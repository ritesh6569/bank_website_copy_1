<?php
/**
 * Database Configuration and Connection
 * Handles PDO database connections with error handling
 */

// Database Configuration — reads from environment variables (set in Render dashboard)
// Falls back to localhost defaults for local XAMPP development
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'bank_db');

/**
 * Get database connection using PDO
 * @return PDO Database connection object
 */
function getDBConnection() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $pdo = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
                DB_USER,
                DB_PASS,
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                )
            );
        } catch (PDOException $e) {
            // Log error securely and show generic message to users
            error_log('Database connection failed: ' . $e->getMessage());
            die('Database connection error. Please try again later.');
        }
    }
    
    return $pdo;
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
