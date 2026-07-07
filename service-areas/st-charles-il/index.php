<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';

$page_title       = "Window Treatment Installer in St. Charles, IL";
$meta_description = "St. Charles, IL window treatment installer. Custom shutters, blinds, shades & drapes, both ZIP codes served. Free consultation. Call (630) 946-1406.";

$sa_h1          = "Window Treatment Installer in St. Charles, IL";
$sa_path        = "/service-areas/st-charles-il/";
$sa_area_served = ["St. Charles"];
$sa_hero_image  = "assets/images/carousel/curtain-drape-background-2365x594.jpg";
$sa_hero_image_mobile = "assets/images/carousel/curtain-drape-background-666x577.jpg";
$sa_hero_intro  = "Creative Blinds & Drapes serves St. Charles from our Aurora showroom, 14 miles away. We design and install custom shutters, blinds, shades and drapes from Norman Window Fashions across both St. Charles ZIP codes, 60174 and 60175, from the historic downtown to Royal Fox and Fox Mill estates. No travel charge to any St. Charles address.";

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Service Areas', 'path' => '/service-areas/'],
    ['name' => 'St. Charles, IL'],
];

$sa_coverage_heading = "Window Treatment Installation Across St. Charles, IL";
$sa_coverage_intro   = "We install window treatments in St. Charles across every subdivision and neighborhood in both ZIP codes 60174 and 60175. St. Charles presents one of the widest housing price ranges in the Fox Valley: from established 1970s homes in The Windings of Ferson Creek through to custom estates in Royal Fox, Fox Mill and Crane Road Estates with average sale prices above $800K.";
$sa_neighborhood_cols = ["St. Charles Neighborhood / Subdivision", "Location / ZIP", "Housing Profile", "Best-Matched Products"];
$sa_neighborhoods = [
    ['area' => "Downtown St. Charles & Fox River corridor", 'zone' => "Central, Route 31, 60174", 'profile' => "Victorian and historic brick homes, Fox River waterfront, older frame profiles. Hotel Baker and Arcada Theatre district.", 'products' => "Real wood Brightwood shutters, full-length custom drapery, outside-mount roman shades"],
    ['area' => "The Windings of Ferson Creek", 'zone' => "West, Empire & Burlington, 60175", 'profile' => "Mid-1970s single-family and townhomes. Established mature-tree community. Varied older frame profiles.", 'products' => "Composite Woodlore shutters, cordless faux wood blinds, cellular honeycomb shades"],
    ['area' => "Cambridge & Charlemagne", 'zone' => "Route 64 / South Tyler, 60174", 'profile' => "Mid-1980s and early 1990s single-family. Consistent suburban profiles.", 'products' => "Faux wood blinds, roman shades, composite Woodlore shutters inside mount"],
    ['area' => "Royal Fox Country Club", 'zone' => "Dunham Rd east of Route 31, 60174", 'profile' => "Country club community, 1988-2001. Luxury homes $700K to $1M+. Grand foyers, large glazing.", 'products' => "Real wood Normandy shutters, PerfectTilt motorized shutters, custom drapery on motorized track"],
    ['area' => "Fox Mill", 'zone' => "South of Route 64 / La Fox Rd, 60174", 'profile' => "Custom homes 1995-2012, avg $832K. Pool, lake, tennis. Large footprints with two-story windows.", 'products' => "Motorized ShadeAuto shades, PerfectTilt shutters, full-length motorized drapery"],
    ['area' => "Crane Road Estates & Heritage Oaks", 'zone' => "Crane Rd between Randall & Route 31, 60174", 'profile' => "Late 1980s to 1990s. Highest avg prices in St. Charles ($1.1M-$1.2M). Custom builds, architectural variety.", 'products' => "Real wood Brightwood and Normandy shutters, custom Fonluk drapery, motorized PerfectTilt"],
    ['area' => "Harvest Hills & Renaux Manor", 'zone' => "Route 64 west of Randall, 60174", 'profile' => "Early 2000s, 302 SFH and 350 townhomes. Consistent standard frames, family-oriented.", 'products' => "Cordless faux wood blinds, composite Woodlore shutters, triple-cell honeycomb shades"],
    ['area' => "Silver Glen Estates & Three Lakes", 'zone' => "Silver Glen east of Randall, 60174", 'profile' => "Mid-1980s to early 2000s single-family. Some waterfront lots. Higher lot values.", 'products' => "Composite Woodlore Plus shutters, motorized roller shades, PerfectSheer shades"],
];

$sa_products_heading = "Custom Window Treatments Available in St. Charles, IL";
$sa_products_intro   = "All Norman Window Fashions product categories are available for St. Charles residents. Professional window treatment installation in St. Charles is included on every order. Our range serves every St. Charles price point: from cordless composite shutters in Harvest Hills to real wood Normandy shutters for Royal Fox and Crane Road Estates.";
$sa_products = [
    [
        'name' => "Custom Shutters in St. Charles", 'badge' => "7 Collections | Entry to Ultra-Premium",
        'intro' => "Shutters for every St. Charles home. Composite Woodlore for Cambridge and Harvest Hills; real wood Brightwood and Normandy for Royal Fox, Fox Mill and Crane Road Estates; PerfectTilt motorized for all newer builds.",
        'features' => [
            "Composite Woodlore shutters for St. Charles kitchens and bathrooms in all subdivisions",
            "Composite Woodlore Plus for Silver Glen Estates and Three Lakes: expanded color range",
            "Real wood Brightwood shutters for St. Charles historic downtown and Fox River corridor homes",
            "Real wood Normandy shutters: 2,000+ paint and 10 stain options for Royal Fox and Crane Road Estates",
            "PerfectTilt motorized shutters for Fox Mill and Royal Fox smart-home builds",
            "Specialty shape shutters for St. Charles Victorian downtown and custom estate windows",
        ],
        'browse_url' => "/window-treatments/window-shutters/", 'browse_label' => "Browse custom shutters in St. Charles",
    ],
    [
        'name' => "Custom Blinds in St. Charles", 'badge' => "5 Styles | All Frame Types Covered",
        'intro' => "Faux wood, real wood, aluminum and vertical blinds installed across all St. Charles ZIP codes. Outside mount options for historic downtown homes. Motorized upgrades for Fox Mill and Royal Fox open-plan builds.",
        'features' => [
            "Faux wood blinds for St. Charles kitchens and bathrooms across all subdivisions",
            "Real wood Normandy blinds for St. Charles dining rooms and home offices",
            "CityLights aluminum blinds for St. Charles utility rooms and rental units",
            "Synchrony vertical blinds for patio slider doors in Harvest Hills and Renaux Manor",
            "Motorized blind upgrade: Norman Hub, Alexa and Google Home compatible",
            "Outside mount assessed at measurement visit for St. Charles historic frame profiles",
        ],
        'browse_url' => "/window-treatments/window-blinds/", 'browse_label' => "Browse custom blinds in St. Charles",
    ],
    [
        'name' => "Custom Shades in St. Charles", 'badge' => "6 Types | Historic to Premium Builds",
        'intro' => "Roller, roman, honeycomb and sheer shades for all St. Charles home types. Roman shades with outside mount for historic downtown homes; triple-cell honeycomb for Harvest Hills energy-efficiency; ShadeAuto motorized for Fox Mill and Royal Fox.",
        'features' => [
            "Centerpiece Roman shades for St. Charles historic downtown: outside mount option available",
            "Portrait Honeycomb triple cell for Harvest Hills and Renaux Manor energy insulation",
            "Soluna Roller shades: sheer to blackout for all St. Charles bedrooms",
            "PerfectSheer shades for Silver Glen Estates and Three Lakes: light with privacy",
            "ShadeAuto motorized shades for Fox Mill and Royal Fox: app and voice control",
            "Inside mount depth checked at measurement visit for all St. Charles frame types",
        ],
        'browse_url' => "/window-treatments/shades/", 'browse_label' => "Browse custom shades in St. Charles",
    ],
    [
        'name' => "Custom Drapes & Curtains in St. Charles", 'badge' => "70+ Fabrics | Motorized Track | Premium Drapery",
        'intro' => "Custom made curtains and drapes for St. Charles homes from 70+ Fonluk drapery fabrics. Full-length drapery on motorized track for Royal Fox, Fox Mill and Crane Road Estates large rooms and two-story windows.",
        'features' => [
            "Full-length custom drapery for Royal Fox and Fox Mill premium homes: 70+ Fonluk fabrics",
            "Motorized drapery track for two-story and open-plan windows in St. Charles luxury builds",
            "Custom made curtains in St. Charles: fabricated to your exact window dimensions",
            "Blackout drapes for St. Charles bedrooms: BLACKOUT_SATIN and ASTAR_DIMOUT fabrics",
            "Sheer curtains: 54 fabric options for layered St. Charles window treatments",
            "70+ drapery fabric samples brought to your St. Charles home at no charge",
        ],
        'browse_url' => "/window-treatments/curtains-and-drapes/", 'browse_label' => "Browse custom drapes & curtains in St. Charles",
    ],
];

$sa_trust = ["14 Miles from St. Charles", "No Travel Charge", "60174 & 60175 Covered", "Installation Included"];

$sa_why_heading = "Why St. Charles Homeowners Choose Creative Blinds & Drapes";
$sa_why = [
    ['label' => "Full Norman range from Harvest Hills to Crane Road Estates", 'detail' => "Composite shutters at entry level; real wood Normandy for luxury builds; PerfectTilt motorized for smart homes. One supplier covers the entire St. Charles price spectrum in a single free in-home consultation."],
    ['label' => "Historic frame expertise for downtown St. Charles homes", 'detail' => "Fox River corridor Victorian and brick homes have varied sash profiles and shallow recess depths. Our installer assesses each window at the measurement visit and recommends inside or outside mount based on the actual frame dimensions."],
    ['label' => "Both ZIP codes 60174 and 60175 fully covered", 'detail' => "Every St. Charles address, including the 60175 western areas such as The Windings of Ferson Creek and rural Route 64 corridor, is within our 20-mile service radius. No travel charge for either ZIP code."],
    ['label' => "Our own installer on every St. Charles order", 'detail' => "The same team handles consultation, measurement and installation for every St. Charles order. One contact from first visit to finished window."],
    ['label' => "Written quote with all costs included", 'detail' => "Installation is in the total price. The itemised written quote at consultation is the final figure. No hidden labour fees, no travel charge for any St. Charles address."],
];

$sa_process_heading = "Window Treatment Installation in St. Charles: What to Expect";
$sa_process_intro   = "Every window treatment installation in St. Charles follows the same fixed five-step process, from free consultation to final installation.";
$sa_process = [
    ['step' => "Free In-Home Consultation", 'what' => "Installer visits with the full Norman Window Fashions sample collection.", 'detail' => "Appointments within 3 to 5 business days for all St. Charles 60174 and 60175 addresses. Saturday available on request."],
    ['step' => "Pre-Installation Measurement", 'what' => "Every window measured to inside or outside mount specifications.", 'detail' => "For Royal Fox, Fox Mill and Crane Road Estates: two-story windows and large opening sizes noted for motorization routing and drapery track spans. Historic downtown homes: frame depth and sash profile checked before ordering."],
    ['step' => "Written Quote", 'what' => "Itemised quote: product, hardware and installation. No hidden charges.", 'detail' => "Same-day or next business day. No St. Charles travel charge for either ZIP code."],
    ['step' => "Custom Fabrication", 'what' => "Products fabricated to exact St. Charles window dimensions at Norman's factory.", 'detail' => "Lead times confirmed at consultation: 3-5 weeks shades and blinds, 4-6 weeks shutters."],
    ['step' => "Installation Day", 'what' => "Installer arrives with the completed order and all required hardware.", 'detail' => "Arrival window confirmed 24 hours before appointment. Motorization pairing and app setup completed same day."],
];

$related_links = [
    ['url' => "/window-treatments/window-shutters/", 'label' => "Custom shutters"],
    ['url' => "/window-treatments/motorized-window-treatment/", 'label' => "Motorized window treatments"],
    ['url' => "/service-areas/", 'label' => "All service areas"],
    ['url' => "/contact/", 'label' => "Get a free quote"],
];

$faqs = [
    ['q' => "Do you charge travel fees to come to St. Charles, IL?",
     'a' => "No. There are no travel charges for St. Charles. Our showroom at 850 S Frontenac St in Aurora is 14 miles from central St. Charles. All consultation visits, pre-installation measurements and installation appointments are included in the cost of the order for every St. Charles address in ZIP codes 60174 and 60175."],
    ['q' => "What areas of St. Charles do you serve?",
     'a' => "We serve all of St. Charles in both ZIP codes 60174 and 60175. Coverage includes every named subdivision: Royal Fox, Fox Mill, Crane Road Estates, Heritage Oaks, Silver Glen Estates, Three Lakes, The Windings of Ferson Creek, Cambridge, Charlemagne, Harvest Hills, Renaux Manor, Pheasant Run Trails, Traditions at Harvest Hills, and all addresses along Route 64, Route 31, Dunham Road and Silver Glen Road. If your St. Charles address is not listed, call (630) 946-1406 to confirm coverage."],
    ['q' => "How soon can you schedule a window treatment consultation in St. Charles?",
     'a' => "For St. Charles residents, free in-home consultation appointments are typically available within 3 to 5 business days. Saturday morning appointments between 10am and 1pm are available on request. St. Charles falls 14 miles from our Aurora showroom, and it is one of our most active service markets in the Tri-Cities corridor. Call (630) 946-1406 or use the contact form to check current availability."],
    ['q' => "Do you install motorized window treatments in St. Charles, IL?",
     'a' => "Yes. Motorized window treatment installation in St. Charles covers Norman ShadeAuto motorized shades, PerfectTilt motorized shutters, SmartRise motorized blinds and motorized drapery track. Royal Fox, Fox Mill and Crane Road Estates homes, with their large open-plan rooms and two-story windows, are particularly well matched to motorized treatments. Battery-operated motor options mean no electrical work is needed for most installations: the ShadeAuto system runs on rechargeable batteries and connects to your router via the Norman Hub. Every motorized St. Charles installation includes hub mounting, app setup and Alexa and Google Home integration in a single appointment."],
    ['q' => "What window treatments work best for Royal Fox and Fox Mill luxury homes?",
     'a' => "Royal Fox and Fox Mill homes, with average sale prices above $700K and floor plans up to 7,400 square feet, are well served by four specific product categories. Real wood Normandy shutters are the architectural choice for formal rooms: the 2,000+ custom paint and 10 stain options match any interior finish specification. Custom Fonluk drapery panels on motorized track handle the large rooms and two-story window spans common in these builds. PerfectTilt motorized shutters provide clean light control without a visible tilt rod in master bedrooms and home offices. For outdoor entertaining rooms and rooms with golf course or waterfront views, PerfectSheer shades rotate to control glare while preserving the view."],
    ['q' => "How much do window treatments cost in St. Charles, IL?",
     'a' => "St. Charles window treatment pricing reflects the full housing spectrum from Cambridge and Harvest Hills through to Royal Fox and Crane Road Estates. Starting guide: cordless faux wood blinds from approximately $150 per window installed; composite Woodlore shutters from approximately $350 per window; real wood Brightwood or Normandy shutters from approximately $450 per window; motorized roller shades from approximately $350 per window; custom drapery panels from approximately $200 per panel. Premium finishes, motorization and two-story installations are priced individually and confirmed in the written quote at the free in-home consultation."],
];

$sa_cta_heading = "St. Charles Window Treatment Installer, Both ZIP Codes";
$sa_cta_text    = "Book a free in-home consultation and we will bring the full Norman sample collection to your St. Charles home. No obligation, and samples brought to you.";

require ROOT_PATH . '/includes/service-area-page.php';
