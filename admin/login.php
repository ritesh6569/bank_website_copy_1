<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';

if (isLoggedIn()) { header("Location: " . SITE_URL . "admin/index.php"); exit(); }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if (empty($username) || empty($password)) {
        $error = 'Username and password are required.';
    } else {
        try {
            $result = fetchOne("SELECT id,username,password,email,full_name FROM admin_users WHERE username=?", [$username]);
            if (!empty($result) && password_verify($password, $result['password'])) {
                $_SESSION['admin_id']       = $result['id'];
                $_SESSION['admin_logged_in']= true;
                $_SESSION['admin_username'] = $result['username'];
                $_SESSION['admin_email']    = $result['email'];
                $_SESSION['admin_name']     = $result['full_name'];
                $_SESSION['login_time']     = time();
                $_SESSION['login_success']  = 'Logged in successfully. Welcome, ' . $result['full_name'] . '!';
                header("Location: " . SITE_URL . "admin/index.php"); exit();
            } else {
                $error = 'Invalid username or password.';
            }
        } catch (Exception $e) {
            $error = 'An error occurred. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login &mdash; Miraji Bank</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing:border-box; }
    body {
      margin:0; font-family:'Poppins',sans-serif;
      min-height:100vh; display:flex; align-items:center; justify-content:center;
      background: linear-gradient(150deg,#0D3D2E 0%,#1A5C42 55%,#2E8B63 100%);
      position:relative; overflow:hidden;
    }
    body::before {
      content:''; position:absolute; inset:0;
      background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 800 600'%3E%3Ccircle cx='650' cy='100' r='220' fill='rgba(255,255,255,0.04)'/%3E%3Ccircle cx='100' cy='500' r='160' fill='rgba(255,255,255,0.03)'/%3E%3C/svg%3E") no-repeat center/cover;
    }
    .login-wrap {
      position:relative; z-index:1; width:100%; max-width:420px; padding:1rem;
    }
    .login-card {
      background:#fff; border-radius:16px; overflow:hidden;
      box-shadow:0 24px 64px rgba(0,0,0,0.25);
    }
    .login-head {
      background:#0D3D2E; padding:2rem 2rem 1.5rem; text-align:center;
    }
    .login-head .brand-icon {
      width:52px; height:52px; background:#B87333; border-radius:12px;
      display:flex; align-items:center; justify-content:center;
      margin:0 auto 0.75rem; font-size:1.4rem; color:#fff;
    }
    .login-head h1 { color:#fff; font-size:1.3rem; font-weight:800; margin:0 0 0.2rem; }
    .login-head p  { color:rgba(255,255,255,0.65); font-size:0.8rem; margin:0; }
    .login-body { padding:1.75rem 2rem; }
    .form-group { margin-bottom:1rem; }
    .form-group label { display:block; font-size:0.8rem; font-weight:600; color:#1C2B22; margin-bottom:0.35rem; }
    .form-group .input-wrap { position:relative; }
    .form-group .input-wrap i { position:absolute; left:0.8rem; top:50%; transform:translateY(-50%); color:#7A9485; font-size:0.85rem; }
    .form-group input {
      width:100%; padding:0.6rem 0.85rem 0.6rem 2.2rem;
      border:1px solid #C8DDD3; border-radius:8px;
      font-family:'Poppins',sans-serif; font-size:0.88rem; color:#1C2B22;
      outline:none; transition:border 0.18s, box-shadow 0.18s; background:#fff;
    }
    .form-group input:focus { border-color:#0D3D2E; box-shadow:0 0 0 3px rgba(13,61,46,0.1); }
    .err-box {
      display:flex; align-items:center; gap:0.5rem;
      background:#fee2e2; color:#b91c1c; border-left:4px solid #dc2626;
      border-radius:0 8px 8px 0; padding:0.7rem 0.9rem; font-size:0.83rem; margin-bottom:1rem;
    }
    .btn-login {
      width:100%; padding:0.65rem; background:#0D3D2E; color:#fff; border:none;
      border-radius:8px; font-family:'Poppins',sans-serif; font-size:0.92rem; font-weight:700;
      cursor:pointer; transition:background 0.18s; display:flex; align-items:center; justify-content:center; gap:0.5rem;
    }
    .btn-login:hover { background:#1A5C42; }
    .back-link { text-align:center; padding:1rem 2rem 1.5rem; font-size:0.8rem; }
    .back-link a { color:#5A7A67; text-decoration:none; }
    .back-link a:hover { color:#0D3D2E; }
  </style>
</head>
<body>
<div class="login-wrap">
  <div class="login-card">
    <div class="login-head">
      <div class="brand-icon"><i class="fas fa-university"></i></div>
      <h1>Admin Login</h1>
      <p>Miraji Bank &mdash; Control Panel</p>
    </div>
    <div class="login-body">
      <?php if ($error): ?>
      <div class="err-box"><i class="fas fa-circle-xmark"></i><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <form method="POST" action="">
        <div class="form-group">
          <label for="username">Username</label>
          <div class="input-wrap">
            <i class="fas fa-user"></i>
            <input type="text" id="username" name="username" placeholder="Enter username"
                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required autofocus>
          </div>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <div class="input-wrap">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="Enter password" required>
          </div>
        </div>
        <button type="submit" class="btn-login">
          <i class="fas fa-right-to-bracket"></i>Sign In
        </button>
      </form>
    </div>
    <div class="back-link">
      <a href="<?= SITE_URL ?>"><i class="fas fa-arrow-left me-1"></i>Back to Website</a>
    </div>
  </div>
</div>
</body>
</html>
