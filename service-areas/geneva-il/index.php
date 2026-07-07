<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';

$page_title       = "Window Treatment Installer in Geneva, IL";
$meta_description = "Geneva, IL window treatment installer. Custom shutters, blinds, shades & drapes for historic and premium homes. Free consultation. Call (630) 946-1406.";

$sa_h1          = "Window Treatment Installer in Geneva, IL";
$sa_path        = "/service-areas/geneva-il/";
$sa_area_served = ["Geneva"];
$sa_hero_image  = "assets/images/carousel/curtain-drape-background-2365x594.jpg";
$sa_hero_image_mobile = "assets/images/carousel/curtain-drape-background-666x577.jpg";
$sa_hero_intro  = "Creative Blinds & Drapes serves Geneva from our Aurora showroom, 12 miles away. We design and install custom shutters, blinds, shades and drapes from Norman Window Fashions across all of Geneva 60134, from the Third Street historic corridor to premium builds in Mill Creek and The Meadows. No travel charge to any Geneva address.";

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Service Areas', 'path' => '/service-areas/'],
    ['name' => 'Geneva, IL'],
];

$sa_coverage_heading = "Window Treatment Installation Across Geneva, IL";
$sa_coverage_intro   = "We install window treatments in Geneva across every neighborhood. Geneva's housing stock spans Victorian and Craftsman homes near Third Street and the Fox River through 1970s established neighborhoods such as Herrington Trails, to late 1990s and 2000s construction in Eagle Brook, Mill Creek and Fisher Farms, and premium custom homes in The Meadows. With a median home value above $448K and household incomes among the highest in the Fox Valley, Geneva homeowners frequently choose premium real wood shutters, motorized treatments and custom drapery.";
$sa_neighborhood_cols = ["Geneva Neighborhood / Subdivision", "Zone", "Housing Profile", "Best-Matched Products"];
$sa_neighborhoods = [
    ['area' => "Downtown Geneva & Third Street corridor", 'zone' => "Central west, Fox River", 'profile' => "Victorian and Craftsman homes, varied window sizes, original double-hung sash, older frame profiles", 'products' => "Real wood Brightwood and Normandy shutters, full-length custom drapery, outside-mount roman shades"],
    ['area' => "Fox River waterfront & Wheeler Park area", 'zone' => "Central, riverfront", 'profile' => "Established 1920s-1960s homes, Fox River views, larger window openings", 'products' => "Shutters, PerfectSheer shades, custom drapes for river-view rooms"],
    ['area' => "Herrington Trails", 'zone' => "West, south of State St", 'profile' => "1970s single-family homes. Established suburban profiles, consistent mid-century frame sizes.", 'products' => "Composite Woodlore shutters, cordless faux wood blinds, honeycomb shades"],
    ['area' => "Eagle Brook", 'zone' => "East, off Fargo and Randall", 'profile' => "Late 1990s custom-built homes, 18-hole golf course community. Higher value, larger footprints.", 'products' => "PerfectTilt motorized shutters, real wood blinds, ShadeAuto motorized shades"],
    ['area' => "Mill Creek", 'zone' => "Southwest, Fabyan west of Randall", 'profile' => "2000s community with 9 parks and golf course. Highest sales volume in Geneva. Consistent modern frames.", 'products' => "Motorized roller shades, triple-cell honeycomb, PerfectTilt shutters, motorized drapes"],
    ['area' => "Fisher Farms", 'zone' => "West of Randall, Williamsburg area", 'profile' => "Early 2000s Kimball Hill Homes construction on former 421-acre farm. Family-oriented, open plans.", 'products' => "Faux wood blinds, cordless honeycomb shades, composite Woodlore shutters"],
    ['area' => "The Meadows & Harvest Ridge", 'zone' => "North, Batavia Rd & Fabyan area", 'profile' => "Premium custom builds, highest average sale prices in Geneva ($710K+). Larger lots, architectural features.", 'products' => "Real wood Normandy shutters, custom drapery on motorized track, motorized PerfectTilt shutters"],
    ['area' => "Southwest Geneva & South Randall Rd", 'zone' => "Southwest, Route 25 corridor", 'profile' => "Modern colonial homes, newer construction. Suburban family profiles with open-plan layouts.", 'products' => "Motorized ShadeAuto shades, faux wood blinds, PerfectTilt motorized shutters"],
];

$sa_products_heading = "Custom Window Treatments Available in Geneva, IL";
$sa_products_intro   = "All Norman Window Fashions product categories are available for Geneva residents. Professional window treatment installation in Geneva is included on every order. Our range covers every Geneva price point, from composite shutters in Herrington Trails through to real wood collections and custom motorized drapery for The Meadows and Eagle Brook premium homes.";
$sa_products = [
    [
        'name' => "Custom Shutters in Geneva", 'badge' => "7 Collections | Historic to Premium Builds",
        'intro' => "Shutters for every Geneva home type. Real wood Brightwood and Normandy for Third Street historic homes and The Meadows custom builds; composite Woodlore for Mill Creek and Fisher Farms; PerfectTilt motorized for Eagle Brook and newer construction.",
        'features' => [
            "Real wood Brightwood shutters for Geneva historic downtown and Third Street homes",
            "Real wood Normandy shutters: 2,000+ paint and 10 stain options for The Meadows premium builds",
            "Composite Woodlore shutters for Geneva kitchens and bathrooms: moisture-resistant",
            "Composite Woodlore Plus for Mill Creek and Fisher Farms: additional colors and motorized option",
            "PerfectTilt motorized shutters for Eagle Brook and Southwest Geneva smart-home builds",
            "Specialty shape shutters for Geneva historic homes with arched or bay window openings",
        ],
        'browse_url' => "/window-treatments/window-shutters/", 'browse_label' => "Browse custom shutters in Geneva",
    ],
    [
        'name' => "Custom Blinds in Geneva", 'badge' => "5 Styles | All Geneva Home Types",
        'intro' => "Faux wood, real wood, aluminum and vertical blinds installed across all Geneva neighborhoods. Motorized upgrades for Eagle Brook and Mill Creek open-plan homes with large windows and high ceilings.",
        'features' => [
            "Faux wood blinds for Geneva kitchens and bathrooms across all subdivisions",
            "Real wood Normandy blinds for Geneva dining rooms, studies and home offices",
            "CityLights aluminum blinds for Geneva multi-use rooms and rental units",
            "Synchrony vertical blinds for patio slider doors in Mill Creek and Southwest Geneva builds",
            "Motorized blind upgrade: Norman Hub, Alexa and Google Home compatible",
            "Outside mount option for Geneva historic homes with shallow frame depths",
        ],
        'browse_url' => "/window-treatments/window-blinds/", 'browse_label' => "Browse custom blinds in Geneva",
    ],
    [
        'name' => "Custom Shades in Geneva", 'badge' => "6 Types | Motorized & Energy-Efficient",
        'intro' => "Roller, roman, honeycomb and sheer shades for all Geneva home types. Triple-cell honeycomb for Mill Creek and The Meadows larger window areas; outside-mount roman shades for Third Street historic homes; motorized ShadeAuto for Eagle Brook smart-home builds.",
        'features' => [
            "Portrait Honeycomb triple cell: maximum energy insulation for Mill Creek large glazing",
            "Centerpiece Roman shades for Third Street and Fox River corridor historic homes: outside mount option",
            "Soluna Roller shades: sheer to blackout for Geneva bedrooms across all subdivisions",
            "PerfectSheer shades for Geneva Fox River view rooms: privacy with natural light",
            "ShadeAuto motorized shades for Eagle Brook and The Meadows: app and voice control",
            "Inside mount depth checked at consultation for all Geneva historic and modern frames",
        ],
        'browse_url' => "/window-treatments/shades/", 'browse_label' => "Browse custom shades in Geneva",
    ],
    [
        'name' => "Custom Drapes & Curtains in Geneva", 'badge' => "70+ Fabrics | Motorized Track | Premium Drapery",
        'intro' => "Custom made curtains and drapes for Geneva homes from 70+ Fonluk drapery fabrics. Full-length custom drapery complements the tall original windows of Third Street historic homes and the large rooms of The Meadows and Eagle Brook builds. Motorized drapery track for open-plan rooms.",
        'features' => [
            "Full-length custom drapery for Geneva historic downtown homes with tall original windows",
            "Real-fabric drapery for The Meadows and Eagle Brook premium homes: 70+ Fonluk collection",
            "Blackout drapes for Geneva bedrooms: BLACKOUT_SATIN and ASTAR_DIMOUT fabrics",
            "Motorized drapery track for Geneva open-plan rooms in Mill Creek and Fisher Farms builds",
            "Sheer curtains: 54 fabric options for layered Geneva window treatments",
            "70+ drapery fabric samples brought to your Geneva home at no charge",
        ],
        'browse_url' => "/window-treatments/curtains-and-drapes/", 'browse_label' => "Browse custom drapes & curtains in Geneva",
    ],
];

$sa_trust = ["12 Miles from Geneva", "No Travel Charge", "Historic & Premium Expertise", "Installation Included"];

$sa_why_heading = "Why Geneva Homeowners Choose Creative Blinds & Drapes";
$sa_why = [
    ['label' => "Full Norman range across every Geneva price point", 'detail' => "Real wood Brightwood and Normandy shutters for Third Street historic homes and The Meadows premium builds; composite Woodlore for Mill Creek; motorized PerfectTilt for Eagle Brook. One supplier covers every Geneva home type."],
    ['label' => "Historic frame expertise for downtown Geneva and Fox River corridor homes", 'detail' => "Older Geneva homes have varied window depths, bay openings and sash profiles. Our installer checks each window at the measurement visit. Outside mount recommended and fitted where inside depth is insufficient."],
    ['label' => "Our own installer on every Geneva order", 'detail' => "The same team handles consultation, measurement and installation. One contact from first visit to finished window. No hand-offs between sales and fitting teams."],
    ['label' => "Premium drapery for The Meadows and Eagle Brook", 'detail' => "Custom Fonluk drapery fabrics on motorized track for Geneva premium builds. Samples brought to your home. Full-length panels fabricated to your exact window height."],
    ['label' => "Written quote with all costs included", 'detail' => "Installation is in the total price. The itemised written quote at consultation is the final figure. No hidden labour fees, no travel charge for any Geneva 60134 address."],
];

$sa_process_heading = "Window Treatment Installation in Geneva: What to Expect";
$sa_process_intro   = "Every window treatment installation in Geneva follows the same fixed five-step process, from free consultation to final installation.";
$sa_process = [
    ['step' => "Free In-Home Consultation", 'what' => "Installer visits with the full Norman Window Fashions sample collection.", 'detail' => "Appointments within 3 to 5 business days for all Geneva 60134 addresses. Saturday available on request."],
    ['step' => "Pre-Installation Measurement", 'what' => "Every window measured to inside or outside mount specifications.", 'detail' => "Geneva downtown and Fox River corridor homes may have shallow frame depths or bay configurations. Our installer assesses each window before any product is ordered."],
    ['step' => "Written Quote", 'what' => "Itemised quote: product, hardware and installation. No hidden charges.", 'detail' => "Same-day or next business day. No Geneva travel charge."],
    ['step' => "Custom Fabrication", 'what' => "Products fabricated to exact Geneva window dimensions at Norman's factory.", 'detail' => "Lead times confirmed at consultation: 3-5 weeks shades and blinds, 4-6 weeks shutters."],
    ['step' => "Installation Day", 'what' => "Installer arrives with the completed order and all required hardware.", 'detail' => "Arrival window confirmed 24 hours before appointment. Motorization pairing and app setup completed same day."],
];

$related_links = [
    ['url' => "/window-treatments/window-shutters/", 'label' => "Custom shutters"],
    ['url' => "/window-treatments/curtains-and-drapes/", 'label' => "Custom draperies and sheers"],
    ['url' => "/service-areas/", 'label' => "All service areas"],
    ['url' => "/contact/", 'label' => "Get a free quote"],
];

$faqs = [
    ['q' => "Do you charge travel fees to come to Geneva, IL?",
     'a' => "No. There are no travel charges for Geneva. Our showroom at 850 S Frontenac St in Aurora is 12 miles from central Geneva. All consultation visits, pre-installation measurements and installation appointments are included in the cost of the order for every Geneva address in ZIP code 60134."],
    ['q' => "Can you install window treatments in older Geneva homes near Third Street and the Fox River corridor?",
     'a' => "Yes. Geneva's Third Street and Fox River corridor homes, many dating from the 1880s through 1930s, present window profiles that differ from modern standard construction: original double-hung sash frames, shallow recess depths and in some cases bay or oriel window openings. Our installer assesses each window at the pre-installation measurement visit. Real wood Brightwood and Normandy shutters complement the period character of these homes. Roman shades and full-length drapery panels work well with outside mount configurations where inside mount depth is limited. Every Geneva historic home receives the same measurement process, and the written quote reflects any specialty hardware needed."],
    ['q' => "How soon can you schedule a window treatment consultation in Geneva?",
     'a' => "For Geneva residents, free in-home consultation appointments are typically available within 3 to 5 business days. Saturday morning appointments between 10am and 1pm are available on request. Geneva falls 12 miles from our Aurora showroom within our core service area, so scheduling availability is consistent throughout the week. Call (630) 946-1406 or use the contact form to check current availability."],
    ['q' => "Do you install motorized window treatments in Geneva, IL?",
     'a' => "Yes. Motorized window treatment installation in Geneva covers Norman ShadeAuto motorized shades, PerfectTilt motorized shutters, SmartRise motorized blinds and motorized drapery track. Eagle Brook and The Meadows custom homes, as well as Mill Creek and Southwest Geneva newer builds, are all well matched to motorized treatments due to larger glazing areas and open-plan layouts. Battery-operated motorized options mean no electrical work is needed for Geneva historic homes: the ShadeAuto system runs on rechargeable batteries and connects to your router via the Norman Hub. Every motorized Geneva installation includes hub mounting, app setup and Alexa and Google Home integration in a single appointment."],
    ['q' => "What window treatments work best for premium Geneva homes in The Meadows and Eagle Brook?",
     'a' => "Premium Geneva homes in The Meadows, Eagle Brook and Harvest Ridge are typically served by four product categories. Real wood Normandy shutters are the architectural choice for formal rooms: the 2,000+ custom paint colors and 10 stain options match any interior finish. Custom Fonluk drapery panels on motorized track suit the large rooms and open-plan layouts common in these builds, and the 70+ fabric options include commercial-grade weaves suited to high-use living spaces. PerfectTilt motorized shutters provide clean light control in master bedrooms and home offices without a visible tilt rod. For rooms where light diffusion without full privacy is the goal, PerfectSheer shades with the vane open deliver the best result."],
    ['q' => "How much do window treatments cost in Geneva, IL?",
     'a' => "Geneva window treatment pricing reflects the full range of the housing stock, from Herrington Trails through to The Meadows. Starting guide: cordless faux wood blinds from approximately $150 per window installed; composite Woodlore shutters from approximately $350 per window; real wood Brightwood or Normandy shutters from approximately $450 per window; motorized roller shades from approximately $350 per window; custom drapery panels from approximately $200 per panel. Premium finishes, motorization and specialty frame configurations are priced individually and confirmed in the written quote provided at the free in-home consultation."],
];

$sa_cta_heading = "Geneva's Window Treatment Installer, Historic and Premium Homes";
$sa_cta_text    = "Book a free in-home consultation and we will bring the full Norman sample collection to your Geneva home. No obligation, and samples brought to you.";

require ROOT_PATH . '/includes/service-area-page.php';
