<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';

$page_title       = "Window Treatment Company Promise, Aurora IL";
$meta_description = "Why Aurora & Naperville homeowners choose Creative Blinds & Drapes: 23+ years local expertise, free consultation, insured team, and a written warranty.";

$guide_h1    = "The Creative Blinds & Drapes Promise";
$guide_path  = "/guidelines/our-promise/";
$guide_hero_image = "assets/images/carousel/curtain-drape-background-2365x594.jpg";
$guide_hero_image_mobile = "assets/images/carousel/curtain-drape-background-666x577.jpg";
$guide_intro = "What sets our installation service apart in the local community: 23+ years of Aurora-area experience, a genuine free consultation, an insured team, and a written warranty.";

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Guides', 'path' => '/guidelines/'],
    ['name' => 'Our Promise'],
];

$s_intro = <<<'HTML'
<p>There are two types of window treatment businesses serving Aurora and Naperville. The first sells you a product, ships it to your door, and leaves every other decision to you. The second measures, designs, installs, warrants, and stays in your community long enough to honor that warranty. Creative Blinds & Drapes is the second type, and this guide explains exactly what that means in practical terms for you as a homeowner.</p>
HTML;

$s_experience = <<<'HTML'
<p>Creative Blinds & Drapes is a division of Creative Floors Inc., which has served Aurora and the surrounding communities since 2001. That is more than two decades of residential installation experience in the specific market you live in, the same neighborhoods, architectural styles, building periods, and seasonal conditions.</p>
<p>What that experience means in practice: our design team knows which Naperville new-build developments use non-standard window widths driven by standardized exterior elevations. We know which Aurora Victorian-era homes have window frames that have rotated with age and need specific bracket shimming to produce a level installation. We know which developments in Oswego and Yorkville use steel-stud interior walls where a standard drywall screw is not the right anchor choice. This local knowledge does not come from a training manual; it comes from more than 23 years of measuring and installing in the same zip codes.</p>
HTML;

$s_consult = <<<'HTML'
<p>When you book a design consultation with Creative Blinds & Drapes, a qualified designer comes to your home, assesses each window in the actual light conditions it experiences, discusses your functional goals and design preferences, and provides specific product recommendations with your confirmed budget in mind. There is no obligation and no sales pressure. You leave with precise measurements on file, specific product recommendations for each room and window, and a written quote that reflects the actual scope of work.</p>
<ul style="line-height: 1.9;">
<li>Room-by-room assessment of light conditions, privacy needs, and current window condition.</li>
<li>Professional measurement at all nine points per window, recorded and stored in our system.</li>
<li>Product samples brought directly to your home for evaluation in real light conditions.</li>
<li>Mount-type recommendation (inside vs. outside) per window based on sill depth and design goals.</li>
<li>Written quote covering products, installation, and any hardware, with no surprises at project completion.</li>
</ul>
HTML;

$s_products = <<<'HTML'
<p>Our product range is not assembled from a generic national catalog. Every product line was selected for its performance in the specific conditions Chicagoland homeowners face.</p>
<div class="g-table-wrap"><table class="g-table">
<thead><tr><th>Product Line</th><th>Why We Selected It for This Market</th></tr></thead>
<tbody>
<tr><td>Norman Window Fashions shutters</td><td>Woodlore composite resists the humidity swings that warp real wood shutters in Illinois winters and humid summers</td></tr>
<tr><td>Norman Window Fashions cellular shades</td><td>Portrait Honeycomb technology meets the energy efficiency standard required for Zone 5b and 6 climate performance</td></tr>
<tr><td>Norman Window Fashions blinds</td><td>Cordless and motorized lift systems eliminate cord safety risk, certified Best for Kids, relevant for Naperville family households</td></tr>
<tr><td>PES drapery and sheer fabrics</td><td>High-quality polyester resists mildew and UV fade better than natural fibers in high-sun and high-humidity rooms</td></tr>
<tr><td>Norman SmartDial and ShadeAuto motorization</td><td>App and voice control with Alexa and Google, rated for tens of thousands of operating cycles, designed for daily use</td></tr>
</tbody>
</table></div>
HTML;

$s_insured = <<<'HTML'
<p>Every Creative Blinds & Drapes installation is performed by insured professionals and backed by a written workmanship warranty covering any failure attributable to the installation itself. Ask us for documentation of both before any work begins; we provide it without being asked, because we consider full transparency the minimum standard for any home services company operating in your neighborhood.</p>
<p>Our workmanship warranty covers bracket pull-out, leveling error, cord management issues, and operating mechanism calibration at installation. It does not cover normal product wear or damage from misuse, those are covered under the manufacturer warranty, which we manage on your behalf. You do not need to contact Norman Window Fashions directly; that is our responsibility as your installing dealer.</p>
HTML;

$s_coverage = <<<'HTML'
<p>Creative Blinds & Drapes serves every community within a 20-mile radius of our Aurora showroom, including Aurora, Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles, and Plainfield. Serving a defined local radius rather than operating as a national dispatch company means our designers and installers are familiar with the specific neighborhoods, home styles, and building conditions in your area. We do not send a technician from two counties away who is visiting your neighborhood for the first time.</p>
<div class="g-table-wrap"><table class="g-table">
<thead><tr><th>Option</th><th>What You Get</th><th>What You Miss</th></tr></thead>
<tbody>
<tr><td>Online-only retailer</td><td>Competitive product pricing; wide selection</td><td>Professional measurement, installation, warranty, local service</td></tr>
<tr><td>National franchise</td><td>Brand recognition; standardized process</td><td>Local market knowledge; flexibility on product lines</td></tr>
<tr><td>Big-box home improvement store</td><td>Convenience; low initial cost on basic products</td><td>Custom fabrication, design expertise, installation quality, warranty coverage</td></tr>
<tr><td>Creative Blinds & Drapes</td><td>23 years of local experience, custom fabrication, professional installation, written warranty, ongoing local service</td><td>Lower initial price on commodity products, but the long-term cost of a correct installation is always lower than replacing a failed one</td></tr>
</tbody>
</table></div>
HTML;

$guide_sections = [
    ['heading' => '', 'body' => $s_intro],
    ['heading' => '23 Years of Local Installation Experience', 'body' => $s_experience],
    ['heading' => 'A Free In-Home Consultation, Not a Sales Visit', 'body' => $s_consult],
    ['heading' => 'Products Selected for the Aurora and Naperville Market', 'body' => $s_products],
    ['heading' => 'Fully Insured, With a Written Workmanship Guarantee', 'body' => $s_insured],
    ['heading' => 'Local Coverage and How We Compare', 'body' => $s_coverage],
];

$related_links = [
    ['url' => "/about-us/", 'label' => "About Creative Blinds & Drapes"],
    ['url' => "/service-areas/", 'label' => "Our Fox Valley service areas"],
    ['url' => "/window-treatments/", 'label' => "Browse all window treatments"],
    ['url' => "/guidelines/", 'label' => "All window treatment guides"],
];

$faqs = [
    ['q' => "How long has Creative Blinds & Drapes been in business?",
     'a' => "Creative Blinds & Drapes is a division of Creative Floors Inc., which has operated in Aurora, Illinois since 2001. That gives our installation team more than 23 years of local residential experience. Creative Blinds & Drapes brings that same installation expertise and customer service standard to custom window treatments specifically."],
    ['q' => "Are you insured? Can I see proof before work begins?",
     'a' => "Yes, Creative Blinds & Drapes carries full liability insurance. We provide documentation of our insurance coverage and our written workmanship warranty before any installation begins. We consider this a basic obligation to every homeowner we work with, not an optional disclosure."],
    ['q' => "What areas do you serve?",
     'a' => "We serve Aurora, Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles, Plainfield, and all communities within a 20-mile radius of our Aurora showroom at 850 S Frontenac St, Aurora, IL 60504. Call (630) 946-1406 to confirm your specific address."],
    ['q' => "Do you carry products other than Norman Window Fashions?",
     'a' => "Our shutter, blind, and shade range is built around Norman Window Fashions products, selected specifically for their performance in the Chicagoland climate. Our drapery and curtain collection uses premium PES fabrics, including over 70 drapery fabrics and 50 sheer options. During your free in-home consultation, our designer will walk through the full range relevant to your windows and present options matched to your style and budget."],
    ['q' => "What makes Creative Blinds & Drapes different from a franchise company?",
     'a' => "Creative Blinds & Drapes is an independently owned local business, not a franchise operating under a national brand guidelines and product restrictions. Our designers select products based on performance for this specific market, not on franchise-mandated catalogs. Our pricing reflects actual local costs without franchise royalty markups. And our long-term relationship with this community means we have a direct stake in the quality of our work in a way that a franchise model does not create."],
];

$guide_cta_heading = "Experience the Creative Blinds & Drapes Difference";
$guide_cta_text    = "Book a free in-home consultation with a local designer who knows Aurora-area homes. No obligation, no minimum order, samples brought to you.";

require ROOT_PATH . '/includes/guide-page.php';
