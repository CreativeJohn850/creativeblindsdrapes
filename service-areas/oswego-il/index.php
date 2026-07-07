<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';

$page_title       = "Window Treatment Installer in Oswego, IL";
$meta_description = "Oswego, IL window treatment installer. Custom shutters, blinds, shades & drapes. Free in-home consultation, no travel charge. Call (630) 946-1406.";

$sa_h1          = "Window Treatment Installer in Oswego, IL";
$sa_path        = "/service-areas/oswego-il/";
$sa_area_served = ["Oswego"];
$sa_hero_image  = "assets/images/carousel/curtain-drape-background-2365x594.jpg";
$sa_hero_image_mobile = "assets/images/carousel/curtain-drape-background-666x577.jpg";
$sa_hero_intro  = "Creative Blinds & Drapes serves Oswego from our Aurora showroom, just 10 miles away. We design and install custom shutters, blinds, shades and drapes from Norman Window Fashions across all of Oswego 60543, backed by 23 years of experience through Creative Floors Inc. No travel charge applies to any Oswego address.";

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Service Areas', 'path' => '/service-areas/'],
    ['name' => 'Oswego, IL'],
];

$sa_coverage_heading = "Window Treatment Installation Across Oswego, IL";
$sa_coverage_intro   = "We install window treatments in Oswego across every neighborhood and subdivision. Oswego's housing stock is predominantly post-2000 construction with standard modern frames, large open-plan layouts and energy-efficient glazing. The Route 30 corridor, Boulder Hill, Route 34 and Route 71 areas all fall within our 20-mile service radius.";
$sa_neighborhood_cols = ["Oswego Area / Subdivision", "Zone", "Typical Window Profile", "Best-Matched Products"];
$sa_neighborhoods = [
    ['area' => "Churchill Club", 'zone' => "East Oswego, off Rt 34", 'profile' => "Newer construction, consistent modern frames, open-plan living", 'products' => "Motorized roller shades, PerfectTilt shutters, faux wood blinds"],
    ['area' => "Blackberry Knoll", 'zone' => "Central Oswego", 'profile' => "Post-2000 single-family homes, standard frame sizes, 3-4 bedrooms", 'products' => "Cordless honeycomb shades, composite Woodlore shutters, roman shades"],
    ['area' => "Farmington Lakes", 'zone' => "North Oswego, Rt 34 corridor", 'profile' => "Established subdivision, larger lot homes, some two-story open stair windows", 'products' => "Triple-cell honeycomb shades, motorized shades"],
    ['area' => "Boulder Hill", 'zone' => "West Oswego, Rt 30 corridor", 'profile' => "Mix of mid-century and newer builds, varied window profiles", 'products' => "Composite shutters, aluminum blinds, cordless roman shades"],
    ['area' => "Fox Chase & Prairie Point area", 'zone' => "South Oswego, Rt 71 corridor", 'profile' => "Newer builds near Oswego-Plainfield border, large glazing, patio sliders", 'products' => "Vertical blinds, motorized drapes, bypass shutters for slider doors"],
    ['area' => "Secretariat Lane & Plank Road area", 'zone' => "Central-south Oswego", 'profile' => "Consistent newer suburban profiles, family homes", 'products' => "Faux wood blinds, cellular honeycomb shades, Soluna roller shades"],
    ['area' => "Route 34 corridor new developments", 'zone' => "East Oswego growth area", 'profile' => "Latest new-build profiles, smart-home ready, large windows", 'products' => "Motorized PerfectTilt shutters, ShadeAuto roller shades, motorized drapes"],
];

$sa_products_heading = "Custom Window Treatments Available in Oswego, IL";
$sa_products_intro   = "All Norman Window Fashions product categories are available for Oswego residents. Professional window treatment installation in Oswego is included on every order. No travel charge from our Aurora showroom.";
$sa_products = [
    [
        'name' => "Custom Shutters in Oswego", 'badge' => "7 Collections | Wood, Composite & Motorized",
        'intro' => "Shutters for Oswego homes from real wood (Brightwood, Normandy) and moisture-resistant composite (Woodlore, Woodlore Plus). PerfectTilt motorized shutters for Oswego new-build homes.",
        'features' => [
            "Composite Woodlore shutters for Oswego kitchens and bathrooms in newer builds",
            "Real wood Brightwood and Normandy shutters for Oswego living rooms and studies",
            "PerfectTilt motorized shutters for Oswego smart-home developments along Route 34",
            "Specialty shape shutters for Oswego homes with angled or arched window openings",
            "Bypass shutters for Oswego patio slider doors in Fox Chase and Prairie Point homes",
            "Free in-home measurement across all Oswego 60543 addresses",
        ],
        'browse_url' => "/window-treatments/window-shutters/", 'browse_label' => "Browse custom shutters in Oswego",
    ],
    [
        'name' => "Custom Blinds in Oswego", 'badge' => "5 Styles | Cordless & Motorized",
        'intro' => "Faux wood, real wood, aluminum and vertical blinds installed across Oswego. Cordless systems for Oswego family homes and motorized upgrades for larger windows in Farmington Lakes and Churchill Club.",
        'features' => [
            "Faux wood blinds for Oswego kitchens and bathrooms: moisture-resistant composite slats",
            "Real wood Normandy blinds for Oswego dining rooms and home offices",
            "CityLights aluminum blinds for Oswego utility rooms and rental properties",
            "Synchrony vertical blinds for Oswego homes with wide patio slider doors",
            "Motorized blind upgrade with Norman Hub, Alexa and Google Home",
            "Inside and outside mount for all Oswego window frame types",
        ],
        'browse_url' => "/window-treatments/window-blinds/", 'browse_label' => "Browse custom blinds in Oswego",
    ],
    [
        'name' => "Custom Shades in Oswego", 'badge' => "6 Types | Energy-Efficient Triple Cell",
        'intro' => "Roller, roman, honeycomb and sheer shades for Oswego homes. Triple-cell honeycomb shades are the top energy-efficiency choice for Oswego's newer open-plan builds with large window areas.",
        'features' => [
            "Portrait Honeycomb triple cell: maximum insulation for Oswego open-plan homes",
            "Soluna Roller shades: sheer to blackout for Oswego bedrooms",
            "Centerpiece Roman shades for Oswego living rooms in Blackberry Knoll and Farmington Lakes",
            "PerfectSheer shades for Oswego street-facing windows: privacy with diffused light",
            "ShadeAuto motorized shades: app and Alexa control for Oswego smart homes",
            "Inside mount for Oswego standard modern frames in all newer Oswego subdivisions",
        ],
        'browse_url' => "/window-treatments/shades/", 'browse_label' => "Browse custom shades in Oswego",
    ],
    [
        'name' => "Custom Drapes & Curtains in Oswego", 'badge' => "70+ Fabrics | Motorized Track",
        'intro' => "Custom made curtains and drapes for Oswego homes from 70+ Fonluk drapery fabrics. Motorized drapery track for Oswego open-plan living rooms and two-story windows in Farmington Lakes homes.",
        'features' => [
            "Custom made curtains in Oswego: fabricated to your exact window dimensions",
            "Blackout drapes for Oswego bedrooms: BLACKOUT_SATIN and ASTAR_DIMOUT fabrics",
            "Sheer curtains: 54 fabric options for layered Oswego window treatments",
            "Motorized drapery track for Oswego open-plan and two-story window applications",
            "Professional drapery installation in Oswego: rod, track and panel dressing included",
            "70+ drapery fabric samples brought to your Oswego home at no charge",
        ],
        'browse_url' => "/window-treatments/curtains-and-drapes/", 'browse_label' => "Browse custom drapes & curtains in Oswego",
    ],
];

$sa_trust = ["10 Miles from Oswego", "No Travel Charge", "23 Years Experience", "Installation Included"];

$sa_why_heading = "Why Oswego Homeowners Choose Creative Blinds & Drapes";
$sa_why = [
    ['label' => "Full Norman Window Fashions product range", 'detail' => "7 shutter collections, 5 blind styles, 6 shade types and 70+ drapery fabrics. Every product available with cordless or motorized operating systems."],
    ['label' => "Our own installer on every Oswego order", 'detail' => "The same team handles your consultation, measurement and installation. One contact from start to finished window with no hand-offs."],
    ['label' => "Written quote with all costs included", 'detail' => "Installation is included in the total price. The itemised written quote you receive at the consultation is the total you pay. No hidden labour fees, no travel charges to Oswego."],
    ['label' => "All of Oswego 60543 fully covered", 'detail' => "Every Oswego address from Boulder Hill and the Route 30 corridor to Fox Chase, Prairie Point and the Route 34 growth area falls within our 20-mile service radius."],
    ['label' => "Motorized installation included in every motorized order", 'detail' => "Norman ShadeAuto, PerfectTilt and SmartRise setup, app pairing, schedule programming and voice command testing are all handled at the installation appointment."],
];

$sa_process_heading = "Window Treatment Installation in Oswego: What to Expect";
$sa_process_intro   = "Every window treatment installation in Oswego follows the same fixed five-step process. The same Aurora-based team handles everything from the consultation to the finished window.";
$sa_process = [
    ['step' => "Free In-Home Consultation", 'what' => "Installer visits your Oswego home with the full Norman Window Fashions sample collection.", 'detail' => "Appointments typically available within 3 to 5 business days for all Oswego 60543 addresses. Saturday appointments available on request."],
    ['step' => "Pre-Installation Measurement", 'what' => "Every window measured to inside or outside mount specifications before fabrication.", 'detail' => "Oswego's post-2000 subdivisions use consistent modern frame sizes. Boulder Hill homes may have varied older profiles: our installer checks each window individually."],
    ['step' => "Written Quote", 'what' => "Itemised quote covering product, hardware and installation. No hidden charges.", 'detail' => "Quote provided same-day or next business day. No separate Oswego travel charge."],
    ['step' => "Custom Fabrication", 'what' => "Products fabricated to exact Oswego window dimensions at Norman's factory.", 'detail' => "Lead times confirmed at consultation: 3-5 weeks for shades and blinds, 4-6 weeks for shutters."],
    ['step' => "Installation Day", 'what' => "Installer arrives at your Oswego address with the completed order and all required hardware.", 'detail' => "Arrival window confirmed 24 hours before the appointment."],
];

$related_links = [
    ['url' => "/window-treatments/window-treatment-installer/", 'label' => "Window treatment installation"],
    ['url' => "/window-treatments/motorized-window-treatment/", 'label' => "Motorized window treatments"],
    ['url' => "/service-areas/", 'label' => "All service areas"],
    ['url' => "/contact/", 'label' => "Get a free quote"],
];

$faqs = [
    ['q' => "Do you charge travel fees to come to Oswego, IL?",
     'a' => "No. There are no travel charges for Oswego. Our showroom at 850 S Frontenac St in Aurora is 10 miles from central Oswego. Consultation visits, pre-installation measurement and installation appointments are all included in the cost of the order for every Oswego address across ZIP code 60543."],
    ['q' => "What areas of Oswego do you serve?",
     'a' => "We serve all of Oswego, IL 60543, including every named subdivision and area of the city. This covers Churchill Club, Blackberry Knoll, Farmington Lakes, Boulder Hill and the Route 30 corridor, Fox Chase, Prairie Point, the Secretariat Lane and Plank Road area, and the Route 34 and Route 71 growth corridors. If you are unsure whether your Oswego address falls within our service radius, call (630) 946-1406 and we will confirm immediately."],
    ['q' => "How soon can you schedule a window treatment consultation in Oswego?",
     'a' => "For Oswego residents, free in-home consultation appointments are typically available within 3 to 5 business days. Saturday morning appointments between 10am and 1pm are available on request. Because Oswego is within 10 miles of our Aurora showroom, we maintain consistent scheduling availability for all Oswego ZIP 60543 addresses throughout the week."],
    ['q' => "Do you install motorized window treatments in Oswego, IL?",
     'a' => "Yes. Motorized window treatment installation in Oswego covers the full Norman system: ShadeAuto motorized shades, PerfectTilt motorized shutters, SmartRise motorized blinds and motorized drapery track. Oswego's newer builds along Route 34, in Churchill Club and in Farmington Lakes are well matched to motorized treatments due to their open-plan layouts and large glazing areas. Every motorized Oswego installation includes Norman Hub mounting, app setup, Amazon Alexa and Google Home voice command testing in a single appointment."],
    ['q' => "What window treatments work best for Oswego new-build homes?",
     'a' => "Oswego's post-2000 housing stock in subdivisions like Churchill Club, Blackberry Knoll and Farmington Lakes is well served by four product types. Triple-cell Portrait Honeycomb shades provide the best energy insulation for Oswego's large modern glazing areas, reducing heating costs in winter. Motorized Soluna Roller shades handle the open-plan sightlines common in Oswego newer builds. PerfectTilt motorized shutters give clean light control on street-facing Oswego windows. For wide sliding doors, which are common in Oswego homes, Synchrony Vertical Blinds or bypass shutters are the most practical fit."],
    ['q' => "How much do window treatments cost in Oswego, IL?",
     'a' => "Oswego window treatment pricing follows the same structure across our full service area. Starting guide: cordless faux wood blinds from approximately $150 per window installed; composite Woodlore shutters from approximately $350 per window; motorized roller shades from approximately $350 per window including the ShadeAuto motor; custom drapes from approximately $200 per panel. All prices include professional installation in Oswego with no separate labour fees or travel charges. A written itemised quote is provided at the free in-home consultation before any order is placed."],
];

$sa_cta_heading = "Oswego's Window Treatment Installer, No Travel Charge";
$sa_cta_text    = "Book a free in-home consultation and we will bring the full Norman sample collection to your Oswego home. No obligation, and samples brought to you.";

require ROOT_PATH . '/includes/service-area-page.php';
