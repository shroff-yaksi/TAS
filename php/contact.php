<?php
/**
 * Contact Form Handler
 */

require_once 'utils.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

if (isRateLimited('contact', 5, 3600)) {
    echo json_encode(['success' => false, 'message' => 'Too many contact attempts. Please try again later.']);
    exit;
}

$name = sanitizeInput($_POST['name'] ?? '');
$email = sanitizeInput($_POST['email'] ?? '');
$phone = sanitizeInput($_POST['phone'] ?? '');
$subject = sanitizeInput($_POST['subject'] ?? '');
$message = sanitizeInput($_POST['message'] ?? '');

if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'Please fill all required fields.']);
    exit;
}

if (!isValidEmail($email)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
    exit;
}

$contactId = generateContactId();

try {
    $db = Database::getInstance();
    $stmt = $db->prepare("INSERT INTO contacts (contact_id, name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$contactId, $name, $email, $phone, $subject, $message]);

    // Send Notification to Admin
    $adminMail = getEmailTemplate("New Inquiry", "
        <p>You have received a new message from the website contact form.</p>
        <div class='details-box'>
            <div class='detail-row'><span class='detail-label'>From:</span> $name</div>
            <div class='detail-row'><span class='detail-label'>Email:</span> $email</div>
            <div class='detail-row'><span class='detail-label'>Phone:</span> $phone</div>
            <div class='detail-row'><span class='detail-label'>Subject:</span> $subject</div>
            <div class='detail-row'><span class='detail-label'>Message:</span><br>$message</div>
        </div>
    ");
    sendEmail(ADMIN_EMAIL, "New Contact Form: $subject ($name)", $adminMail, $email);

    // Send Acknowledgment to User
    $userMail = getEmailTemplate("Message Received", "
        <p>Hi $name,</p>
        <p>Thank you for reaching out to The Auto Shoppers. We have received your message regarding <strong>$subject</strong>.</p>
        <p>Our team will review your inquiry and get back to you as soon as possible (usually within 24 hours).</p>
        <div class='details-box'>
            <p><strong>Your Inquiry Reference:</strong> $contactId</p>
        </div>
        <p>Need urgent help? Call us at +91 99789 65551.</p>
    ");
    sendEmail($email, "We've Received Your Message - $contactId", $userMail);

    echo json_encode(['success' => true, 'message' => 'Message sent successfully! We will contact you shortly.']);
} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Something went wrong. Please try again later.']);
}
