<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';

$page_title       = "Window Treatment Care & Maintenance Guide, Aurora IL";
$meta_description = "How to clean and maintain blinds, shades, shutters, and drapes in Aurora & Naperville, IL. Seasonal tips for the Chicagoland climate, humidity, and UV.";

$guide_h1    = "Long-Term Window Treatment Care & Maintenance";
$guide_path  = "/guidelines/care-and-maintenance/";
$guide_hero_image = "assets/images/carousel/curtain-drape-background-2365x594.jpg";
$guide_hero_image_mobile = "assets/images/carousel/curtain-drape-background-666x577.jpg";
$guide_intro = "How to protect your investment in the Chicagoland climate: product-by-product cleaning, humidity and UV management, and when to call for service instead of replacing.";

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Guides', 'path' => '/guidelines/'],
    ['name' => 'Care & Maintenance'],
];

$s_intro = <<<'HTML'
<p>Window treatments in Aurora and Naperville face maintenance challenges that homeowners in more temperate climates never encounter. Indoor humidity swings from below 20 percent in a heated Illinois winter to 80 percent during a humid July. Dust carried on Midwest prairie winds accumulates rapidly on horizontal surfaces. UV radiation from a low winter sun shines directly into south-facing rooms between October and March. A consistent, product-appropriate maintenance routine protects your investment and extends the life of every treatment by years.</p>
HTML;

$s_cleaning = <<<'HTML'
<div class="g-table-wrap"><table class="g-table">
<thead><tr><th>Treatment Type</th><th>Cleaning Method</th><th>Recommended Frequency</th></tr></thead>
<tbody>
<tr><td>Cellular / Honeycomb Shades</td><td>Compressed air or low-suction vacuum with brush attachment along cell openings. Spot-clean fabric with mild dish soap and cold water on a clean cloth. Do not saturate the fabric.</td><td>Monthly light dusting; spot clean as needed</td></tr>
<tr><td>Roller Shades</td><td>Wipe with a clean, lightly dampened microfiber cloth in long horizontal strokes from top to bottom. Do not soak the fabric or allow water into the roller mechanism.</td><td>Monthly or when visible dust accumulates</td></tr>
<tr><td>Faux Wood Blinds</td><td>Microfiber cloth, slat by slat, with slats angled closed in one direction, then repeat in the other direction. Avoid excess moisture.</td><td>Weekly dusting; monthly wipe-down</td></tr>
<tr><td>Real Wood Blinds</td><td>Dry microfiber cloth only, slat by slat. Avoid all moisture. Apply a wood-safe furniture polish once per year to prevent surface drying.</td><td>Weekly dusting; annual polish</td></tr>
<tr><td>Plantation Shutters</td><td>Dry microfiber cloth or feather duster along each louver. Composite shutters tolerate a lightly damp cloth; wood shutters, dry only with annual polish.</td><td>Bi-weekly dusting; annual polish (wood only)</td></tr>
<tr><td>Roman Shades</td><td>Vacuum with an upholstery attachment on low suction. Spot-clean with a clean cloth and cold water only. Most Roman shade fabrics are not washable.</td><td>Monthly vacuuming; spot clean promptly</td></tr>
<tr><td>Custom Drapes & Curtains</td><td>Vacuum with upholstery attachment on lowest suction between professional cleans. Dry cleaning is recommended for most drapery fabrics. Do not machine wash.</td><td>Vacuum quarterly; professional clean annually</td></tr>
</tbody>
</table></div>
HTML;

$s_humidity = <<<'HTML'
<p>Indoor humidity is one of the most damaging and least-discussed factors in window treatment maintenance. Aurora and Naperville homes experience extreme humidity swings across the calendar year, and different treatment materials respond to those swings differently.</p>
<h3>Real wood treatments in low humidity</h3>
<p>Forced-air heating drives indoor relative humidity to 20 percent or below in January and February. At these levels, real wood blinds and shutters expand and contract with each cycle of humidity change. Over a single winter season without humidification, untreated wood blinds can develop micro-cracks in the finish, joint separation at the stile, and surface chalking that cannot be reversed without refinishing. Maintaining indoor humidity above 35 percent prevents these conditions. If humidification is not practical, composite alternatives such as the Woodlore shutter range and cordless faux wood blinds offer the look of wood without the humidity sensitivity.</p>
<h3>Fabric treatments in high humidity</h3>
<p>Drapery, Roman shade, and cellular shade fabrics are susceptible to mildew if exposed to sustained humidity above 70 percent, particularly in bathrooms and kitchens without adequate ventilation. Ensure proper ventilation in any room where fabric treatments are installed near a moisture source. Polyester-based fabrics resist mildew better than natural fibers; our curtain and drape collection uses high-quality PES (polyester) fabrics specifically for this reason.</p>
HTML;

$s_uv = <<<'HTML'
<p>UV radiation fades drapery fabric, cellular shade material, and Roman shade fabric faster than any other environmental factor. South-facing rooms receive direct, low-angle winter sun from October through March, the same months when UV damage is often underestimated because air temperatures are cold. Fabrics in these exposures can show measurable color shift in as little as 12 months without UV protection.</p>
<div class="g-table-wrap"><table class="g-table">
<thead><tr><th>UV Protection Strategy</th><th>How It Works</th></tr></thead>
<tbody>
<tr><td>Solar roller shades (1-5% openness factor)</td><td>Blocks 95 to 99% of UV at the window, protecting furnishings and flooring behind the shade</td></tr>
<tr><td>Room-darkening cellular shades</td><td>Dual-purpose: insulates against cold transfer and blocks UV radiation when lowered</td></tr>
<tr><td>Layered treatments: sheer plus drape</td><td>Sheer filters direct UV; the drape can be closed for full protection during peak sun hours</td></tr>
<tr><td>Window film (applied to glass)</td><td>A supplementary option for south-facing rooms where no treatment can be added; reduces UV without eliminating natural light</td></tr>
</tbody>
</table></div>
HTML;

$s_seasonal = <<<'HTML'
<h3>Winter (December through February)</h3>
<p>Close cellular shades at night on all exterior-facing windows to reduce cold transfer at the glass surface. Even a single-cell shade creates a meaningful thermal barrier. Leave south-facing treatments open during daylight hours to allow passive solar heat gain. For motorized shades, use the scheduling function to automate this routine.</p>
<h3>Summer (June through August)</h3>
<p>Lower solar shades or room-darkening roller shades on south- and west-facing windows between noon and 4 pm. This is the window of peak solar heat gain. Closing the treatment before the heat enters the room is more effective than closing it after the room has already warmed.</p>
<h3>Spring and autumn transition periods</h3>
<p>Clean all treatments during the spring and autumn transitions, before and after the seasons of heaviest use. These intervals catch accumulated dust before summer allergen season and remove summer grime before treatments are used in the closed position throughout winter.</p>
HTML;

$s_service = <<<'HTML'
<p>Window treatments are mechanical products. Knowing when to seek service versus replacement saves money and extends the life of products that still have years of service remaining.</p>
<p><strong>Call for service, do not replace:</strong></p>
<ul style="line-height: 1.9;">
<li>A blind or shade with a visible tilt that does not correct with manual adjustment, usually a cord lock or spring tension issue, not a product failure.</li>
<li>A shutter panel that binds or clicks when opening or closing, usually a hinge adjustment or frame alignment correction.</li>
<li>A motorized shade that stops responding to the remote or app, usually a motor pairing reset or battery replacement.</li>
<li>A broken or frayed lift cord, a standard service repair covered under most manufacturer warranties.</li>
</ul>
<p><strong>Consider replacement when:</strong></p>
<ul style="line-height: 1.9;">
<li>The fabric shows permanent color shift, holes, or deformation that cleaning cannot correct.</li>
<li>A wood treatment has warped beyond what adjustment can correct.</li>
<li>The mechanical system has been repaired more than twice and continues to fail; the operating mechanism has exceeded its rated cycle life.</li>
</ul>
HTML;

$guide_sections = [
    ['heading' => '', 'body' => $s_intro],
    ['heading' => 'Cleaning Guide by Treatment Type', 'body' => $s_cleaning],
    ['heading' => 'Humidity Management in Chicagoland Homes', 'body' => $s_humidity],
    ['heading' => 'UV Exposure and Fabric Longevity', 'body' => $s_uv],
    ['heading' => 'Seasonal Adjustment Routines', 'body' => $s_seasonal],
    ['heading' => 'When to Call for Service or Replacement', 'body' => $s_service],
];

$related_links = [
    ['url' => "/window-treatments/window-shutters/", 'label' => "Composite and wood shutters"],
    ['url' => "/window-treatments/shades/", 'label' => "Cellular and roller shades"],
    ['url' => "/window-treatments/curtains-and-drapes/", 'label' => "Custom drapes and curtains"],
    ['url' => "/guidelines/", 'label' => "All window treatment guides"],
];

$faqs = [
    ['q' => "How often should I have my drapes professionally cleaned?",
     'a' => "For most drapery fabrics in a residential setting, professional dry cleaning once per year is sufficient. In rooms with pets, smokers, or heavy cooking odors, twice per year is recommended. Never machine wash drapery panels, the weight and length of most custom drapes cause fabric damage in a residential washing machine. Between professional cleans, vacuum with an upholstery attachment on the lowest suction setting, working from top to bottom."],
    ['q' => "My cellular shades look dusty but I am worried about water damage. What do I do?",
     'a' => "Start with compressed air or a low-suction vacuum fitted with a soft brush attachment. Hold the shade extended and work along each cell opening from top to bottom. For spot stains, use a clean white cloth lightly dampened with cold water and a drop of mild dish soap. Blot the stain; do not rub. Allow the fabric to air dry completely before raising the shade. Avoid steam cleaning or soaking cellular shades, moisture trapped inside the cells promotes mildew growth."],
    ['q' => "Do composite shutters need the same maintenance as wood shutters?",
     'a' => "No. Composite shutters such as the Woodlore range require less maintenance than real wood shutters. A dry microfiber cloth removes dust from the louvers; a lightly dampened cloth handles surface grime. No wood polish is needed or recommended. The practical advantage of composite for Aurora and Naperville homeowners is that no humidity management is required; Woodlore shutters are dimensionally stable across the full range of indoor humidity these homes experience."],
];

$guide_cta_heading = "Questions About Caring for Your Treatments?";
$guide_cta_text    = "We help you choose low-maintenance products suited to the Chicagoland climate. Book a free in-home consultation, no obligation, samples brought to you.";

require ROOT_PATH . '/includes/guide-page.php';
