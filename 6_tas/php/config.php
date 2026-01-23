<?php
/**
 * Configuration file for The Auto Shoppers
 */

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../data/error.log');

// Timezone
date_default_timezone_set('Asia/Kolkata');

// Email configuration
define('ADMIN_EMAIL', 'info@theautoshoppers.com');
define('FROM_EMAIL', 'noreply@theautoshoppers.com');
define('FROM_NAME', 'The Auto Shoppers');

// File paths
define('DATA_DIR', __DIR__ . '/../data/');
define('BOOKINGS_FILE', DATA_DIR . 'bookings.json');
define('CONTACTS_FILE', DATA_DIR . 'contacts.json');
define('NEWSLETTER_FILE', DATA_DIR . 'newsletter.json');

// Ensure data directory exists
if (!file_exists(DATA_DIR)) {
    mkdir(DATA_DIR, 0755, true);
}

// Initialize JSON files if they don't exist
if (!file_exists(BOOKINGS_FILE)) {
    file_put_contents(BOOKINGS_FILE, json_encode([], JSON_PRETTY_PRINT));
}
if (!file_exists(CONTACTS_FILE)) {
    file_put_contents(CONTACTS_FILE, json_encode([], JSON_PRETTY_PRINT));
}
if (!file_exists(NEWSLETTER_FILE)) {
    file_put_contents(NEWSLETTER_FILE, json_encode([], JSON_PRETTY_PRINT));
}

// CORS headers (if needed)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

?>
