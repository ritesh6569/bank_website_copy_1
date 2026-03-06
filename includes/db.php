<?php
/**
 * Database Configuration and Connection
 * Handles PDO database connections with error handling
 */

// Database Configuration — reads from environment variables (set in Render dashboard)
// Falls back to localhost defaults for local XAMPP development
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'bank_db');
define('DB_SSL',  getenv('DB_SSL')  ?: 'false');

/**
 * Get database connection using PDO
 * @return PDO Database connection object
 */
function getDBConnection() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4';
            $options = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            );
            // Enable SSL for Aiven (and any host requiring it)
            if (DB_SSL === 'true') {
                $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
                $options[PDO::MYSQL_ATTR_SSL_CA] = '';
            }
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);

            // Auto-initialise: create tables if they don't exist yet
            runSetupSQL($pdo);

        } catch (PDOException $e) {
            // Log error securely and show generic message to users
            error_log('Database connection failed: ' . $e->getMessage());
            die('Database connection error. Please try again later.');
        }
    }
    
    return $pdo;
}

/**
 * Run db_setup.sql once to create all tables and seed data.
 * Safe to call on every boot — every statement uses IF NOT EXISTS / INSERT IGNORE.
 * @param PDO $pdo
 */
function runSetupSQL(PDO $pdo) {
    $sqlFile = __DIR__ . '/../db_setup.sql';
    if (!file_exists($sqlFile)) {
        error_log('db_setup.sql not found at: ' . $sqlFile);
        return;
    }

    $sql = file_get_contents($sqlFile);

    // Strip comments and split into individual statements
    $sql = preg_replace('/--[^\n]*\n/', "\n", $sql);   // remove -- comments
    $sql = preg_replace('/\s+/', ' ', $sql);            // collapse whitespace
    $statements = array_filter(
        array_map('trim', explode(';', $sql)),
        fn($s) => $s !== ''
    );

    foreach ($statements as $statement) {
        try {
            $pdo->exec($statement);
        } catch (PDOException $e) {
            // Log but don't crash — table may already exist, index duplicate, etc.
            error_log('DB setup warning [' . $statement . ']: ' . $e->getMessage());
        }
    }
}

/**
 * Execute a prepared statement with parameters
 * @param string $query SQL query with placeholders
 * @param array $params Parameters for placeholders
 * @return PDOStatement
 */
function executeQuery($query, $params = []) {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    return $stmt;
}

/**
 * Fetch all results from a query
 * @param string $query SQL query
 * @param array $params Parameters
 * @return array Results array
 */
function fetchAll($query, $params = []) {
    $stmt = executeQuery($query, $params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Fetch single result from a query
 * @param string $query SQL query
 * @param array $params Parameters
 * @return array Single result or empty array
 */
function fetchOne($query, $params = []) {
    $stmt = executeQuery($query, $params);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ?: [];
}

/**
 * Execute a query that doesn't return results (INSERT, UPDATE, DELETE)
 * @param string $query SQL query
 * @param array $params Parameters
 * @return int Number of affected rows
 */
function executeUpdate($query, $params = []) {
    $stmt = executeQuery($query, $params);
    return $stmt->rowCount();
}

/**
 * Get last inserted ID
 * @return string Last insert ID
 */
function getLastInsertId() {
    return getDBConnection()->lastInsertId();
}

?>
