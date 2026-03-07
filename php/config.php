<?php
session_start();
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
define('ADMIN_EMAIL', 'theautoshoppers.in@gmail.com');
define('FROM_EMAIL', 'noreply@theautoshoppers.com');
define('FROM_NAME', 'The Auto Shoppers');

// File paths
define('DATA_DIR', __DIR__ . '/../data/');
define('DB_PATH', DATA_DIR . 'tas.db');

// Ensure data directory exists
if (!file_exists(DATA_DIR)) {
    mkdir(DATA_DIR, 0755, true);
}

// CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

?>
