<?php
require_once dirname(__DIR__, 3) . '/includes/config.php';

$page_title       = 'Honeycomb Shades in Aurora, IL';
$meta_description = 'Energy-efficient honeycomb (cellular) shades in Aurora, IL. Single & double cell, light-filtering to blackout, cordless lift. Free in-home measure.';

$spoke_service_type = 'Honeycomb Cellular Shades';
$spoke_h1           = 'Honeycomb (Cellular) Shades in Aurora, IL';
$spoke_path         = '/window-treatments/shades/honeycomb-shades/';
$spoke_hero_image   = 'assets/products/honeycomb/Portrait Honeycomb/01-Honeycomb.jpg';
$spoke_hero_image_mobile = 'assets/products/honeycomb/Portrait Honeycomb/01-Honeycomb_m.webp';
$spoke_intro        = 'The most energy-efficient shade we install, honeycomb cells trap air at the window to keep Aurora homes warmer in winter and cooler in summer.';

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Window Treatments', 'path' => '/window-treatments/'],
    ['name' => 'Shades', 'path' => '/window-treatments/shades/'],
    ['name' => 'Honeycomb Shades'],
];

$spoke_sections = [
    ['heading' => '', 'body' => '
        <p>Honeycomb shades, also called cellular shades, are named for the row of honeycomb-shaped pockets that run across the fabric when you look at it from the side. Those pockets trap a layer of air right at the glass, creating an insulating buffer between the cold (or hot) window and your room. In the Chicago suburbs, where winters are long and summers are humid, that insulation translates directly into lower heating and cooling bills.</p>
        <p>Creative Blinds &amp; Drapes custom-builds every honeycomb shade to your exact window, so the cells seal cleanly against the frame and do their job.</p>'],
    ['heading' => 'Single cell vs. double cell', 'body' => '
        <p>The number of cell layers controls how much insulation you get:</p>
        <ul style="line-height: 2;">
            <li><strong>Single cell</strong>: one layer of pockets; a great all-around choice for most rooms.</li>
            <li><strong>Double cell</strong>: two stacked layers for maximum energy efficiency on drafty or sun-facing windows.</li>
        </ul>
        <p>You can pair either with light-filtering, room-darkening, or blackout fabric depending on the room.</p>'],
    ['heading' => 'Why homeowners choose honeycomb shades', 'body' => '
        <ul style="line-height: 2;">
            <li>Best-in-class insulation and year-round energy savings</li>
            <li>Soft, diffused light with a clean, uncluttered look</li>
            <li>Sound dampening for quieter rooms</li>
            <li>Cordless, top-down/bottom-up, and motorized lift options</li>
            <li>Wide range of colors and opacities</li>
        </ul>'],
    ['heading' => 'Our process: consultation to installation', 'body' => '
        <p>We start with a <strong>free in-home consultation</strong>, bringing cell and fabric samples so you can compare single vs. double cell in your own windows. We then <strong>measure precisely</strong> for an airtight fit and <strong>professionally install</strong> each shade, confirming smooth operation before we leave.</p>'],
];

$browse_url   = '/window-treatments/shades/';
$browse_label = 'Browse our shade collection';

$related_links = [
    ['url' => '/window-treatments/shades/roller-shades/', 'label' => 'Roller shades'],
    ['url' => '/window-treatments/shades/sheer-shades/', 'label' => 'Sheer shades'],
    ['url' => '/window-treatments/motorized-window-treatment/', 'label' => 'Motorized window treatments'],
    ['url' => '/service-areas/aurora-il/', 'label' => 'Window treatments in Aurora, IL'],
    ['url' => '/guidelines/climate-light-control/', 'label' => 'Guide: climate & light control for Illinois homes'],
];

$faqs = [
    ['q' => 'Do honeycomb shades really save on energy bills?',
     'a' => 'Yes. The trapped air inside the honeycomb cells slows heat transfer through the window, which reduces how hard your furnace and air conditioner have to work. Double-cell shades and blackout fabrics provide the greatest energy savings on drafty or sun-facing windows.'],
    ['q' => 'What is the difference between single-cell and double-cell shades?',
     'a' => 'Single-cell shades have one layer of air pockets and suit most rooms, while double-cell shades stack two layers for extra insulation. Double cell is the better choice for very cold, very hot, or energy-critical windows.'],
    ['q' => 'What is a top-down/bottom-up honeycomb shade?',
     'a' => 'Top-down/bottom-up lets you lower the shade from the top or raise it from the bottom, so you can let in daylight while keeping the lower half private. It is a popular option for street-facing and bathroom windows.'],
    ['q' => 'Do you install honeycomb shades outside of Aurora?',
     'a' => 'Yes. We serve Aurora plus Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles, and Plainfield, with professional measuring and installation on every job.'],
];

$spoke_cta_heading = 'Ready to Lower Your Energy Bills?';
$spoke_cta_text    = 'Schedule a free in-home consultation and see single- and double-cell honeycomb samples in your own light.';

require ROOT_PATH . '/includes/spoke-page.php';
