<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/spoke-schema.php';

// Page-specific variables (meta title/description from the HQ homepage copy)
$page_title = 'Custom Window Treatments in Aurora, IL';
$meta_description = 'Creative Blinds & Drapes installs custom shutters, blinds, shades, and drapes for Aurora, IL homes. Free in-home consultation. Call ' . BUSINESS_PHONE . '.';

$lcp_image = BASE_URL . '/assets/images/carousel/adeko-2-1.jpg';

// Homepage FAQ. Rendered by faq-section.php and reused to build the FAQPage schema.
$faqs = [
    [
        'q' => 'How much do custom window treatments cost in Aurora, IL?',
        'a' => 'Cost depends on the product, window count, and fabric or material choice, which is why every project starts with a free in-home consultation and a written quote. Shutters typically cost more per window than blinds, while shades fall in the middle depending on the fabric chosen.',
    ],
    [
        'q' => 'Do you offer free in-home consultations?',
        'a' => 'Yes. A team member comes to the home, measures every window, and provides product recommendations and pricing at no charge, throughout Aurora and the surrounding Fox Valley area.',
    ],
    [
        'q' => 'What is the difference between blinds and shades?',
        'a' => 'Blinds use rigid slats that tilt open and closed, giving precise light control at a lower price point. Shades use a single piece of fabric that raises and lowers, offering a softer look with less exact light adjustment.',
    ],
    [
        'q' => 'How long does professional installation take?',
        'a' => 'Most residential installations are completed in a single visit, with the exact time depending on the number of windows and the product installed. The installation team confirms a time estimate during the in-home consultation.',
    ],
    [
        'q' => 'Do you install motorized window treatments?',
        'a' => 'Yes. Motorized options allow shades and blinds to be raised, lowered, and tilted from a wall switch, remote, or phone app, and the installation team wires and programs the system on site.',
    ],
    [
        'q' => 'What areas do you serve outside Aurora?',
        'a' => 'Creative Blinds & Drapes serves Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles, and Plainfield, all within about 20 miles of the Aurora showroom.',
    ],
];

// FAQPage JSON-LD, emitted by header.php through $page_schema_json.
$page_schema_json = spoke_schema_graph([cbd_faq_schema($faqs)]);

// Include header
require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Slider -->
<section class="hero-slider">
    <div class="hero-slide active" style="background-image: url('<?php echo BASE_URL; ?>/assets/images/carousel/adeko-2-1.jpg');">
        <div class="hero-overlay">
            <div class="container">
                <div class="hero-content">
                    <h1>Custom Window Treatments in Aurora, IL</h1>
                    <p>Custom shutters, blinds, shades, and drapes with professional installation included. Serving Aurora and the surrounding Fox Valley since 2001.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/compact-form.php'; ?>

<!-- Intro Section -->
<section class="welcome-section">
    <div class="container">
        <div class="grid-2" style="align-items: center;">
            <div>
                <h2>Custom Window Treatments in Aurora, IL</h2>
                <p>Creative Blinds &amp; Drapes has installed custom window treatments for Aurora, IL homeowners since 2001. As a division of Creative Floors Inc., the team brings more than 23 years of local experience to every project, backed by the full Norman Window Fashions product line and professional installation included with every order.</p>
                <p>Creative Blinds &amp; Drapes serves homeowners within a 20 mile radius of Aurora, including Naperville, Oswego, Yorkville, Batavia, Geneva, St. Charles, and Plainfield.</p>
                <a href="<?php echo url('/about-us/'); ?>" class="btn btn-primary">Learn More About Us</a>
            </div>
            <div>
                <img src="<?php echo url('/assets/images/showroom/displays-norman-v.jpeg'); ?>" alt="Norman window treatment displays in the Creative Blinds & Drapes showroom in Aurora, IL" style="border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);" loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- Why Aurora Homeowners Choose Us -->
<section class="benefits-section bg-light">
    <div class="container">
        <div class="section-header">
            <h2>Why Aurora Homeowners Choose Creative Blinds &amp; Drapes</h2>
            <p>Local experience, premium products, and installation handled by our own crew on every order.</p>
        </div>

        <div class="features-grid">
            <div class="feature-item">
                <div class="feature-icon">🏠</div>
                <h3>Free In-Home Consultation</h3>
                <p>A team member measures every window and provides recommendations at no charge.</p>
            </div>

            <div class="feature-item">
                <div class="feature-icon">⭐</div>
                <h3>Premium Fabrics</h3>
                <p>The Norman Window Fashions line offers a wide fabric and material selection.</p>
            </div>

            <div class="feature-item">
                <div class="feature-icon">🔧</div>
                <h3>Proven Expertise</h3>
                <p>Over 23 years of installation experience as a division of Creative Floors Inc.</p>
            </div>

            <div class="feature-item">
                <div class="feature-icon">💰</div>
                <h3>Competitive Pricing</h3>
                <p>Premium products priced to fit a range of budgets.</p>
            </div>
        </div>
    </div>
</section>

<!-- Window Treatment Products Installed in Aurora -->
<section class="treatments-section">
    <div class="container">
        <div class="section-header">
            <h2>Window Treatment Products Installed in Aurora</h2>
            <p>Creative Blinds &amp; Drapes installs six categories of window treatments, and every product ships with professional installation rather than a self-install kit.</p>
        </div>

        <div class="grid-3" style="margin-top: 45px;">
            <a href="<?php echo url('/window-treatments/window-shutters/'); ?>" class="treatment-card">
                <img src="<?php echo url('/assets/images/showroom/displays-norman.jpeg'); ?>" alt="Plantation-style shutters on display in the Aurora showroom" loading="lazy">
                <div class="treatment-card-caption">
                    <h3>Shutters</h3>
                    <span>Plantation-style shutters built into the window frame, a fit for both older and newer Aurora homes.</span>
                </div>
            </a>

            <a href="<?php echo url('/window-treatments/window-blinds/'); ?>" class="treatment-card">
                <img src="<?php echo url('/assets/images/showroom/right-1.jpeg'); ?>" alt="Horizontal and vertical blinds on display in the Aurora showroom" loading="lazy">
                <div class="treatment-card-caption">
                    <h3>Blinds</h3>
                    <span>Horizontal and vertical blinds for adjustable light control at a range of price points.</span>
                </div>
            </a>

            <a href="<?php echo url('/window-treatments/shades/'); ?>" class="treatment-card">
                <img src="<?php echo url('/assets/images/showroom/showroom-right.jpeg'); ?>" alt="Honeycomb, roller, roman, and sheer shades in the Aurora showroom" loading="lazy">
                <div class="treatment-card-caption">
                    <h3>Shades</h3>
                    <span>Honeycomb, roller, roman, and sheer shades for softened, filtered light.</span>
                </div>
            </a>

            <a href="<?php echo url('/window-treatments/curtains-and-drapes/'); ?>" class="treatment-card">
                <img src="<?php echo url('/assets/images/showroom/left.jpeg'); ?>" alt="Custom drapery and sheer curtain panels on display racks" loading="lazy">
                <div class="treatment-card-caption">
                    <h3>Curtains</h3>
                    <span>Custom drapery panels and sheer curtains for a finished, layered look.</span>
                </div>
            </a>

            <a href="<?php echo url('/window-treatments/window-treatment-installer/'); ?>" class="treatment-card">
                <img src="<?php echo url('/assets/images/showroom/displays.jpeg'); ?>" alt="Window treatment displays in the Creative Blinds & Drapes showroom in Aurora, IL" loading="lazy">
                <div class="treatment-card-caption">
                    <h3>Installation</h3>
                    <span>Measuring, ordering, and on-site installation included with every product line.</span>
                </div>
            </a>

            <a href="<?php echo url('/window-treatments/motorized-window-treatment/'); ?>" class="treatment-card">
                <img src="<?php echo url('/assets/images/showroom/motorized-rh.jpg'); ?>" alt="Motorized shades and blinds display in the Aurora showroom" loading="lazy">
                <div class="treatment-card-caption">
                    <h3>Motorized</h3>
                    <span>App, remote, and wall-switch control for shades and blinds.</span>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Why Professional Installation Matters -->
<section class="showroom-section bg-cream">
    <div class="container">
        <div class="grid-2 showroom-band">
            <div class="showroom-media">
                <img src="<?php echo url('/assets/images/showroom/displays.jpeg'); ?>" alt="Interior of the Creative Blinds & Drapes showroom in Aurora, IL with window treatment displays" class="showroom-media-main" loading="lazy">
                <img src="<?php echo url('/assets/images/showroom/display-cfa.jpeg'); ?>" alt="Creative Blinds & Drapes branded drapery fabric sample" class="showroom-media-inset" loading="lazy">
            </div>
            <div>
                <h2>Why Professional Installation Matters</h2>
                <p>A shutter or shade that is not installed correctly can bind, sag, or leave light gaps at the edges. Creative Blinds &amp; Drapes installs every product with its own crew, using the same measurements taken during the free consultation, so the final fit matches the window rather than a generic size.</p>
                <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-top: 25px;">
                    <a href="<?php echo url('/contact/'); ?>" class="btn btn-primary">Book a Consultation</a>
                    <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" onclick="dataLayer.push({'event': 'phone_click'});" class="btn btn-secondary">Call <?php echo BUSINESS_PHONE; ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Serving Aurora and the Fox Valley -->
<section class="service-areas bg-light">
    <div class="container">
        <div class="section-header">
            <h2>Serving Aurora and the Fox Valley</h2>
            <p>Creative Blinds &amp; Drapes serves eight cities within a 20 mile radius of the Aurora showroom. Aurora is the company's home base. Naperville, Oswego, and Yorkville sit along the Fox River corridor south and west of Aurora. Batavia, Geneva, and St. Charles make up the Tri-Cities area to the north. Plainfield rounds out the southern coverage.</p>
        </div>

        <div class="grid-4">
            <div style="text-align: center;">
                <h3><a href="<?php echo url('/service-areas/aurora-il/'); ?>">Aurora</a></h3>
                <p style="margin: 0;">Our home base</p>
            </div>
            <div style="text-align: center;">
                <h3><a href="<?php echo url('/service-areas/naperville-il/'); ?>">Naperville</a></h3>
                <p style="margin: 0;">Fox River corridor</p>
            </div>
            <div style="text-align: center;">
                <h3><a href="<?php echo url('/service-areas/oswego-il/'); ?>">Oswego</a></h3>
                <p style="margin: 0;">Fox River corridor</p>
            </div>
            <div style="text-align: center;">
                <h3><a href="<?php echo url('/service-areas/yorkville-il/'); ?>">Yorkville</a></h3>
                <p style="margin: 0;">Fox River corridor</p>
            </div>
            <div style="text-align: center;">
                <h3><a href="<?php echo url('/service-areas/batavia-il/'); ?>">Batavia</a></h3>
                <p style="margin: 0;">Tri-Cities area</p>
            </div>
            <div style="text-align: center;">
                <h3><a href="<?php echo url('/service-areas/geneva-il/'); ?>">Geneva</a></h3>
                <p style="margin: 0;">Tri-Cities area</p>
            </div>
            <div style="text-align: center;">
                <h3><a href="<?php echo url('/service-areas/st-charles-il/'); ?>">St. Charles</a></h3>
                <p style="margin: 0;">Tri-Cities area</p>
            </div>
            <div style="text-align: center;">
                <h3><a href="<?php echo url('/service-areas/plainfield-il/'); ?>">Plainfield</a></h3>
                <p style="margin: 0;">Southern coverage</p>
            </div>
        </div>

        <div class="text-center mt-2">
            <p><strong>Not sure whether your address is covered?</strong> <a href="<?php echo url('/contact/'); ?>" style="color: var(--primary-teal); font-weight: 600;">Contact the team</a> and we'll be happy to help.</p>
        </div>
    </div>
</section>

<!-- Homeowner Resources -->
<style>
    .resource-grid { margin-top: 45px; }
    .resource-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 28px 18px;
        border: 1px solid var(--warm-beige, #e6ddd0);
        border-radius: 10px;
        background: #fff;
        color: inherit;
        text-decoration: none;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .resource-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        border-color: var(--primary-teal);
    }
    .resource-icon {
        display: block;
        color: var(--primary-teal);
        margin-bottom: 14px;
    }
    .resource-card h3 {
        margin: 0;
        font-size: 1.05rem;
        line-height: 1.35;
        color: var(--primary-teal-dark, #289C3F);
    }
</style>
<section class="benefits-section">
    <div class="container">
        <div class="section-header">
            <h2>Homeowner Resources</h2>
            <p>Before a consultation, the <a href="<?php echo url('/guidelines/'); ?>" style="color: var(--primary-teal); font-weight: 600;">Guidelines hub</a> answers common questions that affect a good installation.</p>
        </div>

        <div class="grid-4 resource-grid">
            <a href="<?php echo url('/guidelines/climate-light-control/'); ?>" class="resource-card">
                <svg class="resource-icon" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                    <circle cx="12" cy="12" r="4"/>
                    <path d="M12 2v2M12 20v2M2 12h2M20 12h2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M19.1 4.9l-1.4 1.4M6.3 17.7l-1.4 1.4"/>
                </svg>
                <h3>Climate and Light Control</h3>
            </a>
            <a href="<?php echo url('/guidelines/precision-measurement/'); ?>" class="resource-card">
                <svg class="resource-icon" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                    <rect x="2.5" y="7" width="19" height="10" rx="1.5"/>
                    <path d="M6.5 7v3M10 7v4M13.5 7v3M17 7v4"/>
                </svg>
                <h3>Precision Measurement</h3>
            </a>
            <a href="<?php echo url('/guidelines/inside-vs-outside-mounts/'); ?>" class="resource-card">
                <svg class="resource-icon" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                    <rect x="3" y="3" width="18" height="18" rx="1.5"/>
                    <path d="M12 3v18M3 12h18"/>
                </svg>
                <h3>Inside vs Outside Mounts</h3>
            </a>
            <a href="<?php echo url('/guidelines/preparing-your-space/'); ?>" class="resource-card">
                <svg class="resource-icon" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                    <rect x="5" y="4" width="14" height="17" rx="2"/>
                    <path d="M9 4h6v3H9z"/>
                    <path d="M8.5 12h7M8.5 16h5"/>
                </svg>
                <h3>Preparing Your Space</h3>
            </a>
            <a href="<?php echo url('/guidelines/professional-installation/'); ?>" class="resource-card">
                <svg class="resource-icon" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                    <path d="M14.6 6.3a4 4 0 0 0-5.3 5.3L4 17l3 3 5.4-5.3a4 4 0 0 0 5.3-5.4l-2.4 2.5-2.3-.6-.6-2.3 2.5-2.4z"/>
                </svg>
                <h3>Professional Installation</h3>
            </a>
            <a href="<?php echo url('/guidelines/care-and-maintenance/'); ?>" class="resource-card">
                <svg class="resource-icon" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                    <path d="M12 4l1.7 4.6L18 10l-4.3 1.4L12 16l-1.7-4.6L6 10l4.3-1.4z"/>
                    <path d="M18 14.5l.7 1.9 1.8.6-1.8.7-.7 1.8-.7-1.8-1.8-.7 1.8-.6z"/>
                </svg>
                <h3>Care and Maintenance</h3>
            </a>
            <a href="<?php echo url('/guidelines/our-promise/'); ?>" class="resource-card">
                <svg class="resource-icon" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                    <path d="M12 3l7 3v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6z"/>
                    <path d="M9 12l2 2 4-4"/>
                </svg>
                <h3>Our Promise</h3>
            </a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/faq-section.php'; ?>

<!-- Ready to Get Started CTA -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Get Started?</h2>
        <p>Homeowners ready to move forward can request a free quote or call to schedule an in-home consultation.</p>
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
