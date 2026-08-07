<?php
// Page-specific variables
$page_title = 'Thank You - Request Received';
$noindex = true;
$meta_description = 'Thank you for contacting Creative Blinds & Drapes. We\'ll be in touch within 24 hours to schedule your free consultation.';

// The lead arrives via a one-shot session value set by process-contact.php, never via the
// URL: this page is tracked by GTM, so query parameters would send PII to Analytics.
require_once dirname(__DIR__) . '/includes/config.php';
cbd_session_start();
header('Cache-Control: no-store, private');

$cbd_lead = $_SESSION['cbd_lead'] ?? [];
unset($_SESSION['cbd_lead']); // one-shot: a refresh shows the generic page

$lead_status   = $cbd_lead['status'] ?? '';
$visitor_name  = htmlspecialchars(trim($cbd_lead['name'] ?? ''), ENT_QUOTES, 'UTF-8');

// Rendered only for a lead that reached the mail_sent path. GTM reads the presence of
// #leadEmail as the qualified-lead signal, so this must not soften into a fallback: an
// out-of-area visitor keeps the name greeting but gets no email element at all.
$visitor_email = $lead_status === 'qualified'
    ? htmlspecialchars(trim($cbd_lead['email'] ?? ''), ENT_QUOTES, 'UTF-8')
    : '';

// Include header
require_once dirname(__DIR__) . '/includes/header.php';
?>

<!-- data-lead-status is 'qualified' or 'out_of_area', never PII, so unlike the email it is
     safe for GTM to read into the dataLayer for out-of-area demand reporting. Absent
     entirely on a generic render (bot path, refresh, back-navigation, direct visit). -->
<section<?php if ($lead_status !== ''): ?> data-lead-status="<?php echo htmlspecialchars($lead_status, ENT_QUOTES, 'UTF-8'); ?>"<?php endif; ?> style="padding: 100px 20px; text-align: center; min-height: 60vh; display: flex; align-items: center; justify-content: center;">
    <div class="container" style="max-width: 700px;">
        <div style="width: 100px; height: 100px; margin: 0 auto 30px; background: var(--warm-cream); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 4rem;">
            ✓
        </div>
        
        <h1 style="color: var(--primary-teal); margin-bottom: 20px;">Thank You!</h1>
        <h2 style="font-size: 1.5rem; font-weight: 400; color: var(--text-dark); margin-bottom: 25px;">Your request has been received.</h2>

        <p style="font-size: 1.1rem; color: var(--text-gray); margin-bottom: 30px; line-height: 1.8;">
            <?php if ($visitor_name !== ''): ?><strong><?php echo $visitor_name; ?></strong>, <?php endif; ?>we appreciate you contacting <strong><?php echo SITE_NAME; ?></strong>. One of our window treatment experts will reach out to you within 24 hours to schedule your free in-home consultation.
        </p>
        
        <div style="background: var(--warm-cream); padding: 30px; border-radius: 8px; margin-bottom: 40px;">
            <h3 style="margin-bottom: 15px; font-size: 1.3rem;">What Happens Next?</h3>
            <div style="text-align: left; max-width: 500px; margin: 0 auto;">
                <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                    <span style="color: var(--primary-teal); font-size: 1.5rem; font-weight: bold;">1</span>
                    <p style="margin: 0;">We'll call or email you<?php if ($visitor_email !== ''): ?> (at <strong id="leadEmail"><?php echo $visitor_email; ?></strong>)<?php endif; ?> within 24 hours to confirm your request</p>
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
            <a href="<?php echo url('/'); ?>" class="btn btn-primary">Return to Homepage</a>
            <a href="<?php echo url('/window-treatments/curtains-and-drapes/'); ?>" class="btn btn-secondary">Browse Curtains</a>
        </div>
        
        <p style="color: var(--text-gray); font-size: 0.95rem;">
            Need immediate assistance? Call us at <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" onclick="dataLayer.push({'event': 'phone_click'});" style="color: var(--primary-teal); font-weight: 600;"><?php echo BUSINESS_PHONE; ?></a>
        </p>
    </div>
</section>

<?php
// Include footer
require_once ROOT_PATH . '/includes/footer.php';
?>