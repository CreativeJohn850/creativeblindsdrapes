<?php
require_once dirname(__DIR__) . '/includes/config.php';

$page_title = 'Custom Window Treatments in Aurora & Naperville, IL';
$meta_description = 'Custom window treatments in Aurora, IL: blinds, shades, shutters & drapes with expert installation. Free in-home consultation. Call (630) 946-1406.';

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Custom Window Treatments'],
];

$faqs = [
    ['q' => 'What are custom window treatments and why do they cost more than ready-made?',
     'a' => 'Custom window treatments are fabricated to the exact measurements of each window rather than cut to standard stock sizes. The price reflects precise custom cutting, professional installation and a manufacturer warranty, which together give a better fit, a longer life and a cleaner finished look than ready-made products.'],
    ['q' => 'How much do custom window treatments cost in Aurora, IL?',
     'a' => 'Cost varies by product type, window size and options such as motorization. Rather than quote a generic figure, we measure every window at your free in-home consultation and provide an itemised written quote with no obligation, so you know the full price before you order.'],
    ['q' => 'What does professional window treatment installation include?',
     'a' => 'Installation covers precise measuring, delivery, secure and level mounting, any motorization programming and a walkthrough of how to operate your treatments. There are no hidden labour or fitting charges, the price you are quoted is the price you pay.'],
    ['q' => 'How long does window treatment installation take?',
     'a' => 'Most installations take one to three hours depending on the number of windows, and motorized treatments add roughly 30 to 60 minutes per room for pairing and testing. We confirm the appointment length when your custom order arrives.'],
    ['q' => 'Do you offer motorized window treatments in Naperville and the surrounding area?',
     'a' => 'Yes. Motorized blinds, shades, shutters and drapery are available across our full service area using Norman ShadeAuto, PerfectTilt and Woodlore Plus systems, with Amazon Alexa, Google Home and the Norman Hub app for voice and schedule control.'],
    ['q' => 'Can you fit custom window treatments in unusual window shapes?',
     'a' => 'Yes. Norman Specialty Shapes cover arched, circular, triangular and angled windows. We assess the opening during your in-home measurement and recommend the best custom solution for the shape.'],
    ['q' => 'What is the lead time for custom window treatments?',
     'a' => 'Typical lead times are about three to five weeks for shades and four to six weeks for shutters, since each order is custom fabricated. We confirm the timeline for your specific products at the consultation.'],
    ['q' => 'Is a free consultation really free, with no pressure?',
     'a' => 'Yes. The in-home consultation is genuinely free with no fees and no obligation. We bring samples to your home, measure your windows and leave you with a written quote, and there is never any pressure to buy.'],
];

// ItemList of the four product categories.
$itemlist_items = [
    ['name' => 'Custom Shutters', 'description' => 'Composite, wood and specialty-shape interior shutters, including motorized PerfectTilt, across 7 Norman collections.', 'url' => SITE_URL . '/window-treatments/window-shutters/'],
    ['name' => 'Custom Blinds', 'description' => 'Faux wood, real wood, aluminum and vertical blinds with cordless and motorized options.', 'url' => SITE_URL . '/window-treatments/window-blinds/'],
    ['name' => 'Custom Shades', 'description' => 'Honeycomb, roller, roman and sheer shades with triple-cell insulation, blackout and motorized options.', 'url' => SITE_URL . '/window-treatments/shades/'],
    ['name' => 'Custom Drapes & Curtains', 'description' => '70+ drapery fabrics and 54 sheers, made to measure, with motorized track available.', 'url' => SITE_URL . '/window-treatments/curtains-and-drapes/'],
];

require_once ROOT_PATH . '/includes/spoke-schema.php';
$page_schema_json = spoke_schema_graph([
    cbd_service_schema('Custom Window Treatment Installation', 'Custom Window Treatments in Aurora, IL', $meta_description, SITE_URL . '/window-treatments/'),
    cbd_itemlist_schema($itemlist_items),
    cbd_faq_schema($faqs),
    cbd_breadcrumb_schema($crumbs),
]);

require_once ROOT_PATH . '/includes/header.php';
?>

<!-- Page Header -->
<section class="page-header"
    style="background: linear-gradient(135deg, var(--primary-teal) 0%, var(--primary-teal-dark) 100%); color: white; padding: 60px 20px; text-align: center;">
    <div class="container">
        <h1 style="color: white; margin-bottom: 15px;">Custom Window Treatments in Aurora, Naperville & Surrounding IL Communities</h1>
        <p style="font-size: 1.2rem; color: rgba(255,255,255,0.95); max-width: 800px; margin: 0 auto;">
            Creative Blinds &amp; Drapes is Aurora's locally trusted window treatment store, serving homeowners across the Fox Valley for over 23 years. We supply, design and install custom blinds, shades, shutters and drapes, backed by full professional installation and a free in-home design consultation. You choose. We handle the rest.
        </p>
    </div>
</section>

<?php require ROOT_PATH . '/includes/breadcrumbs.php'; ?>

<?php include ROOT_PATH . '/includes/compact-form.php'; ?>

<!-- Why Choose Us -->
<section style="padding: 60px 20px 20px;">
    <div class="container">
        <div class="section-header">
            <h2>Why Aurora & Naperville Homeowners Choose Creative Blinds & Drapes</h2>
            <p>Family-owned and locally trusted: not a franchise or big-box counter.</p>
        </div>
        <div class="grid-4" style="margin-top: 40px;">
            <div class="trust-chip">Free In-Home Consultation</div>
            <div class="trust-chip">Professional Installation Included</div>
            <div class="trust-chip">Norman Window Fashions Dealer</div>
            <div class="trust-chip">23 Years of Experience</div>
        </div>
    </div>
</section>

<!-- Category Cards -->
<section style="padding: 40px 20px;">
    <div class="container">
        <div class="section-header">
            <h2>Complete Custom Window Treatment Services</h2>
            <p>Four product categories, all with free consultation, custom fabrication and installation.</p>
        </div>
        <div class="grid-4" style="margin-top: 40px;">
            <div style="text-align: center;">
                <h3 style="margin-bottom: 10px;">Custom Shutters</h3>
                <p style="color: var(--text-gray); margin-bottom: 15px;">Composite, wood and specialty shapes across 7 Norman collections, including motorized PerfectTilt.</p>
                <a href="<?php echo url('/window-treatments/window-shutters/'); ?>" class="btn btn-primary">Explore shutters</a>
            </div>
            <div style="text-align: center;">
                <h3 style="margin-bottom: 10px;">Custom Blinds</h3>
                <p style="color: var(--text-gray); margin-bottom: 15px;">Faux wood, real wood, aluminum and vertical blinds. Cordless, motorized and Best for Kids certified.</p>
                <a href="<?php echo url('/window-treatments/window-blinds/'); ?>" class="btn btn-primary">Explore blinds</a>
            </div>
            <div style="text-align: center;">
                <h3 style="margin-bottom: 10px;">Custom Shades</h3>
                <p style="color: var(--text-gray); margin-bottom: 15px;">Honeycomb, roller, roman and sheer shades with triple-cell insulation, blackout and motorized options.</p>
                <a href="<?php echo url('/window-treatments/shades/'); ?>" class="btn btn-primary">Explore shades</a>
            </div>
            <div style="text-align: center;">
                <h3 style="margin-bottom: 10px;">Custom Drapes & Curtains</h3>
                <p style="color: var(--text-gray); margin-bottom: 15px;">70+ drapery fabrics and 54 sheers with 118-inch panel widths and motorized drapery track.</p>
                <a href="<?php echo url('/window-treatments/curtains-and-drapes/'); ?>" class="btn btn-primary">Explore drapes</a>
            </div>
        </div>
    </div>
</section>

<!-- Motorization -->
<section style="padding: 40px 20px; background-color: var(--warm-cream);">
    <div class="container">
        <div class="section-header">
            <h2>Motorized Window Treatments: Smart Control for Every Room</h2>
            <p>Control shades, blinds, shutters and drapery by app, remote, schedule or voice.</p>
        </div>
        <div class="compare-table-wrap" style="margin-top: 30px;">
            <table class="compare-table">
                <thead>
                    <tr><th>Platform</th><th>Compatible Products</th><th>How It Works</th></tr>
                </thead>
                <tbody>
                    <tr><td>Amazon Alexa / Google Home</td><td>ShadeAuto roller &amp; honeycomb shades, PerfectTilt shutters</td><td>Voice commands and smart-home scenes via the Norman Hub</td></tr>
                    <tr><td>Norman Hub App</td><td>PerfectTilt, Woodlore Plus, Soluna Roller</td><td>Schedule, timer and remote control from your phone</td></tr>
                    <tr><td>SmartDial Remote</td><td>Woodlore Plus, Soluna Roller</td><td>Battery operation with no hub required</td></tr>
                    <tr><td>Motorized Drapes</td><td>Custom drapery panels on a motorized track</td><td>Touch, app or voice control of opening and closing</td></tr>
                </tbody>
            </table>
        </div>
        <p style="text-align: center; margin-top: 24px;">
            <a href="<?php echo url('/window-treatments/motorized-window-treatment/'); ?>" class="btn btn-primary">Explore motorized window treatments</a>
        </p>
    </div>
</section>

<!-- Installation Process -->
<section style="padding: 60px 20px;">
    <div class="container">
        <div class="section-header">
            <h2>How Our Window Treatment Installation Process Works</h2>
            <p>One company, one contact, from first consultation to finished window.</p>
        </div>
        <div class="compare-table-wrap" style="margin-top: 30px;">
            <table class="compare-table">
                <thead>
                    <tr><th>Step</th><th>What Happens</th><th>Your Role</th></tr>
                </thead>
                <tbody>
                    <tr><td>1. Free Consultation</td><td>We bring samples to your home and discuss your rooms and goals.</td><td>Share your ideas and preferences.</td></tr>
                    <tr><td>2. In-Home Measurement</td><td>We measure every window precisely for an exact-fit order.</td><td>Nothing: we handle the measuring.</td></tr>
                    <tr><td>3. Quotation</td><td>You receive an itemised written quote with no hidden charges.</td><td>Review and approve the quote.</td></tr>
                    <tr><td>4. Order Placed</td><td>Your treatments are custom fabricated to your measurements.</td><td>Relax while your order is made.</td></tr>
                    <tr><td>5. Installation Day</td><td>We mount, level, program and test every treatment.</td><td>Enjoy a clean, tidy workspace.</td></tr>
                </tbody>
            </table>
        </div>
        <p style="text-align: center; margin-top: 24px;">
            <a href="<?php echo url('/window-treatments/window-treatment-installer/'); ?>" class="btn btn-primary">About our installation service</a>
        </p>
    </div>
</section>

<!-- Service Area -->
<section style="padding: 40px 20px; background-color: var(--warm-cream);">
    <div class="container">
        <div class="section-header">
            <h2>Serving Aurora, Naperville & the Fox Valley Region</h2>
            <p>Local installation across our 20-mile service area, with no travel charges.</p>
        </div>
        <div class="compare-table-wrap" style="margin-top: 30px;">
            <table class="compare-table">
                <thead>
                    <tr><th>City</th><th>Coverage</th></tr>
                </thead>
                <tbody>
                    <tr><td>Aurora</td><td>Home base, full service area</td></tr>
                    <tr><td>Naperville</td><td>Full service area</td></tr>
                    <tr><td>Oswego</td><td>Full service area</td></tr>
                    <tr><td>Yorkville</td><td>Full service area</td></tr>
                    <tr><td>Batavia</td><td>Full service area</td></tr>
                    <tr><td>Geneva</td><td>Full service area</td></tr>
                    <tr><td>St. Charles</td><td>Full service area</td></tr>
                    <tr><td>Plainfield</td><td>Full service area</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- What Sets Us Apart -->
<section style="padding: 60px 20px;">
    <div class="container">
        <div class="section-header">
            <h2>What Sets Creative Blinds & Drapes Apart</h2>
            <p>A local specialist, not a franchise or big-box counter.</p>
        </div>
        <div class="compare-table-wrap" style="margin-top: 30px;">
            <table class="compare-table">
                <thead>
                    <tr><th>Feature</th><th>Creative Blinds & Drapes</th><th>National Franchises</th><th>Big-Box Retailers</th></tr>
                </thead>
                <tbody>
                    <tr><td>Free in-home measurement</td><td>Yes</td><td>Sometimes</td><td>Rarely</td></tr>
                    <tr><td>Professional installation included</td><td>Yes</td><td>Extra charge</td><td>Sub-contracted</td></tr>
                    <tr><td>Local, family-owned</td><td>Yes, 23 years</td><td>No</td><td>No</td></tr>
                    <tr><td>Norman Window Fashions line</td><td>Yes</td><td>Varies</td><td>Limited</td></tr>
                    <tr><td>Motorization setup &amp; training</td><td>Yes</td><td>Varies</td><td>No</td></tr>
                    <tr><td>Same company sells &amp; installs</td><td>Yes</td><td>No</td><td>No</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php require ROOT_PATH . '/includes/faq-section.php'; ?>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to See Custom Window Treatments in Your Home?</h2>
        <p>Free consultation. No obligation. Professional installation included on every order.</p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-top: 30px;">
            <a href="<?php echo url('/contact/'); ?>#quote-form" class="btn btn-primary">Request Free Consultation</a>
            <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" onclick="dataLayer.push({'event': 'phone_click'});" class="btn btn-secondary"
                style="background-color: transparent; color: white; border-color: white;">
                Call <?php echo BUSINESS_PHONE; ?>
            </a>
        </div>
    </div>
</section>

<?php
require_once ROOT_PATH . '/includes/footer.php';
?>
