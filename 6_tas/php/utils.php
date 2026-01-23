<?php
/**
 * Utility Functions
 */

/**
 * Sanitize user input
 */
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Generate unique booking ID
 */
function generateBookingId() {
    return 'TAS' . date('Ymd') . strtoupper(substr(uniqid(), -6));
}

/**
 * Generate unique contact ID
 */
function generateContactId() {
    return 'CNT' . date('Ymd') . strtoupper(substr(uniqid(), -6));
}

/**
 * Send booking confirmation email
 */
function sendBookingConfirmation($data) {
    $to = $data['personalInfo']['email'];
    $subject = 'Booking Confirmation - The Auto Shoppers';
    
    $message = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background-color: #E31E24; color: white; padding: 20px; text-align: center; }
            .content { background-color: #f9f9f9; padding: 20px; }
            .booking-details { background-color: white; padding: 15px; margin: 10px 0; border-left: 4px solid #E31E24; }
            .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>The Auto Shoppers</h1>
                <p>Booking Confirmation</p>
            </div>
            <div class='content'>
                <h2>Dear {$data['personalInfo']['name']},</h2>
                <p>Thank you for booking with The Auto Shoppers! Your service appointment has been confirmed.</p>
                
                <div class='booking-details'>
                    <h3>Booking Details</h3>
                    <p><strong>Booking ID:</strong> {$data['bookingId']}</p>
                    <p><strong>Service Type:</strong> {$data['serviceDetails']['type']}</p>
                    <p><strong>Date:</strong> {$data['serviceDetails']['date']}</p>
                    <p><strong>Time:</strong> {$data['serviceDetails']['time']}</p>
                </div>
                
                <div class='booking-details'>
                    <h3>Vehicle Information</h3>
                    <p><strong>Vehicle:</strong> {$data['vehicleInfo']['year']} {$data['vehicleInfo']['make']} {$data['vehicleInfo']['model']}</p>
                    <p><strong>Registration:</strong> {$data['vehicleInfo']['registrationNumber']}</p>
                </div>
                
                <p>Our team will contact you shortly to confirm the appointment. If you need to make any changes, please call us at +91 98765 43210.</p>
                
                <p>We look forward to serving you!</p>
            </div>
            <div class='footer'>
                <p>The Auto Shoppers | 123 Street, Mumbai, India</p>
                <p>Phone: +91 98765 43210 | Email: info@theautoshoppers.com</p>
            </div>
        </div>
    </body>
    </html>
    ";
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: " . FROM_NAME . " <" . FROM_EMAIL . ">" . "\r\n";
    
    // Send email (may not work on localhost without mail server)
    $emailSent = @mail($to, $subject, $message, $headers);
    
    // Also send notification to admin
    @mail(ADMIN_EMAIL, 'New Booking - ' . $data['bookingId'], $message, $headers);
    
    return $emailSent;
}

/**
 * Send contact form email
 */
function sendContactEmail($data) {
    $to = ADMIN_EMAIL;
    $subject = 'New Contact Form Submission - The Auto Shoppers';
    
    $message = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background-color: #E31E24; color: white; padding: 20px; }
            .content { background-color: #f9f9f9; padding: 20px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>New Contact Form Submission</h2>
            </div>
            <div class='content'>
                <p><strong>Name:</strong> {$data['name']}</p>
                <p><strong>Email:</strong> {$data['email']}</p>
                <p><strong>Phone:</strong> {$data['phone']}</p>
                <p><strong>Subject:</strong> {$data['subject']}</p>
                <p><strong>Message:</strong></p>
                <p>{$data['message']}</p>
                <p><strong>Submitted:</strong> {$data['timestamp']}</p>
            </div>
        </div>
    </body>
    </html>
    ";
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: " . FROM_NAME . " <" . FROM_EMAIL . ">" . "\r\n";
    $headers .= "Reply-To: {$data['email']}" . "\r\n";
    
    return @mail($to, $subject, $message, $headers);
}

/**
 * Validate email address
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Check if email already exists in newsletter
 */
function emailExistsInNewsletter($email) {
    $subscribers = json_decode(file_get_contents(NEWSLETTER_FILE), true) ?? [];
    foreach ($subscribers as $subscriber) {
        if ($subscriber['email'] === $email) {
            return true;
        }
    }
    return false;
}

?>
