<?php
/**
 * Database Auto-Setup
 * Initialize the database automatically
 */

echo "<h1>Bank Website - Database Setup</h1>";
echo "<hr>";

// Database credentials
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'bank_db';

// Connect to MySQL (without selecting database first)
try {
    echo "<p><strong>Step 1: Connecting to MySQL...</strong></p>";
    $pdo = new PDO(
        "mysql:host=$db_host;charset=utf8mb4",
        $db_user,
        $db_pass,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        )
    );
    echo "<p>✓ MySQL connection successful</p>";
    
    // Create database if not exists
    echo "<p><strong>Step 2: Creating database...</strong></p>";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $db_name");
    echo "<p>✓ Database created/verified</p>";
    
    // Select database
    echo "<p><strong>Step 3: Selecting database...</strong></p>";
    $pdo->exec("USE $db_name");
    echo "<p>✓ Database selected</p>";
    
    // Read SQL file
    echo "<p><strong>Step 4: Reading SQL setup file...</strong></p>";
    $sql_file = __DIR__ . '/db_setup.sql';
    if (!file_exists($sql_file)) {
        die("<p style='color: red;'>✗ db_setup.sql file not found at: $sql_file</p>");
    }
    
    $sql = file_get_contents($sql_file);
    echo "<p>✓ SQL file read successfully</p>";
    
    // Parse and execute SQL statements
    echo "<p><strong>Step 5: Executing SQL statements...</strong></p>";
    
    // Split by semicolon but be careful with IN clauses
    $statements = array_filter(array_map('trim', preg_split('/;(?=(?:[^\']*\'[^\']*\')*[^\']*$)/', $sql)));
    
    foreach ($statements as $statement) {
        if (!empty($statement)) {
            try {
                $pdo->exec($statement);
            } catch (Exception $e) {
                // Ignore some errors (like duplicate key)
                if (stripos($e->getMessage(), 'duplicate') === false) {
                    echo "<p style='color: orange;'>⚠ " . htmlspecialchars($e->getMessage()) . "</p>";
                }
            }
        }
    }
    
    echo "<p>✓ SQL statements executed</p>";
    
    // Verify setup
    echo "<p><strong>Step 6: Verifying setup...</strong></p>";
    
    // Check tables
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "<p>✓ Tables created: " . implode(', ', $tables) . "</p>";
    
    // Check users
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM admin_users");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<p>✓ Admin users: " . $result['count'] . "</p>";
    
    // List users
    $stmt = $pdo->query("SELECT id, username, email, full_name FROM admin_users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<p><strong>Users in database:</strong></p>";
    echo "<ul>";
    foreach ($users as $user) {
        echo "<li>{$user['username']} - {$user['email']} ({$user['full_name']})</li>";
    }
    echo "</ul>";
    
    echo "<hr>";
    echo "<p style='color: green; font-weight: bold;'>✓ DATABASE SETUP COMPLETE!</p>";
    echo "<p><a href='admin/login.php' class='btn btn-primary'>Go to Login →</a></p>";
    
} catch (PDOException $e) {
    echo "<p style='color: red;'><strong>✗ Error: " . htmlspecialchars($e->getMessage()) . "</strong></p>";
    echo "<p>Make sure:</p>";
    echo "<ul>";
    echo "<li>MySQL is running</li>";
    echo "<li>Database credentials are correct (root / no password)</li>";
    echo "<li>db_setup.sql file exists</li>";
    echo "</ul>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup</title>
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
        }
        h1 {
            color: #1e3a8a;
            margin-bottom: 1rem;
        }
        a {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- HTML output goes here from PHP -->
    </div>
</body>
</html>
