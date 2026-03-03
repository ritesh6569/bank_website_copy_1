<?php
/**
 * API Endpoint Handler
 * Handles AJAX requests from frontend
 * Can be expanded for database operations
 */

// Set JSON header
header('Content-Type: application/json');

// Get request method
$method = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Handle different actions
switch ($action) {
    case 'submit_inquiry':
        handleInquiry();
        break;
    
    case 'submit_contact':
        handleContact();
        break;
    
    case 'submit_feedback':
        handleFeedback();
        break;
    
    case 'apply_account':
        handleAccountApplication();
        break;
    
    case 'apply_loan':
        handleLoanApplication();
        break;
    
    case 'get_branches':
        getBranches();
        break;
    
    case 'get_rates':
        getRates();
        break;
    
    default:
        http_response_code(400);
        echo json_encode(['error' => 'Invalid action']);
        break;
}

/**
 * Handle inquiry submission
 */
function handleInquiry() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        return;
    }
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Validate input
    if (!isset($data['name']) || !isset($data['email']) || !isset($data['message'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing required fields']);
        return;
    }
    
    // Sanitize input
    $name = htmlspecialchars($data['name']);
    $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars($data['message']);
    
    if (!$email) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid email address']);
        return;
    }
    
    // TODO: Save to database or send email
    
    echo json_encode([
        'success' => true,
        'message' => 'Your inquiry has been submitted successfully'
    ]);
}

/**
 * Handle contact form submission
 */
function handleContact() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        return;
    }
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Validate required fields
    $required = ['name', 'email', 'phone', 'subject', 'message'];
    foreach ($required as $field) {
        if (!isset($data[$field]) || empty($data[$field])) {
            http_response_code(400);
            echo json_encode(['error' => "Missing field: $field"]);
            return;
        }
    }
    
    // Sanitize input
    $contact = [
        'name' => htmlspecialchars($data['name']),
        'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
        'phone' => htmlspecialchars($data['phone']),
        'subject' => htmlspecialchars($data['subject']),
        'message' => htmlspecialchars($data['message']),
        'timestamp' => date('Y-m-d H:i:s')
    ];
    
    if (!$contact['email']) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid email address']);
        return;
    }
    
    // TODO: Save to database and send email notification
    
    echo json_encode([
        'success' => true,
        'message' => 'Thank you for contacting us. We will get back to you soon.'
    ]);
}

/**
 * Handle feedback submission
 */
function handleFeedback() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        return;
    }
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Validate input
    $required = ['name', 'email', 'rating'];
    foreach ($required as $field) {
        if (!isset($data[$field])) {
            http_response_code(400);
            echo json_encode(['error' => "Missing field: $field"]);
            return;
        }
    }
    
    // Sanitize and validate
    $feedback = [
        'name' => htmlspecialchars($data['name']),
        'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
        'rating' => (int)$data['rating'],
        'comment' => isset($data['comment']) ? htmlspecialchars($data['comment']) : '',
        'timestamp' => date('Y-m-d H:i:s')
    ];
    
    if (!$feedback['email'] || $feedback['rating'] < 1 || $feedback['rating'] > 5) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input data']);
        return;
    }
    
    // TODO: Save feedback to database
    
    echo json_encode([
        'success' => true,
        'message' => 'Thank you for your feedback!'
    ]);
}

/**
 * Handle account application
 */
function handleAccountApplication() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        return;
    }
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Validate required fields
    $required = ['name', 'email', 'phone', 'account_type'];
    foreach ($required as $field) {
        if (!isset($data[$field])) {
            http_response_code(400);
            echo json_encode(['error' => "Missing field: $field"]);
            return;
        }
    }
    
    // TODO: Save application to database, send confirmation email
    
    echo json_encode([
        'success' => true,
        'message' => 'Your account application has been submitted. We will contact you soon.',
        'reference_id' => 'APP-' . strtoupper(uniqid())
    ]);
}

/**
 * Handle loan application
 */
function handleLoanApplication() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        return;
    }
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Validate required fields
    $required = ['name', 'email', 'phone', 'loan_type', 'loan_amount'];
    foreach ($required as $field) {
        if (!isset($data[$field])) {
            http_response_code(400);
            echo json_encode(['error' => "Missing field: $field"]);
            return;
        }
    }
    
    // TODO: Save application to database, perform credit check, send confirmation
    
    echo json_encode([
        'success' => true,
        'message' => 'Your loan application has been submitted. We will review and contact you within 2 business days.',
        'reference_id' => 'LOAN-' . strtoupper(uniqid())
    ]);
}

/**
 * Get branches (can be used for dropdown/list)
 */
function getBranches() {
    // This would typically fetch from database
    $branches = [
        ['id' => 1, 'name' => 'Main Branch', 'city' => 'Financial City'],
        ['id' => 2, 'name' => 'Downtown Branch', 'city' => 'Financial City'],
        ['id' => 3, 'name' => 'Midtown Branch', 'city' => 'Financial City'],
    ];
    
    echo json_encode($branches);
}

/**
 * Get current interest rates
 */
function getRates() {
    // This would typically fetch from database
    $rates = [
        'savings' => '3.5-4.0%',
        'fixed_deposit_1y' => '6.0%',
        'personal_loan' => '8.5-12.5%',
        'home_loan' => '7.0-8.5%'
    ];
    
    echo json_encode($rates);
}

/**
 * Send email (helper function)
 */
function send_email($to, $subject, $message, $from = null) {
    // TODO: Implement email sending using PHPMailer or similar
    // This is a placeholder
    return true;
}

/**
 * Log action for audit trail
 */
function log_action($action, $data) {
    // TODO: Implement logging to database or file
    $log_entry = [
        'action' => $action,
        'data' => $data,
        'ip' => $_SERVER['REMOTE_ADDR'],
        'timestamp' => date('Y-m-d H:i:s')
    ];
    
    // File logging (simple example)
    // error_log(json_encode($log_entry) . PHP_EOL, 3, 'logs/actions.log');
}

?>
