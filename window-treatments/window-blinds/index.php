<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';

$page_title = 'Custom Window Blinds in Aurora & Naperville, IL';
$meta_description = 'Shop faux wood, vertical & aluminum blinds in Aurora, IL. Cordless, motorized & inside-mount options by Norman Window Fashions. Free consultation.';

$blinds_json = file_get_contents(ROOT_PATH . '/data/blinds.json');
$blinds_products = json_decode($blinds_json, true);

if (json_last_error() !== JSON_ERROR_NONE || !is_array($blinds_products)) {
    $blinds_products = [];
}

// Group by category
$tabs = [
    'horizontal' => ['label' => 'Horizontal Blinds', 'products' => []],
    'vertical'   => ['label' => 'Vertical Blinds',   'products' => []],
];
foreach ($blinds_products as $p) {
    if (isset($tabs[$p['category']])) {
        $tabs[$p['category']]['products'][] = $p;
    }
}

// Learn-more links to the dedicated spoke landing pages (two-way hub<->spoke linking).
$spokeLinks = [
    'horizontal' => ['url' => '/window-treatments/window-blinds/horizontal-blinds/', 'label' => 'horizontal blinds'],
    'vertical'   => ['url' => '/window-treatments/window-blinds/vertical-blinds/',   'label' => 'vertical blinds'],
];

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Window Treatments', 'path' => '/window-treatments/'],
    ['name' => 'Custom Blinds'],
];

$faqs = [
    ['q' => 'What are the best faux wood blinds for a kitchen or bathroom?',
     'a' => 'For damp rooms we recommend the Cordless Fauxwood and Ultimate Fauxwood collections. Their moisture-resistant composite construction will not warp, crack or fade the way real wood can in humidity, which makes them ideal for kitchens, bathrooms and laundry rooms. We bring samples of both to your free in-home consultation.'],
    ['q' => 'What is the difference between 2 inch and 1 inch faux wood blinds?',
     'a' => 'Two-inch slats are the most popular size and stack more compactly while covering more of the glass when tilted open, giving a bolder, more contemporary look. One-inch slats suit narrow windows and a more traditional, tailored appearance. We can show both sizes side by side during the consultation.'],
    ['q' => 'Can you install vertical blinds on a sliding glass door?',
     'a' => 'Yes. The Synchrony vertical blind collection is designed for patio doors and wide windows. The vanes tilt for light and privacy and slide to one side so you can open the door freely, and a motorized upgrade is available. Installation is included with every order.'],
    ['q' => 'Do you offer inside mount for faux wood blinds?',
     'a' => 'Yes, provided the window recess is at least about 1.5 inches deep. Our installer checks the mounting depth during the pre-installation measurement visit. If the recess is too shallow, we fit a flush outside mount that covers the frame for a clean finish.'],
    ['q' => 'Are motorized vertical blinds compatible with Alexa or Google Home?',
     'a' => 'Yes. Motorized blinds use the Norman ShadeAuto and SmartDial systems with the Norman Hub app, and integrate with Amazon Alexa and Google Home for voice and schedule control. Our installer pairs and tests the motorization at the installation appointment.'],
    ['q' => 'How much does blind installation cost in Aurora, IL?',
     'a' => 'Professional installation is included in the price of your blinds, with no separate fitting or labour fee. You receive an itemised written quote at your free in-home consultation so you know the full cost before you order.'],
];

// ItemList of the blind collections (data-driven from the loaded catalog).
$itemlist_items = array_map(fn($p) => [
    'name'        => $p['name'],
    'description' => $p['description'] ?? '',
    'url'         => SITE_URL . '/window-treatments/window-blinds/',
], $blinds_products);

require_once ROOT_PATH . '/includes/spoke-schema.php';
$page_schema_json = spoke_schema_graph([
    cbd_service_schema('Window Blind Installation', 'Custom Window Blinds in Aurora, IL', $meta_description, SITE_URL . '/window-treatments/window-blinds/'),
    cbd_itemlist_schema($itemlist_items),
    cbd_faq_schema($faqs),
    cbd_breadcrumb_schema($crumbs),
]);

$lcp_image        = BASE_URL . '/assets/products/horizontal_blinds/Ultimate Fauxwood Blinds/01-Ultimate-Blinds.jpg';
$lcp_image_mobile = BASE_URL . '/assets/products/horizontal_blinds/Ultimate Fauxwood Blinds/01-Ultimate-Blinds_m.webp';

require_once ROOT_PATH . '/includes/header.php';

if (!function_exists('encodeImagePath')) {
    function encodeImagePath($path) {
        return BASE_URL . '/' . implode('/', array_map('rawurlencode', explode('/', $path)));
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
                      url('<?php echo encodeImagePath('assets/products/horizontal_blinds/Ultimate Fauxwood Blinds/01-Ultimate-Blinds.jpg'); ?>');
    background-size: cover;
    background-position: center;
}
@media (max-width: 991px) {
    .page-header-bg {
        background-image: linear-gradient(rgba(63,61,61,0.52), rgba(63,61,61,0.52)),
                          url('<?php echo encodeImagePath('assets/products/horizontal_blinds/Ultimate Fauxwood Blinds/01-Ultimate-Blinds_m.webp'); ?>');
    }
}
</style>
<section class="page-header page-header-bg"
    style="color: white; padding: 60px 20px; text-align: center;">
    <div class="container">
        <h1 style="color: white; margin-bottom: 15px;">Custom Window Blinds in Aurora, Naperville & the Fox Valley</h1>
        <p style="font-size: 1.2rem; color: rgba(255,255,255,0.95); max-width: 760px; margin: 0 auto;">Shop faux wood blinds, vertical blinds and aluminum blinds from Norman Window Fashions, professionally measured and installed in Aurora, IL. Every order includes a free in-home consultation, custom fabrication and expert blind installation backed by 23 years of experience through Creative Floors Inc.</p>
    </div>
</section>

<?php require ROOT_PATH . '/includes/breadcrumbs.php'; ?>

<?php include ROOT_PATH . '/includes/compact-form.php'; ?>

<!-- Trust Bar -->
<section style="padding: 40px 20px 0;">
    <div class="container">
        <div class="trust-bar">
            <div class="trust-chip">5 Blind Styles</div>
            <div class="trust-chip">Inside Mount Available</div>
            <div class="trust-chip">Cordless &amp; Motorized</div>
            <div class="trust-chip">Installation Included</div>
        </div>
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
            <input type="text" id="productSearch" placeholder="Search blinds by name..."
                style="width: 100%; padding: 14px 20px; border: 2px solid var(--border-color); border-radius: 4px; font-size: 1rem; font-family: var(--font-primary);">
        </div>

        <!-- Tab Content Panels -->
        <?php $tabIndex = 0; foreach ($tabs as $key => $tab): ?>
            <?php if (empty($tab['products'])) { $tabIndex++; continue; } ?>
            <div class="tab-content <?php echo $tabIndex === 0 ? 'active' : ''; ?>"
                id="<?php echo $key; ?>-content"
                style="display: <?php echo $tabIndex === 0 ? 'block' : 'none'; ?>;">
                <?php if (!empty($spokeLinks[$key])): ?>
                    <p style="margin-bottom: 24px; font-size: 1rem;">
                        <a href="<?php echo url($spokeLinks[$key]['url']); ?>" style="color: var(--primary-teal); font-weight: 600;">Learn more about <?php echo htmlspecialchars($spokeLinks[$key]['label']); ?> &rarr;</a>
                    </p>
                <?php endif; ?>
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
                                    <div><strong>Colors:</strong> <?php echo htmlspecialchars(implode(', ', $product['colors'])); ?></div>
                                    <?php if (!empty($product['slat_sizes'])): ?>
                                        <div><strong>Slat Sizes:</strong> <?php echo htmlspecialchars(implode(', ', $product['slat_sizes'])); ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($product['vane_width'])): ?>
                                        <div><strong>Vane Width:</strong> <?php echo htmlspecialchars(implode(', ', $product['vane_width'])); ?></div>
                                    <?php endif; ?>
                                    <div><strong>Materials:</strong> <?php echo htmlspecialchars(implode(', ', $product['materials'])); ?></div>
                                    <div><strong>Lift Options:</strong> <?php echo htmlspecialchars(implode(', ', $product['lift_options'])); ?></div>
                                </div>

                                <div style="display: flex; gap: 10px;">
                                    <a href="<?php echo url('/contact/'); ?>#quote-form"
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

<!-- Installation Coverage -->
<section style="padding: 20px 20px 60px; background-color: var(--warm-cream);">
    <div class="container">
        <div class="section-header">
            <h2>What Our Blind Installation Covers</h2>
            <p>Professional measuring and fitting is included with every order.</p>
        </div>
        <div class="compare-table-wrap" style="margin-top: 30px;">
            <table class="compare-table">
                <thead>
                    <tr><th>Installation Step</th><th>What It Covers</th></tr>
                </thead>
                <tbody>
                    <tr><td>Pre-installation measurement</td><td>Exact measuring of every window for inside or outside mount before fabrication.</td></tr>
                    <tr><td>Mounting faux wood blinds</td><td>Secure, level bracket mounting into the frame or wall for a gap-free fit.</td></tr>
                    <tr><td>Faux wood blinds inside mount</td><td>Recess-depth check and flush inside fitting where the window allows.</td></tr>
                    <tr><td>Vertical blinds installation</td><td>Headrail mounting and vane hanging across patio doors and wide windows.</td></tr>
                    <tr><td>Motorized blind setup</td><td>Motor fitting, Norman Hub pairing and Alexa / Google Home testing.</td></tr>
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
            <p>Every category includes free consultation, custom fabrication and professional installation.</p>
        </div>
        <div class="grid-4" style="margin-top: 40px;">
            <div style="text-align: center;">
                <h3 style="margin-bottom: 10px;">Shutters</h3>
                <p style="color: var(--text-gray); margin-bottom: 15px;">7 collections: wood, composite &amp; motorized interior shutters.</p>
                <a href="<?php echo url('/window-treatments/window-shutters/'); ?>" class="btn btn-primary">Browse custom shutters</a>
            </div>
            <div style="text-align: center;">
                <h3 style="margin-bottom: 10px;">Shades</h3>
                <p style="color: var(--text-gray); margin-bottom: 15px;">Honeycomb, roller, roman &amp; sheer shades. Cordless &amp; motorized.</p>
                <a href="<?php echo url('/window-treatments/shades/'); ?>" class="btn btn-primary">Browse custom shades</a>
            </div>
            <div style="text-align: center;">
                <h3 style="margin-bottom: 10px;">Drapes &amp; Curtains</h3>
                <p style="color: var(--text-gray); margin-bottom: 15px;">70+ drapery fabrics and 54 sheers, made to measure.</p>
                <a href="<?php echo url('/window-treatments/curtains-and-drapes/'); ?>" class="btn btn-primary">Browse drapes &amp; curtains</a>
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
        <h2>Ready to Find Your Perfect Blinds?</h2>
        <p>Schedule a free in-home consultation. We'll bring samples directly to you!</p>
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
            // Reset search when switching tabs
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
require_once ROOT_PATH . '/includes/footer.php';
?>
