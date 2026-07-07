<?php
/**
 * Shared renderer for Phase 3 service-area (SAP) pages.
 *
 * The including page loads config.php, defines the variables below, then
 * `require ROOT_PATH . '/includes/service-area-page.php';`. This file builds the
 * Service + FAQPage + BreadcrumbList schema, sets the LCP preload, and renders
 * the full page: hero, breadcrumbs, quote form, coverage table, product cards,
 * trust chips, why-choose table, process table, service links, FAQ and CTA.
 *
 * Required vars:
 *   $page_title, $meta_description         head metadata (title <=60, desc <=155)
 *   $sa_h1                                 single page <h1>
 *   $sa_path                               root-relative canonical path (trailing slash)
 *   $sa_area_served                        array of city names for Service areaServed
 *   $sa_hero_intro                         hero sub-headline (plain text)
 *   $crumbs                                breadcrumb array (see breadcrumbs.php)
 *   $sa_coverage_heading, $sa_coverage_intro
 *   $sa_neighborhood_cols                  [colA, colB, colC, colD] table headers
 *   $sa_neighborhoods                      [['area','zone','profile','products'], ...]
 *   $sa_products_heading, $sa_products_intro
 *   $sa_products                           [['name','badge','intro','features'[],'browse_url','browse_label'], ...]
 *   $sa_trust                              [chip, chip, chip, chip]
 *   $sa_process_heading, $sa_process_intro
 *   $sa_process                            [['step','what','detail'], ...]
 *   $related_links                         [['url','label'], ...]
 *   $faqs                                  [['q','a'], ...]
 *   $sa_cta_heading, $sa_cta_text
 * Optional:
 *   $sa_service_type                       Service serviceType (default below)
 *   $sa_hero_image, $sa_hero_image_mobile  relative asset paths for hero/LCP
 *   $sa_why_heading, $sa_why               [['label','detail'], ...] why-choose table
 */

require_once ROOT_PATH . '/includes/spoke-schema.php';

if (!function_exists('encodeImagePath')) {
    function encodeImagePath($path) {
        return BASE_URL . '/' . implode('/', array_map('rawurlencode', explode('/', $path)));
    }
}

$sa_service_type = $sa_service_type ?? 'Window Treatment Installation';

$sa_schema_nodes = [
    cbd_service_schema($sa_service_type, $sa_h1, $meta_description, SITE_URL . $sa_path, $sa_area_served),
    cbd_faq_schema($faqs),
    cbd_breadcrumb_schema($crumbs),
];
$page_schema_json = spoke_schema_graph($sa_schema_nodes);

if (!empty($sa_hero_image)) {
    $lcp_image = encodeImagePath($sa_hero_image);
    if (!empty($sa_hero_image_mobile)) {
        $lcp_image_mobile = encodeImagePath($sa_hero_image_mobile);
    }
}

require_once ROOT_PATH . '/includes/header.php';
?>
<!-- Page Header -->
<?php if (!empty($sa_hero_image)): ?>
<style>
.page-header-bg {
    background-image: linear-gradient(rgba(63,61,61,0.55), rgba(63,61,61,0.55)),
                      url('<?php echo encodeImagePath($sa_hero_image); ?>');
    background-size: cover;
    background-position: center;
}
<?php if (!empty($sa_hero_image_mobile)): ?>
@media (max-width: 991px) {
    .page-header-bg {
        background-image: linear-gradient(rgba(63,61,61,0.55), rgba(63,61,61,0.55)),
                          url('<?php echo encodeImagePath($sa_hero_image_mobile); ?>');
    }
}
<?php endif; ?>
</style>
<?php endif; ?>
<style>
.sa-table-wrap { overflow-x: auto; margin: 20px 0; }
.sa-table { width: 100%; border-collapse: collapse; min-width: 640px; }
.sa-table th, .sa-table td { border: 1px solid var(--border-color, #ddd); padding: 10px 12px; text-align: left; vertical-align: top; font-size: 0.95rem; }
.sa-table th { background: var(--primary-teal, #7abd3c); color: #fff; }
.sa-table tr:nth-child(even) td { background: rgba(0,0,0,0.03); }
.sa-product { border: 1px solid var(--border-color, #ddd); border-radius: 8px; padding: 20px 22px; margin: 18px 0; }
.sa-product h3 { margin: 0 0 4px; }
.sa-product .sa-badge { display: inline-block; font-size: 0.85rem; color: var(--primary-teal-dark, #289C3F); font-weight: 600; margin-bottom: 8px; }
.sa-trust-bar { display: flex; flex-wrap: wrap; gap: 12px; margin: 24px 0; }
.sa-trust-chip { background: var(--warm-cream, #f7f4ee); border: 1px solid var(--border-color, #ddd); border-radius: 999px; padding: 8px 16px; font-weight: 600; font-size: 0.95rem; }
</style>
<section class="page-header page-header-bg" style="color: white; padding: 60px 20px; text-align: center;">
    <div class="container">
        <h1 style="color: white; margin-bottom: 15px;"><?php echo htmlspecialchars($sa_h1); ?></h1>
        <p style="font-size: 1.2rem; color: rgba(255,255,255,0.95); max-width: 760px; margin: 0 auto;"><?php echo htmlspecialchars($sa_hero_intro); ?></p>
    </div>
</section>

<?php require ROOT_PATH . '/includes/breadcrumbs.php'; ?>

<?php include ROOT_PATH . '/includes/compact-form.php'; ?>

<section style="padding: 50px 20px;">
    <div class="container" style="max-width: 960px;">

        <!-- Coverage / neighborhoods -->
        <h2><?php echo htmlspecialchars($sa_coverage_heading); ?></h2>
        <p><?php echo htmlspecialchars($sa_coverage_intro); ?></p>
        <div class="sa-table-wrap">
            <table class="sa-table">
                <thead>
                    <tr>
                        <?php foreach ($sa_neighborhood_cols as $col): ?>
                            <th><?php echo htmlspecialchars($col); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sa_neighborhoods as $n): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($n['area']); ?></td>
                            <td><?php echo htmlspecialchars($n['zone']); ?></td>
                            <td><?php echo htmlspecialchars($n['profile']); ?></td>
                            <td><?php echo htmlspecialchars($n['products']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Products -->
        <h2 style="margin-top: 40px;"><?php echo htmlspecialchars($sa_products_heading); ?></h2>
        <p><?php echo htmlspecialchars($sa_products_intro); ?></p>
        <?php foreach ($sa_products as $p): ?>
            <div class="sa-product">
                <h3><?php echo htmlspecialchars($p['name']); ?></h3>
                <span class="sa-badge"><?php echo htmlspecialchars($p['badge']); ?></span>
                <p><?php echo htmlspecialchars($p['intro']); ?></p>
                <ul style="line-height: 1.9;">
                    <?php foreach ($p['features'] as $feat): ?>
                        <li><?php echo htmlspecialchars($feat); ?></li>
                    <?php endforeach; ?>
                </ul>
                <p><a href="<?php echo url($p['browse_url']); ?>"><?php echo htmlspecialchars($p['browse_label']); ?></a></p>
            </div>
        <?php endforeach; ?>

        <!-- Trust chips -->
        <?php if (!empty($sa_trust)): ?>
            <div class="sa-trust-bar">
                <?php foreach ($sa_trust as $chip): ?>
                    <span class="sa-trust-chip"><?php echo htmlspecialchars($chip); ?></span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Why choose (optional) -->
        <?php if (!empty($sa_why)): ?>
            <h2 style="margin-top: 40px;"><?php echo htmlspecialchars($sa_why_heading); ?></h2>
            <div class="sa-table-wrap">
                <table class="sa-table">
                    <thead><tr><th>What sets us apart</th><th>Detail</th></tr></thead>
                    <tbody>
                        <?php foreach ($sa_why as $w): ?>
                            <tr>
                                <td><strong><?php echo htmlspecialchars($w['label']); ?></strong></td>
                                <td><?php echo htmlspecialchars($w['detail']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <!-- Process -->
        <h2 style="margin-top: 40px;"><?php echo htmlspecialchars($sa_process_heading); ?></h2>
        <p><?php echo htmlspecialchars($sa_process_intro); ?></p>
        <div class="sa-table-wrap">
            <table class="sa-table">
                <thead><tr><th>Step</th><th>What happens</th><th>Local detail</th></tr></thead>
                <tbody>
                    <?php foreach ($sa_process as $s): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($s['step']); ?></strong></td>
                            <td><?php echo htmlspecialchars($s['what']); ?></td>
                            <td><?php echo htmlspecialchars($s['detail']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Service links -->
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
        <h2><?php echo htmlspecialchars($sa_cta_heading); ?></h2>
        <p><?php echo htmlspecialchars($sa_cta_text); ?></p>
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
