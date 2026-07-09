<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';

$page_title       = "Professional Window Measurement Guide, Aurora IL";
$meta_description = "Why professional window measurement is non-negotiable for custom treatments in Aurora & Naperville. Avoid light gaps, mechanical failure & costly remakes.";

$guide_h1    = "The Precision Measurement Difference for Aurora Homes";
$guide_path  = "/guidelines/precision-measurement/";
$guide_hero_image = "assets/images/carousel/curtain-drape-background-2365x594.jpg";
$guide_hero_image_mobile = "assets/images/carousel/curtain-drape-background-666x577.jpg";
$guide_intro = "Why professional sizing beats DIY for your unique window shapes, and how the nine-point measurement standard prevents light gaps, binding, and costly remakes.";

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Guides', 'path' => '/guidelines/'],
    ['name' => 'Precision Measurement'],
];

$s_intro = <<<'HTML'
<p>Professional measurement is non-negotiable for custom window treatments. A margin of error as small as one-quarter of an inch in the wrong direction causes light gaps along the frame, prevents smooth mechanical operation, or results in a shade that cannot seat inside the casing at all. At that point the treatment must be remade, and the homeowner pays twice. Our designers measure every opening correctly the first time, so you never face that situation.</p>
HTML;

$s_standard = <<<'HTML'
<p>Every window our team measures is recorded at nine separate points, three widths and three heights, not at a single center point. This accounts for the reality that very few windows are perfectly square, especially in Aurora homes built before 1970 and in newer Naperville developments where initial settling has already begun.</p>
<ul style="line-height: 1.9;">
<li><strong>Width measurements:</strong> top of the opening (below the head jamb), middle of the opening, and bottom of the opening (above the sill).</li>
<li><strong>Height measurements:</strong> left side (head jamb to sill), center of the opening, and right side (head jamb to sill).</li>
</ul>
<p>The narrowest width and shortest height are used for inside-mount orders so the treatment clears the casing. The widest width and tallest height are used for outside-mount orders to guarantee full coverage. This single discipline eliminates the most common cause of custom blind returns.</p>
HTML;

$s_diy = <<<'HTML'
<p>Most homeowners measure once, at the center of the window, using a standard tape measure. That approach misses out-of-square openings, crown moulding intrusions at the top of the casing, and baseboards or sill depths that affect bracket placement. It also misses the deduction required for inside-mount products: every manufacturer specifies a different deduction per product type, and applying the wrong deduction produces a treatment that binds in the frame on the first operation.</p>
<div class="g-table-wrap"><table class="g-table">
<thead><tr><th>Common DIY measurement error</th><th>Consequence</th></tr></thead>
<tbody>
<tr><td>Single center measurement only</td><td>Out-of-square opening causes uneven gaps on one or both sides</td></tr>
<tr><td>Forgetting the manufacturer deduction</td><td>Blind or shade binds in the frame and cannot operate properly</td></tr>
<tr><td>Not checking sill depth</td><td>Inside-mount product ordered too deep for available casing clearance</td></tr>
<tr><td>Rounding to the nearest inch</td><td>Gap at frame edge allows light bleed and reduces thermal performance</td></tr>
<tr><td>Not accounting for obstruction clearance</td><td>Headrail collides with window crank handle or lock hardware</td></tr>
</tbody>
</table></div>
HTML;

$s_specialty = <<<'HTML'
<h3>Arched and circular windows</h3>
<p>Arched, circular, and elliptical windows require a physical template, not a tape measurement. Our team applies a flexible template material directly to the opening and traces the exact curve. That template goes to the manufacturer for custom fabrication. Off-the-shelf products adapted to fit an arch always leave gaps at the curved section. Custom specialty-shape shutters from Norman Window Fashions are built to exact template specifications, no adaptation required.</p>
<h3>Bay windows</h3>
<p>A bay window consists of three or more panels set at varying angles, typically 30, 45, or 90 degrees from the wall plane. Each panel requires an independent measurement. The installer must also account for the stacking space each treatment needs when raised; if that space is not calculated per panel, raised treatments overlap and block the view or collide with adjacent panels.</p>
<h3>Sliding glass doors and wide openings</h3>
<p>Sliding glass doors and openings wider than 96 inches require vertical blinds, bypass shutters, or panel track systems. Each configuration has specific clearance requirements at the wall or pocket where panels stack when the door is open. Measuring for these correctly requires knowing the door stack direction and the depth of the wall pocket, both of which are confirmed on-site.</p>
<h3>Sidelights and transom windows</h3>
<p>Narrow sidelights flanking entry doors can be as small as 8 inches wide. Products available at this width are limited, and bracket placement requires precision to avoid drilling into the door frame itself. Transom windows above doors require treatments that can be accessed from below, which affects both product selection and the type of lift mechanism specified.</p>
HTML;

$s_visit = <<<'HTML'
<ul style="line-height: 1.9;">
<li>Our designer walks through each window or door with you to confirm mount preference and product type.</li>
<li>Each opening is measured at all nine points and recorded in our ordering system immediately.</li>
<li>Sill depth, bracket clearance, and any hardware obstructions are documented per window.</li>
<li>For specialty shapes, a template is produced on-site and stored with the order.</li>
<li>A written order confirmation is prepared and reviewed with you before any product is submitted to the manufacturer.</li>
</ul>
<p>There is no charge for the measurement visit, and the measurements on file are yours to reference for the life of the treatment.</p>
HTML;

$guide_sections = [
    ['heading' => '', 'body' => $s_intro],
    ['heading' => 'The Nine-Point Measurement Standard', 'body' => $s_standard],
    ['heading' => 'Why DIY Measurement Falls Short', 'body' => $s_diy],
    ['heading' => 'Specialty Windows: Where Professional Measurement Is Critical', 'body' => $s_specialty],
    ['heading' => 'What Happens During a Measurement Visit', 'body' => $s_visit],
];

$related_links = [
    ['url' => "/window-treatments/window-treatment-installer/", 'label' => "Professional installation service"],
    ['url' => "/window-treatments/window-shutters/", 'label' => "Custom shutters and specialty shapes"],
    ['url' => "/window-treatments/window-blinds/", 'label' => "Custom blinds"],
    ['url' => "/guidelines/", 'label' => "All window treatment guides"],
];

$faqs = [
    ['q' => "How accurate does a window measurement need to be for custom blinds?",
     'a' => "For inside-mount products, measurements should be accurate to one-eighth of an inch. A quarter-inch error in either dimension can prevent proper operation. Our designers use laser measuring tools for openings above 72 inches tall and standard precision tape measures for smaller windows, recording all nine data points per opening."],
    ['q' => "Can I measure my windows myself and then order from Creative Blinds & Drapes?",
     'a' => "You can, but we strongly recommend against it for custom products. The manufacturer deduction required for each product type, the amount subtracted from the opening measurement to ensure the blind clears the frame, varies by product line and cell type. Applying the wrong deduction means the treatment does not fit. Professional measurement is included at no charge with every Creative Blinds & Drapes quote, so there is no cost reason to measure yourself."],
    ['q' => "What if my windows are not standard sizes?",
     'a' => "Non-standard sizes are standard for us. Aurora and Naperville homes include older properties with unique custom openings, modern builds with oversized picture windows, and every size between them. All of the products Creative Blinds & Drapes carries are custom-fabricated to the measured opening, there are no pre-set sizes, and there is no surcharge for non-standard dimensions."],
];

$guide_cta_heading = "Book a Free, No-Charge Measurement";
$guide_cta_text    = "Our designer measures every opening at nine points and confirms the order with you before anything is made. No obligation, samples brought to your home.";

require ROOT_PATH . '/includes/guide-page.php';
