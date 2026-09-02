<?php
// Site Configuration
define('SITE_URL', 'https://creativeblindsdrapes.com');
define('SITE_NAME', 'Creative Blinds & Drapes');
define('BUSINESS_PHONE', '(630) 946-1406');
define('BUSINESS_EMAIL', 'design@creativeblindsdrapes.com');
define('BUSINESS_ADDRESS', '850 S Frontenac St, Aurora, IL 60504');
define('BUSINESS_HOURS', 'Mon-Fri: 9am - 6pm, Sat: 10am - 1pm, Sun: Closed');
define('BUSINESS_HOURS_ML', 'Mon-Fri: 9am - 6pm<br>Sat: 10am - 1pm<br>Sun: Closed');

/*
 * Service-area communities (Aurora + 20-mile radius). Single source of truth for
 * Service/LocalBusiness areaServed schema and the upcoming /service-areas/ pages.
 */
define('SERVICE_AREAS', ['Aurora', 'Naperville', 'Oswego', 'Yorkville', 'Batavia', 'Geneva', 'St. Charles', 'Plainfield']);

// Social Media (optional - add links later)
define('FACEBOOK_URL', 'https://www.facebook.com/CreativeBlindsDrapes');
define('INSTAGRAM_URL', 'https://www.instagram.com/creative_blindsdrapes');

// Default Page Title
define('DEFAULT_TITLE', 'Custom Drapes, Blinds & Shutters in Aurora, IL');
define('DEFAULT_DESCRIPTION', 'Professional window treatment solutions in Aurora, Illinois. Custom drapes, blinds, shutters, and shades with expert installation.');

/*
 * Path framework
 * --------------
 * ROOT_PATH - filesystem root of the app, for server-side require/read. Depth-independent.
 * BASE_URL  - URL path prefix so root-relative URLs work both in production (site at the
 *             domain root → '') and locally (site under /creativeblindsdrapes → that prefix).
 *             Derived by diffing the app root against DOCUMENT_ROOT - no hardcoded folder name.
 */
define('ROOT_PATH', dirname(__DIR__));

$cbd_doc_root = !empty($_SERVER['DOCUMENT_ROOT']) ? realpath($_SERVER['DOCUMENT_ROOT']) : '';
$cbd_base_url = '';
if ($cbd_doc_root) {
    $cbd_doc_root = rtrim(str_replace('\\', '/', $cbd_doc_root), '/');
    $cbd_app_root = rtrim(str_replace('\\', '/', ROOT_PATH), '/');
    if (strpos($cbd_app_root, $cbd_doc_root) === 0) {
        $cbd_base_url = substr($cbd_app_root, strlen($cbd_doc_root)); // '' or '/creativeblindsdrapes'
    }
}
define('BASE_URL', $cbd_base_url);

/** Prefix a root-relative path with BASE_URL. Use for every internal URL (links, assets). */
function url($path = '/') {
    return BASE_URL . $path;
}

/*
 * Session bootstrap. Called only by pages that need cross-request state (the contact form
 * handoff to the thank-you page). Deliberately not called on every page view, so ordinary
 * visitors are never issued a session cookie.
 */
function cbd_session_start() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

/*
 * Primary navigation - single source of truth for header nav + footer product links.
 * Keys are root-relative URLs (run through url()); values are labels.
 */
define('PRIMARY_NAV', [
    '/window-treatments/window-shutters/'     => 'Shutters',
    '/window-treatments/window-blinds/'       => 'Blinds',
    '/window-treatments/shades/'              => 'Shades',
    '/window-treatments/curtains-and-drapes/' => 'Curtains',
    '/contact/'                               => 'Contact',
]);

/*
 * Header navigation - nested structure driving the top menu (and its dropdown).
 * A leaf item has 'label' + 'path'. A parent item adds 'children' (root-relative
 * URL => label). Kept separate from PRIMARY_NAV so the footer Products column is
 * unaffected. All URLs run through url().
 */
define('MAIN_NAV', [
    [
        'label' => 'Window Treatments',
        'path'  => '/window-treatments/',
        'children' => [
            '/window-treatments/window-shutters/'            => 'Shutters',
            '/window-treatments/window-blinds/'              => 'Blinds',
            '/window-treatments/shades/'                     => 'Shades',
            '/window-treatments/curtains-and-drapes/'        => 'Curtains',
            '/window-treatments/window-treatment-installer/' => 'Installation',
            '/window-treatments/motorized-window-treatment/' => 'Motorized',
        ],
    ],
    [
        'label' => 'Service Areas',
        'path'  => '/service-areas/',
        'children' => [
            '/service-areas/aurora-il/'     => 'Aurora',
            '/service-areas/naperville-il/' => 'Naperville',
            '/service-areas/oswego-il/'     => 'Oswego',
            '/service-areas/yorkville-il/'  => 'Yorkville',
            '/service-areas/batavia-il/'    => 'Batavia',
            '/service-areas/geneva-il/'     => 'Geneva',
            '/service-areas/st-charles-il/' => 'St. Charles',
            '/service-areas/plainfield-il/' => 'Plainfield',
        ],
    ],
    [
        'label' => 'Guidelines',
        'path'  => '/guidelines/',
        'children' => [
            '/guidelines/climate-light-control/'     => 'Climate & Light Control',
            '/guidelines/precision-measurement/'     => 'Precision Measurement',
            '/guidelines/inside-vs-outside-mounts/'   => 'Inside vs. Outside Mounts',
            '/guidelines/preparing-your-space/'       => 'Preparing Your Space',
            '/guidelines/professional-installation/'  => 'Professional Installation',
            '/guidelines/care-and-maintenance/'       => 'Care & Maintenance',
            '/guidelines/our-promise/'                => 'Our Promise',
        ],
    ],
    ['label' => 'About',   'path' => '/about-us/'],
    ['label' => 'Contact', 'path' => '/contact/'],
]);
?>