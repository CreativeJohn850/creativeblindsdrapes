<?php
/**
 * Structured-data helpers for Phase 2 product/service "spoke" landing pages.
 *
 * header.php emits a single $page_schema_json slot, so Service + FAQPage +
 * BreadcrumbList are wrapped into one @graph and json_encoded once.
 *
 * Requires config.php to be loaded first (SITE_URL, SERVICE_AREAS).
 * All builders return plain arrays; spoke_schema_graph() serialises them.
 */

if (!function_exists('cbd_service_schema')) {
    /**
     * Service node - provider references the header's LocalBusiness @id.
     * $areaServed is an optional array of city names; when null the full
     * SERVICE_AREAS list is used. City pages pass a single-city list so their
     * Service schema is scoped to that town.
     */
    function cbd_service_schema($serviceType, $name, $description, $url, $areaServed = null) {
        $areas = $areaServed ?? SERVICE_AREAS;
        return [
            '@type'       => 'Service',
            'serviceType' => $serviceType,
            'name'        => $name,
            'provider'    => ['@id' => SITE_URL . '/#business'],
            'areaServed'  => array_map(fn($c) => ['@type' => 'City', 'name' => $c . ', IL'], $areas),
            'description' => $description,
            'url'         => $url,
        ];
    }
}

if (!function_exists('cbd_faq_schema')) {
    /** FAQPage node from [['q' => ..., 'a' => ...], ...]. */
    function cbd_faq_schema(array $faqs) {
        return [
            '@type'      => 'FAQPage',
            'mainEntity' => array_map(fn($f) => [
                '@type'          => 'Question',
                'name'           => $f['q'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
            ], $faqs),
        ];
    }
}

if (!function_exists('cbd_breadcrumb_schema')) {
    /**
     * BreadcrumbList node from [['name' => ..., 'path' => '/root-relative/'], ...].
     * The current page is the last crumb and may omit 'path'. Paths are made
     * absolute with SITE_URL for the schema (visible trail uses url()).
     */
    function cbd_breadcrumb_schema(array $crumbs) {
        $position = 0;
        return [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => array_map(function ($c) use (&$position) {
                $position++;
                $item = [
                    '@type'    => 'ListItem',
                    'position' => $position,
                    'name'     => $c['name'],
                ];
                if (!empty($c['path'])) {
                    $item['item'] = SITE_URL . $c['path'];
                }
                return $item;
            }, $crumbs),
        ];
    }
}

if (!function_exists('cbd_itemlist_schema')) {
    /**
     * ItemList node from [['name' => ..., 'url' => ..., 'description' => ...], ...].
     * 'url' and 'description' are optional per item.
     */
    function cbd_itemlist_schema(array $items) {
        $position = 0;
        return [
            '@type'           => 'ItemList',
            'itemListElement' => array_map(function ($it) use (&$position) {
                $position++;
                $entry = [
                    '@type'    => 'ListItem',
                    'position' => $position,
                    'name'     => $it['name'],
                ];
                if (!empty($it['url']))         $entry['url'] = $it['url'];
                if (!empty($it['description']))  $entry['description'] = $it['description'];
                return $entry;
            }, $items),
        ];
    }
}

if (!function_exists('cbd_howto_schema')) {
    /** HowTo node from a name + [['name' => ..., 'text' => ...], ...] steps. */
    function cbd_howto_schema($name, array $steps) {
        $position = 0;
        return [
            '@type' => 'HowTo',
            'name'  => $name,
            'step'  => array_map(function ($s) use (&$position) {
                $position++;
                return [
                    '@type'    => 'HowToStep',
                    'position' => $position,
                    'name'     => $s['name'],
                    'text'     => $s['text'],
                ];
            }, $steps),
        ];
    }
}

if (!function_exists('cbd_article_schema')) {
    /**
     * Article node for guide/blog pages. author and publisher reference the
     * header's LocalBusiness @id; mainEntityOfPage and url are the page URL.
     */
    function cbd_article_schema($headline, $description, $url) {
        return [
            '@type'            => 'Article',
            'headline'         => $headline,
            'description'      => $description,
            'author'           => ['@id' => SITE_URL . '/#business'],
            'publisher'        => ['@id' => SITE_URL . '/#business'],
            'mainEntityOfPage' => $url,
            'url'              => $url,
        ];
    }
}

if (!function_exists('spoke_schema_graph')) {
    /** Wrap the supplied schema nodes in a single @graph JSON string. */
    function spoke_schema_graph(array $nodes) {
        return json_encode([
            '@context' => 'https://schema.org',
            '@graph'   => $nodes,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
