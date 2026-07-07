<?php
require_once dirname(__DIR__, 3) . '/includes/config.php';

$page_title       = 'Drapery Installation in Aurora, IL';
$meta_description = 'Professional drapery installation in Aurora, IL. Level rods and tracks, perfectly dressed folds for custom drapes and sheers. Free in-home measure.';

$spoke_service_type = 'Drapery Installation';
$spoke_h1           = 'Drapery Installation in Aurora, IL';
$spoke_path         = '/window-treatments/window-treatment-installer/drapery-installation/';
$spoke_hero_image   = 'assets/images/carousel/curtain-drape-background-2365x594.jpg';
$spoke_hero_image_mobile = 'assets/images/carousel/curtain-drape-background-666x577.jpg';
$spoke_intro        = 'Level rods, secure tracks, and hand-dressed folds: professional drapery installation that makes custom panels and sheers hang beautifully in Aurora homes.';

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Window Treatments', 'path' => '/window-treatments/'],
    ['name' => 'Window Treatment Installer', 'path' => '/window-treatments/window-treatment-installer/'],
    ['name' => 'Drapery Installation'],
];

$spoke_sections = [
    ['heading' => '', 'body' => '
        <p>Drapery is where installation makes the biggest visual difference. Panels that are perfect off the sewing table can still look wrong if the rod isn&rsquo;t level, the brackets aren&rsquo;t anchored, or the folds aren&rsquo;t dressed. Creative Blinds &amp; Drapes mounts the hardware securely, hangs your panels at the right height for a full floor-to-ceiling look, and hand-dresses the folds so the drapery falls in even, elegant pleats.</p>
        <p>We install custom draperies, sheers, rods, and tracks throughout Aurora and the surrounding communities.</p>'],
    ['heading' => 'What our drapery installation includes', 'body' => '
        <ul style="line-height: 2;">
            <li>Level, securely anchored rods and tracks</li>
            <li>Correct mounting height for a full, tailored look</li>
            <li>Hand-dressed folds so panels hang evenly</li>
            <li>Layered setups with sheers and drapery together</li>
            <li>Cleanup and haul-away of packaging</li>
        </ul>'],
    ['heading' => 'Our process', 'body' => '
        <p>At your <strong>free in-home consultation</strong> we help you choose fabrics and hardware. We <strong>measure precisely</strong>, make your custom drapery, and return to <strong>mount, hang, and dress</strong> every panel. Explore fabrics first on our <a href="' . url('/window-treatments/curtains-and-drapes/') . '">curtains and drapes page</a> or view <a href="' . url('/curtain-hardware.php') . '">rods and tracks</a>.</p>'],
];

$browse_url   = '/window-treatments/curtains-and-drapes/';
$browse_label = 'Browse our Fonluk drapery fabrics';

$related_links = [
    ['url' => '/window-treatments/curtains-and-drapes/draperies/', 'label' => 'Custom draperies'],
    ['url' => '/window-treatments/curtains-and-drapes/sheers/', 'label' => 'Sheer curtains'],
    ['url' => '/curtain-hardware.php', 'label' => 'Curtain rods, tracks & hardware'],
    ['url' => '/window-treatments/window-treatment-installer/', 'label' => 'All window treatment installation'],
];

$faqs = [
    ['q' => 'Do you supply and install the drapery hardware too?',
     'a' => 'Yes. We provide coordinating rods, tracks, and hardware and mount everything for you, anchored securely and level. You can view hardware options on our curtain hardware page.'],
    ['q' => 'How high should drapery be mounted?',
     'a' => 'For a full, tailored look we typically mount drapery well above the window frame, closer to the ceiling, so the panels read floor-to-ceiling. We determine the ideal height for your room during measuring.'],
    ['q' => 'Can you install sheers and drapes as a layered set?',
     'a' => 'Yes. Layered sheers and drapery are one of the most popular looks we install. We set up the hardware so both layers operate smoothly, giving you soft light by day and privacy at night.'],
    ['q' => 'Which areas do you install drapery in?',
     'a' => 'We install drapery in Aurora, Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles, and Plainfield.'],
];

$spoke_cta_heading = 'Ready to Hang Your Drapery Right?';
$spoke_cta_text    = 'Schedule a free in-home consultation and let our team measure, make, and install your custom drapery.';

require ROOT_PATH . '/includes/spoke-page.php';
