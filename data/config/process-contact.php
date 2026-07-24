<?php
// Email processing script
header('Content-Type: application/json');

// Configuration
require_once '../../includes/config.php';
cbd_session_start();

// reCAPTCHA configuration (replace with your actual secret key)
define('RECAPTCHA_SECRET_KEY', '6LdOMk0sAAAAADiT0k7Y2oZWXg9-2Ot0F_020qA2');

// Minimum v3 score to accept. Google returns 1.0 for anything that looks like a real
// browser session, so this catches scripted senders, not hand-typed spam. The score is
// logged on every path (accepted and rejected), so this can be retuned from real traffic.
define('RECAPTCHA_MIN_SCORE', 0.7);

// Hosts a token may legitimately have been issued on. localhost entries are for WAMP dev.
define('RECAPTCHA_ALLOWED_HOSTS', [
    'creativeblindsdrapes.com',
    'www.creativeblindsdrapes.com',
    'localhost',
    '127.0.0.1',
]);

// Action names our two forms pass to grecaptcha.execute().
// compact_quote: includes/compact-form.php. submit: contact/index.php.
define('RECAPTCHA_ALLOWED_ACTIONS', ['compact_quote', 'submit']);

function log_submission($event, $data) {
    $logDir = __DIR__ . '/logs';
    $logFile = $logDir . '/form_submissions.log';
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }
    $ip = $_SERVER['HTTP_CF_CONNECTING_IP']
        ?? $_SERVER['HTTP_X_FORWARDED_FOR']
        ?? $_SERVER['REMOTE_ADDR']
        ?? 'unknown';
    $entry = [
        'time'       => date('Y-m-d H:i:s T'),
        'event'      => $event,
        'ip'         => trim(explode(',', $ip)[0]),
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
        'referrer'   => $_SERVER['HTTP_REFERER'] ?? '',
        'payload'    => $data,
    ];
    file_put_contents($logFile, json_encode($entry, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . PHP_EOL, FILE_APPEND | LOCK_EX);
}

/*
 * One-shot handoff to the thank-you page. Keeps the visitor's name and email out of the
 * redirect URL, which is tracked by GTM and would otherwise send PII to Analytics.
 * thank-you/index.php reads this and immediately clears it.
 */
function store_lead_flash($name, $email) {
    $_SESSION['cbd_lead'] = ['name' => $name, 'email' => $email];
}

/*
 * Soft rejection. The sender gets the exact response a real lead gets, so a bot has no
 * signal to tune against, but no mail is ever sent. Only the log knows the difference.
 * Pass $name/$email to personalize the thank-you page; omit them for suspected bots.
 */
function soft_reject($event, $data, $name = null, $email = null) {
    log_submission($event, $data);
    if ($name !== null) {
        store_lead_flash($name, $email);
    }
    echo json_encode([
        'success' => true,
        'message' => 'Thank you! Your request has been sent successfully.',
    ]);
    exit;
}

$recaptchaScore = null;

// Response array
$response = ['success' => false, 'message' => ''];

// Validate request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Invalid request method';
    echo json_encode($response);
    exit;
}

// Get form data
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');
$zip = trim($_POST['zip'] ?? '');
$service = trim($_POST['service'] ?? '');
$rooms = trim($_POST['rooms'] ?? '');
$message = trim($_POST['message'] ?? '');
$consent = isset($_POST['consent']) ? true : false;
$recaptchaToken = $_POST['recaptcha_token'] ?? '';
$honeypot = trim($_POST['middleName'] ?? '');

log_submission('request_received', [
    'name'    => $name,
    'email'   => $email,
    'phone'   => $phone,
    'zip'     => $zip,
    'service' => $service,
]);

// Basic validation
if (empty($name) || empty($email) || empty($phone) || empty($service)) {
    $response['message'] = 'Please fill in all required fields.';
    echo json_encode($response);
    exit;
}

if (!$consent) {
    $response['message'] = 'Please agree to receive communication.';
    echo json_encode($response);
    exit;
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response['message'] = 'Please provide a valid email address.';
    echo json_encode($response);
    exit;
}

/*
 * reCAPTCHA verification. This is a hard gate: a request with no token is refused outright,
 * because the old "verify only if a token was supplied" behavior let any direct POST skip
 * the check entirely. A legitimate visitor whose reCAPTCHA script failed to load sees an
 * error with the phone number and can retry, so failing closed here costs no real leads.
 */
if (empty($recaptchaToken)) {
    log_submission('recaptcha_missing', [
        'name'  => $name,
        'email' => $email,
        'phone' => $phone,
    ]);
    $response['message'] = 'Security check could not be completed. Please reload the page and try again, or call us at ' . BUSINESS_PHONE . '.';
    echo json_encode($response);
    exit;
}

$recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
$recaptchaData = [
    'secret' => RECAPTCHA_SECRET_KEY,
    'response' => $recaptchaToken,
    'remoteip' => $_SERVER['REMOTE_ADDR']
];

$recaptchaOptions = [
    'http' => [
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($recaptchaData),
        'timeout' => 10,
        'ignore_errors' => true
    ]
];

$recaptchaContext = stream_context_create($recaptchaOptions);
$recaptchaResult = @file_get_contents($recaptchaUrl, false, $recaptchaContext);
$recaptchaJson = $recaptchaResult === false ? null : json_decode($recaptchaResult);

// Google unreachable or answering with something that is not JSON. Refuse rather than
// wave the request through, but say so plainly so the visitor can retry or call.
if (!is_object($recaptchaJson)) {
    log_submission('recaptcha_api_error', [
        'name'  => $name,
        'email' => $email,
        'phone' => $phone,
        'raw'   => is_string($recaptchaResult) ? substr($recaptchaResult, 0, 200) : 'request_failed',
    ]);
    $response['message'] = 'We could not complete the security check. Please try again in a moment, or call us at ' . BUSINESS_PHONE . '.';
    echo json_encode($response);
    exit;
}

$recaptchaScore = $recaptchaJson->score ?? null;

if (empty($recaptchaJson->success) || $recaptchaScore < RECAPTCHA_MIN_SCORE) {
    log_submission('recaptcha_rejected', [
        'name'              => $name,
        'email'             => $email,
        'phone'             => $phone,
        'recaptcha_score'   => $recaptchaScore,
        'recaptcha_success' => $recaptchaJson->success ?? false,
        'recaptcha_errors'  => $recaptchaJson->{'error-codes'} ?? [],
    ]);
    $response['message'] = 'reCAPTCHA verification failed. Please try again.';
    echo json_encode($response);
    exit;
}

/*
 * A valid token is not enough on its own: it also has to have been minted on one of our
 * pages, for one of our form actions. Without this, a token harvested from any other site
 * running the same site key, or replayed from a different page, would be accepted.
 * A mismatch means an automated sender, so it gets the silent treatment.
 */
$recaptchaHost   = $recaptchaJson->hostname ?? '';
$recaptchaAction = $recaptchaJson->action ?? '';

if (!in_array($recaptchaHost, RECAPTCHA_ALLOWED_HOSTS, true)
    || !in_array($recaptchaAction, RECAPTCHA_ALLOWED_ACTIONS, true)) {
    soft_reject('recaptcha_context_mismatch', [
        'name'     => $name,
        'email'    => $email,
        'phone'    => $phone,
        'hostname' => $recaptchaHost,
        'action'   => $recaptchaAction,
        'recaptcha_score' => $recaptchaScore,
    ]);
}

/*
 * Everything below this line is a silent check, and everything below it runs only once a
 * valid reCAPTCHA token has been proven. That ordering matters: these checks all answer
 * with the same success response a real lead gets, so if they ran before the reCAPTCHA
 * gate, the difference between "success" and "reCAPTCHA failed" would tell an automated
 * prober which inputs pass. Holding them behind the gate means a sender without a valid
 * token learns one thing only, that the token was bad.
 */

// Honeypot. The field is hidden from humans, so anything in it came from a bot filling
// every input it found. Checked here as well as in the JS, since a direct POST skips the JS.
if ($honeypot !== '') {
    soft_reject('honeypot_tripped', [
        'name'     => $name,
        'email'    => $email,
        'phone'    => $phone,
        'honeypot' => $honeypot,
    ]);
}

// ZIP validation handle ZIP+4 (e.g. 60540-6398 becomes 60540)
if (strpos($zip, '-') !== false) {
    foreach (explode('-', $zip) as $part) {
        if (preg_match('/^\d{5}$/', $part)) {
            $partInt = (int) $part;
            if ($partInt >= 60001 && $partInt <= 60900) {
                $zip = $part;
                break;
            }
        }
    }
}

if (empty($zip) || !preg_match('/^\d{5}$/', $zip)) {
    soft_reject('zip_invalid', ['zip' => $zip, 'name' => $name, 'email' => $email], $name, $email);
}

$zipInt = (int) $zip;
if ($zipInt < 60001 || $zipInt > 60900) {
    soft_reject('zip_out_of_range', ['zip' => $zip, 'name' => $name, 'email' => $email], $name, $email);
}

// Sanitize inputs
$name = htmlspecialchars($name);
$email = htmlspecialchars($email);
$phone = htmlspecialchars($phone);
$address = htmlspecialchars($address);
$zip = htmlspecialchars($zip);
$service = htmlspecialchars($service);
$rooms = htmlspecialchars($rooms);
$message = htmlspecialchars($message);

// Prepare email
$to = BUSINESS_EMAIL;
$subject = 'New Quote Request from ' . $name;
$headers = "From: Creative Blinds & Drapes <noreply@creativeblindsdrapes.com>\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

// Email body
$emailBody = "
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #4a919e; color: white; padding: 20px; text-align: center; }
        .content { background-color: #f9f9f9; padding: 20px; border: 1px solid #ddd; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #4a919e; }
        .footer { text-align: center; padding: 20px; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h2>New Quote Request</h2>
            <p>" . SITE_NAME . "</p>
        </div>
        <div class='content'>
            <div class='field'>
                <span class='label'>Name:</span><br>
                " . $name . "
            </div>
            <div class='field'>
                <span class='label'>Email:</span><br>
                <a href='mailto:" . $email . "'>" . $email . "</a>
            </div>
            <div class='field'>
                <span class='label'>Phone:</span><br>
                <a href='tel:" . $phone . "'>" . $phone . "</a>
            </div>
            " . (!empty($address) ? "
            <div class='field'>
                <span class='label'>Address:</span><br>
                " . $address . ", " . $zip . "
            </div>
            " : "
            <div class='field'>
                <span class='label'>ZIP Code:</span><br>
                " . $zip . "
            </div>
            ") . "
            <div class='field'>
                <span class='label'>Interested In:</span><br>
                " . $service . "
            </div>
            " . (!empty($rooms) ? "
            <div class='field'>
                <span class='label'>Number of Windows/Rooms:</span><br>
                " . $rooms . "
            </div>
            " : "") . "
            " . (!empty($message) ? "
            <div class='field'>
                <span class='label'>Additional Details:</span><br>
                " . nl2br($message) . "
            </div>
            " : "") . "
            <div class='field'>
                <span class='label'>Submitted:</span><br>
                " . date('F j, Y, g:i a') . "
            </div>
        </div>
        <div class='footer'>
            <p>This quote request was submitted via the contact form on " . SITE_NAME . " website.</p>
        </div>
    </div>
</body>
</html>
";

// Send email
$logPayload = [
    'name'            => $name,
    'email'           => $email,
    'phone'           => $phone,
    'address'         => $address,
    'zip'             => $zip,
    'service'         => $service,
    'rooms'           => $rooms,
    'message'         => $message,
    'recaptcha_score' => $recaptchaScore,
];

if (mail($to, $subject, $emailBody, $headers)) {
    log_submission('mail_sent', $logPayload);
    store_lead_flash($name, $email);
    $response['success'] = true;
    $response['message'] = 'Thank you! Your request has been sent successfully.';
} else {
    log_submission('mail_failed', $logPayload);
    error_log('[CreativeBlinds] mail() failed - To: ' . $to . ' From: ' . BUSINESS_EMAIL);
    $response['message'] = 'Failed to send email. Please call us directly at ' . BUSINESS_PHONE;
}

echo json_encode($response);
?>