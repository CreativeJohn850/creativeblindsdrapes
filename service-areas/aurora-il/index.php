<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';

$page_title       = "Window Treatment Installer in Aurora, IL";
$meta_description = "Aurora's locally owned window treatment installer. Custom shutters, blinds, shades & drapes. Free in-home consultation. Call (630) 946-1406.";

$sa_h1          = "Window Treatment Installer in Aurora, IL";
$sa_path        = "/service-areas/aurora-il/";
$sa_area_served = ["Aurora"];
$sa_hero_image  = "assets/images/carousel/curtain-drape-background-2365x594.jpg";
$sa_hero_image_mobile = "assets/images/carousel/curtain-drape-background-666x577.jpg";
$sa_hero_intro  = "Creative Blinds & Drapes is Aurora's locally owned window treatment installer, operating from our showroom at 850 S Frontenac St. We design and install custom shutters, blinds, shades and drapes from Norman Window Fashions across all Aurora ZIP codes, backed by 23 years of experience through Creative Floors Inc.";

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Service Areas', 'path' => '/service-areas/'],
    ['name' => 'Aurora, IL'],
];

$sa_coverage_heading = "Window Treatment Installation Across Aurora, IL";
$sa_coverage_intro   = "We install window treatments in Aurora across every neighborhood and ZIP code. Our installer knows Aurora's housing stock: from the historic bungalows along the Fox River to the newer construction in Stonebridge and Oakhurst, each home type brings its own window profile and mounting requirement.";
$sa_neighborhood_cols = ["Aurora Neighborhood / Area", "ZIP Code", "Common Window Profile", "Recommended Products"];
$sa_neighborhoods = [
    ['area' => "Downtown Aurora & Fox River Corridor", 'zone' => "60505", 'profile' => "Historic double-hung and casement windows, older plaster walls", 'products' => "Specialty shape shutters, composite Woodlore, inside-mount honeycomb shades"],
    ['area' => "Stonebridge & Oakhurst", 'zone' => "60504", 'profile' => "Contemporary new-build frames, large open-plan windows", 'products' => "Motorized roller shades, faux wood blinds"],
    ['area' => "Lincoln Crossing & Wheatlands", 'zone' => "60504", 'profile' => "Newer construction, consistent frame sizes, energy focus", 'products' => "Triple-cell honeycomb shades, PerfectTilt motorized shutters"],
    ['area' => "Riddle Highlands & West Side", 'zone' => "60506", 'profile' => "Mix of ranch-style and split-level, varied window sizes", 'products' => "Wood blinds, roman shades, composite shutters with outside mount"],
    ['area' => "River Valley & Orchard Road Corridor", 'zone' => "60506 / 60502", 'profile' => "Larger lots, wide windows and patio slider doors", 'products' => "Vertical blinds, motorized drapes, Synchrony vertical blinds"],
    ['area' => "North Aurora adjacent (Frontenac area)", 'zone' => "60504", 'profile' => "Our home ZIP. Showroom visits available by appointment.", 'products' => "Full Norman collection available for showroom comparison"],
    ['area' => "Eola & Sugar Grove border", 'zone' => "60502", 'profile' => "Newer subdivisions, standard frame sizes", 'products' => "Honeycomb shades, faux wood blinds, Soluna roller shades"],
];

$sa_products_heading = "Custom Window Treatments Available in Aurora, IL";
$sa_products_intro   = "All five Norman Window Fashions product categories are available for Aurora residents. Professional installation in Aurora is included on every order.";
$sa_products = [
    [
        'name' => "Custom Shutters in Aurora", 'badge' => "7 Collections | Wood & Composite",
        'intro' => "Shutters for Aurora homes from real wood (Brightwood, Normandy) and moisture-resistant composite (Woodlore, Woodlore Plus). PerfectTilt motorized shutters available.",
        'features' => [
            "Real wood shutters: Brightwood and Normandy for Aurora living rooms and studies",
            "Composite shutters: Woodlore and Woodlore Plus for Aurora kitchens and bathrooms",
            "PerfectTilt motorized shutters: app and voice control via Norman Hub",
            "Specialty shape shutters for Aurora's older arched and angled windows",
            "Bypass shutters for patio slider doors in Aurora homes",
            "Free in-home measurement across all Aurora ZIP codes",
        ],
        'browse_url' => "/window-treatments/window-shutters/", 'browse_label' => "Browse custom shutters in Aurora",
    ],
    [
        'name' => "Custom Blinds in Aurora", 'badge' => "5 Styles | Cordless & Motorized",
        'intro' => "Faux wood, real wood, aluminum and vertical blinds installed across Aurora. Child-safe cordless systems and motorized upgrades for contemporary Aurora builds.",
        'features' => [
            "Faux wood blinds for Aurora kitchens and bathrooms: moisture-resistant composite",
            "Real wood Normandy blinds for Aurora living rooms and dining rooms",
            "CityLights aluminum blinds for Aurora home offices and utility rooms",
            "Synchrony vertical blinds for Aurora patio slider doors",
            "Motorized blind upgrade: Norman Hub, Alexa and Google Home",
            "Inside and outside mount for all Aurora window frame types",
        ],
        'browse_url' => "/window-treatments/window-blinds/", 'browse_label' => "Browse custom blinds in Aurora",
    ],
    [
        'name' => "Custom Shades in Aurora", 'badge' => "6 Types | Energy-Efficient Options",
        'intro' => "Roller, roman, honeycomb and sheer shades installed across Aurora. Triple-cell honeycomb shades provide insulation against Aurora's cold Fox Valley winters.",
        'features' => [
            "Portrait Honeycomb shades: triple cell for Aurora winter insulation",
            "Soluna Roller shades: sheer to blackout for Aurora bedrooms",
            "Centerpiece Roman shades: flat and hobbled fold for Aurora living rooms",
            "PerfectSheer shades: privacy with diffused light for Aurora street-facing windows",
            "ShadeAuto motorized shades: app and voice control for Aurora smart homes",
            "Inside mount shades for Aurora's newer construction standard frames",
        ],
        'browse_url' => "/window-treatments/shades/", 'browse_label' => "Browse custom shades in Aurora",
    ],
    [
        'name' => "Custom Drapes & Curtains in Aurora", 'badge' => "70+ Fabrics | Motorized Track",
        'intro' => "Custom made curtains and drapes for Aurora homes from 70+ Fonluk drapery fabrics. Motorized drapery track available for Aurora rooms with high or wide windows.",
        'features' => [
            "Custom made curtains in Aurora: fabricated to your exact window dimensions",
            "Blackout drapes for Aurora bedrooms: BLACKOUT_SATIN and ASTAR_DIMOUT fabrics",
            "Sheer curtains: 54 fabric options for layered Aurora window treatments",
            "Motorized drapery track for Aurora's open-plan living spaces",
            "Professional drapery installation in Aurora: rod, track and panel dressing",
            "70+ drapery fabrics available at our Aurora showroom by appointment",
        ],
        'browse_url' => "/window-treatments/curtains-and-drapes/", 'browse_label' => "Browse custom drapes & curtains in Aurora",
    ],
];

$sa_trust = ["Aurora Showroom", "Same-Week Consult", "23 Years in Aurora", "Installation Included"];

$sa_process_heading = "Window Treatment Installation in Aurora: What to Expect";
$sa_process_intro   = "Every window treatment installation in Aurora follows a fixed process. The same Aurora-based team handles everything from consultation to final fitting: one contact, one process, one finished window.";
$sa_process = [
    ['step' => "Free In-Home Consultation", 'what' => "Our Aurora-based installer visits your home with the full Norman Window Fashions sample collection.", 'detail' => "Same-week availability for Aurora ZIP codes 60502-60506. Showroom at 850 S Frontenac St available by appointment Mon-Fri."],
    ['step' => "Pre-Installation Measurement", 'what' => "Every window measured to inside or outside mount specifications.", 'detail' => "Aurora's older neighborhoods often have non-standard frame depths. We check every window before fabrication."],
    ['step' => "Written Quote", 'what' => "Itemised quote covering product, hardware and installation at no hidden charges.", 'detail' => "Quote delivered same-day or next business day for all Aurora consultations."],
    ['step' => "Custom Fabrication", 'what' => "Products fabricated to exact Aurora window measurements at Norman's factory.", 'detail' => "Lead time: 3-5 weeks for shades and blinds, 4-6 weeks for shutters, confirmed at consultation."],
    ['step' => "Installation Day", 'what' => "Installer arrives with completed order and all required hardware for your Aurora address.", 'detail' => "Installer is Aurora-based. Arrival window confirmed 24 hours before appointment."],
];

$related_links = [
    ['url' => "/window-treatments/window-treatment-installer/", 'label' => "Window treatment installation"],
    ['url' => "/window-treatments/motorized-window-treatment/", 'label' => "Motorized window treatments"],
    ['url' => "/service-areas/", 'label' => "All service areas"],
    ['url' => "/contact/", 'label' => "Get a free quote"],
];

$faqs = [
    ['q' => "Where is your Aurora, IL window treatment showroom located?",
     'a' => "Our showroom is at 850 S Frontenac St, Aurora, IL 60504, off the Frontenac Street corridor near the Fox Valley Mall area. We are open Monday through Friday 9am to 6pm and Saturday 10am to 1pm. Showroom visits are by appointment. Call (630) 946-1406 to schedule a visit, or we can come to you with the full Norman Window Fashions sample collection at no charge."],
    ['q' => "What Aurora ZIP codes do you serve?",
     'a' => "We serve all Aurora ZIP codes: 60502, 60503, 60504, 60505 and 60506. This covers every Aurora neighborhood from the downtown Fox River corridor and Riddle Highlands on the west side, through Stonebridge, Oakhurst and Lincoln Crossing on the east side, to the Frontenac, Wheatlands and Eola border areas in the south. If you are unsure whether your address falls within our service area, call (630) 946-1406 and we will confirm immediately."],
    ['q' => "How quickly can you schedule a window treatment consultation in Aurora?",
     'a' => "For Aurora residents, same-week consultation appointments are generally available. Our showroom and our installer are both based in Aurora at 850 S Frontenac St, giving us the most responsive local scheduling in the area. Evening appointments are available by request. Call (630) 946-1406 or use the contact form to check current availability."],
    ['q' => "Do you install motorized window treatments in Aurora, IL?",
     'a' => "Yes. Motorized window treatment installation in Aurora covers all Norman ShadeAuto shades, PerfectTilt motorized shutters, SmartRise motorized blinds and motorized drapery track systems. Every motorized installation includes Norman Hub mounting, app setup, schedule programming and Amazon Alexa and Google Home voice command testing in a single appointment. Because we are Aurora-based, same-week motorized installation appointments are often available."],
    ['q' => "What makes Creative Blinds & Drapes different from other Aurora window treatment companies?",
     'a' => "Three things define the Creative Blinds & Drapes service for Aurora homeowners. First, our showroom is at 850 S Frontenac St in Aurora, meaning your installer is Aurora-based and knows the local housing stock. Second, every product we sell is installed by our own team: one point of contact from consultation to finished window. Third, we carry the full Norman Window Fashions product line across shutters, blinds, shades and drapes, with 23 years of installation experience through Creative Floors Inc."],
    ['q' => "How much do window treatments cost in Aurora, IL?",
     'a' => "Aurora window treatment pricing depends on product type, collection, window size and operating system. As a starting guide: cordless faux wood blinds begin at approximately $150 per window installed; composite Woodlore shutters from approximately $350 per window; motorized roller shades from approximately $350 per window; custom made curtains from approximately $200 per panel. All prices include professional installation in Aurora with no hidden labour charges. The most accurate figure comes from the free in-home consultation, where we measure every window and provide a written itemised quote at no obligation."],
];

$sa_cta_heading = "Aurora's Local Window Treatment Installer";
$sa_cta_text    = "Book a free in-home consultation and we will bring the full Norman sample collection to your Aurora home. No obligation, and samples brought to you.";

require ROOT_PATH . '/includes/service-area-page.php';
