<?php
require_once dirname(__DIR__, 3) . '/includes/config.php';

$page_title       = 'Shade Installation in Aurora, IL';
$meta_description = 'Professional shade installation in Aurora, IL. Expert fitting of honeycomb, roller, roman and sheer shades. Free in-home measure and quote.';

$spoke_service_type = 'Shade Installation';
$spoke_h1           = 'Shade Installation in Aurora, IL';
$spoke_path         = '/window-treatments/window-treatment-installer/shades-installation/';
$spoke_hero_image   = 'assets/products/honeycomb/Portrait Honeycomb/01-Honeycomb.jpg';
$spoke_hero_image_mobile = 'assets/products/honeycomb/Portrait Honeycomb/01-Honeycomb_m.webp';
$spoke_intro        = 'Precise fitting so cells seal and shades glide: professional installation of honeycomb, roller, roman, and sheer shades across the Aurora area.';

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Window Treatments', 'path' => '/window-treatments/'],
    ['name' => 'Window Treatment Installer', 'path' => '/window-treatments/window-treatment-installer/'],
    ['name' => 'Shade Installation'],
];

$spoke_sections = [
    ['heading' => '', 'body' => '
        <p>Shades depend on a snug, square fit to perform. An honeycomb shade only insulates if the cells seal against the frame; a roller only looks clean if it hangs perfectly level; a sheer only diffuses light evenly if the vanes are true. Creative Blinds &amp; Drapes measures and installs every shade with that precision, so your investment actually delivers the light control and energy savings it promises.</p>
        <p>We install honeycomb, roller, roman, and sheer shades, inside or outside mount, cordless or motorized, throughout Aurora and nearby towns.</p>'],
    ['heading' => 'What our shade installation includes', 'body' => '
        <ul style="line-height: 2;">
            <li>Accurate measuring for a square, gap-free fit</li>
            <li>Level mounting for clean, even hanging</li>
            <li>Setup of cordless, top-down/bottom-up, and motorized lifts</li>
            <li>Operation check on every shade before we leave</li>
            <li>Packaging cleanup and haul-away</li>
        </ul>'],
    ['heading' => 'Our process', 'body' => '
        <p>Choose your shades during a <strong>free in-home consultation</strong>. We <strong>measure precisely</strong>, order your custom shades, and return to <strong>install and test</strong> each one. Explore styles first on our <a href="' . url('/window-treatments/shades/') . '">window shades page</a>.</p>'],
];

$browse_url   = '/window-treatments/shades/';
$browse_label = 'Browse our shade collection';

$related_links = [
    ['url' => '/window-treatments/shades/honeycomb-shades/', 'label' => 'Honeycomb shades'],
    ['url' => '/window-treatments/shades/roller-shades/', 'label' => 'Roller shades'],
    ['url' => '/window-treatments/window-treatment-installer/', 'label' => 'All window treatment installation'],
    ['url' => '/service-areas/aurora-il/', 'label' => 'Window treatments in Aurora, IL'],
];

$faqs = [
    ['q' => 'Do you install motorized shades?',
     'a' => 'Yes. We install and set up motorized shades, including remote and smart-home control, and test the operation before we finish. Motorized lifts are a popular, cord-free option for hard-to-reach and large windows.'],
    ['q' => 'Will professional installation help my honeycomb shades save energy?',
     'a' => 'Yes. Honeycomb shades insulate best when they fit snugly and the cells seal against the window frame. Precise measuring and mounting ensures you get the full energy-saving benefit of the shade.'],
    ['q' => 'Can you install top-down/bottom-up shades?',
     'a' => 'Yes. We install top-down/bottom-up systems and demonstrate how they operate so you can lower the shade from the top or raise it from the bottom for flexible light and privacy.'],
    ['q' => 'Which areas do you install shades in?',
     'a' => 'We install shades in Aurora, Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles, and Plainfield.'],
];

$spoke_cta_heading = 'Ready to Get Your Shades Installed?';
$spoke_cta_text    = 'Schedule a free in-home consultation and let our team measure and install your new shades.';

require ROOT_PATH . '/includes/spoke-page.php';
