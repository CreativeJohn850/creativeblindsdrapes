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

                <!-- Quick Links -->
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="products.php">Our Products</a></li>
                        <li><a href="installation.php">Installation Services</a></li>
                        <li><a href="gallery.php">Project Gallery</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Products -->
                <div class="footer-col">
                    <h4>Products</h4>
                    <ul class="footer-links">
                        <li><a href="drapes-curtains.php">Drapes Curtains</a></li>
                        <li><a href="sheer-curtains.php">Sheer Curtains</a></li>
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

<!-- Minimal JavaScript (mobile menu toggle) -->
<script src="js/script.js"></script>
</body>

</html>