<?php
require_once dirname(__DIR__, 3) . '/includes/config.php';

$page_title       = 'Custom Draperies in Aurora, IL';
$meta_description = 'Custom draperies in Aurora, IL. 70+ Fonluk drapery fabrics, pinch pleat to grommet styles, blackout lining & hardware. Free in-home measure.';

$spoke_service_type = 'Custom Draperies';
$spoke_h1           = 'Custom Draperies in Aurora, IL';
$spoke_path         = '/window-treatments/curtains-and-drapes/draperies/';
$spoke_hero_image   = 'assets/images/carousel/curtain-drape-background-2365x594.jpg';
$spoke_hero_image_mobile = 'assets/images/carousel/curtain-drape-background-666x577.jpg';
$spoke_intro        = 'Floor-to-ceiling elegance made to measure, custom draperies in our exclusive Fonluk fabric collection, tailored, lined, and installed for Aurora homes.';

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Window Treatments', 'path' => '/window-treatments/'],
    ['name' => 'Curtains & Drapes', 'path' => '/window-treatments/curtains-and-drapes/'],
    ['name' => 'Draperies'],
];

$spoke_sections = [
    ['heading' => '', 'body' => '
        <p>Custom draperies bring softness, color, and a finished designer look to a room that blinds and shades alone can&rsquo;t match. Full-length panels frame a window, add warmth and texture, and quietly improve insulation and sound. Because they are made to your exact window height and width, custom draperies hang with clean, even folds from the top of the wall to the floor, with no skimpy, off-the-rack look.</p>
        <p>Creative Blinds &amp; Drapes offers an <strong>exclusive Fonluk drapery collection</strong> of more than 70 premium Turkish textiles you won&rsquo;t find at the big-box stores, sewn and installed by our own team.</p>'],
    ['heading' => 'Heading styles and lining', 'body' => '
        <ul style="line-height: 2;">
            <li><strong>Pinch pleat</strong>: tailored, traditional folds for a classic, formal look.</li>
            <li><strong>Grommet</strong>: clean modern rings that glide easily for a contemporary feel.</li>
            <li><strong>Rod pocket &amp; tab top</strong>: casual, relaxed styling for everyday rooms.</li>
            <li><strong>Blackout &amp; privacy lining</strong>: add light control and insulation without changing the face fabric.</li>
        </ul>'],
    ['heading' => 'Why choose custom draperies', 'body' => '
        <ul style="line-height: 2;">
            <li>Exclusive Fonluk fabrics in a huge range of colors and patterns</li>
            <li>Made-to-measure panels that hang perfectly</li>
            <li>Added insulation, warmth, and sound absorption</li>
            <li>Coordinating drapery rods, tracks, and hardware</li>
            <li>Layer beautifully over blinds, shades, or sheers</li>
        </ul>'],
    ['heading' => 'Our process: consultation to installation', 'body' => '
        <p>At your <strong>free in-home consultation</strong> we bring the Fonluk fabric collection so you can see and feel textiles against your walls and floors. We then <strong>measure precisely</strong> for full, even folds, and once your panels are sewn we <strong>install the hardware and drapery</strong> and dress the folds so everything hangs beautifully.</p>'],
];

$browse_url   = '/window-treatments/curtains-and-drapes/';
$browse_label = 'Browse our Fonluk drapery fabrics';

$related_links = [
    ['url' => '/window-treatments/curtains-and-drapes/sheers/', 'label' => 'Sheer curtains'],
    ['url' => '/curtain-hardware.php', 'label' => 'Curtain rods, tracks & hardware'],
    ['url' => '/window-treatments/window-treatment-installer/drapery-installation/', 'label' => 'Drapery installation service'],
    ['url' => '/service-areas/aurora-il/', 'label' => 'Window treatments in Aurora, IL'],
    ['url' => '/guidelines/care-and-maintenance/', 'label' => 'Guide: caring for drapes and window treatments'],
];

$faqs = [
    ['q' => 'What are Fonluk fabrics?',
     'a' => 'Fonluk is our premium drapery collection, woven by a premium Turkish textile manufacturer, with more than 70 textiles in a wide range of colors, weaves and patterns. We carry it exclusively in the Aurora area, so you get designer looks that are not available at typical big-box retailers.'],
    ['q' => 'Can custom draperies help with light and insulation?',
     'a' => 'Yes. Adding a blackout or privacy lining lets custom draperies block light and add a layer of insulation at the window, which helps with both energy efficiency and sound. You keep your chosen face fabric while gaining these benefits from the lining.'],
    ['q' => 'What heading style should I choose?',
     'a' => 'Pinch pleat gives a tailored, formal look; grommet panels read modern and glide easily; rod pocket and tab top are more casual. The right choice depends on your decor and how often you open and close the panels, and we will help you decide during your consultation.'],
    ['q' => 'Do you supply the rods and tracks too?',
     'a' => 'Yes. We offer coordinating drapery rods, tracks, and hardware, and our installers mount everything for you. You can view our hardware options on the curtain hardware page.'],
];

$spoke_cta_heading = 'Ready to Frame Your Windows Beautifully?';
$spoke_cta_text    = 'Schedule a free in-home consultation and explore our exclusive Fonluk drapery fabrics in your own home.';

require ROOT_PATH . '/includes/spoke-page.php';
