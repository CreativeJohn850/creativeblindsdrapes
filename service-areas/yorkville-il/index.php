<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';

$page_title       = "Window Treatment Installer in Yorkville, IL";
$meta_description = "Yorkville, IL window treatment installer. Custom shutters, blinds, shades & drapes. Free in-home consultation, no travel charge. Call (630) 946-1406.";

$sa_h1          = "Window Treatment Installer in Yorkville, IL";
$sa_path        = "/service-areas/yorkville-il/";
$sa_area_served = ["Yorkville"];
$sa_hero_image  = "assets/images/carousel/curtain-drape-background-2365x594.jpg";
$sa_hero_image_mobile = "assets/images/carousel/curtain-drape-background-666x577.jpg";
$sa_hero_intro  = "Creative Blinds & Drapes serves Yorkville from our Aurora showroom, 12 miles away. We design and install custom shutters, blinds, shades and drapes from Norman Window Fashions across all of Yorkville 60560, backed by 23 years of experience through Creative Floors Inc. No travel charge to any Yorkville address.";

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Service Areas', 'path' => '/service-areas/'],
    ['name' => 'Yorkville, IL'],
];

$sa_coverage_heading = "Window Treatment Installation Across Yorkville, IL";
$sa_coverage_intro   = "We install window treatments in Yorkville across every neighborhood and subdivision. Yorkville's housing stock ranges from 1990s established communities along Route 71 to active new construction in Grande Reserve and Heartland Circle. High-income owner-occupied households, median home values around $346K and smart-home ready builds in Bristol Bay make Yorkville a strong market for both motorized window treatments and premium plantation shutters.";
$sa_neighborhood_cols = ["Yorkville Subdivision / Area", "Location", "Housing Profile", "Best-Matched Products"];
$sa_neighborhoods = [
    ['area' => "Grande Reserve", 'zone' => "Route 34 & Bristol Ridge Rd", 'profile' => "Active new construction 2005-present by DR Horton and Ryan Homes. Open-plan layouts, large glazing, high ceilings.", 'products' => "Motorized PerfectTilt shutters, ShadeAuto roller shades, motorized drapes on track"],
    ['area' => "Bristol Bay", 'zone' => "North Yorkville, adjacent to municipal park", 'profile' => "Clubhouse community, townhouses and SFH. Pre-wired for smart home, EV chargers and smart thermostats.", 'products' => "Motorized ShadeAuto shades, PerfectTilt motorized shutters, Norman Hub app control"],
    ['area' => "Blackberry Creek", 'zone' => "Route 47 / Lexington Circle", 'profile' => "Single-family neighborhood, consistent suburban frames.", 'products' => "Cordless Woodlore composite shutters, faux wood blinds, Portrait Honeycomb shades"],
    ['area' => "Fox Hill", 'zone' => "Route 34 / Cottonwood Trail", 'profile' => "Established subdivision near Route 34. Mix of 1990s and 2000s builds.", 'products' => "Plantation shutters, roman shades, cordless honeycomb shades"],
    ['area' => "Heartland & Heartland Circle", 'zone' => "Route 34 / Route 47 east", 'profile' => "Single-family homes built mid-2010s. Standard modern frames, energy-focused builds.", 'products' => "Triple-cell honeycomb shades, motorized roller shades, composite shutters"],
    ['area' => "Shadow Creek & Autumn Creek", 'zone' => "West of Route 71 / Stagecoach Trail", 'profile' => "Custom-built and higher-value homes averaging $880K. Premium finishes throughout.", 'products' => "Real wood Brightwood and Normandy shutters, custom drapery, motorized treatments"],
    ['area' => "Oak Creek Estates", 'zone' => "Route 71 east / Oak Creek Rd", 'profile' => "1990s and early 2000s single-family homes. Varied frame profiles, some older construction.", 'products' => "Composite Woodlore shutters, faux wood blinds, inside-mount roman shades"],
    ['area' => "Blackberry Woods & Timber Ridge", 'zone' => "Route 47 south", 'profile' => "Single-family homes, late 2010s and newer builds. Consistent frame sizes.", 'products' => "Cordless faux wood blinds, cellular honeycomb shades, PerfectSheer shades"],
];

$sa_products_heading = "Custom Window Treatments Available in Yorkville, IL";
$sa_products_intro   = "All Norman Window Fashions product categories are available for Yorkville residents. Professional window treatment installation in Yorkville is included on every order. No travel charge from our Aurora showroom.";
$sa_products = [
    [
        'name' => "Custom Shutters in Yorkville", 'badge' => "7 Collections | Ideal for Yorkville Homes",
        'intro' => "Plantation shutters for Yorkville homes across all price points. Real wood for Shadow Creek and Autumn Creek premium builds; composite Woodlore for Blackberry Creek and Fox Hill; PerfectTilt motorized for Bristol Bay smart-home builds.",
        'features' => [
            "Real wood Brightwood shutters for Yorkville premium homes in Shadow Creek",
            "Real wood Normandy shutters: 2,000+ paint and 10 stain options for Autumn Creek builds",
            "Composite Woodlore shutters for Yorkville kitchens and bathrooms: moisture-resistant",
            "PerfectTilt motorized shutters for Bristol Bay smart-home pre-wired properties",
            "Specialty shape shutters for arched or angled windows in older Yorkville builds",
            "Bypass shutters for Yorkville homes with wide patio slider doors",
        ],
        'browse_url' => "/window-treatments/window-shutters/", 'browse_label' => "Browse custom shutters in Yorkville",
    ],
    [
        'name' => "Custom Blinds in Yorkville", 'badge' => "5 Styles | Cordless & Motorized",
        'intro' => "Faux wood, real wood, aluminum and vertical blinds for every Yorkville home type. Motorized upgrades for Grande Reserve and Bristol Bay open-plan builds with large window areas.",
        'features' => [
            "Faux wood blinds for Yorkville kitchens and bathrooms in all subdivisions",
            "Real wood Normandy blinds for Yorkville dining rooms and studies",
            "CityLights aluminum blinds for Yorkville home offices and multi-use rooms",
            "Synchrony vertical blinds for patio slider doors across Yorkville neighborhoods",
            "Motorized blind upgrade: Norman Hub, Alexa and Google Home",
            "Inside and outside mount for all Yorkville frame types, 1990s through new construction",
        ],
        'browse_url' => "/window-treatments/window-blinds/", 'browse_label' => "Browse custom blinds in Yorkville",
    ],
    [
        'name' => "Custom Shades in Yorkville", 'badge' => "6 Types | Smart Home Ready",
        'intro' => "Roller, roman, honeycomb and sheer shades for Yorkville homes. Triple-cell honeycomb shades suit the large glazing areas in Grande Reserve and Heartland Circle new builds. ShadeAuto motorization for Bristol Bay smart homes.",
        'features' => [
            "Portrait Honeycomb triple cell: insulation for Grande Reserve and Heartland large windows",
            "Soluna Roller shades: sheer to blackout for Yorkville bedrooms",
            "Centerpiece Roman shades for Fox Hill and Oak Creek Estates living rooms",
            "PerfectSheer shades for Yorkville street-facing windows: privacy with natural light",
            "ShadeAuto motorized shades: app and voice control for Bristol Bay smart-home builds",
            "Inside mount for Yorkville standard modern frames in all newer construction",
        ],
        'browse_url' => "/window-treatments/shades/", 'browse_label' => "Browse custom shades in Yorkville",
    ],
    [
        'name' => "Custom Drapes & Curtains in Yorkville", 'badge' => "70+ Fabrics | Motorized Track",
        'intro' => "Custom made curtains and drapes for Yorkville homes from 70+ Fonluk drapery fabrics. Motorized drapery track for Yorkville two-story open stairwells and Grande Reserve open-plan living rooms.",
        'features' => [
            "Custom made curtains in Yorkville: fabricated to your exact window dimensions",
            "Real wood look drapery for Shadow Creek and Autumn Creek premium homes",
            "Blackout drapes for Yorkville bedrooms: BLACKOUT_SATIN and ASTAR_DIMOUT fabrics",
            "Motorized drapery track for Yorkville two-story and open-plan window applications",
            "Sheer curtains: 54 fabric options for layered Yorkville window treatments",
            "70+ drapery fabric samples brought to your Yorkville home at no charge",
        ],
        'browse_url' => "/window-treatments/curtains-and-drapes/", 'browse_label' => "Browse custom drapes & curtains in Yorkville",
    ],
];

$sa_trust = ["12 Miles from Yorkville", "No Travel Charge", "23 Years Experience", "Installation Included"];

$sa_why_heading = "Why Yorkville Homeowners Choose Creative Blinds & Drapes";
$sa_why = [
    ['label' => "Full Norman range for every Yorkville price point", 'detail' => "7 shutter collections, 5 blind styles, 6 shade types and 70+ drapery fabrics. From composite shutters for Blackberry Creek to real wood shutters for Shadow Creek custom homes."],
    ['label' => "Our own installer on every Yorkville order", 'detail' => "The same team handles consultation, measurement and installation. One contact from first visit to finished window. No hand-offs between sales and fitting teams."],
    ['label' => "Smart-home motorization expertise for Bristol Bay and Grande Reserve", 'detail' => "Norman ShadeAuto, PerfectTilt and SmartRise setup, Norman Hub pairing, Alexa and Google Home integration all handled in a single appointment. No separate technology contractor needed."],
    ['label' => "Written quote with all costs included", 'detail' => "Installation is in the total price. The itemised written quote at consultation is the final figure. No hidden labour fees, no travel charge for any Yorkville 60560 address."],
    ['label' => "All of Yorkville 60560 covered", 'detail' => "Every Yorkville subdivision from Grande Reserve and Bristol Bay in the north to Shadow Creek, Oak Creek Estates and Blackberry Woods along Route 71 falls within our 20-mile service radius."],
];

$sa_process_heading = "Window Treatment Installation in Yorkville: What to Expect";
$sa_process_intro   = "Every window treatment installation in Yorkville follows the same fixed five-step process. The same team handles everything from consultation to finished window.";
$sa_process = [
    ['step' => "Free In-Home Consultation", 'what' => "Installer visits your Yorkville home with the full Norman Window Fashions sample collection.", 'detail' => "Appointments typically within 3 to 5 business days for all Yorkville 60560 addresses. Saturday appointments available on request."],
    ['step' => "Pre-Installation Measurement", 'what' => "Every window measured to inside or outside mount specifications before fabrication.", 'detail' => "Yorkville homes range from 1990s builds in Oak Creek Estates to 2020s new construction in Grande Reserve. Our installer assesses each window profile individually."],
    ['step' => "Written Quote", 'what' => "Itemised quote covering product, hardware and installation. No hidden charges.", 'detail' => "Quote provided same-day or next business day. No Yorkville travel charge."],
    ['step' => "Custom Fabrication", 'what' => "Products fabricated to exact Yorkville window measurements at Norman's factory.", 'detail' => "Lead times at consultation: 3-5 weeks for shades and blinds, 4-6 weeks for shutters."],
    ['step' => "Installation Day", 'what' => "Installer arrives at your Yorkville address with the completed order and all required hardware.", 'detail' => "Arrival window confirmed 24 hours before appointment. Motorization pairing and smart-home setup included same day."],
];

$related_links = [
    ['url' => "/window-treatments/window-treatment-installer/", 'label' => "Window treatment installation"],
    ['url' => "/window-treatments/motorized-window-treatment/", 'label' => "Motorized window treatments"],
    ['url' => "/service-areas/", 'label' => "All service areas"],
    ['url' => "/contact/", 'label' => "Get a free quote"],
];

$faqs = [
    ['q' => "Do you charge travel fees to come to Yorkville, IL?",
     'a' => "No. There are no travel charges for Yorkville. Our showroom at 850 S Frontenac St in Aurora is 12 miles from central Yorkville. All consultation visits, pre-installation measurements and installation appointments are included in the cost of the order for every Yorkville address in ZIP code 60560."],
    ['q' => "What Yorkville subdivisions do you serve?",
     'a' => "We serve every subdivision in Yorkville 60560, including Grande Reserve, Bristol Bay, Blackberry Creek, Fox Hill, Heartland and Heartland Circle, Shadow Creek, Autumn Creek, Blackberry Woods, Oak Creek Estates and Timber Ridge, as well as all addresses along the Route 34, Route 47 and Route 71 corridors. If you are unsure whether your Yorkville address is within our service area, call (630) 946-1406 and we will confirm immediately."],
    ['q' => "How soon can you schedule a window treatment consultation in Yorkville?",
     'a' => "For Yorkville residents, free in-home consultation appointments are typically available within 3 to 5 business days. Saturday morning appointments are available on request. Because Yorkville falls within 12 miles of our Aurora showroom, we maintain consistent scheduling availability for all Yorkville 60560 addresses throughout the week. Call (630) 946-1406 or use the contact form to check current availability."],
    ['q' => "Do you install motorized window treatments in Yorkville, IL?",
     'a' => "Yes. Motorized window treatment installation is available across all Yorkville neighborhoods. Bristol Bay homes pre-wired for smart home technology are ideal for Norman ShadeAuto motorized shades and PerfectTilt motorized shutters. Grande Reserve open-plan builds with large glazing are well matched to motorized roller shades and motorized drapery track systems. Every motorized Yorkville installation includes Norman Hub mounting, app setup, Amazon Alexa and Google Home voice command testing in a single appointment."],
    ['q' => "What window treatments work best for Yorkville new-build homes in Grande Reserve and Bristol Bay?",
     'a' => "Yorkville new-build homes in Grande Reserve and Bristol Bay share three window treatment needs that older builds do not. First, open-plan layouts with large windows and high ceilings call for motorized treatments that can be operated from a central app without reaching high frames. Triple-cell Portrait Honeycomb shades on the ShadeAuto system are the strongest energy-insulation choice. Second, the patio slider doors common in these builds are best served by Synchrony Vertical Blinds or bypass shutters. Third, Bristol Bay homes pre-wired for smart home systems connect directly to the Norman Hub and integrate with existing Alexa or Google Home setups without any additional wiring."],
    ['q' => "How much do window treatments cost in Yorkville, IL?",
     'a' => "Yorkville window treatment pricing covers a wide range to match the varied housing stock from Fox Hill through to Shadow Creek custom homes. Starting guide: cordless faux wood blinds from approximately $150 per window installed; composite Woodlore shutters from approximately $350 per window; real wood Brightwood shutters for Shadow Creek and Autumn Creek premium homes from approximately $450 per window; motorized roller shades from approximately $350 per window. All prices include professional installation with no hidden labour fees or travel charges to Yorkville. A written itemised quote is provided at the free in-home consultation before any order is placed."],
];

$sa_cta_heading = "Yorkville's Window Treatment Installer, No Travel Charge";
$sa_cta_text    = "Book a free in-home consultation and we will bring the full Norman sample collection to your Yorkville home. No obligation, and samples brought to you.";

require ROOT_PATH . '/includes/service-area-page.php';
