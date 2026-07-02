# Complete Site Structure & Build Plan

**Project:** Creative Blinds & Drapes — creativeblindsdrapes.com (Aurora, IL)
**Purpose:** Single source of truth for building out the remaining site pages, in phases, with per-page specs, SEO requirements, and validation gates.
**Sources reconciled in this document:**
- `seo/site-structure-creative-blinds.pdf` — target information architecture (the URL tree). **Authoritative for URLs.**
- `seo/General SEO Audit - Creative Blinds Drapes.pdf` (06/04/2026) — defects to remediate before scaling content.
- `seo/SEO_Strategy_Action_Plan_Creative_Blinds_Drapes.docx.pdf` (Little Red SEO, June 2026) — content standards, schema, keyword targets, hub-and-spoke model. **Authoritative for SEO/content requirements.**

---

## 0. Reconciliation & Conventions

### 0.1 URL scheme decision
The site has **already migrated** to the nested folder scheme (commit `b785ec8`). We keep it. Where the strategy doc uses flat URLs, map them as below:

| Strategy doc (flat) | This repo (built/canonical) |
|---|---|
| `/drapes/` | `/window-treatments/curtains-and-drapes/` |
| `/blinds/` | `/window-treatments/window-blinds/` |
| `/shades/` | `/window-treatments/shades/` |
| `/about/` | `/about-us/` |
| `/drapes-aurora-il/` (service×city) | folded into `/service-areas/aurora-il/` (one strong page per city, multi-service) |
| `/guides/[topic]/` | `/blog/[topic]/` (content hub) |

**Service×city matrix vs. city hub:** the strategy proposes a service×city matrix (`/drapes-naperville/`, `/blinds-naperville/`…). For a single-location showroom that is thin-content risk and link bloat. **Decision: one authoritative city page per service area** (`/service-areas/{city}-il/`) that targets all service+city keywords for that town. The service×city matrix is deferred (optional Phase 6) — only build a dedicated service×city page if a single city page starts ranking and a specific service term needs its own page.

### 0.2 Shade/blind sub-type placement — DECIDED
The structure PDF diagram nests shade types (honeycomb, roller, roman, sheer) **and** draperies/sheers under `window-blinds/`. That contradicts the **already-built** data model (`data/shades.json` categories `honeycomb|roller|roman|sheer` render as tabs in `/window-treatments/shades/`; `data/blinds.json` categories `horizontal|vertical` render in `/window-treatments/window-blinds/`). Treated as a mind-map drawing artifact. **Confirmed logical placement:**
- Blind types (horizontal, vertical) → `/window-treatments/window-blinds/{type}/`
- Shade types (honeycomb, roller, roman, sheer) → `/window-treatments/shades/{type}/`
- Drapery/sheer → `/window-treatments/curtains-and-drapes/{type}/`

This keeps breadcrumbs and crawl paths coherent (e.g. `Home › Window Treatments › Shades › Roller Shades`, pulling from the shades dataset) instead of the incoherent PDF-literal `…/window-blinds/roller-shades/`.

### 0.2a Hub vs. sub-page relationship — DECIDED
Each hub already renders every sub-type as a **tab**. The new sub-pages do **not** replace those tabs; they are dedicated SEO landing pages. Pattern:
- **Sub-page** = keyword landing page: unique copy, FAQ block, `Service` + `FAQPage` + `BreadcrumbList` schema. It **links into** the hub's filtered product grid ("Browse our roller shade range").
- **Hub** = product catalog: keeps the full `ItemList`/`Product` schema and the tab UI; each tab links **out** to its sub-page ("Learn more about roller shades").
- **Do not duplicate `Product`/`ItemList` markup on the sub-pages** — that lives on the hub only, to avoid duplicate structured data.
- Two-way internal links between hub tab and sub-page.

### 0.3 Page template contract (every new page)
Follow the existing pattern (see `window-treatments/index.php`):

```php
<?php
$page_title       = '...';                 // < 60 chars; " | Creative Blinds & Drapes" is appended by header
$meta_description = '...';                  // 140–155 chars HARD CAP (audit flagged >160)
// optional:
$page_schema_json = json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
$lcp_image        = url('/assets/images/.../hero.webp');     // desktop LCP preload
$lcp_image_mobile = url('/assets/images/.../hero-mobile.webp');
require_once dirname(__DIR__, N) . '/includes/header.php';   // N = folder depth below root
?>
<!-- page sections -->
<?php include ROOT_PATH . '/includes/compact-form.php'; ?>   <!-- quote form, below hero -->
<!-- more sections -->
<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
```

- `dirname(__DIR__, N)`: depth 1 = `/contact/` → `dirname(__DIR__, 1)`; depth 2 = `/window-treatments/shades/` → `dirname(__DIR__, 2)`; depth 3 = `/window-treatments/shades/roller-shades/` → `dirname(__DIR__, 3)`. Header defines `ROOT_PATH`, `BASE_URL`, `url()`.
- **Every internal URL** goes through `url('/path')`. Never hardcode the domain or `/creativeblindsdrapes`.
- `$noindex = true;` before header for any page that must not be indexed (e.g. thank-you).

### 0.4 Global SEO requirements (apply to EVERY page — from audit + strategy)
1. **Exactly one `<h1>`** containing the page's primary keyword (audit: About had 0; some H1s duplicated).
2. **Meta description ≤ 155 chars**, unique (audit: 10 pages were >160).
3. **Title ≤ 60 chars** before the site-name suffix, unique.
4. **Click-to-call**: phone rendered as `tel:` link (already in header) — repeat a prominent CTA in-body.
5. **Compact quote form** included below the hero on every public page (except `contact/` and `thank-you/`).
6. **Schema**: `LocalBusiness` is global (header). Add page-type schema via `$page_schema_json` (Service / FAQPage / ItemList / BreadcrumbList as specified per page).
7. **Internal linking**: each page links to ≥2 related service pages + ≥1 guide, with descriptive anchor text (no "click here").
8. **Images**: WebP, `loading="lazy"` for below-fold, descriptive alt (e.g. `custom drapery installation Aurora IL living room`). Hero preloaded via `$lcp_image*`.
9. **Add the page to `sitemap.xml`** with `lastmod`/`priority`, and trigger IndexNow (`data/config/index/`).
10. **No page over ~100 internal links** (audit ERROR on curtains.php — 142 links).

---

## Phase 1 — Technical Remediation (DO FIRST, no new pages)

> Strategy is explicit: *"No content pages go live until the structural issues identified in the audit are resolved."* Verify each item against current code (the SEO refactor may have already fixed some). Track in this checklist.

| # | Task | Audit/Strategy source | Acceptance test |
|---|---|---|---|
| 1.1 | **About page H1** — add keyword-rich single H1 (e.g. "Custom Window Treatments in Aurora, IL") | Audit VII.g (0 H1) | `about-us/index.php` renders exactly one `<h1>` with primary keyword |
| 1.2 | **Meta descriptions ≤155 chars** on all existing pages (About/Contact were 181) | Audit VII.f | Crawl: 0 descriptions >155 |
| 1.3 | **Orphan pages** — ensure every indexable page is reachable from nav/footer; retire or 301 legacy `*.php` (`drapes-curtains.php`, `sheer-curtains.php`, `curtains.php`, `curtain-hardware.php`, `blinds.php`, `shutters.php`, `shades.php`, `about.php`, `contact.php`) to their new nested URLs | Audit X; Strategy §4 Orphan Resolution | No URL tagged "Orphan page"; old URLs 301 → new |
| 1.4 | **curtains link overload** — replace per-PDF link library (142 links) with a single "View Full Fabric Range" gallery / on-demand render. Target <100 (ideally <80) | Audit V.b; Strategy §4 | Crawl: curtains hub <100 links |
| 1.5 | **Invalid schema (5 blinds items)** — fix Product/Service JSON-LD flagged in GSC (Synchrony Vertical, Ultimate Fauxwood, Normandy Wood, Cordless Faux Wood, Citylights Aluminum) | Audit X.5 | GSC Rich Results: 0 invalid items |
| 1.6 | **Duplicate homepage / www canonical** — confirm non-www canonical + single homepage URL (index.php → `/`) | Audit X.5 | One canonical homepage; www 301 → non-www |
| 1.7 | **Mobile LCP < 2.5s** — hero WebP + preload (`$lcp_image*` already supported), lazy-load below-fold (mobile LCP was 8.2s) | Audit VIII; Strategy §5 | Lighthouse mobile LCP <2.5s |
| 1.8 | **Sitemap reconciliation** — sitemap lists exactly the live, navigable URLs; submit to GSC | Strategy §5 | sitemap.xml == live nav set |
| 1.9 | **Click-to-call visibility** — phone visually prominent (was "almost invisible") | Audit X.1.f | Tap-to-call visible above fold on mobile |

**Phase 1 validation gate (must pass before Phase 2):**
- [ ] Full site crawl (Screaming Frog or equiv.): 0 missing/duplicate H1, 0 meta >155, 0 orphan pages, 0 broken links.
- [ ] GSC Rich Results test on home + each hub: 0 invalid schema items.
- [ ] Lighthouse mobile: Performance ≥ 80, LCP < 2.5s on home + one hub.
- [ ] All legacy `*.php` URLs return 301 to nested equivalents.

### Phase 1 — Implementation status (updated 2026-06-29)
**Code-level items DONE (verified locally: `php -l` clean, metas re-measured, schema JSON validated):**
- ✅ **1.1** About H1 — already a single keyword-rich H1 (no change needed).
- ✅ **1.2** Meta descriptions — trimmed shutters/shades/blinds/curtain-hardware; **all 10 pages now ≤150 chars**.
- ✅ **1.3 / 1.8** Orphan resolution — `curtain-hardware.php` **kept** (has real `tracks.json` content the strategy's `/curtain-hardware/` cluster wants) and linked from the footer Products column; legacy flat `*.php` already 301'd in `.htaccess`. *Interim decision: keep at flat URL; migrate to `/window-treatments/curtain-hardware/` in a later phase.*
- ✅ **1.4** curtains link overload — 127 per-product PDF `<a download>` links converted to JS-driven `.pdf-download` buttons (`window.open`); page drops from ~142 links to ~15.
- ✅ **1.5** invalid schema — all four product hubs (blinds/shades/shutters/curtains) switched from invalid `Product` `ItemList` (missing offers/review/aggregateRating) to valid **`Service`** schema with `provider` → LocalBusiness `@id` and `areaServed` from new **`SERVICE_AREAS`** config constant (reused in Phase 3).
- ✅ **1.6** www/canonical/dup homepage — already correct in `.htaccess` + `header.php` (no change needed).
- ✅ Bonus: footer social links already use real `FACEBOOK_URL`/`INSTAGRAM_URL`.

**Requires the LIVE site / external tools (cannot verify from local dev — hand to site owner / SEO agency):**
- ⏳ **1.5 re-test** — confirm 0 invalid items in **GSC Rich Results / Schema Markup report** after deploy.
- ⏳ **1.7** Mobile LCP <2.5s — code addresses it (hero preload + mobile WebP); confirm via **live Lighthouse**.
- ⏳ **1.9** Click-to-call visibility — `tel:` links present everywhere; the audit's "almost invisible" is a **CSS contrast** check on the header-top bar (visual QA on live).
- ⏳ **1.8 submit** — submit reconciled `sitemap.xml` in **GSC**.

---

## Phase 2 — Product / Service Sub-Pages (14 pages)

Folder: `window-treatments/`. These are **hub-and-spoke spokes** under the existing four hubs, plus a new installer hub. Build hub-by-hub so each batch is independently validatable.

**Per-page spec template for all Phase 2 pages:**
- **Word count:** ≥600 (service sub-page).
- **Sections:** intro (primary keyword in first 100 words) → product/type explainer → benefits → process (consultation → measure → install) → **FAQ block (≥4 Q, FAQPage schema)** → social proof → CTA (form + click-to-call).
- **Schema:** `Service` (name, provider=LocalBusiness `@id`, areaServed = 8 cities, description) **+** `FAQPage` **+** `BreadcrumbList`.
- **Internal links:** up to parent hub, sibling sub-pages, ≥1 relevant guide, ≥1 service-area page.

### 2A. Blinds sub-pages → `window-treatments/window-blinds/`
| URL | File | H1 | Primary keyword |
|---|---|---|---|
| `/window-treatments/window-blinds/horizontal-blinds/` | `window-blinds/horizontal-blinds/index.php` | Horizontal Blinds in Aurora, IL | horizontal blinds Aurora IL |
| `/window-treatments/window-blinds/vertical-blinds/` | `window-blinds/vertical-blinds/index.php` | Vertical Blinds in Aurora, IL | vertical blinds Aurora IL |

### 2B. Shade sub-pages → `window-treatments/shades/`
| URL | File | H1 | Primary keyword |
|---|---|---|---|
| `/window-treatments/shades/honeycomb-shades/` | `shades/honeycomb-shades/index.php` | Honeycomb (Cellular) Shades | honeycomb shades Aurora IL |
| `/window-treatments/shades/roller-shades/` | `shades/roller-shades/index.php` | Roller Shades | roller shades Aurora IL |
| `/window-treatments/shades/roman-shades/` | `shades/roman-shades/index.php` | Roman Shades | roman shades Aurora IL |
| `/window-treatments/shades/sheer-shades/` | `shades/sheer-shades/index.php` | Sheer Shades | sheer shades Aurora IL |

### 2C. Curtains sub-pages → `window-treatments/curtains-and-drapes/`
| URL | File | H1 | Primary keyword |
|---|---|---|---|
| `/window-treatments/curtains-and-drapes/draperies/` | `curtains-and-drapes/draperies/index.php` | Custom Draperies | custom draperies Aurora IL |
| `/window-treatments/curtains-and-drapes/sheers/` | `curtains-and-drapes/sheers/index.php` | Sheer Curtains | custom sheer curtains Aurora IL |

> Note: existing curtains hub already renders fonluk (drapery) + tuller (sheer) catalogs. These spokes are the **keyword landing pages** that link into the catalog; avoid duplicating the full product grid on both (canonical the catalog to the hub).

### 2D. Installer hub + service spokes → `window-treatments/window-treatment-installer/`
New hub + 4 spokes. These target **transactional installation** intent ("drapery installation service Aurora").
| URL | File | H1 | Primary keyword |
|---|---|---|---|
| `/window-treatments/window-treatment-installer/` | `window-treatment-installer/index.php` | Window Treatment Installation in Aurora, IL | window treatment installer Aurora IL |
| `…/blind-installer/` | `…/blind-installer/index.php` | Blind Installation | blind installer Aurora IL |
| `…/shutter-installer/` | `…/shutter-installer/index.php` | Shutter Installation | shutter installer Aurora IL |
| `…/shades-installation/` | `…/shades-installation/index.php` | Shade Installation | shade installation Aurora IL |
| `…/drapery-installation/` | `…/drapery-installation/index.php` | Drapery Installation | drapery installation service Aurora IL |

### 2E. Motorized → `window-treatments/motorized-window-treatment/`
| URL | File | H1 | Primary keyword |
|---|---|---|---|
| `/window-treatments/motorized-window-treatment/` | `motorized-window-treatment/index.php` | Motorized Window Treatments | motorized window treatments Aurora IL |

**Also in Phase 2:** add the new spokes to the **`/window-treatments/` hub grid** and to footer link columns; extend `PRIMARY_NAV` only if a dropdown is introduced (otherwise keep top nav at 5 and surface spokes via hub pages + footer to avoid nav bloat).

**Phase 2 validation gate:**
- [ ] Each new page: exactly one H1 w/ primary keyword, title ≤60, meta ≤155, ≥600 words.
- [ ] GSC Rich Results: Service + FAQPage + BreadcrumbList valid on every new page.
- [ ] Every new page reachable in ≤2 clicks from home; appears in sitemap + IndexNow pushed.
- [ ] No hub exceeds 100 internal links after spokes added.
- [ ] Lighthouse mobile ≥80 on a sampled new page.

---

## Phase 3 — Service-Area Pages (9 pages)

Folder: `service-areas/`. **Highest-ROI per strategy §6** (Local Pack). One hub + 8 city pages. These are **spoke pages with ≥900 words** (strategy content standard for service-area pages).

| URL | File | H1 | Primary keyword |
|---|---|---|---|
| `/service-areas/` | `service-areas/index.php` | Window Treatment Service Areas | window treatments Aurora IL service area |
| `/service-areas/aurora-il/` | `service-areas/aurora-il/index.php` | Window Treatments in Aurora, IL | custom drapes Aurora IL |
| `/service-areas/naperville-il/` | `…/naperville-il/index.php` | Window Treatments in Naperville, IL | window treatments Naperville IL |
| `/service-areas/oswego-il/` | `…/oswego-il/index.php` | Window Treatments in Oswego, IL | custom blinds Oswego IL |
| `/service-areas/yorkville-il/` | `…/yorkville-il/index.php` | Window Treatments in Yorkville, IL | window treatments Yorkville IL |
| `/service-areas/batavia-il/` | `…/batavia-il/index.php` | Window Treatments in Batavia, IL | window treatments Batavia IL |
| `/service-areas/geneva-il/` | `…/geneva-il/index.php` | Window Treatments in Geneva, IL | window treatments Geneva IL |
| `/service-areas/st-charles-il/` | `…/st-charles-il/index.php` | Window Treatments in St. Charles, IL | window treatments St Charles IL |
| `/service-areas/plainfield-il/` | `…/plainfield-il/index.php` | Window Treatments in Plainfield, IL | custom drapes Plainfield IL |

**City-page content spec (each, ≥900 words):**
- Localized intro (city name + "near me" intent in first 100 words), distance/relationship to the Aurora showroom.
- Services offered in that city, each linking to the matching product hub (drapes/blinds/shades/shutters).
- **Local trust:** drive time / neighborhoods served, IL contractor license, 23-yr Creative Floors heritage, Adeko exclusive range.
- ≥2 installation photos with city-specific alt text (use generic showroom photos until real local projects exist — **do not fabricate** location claims).
- **FAQ block (≥4 Q)** with city-localized questions.
- **Schema:** `Service` with `areaServed = {City, IL}` **+** `FAQPage` **+** `BreadcrumbList`. (Do **not** mint fake `LocalBusiness` branches per city — one real GBP per strategy §6.)
- CTA: form + click-to-call.

**Anti-doulication rule:** city pages must differ by more than the town name — vary the opening, FAQs, and which services lead. Thin/templated duplicate local pages are a known Google penalty risk.

**Also in Phase 3:** build the **footer "Serving Aurora & Surrounding Communities"** block into **clickable** links to each city page (audit X.3.d: titles were unclickable). Add `/service-areas/` to nav or footer.

**Phase 3 validation gate:**
- [ ] 8 city pages each ≥900 words, unique opening + FAQs (run a duplicate-content check across the 8).
- [ ] Service + FAQPage + BreadcrumbList schema valid in GSC for each.
- [ ] Footer city links resolve (no 404, no placeholder `#`).
- [ ] All 9 added to sitemap + IndexNow.
- [ ] GBP service-area list matches these 8 cities (strategy §6 checklist).

---

## Phase 4 — Content & Trust Pages (3 pages + content engine)

| URL | File | Purpose | Notes |
|---|---|---|---|
| `/gallery/` | `gallery/index.php` | Portfolio / social proof | See `docs/gallery-system-spec.md` for the gallery system. Image-heavy → strict lazy-load + WebP. `ImageGallery` schema. |
| `/guidelines/` | `guidelines/index.php` | Buyer-guide hub (= strategy's `/guides/`) | Hub linking to all educational articles; may double as measuring/measure-windows guidance. |
| `/blog/` | `blog/index.php` | Content hub index | Lists guide articles; each article = its own page under `/blog/{slug}/`. |

**Blog/guide articles (ongoing, 2/month per strategy §8 calendar).** Not one-time; tracked separately. First 12 priority articles (keyword → target hub it links to):
1. Custom drapes vs ready-made → curtains hub
2. How much do custom window treatments cost in Illinois (2026) → curtains hub
3. Sheer vs blackout curtains by room → sheers
4. Faux wood vs real wood blinds (Illinois homes) → blinds hub
5. Roman vs roller shades → shades hub
6. What are Turkish (Adeko) fabrics → (Adeko page, see Phase 5)
7. Honeycomb vs roller shades — energy efficiency → shades hub
8. What happens during a free in-home consultation → home/about
9. How to measure windows for custom curtains → curtains hub
10. Best window treatments for Naperville new-build homes → naperville city page
11. Curtain hardware guide: rods, rings & tracks → curtain-hardware
12. Window treatments for open-plan homes in Aurora → aurora city page

**Article spec:** 1,000–1,400 words, one H1 w/ keyword, H2s with secondary/LSI, `Article` (or `BlogPosting`) schema, ends with CTA to the relevant service page, internal links to ≥2 service pages.

**Phase 4 validation gate:**
- [ ] Gallery: all images WebP + lazy + descriptive alt; passes Lighthouse mobile ≥80 despite image volume.
- [ ] Blog index + each article: Article schema valid, H1 unique, CTA + internal links present.
- [ ] `/guidelines/` and `/blog/` linked from footer; articles linked from their target hubs (two-way).

---

## Phase 5 — Brand / Authority Page (1 page, recommended; not in structure PDF)

| URL | File | Purpose |
|---|---|---|
| `/adeko-fabrics/` (or `/window-treatments/curtains-and-drapes/adeko-fabrics/`) | `…/adeko-fabrics/index.php` | Strategy §4/§7 "Product / brand page" — capture "Adeko curtain fabrics USA" navigational intent; showcases the exclusive 70+ drapery / 50+ sheer range. `Product`/`ItemList` schema sourced from `data/fonluk.json` + `data/tuller.json`. |

Place it under the curtains hub to keep the URL tree coherent; it absorbs the consolidated "full fabric range" gallery referenced in Phase 1.4.

---

## Phase 6 — Service×City Matrix (DEFERRED / optional)

Only if a city page ranks and a specific service term needs its own page (strategy's `/drapes-naperville/` model). Spin up `/service-areas/{city}-il/{service}/` on demand. Do **not** pre-build the full matrix — thin duplicate pages hurt more than they help.

---

## Summary: Pages to Build

| Phase | Group | New pages |
|---|---|---|
| 1 | Technical remediation | 0 (fixes only) |
| 2 | Product/service sub-pages (blinds 2, shades 4, curtains 2, installer 5, motorized 1) | **14** |
| 3 | Service areas (1 hub + 8 cities) | **9** |
| 4 | Gallery + Guidelines + Blog index | **3** |
| **— Core total (matches site-structure PDF)** | | **26** |
| 5 | Adeko brand page (recommended add-on) | +1 |
| 4* | Blog articles (ongoing 2/mo, 12 prioritized) | +12 and counting |
| 6 | Service×city matrix | deferred |

**Core build to satisfy the target structure: 26 pages**, sequenced Phase 1 → 4, each phase gated by validation. Add the Adeko page (+1) and the ongoing blog engine for full strategy alignment.

---

## Cross-Phase Definition of Done (every page)
1. One H1 with primary keyword; title ≤60; meta ≤155; all unique.
2. Correct `dirname(__DIR__, N)` header include; footer + compact-form included (non-contact pages).
3. All internal URLs via `url()`; no hardcoded domain.
4. Required schema valid in GSC Rich Results (no invalid items).
5. ≥ required word count; ≥4-question FAQ block where specified.
6. Images WebP + lazy + descriptive alt; hero preloaded.
7. Internal links: ≥2 service pages + ≥1 guide, descriptive anchors; page <100 total links.
8. Added to `sitemap.xml`; IndexNow push fired.
9. Reachable in ≤2 clicks from home; no orphan.
10. Lighthouse mobile: Performance ≥80, LCP <2.5s.
