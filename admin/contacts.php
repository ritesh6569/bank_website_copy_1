<?php
/**
 * Admin Contact Submissions Manager
 * View, manage, and reply to contact form submissions
 */

// Start session FIRST
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load configuration and dependencies
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$page_title = 'Contact Submissions - ' . SITE_NAME;
$success_message = '';
$error_message = '';
$contact_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

// Handle reply submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'reply' && $contact_id) {
        $reply_message = trim($_POST['reply_message'] ?? '');
        
        if (empty($reply_message)) {
            $error_message = 'Reply message cannot be empty.';
        } else {
            try {
                // Get contact submission
                $contact = fetchOne(
                    "SELECT email, name FROM contact_submissions WHERE id = ?",
                    [$contact_id]
                );
                
                if (!$contact) {
                    $error_message = 'Contact submission not found.';
                } else {
                    // Send email reply
                    $to = $contact['email'];
                    $subject = 'RE: Your Contact Inquiry - ' . SITE_NAME;
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
                    $headers .= "From: " . SITE_EMAIL . "\r\n";
                    
                    $body = '<html><body>';
                    $body .= '<p>Dear ' . escape($contact['name']) . ',</p>';
                    $body .= '<p>Thank you for contacting us. Here is our response:</p>';
                    $body .= '<div style="background: #f0f0f0; padding: 15px; margin: 15px 0; border-left: 4px solid #3b82f6;">';
                    $body .= nl2br(escape($reply_message));
                    $body .= '</div>';
                    $body .= '<p>Best regards,<br>' . SITE_NAME . ' Team</p>';
                    $body .= '</body></html>';
                    
                    // Send email
                    $mail_sent = mail($to, $subject, $body, $headers);
                    
                    if ($mail_sent) {
                        // Update contact submission status
                        $current_admin = getCurrentAdmin();
                        $query = "UPDATE contact_submissions 
                                 SET status = 'replied', 
                                     admin_reply = ?, 
                                     admin_reply_by = ?,
                                     admin_reply_at = NOW(),
                                     updated_at = NOW()
                                 WHERE id = ?";
                        $pdo = getDBConnection();
                        $stmt = $pdo->prepare($query);
                        $stmt->execute([$reply_message, $current_admin['id'], $contact_id]);
                        
                        $success_message = 'Reply sent successfully to ' . $contact['email'];
                        $contact_id = null; // Clear contact_id to show list
                    } else {
                        $error_message = 'Failed to send email. Please try again.';
                    }
                }
            } catch (Exception $e) {
                error_log('Error sending reply: ' . $e->getMessage());
                $error_message = 'Error processing your request: ' . $e->getMessage();
            }
        }
    }
    
    // Handle delete
    if ($_POST['action'] === 'delete' && isset($_POST['id'])) {
        $delete_id = (int)$_POST['id'];
        try {
            $query = "DELETE FROM contact_submissions WHERE id = ?";
            $pdo = getDBConnection();
            $stmt = $pdo->prepare($query);
            $stmt->execute([$delete_id]);
            $success_message = 'Contact submission deleted successfully.';
        } catch (Exception $e) {
            error_log('Error deleting submission: ' . $e->getMessage());
            $error_message = 'Error deleting submission.';
        }
    }
    
    // Handle archive
    if ($_POST['action'] === 'archive' && isset($_POST['id'])) {
        $archive_id = (int)$_POST['id'];
        try {
            $query = "UPDATE contact_submissions SET status = 'archived' WHERE id = ?";
            $pdo = getDBConnection();
            $stmt = $pdo->prepare($query);
            $stmt->execute([$archive_id]);
            $success_message = 'Contact submission archived.';
        } catch (Exception $e) {
            error_log('Error archiving submission: ' . $e->getMessage());
            $error_message = 'Error archiving submission.';
        }
    }
}

// Get submission details if viewing a specific contact
$current_contact = null;
if ($contact_id) {
    try {
        $current_contact = fetchOne(
            "SELECT * FROM contact_submissions WHERE id = ?",
            [$contact_id]
        );
    } catch (Exception $e) {
        error_log('Error fetching contact: ' . $e->getMessage());
    }
}

// Get list of contacts
$filter_status = $_GET['status'] ?? 'all';
$search_query = $_GET['search'] ?? '';

try {
    // Check if table exists
    $pdo = getDBConnection();
    $table_check = $pdo->query("SHOW TABLES LIKE 'contact_submissions'");
    
    if ($table_check->rowCount() > 0) {
        $query = "SELECT * FROM contact_submissions WHERE 1=1";
        $params = [];
        
        if ($filter_status !== 'all') {
            $query .= " AND status = ?";
            $params[] = $filter_status;
        }
        
        if (!empty($search_query)) {
            $query .= " AND (name LIKE ? OR email LIKE ? OR subject LIKE ?)";
            $search_param = '%' . $search_query . '%';
            $params[] = $search_param;
            $params[] = $search_param;
            $params[] = $search_param;
        }
        
        $query .= " ORDER BY created_at DESC";
        
        $contacts = fetchAll($query, $params);
    } else {
        $contacts = [];
    }
} catch (Exception $e) {
    error_log('Error fetching contacts: ' . $e->getMessage());
    $contacts = [];
}

// Count submissions by status
$stats = [];
try {
    // First check if table exists
    $pdo = getDBConnection();
    $table_check = $pdo->query("SHOW TABLES LIKE 'contact_submissions'");
    
    if ($table_check->rowCount() > 0) {
        $stats['new'] = fetchOne("SELECT COUNT(*) as count FROM contact_submissions WHERE status = 'new'")['count'] ?? 0;
        $stats['replied'] = fetchOne("SELECT COUNT(*) as count FROM contact_submissions WHERE status = 'replied'")['count'] ?? 0;
        $stats['archived'] = fetchOne("SELECT COUNT(*) as count FROM contact_submissions WHERE status = 'archived'")['count'] ?? 0;
        $stats['total'] = fetchOne("SELECT COUNT(*) as count FROM contact_submissions")['count'] ?? 0;
    } else {
        $stats = ['new' => 0, 'replied' => 0, 'archived' => 0, 'total' => 0];
    }
} catch (Exception $e) {
    // Stats may not be available if table doesn't exist yet
    $stats = ['new' => 0, 'replied' => 0, 'archived' => 0, 'total' => 0];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Roboto', sans-serif;
        }
        
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }
        
        .sidebar {
            width: 250px;
            background: #1A2533;
            padding: 2rem 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 4px 0 12px rgba(15,31,53,0.15);
        }
        
        .sidebar .nav-link {
            padding: 0.85rem 1.5rem;
            color: rgba(255,255,255,0.75) !important;
            border-left: 3px solid transparent;
            transition: all 0.2s ease;
        }
        
        .sidebar .nav-link:hover {
            background-color: #2C3E50;
            color: white !important;
            border-left-color: #B8860B;
        }
        
        .sidebar .nav-link.active {
            background-color: rgba(184,134,11,0.12);
            color: #B8860B !important;
            border-left-color: #B8860B;
            font-weight: 600;
        }
        
        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 2rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
            margin-bottom: 1rem;
        }
        
        .stat-card h6 {
            color: #6b7280;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }
        
        .stat-card .number {
            font-size: 2rem;
            font-weight: bold;
            color: #1e40af;
        }
        
        .contact-list-item {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }
        
        .contact-list-item:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-left-color: #3b82f6;
        }
        
        .contact-list-item.new {
            border-left-color: #ef4444;
            background-color: #fef2f2;
        }
        
        .contact-list-item.replied {
            border-left-color: #10b981;
        }
        
        .contact-list-item.archived {
            border-left-color: #9ca3af;
            opacity: 0.7;
        }
        
        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
        }
        
        .contact-detail {
            background: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .reply-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar Navigation -->
        <nav class="sidebar">
            <div class="sidebar-header mb-4 px-3">
                <div style="font-size: 1.2rem; font-weight: 800; color: white; padding-bottom: 1rem; border-bottom: 1px solid rgba(255,255,255,0.1);">
                    <i class="fas fa-university me-2" style="color: #B8860B;"></i>Admin Panel
                </div>
                <a href="<?php echo SITE_URL; ?>" class="d-block mt-3" style="color: rgba(255,255,255,0.65); font-size: 0.85rem; text-decoration: none;">
                    <i class="fas fa-arrow-left me-2"></i>Back to Site
                </a>
            </div>
            <ul class="nav flex-column px-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <i class="fas fa-chart-line me-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="contacts.php">
                        <i class="fas fa-envelope me-2"></i>Contact Submissions
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="downloads.php">
                        <i class="fas fa-download me-2"></i>Manage Downloads
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="notices.php">
                        <i class="fas fa-bullhorn me-2"></i>Manage Notices
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gallery.php">
                        <i class="fas fa-images me-2"></i>Manage Gallery
                    </a>
                </li>
                <hr style="border-color: rgba(255,255,255,0.1); margin: 0.75rem 0;">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <div class="container-fluid">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="mb-1">Contact Submissions</h1>
                        <p class="text-muted mb-0">Manage customer inquiries and send replies</p>
                    </div>
                </div>

                <!-- Alerts -->
                <?php if ($success_message): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i><?php echo $success_message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if ($error_message): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i><?php echo $error_message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- View Details or List -->
                <?php if ($current_contact && $contact_id): ?>
                    <!-- Contact Detail View -->
                    <div class="contact-detail">
                        <div class="mb-3">
                            <a href="contacts.php" class="btn btn-sm btn-outline-secondary mb-3">
                                <i class="fas fa-arrow-left me-2"></i> Back to List
                            </a>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5 class="text-muted mb-3">Contact Information</h5>
                                <dl class="row">
                                    <dt class="col-sm-4">Name:</dt>
                                    <dd class="col-sm-8"><?php echo escape($current_contact['name']); ?></dd>

                                    <dt class="col-sm-4">Email:</dt>
                                    <dd class="col-sm-8">
                                        <a href="mailto:<?php echo escape($current_contact['email']); ?>">
                                            <?php echo escape($current_contact['email']); ?>
                                        </a>
                                    </dd>

                                    <dt class="col-sm-4">Phone:</dt>
                                    <dd class="col-sm-8">
                                        <?php echo !empty($current_contact['phone']) ? escape($current_contact['phone']) : '<em class="text-muted">Not provided</em>'; ?>
                                    </dd>

                                    <dt class="col-sm-4">Subject:</dt>
                                    <dd class="col-sm-8"><?php echo escape($current_contact['subject']); ?></dd>

                                    <dt class="col-sm-4">Submitted:</dt>
                                    <dd class="col-sm-8"><?php echo formatDate($current_contact['created_at']); ?></dd>

                                    <dt class="col-sm-4">Status:</dt>
                                    <dd class="col-sm-8">
                                        <?php
                                        $status_badge_class = 'warning';
                                        $status_text = 'New';
                                        if ($current_contact['status'] === 'replied') {
                                            $status_badge_class = 'success';
                                            $status_text = 'Replied';
                                        } elseif ($current_contact['status'] === 'archived') {
                                            $status_badge_class = 'secondary';
                                            $status_text = 'Archived';
                                        }
                                        ?>
                                        <span class="badge bg-<?php echo $status_badge_class; ?>"><?php echo $status_text; ?></span>
                                    </dd>
                                </dl>
                            </div>

                            <div class="col-md-6">
                                <h5 class="text-muted mb-3">Actions</h5>
                                <form method="POST" class="d-grid gap-2">
                                    <input type="hidden" name="id" value="<?php echo $contact_id; ?>">
                                    <?php if ($current_contact['status'] !== 'archived'): ?>
                                        <button type="submit" name="action" value="archive" class="btn btn-warning btn-sm">
                                            <i class="fas fa-archive me-2"></i> Archive
                                        </button>
                                    <?php endif; ?>
                                    <button type="submit" name="action" value="delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash me-2"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="text-muted mb-3">Message</h5>
                            <div style="background: #f9fafb; padding: 1rem; border-radius: 8px; border-left: 4px solid #3b82f6;">
                                <?php echo nl2br(escape($current_contact['message'])); ?>
                            </div>
                        </div>

                        <!-- Previous Reply (if exists) -->
                        <?php if (!empty($current_contact['admin_reply'])): ?>
                            <div class="mb-4">
                                <h5 class="text-muted mb-3">Your Previous Reply</h5>
                                <div style="background: #f0fdf4; padding: 1rem; border-radius: 8px; border-left: 4px solid #10b981;">
                                    <small class="text-muted d-block mb-2">
                                        Sent on <?php echo formatDate($current_contact['admin_reply_at']); ?>
                                    </small>
                                    <?php echo nl2br(escape($current_contact['admin_reply'])); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Reply Form -->
                        <?php if ($current_contact['status'] !== 'archived'): ?>
                            <div class="reply-box">
                                <h5 class="mb-3">
                                    <i class="fas fa-reply me-2"></i> Send Reply
                                </h5>
                                <form method="POST">
                                    <input type="hidden" name="action" value="reply">
                                    <input type="hidden" name="id" value="<?php echo $contact_id; ?>">
                                    
                                    <div class="mb-3">
                                        <label for="reply_message" class="form-label">Your Reply *</label>
                                        <textarea class="form-control" id="reply_message" name="reply_message" rows="6" required placeholder="Type your reply here..."></textarea>
                                        <small class="text-muted">A response email will be sent to <?php echo escape($current_contact['email']); ?></small>
                                    </div>

                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane me-2"></i> Send Reply
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <!-- Contact List View -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="stat-card">
                                <h6><i class="fas fa-inbox me-2"></i> Total Submissions</h6>
                                <div class="number"><?php echo $stats['total'] ?? 0; ?></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <h6><i class="fas fa-star me-2"></i> New Inquiries</h6>
                                <div class="number" style="color: #ef4444;"><?php echo $stats['new'] ?? 0; ?></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <h6><i class="fas fa-check-circle me-2"></i> Replied</h6>
                                <div class="number" style="color: #10b981;"><?php echo $stats['replied'] ?? 0; ?></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <h6><i class="fas fa-archive me-2"></i> Archived</h6>
                                <div class="number" style="color: #6b7280;"><?php echo $stats['archived'] ?? 0; ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters and Search -->
                    <div class="card mb-4" style="background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <div class="card-body">
                            <form method="GET" class="row g-3">
                                <div class="col-md-6">
                                    <label for="search" class="form-label">Search</label>
                                    <input type="text" class="form-control" id="search" name="search" 
                                           placeholder="Search by name, email, or subject..." 
                                           value="<?php echo escape($search_query); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="all" <?php echo $filter_status === 'all' ? 'selected' : ''; ?>>All Statuses</option>
                                        <option value="new" <?php echo $filter_status === 'new' ? 'selected' : ''; ?>>New</option>
                                        <option value="replied" <?php echo $filter_status === 'replied' ? 'selected' : ''; ?>>Replied</option>
                                        <option value="archived" <?php echo $filter_status === 'archived' ? 'selected' : ''; ?>>Archived</option>
                                    </select>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-search me-2"></i> Filter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Contact List -->
                    <div>
                        <?php if (empty($contacts)): ?>
                            <div style="text-align: center; padding: 3rem;">
                                <i class="fas fa-inbox" style="font-size: 3rem; color: #d1d5db; margin-bottom: 1rem; display: block;"></i>
                                <p class="text-muted">No contact submissions found.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($contacts as $contact): ?>
                                <div class="contact-list-item <?php echo $contact['status']; ?>" onclick="window.location='contacts.php?id=<?php echo $contact['id']; ?>'">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div style="flex: 1;">
                                            <h6 class="mb-1">
                                                <?php echo escape($contact['name']); ?>
                                                <?php if ($contact['status'] === 'new'): ?>
                                                    <span class="badge bg-danger">NEW</span>
                                                <?php endif; ?>
                                            </h6>
                                            <p class="text-muted mb-2 small">
                                                <i class="fas fa-envelope me-2"></i><?php echo escape($contact['email']); ?>
                                            </p>
                                            <p class="mb-1">
                                                <strong><?php echo escape($contact['subject']); ?></strong>
                                            </p>
                                            <p class="text-muted small mb-0">
                                                <?php 
                                                $preview = substr(strip_tags($contact['message']), 0, 100);
                                                echo escape($preview) . (strlen($contact['message']) > 100 ? '...' : '');
                                                ?>
                                            </p>
                                        </div>
                                        <div style="text-align: right; margin-left: 1rem;">
                                            <small class="text-muted d-block mb-2">
                                                <?php 
                                                $time_ago = timeAgo($contact['created_at']);
                                                echo $time_ago;
                                                ?>
                                            </small>
                                            <?php
                                            $status_badge_class = 'warning';
                                            $status_text = 'New';
                                            if ($contact['status'] === 'replied') {
                                                $status_badge_class = 'success';
                                                $status_text = 'Replied';
                                            } elseif ($contact['status'] === 'archived') {
                                                $status_badge_class = 'secondary';
                                                $status_text = 'Archived';
                                            }
                                            ?>
                                            <span class="badge bg-<?php echo $status_badge_class; ?> status-badge">
                                                <?php echo $status_text; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
