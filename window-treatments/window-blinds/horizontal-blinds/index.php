<?php
require_once dirname(__DIR__, 3) . '/includes/config.php';

$page_title       = 'Horizontal Blinds in Aurora, IL';
$meta_description = 'Custom horizontal blinds in Aurora, IL. Faux wood, real wood, and aluminum slats in 1", 2" & 2.5" widths. Cordless options. Free in-home measure.';

$spoke_service_type = 'Horizontal Window Blinds';
$spoke_h1           = 'Horizontal Blinds in Aurora, IL';
$spoke_path         = '/window-treatments/window-blinds/horizontal-blinds/';
$spoke_hero_image   = 'assets/products/horizontal_blinds/Cordless Faux Wood Blinds/01-Cordless Blinds.jpg';
$spoke_intro        = 'Timeless tilt-and-lift light control for Aurora homes, custom horizontal blinds in faux wood, real wood, and aluminum, sized to fit every window.';

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Window Treatments', 'path' => '/window-treatments/'],
    ['name' => 'Blinds', 'path' => '/window-treatments/window-blinds/'],
    ['name' => 'Horizontal Blinds'],
];

$spoke_sections = [
    ['heading' => '', 'body' => '
        <p>Horizontal blinds are the classic, do-everything window treatment: a stack of slats that tilt to control light and glare, then raise up out of the way when you want the full window. Because the slats tilt independently of the lift, you can let in soft daylight while keeping privacy from the street, something a simple shade can&rsquo;t do. That flexibility is why horizontal blinds remain the most popular choice in Aurora-area kitchens, offices, and living spaces.</p>
        <p>Creative Blinds &amp; Drapes custom-sizes every set of horizontal blinds so the slats fill the window cleanly with no awkward gaps.</p>'],
    ['heading' => 'Choose your material', 'body' => '
        <ul style="line-height: 2;">
            <li><strong>Faux wood</strong>: the look of painted wood that resists moisture, warping, and fading. Ideal for kitchens, baths, and sunny rooms.</li>
            <li><strong>Real wood</strong>: warm, natural grain and a premium feel for living and dining rooms.</li>
            <li><strong>Aluminum</strong>: slim, durable metal slats for a crisp, modern, budget-friendly look.</li>
        </ul>
        <p>Slat sizes typically range from 1&quot; up to 2.5&quot;. Wider slats give a bolder look and a clearer view when open.</p>'],
    ['heading' => 'Benefits of custom horizontal blinds', 'body' => '
        <ul style="line-height: 2;">
            <li>Precise tilt control for light, glare, and privacy</li>
            <li>Durable materials for every room, including damp spaces</li>
            <li>Cordless and easy-lift options for child safety</li>
            <li>Clean, classic look that suits any decor</li>
            <li>Simple to dust and maintain</li>
        </ul>'],
    ['heading' => 'Our process: consultation to installation', 'body' => '
        <p>We begin with a <strong>free in-home consultation</strong>, bringing faux wood, real wood, and aluminum samples so you can compare materials and slat sizes in your own light. We <strong>measure each window precisely</strong>, then <strong>install professionally</strong> and confirm smooth tilt and lift before we leave.</p>'],
];

$browse_url   = '/window-treatments/window-blinds/';
$browse_label = 'Browse our blinds collection';

$related_links = [
    ['url' => '/window-treatments/window-blinds/vertical-blinds/', 'label' => 'Vertical blinds'],
    ['url' => '/window-treatments/shades/roller-shades/', 'label' => 'Roller shades'],
    ['url' => '/window-treatments/window-treatment-installer/blind-installer/', 'label' => 'Blind installation service'],
    ['url' => '/service-areas/aurora-il/', 'label' => 'Window treatments in Aurora, IL'],
];

$faqs = [
    ['q' => 'Are faux wood or real wood blinds better?',
     'a' => 'Faux wood resists moisture, warping, and fading, so it is the better choice for kitchens, bathrooms, and sunny windows. Real wood is lighter and offers a warm natural grain that many homeowners prefer in living and dining rooms. We will show you both during your consultation.'],
    ['q' => 'What slat size should I choose?',
     'a' => 'Narrow 1-inch slats give a tailored look and suit smaller windows, while 2 to 2.5-inch slats create a bolder appearance and a clearer view when tilted open. Larger windows generally look best with wider slats.'],
    ['q' => 'Can horizontal blinds be cordless?',
     'a' => 'Yes. We offer cordless lift and wand-tilt systems that remove hanging cords, which is the recommended safe option for homes with children or pets.'],
    ['q' => 'Do you install horizontal blinds outside Aurora?',
     'a' => 'Yes. We serve Aurora plus Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles, and Plainfield, with professional measuring and installation on every order.'],
];

$spoke_cta_heading = 'Ready to Upgrade Your Blinds?';
$spoke_cta_text    = 'Schedule a free in-home consultation and compare faux wood, real wood, and aluminum samples in your own home.';

require ROOT_PATH . '/includes/spoke-page.php';
