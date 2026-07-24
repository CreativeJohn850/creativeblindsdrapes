# Wholesale & Ecommerce Hub: Phased SEO Plan

Status: feasibility study (draft). Owner: Creative Blinds & Drapes.
Scope: a B2B "trade" hub at `/wholesale/` plus a transactional ecommerce layer powered by
**Shopify** (catalog, cart, checkout, payment, and B2B trade accounts). This document
follows the site's existing hub-and-spoke SEO conventions
(see `CLAUDE.md`, `seo/complete_structure.md`, and the Phase 2 spoke infrastructure).

Typography note: this file obeys the project rule of no em or en dashes anywhere.

---

## 0. Guiding constraints (read first)

**Technical constraints that shape every phase:**
- PHP 7+ on Apache (WAMP64). No Node, no npm, no Composer, no build step.
- Products already exist as JSON in `data/` (fonluk.json 70 items, tuller.json 57 items,
  rods.json, tracks.json). A wholesale catalog can reuse this data layer, not a new one.
- Pages are rendered with procedural includes. Reuse `includes/spoke-page.php`,
  `includes/spoke-schema.php`, `includes/faq-section.php`, `includes/breadcrumbs.php`.
- Contact/quote flow already runs through `data/config/process-contact.php` with
  reCAPTCHA v3 + honeypot. A trade signup and a quote request can still extend this for
  non-transactional leads.
- **Commerce engine: Shopify.** All transactional ecommerce (product catalog, cart,
  checkout, payment, tax, and trade/B2B accounts) is handled by Shopify, not by the WAMP
  stack. The PHP site stays the SEO/marketing surface and links into (or embeds) Shopify.
  This removes PCI scope and cart/build complexity from WAMP. See Phase 4.

**Positioning decision (B2B vs. B2C):**
Creative Blinds & Drapes is a local, install-led, custom window treatment business.
"Wholesale" here means a **trade program** (sell to businesses who resell or specify).
Two product realities coexist:
- **Configurable / made-to-measure** items (custom shades, shutters, drapery) do not fit a
  fixed add-to-cart price; these stay quote-led, or use Shopify variants/product options
  where a finite set of SKUs can be defined.
- **Stock, catalog-priced** items (hardware: rods, tracks; sample kits; fabric by the yard;
  standard-size blinds) are true add-to-cart products and belong in Shopify checkout.
So the ecommerce angle is a **Shopify storefront with B2B trade accounts**, with a quote
path retained for custom work. This is detailed in Phase 4.

**Audience segments (drive the spoke pages):**
1. Interior designers and decorators (the trade)
2. General contractors and remodelers
3. Home builders and developers (new construction, spec homes)
4. Property managers and multifamily / HOA
5. Hospitality, senior living, and commercial (hotels, offices, clinics)
6. Home stagers and real estate professionals
7. Resellers / smaller window treatment retailers (true wholesale of hardware/fabric)

---

## Phase 1: Wholesale hub foundation (the money page)

**Goal:** one authoritative hub that ranks for trade/wholesale intent and converts to a
trade-account application.

**New page:** `/wholesale/index.php` (URL `/wholesale/`)

**Primary keywords (commercial, mid-to-high intent):**
- "wholesale window treatments Aurora IL"
- "trade program window treatments Chicago suburbs"
- "window treatments for interior designers Illinois"
- "bulk blinds and shades for contractors"
- "designer trade discount blinds shades shutters"

**Secondary / supporting keywords:**
- "to the trade window coverings", "contractor window treatment supplier",
  "builder window treatment program", "wholesale drapery hardware", "trade pricing shutters".

**On-page content blocks (mirror the product-hub layout from Phase 2):**
- H1: "Wholesale & Trade Program for Window Treatments" (one H1 only).
- Trust bar (reuse `.trust-bar` / `.trust-chip`): local, custom-made, install network,
  volume pricing, dedicated trade contact.
- "Who the trade program is for" grid: one card per audience segment linking to its
  Phase 2 spoke.
- "How trade pricing works" section: tiered volume language, no published retail prices
  (consistent with the existing pricing-omission decision in the Phase 2 memory).
- "What you get" list: dedicated account manager, samples/memo program, measurement and
  install support, lead times, net terms (if offered), reorder support.
- Comparison table (reuse `.compare-table`): Retail customer vs. Trade account.
- Application CTA: link to Phase 4 trade-account form.
- FAQ block (6 questions via `includes/faq-section.php`): minimums, pricing, terms,
  samples, install, service area.

**Schema (via `includes/spoke-schema.php`):** one `@graph` with `Service`
(serviceType "Wholesale window treatment supply"), `FAQPage`, and `BreadcrumbList`.
Consider `OfferCatalog` referencing the Phase 3 catalog pages.

**Wiring:**
- Add "Wholesale / Trade" to footer (new column or under Products) and, optionally, main nav.
- Add `/wholesale/` to `sitemap.xml` with a fresh `lastmod` and priority ~0.8.
- Pre-load the URL into `data/config/index/urls_2_submit.txt` for IndexNow on deploy.

---

## Phase 2: Audience spoke pages (topical depth)

**Goal:** capture segment-specific intent and funnel to the hub. Each is a spoke of
`/wholesale/`, built with `includes/spoke-page.php` (same pattern as the 14 Phase 2 spokes:
1 H1, meta <=155 chars, ~1000-1175 words, Service+FAQ+Breadcrumb `@graph`).

**Pages (URL: keyword: notes):**

| Page | URL | Primary keyword | Angle |
|------|-----|-----------------|-------|
| For Interior Designers | `/wholesale/interior-designers/` | "window treatments for interior designers" | memo samples, spec support, trade discount, white-glove install |
| For Contractors & Remodelers | `/wholesale/contractors/` | "window treatments for contractors" | job-site measure, scheduling, volume, invoicing |
| For Home Builders | `/wholesale/builders/` | "window treatments for home builders" | spec homes, model homes, per-unit pricing, timelines |
| For Property Managers | `/wholesale/property-managers/` | "bulk blinds for apartments / property managers" | turnkey re-outfitting, durable/cordless (child safety), fast reorder |
| For Hospitality & Commercial | `/wholesale/commercial/` | "commercial window treatments Illinois" | fire-rated / contract-grade fabrics, blackout for hotels, offices |
| For Home Stagers & Realtors | `/wholesale/stagers-realtors/` | "window treatments for home staging" | quick turnaround, budget tiers, curb-appeal |
| Hardware & Fabric Reseller Supply | `/wholesale/reseller-supply/` | "wholesale drapery hardware / curtain track supplier" | true wholesale of rods/tracks/fabric from existing catalogs |

**Content pattern per spoke:**
- H1 tied to the segment; 3-5 `$spoke_sections` (problem, our solution, process, why us).
- Segment-specific FAQ (4-6 Q).
- `$related_links`: back to `/wholesale/`, across to 1-2 sibling spokes, and to the
  relevant product hub (`/window-treatments/window-blinds/` etc.).
- Cross-link forward to Phase 3 catalog and Phase 4 application.

**Schema:** Service + FAQPage + BreadcrumbList per spoke. Add `HowTo` only where a real
process is described (e.g., contractor job-site workflow), reusing `cbd_howto_schema()`.

---

## Phase 3: Wholesale product / catalog pages (transactional depth)

**Goal:** give the hub product-level pages that can rank for "wholesale [product]" and feed
a future quote-cart. Reuse the existing JSON catalogs rather than duplicating data.

**Pages:**
- `/wholesale/catalog/index.php`: overview + `ItemList` schema across categories.
- Category pages (reuse product rendering from existing hubs but in a trade frame):
  - `/wholesale/catalog/blinds-shades/`
  - `/wholesale/catalog/shutters/`
  - `/wholesale/catalog/drapery-fabric/` (fonluk.json)
  - `/wholesale/catalog/sheers/` (tuller.json)
  - `/wholesale/catalog/hardware/` (rods.json + tracks.json) <- strongest true-wholesale fit

**Keywords:** "wholesale roller shades", "bulk faux wood blinds", "contract grade shutters",
"wholesale curtain rods and tracks", "trade drapery fabric supplier".

**Content / technical:**
- Cards render from JSON (same `file_get_contents` + `json_decode` pattern). Add
  `loading="lazy"` on images (closes an open tech-debt item from `CLAUDE.md`).
- Each card shows spec fields useful to trade (widths, material, lead time). CTA depends on
  product type: **stock/catalog-priced** items get a real Shopify "Add to cart" / "Buy"
  (Buy Button or Storefront-API embed, see Phase 4); **configurable/custom** items keep a
  "Request trade pricing" quote CTA.
- Schema: `ItemList` + `Product` per catalog page (mirrors `drapes-curtains.php` /
  `sheer-curtains.php`), plus BreadcrumbList. Emit `Product`/`Offer` schema on the PHP
  catalog page **only for items not served from a Shopify product page**, to avoid
  duplicate/conflicting Product markup with Shopify (see Phase 5).

**Data source (decision):** for Shopify-sold items, **Shopify is the source of truth** for
price, inventory, and variants. Keep the existing JSON as the SEO/catalog display layer and
map each JSON item to a Shopify product/variant ID (add an optional `shopify_id` field to
the JSON records). For quote-only custom items, JSON stays authoritative. Do not fork the
catalog; extend it with optional trade fields (MOQ, case pack, trade tier, `shopify_id`).

---

## Phase 4: Ecommerce via Shopify (cart, checkout, payment, B2B)

**Goal:** stand up the transactional layer on **Shopify**, which owns catalog, cart,
checkout, payment, tax, and trade/B2B accounts. The WAMP/PHP site remains the SEO surface
and links into (or embeds) Shopify. This offloads PCI scope and build complexity from WAMP.

**Integration model (choose one; recommendation follows):**

1. **Buy Button / Storefront API embed (recommended to start).** Shopify products are
   embedded on the existing PHP catalog pages (Phase 3) via the JS Buy SDK or a Storefront
   API call in `script.js`. Cart and checkout redirect to Shopify's hosted, PCI-compliant
   checkout. No build step, no Composer, works on WAMP. Best for keeping SEO authority on
   the main domain while Shopify handles money.
2. **Shopify-hosted store on a subdomain** (e.g. `shop.creativeblindsdrapes.com`).
   Fastest to launch, but splits domain authority and needs canonical/cross-linking care.
   Use if a full Shopify theme is wanted over embeds.
3. **Headless (Hydrogen/Oxygen)** with Storefront API. Most control, but reintroduces a
   build toolchain that this stack deliberately avoids. **Not recommended** here.

**Trade / B2B on Shopify:**
- Use **Shopify B2B** (Plus) for company accounts, per-customer catalogs, and net terms; or,
  on a non-Plus plan, customer tags + a wholesale/discount app (e.g. Wholesale Club) plus a
  locked catalog. Decision depends on plan/budget.
- **Trade-account application** (`/wholesale/apply/`) stays on the PHP site as the indexable
  marketing lander and vetting form (business name, resale cert, EIN, segment). It can
  submit through `process-contact.php` (reCAPTCHA v3, honeypot, logging) for manual review,
  or create a draft Shopify customer via the Admin API once approved.

**Product split:**
- **Stock / catalog-priced** (hardware, sample kits, fabric by the yard, standard blinds):
  real Shopify products with add-to-cart and checkout.
- **Configurable / made-to-measure**: model as Shopify products with variants/line-item
  properties where a finite SKU set exists; otherwise keep the quote path. A deposit or
  "book a measure" product in Shopify can still take payment up front.

**What Shopify removes from the WAMP concern list:** PCI compliance, cart/session, payment
gateway, tax calculation, inventory, and order management. What stays on WAMP: SEO content,
schema, and the embed/link glue.

**Feasibility verdict to record:**
- **Feasible and recommended:** Shopify as commerce engine, embedded on the PHP catalog
  pages (option 1), with B2B trade accounts. Reuses the existing site as the SEO front end.
- Retained quote path for fully custom work; Shopify checkout for stock items.

**SEO notes (important with Shopify):**
- **Avoid duplicate Product schema and duplicate content.** If a product lives on both a
  Shopify page and a PHP catalog page, pick one canonical location per product and
  `rel=canonical` accordingly. Do not emit `Product`/`Offer` JSON-LD on the PHP page for an
  item whose canonical is the Shopify page.
- Buy Button embeds add no crawlable product URLs, so they are the safest for SEO.
- If using a subdomain store, cross-link and set canonicals deliberately; the marketing hub
  and spokes (Phases 1-3) stay on the main domain and pass authority via internal links.
- `noindex` cart/checkout/account/thank-you states; keep marketing landers indexable.

---

## Phase 5: Trust, technical SEO, and internal linking

**Goal:** make the hub credible and crawlable.

- **Trust/authority content:** trade testimonials, a "trade partners" logo strip (once real),
  case studies (a builder project, a designer project). E-E-A-T signals matter for B2B.
- **Schema hardening:** add `Organization` / `LocalBusiness` `makesOffer` pointing to the
  wholesale `OfferCatalog`; keep exactly one `@graph` per page (header emits one
  `$page_schema_json`, per existing convention). **Coordinate with Shopify:** Shopify emits
  its own `Product`/`Offer` schema on its product pages, so do not double-emit Product markup
  for the same item from the PHP side; assign one canonical URL per product (see Phase 4).
- **Internal links:** every product hub and top `/window-treatments/` hub gets a
  contextual "Trade & wholesale pricing" link to `/wholesale/`. Footer link added Phase 1.
- **Sitemap & IndexNow:** all new URLs added to `sitemap.xml`; queued in
  `data/config/index/urls_2_submit.txt`; run `php indexnow_sync.php` on deploy.
- **robots.txt:** confirm `/data/` stays disallowed; add any quote/apply state exclusions.
- **Security headers / lazy-load:** fold in the two open `CLAUDE.md` tech-debt items while
  touching these pages.

---

## Phase 6: Measurement & iteration

- Track trade-account applications and quote-request submissions as primary conversions
  (extend the form logging already in `data/config/logs/`).
- GSC: monitor impressions/clicks for the wholesale keyword set; validate Rich Results for
  Service / FAQPage / BreadcrumbList / ItemList on the new pages.
- Review which audience spokes convert; expand the winners into deeper content
  (guides, per-city trade pages leveraging the `/service-areas/` structure).
- Revisit the Phase 4 payment decision only if trade volume justifies it.

---

## Build order summary

1. **Phase 1** hub `/wholesale/` (foundation + application CTA target).
2. **Phase 2** audience spokes (topical breadth).
3. **Phase 3** wholesale catalog pages (reuse JSON, add lazy-load, map `shopify_id`).
4. **Phase 4** Shopify integration: embed products/cart/checkout, B2B trade accounts.
5. **Phase 5** trust, schema (coordinated with Shopify), linking, sitemap/IndexNow.
6. **Phase 6** measure and iterate.

Dependencies: Phase 1 before all. Phases 2 and 3 can run in parallel after Phase 1.
Phase 4 needs Phase 3 (catalog products to embed/sell) and a Shopify plan chosen (B2B vs.
tags+app). Phases 5-6 are continuous.
