<?php
/**
 * Helper Functions
 * Utility functions used across the site
 */

/**
 * Sanitize input to prevent XSS
 * @param mixed $data Data to sanitize
 * @return mixed Sanitized data
 */
function sanitize($data) {
    if (is_array($data)) {
        return array_map('sanitize', $data);
    }
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * Escape for HTML output
 * @param string $str String to escape
 * @return string Escaped string
 */
function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

/**
 * Format date in readable format
 * @param string $date Date string
 * @param string $format Format string
 * @return string Formatted date
 */
function formatDate($date, $format = 'M d, Y h:i A') {
    if (empty($date)) {
        return '';
    }
    return date($format, strtotime($date));
}

/**
 * Get time ago string (e.g., "2 hours ago")
 * @param string $date Date string
 * @return string Time ago string
 */
function timeAgo($date) {
    $time = strtotime($date);
    $diff = time() - $time;
    
    if ($diff < 60) {
        return 'just now';
    } elseif ($diff < 3600) {
        return floor($diff / 60) . ' minutes ago';
    } elseif ($diff < 86400) {
        return floor($diff / 3600) . ' hours ago';
    } elseif ($diff < 604800) {
        return floor($diff / 86400) . ' days ago';
    } else {
        return formatDate($date, 'M d, Y');
    }
}

/**
 * Generate unique filename
 * @param string $filename Original filename
 * @return string Unique filename
 */
function generateUniqueFilename($filename) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $name = pathinfo($filename, PATHINFO_FILENAME);
    return $name . '_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
}

/**
 * Format file size
 * @param int $bytes File size in bytes
 * @return string Formatted file size
 */
function formatFileSize($bytes) {
    $units = array('B', 'KB', 'MB', 'GB');
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= (1 << (10 * $pow));
    
    return round($bytes, 2) . ' ' . $units[$pow];
}

/**
 * Check if uploaded file is valid image
 * @param string $filename Filename
 * @param string $mimeType MIME type
 * @return bool True if valid image
 */
function isValidImage($filename, $mimeType) {
    $allowed_ext = array('jpg', 'jpeg', 'png', 'gif', 'webp');
    $allowed_mime = array('image/jpeg', 'image/png', 'image/gif', 'image/webp');
    
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    return in_array($ext, $allowed_ext) && in_array($mimeType, $allowed_mime);
}

/**
 * Check if uploaded file is valid PDF
 * @param string $filename Filename
 * @param string $mimeType MIME type
 * @return bool True if valid PDF
 */
function isValidPDF($filename, $mimeType) {
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    return $ext === 'pdf' && $mimeType === 'application/pdf';
}

/**
 * Get placeholder image URL
 * @param int $width Width in pixels
 * @param int $height Height in pixels
 * @param string $text Text for placeholder
 * @return string Placeholder image URL
 */
function getPlaceholderImage($width = 400, $height = 300, $text = 'Image') {
    return "https://via.placeholder.com/{$width}x{$height}?text=" . urlencode($text);
}

/**
 * Validate email
 * @param string $email Email to validate
 * @return bool True if valid email
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Get MIME type from file
 * @param string $file File path
 * @return string MIME type
 */
function getMimeType($file) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file);
    finfo_close($finfo);
    return $mime;
}

?>
