<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); exit();
}

$page_title   = 'Dashboard';
$admin_active = 'dashboard';

$totalNotices = $activeNotices = $totalDownloads = $totalGallery = $totalContacts = $newContacts = 0;
try {
    $totalNotices   = fetchOne("SELECT COUNT(*) c FROM notices")['c']                                ?? 0;
    $activeNotices  = fetchOne("SELECT COUNT(*) c FROM notices WHERE status='active'")['c']          ?? 0;
    $totalDownloads = fetchOne("SELECT COUNT(*) c FROM downloads")['c']                              ?? 0;
    $totalGallery   = fetchOne("SELECT COUNT(*) c FROM gallery")['c']                                ?? 0;
    $totalContacts  = fetchOne("SELECT COUNT(*) c FROM contact_submissions")['c']                    ?? 0;
    $newContacts    = fetchOne("SELECT COUNT(*) c FROM contact_submissions WHERE status='new'")['c'] ?? 0;
} catch (Exception $e) {}

$recentContacts = [];
try {
    $recentContacts = fetchAll("SELECT id,name,subject,status,created_at FROM contact_submissions ORDER BY created_at DESC LIMIT 5");
} catch (Exception $e) {}

include __DIR__ . '/layout.php';
?>
<div class="adm-page-header">
  <div>
    <h1><i class="fas fa-gauge-high me-2" style="color:var(--b-copper);font-size:1.1rem;"></i>Dashboard</h1>
    <p>Welcome back, <strong><?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin') ?></strong> &mdash; <?= date('l, d M Y') ?></p>
  </div>
  <a href="notices.php?action=add" class="btn-adm-copper"><i class="fas fa-plus"></i>Add Notice</a>
</div>
<?php if (isset($_SESSION['login_success'])): ?>
<div class="adm-alert adm-alert-success">
  <i class="fas fa-circle-check"></i><?= htmlspecialchars($_SESSION['login_success']) ?>
</div>
<?php unset($_SESSION['login_success']); endif; ?>
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.5rem;">
  <div class="adm-stat" style="--accent-color:#0D3D2E;--accent-bg:#EBF2ED;">
    <div class="stat-icon"><i class="fas fa-bullhorn"></i></div>
    <div class="stat-value"><?= $totalNotices ?></div>
    <div class="stat-label">Notices</div>
    <div class="stat-sub"><span class="badge-green"><?= $activeNotices ?> active</span></div>
  </div>
  <div class="adm-stat" style="--accent-color:#B87333;--accent-bg:#FEF3E2;">
    <div class="stat-icon" style="background:#FEF3E2;color:#B87333;"><i class="fas fa-file-arrow-down"></i></div>
    <div class="stat-value"><?= $totalDownloads ?></div>
    <div class="stat-label">Downloads</div>
    <div class="stat-sub">File Management</div>
  </div>
  <div class="adm-stat" style="--accent-color:#2E8B63;--accent-bg:#DCF0E7;">
    <div class="stat-icon" style="background:#DCF0E7;color:#2E8B63;"><i class="fas fa-images"></i></div>
    <div class="stat-value"><?= $totalGallery ?></div>
    <div class="stat-label">Gallery</div>
    <div class="stat-sub">Photo Library</div>
  </div>
  <div class="adm-stat" style="--accent-color:#dc2626;--accent-bg:#fee2e2;">
    <div class="stat-icon" style="background:#fee2e2;color:#dc2626;"><i class="fas fa-envelope"></i></div>
    <div class="stat-value"><?= $totalContacts ?></div>
    <div class="stat-label">Contacts</div>
    <div class="stat-sub"><?php if ($newContacts > 0): ?><span class="badge-red"><?= $newContacts ?> new</span><?php else: ?>All read<?php endif; ?></div>
  </div>
</div>
<div style="display:grid;grid-template-columns:1fr 300px;gap:1.25rem;align-items:start;">
  <div class="adm-card">
    <div class="adm-card-header">
      <i class="fas fa-clock-rotate-left"></i>Recent Contact Submissions
      <a href="contacts.php" style="margin-left:auto;font-size:0.75rem;color:var(--s-accentH);text-decoration:none;font-weight:500;">View all &rsaquo;</a>
    </div>
    <?php if (empty($recentContacts)): ?>
    <div style="padding:2.5rem;text-align:center;color:var(--b-muted);">
      <i class="fas fa-inbox fa-2x" style="display:block;color:var(--b-border);margin-bottom:.6rem;"></i>No submissions yet.
    </div>
    <?php else: ?>
    <div style="overflow-x:auto;">
      <table class="adm-table">
        <thead><tr><th>Name</th><th>Subject</th><th style="width:90px;">Status</th><th style="width:95px;">Time</th><th style="width:50px;"></th></tr></thead>
        <tbody>
        <?php foreach ($recentContacts as $c):
            $badge = $c['status']==='replied' ? 'adm-badge-green' : ($c['status']==='archived' ? 'adm-badge-muted' : 'adm-badge-blue');
        ?>
        <tr>
          <td style="font-weight:600;font-size:.85rem;"><?= htmlspecialchars($c['name']) ?></td>
          <td style="font-size:.83rem;max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?= htmlspecialchars($c['subject']) ?></td>
          <td><span class="adm-badge <?= $badge ?>"><?= ucfirst($c['status']) ?></span></td>
          <td style="font-size:.75rem;color:var(--b-muted);white-space:nowrap;"><?= timeAgo($c['created_at']) ?></td>
          <td><a href="contacts.php?id=<?= $c['id'] ?>" class="btn-adm-ghost btn-adm-sm"><i class="fas fa-eye"></i></a></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>
  </div>
  <div style="display:flex;flex-direction:column;gap:1rem;">
    <div class="adm-card">
      <div class="adm-card-header"><i class="fas fa-bolt"></i>Quick Actions</div>
      <div class="adm-card-body" style="display:grid;gap:.55rem;">
        <a href="notices.php?action=add"   class="btn-adm-primary" style="justify-content:flex-start;"><i class="fas fa-bullhorn"></i>Add Notice</a>
        <a href="downloads.php?action=add" class="btn-adm-copper"  style="justify-content:flex-start;"><i class="fas fa-upload"></i>Upload File</a>
        <a href="gallery.php?action=add"   class="btn-adm-ghost"   style="justify-content:flex-start;"><i class="fas fa-image"></i>Add Image</a>
        <a href="rates.php"                class="btn-adm-ghost"   style="justify-content:flex-start;"><i class="fas fa-percent"></i>Edit Rates</a>
        <a href="contacts.php"             class="btn-adm-ghost"   style="justify-content:flex-start;">
          <i class="fas fa-envelope"></i>View Contacts
          <?php if ($newContacts > 0): ?><span style="margin-left:auto;background:#dc2626;color:#fff;font-size:.65rem;padding:.15rem .45rem;border-radius:20px;font-weight:700;"><?= $newContacts ?></span><?php endif; ?>
        </a>
      </div>
    </div>
    <div class="adm-card">
      <div class="adm-card-header"><i class="fas fa-circle-info"></i>System Info</div>
      <div class="adm-card-body" style="display:grid;gap:.6rem;font-size:.82rem;">
        <div style="display:flex;justify-content:space-between;"><span style="color:var(--b-muted);">PHP Version</span><span style="font-weight:600;"><?= phpversion() ?></span></div>
        <div style="display:flex;justify-content:space-between;"><span style="color:var(--b-muted);">Server Time</span><span style="font-weight:600;"><?= date('H:i:s') ?></span></div>
        <div style="display:flex;justify-content:space-between;"><span style="color:var(--b-muted);">Server Date</span><span style="font-weight:600;"><?= date('d M Y') ?></span></div>
        <hr style="border-color:var(--b-border);margin:.25rem 0;">
        <a href="<?= SITE_URL ?>" target="_blank" style="color:var(--b-green);font-size:.8rem;font-weight:600;text-decoration:none;"><i class="fas fa-arrow-up-right-from-square me-1"></i>View Live Website</a>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/layout-end.php'; ?>