<?php
// Page-specific variables
$page_title = 'Window Treatments';
$meta_description = 'Custom window treatments in Aurora, IL — blinds, shutters, shades, and curtains & drapes. Free in-home consultation and professional installation.';

// Include header (loads config, which defines ROOT_PATH / BASE_URL / url())
require_once dirname(__DIR__) . '/includes/header.php';
?>

<!-- Page Header -->
<section class="page-header"
    style="background: linear-gradient(135deg, var(--primary-teal) 0%, var(--primary-teal-dark) 100%); color: white; padding: 60px 20px; text-align: center;">
    <div class="container">
        <h1 style="color: white; margin-bottom: 15px;">Window Treatments in Aurora, IL</h1>
        <p style="font-size: 1.2rem; color: rgba(255,255,255,0.95); max-width: 700px; margin: 0 auto;">
            Explore our full range of custom window treatments — blinds, shutters, shades, and curtains & drapes —
            backed by expert consultation and professional installation.
        </p>
    </div>
</section>

<?php include ROOT_PATH . '/includes/compact-form.php'; ?>

<!-- Category Grid -->
<section style="padding: 60px 20px;">
    <div class="container">
        <div class="section-header">
            <h2>Browse by Category</h2>
            <p>Find the perfect solution for every window in your home.</p>
        </div>

        <div class="grid-4" style="margin-top: 40px;">
            <?php
            // Product categories from the primary nav (everything except Contact)
            foreach (PRIMARY_NAV as $nav_path => $nav_label):
                if ($nav_path === '/contact/') continue;
            ?>
                <div style="text-align: center;">
                    <h3 style="margin-bottom: 10px;"><?php echo htmlspecialchars($nav_label); ?></h3>
                    <a href="<?php echo url($nav_path); ?>" class="btn btn-primary">Explore <?php echo htmlspecialchars($nav_label); ?></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Transform Your Windows?</h2>
        <p>Schedule a free in-home consultation. We'll bring samples directly to you!</p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-top: 30px;">
            <a href="<?php echo url('/contact/'); ?>#quote-form" class="btn btn-primary">Request Free Consultation</a>
            <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" onclick="dataLayer.push({'event': 'phone_click'});" class="btn btn-secondary"
                style="background-color: transparent; color: white; border-color: white;">
                Call <?php echo BUSINESS_PHONE; ?>
            </a>
        </div>
    </div>
</section>

<?php
require_once ROOT_PATH . '/includes/footer.php';
?>
