<?php
require_once dirname(__DIR__, 3) . '/includes/config.php';

$page_title       = 'Sheer Curtains in Aurora, IL';
$meta_description = 'Custom sheer curtains in Aurora, IL. Light, airy Fonluk sheers that soften daylight and add privacy. Layer over drapes or blinds. Free in-home measure.';

$spoke_service_type = 'Custom Sheer Curtains';
$spoke_h1           = 'Custom Sheer Curtains in Aurora, IL';
$spoke_path         = '/window-treatments/curtains-and-drapes/sheers/';
$spoke_hero_image   = 'assets/images/carousel/curtain-drape-background-2365x594.jpg';
$spoke_hero_image_mobile = 'assets/images/carousel/curtain-drape-background-666x577.jpg';
$spoke_intro        = 'Soft, glowing daylight and gentle daytime privacy, custom sheer curtains in our Fonluk sheer collection, made to measure for Aurora windows.';

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Window Treatments', 'path' => '/window-treatments/'],
    ['name' => 'Curtains & Drapes', 'path' => '/window-treatments/curtains-and-drapes/'],
    ['name' => 'Sheer Curtains'],
];

$spoke_sections = [
    ['heading' => '', 'body' => '
        <p>Sheer curtains are the easiest way to make a room feel bright, soft, and welcoming. The lightweight fabric filters harsh sunlight into a gentle glow, adds a layer of daytime privacy, and softens the hard lines of a window without blocking your view. On their own they suit sunrooms and living rooms; layered in front of drapery or behind blinds, they give you a full, decorator-style window with flexible light control.</p>
        <p>Creative Blinds &amp; Drapes makes sheer curtains to measure from our <strong>exclusive Fonluk sheer collection</strong> of more than 50 premium Turkish textiles, so panels hang full and even.</p>'],
    ['heading' => 'Ways to use sheer curtains', 'body' => '
        <ul style="line-height: 2;">
            <li><strong>On their own</strong>: airy light and privacy for living rooms and sunrooms.</li>
            <li><strong>Layered with drapery</strong>: sheers by day, drapes drawn for privacy and warmth at night.</li>
            <li><strong>Over blinds or shades</strong>: soften a hard treatment and add texture and color.</li>
        </ul>'],
    ['heading' => 'Why choose custom sheers', 'body' => '
        <ul style="line-height: 2;">
            <li>Exclusive Fonluk sheer fabrics in many tones and weaves</li>
            <li>Made-to-measure panels that hang full and even</li>
            <li>Soft, diffused daylight and daytime privacy</li>
            <li>Beautiful layered looks with drapery and hardware</li>
            <li>Helps filter UV to protect floors and furniture</li>
        </ul>'],
    ['heading' => 'Our process: consultation to installation', 'body' => '
        <p>During your <strong>free in-home consultation</strong> we bring Fonluk sheer samples so you can see how each fabric filters your light. We <strong>measure precisely</strong> for full, even panels and, once sewn, <strong>install the hardware and sheers</strong> and dress the folds so they hang beautifully.</p>'],
];

$browse_url   = '/window-treatments/curtains-and-drapes/';
$browse_label = 'Browse our Fonluk sheer fabrics';

$related_links = [
    ['url' => '/window-treatments/curtains-and-drapes/draperies/', 'label' => 'Custom draperies'],
    ['url' => '/window-treatments/shades/sheer-shades/', 'label' => 'Sheer shades'],
    ['url' => '/curtain-hardware.php', 'label' => 'Curtain rods, tracks & hardware'],
    ['url' => '/service-areas/aurora-il/', 'label' => 'Window treatments in Aurora, IL'],
];

$faqs = [
    ['q' => 'Do sheer curtains provide privacy?',
     'a' => 'Sheer curtains add good daytime privacy while still letting light through. At night, when interior lights are on, sheers become more see-through, so many homeowners layer them with drapery or blinds for full privacy after dark.'],
    ['q' => 'What is the difference between sheer curtains and sheer shades?',
     'a' => 'Sheer curtains are fabric panels that hang across the window for a soft, flowing look, while sheer shades have adjustable vanes between two sheer layers and raise up and down like a shade. Curtains are more decorative; shades offer more precise light control.'],
    ['q' => 'Can I layer sheers with my existing drapes?',
     'a' => 'Yes. Layering sheers behind drapery is one of the most popular looks we install. It gives you soft filtered light during the day and full privacy and insulation when the drapes are drawn. We can match hardware so both layers operate smoothly.'],
    ['q' => 'Do you install sheer curtains throughout the Aurora area?',
     'a' => 'Yes. We make and install custom sheer curtains in Aurora, Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles, and Plainfield with professional in-home measuring.'],
];

$spoke_cta_heading = 'Ready to Brighten Your Rooms?';
$spoke_cta_text    = 'Schedule a free in-home consultation and see our Fonluk sheer fabrics in your own light.';

require ROOT_PATH . '/includes/spoke-page.php';
