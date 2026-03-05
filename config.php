<?php
/**
 * Configuration File
 * Contains site-wide configuration settings
 */

// Define site constants
define('SITE_NAME', 'Shri Shantappanna Miraji Urban Co-op. Bank Ltd., Chikodi');
define('SITE_NAME_SHORT', 'Miraji Bank');
define('SITE_URL', 'http://localhost/bank-website-grok/');
define('SITE_EMAIL', 'shantappanna@mirajibank.com');
define('ADMIN_EMAIL', 'shantappanna@mirajibank.com');
define('SITE_PHONE', '+918338273169');
define('SITE_PHONE2', '+918494903886');
define('SUPPORT_EMAIL', 'shantappanna@mirajibank.com');
define('SITE_ADDRESS', '944-945, Guruwar Peth Chikodi, Belagavi Karnataka, 591201');
define('SITE_WEBSITE', 'www.shantappannamirajibank.com');

// Database Configuration (future use)
// define('DB_HOST', 'localhost');
// define('DB_USER', 'root');
// define('DB_PASS', '');
// define('DB_NAME', 'bank_db');

// Email / SMTP Configuration (PHPMailer)
// Use Gmail App Password: https://myaccount.google.com/apppasswords
define('MAIL_HOST',       'smtp.gmail.com');
define('MAIL_PORT',       587);                               // 587 = TLS, 465 = SSL
define('MAIL_ENCRYPTION', 'tls');                             // 'tls' or 'ssl'
define('MAIL_USER',       'shantappanna@mirajibank.com');     // Gmail / SMTP username
define('MAIL_PASS',       '');                                // App Password (16 chars, no spaces)
define('MAIL_FROM_NAME',  SITE_NAME_SHORT);                   // Sender display name

// reCAPTCHA Configuration (for production)
// define('RECAPTCHA_SITE_KEY', 'your-site-key');
// define('RECAPTCHA_SECRET_KEY', 'your-secret-key');

// Timezone
date_default_timezone_set('Asia/Kolkata');

// Upload directories
define('DOWNLOAD_UPLOAD_DIR', __DIR__ . '/uploads/downloads/');
define('GALLERY_UPLOAD_DIR', __DIR__ . '/uploads/gallery/');

// Set error reporting for development
// In production, errors should be logged to a file, not displayed
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/logs/error.log');

// Production mode (set to false in production)
define('DEVELOPMENT_MODE', false);

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
