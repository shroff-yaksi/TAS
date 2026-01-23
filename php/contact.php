<?php
/**
 * Contact Form Handler
 */

require_once 'config.php';
require_once 'utils.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Collect and sanitize form data
$data = [
    'contactId' => generateContactId(),
    'timestamp' => date('Y-m-d H:i:s'),
    'name' => sanitizeInput($_POST['name'] ?? ''),
    'email' => sanitizeInput($_POST['email'] ?? ''),
    'phone' => sanitizeInput($_POST['phone'] ?? ''),
    'subject' => sanitizeInput($_POST['subject'] ?? ''),
    'message' => sanitizeInput($_POST['message'] ?? ''),
    'status' => 'new'
];

// Validate required fields
$errors = [];

if (empty($data['name'])) {
    $errors[] = 'Name is required';
}

if (empty($data['email']) || !isValidEmail($data['email'])) {
    $errors[] = 'Valid email is required';
}

if (empty($data['subject'])) {
    $errors[] = 'Subject is required';
}

if (empty($data['message'])) {
    $errors[] = 'Message is required';
}

if (!empty($errors)) {
    echo json_encode([
        'success' => false,
        'message' => 'Please fill all required fields',
        'errors' => $errors
    ]);
    exit;
}

// Save contact to JSON file
try {
    $contacts = json_decode(file_get_contents(CONTACTS_FILE), true) ?? [];
    $contacts[] = $data;
    file_put_contents(CONTACTS_FILE, json_encode($contacts, JSON_PRETTY_PRINT));
    
    // Send email notification
    $emailSent = sendContactEmail($data);
    
    echo json_encode([
        'success' => true,
        'message' => 'Thank you for contacting us! We will get back to you shortly.',
        'contactId' => $data['contactId']
    ]);
    
} catch (Exception $e) {
    error_log('Contact form error: ' . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred. Please try again or call us directly.'
    ]);
}

?>
