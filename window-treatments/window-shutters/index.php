<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';

$page_title = 'Custom Wood Shutters in Aurora & Naperville, IL';
$meta_description = 'Shop custom wood & composite interior shutters in Aurora, IL. Real wood, composite & motorized styles by Norman Window Fashions. Free consultation.';

$shutters_json = file_get_contents(ROOT_PATH . '/data/shutters.json');
$shutters_products = json_decode($shutters_json, true);

if (json_last_error() !== JSON_ERROR_NONE || !is_array($shutters_products)) {
    $shutters_products = [];
}

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Window Treatments', 'path' => '/window-treatments/'],
    ['name' => 'Custom Shutters'],
];

$faqs = [
    ['q' => 'What is the difference between custom wood shutters and composite shutters?',
     'a' => 'Custom wood shutters (our Brightwood and Normandy collections) are milled from real hardwood for a premium look and are best in low-humidity rooms such as living rooms, bedrooms and studies. Composite shutters (Woodlore and Woodlore Plus) use a moisture-resistant polymer that will not warp or crack, which makes them ideal for kitchens, bathrooms and laundry rooms.'],
    ['q' => 'What louver sizes are available for custom shutters?',
     'a' => 'We offer 2.5-inch, 3.5-inch and 4.5-inch louvers. The 3.5-inch louver is the most popular all-round size, while the 4.5-inch louver gives the clearest view and most light when open. We bring samples so you can compare sizes on your own windows during the consultation.'],
    ['q' => 'Are custom shutters available with motorized control?',
     'a' => 'Yes. The patented PerfectTilt system adds hidden motorized louver control with no visible tilt rod, and works across the shutter collections. It pairs with the Norman Hub app, SmartDial remote and Amazon Alexa or Google Home. Our installer configures and tests the motorization at the installation appointment.'],
    ['q' => 'Do you install custom shutters in Naperville and surrounding areas?',
     'a' => 'Yes. We install shutters across our full service area: Aurora, Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles and Plainfield. Every job includes a free in-home measure and professional mounting, with no hidden labour charges.'],
    ['q' => 'How do shutters differ from window blinds?',
     'a' => 'Shutters are a solid, framed panel with tilting louvers that is fixed to the window, giving an architectural, built-in look that can add resale value. Blinds are slats that raise and lower on a cord or wand, offer a wider opacity range and a lower entry cost, and are quicker to install. Many homeowners use shutters in key rooms and blinds elsewhere.'],
    ['q' => 'How much do custom interior shutters cost in Aurora, IL?',
     'a' => 'Pricing depends on whether you choose composite or real wood, the collection, louver size, any specialty shapes and whether you add motorization. The most accurate figure comes from your free in-home consultation, where we measure each window and provide an itemised written quote with no obligation.'],
];

// ItemList of the shutter collections (data-driven from the loaded catalog).
$itemlist_items = array_map(fn($p) => [
    'name'        => $p['name'],
    'description' => $p['description'] ?? '',
    'url'         => SITE_URL . '/window-treatments/window-shutters/',
], $shutters_products);

require_once ROOT_PATH . '/includes/spoke-schema.php';
$page_schema_json = spoke_schema_graph([
    cbd_service_schema('Custom Shutter Installation', 'Custom Window Shutters in Aurora, IL', $meta_description, SITE_URL . '/window-treatments/window-shutters/'),
    cbd_itemlist_schema($itemlist_items),
    cbd_faq_schema($faqs),
    cbd_breadcrumb_schema($crumbs),
]);

$lcp_image        = BASE_URL . '/assets/products/shutters/Woodlore/01-Woodlore.jpg';
$lcp_image_mobile = BASE_URL . '/assets/products/shutters/Woodlore/01-Woodlore_m.webp';

require_once ROOT_PATH . '/includes/header.php';

function encodeImagePath($path) {
    return BASE_URL . '/' . implode('/', array_map('rawurlencode', explode('/', $path)));
}
function thumbPath($path) {
    return substr($path, 0, strrpos($path, '.')) . '_thumb.webp';
}
?>
<!-- Page Header -->
<style>
.page-header-bg {
    background-image: linear-gradient(rgba(63,61,61,0.52), rgba(63,61,61,0.52)),
                      url('<?php echo BASE_URL; ?>/assets/products/shutters/Woodlore/01-Woodlore.jpg');
    background-size: cover;
    background-position: center;
}
@media (max-width: 991px) {
    .page-header-bg {
        background-image: linear-gradient(rgba(63,61,61,0.52), rgba(63,61,61,0.52)),
                          url('<?php echo BASE_URL; ?>/assets/products/shutters/Woodlore/01-Woodlore_m.webp');
    }
}
</style>
<section class="page-header page-header-bg"
    style="color: white; padding: 60px 20px; text-align: center;">
    <div class="container">
        <h1 style="color: white; margin-bottom: 15px;">Custom Wood & Interior Shutters in Aurora, Naperville & the Fox Valley</h1>
        <p style="font-size: 1.2rem; color: rgba(255,255,255,0.95); max-width: 760px; margin: 0 auto;">Shop custom wood shutters and interior shutters from seven Norman Window Fashions collections, professionally measured and installed across Aurora, Naperville and the Fox Valley. Every order includes a free in-home consultation, exact-fit fabrication and professional installation backed by 23 years of experience through Creative Floors Inc.</p>
    </div>
</section>

<?php require ROOT_PATH . '/includes/breadcrumbs.php'; ?>

<?php include ROOT_PATH . '/includes/compact-form.php'; ?>

<!-- Trust Bar -->
<section style="padding: 40px 20px 0;">
    <div class="container">
        <div class="trust-bar">
            <div class="trust-chip">7 Shutter Collections</div>
            <div class="trust-chip">Real Wood &amp; Composite</div>
            <div class="trust-chip">Motorized Smart-Home</div>
            <div class="trust-chip">Installation Included</div>
        </div>
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

    </div>
</section>

<!-- Wood vs Composite -->
<section style="padding: 20px 20px 60px; background-color: var(--warm-cream);">
    <div class="container">
        <div class="section-header">
            <h2>Custom Wood Shutters vs Composite: Which Is Right for You?</h2>
            <p>Compare our real-wood and composite collections before your consultation.</p>
        </div>
        <div class="compare-table-wrap" style="margin-top: 30px;">
            <table class="compare-table">
                <thead>
                    <tr><th>Property</th><th>Custom Wood (Brightwood &amp; Normandy)</th><th>Composite (Woodlore &amp; Woodlore Plus)</th></tr>
                </thead>
                <tbody>
                    <tr><td>Material</td><td>Real North American hardwood</td><td>Moisture-resistant composite polymer</td></tr>
                    <tr><td>Best rooms</td><td>Living rooms, bedrooms, studies (low humidity)</td><td>Kitchens, baths, laundry (high humidity)</td></tr>
                    <tr><td>Louver sizes</td><td>2.5&quot;, 3.5&quot;, 4.5&quot;</td><td>2.5&quot;, 3.5&quot;, 4.5&quot;</td></tr>
                    <tr><td>Custom finishes</td><td>2,000+ paint colors &amp; 10 stains</td><td>Up to 8 colors</td></tr>
                    <tr><td>Motorization</td><td>PerfectTilt upgrade</td><td>PerfectTilt, SmartDial &amp; Norman Hub</td></tr>
                    <tr><td>Moisture resistance</td><td>Not recommended for wet rooms</td><td>Will not warp in humidity</td></tr>
                    <tr><td>Typical lead time</td><td>4-6 weeks</td><td>3-5 weeks</td></tr>
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
                <h3 style="margin-bottom: 10px;">Blinds</h3>
                <p style="color: var(--text-gray); margin-bottom: 15px;">Faux wood, real wood, aluminum &amp; vertical blinds.</p>
                <a href="<?php echo url('/window-treatments/window-blinds/'); ?>" class="btn btn-primary">Browse custom blinds</a>
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
        <h2>Ready to Transform Your Windows?</h2>
        <p>Schedule a free in-home consultation. We'll bring shutter samples directly to you!</p>
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
require_once ROOT_PATH . '/includes/footer.php';
?>
