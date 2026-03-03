<?php
/**
 * Authentication Functions for Admin Panel
 * Handles login, logout, and session management
 */

// Ensure session is started (must be first in this file)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Check if user is logged in as admin
 * Uses the consistent 'admin_logged_in' flag instead of relying on admin_id
 * @return bool True if logged in, false otherwise
 */
function isLoggedIn() {
    // Check both the explicit flag and admin_id for backward compatibility
    return (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) ||
           (isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']));
}

/**
 * Redirect to login if not authenticated
 */
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: ' . SITE_URL . 'admin/login.php');
        exit;
    }
}

/**
 * Login user with username and password
 * @param string $username Admin username
 * @param string $password Admin password
 * @return bool True if login successful, false otherwise
 */
function loginUser($username, $password) {
    require_once __DIR__ . '/db.php';
    
    $query = "SELECT id, username, password, email, full_name FROM admin_users WHERE username = ?";
    $result = fetchOne($query, [$username]);
    
    if (empty($result)) {
        return false;
    }
    
    // Verify password - using bcrypt
    if (password_verify($password, $result['password'])) {
        $_SESSION['admin_id'] = $result['id'];
        $_SESSION['admin_username'] = $result['username'];
        $_SESSION['admin_email'] = $result['email'];
        $_SESSION['admin_name'] = $result['full_name'];
        $_SESSION['login_time'] = time();
        return true;
    }
    
    return false;
}

/**
 * Logout current user
 */
function logoutUser() {
    session_destroy();
}

/**
 * Get current logged-in admin info
 * @return array Admin user data
 */
function getCurrentAdmin() {
    if (!isLoggedIn()) {
        return [];
    }
    
    return [
        'id' => $_SESSION['admin_id'] ?? null,
        'username' => $_SESSION['admin_username'] ?? null,
        'email' => $_SESSION['admin_email'] ?? null,
        'name' => $_SESSION['admin_name'] ?? null,
    ];
}

?>
