<?php
/**
 * Shared helpers for the blog: the index at /blog/ and the generated article pages.
 *
 * Loaded by includes/blog-post.php and blog/index.php. Requires config.php.
 */

if (!defined('BLOG_INDEX_FILE')) {
    define('BLOG_INDEX_FILE', ROOT_PATH . '/data/blog-index.json');
}

if (!defined('BLOG_IMAGE_DIR')) {
    define('BLOG_IMAGE_DIR', '/assets/images/blog');
}

if (!function_exists('cbd_blog_image_exists')) {
    /**
     * Whether an image file is genuinely usable.
     *
     * A zero-byte file counts as absent: the placeholders that arrive before the real
     * artwork would otherwise render as a broken image. Callers use this to skip the
     * image silently, with no warning, no alt box and no missing-file message.
     */
    function cbd_blog_image_exists($rel_path) {
        if (empty($rel_path)) {
            return false;
        }
        $full = ROOT_PATH . str_replace('/', DIRECTORY_SEPARATOR, $rel_path);
        return is_file($full) && filesize($full) > 0;
    }
}

if (!function_exists('cbd_blog_image_set')) {
    /**
     * Every usable image belonging to article $id, split into the card thumbnail and
     * the in-article pictures.
     *
     * Files are named {id}_{slot}_{free text}[_thumb].{ext}. Only the leading "{id}_"
     * is fixed: the slot numbers are not contiguous and differ per article (one may
     * use 2 and 4, another 3 and 5), so body images are ordered by the slot number
     * parsed out of the name rather than by a fixed pair of slots. Exactly one file
     * per article carries the _thumb suffix and is used on the index card.
     *
     * Returns ['thumb' => root-relative path or '', 'body' => [paths in slot order]].
     * Zero-byte and unknown-extension files are ignored, so a missing or half-copied
     * image simply does not render.
     */
    function cbd_blog_image_set($id) {
        static $cache = [];
        $id = (int) $id;
        if (isset($cache[$id])) {
            return $cache[$id];
        }

        $set = ['thumb' => '', 'body' => []];
        $dir = ROOT_PATH . str_replace('/', DIRECTORY_SEPARATOR, BLOG_IMAGE_DIR);
        if ($id <= 0 || !is_dir($dir)) {
            return $cache[$id] = $set;
        }

        $allowed = ['webp', 'jpg', 'jpeg', 'png', 'avif'];
        $body = [];
        foreach (glob($dir . DIRECTORY_SEPARATOR . $id . '_*', GLOB_NOSORT) ?: [] as $full) {
            $name = basename($full);
            if (!preg_match('/^' . $id . '_(\d+)_.+?(_thumb)?\.([A-Za-z0-9]+)$/', $name, $m)) {
                continue;
            }
            if (!in_array(strtolower($m[3]), $allowed, true)
                || !is_file($full) || filesize($full) <= 0) {
                continue;
            }
            $rel = BLOG_IMAGE_DIR . '/' . $name;
            if (!empty($m[2])) {
                $set['thumb'] = $rel;
            } else {
                $body[] = [(int) $m[1], $rel];
            }
        }
        usort($body, function ($a, $b) {
            return $a[0] <=> $b[0];
        });
        $set['body'] = array_column($body, 1);

        return $cache[$id] = $set;
    }
}

if (!function_exists('cbd_blog_img_size')) {
    /**
     * width/height attributes for an image, read from the file itself so the browser
     * can reserve the right space and the page does not shift as images load. The
     * files differ in aspect ratio, so hardcoding one size would distort them.
     * Returns '' if the dimensions cannot be read.
     */
    function cbd_blog_img_size($rel_path) {
        static $cache = [];
        if (isset($cache[$rel_path])) {
            return $cache[$rel_path];
        }
        $full = ROOT_PATH . str_replace('/', DIRECTORY_SEPARATOR, $rel_path);
        $info = @getimagesize($full);
        $attrs = ($info && !empty($info[0]) && !empty($info[1]))
            ? sprintf(' width="%d" height="%d"', $info[0], $info[1])
            : '';
        return $cache[$rel_path] = $attrs;
    }
}

if (!function_exists('cbd_blog_image')) {
    /**
     * Render in-article picture number $index (1-based), or nothing at all when that
     * image is not there. Images can be dropped into assets/images/blog later and
     * appear on their own, with no regeneration needed.
     */
    function cbd_blog_image($id, $index, $alt, $class = 'bp-figure') {
        $set = cbd_blog_image_set($id);
        $rel = $set['body'][$index - 1] ?? '';
        if ($rel === '') {
            return '';
        }
        return sprintf(
            '<figure class="%s"><img src="%s" alt="%s" loading="lazy" decoding="async"%s></figure>',
            htmlspecialchars($class),
            htmlspecialchars(url($rel)),
            htmlspecialchars($alt),
            cbd_blog_img_size($rel)
        );
    }
}

if (!function_exists('cbd_blog_thumb_path')) {
    /**
     * Root-relative path of the card thumbnail: the article's _thumb file, falling
     * back to its first in-article picture, then to the shared default, so every card
     * keeps the same shape. Returns '' when the article has no usable image at all.
     */
    function cbd_blog_thumb_path(array $post) {
        $set = cbd_blog_image_set($post['id'] ?? 0);
        if ($set['thumb'] !== '') {
            return $set['thumb'];
        }
        if (!empty($set['body'][0])) {
            return $set['body'][0];
        }
        $default = BLOG_IMAGE_DIR . '/default-article.webp';
        return cbd_blog_image_exists($default) ? $default : '';
    }
}

if (!function_exists('cbd_blog_thumb')) {
    /** Card thumbnail as a browser-ready URL, or '' when there is none. */
    function cbd_blog_thumb(array $post) {
        $rel = cbd_blog_thumb_path($post);
        return $rel === '' ? '' : url($rel);
    }
}

if (!function_exists('cbd_blog_posts')) {
    /**
     * All blog posts, newest first. Every article shares one publication date, so
     * article number decides the order within a date (lowest first, matching the
     * order the set was written in).
     */
    function cbd_blog_posts() {
        if (!is_file(BLOG_INDEX_FILE)) {
            return [];
        }
        $posts = json_decode(file_get_contents(BLOG_INDEX_FILE), true);
        if (!is_array($posts)) {
            return [];
        }
        usort($posts, function ($a, $b) {
            $by_date = strcmp($b['published_date'] ?? '', $a['published_date'] ?? '');
            return $by_date !== 0 ? $by_date : (($a['id'] ?? 0) <=> ($b['id'] ?? 0));
        });
        return $posts;
    }
}

if (!function_exists('cbd_blog_date')) {
    /** Publication date for display, e.g. "November 9, 2026". */
    function cbd_blog_date($iso) {
        $ts = strtotime($iso);
        return $ts ? date('F j, Y', $ts) : '';
    }
}
?>
