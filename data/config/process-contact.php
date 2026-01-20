<?php
// Email processing script
header('Content-Type: application/json');

// Configuration
require_once '../../includes/config.php';

// reCAPTCHA configuration (replace with your actual secret key)
define('RECAPTCHA_SECRET_KEY', '6LdOMk0sAAAAADiT0k7Y2oZWXg9-2Ot0F_020qA2');

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
$service = trim($_POST['service'] ?? '');
$rooms = trim($_POST['rooms'] ?? '');
$message = trim($_POST['message'] ?? '');
$consent = isset($_POST['consent']) ? true : false;
$recaptchaToken = $_POST['recaptcha_token'] ?? '';

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
    
    if (!$recaptchaJson->success || $recaptchaJson->score < 0.5) {
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
$service = htmlspecialchars($service);
$rooms = htmlspecialchars($rooms);
$message = htmlspecialchars($message);

// Prepare email
$to = BUSINESS_EMAIL;
$subject = 'New Quote Request from ' . $name;
$headers = "From: " . $email . "\r\n";
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
                " . $address . "
            </div>
            " : "") . "
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
if (mail($to, $subject, $emailBody, $headers)) {
    $response['success'] = true;
    $response['message'] = 'Thank you! Your request has been sent successfully.';
} else {
    $response['message'] = 'Failed to send email. Please call us directly at ' . BUSINESS_PHONE;
}

echo json_encode($response);
?>