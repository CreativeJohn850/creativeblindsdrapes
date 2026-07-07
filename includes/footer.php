</main>
<!-- Main Content End -->

<!-- Footer -->
<footer class="site-footer">
    <div class="footer-main">
        <div class="container">
            <div class="footer-grid">
                <!-- Company Info -->
                <div class="footer-col">
                    <h3><?php echo SITE_NAME; ?></h3>
                    <p>Serving Aurora and surrounding communities with premium window treatments, locally trusted.</p>
                    <div class="social-links">
                        <a href="<?php echo FACEBOOK_URL; ?>" aria-label="Facebook" target="_blank">f</a>
                        <a href="<?php echo INSTAGRAM_URL; ?>" aria-label="Instagram" target="_blank">📷</a>
                    </div>
                </div>

                <!-- Products -->
                <div class="footer-col">
                    <h4>Products</h4>
                    <ul class="footer-links">
                        <?php foreach (PRIMARY_NAV as $nav_path => $nav_label): ?>
                            <?php if ($nav_path === '/contact/') continue; ?>
                            <li><a href="<?php echo url($nav_path); ?>"><?php echo htmlspecialchars($nav_label); ?></a></li>
                        <?php endforeach; ?>
                        <li><a href="<?php echo url('/curtain-hardware.php'); ?>">Curtain Hardware</a></li>
                        <li><a href="<?php echo url('/window-treatments/window-treatment-installer/'); ?>">Installation</a></li>
                        <li><a href="<?php echo url('/window-treatments/motorized-window-treatment/'); ?>">Motorized</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="footer-col">
                    <h4>Contact Us</h4>
                    <ul class="footer-contact">
                        <li>
                            <strong>Phone:</strong> <a
                                href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>"><?php echo BUSINESS_PHONE; ?></a>
                        </li>
                        <li>
                            <strong>Email:</strong> <a
                                href="mailto:<?php echo BUSINESS_EMAIL; ?>"><?php echo BUSINESS_EMAIL; ?></a>
                        </li>
                        <li>
                            <strong>Address:</strong> <a target="_blank"
                                href="https://maps.app.goo.gl/E2B9YkeiqMfka7Y66"
                                class="d-flex align-items-center gap-2 sm-icon py-2">
                                <span class="d-flex align-items-center"> <?php echo BUSINESS_ADDRESS; ?></span></a>
                        </li>
                        <li>
                            <strong>Hours:</strong> <?php echo BUSINESS_HOURS_ML; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved. | Serving Aurora,
                Naperville, and surrounding IL communities.</p>
        </div>
    </div>
</footer>

<!-- Expose the URL base path to JS (for form endpoint + redirects) -->
<script>window.SITE_BASE = '<?php echo BASE_URL; ?>';</script>
<!-- Minimal JavaScript (mobile menu toggle) -->
<script src="<?php echo url('/assets/js/script.js'); ?>"></script>
</body>

</html>