<?php
/**
 * Sitemap-driven IndexNow sync.
 *
 * Reads your sitemap.xml, compares each URL's <lastmod> against the previous
 * run stored in a local state file, and submits ONLY new or changed URLs.
 * This is how IndexNow is meant to work: notify on change, not bulk resubmit.
 * Already-indexed, unchanged pages are left alone (they'd just waste crawl quota).
 *
 * Usage:
 *   php indexnow_sync.php                 normal run
 *   php indexnow_sync.php --dry-run       show what WOULD be submitted, send nothing
 *   php indexnow_sync.php --seed          submit ALL current URLs once (use sparingly)
 *   php indexnow_sync.php --urls          submit a hand-picked list (urls_2_submit.txt)
 *   php indexnow_sync.php --urls=FILE     submit a hand-picked list from FILE
 *
 * --urls is independent of the sitemap and does NOT touch the baseline state -
 * use it to nudge specific "Discovered - currently not indexed" pages.
 */
require __DIR__ . '/indexnow_lib.php';

// ----------------------- CONFIG -----------------------
const SITEMAP_URL = 'https://creativeblindsdrapes.com/sitemap.xml';   // sitemap lives at the domain root (see robots.txt)
// State file is kept in your home dir (above the web root) so it isn't public.
$stateFile = (getenv('HOME') ?: __DIR__) . '/.indexnow_state_creativeblindsdrapes.json';
// ------------------------------------------------------

$dryRun = in_array('--dry-run', $argv, true);
$seed   = in_array('--seed', $argv, true);

// ---- Targeted submit: push a hand-picked list, leave the baseline untouched ----
// One URL per line. Blank lines and lines starting with '#' are ignored.
// URLs outside the key scope are filtered out by indexnow_submit().
$urlsFile = null;
foreach ($argv as $a) {
    if ($a === '--urls') {
        $urlsFile = __DIR__ . '/urls_2_submit.txt';
    } elseif (strpos($a, '--urls=') === 0) {
        $urlsFile = substr($a, 7);
    }
}
if ($urlsFile !== null) {
    if (!is_file($urlsFile)) {
        fwrite(STDERR, "URL list not found: $urlsFile\n");
        exit(1);
    }
    $urls = [];
    foreach (file($urlsFile, FILE_IGNORE_NEW_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#') {
            continue;
        }
        $urls[] = $line;
    }
    $urls = array_values(array_unique($urls));
    if (empty($urls)) {
        echo "No URLs found in $urlsFile (after ignoring blanks/comments).\n";
        exit(0);
    }

    echo "Targeted submit from: $urlsFile\n";
    echo "URLs to submit: " . count($urls) . "\n";
    foreach ($urls as $u) {
        echo "  $u\n";
    }

    if ($dryRun) {
        echo "\n--dry-run: not submitting.\n";
        exit(0);
    }

    $res = indexnow_submit($urls);
    echo "\nIndexNow response: HTTP {$res['status']}\n";
    if (!empty($res['skipped'])) {
        echo "Skipped (outside key scope " . indexnow_scope_prefix() . "):\n";
        foreach ($res['skipped'] as $u) {
            echo "  $u\n";
        }
    }
    if (in_array($res['status'], [200, 202], true)) {
        echo "Submitted. Baseline state left unchanged.\n";
    } else {
        echo "Submission not accepted.\n";
        echo "Body: {$res['body']}\n";
    }
    exit(0);
}

// ---- 1. Load the sitemap into a data structure: [url => lastmod] ----
$xmlRaw = @file_get_contents(SITEMAP_URL);
if ($xmlRaw === false) {
    fwrite(STDERR, "Could not fetch sitemap: " . SITEMAP_URL . "\n");
    exit(1);
}
$xml = simplexml_load_string($xmlRaw);
if ($xml === false || !isset($xml->url)) {
    fwrite(STDERR, "Sitemap is not a valid <urlset>. (Nested sitemap-index files need a small extension.)\n");
    exit(1);
}

$current = [];
foreach ($xml->url as $entry) {
    $loc = trim((string) $entry->loc);
    if ($loc === '') {
        continue;
    }
    // <lastmod> is often absent in a hand-made sitemap; fall back to empty string.
    $current[$loc] = trim((string) $entry->lastmod);
}
echo "Sitemap URLs found: " . count($current) . "\n";

// ---- 2. Load previous state ----
$previous = [];
if (is_file($stateFile)) {
    $decoded = json_decode((string) file_get_contents($stateFile), true);
    if (is_array($decoded)) {
        $previous = $decoded;
    }
}
$firstRun = empty($previous);

// ---- 3. Decide what to submit ----
if ($seed) {
    $toSubmit = array_keys($current);
    echo "--seed: submitting all current URLs.\n";
} else {
    $toSubmit = [];
    foreach ($current as $url => $lastmod) {
        if (!array_key_exists($url, $previous)) {
            $toSubmit[] = $url;                               // brand-new URL
        } elseif ($lastmod !== '' && $lastmod !== $previous[$url]) {
            $toSubmit[] = $url;                               // lastmod changed
        }
    }
}

// On the first ever run (and not seeding), establish a baseline without firing
// the whole sitemap - IndexNow discourages bulk-submitting unchanged pages.
if ($firstRun && !$seed) {
    echo "First run - saving a baseline WITHOUT submitting.\n";
    echo "Future runs will then submit only what changes. (Use --seed to push everything now.)\n";
    if (!$dryRun) {
        file_put_contents($stateFile, json_encode($current, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
    exit(0);
}

if (empty($toSubmit)) {
    echo "Nothing changed since last run. Nothing to submit.\n";
    exit(0);
}

echo "URLs to submit: " . count($toSubmit) . "\n";
foreach ($toSubmit as $u) {
    echo "  $u\n";
}

if ($dryRun) {
    echo "\n--dry-run: not submitting, not updating state.\n";
    exit(0);
}

// ---- 4. Submit ----
$res = indexnow_submit($toSubmit);
echo "\nIndexNow response: HTTP {$res['status']}\n";

if (!empty($res['skipped'])) {
    echo "Skipped (outside key scope " . indexnow_scope_prefix() . "):\n";
    foreach ($res['skipped'] as $u) {
        echo "  $u\n";
    }
    echo "If you need these indexed, move the key file to the site root.\n";
}

// ---- 5. Persist state only on a clean acceptance, so failures can be retried ----
if (in_array($res['status'], [200, 202], true)) {
    file_put_contents($stateFile, json_encode($current, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    echo "State updated. Done.\n";
} else {
    echo "Submission not accepted - state NOT updated so you can retry.\n";
    echo "Body: {$res['body']}\n";
}
