<?php
require_once __DIR__ . '/config.php';

// Set page title - can be overridden in individual pages
if (!isset($page_title)) {
    $page_title = DEFAULT_TITLE;
}
if (!isset($meta_description)) {
    $meta_description = DEFAULT_DESCRIPTION;
}
// Current page detection for active nav
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($meta_description); ?>">
    <title><?php echo htmlspecialchars($page_title); ?> | <?php echo SITE_NAME; ?></title>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-HFYHCDK94L"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-HFYHCDK94L');
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap"
        rel="stylesheet">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="header-top">
        <div class="container">
            <div class="header-top-content">
                <div class="contact-info">
                    <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>"
                        class="header-phone">
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
                        <a href="index.php">
                            <img loading="lazy" src="assets/images/logo/CD-logo.png" alt="Creative Drapes Naperville IL"
                                style="margin: 1rem; height: 120px;" class="d-none d-lg-block">
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
                            <li><a href="index.php"
                                    class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">Home</a></li>
                            <!-- <li><a href="about.php" class="<?php echo ($current_page == 'about.php') ? 'active' : ''; ?>">About</a></li> -->
                            <li><a href="drapes-curtains.php">Draperies</a></li>
                            <li><a href="sheer-curtains.php">Sheers</a></li>
                            <!-- <li><a href="gallery.php" class="<?php echo ($current_page == 'gallery.php') ? 'active' : ''; ?>">Gallery</a></li> -->
                            <li><a href="contact.php"
                                    class="<?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>">Contact</a>
                            </li>
                            <li class="cta-nav"><a href="contact.php#quote-form" class="btn-quote">Get Free Quote</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Start -->
    <main class="main-content"></main>