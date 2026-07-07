<?php
require_once dirname(__DIR__, 3) . '/includes/config.php';

$page_title       = 'Roman Shades in Aurora, IL';
$meta_description = 'Custom roman shades in Aurora, IL. Soft fabric folds, flat & hobbled styles, light-filtering to blackout liners, cordless lift. Free in-home measure.';

$spoke_service_type = 'Roman Shades';
$spoke_h1           = 'Roman Shades in Aurora, IL';
$spoke_path         = '/window-treatments/shades/roman-shades/';
$spoke_hero_image   = 'assets/products/centerpiece_roman/01-Roman.jpg';
$spoke_intro        = 'The warmth of fabric drapery with the tidy function of a shade, custom roman shades tailored to your Aurora windows in flat and hobbled fold styles.';

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Window Treatments', 'path' => '/window-treatments/'],
    ['name' => 'Shades', 'path' => '/window-treatments/shades/'],
    ['name' => 'Roman Shades'],
];

$spoke_sections = [
    ['heading' => '', 'body' => '
        <p>Roman shades give you the soft, layered look of drapery in a compact, easy-to-operate shade. As you raise the shade, the fabric gathers into elegant horizontal folds; as you lower it, the panel falls smooth and flat against the window. That combination of texture and tidiness makes roman shades a favorite for living rooms, dining rooms, and bedrooms where homeowners want a decorator finish without full-length curtains.</p>
        <p>Every roman shade from Creative Blinds &amp; Drapes is custom-sewn to your window and your fabric choice, so the folds hang evenly and the color suits your room.</p>'],
    ['heading' => 'Flat fold vs. hobbled fold', 'body' => '
        <ul style="line-height: 2;">
            <li><strong>Flat fold</strong>: crisp, tailored horizontal pleats for a clean, contemporary look.</li>
            <li><strong>Hobbled (teardrop) fold</strong>: soft cascading loops that stay full even when the shade is down, for a richer, more traditional feel.</li>
        </ul>
        <p>Add a light-filtering or blackout liner to control privacy and light without changing the face fabric you love.</p>'],
    ['heading' => 'Why choose custom roman shades', 'body' => '
        <ul style="line-height: 2;">
            <li>Designer fabric look with the convenience of a shade</li>
            <li>Hundreds of fabrics, patterns, and textures</li>
            <li>Optional blackout lining for bedrooms</li>
            <li>Child-safe cordless and motorized lifts</li>
            <li>Coordinates beautifully with drapery panels</li>
        </ul>'],
    ['heading' => 'Our process: consultation to installation', 'body' => '
        <p>During a <strong>free in-home consultation</strong> we bring fabric and fold samples so you can see how flat and hobbled styles look in your space. We then <strong>measure each window precisely</strong> and, once your shades are made, <strong>install them professionally</strong> and confirm smooth, even operation.</p>'],
];

$browse_url   = '/window-treatments/shades/';
$browse_label = 'Browse our shade collection';

$related_links = [
    ['url' => '/window-treatments/shades/roller-shades/', 'label' => 'Roller shades'],
    ['url' => '/window-treatments/curtains-and-drapes/draperies/', 'label' => 'Custom draperies'],
    ['url' => '/window-treatments/shades/honeycomb-shades/', 'label' => 'Honeycomb shades'],
    ['url' => '/service-areas/aurora-il/', 'label' => 'Window treatments in Aurora, IL'],
];

$faqs = [
    ['q' => 'Can roman shades block out light for a bedroom?',
     'a' => 'Yes. We can add a blackout liner behind your chosen face fabric, so you keep the decorative look while significantly reducing incoming light. Pairing a blackout liner with a snug fit is ideal for bedrooms and nurseries.'],
    ['q' => 'What is the difference between flat and hobbled roman shades?',
     'a' => 'Flat-fold roman shades pull up into crisp, tailored pleats for a modern look, while hobbled shades keep soft cascading loops of fabric even when lowered, giving a fuller, more traditional appearance.'],
    ['q' => 'Are roman shades child-safe?',
     'a' => 'They can be. We offer cordless and motorized lift systems that eliminate exposed cords, which is the recommended choice for homes with children or pets.'],
    ['q' => 'Do you make roman shades to match my drapery?',
     'a' => 'Often, yes. Many of our fabrics can be used for both roman shades and drapery panels, so you can coordinate treatments across a room. We will help you plan this during your in-home consultation.'],
];

$spoke_cta_heading = 'Ready for a Designer Window Look?';
$spoke_cta_text    = 'Schedule a free in-home consultation and see roman shade fabrics and fold styles in your own room.';

require ROOT_PATH . '/includes/spoke-page.php';
