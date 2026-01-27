<?php
/**
 * Booking Form Handler
 */

require_once 'utils.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

if (isRateLimited('booking', 3, 3600)) {
    echo json_encode(['success' => false, 'message' => 'Too many booking attempts. Please try again after an hour.']);
    exit;
}

// Sanitize inputs
$name = sanitizeInput($_POST['name'] ?? '');
$email = sanitizeInput($_POST['email'] ?? '');
$phone = sanitizeInput($_POST['phone'] ?? '');
$address = sanitizeInput($_POST['address'] ?? '');
$carMake = sanitizeInput($_POST['carMake'] ?? '');
$carModel = sanitizeInput($_POST['carModel'] ?? '');
$carYear = sanitizeInput($_POST['carYear'] ?? '');
$regNo = sanitizeInput($_POST['registrationNumber'] ?? '');
$mileage = sanitizeInput($_POST['mileage'] ?? '');
$serviceType = sanitizeInput($_POST['serviceType'] ?? '');
$serviceDate = sanitizeInput($_POST['serviceDate'] ?? '');
$serviceTime = sanitizeInput($_POST['serviceTime'] ?? '');
$urgency = sanitizeInput($_POST['urgency'] ?? 'Normal');
$message = sanitizeInput($_POST['message'] ?? '');

// Validation
if (empty($name) || empty($email) || empty($phone) || empty($carMake) || empty($carModel) || empty($serviceType) || empty($serviceDate)) {
    echo json_encode(['success' => false, 'message' => 'Please fill all required fields.']);
    exit;
}

if (!isValidEmail($email)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
    exit;
}

$bookingId = generateBookingId();

try {
    $db = Database::getInstance();
    $stmt = $db->prepare("INSERT INTO bookings (
        booking_id, name, email, phone, address, car_make, car_model, car_year, 
        registration_number, mileage, service_type, service_date, service_time, urgency, message
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([
        $bookingId, $name, $email, $phone, $address, $carMake, $carModel, $carYear,
        $regNo, $mileage, $serviceType, $serviceDate, $serviceTime, $urgency, $message
    ]);

    // Send Confirmation Email to Client
    $mailContent = "
    <h2>Appointment Confirmation</h2>
    <p>Dear $name,</p>
    <p>Thank you for choosing The Auto Shoppers! Your service appointment has been successfully booked.</p>
    
    <div class='details-box'>
        <h3>Booking Summary</h3>
        <div class='detail-row'><span class='detail-label'>Booking ID:</span> $bookingId</div>
        <div class='detail-row'><span class='detail-label'>Service:</span> $serviceType</div>
        <div class='detail-row'><span class='detail-label'>Date:</span> $serviceDate</div>
        <div class='detail-row'><span class='detail-label'>Time:</span> $serviceTime</div>
    </div>
    
    <div class='details-box'>
        <h3>Vehicle Details</h3>
        <div class='detail-row'><span class='detail-label'>Vehicle:</span> $carYear $carMake $carModel</div>
        <div class='detail-row'><span class='detail-label'>Reg. No:</span> $regNo</div>
    </div>
    
    <p>We will contact you shortly to confirm the details. If you need to reschedule, please call us at +91 99789 65551.</p>
    ";
    
    $clientMail = getEmailTemplate("Booking Confirmed", $mailContent);
    sendEmail($email, "Your Booking is Confirmed - $bookingId", $clientMail);

    // Send Notification to Admin
    $adminMail = getEmailTemplate("New Booking Received", "
        <p>A new service appointment has been booked.</p>
        <div class='details-box'>
            <div class='detail-row'><span class='detail-label'>Customer:</span> $name</div>
            <div class='detail-row'><span class='detail-label'>Phone:</span> $phone</div>
            <div class='detail-row'><span class='detail-label'>Email:</span> $email</div>
            <div class='detail-row'><span class='detail-label'>Vehicle:</span> $carYear $carMake $carModel ($regNo)</div>
            <div class='detail-row'><span class='detail-label'>Service:</span> $serviceType</div>
            <div class='detail-row'><span class='detail-label'>Requested:</span> $serviceDate at $serviceTime</div>
        </div>
    ");
    sendEmail(ADMIN_EMAIL, "New Booking - $bookingId ($name)", $adminMail, $email);

    echo json_encode([
        'success' => true, 
        'message' => "Booking successful! Your ID is $bookingId. Check your email for details.",
        'bookingId' => $bookingId
    ]);

} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => "Booking failed. Please try again or call us."]);
}
