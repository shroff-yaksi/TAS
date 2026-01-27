<?php
/**
 * Newsletter Subscription Handler
 */

require_once 'utils.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

if (isRateLimited('newsletter', 10, 3600)) {
    echo json_encode(['success' => false, 'message' => 'Too many subscription attempts.']);
    exit;
}

$email = sanitizeInput($_POST['email'] ?? '');

if (empty($email) || !isValidEmail($email)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
    exit;
}

if (emailExistsInNewsletter($email)) {
    echo json_encode(['success' => false, 'message' => 'You are already subscribed to our newsletter.']);
    exit;
}

if (subscribeToNewsletter($email)) {
    // Send Welcome Email
    $welcomeContent = "
        <h2>Welcome to our Newsletter!</h2>
        <p>Thank you for subscribing to The Auto Shoppers newsletter.</p>
        <p>You'll now be the first to know about our special offers, seasonal maintenance tips, and latest automotive news.</p>
        <div class='details-box'>
            <p><strong>Stay tuned for:</strong></p>
            <ul>
                <li>Exclusive discount coupons</li>
                <li>Pro-tips for car longevity</li>
                <li>New service announcements</li>
            </ul>
        </div>
        <p>Safe driving!</p>
    ";
    
    $mail = getEmailTemplate("Subscribed Successfully", $welcomeContent);
    sendEmail($email, "Welcome to The Auto Shoppers Newsletter!", $mail);

    echo json_encode(['success' => true, 'message' => 'Subscription successful! Check your inbox for updates.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Something went wrong. Please try again later.']);
}
