<?php
/**
 * Notices Fetcher
 * Retrieves active notices from database for display on public pages
 */

// Include database connection
require_once __DIR__ . '/db.php';

function getActiveNotices() {
    try {
        $query = "SELECT id, title, content, date_published, status 
                  FROM notices 
                  WHERE status = 'active' 
                  ORDER BY date_published DESC 
                  LIMIT 10";
        
        $pdo = getDBConnection();
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        error_log('Error fetching notices: ' . $e->getMessage());
        return [];
    }
}

function getLatestNotice() {
    try {
        $query = "SELECT id, title, content, date_published, status 
                  FROM notices 
                  WHERE status = 'active' 
                  ORDER BY date_published DESC 
                  LIMIT 1";
        
        $pdo = getDBConnection();
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    } catch (Exception $e) {
        error_log('Error fetching latest notice: ' . $e->getMessage());
        return null;
    }
}

function truncateNotice($content, $length = 150) {
    if (strlen($content) > $length) {
        return substr($content, 0, $length) . '...';
    }
    return $content;
}

function stripHtmlTags($html) {
    return strip_tags($html);
}

function formatNoticeDate($date) {
    $datetime = new DateTime($date);
    return $datetime->format('M d, Y');
}
?>
