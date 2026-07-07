<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';
require_once ROOT_PATH . '/includes/spoke-schema.php';

$page_title       = 'Motorized Window Treatments in Aurora & Naperville';
$meta_description = 'Shop motorized blinds, shades, shutters & drapes in Aurora, IL by Norman Window Fashions. App, voice & remote control. Free in-home consultation.';

$spoke_service_type = 'Motorized Window Treatment Installation';
$spoke_h1           = 'Motorized Window Treatments in Aurora, Naperville & the Fox Valley';
$spoke_path         = '/window-treatments/motorized-window-treatment/';
$spoke_hero_image   = 'assets/products/honeycomb/Portrait Honeycomb/01-Honeycomb.jpg';
$spoke_hero_image_mobile = 'assets/products/honeycomb/Portrait Honeycomb/01-Honeycomb_m.webp';
$spoke_intro        = 'Shop motorized window treatments from Norman Window Fashions, professionally installed across Aurora, Naperville and the Fox Valley. Motorized blinds, shades, shutters and drapes, all controlled by app, remote, schedule or voice through Amazon Alexa and Google Home.';

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Window Treatments', 'path' => '/window-treatments/'],
    ['name' => 'Motorized Window Treatments'],
];

$spoke_sections = [
    ['heading' => '', 'body' => '
        <p>Motorization turns everyday window treatments into effortless ones. Instead of tugging cords on a dozen windows, you raise and lower shades, tilt blinds or shutters, and draw drapery by remote, app, schedule or voice command. For hard-to-reach windows over a staircase or kitchen sink, for large or heavy treatments, and for a cleaner cord-free look, motorized control is a genuine upgrade, and it is the safest option for homes with children and pets. Every motorized order includes full setup by our installer: hub pairing, app configuration, schedule programming and voice-command testing in a single appointment.</p>
        <div class="trust-bar" style="margin-top: 30px;">
            <div class="trust-chip">5 Product Categories</div>
            <div class="trust-chip">Alexa &amp; Google Home</div>
            <div class="trust-chip">Battery or Hardwired</div>
            <div class="trust-chip">Full Setup Included</div>
        </div>'],
    ['heading' => 'Motorized Window Treatments by Product Type', 'body' => '
        <ul style="line-height: 2;">
            <li><strong>Motorized Shades</strong>: Norman ShadeAuto on roller (Soluna), roman (Centerpiece), honeycomb (Portrait, single to triple cell) and sheer (PerfectSheer). Battery or hardwired. <a href="' . url('/window-treatments/shades/') . '">Browse shades</a>.</li>
            <li><strong>Motorized Shutters</strong>: PerfectTilt hidden tilt with no visible rod on Woodlore, Woodlore Plus, Brightwood and Normandy, with SmartDial. <a href="' . url('/window-treatments/window-shutters/') . '">Browse shutters</a>.</li>
            <li><strong>Motorized Blinds</strong>: SmartRise motor on Cordless Fauxwood, Woodlore Plus and Synchrony Vertical. <a href="' . url('/window-treatments/window-blinds/') . '">Browse blinds</a>.</li>
            <li><strong>Motorized Drapes &amp; Curtains</strong>: motorized track for all Fonluk fabrics on panels up to 118 inches wide. <a href="' . url('/window-treatments/curtains-and-drapes/') . '">Browse drapes</a>.</li>
            <li><strong>Norman ShadeAuto Control System</strong>: Hub, iOS/Android app, SmartDial remote, Alexa, Google Home and sunrise/sunset automation.</li>
        </ul>'],
    ['heading' => 'Control Options for Motorized Window Treatments', 'body' => '
        <div class="compare-table-wrap">
            <table class="compare-table">
                <thead><tr><th>Control Method</th><th>Compatible Products</th><th>Requires Hub</th><th>Voice Control</th><th>Best For</th></tr></thead>
                <tbody>
                    <tr><td>Norman App</td><td>All motorized products</td><td>Yes</td><td>Via skill</td><td>Whole-home control</td></tr>
                    <tr><td>SmartDial Remote</td><td>Shades &amp; shutters</td><td>No</td><td>No</td><td>Simple room control</td></tr>
                    <tr><td>Amazon Alexa</td><td>Hub products</td><td>Yes</td><td>Yes</td><td>Voice &amp; scenes</td></tr>
                    <tr><td>Google Home</td><td>Hub products</td><td>Yes</td><td>Yes</td><td>Voice &amp; scenes</td></tr>
                    <tr><td>Sunrise / Sunset Schedule</td><td>Hub products</td><td>Yes</td><td>N/A</td><td>Automatic daily routines</td></tr>
                    <tr><td>Manual SmartDial wall unit</td><td>Shades &amp; shutters</td><td>No</td><td>No</td><td>A permanent switch feel</td></tr>
                </tbody>
            </table>
        </div>'],
    ['heading' => 'Our process', 'body' => '
        <p>At your <strong>free in-home consultation</strong> we show which treatments can be motorized and demonstrate the control options. We <strong>measure precisely</strong>, order your motorized treatments, then <strong>install and program</strong> the motors, hub, remotes and any smart-home integration, testing everything before we leave.</p>'],
];

$browse_url   = '/window-treatments/';
$browse_label = 'Explore all window treatments';

$related_links = [
    ['url' => '/window-treatments/shades/roller-shades/', 'label' => 'Roller shades'],
    ['url' => '/window-treatments/shades/honeycomb-shades/', 'label' => 'Honeycomb shades'],
    ['url' => '/window-treatments/window-treatment-installer/', 'label' => 'Window treatment installation'],
    ['url' => '/service-areas/aurora-il/', 'label' => 'Window treatments in Aurora, IL'],
];

$faqs = [
    ['q' => 'What are motorized window treatments and how do they work?',
     'a' => 'A small motor is built into the headrail or track and moves the treatment on command. Most use rechargeable or AA batteries, so no electrical work is needed for the majority of installations, and you control them by remote, app, schedule or voice.'],
    ['q' => 'Which Norman products are available with motorized control?',
     'a' => 'All five categories: shades (Soluna roller, Centerpiece roman, Portrait honeycomb, PerfectSheer), shutters (PerfectTilt on Woodlore, Woodlore Plus, Brightwood and Normandy), blinds (SmartRise on Cordless Fauxwood, Woodlore Plus and Synchrony vertical), and drapery on a motorized track.'],
    ['q' => 'Do motorized treatments require an electrician or hardwiring?',
     'a' => 'Not for most installations. Norman ShadeAuto and SmartDial systems are battery powered, and the hub simply connects to your Wi-Fi. Hardwired options are available for new construction or remodels if you prefer.'],
    ['q' => 'How does smart-home integration work?',
     'a' => 'The Norman Hub connects your treatments to Amazon Alexa and Google Home through their skills, so you can use voice commands and scenes, and set sunrise/sunset schedules. There is no subscription fee, and we configure the integration during installation.'],
    ['q' => 'Can you install motorized treatments in Naperville, Oswego and Yorkville?',
     'a' => 'Yes. Motorized window treatments are installed across our full 20-mile service area: Aurora, Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles and Plainfield, with no technology or travel fee.'],
    ['q' => 'How much do motorized window treatments cost in Aurora, IL?',
     'a' => 'Cost depends on the product, window size, the motor and whether you add a hub for smart-home control. The most accurate figure comes from your free in-home consultation, where we measure each window and provide an itemised written quote with no obligation.'],
];

// ItemList of the motorized product categories (matches the on-page cards).
$itemlist_items = [
    ['name' => 'Motorized Shades', 'description' => 'Norman ShadeAuto on roller, roman, honeycomb and sheer shades.', 'url' => SITE_URL . '/window-treatments/shades/'],
    ['name' => 'Motorized Shutters', 'description' => 'PerfectTilt hidden-tilt motorization across the shutter collections.', 'url' => SITE_URL . '/window-treatments/window-shutters/'],
    ['name' => 'Motorized Blinds', 'description' => 'SmartRise motor on faux wood, Woodlore Plus and vertical blinds.', 'url' => SITE_URL . '/window-treatments/window-blinds/'],
    ['name' => 'Motorized Drapes & Curtains', 'description' => 'Motorized drapery track for Fonluk fabrics up to 118 inches.', 'url' => SITE_URL . '/window-treatments/curtains-and-drapes/'],
    ['name' => 'Norman ShadeAuto Control System', 'description' => 'Hub, app, SmartDial remote, Alexa, Google Home and automation.', 'url' => SITE_URL . '/window-treatments/motorized-window-treatment/'],
];

$spoke_extra_schema = [
    cbd_itemlist_schema($itemlist_items),
];

$spoke_cta_heading = 'Ready to Automate Your Windows?';
$spoke_cta_text    = 'Schedule a free in-home consultation and see motorized shade, blind, shutter and drapery options in your own home.';

require ROOT_PATH . '/includes/spoke-page.php';
