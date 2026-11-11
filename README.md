# Creative Blinds & Drapes: site tools

Scripts and test assets behind [creativeblindsdrapes.com](https://creativeblindsdrapes.com), a window treatment business in Aurora, IL. They generate blog posts and product data, prepare images, test the local and live sites, notify search engines of changes, and handle the contact form.

The public PHP pages (`index.php`, `blog/`, `window-treatments/`, and so on) are the website, not tools, so they are not listed here. `CLAUDE.md` describes the site architecture.

## Setup

Run from the repo root, `C:/wamp64/www/creativeblindsdrapes`. There is no build step.

| Need | Used by | Install or check |
|------|---------|------------------|
| Python 3.10+ | All `.py` tools (`photo_util.py` needs 3.10; the others run on 3.9+) | `python --version` |
| Pillow | `lcp_photo.py`, `photo_util.py` | `pip install Pillow` (not in any requirements file) |
| Selenium, webdriver-manager | `scrape_shutters.py`, `test_prod_web.py`, `TestForms.ipynb` | `pip install -r scraper/requirements.txt` |
| Selenium, webdriver-manager, requests | `seo/` tests | `pip install -r seo/requirements.txt` |
| Google Chrome | All Selenium tools | webdriver-manager downloads the matching driver, so internet access is needed |
| Jupyter | `TestForms.ipynb` | `pip install notebook` |
| PHP 7+ with curl and SimpleXML, `allow_url_fopen` on | IndexNow scripts | `php -m` (WAMP CLI: `C:/wamp64/bin/php/php7.4.33/php`) |
| Apache and PHP (WAMP64) | `test-local.ps1`, `process-contact.php` | Site at `http://localhost/creativeblindsdrapes/` |
| Windows PowerShell 5.1 | `test-local.ps1` | Included with Windows |
| Postman | `WEB_FORMS_COLLECTION.json` | Desktop or web app |

Optional virtual environment: `python -m venv .venv`, then `source .venv/Scripts/activate` in Git Bash. `.venv/` is ignored by Git.

## Tool index

| Tool | Purpose | Command |
|------|---------|---------|
| [build-blog.py](#build-blogpy) | Generate blog posts from `.docx` articles and sync the sitemap | `python scraper/build-blog.py --all` |
| [scrape_shutters.py](#scrape_shutterspy) | Scrape Norman USA shutter specs into `data/shutters.json` | `python scraper/scrape_shutters.py --headless` |
| [lcp_photo.py](#lcp_photopy) | Make mobile `_m.webp` versions of hero images | `python lcp_photo.py <image>...` |
| [photo_util.py](#photo_utilpy) | Make `_thumb.webp` product thumbnails (**Broken**) | `python photo_util.py` |
| [test-local.ps1](#test-localps1) | Smoke-test pages, redirects, and tags over HTTP | `powershell -ExecutionPolicy Bypass -File test-local.ps1` |
| [test_prod_web.py](#test_prod_webpy) | Browser-based production test: status, SEO, links | `python seo/test_prod_web.py` |
| [test_sitemap.py](#test_sitemappy) | Compare local and live sitemaps, and check every URL | `python seo/test_sitemap.py` |
| [indexnow_test.php](#indexnow_testphp) | Verify the IndexNow key and submit one URL | `php data/config/index/indexnow_test.php` |
| [indexnow_sync.php](#indexnow_syncphp) | Submit new or changed sitemap URLs to IndexNow | `php data/config/index/indexnow_sync.php` |
| [process-contact.php](#process-contactphp) | Contact form endpoint: validate, email, log | `POST /data/config/process-contact.php` |
| [TestForms.ipynb](#testformsipynb) | Selenium form tests for creativefloors.co (**Broken**) | `jupyter notebook form-test/TestForms.ipynb` |
| [WEB_FORMS_COLLECTION.json](#web_forms_collectionjson) | Postman requests for the Lead Tracking web forms API | Import into Postman |

## Typical workflow

**Publish blog articles**

```bash
python scraper/build-blog.py --all --dry-run            # 1. preview
python scraper/build-blog.py --all                      # 2. write pages, index, sitemap
powershell -ExecutionPolicy Bypass -File test-local.ps1 # 3. check locally
# 4. upload the changed files to production (FileZilla)
python seo/test_sitemap.py                              # 5. check the live sitemap
python seo/test_prod_web.py                             # 6. check the live site
# 7. over SSH on production:
php data/config/index/indexnow_sync.php --dry-run
php data/config/index/indexnow_sync.php
```

**Add a hero image:** add the source image, run `lcp_photo.py`, reference the `_m.webp` file in the page, then run `test-local.ps1`.

**Refresh shutter data:** see the overwrite warning under [scrape_shutters.py](#scrape_shutterspy) first.

---

## Blog and product data

### build-blog.py

#### What it does

Turns the SEO `.docx` articles into pre-rendered PHP blog pages with JSON-LD, updates the blog index, and adds new posts to the sitemap. Run it to add or rebuild articles.

#### How to run

Paths resolve from the script location, so any working directory works. Standard library only.

```bash
python scraper/build-blog.py --all
python scraper/build-blog.py --only 17,22 --dry-run
python scraper/build-blog.py --sitemap-only
```

| Flag | Default | Meaning |
|------|---------|---------|
| `--all` | off | Build every matching `.docx` |
| `--only N,N` | none | Build these article numbers |
| `--sitemap-only` | off | Sync `sitemap.xml` from `data/blog-index.json`, then exit |
| `--dry-run` | off | Parse and report, write nothing |
| `--date YYYY-MM-DD` | `PUBLISH_DATE` (2026-09-14) | Publication date for this run |
| `--docx-dir PATH` | `DOCX_DIR` constant (below) | Source folder |
| `--format php\|html` | `php` | Output file extension; see Notes |

One of `--all`, `--only`, or `--sitemap-only` is required.

#### Input

- Files named `CBD-ArtNN*.docx`, by default from `C:\Users\Manager\Documents\Creative Blinds And Drapes Inc\SEO\24art-9-14-2026\articoleblogctabanners`.
- Word formatting is the structure, read from run font size: H1 is `sz=36`, H2 is `sz=28`, meta lines are `sz=18`, with `Title (N chars): ...` and `Description (N chars): ...`.
- A heading starting "Frequently Asked Questions" begins the FAQ, where bold paragraphs are questions. A heading starting "About Creative Blinds" begins the About box.
- Images in `assets/images/blog/`, named `{id}_{slot}_{text}[_thumb].{webp,jpg,jpeg,png,avif}`. Zero-byte files are ignored.
- The `CATEGORIES` and `TAG_VOCAB` tables at the top of the script. Article numbers not in `CATEGORIES` become "Buying Guide".

#### Output

| Path | Content | Behavior |
|------|---------|----------|
| `blog/{slug}/index.php` | Literal HTML, JSON-LD (`BlogPosting`, `FAQPage`, `BreadcrumbList`), rendered by `includes/blog-post.php` | Overwritten |
| `data/blog-index.json` | Listing fields: `slug`, `id`, `title`, `h1`, `meta-desc`, `category`, `published_date`, `thumb_img`, `images`, `image_prefix`, `tags`, `reading_time`, `word_count`, `faq_count`, `source_docx` | Merged by `id`; other posts are kept |
| `sitemap.xml` | A `<url>` for each indexed post not already listed | Only adds, never removes or updates |

The console prints one line per article, with words, reading time, date, image, FAQ, and link counts.

#### Notes

- **10 posts are missing from `sitemap.xml`:** IDs 26, 27, 29, 30, 31, 32, 34, 35, 37, 39. `--sitemap-only --dry-run` reports them as pending. Run `--sitemap-only` to add them.
- Those 10 posts were generated by an external tool, `micro_articulator.py` (`C:\Users\Manager\Documents\Creative Blinds And Drapes Inc\SEO\micro-articulator\`), and not by this script. `--all` leaves them untouched because the index merge keeps other IDs.
- **`--format html` looks broken:** it always writes the PHP template and only changes the filename to `index.html`, so the file holds PHP source.
- Generated pages should not be edited by hand; rebuilding overwrites them.
- The build stops with an error if the body, schema, About block, title, or description contains an em or en dash (`CLAUDE.md` rule).
- If an H1 changes, the slug changes too, and the old `blog/{old-slug}/` folder is not deleted.
- With `--dry-run`, the summary still says "written" and "added". Those are counts of what would happen.

### scrape_shutters.py

#### What it does

Opens each Norman USA shutter page in Chrome, reads the colors, louver sizes, frames, control options, and Design Inspiration images, adds local image paths, and writes a catalog JSON file.

#### How to run

```bash
python scraper/scrape_shutters.py --headless
python scraper/scrape_shutters.py --headless --output scratch/shutters-new.json
```

| Flag | Default | Meaning |
|------|---------|---------|
| `--headless` | off | Hide the browser window |
| `--input PATH` | `scraper/input.json` | Product list |
| `--output PATH` | `data/shutters.json` | Output file |

#### Input

A JSON list. `slug` and `category` are optional.

```json
[{"name": "Brightwood",
  "folder": "assets/products/shutters/Brightwood",
  "manufacturer_url": "https://normanusa.com/product/brightwood-shutters/"}]
```

It also reads the image filenames in each `folder`, and the live normanusa.com pages.

#### Output

A JSON array with `name`, `slug`, `category`, `description`, `images`, `colors`, `louver_sizes`, `frames`, `control_options`, `design_inspiration`, `features`, `manufacturer_url`. A product that fails still gets a record with empty fields.

#### Notes

- **Overwrite warning:** the default run replaces `data/shutters.json`, and always writes `description` and `features` as empty. The current file has hand-written values in those fields and hand-edited names (such as "Brightwood Shutter"). Use `--output` and merge the result by hand.
- `scraper/blinds_input.json` and `scraper/shades_input.json` have no default user here. Passing one with `--input` still scrapes the shutter headings and, unless `--output` is set, overwrites `data/shutters.json`.
- `data/blinds.json` and `data/shades.json` use different fields from this script's output. TODO: confirm how they were produced.
- The scrape relies on the manufacturer's page headings. A missing section logs a warning and returns an empty list.

## Images

### lcp_photo.py

#### What it does

Creates a small mobile WebP of each image given, to improve Largest Contentful Paint on hero images.

#### How to run

```bash
python lcp_photo.py assets/images/carousel/photo1.jpg assets/images/carousel/photo2.jpg
```

Takes one or more image paths. There are no flags.

#### Input

Any image file Pillow can open.

#### Output

`<stem>_m.webp` next to each source: fits within 768 x 600 px without upscaling, WebP quality 78. The console shows before and after sizes.

#### Notes

- Existing `_m.webp` files are overwritten without asking.
- The exit code is the number of files that failed, and is 1 for missing arguments.
- A source under 1 KB is reported as an error after the output is written, because the savings calculation divides by zero.

### photo_util.py

#### What it does

Creates a `_thumb.webp` thumbnail from the first image of each product in seven product categories.

#### How to run

```bash
python photo_util.py          # skip existing thumbnails
python photo_util.py --force  # overwrite them
```

#### Input

Intended input is `assets/images/products/<category>/` for `centerpiece_roman`, `honeycomb`, `horizontal_blinds`, `perfect_sheer`, `shutters`, `soluna_roller`, and `vertical_blinds`. Each subfolder counts as one product. With no subfolders, the category folder counts as one. Only the alphabetically first `.jpg`, `.jpeg`, `.png`, or `.webp` is used.

#### Output

`<stem>_thumb.webp` beside the source: 400 px tall, WebP quality 85.

#### Notes

- **Broken:** `assets/images/products/` no longer exists, so the script exits with `ERROR: directory not found`. Images moved to `assets/products/`, where all seven categories exist. Fix by updating `base` in `main()`.
- It needs Python 3.10+ because of the `Path | None` annotation.

## Testing

### test-local.ps1

#### What it does

Fast HTTP smoke test: core pages load, legacy URLs return 301, and canonical tags, asset paths, active nav, and the thank-you noindex tag are correct. It also checks that the contact endpoint responds.

#### How to run

```bash
powershell -ExecutionPolicy Bypass -File test-local.ps1
powershell -ExecutionPolicy Bypass -File test-local.ps1 -BaseUrl https://creativeblindsdrapes.com
```

| Parameter | Default | Meaning |
|-----------|---------|---------|
| `-BaseUrl` | `http://localhost/creativeblindsdrapes` | Site root, no trailing slash needed |

#### Input

HTTP responses from the target site. Paths and expected values are hard-coded in the script.

#### Output

`[PASS]` or `[FAIL]` lines and a total on the console. Exit code 0 if all pass, otherwise 1. No files are written.

#### Notes

- Sends GET requests only, so it does not submit forms.
- It passed 37/37 against local WAMP on 2026-10-30.
- It does not cover the blog, service-area, or guideline pages.

### test_prod_web.py

#### What it does

Drives real Chrome against the live site. Checks page status over HTTPS, canonical redirects, one H1, meta description up to 155 characters, title up to 60 characters before the ` | ` suffix, self-canonical tags, internal links, `robots.txt`, `sitemap.xml`, and a real 404.

#### How to run

```bash
python seo/test_prod_web.py
python seo/test_prod_web.py --skip-links --json seo/prod_test_results.json
```

| Flag | Default | Meaning |
|------|---------|---------|
| `--base-url URL` | `https://creativeblindsdrapes.com` | Target site |
| `--headed` | off (headless) | Show the browser |
| `--include-planned` | off | Also probe `PLANNED_PATHS` (never fails the run) |
| `--skip-links` | off | Skip the slower link crawl |
| `--timeout N` | 20 | Page load timeout in seconds |
| `--json PATH` | none | Save full results as JSON |

#### Input

`DEPLOYED_PATHS` and `PLANNED_PATHS` in the script, plus the live site. Chrome's performance log provides real status codes.

#### Output

`PASS`, `FAIL`, or `INFO` rows and `RESULT: PASS|FAIL`. Exit code 0 means no hard failures, otherwise 1. A JSON file is written only with `--json`.

#### Notes

- **The inventory is out of date:** blog posts are not in `DEPLOYED_PATHS`, and `/blog/` is still in `PLANNED_PATHS`, so the blog is not tested by default. Move each page across as it ships.
- `seo/first-run-result.txt`, `second-`, `third-`, and `forth-run-result.txt` are saved console output from July 2026. The newest shows 0 hard failures, with 33 deployed paths at that time.
- Redirect checks accept 301, 302, 307, or 308, because Chrome reports a 307 for HSTS upgrades.
- Runbook: `docs/test_prod_web.md`. Its "Phase 3-6 not built" text is out of date; the code treats Phase 3 and 4a pages as deployed.

### test_sitemap.py

#### What it does

Requests every URL in the local and live sitemaps, reports what differs between them, and gives a deploy verdict. It needs no browser.

#### How to run

```bash
python seo/test_sitemap.py
python seo/test_sitemap.py --insecure --json seo/sitemap_test_results.json
```

| Flag | Default | Meaning |
|------|---------|---------|
| `--base-url URL` | `https://creativeblindsdrapes.com` | Target site |
| `--local-sitemap PATH` | `sitemap.xml` in the repo root | Local sitemap |
| `--timeout N` | 20 | Request timeout in seconds |
| `--insecure` | off | Skip TLS verification, only if the local trust store cannot build the chain |
| `--json PATH` | none | Save full results as JSON |

#### Input

Local `sitemap.xml`, `<base-url>/sitemap.xml`, each listed URL, and the path lists in `seo/test_prod_web.py` (parsed, not imported).

#### Output

Status rows, differences, a verdict (`DEPLOY REQUIRED`, `OUT OF SYNC`, or `IN SYNC`), and `RESULT`. Exit code 0 means all URLs return 200 and the sitemaps match. 1 means failures or a mismatch. 2 means a sitemap could not be read. A JSON file is written only with `--json`.

#### Notes

- It cannot detect pages missing from both sitemaps, such as the 10 posts listed under [build-blog.py](#build-blogpy).
- Differences against the `test_prod_web.py` inventory are reported but never fail the run.

### TestForms.ipynb

#### What it does

Selenium notebook that fills and submits the compact, contact, FAQ, and newsletter forms on creativefloors.co, then waits for the thank-you redirect. It tests a different site from this repo.

#### How to run

```bash
jupyter notebook form-test/TestForms.ipynb
```

Run the cells in order. Cell 1 installs `webdriver_manager` with pip.

#### Input

`BASE_URL`, `THANK_YOU_PATH`, `WAIT_TIMEOUT`, and hard-coded test values in the cells, plus the live forms at `http://creativefloors.co/m`.

#### Output

`PASSED` or error output in the notebook. Saved screenshots in `form-test/` (`compact_form_error.png`, `contact_form_error.png`, `faq_form_error.png`) are from earlier runs.

#### Notes

- **Broken:** its notes require `X-Test-Mode` routing, but `create_driver()` never injects that header despite its docstring. `C:/wamp64/www/m/data/config/test-config.php` does not exist, and `send-email.php` has no test-mode code.
- **Side effect:** without that routing, assume each run sends test submissions through the real form path. TODO: confirm where they are delivered.
- `form-test/testing_forms.md` is a plan for this other site, and its `form_tester.py` suite does not exist here.

### WEB_FORMS_COLLECTION.json

#### What it does

Postman collection for the separate Lead Tracking System API: login, health, public form submissions, and authenticated submission lists.

#### How to run

In Postman, choose **Import**, select `form-test/WEB_FORMS_COLLECTION.json`, set the collection variables, then run **Login** first. It sets the HttpOnly cookie used by the authenticated requests.

| Variable | Example |
|----------|---------|
| `base_url` | `https://<lead-tracking-host>/api/v1` |
| `username` | `<LEAD_TRACKING_USERNAME>` |
| `password` | `<LEAD_TRACKING_PASSWORD>` |

The "Get by ID" requests also need `test_question_id`, `test_newsletter_id`, or `test_web_lead_id`, which the collection does not define.

#### Input

Collection variables and the JSON request bodies. For example, Submit Question sends `question`, `zip`, `email`, and `data_consent`.

#### Output

Postman responses and test results. Writes no local files.

#### Notes

- **Security:** the `username` and `password` variables hold real-looking values in plain text, in a file tracked by Git. Rotate that password and replace the values with placeholders.
- **Side effect:** the Submit requests create records on the configured server, which is a live host by default. The collection description says the default is `localhost:8000`, which does not match its `base_url`.
- TODO: confirm whether this belongs in this repo. Nothing on this site calls this API.

## Search engine notification

Detailed server steps are in [`data/config/index/README.md`](data/config/index/README.md).

Both scripts are intended to run on the production server over SSH (PuTTY), after uploading changes with FileZilla. They share `data/config/index/indexnow_lib.php`, which holds `INDEXNOW_HOST`, `INDEXNOW_KEY`, `INDEXNOW_KEY_URL`, `INDEXNOW_ENDPOINT`, and the `indexnow_submit()` function. Edit configuration only there. The library is not run directly.

The public key file `https://creativeblindsdrapes.com/<INDEXNOW_KEY>.txt` is on the live server but is not in this repo.

### indexnow_test.php

#### What it does

One-shot check that the public key file holds the exact key, followed by one real IndexNow submission of the site homepage. Run it first when setting up.

#### How to run

```bash
php data/config/index/indexnow_test.php
```

There are no arguments.

#### Input

The constants in `indexnow_lib.php` and the public key file.

#### Output

Console messages and the IndexNow status with its meaning: 200 or 202 succeeded, 403 is a bad key, 422 is a host or scope mismatch, 429 is too many requests. It POSTs to `https://api.indexnow.org/IndexNow` and writes no files.

#### Notes

- It exits with 1 only when the key check fails. A rejected submission still exits with 0, so read the message.

### indexnow_sync.php

#### What it does

Compares the live sitemap with the last saved baseline and submits only new URLs and URLs with a changed `<lastmod>`. It can also submit a hand-picked list.

#### How to run

```bash
php data/config/index/indexnow_sync.php --dry-run
php data/config/index/indexnow_sync.php
php data/config/index/indexnow_sync.php --urls
```

| Flag | Meaning |
|------|---------|
| none | Normal sync |
| `--dry-run` | Show what would be sent; send and save nothing |
| `--seed` | Submit every sitemap URL (use sparingly) |
| `--urls` | Submit `data/config/index/urls_2_submit.txt` |
| `--urls=FILE` | Submit a different list |

#### Input

- `https://creativeblindsdrapes.com/sitemap.xml` (the live file, set by `SITEMAP_URL`).
- The baseline at `$HOME/.indexnow_state_creativeblindsdrapes.json`, or beside the script if `HOME` is unset.
- For `--urls`: one URL per line, with blank lines and `#` comments ignored.

Suggested example for a daily cron job, carried over from the IndexNow README, with the path adjusted to the host:

```bash
0 6 * * * php /home/USER/public_html/data/config/index/indexnow_sync.php >> /home/USER/indexnow.log 2>&1
```

#### Output

- A POST to IndexNow for in-scope URLs, and console status.
- The state file is overwritten only after a 200 or 202. `--urls` never changes it.
- The first run saves a baseline and submits nothing, unless `--seed` is used.

#### Notes

- Sitemap changes must reach production first, or the sync will not see them. It reads the live sitemap, so the 10 posts missing from the sitemap are not notified.
- Rejected submissions exit with 0; read the console message.
- Each machine keeps its own baseline, so a run from a different machine starts with a new one.
- Only submit pages that benefit from a crawl nudge, such as "Discovered - currently not indexed" in Search Console, not "Crawled - currently not indexed" or "Duplicate".
- **Exposure to check:** `data/config/index/` has no `.htaccess` deny rule, and these scripts do not check for CLI use. `robots.txt` only asks crawlers to stay out, so a browser request could likely run them. This was not tested, to avoid sending a real submission.
- There is no local run log. A cron setup would write to the log path you choose.

## Contact form

### process-contact.php

#### What it does

The server endpoint behind the quote forms. It validates a submission, verifies reCAPTCHA v3, screens out spam and out-of-area requests, emails qualifying leads to the business, and logs each step.

#### How to run

Apache calls it when a visitor submits `includes/compact-form.php` or `contact/index.php`. It is not a command-line tool.

```bash
curl http://localhost/creativeblindsdrapes/data/config/process-contact.php
# {"success":false,"message":"Invalid request method"}
```

Prerequisites: `includes/config.php`, PHP `mail()`, outbound access to Google reCAPTCHA, and write access to `data/config/logs/`. Configure `RECAPTCHA_SECRET_KEY`, `RECAPTCHA_MIN_SCORE` (0.7), `RECAPTCHA_ALLOWED_HOSTS`, and `RECAPTCHA_ALLOWED_ACTIONS` at the top of the file, and `BUSINESS_EMAIL` in `includes/config.php`.

#### Input

POST fields:

| Field | Required | Notes |
|-------|----------|-------|
| `name`, `email`, `phone`, `service` | Yes | Email format is checked |
| `consent` | Yes | Must be present |
| `recaptcha_token` | Yes | Action must be `compact_quote` or `submit` |
| `zip` | Yes | 5 digits, or ZIP+4 reduced to 5 digits; accepted range is 60001-60900 |
| `address`, `rooms`, `message` | No | Included in the email |
| `middleName` | Must be empty | Honeypot |

#### Output

- JSON: `{"success": true|false, "message": "..."}`. Silent rejections return the same success response as a real lead.
- An HTML email to `BUSINESS_EMAIL` from `mail()`.
- JSON lines appended to `data/config/logs/form_submissions.log`, with fields `time`, `event`, `ip`, `user_agent`, `referrer`, `payload`.
- Log events: `request_received`, `recaptcha_missing`, `recaptcha_api_error`, `recaptcha_rejected`, `recaptcha_context_mismatch`, `honeypot_tripped`, `zip_invalid`, `zip_out_of_range`, `mail_sent`, `mail_failed`.
- Session value `cbd_lead`, read and cleared by `thank-you/index.php`. Its email is stored only for a qualified lead, which is the GTM signal.

#### Notes

- **Secret in code:** `RECAPTCHA_SECRET_KEY` is hard-coded in this tracked file. Move it to server configuration and rotate it.
- **Visitor data in Git:** `data/config/logs/form_submissions.log` holds names, emails, phones, and IPs, and is still tracked despite `.gitignore`. The latest commit (`36affe7`) changed it. Remove it from tracking with `git rm --cached`, and consider purging it from history.
- `CLAUDE.md` says the score threshold is 0.5; the code uses 0.7.
