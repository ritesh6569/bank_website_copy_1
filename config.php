<?php
/**
 * Configuration File
 * Contains site-wide configuration settings
 */

// Define site constants
define('SITE_NAME', 'Professional Bank');
define('SITE_URL', 'http://localhost/bank-website-grok/');
define('SITE_EMAIL', 'support@bank.com');
define('SITE_PHONE', '+1 (234) 567-890');
define('SUPPORT_EMAIL', 'support@bank.com');

// Database Configuration (future use)
// define('DB_HOST', 'localhost');
// define('DB_USER', 'root');
// define('DB_PASS', '');
// define('DB_NAME', 'bank_db');

// Email Configuration (future use)
// define('MAIL_HOST', 'smtp.gmail.com');
// define('MAIL_PORT', 587);
// define('MAIL_USER', 'your-email@gmail.com');
// define('MAIL_PASS', 'your-password');

// reCAPTCHA Configuration (for production)
// define('RECAPTCHA_SITE_KEY', 'your-site-key');
// define('RECAPTCHA_SECRET_KEY', 'your-secret-key');

// Timezone
date_default_timezone_set('Asia/Kolkata');

// Set error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Production mode (set to false in production)
define('DEVELOPMENT_MODE', true);

// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');

// CORS (if needed)
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

/**
 * Helper function to get site name
 */
function site_name() {
    return SITE_NAME;
}

/**
 * Helper function to get site URL
 */
function site_url() {
    return SITE_URL;
}

/**
 * Helper function to sanitize input
 */
function sanitize_input($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}

/**
 * Helper function to validate email
 */
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Helper function to validate phone
 */
function validate_phone($phone) {
    $phone = preg_replace('/[^0-9]/', '', $phone);
    return strlen($phone) >= 10;
}

/**
 * Redirect function
 */
function redirect($url) {
    header("Location: {$url}");
    exit;
}

/**
 * Get current page
 */
function get_current_page() {
    $page = basename($_SERVER['PHP_SELF'], '.php');
    return $page !== 'index' ? $page : 'home';
}
?>
