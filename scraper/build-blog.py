#!/usr/bin/env python3
"""
build-blog.py - generate the Creative Blinds & Drapes blog from the SEO .docx set.

Reads the CBD-ArtNN-*.docx articles, extracts title/description/headings/body/FAQ/links,
and writes one pre-baked page per article plus the shared index metadata:

    blog/{slug}/index.php   article body + JSON-LD, fully rendered at build time
    data/blog-index.json    listing metadata for /blog/

Nothing is parsed or assembled at request time: the generated PHP holds literal HTML
in a nowdoc and a literal JSON-LD graph. The only runtime work is BASE_URL
substitution (so the site still runs both at the domain root and under a subfolder)
and the silent existence check for article images.

Usage:
    python scraper/build-blog.py --all
    python scraper/build-blog.py --only 17,22
    python scraper/build-blog.py --only 17 --dry-run
    python scraper/build-blog.py --all --format html    (see README note; php is default)

No third-party packages: a .docx is a zip of XML, handled with stdlib zipfile + ElementTree.
"""

import argparse
import datetime
import json
import os
import re
import sys
import zipfile
from xml.etree import ElementTree as ET

W = '{http://schemas.openxmlformats.org/wordprocessingml/2006/main}'
R = '{http://schemas.openxmlformats.org/officeDocument/2006/relationships}'

REPO = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
DOCX_DIR = r"C:\Users\Manager\Documents\Creative Blinds And Drapes Inc\SEO\24art-9-14-2026\articoleblogctabanners"
SITE_URL = 'https://creativeblindsdrapes.com'
BLOG_PATH = '/blog/'
IMAGE_DIR_REL = '/assets/images/blog'

# Every article carries this publication date. A fixed constant rather than
# date.today() so a later rebuild does not silently re-date articles already
# published; override for one run with --date.
PUBLISH_DATE = datetime.date(2026, 9, 14)
WORDS_PER_MINUTE = 200

# Word stores heading level in the run font size (half-points); no heading styles are used.
SZ_H1, SZ_H2, SZ_BODY, SZ_METALABEL, SZ_META = '36', '28', '22', '20', '18'

CATEGORIES = {
    1: 'Buying Guide',    2: 'Trends',           3: 'Trends',          4: 'Buying Guide',
    5: 'Cost & Value',    6: 'Buying Guide',     7: 'Care & Durability', 8: 'Trends',
    9: 'Trends',         10: 'Comparisons',     11: 'Trends',         12: 'Buying Guide',
    13: 'Trends',        14: 'Cost & Value',    15: 'Cost & Value',   16: 'Installation',
    17: 'Cost & Value',  18: 'Cost & Value',    19: 'Light & Privacy', 20: 'Product Basics',
    21: 'Buying Guide',  22: 'Product Basics',  23: 'Care & Durability', 24: 'Light & Privacy',
}

# Controlled tag vocabulary: regex -> tag. A tag is kept when it matches at least
# TAG_MIN_HITS times in the article body, so tags reflect what the piece is actually about.
TAG_VOCAB = [
    (r'faux wood', 'faux wood'),
    (r'real wood|wood blind', 'wood blinds'),
    (r'aluminum', 'aluminum'),
    (r'vinyl', 'vinyl'),
    (r'roller shade', 'roller shades'),
    (r'roman shade', 'roman shades'),
    (r'honeycomb|cellular shade', 'honeycomb shades'),
    (r'sheer shade', 'sheer shades'),
    (r'zebra', 'zebra blinds'),
    (r'vertical blind', 'vertical blinds'),
    (r'horizontal blind', 'horizontal blinds'),
    (r'shutter', 'shutters'),
    (r'drapery|draperies|curtain', 'draperies'),
    (r'blackout', 'blackout'),
    (r'light filtering', 'light filtering'),
    (r'privacy', 'privacy'),
    (r'motoriz|cordless|no.lift', 'motorized'),
    (r'install', 'installation'),
    (r'measur', 'measurement'),
    (r'clean', 'cleaning'),
    (r'durab|last|lifespan', 'durability'),
    (r'cost|price|budget', 'pricing'),
    (r'trend|in style', 'trends'),
    (r'energy|insulat|r.value', 'energy efficiency'),
    (r'resale|home value', 'home value'),
]
TAG_MIN_HITS = 2
TAG_MAX = 9

# The house rule from CLAUDE.md: no em or en dashes in any committed string, in any
# form. The needles are assembled from escapes so this checker does not itself contain
# the forms it rejects, the same reason the CLAUDE.md grep uses codepoint escapes.
_AMP = '&'
FORBIDDEN = [
    ('\u2014', 'em dash'),
    ('\u2013', 'en dash'),
    (_AMP + 'mdash;', 'em dash entity'),
    (_AMP + 'ndash;', 'en dash entity'),
    (_AMP + '#8212;', 'em dash numeric entity'),
    (_AMP + '#8211;', 'en dash numeric entity'),
    (_AMP + '#x2014;', 'em dash hex entity'),
    (_AMP + '#x2013;', 'en dash hex entity'),
]


# --------------------------------------------------------------------------- docx reading

def para_text(p):
    return ''.join(t.text or '' for t in p.iter(W + 't'))


def para_size(p):
    sz = p.find('.//' + W + 'sz')
    return sz.get(W + 'val') if sz is not None else None


def para_is_bold(p):
    """True only when every text-bearing run is explicitly bold. Word writes
    <w:b w:val="0"/> on regular runs here, so the val must be checked."""
    runs = [r for r in p.iter(W + 'r') if ''.join(t.text or '' for t in r.iter(W + 't')).strip()]
    if not runs:
        return False
    for r in runs:
        rpr = r.find(W + 'rPr')
        b = rpr.find(W + 'b') if rpr is not None else None
        if b is None or b.get(W + 'val') in ('0', 'false'):
            return False
    return True


def esc(s):
    return (s.replace('&', '&amp;').replace('<', '&lt;')
             .replace('>', '&gt;').replace('"', '&quot;'))


def internalize(href):
    """Absolute links back to our own domain become root-relative and carry the
    %BASE% token, so they resolve both in production and under /creativeblindsdrapes."""
    for prefix in (SITE_URL, 'https://www.creativeblindsdrapes.com',
                   'http://creativeblindsdrapes.com'):
        if href.startswith(prefix):
            return '%BASE%' + href[len(prefix):], True
    return href, False


def para_html(p, rels, links_out):
    """Render one <w:p> to inline HTML, preserving hyperlinks in document order.

    Every link opens in a new tab, so reading the article is never interrupted.
    rel="noopener" goes on all of them, external or not, since target="_blank"
    otherwise hands the opened page a reference back to this one.
    """
    out = []
    for child in p:
        if child.tag == W + 'r':
            out.append(esc(''.join(t.text or '' for t in child.iter(W + 't'))))
        elif child.tag == W + 'hyperlink':
            text = esc(''.join(t.text or '' for t in child.iter(W + 't')))
            target = rels.get(child.get(R + 'id'), '')
            if not text:
                continue
            href, internal = internalize(target)
            if internal:
                links_out.append(href.replace('%BASE%', ''))
            else:
                href = esc(target)
            out.append('<a href="%s" target="_blank" rel="noopener">%s</a>' % (href, text))
    return ''.join(out)


# The licence line belongs in the About box at the foot of the page. The source
# repeats it in the closing body section and again inside the last FAQ answer, so it
# is stripped everywhere except the About block.
CREDENTIALS_RE = re.compile(
    r'\s*Insurance Policy Nr\.?\s*:\s*\S+\s*\|\s*'
    r'Certificate of Registration Nr\.?\s*:\s*[\w-]+\.?',
    re.IGNORECASE)


def strip_credentials(text):
    return CREDENTIALS_RE.sub('', text).strip()


def parse_docx(path):
    """Split one article into its meta block, H2 sections, FAQ pairs and closing about note."""
    z = zipfile.ZipFile(path)
    rels = {r.get('Id'): r.get('Target')
            for r in ET.fromstring(z.read('word/_rels/document.xml.rels'))
            if r.get('Type').endswith('hyperlink')}
    body = ET.fromstring(z.read('word/document.xml')).find(W + 'body')

    doc = {'seo_title': '', 'seo_desc': '', 'h1': '', 'sections': [], 'faq_heading': '',
           'faq_intro': '', 'faqs': [], 'about_heading': '', 'about': [], 'links': [],
           'plain': []}
    mode = 'meta'
    section = None

    for p in body:
        if p.tag != W + 'p':
            continue
        raw = para_text(p).strip()
        if not raw:
            continue
        size = para_size(p)

        if size == SZ_METALABEL:
            continue
        if size == SZ_META:
            m = re.match(r'Title\s*\(\d+\s*chars?\)\s*:\s*(.+)$', raw)
            if m:
                doc['seo_title'] = m.group(1).strip()
                continue
            m = re.match(r'Description\s*\(\d+\s*chars?\)\s*:\s*(.+)$', raw)
            if m:
                doc['seo_desc'] = m.group(1).strip()
            continue
        if size == SZ_H1:
            doc['h1'] = raw
            continue

        if size == SZ_H2:
            low = raw.lower()
            if low.startswith('frequently asked questions'):
                mode, doc['faq_heading'] = 'faq', raw
            elif low.startswith('about creative blinds'):
                mode, doc['about_heading'] = 'about', raw
            else:
                mode = 'body'
                section = {'heading': raw, 'paras': []}
                doc['sections'].append(section)
            continue

        # Body-sized paragraph: route by current mode.
        html = para_html(p, rels, doc['links'])
        if mode == 'about':
            doc['about'].append(html)
            doc['plain'].append(raw)
            continue

        # Everywhere but the About block, drop the repeated licence line. A paragraph
        # that consisted only of it disappears entirely.
        html, raw = strip_credentials(html), strip_credentials(raw)
        if not html:
            continue
        doc['plain'].append(raw)

        if mode == 'faq':
            if para_is_bold(p):
                doc['faqs'].append({'q': raw, 'a_html': '', 'a_text': ''})
            elif doc['faqs']:
                tail = doc['faqs'][-1]
                tail['a_html'] = (tail['a_html'] + ' ' + html).strip()
                tail['a_text'] = (tail['a_text'] + ' ' + raw).strip()
            else:
                # Art01 opens its FAQ with a lead-in line before the first question.
                doc['faq_intro'] = html
        else:
            if section is None:
                section = {'heading': '', 'paras': []}
                doc['sections'].append(section)
            section['paras'].append(html)

    return doc


# --------------------------------------------------------------------------- derived fields

def slugify(text):
    s = re.sub(r"['\u2019]", '', text.lower())
    s = re.sub(r'[^a-z0-9]+', '-', s)
    return re.sub(r'-{2,}', '-', s).strip('-')


def slug_for(h1):
    """Slug from the headline, cut at the first sentence break.

    Most headlines are a single question, where this changes nothing. One of them
    ("What Is the Best Company to Buy Blinds From? Here's What to Look for in
    Aurora, IL") carries a subtitle that would otherwise produce a 79 character URL.
    The tail is only dropped when enough of the headline survives to stay meaningful.
    """
    head = re.split(r'[?.:]', h1, maxsplit=1)[0].strip()
    if len(slugify(head)) >= 20:
        return slugify(head)
    return slugify(h1)


def reading_time(words):
    return '%d min' % max(1, round(words / WORDS_PER_MINUTE))


def publish_date(num, override=None):
    """Publication date. The same for every article; `num` is kept so a per-article
    schedule can be reintroduced here without touching the callers."""
    return override or PUBLISH_DATE


def derive_tags(text):
    low = text.lower()
    hits = []
    for pattern, tag in TAG_VOCAB:
        n = len(re.findall(pattern, low))
        if n >= TAG_MIN_HITS:
            hits.append((n, tag))
    hits.sort(key=lambda x: (-x[0], x[1]))
    return [t for _, t in hits[:TAG_MAX]]


def about_things(tags, category):
    """schema.org `about` entries: the category plus the strongest topical tags."""
    names, seen = [], set()
    for name in [category] + [t.title() for t in tags[:4]]:
        key = name.lower()
        if key not in seen:
            seen.add(key)
            names.append(name)
    return [{'@type': 'Thing', 'name': n} for n in names]


IMAGE_EXTS = ('webp', 'jpg', 'jpeg', 'png', 'avif')


def image_set(num):
    """Images belonging to article `num`, as (thumb, [body images in slot order]).

    Files are named {id}_{slot}_{free text}[_thumb].{ext}. Only the leading "{id}_"
    is fixed: slot numbers are not contiguous and differ per article, so body images
    are ordered by the slot parsed from the name. The single _thumb file is the index
    card image. Zero-byte files are ignored. Mirrors cbd_blog_image_set() in
    includes/blog-helpers.php.
    """
    directory = os.path.join(REPO, IMAGE_DIR_REL.strip('/').replace('/', os.sep))
    if not os.path.isdir(directory):
        return '', []
    pattern = re.compile(r'^%d_(\d+)_.+?(_thumb)?\.([A-Za-z0-9]+)$' % num)
    thumb, body = '', []
    for name in os.listdir(directory):
        m = pattern.match(name)
        if not m or m.group(3).lower() not in IMAGE_EXTS:
            continue
        full = os.path.join(directory, name)
        if not os.path.isfile(full) or os.path.getsize(full) <= 0:
            continue
        rel = '%s/%s' % (IMAGE_DIR_REL, name)
        if m.group(2):
            thumb = rel
        else:
            body.append((int(m.group(1)), rel))
    body.sort()
    return thumb, [rel for _, rel in body]


# --------------------------------------------------------------------------- HTML assembly

LABEL_RE = re.compile(r'^([A-Z][A-Za-z0-9 /\'&.-]{1,34}):\s+(.*\S)$')


def render_paragraphs(paras):
    """Consecutive `Label: explanation` lines read as a list, so render them as one.
    Everything else stays a paragraph."""
    out, i = [], 0
    while i < len(paras):
        run = []
        j = i
        while j < len(paras) and LABEL_RE.match(re.sub(r'<[^>]+>', '', paras[j])):
            run.append(paras[j])
            j += 1
        if len(run) >= 3:
            items = []
            for para in run:
                m = LABEL_RE.match(re.sub(r'<[^>]+>', '', para))
                label = m.group(1)
                rest = para[len(label) + 1:].lstrip()
                items.append('  <li><strong>%s:</strong> %s</li>' % (label, rest))
            out.append('<ul class="bp-list">\n' + '\n'.join(items) + '\n</ul>')
            i = j
        else:
            out.append('<p>%s</p>' % paras[i])
            i += 1
    return out


def build_body_html(doc, num, images):
    """Article body. The two image slots land after the opening section and just
    before the FAQ, and are emitted as PHP calls so a missing file disappears silently."""
    blocks = []
    total = len(doc['sections'])
    for idx, sec in enumerate(doc['sections']):
        if sec['heading']:
            blocks.append('<h2 id="%s">%s</h2>' % (slugify(sec['heading'])[:60], esc(sec['heading'])))
        blocks.extend(render_paragraphs(sec['paras']))
        if idx == 0:
            blocks.append('%IMAGE1%')
        elif idx == max(1, total - 2):
            blocks.append('%IMAGE2%')
    return '\n'.join(blocks)


def build_schema(doc, num, slug, date_str, category, tags, images, thumb=''):
    url = SITE_URL + BLOG_PATH + slug + '/'
    article = {
        '@type': 'BlogPosting',
        '@id': url + '#blogposting',
        'mainEntityOfPage': {'@type': 'WebPage', '@id': url},
        'url': url,
        'headline': doc['h1'],
        'alternativeHeadline': doc['seo_title'],
        'description': doc['seo_desc'],
        'inLanguage': 'en-US',
        'datePublished': date_str,
        'dateModified': date_str,
        'author': {'@id': SITE_URL + '/#business'},
        'publisher': {'@id': SITE_URL + '/#business'},
        'keywords': ', '.join(tags),
        'articleSection': category,
        'wordCount': len(' '.join(doc['plain']).split()),
        'isPartOf': {'@type': 'Blog', '@id': SITE_URL + BLOG_PATH + '#blog',
                     'name': 'Creative Blinds & Drapes Blog', 'url': SITE_URL + BLOG_PATH},
        'about': about_things(tags, category),
    }
    present = [SITE_URL + p for p in ([thumb] + list(images)) if p]
    if present:
        article['image'] = present

    graph = [article]
    if doc['faqs']:
        graph.append({
            '@type': 'FAQPage',
            '@id': url + '#faq',
            'mainEntity': [{
                '@type': 'Question',
                'name': f['q'],
                'acceptedAnswer': {'@type': 'Answer', 'text': f['a_text']},
            } for f in doc['faqs']],
        })
    graph.append({
        '@type': 'BreadcrumbList',
        '@id': url + '#breadcrumb',
        'itemListElement': [
            {'@type': 'ListItem', 'position': 1, 'name': 'Home', 'item': SITE_URL + '/'},
            {'@type': 'ListItem', 'position': 2, 'name': 'Blog', 'item': SITE_URL + BLOG_PATH},
            {'@type': 'ListItem', 'position': 3, 'name': doc['h1']},
        ],
    })
    return json.dumps({'@context': 'https://schema.org', '@graph': graph},
                      indent=2, ensure_ascii=False)


PAGE_TEMPLATE = """<?php
/**
 * Generated by scraper/build-blog.py from %(source)s
 * Do not edit by hand: re-run the generator instead.
 */
require_once dirname(__DIR__, 2) . '/includes/config.php';

$post_id         = %(num)d;
$post_slug       = '%(slug)s';
$post_h1         = %(h1)s;
$post_title      = %(title)s;
$post_desc       = %(desc)s;
$post_category   = %(category)s;
$post_date       = '%(date)s';
$post_reading    = '%(reading)s';
$post_tags       = %(tags)s;
$post_images     = %(images)s;

$post_schema_json = <<<'JSON'
%(schema)s
JSON;

$post_body = <<<'HTML'
%(body)s
HTML;

$post_faq_intro = %(faq_intro)s;

$post_faqs = %(faqs)s;

$post_about_heading = %(about_heading)s;

$post_about = <<<'HTML'
%(about)s
HTML;

require ROOT_PATH . '/includes/blog-post.php';
"""


def php_str(value):
    """Single-quoted PHP literal."""
    return "'" + value.replace('\\', '\\\\').replace("'", "\\'") + "'"


def php_array(items, indent=4):
    if not items:
        return '[]'
    pad = ' ' * indent
    return '[\n' + ''.join('%s%s,\n' % (pad, php_str(i)) for i in items) + ']'


def php_faqs(faqs):
    if not faqs:
        return '[]'
    rows = []
    for f in faqs:
        rows.append("    ['q' => %s,\n     'a' => %s],"
                    % (php_str(f['q']), php_str(f['a_html'])))
    return '[\n' + '\n'.join(rows) + '\n]'


def check_forbidden(label, text):
    for needle, name in FORBIDDEN:
        if needle in text:
            raise SystemExit('ERROR: %s contains a %s. Fix the source before committing.'
                             % (label, name))


# --------------------------------------------------------------------------- driver

def build_one(path, fmt, dry_run, pub_date=None):
    base = os.path.basename(path)
    num = int(re.match(r'CBD-Art(\d+)', base).group(1))
    doc = parse_docx(path)
    if not doc['h1']:
        raise SystemExit('ERROR: no H1 found in %s' % base)

    slug = slug_for(doc['h1'])
    category = CATEGORIES.get(num, 'Buying Guide')
    body_words = len(' '.join(doc['plain']).split())
    tags = derive_tags(' '.join(doc['plain']))
    date = publish_date(num, pub_date)
    date_str = date.isoformat()
    thumb, images = image_set(num)

    body = build_body_html(doc, num, images)
    schema = build_schema(doc, num, slug, date_str, category, tags, images, thumb)
    about = '\n'.join('<p>%s</p>' % p for p in doc['about'])

    for label, text in (('body of ' + base, body), ('schema of ' + base, schema),
                        ('about block of ' + base, about),
                        ('title of ' + base, doc['seo_title']),
                        ('description of ' + base, doc['seo_desc'])):
        check_forbidden(label, text)

    page = PAGE_TEMPLATE % {
        'source': base, 'num': num, 'slug': slug,
        'h1': php_str(doc['h1']), 'title': php_str(doc['seo_title']),
        'desc': php_str(doc['seo_desc']), 'category': php_str(category),
        'date': date_str, 'reading': reading_time(body_words),
        'tags': php_array(tags), 'images': php_array(images),
        'schema': schema, 'body': body,
        'faq_intro': php_str(doc['faq_intro']),
        'faqs': php_faqs(doc['faqs']),
        'about_heading': php_str(doc['about_heading']),
        'about': about,
    }

    record = {
        'slug': slug,
        'id': num,
        'title': doc['seo_title'],
        'h1': doc['h1'],
        'meta-desc': doc['seo_desc'],
        'category': category,
        'published_date': date_str,
        'thumb_img': thumb,
        'images': images,
        'image_prefix': '%s/%d_' % (IMAGE_DIR_REL, num),
        'tags': tags,
        'reading_time': reading_time(body_words),
        'word_count': body_words,
        'faq_count': len(doc['faqs']),
        'source_docx': base,
    }

    out_dir = os.path.join(REPO, 'blog', slug)
    out_file = os.path.join(out_dir, 'index.php' if fmt == 'php' else 'index.html')
    if not dry_run:
        os.makedirs(out_dir, exist_ok=True)
        with open(out_file, 'w', encoding='utf-8', newline='\n') as fh:
            fh.write(page)

    have = len(images) + (1 if thumb else 0)
    print('  Art%02d  %-52s %5d words  %-7s %s  imgs %d/3  faq %d  links %d'
          % (num, slug[:52], body_words, reading_time(body_words), date_str,
             have, len(doc['faqs']), len(set(doc['links']))))
    return record


def sync_sitemap(dry_run=False):
    """Keep sitemap.xml in step with data/blog-index.json: every article is listed."""
    index_path = os.path.join(REPO, 'data', 'blog-index.json')
    sitemap_path = os.path.join(REPO, 'sitemap.xml')
    if not (os.path.isfile(index_path) and os.path.isfile(sitemap_path)):
        return 0
    with open(index_path, encoding='utf-8') as fh:
        posts = json.load(fh)
    with open(sitemap_path, encoding='utf-8') as fh:
        xml = fh.read()

    nl = chr(10)
    added = 0
    for post in sorted(posts, key=lambda r: r['id']):
        loc = SITE_URL + BLOG_PATH + post['slug'] + '/'
        if loc in xml:
            continue
        entry = ('  <url>' + nl
                 + '    <loc>' + loc + '</loc>' + nl
                 + '    <lastmod>' + post['published_date'] + '</lastmod>' + nl
                 + '  </url>' + nl
                 + '</urlset>')
        xml = xml.replace('</urlset>', entry)
        added += 1

    if added and not dry_run:
        with open(sitemap_path, 'w', encoding='utf-8', newline=nl) as fh:
            fh.write(xml)
    return added


def main():
    ap = argparse.ArgumentParser(description='Build the blog from the SEO .docx set.')
    ap.add_argument('--all', action='store_true', help='build every article')
    ap.add_argument('--only', default='', help='comma-separated article numbers, e.g. 17,22')
    ap.add_argument('--format', choices=['php', 'html'], default='php')
    ap.add_argument('--dry-run', action='store_true', help='parse and report, write nothing')
    ap.add_argument('--sitemap-only', action='store_true',
                    help='sync sitemap.xml from data/blog-index.json and exit, building nothing')
    ap.add_argument('--date', default='',
                    help='publication date for this run (YYYY-MM-DD); defaults to PUBLISH_DATE')
    ap.add_argument('--docx-dir', default=DOCX_DIR)
    args = ap.parse_args()

    pub_date = None
    if args.date:
        pub_date = datetime.datetime.strptime(args.date, '%Y-%m-%d').date()

    if args.sitemap_only:
        added = sync_sitemap(args.dry_run)
        print('sitemap.xml: %d article(s) added' % added)
        return 0

    if not args.all and not args.only:
        ap.error('pass --all, --only or --sitemap-only')
    if not os.path.isdir(args.docx_dir):
        raise SystemExit('ERROR: docx directory not found: %s' % args.docx_dir)

    wanted = None
    if args.only:
        wanted = {int(x) for x in args.only.split(',') if x.strip()}

    paths = []
    for name in sorted(os.listdir(args.docx_dir)):
        m = re.match(r'CBD-Art(\d+).*\.docx$', name)
        if not m or name.startswith('~$'):
            continue
        if wanted is None or int(m.group(1)) in wanted:
            paths.append(os.path.join(args.docx_dir, name))

    if not paths:
        raise SystemExit('ERROR: no matching .docx files')

    print('Building %d article(s), format=%s%s\n'
          % (len(paths), args.format, ', dry run' if args.dry_run else ''))
    records = [build_one(p, args.format, args.dry_run, pub_date) for p in paths]

    index_path = os.path.join(REPO, 'data', 'blog-index.json')
    merged = {}
    if os.path.isfile(index_path):
        with open(index_path, encoding='utf-8') as fh:
            for row in json.load(fh):
                merged[row['id']] = row
    for row in records:
        merged[row['id']] = row
    # Dates are identical, so article number decides the order on /blog/.
    ordered = sorted(merged.values(), key=lambda r: (r['published_date'], -r['id']),
                     reverse=True)

    if not args.dry_run:
        with open(index_path, 'w', encoding='utf-8', newline='\n') as fh:
            json.dump(ordered, fh, indent=4, ensure_ascii=False)
            fh.write('\n')

    print('\n%d article(s) written, %d total in data/blog-index.json'
          % (len(records), len(ordered)))
    added = sync_sitemap(args.dry_run)
    print('sitemap.xml: %d article(s) added' % added)
    return 0


if __name__ == '__main__':
    sys.exit(main())
