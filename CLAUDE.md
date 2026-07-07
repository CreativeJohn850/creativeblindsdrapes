# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

**Creative Blinds & Drapes**: a local window treatment business website (Aurora, IL). Served via WAMP64 (Windows Apache MySQL PHP) with no build step required.

## Typography: NO Em or En Dashes (STRICT)

Never output an em dash or an en dash anywhere in this project: not in page copy, code
comments, docs, config, commit messages, or any committed string. This is a hard rule with no
exceptions.

Forbidden in every form:
- Literal characters: em dash (U+2014) and en dash (U+2013)
- HTML entities: `&mdash;` and `&ndash;`
- Numeric/hex entities: `&#8212;`, `&#8211;`, `&#x2014;`, `&#x2013;`

Use instead:
- Label then explanation: a colon (`Blackout: blocks light`)
- A parenthetical aside: paired commas, or parentheses
- Two independent clauses: split into two sentences with a period, or a semicolon
- A numeric range: a plain hyphen (`4-6 weeks`, `60001-60900`)
- Compound words: keep the normal hyphen (`custom-made`)

Before committing, verify zero matches for every form above. Use codepoint escapes so the
check itself contains no dash characters:
```bash
grep -rnP '\x{2014}|\x{2013}' . --exclude-dir=.git
grep -rn '&mdash;\|&ndash;\|&#821[12];\|&#x201[34];' . --exclude-dir=.git
```

## Development Setup

- **Runtime**: PHP 7+ on Apache (WAMP64); no Node.js, no Composer
- **Local URL**: typically `http://localhost/creativeblindsdrapes/`
- **No build tools**: no npm, no webpack, no SASS compilation, all files are served as-is
- **Deployment**: direct file copy to Apache `www/` directory

## Architecture

### Template System
PHP procedural includes pattern, every page follows this structure:
```php
<?php
$page_title = '...';
$meta_description = '...';
require_once 'includes/header.php';  // outputs <head> (canonical, OG, Twitter, schema), nav, GTM
// ... page-specific HTML ...
require_once 'includes/footer.php';  // outputs footer, closes </html>, loads script.js
```

`includes/config.php` defines business constants (`SITE_NAME`, `BUSINESS_PHONE`, `BUSINESS_EMAIL`, `SITE_URL`, etc.) used across all pages. `SITE_URL` is `https://creativeblindsdrapes.com`.

`includes/header.php` builds the canonical URL from `SITE_URL` + current filename, and outputs: canonical tag, Open Graph tags, Twitter Card tags, LocalBusiness JSON-LD schema, and optional per-page schema via `$page_schema_json`.

### Product Catalogs
Products are stored as JSON in `data/`:
- `data/fonluk.json`: 70 drapery products (Adeko brand)
- `data/tuller.json`: 57 sheer curtain products
- `data/rods.json` / `data/tracks.json`: hardware products

Product pages load JSON with `file_get_contents()` + `json_decode()` and render cards inline:
- `curtains.php`: drapes/curtains (fonluk + tuller)
- `blinds.php`: blinds products
- `shutters.php`: shutters products
- `shades.php`: shades products
- `curtain-hardware.php`: rods and tracks

Product assets live under `assets/products/{fonluk,tuller}/{images,pdfs,thumbnails}/`.

### Contact Form
`data/config/process-contact.php` handles form submissions:
- Validates and sanitizes input fields (including ZIP range check for Aurora service area)
- Verifies reCAPTCHA v3 token (score threshold 0.5)
- Sends HTML email via PHP `mail()`
- Logs all submissions (including rejections) to `data/config/logs/form_submissions.log`
- Returns JSON response

`includes/compact-form.php` is a compact quote form rendered as a static section directly below the hero/page-header, and each page includes it explicitly after its hero section (all public pages except `contact.php` and `thank-you.php`). Backed by the same `process-contact.php` endpoint.

### Apache / URL Handling
Root `.htaccess` handles:
- 301 redirect: `www.creativeblindsdrapes.com` → `creativeblindsdrapes.com` (canonical non-www)
- 301 redirect: HTTP → HTTPS (live domain only, localhost is excluded)

`data/logs/.htaccess` and `data/config/logs/.htaccess` deny all public access to log directories.

### CSS Architecture
Single stylesheet `css/style.css`. CSS variables defined in `:root`:
- Colors: `--primary-teal: #7abd3c`, `--primary-teal-dark: #289C3F`, `--warm-cream`, `--warm-beige`
- Fonts: `--font-primary` (Montserrat), `--font-headings` (Playfair Display)
- Breakpoints: 992px, 768px, 480px

### JavaScript
Single file `assets/js/script.js` (~265 lines, vanilla ES6+):
- Mobile nav menu toggle (creates overlay dynamically, manages body scroll lock)
- Compact quote form (live ZIP hint, form submit with reCAPTCHA v3)
- Hero image slider (auto-rotates every 5s, dot navigation; exits early if ≤1 slide present)

### SEO / Discoverability
- `robots.txt`: allows all, disallows `/data/` and PDF directories, references sitemap
- `sitemap.xml`: lists all public pages with `lastmod` and `priority`
- Schema.org: LocalBusiness JSON-LD on every page; product/service schemas on product pages

## Known Issues / Technical Debt
- **reCAPTCHA secret key hardcoded** in `data/config/process-contact.php` line 9: should move to a server environment variable or `.env` file excluded from version control
- **Product images not lazy-loaded**: `<img>` tags in `curtains.php`, `blinds.php`, `shutters.php`, `shades.php` are missing `loading="lazy"`
- **Social media links are placeholder `#`**: `FACEBOOK_URL` and `INSTAGRAM_URL` in `includes/config.php` need real URLs once accounts are active
- **No security headers in `.htaccess`**: `X-Frame-Options`, `X-Content-Type-Options`, `Referrer-Policy` etc. not yet set
