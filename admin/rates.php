<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); exit();
}

$page_title   = 'Interest Rates';
$admin_active = 'rates';
$active_tab   = $_GET['tab']    ?? 'loan';   // loan | deposit
$action       = $_GET['action'] ?? 'list';
$edit_id      = intval($_GET['id'] ?? 0);
$message = ''; $message_type = '';

// ── POST handler ─────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tab = $_POST['tab'] ?? 'loan';

    if ($tab === 'loan') {
        $category  = trim($_POST['category']      ?? '');
        $loan_type = trim($_POST['loan_type']     ?? '');
        $rate      = trim($_POST['interest_rate'] ?? '');
        $order     = intval($_POST['display_order'] ?? 0);
        $status    = $_POST['status'] ?? 'active';

        if (empty($category) || empty($loan_type) || empty($rate)) {
            $message = 'Category, Loan Type and Rate are required.'; $message_type = 'danger';
        } elseif ($action === 'add') {
            executeUpdate("INSERT INTO loan_rates (category,loan_type,interest_rate,display_order,status) VALUES (?,?,?,?,?)",
                [$category,$loan_type,$rate,$order,$status]);
            $message = 'Loan rate added.'; $message_type = 'success'; $action = 'list';
        } elseif ($action === 'edit') {
            executeUpdate("UPDATE loan_rates SET category=?,loan_type=?,interest_rate=?,display_order=?,status=?,updated_at=NOW() WHERE id=?",
                [$category,$loan_type,$rate,$order,$status,$edit_id]);
            $message = 'Loan rate updated.'; $message_type = 'success'; $action = 'list';
        }
        $active_tab = 'loan';

    } else { // deposit
        $deposit_type = trim($_POST['deposit_type'] ?? '');
        $period       = trim($_POST['period']       ?? '');
        $general_rate = trim($_POST['general_rate'] ?? '');
        $senior_rate  = trim($_POST['senior_rate']  ?? '');
        $order        = intval($_POST['display_order'] ?? 0);
        $status       = $_POST['status'] ?? 'active';

        if (empty($deposit_type) || empty($period) || empty($general_rate)) {
            $message = 'Deposit Type, Period and General Rate are required.'; $message_type = 'danger';
        } elseif ($action === 'add') {
            executeUpdate("INSERT INTO deposit_rates (deposit_type,period,general_rate,senior_rate,display_order,status) VALUES (?,?,?,?,?,?)",
                [$deposit_type,$period,$general_rate,$senior_rate,$order,$status]);
            $message = 'Deposit rate added.'; $message_type = 'success'; $action = 'list';
        } elseif ($action === 'edit') {
            executeUpdate("UPDATE deposit_rates SET deposit_type=?,period=?,general_rate=?,senior_rate=?,display_order=?,status=?,updated_at=NOW() WHERE id=?",
                [$deposit_type,$period,$general_rate,$senior_rate,$order,$status,$edit_id]);
            $message = 'Deposit rate updated.'; $message_type = 'success'; $action = 'list';
        }
        $active_tab = 'deposit';
    }
}

// ── DELETE ───────────────────────────────────────────────────
if ($action === 'delete') {
    $del_tab = $_GET['tab'] ?? 'loan';
    if ($del_tab === 'loan') {
        executeUpdate("DELETE FROM loan_rates WHERE id=?", [$edit_id]);
        $message = 'Loan rate deleted.'; $message_type = 'success';
    } else {
        executeUpdate("DELETE FROM deposit_rates WHERE id=?", [$edit_id]);
        $message = 'Deposit rate deleted.'; $message_type = 'success';
    }
    $active_tab = $del_tab; $action = 'list';
}

// ── Fetch ────────────────────────────────────────────────────
$loan_rates    = fetchAll("SELECT * FROM loan_rates    ORDER BY display_order, id") ?: [];
$deposit_rates = fetchAll("SELECT * FROM deposit_rates ORDER BY display_order, id") ?: [];
$edit_loan     = ($action==='edit' && $active_tab==='loan')    ? fetchOne("SELECT * FROM loan_rates    WHERE id=?", [$edit_id]) : null;
$edit_deposit  = ($action==='edit' && $active_tab==='deposit') ? fetchOne("SELECT * FROM deposit_rates WHERE id=?", [$edit_id]) : null;
$categories    = array_unique(array_column($loan_rates,'category'));

include __DIR__ . '/layout.php';
?>

<div class="adm-page-header">
  <div>
    <h1><i class="fas fa-percent me-2" style="color:var(--b-copper);font-size:1.1rem;"></i>Interest Rates</h1>
    <p>Manage loan and deposit interest rates displayed on the website</p>
  </div>
</div>

<?php if ($message): ?>
<div class="adm-alert adm-alert-<?= $message_type==='success'?'success':'danger' ?>">
  <i class="fas fa-<?= $message_type==='success'?'circle-check':'circle-xmark' ?>"></i><?= htmlspecialchars($message) ?>
</div>
<?php endif; ?>

<!-- Tab nav -->
<div style="display:flex;gap:0;border-bottom:2px solid var(--b-border);margin-bottom:1.5rem;">
  <a href="rates.php?tab=loan"
     style="padding:.65rem 1.4rem;font-size:.85rem;font-weight:600;text-decoration:none;border-bottom:3px solid <?= $active_tab==='loan'?'var(--b-copper)':'transparent' ?>;margin-bottom:-2px;color:<?= $active_tab==='loan'?'var(--b-copper)':'var(--b-muted)' ?>;">
    <i class="fas fa-hand-holding-dollar me-1"></i>Loan Rates
    <span class="adm-badge adm-badge-<?= $active_tab==='loan'?'amber':'muted' ?>" style="margin-left:.4rem;"><?= count($loan_rates) ?></span>
  </a>
  <a href="rates.php?tab=deposit"
     style="padding:.65rem 1.4rem;font-size:.85rem;font-weight:600;text-decoration:none;border-bottom:3px solid <?= $active_tab==='deposit'?'var(--b-copper)':'transparent' ?>;margin-bottom:-2px;color:<?= $active_tab==='deposit'?'var(--b-copper)':'var(--b-muted)' ?>;">
    <i class="fas fa-piggy-bank me-1"></i>Deposit Rates
    <span class="adm-badge adm-badge-<?= $active_tab==='deposit'?'amber':'muted' ?>" style="margin-left:.4rem;"><?= count($deposit_rates) ?></span>
  </a>
</div>

<?php if ($active_tab === 'loan'): ?>
<!-- ══════════════════════════════════════
     LOAN RATES
══════════════════════════════════════ -->

<?php if ($action==='add' || ($action==='edit' && $edit_loan)): ?>
<!-- Loan add/edit form -->
<div class="adm-card" style="margin-bottom:1.5rem;">
  <div class="adm-card-header"><i class="fas fa-<?= $action==='add'?'plus':'pen' ?>"></i><?= $action==='add'?'Add New Loan Rate':'Edit Loan Rate' ?></div>
  <div class="adm-card-body">
    <form method="POST" action="rates.php?action=<?= $action ?>&tab=loan<?= $action==='edit'?'&id='.$edit_id:'' ?>">
      <input type="hidden" name="tab" value="loan">
      <div style="display:grid;grid-template-columns:1fr 1fr 140px 90px 100px;gap:1rem;align-items:end;">
        <div class="adm-form-group" style="margin:0;">
          <label>Category <span class="req">*</span></label>
          <input class="adm-input" type="text" name="category" list="cat-list" required
                 value="<?= htmlspecialchars($edit_loan['category'] ?? '') ?>"
                 placeholder="e.g. I. Industrial Loan / MSME">
          <datalist id="cat-list">
            <?php foreach ($categories as $c): ?>
            <option value="<?= htmlspecialchars($c) ?>">
            <?php endforeach; ?>
          </datalist>
        </div>
        <div class="adm-form-group" style="margin:0;">
          <label>Loan Type <span class="req">*</span></label>
          <input class="adm-input" type="text" name="loan_type" required
                 value="<?= htmlspecialchars($edit_loan['loan_type'] ?? '') ?>"
                 placeholder="e.g. Working Capital">
        </div>
        <div class="adm-form-group" style="margin:0;">
          <label>Rate (% p.a.) <span class="req">*</span></label>
          <input class="adm-input" type="text" name="interest_rate" required
                 value="<?= htmlspecialchars($edit_loan['interest_rate'] ?? '') ?>"
                 placeholder="e.g. 10.50%">
        </div>
        <div class="adm-form-group" style="margin:0;">
          <label>Order</label>
          <input class="adm-input" type="number" name="display_order"
                 value="<?= intval($edit_loan['display_order'] ?? 0) ?>">
        </div>
        <div class="adm-form-group" style="margin:0;">
          <label>Status</label>
          <select class="adm-select" name="status">
            <option value="active"   <?= (($edit_loan['status']??'active')==='active')  ?'selected':'' ?>>Active</option>
            <option value="inactive" <?= (($edit_loan['status']??'')==='inactive')?'selected':'' ?>>Inactive</option>
          </select>
        </div>
      </div>
      <div style="display:flex;gap:.6rem;margin-top:1.2rem;">
        <button type="submit" class="btn-adm-primary"><i class="fas fa-floppy-disk"></i><?= $action==='add'?'Add Rate':'Update Rate' ?></button>
        <a href="rates.php?tab=loan" class="btn-adm-ghost"><i class="fas fa-xmark"></i>Cancel</a>
      </div>
    </form>
  </div>
</div>
<?php endif; ?>

<!-- Loan rates table -->
<div class="adm-card">
  <div style="display:flex;align-items:center;justify-content:space-between;padding:1rem 1.2rem;border-bottom:1px solid var(--b-border);">
    <div style="font-weight:700;color:var(--b-dark);font-size:.9rem;"><i class="fas fa-table me-2" style="color:var(--b-copper);"></i>Loan Interest Rates</div>
    <a href="rates.php?action=add&tab=loan" class="btn-adm-copper btn-adm-sm"><i class="fas fa-plus"></i>Add Rate</a>
  </div>
  <div style="overflow-x:auto;">
    <table class="adm-table">
      <thead>
        <tr><th>#</th><th>Category</th><th>Loan Type</th><th style="text-align:center;">Rate (% p.a.)</th><th style="text-align:center;">Order</th><th style="text-align:center;">Status</th><th style="text-align:center;width:110px;">Actions</th></tr>
      </thead>
      <tbody>
      <?php if (empty($loan_rates)): ?>
      <tr><td colspan="7" style="text-align:center;padding:2.5rem;color:var(--b-muted);">No loan rates yet. Click "Add Rate" to get started.</td></tr>
      <?php else: $i=1; foreach ($loan_rates as $r): ?>
      <tr>
        <td style="color:var(--b-muted);font-size:.78rem;"><?= $i++ ?></td>
        <td><span class="adm-badge adm-badge-muted"><?= htmlspecialchars($r['category']) ?></span></td>
        <td style="font-weight:500;"><?= htmlspecialchars($r['loan_type']) ?></td>
        <td style="text-align:center;"><strong style="color:var(--b-green);"><?= htmlspecialchars($r['interest_rate']) ?></strong></td>
        <td style="text-align:center;color:var(--b-muted);font-size:.82rem;"><?= $r['display_order'] ?></td>
        <td style="text-align:center;">
          <?= $r['status']==='active' ? '<span class="adm-badge adm-badge-green">Active</span>' : '<span class="adm-badge adm-badge-muted">Inactive</span>' ?>
        </td>
        <td style="text-align:center;display:flex;justify-content:center;gap:.4rem;">
          <a href="rates.php?action=edit&tab=loan&id=<?= $r['id'] ?>" class="btn-adm-ghost btn-adm-sm"><i class="fas fa-pen"></i></a>
          <a href="rates.php?action=delete&tab=loan&id=<?= $r['id'] ?>" class="btn-adm-danger btn-adm-sm" onclick="return confirm('Delete this loan rate?')"><i class="fas fa-trash"></i></a>
        </td>
      </tr>
      <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php else: ?>
<!-- ══════════════════════════════════════
     DEPOSIT RATES
══════════════════════════════════════ -->

<?php if ($action==='add' || ($action==='edit' && $edit_deposit)): ?>
<!-- Deposit add/edit form -->
<div class="adm-card" style="margin-bottom:1.5rem;">
  <div class="adm-card-header"><i class="fas fa-<?= $action==='add'?'plus':'pen' ?>"></i><?= $action==='add'?'Add New Deposit Rate':'Edit Deposit Rate' ?></div>
  <div class="adm-card-body">
    <form method="POST" action="rates.php?action=<?= $action ?>&tab=deposit<?= $action==='edit'?'&id='.$edit_id:'' ?>">
      <input type="hidden" name="tab" value="deposit">
      <div style="display:grid;grid-template-columns:1fr 1fr 120px 120px 90px 100px;gap:1rem;align-items:end;">
        <div class="adm-form-group" style="margin:0;">
          <label>Deposit Type <span class="req">*</span></label>
          <input class="adm-input" type="text" name="deposit_type" required
                 value="<?= htmlspecialchars($edit_deposit['deposit_type'] ?? '') ?>"
                 placeholder="e.g. Term Deposit">
        </div>
        <div class="adm-form-group" style="margin:0;">
          <label>Period <span class="req">*</span></label>
          <input class="adm-input" type="text" name="period" required
                 value="<?= htmlspecialchars($edit_deposit['period'] ?? '') ?>"
                 placeholder="e.g. 46–90 Days">
        </div>
        <div class="adm-form-group" style="margin:0;">
          <label>General Rate <span class="req">*</span></label>
          <input class="adm-input" type="text" name="general_rate" required
                 value="<?= htmlspecialchars($edit_deposit['general_rate'] ?? '') ?>"
                 placeholder="5.00%">
        </div>
        <div class="adm-form-group" style="margin:0;">
          <label>Senior Rate</label>
          <input class="adm-input" type="text" name="senior_rate"
                 value="<?= htmlspecialchars($edit_deposit['senior_rate'] ?? '') ?>"
                 placeholder="5.50%">
        </div>
        <div class="adm-form-group" style="margin:0;">
          <label>Order</label>
          <input class="adm-input" type="number" name="display_order"
                 value="<?= intval($edit_deposit['display_order'] ?? 0) ?>">
        </div>
        <div class="adm-form-group" style="margin:0;">
          <label>Status</label>
          <select class="adm-select" name="status">
            <option value="active"   <?= (($edit_deposit['status']??'active')==='active')  ?'selected':'' ?>>Active</option>
            <option value="inactive" <?= (($edit_deposit['status']??'')==='inactive')?'selected':'' ?>>Inactive</option>
          </select>
        </div>
      </div>
      <div style="display:flex;gap:.6rem;margin-top:1.2rem;">
        <button type="submit" class="btn-adm-primary"><i class="fas fa-floppy-disk"></i><?= $action==='add'?'Add Rate':'Update Rate' ?></button>
        <a href="rates.php?tab=deposit" class="btn-adm-ghost"><i class="fas fa-xmark"></i>Cancel</a>
      </div>
    </form>
  </div>
</div>
<?php endif; ?>

<!-- Deposit rates table -->
<div class="adm-card">
  <div style="display:flex;align-items:center;justify-content:space-between;padding:1rem 1.2rem;border-bottom:1px solid var(--b-border);">
    <div style="font-weight:700;color:var(--b-dark);font-size:.9rem;"><i class="fas fa-table me-2" style="color:var(--b-copper);"></i>Deposit Interest Rates</div>
    <a href="rates.php?action=add&tab=deposit" class="btn-adm-copper btn-adm-sm"><i class="fas fa-plus"></i>Add Rate</a>
  </div>
  <div style="overflow-x:auto;">
    <table class="adm-table">
      <thead>
        <tr><th>#</th><th>Deposit Type</th><th>Period</th><th style="text-align:center;">General Rate</th><th style="text-align:center;">Senior Rate</th><th style="text-align:center;">Order</th><th style="text-align:center;">Status</th><th style="text-align:center;width:110px;">Actions</th></tr>
      </thead>
      <tbody>
      <?php if (empty($deposit_rates)): ?>
      <tr><td colspan="8" style="text-align:center;padding:2.5rem;color:var(--b-muted);">No deposit rates yet. Click "Add Rate" to get started.</td></tr>
      <?php else: $i=1; foreach ($deposit_rates as $r): ?>
      <tr>
        <td style="color:var(--b-muted);font-size:.78rem;"><?= $i++ ?></td>
        <td style="font-weight:500;"><?= htmlspecialchars($r['deposit_type']) ?></td>
        <td style="color:var(--b-muted);font-size:.85rem;"><?= htmlspecialchars($r['period']) ?></td>
        <td style="text-align:center;"><strong style="color:var(--b-green);"><?= htmlspecialchars($r['general_rate']) ?></strong></td>
        <td style="text-align:center;"><strong style="color:var(--b-copper);"><?= htmlspecialchars($r['senior_rate'] ?: '—') ?></strong></td>
        <td style="text-align:center;color:var(--b-muted);font-size:.82rem;"><?= $r['display_order'] ?></td>
        <td style="text-align:center;">
          <?= $r['status']==='active' ? '<span class="adm-badge adm-badge-green">Active</span>' : '<span class="adm-badge adm-badge-muted">Inactive</span>' ?>
        </td>
        <td style="text-align:center;display:flex;justify-content:center;gap:.4rem;">
          <a href="rates.php?action=edit&tab=deposit&id=<?= $r['id'] ?>" class="btn-adm-ghost btn-adm-sm"><i class="fas fa-pen"></i></a>
          <a href="rates.php?action=delete&tab=deposit&id=<?= $r['id'] ?>" class="btn-adm-danger btn-adm-sm" onclick="return confirm('Delete this deposit rate?')"><i class="fas fa-trash"></i></a>
        </td>
      </tr>
      <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php endif; ?>

<?php include __DIR__ . '/layout-end.php'; ?>
