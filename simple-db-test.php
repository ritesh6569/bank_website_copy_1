<?php
/**
 * Simple Database Test
 */

// Test database connection
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=bank_db;charset=utf8mb4',
        'root',
        '',
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        )
    );
    echo "✓ Database connection successful!<br>";
    
    // Check if admin_users table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'admin_users'");
    $table_exists = $stmt->rowCount() > 0;
    
    if ($table_exists) {
        echo "✓ admin_users table exists<br>";
        
        // Count users
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM admin_users");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "✓ Admin users in database: " . $result['count'] . "<br>";
        
        // List all users
        echo "<br><strong>Users in database:</strong><br>";
        $stmt = $pdo->query("SELECT id, username, email, full_name FROM admin_users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($users)) {
            echo "⚠ No users found! Database needs to be initialized.<br>";
            echo "<strong>Run db_setup.sql to initialize the database</strong>";
        } else {
            foreach ($users as $user) {
                echo "- {$user['username']} ({$user['email']})<br>";
            }
        }
    } else {
        echo "✗ admin_users table does NOT exist<br>";
        echo "<strong>⚠ Database needs to be initialized. Run db_setup.sql</strong>";
    }
    
} catch (PDOException $e) {
    echo "✗ Database connection FAILED: " . $e->getMessage() . "<br>";
    echo "<strong>⚠ Make sure MySQL is running and bank_db database exists</strong>";
}
?>
