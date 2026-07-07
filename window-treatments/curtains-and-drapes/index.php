<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';

$page_title = 'Custom Curtains & Drapes in Aurora & Naperville, IL';
$meta_description = 'Shop custom curtains & drapes in Aurora, IL. 70+ Fonluk drapery fabrics, 54 sheers, motorized track & professional installation. Free consultation.';

$fonluk_json = file_get_contents(ROOT_PATH . '/data/fonluk.json');
$fonluk_products = json_decode($fonluk_json, true);
if (json_last_error() !== JSON_ERROR_NONE || !is_array($fonluk_products)) {
    $fonluk_products = [];
}

$tuller_json = file_get_contents(ROOT_PATH . '/data/tuller.json');
$tuller_products = json_decode($tuller_json, true);
if (json_last_error() !== JSON_ERROR_NONE || !is_array($tuller_products)) {
    $tuller_products = [];
}

$tabs = [
    'draperies' => [
        'label'        => 'Draperies',
        'products'     => $fonluk_products,
        'img_prefix'   => BASE_URL . '/assets/products/fonluk/thumbnails/',
        'pdf_prefix'   => BASE_URL . '/assets/products/fonluk/pdfs/',
        'img_ext'      => '.webp',
        'product_type' => 'Drapery Fabric',
        'brand'        => 'Fonluk',
    ],
    'sheers' => [
        'label'        => 'Sheers',
        'products'     => $tuller_products,
        'img_prefix'   => BASE_URL . '/assets/products/tuller/thumbnails/',
        'pdf_prefix'   => BASE_URL . '/assets/products/tuller/pdfs/',
        'img_ext'      => '.webp',
        'product_type' => 'Sheer Curtain Fabric',
        'brand'        => 'Fonluk',
    ],
];

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Window Treatments', 'path' => '/window-treatments/'],
    ['name' => 'Curtains & Drapes'],
];

$faqs = [
    ['q' => 'What are custom made curtains and how do they differ from ready-made?',
     'a' => 'Custom made curtains are fabricated to the exact drop and width of your window, so panels hang cleanly without pooling on the floor or gapping at the sides the way stock, ready-made sizes often do. We measure every window at your free in-home consultation and tailor the fullness, heading style and length to the room.'],
    ['q' => 'What drapery designs and styles do you offer?',
     'a' => 'We offer four main directions: full-length drapery panels in pinch pleat, eyelet, tab-top or rod-pocket headings; layered looks that combine a sheer with a drape; blackout and room-darkening drapes using fabrics such as Blackout Satin and Astar Dimout; and motorized drapery on a track. All draw from our 70+ Fonluk drapery fabrics and 54 sheers.'],
    ['q' => 'What is the layered shades-and-curtains look and how do you install it?',
     'a' => 'The layered look pairs a shade (such as a cellular or roller shade) for precise light control with a drapery panel for softness and style. We install both in a single appointment, mounting the shade inside or close to the window and the drapery hardware above and wider so the panels frame the window.'],
    ['q' => 'What does professional drapery installation include?',
     'a' => 'Our drapery installation covers precise measuring, mounting the rod or track level and securely, hanging the panels, and steaming and dressing the pleats so they hang evenly. For motorized drapery we pair and test the track, and every job includes a 30-day follow-up adjustment.'],
    ['q' => 'Can you install curtains in Naperville, Oswego or Yorkville?',
     'a' => 'Yes. We make and install custom curtains and drapes across our full service area: Aurora, Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles and Plainfield, with no travel charges and a free in-home measure and written quote.'],
    ['q' => 'How much do custom curtains and drapes cost in Aurora, IL?',
     'a' => 'Cost depends on the fabric, panel width and drop, heading style, and whether you add a blackout lining or motorized track. The most accurate figure comes from your free in-home consultation, where we measure each window and provide an itemised written quote with no obligation.'],
];

// ItemList of the drapery style categories (matches the on-page collection cards).
$itemlist_items = [
    ['name' => 'Custom Drapery Panels', 'description' => 'Made-to-measure panels from 70+ Fonluk fabrics in pinch pleat, eyelet, tab-top and rod-pocket styles.', 'url' => SITE_URL . '/window-treatments/curtains-and-drapes/draperies/'],
    ['name' => 'Blackout & Room-Darkening Drapes', 'description' => 'Light-blocking drapery using Blackout Satin and Astar Dimout fabrics.', 'url' => SITE_URL . '/window-treatments/curtains-and-drapes/'],
    ['name' => 'Sheer Curtains', 'description' => '54 sheer options for soft, diffused daylight and daytime privacy.', 'url' => SITE_URL . '/window-treatments/curtains-and-drapes/sheers/'],
    ['name' => 'Motorized Curtains & Drapes', 'description' => 'Drapery on a motorized track controlled by app, remote, schedule or voice.', 'url' => SITE_URL . '/window-treatments/motorized-window-treatment/'],
    ['name' => 'Layered Shades & Drapery Designs', 'description' => 'Shade plus drapery combinations for light control and a designer finish.', 'url' => SITE_URL . '/window-treatments/curtains-and-drapes/'],
];

require_once ROOT_PATH . '/includes/spoke-schema.php';
$page_schema_json = spoke_schema_graph([
    cbd_service_schema('Custom Drapery Installation', 'Custom Curtains & Drapes in Aurora, IL', $meta_description, SITE_URL . '/window-treatments/curtains-and-drapes/'),
    cbd_itemlist_schema($itemlist_items),
    cbd_faq_schema($faqs),
    cbd_breadcrumb_schema($crumbs),
]);

$lcp_image        = BASE_URL . '/assets/images/carousel/curtain-drape-background-2365x594.jpg';
$lcp_image_mobile = BASE_URL . '/assets/images/carousel/curtain-drape-background-666x577.jpg';

require_once ROOT_PATH . '/includes/header.php';

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
                      url('<?php echo BASE_URL; ?>/assets/images/carousel/curtain-drape-background-2365x594.jpg');
    background-size: cover;
    background-position: center;
}
@media (max-width: 991px) {
    .page-header-bg {
        background-image: linear-gradient(rgba(63,61,61,0.52), rgba(63,61,61,0.52)),
                          url('<?php echo BASE_URL; ?>/assets/images/carousel/curtain-drape-background-666x577.jpg');
    }
}
</style>
<section class="page-header page-header-bg"
    style="color: white; padding: 60px 20px; text-align: center;">
    <div class="container">
        <h1 style="color: white; margin-bottom: 15px;">Custom Curtains &amp; Drapes in Aurora, Naperville & the Fox Valley</h1>
        <p style="font-size: 1.2rem; color: rgba(255,255,255,0.95); max-width: 760px; margin: 0 auto;">
            Shop custom curtains and drapes from 70+ premium Fonluk drapery fabrics and 54 sheer options, professionally measured and installed across Aurora, Naperville and the Fox Valley. Every order includes a free in-home consultation, exact-fit fabrication and drapery installation backed by 23 years of experience through Creative Floors Inc.
        </p>
    </div>
</section>

<?php require ROOT_PATH . '/includes/breadcrumbs.php'; ?>

<?php include ROOT_PATH . '/includes/compact-form.php'; ?>

<!-- Trust Bar -->
<section style="padding: 40px 20px 0;">
    <div class="container">
        <div class="trust-bar">
            <div class="trust-chip">70+ Drapery Fabrics</div>
            <div class="trust-chip">54 Sheer Options</div>
            <div class="trust-chip">Motorized Track Available</div>
            <div class="trust-chip">Installation Included</div>
        </div>
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
                <?php $spokeLinks = ['draperies' => ['url' => '/window-treatments/curtains-and-drapes/draperies/', 'label' => 'custom draperies'], 'sheers' => ['url' => '/window-treatments/curtains-and-drapes/sheers/', 'label' => 'sheer curtains']]; ?>
                <?php if (!empty($spokeLinks[$key])): ?>
                    <p style="margin-bottom: 24px; font-size: 1rem;">
                        <a href="<?php echo url($spokeLinks[$key]['url']); ?>" style="color: var(--primary-teal); font-weight: 600;">Learn more about <?php echo htmlspecialchars($spokeLinks[$key]['label']); ?> &rarr;</a>
                    </p>
                <?php endif; ?>
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
                                    <button type="button"
                                        class="btn btn-primary pdf-download"
                                        data-pdf="<?php echo htmlspecialchars($tab['pdf_prefix'] . $product['name'] . '.pdf'); ?>"
                                        style="flex: 1; text-align: center; padding: 10px; font-size: 0.9rem; cursor: pointer;">
                                        Download PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php $tabIndex++; endforeach; ?>

    </div>
</section>

<!-- Fonluk Fabric Specifications -->
<section style="padding: 20px 20px 60px; background-color: var(--warm-cream);">
    <div class="container">
        <div class="section-header">
            <h2>Fonluk Drapery Fabric Specifications</h2>
            <p>Our Fonluk drapery and sheer collections are woven by the Turkish manufacturer Adeko for commercial-grade quality.</p>
        </div>
        <div class="compare-table-wrap" style="margin-top: 30px;">
            <table class="compare-table">
                <thead>
                    <tr><th>Fabric Property</th><th>Drapery Collection</th><th>Sheer Collection</th></tr>
                </thead>
                <tbody>
                    <tr><td>Panel width</td><td>118.1&quot; standard (up to 126&quot; blackout)</td><td>118.1&quot;</td></tr>
                    <tr><td>Weight range</td><td>19-26.5 oz/yd&sup2;</td><td>Lightweight sheer</td></tr>
                    <tr><td>Composition</td><td>100% PES and PES/VIS/COT blends</td><td>100% PES sheer</td></tr>
                    <tr><td>Opacity range</td><td>Light filtering to blackout (Blackout Satin)</td><td>Semi-transparent</td></tr>
                    <tr><td>Double-face options</td><td>Yes (e.g. reversible Amour)</td><td>N/A</td></tr>
                    <tr><td>Custom drop lengths</td><td>Made to measure</td><td>Made to measure</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Cross-sell -->
<section style="padding: 60px 20px;">
    <div class="container">
        <div class="section-header">
            <h2>Explore the Full Custom Window Treatment Range</h2>
            <p>Layer drapes with shades and shutters. Every category includes free consultation, custom fabrication and professional installation.</p>
        </div>
        <div class="grid-4" style="margin-top: 40px;">
            <div style="text-align: center;">
                <h3 style="margin-bottom: 10px;">Shutters</h3>
                <p style="color: var(--text-gray); margin-bottom: 15px;">7 collections: wood, composite &amp; motorized interior shutters.</p>
                <a href="<?php echo url('/window-treatments/window-shutters/'); ?>" class="btn btn-primary">Browse custom shutters</a>
            </div>
            <div style="text-align: center;">
                <h3 style="margin-bottom: 10px;">Blinds</h3>
                <p style="color: var(--text-gray); margin-bottom: 15px;">Faux wood, real wood, aluminum &amp; vertical blinds.</p>
                <a href="<?php echo url('/window-treatments/window-blinds/'); ?>" class="btn btn-primary">Browse custom blinds</a>
            </div>
            <div style="text-align: center;">
                <h3 style="margin-bottom: 10px;">Shades</h3>
                <p style="color: var(--text-gray); margin-bottom: 15px;">Honeycomb, roller, roman &amp; sheer shades. Layer with sheers.</p>
                <a href="<?php echo url('/window-treatments/shades/'); ?>" class="btn btn-primary">Browse custom shades</a>
            </div>
            <div style="text-align: center;">
                <h3 style="margin-bottom: 10px;">All Window Treatments</h3>
                <p style="color: var(--text-gray); margin-bottom: 15px;">Hub page: blinds, shades, shutters, drapes and motorized options.</p>
                <a href="<?php echo url('/window-treatments/'); ?>" class="btn btn-primary">Browse all treatments</a>
            </div>
        </div>
    </div>
</section>

<?php require ROOT_PATH . '/includes/faq-section.php'; ?>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Choose Your Perfect Fabric?</h2>
        <p>Schedule a free in-home consultation. We'll bring fabric samples directly to you!</p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-top: 30px;">
            <a href="<?php echo url('/contact/'); ?>#quote-form" class="btn btn-primary">Request Free Consultation</a>
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

    // PDF spec sheets opened via JS so they aren't crawlable <a> links
    // (keeps this page well under the 100-link SEO threshold - was ~142 links).
    document.querySelectorAll('.pdf-download').forEach(function (btn) {
        btn.addEventListener('click', function () {
            window.open(this.dataset.pdf, '_blank', 'noopener');
        });
    });
</script>
<?php
require_once ROOT_PATH . '/includes/footer.php';
?>
