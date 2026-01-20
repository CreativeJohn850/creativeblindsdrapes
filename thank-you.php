<?php
// Page-specific variables
$page_title = 'Thank You - Request Received';
$meta_description = 'Thank you for contacting Creative Floors & Windows. We\'ll be in touch within 24 hours to schedule your free consultation.';

// Include header
require_once 'includes/header.php';
?>

<section style="padding: 100px 20px; text-align: center; min-height: 60vh; display: flex; align-items: center; justify-content: center;">
    <div class="container" style="max-width: 700px;">
        <div style="width: 100px; height: 100px; margin: 0 auto 30px; background: var(--warm-cream); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 4rem;">
            ✓
        </div>
        
        <h1 style="color: var(--primary-teal); margin-bottom: 20px;">Thank You!</h1>
        <h2 style="font-size: 1.5rem; font-weight: 400; color: var(--text-dark); margin-bottom: 25px;">Your request has been received.</h2>
        
        <p style="font-size: 1.1rem; color: var(--text-gray); margin-bottom: 30px; line-height: 1.8;">
            We appreciate you contacting <strong><?php echo SITE_NAME; ?></strong>. One of our window treatment experts will reach out to you within 24 hours to schedule your free in-home consultation.
        </p>
        
        <div style="background: var(--warm-cream); padding: 30px; border-radius: 8px; margin-bottom: 40px;">
            <h3 style="margin-bottom: 15px; font-size: 1.3rem;">What Happens Next?</h3>
            <div style="text-align: left; max-width: 500px; margin: 0 auto;">
                <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                    <span style="color: var(--primary-teal); font-size: 1.5rem; font-weight: bold;">1</span>
                    <p style="margin: 0;">We'll call or email you within 24 hours to confirm your request</p>
                </div>
                <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                    <span style="color: var(--primary-teal); font-size: 1.5rem; font-weight: bold;">2</span>
                    <p style="margin: 0;">Schedule your free in-home consultation at a time that works for you</p>
                </div>
                <div style="display: flex; gap: 15px;">
                    <span style="color: var(--primary-teal); font-size: 1.5rem; font-weight: bold;">3</span>
                    <p style="margin: 0;">Our expert will bring samples and provide personalized recommendations</p>
                </div>
            </div>
        </div>
        
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-bottom: 30px;">
            <a href="index.php" class="btn btn-primary">Return to Homepage</a>
            <a href="drapes-curtains.php" class="btn btn-secondary">Browse Drapes</a>
            <a href="sheer-curtains.php" class="btn btn-secondary">Browse Sheers</a>
        </div>
        
        <p style="color: var(--text-gray); font-size: 0.95rem;">
            Need immediate assistance? Call us at <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" style="color: var(--primary-teal); font-weight: 600;"><?php echo BUSINESS_PHONE; ?></a>
        </p>
    </div>
</section>

<?php
// Include footer
require_once 'includes/footer.php';
?>