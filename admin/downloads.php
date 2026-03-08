<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); exit();
}

$page_title   = 'Manage Downloads';
$admin_active = 'downloads';
$action       = $_GET['action'] ?? 'list';
$message = ''; $message_type = '';

if (!is_dir(DOWNLOAD_UPLOAD_DIR)) mkdir(DOWNLOAD_UPLOAD_DIR, 0755, true);

// ── POST handler ─────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = sanitize($_POST['title']       ?? '');
    $description = sanitize($_POST['description'] ?? '');
    $category    = sanitize($_POST['category']    ?? '');
    $status      = $_POST['status']               ?? 'active';
    $admin_id    = $_SESSION['admin_id'];

    if (empty($title)) {
        $message = 'Title is required.'; $message_type = 'danger';
    } else {
        if ($action === 'add') {
            if (!isset($_FILES['file']) || $_FILES['file']['error'] === UPLOAD_ERR_NO_FILE) {
                $message = 'Please upload a file.'; $message_type = 'danger';
            } else {
                $file     = $_FILES['file'];
                $filename = generateUniqueFilename($file['name']);
                $filepath = DOWNLOAD_UPLOAD_DIR . $filename;
                if (move_uploaded_file($file['tmp_name'], $filepath)) {
                    executeUpdate(
                        "INSERT INTO downloads (title,description,file_path,category,status,created_by) VALUES (?,?,?,?,?,?)",
                        [$title, $description, 'uploads/downloads/'.$filename, $category, $status, $admin_id]
                    );
                    $message = 'Download added successfully!'; $message_type = 'success'; $action = 'list';
                } else {
                    $message = 'Failed to upload file.'; $message_type = 'danger';
                }
            }
        } elseif ($action === 'edit') {
            $dl_id = intval($_GET['id'] ?? 0);
            if (!empty($_FILES['file']['name'])) {
                $file     = $_FILES['file'];
                $filename = generateUniqueFilename($file['name']);
                $filepath = DOWNLOAD_UPLOAD_DIR . $filename;
                if (move_uploaded_file($file['tmp_name'], $filepath)) {
                    executeUpdate(
                        "UPDATE downloads SET title=?,description=?,file_path=?,category=?,status=? WHERE id=?",
                        [$title, $description, 'uploads/downloads/'.$filename, $category, $status, $dl_id]
                    );
                    $message = 'Download updated!'; $message_type = 'success';
                } else {
                    $message = 'Failed to upload file.'; $message_type = 'danger';
                }
            } else {
                executeUpdate("UPDATE downloads SET title=?,description=?,category=?,status=? WHERE id=?",
                    [$title, $description, $category, $status, $dl_id]);
                $message = 'Download updated!'; $message_type = 'success';
            }
            $action = 'list';
        }
    }
}

// ── DELETE ───────────────────────────────────────────────────
if ($action === 'delete' && isset($_GET['id'])) {
    $dl_id = intval($_GET['id']);
    $dl = fetchOne("SELECT file_path FROM downloads WHERE id=?", [$dl_id]);
    if (!empty($dl)) {
        $fp = __DIR__ . '/../' . $dl['file_path'];
        if (file_exists($fp)) unlink($fp);
    }
    executeUpdate("DELETE FROM downloads WHERE id=?", [$dl_id]);
    $message = 'Download deleted.'; $message_type = 'success'; $action = 'list';
}

// ── Fetch ────────────────────────────────────────────────────
$downloads = []; $current_download = null;
if ($action === 'list') {
    $downloads = fetchAll("SELECT * FROM downloads ORDER BY created_at DESC");
} elseif ($action === 'edit' && isset($_GET['id'])) {
    $current_download = fetchOne("SELECT * FROM downloads WHERE id=?", [intval($_GET['id'])]);
    if (empty($current_download)) { $action = 'list'; $message = 'Not found.'; $message_type = 'danger'; }
}

include __DIR__ . '/layout.php';
?>

<div class="adm-page-header">
  <div>
    <h1><i class="fas fa-download me-2" style="color:var(--b-copper);font-size:1.1rem;"></i>
      <?= $action==='add' ? 'Add Download' : ($action==='edit' ? 'Edit Download' : 'Manage Downloads') ?>
    </h1>
    <p><?= $action==='list' ? count($downloads).' file(s) total' : 'Fill in the details below' ?></p>
  </div>
  <?php if ($action==='list'): ?>
  <a href="downloads.php?action=add" class="btn-adm-copper"><i class="fas fa-plus"></i>Add Download</a>
  <?php else: ?>
  <a href="downloads.php" class="btn-adm-ghost"><i class="fas fa-arrow-left"></i>Back to List</a>
  <?php endif; ?>
</div>

<?php if ($message): ?>
<div class="adm-alert adm-alert-<?= $message_type==='success'?'success':'danger' ?>">
  <i class="fas fa-<?= $message_type==='success'?'circle-check':'circle-xmark' ?>"></i><?= htmlspecialchars($message) ?>
</div>
<?php endif; ?>

<?php if ($action==='list'): ?>
<!-- ===== LIST ===== -->
<div class="adm-card">
  <div style="overflow-x:auto;">
    <?php if (!empty($downloads)): ?>
    <table class="adm-table">
      <thead>
        <tr><th>#</th><th>Title</th><th>Category</th><th>File</th><th>Status</th><th style="width:110px;">Actions</th></tr>
      </thead>
      <tbody>
      <?php foreach ($downloads as $i => $d): ?>
      <tr>
        <td style="color:var(--b-muted);font-size:.78rem;"><?= $i+1 ?></td>
        <td>
          <div style="font-weight:600;"><?= htmlspecialchars($d['title']) ?></div>
          <?php if (!empty($d['description'])): ?>
          <div style="font-size:.77rem;color:var(--b-muted);"><?= htmlspecialchars(substr($d['description'],0,60)) ?><?= strlen($d['description'])>60?'…':'' ?></div>
          <?php endif; ?>
        </td>
        <td>
          <?php if (!empty($d['category'])): ?>
          <span class="adm-badge adm-badge-blue"><?= htmlspecialchars($d['category']) ?></span>
          <?php else: ?><span style="color:var(--b-muted);font-size:.8rem;">—</span><?php endif; ?>
        </td>
        <td>
          <a href="<?= SITE_URL.'/'.$d['file_path'] ?>" target="_blank" class="btn-adm-ghost btn-adm-sm">
            <i class="fas fa-file-arrow-down"></i>View
          </a>
        </td>
        <td>
          <?= $d['status']==='active'
            ? '<span class="adm-badge adm-badge-green">Active</span>'
            : '<span class="adm-badge adm-badge-muted">Inactive</span>' ?>
        </td>
        <td style="display:flex;gap:.4rem;">
          <a href="downloads.php?action=edit&id=<?= $d['id'] ?>" class="btn-adm-ghost btn-adm-sm"><i class="fas fa-pen"></i></a>
          <a href="downloads.php?action=delete&id=<?= $d['id'] ?>" class="btn-adm-danger btn-adm-sm" onclick="return confirm('Delete this download?')"><i class="fas fa-trash"></i></a>
        </td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php else: ?>
    <div style="padding:3rem;text-align:center;color:var(--b-muted);">
      <i class="fas fa-folder-open fa-2x" style="display:block;color:var(--b-border);margin-bottom:.8rem;"></i>
      No downloads yet. <a href="downloads.php?action=add" style="color:var(--b-green);font-weight:600;">Add the first one.</a>
    </div>
    <?php endif; ?>
  </div>
</div>

<?php else: ?>
<!-- ===== ADD / EDIT FORM ===== -->
<div class="adm-card" style="max-width:680px;">
  <div class="adm-card-header"><i class="fas fa-file-arrow-up"></i><?= $action==='add'?'Upload New File':'Edit Download' ?></div>
  <div class="adm-card-body">
    <form method="POST" action="" enctype="multipart/form-data">
      <div class="adm-form-group">
        <label>Title <span class="req">*</span></label>
        <input class="adm-input" type="text" name="title" required
               value="<?= htmlspecialchars($current_download['title'] ?? '') ?>"
               placeholder="Enter file title">
      </div>
      <div class="adm-form-group">
        <label>Description</label>
        <textarea class="adm-textarea" name="description" rows="3"
                  placeholder="Brief description (optional)"><?= htmlspecialchars($current_download['description'] ?? '') ?></textarea>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
        <div class="adm-form-group">
          <label>Category</label>
          <input class="adm-input" type="text" name="category"
                 value="<?= htmlspecialchars($current_download['category'] ?? '') ?>"
                 placeholder="e.g. Forms, Policies">
        </div>
        <div class="adm-form-group">
          <label>Status</label>
          <select class="adm-select" name="status">
            <option value="active"   <?= (($current_download['status']??'active')==='active')?'selected':'' ?>>Active</option>
            <option value="inactive" <?= (($current_download['status']??'')==='inactive')?'selected':'' ?>>Inactive</option>
          </select>
        </div>
      </div>
      <div class="adm-form-group">
        <label>File <?= $action==='add' ? '<span class="req">*</span>' : '(leave blank to keep current)' ?></label>
        <input class="adm-input" type="file" name="file" <?= $action==='add'?'required':'' ?>>
        <p style="font-size:.76rem;color:var(--b-muted);margin-top:.3rem;">Accepted: PDF, Word, Excel, etc.</p>
      </div>
      <div style="display:flex;gap:.6rem;margin-top:1.2rem;">
        <button type="submit" class="btn-adm-primary"><i class="fas fa-floppy-disk"></i>Save Download</button>
        <a href="downloads.php" class="btn-adm-ghost"><i class="fas fa-xmark"></i>Cancel</a>
      </div>
    </form>
  </div>
</div>
<?php endif; ?>

<?php include __DIR__ . '/layout-end.php'; ?>
