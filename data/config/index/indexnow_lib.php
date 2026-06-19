<?php
/**
 * IndexNow shared library for creativeblindsdrapes.com
 * Holds config + the submit function used by both the test and sync scripts.
 *
 * Edit the four CONFIG constants once, and both other scripts pick them up.
 */

// ----------------------- CONFIG: edit these -----------------------
const INDEXNOW_HOST     = 'creativeblindsdrapes.com';                                            // canonical host, NO www
const INDEXNOW_KEY      = 'd15d73ba54749e8e5456b89b99a90eb2';                                     // your generated key
const INDEXNOW_KEY_URL  = 'https://creativeblindsdrapes.com/d15d73ba54749e8e5456b89b99a90eb2.txt'; // where the key file lives
const INDEXNOW_ENDPOINT = 'https://api.indexnow.org/IndexNow';                                   // shared endpoint, propagates to all engines
// ------------------------------------------------------------------

/**
 * The directory the key is allowed to vouch for.
 * A key at /sub/key.txt can only submit URLs under https://host/sub/
 * This key sits at the root, so it can vouch for the entire site.
 */
function indexnow_scope_prefix(): string
{
    return substr(INDEXNOW_KEY_URL, 0, strrpos(INDEXNOW_KEY_URL, '/') + 1);
}

/**
 * Submit a batch of URLs to IndexNow.
 * URLs outside the key's scope are skipped (they would otherwise 422).
 *
 * @return array{status:int, body:string, sent:string[], skipped:string[]}
 */
function indexnow_submit(array $urls): array
{
    $scope   = indexnow_scope_prefix();
    $sent    = [];
    $skipped = [];

    foreach ($urls as $u) {
        if (strpos($u, $scope) === 0) {
            $sent[] = $u;
        } else {
            $skipped[] = $u;
        }
    }

    if (empty($sent)) {
        return ['status' => 0, 'body' => 'No in-scope URLs to submit', 'sent' => [], 'skipped' => $skipped];
    }

    // IndexNow accepts up to 10,000 URLs per request.
    $payload = json_encode([
        'host'        => INDEXNOW_HOST,
        'key'         => INDEXNOW_KEY,
        'keyLocation' => INDEXNOW_KEY_URL,
        'urlList'     => array_values($sent),
    ], JSON_UNESCAPED_SLASHES);

    $ch = curl_init(INDEXNOW_ENDPOINT);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_HTTPHEADER     => ['Content-Type: application/json; charset=utf-8'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 20,
    ]);
    $body = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($body === false) {
        $body = 'cURL error: ' . curl_error($ch);
    }
    curl_close($ch);

    return ['status' => $code, 'body' => (string) $body, 'sent' => $sent, 'skipped' => $skipped];
}
