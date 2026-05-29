"""
Norman USA shutter scraper.

Reads scraper/input.json (list of {name, folder, manufacturer_url}),
visits each manufacturer page with Selenium, scrapes the product details
(Colors, Louver Sizes, Frames, Control Options, Design Inspiration),
merges the results with local image file listings, and writes
data/shutters.json relative to the project root.

Usage:
    cd <project-root>
    pip install -r scraper/requirements.txt
    python scraper/scrape_shutters.py [--headless]
"""

import argparse
import json
import os
import sys
import time

from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import WebDriverWait
from webdriver_manager.chrome import ChromeDriverManager

# ---------------------------------------------------------------------------
# Configuration
# ---------------------------------------------------------------------------

SCRIPT_DIR = os.path.dirname(os.path.abspath(__file__))
PROJECT_ROOT = os.path.dirname(SCRIPT_DIR)

INPUT_FILE = os.path.join(SCRIPT_DIR, "input.json")
OUTPUT_FILE = os.path.join(PROJECT_ROOT, "data", "shutters.json")

# Seconds to wait for the page and dynamic content to load.
PAGE_LOAD_TIMEOUT = 15
SECTION_WAIT_TIMEOUT = 10

# Characteristics we want to extract, keyed by the heading text on the page.
CHARACTERISTIC_KEYS = {
    "Colors": "colors",
    "Louver Sizes": "louver_sizes",
    "Frames": "frames",
    "Control Options": "control_options",
}

DESIGN_INSPIRATION_HEADING = "Design Inspiration"


# ---------------------------------------------------------------------------
# Helpers
# ---------------------------------------------------------------------------

def make_slug(name: str) -> str:
    return name.lower().replace(" ", "-")


def local_image_paths(folder: str) -> list[str]:
    """Return sorted relative paths of image files inside *folder*."""
    abs_folder = os.path.join(PROJECT_ROOT, folder)
    if not os.path.isdir(abs_folder):
        print(f"  [warn] folder not found: {abs_folder}", file=sys.stderr)
        return []
    exts = {".jpg", ".jpeg", ".png", ".webp", ".gif"}
    files = sorted(
        f for f in os.listdir(abs_folder)
        if os.path.splitext(f)[1].lower() in exts
    )
    # Use forward slashes so paths are valid in HTML/JSON on any OS.
    return [folder.replace("\\", "/") + "/" + f for f in files]


def build_driver(headless: bool) -> webdriver.Chrome:
    opts = Options()
    if headless:
        opts.add_argument("--headless=new")
    opts.add_argument("--disable-gpu")
    opts.add_argument("--no-sandbox")
    opts.add_argument("--window-size=1280,900")
    opts.add_argument(
        "user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) "
        "AppleWebKit/537.36 (KHTML, like Gecko) "
        "Chrome/124.0.0.0 Safari/537.36"
    )
    service = Service(ChromeDriverManager().install())
    return webdriver.Chrome(service=service, options=opts)


def scroll_to_element(driver, element):
    driver.execute_script("arguments[0].scrollIntoView({block:'center'});", element)
    time.sleep(0.4)


def expand_accordion(driver, element):
    """Click an accordion item if it is collapsed."""
    try:
        aria = element.get_attribute("aria-expanded")
        if aria == "false":
            scroll_to_element(driver, element)
            element.click()
            time.sleep(0.5)
    except Exception:
        pass


# ---------------------------------------------------------------------------
# Scraping logic
# ---------------------------------------------------------------------------

def find_section_by_heading(driver, heading_text: str):
    """
    Try several common accordion/tab patterns to locate a product-detail
    section whose visible heading matches *heading_text*.

    Returns the container element or None.
    """
    # Strategy 1: aria-label or data-title attribute
    for attr in ("aria-label", "data-title", "data-tab"):
        try:
            el = driver.find_element(
                By.CSS_SELECTOR, f'[{attr}="{heading_text}"]'
            )
            return el
        except Exception:
            pass

    # Strategy 2: walk heading elements (h2-h4) and return the parent container
    for tag in ("h2", "h3", "h4", "h5", "button", "span", "div"):
        elements = driver.find_elements(By.TAG_NAME, tag)
        for el in elements:
            try:
                if el.text.strip() == heading_text:
                    # Expand accordion if needed
                    expand_accordion(driver, el)
                    # Return sibling or parent that holds the content
                    parent = el.find_element(By.XPATH, "..")
                    return parent
            except Exception:
                continue
    return None


def extract_list_items(container) -> list[str]:
    """Return text content of all <li> elements inside *container*."""
    try:
        items = container.find_elements(By.TAG_NAME, "li")
        return [li.text.strip() for li in items if li.text.strip()]
    except Exception:
        return []


def extract_option_values(container) -> list[str]:
    """Return <option> values as fallback when no <li> elements exist."""
    try:
        options = container.find_elements(By.TAG_NAME, "option")
        return [o.text.strip() for o in options if o.text.strip()]
    except Exception:
        return []


def extract_text_content(container) -> list[str]:
    """
    Last-resort: split the container's visible text on commas or newlines
    to produce a list of values.
    """
    try:
        raw = container.text.strip()
        if not raw:
            return []
        # Remove the heading line if it crept in
        lines = [ln.strip() for ln in raw.splitlines() if ln.strip()]
        if len(lines) > 1:
            return lines[1:]  # skip heading
        # Comma-separated in a single line
        return [v.strip() for v in lines[0].split(",") if v.strip()]
    except Exception:
        return []


def scrape_characteristic(driver, heading: str) -> list[str]:
    """
    Locate the section for *heading* and extract the list of values.
    Returns an empty list on failure (never raises).
    """
    container = find_section_by_heading(driver, heading)
    if container is None:
        print(f"  [warn] section not found: '{heading}'", file=sys.stderr)
        return []

    values = extract_list_items(container)
    if not values:
        values = extract_option_values(container)
    if not values:
        values = extract_text_content(container)
    return values


def scrape_design_inspiration(driver) -> list[str]:
    """
    Locate the Design Inspiration section and return image src URLs.
    """
    container = find_section_by_heading(driver, DESIGN_INSPIRATION_HEADING)
    if container is None:
        return []
    try:
        imgs = container.find_elements(By.TAG_NAME, "img")
        return [
            img.get_attribute("src") or img.get_attribute("data-src") or ""
            for img in imgs
            if (img.get_attribute("src") or img.get_attribute("data-src"))
        ]
    except Exception:
        return []


def scrape_product(driver, entry: dict) -> dict:
    url = entry["manufacturer_url"]
    name = entry["name"]
    folder = entry["folder"]

    print(f"\nScraping: {name}")
    print(f"  URL: {url}")

    driver.get(url)

    # Wait for the body to be ready, then let JS settle
    try:
        WebDriverWait(driver, PAGE_LOAD_TIMEOUT).until(
            EC.presence_of_element_located((By.TAG_NAME, "body"))
        )
    except Exception:
        print(f"  [warn] page load timed out for {url}", file=sys.stderr)

    # Scroll down to trigger lazy-load of product detail sections
    driver.execute_script("window.scrollTo(0, document.body.scrollHeight / 2);")
    time.sleep(1.5)
    driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
    time.sleep(1.0)
    driver.execute_script("window.scrollTo(0, 0);")
    time.sleep(0.5)

    product = {
        "name": name,
        "slug": entry.get("slug", make_slug(name)),
        "category": entry.get("category", ""),
        "description": "",
        "images": local_image_paths(folder),
        "colors": [],
        "louver_sizes": [],
        "frames": [],
        "control_options": [],
        "design_inspiration": [],
        "features": [],
        "manufacturer_url": url,
    }

    for heading, key in CHARACTERISTIC_KEYS.items():
        values = scrape_characteristic(driver, heading)
        product[key] = values
        print(f"  {heading}: {values}")

    product["design_inspiration"] = scrape_design_inspiration(driver)
    print(f"  Design Inspiration: {len(product['design_inspiration'])} images")

    return product


# ---------------------------------------------------------------------------
# Main
# ---------------------------------------------------------------------------

def main():
    parser = argparse.ArgumentParser(description="Scrape Norman USA shutter details.")
    parser.add_argument(
        "--headless",
        action="store_true",
        help="Run Chrome in headless mode (no visible browser window).",
    )
    parser.add_argument(
        "--input",
        default=INPUT_FILE,
        help=f"Path to input JSON (default: {INPUT_FILE})",
    )
    parser.add_argument(
        "--output",
        default=OUTPUT_FILE,
        help=f"Path to output JSON (default: {OUTPUT_FILE})",
    )
    args = parser.parse_args()

    with open(args.input, encoding="utf-8") as f:
        entries = json.load(f)

    driver = build_driver(headless=args.headless)
    results = []

    try:
        for entry in entries:
            try:
                product = scrape_product(driver, entry)
                results.append(product)
            except Exception as exc:
                print(f"  [error] failed to scrape {entry['name']}: {exc}", file=sys.stderr)
                # Append a minimal record so the JSON stays complete
                results.append({
                    "name": entry["name"],
                    "slug": entry.get("slug", make_slug(entry["name"])),
                    "category": entry.get("category", ""),
                    "description": "",
                    "images": local_image_paths(entry["folder"]),
                    "colors": [],
                    "louver_sizes": [],
                    "frames": [],
                    "control_options": [],
                    "design_inspiration": [],
                    "features": [],
                    "manufacturer_url": entry["manufacturer_url"],
                })
    finally:
        driver.quit()

    os.makedirs(os.path.dirname(args.output), exist_ok=True)
    with open(args.output, "w", encoding="utf-8") as f:
        json.dump(results, f, ensure_ascii=False, indent=2)

    print(f"\nWrote {len(results)} products to {args.output}")


if __name__ == "__main__":
    main()
