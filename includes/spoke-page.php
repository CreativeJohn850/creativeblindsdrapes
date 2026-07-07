<?php
/**
 * Shared renderer for Phase 2 product/service spoke pages.
 *
 * The including page must load config.php first, then define the variables
 * below, then `require ROOT_PATH . '/includes/spoke-page.php';`. This file
 * builds the schema graph, sets the LCP preload, includes the header, renders
 * the full page body (hero, breadcrumbs, quote form, content, FAQ, CTA) and
 * includes the footer.
 *
 * Required vars:
 *   $page_title, $meta_description   head metadata (title <=60, desc <=155)
 *   $spoke_service_type              Service schema serviceType
 *   $spoke_h1                        single page <h1>
 *   $spoke_path                      root-relative canonical path (trailing slash)
 *   $spoke_hero_image                relative asset path (spaces allowed)
 *   $spoke_intro                     hero sub-headline (plain text)
 *   $crumbs                          breadcrumb array (see breadcrumbs.php)
 *   $spoke_sections                  [['heading' => ?, 'body' => HTML], ...]
 *   $browse_url, $browse_label       deep link into the parent hub
 *   $faqs                            [['q' => , 'a' => ], ...] (>=4)
 *   $spoke_cta_heading, $spoke_cta_text
 * Optional:
 *   $spoke_hero_image_mobile         relative _m.webp for mobile hero/preload
 *   $related_links                   [['url' => root-relative, 'label' => ], ...]
 *   $spoke_area_served               array of city names for the Service schema
 *                                    areaServed (defaults to all SERVICE_AREAS)
 */

require_once ROOT_PATH . '/includes/spoke-schema.php';

if (!function_exists('encodeImagePath')) {
    function encodeImagePath($path) {
        return BASE_URL . '/' . implode('/', array_map('rawurlencode', explode('/', $path)));
    }
}

$spoke_schema_nodes = [
    cbd_service_schema($spoke_service_type, $spoke_h1, $meta_description, SITE_URL . $spoke_path, $spoke_area_served ?? null),
    cbd_faq_schema($faqs),
    cbd_breadcrumb_schema($crumbs),
];
// Optional extra nodes (e.g. HowTo on the installer page, ItemList on motorized).
if (!empty($spoke_extra_schema) && is_array($spoke_extra_schema)) {
    $spoke_schema_nodes = array_merge($spoke_schema_nodes, $spoke_extra_schema);
}
$page_schema_json = spoke_schema_graph($spoke_schema_nodes);

$lcp_image = encodeImagePath($spoke_hero_image);
if (!empty($spoke_hero_image_mobile)) {
    $lcp_image_mobile = encodeImagePath($spoke_hero_image_mobile);
}

require_once ROOT_PATH . '/includes/header.php';
?>
<!-- Page Header -->
<style>
.page-header-bg {
    background-image: linear-gradient(rgba(63,61,61,0.55), rgba(63,61,61,0.55)),
                      url('<?php echo encodeImagePath($spoke_hero_image); ?>');
    background-size: cover;
    background-position: center;
}
<?php if (!empty($spoke_hero_image_mobile)): ?>
@media (max-width: 991px) {
    .page-header-bg {
        background-image: linear-gradient(rgba(63,61,61,0.55), rgba(63,61,61,0.55)),
                          url('<?php echo encodeImagePath($spoke_hero_image_mobile); ?>');
    }
}
<?php endif; ?>
</style>
<section class="page-header page-header-bg" style="color: white; padding: 60px 20px; text-align: center;">
    <div class="container">
        <h1 style="color: white; margin-bottom: 15px;"><?php echo htmlspecialchars($spoke_h1); ?></h1>
        <p style="font-size: 1.2rem; color: rgba(255,255,255,0.95); max-width: 720px; margin: 0 auto;"><?php echo htmlspecialchars($spoke_intro); ?></p>
    </div>
</section>

<?php require ROOT_PATH . '/includes/breadcrumbs.php'; ?>

<?php include ROOT_PATH . '/includes/compact-form.php'; ?>

<!-- Content -->
<section style="padding: 60px 20px;">
    <div class="container" style="max-width: 820px;">
        <?php foreach ($spoke_sections as $sec): ?>
            <?php if (!empty($sec['heading'])): ?>
                <h2 style="margin-top: 40px;"><?php echo htmlspecialchars($sec['heading']); ?></h2>
            <?php endif; ?>
            <?php echo $sec['body']; ?>
        <?php endforeach; ?>

        <p style="margin-top: 40px;">
            <a href="<?php echo url($browse_url); ?>" class="btn btn-primary"><?php echo htmlspecialchars($browse_label); ?></a>
        </p>

        <?php if (!empty($related_links)): ?>
            <div style="margin-top: 40px; padding-top: 24px; border-top: 1px solid var(--border-color);">
                <h3>Related pages</h3>
                <ul style="line-height: 2;">
                    <?php foreach ($related_links as $rl): ?>
                        <li><a href="<?php echo url($rl['url']); ?>"><?php echo htmlspecialchars($rl['label']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require ROOT_PATH . '/includes/faq-section.php'; ?>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2><?php echo htmlspecialchars($spoke_cta_heading); ?></h2>
        <p><?php echo htmlspecialchars($spoke_cta_text); ?></p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-top: 30px;">
            <a href="<?php echo url('/contact/'); ?>#quote-form" class="btn btn-primary">Request Free Consultation</a>
            <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" onclick="dataLayer.push({'event': 'phone_click'});" class="btn btn-secondary"
                style="background-color: transparent; color: white; border-color: white;">
                Call <?php echo BUSINESS_PHONE; ?>
            </a>
        </div>
    </div>
</section>
<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
