# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

**Creative Blinds & Drapes** — a local window treatment business website (Aurora, IL). Served via WAMP64 (Windows Apache MySQL PHP) with no build step required.

## Development Setup

- **Runtime**: PHP 7+ on Apache (WAMP64); no Node.js, no Composer
- **Local URL**: typically `http://localhost/creativeblindsdrapes/`
- **No build tools**: no npm, no webpack, no SASS compilation — all files are served as-is
- **Deployment**: direct file copy to Apache `www/` directory

## Architecture

### Template System
PHP procedural includes pattern — every page follows this structure:
```php
<?php
define('PAGE_TITLE', '...');
define('PAGE_DESCRIPTION', '...');
include 'includes/header.php';  // outputs <head>, nav, GA4
// ... page-specific HTML ...
include 'includes/footer.php';  // outputs footer, closes </html>, loads script.js
```

`includes/config.php` defines business constants (`SITE_NAME`, `BUSINESS_PHONE`, `BUSINESS_EMAIL`, etc.) used across all pages.

### Product Catalogs
Products are stored as JSON in `data/`:
- `data/fonluk.json` — 70 drapery products (Adeko brand)
- `data/tuller.json` — 57 sheer curtain products
- `data/rods.json` / `data/tracks.json` — hardware products

Product pages (`drapes-curtains.php`, `sheer-curtains.php`) load these with `file_get_contents()` + `json_decode()` and render cards inline. Product assets live under `assets/products/{fonluk,tuller}/{images,pdfs,thumbnails}/`.

### Contact Form
`data/config/process-contact.php` handles form submissions:
- Validates and sanitizes input fields
- Verifies reCAPTCHA v3 token
- Sends HTML email via PHP `mail()`
- Returns JSON response

**Note**: The reCAPTCHA secret key is currently hardcoded in this file — it should be moved to an environment variable or server config before production deployment.

### CSS Architecture
Single stylesheet `css/style.css` (~938 lines). CSS variables defined in `:root`:
- Colors: `--primary-teal: #7abd3c`, `--primary-teal-dark: #289C3F`, `--warm-cream`, `--warm-beige`
- Fonts: `--font-primary` (Montserrat), `--font-headings` (Playfair Display)
- Breakpoints: 992px, 768px, 480px

### JavaScript
Single file `assets/js/script.js` (~91 lines, vanilla ES6+):
- Mobile nav menu toggle (creates overlay dynamically, manages body scroll lock)
- Hero image slider (auto-rotates every 5s, dot navigation)

## Known Issues / Technical Debt
Detailed notes are in `dev_story.md`. Key items:
- reCAPTCHA secret key hardcoded in `data/config/process-contact.php`
- No `robots.txt`, `sitemap.xml`, or structured data (schema.org) markup
- Product images not lazy-loaded
- No `.htaccess` for URL rewriting or security headers
- Social media links in `includes/config.php` are placeholder `#` values
