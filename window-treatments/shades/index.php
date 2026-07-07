<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';

$page_title = 'Roman, Roller & Honeycomb Shades in Aurora, IL';
$meta_description = 'Shop roman, roller, honeycomb & sheer shades in Aurora, IL. Cordless, motorized & inside-mount options by Norman Window Fashions. Free consultation.';

$shades_json = file_get_contents(ROOT_PATH . '/data/shades.json');
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

// Learn-more links to the dedicated spoke landing pages (two-way hub<->spoke linking).
$spokeLinks = [
    'honeycomb' => ['url' => '/window-treatments/shades/honeycomb-shades/', 'label' => 'honeycomb (cellular) shades'],
    'roller'    => ['url' => '/window-treatments/shades/roller-shades/',    'label' => 'roller shades'],
    'roman'     => ['url' => '/window-treatments/shades/roman-shades/',     'label' => 'roman shades'],
    'sheer'     => ['url' => '/window-treatments/shades/sheer-shades/',      'label' => 'sheer shades'],
];

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Window Treatments', 'path' => '/window-treatments/'],
    ['name' => 'Custom Window Shades'],
];

$faqs = [
    ['q' => 'What is the difference between roman shades and roller shades?',
     'a' => 'Roman shades fold into soft horizontal pleats when raised, creating a fabric stack at the top of the window, and come in flat, hobbled and relaxed fold styles that suit traditional and transitional rooms. Roller shades roll onto a concealed tube for a clean, contemporary profile with no visible folds and cover a wider opacity range from sheer solar fabric to full blackout. Both are available cordless and can be upgraded to motorized operation.'],
    ['q' => 'What are honeycomb shades and why are they energy-efficient?',
     'a' => 'Honeycomb shades are named for the air pockets formed by their cellular fabric. Each pocket traps a layer of air between the glass and the room, insulating against heat in summer and cold in winter. Double-cell shades trap two layers and are ideal for bedrooms and main living areas, while triple-cell models give the maximum insulation. The Portrait Honeycomb collection from Norman Window Fashions offers single, double and triple cell with over 500 fabric choices across light-filtering, room-darkening and blackout opacities.'],
    ['q' => 'Can roman shades be installed inside the window frame?',
     'a' => 'Yes. Inside mount is available on all Centerpiece Roman Shade configurations provided the window recess is deep enough for the mounting hardware. Our installer checks inside-mount depth during the pre-installation measurement visit. If the recess is too shallow, we recommend an outside mount that covers the frame for a clean finish. The written quote at your free in-home consultation specifies the mount type.'],
    ['q' => 'What are smart roman shades and motorized roller shades for large windows?',
     'a' => 'Smart shades use the Norman ShadeAuto motorization system to raise and lower by app, remote, schedule or voice command. The same system powers motorized roller shades and honeycomb shades. For large windows, the ShadeAuto motor handles spans that are hard to operate by hand, and the Norman Hub app controls every shade in a room from one schedule. Amazon Alexa and Google Home are both compatible, and our installer pairs and configures everything at the appointment.'],
    ['q' => 'Do you install honeycomb shades in Naperville, Oswego and Yorkville?',
     'a' => 'Yes. Honeycomb shades, and every other shade type, are installed across our full service area: Aurora, Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles and Plainfield. Every installation includes the free pre-installation measurement visit and professional mounting.'],
    ['q' => 'How much do custom roman shades cost in Aurora, IL?',
     'a' => 'Pricing depends on your fabric choice, window width and drop, and whether you choose cordless or motorized operation. The most accurate figure comes from your free in-home consultation, where we measure every window and provide an itemised written quote with no obligation.'],
];

// ItemList of the shade collections (data-driven from the loaded catalog).
$itemlist_items = array_map(fn($p) => [
    'name'        => $p['name'],
    'description' => $p['description'] ?? '',
    'url'         => SITE_URL . '/window-treatments/shades/',
], $shades_products);

require_once ROOT_PATH . '/includes/spoke-schema.php';
$page_schema_json = spoke_schema_graph([
    cbd_service_schema('Custom Window Shade Installation', 'Custom Window Shades in Aurora, IL', $meta_description, SITE_URL . '/window-treatments/shades/'),
    cbd_itemlist_schema($itemlist_items),
    cbd_faq_schema($faqs),
    cbd_breadcrumb_schema($crumbs),
]);

$lcp_image        = BASE_URL . '/assets/products/honeycomb/Portrait Honeycomb/01-Honeycomb.jpg';
$lcp_image_mobile = BASE_URL . '/assets/products/honeycomb/Portrait Honeycomb/01-Honeycomb_m.webp';

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
                      url('<?php echo encodeImagePath('assets/products/honeycomb/Portrait Honeycomb/01-Honeycomb.jpg'); ?>');
    background-size: cover;
    background-position: center;
}
@media (max-width: 991px) {
    .page-header-bg {
        background-image: linear-gradient(rgba(63,61,61,0.52), rgba(63,61,61,0.52)),
                          url('<?php echo encodeImagePath('assets/products/honeycomb/Portrait Honeycomb/01-Honeycomb_m.webp'); ?>');
    }
}
</style>
<section class="page-header page-header-bg"
    style="color: white; padding: 60px 20px; text-align: center;">
    <div class="container">
        <h1 style="color: white; margin-bottom: 15px;">Custom Roman, Roller & Honeycomb Shades in Aurora, Naperville & the Fox Valley</h1>
        <p style="font-size: 1.2rem; color: rgba(255,255,255,0.95); max-width: 760px; margin: 0 auto;">Shop roman shades, roller shades, honeycomb shades and sheer shades from Norman Window Fashions, professionally measured and installed across Aurora, Naperville and the Fox Valley. Every order includes a free in-home consultation, exact-fit fabrication and shade installation backed by 23 years of experience through Creative Floors Inc.</p>
    </div>
</section>

<?php require ROOT_PATH . '/includes/breadcrumbs.php'; ?>

<?php include ROOT_PATH . '/includes/compact-form.php'; ?>

<!-- Trust Bar -->
<section style="padding: 40px 20px 0;">
    <div class="container">
        <div class="trust-bar">
            <div class="trust-chip">6 Shade Collections</div>
            <div class="trust-chip">Cordless &amp; Motorized</div>
            <div class="trust-chip">Inside Mount Available</div>
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
            <input type="text" id="productSearch" placeholder="Search shades by name..."
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

<!-- Quick-Select Guide -->
<section style="padding: 20px 20px 60px; background-color: var(--warm-cream);">
    <div class="container">
        <div class="section-header">
            <h2>Choose the Right Shade: Quick-Select Guide</h2>
            <p>Match your room need to the right shade type before your consultation.</p>
        </div>
        <div class="compare-table-wrap" style="margin-top: 30px;">
            <table class="compare-table">
                <thead>
                    <tr><th>Room / Need</th><th>Best Shade Type</th><th>Key Feature</th><th>Lift Options</th></tr>
                </thead>
                <tbody>
                    <tr><td>Bedroom: full blackout</td><td>Centerpiece Roman or Soluna Roller</td><td>Blackout opacity blocks all light</td><td>Cordless or motorized</td></tr>
                    <tr><td>Living room: soft light</td><td>PerfectSheer or Centerpiece Roman</td><td>Diffused natural light with privacy</td><td>Cordless or motorized</td></tr>
                    <tr><td>Kitchen: moisture-resistant</td><td>Portrait Honeycomb single cell</td><td>Moisture-tolerant cellular fabric</td><td>SmartRise cordless</td></tr>
                    <tr><td>Nursery: child safety</td><td>San Clemente Cordless Honeycomb</td><td>No cords, SmartRise operation</td><td>Cordless only</td></tr>
                    <tr><td>Large window or patio door</td><td>Vertical Honeycomb or Soluna Roller</td><td>Wide coverage, stacks to the side</td><td>Wand or motorized</td></tr>
                    <tr><td>Home office: glare control</td><td>Soluna Roller (solar fabric)</td><td>Solar weave reduces glare, keeps view</td><td>Cordless or motorized</td></tr>
                    <tr><td>Energy saving: all rooms</td><td>Portrait Honeycomb double or triple cell</td><td>Air-pocket insulation cuts heating bills</td><td>SmartRise or ShadeAuto motorized</td></tr>
                    <tr><td>Smart-home integration</td><td>Soluna Roller or Portrait Honeycomb</td><td>ShadeAuto + Alexa / Google Home</td><td>Motorized with Norman Hub</td></tr>
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
            <p>Shades layer beautifully with shutters and drapes. Every category includes free consultation, custom fabrication and professional installation.</p>
        </div>
        <div class="grid-4" style="margin-top: 40px;">
            <div style="text-align: center;">
                <h3 style="margin-bottom: 10px;">Shutters</h3>
                <p style="color: var(--text-gray); margin-bottom: 15px;">7 collections: wood, composite &amp; motorized interior shutters.</p>
                <a href="<?php echo url('/window-treatments/window-shutters/'); ?>" class="btn btn-primary">Browse custom shutters</a>
            </div>
            <div style="text-align: center;">
                <h3 style="margin-bottom: 10px;">Blinds</h3>
                <p style="color: var(--text-gray); margin-bottom: 15px;">Faux wood, real wood, aluminum &amp; vertical blinds. Cordless &amp; motorized.</p>
                <a href="<?php echo url('/window-treatments/window-blinds/'); ?>" class="btn btn-primary">Browse custom blinds</a>
            </div>
            <div style="text-align: center;">
                <h3 style="margin-bottom: 10px;">Drapes &amp; Curtains</h3>
                <p style="color: var(--text-gray); margin-bottom: 15px;">70+ drapery fabrics, 54 sheers. Layer with sheer shades for a designer finish.</p>
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
        <h2>Ready to Find Your Perfect Shades?</h2>
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
