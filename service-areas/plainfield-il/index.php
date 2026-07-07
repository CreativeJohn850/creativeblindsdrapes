<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';

$page_title       = "Window Treatment Installer in Plainfield, IL";
$meta_description = "Plainfield, IL window treatment installer. Custom shutters, blinds, shades & drapes, Carillon 55+ cordless options. Free consultation. Call (630) 946-1406.";

$sa_h1          = "Window Treatment Installer in Plainfield, IL";
$sa_path        = "/service-areas/plainfield-il/";
$sa_area_served = ["Plainfield"];
$sa_hero_image  = "assets/images/carousel/curtain-drape-background-2365x594.jpg";
$sa_hero_image_mobile = "assets/images/carousel/curtain-drape-background-666x577.jpg";
$sa_hero_intro  = "Creative Blinds & Drapes serves Plainfield from our Aurora showroom, 15 miles away. We design and install custom shutters, blinds, shades and drapes from Norman Window Fashions across both Plainfield ZIP codes, 60544 and 60585, from the Carillon 55+ community to premium builds in Ashwood Park. No travel charge to any Plainfield address.";

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Service Areas', 'path' => '/service-areas/'],
    ['name' => 'Plainfield, IL'],
];

$sa_coverage_heading = "Window Treatment Installation Across Plainfield, IL";
$sa_coverage_intro   = "We install window treatments in Plainfield across every neighborhood and subdivision in both ZIP codes 60544 and 60585. The housing spectrum runs from Carillon ranch homes through Grande Park master-planned community to Ashwood Park and Tamarack premium builds averaging above $900K. The 60585 ZIP along the Naperville border contains the largest and newest builds, well matched to motorized window treatments.";
$sa_neighborhood_cols = ["Plainfield Subdivision", "ZIP", "Price Range / Profile", "Best-Matched Products"];
$sa_neighborhoods = [
    ['area' => "Carillon (55+ Active Adult)", 'zone' => "60544", 'profile' => "1989-2005, ranch homes 1,375-2,320 sq ft. Single-story. Avg $315K. Weber Rd near I-55.", 'products' => "Cordless Woodlore shutters, cordless cellular shades, SmartRise motorized lift for blinds"],
    ['area' => "Crystal Lawns & Wespark", 'zone' => "60544", 'profile' => "Established 1990s-2000s. Entry to mid-range. Standard frames. Avg $310-$374K.", 'products' => "Cordless faux wood blinds, composite Woodlore shutters, cellular honeycomb shades"],
    ['area' => "Liberty Grove & Walkers Grove", 'zone' => "60544", 'profile' => "Early-to-mid 2000s family builds. Standard modern frames. Avg $484-$505K.", 'products' => "Faux wood blinds, Woodlore Plus composite shutters, triple-cell honeycomb shades"],
    ['area' => "Springbank & Grande Park", 'zone' => "60544 / 60585", 'profile' => "Master-planned 2003-2023. Multiple builders. Avg $545-$610K. Up to 5,466 sq ft.", 'products' => "Motorized roller shades, PerfectTilt shutters, Woodlore Plus, roman shades"],
    ['area' => "Saddle Creek & High Meadows", 'zone' => "60544", 'profile' => "Established family single-family homes. Avg $632-$679K.", 'products' => "Composite Woodlore shutters, motorized honeycomb shades, faux wood blinds"],
    ['area' => "South Pointe & Harmony Grove", 'zone' => "60585", 'profile' => "Newer construction near Naperville border. Larger footprints. Avg $737-$775K.", 'products' => "Motorized ShadeAuto shades, PerfectTilt motorized shutters, motorized drapery track"],
    ['area' => "Ashwood Creek", 'zone' => "60585", 'profile' => "Premium 2000s and 2010s builds. Avg $872-$907K.", 'products' => "Real wood Brightwood and Normandy shutters, custom drapery, motorized PerfectTilt shutters"],
    ['area' => "Tamarack & Ashwood Park", 'zone' => "60585", 'profile' => "Highest-value Plainfield tier. Avg $899K-$1.1M+.", 'products' => "Real wood Normandy shutters, custom Fonluk drapery on motorized track, full motorized suite"],
];

$sa_products_heading = "Custom Window Treatments Available in Plainfield, IL";
$sa_products_intro   = "All Norman Window Fashions product categories are available for Plainfield residents across both ZIP codes. Professional window treatment installation in Plainfield is included on every order. No travel charge from our Aurora showroom.";
$sa_products = [
    [
        'name' => "Custom Shutters in Plainfield", 'badge' => "7 Collections | Carillon to Ashwood Park",
        'intro' => "Shutters across every Plainfield price point. Cordless composite for Carillon 55+ ranch homes; Woodlore Plus for Grande Park and Springbank; real wood Normandy for Ashwood Creek, Tamarack and Ashwood Park.",
        'features' => [
            "Composite Woodlore cordless shutters for Carillon 55+ homes: single-hand tilt, no cords",
            "Composite Woodlore Plus for Grande Park and South Pointe: additional colors and motorized option",
            "Real wood Brightwood shutters for Ashwood Creek and South Pointe premium builds",
            "Real wood Normandy shutters: 2,000+ paint and 10 stain options for Tamarack and Ashwood Park",
            "PerfectTilt motorized shutters for 60585 ZIP newer builds with app and voice control",
            "Free in-home measurement across all Plainfield 60544 and 60585 addresses",
        ],
        'browse_url' => "/window-treatments/window-shutters/", 'browse_label' => "Browse custom shutters in Plainfield",
    ],
    [
        'name' => "Custom Blinds in Plainfield", 'badge' => "5 Styles | Cordless, SmartRise & Motorized",
        'intro' => "Faux wood, real wood, aluminum and vertical blinds for all Plainfield home types. Cordless systems for Carillon and family homes. SmartRise battery motorized lift for Carillon residents. Motorized upgrades for Ashwood Park open-plan builds.",
        'features' => [
            "Cordless faux wood blinds for Plainfield kitchens and bathrooms across all subdivisions",
            "SmartRise battery motorized lift for Carillon 55+ homes: one-touch operation, no cords, no hub required",
            "Real wood Normandy blinds for Plainfield dining rooms and home offices",
            "CityLights aluminum blinds for Plainfield utility rooms and rental units",
            "Synchrony vertical blinds for patio slider doors in Grande Park and South Pointe",
            "Motorized blind upgrade: Norman Hub, Alexa and Google Home compatible",
        ],
        'browse_url' => "/window-treatments/window-blinds/", 'browse_label' => "Browse custom blinds in Plainfield",
    ],
    [
        'name' => "Custom Shades in Plainfield", 'badge' => "6 Types | 55+ Accessible to Premium Motorized",
        'intro' => "Roller, roman, honeycomb and sheer shades for all Plainfield home types. Cordless cellular shades for Carillon accessibility; triple-cell honeycomb for Grande Park energy efficiency; ShadeAuto motorized for Ashwood Park and Tamarack.",
        'features' => [
            "Cordless Portrait Honeycomb shades for Carillon 55+ homes: no cord hazard, single-hand operation",
            "Portrait Honeycomb triple cell for Grande Park and South Pointe energy insulation",
            "Soluna Roller shades: sheer to blackout for Plainfield bedrooms across all subdivisions",
            "Centerpiece Roman shades for Springbank and Saddle Creek living rooms",
            "PerfectSheer shades for Harmony Grove and South Pointe: view with privacy",
            "ShadeAuto motorized shades for 60585 premium builds: app and voice control",
        ],
        'browse_url' => "/window-treatments/shades/", 'browse_label' => "Browse custom shades in Plainfield",
    ],
    [
        'name' => "Custom Drapes & Curtains in Plainfield", 'badge' => "70+ Fabrics | Motorized Track | Full Height",
        'intro' => "Custom made curtains and drapes for Plainfield homes from 70+ Fonluk drapery fabrics. Motorized drapery track for open-plan rooms and two-story window spans in Ashwood Creek, Tamarack and Ashwood Park premium builds.",
        'features' => [
            "Full-length custom drapery for Tamarack and Ashwood Park premium homes: 70+ Fonluk fabrics",
            "Motorized drapery track for two-story and open-plan windows in 60585 newer builds",
            "Custom made curtains in Plainfield: fabricated to exact window dimensions",
            "Blackout drapes for Plainfield bedrooms: BLACKOUT_SATIN and ASTAR_DIMOUT fabrics",
            "Sheer curtains: 54 fabric options for layered Plainfield window treatments",
            "70+ drapery fabric samples brought to your Plainfield home at no charge",
        ],
        'browse_url' => "/window-treatments/curtains-and-drapes/", 'browse_label' => "Browse custom drapes & curtains in Plainfield",
    ],
];

$sa_trust = ["15 Miles from Plainfield", "No Travel Charge", "55+ Cordless Options", "Installation Included"];

$sa_why_heading = "Why Plainfield Homeowners Choose Creative Blinds & Drapes";
$sa_why = [
    ['label' => "Cordless and accessible options for Carillon 55+ community", 'detail' => "Cordless Woodlore shutters with single-hand tilt. SmartRise battery motorized lift for blinds. Cordless cellular shades. No hanging cords on any product ordered for a Carillon home. No hub or Wi-Fi required for the SmartRise motor."],
    ['label' => "No travel charge for either 60544 or 60585 ZIP code", 'detail' => "At 15 miles, Plainfield is the furthest point in our service area. There is no travel charge for any Plainfield address in either ZIP code. Consultation, measurement and installation are all included in the product price."],
    ['label' => "Full Norman range from Carillon to Ashwood Park", 'detail' => "Composite shutters at entry level; real wood Normandy for Tamarack and Ashwood Park; motorized PerfectTilt for South Pointe and Harmony Grove newer builds. One supplier covers the entire Plainfield price spectrum."],
    ['label' => "Our own installer on every Plainfield order", 'detail' => "The same team handles consultation, measurement and installation. One contact from first visit to finished window. No hand-offs."],
    ['label' => "Written quote with all costs included", 'detail' => "Installation is in the total price. The itemised written quote at consultation is the final figure. No hidden labour fees."],
];

$sa_process_heading = "Window Treatment Installation in Plainfield: What to Expect";
$sa_process_intro   = "Every window treatment installation in Plainfield follows the same fixed five-step process, from free consultation to final installation.";
$sa_process = [
    ['step' => "Free In-Home Consultation", 'what' => "Installer visits with the full Norman Window Fashions sample collection.", 'detail' => "Within 3 to 5 business days for all Plainfield 60544 and 60585 addresses. Saturday available."],
    ['step' => "Pre-Installation Measurement", 'what' => "Every window measured to inside or outside mount specifications.", 'detail' => "Carillon: single-story ranch frames for cordless inside mount. Tamarack and Ashwood Park: two-story and large-opening spans for motorized track."],
    ['step' => "Written Quote", 'what' => "Itemised quote: product, hardware and installation. No hidden charges.", 'detail' => "Same-day or next business day. No travel charge for either Plainfield ZIP code."],
    ['step' => "Custom Fabrication", 'what' => "Products fabricated to exact dimensions at Norman factory.", 'detail' => "Lead times: 3-5 weeks shades and blinds, 4-6 weeks shutters. Confirmed at consultation."],
    ['step' => "Installation Day", 'what' => "Installer arrives with completed order and all hardware.", 'detail' => "Arrival window confirmed 24 hours before appointment. Motorization and app setup same day."],
];

$related_links = [
    ['url' => "/window-treatments/window-treatment-installer/", 'label' => "Window treatment installation"],
    ['url' => "/window-treatments/shades/", 'label' => "Custom shades"],
    ['url' => "/service-areas/", 'label' => "All service areas"],
    ['url' => "/contact/", 'label' => "Get a free quote"],
];

$faqs = [
    ['q' => "Do you charge travel fees to come to Plainfield, IL?",
     'a' => "No. There are no travel charges for Plainfield. Our showroom at 850 S Frontenac St in Aurora is 15 miles from central Plainfield. All consultation visits, pre-installation measurements and installation appointments are included in the cost of the order for every Plainfield address in both ZIP codes 60544 and 60585. Plainfield is the furthest city in our service area, and the same no-travel-charge policy applies here as it does for Aurora and Naperville."],
    ['q' => "Do you serve the Carillon 55+ community in Plainfield?",
     'a' => "Yes. Carillon is a specific product category for us. The single-story ranch floor plans built 1989-2005 use standard inside-mount frame sizes, and the product specification focuses on cordless and accessible operating systems throughout. Every shutter, shade and blind order for a Carillon home uses cordless or motorized lift systems. Norman Woodlore composite shutters with single-hand tilt, cordless Portrait Honeycomb cellular shades, and the SmartRise battery motorized lift for blinds are the three most requested Carillon products. The SmartRise motor requires no hub or Wi-Fi connection: it pairs with a handheld remote and operates on AA batteries. ShadeAuto motorized shades are also available for Carillon residents who want app or voice control via the Norman Hub."],
    ['q' => "How soon can you schedule a window treatment consultation in Plainfield?",
     'a' => "For Plainfield residents in both ZIP codes 60544 and 60585, free in-home consultation appointments are typically available within 3 to 5 business days. Saturday morning appointments between 10am and 1pm are available on request. Call (630) 946-1406 or use the contact form to check current availability for your specific Plainfield neighborhood."],
    ['q' => "Do you install motorized window treatments in Plainfield, IL?",
     'a' => "Yes. Motorized window treatment installation in Plainfield covers Norman ShadeAuto motorized shades, PerfectTilt motorized shutters, SmartRise motorized blinds and motorized drapery track. The 60585 ZIP code, covering South Pointe, Harmony Grove, Ashwood Creek, Tamarack and Ashwood Park, contains the largest and newest Plainfield builds, with open-plan layouts and large glazing areas that are well matched to motorized treatments. Battery-operated motorized options mean no electrical work is needed for most installations. Every motorized Plainfield installation includes hub mounting, app setup and Alexa and Google Home integration in a single appointment."],
    ['q' => "What window treatments work best for Ashwood Park and Tamarack premium homes?",
     'a' => "Ashwood Park and Tamarack homes, with average values above $900K, are served by four specific product categories. Real wood Normandy shutters are the premium architectural choice: 2,000+ custom paint and 10 stain options cover any interior specification. Custom Fonluk drapery panels on motorized track handle large rooms and two-story window spans, with panel heights up to 118 inches and 70+ fabric options. PerfectTilt motorized shutters provide clean light control in master bedrooms without a visible tilt rod. For rooms with views of open lots or wooded areas common in both subdivisions, PerfectSheer shades rotate to control glare while preserving the sightline."],
    ['q' => "How much do window treatments cost in Plainfield, IL?",
     'a' => "Plainfield window treatment pricing covers the full housing spectrum from Carillon through to Ashwood Park. Starting guide: cordless faux wood blinds from approximately $150 per window installed; SmartRise motorized lift for blinds from approximately $280 per window including the motor; composite Woodlore shutters from approximately $350 per window; ShadeAuto motorized roller shades from approximately $350 per window; real wood Normandy shutters from approximately $450 per window; custom drapery panels from approximately $200 per panel. All prices include professional installation in Plainfield with no travel charges or hidden labour fees. A written itemised quote is provided at the free in-home consultation before any order is placed."],
];

$sa_cta_heading = "Plainfield's Window Treatment Installer, Carillon to Ashwood Park";
$sa_cta_text    = "Book a free in-home consultation and we will bring the full Norman sample collection to your Plainfield home. No obligation, and samples brought to you.";

require ROOT_PATH . '/includes/service-area-page.php';
