<?php
/**
 * Manage Notices
 * CRUD operations for notices
 */

// Start session BEFORE any output
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';

// Require login - check for the correct session variable
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php", true, 302);
    exit();
}

$page_title = 'Manage Notices - Admin';
$action = $_GET['action'] ?? 'list';
$message = '';
$message_type = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize($_POST['title'] ?? '');
    $content = $_POST['content'] ?? '';
    $status = $_POST['status'] ?? 'active';
    $admin_id = $_SESSION['admin_id'];

    if (empty($title) || empty($content)) {
        $message = 'Title and content are required.';
        $message_type = 'danger';
    } else {
        if ($action === 'add') {
            $query = "INSERT INTO notices (title, content, date_published, status, created_by) VALUES (?, ?, ?, ?, ?)";
            executeUpdate($query, [$title, $content, date('Y-m-d H:i:s'), $status, $admin_id]);
            $message = 'Notice added successfully!';
            $message_type = 'success';
            $action = 'list';
        } elseif ($action === 'edit') {
            $notice_id = $_GET['id'] ?? 0;
            $query = "UPDATE notices SET title = ?, content = ?, status = ?, updated_at = NOW() WHERE id = ?";
            executeUpdate($query, [$title, $content, $status, $notice_id]);
            $message = 'Notice updated successfully!';
            $message_type = 'success';
            $action = 'list';
        }
    }
}

// Handle delete
if ($action === 'delete' && isset($_GET['id'])) {
    $notice_id = $_GET['id'];
    executeUpdate("DELETE FROM notices WHERE id = ?", [$notice_id]);
    $message = 'Notice deleted successfully!';
    $message_type = 'success';
    $action = 'list';
}

// Get notices for list or edit
$notices = [];
$current_notice = null;

if ($action === 'list') {
    $notices = fetchAll("SELECT * FROM notices ORDER BY date_published DESC");
} elseif ($action === 'edit' && isset($_GET['id'])) {
    $current_notice = fetchOne("SELECT * FROM notices WHERE id = ?", [$_GET['id']]);
    if (empty($current_notice)) {
        $action = 'list';
        $message = 'Notice not found.';
        $message_type = 'danger';
    }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/professional-theme.css">
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.2/tinymce.min.js"></script>
</head>
<body>
    <div class="d-flex" style="min-height: 100vh;">
        <!-- Sidebar -->
        <nav class="sidebar" style="width: 250px; background: #1A2533; padding: 2rem 0; position: fixed; height: 100vh; overflow-y: auto; box-shadow: 4px 0 12px rgba(15,31,53,0.15);">
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
                    <a class="nav-link" href="index.php" style="color: rgba(255,255,255,0.75); padding: 0.85rem 1.5rem; border-left: 3px solid transparent;">
                        <i class="fas fa-chart-line me-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="notices.php" style="color: rgba(255,255,255,0.85); padding: 0.85rem 1.5rem; border-left: 3px solid #B8860B; background: rgba(184,134,11,0.12); font-weight: 600;">
                        <i class="fas fa-bullhorn me-2" style="color: #B8860B;"></i>Manage Notices
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="downloads.php" style="color: rgba(255,255,255,0.75); padding: 0.85rem 1.5rem; border-left: 3px solid transparent;">
                        <i class="fas fa-download me-2"></i>Manage Downloads
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gallery.php" style="color: rgba(255,255,255,0.75); padding: 0.85rem 1.5rem; border-left: 3px solid transparent;">
                        <i class="fas fa-images me-2"></i>Manage Gallery
                    </a>
                </li>
                <hr style="border-color: rgba(255,255,255,0.1); margin: 0.75rem 0;">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php" style="color: rgba(255,255,255,0.65); padding: 0.85rem 1.5rem; border-left: 3px solid transparent;">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main style="margin-left: 250px; width: calc(100% - 250px);">
            <div class="container-fluid p-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1><?php echo $action === 'add' ? 'Add New Notice' : ($action === 'edit' ? 'Edit Notice' : 'Manage Notices'); ?></h1>
                    <?php if ($action === 'list'): ?>
                        <a href="notices.php?action=add" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Notice
                        </a>
                    <?php else: ?>
                        <a href="notices.php" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Messages -->
                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i><?php echo $message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- List View -->
                <?php if ($action === 'list'): ?>
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Date Published</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($notices as $notice): ?>
                                        <tr>
                                            <td><?php echo escape($notice['title']); ?></td>
                                            <td><?php echo formatDate($notice['date_published']); ?></td>
                                            <td>
                                                <span class="badge badge-<?php echo $notice['status'] === 'active' ? 'success' : 'secondary'; ?>">
                                                    <?php echo ucfirst($notice['status']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="notices.php?action=edit&id=<?php echo $notice['id']; ?>" class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="notices.php?action=delete&id=<?php echo $notice['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if (empty($notices)): ?>
                            <div class="card-body text-center py-5">
                                <i class="fas fa-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                <p class="text-muted mt-3">No notices found.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                <!-- Add/Edit View -->
                <?php else: ?>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title *</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="title" 
                                        name="title" 
                                        required
                                        value="<?php echo escape($current_notice['title'] ?? ''); ?>"
                                    >
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">Content *</label>
                                    <textarea 
                                        class="form-control" 
                                        id="content" 
                                        name="content" 
                                        rows="8" 
                                        required
                                    ><?php echo escape($current_notice['content'] ?? ''); ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="active" <?php echo (($current_notice['status'] ?? 'active') === 'active') ? 'selected' : ''; ?>>Active</option>
                                        <option value="inactive" <?php echo (($current_notice['status'] ?? '') === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                    </select>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Save Notice
                                    </button>
                                    <a href="notices.php" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <script>
                        tinymce.init({
                            selector: '#content',
                            plugins: 'lists link image table',
                            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image table',
                            menubar: false,
                            height: 300,
                            setup: function(editor) {
                                editor.on('change', function() {
                                    tinymce.triggerSave();
                                });
                            }
                        });
                        
                        // Handle form submission with TinyMCE
                        document.querySelector('form')?.addEventListener('submit', function(e) {
                            tinymce.triggerSave();
                        });
                    </script>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
