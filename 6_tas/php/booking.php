<?php
/**
 * Booking Form Handler
 * Handles car service booking requests
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
    'bookingId' => generateBookingId(),
    'timestamp' => date('Y-m-d H:i:s'),
    'personalInfo' => [
        'name' => sanitizeInput($_POST['name'] ?? ''),
        'email' => sanitizeInput($_POST['email'] ?? ''),
        'phone' => sanitizeInput($_POST['phone'] ?? ''),
        'address' => sanitizeInput($_POST['address'] ?? '')
    ],
    'vehicleInfo' => [
        'make' => sanitizeInput($_POST['carMake'] ?? ''),
        'model' => sanitizeInput($_POST['carModel'] ?? ''),
        'year' => sanitizeInput($_POST['carYear'] ?? ''),
        'registrationNumber' => sanitizeInput($_POST['registrationNumber'] ?? ''),
        'mileage' => sanitizeInput($_POST['mileage'] ?? '')
    ],
    'serviceDetails' => [
        'type' => sanitizeInput($_POST['serviceType'] ?? ''),
        'date' => sanitizeInput($_POST['serviceDate'] ?? ''),
        'time' => sanitizeInput($_POST['serviceTime'] ?? ''),
        'urgency' => sanitizeInput($_POST['urgency'] ?? 'Normal'),
        'message' => sanitizeInput($_POST['message'] ?? '')
    ],
    'status' => 'pending'
];

// Validate required fields
$errors = [];

if (empty($data['personalInfo']['name'])) {
    $errors[] = 'Name is required';
}

if (empty($data['personalInfo']['email']) || !filter_var($data['personalInfo']['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Valid email is required';
}

if (empty($data['personalInfo']['phone'])) {
    $errors[] = 'Phone number is required';
}

if (empty($data['vehicleInfo']['make'])) {
    $errors[] = 'Car make is required';
}

if (empty($data['vehicleInfo']['model'])) {
    $errors[] = 'Car model is required';
}

if (empty($data['vehicleInfo']['registrationNumber'])) {
    $errors[] = 'Registration number is required';
}

if (empty($data['serviceDetails']['type'])) {
    $errors[] = 'Service type is required';
}

if (empty($data['serviceDetails']['date'])) {
    $errors[] = 'Service date is required';
}

if (!empty($errors)) {
    echo json_encode([
        'success' => false,
        'message' => 'Please fill all required fields',
        'errors' => $errors
    ]);
    exit;
}

// Save booking to JSON file
try {
    $bookings = json_decode(file_get_contents(BOOKINGS_FILE), true) ?? [];
    $bookings[] = $data;
    file_put_contents(BOOKINGS_FILE, json_encode($bookings, JSON_PRETTY_PRINT));
    
    // Send confirmation email
    $emailSent = sendBookingConfirmation($data);
    
    echo json_encode([
        'success' => true,
        'message' => 'Booking confirmed! Your booking ID is ' . $data['bookingId'] . '. We will contact you shortly.',
        'bookingId' => $data['bookingId'],
        'emailSent' => $emailSent
    ]);
    
} catch (Exception $e) {
    error_log('Booking error: ' . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred while processing your booking. Please try again or call us directly.'
    ]);
}

?>
