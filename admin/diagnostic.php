<?php
/**
 * Database and Login Diagnostic Tool
 * Tests database connectivity and admin user setup
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/helpers.php';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Login Diagnostic - Bank Website</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #333; }
        .test { margin: 15px 0; padding: 15px; border-left: 4px solid #ddd; background: #fafafa; }
        .pass { border-left-color: #4caf50; background: #f1f8f4; }
        .fail { border-left-color: #f44336; background: #fef5f5; }
        .warning { border-left-color: #ff9800; background: #fff9f3; }
        code { background: #f0f0f0; padding: 2px 6px; border-radius: 3px; font-family: monospace; }
        .label { font-weight: bold; color: #666; }
        .value { color: #333; font-family: monospace; }
    </style>
</head>
<body>
    <div class='container'>
        <h1>🔧 Login System Diagnostic</h1>";

// Test 1: Database Connection
echo "<div class='test'>";
try {
    $pdo = getDBConnection();
    echo "<strong class='pass'>✓ Database Connected</strong><br>";
    echo "<small class='label'>Database:</small> <span class='value'>" . DB_NAME . "</span><br>";
    echo "<small class='label'>Host:</small> <span class='value'>" . DB_HOST . "</span>";
} catch (Exception $e) {
    echo "<strong class='fail'>✗ Database Connection Failed</strong><br>";
    echo "<small>" . htmlspecialchars($e->getMessage()) . "</small>";
}
echo "</div>";

// Test 2: Admin Users Table
echo "<div class='test'>";
try {
    $query = "SELECT COUNT(*) as count FROM admin_users";
    $result = fetchOne($query);
    $count = $result['count'] ?? 0;
    
    if ($count > 0) {
        echo "<strong class='pass'>✓ Admin Users Table Exists</strong><br>";
        echo "<small class='label'>Total users:</small> <span class='value'>" . $count . "</span>";
    } else {
        echo "<strong class='fail'>✗ Admin Users Table Empty</strong><br>";
        echo "<small>Run database setup script to create user</small>";
    }
} catch (Exception $e) {
    echo "<strong class='fail'>✗ Admin Users Table Not Found</strong><br>";
    echo "<small>" . htmlspecialchars($e->getMessage()) . "</small>";
}
echo "</div>";

// Test 3: Admin User Exists
echo "<div class='test'>";
try {
    $query = "SELECT id, username, email, full_name FROM admin_users WHERE username = 'admin'";
    $admin = fetchOne($query);
    
    if (!empty($admin)) {
        echo "<strong class='pass'>✓ Admin User Exists</strong><br>";
        echo "<small class='label'>ID:</small> <span class='value'>" . $admin['id'] . "</span><br>";
        echo "<small class='label'>Username:</small> <span class='value'>" . htmlspecialchars($admin['username']) . "</span><br>";
        echo "<small class='label'>Email:</small> <span class='value'>" . htmlspecialchars($admin['email']) . "</span><br>";
        echo "<small class='label'>Full Name:</small> <span class='value'>" . htmlspecialchars($admin['full_name']) . "</span>";
    } else {
        echo "<strong class='fail'>✗ Admin User Not Found</strong><br>";
        echo "<small>Expected user 'admin' in database</small>";
    }
} catch (Exception $e) {
    echo "<strong class='fail'>✗ Error Checking Admin User</strong><br>";
    echo "<small>" . htmlspecialchars($e->getMessage()) . "</small>";
}
echo "</div>";

// Test 4: Password Hash Verification
echo "<div class='test'>";
try {
    $query = "SELECT password FROM admin_users WHERE username = 'admin'";
    $result = fetchOne($query);
    
    if (!empty($result)) {
        $stored_hash = $result['password'];
        $test_password = 'password';
        
        if (password_verify($test_password, $stored_hash)) {
            echo "<strong class='pass'>✓ Password Hash Valid</strong><br>";
            echo "<small class='label'>Test Password:</small> <span class='value'>" . $test_password . "</span><br>";
            echo "<small class='label'>Hash Verification:</small> <span class='value'>PASS</span>";
        } else {
            echo "<strong class='fail'>✗ Password Hash Mismatch</strong><br>";
            echo "<small class='label'>Current Hash:</small> <span class='value'>" . substr($stored_hash, 0, 30) . "...</span><br>";
            echo "<small class='warning'>The password 'password' does not match the hash in database</small><br>";
            echo "<small>Use generate-hash.php to get the correct hash</small>";
        }
    }
} catch (Exception $e) {
    echo "<strong class='fail'>✗ Error Checking Password</strong><br>";
    echo "<small>" . htmlspecialchars($e->getMessage()) . "</small>";
}
echo "</div>";

// Test 5: Login Simulation
echo "<div class='test'>";
try {
    $username = 'admin';
    $password = 'password';
    
    $query = "SELECT id, username, password, email, full_name FROM admin_users WHERE username = ?";
    $result = fetchOne($query, [$username]);
    
    if (!empty($result) && password_verify($password, $result['password'])) {
        echo "<strong class='pass'>✓ Login Simulation Successful</strong><br>";
        echo "<small class='label'>User:</small> <span class='value'>" . htmlspecialchars($result['full_name']) . " (" . htmlspecialchars($result['username']) . ")</span><br>";
        echo "<small class='label'>Email:</small> <span class='value'>" . htmlspecialchars($result['email']) . "</span>";
    } else {
        echo "<strong class='fail'>✗ Login Simulation Failed</strong><br>";
        if (empty($result)) {
            echo "<small>User 'admin' not found in database</small>";
        } else {
            echo "<small>Password verification failed</small>";
        }
    }
} catch (Exception $e) {
    echo "<strong class='fail'>✗ Error During Login Simulation</strong><br>";
    echo "<small>" . htmlspecialchars($e->getMessage()) . "</small>";
}
echo "</div>";

// Test 6: PHP Version & Extensions
echo "<div class='test'>";
echo "<strong class='pass'>✓ Server Information</strong><br>";
echo "<small class='label'>PHP Version:</small> <span class='value'>" . phpversion() . "</span><br>";
echo "<small class='label'>PDO Extension:</small> <span class='value'>" . (extension_loaded('pdo') ? 'Loaded' : 'NOT LOADED') . "</span><br>";
echo "<small class='label'>PDO MySQL:</small> <span class='value'>" . (extension_loaded('pdo_mysql') ? 'Loaded' : 'NOT LOADED') . "</span><br>";
echo "<small class='label'>OpenSSL (for hashing):</small> <span class='value'>" . (extension_loaded('openssl') ? 'Loaded' : 'NOT LOADED') . "</span>";
echo "</div>";

echo "<div style='margin-top: 30px; padding: 15px; background: #e3f2fd; border-radius: 4px;'>
    <strong>Quick Links:</strong><br>
    <a href='login.php'>Go to Login Page</a> | 
    <a href='generate-hash.php'>Generate Password Hash</a> | 
    <a href='../'>Back to Website</a>
</div>";

echo "</div>
</body>
</html>";
?>
