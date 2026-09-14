<?php
/**
 * Blog index: every published article as a clickable card showing the image,
 * title, reading time and publication date. No subcategories, the Blog menu item
 * lands straight here.
 *
 * Reads data/blog-index.json, written by scraper/build-blog.py. Same
 * file_get_contents + json_decode pattern the product pages already use.
 */
require_once dirname(__DIR__) . '/includes/config.php';
require_once ROOT_PATH . '/includes/blog-helpers.php';

$posts = cbd_blog_posts();

$page_title       = 'Window Treatment Blog, Aurora IL';
$meta_description = 'Practical guides on blinds, shades, shutters and draperies from the '
    . 'Creative Blinds & Drapes team in Aurora, IL. Costs, styles, care and buying advice.';

$crumbs = [
    ['name' => 'Home', 'path' => '/'],
    ['name' => 'Blog'],
];

require_once ROOT_PATH . '/includes/spoke-schema.php';

$blog_url = SITE_URL . '/blog/';
$schema_nodes = [
    [
        '@type'       => 'Blog',
        '@id'         => $blog_url . '#blog',
        'url'         => $blog_url,
        'name'        => SITE_NAME . ' Blog',
        'description' => $meta_description,
        'inLanguage'  => 'en-US',
        'publisher'   => ['@id' => SITE_URL . '/#business'],
    ],
];
if ($posts) {
    $position = 0;
    $schema_nodes[] = [
        '@type'           => 'ItemList',
        '@id'             => $blog_url . '#articles',
        'itemListElement' => array_map(function ($p) use (&$position) {
            $position++;
            return [
                '@type'    => 'ListItem',
                'position' => $position,
                'url'      => SITE_URL . '/blog/' . $p['slug'] . '/',
                'name'     => $p['h1'] ?? $p['title'],
            ];
        }, $posts),
    ];
}
$schema_nodes[] = cbd_breadcrumb_schema($crumbs);
$page_schema_json = spoke_schema_graph($schema_nodes);

require_once ROOT_PATH . '/includes/header.php';
?>
<style>
.bl-head { background: var(--warm-cream, #faf7f2); padding: 54px 20px 40px; text-align: center; }
.bl-head h1 { margin: 0 0 14px; font-size: clamp(1.9rem, 4.2vw, 2.7rem); }
.bl-head p { max-width: 680px; margin: 0 auto; color: #5f5f5f; line-height: 1.7; }
.bl-wrap { padding: 44px 20px 60px; }
.bl-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 28px; }
.bl-card { border: 1px solid var(--border-color, #e2e2e2); border-radius: 10px; overflow: hidden;
    background: #fff; display: flex; flex-direction: column; transition: box-shadow .2s, transform .2s; }
.bl-card:hover { box-shadow: 0 8px 22px rgba(0,0,0,.10); transform: translateY(-3px); }
.bl-card a.bl-link { text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%; }
.bl-thumb { aspect-ratio: 3 / 2; background: var(--warm-beige, #efe8dd); overflow: hidden; }
.bl-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
.bl-body { padding: 18px 20px 22px; display: flex; flex-direction: column; flex: 1; }
.bl-cat { font-size: .7rem; letter-spacing: .07em; text-transform: uppercase; font-weight: 700;
    color: var(--primary-teal-dark, #289C3F); margin-bottom: 9px; }
.bl-card h2 { font-size: 1.12rem; line-height: 1.38; margin: 0 0 12px; }
.bl-meta { margin-top: auto; padding-top: 12px; color: #767676; font-size: .85rem;
    display: flex; gap: 14px; flex-wrap: wrap; align-items: center; }
.bl-empty { text-align: center; color: #6b6b6b; padding: 40px 0; }
</style>

<section class="bl-head">
    <div class="container">
        <h1>Window Treatment Guides &amp; Advice</h1>
        <p>Straight answers on blinds, shades, shutters and draperies, written by the team that
            measures and installs them across Aurora and the Fox Valley.</p>
    </div>
</section>

<?php require ROOT_PATH . '/includes/breadcrumbs.php'; ?>

<?php include ROOT_PATH . '/includes/compact-form.php'; ?>

<section class="bl-wrap">
    <div class="container">
        <?php if (!$posts): ?>
            <p class="bl-empty">No articles published yet. Check back soon.</p>
        <?php else: ?>
            <div class="bl-grid">
                <?php foreach ($posts as $p): ?>
                    <?php $thumb = cbd_blog_thumb($p); ?>
                    <article class="bl-card">
                        <a class="bl-link" href="<?php echo url('/blog/' . $p['slug'] . '/'); ?>">
                            <div class="bl-thumb">
                                <?php if ($thumb): ?>
                                    <img src="<?php echo htmlspecialchars($thumb); ?>"
                                        alt="<?php echo htmlspecialchars($p['h1'] ?? $p['title']); ?>"
                                        loading="lazy" decoding="async"<?php
                                        echo cbd_blog_img_size(cbd_blog_thumb_path($p)); ?>>
                                <?php endif; ?>
                            </div>
                            <div class="bl-body">
                                <div class="bl-cat"><?php echo htmlspecialchars($p['category']); ?></div>
                                <h2><?php echo htmlspecialchars($p['h1'] ?? $p['title']); ?></h2>
                                <div class="bl-meta">
                                    <time datetime="<?php echo htmlspecialchars($p['published_date']); ?>">
                                        <?php echo cbd_blog_date($p['published_date']); ?>
                                    </time>
                                    <span><?php echo htmlspecialchars($p['reading_time']); ?> read</span>
                                </div>
                            </div>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Talk About Your Windows?</h2>
        <p>Free in-home consultation across Aurora, Naperville, Oswego and the surrounding communities.</p>
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
