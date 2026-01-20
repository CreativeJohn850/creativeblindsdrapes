<?php
// Page-specific variables
$page_title = 'Custom Drapes, Blinds & Shutters';
$meta_description = 'Transform your Aurora home with premium window treatments from Creative Blinds & Drapes. Custom drapes, blinds, shutters & shades. Featuring quality Adeko products. Free consultation!';

// Include header
require_once 'includes/header.php';
?>

<!-- Hero Slider -->
<section class="hero-slider">
    <div class="hero-slide active" style="background-image: url('assets/images/carousel/adeko-2-1.jpg');">
        <div class="hero-overlay">
            <div class="container">
                <div class="hero-content">
                    <h1>Transform Your Home with Custom Window Treatments</h1>
                    <p>Premium drapes and sheers. Professional design consultation and installation. Serving Aurora and surrounding communities.</p>
                    <div class="hero-buttons">
                        <a href="sheer-curtains.php" class="btn btn-primary">Sheers</a>
                        <a href="drapes-curtains.php" class="btn btn-primary">Draperies</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

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
                <p>We proudly feature <strong>Adeko</strong> window treatments, renowned for their Turkish craftsmanship and exceptional quality. Combined with our personalized service and competitive pricing, we're Aurora's premier choice for window solutions.</p>
                <a href="about.php" class="btn btn-primary">Learn More About Us</a>
            </div>
            <div>
                <img src="assets/images/showroom/showroom-right.jpeg" alt="Creative Blinds & Drapes Showroom in Aurora, IL" style="border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
            </div>
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
                <h3>Quality Adeko Products</h3>
                <p>Featuring premium window treatments from Adeko, Turkey's leading manufacturer known for exceptional craftsmanship.</p>
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

<!-- Service Areas Section -->
<section class="service-areas bg-light">
    <div class="container">
        <div class="section-header">
            <h2>Serving Aurora & Surrounding Communities</h2>
            <p>Proudly providing premium window treatment solutions throughout the Aurora area and within a 20-mile radius of our showroom.</p>
        </div>
        
        <div class="grid-4">
            <div style="text-align: center;">
                <h4>Aurora</h4>
                <p style="margin: 0;">Our home base</p>
            </div>
            <div style="text-align: center;">
                <h4>Naperville</h4>
                <p style="margin: 0;">Full service area</p>
            </div>
            <div style="text-align: center;">
                <h4>Oswego</h4>
                <p style="margin: 0;">We're nearby</p>
            </div>
            <div style="text-align: center;">
                <h4>Yorkville</h4>
                <p style="margin: 0;">Expert service</p>
            </div>
            <div style="text-align: center;">
                <h4>Batavia</h4>
                <p style="margin: 0;">Local trusted partner</p>
            </div>
            <div style="text-align: center;">
                <h4>Geneva</h4>
                <p style="margin: 0;">Professional solutions</p>
            </div>
            <div style="text-align: center;">
                <h4>St. Charles</h4>
                <p style="margin: 0;">Quality installations</p>
            </div>
            <div style="text-align: center;">
                <h4>Plainfield</h4>
                <p style="margin: 0;">& more nearby areas</p>
            </div>
        </div>
        
        <div class="text-center mt-2">
            <p><strong>Not sure if we serve your area?</strong> <a href="contact.php" style="color: var(--primary-teal); font-weight: 600;">Contact us</a> and we'll be happy to help!</p>
        </div>
    </div>
</section>


<!-- Call to Action Section -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Transform Your Windows?</h2>
        <p>Get started today with a free in-home consultation. We'll help you find the perfect window treatments for your style and budget.</p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-top: 30px;">
            <a href="contact.php#quote-form" class="btn btn-primary">Request Free Quote</a>
            <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" class="btn btn-secondary" style="background-color: transparent; color: white; border-color: white;">
                Call <?php echo BUSINESS_PHONE; ?>
            </a>
        </div>
    </div>
</section>

<?php
// Include footer
require_once 'includes/footer.php';
?>