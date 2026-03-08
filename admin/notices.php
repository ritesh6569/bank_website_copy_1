<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); exit();
}

$page_title   = 'Manage Notices';
$admin_active = 'notices';
$action       = $_GET['action'] ?? 'list';
$message = ''; $message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title    = sanitize($_POST['title']   ?? '');
    $content  = $_POST['content']          ?? '';
    $status   = $_POST['status']           ?? 'active';
    $admin_id = $_SESSION['admin_id'];
    if (empty($title) || empty($content)) {
        $message = 'Title and content are required.'; $message_type = 'danger';
    } else {
        if ($action === 'add') {
            executeUpdate("INSERT INTO notices (title,content,date_published,status,created_by) VALUES (?,?,?,?,?)",
                [$title, $content, date('Y-m-d H:i:s'), $status, $admin_id]);
            $message = 'Notice added successfully!'; $message_type = 'success'; $action = 'list';
        } elseif ($action === 'edit') {
            executeUpdate("UPDATE notices SET title=?,content=?,status=?,updated_at=NOW() WHERE id=?",
                [$title, $content, $status, $_GET['id'] ?? 0]);
            $message = 'Notice updated successfully!'; $message_type = 'success'; $action = 'list';
        }
    }
}
if ($action === 'delete' && isset($_GET['id'])) {
    executeUpdate("DELETE FROM notices WHERE id=?", [$_GET['id']]);
    $message = 'Notice deleted.'; $message_type = 'success'; $action = 'list';
}

$notices = []; $current_notice = null;
if ($action === 'list') {
    $notices = fetchAll("SELECT * FROM notices ORDER BY date_published DESC");
} elseif ($action === 'edit' && isset($_GET['id'])) {
    $current_notice = fetchOne("SELECT * FROM notices WHERE id=?", [$_GET['id']]);
    if (empty($current_notice)) { $action = 'list'; $message = 'Notice not found.'; $message_type = 'danger'; }
}

include __DIR__ . '/layout.php';
?>

<div class="adm-page-header">
  <div>
    <h1><i class="fas fa-bullhorn me-2" style="color:var(--b-copper);font-size:1.1rem;"></i>
      <?= $action === 'add' ? 'Add Notice' : ($action === 'edit' ? 'Edit Notice' : 'Manage Notices') ?>
    </h1>
    <p><?= $action === 'list' ? count($notices) . ' notice(s) total' : 'Fill in the details below' ?></p>
  </div>
  <?php if ($action === 'list'): ?>
  <a href="notices.php?action=add" class="btn-adm-copper"><i class="fas fa-plus"></i>Add Notice</a>
  <?php else: ?>
  <a href="notices.php" class="btn-adm-ghost"><i class="fas fa-arrow-left"></i>Back to List</a>
  <?php endif; ?>
</div>

<?php if ($message): ?>
<div class="adm-alert adm-alert-<?= $message_type === 'success' ? 'success' : 'danger' ?>">
  <i class="fas fa-<?= $message_type === 'success' ? 'circle-check' : 'circle-xmark' ?>"></i>
  <?= htmlspecialchars($message) ?>
</div>
<?php endif; ?>

<?php if ($action === 'list'): ?>
<!-- ===== LIST ===== -->
<div class="adm-card">
  <div style="overflow-x:auto;">
    <?php if (!empty($notices)): ?>
    <table class="adm-table">
      <thead>
        <tr><th>#</th><th>Title</th><th>Published</th><th>Status</th><th style="width:120px;">Actions</th></tr>
      </thead>
      <tbody>
      <?php foreach ($notices as $i => $n): ?>
      <tr>
        <td style="color:var(--b-muted);font-size:0.78rem;"><?= $i+1 ?></td>
        <td style="font-weight:600;"><?= htmlspecialchars($n['title']) ?></td>
        <td style="color:var(--b-muted);font-size:0.82rem;"><?= date('d M Y', strtotime($n['date_published'])) ?></td>
        <td>
          <?php if ($n['status']==='active'): ?>
            <span class="adm-badge adm-badge-green">Active</span>
          <?php else: ?>
            <span class="adm-badge adm-badge-muted">Inactive</span>
          <?php endif; ?>
        </td>
        <td style="display:flex;gap:0.4rem;">
          <a href="notices.php?action=edit&id=<?= $n['id'] ?>" class="btn-adm-ghost btn-adm-sm"><i class="fas fa-pen"></i></a>
          <a href="notices.php?action=delete&id=<?= $n['id'] ?>" class="btn-adm-danger btn-adm-sm" onclick="return confirm('Delete this notice?')"><i class="fas fa-trash"></i></a>
        </td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php else: ?>
    <div style="padding:3rem;text-align:center;color:var(--b-muted);">
      <i class="fas fa-bullhorn fa-2x mb-2" style="display:block;color:var(--b-border);"></i>
      No notices yet. <a href="notices.php?action=add" style="color:var(--b-green);font-weight:600;">Add the first one.</a>
    </div>
    <?php endif; ?>
  </div>
</div>

<?php else: ?>
<!-- ===== ADD / EDIT FORM ===== -->
<div class="adm-card" style="max-width:720px;">
  <div class="adm-card-header"><i class="fas fa-bullhorn"></i><?= $action === 'add' ? 'New Notice' : 'Edit Notice' ?></div>
  <div class="adm-card-body">
    <form method="POST" action="">
      <div class="adm-form-group">
        <label>Title <span class="req">*</span></label>
        <input class="adm-input" type="text" name="title" required
               value="<?= htmlspecialchars($current_notice['title'] ?? '') ?>"
               placeholder="Enter notice title">
      </div>
      <div class="adm-form-group">
        <label>Content <span class="req">*</span></label>
        <textarea class="adm-textarea" name="content" id="noticeContent" rows="10" required
                  placeholder="Enter full notice content..."><?= htmlspecialchars($current_notice['content'] ?? '') ?></textarea>
      </div>
      <div class="adm-form-group" style="max-width:200px;">
        <label>Status</label>
        <select class="adm-select" name="status">
          <option value="active"   <?= (($current_notice['status'] ?? 'active') === 'active')   ? 'selected' : '' ?>>Active</option>
          <option value="inactive" <?= (($current_notice['status'] ?? '') === 'inactive') ? 'selected' : '' ?>>Inactive</option>
        </select>
      </div>
      <div style="display:flex;gap:0.6rem;margin-top:1.25rem;">
        <button type="submit" class="btn-adm-primary"><i class="fas fa-floppy-disk"></i>Save Notice</button>
        <a href="notices.php" class="btn-adm-ghost"><i class="fas fa-xmark"></i>Cancel</a>
      </div>
    </form>
  </div>
</div>
<?php endif; ?>

<?php include __DIR__ . '/layout-end.php'; ?>
