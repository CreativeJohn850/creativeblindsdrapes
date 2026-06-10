<?php
require_once 'includes/config.php';

$page_title = 'Custom Window Shades';
$meta_description = 'Browse premium honeycomb, roller, roman, and sheer shades by Norman Window Fashions. Energy-efficient and stylish window shades for Aurora, IL homes. Free in-home consultation.';

$shades_json = file_get_contents('data/shades.json');
$shades_products = json_decode($shades_json, true);

if (json_last_error() !== JSON_ERROR_NONE || !is_array($shades_products)) {
    $shades_products = [];
}

// Group by category
$tabs = [
    'honeycomb' => ['label' => 'Honeycomb Shades', 'products' => []],
    'roller'    => ['label' => 'Roller Shades',    'products' => []],
    'roman'     => ['label' => 'Roman Shades',     'products' => []],
    'sheer'     => ['label' => 'Perfect Sheer',    'products' => []],
];
foreach ($shades_products as $p) {
    if (isset($tabs[$p['category']])) {
        $tabs[$p['category']]['products'][] = $p;
    }
}

if (!empty($shades_products)) {
    $schema_items = [];
    foreach ($shades_products as $i => $p) {
        $schema_items[] = [
            '@type' => 'ListItem',
            'position' => $i + 1,
            'item' => [
                '@type' => 'Product',
                'name' => $p['name'],
                'description' => $p['description'],
                'brand' => ['@type' => 'Brand', 'name' => 'Norman Window Fashions'],
                'url' => $p['manufacturer_url'],
                'image' => SITE_URL . '/' . $p['images'][0]
            ]
        ];
    }
    $page_schema_json = json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'name' => 'Custom Window Shades Norman Window Fashions Collection',
        'description' => $meta_description,
        'numberOfItems' => count($shades_products),
        'itemListElement' => $schema_items
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}

require_once 'includes/header.php';

if (!function_exists('encodeImagePath')) {
    function encodeImagePath($path) {
        return implode('/', array_map('rawurlencode', explode('/', $path)));
    }
}
if (!function_exists('thumbPath')) {
    function thumbPath($path) {
        return substr($path, 0, strrpos($path, '.')) . '_thumb.webp';
    }
}
?>
<!-- Page Header -->
<style>
.page-header-bg {
    background-image: linear-gradient(rgba(63,61,61,0.52), rgba(63,61,61,0.52)),
                      url('<?php echo encodeImagePath('assets/products/honeycomb/Portrait Honeycomb/01-Honeycomb.jpg'); ?>');
    background-size: cover;
    background-position: center;
}
</style>
<section class="page-header page-header-bg"
    style="color: white; padding: 60px 20px; text-align: center;">
    <div class="container">
        <h1 style="color: white; margin-bottom: 15px;">Custom Window Shades</h1>
        <p style="font-size: 1.2rem; color: rgba(255,255,255,0.95); max-width: 700px; margin: 0 auto;">Energy-efficient honeycomb, sleek roller, elegant roman, and modern sheer shades by Norman Window Fashions  for every window in your home.</p>
    </div>
</section>

<!-- Products Section -->
<section style="padding: 60px 20px;">
    <div class="container">

        <!-- Tab Navigation -->
        <div style="overflow-x: auto; margin-bottom: 40px;">
            <div style="display: flex; gap: 0; border-bottom: 2px solid var(--border-color);">
                <?php $tabIndex = 0; foreach ($tabs as $key => $tab): ?>
                    <?php if (empty($tab['products'])) { $tabIndex++; continue; } ?>
                    <button class="tab-btn <?php echo $tabIndex === 0 ? 'active' : ''; ?>"
                        data-tab="<?php echo $key; ?>"
                        data-count="<?php echo count($tab['products']); ?>"
                        style="padding: 14px 28px; background: none; border: none; border-bottom: 3px solid <?php echo $tabIndex === 0 ? 'var(--primary-teal)' : 'transparent'; ?>; color: <?php echo $tabIndex === 0 ? 'var(--primary-teal)' : 'var(--text-gray)'; ?>; font-family: var(--font-primary); font-size: 1rem; font-weight: 600; cursor: pointer; white-space: nowrap; margin-bottom: -2px;">
                        <?php echo htmlspecialchars($tab['label']); ?>
                        <span style="font-weight: 400; font-size: 0.85rem; margin-left: 6px;">(<?php echo count($tab['products']); ?>)</span>
                    </button>
                <?php $tabIndex++; endforeach; ?>
            </div>
        </div>

        <!-- Search/Filter Bar -->
        <?php $firstTabCount = 0; foreach ($tabs as $t) { if (!empty($t['products'])) { $firstTabCount = count($t['products']); break; } } ?>
        <div id="searchBar" style="margin-bottom: 40px; max-width: 600px; margin-left: auto; margin-right: auto;<?php echo $firstTabCount <= 1 ? ' display:none;' : ''; ?>">
            <input type="text" id="productSearch" placeholder="Search shades by name..."
                style="width: 100%; padding: 14px 20px; border: 2px solid var(--border-color); border-radius: 4px; font-size: 1rem; font-family: var(--font-primary);">
        </div>

        <!-- Tab Content Panels -->
        <?php $tabIndex = 0; foreach ($tabs as $key => $tab): ?>
            <?php if (empty($tab['products'])) { $tabIndex++; continue; } ?>
            <div class="tab-content <?php echo $tabIndex === 0 ? 'active' : ''; ?>"
                id="<?php echo $key; ?>-content"
                style="display: <?php echo $tabIndex === 0 ? 'block' : 'none'; ?>;">
                <div class="products-grid"
                    style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px;">
                    <?php foreach ($tab['products'] as $product): ?>
                        <div class="product-card" data-name="<?php echo htmlspecialchars($product['slug']); ?>">

                            <div class="card-image" style="position: relative; overflow: hidden;">
                                <img src="<?php echo encodeImagePath(thumbPath($product['images'][0])); ?>"
                                    alt="<?php echo htmlspecialchars($product['name']); ?>"
                                    style="width: 100%; height: 220px; object-fit: cover;"
                                    onerror="this.src='<?php echo encodeImagePath($product['images'][0]); ?>'; this.onerror=null;">
                                <?php if (count($product['images']) > 1): ?>
                                    <span style="display:none; position: absolute; bottom: 10px; right: 10px; background: rgba(0,0,0,0.55); color: white; padding: 4px 10px; border-radius: 3px; font-size: 0.75rem; font-weight: 600;">
                                        <?php echo count($product['images']); ?> photos
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="card-content">
                                <h3 style="font-size: 1.3rem; margin-bottom: 10px;">
                                    <?php echo htmlspecialchars($product['name']); ?>
                                </h3>

                                <p style="font-size: 0.88rem; color: var(--text-gray); margin-bottom: 14px; line-height: 1.6;">
                                    <?php echo htmlspecialchars($product['description']); ?>
                                </p>

                                <div class="product-specs"
                                    style="font-size: 0.9rem; color: var(--text-gray); margin-bottom: 15px; line-height: 1.9;">
                                    <div><strong>Opacity:</strong> <?php echo htmlspecialchars(implode(', ', $product['opacity_options'])); ?></div>
                                    <?php if (!empty($product['cell_structure'])): ?>
                                        <div><strong>Cell Structure:</strong> <?php echo htmlspecialchars(implode(', ', $product['cell_structure'])); ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($product['fold_styles'])): ?>
                                        <div><strong>Fold Styles:</strong> <?php echo htmlspecialchars(implode(', ', $product['fold_styles'])); ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($product['roll_type'])): ?>
                                        <div><strong>Roll Type:</strong> <?php echo htmlspecialchars(implode(', ', $product['roll_type'])); ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($product['vane_width'])): ?>
                                        <div><strong>Vane Width:</strong> <?php echo htmlspecialchars(implode(', ', $product['vane_width'])); ?></div>
                                    <?php endif; ?>
                                    <div><strong>Lift Options:</strong> <?php echo htmlspecialchars(implode(', ', $product['lift_options'])); ?></div>
                                </div>

                                <div style="display: flex; gap: 10px;">
                                    <a href="contact.php#quote-form"
                                        class="btn btn-primary"
                                        style="flex: 1; text-align: center; padding: 10px; font-size: 0.9rem;">
                                        Get a Quote
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php $tabIndex++; endforeach; ?>

    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Find Your Perfect Shades?</h2>
        <p>Schedule a free in-home consultation. We'll bring samples directly to you!</p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-top: 30px;">
            <a href="contact.php#quote-form" class="btn btn-primary">Request Free Consultation</a>
            <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" onclick="dataLayer.push({'event': 'phone_click'});" class="btn btn-secondary"
                style="background-color: transparent; color: white; border-color: white;">
                Call <?php echo BUSINESS_PHONE; ?>
            </a>
        </div>
    </div>
</section>

<script>
    // Tab switching
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.tab-btn').forEach(b => {
                b.classList.remove('active');
                b.style.color = 'var(--text-gray)';
                b.style.borderBottomColor = 'transparent';
            });
            document.querySelectorAll('.tab-content').forEach(c => {
                c.classList.remove('active');
                c.style.display = 'none';
            });
            this.classList.add('active');
            this.style.color = 'var(--primary-teal)';
            this.style.borderBottomColor = 'var(--primary-teal)';
            const content = document.getElementById(this.dataset.tab + '-content');
            content.classList.add('active');
            content.style.display = 'block';
            document.getElementById('productSearch').value = '';
            content.querySelectorAll('.product-card').forEach(c => c.style.display = 'block');
            document.getElementById('searchBar').style.display = Number(this.dataset.count) > 1 ? '' : 'none';
        });
    });

    // Search (searches within active tab only)
    document.getElementById('productSearch').addEventListener('input', function (e) {
        const searchTerm = e.target.value.toLowerCase();
        const activeTab = document.querySelector('.tab-content.active');
        if (!activeTab) return;
        activeTab.querySelectorAll('.product-card').forEach(product => {
            product.style.display = product.dataset.name.includes(searchTerm) ? 'block' : 'none';
        });
    });
</script>
<?php
require_once 'includes/footer.php';
?>
