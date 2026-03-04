<?php
/**
 * Auto-Fix Password Hash
 * Automatically updates the admin password hash in the database
 */

echo "<h1>Admin Password Fix</h1>";
echo "<hr>";

// Database credentials
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'bank_db';

try {
    // Connect to database
    $pdo = new PDO(
        "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4",
        $db_user,
        $db_pass,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        )
    );
    
    echo "<p>✓ Database connected</p>";
    
    // Generate new password hash
    $password = 'password';
    $new_hash = password_hash($password, PASSWORD_BCRYPT);
    
    echo "<p><strong>Generated new password hash:</strong></p>";
    echo "<pre>" . htmlspecialchars($new_hash) . "</pre>";
    
    // Update the password in database
    $stmt = $pdo->prepare("UPDATE admin_users SET password = ? WHERE username = ?");
    $stmt->execute([$new_hash, 'admin']);
    
    $rows_affected = $stmt->rowCount();
    
    if ($rows_affected > 0) {
        echo "<p style='color: green;'><strong>✓ Password updated successfully!</strong></p>";
        echo "<p>Rows affected: " . $rows_affected . "</p>";
        
        // Verify the update
        $stmt = $pdo->prepare("SELECT username, email FROM admin_users WHERE username = ?");
        $stmt->execute(['admin']);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo "<p><strong>Updated admin user:</strong></p>";
        echo "<ul>";
        echo "<li>Username: " . htmlspecialchars($user['username']) . "</li>";
        echo "<li>Email: " . htmlspecialchars($user['email']) . "</li>";
        echo "</ul>";
        
        echo "<hr>";
        echo "<p style='color: green; font-weight: bold;'>You can now login with:</p>";
        echo "<ul>";
        echo "<li><strong>Username:</strong> admin</li>";
        echo "<li><strong>Password:</strong> password</li>";
        echo "</ul>";
        echo "<p><a href='/bank-website-grok/admin/login.php' class='btn btn-primary btn-lg'>Go to Admin Login →</a></p>";
        
    } else {
        echo "<p style='color: red;'><strong>✗ No rows updated. Admin user might not exist.</strong></p>";
        echo "<p><a href='/bank-website-grok/setup-database.php' class='btn btn-warning'>Initialize Database</a></p>";
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'><strong>✗ Error: " . htmlspecialchars($e->getMessage()) . "</strong></p>";
    echo "<p>Make sure MySQL is running and database is initialized.</p>";
    echo "<p><a href='/bank-website-grok/setup-database.php' class='btn btn-warning'>Initialize Database</a></p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fix Admin Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e3a8a 0%, #2d5a8c 100%);
            min-height: 100vh;
            padding: 2rem;
        }
        .container {
            background: white;
            border-radius: 0.5rem;
            padding: 2rem;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        h1 {
            color: #1e3a8a;
            margin-bottom: 1rem;
        }
        pre {
            background: #f5f5f5;
            padding: 1rem;
            border-radius: 4px;
            border-left: 4px solid #3b82f6;
            word-break: break-all;
        }
        .btn {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Output goes here -->
    </div>
</body>
</html>
