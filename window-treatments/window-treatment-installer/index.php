<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';
require_once ROOT_PATH . '/includes/spoke-schema.php';

$page_title       = 'Window Treatment Installation in Aurora & Naperville';
$meta_description = 'Expert window treatment installation in Aurora, IL. Blinds, shades, shutters & drapes measured and installed. Free consult. Call (630) 946-1406.';

$spoke_service_type = 'Window Treatment Installation';
$spoke_h1           = 'Professional Window Treatment Installation in Aurora, Naperville & the Fox Valley';
$spoke_path         = '/window-treatments/window-treatment-installer/';
$spoke_hero_image   = 'assets/images/showroom/displays-cfa.jpeg';
$spoke_intro        = "Creative Blinds & Drapes is Aurora's locally owned window treatment installer, providing professional installation across the Fox Valley for over 23 years. One company, one contact, from first consultation to finished window.";

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Window Treatments', 'path' => '/window-treatments/'],
    ['name' => 'Window Treatment Installation'],
];

// 6-step process - reused for both the on-page section and the HowTo schema.
$howto_steps = [
    ['name' => 'Free In-Home Consultation', 'text' => 'We bring samples to your home, discuss your rooms and recommend options at no cost and no obligation.'],
    ['name' => 'Precise In-Home Measurement', 'text' => 'We measure every window exactly for inside or outside mount before anything is ordered.'],
    ['name' => 'Written Quote with No Hidden Charges', 'text' => 'You receive an itemised written quote that includes installation, with no surprise labour or fitting fees.'],
    ['name' => 'Custom Fabrication', 'text' => 'Your treatments are custom made to your measurements by Norman Window Fashions.'],
    ['name' => 'Professional Installation Day', 'text' => 'Our team mounts, levels, programs and tests every treatment, then leaves a clean workspace.'],
];
$steps_html = '';
$stepNum = 0;
foreach ($howto_steps as $s) {
    $stepNum++;
    $steps_html .= '<li style="margin-bottom: 14px;"><strong>' . sprintf('%02d', $stepNum) . '. ' . htmlspecialchars($s['name']) . '</strong><br>' . htmlspecialchars($s['text']) . '</li>';
}

$spoke_sections = [
    ['heading' => '', 'body' => '
        <p>A beautiful window treatment only performs when it is measured and installed correctly. A blind a half-inch too wide, a drapery rod that is not level, or a shade that binds against the frame turns a premium product into a daily frustration. Every order we supply covers the full process: free in-home measurement, custom fabrication and expert installation of blinds, shades, shutters and drapes by our own trained team.</p>'],
    ['heading' => 'Why Professional Window Treatment Installation Matters', 'body' => '
        <div class="compare-table-wrap">
            <table class="compare-table">
                <thead><tr><th>Risk with DIY or sub-contracted fitting</th><th>How our service removes it</th></tr></thead>
                <tbody>
                    <tr><td>Incorrect measurements and ill-fitting treatments</td><td>We measure every window before fabrication for an exact fit.</td></tr>
                    <tr><td>Brackets screwed into plaster, not studs</td><td>We mount securely into studs and proper anchors.</td></tr>
                    <tr><td>Valance or fascia not level</td><td>We level and align every headrail, rod and fascia.</td></tr>
                    <tr><td>Motorization not paired or programmed</td><td>We pair, program and test all motorized controls on site.</td></tr>
                    <tr><td>A sub-contractor with no product knowledge</td><td>Our installers know every Norman product we fit.</td></tr>
                </tbody>
            </table>
        </div>'],
    ['heading' => 'Our Window Treatment Installation Process', 'body' => '
        <ol style="line-height: 1.7; padding-left: 20px;">' . $steps_html . '</ol>'],
    ['heading' => 'Installation by Product Type', 'body' => '
        <ul style="line-height: 2;">
            <li><a href="' . url('/window-treatments/window-treatment-installer/shutter-installer/') . '">Shutter installation</a>: 7 collections including motorized PerfectTilt, L-Frame, Z-Frame and Deco Frame, specialty shapes and bypass track. <a href="' . url('/window-treatments/window-shutters/') . '">Browse custom shutters</a>.</li>
            <li><a href="' . url('/window-treatments/window-treatment-installer/blind-installer/') . '">Blind installation</a>: faux wood, real wood, aluminum and vertical, with SmartRise cordless, Norman Hub motorization and a child-safe check. <a href="' . url('/window-treatments/window-blinds/') . '">Browse custom blinds</a>.</li>
            <li><a href="' . url('/window-treatments/window-treatment-installer/shades-installation/') . '">Shade installation</a>: roman, roller, honeycomb and sheer, with ShadeAuto, Alexa/Google and Top-Down Bottom-Up. <a href="' . url('/window-treatments/shades/') . '">Browse custom shades</a>.</li>
            <li><a href="' . url('/window-treatments/window-treatment-installer/drapery-installation/') . '">Drapery installation</a>: 70+ fabrics with rod and track mounting, pleat steaming and motorized track pairing. <a href="' . url('/window-treatments/curtains-and-drapes/') . '">Browse custom drapes</a>.</li>
        </ul>'],
    ['heading' => 'Window Treatment Installation Service Area', 'body' => '
        <div class="compare-table-wrap">
            <table class="compare-table">
                <thead><tr><th>City</th><th>Approx. distance from showroom</th></tr></thead>
                <tbody>
                    <tr><td>Aurora</td><td>Home base (0 mi)</td></tr>
                    <tr><td>Naperville</td><td>8 mi</td></tr>
                    <tr><td>Oswego</td><td>10 mi</td></tr>
                    <tr><td>Batavia</td><td>10 mi</td></tr>
                    <tr><td>Yorkville</td><td>12 mi</td></tr>
                    <tr><td>Geneva</td><td>12 mi</td></tr>
                    <tr><td>St. Charles</td><td>14 mi</td></tr>
                    <tr><td>Plainfield</td><td>15 mi</td></tr>
                </tbody>
            </table>
        </div>'],
];

$browse_url   = '/window-treatments/';
$browse_label = 'Explore all window treatments';

$related_links = [
    ['url' => '/window-treatments/window-treatment-installer/blind-installer/', 'label' => 'Blind installation service'],
    ['url' => '/window-treatments/window-treatment-installer/shades-installation/', 'label' => 'Shade installation service'],
    ['url' => '/window-treatments/window-treatment-installer/shutter-installer/', 'label' => 'Shutter installation service'],
    ['url' => '/window-treatments/window-treatment-installer/drapery-installation/', 'label' => 'Drapery installation service'],
    ['url' => '/guidelines/professional-installation/', 'label' => 'Guide: the benefits of professional installation'],
];

$faqs = [
    ['q' => 'What does professional window treatment installation include?',
     'a' => 'It covers the full process: precise in-home measuring, secure and level mounting into studs and proper anchors, motorization programming where applicable and a walkthrough of how to operate your treatments.'],
    ['q' => 'Is installation included in the price, or a separate charge?',
     'a' => 'Installation is included. There are no separate labour, fitting or travel fees, so the written quote you approve is the total price you pay.'],
    ['q' => 'How long does window treatment installation take?',
     'a' => 'A typical job takes one to three hours. A whole-home order of 10 to 15 windows usually takes three to five hours, and motorized treatments add roughly 30 to 60 minutes per room for pairing and testing.'],
    ['q' => 'Can you install motorized treatments and set up smart-home integration?',
     'a' => 'Yes. We pair the Norman Hub, configure the app and test Amazon Alexa and Google Home control, all in a single appointment so your motorized treatments are ready to use when we leave.'],
    ['q' => 'Do you install in Naperville, Oswego and Yorkville?',
     'a' => 'Yes. We cover the full 8-city, 20-mile service area: Aurora, Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles and Plainfield, with no travel charges.'],
    ['q' => 'What is the difference between your installer and a handyman?',
     'a' => 'Our installers have product-specific knowledge of every Norman treatment we fit, and we measure before fabrication so the product is made to fit. A general handyman typically installs whatever arrives, without that product expertise or measurement guarantee.'],
];

$spoke_extra_schema = [
    cbd_howto_schema('Window Treatment Installation Process', $howto_steps),
];

$spoke_cta_heading = 'Ready for a Perfect Fit?';
$spoke_cta_text    = 'Schedule a free in-home consultation and let our team measure and install your window treatments.';

require ROOT_PATH . '/includes/spoke-page.php';
