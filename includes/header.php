<?php
require_once __DIR__ . '/config.php';

if (!isset($page_title)) {
    $page_title = DEFAULT_TITLE;
}
if (!isset($meta_description)) {
    $meta_description = DEFAULT_DESCRIPTION;
}
// Request path (BASE_URL stripped, query removed) drives canonical + nav active state.
$request_path = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
if (BASE_URL !== '' && strpos($request_path, BASE_URL) === 0) {
    $request_path = substr($request_path, strlen(BASE_URL));
}
if ($request_path === '' || $request_path === '/index.php') {
    $request_path = '/';
}
$canonical_url = SITE_URL . $request_path;
$og_image = SITE_URL . '/assets/images/showroom/displays-cfa.jpeg';

$local_business_schema = [
    '@context' => 'https://schema.org',
    '@type' => 'LocalBusiness',
    '@id' => SITE_URL . '/#business',
    'name' => SITE_NAME,
    'telephone' => BUSINESS_PHONE,
    'email' => BUSINESS_EMAIL,
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => '850 S Frontenac St',
        'addressLocality' => 'Aurora',
        'addressRegion' => 'IL',
        'postalCode' => '60504',
        'addressCountry' => 'US'
    ],
    'openingHoursSpecification' => [
        [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            'opens' => '09:00',
            'closes' => '18:00'
        ],
        [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Saturday'],
            'opens' => '10:00',
            'closes' => '13:00'
        ]
    ],
    'url' => SITE_URL,
    'image' => $og_image
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($meta_description); ?>">
    <?php if (!empty($noindex)): ?>
        <meta name="robots" content="noindex, nofollow">
    <?php endif; ?>
    <title><?php echo htmlspecialchars($page_title); ?> | <?php echo SITE_NAME; ?></title>

    <!-- Canonical -->
    <link rel="canonical" href="<?php echo htmlspecialchars($canonical_url); ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?php echo htmlspecialchars(SITE_NAME); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($page_title . ' | ' . SITE_NAME); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($meta_description); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonical_url); ?>">
    <meta property="og:image" content="<?php echo $og_image; ?>">
    <meta property="og:locale" content="en_US">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($page_title . ' | ' . SITE_NAME); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($meta_description); ?>">
    <meta name="twitter:image" content="<?php echo $og_image; ?>">

    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || []; w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            }); var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-W9J8WXQX');</script>
    <!-- End Google Tag Manager -->

    <!-- CallRail Dynamic Number Insertion -->
    <script type="text/javascript" src="https://cdn.callrail.com/companies/351100287/0436d05c85c55e6a5496/12/swap.js"></script>
    <!-- End CallRail -->

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap"
        rel="stylesheet">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="<?php echo url('/css/style.css'); ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo url('/assets/images/logo/cd-icon-round.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo url('/assets/images/logo/cd-icon-round.png'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo url('/assets/images/logo/cd-icon-round.png'); ?>">
    <link rel="shortcut icon" href="<?php echo url('/assets/images/logo/cd-icon-round.png'); ?>">

    <!-- LCP hero image preload -->
    <?php if (!empty($lcp_image_mobile)): ?>
        <link rel="preload" as="image" href="<?php echo htmlspecialchars($lcp_image_mobile); ?>" media="(max-width: 991px)">
        <link rel="preload" as="image" href="<?php echo htmlspecialchars($lcp_image); ?>" media="(min-width: 992px)">
    <?php elseif (!empty($lcp_image)): ?>
        <link rel="preload" as="image" href="<?php echo htmlspecialchars($lcp_image); ?>">
    <?php endif; ?>

    <!-- LocalBusiness Schema -->
    <script
        type="application/ld+json"><?php echo json_encode($local_business_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>

    <?php if (!empty($page_schema_json)): ?>
        <script type="application/ld+json"><?php echo $page_schema_json; ?></script>
    <?php endif; ?>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W9J8WXQX" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->


    <div class="header-top">
        <div class="container">
            <div class="header-top-content">
                <div class="contact-info">
                    <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>"
                        onclick="dataLayer.push({'event': 'phone_click'});" class="header-phone">
                        <span class="icon">📞</span>
                        <?php echo BUSINESS_PHONE; ?>
                    </a>
                    <span class="separator">|</span>
                    <span class="hours">
                        <?php echo BUSINESS_HOURS; ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- Header -->
    <header class="site-header">
        <div class="header-main">
            <div class="container">
                <div class="header-content">
                    <div class="logo">
                        <a href="<?php echo url('/'); ?>">
                            <img src="<?php echo url('/assets/images/logo/CD-logo.png'); ?>"
                                alt="Creative Blinds & Drapes Aurora IL"
                                class="logo-img">
                            <p class="tagline">Aurora's Premier Window Treatment Experts</p>
                        </a>
                    </div>

                    <nav class="main-nav" id="mainNav">
                        <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>

                        <ul class="nav-menu">
                            <?php $cur = rtrim($request_path, '/'); foreach (PRIMARY_NAV as $nav_path => $nav_label): ?>
                                <li><a href="<?php echo url($nav_path); ?>"
                                       class="<?php echo $cur === rtrim($nav_path, '/') ? 'active' : ''; ?>"><?php echo htmlspecialchars($nav_label); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Start -->
    <main class="main-content"></main>