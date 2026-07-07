# Gallery System Spec

Implementation guide to replicate the portfolio gallery used in `pages/projects.php` + `pages/project.php`.

---

## Overview

Two-page pattern:

1. **Listing page**: grid of project cards with category filter tabs and pagination.
2. **Detail page**: full-screen lightbox gallery for a single project's images.

---

## Libraries

| Library | Version | CDN |
|---|---|---|
| GLightbox (CSS) | 3.3.0 | `https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/css/glightbox.min.css` |
| GLightbox (JS) | 3.3.0 | `https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/js/glightbox.min.js` |
| Bootstrap 5 | existing | already loaded via `header.php` |

GLightbox handles: click-to-open, touch swipe, keyboard nav, loop, close-on-outside-click, and video support (MP4 thumbnails).

---

## Data Structure

Each item in the JSON collection needs these fields:

```json
{
  "id": 101,
  "title": "...",
  "sub-title": "...",
  "category": "CategoryName",
  "excerpt": "Short description for the card",
  "description": "Full description shown on the detail page",
  "slug": "unique-url-slug",
  "complete_date": "2024-02-15",
  "images": [
    "thumb-image.webp",
    "gallery-image-001.webp",
    "gallery-image-002.webp"
  ],
  "alt-text": [
    "Alt text for image 001",
    "Alt text for image 002"
  ]
}
```

**Convention:** `images[0]` is the thumbnail shown on the listing card. `images[1..n]` are shown in the lightbox gallery on the detail page. `alt-text` maps to gallery images starting at index 0 (aligns with `images[1]`).

The category filter uses a numeric ID derived from `floor(id / 100) * 100`, so IDs 101-199 all belong to category `100`. Define your own ID ranges per category.

---

## Listing Page (`pages/projects.php` pattern)

### PHP Setup

```php
<?php
$categories = [
    "all" => "All",
    "100" => "Category A",
    "200" => "Category B",
    // ...
];

$cat = isset($_GET['category']) ? $_GET['category'] : "all";
$pageTitle = $categories[$cat] . " | Your Site Name";
$metaDescription = "Description for this category.";

$jsonPath = $_SERVER['DOCUMENT_ROOT'] . '/m/data/your-items.json';
$items = json_decode(file_get_contents($jsonPath), true)['items'];
$imgBase = "https://yourdomain.com/media/images/";

usort($items, fn($a, $b) => strtotime($b['complete_date']) - strtotime($a['complete_date']));

include '../includes/header.php';
?>
```

### Category Tabs HTML

```html
<!-- Desktop tabs -->
<div class="d-none d-lg-flex flex-wrap justify-content-between gap-2">
    <?php foreach ($categories as $id => $name): ?>
        <button class="btn flex-grow-1 tab-button <?= $id === 'all' ? 'active' : '' ?>"
                data-category="<?= $id ?>">
            <?= $name ?>
        </button>
    <?php endforeach; ?>
</div>

<!-- Mobile dropdown -->
<div class="d-lg-none mb-3">
    <select class="form-select tab-dropdown">
        <?php foreach ($categories as $id => $name): ?>
            <option value="<?= $id ?>" <?= $id === 'all' ? 'selected' : '' ?>>
                <?= $name ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
```

### Card Grid HTML

```html
<div class="row">
    <?php foreach ($items as $item):
        $category_id = floor($item['id'] / 100) * 100;
        $slug = $item['slug'];
        $thumb = $imgBase . $slug . '/' . $item['images'][0];
    ?>
        <div class="col-md-6 mb-4 article-card active" data-category="<?= $category_id ?>">
            <div class="card shadow-sm h-100">
                <div class="row g-0 flex-column flex-md-row h-100">
                    <div class="col-12 col-md-4 d-flex align-items-center">
                        <img src="<?= $thumb ?>" class="img-fluid mx-auto d-block m-3 rounded-3"
                             alt="<?= $item['title'] ?>" style="object-fit: cover;">
                    </div>
                    <div class="col-12 col-md-8 d-flex flex-column">
                        <div class="card-body d-flex flex-column h-100">
                            <h2 class="card-title">
                                <a href="/m/your-section/<?= $slug ?>"><?= $item['title'] ?></a>
                            </h2>
                            <p class="card-text text-muted"><?= $item['excerpt'] ?></p>
                            <a href="/m/your-section/<?= $slug ?>" class="btn w-auto">View Gallery</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Pagination is injected here by script.js -->
<nav id="articlesPagination"><ul class="pagination justify-content-center"></ul></nav>
```

**Required CSS class names** (script.js depends on these):

| Class | Purpose |
|---|---|
| `tab-button` | Desktop filter buttons |
| `tab-dropdown` | Mobile `<select>` |
| `article-card` | Each card wrapper |
| `active` | Cards start with this; JS removes/re-adds to show/hide |
| `data-category` attribute | Numeric category ID on each card |
| `articlesPagination` | `<nav id>` for pagination to render into |

### Footer Scripts

```php
<script src="/m/assets/js/script.js"></script>
<?php include '../includes/footer.php'; ?>
```

---

## Detail Page (`pages/project.php` pattern)

### PHP Setup

```php
<?php
$extraScripts = [
    ["type" => "style",  "url" => "https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/css/glightbox.min.css"],
    ["type" => "script", "url" => "https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/js/glightbox.min.js", "defer" => true],
    ["type" => "script", "url" => "/m/assets/js/script.js"]
];

$jsonPath = $_SERVER['DOCUMENT_ROOT'] . '/m/data/your-items.json';
$items = json_decode(file_get_contents($jsonPath), true)['items'];
$imgBase = "https://yourdomain.com/media/images/";

$slug = $_GET['slug'] ?? '';
$item = null;
foreach ($items as $a) {
    if ($a['slug'] === $slug) { $item = $a; break; }
}

if (!$item) {
    http_response_code(404);
    include $_SERVER['DOCUMENT_ROOT'] . '/m/404page.php';
    exit();
}

$pageTitle = $item['title'];
$metaDescription = "Browse " . strtolower($item['title']) . ": gallery of completed work.";
include '../includes/header.php';
?>
```

### Gallery HTML

```html
<div class="p-4 shadow-sm rounded">
    <h1 class="fw-bold text-center"><?= $item['title'] ?></h1>
    <p class="text-muted"><?= $item['description'] ?></p>

    <?php if (!empty($item['sub-title'])): ?>
        <h2 class="fw-bold text-center"><?= $item['sub-title'] ?></h2>
    <?php endif; ?>

    <div class="row g-3 p-2">
        <?php
        $is_alt = !empty($item['alt-text']);
        $alt_list = $is_alt ? $item['alt-text'] : [];
        $count = count($item['images']);

        for ($i = 1; $i < $count; $i++):
            $file = $item['images'][$i];
            if (empty($file)) continue;
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $alt = $is_alt ? htmlspecialchars($alt_list[$i - 1]) : '';

            if ($ext === 'mp4'):
                $thumb = preg_replace('/\.mp4$/i', '.jpg', $file);
        ?>
                <div class="col-6 col-md-4">
                    <a href="<?= $imgBase . $file ?>" class="glightbox" data-gallery="project">
                        <img src="<?= $imgBase . $thumb ?>" alt="<?= $alt ?>"
                             class="img-fluid rounded shadow-sm" loading="lazy"
                             style="width:100%;height:auto;object-fit:cover;">
                    </a>
                </div>
        <?php else: $src = $imgBase . $slug . '/' . $file; ?>
                <div class="col-6 col-md-4">
                    <a href="<?= $src ?>" class="glightbox" data-gallery="project">
                        <img src="<?= $src ?>" alt="<?= $alt ?>"
                             class="img-fluid rounded shadow-sm" loading="lazy"
                             style="width:100%;height:auto;object-fit:cover;">
                    </a>
                </div>
        <?php endif; endfor; ?>
    </div>
</div>

<!-- Back navigation -->
<div class="container mb-4 d-flex gap-3 justify-content-center">
    <a href="/m/your-section" class="btn">All Items</a>
</div>

<?php include '../includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        closeOnOutsideClick: true
    });
});
</script>
```

---

## URL Routing

Add to `.htaccess` (same pattern as existing rules):

```apache
RewriteRule ^your-section/([^/]+)/?$ pages/your-detail.php?slug=$1 [L,QSA]
```

---

## Image Storage Convention

```
/media/images/{slug}/thumb.webp        ← images[0], used as card thumbnail
/media/images/{slug}/gallery-001.webp  ← images[1..n], shown in lightbox
```

Videos: store the `.mp4` alongside a `.jpg` poster with the same base name. The PHP loop auto-detects the `mp4` extension and swaps in the `.jpg` for the visible thumbnail while the lightbox opens the video.

---

## Pagination

`script.js` automatically handles pagination when the `#articlesPagination` nav element is present. Default page size is **10 cards**. No changes needed to the JS; the DOM class names drive it.

---

## Checklist for a New Section

- [ ] Create `data/your-items.json` with the structure above
- [ ] Create `pages/your-listing.php` (listing page pattern)
- [ ] Create `pages/your-detail.php` (detail page pattern)
- [ ] Add rewrite rule in `.htaccess`
- [ ] Upload images to `/media/images/{slug}/`
- [ ] Verify `$extraScripts` array loads GLightbox on the detail page
- [ ] Confirm `article-card` class and `data-category` attribute are on every card
- [ ] Confirm `#articlesPagination` nav is present on the listing page
