<?php
/**
 * Shared renderer for generated blog posts.
 *
 * A post page (blog/{slug}/index.php) is written by scraper/build-blog.py. It loads
 * config.php, defines the variables below, then requires this file. Everything the
 * page shows is already literal HTML in those variables: no JSON is read and no
 * content is assembled at request time. The only substitutions made here are the
 * %BASE% URL token and the two image slots, both of which have to stay dynamic so
 * the site keeps working at the domain root and under /creativeblindsdrapes, and so
 * an image dropped in later appears without regenerating the page.
 *
 * Required vars:
 *   $post_id, $post_slug, $post_h1, $post_title, $post_desc, $post_category,
 *   $post_date (Y-m-d), $post_reading, $post_tags[], $post_images[],
 *   $post_schema_json, $post_body
 * Optional:
 *   $post_faq_intro, $post_faqs [['q','a'], ...], $post_about_heading, $post_about
 */

require_once ROOT_PATH . '/includes/blog-helpers.php';

$post_path = '/blog/' . $post_slug . '/';

// header.php appends the brand to $page_title; these titles are written by the SEO
// source as complete title tags, so the full form is set explicitly instead.
$page_title       = $post_h1;
$page_title_full  = $post_title;
$meta_description = $post_desc;
$page_schema_json = $post_schema_json;

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Blog', 'path' => '/blog/'],
    ['name' => $post_h1],
];

// Resolve the body: BASE_URL for internal links, then the two silent image slots.
$post_body_html = str_replace('%BASE%', BASE_URL, $post_body);
$post_body_html = str_replace(
    ['%IMAGE1%', '%IMAGE2%'],
    [
        cbd_blog_image($post_id, 1, $post_h1),
        cbd_blog_image($post_id, 2, $post_category . ': ' . $post_h1),
    ],
    $post_body_html
);
$post_about_html = str_replace('%BASE%', BASE_URL, $post_about ?? '');

require_once ROOT_PATH . '/includes/header.php';
?>
<style>
.bp-head { background: var(--warm-cream, #faf7f2); padding: 46px 20px 34px; }
.bp-head .container { max-width: 860px; }
.bp-cat { display: inline-block; background: var(--primary-teal, #7abd3c); color: #fff;
    font-size: .74rem; letter-spacing: .06em; text-transform: uppercase; font-weight: 600;
    padding: 5px 12px; border-radius: 3px; }
.bp-head h1 { margin: 16px 0 12px; font-size: clamp(1.7rem, 4vw, 2.5rem); line-height: 1.22; }
.bp-meta { color: #6b6b6b; font-size: .92rem; display: flex; flex-wrap: wrap; gap: 8px 16px; }
.bp-article { padding: 44px 20px 10px; }
.bp-article .container { max-width: 760px; }
.bp-article p { line-height: 1.8; margin: 0 0 18px; }
.bp-article h2 { margin: 40px 0 14px; font-size: clamp(1.35rem, 2.6vw, 1.75rem); line-height: 1.3; }
.bp-list { line-height: 1.85; margin: 0 0 20px; padding-left: 22px; }
.bp-list li { margin-bottom: 10px; }
/*
 * In-prose links. The global reset in style.css is `a { text-decoration: none;
 * color: inherit; }`, which makes a link inside a paragraph indistinguishable from
 * the text around it, so it is overridden here for article prose only.
 *
 * Three cues at once, so a link is obvious while skimming and does not depend on
 * colour alone (WCAG 1.4.1): a persistent underline, semibold weight, and the brand
 * green darkened to #1F7A32, which holds 5.4:1 against the page (AA for body text).
 * The lighter --primary-teal is only 2.3:1 and is not usable for running text.
 */
.bp-article p a, .bp-article li a, .bp-faq .faq-answer a, .bp-about-inner a {
    color: #1F7A32;
    font-weight: 600;
    text-decoration: underline;
    text-decoration-thickness: 1.5px;
    text-underline-offset: 2px;
}
.bp-article p a:hover, .bp-article li a:hover,
.bp-faq .faq-answer a:hover, .bp-about-inner a:hover {
    color: var(--primary-teal-dark, #289C3F);
    text-decoration-thickness: 2.5px;
}
.bp-article p a:focus-visible, .bp-article li a:focus-visible,
.bp-faq .faq-answer a:focus-visible, .bp-about-inner a:focus-visible {
    outline: 2px solid var(--primary-teal-dark, #289C3F);
    outline-offset: 2px;
    border-radius: 2px;
}
/*
 * Article pictures vary a lot in size (some are 1600px wide, some barely 520px).
 * max-width rather than width lets the big ones fill the column while the small ones
 * stay at their natural size instead of being stretched and going soft; they are
 * centred so a narrow image still sits correctly in the text.
 */
.bp-figure { margin: 30px 0; text-align: center; }
.bp-figure img { max-width: 100%; height: auto; border-radius: 8px; display: block; margin: 0 auto; }
.bp-faq { padding: 10px 20px 20px; }
.bp-faq .container { max-width: 760px; }
.bp-faq .faq-item { border-bottom: 1px solid var(--border-color, #ddd); }
.bp-faq summary { cursor: pointer; font-weight: 600; padding: 16px 0; line-height: 1.45; }
.bp-faq .faq-answer { padding: 0 0 16px; line-height: 1.8; color: #444; }
.bp-about { padding: 10px 20px 40px; }
.bp-about .container { max-width: 760px; }
.bp-about-inner { background: var(--warm-cream, #faf7f2); border-left: 4px solid var(--primary-teal, #7abd3c);
    padding: 22px 26px; border-radius: 0 6px 6px 0; }
.bp-about-inner h2 { margin: 0 0 12px; font-size: 1.2rem; }
.bp-about-inner p { line-height: 1.75; margin: 0 0 12px; font-size: .95rem; }
.bp-about-inner p:last-child { margin-bottom: 0; }
.bp-tags { max-width: 760px; margin: 0 auto; padding: 0 20px 10px;
    display: flex; flex-wrap: wrap; gap: 8px; align-items: center; }
.bp-tag { background: #f0f0ee; color: #555; font-size: .8rem; padding: 5px 11px; border-radius: 14px; }
.bp-back { max-width: 760px; margin: 0 auto; padding: 24px 20px 44px; }
</style>

<section class="bp-head">
    <div class="container">
        <span class="bp-cat"><?php echo htmlspecialchars($post_category); ?></span>
        <h1><?php echo htmlspecialchars($post_h1); ?></h1>
        <div class="bp-meta">
            <time datetime="<?php echo htmlspecialchars($post_date); ?>"><?php echo cbd_blog_date($post_date); ?></time>
            <span><?php echo htmlspecialchars($post_reading); ?> read</span>
        </div>
    </div>
</section>

<?php require ROOT_PATH . '/includes/breadcrumbs.php'; ?>

<?php include ROOT_PATH . '/includes/compact-form.php'; ?>

<article class="bp-article">
    <div class="container">
        <?php echo $post_body_html; ?>
    </div>
</article>

<?php if (!empty($post_faqs)): ?>
<section class="bp-faq">
    <div class="container">
        <h2>Frequently Asked Questions</h2>
        <?php if (!empty($post_faq_intro)): ?>
            <p><?php echo str_replace('%BASE%', BASE_URL, $post_faq_intro); ?></p>
        <?php endif; ?>
        <div class="faq-list">
            <?php foreach ($post_faqs as $f): ?>
                <details class="faq-item">
                    <summary><?php echo htmlspecialchars($f['q']); ?></summary>
                    <div class="faq-answer"><?php echo str_replace('%BASE%', BASE_URL, $f['a']); ?></div>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (!empty($post_about_html)): ?>
<section class="bp-about">
    <div class="container">
        <div class="bp-about-inner">
            <h2><?php echo htmlspecialchars($post_about_heading ?: 'About Creative Blinds & Drapes'); ?></h2>
            <?php echo $post_about_html; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (!empty($post_tags)): ?>
<div class="bp-tags">
    <?php foreach ($post_tags as $t): ?>
        <span class="bp-tag"><?php echo htmlspecialchars($t); ?></span>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<div class="bp-back">
    <a href="<?php echo url('/blog/'); ?>">&larr; All articles</a>
</div>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Get Expert Help With Your Windows</h2>
        <p>Free in-home consultation across Aurora and the Fox Valley. We measure, we bring the
            samples, and we install with our own team.</p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-top: 30px;">
            <a href="<?php echo url('/contact/'); ?>#quote-form" class="btn btn-primary">Request Free Consultation</a>
            <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>"
                onclick="dataLayer.push({'event': 'phone_click'});" class="btn btn-secondary"
                style="background-color: transparent; color: white; border-color: white;">
                Call <?php echo BUSINESS_PHONE; ?>
            </a>
        </div>
    </div>
</section>
<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
