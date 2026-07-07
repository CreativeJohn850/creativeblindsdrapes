# Production Web Test Runbook

How to run the Selenium smoke test that validates the live site
(`https://creativeblindsdrapes.com`) returns HTTP 200 over HTTPS for every page in the SEO
build plan, plus redirect, SEO, link, and infrastructure checks.

Script: `seo/test_prod_web.py` | Dependencies: `seo/requirements.txt`

## What it checks

1. **HTTP 200 over HTTPS** for every deployed page (Phase 1 + Phase 2, the sitemap set plus
   `thank-you/`). Real status codes are read from Chrome's performance log
   (`Network.responseReceived` for the main Document), because Selenium does not expose status
   codes on its own.
2. **Redirect canonicalization**: `http://`, `http://www.`, and `https://www.` all 301 to
   `https://creativeblindsdrapes.com/`.
3. **Per-page SEO asserts** (skips the noindex `thank-you/`): exactly one `<h1>`, meta
   description <= 155 chars, title <= 60 chars before the ` | ` suffix, and a self-referential
   `<link rel="canonical">`.
4. **Internal broken-link crawl**: every in-scope `<a href>` found on the deployed pages is
   de-duplicated and checked for a 200/301/302.
5. **Infrastructure**: `/robots.txt` and `/sitemap.xml` return 200, and a random nonexistent
   path returns a real 404.

Phase 3-6 pages are not built yet. They live in a separate `PLANNED_PATHS` list and are only
probed with `--include-planned`, where they are reported as "not yet live" and never fail the
run. As each ships, move its path from `PLANNED_PATHS` to `DEPLOYED_PATHS` in the script.

## Prerequisites

- Python 3.9 or newer.
- Google Chrome installed (the matching driver is fetched automatically by
  `webdriver-manager`).
- Network access to the live site.

## Install

```bash
cd C:\wamp64\www\creativeblindsdrapes
pip install -r seo/requirements.txt
```

A virtual environment is recommended but optional:

```bash
python -m venv .venv
.venv\Scripts\activate
pip install -r seo/requirements.txt
```

## Run

From the project root:

```bash
# Deployed pages only (Phase 1 + 2), headless. This is the main run.
python seo/test_prod_web.py

# Also probe Phase 3-6 planned pages (reported, not failed)
python seo/test_prod_web.py --include-planned

# Watch it in a real browser window
python seo/test_prod_web.py --headed

# Skip the slower internal-link crawl
python seo/test_prod_web.py --skip-links

# Save a machine-readable report
python seo/test_prod_web.py --json seo/prod_test_results.json

# Test a different environment (e.g. staging)
python seo/test_prod_web.py --base-url https://staging.example.com
```

Other flags: `--timeout <seconds>` (per-page load timeout, default 20).

## Reading the output

Each row is prefixed with a verdict:

- `PASS` the check passed.
- `FAIL` a deployed/redirect/SEO/link/infra check failed. Counts toward the exit code.
- `INFO` informational only (planned pages). Never fails the run.

The final block prints `Hard failures: N` and `RESULT: PASS|FAIL`. The process exits `0` when
there are zero hard failures and `1` otherwise, so it can gate a deploy step or CI job.

Common failures and what they mean:

- A deployed page shows a status other than `200`: it is missing on the server, misconfigured,
  or the deploy did not copy it. Confirm the file exists at the mapped path.
- A redirect row fails: the `.htaccess` canonical (www to non-www) or HTTP to HTTPS rule is not
  active on the live host.
- An SEO row fails: fix the specific note (duplicate H1, over-long meta/title, missing or wrong
  canonical) on that page.
- A link row fails: an internal `<a href>` points at a dead or moved URL.

## Suggested additional tests (not automated by this script)

Run these manually during the maintenance window, or add them later:

- **Mobile performance / LCP**: Lighthouse or PageSpeed Insights on the home page and one hub;
  target mobile LCP < 2.5s and Performance >= 80 (Phase 1.7).
- **Schema validation**: Google Rich Results Test on each page type; confirm `Service`,
  `FAQPage`, and `BreadcrumbList` are valid and there are zero invalid items (Phase 1.5).
- **Mixed content**: confirm no `http://` assets load on HTTPS pages (browser console has no
  mixed-content warnings). Can be scripted later by scanning the performance log for insecure
  request URLs.
- **Contact form end to end**: submit `contact/` with a valid Aurora ZIP and confirm the
  reCAPTCHA v3 flow, the redirect to `thank-you/`, and that an out-of-range ZIP is rejected.
- **Image audit**: below-the-fold images are WebP with `loading="lazy"` and descriptive `alt`
  text.
- **Accessibility**: an axe-core pass for color contrast, labels, and landmark structure.
- **Security headers**: check for HSTS and the headers noted as missing in CLAUDE.md
  (`X-Frame-Options`, `X-Content-Type-Options`, `Referrer-Policy`).
- **Uptime monitoring**: an external monitor (e.g. a scheduled ping) on the home page and the
  sitemap.
- **Typography rule**: the dash-free check from CLAUDE.md
  (`grep -rnP '\x{2014}|\x{2013}' . --exclude-dir=.git`).
