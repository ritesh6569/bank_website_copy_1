<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/mailer.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); exit();
}

$page_title   = 'Contact Submissions';
$admin_active = 'contacts';
$contact_id   = intval($_GET['id'] ?? 0);
$success_message = '';
$error_message   = '';

// ── POST handler ─────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_action = $_POST['action'] ?? '';
    $post_id     = intval($_POST['id'] ?? 0);

    if ($post_action === 'reply' && $post_id) {
        $reply = trim($_POST['reply_message'] ?? '');
        if (empty($reply)) {
            $error_message = 'Reply message cannot be empty.';
        } else {
            try {
                $contact = fetchOne("SELECT * FROM contact_submissions WHERE id = ?", [$post_id]);
                if ($contact) {
                    $emailBody = buildEmailTemplate(
                        'Re: ' . $contact['subject'],
                        nl2br(htmlspecialchars($reply)),
                        $contact['name']
                    );
                    $sent = sendMail($contact['email'], 'Re: ' . $contact['subject'], $emailBody);
                    if ($sent) {
                        executeUpdate(
                            "UPDATE contact_submissions SET status='replied', admin_reply=?, admin_reply_at=NOW() WHERE id=?",
                            [$reply, $post_id]
                        );
                        $success_message = 'Reply sent successfully to ' . $contact['email'];
                    } else {
                        $error_message = 'Failed to send email. Please try again.';
                    }
                }
            } catch (Exception $e) {
                error_log('Reply error: ' . $e->getMessage());
                $error_message = 'Error sending reply.';
            }
        }
    } elseif ($post_action === 'archive' && $post_id) {
        try {
            executeUpdate("UPDATE contact_submissions SET status='archived' WHERE id=?", [$post_id]);
            $success_message = 'Contact submission archived.';
        } catch (Exception $e) { $error_message = 'Error archiving.'; }
    } elseif ($post_action === 'delete' && $post_id) {
        try {
            executeUpdate("DELETE FROM contact_submissions WHERE id=?", [$post_id]);
            $success_message = 'Submission deleted.';
            $contact_id = 0;
        } catch (Exception $e) { $error_message = 'Error deleting.'; }
    }
}

// ── Stats ────────────────────────────────────────────────────
$stats = ['total'=>0,'new'=>0,'replied'=>0,'archived'=>0];
try {
    $pdo = getDBConnection();
    if ($pdo->query("SHOW TABLES LIKE 'contact_submissions'")->rowCount() > 0) {
        $stats['total']    = fetchOne("SELECT COUNT(*) c FROM contact_submissions")['c'] ?? 0;
        $stats['new']      = fetchOne("SELECT COUNT(*) c FROM contact_submissions WHERE status='new'")['c'] ?? 0;
        $stats['replied']  = fetchOne("SELECT COUNT(*) c FROM contact_submissions WHERE status='replied'")['c'] ?? 0;
        $stats['archived'] = fetchOne("SELECT COUNT(*) c FROM contact_submissions WHERE status='archived'")['c'] ?? 0;
    }
} catch (Exception $e) {}

// ── Fetch current contact ────────────────────────────────────
$current_contact = null;
if ($contact_id) {
    try { $current_contact = fetchOne("SELECT * FROM contact_submissions WHERE id=?", [$contact_id]); } catch (Exception $e) {}
}

// ── Fetch list ───────────────────────────────────────────────
$filter_status = $_GET['status'] ?? 'all';
$search_query  = $_GET['search'] ?? '';
$contacts = [];
try {
    $pdo = getDBConnection();
    if ($pdo->query("SHOW TABLES LIKE 'contact_submissions'")->rowCount() > 0) {
        $q = "SELECT * FROM contact_submissions WHERE 1=1";
        $p = [];
        if ($filter_status !== 'all') { $q .= " AND status=?"; $p[] = $filter_status; }
        if (!empty($search_query)) {
            $q .= " AND (name LIKE ? OR email LIKE ? OR subject LIKE ?)";
            $sp = '%' . $search_query . '%';
            $p[] = $sp; $p[] = $sp; $p[] = $sp;
        }
        $q .= " ORDER BY created_at DESC";
        $contacts = fetchAll($q, $p);
    }
} catch (Exception $e) {}

include __DIR__ . '/layout.php';
?>

<?php if ($current_contact && $contact_id):
    $isComplaint = str_starts_with($current_contact['subject'], '[Complaint]');
    $statusLabel = $current_contact['status'] === 'replied' ? 'Replied'
        : ($current_contact['status'] === 'archived' ? 'Archived' : 'New');
    $statusColor = $current_contact['status'] === 'replied' ? '#059669'
        : ($current_contact['status'] === 'archived' ? '#6B7280' : 'var(--b-copper)');
?>
<!-- ===== DETAIL VIEW ===== -->
<div class="adm-page-header">
  <div>
    <a href="contacts.php" class="btn-adm-ghost" style="margin-bottom:.6rem;display:inline-flex;">
      <i class="fas fa-arrow-left"></i>Back to All Submissions
    </a>
    <h1>
      <?php if ($isComplaint): ?><span style="background:#92400e;color:#fff;font-size:.65rem;padding:.2rem .55rem;border-radius:3px;font-weight:700;vertical-align:middle;margin-right:.4rem;letter-spacing:.05em;">COMPLAINT</span><?php endif; ?>
      <?= htmlspecialchars($current_contact['subject']) ?>
    </h1>
    <p>From <strong><?= htmlspecialchars($current_contact['name']) ?></strong> · <?= formatDate($current_contact['created_at']) ?></p>
  </div>
  <span style="background:<?= $statusColor ?>22;color:<?= $statusColor ?>;border:1px solid <?= $statusColor ?>55;padding:.3rem .9rem;border-radius:20px;font-size:.75rem;font-weight:700;white-space:nowrap;"><?= $statusLabel ?></span>
</div>

<?php if ($success_message): ?>
<div class="adm-alert adm-alert-success"><i class="fas fa-circle-check"></i><?= htmlspecialchars($success_message) ?></div>
<?php endif; ?>
<?php if ($error_message): ?>
<div class="adm-alert adm-alert-danger"><i class="fas fa-circle-xmark"></i><?= htmlspecialchars($error_message) ?></div>
<?php endif; ?>

<div style="display:grid;grid-template-columns:1fr 300px;gap:1.25rem;align-items:start;">
  <!-- Left column -->
  <div>
    <!-- Sender info -->
    <div class="adm-card" style="margin-bottom:1rem;">
      <div class="adm-card-header"><i class="fas fa-user"></i>Sender Information</div>
      <div class="adm-card-body" style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
        <div><div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--b-muted);margin-bottom:.2rem;">Full Name</div>
          <div style="font-weight:600;"><?= htmlspecialchars($current_contact['name']) ?></div></div>
        <div><div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--b-muted);margin-bottom:.2rem;">Email</div>
          <div><a href="mailto:<?= htmlspecialchars($current_contact['email']) ?>" style="color:var(--b-green);"><?= htmlspecialchars($current_contact['email']) ?></a></div></div>
        <div><div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--b-muted);margin-bottom:.2rem;">Phone</div>
          <div><?= !empty($current_contact['phone']) ? '<a href="tel:' . htmlspecialchars($current_contact['phone']) . '" style="color:var(--b-green);">' . htmlspecialchars($current_contact['phone']) . '</a>' : '<span style="color:var(--b-muted);font-size:.85rem;">Not provided</span>' ?></div></div>
        <div><div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--b-muted);margin-bottom:.2rem;">Submitted</div>
          <div style="font-size:.88rem;"><?= formatDate($current_contact['created_at']) ?></div></div>
      </div>
    </div>

    <!-- Message -->
    <div class="adm-card" style="margin-bottom:1rem;">
      <div class="adm-card-header"><i class="fas fa-<?= $isComplaint ? 'triangle-exclamation' : 'message' ?>"></i><?= $isComplaint ? 'Complaint Message' : 'Message' ?></div>
      <div class="adm-card-body">
        <div style="background:<?= $isComplaint ? '#fdfaf2' : 'var(--b-tint)' ?>;border-left:4px solid <?= $isComplaint ? '#B8860B' : 'var(--b-green)' ?>;padding:1rem 1.2rem;border-radius:6px;white-space:pre-wrap;font-size:.93rem;line-height:1.75;color:#1e293b;">
          <?= nl2br(htmlspecialchars($current_contact['message'])) ?>
        </div>
      </div>
    </div>

    <!-- Previous reply -->
    <?php if (!empty($current_contact['admin_reply'])): ?>
    <div class="adm-card" style="margin-bottom:1rem;">
      <div class="adm-card-header"><i class="fas fa-reply"></i>Previous Reply</div>
      <div class="adm-card-body">
        <div style="font-size:.76rem;color:var(--b-muted);margin-bottom:.5rem;">Sent on <?= formatDate($current_contact['admin_reply_at']) ?></div>
        <div style="background:#f0fdf6;border-left:4px solid #059669;padding:1rem 1.2rem;border-radius:6px;white-space:pre-wrap;font-size:.93rem;line-height:1.75;">
          <?= nl2br(htmlspecialchars($current_contact['admin_reply'])) ?>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <!-- Reply form -->
    <?php if ($current_contact['status'] !== 'archived'): ?>
    <div class="adm-card" style="margin-bottom:1rem;">
      <div class="adm-card-header"><i class="fas fa-paper-plane"></i>Send Reply → <?= htmlspecialchars($current_contact['email']) ?></div>
      <div class="adm-card-body">
        <form method="POST">
          <input type="hidden" name="action" value="reply">
          <input type="hidden" name="id" value="<?= $contact_id ?>">
          <div class="adm-form-group">
            <textarea class="adm-textarea" name="reply_message" rows="6" required placeholder="Type your reply…"></textarea>
            <p style="font-size:.76rem;color:var(--b-muted);margin-top:.3rem;">An email will be sent to the customer automatically.</p>
          </div>
          <button type="submit" class="btn-adm-primary"><i class="fas fa-paper-plane"></i>Send Reply</button>
        </form>
      </div>
    </div>
    <?php endif; ?>
  </div>

  <!-- Right column -->
  <div>
    <div class="adm-card" style="margin-bottom:1rem;">
      <div class="adm-card-header"><i class="fas fa-info-circle"></i>Status</div>
      <div class="adm-card-body">
        <div style="background:<?= $statusColor ?>11;border-left:4px solid <?= $statusColor ?>;border-radius:6px;padding:.8rem 1rem;">
          <div style="color:<?= $statusColor ?>;font-weight:700;font-size:.85rem;"><?= strtoupper($statusLabel) ?></div>
          <div style="color:var(--b-muted);font-size:.75rem;margin-top:.2rem;">#<?= $current_contact['id'] ?> · <?= timeAgo($current_contact['created_at']) ?></div>
        </div>
        <?php if ($isComplaint): ?>
        <div style="background:#fdfaf2;border-left:4px solid #B8860B;border-radius:6px;padding:.7rem 1rem;margin-top:.6rem;">
          <div style="color:#92400e;font-weight:700;font-size:.76rem;">FLAGGED AS COMPLAINT</div>
        </div>
        <?php endif; ?>
      </div>
    </div>

    <div class="adm-card" style="margin-bottom:1rem;">
      <div class="adm-card-header"><i class="fas fa-sliders"></i>Actions</div>
      <div class="adm-card-body" style="display:grid;gap:.5rem;">
        <form method="POST">
          <input type="hidden" name="id" value="<?= $contact_id ?>">
          <?php if ($current_contact['status'] !== 'archived'): ?>
          <button type="submit" name="action" value="archive" class="btn-adm-ghost" style="width:100%;justify-content:center;background:#fef9ec;color:#92400e;border-color:#e2c97e;">
            <i class="fas fa-box-archive"></i>Archive
          </button>
          <?php endif; ?>
          <button type="submit" name="action" value="delete" class="btn-adm-danger" style="width:100%;justify-content:center;margin-top:.4rem;" onclick="return confirm('Permanently delete this submission?')">
            <i class="fas fa-trash"></i>Delete
          </button>
        </form>
      </div>
    </div>

    <div class="adm-card">
      <div class="adm-card-header"><i class="fas fa-tag"></i>Details</div>
      <div class="adm-card-body" style="display:grid;gap:.8rem;">
        <div><div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--b-muted);margin-bottom:.15rem;">Type</div>
          <?= $isComplaint ? '<span style="background:#92400e;color:#fff;font-size:.67rem;padding:.2rem .6rem;border-radius:4px;font-weight:700;">Complaint</span>' : '<span style="color:var(--b-green);font-weight:600;">Contact Query</span>' ?></div>
        <div><div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--b-muted);margin-bottom:.15rem;">Submission ID</div>
          <div style="font-weight:600;">#<?= $current_contact['id'] ?></div></div>
        <?php if (!empty($current_contact['admin_reply_at'])): ?>
        <div><div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--b-muted);margin-bottom:.15rem;">Last Replied</div>
          <div style="font-size:.87rem;"><?= formatDate($current_contact['admin_reply_at']) ?></div></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php else: ?>
<!-- ===== LIST VIEW ===== -->
<div class="adm-page-header">
  <div>
    <h1><i class="fas fa-envelope me-2" style="color:var(--b-copper);font-size:1.1rem;"></i>Contact Submissions</h1>
    <p>Manage customer inquiries and send replies</p>
  </div>
</div>

<?php if ($success_message): ?>
<div class="adm-alert adm-alert-success"><i class="fas fa-circle-check"></i><?= htmlspecialchars($success_message) ?></div>
<?php endif; ?>
<?php if ($error_message): ?>
<div class="adm-alert adm-alert-danger"><i class="fas fa-circle-xmark"></i><?= htmlspecialchars($error_message) ?></div>
<?php endif; ?>

<!-- Stats -->
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.5rem;">
  <?php
  $statDefs = [
    ['label'=>'Total','icon'=>'inbox','val'=>$stats['total'],'color'=>'var(--b-green)'],
    ['label'=>'New','icon'=>'bell','val'=>$stats['new'],'color'=>'#2563EB'],
    ['label'=>'Replied','icon'=>'circle-check','val'=>$stats['replied'],'color'=>'#059669'],
    ['label'=>'Archived','icon'=>'box-archive','val'=>$stats['archived'],'color'=>'#6B7280'],
  ];
  foreach ($statDefs as $s): ?>
  <div class="adm-stat" style="--accent-color:<?= $s['color'] ?>;--accent-bg:<?= $s['color'] ?>18;">
    <div class="stat-icon"><i class="fas fa-<?= $s['icon'] ?>"></i></div>
    <div class="stat-value"><?= $s['val'] ?></div>
    <div class="stat-label"><?= $s['label'] ?></div>
  </div>
  <?php endforeach; ?>
</div>

<!-- Filters -->
<div class="adm-card" style="margin-bottom:1.25rem;">
  <div class="adm-card-body">
    <form method="GET" style="display:flex;gap:1rem;align-items:flex-end;flex-wrap:wrap;">
      <div class="adm-form-group" style="flex:1;min-width:200px;margin:0;">
        <label>Search</label>
        <input class="adm-input" type="text" name="search" placeholder="Name, email, subject…" value="<?= htmlspecialchars($search_query) ?>">
      </div>
      <div class="adm-form-group" style="width:160px;margin:0;">
        <label>Status</label>
        <select class="adm-select" name="status">
          <?php foreach (['all'=>'All Statuses','new'=>'New','replied'=>'Replied','archived'=>'Archived'] as $v=>$l): ?>
          <option value="<?= $v ?>" <?= $filter_status===$v?'selected':'' ?>><?= $l ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <button type="submit" class="btn-adm-primary" style="margin-bottom:0;"><i class="fas fa-search"></i>Filter</button>
      <?php if ($filter_status!=='all'||$search_query): ?>
      <a href="contacts.php" class="btn-adm-ghost" style="margin-bottom:0;"><i class="fas fa-xmark"></i>Clear</a>
      <?php endif; ?>
    </form>
  </div>
</div>

<!-- Submissions table -->
<div class="adm-card">
  <?php if (empty($contacts)): ?>
  <div style="padding:3.5rem;text-align:center;color:var(--b-muted);">
    <i class="fas fa-inbox fa-2x" style="display:block;margin-bottom:.8rem;color:var(--b-border);"></i>
    No contact submissions found.
  </div>
  <?php else: ?>
  <div style="overflow-x:auto;">
    <table class="adm-table">
      <thead>
        <tr>
          <th style="width:38px;"></th>
          <th>From</th>
          <th>Subject</th>
          <th style="width:90px;">Status</th>
          <th style="width:100px;">Time</th>
          <th style="width:60px;"></th>
        </tr>
      </thead>
      <tbody>
      <?php
      $avatarColors = ['#1A5C42','#0369A1','#0F766E','#7C3AED','#B45309','#0D3D2E','#065F46'];
      foreach ($contacts as $i => $c):
          $isCom   = str_starts_with($c['subject'], '[Complaint]');
          $isNew   = $c['status'] === 'new';
          $initials = strtoupper(substr($c['name'],0,1));
          if (strpos($c['name'],' ')!==false) {
              $parts = explode(' ',$c['name']);
              $initials = strtoupper(substr($parts[0],0,1).substr(end($parts),0,1));
          }
          $avatarBg = $isCom ? '#92400e' : $avatarColors[$i % count($avatarColors)];
          $displaySubject = $isCom ? trim(substr($c['subject'],strlen('[Complaint]'))) : $c['subject'];
          $preview = substr(strip_tags($c['message']),0,55);
          $badgeClass = $c['status']==='replied' ? 'adm-badge-green' : ($c['status']==='archived' ? 'adm-badge-muted' : 'adm-badge-blue');
          $badgeText  = ucfirst($c['status']);
          $rowStyle = $isNew ? 'background:#f7f9ff;' : ($c['status']==='archived' ? 'opacity:.6;' : '');
      ?>
      <tr style="<?= $rowStyle ?>cursor:pointer;" onclick="window.location='contacts.php?id=<?= $c['id'] ?>'">
        <td>
          <div style="width:36px;height:36px;border-radius:50%;background:<?= $avatarBg ?>;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.8rem;"><?= $initials ?></div>
        </td>
        <td>
          <div style="font-weight:<?= $isNew?'700':'500' ?>;font-size:.87rem;"><?= htmlspecialchars($c['name']) ?></div>
          <div style="font-size:.74rem;color:var(--b-muted);"><?= htmlspecialchars($c['email']) ?></div>
        </td>
        <td>
          <?php if ($isCom): ?><span style="background:#92400e;color:#fff;font-size:.6rem;padding:.15rem .45rem;border-radius:3px;font-weight:700;letter-spacing:.05em;margin-right:.3rem;">COMPLAINT</span><?php endif; ?>
          <span style="font-weight:600;font-size:.85rem;"><?= htmlspecialchars($displaySubject) ?></span>
          <span style="color:var(--b-muted);font-size:.8rem;"> — <?= htmlspecialchars($preview) ?><?= strlen($c['message'])>55?'…':'' ?></span>
        </td>
        <td><span class="adm-badge <?= $badgeClass ?>"><?= $badgeText ?></span></td>
        <td style="font-size:.76rem;color:var(--b-muted);white-space:nowrap;"><?= timeAgo($c['created_at']) ?></td>
        <td><a href="contacts.php?id=<?= $c['id'] ?>" class="btn-adm-ghost btn-adm-sm" onclick="event.stopPropagation()"><i class="fas fa-eye"></i></a></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <?php endif; ?>
</div>
<?php endif; ?>

<?php include __DIR__ . '/layout-end.php'; ?>
