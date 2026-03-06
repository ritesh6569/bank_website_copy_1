<?php
/**
 * Admin Login Page
 * Secure admin panel login with session management
 */

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// CRITICAL: Start session as FIRST thing
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load configuration and dependencies
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';

$page_title = 'Admin Login - ' . SITE_NAME;
$meta_description = 'Admin panel login for ' . SITE_NAME;

// If already logged in, redirect to dashboard
if (isLoggedIn()) {
    $dashboard_url = SITE_URL . 'admin/index.php';
    header("Location: " . $dashboard_url);
    exit();
}

$error = '';
$success = '';
$show_alert = false;
$alert_message = '';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get raw values - sanitize AFTER database check, not before
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // alert box for testing purpose
    $show_alert = true;
    $alert_message = "Login attempt: Username: $username, Password: " . str_repeat("*", strlen($password));

    if (empty($username) || empty($password)) {
        $error = 'Username and password are required.';
    } else {
        // Check credentials against database
        try {
            $query = "SELECT id, username, password, email, full_name FROM admin_users WHERE username = ?";
            $result = fetchOne($query, [$username]);
            
            if (!empty($result) && password_verify($password, $result['password'])) {
                // Password is correct - set session variables
                $_SESSION['admin_id'] = $result['id'];
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $result['username'];
                $_SESSION['admin_email'] = $result['email'];
                $_SESSION['admin_name'] = $result['full_name'];
                $_SESSION['login_time'] = time();

                // IMPORTANT: Use absolute path from SITE_URL to admin/index.php
                // This ensures we go to the admin dashboard, not the landing page
                $dashboard_url = SITE_URL . 'admin/index.php';
                header("Location: " . $dashboard_url);
                exit();
            } else {
                $error = 'Invalid username or password.';
            }
        } catch (Exception $e) {
            $error = 'An error occurred during login. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1e3a8a;
            --primary-light: #2d5a8c;
        }

        body {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Open Sans', sans-serif;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .login-header h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .login-header p {
            margin: 0.5rem 0 0;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .login-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }

        .login-btn {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border: none;
            border-radius: 0.5rem;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3);
        }

        .demo-info {
            background-color: #f0f9ff;
            border-left: 4px solid #3b82f6;
            padding: 1rem;
            border-radius: 0.25rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .demo-info strong {
            color: var(--primary-color);
        }

        .alert {
            border: none;
            border-radius: 0.5rem;
            border-left: 4px solid;
        }

        .back-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }

        .back-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .icon-input {
            position: relative;
        }

        .icon-input i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
            opacity: 0.6;
        }

        .icon-input input {
            padding-left: 2.5rem;
        }
    </style>
</head>
<body>
    <div class="login-container animate__animated animate__fadeIn">
        <div class="login-header">
            <i class="fas fa-lock" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
            <h2>Admin Login</h2>
            <p><?php echo SITE_NAME; ?></p>
        </div>

        <div class="login-body">
            <?php if ($show_alert): ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Info:</strong> <?php echo htmlspecialchars($alert_message); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?php echo $error; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo $success; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Demo Credentials -->
            <div class="demo-info">
                <strong><i class="fas fa-info-circle me-2"></i>Demo Credentials:</strong>
                <br>Username: <code>admin</code>
                <br>Password: <code>password</code>
                <br><small style="color: #666;">Authenticated from database</small>
            </div>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <div class="icon-input">
                        <i class="fas fa-user"></i>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            class="form-control" 
                            placeholder="Enter username"
                            required 
                            autofocus
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="icon-input">
                        <i class="fas fa-lock"></i>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-control" 
                            placeholder="Enter password"
                            required
                        >
                    </div>
                </div>

                <button type="submit" class="login-btn">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </button>
            </form>

            <div class="back-link">
                <a href="<?php echo SITE_URL; ?>index.php">
                    <i class="fas fa-arrow-left me-2"></i> Back to Website
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</body>
</html>
