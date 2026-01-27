<?php
/**
 * Utility Functions
 */

require_once 'db.php';

/**
 * Sanitize user input
 */
function sanitizeInput($data) {
    if (is_array($data)) {
        return array_map('sanitizeInput', $data);
    }
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Generate unique IDs
 */
function generateBookingId() {
    return 'TAS' . date('Ymd') . strtoupper(substr(uniqid(), -6));
}

function generateContactId() {
    return 'CNT' . date('Ymd') . strtoupper(substr(uniqid(), -6));
}

/**
 * CSRF Protection
 */
function getCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCsrfToken($token) {
    if (!isset($_SESSION['csrf_token']) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Rate Limiting
 */
function isRateLimited($action, $limit = 5, $period = 3600) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    $db = Database::getInstance();
    $now = time();
    $cutoff = $now - $period;

    // Clean up old records
    $db->prepare("DELETE FROM rate_limits WHERE last_request < ?")->execute([$cutoff]);

    // Check current IP
    $stmt = $db->prepare("SELECT request_count, last_request FROM rate_limits WHERE ip = ? AND action = ?");
    $stmt->execute([$ip, $action]);
    $row = $stmt->fetch();

    if ($row) {
        if ($row['request_count'] >= $limit) {
            return true;
        }
        $stmt = $db->prepare("UPDATE rate_limits SET request_count = request_count + 1, last_request = ? WHERE ip = ? AND action = ?");
        $stmt->execute([$now, $ip, $action]);
    } else {
        $stmt = $db->prepare("INSERT INTO rate_limits (ip, action, last_request, request_count) VALUES (?, ?, ?, 1)");
        $stmt->execute([$ip, $action, $now]);
    }

    return false;
}

/**
 * Validate email address
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Database Helpers
 */
function emailExistsInNewsletter($email) {
    $db = Database::getInstance();
    $stmt = $db->prepare("SELECT id FROM newsletter WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch() !== false;
}

function subscribeToNewsletter($email) {
    if (emailExistsInNewsletter($email)) return true;
    $db = Database::getInstance();
    $stmt = $db->prepare("INSERT INTO newsletter (email) VALUES (?)");
    return $stmt->execute([$email]);
}

/**
 * Email Sending Helpers
 */
function sendEmail($to, $subject, $body, $replyTo = null) {
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: " . FROM_NAME . " <" . FROM_EMAIL . ">" . "\r\n";
    if ($replyTo) {
        $headers .= "Reply-To: $replyTo" . "\r\n";
    }
    
    return @mail($to, $subject, $body, $headers);
}

function getEmailTemplate($title, $content) {
    return "
    <html>
    <head>
        <style>
            body { font-family: 'Segoe UI', Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
            .container { max-width: 600px; margin: 20px auto; border: 1px solid #eee; }
            .header { background-color: #E31E24; color: white; padding: 30px; text-align: center; }
            .header h1 { margin: 0; font-size: 24px; }
            .content { padding: 30px; background-color: #ffffff; }
            .footer { background-color: #f8f9fa; padding: 20px; text-align: center; color: #666; font-size: 12px; border-top: 1px solid #eee; }
            .details-box { background-color: #f1f3f5; border-left: 4px solid #E31E24; padding: 15px; margin: 20px 0; }
            .detail-row { margin-bottom: 5px; }
            .detail-label { font-weight: bold; color: #495057; width: 120px; display: inline-block; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>The Auto Shoppers</h1>
                <div>$title</div>
            </div>
            <div class='content'>
                $content
            </div>
            <div class='footer'>
                <p><strong>The Auto Shoppers</strong><br>
                F.P. 134, Beside Western city, Opp. L.P.Savani CNG Pump, Adajan, Surat, Gujarat 395009</p>
                <p>Phone: +91 99789 65551 | Email: info@theautoshoppers.com</p>
                <p>&copy; " . date('Y') . " The Auto Shoppers. All rights reserved.</p>
            </div>
        </div>
    </body>
    </html>
    ";
}
