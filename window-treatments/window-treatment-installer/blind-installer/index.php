<?php
require_once dirname(__DIR__, 3) . '/includes/config.php';

$page_title       = 'Blind Installation in Aurora, IL';
$meta_description = 'Professional blind installation in Aurora, IL. Precise measuring and secure mounting of horizontal and vertical blinds. Free in-home measure and quote.';

$spoke_service_type = 'Blind Installation';
$spoke_h1           = 'Blind Installation in Aurora, IL';
$spoke_path         = '/window-treatments/window-treatment-installer/blind-installer/';
$spoke_hero_image   = 'assets/products/horizontal_blinds/Cordless Faux Wood Blinds/01-Cordless Blinds.jpg';
$spoke_intro        = 'Measured, mounted, and tested by our own Aurora team: professional installation of horizontal and vertical blinds that fit and operate flawlessly.';

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Window Treatments', 'path' => '/window-treatments/'],
    ['name' => 'Window Treatment Installer', 'path' => '/window-treatments/window-treatment-installer/'],
    ['name' => 'Blind Installation'],
];

$spoke_sections = [
    ['heading' => '', 'body' => '
        <p>Blinds look simple to hang, but a clean result depends on accurate measuring and secure, level mounting. A bracket set a fraction off, or a blind cut slightly too wide, leaves gaps, light leaks, and slats that catch on the frame. Creative Blinds &amp; Drapes takes that risk off your plate: our own installers measure each opening and mount your blinds so they fit tight, sit level, and tilt and lift smoothly.</p>
        <p>We install both horizontal and vertical blinds, inside or outside mount, throughout the Aurora area.</p>'],
    ['heading' => 'What our blind installation includes', 'body' => '
        <ul style="line-height: 2;">
            <li>Precise window measuring for inside or outside mount</li>
            <li>Secure bracket mounting into the frame or wall</li>
            <li>Level, gap-free fit across the full width</li>
            <li>Operation check on tilt, lift, and cordless systems</li>
            <li>Cleanup and haul-away of packaging</li>
        </ul>'],
    ['heading' => 'Our process', 'body' => '
        <p>Start with a <strong>free in-home consultation</strong> to choose your blinds. We <strong>measure each window precisely</strong>, order your custom blinds, and return to <strong>install and test</strong> every unit before we leave. You can review the blind options first on our <a href="' . url('/window-treatments/window-blinds/') . '">window blinds page</a>.</p>'],
];

$browse_url   = '/window-treatments/window-blinds/';
$browse_label = 'Browse our blinds collection';

$related_links = [
    ['url' => '/window-treatments/window-blinds/horizontal-blinds/', 'label' => 'Horizontal blinds'],
    ['url' => '/window-treatments/window-blinds/vertical-blinds/', 'label' => 'Vertical blinds'],
    ['url' => '/window-treatments/window-treatment-installer/', 'label' => 'All window treatment installation'],
    ['url' => '/service-areas/aurora-il/', 'label' => 'Window treatments in Aurora, IL'],
];

$faqs = [
    ['q' => 'Do you measure the windows before installing blinds?',
     'a' => 'Yes. Professional measuring is part of the service. We measure each opening for inside or outside mount so your blinds fit correctly, which prevents the gaps and binding that come from do-it-yourself measuring.'],
    ['q' => 'Can you install blinds I need for an unusual window shape or size?',
     'a' => 'In most cases, yes. We handle wide windows, tall windows, and specialty situations during measuring and select the right mounting approach. We will confirm what is possible during your in-home consultation.'],
    ['q' => 'Do you install cordless and child-safe blinds?',
     'a' => 'Yes. We install cordless and wand-operated systems that remove hanging cords, and we test the operation before we finish. Cordless options are recommended for homes with children or pets.'],
    ['q' => 'Which areas do you install blinds in?',
     'a' => 'We install blinds in Aurora, Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles, and Plainfield.'],
];

$spoke_cta_heading = 'Ready to Get Your Blinds Installed?';
$spoke_cta_text    = 'Schedule a free in-home consultation and let our team measure and install your new blinds.';

require ROOT_PATH . '/includes/spoke-page.php';
