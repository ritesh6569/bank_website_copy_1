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
require_once __DIR__ . '/../includes/mailer.php';

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
                    // Build branded HTML email body
                    $emailContent = '
                        <p>Thank you for contacting us. Here is our response to your inquiry:</p>
                        <div class="content-box">' . nl2br(htmlspecialchars($reply_message, ENT_QUOTES, 'UTF-8')) . '</div>
                        <p>If you have any further questions, please do not hesitate to contact us.</p>
                    ';
                    $emailBody = buildEmailTemplate(
                        htmlspecialchars($contact['name']),
                        $emailContent,
                        '<p>This is a reply to your inquiry submitted at <a href="' . SITE_URL . '">' . SITE_WEBSITE . '</a></p>'
                    );

                    // Send via PHPMailer SMTP
                    $result = sendMail(
                        $contact['email'],
                        'RE: Your Contact Inquiry â€” ' . SITE_NAME_SHORT,
                        $emailBody,
                        SITE_EMAIL,        // Reply-To
                        $contact['name']   // Recipient display name
                    );

                    if ($result['success']) {
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
                        $contact_id = null; // Return to list view
                    } else {
                        $error_message = 'Failed to send email: ' . $result['error'];
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
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/admin-responsive.css">
    <style>
        body { background-color: #f0f4f8; font-family: 'Roboto', sans-serif; }

        .admin-wrapper { display: flex; min-height: 100vh; }

        .sidebar {
            width: 250px; background: #1A2533; padding: 2rem 0;
            position: fixed; height: 100vh; overflow-y: auto;
            box-shadow: 4px 0 12px rgba(15,31,53,0.15);
        }
        .sidebar .nav-link {
            padding: 0.85rem 1.5rem; color: rgba(255,255,255,0.75) !important;
            border-left: 3px solid transparent; transition: all 0.2s ease;
        }
        .sidebar .nav-link:hover { background:#2C3E50; color:white !important; border-left-color:#B8860B; }
        .sidebar .nav-link.active {
            background: rgba(184,134,11,0.12); color: #B8860B !important;
            border-left-color: #B8860B; font-weight: 600;
        }

        .main-content { margin-left: 250px; width: calc(100% - 250px); padding: 2rem; }

        /* â”€â”€ Stat Cards â”€â”€ */
        .stat-card {
            border-radius: 12px; padding: 1.4rem 1.2rem;
            text-align: center; border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-2px); }
        .stat-card .sc-icon { font-size: 1.6rem; margin-bottom: 0.5rem; }
        .stat-card .sc-num { font-size: 2rem; font-weight: 800; line-height: 1; }
        .stat-card .sc-label { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-top: 0.3rem; }

        .sc-total   { background: linear-gradient(135deg,#0D3D2E,#1A5C42); color: white; }
        .sc-new     { background: linear-gradient(135deg,#1e3a6e,#2563eb); color: white; }
        .sc-replied { background: linear-gradient(135deg,#065f46,#059669); color: white; }
        .sc-archived{ background: linear-gradient(135deg,#374151,#6b7280); color: white; }

        /* â”€â”€ Contact Grid Cards â”€â”€ */
        .contact-grid { display:none; } /* unused, kept for safety */

        /* â”€â”€ Submission List â”€â”€ */
        .sub-list { display: flex; flex-direction: column; gap: 0; }

        .sub-row {
            display: flex; align-items: center; gap: 1rem;
            padding: 0.85rem 1.2rem;
            border-bottom: 1px solid #f0f3f8;
            cursor: pointer;
            transition: background 0.14s;
            background: white;
            text-decoration: none; color: inherit;
        }
        .sub-row:last-child { border-bottom: none; }
        .sub-row:hover { background: #f5f8ff; }
        .sub-row.is-new { background: #f7f9ff; }
        .sub-row.is-new:hover { background: #edf2ff; }
        .sub-row.is-complaint { background: #fdfaf2; }
        .sub-row.is-complaint:hover { background: #faf4e0; }
        .sub-row.is-archived { opacity: 0.58; }

        /* Avatar circle */
        .sub-avatar {
            width: 38px; height: 38px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.9rem; font-weight: 700; color: white;
            flex-shrink: 0; letter-spacing: 0.02em;
        }

        /* Unread dot */
        .sub-unread-dot {
            width: 7px; height: 7px; border-radius: 50%;
            background: #1A5C42; flex-shrink: 0;
        }
        .sub-unread-dot.hidden { background: transparent; }

        /* Main text block */
        .sub-body { flex: 1; min-width: 0; }
        .sub-top { display: flex; align-items: baseline; gap: 0.5rem; margin-bottom: 0.15rem; }
        .sub-name { font-weight: 700; font-size: 0.88rem; color: #111827; white-space: nowrap; }
        .sub-email { font-size: 0.75rem; color: #9ca3af; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .sub-subject-line {
            font-size: 0.83rem; color: #374151;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .sub-subject-line .sub-subject { font-weight: 600; color: #1e293b; }
        .sub-subject-line .sub-preview { color: #9ca3af; }

        /* Mobile meta line (status + time) â€” hidden on desktop */
        .sub-mobile-meta { display: none; }

        /* Right side */
        .sub-right { display: flex; flex-direction: column; align-items: flex-end; gap: 0.35rem; flex-shrink: 0; }
        .sub-time { font-size: 0.72rem; color: #9ca3af; white-space: nowrap; }

        .status-badge { font-size: 0.65rem; padding: 0.2rem 0.6rem; border-radius: 20px; font-weight: 600; }

        /* â”€â”€ Mobile: submission rows â”€â”€ */
        @media (max-width: 640px) {
            /* Row becomes a 2-col grid: [avatar] [content block] */
            .sub-row {
                display: grid !important;
                grid-template-columns: 36px 1fr;
                grid-template-rows: auto auto;
                column-gap: 0.65rem;
                row-gap: 0.3rem;
                padding: 0.7rem 0.85rem;
                align-items: start;
            }

            /* Avatar â€” row 1, col 1 */
            .sub-avatar {
                grid-column: 1; grid-row: 1;
                width: 34px !important; height: 34px !important;
                font-size: 0.76rem !important;
                align-self: center;
            }

            /* Unread dot â€” hide it (status badge replaces it) */
            .sub-unread-dot { display: none !important; }

            /* Name column (inline flex:0 0 180px) â€” row 1, col 2 */
            .sub-row > div[style*="flex:0 0 180px"],
            .sub-row > div[style*="flex: 0 0 180px"] {
                grid-column: 2; grid-row: 1;
                flex: unset !important;
                min-width: 0;
                display: flex;
                align-items: baseline;
                gap: 0.4rem;
                flex-wrap: wrap;
            }

            /* Subject body â€” row 2, col 2 */
            .sub-body {
                grid-column: 2; grid-row: 2;
                min-width: 0;
            }
            .sub-subject-line {
                white-space: normal !important;
                overflow: visible !important;
                text-overflow: unset !important;
                font-size: 0.79rem;
            }
            .sub-preview { display: none; } /* hide preview on mobile to save space */

            /* Status badge â€” hide separate status div, show inline in subject line via badge */
            .sub-row > div[style*="flex:0 0 80px"],
            .sub-row > div[style*="flex: 0 0 80px"] {
                display: none !important;
            }

            /* Time â€” hide in separate div; shown inline via name row */
            .sub-row > .sub-time[style*="flex:0 0 70px"],
            .sub-row > div[style*="flex:0 0 70px"],
            .sub-row > div[style*="flex: 0 0 70px"] {
                display: none !important;
            }

            /* Name text */
            .sub-name { font-size: 0.84rem; white-space: normal !important; }
            .sub-email { font-size: 0.7rem; white-space: normal !important; }

            /* Show mobile meta line */
            .sub-mobile-meta {
                display: flex !important;
                align-items: center;
                gap: 0.5rem;
                margin-top: 0.3rem;
            }
            .sub-mobile-meta .sub-time {
                font-size: 0.69rem;
                color: #9ca3af;
            }
        }

        .complaint-pill {
            display: inline-block; background: #B8860B; color: white;
            font-size: 0.62rem; font-weight: 700; padding: 0.18rem 0.5rem;
            border-radius: 3px; letter-spacing: 0.05em; vertical-align: middle;
        }

        /* â”€â”€ Detail View â”€â”€ */
        .detail-page-wrap { max-width: 820px; margin: 0 auto; }

        .detail-hero {
            border-radius: 10px; padding: 1.6rem 2rem;
            color: white; margin-bottom: 1.5rem;
            background: linear-gradient(135deg,#0A3020,#1A5C42);
            box-shadow: 0 3px 14px rgba(15,44,94,0.18);
        }
        .detail-hero h5 { font-weight: 700; margin-bottom: 0.2rem; font-size: 1.05rem; }
        .detail-hero .hero-subject {
            font-size: 0.88rem; opacity: 0.80; font-weight: 400;
            word-break: break-word; margin-top: 0.15rem;
        }
        .hero-status-pill {
            font-size: 0.72rem; padding: 0.28rem 0.8rem; border-radius: 20px;
            background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.3);
            color: white; font-weight: 600; white-space: nowrap;
        }

        .detail-card {
            background: white; border-radius: 10px;
            box-shadow: 0 1px 6px rgba(0,0,0,0.07);
            border: 1px solid #e5e9f0;
            margin-bottom: 1.1rem; overflow: hidden;
        }
        .detail-card-header {
            padding: 0.75rem 1.3rem;
            border-bottom: 1px solid #f0f2f5;
            background: #f8f9fb;
            font-size: 0.75rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.07em; color: #4b5563;
        }
        .detail-card-body { padding: 1.2rem 1.3rem; }

        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        @media (max-width: 576px) { .info-grid { grid-template-columns: 1fr; } }
        .info-label {
            font-size: 0.69rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.06em; color: #9ca3af; margin-bottom: 0.18rem;
        }
        .info-value {
            font-size: 0.93rem; color: #111827; font-weight: 500; word-break: break-word;
        }
        .info-value a { color: #1A5C42; text-decoration: none; }
        .info-value a:hover { text-decoration: underline; }

        .msg-box {
            background: #f4f7ff; padding: 1.1rem 1.3rem; border-radius: 7px;
            border-left: 4px solid #1A5C42; white-space: pre-wrap;
            font-size: 0.93rem; line-height: 1.75; color: #1e293b;
        }
        .msg-box.complaint-msg {
            background: #fdfaf2; border-left-color: #B8860B; color: #3b2a00;
        }
        .reply-history-box {
            background: #f0fdf6; padding: 1.1rem 1.3rem; border-radius: 7px;
            border-left: 4px solid #059669; font-size: 0.93rem;
            line-height: 1.75; color: #1e293b;
        }
        .reply-meta {
            font-size: 0.76rem; color: #6b7280; margin-bottom: 0.6rem;
        }

        .reply-form-card {
            background: white; border-radius: 10px;
            border: 1px solid #e5e9f0;
            box-shadow: 0 1px 6px rgba(0,0,0,0.07);
            margin-bottom: 1.1rem; overflow: hidden;
        }
        .reply-form-header {
            padding: 0.8rem 1.3rem;
            background: #f8f9fb; border-bottom: 1px solid #f0f2f5;
            font-size: 0.75rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.07em; color: #4b5563;
        }
        .reply-form-body { padding: 1.3rem; }

        .action-card {
            background: white; border-radius: 10px;
            border: 1px solid #e5e9f0;
            box-shadow: 0 1px 6px rgba(0,0,0,0.07);
            margin-bottom: 1.1rem; overflow: hidden;
        }
        .action-card-header {
            padding: 0.75rem 1.3rem; background: #f8f9fb;
            border-bottom: 1px solid #f0f2f5;
            font-size: 0.75rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.07em; color: #4b5563;
        }
        .action-card-body { padding: 1.1rem 1.3rem; display: grid; gap: 0.55rem; }

        .complaint-tag {
            display: inline-block; background: #B8860B; color: white;
            font-size: 0.67rem; font-weight: 700; padding: 0.2rem 0.6rem;
            border-radius: 4px; letter-spacing: 0.05em;
        }
    </style>
</head>
<body>
    <!-- Hamburger Toggle (mobile) -->
    <button class="hamburger-btn" id="sidebarToggle" aria-label="Toggle menu">
        <i class="fas fa-bars"></i>
    </button>
    <!-- Overlay backdrop -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="admin-wrapper">
        <!-- Sidebar Navigation -->
        <nav class="sidebar" id="adminSidebar">
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
                <li class="nav-item">
                    <a class="nav-link" href="rates.php">
                        <i class="fas fa-percent me-2"></i>Interest Rates
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
                <?php if ($current_contact && $contact_id):
                    $isComplaint = str_starts_with($current_contact['subject'], '[Complaint]');
                    $statusLabel = $current_contact['status'] === 'replied' ? 'Replied'
                        : ($current_contact['status'] === 'archived' ? 'Archived' : 'New');
                ?>
                    <div class="detail-page-wrap">

                        <!-- Back -->
                        <a href="contacts.php" class="btn btn-sm btn-outline-secondary mb-3">
                            <i class="fas fa-arrow-left me-2"></i>Back to All Submissions
                        </a>

                        <!-- Header bar â€” navy for all, gold left accent for complaints -->
                        <div class="detail-hero" style="<?php echo $isComplaint ? 'border-left:5px solid #B8860B;' : 'border-left:5px solid rgba(255,255,255,0.3);'; ?>">
                            <div class="d-flex align-items-start justify-content-between gap-3">
                                <div>
                                    <h5>
                                        <?php if ($isComplaint): ?>
                                            <span class="complaint-tag me-2">COMPLAINT</span>
                                        <?php endif; ?>
                                        <?php echo escape($current_contact['subject']); ?>
                                    </h5>
                                    <div class="hero-subject">
                                        From <strong><?php echo escape($current_contact['name']); ?></strong>
                                        &nbsp;&middot;&nbsp; <?php echo formatDate($current_contact['created_at']); ?>
                                    </div>
                                </div>
                                <span class="hero-status-pill flex-shrink-0"><?php echo $statusLabel; ?></span>
                            </div>
                        </div>

                        <div class="row g-3">
                            <!-- Left: sender info + message + reply history + reply form -->
                            <div class="col-lg-8">

                                <!-- Sender Info -->
                                <div class="detail-card">
                                    <div class="detail-card-header">Sender Information</div>
                                    <div class="detail-card-body">
                                        <div class="info-grid">
                                            <div>
                                                <div class="info-label">Full Name</div>
                                                <div class="info-value"><?php echo escape($current_contact['name']); ?></div>
                                            </div>
                                            <div>
                                                <div class="info-label">Email</div>
                                                <div class="info-value">
                                                    <a href="mailto:<?php echo escape($current_contact['email']); ?>">
                                                        <?php echo escape($current_contact['email']); ?>
                                                    </a>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="info-label">Phone</div>
                                                <div class="info-value">
                                                    <?php echo !empty($current_contact['phone'])
                                                        ? '<a href="tel:' . escape($current_contact['phone']) . '">' . escape($current_contact['phone']) . '</a>'
                                                        : '<span class="text-muted" style="font-size:0.87rem;">Not provided</span>'; ?>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="info-label">Submitted</div>
                                                <div class="info-value"><?php echo formatDate($current_contact['created_at']); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Message -->
                                <div class="detail-card">
                                    <div class="detail-card-header"><?php echo $isComplaint ? 'Complaint Message' : 'Message'; ?></div>
                                    <div class="detail-card-body">
                                        <div class="msg-box<?php echo $isComplaint ? ' complaint-msg' : ''; ?>">
                                            <?php echo nl2br(escape($current_contact['message'])); ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Previous Reply -->
                                <?php if (!empty($current_contact['admin_reply'])): ?>
                                <div class="detail-card">
                                    <div class="detail-card-header">Previous Reply</div>
                                    <div class="detail-card-body">
                                        <div class="reply-meta">Sent on <?php echo formatDate($current_contact['admin_reply_at']); ?></div>
                                        <div class="reply-history-box">
                                            <?php echo nl2br(escape($current_contact['admin_reply'])); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <!-- Reply Form -->
                                <?php if ($current_contact['status'] !== 'archived'): ?>
                                <div class="reply-form-card">
                                    <div class="reply-form-header">Send Reply &rarr; <?php echo escape($current_contact['email']); ?></div>
                                    <div class="reply-form-body">
                                        <form method="POST">
                                            <input type="hidden" name="action" value="reply">
                                            <input type="hidden" name="id" value="<?php echo $contact_id; ?>">
                                            <div class="mb-3">
                                                <textarea class="form-control" name="reply_message" rows="6" required
                                                    placeholder="Type your reply hereâ€¦"
                                                    style="font-size:0.93rem; resize:vertical;"></textarea>
                                                <small class="text-muted mt-1 d-block">An email will be sent to the customer automatically.</small>
                                            </div>
                                            <button type="submit" class="btn text-white px-4"
                                                style="background:linear-gradient(135deg,#0D3D2E,#1A5C42); border:none;">
                                                <i class="fas fa-paper-plane me-2"></i>Send Reply
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <?php endif; ?>

                            </div>

                            <!-- Right: status + actions -->
                            <div class="col-lg-4">

                                <!-- Status -->
                                <div class="detail-card">
                                    <div class="detail-card-header">Status</div>
                                    <div class="detail-card-body">
                                        <?php
                                        $sc = $current_contact['status'] === 'replied' ? '#059669'
                                            : ($current_contact['status'] === 'archived' ? '#6b7280' : '#1A5C42');
                                        $sb = $current_contact['status'] === 'replied' ? '#f0fdf6'
                                            : ($current_contact['status'] === 'archived' ? '#f9fafb' : '#f0f6ff');
                                        ?>
                                        <div style="background:<?php echo $sb; ?>; border-left:4px solid <?php echo $sc; ?>;
                                            border-radius:7px; padding:0.8rem 1rem; border:1px solid <?php echo $sc; ?>22;">
                                            <div style="color:<?php echo $sc; ?>; font-weight:700; font-size:0.85rem;">
                                                <?php echo strtoupper($statusLabel); ?>
                                            </div>
                                            <div class="text-muted mt-1" style="font-size:0.76rem;">
                                                #<?php echo $current_contact['id']; ?> &middot; <?php echo timeAgo($current_contact['created_at']); ?>
                                            </div>
                                        </div>
                                        <?php if ($isComplaint): ?>
                                        <div class="mt-2" style="background:#fdfaf2; border-left:4px solid #B8860B;
                                            border-radius:7px; padding:0.7rem 1rem; border:1px solid #e2c97e55;">
                                            <div style="color:#92400e; font-weight:700; font-size:0.78rem;">
                                                FLAGGED AS COMPLAINT
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="action-card">
                                    <div class="action-card-header">Actions</div>
                                    <div class="action-card-body">
                                        <form method="POST">
                                            <input type="hidden" name="id" value="<?php echo $contact_id; ?>">
                                            <?php if ($current_contact['status'] !== 'archived'): ?>
                                            <button type="submit" name="action" value="archive"
                                                class="btn btn-sm w-100"
                                                style="background:#fef9ec; color:#92400e; border:1px solid #e2c97e; font-weight:600;">
                                                Archive
                                            </button>
                                            <?php endif; ?>
                                            <button type="submit" name="action" value="delete"
                                                class="btn btn-sm w-100 btn-outline-danger"
                                                onclick="return confirm('Permanently delete this submission?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Submission Info -->
                                <div class="detail-card">
                                    <div class="detail-card-header">Details</div>
                                    <div class="detail-card-body" style="display:grid; gap:0.8rem;">
                                        <div>
                                            <div class="info-label">Type</div>
                                            <div class="info-value">
                                                <?php echo $isComplaint
                                                    ? '<span class="complaint-tag">Complaint</span>'
                                                    : '<span style="color:#1A5C42; font-weight:600;">Contact Query</span>'; ?>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="info-label">Submission ID</div>
                                            <div class="info-value">#<?php echo $current_contact['id']; ?></div>
                                        </div>
                                        <?php if (!empty($current_contact['admin_reply_at'])): ?>
                                        <div>
                                            <div class="info-label">Last Replied</div>
                                            <div class="info-value" style="font-size:0.87rem;"><?php echo formatDate($current_contact['admin_reply_at']); ?></div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div><!-- /detail-page-wrap -->
                <?php else: ?>
                    <!-- Stats -->
                    <div class="row g-3 mb-4">
                        <div class="col-6 col-md-3">
                            <div class="stat-card sc-total">
                                <div class="sc-icon"><i class="fas fa-inbox"></i></div>
                                <div class="sc-num"><?php echo $stats['total'] ?? 0; ?></div>
                                <div class="sc-label">Total</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="stat-card sc-new">
                                <div class="sc-icon"><i class="fas fa-bell"></i></div>
                                <div class="sc-num"><?php echo $stats['new'] ?? 0; ?></div>
                                <div class="sc-label">New</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="stat-card sc-replied">
                                <div class="sc-icon"><i class="fas fa-check-circle"></i></div>
                                <div class="sc-num"><?php echo $stats['replied'] ?? 0; ?></div>
                                <div class="sc-label">Replied</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="stat-card sc-archived">
                                <div class="sc-icon"><i class="fas fa-archive"></i></div>
                                <div class="sc-num"><?php echo $stats['archived'] ?? 0; ?></div>
                                <div class="sc-label">Archived</div>
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

                    <!-- Submission List -->
                    <div style="background:white; border-radius:10px; border:1px solid #e2e8f0; box-shadow:0 1px 8px rgba(0,0,0,0.06); overflow:hidden;">
                        <?php if (empty($contacts)): ?>
                            <div style="padding:3.5rem 1rem; text-align:center;">
                                <i class="fas fa-inbox" style="font-size:2.6rem; color:#d1d5db; display:block; margin-bottom:0.8rem;"></i>
                                <p class="text-muted mb-0" style="font-size:0.9rem;">No contact submissions found.</p>
                            </div>
                        <?php else: ?>
                            <!-- List header -->
                            <div style="padding:0.65rem 1.2rem; background:#f8fafc; border-bottom:1px solid #e8edf5; display:flex; align-items:center; gap:1rem;">
                                <div style="width:38px; flex-shrink:0;"></div>
                                <div style="width:7px; flex-shrink:0;"></div>
                                <div style="flex:0 0 180px; font-size:0.68rem; font-weight:700; text-transform:uppercase; letter-spacing:.07em; color:#9ca3af;">From</div>
                                <div style="flex:1; font-size:0.68rem; font-weight:700; text-transform:uppercase; letter-spacing:.07em; color:#9ca3af;">Subject &amp; Preview</div>
                                <div style="flex:0 0 80px; text-align:center; font-size:0.68rem; font-weight:700; text-transform:uppercase; letter-spacing:.07em; color:#9ca3af;">Status</div>
                                <div style="flex:0 0 70px; text-align:right; font-size:0.68rem; font-weight:700; text-transform:uppercase; letter-spacing:.07em; color:#9ca3af;">Time</div>
                            </div>
                            <div class="sub-list">
                            <?php
                            $avatarColors = ['#1A5C42','#0369a1','#0f766e','#7c3aed','#b45309','#0D3D2E','#065f46'];
                            foreach ($contacts as $i => $contact):
                                $isComplaint = str_starts_with($contact['subject'], '[Complaint]');
                                $isNew       = $contact['status'] === 'new';
                                $rowClass    = ($isNew ? 'is-new' : '') . ($isComplaint ? ' is-complaint' : '') . ($contact['status'] === 'archived' ? ' is-archived' : '');
                                $badgeClass  = $contact['status'] === 'replied' ? 'success' : ($contact['status'] === 'archived' ? 'secondary' : 'primary');
                                $badgeText   = $contact['status'] === 'replied' ? 'Replied' : ($contact['status'] === 'archived' ? 'Archived' : 'New');
                                $avatarBg    = $isComplaint ? '#92400e' : $avatarColors[$i % count($avatarColors)];
                                $initials    = strtoupper(substr($contact['name'], 0, 1));
                                if (strpos($contact['name'], ' ') !== false) {
                                    $parts = explode(' ', $contact['name']);
                                    $initials = strtoupper(substr($parts[0],0,1) . substr(end($parts),0,1));
                                }
                                $displaySubject = $isComplaint
                                    ? trim(substr($contact['subject'], strlen('[Complaint]')))
                                    : $contact['subject'];
                                $preview = substr(strip_tags($contact['message']), 0, 70);
                            ?>
                                <div class="sub-row <?php echo trim($rowClass); ?>" onclick="window.location='contacts.php?id=<?php echo $contact['id']; ?>'">
                                    <!-- Avatar -->
                                    <div class="sub-avatar" style="background:<?php echo $avatarBg; ?>;"><?php echo $initials; ?></div>
                                    <!-- Unread indicator -->
                                    <div class="sub-unread-dot <?php echo $isNew ? '' : 'hidden'; ?>" style="<?php echo $isComplaint && $isNew ? 'background:#B8860B;' : ''; ?>"></div>
                                    <!-- From -->
                                    <div style="flex:0 0 180px; min-width:0;">
                                        <div class="sub-name"><?php echo escape($contact['name']); ?></div>
                                        <div class="sub-email"><?php echo escape($contact['email']); ?></div>
                                    </div>
                                    <!-- Subject + preview -->
                                    <div class="sub-body">
                                        <div class="sub-subject-line">
                                            <?php if ($isComplaint): ?>
                                                <span class="complaint-pill me-1">COMPLAINT</span>
                                            <?php endif; ?>
                                            <span class="sub-subject"><?php echo escape($displaySubject); ?></span>
                                            <span class="sub-preview"> â€” <?php echo escape($preview); ?><?php echo strlen($contact['message']) > 70 ? 'â€¦' : ''; ?></span>
                                        </div>
                                        <!-- Mobile-only: status + time on second line -->
                                        <div class="sub-mobile-meta">
                                            <span class="badge bg-<?php echo $badgeClass; ?> status-badge"><?php echo $badgeText; ?></span>
                                            <span class="sub-time"><?php echo timeAgo($contact['created_at']); ?></span>
                                        </div>
                                    </div>
                                    <!-- Status (desktop) -->
                                    <div style="flex:0 0 80px; text-align:center;">
                                        <span class="badge bg-<?php echo $badgeClass; ?> status-badge"><?php echo $badgeText; ?></span>
                                    </div>
                                    <!-- Time (desktop) -->
                                    <div class="sub-time" style="flex:0 0 70px; text-align:right;"><?php echo timeAgo($contact['created_at']); ?></div>
                                </div>
                            <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    (function(){
        var toggle  = document.getElementById('sidebarToggle');
        var sidebar = document.getElementById('adminSidebar');
        var overlay = document.getElementById('sidebarOverlay');
        function openSidebar()  { sidebar.classList.add('sidebar-open');    overlay.classList.add('active'); }
        function closeSidebar() { sidebar.classList.remove('sidebar-open'); overlay.classList.remove('active'); }
        if (toggle)  toggle.addEventListener('click', function(){ sidebar.classList.contains('sidebar-open') ? closeSidebar() : openSidebar(); });
        if (overlay) overlay.addEventListener('click', closeSidebar);
    })();
    </script>
</body>
</html>

