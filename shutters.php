<?php
require_once 'includes/config.php';

$page_title = 'Custom Window Shutters';
$meta_description = 'Browse 7 premium shutter collections by Norman Window Fashions. Composite, wood, and specialty shape shutters for Aurora, IL homes. Free in-home consultation.';

$shutters_json = file_get_contents('data/shutters.json');
$shutters_products = json_decode($shutters_json, true);

if (json_last_error() !== JSON_ERROR_NONE || !is_array($shutters_products)) {
    $shutters_products = [];
}

if (!empty($shutters_products)) {
    $schema_items = [];
    foreach ($shutters_products as $i => $p) {
        $schema_items[] = [
            '@type' => 'ListItem',
            'position' => $i + 1,
            'item' => [
                '@type' => 'Product',
                'name' => $p['name'] . ' Window Shutter',
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
        'name' => 'Custom Window Shutters Norman Window Fashions Collection',
        'description' => $meta_description,
        'numberOfItems' => count($shutters_products),
        'itemListElement' => $schema_items
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}

$lcp_image        = 'assets/products/shutters/Woodlore/01-Woodlore.jpg';
$lcp_image_mobile = 'assets/products/shutters/Woodlore/01-Woodlore_m.webp';

require_once 'includes/header.php';

function encodeImagePath($path) {
    return implode('/', array_map('rawurlencode', explode('/', $path)));
}
function thumbPath($path) {
    return substr($path, 0, strrpos($path, '.')) . '_thumb.webp';
}
?>
<!-- Page Header -->
<style>
.page-header-bg {
    background-image: linear-gradient(rgba(63,61,61,0.52), rgba(63,61,61,0.52)),
                      url('assets/products/shutters/Woodlore/01-Woodlore.jpg');
    background-size: cover;
    background-position: center;
}
@media (max-width: 991px) {
    .page-header-bg {
        background-image: linear-gradient(rgba(63,61,61,0.52), rgba(63,61,61,0.52)),
                          url('assets/products/shutters/Woodlore/01-Woodlore_m.webp');
    }
}
</style>
<section class="page-header page-header-bg"
    style="color: white; padding: 60px 20px; text-align: center;">
    <div class="container">
        <h1 style="color: white; margin-bottom: 15px;">Custom Window Shutters in Aurora, IL</h1>
        <p style="font-size: 1.2rem; color: rgba(255,255,255,0.95); max-width: 700px; margin: 0 auto;">Premium shutter collections by Norman Window Fashions. Composite, wood, and specialty shapes for every window in your home.</p>
    </div>
</section>

<!-- Products Section -->
<section style="padding: 60px 20px;">
    <div class="container">

        <?php if (count($shutters_products) > 1): ?>
        <!-- Search/Filter Bar -->
        <div style="margin-bottom: 40px; max-width: 600px; margin-left: auto; margin-right: auto;">
            <input type="text" id="productSearch" placeholder="Search shutters by name..."
                style="width: 100%; padding: 14px 20px; border: 2px solid var(--border-color); border-radius: 4px; font-size: 1rem; font-family: var(--font-primary);">
        </div>
        <?php endif; ?>

        <!-- Shutters Grid -->
        <div class="tab-content" id="shutters-content">
            <div class="products-grid"
                style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px;">
                <?php foreach ($shutters_products as $product): ?>
                    <div class="product-card" data-name="<?php echo htmlspecialchars($product['slug']); ?>">

                        <!-- Thumbnail image -->
                        <div class="card-image" style="position: relative; overflow: hidden;">
                            <img src="<?php echo encodeImagePath(thumbPath($product['images'][0])); ?>"
                                alt="<?php echo htmlspecialchars($product['name']); ?> window shutter"
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
                                <div>
                                    <strong>Colors:</strong>
                                    <?php echo htmlspecialchars(implode(', ', $product['colors'])); ?>
                                </div>
                                <div>
                                    <strong>Louver Sizes:</strong>
                                    <?php echo htmlspecialchars(implode(', ', $product['louver_sizes'])); ?>
                                </div>
                                <div>
                                    <strong>Frames:</strong>
                                    <?php echo htmlspecialchars(implode(', ', $product['frames'])); ?>
                                </div>
                                <div>
                                    <strong>Controls:</strong>
                                    <?php echo htmlspecialchars(implode(', ', $product['control_options'])); ?>
                                </div>
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

    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Transform Your Windows?</h2>
        <p>Schedule a free in-home consultation. We'll bring shutter samples directly to you!</p>
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
    const searchInput = document.getElementById('productSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function (e) {
            const searchTerm = e.target.value.toLowerCase();
            const products = document.querySelectorAll('#shutters-content .product-card');
            products.forEach(product => {
                const name = product.dataset.name;
                product.style.display = name.includes(searchTerm) ? 'block' : 'none';
            });
        });
    }
</script>
<?php
require_once 'includes/footer.php';
?>
