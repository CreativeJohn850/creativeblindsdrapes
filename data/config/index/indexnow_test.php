<?php
/**
 * One-shot IndexNow test.
 *   1. Confirms the key file is reachable and contains exactly the key.
 *   2. Submits a single in-scope URL and reports the IndexNow response.
 *
 * Run from the shell:   php indexnow_test.php
 */
require __DIR__ . '/indexnow_lib.php';

echo "== IndexNow key test ==\n";
echo "Host:      " . INDEXNOW_HOST . "\n";
echo "Key file:  " . INDEXNOW_KEY_URL . "\n\n";

// --- 1. Verify the key file is publicly reachable and correct ---
$ch = curl_init(INDEXNOW_KEY_URL);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,   // follow the www -> non-www 301 if it fires
    CURLOPT_TIMEOUT        => 15,
]);
$keyBody  = trim((string) curl_exec($ch));
$keyCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
curl_close($ch);

echo "Key fetch: HTTP $keyCode  (final URL: $finalUrl)\n";
if ($keyCode === 200 && $keyBody === INDEXNOW_KEY) {
    echo "Key match: OK - file contains exactly the key\n\n";
} else {
    echo "Key match: FAIL - expected '" . INDEXNOW_KEY . "', got '" . $keyBody . "'\n";
    echo "Fix the key file before submitting; IndexNow returns 403 otherwise.\n";
    exit(1);
}

// --- 2. Submit one in-scope test URL (the site homepage is always in scope) ---
$testUrl = indexnow_scope_prefix();
echo "Submitting: $testUrl\n";

$res = indexnow_submit([$testUrl]);
echo "Response:   HTTP {$res['status']}\n";
echo "Body:       " . ($res['body'] === '' ? '(empty - normal for 200)' : $res['body']) . "\n\n";

switch ($res['status']) {
    case 200:
    case 202:
        echo "SUCCESS - the search engine accepted the submission.\n";
        echo "(202 means accepted with key validation still pending - also fine.)\n";
        break;
    case 403:
        echo "403 - key not valid. Re-check the key file contents and location.\n";
        break;
    case 422:
        echo "422 - URL/host mismatch. Check www vs non-www and the key scope.\n";
        break;
    case 429:
        echo "429 - too many requests. Wait a bit and retry.\n";
        break;
    default:
        echo "Unexpected status. See the body above.\n";
}
