<?php
require_once __DIR__ . '/includes/config.php';

// Page-specific variables
$page_title = 'Custom Drapes, Blinds & Shutters';
$meta_description = 'Transform your Aurora home with premium window treatments from Creative Blinds & Drapes. Custom drapes, blinds, shutters & shades. Free consultation!';

$lcp_image = BASE_URL . '/assets/images/carousel/adeko-2-1.jpg';

// Include header
require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Slider -->
<section class="hero-slider">
    <div class="hero-slide active" style="background-image: url('<?php echo BASE_URL; ?>/assets/images/carousel/adeko-2-1.jpg');">
        <div class="hero-overlay">
            <div class="container">
                <div class="hero-content">
                    <h1>Custom Blinds, Shades &amp; Drapes in Aurora, IL</h1>
                    <p>Premium drapes and sheers. Professional design consultation and installation. Serving Aurora and surrounding communities.</p>
                </div>
            </div>
        </div>
    </div>

</section>

<?php include __DIR__ . '/includes/compact-form.php'; ?>

<!-- Welcome Section -->
<section class="welcome-section">
    <div class="container">
        <div class="section-header">
            <h2>Welcome to Creative Blinds & Drapes</h2>
            <p>Your trusted partner for premium window treatments in Aurora, Illinois. Family-owned and locally operated.</p>
        </div>
        
        <div class="grid-2" style="align-items: center; margin-top: 50px;">
            <div>
                <h3>Why Choose Us?</h3>
                <p>At Creative Blinds & Drapes, we believe every window tells a story. Whether you're looking for energy-efficient blinds, elegant custom drapes, or classic plantation shutters, our experienced team will guide you through every step: from initial consultation to professional installation.</p>
                <p>We proudly feature window treatments, renowned for their craftsmanship and exceptional quality. Combined with our personalized service and competitive pricing, we're Aurora's premier choice for window solutions.</p>
                <a href="<?php echo url('/about-us/'); ?>" class="btn btn-primary">Learn More About Us</a>
            </div>
            <div>
                <img src="<?php echo url('/assets/images/showroom/displays-norman-v.jpeg'); ?>" alt="Creative Blinds & Drapes Showroom in Aurora, IL" style="border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
            </div>
        </div>
    </div>
</section>

<!-- Explore Our Window Treatments -->
<section class="treatments-section bg-light">
    <div class="container">
        <div class="section-header">
            <h2>Explore Our Window Treatments</h2>
            <p>From Norman shutters, blinds and shades to fully custom drapery, see what we craft for Aurora homes. Browse our collections or visit the showroom to touch every fabric.</p>
        </div>

        <div class="grid-3" style="margin-top: 45px;">
            <a href="<?php echo url('/window-treatments/window-shutters/'); ?>" class="treatment-card">
                <img src="<?php echo url('/assets/images/showroom/displays-norman.jpeg'); ?>" alt="Norman shutters, blinds and shades displays in the Creative Blinds & Drapes showroom" loading="lazy">
                <div class="treatment-card-caption">
                    <h3>Blinds, Shades &amp; Shutters</h3>
                    <span>Explore collections &rsaquo;</span>
                </div>
            </a>

            <a href="<?php echo url('/window-treatments/curtains-and-drapes/'); ?>" class="treatment-card">
                <img src="<?php echo url('/assets/images/showroom/left.jpeg'); ?>" alt="Custom drapery and sheer curtain panels on display racks" loading="lazy">
                <div class="treatment-card-caption">
                    <h3>Custom Curtains &amp; Drapes</h3>
                    <span>Explore collections &rsaquo;</span>
                </div>
            </a>

            <a href="<?php echo url('/window-treatments/motorized-window-treatment/'); ?>" class="treatment-card">
                <img src="<?php echo url('/assets/images/showroom/motorized-rh.jpg'); ?>" alt="Hundreds of designer drapery fabric swatches in the Aurora showroom" loading="lazy">
                <div class="treatment-card-caption">
                    <h3>Motorized Window Treatment</h3>
                    <span>Explore motorization</span>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="benefits-section">
    <div class="container">
        <div class="section-header">
            <h2>Why Aurora Trusts Us</h2>
            <p>We're more than just a window treatment company, we're your neighbors, committed to enhancing your home with quality products and exceptional service.</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-item">
                <div class="feature-icon">🏠</div>
                <h3>Free In-Home Consultation</h3>
                <p>We come to you! Our experts provide personalized recommendations and measure your windows at no charge.</p>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">⭐</div>
                <h3>Premium Fabrics</h3>
                <p>Our window treatments are known for exceptional fabric quality and extensive design variety.</p>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">🔧</div>
                <h3>Backed by Proven Expertise</h3>
                <p>As a division of Creative Floors Inc., we leverage over 23 years of installation experience to ensure high-quality products and high-quality installation service.</p>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">💰</div>
                <h3>Competitive Pricing</h3>
                <p>Premium quality at fair prices. We work with your budget to find the perfect solution for your home.</p>
            </div>
        </div>
    </div>
</section>

<!-- Visit Our Showroom Band -->
<section class="showroom-section bg-cream">
    <div class="container">
        <div class="grid-2 showroom-band">
            <div class="showroom-media">
                <img src="<?php echo url('/assets/images/showroom/displays.jpeg'); ?>" alt="Interior of the Creative Blinds & Drapes showroom in Aurora, IL with window treatment displays" class="showroom-media-main" loading="lazy">
                <img src="<?php echo url('/assets/images/showroom/display-cfa.jpeg'); ?>" alt="Creative Blinds & Drapes branded drapery fabric sample" class="showroom-media-inset" loading="lazy">
            </div>
            <div>
                <h2>Visit Our Aurora Showroom</h2>
                <p>Photos only tell part of the story. Come see and feel the difference: run your hands across the fabrics, compare drapery styles side by side, and get honest, expert guidance from our team. No pressure, just help finding the right treatment for your home and budget.</p>
                <p>Prefer we come to you? We also offer free in-home consultations throughout the Aurora area.</p>
                <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-top: 25px;">
                    <a href="<?php echo url('/contact/'); ?>" class="btn btn-primary">Book a Consultation</a>
                    <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" onclick="dataLayer.push({'event': 'phone_click'});" class="btn btn-secondary">Call <?php echo BUSINESS_PHONE; ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Areas Section -->
<section class="service-areas bg-light">
    <div class="container">
        <div class="section-header">
            <h2>Serving Aurora & Surrounding Communities</h2>
            <p>Proudly providing premium window treatment solutions throughout the Aurora area and within a 20-mile radius of our showroom.</p>
        </div>
        
        <div class="grid-4">
            <div style="text-align: center;">
                <h3>Aurora</h3>
                <p style="margin: 0;">Our home base</p>
            </div>
            <div style="text-align: center;">
                <h3>Naperville</h3>
                <p style="margin: 0;">Full service area</p>
            </div>
            <div style="text-align: center;">
                <h3>Oswego</h3>
                <p style="margin: 0;">We're nearby</p>
            </div>
            <div style="text-align: center;">
                <h3>Yorkville</h3>
                <p style="margin: 0;">Expert service</p>
            </div>
            <div style="text-align: center;">
                <h3>Batavia</h3>
                <p style="margin: 0;">Local trusted partner</p>
            </div>
            <div style="text-align: center;">
                <h3>Geneva</h3>
                <p style="margin: 0;">Professional solutions</p>
            </div>
            <div style="text-align: center;">
                <h3>St. Charles</h3>
                <p style="margin: 0;">Quality installations</p>
            </div>
            <div style="text-align: center;">
                <h3>Plainfield</h3>
                <p style="margin: 0;">& more nearby areas</p>
            </div>
        </div>
        
        <div class="text-center mt-2">
            <p><strong>Not sure if we serve your area?</strong> <a href="<?php echo url('/contact/'); ?>" style="color: var(--primary-teal); font-weight: 600;">Contact us</a> and we'll be happy to help!</p>
        </div>
    </div>
</section>


<!-- Call to Action Section -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Transform Your Windows?</h2>
        <p>Get started today with a free in-home consultation. We'll help you find the perfect window treatments for your style and budget.</p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-top: 30px;">
            <a href="<?php echo url('/contact/'); ?>#quote-form" class="btn btn-primary">Request Free Quote</a>
            <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" onclick="dataLayer.push({'event': 'phone_click'});" class="btn btn-secondary" style="background-color: transparent; color: white; border-color: white;">
                Call <?php echo BUSINESS_PHONE; ?>
            </a>
        </div>
    </div>
</section>

<?php
// Include footer
require_once __DIR__ . '/includes/footer.php';
?>