<?php
require_once dirname(__DIR__, 3) . '/includes/config.php';

$page_title       = 'Vertical Blinds in Aurora, IL';
$meta_description = 'Custom vertical blinds in Aurora, IL for sliding doors & wide windows. Fabric, vinyl & S-curve vanes that slide and tilt. Free in-home measure.';

$spoke_service_type = 'Vertical Window Blinds';
$spoke_h1           = 'Vertical Blinds in Aurora, IL';
$spoke_path         = '/window-treatments/window-blinds/vertical-blinds/';
$spoke_hero_image   = 'assets/products/vertical_blinds/Synchrony Vertical Blinds/01-Synchrony.jpg';
$spoke_intro        = 'The practical answer for sliding doors and wide windows, custom vertical blinds with vanes that tilt for light and slide aside for easy access.';

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Window Treatments', 'path' => '/window-treatments/'],
    ['name' => 'Blinds', 'path' => '/window-treatments/window-blinds/'],
    ['name' => 'Vertical Blinds'],
];

$spoke_sections = [
    ['heading' => '', 'body' => '
        <p>Vertical blinds are purpose-built for the widest openings in your home: patio and sliding glass doors, wide picture windows, and floor-to-ceiling glass. Instead of stacking at the top, the vanes hang vertically, tilt together to control light and privacy, and draw to one side so you can walk through a doorway without lifting anything. That side-stacking design makes them the most convenient treatment for high-traffic openings.</p>
        <p>Creative Blinds &amp; Drapes measures and builds each set of vertical blinds to your exact opening for smooth sliding and even tilt.</p>'],
    ['heading' => 'Vane materials and styles', 'body' => '
        <ul style="line-height: 2;">
            <li><strong>Fabric vanes</strong>: soften a room and diffuse light with a warmer, more upscale look.</li>
            <li><strong>Vinyl (PVC) vanes</strong>: durable and easy to wipe clean, ideal for busy doors and damp areas.</li>
            <li><strong>S-curve vanes</strong>: gently contoured for a softer profile and better light blocking.</li>
        </ul>'],
    ['heading' => 'Why choose vertical blinds', 'body' => '
        <ul style="line-height: 2;">
            <li>Ideal for sliding doors and very wide windows</li>
            <li>Tilt for light control and slide aside for full access</li>
            <li>Durable, easy-to-clean vane options</li>
            <li>Wand controls and cordless-friendly operation</li>
            <li>Replaceable individual vanes for easy upkeep</li>
        </ul>'],
    ['heading' => 'Our process: consultation to installation', 'body' => '
        <p>Your <strong>free in-home consultation</strong> includes fabric, vinyl, and S-curve vane samples so you can pick the right look for your doors and windows. We then <strong>measure your openings precisely</strong> and <strong>install professionally</strong>, confirming the vanes slide and tilt smoothly across the full width.</p>'],
];

$browse_url   = '/window-treatments/window-blinds/';
$browse_label = 'Browse our blinds collection';

$related_links = [
    ['url' => '/window-treatments/window-blinds/horizontal-blinds/', 'label' => 'Horizontal blinds'],
    ['url' => '/window-treatments/curtains-and-drapes/draperies/', 'label' => 'Custom draperies'],
    ['url' => '/window-treatments/window-treatment-installer/blind-installer/', 'label' => 'Blind installation service'],
    ['url' => '/service-areas/aurora-il/', 'label' => 'Window treatments in Aurora, IL'],
];

$faqs = [
    ['q' => 'What are the best blinds for a sliding glass door?',
     'a' => 'Vertical blinds are the most popular and practical choice for sliding glass doors because the vanes tilt for light and privacy, then slide to one side so you can open the door freely. Fabric or vinyl vanes both work well depending on the look you want.'],
    ['q' => 'Are vertical blind vanes easy to replace if one is damaged?',
     'a' => 'Yes. Vanes hang individually, so a single damaged vane can be swapped out without replacing the whole blind, which makes vertical blinds easy to maintain in high-traffic areas.'],
    ['q' => 'Can vertical blinds cover a very wide window?',
     'a' => 'Absolutely. Vertical blinds are ideal for wide picture windows and floor-to-ceiling glass because they span large openings cleanly and stack compactly to one side when opened.'],
    ['q' => 'Do you install vertical blinds throughout the Aurora area?',
     'a' => 'Yes. We install custom vertical blinds in Aurora, Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles, and Plainfield with professional in-home measuring.'],
];

$spoke_cta_heading = 'Ready to Dress Your Sliding Doors?';
$spoke_cta_text    = 'Schedule a free in-home consultation and see vertical blind vane options for your doors and wide windows.';

require ROOT_PATH . '/includes/spoke-page.php';
