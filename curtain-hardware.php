<?php
require_once 'includes/config.php';

$page_title = 'Curtain Hardware & Accessories';
$meta_description = 'Browse our selection of premium curtain hardware and accessories. Bendable tracks, valance rails, and more to complete your window treatments in Aurora, IL.';

$tracks_json = file_get_contents('data/tracks.json');
$track_products = json_decode($tracks_json, true);

if (json_last_error() !== JSON_ERROR_NONE || !is_array($track_products)) {
    $track_products = [];
}

// Include header
require_once 'includes/header.php';
?>
<!-- Page Header -->
<section class="page-header"
    style="background: linear-gradient(135deg, var(--primary-teal) 0%, var(--primary-teal-dark) 100%); color: white; padding: 60px 20px; text-align: center;">
    <div class="container">
        <h1 style="color: white; margin-bottom: 15px;">Curtain Rods, Tracks &amp; Hardware in Aurora, IL</h1>
        <p style="font-size: 1.2rem; color: rgba(255,255,255,0.95); max-width: 700px; margin: 0 auto;">
            Quality curtain tracks, rods, and accessories to complete your window treatment installation in Aurora, IL.
        </p>
    </div>
</section>

<?php include 'includes/compact-form.php'; ?>

<!-- Curtain Tracks Section -->
<section style="padding: 60px 20px;">
    <div class="container">
        <div class="section-header">
            <h2>Curtain Tracks</h2>
            <p>Versatile, wall- or ceiling-mounted tracks for every window and curtain type.</p>
        </div>

        <?php if (!empty($track_products)): ?>
        <div class="products-grid"
            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px; margin-top: 40px;">
            <?php foreach ($track_products as $track): ?>
                <div class="product-card">
                    <div class="card-content" style="padding: 25px;">
                        <h3 style="font-size: 1.15rem; margin-bottom: 15px; color: var(--text-dark);">
                            <?php echo htmlspecialchars($track['name']); ?>
                        </h3>
                        <div class="product-specs"
                            style="font-size: 0.9rem; color: var(--text-gray); line-height: 1.8;">
                            <?php if (!empty($track['material'])): ?>
                            <div><strong>Material:</strong> <?php echo htmlspecialchars($track['material']); ?></div>
                            <?php endif; ?>
                            <div><strong>Colors available:</strong> <?php echo htmlspecialchars($track['colors']); ?></div>
                            <div><strong>Mount:</strong> <?php echo htmlspecialchars(ucwords($track['mount'])); ?></div>
                            <div><strong>Use:</strong> <?php echo htmlspecialchars(ucwords($track['use'])); ?></div>
                            <?php if (!empty($track['feature'])): ?>
                            <div><strong>Feature:</strong> <?php echo htmlspecialchars(ucwords($track['feature'])); ?></div>
                            <?php endif; ?>
                            <?php if (!empty($track['max_weight'])): ?>
                            <div><strong>Max weight:</strong> <?php echo htmlspecialchars($track['max_weight']); ?></div>
                            <?php endif; ?>
                            <?php if (!empty($track['thickness'])): ?>
                            <div><strong>Thickness:</strong> <?php echo htmlspecialchars($track['thickness']); ?></div>
                            <?php endif; ?>
                            <?php if (!empty($track['code'])): ?>
                            <div><strong>Code:</strong> <?php echo htmlspecialchars($track['code']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <p style="text-align: center; color: var(--text-gray); margin-top: 40px;">
            Hardware catalog coming soon. <a href="contact.php" style="color: var(--primary-teal);">Contact us</a> for availability.
        </p>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Need Help Choosing the Right Hardware?</h2>
        <p>Our experts will recommend the right track or rod for your curtains during your free in-home consultation.</p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-top: 30px;">
            <a href="contact.php#quote-form" class="btn btn-primary">Request Free Consultation</a>
            <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" onclick="dataLayer.push({'event': 'phone_click'});" class="btn btn-secondary"
                style="background-color: transparent; color: white; border-color: white;">
                Call <?php echo BUSINESS_PHONE; ?>
            </a>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>
