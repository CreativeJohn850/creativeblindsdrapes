<?php
require_once dirname(__DIR__, 3) . '/includes/config.php';

$page_title       = 'Shutter Installation in Aurora, IL';
$meta_description = 'Professional shutter installation in Aurora, IL. Custom-fit plantation and interior shutters mounted level and square. Free in-home measure and quote.';

$spoke_service_type = 'Shutter Installation';
$spoke_h1           = 'Shutter Installation in Aurora, IL';
$spoke_path         = '/window-treatments/window-treatment-installer/shutter-installer/';
$spoke_hero_image   = 'assets/products/shutters/Woodlore/01-Woodlore.jpg';
$spoke_hero_image_mobile = 'assets/products/shutters/Woodlore/01-Woodlore_m.webp';
$spoke_intro        = 'Custom shutters are built into the window, so fit is everything. Our Aurora team measures and mounts plantation and interior shutters square and true.';

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Window Treatments', 'path' => '/window-treatments/'],
    ['name' => 'Window Treatment Installer', 'path' => '/window-treatments/window-treatment-installer/'],
    ['name' => 'Shutter Installation'],
];

$spoke_sections = [
    ['heading' => '', 'body' => '
        <p>Shutters are the most permanent, built-in window treatment, effectively a piece of custom cabinetry framed into your window. That makes professional installation essential. The frame has to sit square in the opening, the panels must swing and latch cleanly, and the louvers need to tilt evenly across every panel. Creative Blinds &amp; Drapes measures and installs each shutter so it looks like it was original to the house.</p>
        <p>We install plantation and interior shutters throughout Aurora and the surrounding communities.</p>'],
    ['heading' => 'What our shutter installation includes', 'body' => '
        <ul style="line-height: 2;">
            <li>Detailed measuring of each opening, including out-of-square windows</li>
            <li>Custom frame fitting for a built-in look</li>
            <li>Level, secure mounting so panels swing and latch true</li>
            <li>Even louver tilt across all panels</li>
            <li>Cleanup and haul-away of packaging</li>
        </ul>'],
    ['heading' => 'Our process', 'body' => '
        <p>We begin with a <strong>free in-home consultation</strong> to choose your shutter style and finish. We <strong>measure meticulously</strong>, build your custom shutters, and return to <strong>install and adjust</strong> every panel and louver. See the styles first on our <a href="' . url('/window-treatments/window-shutters/') . '">window shutters page</a>.</p>'],
];

$browse_url   = '/window-treatments/window-shutters/';
$browse_label = 'Browse our shutter collection';

$related_links = [
    ['url' => '/window-treatments/window-shutters/', 'label' => 'Window shutters'],
    ['url' => '/window-treatments/window-blinds/', 'label' => 'Window blinds'],
    ['url' => '/window-treatments/window-treatment-installer/', 'label' => 'All window treatment installation'],
    ['url' => '/service-areas/aurora-il/', 'label' => 'Window treatments in Aurora, IL'],
];

$faqs = [
    ['q' => 'Why do shutters need professional installation?',
     'a' => 'Shutters are built into the window frame, so the frame must sit square and the panels must swing and latch cleanly. Professional measuring and mounting ensures a tight, built-in look and smooth operation that do-it-yourself installation rarely achieves.'],
    ['q' => 'Can you install shutters on out-of-square or older windows?',
     'a' => 'Yes. During measuring we account for openings that are not perfectly square, which is common in older homes, and fit the custom frame accordingly so the shutters still look and operate correctly.'],
    ['q' => 'How long does shutter installation take?',
     'a' => 'Most shutter installations are completed in a single visit, though the time depends on the number and size of the windows. We confirm the schedule when your custom shutters arrive.'],
    ['q' => 'Which areas do you install shutters in?',
     'a' => 'We install shutters in Aurora, Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles, and Plainfield.'],
];

$spoke_cta_heading = 'Ready to Add Custom Shutters?';
$spoke_cta_text    = 'Schedule a free in-home consultation and let our team measure and install your new shutters.';

require ROOT_PATH . '/includes/spoke-page.php';
