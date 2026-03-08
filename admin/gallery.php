<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); exit();
}

$page_title   = 'Manage Gallery';
$admin_active = 'gallery';
$action       = $_GET['action'] ?? 'list';
$message = ''; $message_type = '';

if (!is_dir(GALLERY_UPLOAD_DIR)) mkdir(GALLERY_UPLOAD_DIR, 0755, true);

// ── POST handler ─────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = sanitize($_POST['title']       ?? '');
    $description = sanitize($_POST['description'] ?? '');
    $alt_text    = sanitize($_POST['alt_text']    ?? '');
    $category    = sanitize($_POST['category']    ?? '');
    $status      = $_POST['status']               ?? 'active';
    $admin_id    = $_SESSION['admin_id'];

    if (empty($title)) {
        $message = 'Title is required.'; $message_type = 'danger';
    } else {
        if ($action === 'add') {
            if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
                $message = 'Please upload an image.'; $message_type = 'danger';
            } else {
                $file = $_FILES['image'];
                if (!isValidImage($file['name'], $file['type'])) {
                    $message = 'Invalid image format. Accepted: JPG, PNG, GIF, WebP'; $message_type = 'danger';
                } else {
                    $filename = generateUniqueFilename($file['name']);
                    $filepath = GALLERY_UPLOAD_DIR . $filename;
                    if (move_uploaded_file($file['tmp_name'], $filepath)) {
                        executeUpdate(
                            "INSERT INTO gallery (title,description,image_path,alt_text,category,status,created_by) VALUES (?,?,?,?,?,?,?)",
                            [$title, $description, 'uploads/gallery/'.$filename, $alt_text, $category, $status, $admin_id]
                        );
                        $message = 'Gallery item added!'; $message_type = 'success'; $action = 'list';
                    } else {
                        $message = 'Failed to upload image.'; $message_type = 'danger';
                    }
                }
            }
        } elseif ($action === 'edit') {
            $gal_id = intval($_GET['id'] ?? 0);
            if (!empty($_FILES['image']['name'])) {
                $file = $_FILES['image'];
                if (!isValidImage($file['name'], $file['type'])) {
                    $message = 'Invalid image format.'; $message_type = 'danger';
                } else {
                    $filename = generateUniqueFilename($file['name']);
                    $filepath = GALLERY_UPLOAD_DIR . $filename;
                    if (move_uploaded_file($file['tmp_name'], $filepath)) {
                        executeUpdate(
                            "UPDATE gallery SET title=?,description=?,image_path=?,alt_text=?,category=?,status=? WHERE id=?",
                            [$title, $description, 'uploads/gallery/'.$filename, $alt_text, $category, $status, $gal_id]
                        );
                        $message = 'Gallery item updated!'; $message_type = 'success';
                    } else {
                        $message = 'Failed to upload image.'; $message_type = 'danger';
                    }
                }
            } else {
                executeUpdate("UPDATE gallery SET title=?,description=?,alt_text=?,category=?,status=? WHERE id=?",
                    [$title, $description, $alt_text, $category, $status, $gal_id]);
                $message = 'Gallery item updated!'; $message_type = 'success';
            }
            $action = 'list';
        }
    }
}

// ── DELETE ───────────────────────────────────────────────────
if ($action === 'delete' && isset($_GET['id'])) {
    $gal_id = intval($_GET['id']);
    $item = fetchOne("SELECT image_path FROM gallery WHERE id=?", [$gal_id]);
    if (!empty($item)) {
        $fp = __DIR__ . '/../' . $item['image_path'];
        if (file_exists($fp)) unlink($fp);
    }
    executeUpdate("DELETE FROM gallery WHERE id=?", [$gal_id]);
    $message = 'Gallery item deleted.'; $message_type = 'success'; $action = 'list';
}

// ── Fetch ────────────────────────────────────────────────────
$gallery_items = []; $current_item = null;
if ($action === 'list') {
    $gallery_items = fetchAll("SELECT * FROM gallery ORDER BY display_order ASC, created_at DESC");
} elseif ($action === 'edit' && isset($_GET['id'])) {
    $current_item = fetchOne("SELECT * FROM gallery WHERE id=?", [intval($_GET['id'])]);
    if (empty($current_item)) { $action = 'list'; $message = 'Not found.'; $message_type = 'danger'; }
}

include __DIR__ . '/layout.php';
?>

<div class="adm-page-header">
  <div>
    <h1><i class="fas fa-images me-2" style="color:var(--b-copper);font-size:1.1rem;"></i>
      <?= $action==='add' ? 'Add Gallery Item' : ($action==='edit' ? 'Edit Gallery Item' : 'Manage Gallery') ?>
    </h1>
    <p><?= $action==='list' ? count($gallery_items).' item(s) total' : 'Fill in the details below' ?></p>
  </div>
  <?php if ($action==='list'): ?>
  <a href="gallery.php?action=add" class="btn-adm-copper"><i class="fas fa-plus"></i>Add Image</a>
  <?php else: ?>
  <a href="gallery.php" class="btn-adm-ghost"><i class="fas fa-arrow-left"></i>Back to Gallery</a>
  <?php endif; ?>
</div>

<?php if ($message): ?>
<div class="adm-alert adm-alert-<?= $message_type==='success'?'success':'danger' ?>">
  <i class="fas fa-<?= $message_type==='success'?'circle-check':'circle-xmark' ?>"></i><?= htmlspecialchars($message) ?>
</div>
<?php endif; ?>

<?php if ($action==='list'): ?>
<!-- ===== GALLERY GRID ===== -->
<?php if (empty($gallery_items)): ?>
<div class="adm-card">
  <div style="padding:3.5rem;text-align:center;color:var(--b-muted);">
    <i class="fas fa-images fa-2x" style="display:block;color:var(--b-border);margin-bottom:.8rem;"></i>
    No gallery items yet. <a href="gallery.php?action=add" style="color:var(--b-green);font-weight:600;">Add the first image.</a>
  </div>
</div>
<?php else: ?>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:1.25rem;">
  <?php foreach ($gallery_items as $item): ?>
  <div style="background:#fff;border-radius:10px;border:1px solid var(--b-border);box-shadow:0 2px 8px rgba(0,0,0,.06);overflow:hidden;display:flex;flex-direction:column;">
    <div style="height:180px;overflow:hidden;position:relative;">
      <img src="<?= SITE_URL.'/'.$item['image_path'] ?>"
           alt="<?= htmlspecialchars($item['alt_text'] ?: $item['title']) ?>"
           style="width:100%;height:100%;object-fit:cover;display:block;">
      <div style="position:absolute;top:.6rem;right:.6rem;">
        <?= $item['status']==='active'
          ? '<span class="adm-badge adm-badge-green">Active</span>'
          : '<span class="adm-badge adm-badge-muted">Inactive</span>' ?>
      </div>
    </div>
    <div style="padding:1rem;flex:1;display:flex;flex-direction:column;gap:.4rem;">
      <div style="font-weight:700;font-size:.9rem;color:var(--b-dark);"><?= htmlspecialchars($item['title']) ?></div>
      <?php if (!empty($item['category'])): ?>
      <span class="adm-badge adm-badge-blue" style="width:fit-content;"><?= htmlspecialchars($item['category']) ?></span>
      <?php endif; ?>
      <?php if (!empty($item['description'])): ?>
      <div style="font-size:.78rem;color:var(--b-muted);line-height:1.5;"><?= htmlspecialchars(substr($item['description'],0,80)) ?><?= strlen($item['description'])>80?'…':'' ?></div>
      <?php endif; ?>
      <div style="display:flex;gap:.5rem;margin-top:auto;padding-top:.6rem;">
        <a href="gallery.php?action=edit&id=<?= $item['id'] ?>" class="btn-adm-ghost btn-adm-sm" style="flex:1;justify-content:center;"><i class="fas fa-pen"></i>Edit</a>
        <a href="gallery.php?action=delete&id=<?= $item['id'] ?>" class="btn-adm-danger btn-adm-sm" onclick="return confirm('Delete this image?')"><i class="fas fa-trash"></i></a>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php endif; ?>

<?php else: ?>
<!-- ===== ADD / EDIT FORM ===== -->
<div class="adm-card" style="max-width:760px;">
  <div class="adm-card-header"><i class="fas fa-image"></i><?= $action==='add'?'Upload New Image':'Edit Gallery Item' ?></div>
  <div class="adm-card-body">
    <form method="POST" action="" enctype="multipart/form-data">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.2rem;">
        <div>
          <div class="adm-form-group">
            <label>Title <span class="req">*</span></label>
            <input class="adm-input" type="text" name="title" required
                   value="<?= htmlspecialchars($current_item['title'] ?? '') ?>"
                   placeholder="Image title">
          </div>
          <div class="adm-form-group">
            <label>Alt Text <small style="color:var(--b-muted);font-weight:400;">(accessibility)</small></label>
            <input class="adm-input" type="text" name="alt_text"
                   value="<?= htmlspecialchars($current_item['alt_text'] ?? '') ?>"
                   placeholder="Describe the image">
          </div>
          <div class="adm-form-group">
            <label>Category</label>
            <input class="adm-input" type="text" name="category"
                   value="<?= htmlspecialchars($current_item['category'] ?? '') ?>"
                   placeholder="e.g. Events, Branches, Team">
          </div>
          <div class="adm-form-group">
            <label>Status</label>
            <select class="adm-select" name="status">
              <option value="active"   <?= (($current_item['status']??'active')==='active')?'selected':'' ?>>Active</option>
              <option value="inactive" <?= (($current_item['status']??'')==='inactive')?'selected':'' ?>>Inactive</option>
            </select>
          </div>
        </div>
        <div>
          <div class="adm-form-group">
            <label>Image <?= $action==='add' ? '<span class="req">*</span>' : '(leave blank to keep current)' ?></label>
            <input class="adm-input" type="file" name="image" accept="image/*" <?= $action==='add'?'required':'' ?>>
            <p style="font-size:.76rem;color:var(--b-muted);margin-top:.3rem;">Accepted: JPG, PNG, GIF, WebP · Max 5MB</p>
          </div>
          <?php if ($action==='edit' && !empty($current_item['image_path'])): ?>
          <div style="margin-top:.5rem;">
            <p style="font-size:.76rem;color:var(--b-muted);font-weight:600;margin-bottom:.4rem;">CURRENT IMAGE</p>
            <img src="<?= SITE_URL.'/'.$current_item['image_path'] ?>"
                 alt="Current"
                 style="max-width:100%;height:160px;object-fit:cover;border-radius:8px;border:1px solid var(--b-border);">
          </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="adm-form-group">
        <label>Description</label>
        <textarea class="adm-textarea" name="description" rows="3"
                  placeholder="Brief description (optional)"><?= htmlspecialchars($current_item['description'] ?? '') ?></textarea>
      </div>
      <div style="display:flex;gap:.6rem;margin-top:1.2rem;">
        <button type="submit" class="btn-adm-primary"><i class="fas fa-floppy-disk"></i>Save Item</button>
        <a href="gallery.php" class="btn-adm-ghost"><i class="fas fa-xmark"></i>Cancel</a>
      </div>
    </form>
  </div>
</div>
<?php endif; ?>

<?php include __DIR__ . '/layout-end.php'; ?>
