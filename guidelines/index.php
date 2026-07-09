<?php
require_once dirname(__DIR__, 1) . '/includes/config.php';

$page_title       = "Window Treatment Guides for Aurora Homeowners";
$meta_description = "Free window treatment guides for Aurora & Naperville homeowners: climate & light, measuring, mounts, installation, care, and our local promise.";

$guide_h1    = "Window Treatment Guides for Aurora & Naperville Homeowners";
$guide_path  = "/guidelines/";
$guide_hero_image = "assets/images/carousel/curtain-drape-background-2365x594.jpg";
$guide_hero_image_mobile = "assets/images/carousel/curtain-drape-background-666x577.jpg";
$guide_intro = "Seven practical guides to help you choose, measure, install, and care for custom window treatments in the Illinois climate.";
$guide_is_hub = true;

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Guides'],
];

$guides = [
    ['slug' => 'climate-light-control', 'title' => 'Local Climate & Light Control', 'summary' => 'Energy-efficient choices for Illinois weather, sun exposure by room, and the light-control spectrum.'],
    ['slug' => 'precision-measurement', 'title' => 'The Precision Measurement Difference', 'summary' => 'Why professional nine-point measuring beats DIY, and how it prevents light gaps and costly remakes.'],
    ['slug' => 'inside-vs-outside-mounts', 'title' => 'Inside vs. Outside Mounts', 'summary' => 'How mount type affects light, blackout, and the look of your window, and which one fits your sill.'],
    ['slug' => 'preparing-your-space', 'title' => 'Preparing Your Space', 'summary' => 'Simple steps to get each room ready for a fast, safe, damage-free installation day.'],
    ['slug' => 'professional-installation', 'title' => 'The Benefits of Professional Installation', 'summary' => 'Child safety, secure anchoring, longevity, and a written workmanship warranty.'],
    ['slug' => 'care-and-maintenance', 'title' => 'Long-Term Care & Maintenance', 'summary' => 'Product-by-product cleaning plus humidity and UV management for the Chicagoland climate.'],
    ['slug' => 'our-promise', 'title' => 'The Creative Blinds & Drapes Promise', 'summary' => 'What sets our local, insured, warranty-backed installation service apart.'],
];

// ItemList schema nodes for the hub.
$guide_items = array_map(function ($g) {
    return [
        'name'        => $g['title'],
        'url'         => SITE_URL . '/guidelines/' . $g['slug'] . '/',
        'description' => $g['summary'],
    ];
}, $guides);

// Visible cards.
$cards = '<div class="g-cards">';
foreach ($guides as $g) {
    $u = url('/guidelines/' . $g['slug'] . '/');
    $cards .= '<div class="g-card"><h3><a href="' . $u . '">' . htmlspecialchars($g['title']) . '</a></h3><p>' . htmlspecialchars($g['summary']) . '</p></div>';
}
$cards .= '</div>';

$intro_body = <<<'HTML'
<p>These guides answer the questions Aurora and Naperville homeowners ask us most often, before, during, and after a window treatment project. Each one is written by our team from more than 23 years of local installation experience. Read them in any order, then book a free in-home consultation when you are ready for room-by-room recommendations.</p>
HTML;

$guide_sections = [
    ['heading' => '', 'body' => $intro_body],
    ['heading' => 'Browse the Guides', 'body' => $cards],
];

$related_links = [
    ['url' => "/window-treatments/", 'label' => "Browse all window treatments"],
    ['url' => "/service-areas/", 'label' => "Our Fox Valley service areas"],
    ['url' => "/contact/", 'label' => "Book a free in-home consultation"],
];

$guide_cta_heading = "Ready to Choose Your Window Treatments?";
$guide_cta_text    = "Book a free in-home consultation and we will bring the guidance in these articles to your own windows. No obligation, samples brought to you.";

require ROOT_PATH . '/includes/guide-page.php';
