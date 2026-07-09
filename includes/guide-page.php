<?php
/**
 * Shared renderer for Phase 4a guideline pages (the /guidelines/ hub and the
 * 7 buyer guides).
 *
 * The including page loads config.php, defines the variables below, then
 * `require ROOT_PATH . '/includes/guide-page.php';`.
 *
 * Required vars:
 *   $page_title, $meta_description   head metadata (title <=60, desc <=155)
 *   $guide_h1                        single page <h1>
 *   $guide_path                      root-relative canonical path (trailing slash)
 *   $guide_intro                     hero sub-headline (plain text)
 *   $crumbs                          breadcrumb array (see breadcrumbs.php)
 *   $guide_sections                  [['heading' => ?, 'body' => HTML], ...]
 *   $guide_cta_heading, $guide_cta_text
 * Optional:
 *   $guide_is_hub                    true => emit ItemList (from $guide_items) +
 *                                    BreadcrumbList instead of Article + FAQPage
 *   $guide_items                     [['name','url','description'], ...] for the hub ItemList
 *   $faqs                            [['q','a'], ...] (guides); feeds FAQPage + accordion
 *   $related_links                   [['url','label'], ...]
 *   $guide_hero_image, $guide_hero_image_mobile   relative asset paths for hero/LCP
 */

require_once ROOT_PATH . '/includes/spoke-schema.php';

if (!function_exists('encodeImagePath')) {
    function encodeImagePath($path) {
        return BASE_URL . '/' . implode('/', array_map('rawurlencode', explode('/', $path)));
    }
}

if (!empty($guide_is_hub)) {
    $guide_nodes = [
        cbd_itemlist_schema($guide_items ?? []),
        cbd_breadcrumb_schema($crumbs),
    ];
} else {
    $guide_nodes = [cbd_article_schema($guide_h1, $meta_description, SITE_URL . $guide_path)];
    if (!empty($faqs)) {
        $guide_nodes[] = cbd_faq_schema($faqs);
    }
    $guide_nodes[] = cbd_breadcrumb_schema($crumbs);
}
$page_schema_json = spoke_schema_graph($guide_nodes);

if (!empty($guide_hero_image)) {
    $lcp_image = encodeImagePath($guide_hero_image);
    if (!empty($guide_hero_image_mobile)) {
        $lcp_image_mobile = encodeImagePath($guide_hero_image_mobile);
    }
}

require_once ROOT_PATH . '/includes/header.php';
?>
<?php if (!empty($guide_hero_image)): ?>
<style>
.page-header-bg {
    background-image: linear-gradient(rgba(63,61,61,0.55), rgba(63,61,61,0.55)),
                      url('<?php echo encodeImagePath($guide_hero_image); ?>');
    background-size: cover;
    background-position: center;
}
<?php if (!empty($guide_hero_image_mobile)): ?>
@media (max-width: 991px) {
    .page-header-bg {
        background-image: linear-gradient(rgba(63,61,61,0.55), rgba(63,61,61,0.55)),
                          url('<?php echo encodeImagePath($guide_hero_image_mobile); ?>');
    }
}
<?php endif; ?>
</style>
<?php endif; ?>
<style>
.g-table-wrap { overflow-x: auto; margin: 20px 0; }
.g-table { width: 100%; border-collapse: collapse; min-width: 560px; }
.g-table th, .g-table td { border: 1px solid var(--border-color, #ddd); padding: 10px 12px; text-align: left; vertical-align: top; font-size: 0.95rem; }
.g-table th { background: var(--primary-teal, #7abd3c); color: #fff; }
.g-table tr:nth-child(even) td { background: rgba(0,0,0,0.03); }
.g-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin: 24px 0; }
.g-card { border: 1px solid var(--border-color, #ddd); border-radius: 8px; padding: 20px 22px; }
.g-card h3 { margin: 0 0 8px; }
.g-card h3 a { text-decoration: none; }
</style>
<section class="page-header page-header-bg" style="color: white; padding: 60px 20px; text-align: center;">
    <div class="container">
        <h1 style="color: white; margin-bottom: 15px;"><?php echo htmlspecialchars($guide_h1); ?></h1>
        <p style="font-size: 1.2rem; color: rgba(255,255,255,0.95); max-width: 760px; margin: 0 auto;"><?php echo htmlspecialchars($guide_intro); ?></p>
    </div>
</section>

<?php require ROOT_PATH . '/includes/breadcrumbs.php'; ?>

<?php include ROOT_PATH . '/includes/compact-form.php'; ?>

<section style="padding: 50px 20px;">
    <div class="container" style="max-width: 900px;">
        <?php foreach ($guide_sections as $sec): ?>
            <?php if (!empty($sec['heading'])): ?>
                <h2 style="margin-top: 40px;"><?php echo htmlspecialchars($sec['heading']); ?></h2>
            <?php endif; ?>
            <?php echo $sec['body']; ?>
        <?php endforeach; ?>

        <?php if (!empty($related_links)): ?>
            <div style="margin-top: 40px; padding-top: 24px; border-top: 1px solid var(--border-color, #ddd);">
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
        <h2><?php echo htmlspecialchars($guide_cta_heading); ?></h2>
        <p><?php echo htmlspecialchars($guide_cta_text); ?></p>
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
