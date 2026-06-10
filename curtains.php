<?php
require_once 'includes/config.php';

$page_title = 'Custom Curtains & Drapes';
$meta_description = 'Browse 70+ premium drapery fabrics and 50+ sheer options. Elegant custom curtains and drapes for Aurora, IL homes. Free design consultation.';

$fonluk_json = file_get_contents('data/fonluk.json');
$fonluk_products = json_decode($fonluk_json, true);
if (json_last_error() !== JSON_ERROR_NONE || !is_array($fonluk_products)) {
    $fonluk_products = [];
}

$tuller_json = file_get_contents('data/tuller.json');
$tuller_products = json_decode($tuller_json, true);
if (json_last_error() !== JSON_ERROR_NONE || !is_array($tuller_products)) {
    $tuller_products = [];
}

$tabs = [
    'draperies' => [
        'label'        => 'Draperies',
        'products'     => $fonluk_products,
        'img_prefix'   => 'assets/products/fonluk/thumbnails/',
        'pdf_prefix'   => 'assets/products/fonluk/pdfs/',
        'img_ext'      => '.webp',
        'product_type' => 'Drapery Fabric',
        'brand'        => 'Adeko',
    ],
    'sheers' => [
        'label'        => 'Sheers',
        'products'     => $tuller_products,
        'img_prefix'   => 'assets/products/tuller/thumbnails/',
        'pdf_prefix'   => 'assets/products/tuller/pdfs/',
        'img_ext'      => '.webp',
        'product_type' => 'Sheer Curtain Fabric',
        'brand'        => 'Adeko',
    ],
];

$all_products = array_merge($fonluk_products, $tuller_products);
if (!empty($all_products)) {
    $schema_items = [];
    foreach ($all_products as $i => $p) {
        $schema_items[] = [
            '@type'    => 'ListItem',
            'position' => $i + 1,
            'item'     => [
                '@type'    => 'Product',
                'name'     => $p['name'] . ' Curtain Fabric',
                'material' => $p['composition'] ?? '',
                'brand'    => ['@type' => 'Brand', 'name' => 'Adeko'],
            ]
        ];
    }
    $page_schema_json = json_encode([
        '@context'       => 'https://schema.org',
        '@type'          => 'ItemList',
        'name'           => 'Custom Curtains & Drapes Adeko Collection',
        'description'    => $meta_description,
        'numberOfItems'  => count($all_products),
        'itemListElement' => $schema_items,
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}

$lcp_image        = 'assets/images/carousel/curtain-drape-background-2365x594.jpg';
$lcp_image_mobile = 'assets/images/carousel/curtain-drape-background-666x577.jpg';

require_once 'includes/header.php';

function getPatternArrow($direction)
{
    $arrows = [
        'all'        => '↔↕',
        'right'      => '→',
        'left'       => '←',
        'vertical'   => '↕',
        'horizontal' => '↔',
        'diagonal'   => '↗↘',
        'up'         => '↑',
        'down'       => '↓',
    ];
    return $arrows[$direction] ?? '↔↕';
}
?>
<!-- Page Header -->
<style>
.page-header-bg {
    background-image: linear-gradient(rgba(63,61,61,0.52), rgba(63,61,61,0.52)),
                      url('assets/images/carousel/curtain-drape-background-2365x594.jpg');
    background-size: cover;
    background-position: center;
}
@media (max-width: 991px) {
    .page-header-bg {
        background-image: linear-gradient(rgba(63,61,61,0.52), rgba(63,61,61,0.52)),
                          url('assets/images/carousel/curtain-drape-background-666x577.jpg');
    }
}
</style>
<section class="page-header page-header-bg"
    style="color: white; padding: 60px 20px; text-align: center;">
    <div class="container">
        <h1 style="color: white; margin-bottom: 15px;">Custom Curtains &amp; Drapes in Aurora, IL</h1>
        <p style="font-size: 1.2rem; color: rgba(255,255,255,0.95); max-width: 700px; margin: 0 auto;">
            Over 70 premium drapery fabrics and 50+ sheer options for elegant windows in every room.
        </p>
    </div>
</section>

<!-- Products Section -->
<section style="padding: 60px 20px;">
    <div class="container">

        <!-- Tab Navigation -->
        <div style="display: flex; gap: 0; border-bottom: 2px solid var(--border-color); margin-bottom: 40px;">
            <?php $tabIndex = 0; foreach ($tabs as $key => $tab): ?>
                <button class="tab-btn <?php echo $tabIndex === 0 ? 'active' : ''; ?>"
                    data-tab="<?php echo $key; ?>"
                    style="padding: 14px 28px; background: none; border: none; border-bottom: 3px solid <?php echo $tabIndex === 0 ? 'var(--primary-teal)' : 'transparent'; ?>; color: <?php echo $tabIndex === 0 ? 'var(--primary-teal)' : 'var(--text-gray)'; ?>; font-family: var(--font-primary); font-size: 1rem; font-weight: 600; cursor: pointer; white-space: nowrap; margin-bottom: -2px;">
                    <?php echo htmlspecialchars($tab['label']); ?>
                    <span style="font-weight: 400; font-size: 0.85rem; margin-left: 6px;">(<?php echo count($tab['products']); ?>)</span>
                </button>
            <?php $tabIndex++; endforeach; ?>
        </div>

        <!-- Search/Filter Bar -->
        <div style="margin-bottom: 40px; max-width: 600px; margin-left: auto; margin-right: auto;">
            <input type="text" id="productSearch" placeholder="Search by product name..."
                style="width: 100%; padding: 14px 20px; border: 2px solid var(--border-color); border-radius: 4px; font-size: 1rem; font-family: var(--font-primary);">
        </div>

        <!-- Tab Content Panels -->
        <?php $tabIndex = 0; foreach ($tabs as $key => $tab): ?>
            <div class="tab-content <?php echo $tabIndex === 0 ? 'active' : ''; ?>"
                id="<?php echo $key; ?>-content"
                style="display: <?php echo $tabIndex === 0 ? 'block' : 'none'; ?>;">
                <div class="products-grid"
                    style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px;">
                    <?php foreach ($tab['products'] as $product): ?>
                        <div class="product-card" data-name="<?php echo strtolower(htmlspecialchars($product['name'])); ?>">
                            <div class="card-image" style="position: relative;">
                                <img src="<?php echo $tab['img_prefix'] . strtolower($product['name']) . $tab['img_ext']; ?>"
                                    alt="<?php echo htmlspecialchars($product['name']); ?> <?php echo $tab['product_type']; ?>"
                                    onerror="this.style.background='#f0f0f0'; this.style.height='200px';">
                                <?php if (isset($product['face'])): ?>
                                    <span style="position: absolute; top: 10px; right: 10px; background: var(--primary-teal); color: white; padding: 5px 12px; border-radius: 3px; font-size: 0.75rem; font-weight: 600;">
                                        <?php echo htmlspecialchars($product['face']); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="card-content">
                                <h3 style="font-size: 1.3rem; margin-bottom: 15px;">
                                    <?php echo htmlspecialchars($product['name']); ?>
                                </h3>
                                <div class="product-specs"
                                    style="font-size: 0.9rem; color: var(--text-gray); margin-bottom: 15px; line-height: 1.8;">
                                    <div><strong>Weight:</strong> <?php echo htmlspecialchars($product['weight_us'] ?? ''); ?></div>
                                    <div><strong>Composition:</strong> <?php echo htmlspecialchars($product['composition'] ?? ''); ?></div>
                                    <div><strong>Width:</strong> <?php echo htmlspecialchars($product['width_us'] ?? ''); ?></div>
                                    <div><strong>Lead Band:</strong>
                                        <?php echo ($product['band'] ?? '') === 'AVAILABLE' ? '✓ Available' : '✗ No'; ?>
                                    </div>
                                    <div><strong>Pattern:</strong>
                                        <?php echo getPatternArrow($product['pattern'] ?? 'all'); ?>
                                        <?php echo ucfirst($product['pattern'] ?? ''); ?>
                                    </div>
                                </div>
                                <div style="display: flex; gap: 10px;">
                                    <a href="<?php echo $tab['pdf_prefix'] . $product['name']; ?>.pdf"
                                        class="btn btn-primary"
                                        style="flex: 1; text-align: center; padding: 10px; font-size: 0.9rem;" download>
                                        Download PDF
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
        <h2>Ready to Choose Your Perfect Fabric?</h2>
        <p>Schedule a free in-home consultation. We'll bring fabric samples directly to you!</p>
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
        });
    });

    // Search (within active tab only)
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
