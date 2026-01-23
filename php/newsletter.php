<?php
/**
 * Newsletter Subscription Handler
 */

require_once 'config.php';
require_once 'utils.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Get and sanitize email
$email = sanitizeInput($_POST['email'] ?? '');

// Validate email
if (empty($email) || !isValidEmail($email)) {
    echo json_encode([
        'success' => false,
        'message' => 'Please enter a valid email address'
    ]);
    exit;
}

// Check if already subscribed
if (emailExistsInNewsletter($email)) {
    echo json_encode([
        'success' => false,
        'message' => 'This email is already subscribed to our newsletter'
    ]);
    exit;
}

// Save to newsletter file
try {
    $subscribers = json_decode(file_get_contents(NEWSLETTER_FILE), true) ?? [];
    $subscribers[] = [
        'email' => $email,
        'timestamp' => date('Y-m-d H:i:s'),
        'status' => 'active'
    ];
    file_put_contents(NEWSLETTER_FILE, json_encode($subscribers, JSON_PRETTY_PRINT));
    
    echo json_encode([
        'success' => true,
        'message' => 'Thank you for subscribing! You will receive our latest updates and offers.'
    ]);
    
} catch (Exception $e) {
    error_log('Newsletter error: ' . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred. Please try again later.'
    ]);
}

?>
