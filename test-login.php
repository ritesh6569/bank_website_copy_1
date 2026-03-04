<?php
/**
 * Test Login Script
 * Debug login issues
 */

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load configuration and dependencies
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/db.php';

echo "<h1>Login Test Debug</h1>";
echo "<pre>";

// Test 1: Database Connection
echo "=== TEST 1: Database Connection ===\n";
try {
    $pdo = getDBConnection();
    echo "✓ Database connected successfully\n";
} catch (Exception $e) {
    echo "✗ Database connection failed: " . $e->getMessage() . "\n";
    exit;
}

// Test 2: Check admin user exists
echo "\n=== TEST 2: Check Admin User ===\n";
try {
    $query = "SELECT id, username, email, full_name FROM admin_users WHERE username = ?";
    $result = fetchOne($query, ['admin']);
    
    if (!empty($result)) {
        echo "✓ Admin user found:\n";
        echo "  - ID: " . $result['id'] . "\n";
        echo "  - Username: " . $result['username'] . "\n";
        echo "  - Email: " . $result['email'] . "\n";
        echo "  - Full Name: " . $result['full_name'] . "\n";
    } else {
        echo "✗ Admin user not found in database\n";
    }
} catch (Exception $e) {
    echo "✗ Query error: " . $e->getMessage() . "\n";
}

// Test 3: Test password verification
echo "\n=== TEST 3: Password Verification ===\n";
try {
    $query = "SELECT id, username, password FROM admin_users WHERE username = ?";
    $result = fetchOne($query, ['admin']);
    
    if (!empty($result)) {
        $password_hash = $result['password'];
        $test_password = 'password';
        
        echo "Stored Hash: " . $password_hash . "\n";
        echo "Test Password: " . $test_password . "\n";
        
        if (password_verify($test_password, $password_hash)) {
            echo "✓ Password verification PASSED\n";
        } else {
            echo "✗ Password verification FAILED\n";
            echo "\nTrying to generate new hash...\n";
            $new_hash = password_hash($test_password, PASSWORD_BCRYPT);
            echo "New Hash: " . $new_hash . "\n";
        }
    } else {
        echo "✗ Cannot test - admin user not found\n";
    }
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}

// Test 4: Simulate login attempt
echo "\n=== TEST 4: Simulate Login POST ===\n";
try {
    $username = sanitize('admin');
    $password = 'password';
    
    echo "Username: " . $username . "\n";
    echo "Password: " . $password . "\n";
    
    $query = "SELECT id, username, password, email, full_name FROM admin_users WHERE username = ?";
    $result = fetchOne($query, [$username]);
    
    if (!empty($result)) {
        if (password_verify($password, $result['password'])) {
            echo "✓ Login would be SUCCESSFUL\n";
            echo "  - Admin ID: " . $result['id'] . "\n";
            echo "  - Admin Name: " . $result['full_name'] . "\n";
        } else {
            echo "✗ Password mismatch\n";
        }
    } else {
        echo "✗ User not found\n";
    }
} catch (Exception $e) {
    echo "✗ Login simulation error: " . $e->getMessage() . "\n";
}

echo "</pre>";

// Test 5: Show all users in database
echo "<h2>All Users in Database</h2>";
echo "<pre>";
try {
    $all_users = fetchAll("SELECT id, username, email, full_name FROM admin_users");
    if (!empty($all_users)) {
        foreach ($all_users as $user) {
            echo "ID: {$user['id']}, Username: {$user['username']}, Email: {$user['email']}, Name: {$user['full_name']}\n";
        }
    } else {
        echo "No users found in database\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
echo "</pre>";
?>
