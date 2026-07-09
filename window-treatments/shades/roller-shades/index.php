<?php
require_once dirname(__DIR__, 3) . '/includes/config.php';

$page_title       = 'Roller Shades in Aurora, IL';
$meta_description = 'Custom roller shades in Aurora, IL: light-filtering to blackout fabrics, cordless and motorized lift. Free in-home measure and quote.';

$spoke_service_type = 'Roller Shades';
$spoke_h1           = 'Roller Shades in Aurora, IL';
$spoke_path         = '/window-treatments/shades/roller-shades/';
$spoke_hero_image   = 'assets/products/soluna_roller/01-Soluna Roller.jpg';
$spoke_intro        = 'Clean, modern roller shades custom-made for Aurora homes, from soft light-filtering fabrics to full blackout, with cordless and motorized lift options.';

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Window Treatments', 'path' => '/window-treatments/'],
    ['name' => 'Shades', 'path' => '/window-treatments/shades/'],
    ['name' => 'Roller Shades'],
];

$spoke_sections = [
    ['heading' => '', 'body' => '
        <p>Roller shades are the most versatile window treatment we install in the Aurora area. A single fabric-wrapped roller mounts discreetly at the top of the window and rolls up out of sight, giving you an uncluttered, contemporary look that suits everything from a modern kitchen to a cozy bedroom. Because the fabric does the work, you can dial in exactly how much light and privacy you want, room by room, window by window.</p>
        <p>At Creative Blinds &amp; Drapes we custom-make every roller shade to your exact window measurements, so you get a crisp, gap-free fit that off-the-shelf shades simply can&rsquo;t match.</p>'],
    ['heading' => 'Choose the right fabric opacity', 'body' => '
        <p>The fabric you choose determines how the shade lives in your room:</p>
        <ul style="line-height: 2;">
            <li><strong>Light-filtering</strong>: softens daylight and adds daytime privacy while keeping the room bright. Ideal for living rooms and kitchens.</li>
            <li><strong>Room-darkening</strong>: a heavier weave that cuts glare for family rooms and media spaces.</li>
            <li><strong>Blackout</strong>: blocks incoming light for bedrooms, nurseries, and home theaters.</li>
            <li><strong>Solar / screen</strong>: reduces UV and heat while preserving your view, perfect for sun-facing windows.</li>
        </ul>'],
    ['heading' => 'Benefits of custom roller shades', 'body' => '
        <ul style="line-height: 2;">
            <li>Sleek, minimal profile that disappears when raised</li>
            <li>Hundreds of fabrics, textures, and colors to match any decor</li>
            <li>Child-safe cordless and motorized lift options</li>
            <li>Easy to clean and built to last</li>
            <li>Energy savings from solar and blackout fabrics</li>
        </ul>'],
    ['heading' => 'Our process: consultation to installation', 'body' => '
        <p>Every project follows the same simple path. First, we bring fabric samples to your home for a <strong>free in-home consultation</strong> so you can see colors and opacities in your own light. Next, we <strong>professionally measure</strong> each window for a precise fit. Finally, our installers <strong>mount your shades</strong> and make sure every one operates smoothly before we leave. You are never guessing. You see, touch, and approve the fabrics before anything is ordered.</p>'],
];

$browse_url   = '/window-treatments/shades/';
$browse_label = 'Browse our shade collection';

$related_links = [
    ['url' => '/window-treatments/shades/honeycomb-shades/', 'label' => 'Honeycomb (cellular) shades'],
    ['url' => '/window-treatments/shades/roman-shades/', 'label' => 'Roman shades'],
    ['url' => '/window-treatments/motorized-window-treatment/', 'label' => 'Motorized window treatments'],
    ['url' => '/service-areas/aurora-il/', 'label' => 'Window treatments in Aurora, IL'],
    ['url' => '/guidelines/climate-light-control/', 'label' => 'Guide: climate & light control for Illinois homes'],
];

$faqs = [
    ['q' => 'How much do custom roller shades cost in Aurora?',
     'a' => 'Pricing depends on window size, fabric, and lift option, so we provide a free, no-obligation quote after measuring. Custom roller shades are one of the most budget-friendly upgrades we offer, and we will show you options at several price points during your consultation.'],
    ['q' => 'Can roller shades block out all the light?',
     'a' => 'Yes. Choosing a blackout fabric with side channels dramatically reduces light leakage, making roller shades an excellent choice for bedrooms, nurseries, and media rooms. For daytime privacy without darkening a room, a light-filtering fabric is a better fit.'],
    ['q' => 'Are cordless and motorized roller shades safe for children and pets?',
     'a' => 'Absolutely. Cordless and motorized lifts remove hanging cords entirely, which is the safest option for homes with young children or pets. Motorized shades can also be scheduled or controlled by remote and smart-home systems.'],
    ['q' => 'Do you install roller shades throughout the Aurora area?',
     'a' => 'Yes. We install custom roller shades in Aurora and surrounding communities including Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles, and Plainfield. Every installation is handled by our own professional team.'],
];

$spoke_cta_heading = 'Ready to Modernize Your Windows?';
$spoke_cta_text    = 'Schedule a free in-home consultation and we will bring roller shade samples directly to you.';

require ROOT_PATH . '/includes/spoke-page.php';
