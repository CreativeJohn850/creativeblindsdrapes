"""
Sitemap coverage and health test for creativeblindsdrapes.com.

Three jobs:

1. Parse the LOCAL repo sitemap.xml (the source of truth you edit) and verify
   every URL it lists returns HTTP 200 against the target site.

2. Fetch the ONLINE sitemap.xml (what is actually deployed) and verify every URL
   it lists returns HTTP 200.

3. Compare the two sitemaps and print a deploy verdict:
     - URLs in the local sitemap but missing from the online one  => the online
       sitemap is stale and must be redeployed.
     - URLs in the online sitemap but missing from the local one  => the repo
       sitemap dropped URLs that are still live (deploy to sync, or investigate).
   As a secondary check it also diffs the sitemap against the URL inventory in
   test_prod_web.py (DEPLOYED_PATHS + PLANNED_PATHS).

Unlike test_prod_web.py this needs no browser: a plain HTTP client is enough to
read status codes. Only the `requests` library is required.

Usage:
    cd <project-root>
    pip install -r seo/requirements.txt
    python seo/test_sitemap.py --insecure
    python seo/test_sitemap.py --base-url https://creativeblindsdrapes.com
    python seo/test_sitemap.py --json seo/sitemap_test_results.json

Exit code is 0 only when every sitemap URL returns 200 AND the online sitemap is
in sync with the local one (nothing left to deploy). Inventory differences
against test_prod_web.py are reported but never fail the run.
"""

import argparse
import ast
import json
import os
import sys
import time
from urllib.parse import urljoin, urlparse
from xml.etree import ElementTree

import requests

DEFAULT_BASE_URL = "https://creativeblindsdrapes.com"
SITEMAP_PATH = "/sitemap.xml"

USER_AGENT = (
    "Mozilla/5.0 (Windows NT 10.0; Win64; x64) "
    "AppleWebKit/537.36 (KHTML, like Gecko) "
    "Chrome/124.0.0.0 Safari/537.36"
)

HERE = os.path.dirname(os.path.abspath(__file__))
PROD_TEST_FILE = os.path.join(HERE, "test_prod_web.py")
LOCAL_SITEMAP_FILE = os.path.join(HERE, os.pardir, "sitemap.xml")  # repo root sitemap.xml


# ---------------------------------------------------------------------------
# Inventory from test_prod_web.py
# ---------------------------------------------------------------------------

def load_script_inventory(path=PROD_TEST_FILE):
    """
    Return (deployed, planned) as lists of root-relative paths by statically
    parsing test_prod_web.py. Parsing the AST (instead of importing) avoids
    pulling in that module's selenium dependency just to read two lists.
    """
    with open(path, "r", encoding="utf-8") as fh:
        tree = ast.parse(fh.read(), filename=path)
    wanted = {"DEPLOYED_PATHS": None, "PLANNED_PATHS": None}
    for node in tree.body:
        if isinstance(node, ast.Assign):
            for target in node.targets:
                if isinstance(target, ast.Name) and target.id in wanted:
                    wanted[target.id] = ast.literal_eval(node.value)
    missing = [k for k, v in wanted.items() if v is None]
    if missing:
        raise RuntimeError(f"Could not find {missing} in {path}")
    return wanted["DEPLOYED_PATHS"], wanted["PLANNED_PATHS"]


# ---------------------------------------------------------------------------
# Path normalization for set comparison
# ---------------------------------------------------------------------------

def normalize_path(url_or_path):
    """
    Reduce a URL or path to a canonical root-relative path for comparison:
    keep the leading slash, drop a trailing slash (except for root "/"), ignore
    scheme/host/query/fragment. "/about-us/" and the full URL both become
    "/about-us".
    """
    path = urlparse(url_or_path).path or "/"
    if path != "/":
        path = path.rstrip("/")
    return path or "/"


# ---------------------------------------------------------------------------
# Sitemap parsing (local file + live fetch)
# ---------------------------------------------------------------------------

def parse_sitemap_locs(content_bytes):
    """Return the ordered list of <loc> URLs from sitemap XML bytes."""
    root = ElementTree.fromstring(content_bytes)
    # Namespace-agnostic: match any element whose tag ends in "loc".
    locs = [el.text.strip() for el in root.iter() if el.tag.endswith("loc") and el.text]
    return locs


def read_local_sitemap(path=LOCAL_SITEMAP_FILE):
    with open(path, "rb") as fh:
        return parse_sitemap_locs(fh.read())


def fetch_online_sitemap(session, base_url, timeout):
    url = urljoin(base_url + "/", SITEMAP_PATH.lstrip("/"))
    resp = session.get(url, timeout=timeout)
    resp.raise_for_status()
    return parse_sitemap_locs(resp.content)


# ---------------------------------------------------------------------------
# Status checks
# ---------------------------------------------------------------------------

def request_url_for(base_url, loc):
    """Map a sitemap <loc> onto the target base_url, preserving its path."""
    path = urlparse(loc).path or "/"
    return urljoin(base_url + "/", path.lstrip("/"))


def check_url(session, url, timeout):
    """
    GET *url* following redirects. Return a row dict with the final status, the
    final URL, and ok=True only when it ends on 200 at the same resource.
    """
    row = {"url": url, "status": None, "final_url": None, "redirected": False, "error": None, "ok": False}
    try:
        resp = session.get(url, timeout=timeout, allow_redirects=True)
    except requests.RequestException as exc:
        row["error"] = f"{type(exc).__name__}: {exc}"
        return row
    row["status"] = resp.status_code
    row["final_url"] = resp.url
    row["redirected"] = len(resp.history) > 0
    same_resource = normalize_path(resp.url) == normalize_path(url)
    row["ok"] = resp.status_code == 200 and same_resource
    if resp.status_code == 200 and not same_resource:
        row["error"] = "redirected to a different resource"
    return row


def check_paths(session, base_url, locs, timeout, cache):
    """
    Status-check each loc (mapped onto base_url), reusing *cache* keyed by
    normalized path so a URL shared by both sitemaps is only requested once.
    Returns rows in the order given.
    """
    rows = []
    for loc in locs:
        key = normalize_path(loc)
        if key not in cache:
            cache[key] = check_url(session, request_url_for(base_url, loc), timeout)
        rows.append(cache[key])
    return rows


# ---------------------------------------------------------------------------
# Reporting
# ---------------------------------------------------------------------------

def mark(ok):
    return "PASS" if ok else "FAIL"


def print_status_section(title, rows):
    print(f"\n== {title} ==")
    if not rows:
        print("  (no URLs)")
        return
    for r in rows:
        status = r["status"] if r["status"] is not None else "ERR"
        extra = ""
        if r["error"]:
            extra = f"  ({r['error']})"
        elif r["redirected"]:
            extra = f"  (redirected -> {r['final_url']})"
        print(f"  [{mark(r['ok'])}] {status:>4}  {normalize_path(r['url'])}{extra}")


def print_diff_section(title, paths):
    print(f"\n== {title} ({len(paths)}) ==")
    if not paths:
        print("  (none)")
        return
    for p in sorted(paths):
        print(f"  - {p}")


# ---------------------------------------------------------------------------
# Main
# ---------------------------------------------------------------------------

def main():
    parser = argparse.ArgumentParser(description="Sitemap health + deploy-sync test for creativeblindsdrapes.com")
    parser.add_argument("--base-url", default=DEFAULT_BASE_URL, help=f"Base URL (default {DEFAULT_BASE_URL})")
    parser.add_argument("--local-sitemap", default=LOCAL_SITEMAP_FILE, help="Path to the local repo sitemap.xml")
    parser.add_argument("--timeout", type=int, default=20, help="Per-request timeout in seconds")
    parser.add_argument("--insecure", action="store_true",
                        help="Skip TLS certificate verification. Use only when a local "
                             "trust store cannot build the chain (the cert is still valid); "
                             "status codes are unaffected.")
    parser.add_argument("--json", dest="json_path", default=None, help="Write full results to this JSON file")
    args = parser.parse_args()

    base_url = args.base_url.rstrip("/")
    started = time.time()
    session = requests.Session()
    session.headers.update({"User-Agent": USER_AGENT})
    if args.insecure:
        session.verify = False
        requests.packages.urllib3.disable_warnings()  # quiet the per-request InsecureRequestWarning
        print("WARNING: TLS certificate verification disabled (--insecure)")

    print(f"Sitemap test against {base_url}")

    # --- Parse local sitemap (source of truth) ---
    try:
        local_locs = read_local_sitemap(args.local_sitemap)
    except Exception as exc:
        print(f"FATAL: could not read/parse local sitemap {args.local_sitemap}: {type(exc).__name__}: {exc}")
        sys.exit(2)
    print(f"Local  sitemap.xml: {len(local_locs)} URLs  ({os.path.relpath(args.local_sitemap)})")

    # --- Fetch online sitemap (what is deployed) ---
    try:
        online_locs = fetch_online_sitemap(session, base_url, args.timeout)
    except Exception as exc:
        print(f"FATAL: could not fetch/parse online sitemap.xml: {type(exc).__name__}: {exc}")
        sys.exit(2)
    print(f"Online sitemap.xml: {len(online_locs)} URLs  ({base_url}{SITEMAP_PATH})")

    # --- Status-check every URL in both sitemaps (shared URLs hit once) ---
    status_cache = {}
    local_rows = check_paths(session, base_url, local_locs, args.timeout, status_cache)
    online_rows = check_paths(session, base_url, online_locs, args.timeout, status_cache)
    print_status_section("LOCAL sitemap URLs (expect 200)", local_rows)
    print_status_section("ONLINE sitemap URLs (expect 200)", online_rows)
    status_failures = sum(1 for r in status_cache.values() if not r["ok"])

    # --- Compare the two sitemaps ---
    local_paths = {normalize_path(u) for u in local_locs}
    online_paths = {normalize_path(u) for u in online_locs}
    missing_online = local_paths - online_paths   # in repo, not yet deployed
    extra_online = online_paths - local_paths      # deployed, not in repo

    print_diff_section("In LOCAL sitemap but MISSING from online (needs deploy)", missing_online)
    print_diff_section("In ONLINE sitemap but MISSING from local repo", extra_online)

    # --- Secondary: diff sitemap against test_prod_web.py inventory ---
    deployed, planned = load_script_inventory()
    deployed_paths = {normalize_path(p) for p in deployed}
    planned_paths = {normalize_path(p) for p in planned}
    script_paths = deployed_paths | planned_paths
    only_in_local_sitemap = local_paths - script_paths
    only_in_script = script_paths - local_paths
    print(f"\n(secondary) local sitemap vs test_prod_web.py inventory "
          f"[deployed {len(deployed_paths)} + planned {len(planned_paths)}]")
    print_diff_section("Only in local sitemap (not in test_prod_web.py)", only_in_local_sitemap)
    print_diff_section("Only in test_prod_web.py (not in local sitemap)", only_in_script)

    # --- Verdict ---
    sitemap_in_sync = not missing_online and not extra_online
    print(f"\n{'=' * 60}")
    print("VERDICT:")
    if missing_online:
        print(f"  DEPLOY REQUIRED: {len(missing_online)} URL(s) in the local sitemap.xml are "
              f"missing from the online sitemap. Redeploy sitemap.xml.")
    if extra_online:
        print(f"  OUT OF SYNC: {len(extra_online)} URL(s) in the online sitemap are not in the "
              f"local repo. Reconcile (deploy the current sitemap.xml or restore the URLs).")
    if sitemap_in_sync:
        print("  IN SYNC: the online sitemap matches the local sitemap.xml. Nothing to deploy.")
    if status_failures:
        print(f"  STATUS FAILURES: {status_failures} sitemap URL(s) did not return 200.")

    elapsed = time.time() - started
    ok = status_failures == 0 and sitemap_in_sync
    print(f"\nStatus failures: {status_failures}  |  needs-deploy: {len(missing_online)}  |  "
          f"online-extra: {len(extra_online)}  |  elapsed: {elapsed:.1f}s")
    print("RESULT:", "PASS" if ok else "FAIL")

    if args.json_path:
        payload = {
            "base_url": base_url,
            "elapsed_seconds": round(elapsed, 1),
            "local_sitemap_count": len(local_locs),
            "online_sitemap_count": len(online_locs),
            "status_failures": status_failures,
            "sitemap_in_sync": sitemap_in_sync,
            "missing_from_online": sorted(missing_online),
            "extra_in_online": sorted(extra_online),
            "status_rows": list(status_cache.values()),
            "only_in_local_sitemap_vs_script": sorted(only_in_local_sitemap),
            "only_in_script_vs_local_sitemap": sorted(only_in_script),
        }
        with open(args.json_path, "w", encoding="utf-8") as fh:
            json.dump(payload, fh, indent=2)
        print(f"Wrote {args.json_path}")

    sys.exit(0 if ok else 1)


if __name__ == "__main__":
    main()
