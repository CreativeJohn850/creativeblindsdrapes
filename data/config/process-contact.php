<?php
// Email processing script
header('Content-Type: application/json');

// Configuration
require_once '../../includes/config.php';

// reCAPTCHA configuration (replace with your actual secret key)
define('RECAPTCHA_SECRET_KEY', '6LdOMk0sAAAAADiT0k7Y2oZWXg9-2Ot0F_020qA2');

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

log_submission('request_received', [
    'name'    => $name,
    'email'   => $email,
    'phone'   => $phone,
    'zip'     => $zip,
    'service' => $service,
]);

// ZIP validation handle ZIP+4 (e.g. 60540-6398 → 60540)
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
    log_submission('zip_invalid', ['zip' => $zip, 'name' => $name, 'email' => $email]);
    $response['success'] = true;
    $response['message'] = 'Thank you! Your request has been sent successfully.';
    echo json_encode($response);
    exit;
}

$zipInt = (int) $zip;
if ($zipInt < 60001 || $zipInt > 60900) {
    log_submission('zip_out_of_range', ['zip' => $zip, 'name' => $name, 'email' => $email]);
    $response['success'] = true;
    $response['message'] = 'Thank you! Your request has been sent successfully.';
    echo json_encode($response);
    exit;
}

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

// Verify reCAPTCHA
if (!empty($recaptchaToken)) {
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
            'content' => http_build_query($recaptchaData)
        ]
    ];
    
    $recaptchaContext = stream_context_create($recaptchaOptions);
    $recaptchaResult = file_get_contents($recaptchaUrl, false, $recaptchaContext);
    $recaptchaJson = json_decode($recaptchaResult);
    $recaptchaScore = $recaptchaJson->score ?? null;

    if (!$recaptchaJson->success || $recaptchaScore < 0.5) {
        log_submission('recaptcha_rejected', [
            'name'              => $name,
            'email'             => $email,
            'phone'             => $phone,
            'recaptcha_score'   => $recaptchaScore,
            'recaptcha_success' => $recaptchaJson->success ?? false,
        ]);
        $response['message'] = 'reCAPTCHA verification failed. Please try again.';
        echo json_encode($response);
        exit;
    }
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
    $response['success'] = true;
    $response['message'] = 'Thank you! Your request has been sent successfully.';
} else {
    log_submission('mail_failed', $logPayload);
    error_log('[CreativeBlinds] mail() failed - To: ' . $to . ' From: ' . BUSINESS_EMAIL);
    $response['message'] = 'Failed to send email. Please call us directly at ' . BUSINESS_PHONE;
}

echo json_encode($response);
?>