<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';

$page_title       = "Window Treatment Installer in Batavia, IL";
$meta_description = "Batavia, IL window treatment installer. Custom shutters, blinds, shades & drapes for historic and new-build homes. Free consultation. Call (630) 946-1406.";

$sa_h1          = "Window Treatment Installer in Batavia, IL";
$sa_path        = "/service-areas/batavia-il/";
$sa_area_served = ["Batavia"];
$sa_hero_image  = "assets/images/carousel/curtain-drape-background-2365x594.jpg";
$sa_hero_image_mobile = "assets/images/carousel/curtain-drape-background-666x577.jpg";
$sa_hero_intro  = "Creative Blinds & Drapes serves Batavia from our Aurora showroom, 10 miles away. We design and install custom shutters, blinds, shades and drapes from Norman Window Fashions across Batavia's 1880s limestone homes, established neighborhoods and newer construction alike, backed by 23 years of experience. No travel charge to any Batavia address.";

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Service Areas', 'path' => '/service-areas/'],
    ['name' => 'Batavia, IL'],
];

$sa_coverage_heading = "Window Treatment Installation Across Batavia, IL";
$sa_coverage_intro   = "We install window treatments in Batavia across every neighborhood and area of the city. Batavia's unique character as Kane County's oldest city means our installer encounters window profiles ranging from 19th-century double-hung frames in the historic limestone district to modern standard frames in newer subdivisions along Route 25 and Kirk Road. Each area benefits from our in-home measurement process, which assesses every window individually before fabrication.";
$sa_neighborhood_cols = ["Batavia Area", "Zone", "Housing Profile", "Best-Matched Products"];
$sa_neighborhoods = [
    ['area' => "Historic Downtown & Wilson Street", 'zone' => "Central, west of Fox River", 'profile' => "Limestone and brick homes 1880s-1920s, double-hung sash windows, plaster walls, non-standard frame depths", 'products' => "Composite Woodlore shutters (moisture-tolerant), inside-mount roman shades, specialty frame assessments required"],
    ['area' => "Fox River Corridor & Batavia Avenue", 'zone' => "East and west riverfront", 'profile' => "Older established homes 1920s-1960s, varied window sizes, some newer renovations with replacement windows", 'products' => "Shutters, cordless faux wood blinds, roman shades with outside mount"],
    ['area' => "Main Street & Houston Street area", 'zone' => "Downtown south and east", 'profile' => "Mix of historic and mid-century homes, ranches and bungalows. Varied frame profiles.", 'products' => "Composite Woodlore shutters, aluminum blinds, cordless honeycomb shades"],
    ['area' => "Hart Road & Fabyan Parkway corridor", 'zone' => "North Batavia", 'profile' => "1970s-1990s ranch and split-level homes. More consistent frame sizes than historic areas.", 'products' => "Faux wood blinds, PerfectSheer shades, composite shutters, roman shades"],
    ['area' => "Kirk Road & Route 25 newer subdivisions", 'zone' => "East Batavia", 'profile' => "Post-1990s and 2000s single-family homes. Standard modern frames. Larger lots.", 'products' => "Motorized roller shades, PerfectTilt shutters, triple-cell honeycomb shades"],
    ['area' => "Batavia Township border areas", 'zone' => "Southeast and southwest", 'profile' => "Newer construction 2000s-2010s, contemporary profiles, open-plan layouts", 'products' => "Motorized ShadeAuto shades, faux wood blinds, motorized drapery track"],
    ['area' => "North Batavia & Randall Road corridor", 'zone' => "North, toward Geneva border", 'profile' => "Mix of 1990s and 2000s builds. Some custom homes. Higher price points.", 'products' => "Real wood Brightwood shutters, custom drapery, PerfectTilt motorized shutters"],
];

$sa_products_heading = "Custom Window Treatments Available in Batavia, IL";
$sa_products_intro   = "All Norman Window Fashions product categories are available for Batavia residents. Professional window treatment installation in Batavia is included on every order. Our installer's experience with older frame profiles makes Batavia's historic homes as straightforward to fit as its newer construction.";
$sa_products = [
    [
        'name' => "Custom Shutters in Batavia", 'badge' => "7 Collections | Historic & Modern Homes",
        'intro' => "Shutters for every Batavia home type. Composite Woodlore for the Fox River corridor and Main Street 1920s-1960s homes; real wood Brightwood for Randall Road custom builds; PerfectTilt motorized for newer Kirk Road construction.",
        'features' => [
            "Composite Woodlore shutters for Batavia historic homes: moisture-tolerant, no warping",
            "Real wood Brightwood and Normandy shutters for Batavia north-side custom homes",
            "PerfectTilt motorized shutters for Batavia newer builds with smart-home integration",
            "Specialty shape shutters: arched windows in downtown Batavia limestone homes",
            "Bypass shutters for Batavia homes with wide patio slider doors",
            "Free in-home measurement across all Batavia 60510 addresses",
        ],
        'browse_url' => "/window-treatments/window-shutters/", 'browse_label' => "Browse custom shutters in Batavia",
    ],
    [
        'name' => "Custom Blinds in Batavia", 'badge' => "5 Styles | All Frame Types Covered",
        'intro' => "Faux wood, real wood, aluminum and vertical blinds for Batavia homes from the 1880 downtown through to 2010s new builds. Our in-home measurement checks every frame depth before fabrication begins.",
        'features' => [
            "Faux wood blinds for Batavia kitchens and bathrooms across all eras of construction",
            "Real wood Normandy blinds for Batavia living rooms and studies",
            "CityLights aluminum blinds for Batavia home offices and utility rooms",
            "Synchrony vertical blinds for Batavia patio slider doors",
            "Motorized blind upgrade with Norman Hub, Alexa and Google Home",
            "Outside mount option for Batavia historic homes with narrow or non-standard frame depths",
        ],
        'browse_url' => "/window-treatments/window-blinds/", 'browse_label' => "Browse custom blinds in Batavia",
    ],
    [
        'name' => "Custom Shades in Batavia", 'badge' => "6 Types | Historic & Energy-Efficient",
        'intro' => "Roller, roman, honeycomb and sheer shades for all Batavia home types. Roman shades with outside mount work well for Batavia historic windows where inside mount depth is limited. Triple-cell honeycomb for newer Batavia builds with large glazing.",
        'features' => [
            "Centerpiece Roman shades for Batavia historic downtown homes: outside mount option",
            "Portrait Honeycomb triple cell for newer Batavia construction with energy-saving insulation",
            "Soluna Roller shades: sheer to blackout for Batavia bedrooms in all neighborhoods",
            "PerfectSheer shades for Batavia Fox River corridor homes: privacy with natural light",
            "ShadeAuto motorized shades for Batavia newer builds with app and voice control",
            "Inside mount depth checked at consultation for all Batavia historic frame types",
        ],
        'browse_url' => "/window-treatments/shades/", 'browse_label' => "Browse custom shades in Batavia",
    ],
    [
        'name' => "Custom Drapes & Curtains in Batavia", 'badge' => "70+ Fabrics | Motorized Track",
        'intro' => "Custom made curtains and drapes for Batavia homes from 70+ Fonluk drapery fabrics. Particularly well suited to Batavia historic homes where full-length drapes complement the period character of older rooms.",
        'features' => [
            "Custom made curtains in Batavia: fabricated to exact window dimensions, any height",
            "Blackout drapes for Batavia bedrooms: BLACKOUT_SATIN and ASTAR_DIMOUT fabrics",
            "Full-length drapery panels for Batavia historic homes with tall original windows",
            "Sheer curtains: 54 fabric options for layered Batavia window treatments",
            "Motorized drapery track for Batavia newer open-plan builds",
            "70+ drapery fabric samples brought to your Batavia home at no charge",
        ],
        'browse_url' => "/window-treatments/curtains-and-drapes/", 'browse_label' => "Browse custom drapes & curtains in Batavia",
    ],
];

$sa_trust = ["10 Miles from Batavia", "No Travel Charge", "Historic & New-Build Expertise", "Installation Included"];

$sa_why_heading = "Why Batavia Homeowners Choose Creative Blinds & Drapes";
$sa_why = [
    ['label' => "Experience with Batavia historic frame profiles", 'detail' => "Batavia's 1880s-1960s homes have non-standard window depths, plaster walls and older sash frames. Our installer checks every window at the pre-installation measurement visit before any product is ordered."],
    ['label' => "Full Norman range for every Batavia price point", 'detail' => "7 shutter collections, 5 blind styles, 6 shade types and 70+ drapery fabrics. Composite shutters for historic homes; real wood for Randall Road custom builds; motorized for newer construction."],
    ['label' => "Outside mount expertise for historic windows", 'detail' => "When inside mount depth is insufficient in Batavia historic homes, we recommend and fit outside mount configurations that maintain a clean, period-appropriate finish."],
    ['label' => "Our own installer on every Batavia order", 'detail' => "The same team handles consultation, measurement and installation. One contact from first visit to finished window. No hand-offs."],
    ['label' => "Written quote with all costs included", 'detail' => "Installation is in the total price. The itemised written quote at consultation is the final figure. No hidden labour fees, no travel charge for any Batavia 60510 address."],
];

$sa_process_heading = "Window Treatment Installation in Batavia: What to Expect";
$sa_process_intro   = "Every window treatment installation in Batavia follows the same fixed five-step process. For Batavia's older homes, step two is particularly important: the pre-installation measurement visit catches non-standard frame depths before fabrication begins.";
$sa_process = [
    ['step' => "Free In-Home Consultation", 'what' => "Installer visits with the full Norman Window Fashions sample collection.", 'detail' => "Appointments within 3 to 5 business days for all Batavia 60510 addresses. Saturday available on request."],
    ['step' => "Pre-Installation Measurement", 'what' => "Every window measured to inside or outside mount specifications.", 'detail' => "Critical for Batavia historic homes. Plaster wall depth, sash frame width and shutter frame clearance are all checked before any product is ordered. Outside mount configured where inside depth is insufficient."],
    ['step' => "Written Quote", 'what' => "Itemised quote: product, hardware and installation. No hidden charges.", 'detail' => "Same-day or next business day. No Batavia travel charge. Frame assessment included at no extra cost."],
    ['step' => "Custom Fabrication", 'what' => "Products fabricated to exact Batavia window measurements at Norman's factory.", 'detail' => "Lead times confirmed at consultation: 3-5 weeks shades and blinds, 4-6 weeks shutters. Custom frame configurations may extend shutter lead time by 1-2 weeks."],
    ['step' => "Installation Day", 'what' => "Installer arrives with the completed order and all required hardware.", 'detail' => "Arrival window confirmed 24 hours before appointment. Historic plaster wall anchoring handled with appropriate fixings."],
];

$related_links = [
    ['url' => "/window-treatments/window-treatment-installer/", 'label' => "Window treatment installation"],
    ['url' => "/window-treatments/window-shutters/", 'label' => "Custom shutters"],
    ['url' => "/service-areas/", 'label' => "All service areas"],
    ['url' => "/contact/", 'label' => "Get a free quote"],
];

$faqs = [
    ['q' => "Do you charge travel fees to come to Batavia, IL?",
     'a' => "No. There are no travel charges for Batavia. Our showroom at 850 S Frontenac St in Aurora is 10 miles from central Batavia. All consultation visits, pre-installation measurements and installation appointments are included in the cost of the order for every Batavia address in ZIP code 60510."],
    ['q' => "Can you fit window treatments in older Batavia homes with non-standard window frames?",
     'a' => "Yes. Batavia's historic district and Fox River corridor homes, those built between 1880 and 1960, frequently have window frame depths that differ from modern standard sizes, plaster walls that require specific fixings, and sash profiles that need careful mount assessment. Our installer checks every window at the pre-installation measurement visit before fabrication begins. Outside mount configurations are recommended and fitted where inside mount depth is insufficient. Norman Window Fashions shutters and shades can be ordered to non-standard sizes and with specialty frame options specifically for older construction."],
    ['q' => "How soon can you schedule a window treatment consultation in Batavia?",
     'a' => "For Batavia residents, free in-home consultation appointments are typically available within 3 to 5 business days. Saturday morning appointments between 10am and 1pm are available on request. Batavia falls 10 miles from our Aurora showroom within our core service area, so scheduling availability is consistent throughout the week. Call (630) 946-1406 or use the contact form to check current availability."],
    ['q' => "Do you install motorized window treatments in Batavia, IL?",
     'a' => "Yes. Motorized window treatment installation in Batavia covers Norman ShadeAuto motorized shades, PerfectTilt motorized shutters, SmartRise motorized blinds and motorized drapery track. Newer Batavia construction along Kirk Road and Fabyan Parkway is well suited to motorized treatments. For Batavia historic homes, battery-operated motor options mean no electrical work is needed: the ShadeAuto system runs on rechargeable batteries and connects to your Wi-Fi router via the Norman Hub. Every motorized Batavia installation includes hub mounting, app setup, Alexa and Google Home integration in a single appointment."],
    ['q' => "What window treatments work best for Batavia historic downtown homes?",
     'a' => "Batavia's limestone and brick homes from the 1880s through 1920s benefit from four specific product considerations. First, composite Woodlore shutters are preferred over real wood in rooms with higher humidity variation, as composite will not warp or crack with seasonal moisture changes common in older construction. Second, roman shades or roller shades with an outside mount suit windows where the recess depth is too shallow for inside mount hardware. Third, full-length custom drapery panels complement the tall original windows common in Batavia historic homes. Fourth, because plaster walls require specific anchoring, our installer selects the correct wall fixing at the measurement visit, not on installation day."],
    ['q' => "How much do window treatments cost in Batavia, IL?",
     'a' => "Batavia window treatment pricing covers the same range as our full service area, with one note: historic homes that require specialty outside mount configurations or non-standard frame hardware add a small amount to the shutter fabrication cost, confirmed in the written quote. Starting guide: cordless faux wood blinds from approximately $150 per window installed; composite Woodlore shutters from approximately $350 per window; roman shades with outside mount from approximately $180 per window; custom drapery panels from approximately $200 per panel. All prices include professional installation in Batavia with no hidden labour fees. A written itemised quote is provided at the free in-home consultation."],
];

$sa_cta_heading = "Batavia's Window Treatment Installer, Historic and New Homes";
$sa_cta_text    = "Book a free in-home consultation and we will bring the full Norman sample collection to your Batavia home. No obligation, and samples brought to you.";

require ROOT_PATH . '/includes/service-area-page.php';
