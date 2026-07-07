<?php
require_once dirname(__DIR__, 3) . '/includes/config.php';

$page_title       = 'Sheer Shades in Aurora, IL';
$meta_description = 'Custom sheer shades in Aurora, IL. Adjustable fabric vanes float between sheers to control light and privacy with a view. Free in-home measure.';

$spoke_service_type = 'Sheer Shades';
$spoke_h1           = 'Sheer Shades in Aurora, IL';
$spoke_path         = '/window-treatments/shades/sheer-shades/';
$spoke_hero_image   = 'assets/products/perfect_sheer/01-PerfectSheer.jpg';
$spoke_intro        = 'The soft glow of a sheer with the light control of a blind, adjustable fabric vanes float between two sheer layers to tune privacy and view.';

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Window Treatments', 'path' => '/window-treatments/'],
    ['name' => 'Shades', 'path' => '/window-treatments/shades/'],
    ['name' => 'Sheer Shades'],
];

$spoke_sections = [
    ['heading' => '', 'body' => '
        <p>Sheer shades combine the airy elegance of sheer curtains with the practical light control of a blind. Soft fabric vanes are suspended between two layers of sheer material; tilt the vanes open and diffused daylight fills the room while you keep your view, or close them for privacy and glare control. When fully raised, the whole shade lifts up and out of the way like a roller.</p>
        <p>Creative Blinds &amp; Drapes builds each sheer shade to your window for smooth vane operation and a clean, gap-free fit.</p>'],
    ['heading' => 'How sheer shades work', 'body' => '
        <ul style="line-height: 2;">
            <li><strong>Vanes open</strong>: soft, filtered daylight with an outward view.</li>
            <li><strong>Vanes closed</strong>: daytime privacy and reduced glare while keeping the sheer look.</li>
            <li><strong>Fully raised</strong>: the shade rolls up completely for an unobstructed window.</li>
        </ul>'],
    ['heading' => 'Why homeowners love sheer shades', 'body' => '
        <ul style="line-height: 2;">
            <li>Beautiful diffused light and a designer look</li>
            <li>Adjustable privacy without losing your view</li>
            <li>UV protection that helps guard floors and furniture</li>
            <li>Cordless and motorized lift options</li>
            <li>Ideal for living rooms, dining rooms, and sunrooms</li>
        </ul>'],
    ['heading' => 'Our process: consultation to installation', 'body' => '
        <p>At your <strong>free in-home consultation</strong> we demonstrate how the vanes adjust light and privacy in your own windows. We then <strong>measure precisely</strong> and <strong>install professionally</strong>, confirming the vanes open, close, and lift smoothly before we finish.</p>'],
];

$browse_url   = '/window-treatments/shades/';
$browse_label = 'Browse our shade collection';

$related_links = [
    ['url' => '/window-treatments/shades/roller-shades/', 'label' => 'Roller shades'],
    ['url' => '/window-treatments/curtains-and-drapes/sheers/', 'label' => 'Sheer curtains'],
    ['url' => '/window-treatments/shades/honeycomb-shades/', 'label' => 'Honeycomb shades'],
    ['url' => '/service-areas/aurora-il/', 'label' => 'Window treatments in Aurora, IL'],
];

$faqs = [
    ['q' => 'What is the difference between sheer shades and sheer curtains?',
     'a' => 'Sheer curtains are fabric panels that hang in front of the window, while sheer shades have adjustable fabric vanes suspended between two sheer layers. The shade lets you tilt the vanes to control light and privacy and then raise the whole unit out of the way.'],
    ['q' => 'Do sheer shades provide privacy at night?',
     'a' => 'With the vanes closed they add strong daytime privacy and glare control. At night, interior lights can make sheer materials more see-through, so for full nighttime privacy in bedrooms we often recommend pairing them with a room-darkening treatment or choosing a different shade.'],
    ['q' => 'Are sheer shades good for large or sunny windows?',
     'a' => 'Yes. They soften and diffuse strong sunlight, reduce glare, and filter UV to help protect flooring and furniture, which makes them a popular choice for sunrooms and sun-facing living areas.'],
    ['q' => 'Do you install sheer shades throughout the Aurora area?',
     'a' => 'Yes. We install custom sheer shades in Aurora, Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles, and Plainfield with professional in-home measuring.'],
];

$spoke_cta_heading = 'Ready for Light Control With a View?';
$spoke_cta_text    = 'Schedule a free in-home consultation and see how sheer shades tune light and privacy in your rooms.';

require ROOT_PATH . '/includes/spoke-page.php';
