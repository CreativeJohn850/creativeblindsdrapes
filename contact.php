<?php
// Page-specific variables
$page_title = 'Contact Us - Get Your Free Quote';
$meta_description = 'Contact Creative Floors & Windows in Aurora, IL. Get a free consultation for custom drapes, blinds, and shutters. Call (630) 555-0123 or visit our showroom at 850 S Frontenac Street.';

// Include header
require_once 'includes/header.php';
?>

<!-- Page Header -->
<section class="page-header" style="background: linear-gradient(135deg, var(--primary-teal) 0%, var(--primary-teal-dark) 100%); color: white; padding: 60px 20px; text-align: center;">
    <div class="container">
        <h1 style="color: white; margin-bottom: 15px;">Contact Us</h1>
        <p style="font-size: 1.2rem; color: rgba(255,255,255,0.95); max-width: 700px; margin: 0 auto;">Get your free consultation today. We're here to help transform your windows!</p>
    </div>
</section>

<!-- Contact Form & Map Section -->
<section style="padding: 60px 20px;">
    <div class="container">
        <div class="grid-2" style="gap: 50px; align-items: start;">
            
            <!-- Contact Form -->
            <div>
                <div class="section-header" style="text-align: left; margin-bottom: 30px;">
                    <h2 id="quote-form">Request Your Free Quote</h2>
                    <p>Fill out the form below and we'll contact you within 24 hours to schedule your free in-home consultation.</p>
                </div>
                
                <!-- Success/Error Messages -->
                <div id="formMessage" style="display: none; padding: 15px; border-radius: 4px; margin-bottom: 20px;"></div>
                
                <form id="contactForm" method="POST">
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="grid-2" style="gap: 20px;">
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Your Address</label>
                        <input type="text" id="address" name="address" placeholder="Street address, City, State, ZIP">
                    </div>
                    
                    <div class="form-group">
                        <label for="service">I'm Interested In *</label>
                        <select id="service" name="service" required>
                            <option value="">-- Select Service --</option>
                            <option value="Custom Drapes & Curtains">Custom Drapes & Curtains</option>
                            <option value="Blinds (Horizontal/Vertical)">Blinds (Horizontal/Vertical)</option>
                            <option value="Plantation Shutters">Plantation Shutters</option>
                            <option value="Shades (Roman, Roller, Solar)">Shades (Roman, Roller, Solar)</option>
                            <option value="Multiple Products">Multiple Products</option>
                            <option value="Not Sure - Need Consultation">Not Sure - Need Consultation</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="rooms">Number of Windows/Rooms</label>
                        <input type="text" id="rooms" name="rooms" placeholder="e.g., 5 windows, 3 rooms">
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Additional Details</label>
                        <textarea id="message" name="message" placeholder="Tell us about your project, preferred schedule, style preferences, etc."></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label style="display: flex; align-items: start; gap: 10px; cursor: pointer;">
                            <input type="checkbox" id="consent" name="consent" required style="width: auto; margin-top: 4px;">
                            <span style="font-size: 0.9rem; color: var(--text-gray);">I agree to receive communication from Creative Floors & Windows regarding my inquiry. *</span>
                        </label>
                    </div>
                    
                    <!-- reCAPTCHA v3 (invisible) -->
                    <input type="hidden" id="recaptchaToken" name="recaptcha_token">
                    
                    <button type="submit" class="btn btn-primary" id="submitBtn" style="width: 100%; padding: 16px; font-size: 1.1rem;">
                        Send My Request
                    </button>
                    
                    <p style="font-size: 0.85rem; color: var(--text-gray); margin-top: 15px; text-align: center;">
                        This site is protected by reCAPTCHA and the Google 
                        <a href="https://policies.google.com/privacy" target="_blank" style="color: var(--primary-teal);">Privacy Policy</a> and 
                        <a href="https://policies.google.com/terms" target="_blank" style="color: var(--primary-teal);">Terms of Service</a> apply.
                    </p>
                </form>
            </div>
            
            <!-- Map & Business Hours -->
            <div>
                <div style="margin-bottom: 30px;">
                    <h3 style="margin-bottom: 15px;">Visit Our Showroom</h3>
                    <p style="color: var(--text-gray); margin-bottom: 20px;">See our products in person! Browse hundreds of fabric samples, blinds, shutters, and more at our Aurora showroom.</p>
                    
                    <!-- Google Map Embed -->
                    <div style="border-radius: 8px; overflow: hidden; box-shadow: 0 2px 15px rgba(0,0,0,0.1); margin-bottom: 25px;">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2977.0256414440523!2d-88.2320343!3d41.7415398!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880e304e3c97840f%3A0x854b3c445599c6ba!2sCreative%20Floors%2C%20Inc!5e0!3m2!1sen!2sus!4v1740681274829!5m2!1sen!2sus" 
                            width="100%" 
                            height="350" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    
                    <!-- Business Hours -->
                    <div style="background: var(--warm-cream); padding: 25px; border-radius: 8px;">
                        <h4 style="margin-bottom: 15px; font-size: 1.2rem;">Showroom Hours</h4>
                        <div style="display: grid; gap: 8px; font-size: 0.95rem; color: var(--text-gray);">
                            <div style="display: flex; justify-content: space-between;">
                                <strong style="color: var(--text-dark);">Monday - Friday:</strong>
                                <span>9:00 AM - 6:00 PM</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <strong style="color: var(--text-dark);">Saturday:</strong>
                                <span>10:00 AM - 1:00 PM</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <strong style="color: var(--text-dark);">Sunday:</strong>
                                <span>Closed</span>
                            </div>
                        </div>
                        <p style="margin-top: 15px; font-size: 0.9rem; color: var(--text-gray);">
                            <strong>Note:</strong> In-home consultations available by appointment, including evenings and weekends!
                        </p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Contact Info Cards -->
<section style="padding: 60px 20px; background-color: var(--warm-cream);">
    <div class="container">
        <div class="grid-3">
            <!-- Phone -->
            <div style="background: white; padding: 30px; border-radius: 8px; text-align: center; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
                <div style="width: 70px; height: 70px; margin: 0 auto 20px; background: var(--warm-cream); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                    📞
                </div>
                <h3 style="margin-bottom: 10px; font-size: 1.3rem;">Call Us</h3>
                <p style="margin-bottom: 15px; color: var(--text-gray);">Mon-Fri: 9am-6pm<br>Sat: 10am-4pm</p>
                <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" style="color: var(--primary-teal); font-size: 1.3rem; font-weight: 600;"><?php echo BUSINESS_PHONE; ?></a>
            </div>
            
            <!-- Email -->
            <div style="background: white; padding: 30px; border-radius: 8px; text-align: center; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
                <div style="width: 70px; height: 70px; margin: 0 auto 20px; background: var(--warm-cream); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                    ✉️
                </div>
                <h3 style="margin-bottom: 10px; font-size: 1.3rem;">Email Us</h3>
                <p style="margin-bottom: 15px; color: var(--text-gray);">We'll respond within<br>24 hours</p>
                <a href="mailto:<?php echo BUSINESS_EMAIL; ?>" style="color: var(--primary-teal); font-size: 1.1rem; font-weight: 600; word-break: break-word;"><?php echo BUSINESS_EMAIL; ?></a>
            </div>
            
            <!-- Visit -->
            <div style="background: white; padding: 30px; border-radius: 8px; text-align: center; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
                <div style="width: 70px; height: 70px; margin: 0 auto 20px; background: var(--warm-cream); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                    📍
                </div>
                <h3 style="margin-bottom: 10px; font-size: 1.3rem;">Visit Showroom</h3>
                <p style="margin-bottom: 15px; color: var(--text-gray);"><?php echo BUSINESS_ADDRESS; ?></p>
                <a href="https://www.google.com/maps/dir/?api=1&destination=850+S+Frontenac+Street+Aurora+IL+60505" target="_blank" style="color: var(--primary-teal); font-weight: 600;">Get Directions →</a>
            </div>
        </div>
    </div>
</section>



<!-- reCAPTCHA v3 Script -->
<script src="https://www.google.com/recaptcha/api.js?render=6LdOMk0sAAAAAMnWfjTV2JtpuimpVL5N8Qql_qc4"></script>

<script>
// Form submission handler
document.getElementById('contactForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const formMessage = document.getElementById('formMessage');
    const form = e.target;
    
    // Disable submit button
    submitBtn.disabled = true;
    submitBtn.textContent = 'Sending...';
    
    try {
        // Get reCAPTCHA token
        const recaptchaToken = await new Promise((resolve, reject) => {
            grecaptcha.ready(function() {
                grecaptcha.execute('6LdOMk0sAAAAAMnWfjTV2JtpuimpVL5N8Qql_qc4', {action: 'submit'})
                    .then(resolve)
                    .catch(reject);
            });
        });
        
        // Add token to form
        document.getElementById('recaptchaToken').value = recaptchaToken;
        
        // Collect form data
        const formData = new FormData(form);
        
        // Send to backend
        const response = await fetch('data/config/process-contact.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            // Redirect to thank you page
            window.location.href = 'thank-you.php';
        } else {
            // Show error message
            formMessage.style.display = 'block';
            formMessage.style.backgroundColor = '#ffebee';
            formMessage.style.color = '#c62828';
            formMessage.style.border = '1px solid #ef5350';
            formMessage.textContent = result.message || 'Something went wrong. Please try again or call us directly.';
            
            // Re-enable button
            submitBtn.disabled = false;
            submitBtn.textContent = 'Send My Request';
            
            // Scroll to message
            formMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        
    } catch (error) {
        console.error('Form submission error:', error);
        
        // Show error message
        formMessage.style.display = 'block';
        formMessage.style.backgroundColor = '#ffebee';
        formMessage.style.color = '#c62828';
        formMessage.style.border = '1px solid #ef5350';
        formMessage.textContent = 'An error occurred. Please try again or call us at <?php echo BUSINESS_PHONE; ?>.';
        
        // Re-enable button
        submitBtn.disabled = false;
        submitBtn.textContent = 'Send My Request';
    }
});
</script>

<?php
// Include footer
require_once 'includes/footer.php';
?>