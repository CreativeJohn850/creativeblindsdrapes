<?php
require_once dirname(__DIR__, 1) . '/includes/config.php';

$page_title       = "Window Treatment Installer, Aurora & Fox Valley IL";
$meta_description = "Window treatment installer serving Aurora, Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles & Plainfield, IL. Free consultation. (630) 946-1406.";

$spoke_service_type = 'Window Treatment Installation';
$spoke_h1           = 'Window Treatment Installer Serving Aurora & the Fox Valley, IL';
$spoke_path         = '/service-areas/';
$spoke_hero_image   = 'assets/images/carousel/curtain-drape-background-2365x594.jpg';
$spoke_hero_image_mobile = 'assets/images/carousel/curtain-drape-background-666x577.jpg';
$spoke_intro        = 'Locally owned installer of custom blinds, shades, shutters and drapes across Aurora and seven surrounding Fox Valley communities, with free in-home consultation and no travel charges within our 20-mile radius.';

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Service Areas'],
];

$spoke_sections = [
    ['heading' => '', 'body' => '
        <p>Creative Blinds &amp; Drapes is the locally owned window treatment installer for Aurora, Naperville and seven surrounding Fox Valley communities. Every order includes a free in-home consultation, exact-fit custom fabrication and professional installation of blinds, shades, shutters and drapes backed by 23 years of hands-on experience through Creative Floors Inc. We cover a 20-mile radius from our Aurora showroom at 850 S Frontenac St, with no travel charges within the service area.</p>
        <p>Every one of the eight cities below receives the same standard: pre-installation measurement, custom fabrication and expert fitting.</p>'],
    ['heading' => 'Window Treatment Installation by City', 'body' => '
        <div style="overflow-x:auto; margin:20px 0;">
        <table style="width:100%; border-collapse:collapse; min-width:640px;">
            <thead><tr>
                <th style="border:1px solid #ddd; padding:10px 12px; background:var(--primary-teal,#7abd3c); color:#fff; text-align:left;">City</th>
                <th style="border:1px solid #ddd; padding:10px 12px; background:var(--primary-teal,#7abd3c); color:#fff; text-align:left;">Distance / Status</th>
                <th style="border:1px solid #ddd; padding:10px 12px; background:var(--primary-teal,#7abd3c); color:#fff; text-align:left;">Coverage Notes</th>
            </tr></thead>
            <tbody>
                <tr><td style="border:1px solid #ddd; padding:10px 12px;"><a href="' . url('/service-areas/aurora-il/') . '"><strong>Aurora, IL</strong></a></td><td style="border:1px solid #ddd; padding:10px 12px;">Home Base | Showroom</td><td style="border:1px solid #ddd; padding:10px 12px;">Full Norman range, same-week consultation, showroom visits by appointment at 850 S Frontenac St.</td></tr>
                <tr><td style="border:1px solid #ddd; padding:10px 12px;"><a href="' . url('/service-areas/naperville-il/') . '"><strong>Naperville, IL</strong></a></td><td style="border:1px solid #ddd; padding:10px 12px;">8 miles | Full Service</td><td style="border:1px solid #ddd; padding:10px 12px;">All ZIP codes 60540, 60563, 60564 and 60565. Motorized app and voice control. No travel charge.</td></tr>
                <tr><td style="border:1px solid #ddd; padding:10px 12px;"><a href="' . url('/service-areas/oswego-il/') . '"><strong>Oswego, IL</strong></a></td><td style="border:1px solid #ddd; padding:10px 12px;">10 miles | Full Service</td><td style="border:1px solid #ddd; padding:10px 12px;">Route 30 corridor, Boulder Hill and Prairie Point. Consultations within 3 to 5 business days.</td></tr>
                <tr><td style="border:1px solid #ddd; padding:10px 12px;"><a href="' . url('/service-areas/yorkville-il/') . '"><strong>Yorkville, IL</strong></a></td><td style="border:1px solid #ddd; padding:10px 12px;">12 miles | Full Service</td><td style="border:1px solid #ddd; padding:10px 12px;">Blackberry Creek and Grande Reserve. All Norman collections and smart-home motorization.</td></tr>
                <tr><td style="border:1px solid #ddd; padding:10px 12px;"><a href="' . url('/service-areas/batavia-il/') . '"><strong>Batavia, IL</strong></a></td><td style="border:1px solid #ddd; padding:10px 12px;">10 miles | Full Service</td><td style="border:1px solid #ddd; padding:10px 12px;">Downtown historic district and West Wilson Street. Expertise with older window frames.</td></tr>
                <tr><td style="border:1px solid #ddd; padding:10px 12px;"><a href="' . url('/service-areas/geneva-il/') . '"><strong>Geneva, IL</strong></a></td><td style="border:1px solid #ddd; padding:10px 12px;">12 miles | Full Service</td><td style="border:1px solid #ddd; padding:10px 12px;">Third Street, Western Avenue and Geneva Lakes. Historic and contemporary homes.</td></tr>
                <tr><td style="border:1px solid #ddd; padding:10px 12px;"><a href="' . url('/service-areas/st-charles-il/') . '"><strong>St. Charles, IL</strong></a></td><td style="border:1px solid #ddd; padding:10px 12px;">14 miles | Full Service</td><td style="border:1px solid #ddd; padding:10px 12px;">Fox River corridor, downtown and Dunham Road. Motorized options for large windows and patio doors.</td></tr>
                <tr><td style="border:1px solid #ddd; padding:10px 12px;"><a href="' . url('/service-areas/plainfield-il/') . '"><strong>Plainfield, IL</strong></a></td><td style="border:1px solid #ddd; padding:10px 12px;">15 miles | Full Service</td><td style="border:1px solid #ddd; padding:10px 12px;">Lakewood Falls, Whispering Creek and the Renwick corridor. Carillon 55+ cordless options.</td></tr>
            </tbody>
        </table>
        </div>'],
    ['heading' => 'Products Available Across All Service Areas', 'body' => '
        <p>Every city in our service area has access to the full Norman Window Fashions product range. All orders include professional installation.</p>
        <div style="overflow-x:auto; margin:20px 0;">
        <table style="width:100%; border-collapse:collapse; min-width:640px;">
            <thead><tr>
                <th style="border:1px solid #ddd; padding:10px 12px; background:var(--primary-teal,#7abd3c); color:#fff; text-align:left;">Product Category</th>
                <th style="border:1px solid #ddd; padding:10px 12px; background:var(--primary-teal,#7abd3c); color:#fff; text-align:left;">Collections Available</th>
                <th style="border:1px solid #ddd; padding:10px 12px; background:var(--primary-teal,#7abd3c); color:#fff; text-align:left;">Motorized Option</th>
            </tr></thead>
            <tbody>
                <tr><td style="border:1px solid #ddd; padding:10px 12px;"><a href="' . url('/window-treatments/window-shutters/') . '">Custom Shutters</a></td><td style="border:1px solid #ddd; padding:10px 12px;">7 collections: Brightwood, Normandy, Woodlore, Woodlore Plus, PerfectTilt, Specialty Shapes, Bypass</td><td style="border:1px solid #ddd; padding:10px 12px;">PerfectTilt app and voice control</td></tr>
                <tr><td style="border:1px solid #ddd; padding:10px 12px;"><a href="' . url('/window-treatments/window-blinds/') . '">Custom Blinds</a></td><td style="border:1px solid #ddd; padding:10px 12px;">5 styles: faux wood, real wood, aluminum, vertical</td><td style="border:1px solid #ddd; padding:10px 12px;">SmartRise motor, Norman Hub, Alexa and Google</td></tr>
                <tr><td style="border:1px solid #ddd; padding:10px 12px;"><a href="' . url('/window-treatments/shades/') . '">Custom Shades</a></td><td style="border:1px solid #ddd; padding:10px 12px;">6 types: honeycomb, roller, roman, sheer, vertical HC</td><td style="border:1px solid #ddd; padding:10px 12px;">ShadeAuto motor, app, voice control</td></tr>
                <tr><td style="border:1px solid #ddd; padding:10px 12px;"><a href="' . url('/window-treatments/curtains-and-drapes/') . '">Drapes &amp; Curtains</a></td><td style="border:1px solid #ddd; padding:10px 12px;">70+ drapery fabrics, 54 sheers, motorized track</td><td style="border:1px solid #ddd; padding:10px 12px;">Motorized drapery track, app control</td></tr>
                <tr><td style="border:1px solid #ddd; padding:10px 12px;"><a href="' . url('/window-treatments/motorized-window-treatment/') . '">Motorized Treatments</a></td><td style="border:1px solid #ddd; padding:10px 12px;">All categories in motorized configuration</td><td style="border:1px solid #ddd; padding:10px 12px;">Norman Hub, ShadeAuto, Alexa, Google Home</td></tr>
            </tbody>
        </table>
        </div>'],
];

$browse_url   = '/window-treatments/';
$browse_label = 'Browse all window treatments';

$related_links = [
    ['url' => '/window-treatments/window-treatment-installer/', 'label' => 'Window treatment installation'],
    ['url' => '/window-treatments/motorized-window-treatment/', 'label' => 'Motorized window treatments'],
    ['url' => '/window-treatments/window-shutters/', 'label' => 'Custom shutters'],
    ['url' => '/window-treatments/window-blinds/', 'label' => 'Custom blinds'],
    ['url' => '/window-treatments/shades/', 'label' => 'Custom shades'],
];

$faqs = [
    ['q' => 'What areas do you serve as a window treatment installer?',
     'a' => 'We serve eight communities within a 20-mile radius of our Aurora showroom: Aurora, Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles and Plainfield. All eight areas receive full service including free in-home consultation, product samples brought to your home, pre-installation measurement, custom fabrication and professional installation. There are no travel charges within this area. If your city is not on this list, call (630) 946-1406 and we will confirm whether your address falls within our range.'],
    ['q' => 'Is the window treatment installation service the same in all eight cities?',
     'a' => 'Yes. Every installation follows the same five-step process regardless of which Fox Valley city you are in. Our window treatment installer brings the same Norman Window Fashions sample collection, takes precise measurements, provides a written itemised quote, orders custom-fabricated products and completes professional installation in a single appointment.'],
    ['q' => 'Do you install motorized window treatments in Naperville and the surrounding area?',
     'a' => 'Yes. Motorized window treatment installation is available across all eight service areas. We install Norman ShadeAuto motorized shades, PerfectTilt motorized shutters, SmartRise motorized blinds and motorized drapery track systems in every city we cover. Every motorized installation includes Norman Hub pairing, Norman App setup, schedule programming and Amazon Alexa and Google Home voice command testing in a single appointment. No separate technology fee applies.'],
    ['q' => 'How quickly can you schedule a window treatment consultation in my area?',
     'a' => 'For Aurora and Naperville, free in-home consultation appointments are generally available within 2 to 4 business days. For Oswego, Yorkville, Batavia, Geneva, St. Charles and Plainfield, appointments are typically available within 3 to 5 business days. Evening and Saturday morning appointments are available by request for all eight service areas. Call (630) 946-1406 or use the contact form to check current availability for your city.'],
    ['q' => 'Do you charge for travel to Oswego, Yorkville or Batavia?',
     'a' => 'No. There are no travel charges for any city within our 20-mile service radius. The consultation visit, pre-installation measurement and installation appointment are all included in the cost of the order. The written quote provided at the consultation is the total you pay: product at custom dimensions, hardware and installation labour. No additional fees are added based on your location.'],
    ['q' => 'What is the difference between a window treatment installer and buying online?',
     'a' => 'Buying window treatments online delivers a product in a standard size to your door. You then measure, order, remeasure if it does not fit, and install yourself. A professional window treatment installer from Creative Blinds & Drapes visits your home first, measures each window to the exact inside or outside mount dimension, and orders the product to those measurements. The product arrives custom-built for your window, not adjusted to fit. Our installer then mounts it correctly, levels it, programs any motorization and walks you through every operating mode before leaving. Every step is covered in a single point of contact from consultation to finished window.'],
];

$spoke_cta_heading = 'Serving Aurora and the Fox Valley';
$spoke_cta_text    = 'Book a free in-home consultation and we will bring the showroom to your door anywhere in our eight-city service area. No obligation, and no travel charge.';

require ROOT_PATH . '/includes/spoke-page.php';
