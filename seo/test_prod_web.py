"""
Production smoke test for creativeblindsdrapes.com.

Drives a real Chrome via Selenium against the LIVE site and verifies that every
page across the SEO build plan returns HTTP 200 over HTTPS. It also checks
redirect canonicalization, a few per-page SEO invariants, internal links, and
basic infrastructure endpoints.

Status codes: Selenium does not expose HTTP status directly, so this script
enables Chrome performance logging and reads the Network.responseReceived event
for the main Document response. That gives the real status code and the full
redirect chain.

Stack mirrors scraper/scrape_shutters.py (Selenium 4 + webdriver-manager).

Usage:
    cd <project-root>
    pip install -r seo/requirements.txt
    python seo/test_prod_web.py                 # deployed pages, headless
    python seo/test_prod_web.py --include-planned
    python seo/test_prod_web.py --headed
    python seo/test_prod_web.py --skip-links
    python seo/test_prod_web.py --json seo/prod_test_results.json

Exit code is 0 only when all deployed, redirect, and infra checks pass. Planned
(not yet built) pages are reported but never fail the run.
"""

import argparse
import json
import sys
import time
import uuid
from urllib.parse import urljoin, urlparse

from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.common.by import By
from webdriver_manager.chrome import ChromeDriverManager

DEFAULT_BASE_URL = "https://creativeblindsdrapes.com"

# ---------------------------------------------------------------------------
# URL inventory (grouped by SEO build phase). Paths are root-relative.
# As a planned page ships, move it from PLANNED_PATHS into DEPLOYED_PATHS.
# ---------------------------------------------------------------------------

# Phase 1 (existing pages) + Phase 2 (14 spokes). Sourced from sitemap.xml,
# plus thank-you/ which is intentionally noindex and not in the sitemap.
DEPLOYED_PATHS = [
    # Core / Phase 1
    "/",
    "/about-us/",
    "/contact/",
    "/thank-you/",
    "/curtain-hardware.php",
    # Product hubs
    "/window-treatments/",
    "/window-treatments/window-shutters/",
    "/window-treatments/window-blinds/",
    "/window-treatments/shades/",
    "/window-treatments/curtains-and-drapes/",
    # Phase 2: shade spokes
    "/window-treatments/shades/honeycomb-shades/",
    "/window-treatments/shades/roller-shades/",
    "/window-treatments/shades/roman-shades/",
    "/window-treatments/shades/sheer-shades/",
    # Phase 2: blind spokes
    "/window-treatments/window-blinds/horizontal-blinds/",
    "/window-treatments/window-blinds/vertical-blinds/",
    # Phase 2: curtain spokes
    "/window-treatments/curtains-and-drapes/draperies/",
    "/window-treatments/curtains-and-drapes/sheers/",
    # Phase 2: installer hub + spokes
    "/window-treatments/window-treatment-installer/",
    "/window-treatments/window-treatment-installer/blind-installer/",
    "/window-treatments/window-treatment-installer/shades-installation/",
    "/window-treatments/window-treatment-installer/shutter-installer/",
    "/window-treatments/window-treatment-installer/drapery-installation/",
    # Phase 2: motorized
    "/window-treatments/motorized-window-treatment/",
    # Phase 3: service-area hub + 8 city pages
    "/service-areas/",
    "/service-areas/aurora-il/",
    "/service-areas/naperville-il/",
    "/service-areas/oswego-il/",
    "/service-areas/yorkville-il/",
    "/service-areas/batavia-il/",
    "/service-areas/geneva-il/",
    "/service-areas/st-charles-il/",
    "/service-areas/plainfield-il/",
]

# Phase 4-6. Not built yet: expected to 404 until deployed. Reported, not failed.
# (Phase 3 service-area pages shipped and moved into DEPLOYED_PATHS above.)
PLANNED_PATHS = [
    # Phase 4: content and trust pages
    "/gallery/",
    "/guidelines/",
    "/blog/",
    # Phase 5: brand / authority page (URL still tentative)
    "/adeko-fabrics/",
    # Phase 6: service x city matrix is deferred with no fixed URLs.
]

# Pages that must not carry indexable SEO tags, so per-page SEO asserts skip them.
NOINDEX_PATHS = {"/thank-you/"}

# Redirect sources that must all land on the canonical https non-www home page.
REDIRECT_SOURCES = [
    "http://creativeblindsdrapes.com/",
    "http://www.creativeblindsdrapes.com/",
    "https://www.creativeblindsdrapes.com/",
]

MAX_META_DESCRIPTION = 155
MAX_TITLE = 60
TITLE_SUFFIX_SEP = " | "


# ---------------------------------------------------------------------------
# Driver
# ---------------------------------------------------------------------------

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
    # Enable performance logging so we can read Network.responseReceived events.
    opts.set_capability("goog:loggingPrefs", {"performance": "ALL"})
    service = Service(ChromeDriverManager().install())
    return webdriver.Chrome(service=service, options=opts)


# ---------------------------------------------------------------------------
# Status capture
# ---------------------------------------------------------------------------

def _same_resource(a: str, b: str) -> bool:
    """True if two URLs point at the same resource ignoring a trailing slash."""
    return a.rstrip("/") == b.rstrip("/")


def fetch(driver, url: str, timeout: int) -> dict:
    """
    Load *url* and return a dict:
        {url, final_url, status, chain, error}
    status is the HTTP status of the final main-document response (int) or None.
    chain is the ordered list of document status codes (redirects then final).
    """
    result = {"url": url, "final_url": None, "status": None, "chain": [], "error": None}
    try:
        driver.set_page_load_timeout(timeout)
        driver.get(url)
    except Exception as exc:  # timeouts, DNS, connection resets, etc.
        result["error"] = f"{type(exc).__name__}: {exc}"
        return result

    result["final_url"] = driver.current_url

    # Collect document responses and redirects from the performance log.
    doc_responses = []  # (url, status)
    redirects = []      # (from_url, status)
    try:
        for entry in driver.get_log("performance"):
            try:
                msg = json.loads(entry["message"])["message"]
            except (KeyError, ValueError):
                continue
            method = msg.get("method")
            params = msg.get("params", {})
            if method == "Network.responseReceived":
                if params.get("type") == "Document":
                    resp = params.get("response", {})
                    doc_responses.append((resp.get("url", ""), resp.get("status")))
            elif method == "Network.requestWillBeSent":
                redirect_resp = params.get("redirectResponse")
                if redirect_resp:
                    redirects.append(
                        (redirect_resp.get("url", ""), redirect_resp.get("status"))
                    )
    except Exception as exc:
        result["error"] = f"log-parse: {type(exc).__name__}: {exc}"
        return result

    chain = [status for _, status in redirects] + [status for _, status in doc_responses]
    result["chain"] = [c for c in chain if c is not None]

    # Prefer the document response whose URL matches the final URL.
    final = driver.current_url
    status = None
    for doc_url, doc_status in doc_responses:
        if _same_resource(doc_url, final):
            status = doc_status
            break
    if status is None and doc_responses:
        status = doc_responses[-1][1]
    result["status"] = status
    return result


# ---------------------------------------------------------------------------
# Checks
# ---------------------------------------------------------------------------

class Report:
    def __init__(self):
        self.sections = []  # list of (title, list-of-rows)
        self.hard_failures = 0

    def add(self, title, rows, count_failures=True):
        self.sections.append((title, rows))
        if count_failures:
            self.hard_failures += sum(1 for r in rows if r.get("ok") is False)

    def to_json(self):
        return {
            "hard_failures": self.hard_failures,
            "sections": [
                {"title": t, "rows": rows} for t, rows in self.sections
            ],
        }


def check_status_pages(driver, base_url, paths, timeout, expect_200):
    rows = []
    for path in paths:
        url = urljoin(base_url, path)
        res = fetch(driver, url, timeout)
        is_https = (res["final_url"] or "").startswith("https://")
        if expect_200:
            ok = res["status"] == 200 and is_https and res["error"] is None
        else:
            # Planned pages: informational. "ok" is None so it never fails a run.
            ok = None
        rows.append({
            "path": path,
            "status": res["status"],
            "final_url": res["final_url"],
            "https": is_https,
            "error": res["error"],
            "ok": ok,
        })
    return rows


# Statuses that count as a redirect hop. 301/308 are the server-side permanent
# redirects we want; 307 (and 302) also appear as Chrome HSTS "internal
# redirect" upgrades of http -> https once the site's Strict-Transport-Security
# header has been seen. An HSTS 307 is a correct, more secure outcome, so it
# counts: the requirement is that each non-canonical variant redirects and ends
# on the canonical https non-www URL, not that a specific 301 shows up.
REDIRECT_CODES = {301, 302, 307, 308}


def check_redirects(driver, base_url, timeout):
    canonical = base_url.rstrip("/") + "/"
    rows = []
    for src in REDIRECT_SOURCES:
        res = fetch(driver, src, timeout)
        landed = (res["final_url"] or "").rstrip("/") + "/"
        redirected = any(c in REDIRECT_CODES for c in res["chain"])
        lands_canonical = landed == canonical and (res["final_url"] or "").startswith("https://")
        # The canonical source itself may serve 200 directly; every other
        # variant must redirect (server 301/308, or a browser HSTS 307) and end
        # on the canonical URL.
        if src == canonical:
            ok = lands_canonical and res["error"] is None
        else:
            ok = lands_canonical and redirected and res["error"] is None
        rows.append({
            "source": src,
            "landed": res["final_url"],
            "chain": res["chain"],
            "redirected": redirected,
            "error": res["error"],
            "ok": ok,
        })
    return rows


def check_seo(driver, base_url, paths, timeout):
    rows = []
    for path in paths:
        if path in NOINDEX_PATHS:
            continue
        url = urljoin(base_url, path)
        res = fetch(driver, url, timeout)
        if res["status"] != 200:
            rows.append({"path": path, "ok": False, "notes": ["page not 200, SEO checks skipped"]})
            continue
        notes = []
        ok = True

        h1s = driver.find_elements(By.TAG_NAME, "h1")
        if len(h1s) != 1:
            ok = False
            notes.append(f"h1 count = {len(h1s)} (want 1)")

        metas = driver.find_elements(By.CSS_SELECTOR, "meta[name='description']")
        if not metas:
            ok = False
            notes.append("missing meta description")
        else:
            desc = metas[0].get_attribute("content") or ""
            if len(desc) > MAX_META_DESCRIPTION:
                ok = False
                notes.append(f"meta description {len(desc)} chars (max {MAX_META_DESCRIPTION})")

        title = driver.title or ""
        title_head = title.split(TITLE_SUFFIX_SEP)[0]
        if len(title_head) > MAX_TITLE:
            ok = False
            notes.append(f"title {len(title_head)} chars before suffix (max {MAX_TITLE})")

        canonicals = driver.find_elements(By.CSS_SELECTOR, "link[rel='canonical']")
        if not canonicals:
            ok = False
            notes.append("missing canonical")
        else:
            href = canonicals[0].get_attribute("href") or ""
            if not _same_resource(href, url):
                ok = False
                notes.append(f"canonical '{href}' != page url")

        rows.append({"path": path, "ok": ok, "notes": notes or ["ok"]})
    return rows


def collect_internal_links(driver, base_url, paths, timeout):
    """Visit each deployed page and gather unique in-scope internal link targets."""
    host = urlparse(base_url).netloc
    targets = set()
    for path in paths:
        url = urljoin(base_url, path)
        res = fetch(driver, url, timeout)
        if res["status"] != 200:
            continue
        for a in driver.find_elements(By.TAG_NAME, "a"):
            href = a.get_attribute("href") or ""
            if not href:
                continue
            parsed = urlparse(href)
            if parsed.scheme not in ("http", "https", ""):
                continue  # skip mailto:, tel:, javascript:, etc.
            if parsed.netloc and parsed.netloc != host:
                continue  # external link
            clean = href.split("#")[0]
            if clean:
                targets.add(clean)
    return sorted(targets)


def check_links(driver, base_url, paths, timeout):
    rows = []
    for target in collect_internal_links(driver, base_url, paths, timeout):
        res = fetch(driver, target, timeout)
        ok = res["status"] in (200, 301, 302) and res["error"] is None
        rows.append({"link": target, "status": res["status"], "error": res["error"], "ok": ok})
    return rows


def check_infra(driver, base_url, timeout):
    rows = []
    for path, want in (("/robots.txt", 200), ("/sitemap.xml", 200)):
        res = fetch(driver, urljoin(base_url, path), timeout)
        rows.append({
            "path": path, "status": res["status"], "want": want,
            "error": res["error"], "ok": res["status"] == want,
        })
    bad = f"/does-not-exist-{uuid.uuid4().hex[:12]}/"
    res = fetch(driver, urljoin(base_url, bad), timeout)
    rows.append({
        "path": bad, "status": res["status"], "want": 404,
        "error": res["error"], "ok": res["status"] == 404,
    })
    return rows


# ---------------------------------------------------------------------------
# Console output
# ---------------------------------------------------------------------------

def mark(ok):
    if ok is True:
        return "PASS"
    if ok is False:
        return "FAIL"
    return "INFO"


def print_status_section(title, rows):
    print(f"\n== {title} ==")
    for r in rows:
        status = r["status"] if r["status"] is not None else "ERR"
        extra = ""
        if r.get("error"):
            extra = f"  ({r['error']})"
        elif r.get("ok") is None and r["status"] != 200:
            extra = "  (not yet live)"
        print(f"  [{mark(r['ok'])}] {status:>4}  {r['path']}{extra}")


def print_redirect_section(rows):
    print("\n== Redirect canonicalization ==")
    for r in rows:
        chain = " -> ".join(str(c) for c in r["chain"]) or "none"
        err = f"  ({r['error']})" if r.get("error") else ""
        print(f"  [{mark(r['ok'])}] {r['source']}  chain: {chain}  landed: {r['landed']}{err}")


def print_generic_section(title, rows, label_key):
    print(f"\n== {title} ==")
    for r in rows:
        note = ""
        if "notes" in r:
            note = "  " + "; ".join(r["notes"])
        elif "status" in r:
            want = r.get("want")
            note = f"  status={r['status']}" + (f" want={want}" if want is not None else "")
            if r.get("error"):
                note += f"  ({r['error']})"
        print(f"  [{mark(r['ok'])}] {r[label_key]}{note}")


# ---------------------------------------------------------------------------
# Main
# ---------------------------------------------------------------------------

def main():
    parser = argparse.ArgumentParser(description="Production smoke test for creativeblindsdrapes.com")
    parser.add_argument("--base-url", default=DEFAULT_BASE_URL,
                        help=f"Base URL (default {DEFAULT_BASE_URL})")
    parser.add_argument("--headed", action="store_true", help="Run with a visible browser window")
    parser.add_argument("--include-planned", action="store_true",
                        help="Also probe Phase 3-6 pages (reported, never fails the run)")
    parser.add_argument("--skip-links", action="store_true", help="Skip the internal broken-link crawl")
    parser.add_argument("--timeout", type=int, default=20, help="Per-page load timeout in seconds")
    parser.add_argument("--json", dest="json_path", default=None, help="Write full results to this JSON file")
    args = parser.parse_args()

    base_url = args.base_url.rstrip("/")
    started = time.time()
    print(f"Prod smoke test against {base_url}")
    print(f"Deployed pages: {len(DEPLOYED_PATHS)} | planned pages: {len(PLANNED_PATHS)}")

    driver = build_driver(headless=not args.headed)
    report = Report()
    try:
        deployed_rows = check_status_pages(driver, base_url, DEPLOYED_PATHS, args.timeout, expect_200=True)
        report.add("Deployed pages (expect 200)", deployed_rows)
        print_status_section("Deployed pages (expect 200)", deployed_rows)

        redirect_rows = check_redirects(driver, base_url, args.timeout)
        report.add("Redirect canonicalization", redirect_rows)
        print_redirect_section(redirect_rows)

        seo_rows = check_seo(driver, base_url, DEPLOYED_PATHS, args.timeout)
        report.add("Per-page SEO asserts", seo_rows)
        print_generic_section("Per-page SEO asserts", seo_rows, "path")

        infra_rows = check_infra(driver, base_url, args.timeout)
        report.add("Infrastructure", infra_rows)
        print_generic_section("Infrastructure", infra_rows, "path")

        if not args.skip_links:
            link_rows = check_links(driver, base_url, DEPLOYED_PATHS, args.timeout)
            report.add("Internal links", link_rows)
            print_generic_section("Internal links", link_rows, "link")

        if args.include_planned:
            planned_rows = check_status_pages(driver, base_url, PLANNED_PATHS, args.timeout, expect_200=False)
            report.add("Planned pages (not yet live)", planned_rows, count_failures=False)
            print_status_section("Planned pages (Phase 3-6, informational)", planned_rows)
    finally:
        driver.quit()

    elapsed = time.time() - started
    print(f"\n{'=' * 60}")
    print(f"Hard failures: {report.hard_failures}  |  elapsed: {elapsed:.1f}s")
    print("RESULT:", "PASS" if report.hard_failures == 0 else "FAIL")

    if args.json_path:
        payload = report.to_json()
        payload["base_url"] = base_url
        payload["elapsed_seconds"] = round(elapsed, 1)
        with open(args.json_path, "w", encoding="utf-8") as fh:
            json.dump(payload, fh, indent=2)
        print(f"Wrote {args.json_path}")

    sys.exit(0 if report.hard_failures == 0 else 1)


if __name__ == "__main__":
    main()
