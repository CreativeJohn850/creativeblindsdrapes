<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';

$page_title       = "Window Treatment Installer in Naperville, IL";
$meta_description = "Naperville's trusted window treatment installer. Custom shutters, blinds, shades & drapes. Free consultation, no travel charge. Call (630) 946-1406.";

$sa_h1          = "Window Treatment Installer in Naperville, IL";
$sa_path        = "/service-areas/naperville-il/";
$sa_area_served = ["Naperville"];
$sa_hero_image  = "assets/images/carousel/curtain-drape-background-2365x594.jpg";
$sa_hero_image_mobile = "assets/images/carousel/curtain-drape-background-666x577.jpg";
$sa_hero_intro  = "Creative Blinds & Drapes serves Naperville from our Aurora showroom, just 8 miles away. We design and install custom shutters, blinds, shades and drapes from Norman Window Fashions across all Naperville ZIP codes, backed by 23 years of experience through Creative Floors Inc. No travel charge applies to any Naperville address.";

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Service Areas', 'path' => '/service-areas/'],
    ['name' => 'Naperville, IL'],
];

$sa_coverage_heading = "Window Treatment Installation Across Naperville, IL";
$sa_coverage_intro   = "We install window treatments in Naperville across every neighborhood and ZIP code. Naperville's mix of historic downtown homes, established mid-century subdivisions and newer construction in the south presents a wide range of window profiles, each with specific mounting and product requirements our installer handles daily.";
$sa_neighborhood_cols = ["Naperville Neighborhood / Area", "ZIP Code", "Typical Window Profile", "Best-Matched Products"];
$sa_neighborhoods = [
    ['area' => "Downtown & Riverwalk Historic District", 'zone' => "60540", 'profile' => "Victorian and Colonial Revival homes, older double-hung frames, plaster walls", 'products' => "Specialty shape shutters, Woodlore composite shutters, inside-mount roman shades"],
    ['area' => "Old Naperville & Washington Street corridor", 'zone' => "60540", 'profile' => "Established residential, mixed frame sizes, older construction", 'products' => "Wood blinds, composite shutters, cordless honeycomb shades"],
    ['area' => "Northern Naperville & Route 59 corridor", 'zone' => "60563", 'profile' => "Suburban residential, consistent modern frames, energy-efficient builds", 'products' => "Triple-cell honeycomb shades, motorized roller shades, faux wood blinds"],
    ['area' => "Tall Grass & Naperville Crossings", 'zone' => "60564", 'profile' => "Newer construction subdivisions, large open-plan windows, high ceilings", 'products' => "Motorized PerfectTilt shutters, Soluna roller shades, motorized drapery track"],
    ['area' => "South Naperville & Knoch Knolls area", 'zone' => "60565", 'profile' => "Mix of established and newer builds, larger lot homes", 'products' => "Shutters, motorized shades, vertical blinds for wide windows"],
    ['area' => "Hawthorne Square & Maple Brook area", 'zone' => "60565", 'profile' => "Contemporary subdivisions near Plainfield border, modern frames", 'products' => "Motorized honeycomb shades, faux wood blinds, custom drapes with motorized track"],
    ['area' => "Naperville Crossings & 95th Street corridor", 'zone' => "60564", 'profile' => "High-growth area, new-build profiles, large patio sliders", 'products' => "Synchrony vertical blinds, motorized roller shades, bypass shutters for sliders"],
];

$sa_products_heading = "Custom Window Treatments Available in Naperville, IL";
$sa_products_intro   = "All five Norman Window Fashions product categories are available for Naperville residents. Professional window treatment installation in Naperville is included on every order. No travel charge from our Aurora showroom.";
$sa_products = [
    [
        'name' => "Custom Shutters in Naperville", 'badge' => "7 Collections | Wood, Composite & Motorized",
        'intro' => "Shutters for Naperville homes from real wood (Brightwood, Normandy) and moisture-resistant composite (Woodlore, Woodlore Plus). PerfectTilt motorized shutters for Naperville smart-home builds.",
        'features' => [
            "Real wood shutters for Naperville Historic District and Washington Street homes",
            "Composite Woodlore shutters for Naperville kitchens and bathrooms",
            "PerfectTilt motorized shutters: app and voice control for Tall Grass and Crossings builds",
            "Specialty shape shutters for Naperville's older Victorian and Colonial Revival windows",
            "Bypass shutters for Naperville homes with wide patio slider doors",
            "Free in-home measurement across all Naperville ZIP codes",
        ],
        'browse_url' => "/window-treatments/window-shutters/", 'browse_label' => "Browse custom shutters in Naperville",
    ],
    [
        'name' => "Custom Blinds in Naperville", 'badge' => "5 Styles | Cordless & Motorized",
        'intro' => "Faux wood, real wood, aluminum and vertical blinds installed across Naperville. Child-safe cordless systems and motorized upgrades for newer Naperville construction with large windows.",
        'features' => [
            "Faux wood blinds for Naperville kitchens and bathrooms: moisture-resistant composite",
            "Real wood Normandy blinds for Naperville living rooms and dining rooms",
            "CityLights aluminum blinds for Naperville home offices",
            "Synchrony vertical blinds for Naperville homes with wide patio sliders",
            "Motorized blind upgrade: Norman Hub, Alexa and Google Home",
            "Inside and outside mount for all Naperville window frame types",
        ],
        'browse_url' => "/window-treatments/window-blinds/", 'browse_label' => "Browse custom blinds in Naperville",
    ],
    [
        'name' => "Custom Shades in Naperville", 'badge' => "6 Types | Energy-Efficient Triple Cell",
        'intro' => "Roller, roman, honeycomb and sheer shades for Naperville homes. Triple-cell honeycomb shades provide maximum insulation for Naperville's open-plan homes with high ceilings and large glazing.",
        'features' => [
            "Portrait Honeycomb triple cell for Naperville energy-efficient builds in 60563 and 60564",
            "Soluna Roller shades: sheer to blackout for Naperville bedrooms",
            "Centerpiece Roman shades for Naperville Historic District living rooms",
            "PerfectSheer shades for Naperville street-facing privacy without blocking light",
            "ShadeAuto motorized shades: app and voice control for Naperville smart homes",
            "Inside mount shades for Naperville's newer standard-frame construction",
        ],
        'browse_url' => "/window-treatments/shades/", 'browse_label' => "Browse custom shades in Naperville",
    ],
    [
        'name' => "Custom Drapes & Curtains in Naperville", 'badge' => "70+ Fabrics | Motorized Track",
        'intro' => "Custom made curtains and drapes for Naperville homes from 70+ Fonluk drapery fabrics. Motorized drapery track for Naperville's open-plan living and dining rooms with high or wide windows.",
        'features' => [
            "Custom made curtains in Naperville: fabricated to your exact window dimensions",
            "Blackout drapes for Naperville bedrooms and media rooms",
            "Sheer curtains: 54 fabric options for layered Naperville window treatments",
            "Motorized drapery track for Naperville open-plan homes in Tall Grass and Crossings",
            "Professional drapery installation in Naperville: rod, track and panel dressing included",
            "70+ drapery fabrics: samples brought to your Naperville home at no charge",
        ],
        'browse_url' => "/window-treatments/curtains-and-drapes/", 'browse_label' => "Browse custom drapes & curtains in Naperville",
    ],
];

$sa_trust = ["8 Miles from Naperville", "No Travel Charge", "Norman Window Fashions", "Installation Included"];

$sa_why_heading = "Why Naperville Homeowners Choose Creative Blinds & Drapes";
$sa_why = [
    ['label' => "Full Norman Window Fashions product range", 'detail' => "7 shutter collections, 5 blind styles, 6 shade types and 70+ drapery fabrics. Every product available with cordless or motorized operating systems."],
    ['label' => "Our own Aurora-based installer on every order", 'detail' => "The same team handles your Naperville consultation, measurement and installation. One contact from start to finished window, with no hand-offs."],
    ['label' => "Written quote with no hidden charges", 'detail' => "Installation is included in the total price. The itemised written quote you receive at the consultation is what you pay. No separate labour fees, no travel charges."],
    ['label' => "Four Naperville ZIP codes fully covered", 'detail' => "60540, 60563, 60564 and 60565. Every Naperville address from the Historic District to the Plainfield border falls within our 20-mile service radius."],
    ['label' => "Motorized installation included", 'detail' => "Norman ShadeAuto, PerfectTilt and SmartRise setup, app pairing, schedule programming and voice command testing are included in every motorized order."],
];

$sa_process_heading = "Window Treatment Installation in Naperville: What to Expect";
$sa_process_intro   = "Every window treatment installation in Naperville follows the same fixed process as our Aurora base. Our installer drives to your Naperville address, handles everything on site and leaves a finished window in a single visit.";
$sa_process = [
    ['step' => "Free In-Home Consultation", 'what' => "Installer visits your Naperville home with the full Norman Window Fashions sample collection.", 'detail' => "3 to 5 business days availability for all Naperville ZIP codes. Saturday appointments available on request."],
    ['step' => "Pre-Installation Measurement", 'what' => "Every window measured to inside or outside mount specifications before fabrication.", 'detail' => "Naperville's newer builds in 60564 and 60565 use standard frames. Historic District 60540 homes may require specialty frames checked at this stage."],
    ['step' => "Written Quote", 'what' => "Itemised quote covering product, hardware and installation. No hidden labour fees.", 'detail' => "Quote delivered same-day or next business day. No separate Naperville travel charge."],
    ['step' => "Custom Fabrication", 'what' => "Products fabricated to exact Naperville window measurements at Norman's factory.", 'detail' => "Lead time confirmed at consultation: 3-5 weeks shades and blinds, 4-6 weeks shutters."],
    ['step' => "Installation Day", 'what' => "Installer arrives at your Naperville address with the completed order and all hardware.", 'detail' => "Arrival window confirmed 24 hours before appointment. One installer handles the full project."],
];

$related_links = [
    ['url' => "/window-treatments/window-treatment-installer/", 'label' => "Window treatment installation"],
    ['url' => "/window-treatments/motorized-window-treatment/", 'label' => "Motorized window treatments"],
    ['url' => "/service-areas/", 'label' => "All service areas"],
    ['url' => "/contact/", 'label' => "Get a free quote"],
];

$faqs = [
    ['q' => "Do you charge travel fees to come to Naperville?",
     'a' => "No. There are no travel charges for Naperville. Our showroom at 850 S Frontenac St in Aurora, IL is 8 miles from central Naperville. Consultation visits, pre-installation measurement and installation appointments are all included in the cost of the order for every Naperville address across ZIP codes 60540, 60563, 60564 and 60565."],
    ['q' => "What Naperville ZIP codes do you serve?",
     'a' => "We cover all four main Naperville ZIP codes: 60540 (downtown and Historic District), 60563 (northern Naperville and the Route 59 corridor), 60564 (Tall Grass, Naperville Crossings and the 95th Street area) and 60565 (south Naperville including Knoch Knolls and the Plainfield border area). If your Naperville address falls within a less common ZIP code, call (630) 946-1406 and we will confirm coverage immediately."],
    ['q' => "How soon can you schedule a window treatment consultation in Naperville?",
     'a' => "For Naperville residents, consultation appointments are typically available within 3 to 5 business days. Evening appointments are available by request for all Naperville ZIP codes. Saturday morning appointments between 10am and 1pm are also available. Because our installer is Aurora-based and Naperville is our most active service market outside Aurora, we maintain consistent weekly availability for the Naperville area. Call (630) 946-1406 to check current availability."],
    ['q' => "Do you install motorized window treatments in Naperville?",
     'a' => "Yes. Motorized window treatment installation in Naperville covers the full Norman system: ShadeAuto motorized shades, PerfectTilt motorized shutters, SmartRise motorized blinds and motorized drapery track. Naperville's newer builds in 60564 and 60565, particularly in Tall Grass and Naperville Crossings, are well suited to motorized window treatments due to their open-plan layouts and large glazing. Every motorized Naperville installation includes Norman Hub pairing, Norman App setup, Amazon Alexa and Google Home voice command testing in a single appointment."],
    ['q' => "What makes Creative Blinds & Drapes the right choice for Naperville window treatments?",
     'a' => "Creative Blinds & Drapes brings three specific advantages to every Naperville order. The full Norman Window Fashions product range covers 7 shutter collections, 5 blind styles, 6 shade types and 70+ drapery fabrics, all available with cordless or motorized operating systems. Our installer is Aurora-based and covers Naperville as our primary service market outside Aurora, meaning scheduling is consistent and the same person handles consultation, measurement and installation. Every order includes a written itemised quote with installation included: no separate labour fee, no travel charge, no surprises."],
    ['q' => "How much do window treatments cost in Naperville, IL?",
     'a' => "Naperville window treatment pricing follows the same structure as our full service area. Starting guide: cordless faux wood blinds from approximately $150 per window installed; composite Woodlore shutters from approximately $350 per window; motorized roller shades from approximately $350 per window; custom made curtains from approximately $200 per panel. All prices include professional installation in Naperville with no separate labour fees or travel charges. A written itemised quote is provided at the free in-home consultation before any order is placed."],
];

$sa_cta_heading = "Naperville's Window Treatment Installer, No Travel Charge";
$sa_cta_text    = "Book a free in-home consultation and we will bring the full Norman sample collection to your Naperville home. No obligation, and samples brought to you.";

require ROOT_PATH . '/includes/service-area-page.php';
