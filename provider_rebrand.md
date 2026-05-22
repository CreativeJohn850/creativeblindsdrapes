# Provider Branding Recommendations
## Adeko & Norman — Creative Blinds & Drapes

---

## Strategic Principle

Adeko is unknown to US consumers. Describing *qualities* (Turkish craftsmanship, premium fabric, European manufacturing) converts better than the brand name alone. One mention per page in body text is sufficient to establish provenance. Reserve heading/card positions for your own trust signals: 23-year parent company (Creative Floors Inc.), local service, free consultation.

If Norman products are added: Norman is a recognized US brand. It can be featured more prominently — a co-branding section with their logo would be appropriate.

---

## Priority Fixes

### 1. Remove the outbound link to adekodesign.com — HIGHEST PRIORITY
**File:** `about.php:36`  
**Problem:** Dofollow link sends users to the manufacturer's website where they may find other US dealers.  
**Fix:** Remove the `<a href="...">` wrapper entirely, or add `rel="nofollow noopener"` if the link must stay.

```php
// Before
<a href="https://www.adekodesign.com//" target="_blank">Adeko</a>

// After (link removed, brand mention kept)
Adeko
```

---

### 2. Rewrite duplicate feature card headings
**Files:** `index.php:70` and `about.php:70` (identical on both pages)  
**Problem:** "Quality Adeko Products" puts the supplier's name in a trust/differentiator heading. Unknown brand = no trust signal. Also creates thin duplicate content across two pages.  
**Fix:** Use descriptive language.

```html
<!-- Before -->
<h3>Quality Adeko Products</h3>
<p>Featuring premium window treatments from Adeko, Turkey's leading manufacturer known for exceptional craftsmanship.</p>

<!-- After -->
<h3>Premium Turkish Fabrics</h3>
<p>Our window treatments are sourced from Turkey's leading manufacturer, known for exceptional fabric quality, precise construction, and extensive design variety.</p>
```

---

### 3. Update meta descriptions — 4 pages
**Problem:** Meta descriptions lead with "Adeko" — a brand unknown to US consumers — wasting the snippet space that drives click-through rate.

| File | Current | Suggested revision |
|------|---------|-------------------|
| `index.php:4` | "...Featuring quality Adeko products." | Remove; end with "Free consultation!" (already present) |
| `about.php:4` | "Premium Adeko window treatments, expert..." | → "Premium window treatments, expert in-home consultation and installation." |
| `drapes-curtains.php:5` | "Browse our premium Adeko draperies." | → "Browse 70+ premium Turkish drapery fabrics. Custom draperies in Aurora, IL." |
| `sheer-curtains.php:5` | "Browse our premium Adeko sheer curtain collections." | → "Browse 50+ premium sheer curtain fabrics. Custom sheers in Aurora, IL." |

---

### 4. Block PDF indexing
**Problem:** Adeko-branded spec PDFs (127+ files across fonluk and tuller) can appear in Google search independently, bypassing your product pages and showing only Adeko branding — sending potential customers to the manufacturer.

**Option A — robots.txt (recommended):**
```
User-agent: *
Disallow: /assets/products/fonluk/pdfs/
Disallow: /assets/products/tuller/pdfs/
```

**Option B — .htaccess (if granular control is needed):**
```apache
<FilesMatch "\.pdf$">
    Header set X-Robots-Tag "noindex, nofollow"
</FilesMatch>
```

The `download` attribute already on PDF links (good) prompts a save rather than browser navigation, reducing the chance of a PDF URL being shared as a standalone link.

---

## What to Keep (Do Not Change)

| Instance | File | Reason |
|----------|------|--------|
| JSON-LD brand fields | `drapes-curtains.php:24`, `sheer-curtains.php:24` | Correct structured data; helps Google categorize products for rich results |
| JSON-LD ItemList names | `drapes-curtains.php:32`, `sheer-curtains.php:32` | Structured data accuracy |
| Page header subtitles | `drapes-curtains.php:62`, `sheer-curtains.php:62` | On product pages, users expect to know what they're browsing — appropriate context |
| Body text mention | `index.php:41`, `about.php:36` (text only, no link) | Single contextual mention is appropriate and honest |

---

## Full Instance Audit

| # | File:Line | Visible to User | Impact | Notes |
|---|-----------|-----------------|--------|-------|
| 1 | `index.php:4` | Meta snippet | Negative | Wastes meta real estate on unknown brand |
| 2 | `index.php:12` | No (filename) | Neutral | Internal file reference only |
| 3 | `index.php:41` | Yes (body) | Neutral | Appropriate single mention |
| 4 | `index.php:70` | Yes (h3 heading) | Negative | Supplier gets credit instead of your business |
| 5 | `index.php:71` | Yes (body) | Negative | Redundant within same card |
| 6 | `about.php:4` | Meta snippet | Negative | Same issue as #1 |
| 7 | `about.php:36` | Yes (hyperlink) | Negative | Sends users to manufacturer — highest risk |
| 8 | `about.php:70` | Yes (h3 heading) | Negative | Exact duplicate of index.php:70 |
| 9 | `about.php:71` | Yes (body) | Negative | Exact duplicate of index.php:71 |
| 10 | `drapes-curtains.php:5` | Meta snippet | Negative | Replace with product count + origin |
| 11 | `drapes-curtains.php:24` | No (JSON-LD) | Positive | Correct brand schema markup |
| 12 | `drapes-curtains.php:32` | No (JSON-LD) | Positive | Structured data accuracy |
| 13 | `drapes-curtains.php:62` | Yes (page header) | Neutral | Product page context — appropriate |
| 14 | `sheer-curtains.php:5` | Meta snippet | Negative | Replace with product count + origin |
| 15 | `sheer-curtains.php:24` | No (JSON-LD) | Positive | Correct brand schema markup |
| 16 | `sheer-curtains.php:32` | No (JSON-LD) | Positive | Structured data accuracy |
| 17 | `sheer-curtains.php:62` | Yes (page header) | Neutral | Product page context — appropriate |

**Summary:** 4 positive, 4 neutral, 9 negative/suboptimal

---

## Norman (Future Supplier)

Norman is a recognized US brand in the window treatment market (comparable tier to Hunter Douglas). When Norman products are added:
- Feature the brand name prominently — US homeowners recognize it
- A co-branding section with Norman's logo on the relevant product page is appropriate
- Meta descriptions and headings can lead with "Norman" without the same risk as Adeko
- Follow Norman's dealer co-branding guidelines if they provide them
