<?php
/**
 * AJAX JSON endpoint for Contact Us & Complaint form submissions
 * Returns: { "success": true/false, "message": "..." }
 */
ob_start(); // buffer any stray output / PHP notices
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_end_clean();
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/db.php';

$name    = trim($_POST['name']    ?? '');
$email   = trim($_POST['email']   ?? '');
$phone   = trim($_POST['phone']   ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

// Basic validation
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
    exit;
}

// phone is optional — store empty string if not provided
try {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare(
        "INSERT INTO contact_submissions (name, email, phone, subject, message, status)
         VALUES (?, ?, ?, ?, ?, 'new')"
    );
    $result = $stmt->execute([$name, $email, $phone, $subject, $message]);

    ob_end_clean();
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'ok']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error. Please try again.']);
    }
} catch (Exception $e) {
    ob_end_clean();
    error_log('submit-form.php exception: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
exit;
