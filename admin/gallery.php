<?php
/**
 * Manage Gallery
 * CRUD operations for gallery images
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

$page_title = 'Manage Gallery - Admin';
$action = $_GET['action'] ?? 'list';
$message = '';
$message_type = '';

// Create upload directory if it doesn't exist
if (!is_dir(GALLERY_UPLOAD_DIR)) {
    mkdir(GALLERY_UPLOAD_DIR, 0755, true);
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize($_POST['title'] ?? '');
    $description = sanitize($_POST['description'] ?? '');
    $alt_text = sanitize($_POST['alt_text'] ?? '');
    $category = sanitize($_POST['category'] ?? '');
    $status = $_POST['status'] ?? 'active';
    $admin_id = $_SESSION['admin_id'];

    if (empty($title)) {
        $message = 'Title is required.';
        $message_type = 'danger';
    } else {
        if ($action === 'add') {
            if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
                $message = 'Please upload an image.';
                $message_type = 'danger';
            } else {
                $file = $_FILES['image'];
                if (!isValidImage($file['name'], $file['type'])) {
                    $message = 'Invalid image format. Accepted: JPG, PNG, GIF, WebP';
                    $message_type = 'danger';
                } else {
                    $filename = generateUniqueFilename($file['name']);
                    $filepath = GALLERY_UPLOAD_DIR . $filename;

                    if (move_uploaded_file($file['tmp_name'], $filepath)) {
                        $query = "INSERT INTO gallery (title, description, image_path, alt_text, category, status, created_by) VALUES (?, ?, ?, ?, ?, ?, ?)";
                        executeUpdate($query, [$title, $description, 'uploads/gallery/' . $filename, $alt_text, $category, $status, $admin_id]);
                        $message = 'Gallery item added successfully!';
                        $message_type = 'success';
                        $action = 'list';
                    } else {
                        $message = 'Failed to upload image.';
                        $message_type = 'danger';
                    }
                }
            }
        } elseif ($action === 'edit') {
            $gallery_id = $_GET['id'] ?? 0;
            if (!empty($_FILES['image']['name'])) {
                $file = $_FILES['image'];
                if (!isValidImage($file['name'], $file['type'])) {
                    $message = 'Invalid image format.';
                    $message_type = 'danger';
                } else {
                    $filename = generateUniqueFilename($file['name']);
                    $filepath = GALLERY_UPLOAD_DIR . $filename;

                    if (move_uploaded_file($file['tmp_name'], $filepath)) {
                        $query = "UPDATE gallery SET title = ?, description = ?, image_path = ?, alt_text = ?, category = ?, status = ? WHERE id = ?";
                        executeUpdate($query, [$title, $description, 'uploads/gallery/' . $filename, $alt_text, $category, $status, $gallery_id]);
                        $message = 'Gallery item updated successfully!';
                        $message_type = 'success';
                    } else {
                        $message = 'Failed to upload image.';
                        $message_type = 'danger';
                    }
                }
            } else {
                $query = "UPDATE gallery SET title = ?, description = ?, alt_text = ?, category = ?, status = ? WHERE id = ?";
                executeUpdate($query, [$title, $description, $alt_text, $category, $status, $gallery_id]);
                $message = 'Gallery item updated successfully!';
                $message_type = 'success';
            }
            $action = 'list';
        }
    }
}

// Handle delete
if ($action === 'delete' && isset($_GET['id'])) {
    $gallery_id = $_GET['id'];
    $item = fetchOne("SELECT image_path FROM gallery WHERE id = ?", [$gallery_id]);
    if (!empty($item)) {
        $file_path = __DIR__ . '/../' . $item['image_path'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }
    executeUpdate("DELETE FROM gallery WHERE id = ?", [$gallery_id]);
    $message = 'Gallery item deleted successfully!';
    $message_type = 'success';
    $action = 'list';
}

// Get gallery items
$gallery_items = [];
$current_item = null;

if ($action === 'list') {
    $gallery_items = fetchAll("SELECT * FROM gallery ORDER BY display_order ASC, created_at DESC");
} elseif ($action === 'edit' && isset($_GET['id'])) {
    $current_item = fetchOne("SELECT * FROM gallery WHERE id = ?", [$_GET['id']]);
    if (empty($current_item)) {
        $action = 'list';
        $message = 'Gallery item not found.';
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
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/professional-theme.css">
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
                    <a class="nav-link" href="notices.php" style="color: rgba(255,255,255,0.75); padding: 0.85rem 1.5rem; border-left: 3px solid transparent;">
                        <i class="fas fa-bullhorn me-2"></i>Manage Notices
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="downloads.php" style="color: rgba(255,255,255,0.75); padding: 0.85rem 1.5rem; border-left: 3px solid transparent;">
                        <i class="fas fa-download me-2"></i>Manage Downloads
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gallery.php" style="color: rgba(255,255,255,0.85); padding: 0.85rem 1.5rem; border-left: 3px solid #B8860B; background: rgba(184,134,11,0.12); font-weight: 600;">
                        <i class="fas fa-images me-2" style="color: #B8860B;"></i>Manage Gallery
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
                    <h1><?php echo $action === 'add' ? 'Add Gallery Item' : ($action === 'edit' ? 'Edit Gallery Item' : 'Manage Gallery'); ?></h1>
                    <?php if ($action === 'list'): ?>
                        <a href="gallery.php?action=add" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Item
                        </a>
                    <?php else: ?>
                        <a href="gallery.php" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Messages -->
                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show" role="alert">
                        <?php echo $message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- List View -->
                <?php if ($action === 'list'): ?>
                    <div class="row" style="gap: 1.5rem;">
                        <?php foreach ($gallery_items as $item): ?>
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="<?php echo SITE_URL . '/' . $item['image_path']; ?>" class="card-img-top" alt="<?php echo escape($item['alt_text']); ?>" style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo escape($item['title']); ?></h5>
                                        <p class="card-text text-muted" style="font-size: 0.9rem;"><?php echo escape(substr($item['description'], 0, 100)); ?></p>
                                        <div class="d-flex gap-2">
                                            <a href="gallery.php?action=edit&id=<?php echo $item['id']; ?>" class="btn btn-sm btn-info flex-grow-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="gallery.php?action=delete&id=<?php echo $item['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (empty($gallery_items)): ?>
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <i class="fas fa-images" style="font-size: 3rem; color: #ccc;"></i>
                                <p class="text-muted mt-3">No gallery items found.</p>
                            </div>
                        </div>
                    <?php endif; ?>

                <!-- Add/Edit View -->
                <?php else: ?>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title *</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="title" 
                                                name="title" 
                                                required
                                                value="<?php echo escape($current_item['title'] ?? ''); ?>"
                                            >
                                        </div>

                                        <div class="mb-3">
                                            <label for="alt_text" class="form-label">Alt Text (for accessibility)</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="alt_text" 
                                                name="alt_text"
                                                value="<?php echo escape($current_item['alt_text'] ?? ''); ?>"
                                            >
                                        </div>

                                        <div class="mb-3">
                                            <label for="category" class="form-label">Category</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="category" 
                                                name="category"
                                                value="<?php echo escape($current_item['category'] ?? ''); ?>"
                                                placeholder="e.g., Events, Branches, Team"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image <?php echo $action === 'add' ? '*' : '(leave empty to keep current)'; ?></label>
                                            <input 
                                                type="file" 
                                                class="form-control" 
                                                id="image" 
                                                name="image"
                                                accept="image/*"
                                                <?php echo $action === 'add' ? 'required' : ''; ?>
                                            >
                                            <small class="text-muted">Accepted: JPG, PNG, GIF, WebP (Max 5MB)</small>
                                        </div>

                                        <?php if ($action === 'edit' && !empty($current_item['image_path'])): ?>
                                            <div class="mb-3">
                                                <label class="form-label">Current Image</label>
                                                <img src="<?php echo SITE_URL . '/' . $current_item['image_path']; ?>" alt="Current image" style="max-width: 100%; height: 150px; object-fit: cover; border-radius: 0.5rem;">
                                            </div>
                                        <?php endif; ?>

                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" id="status" name="status">
                                                <option value="active" <?php echo (($current_item['status'] ?? 'active') === 'active') ? 'selected' : ''; ?>>Active</option>
                                                <option value="inactive" <?php echo (($current_item['status'] ?? '') === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea 
                                        class="form-control" 
                                        id="description" 
                                        name="description" 
                                        rows="4"
                                    ><?php echo escape($current_item['description'] ?? ''); ?></textarea>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Save Item
                                    </button>
                                    <a href="gallery.php" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
