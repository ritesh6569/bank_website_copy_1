<?php
/**
 * Manage Interest Rates
 * CRUD for loan_rates and deposit_rates tables
 */
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); exit();
}

$page_title  = 'Manage Interest Rates - Admin';
$active_tab  = $_GET['tab']    ?? 'loan';   // loan | deposit
$action      = $_GET['action'] ?? 'list';
$edit_id     = intval($_GET['id'] ?? 0);
$message     = '';
$message_type = '';

// ── Handle POST ───────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tab = $_POST['tab'] ?? 'loan';

    if ($tab === 'loan') {
        $category  = trim($_POST['category']      ?? '');
        $loan_type = trim($_POST['loan_type']     ?? '');
        $rate      = trim($_POST['interest_rate'] ?? '');
        $order     = intval($_POST['display_order'] ?? 0);
        $status    = $_POST['status'] ?? 'active';

        if (empty($category) || empty($loan_type) || empty($rate)) {
            $message = 'Category, Loan Type and Rate are required.';
            $message_type = 'danger';
        } elseif ($action === 'add') {
            executeUpdate("INSERT INTO loan_rates (category, loan_type, interest_rate, display_order, status) VALUES (?,?,?,?,?)",
                [$category, $loan_type, $rate, $order, $status]);
            $message = 'Loan rate added.'; $message_type = 'success'; $action = 'list';
        } elseif ($action === 'edit') {
            executeUpdate("UPDATE loan_rates SET category=?, loan_type=?, interest_rate=?, display_order=?, status=?, updated_at=NOW() WHERE id=?",
                [$category, $loan_type, $rate, $order, $status, $edit_id]);
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
            $message = 'Deposit Type, Period and General Rate are required.';
            $message_type = 'danger';
        } elseif ($action === 'add') {
            executeUpdate("INSERT INTO deposit_rates (deposit_type, period, general_rate, senior_rate, display_order, status) VALUES (?,?,?,?,?,?)",
                [$deposit_type, $period, $general_rate, $senior_rate, $order, $status]);
            $message = 'Deposit rate added.'; $message_type = 'success'; $action = 'list';
        } elseif ($action === 'edit') {
            executeUpdate("UPDATE deposit_rates SET deposit_type=?, period=?, general_rate=?, senior_rate=?, display_order=?, status=?, updated_at=NOW() WHERE id=?",
                [$deposit_type, $period, $general_rate, $senior_rate, $order, $status, $edit_id]);
            $message = 'Deposit rate updated.'; $message_type = 'success'; $action = 'list';
        }
        $active_tab = 'deposit';
    }
}

// ── Handle DELETE ─────────────────────────────────────────────
if ($action === 'delete') {
    $tab = $_GET['tab'] ?? 'loan';
    if ($tab === 'loan') {
        executeUpdate("DELETE FROM loan_rates WHERE id=?", [$edit_id]);
        $message = 'Loan rate deleted.'; $message_type = 'warning';
    } else {
        executeUpdate("DELETE FROM deposit_rates WHERE id=?", [$edit_id]);
        $message = 'Deposit rate deleted.'; $message_type = 'warning';
    }
    $active_tab = $tab; $action = 'list';
}

// ── Fetch data ────────────────────────────────────────────────
$loan_rates    = fetchAll("SELECT * FROM loan_rates    ORDER BY display_order, id") ?: [];
$deposit_rates = fetchAll("SELECT * FROM deposit_rates ORDER BY display_order, id") ?: [];

// Fetch record for editing
$edit_loan    = ($action === 'edit' && $active_tab === 'loan')
    ? fetchOne("SELECT * FROM loan_rates WHERE id=?",    [$edit_id]) : null;
$edit_deposit = ($action === 'edit' && $active_tab === 'deposit')
    ? fetchOne("SELECT * FROM deposit_rates WHERE id=?", [$edit_id]) : null;

// Unique categories for datalist
$categories = array_unique(array_column($loan_rates, 'category'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/professional-theme.css">
</head>
<body>
<div class="d-flex" style="min-height:100vh;">
    <!-- Sidebar -->
    <nav class="sidebar" style="width:250px;background:#1A2533;padding:2rem 0;position:fixed;height:100vh;overflow-y:auto;box-shadow:4px 0 12px rgba(15,31,53,.15);">
        <div class="sidebar-header mb-4 px-3">
            <div style="font-size:1.2rem;font-weight:800;color:white;padding-bottom:1rem;border-bottom:1px solid rgba(255,255,255,.1);">
                <i class="fas fa-university me-2" style="color:#B8860B;"></i>Admin Panel
            </div>
            <a href="<?php echo SITE_URL; ?>" class="d-block mt-3" style="color:rgba(255,255,255,.65);font-size:.85rem;text-decoration:none;">
                <i class="fas fa-arrow-left me-2"></i>Back to Site
            </a>
        </div>
        <ul class="nav flex-column px-0">
            <li class="nav-item"><a class="nav-link" href="index.php"     style="color:rgba(255,255,255,.75);padding:.85rem 1.5rem;border-left:3px solid transparent;"><i class="fas fa-chart-line me-2"></i>Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="contacts.php"  style="color:rgba(255,255,255,.75);padding:.85rem 1.5rem;border-left:3px solid transparent;"><i class="fas fa-envelope me-2"></i>Contact Submissions</a></li>
            <li class="nav-item"><a class="nav-link" href="downloads.php" style="color:rgba(255,255,255,.75);padding:.85rem 1.5rem;border-left:3px solid transparent;"><i class="fas fa-download me-2"></i>Manage Downloads</a></li>
            <li class="nav-item"><a class="nav-link" href="notices.php"   style="color:rgba(255,255,255,.75);padding:.85rem 1.5rem;border-left:3px solid transparent;"><i class="fas fa-bullhorn me-2"></i>Manage Notices</a></li>
            <li class="nav-item"><a class="nav-link" href="gallery.php"   style="color:rgba(255,255,255,.75);padding:.85rem 1.5rem;border-left:3px solid transparent;"><i class="fas fa-images me-2"></i>Manage Gallery</a></li>
            <li class="nav-item"><a class="nav-link" href="rates.php"     style="color:white;padding:.85rem 1.5rem;border-left:3px solid #B8860B;background:rgba(184,134,11,.12);font-weight:600;"><i class="fas fa-percent me-2" style="color:#B8860B;"></i>Interest Rates</a></li>
            <hr style="border-color:rgba(255,255,255,.1);margin:.75rem 0;">
            <li class="nav-item"><a class="nav-link" href="logout.php"    style="color:rgba(255,255,255,.65);padding:.85rem 1.5rem;border-left:3px solid transparent;"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main style="margin-left:250px;width:calc(100% - 250px);padding:2rem;">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="mb-1"><i class="fas fa-percent me-2 text-warning"></i>Interest Rates</h1>
                    <p class="text-muted">Manage loan and deposit interest rates shown on the website</p>
                </div>
            </div>

            <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show">
                <?php echo htmlspecialchars($message); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

            <!-- Tabs -->
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <a class="nav-link <?php echo $active_tab === 'loan' ? 'active' : ''; ?>"
                       href="rates.php?tab=loan">
                        <i class="fas fa-hand-holding-usd me-1"></i>Loan Rates
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $active_tab === 'deposit' ? 'active' : ''; ?>"
                       href="rates.php?tab=deposit">
                        <i class="fas fa-piggy-bank me-1"></i>Deposit Rates
                    </a>
                </li>
            </ul>

            <?php if ($active_tab === 'loan'): ?>
            <!-- ══ LOAN RATES ══ -->

            <?php if ($action === 'add' || ($action === 'edit' && $edit_loan)): ?>
            <!-- Add / Edit Loan Rate Form -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-<?php echo $action === 'add' ? 'plus' : 'edit'; ?> me-2"></i>
                        <?php echo $action === 'add' ? 'Add New Loan Rate' : 'Edit Loan Rate'; ?>
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="rates.php?action=<?php echo $action; ?>&tab=loan<?php echo $action === 'edit' ? '&id='.$edit_id : ''; ?>">
                        <input type="hidden" name="tab" value="loan">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                                <input type="text" name="category" class="form-control" list="cat-list"
                                    value="<?php echo htmlspecialchars($edit_loan['category'] ?? ''); ?>"
                                    placeholder="e.g. I. Industrial Loan / MSME" required>
                                <datalist id="cat-list">
                                    <?php foreach ($categories as $c): ?>
                                    <option value="<?php echo htmlspecialchars($c); ?>">
                                    <?php endforeach; ?>
                                </datalist>
                                <small class="text-muted">Group header for the table</small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Loan Type <span class="text-danger">*</span></label>
                                <input type="text" name="loan_type" class="form-control"
                                    value="<?php echo htmlspecialchars($edit_loan['loan_type'] ?? ''); ?>"
                                    placeholder="e.g. Working Capital" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Interest Rate <span class="text-danger">*</span></label>
                                <input type="text" name="interest_rate" class="form-control"
                                    value="<?php echo htmlspecialchars($edit_loan['interest_rate'] ?? ''); ?>"
                                    placeholder="e.g. 10.00%" required>
                            </div>
                            <div class="col-md-1">
                                <label class="form-label fw-semibold">Order</label>
                                <input type="number" name="display_order" class="form-control"
                                    value="<?php echo intval($edit_loan['display_order'] ?? 0); ?>">
                            </div>
                            <div class="col-md-1">
                                <label class="form-label fw-semibold">Status</label>
                                <select name="status" class="form-select">
                                    <option value="active"   <?php echo ($edit_loan['status'] ?? 'active') === 'active'   ? 'selected' : ''; ?>>Active</option>
                                    <option value="inactive" <?php echo ($edit_loan['status'] ?? '')        === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-3 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i><?php echo $action === 'add' ? 'Add Rate' : 'Update Rate'; ?>
                            </button>
                            <a href="rates.php?tab=loan" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
            <?php endif; ?>

            <!-- Loan Rates Table -->
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-table me-2"></i>Loan Interest Rates</h5>
                    <a href="rates.php?action=add&tab=loan" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i>Add Rate
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th style="width:40px;">#</th>
                                    <th>Category</th>
                                    <th>Loan Type</th>
                                    <th class="text-center">Rate (% p.a.)</th>
                                    <th class="text-center">Order</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($loan_rates)): ?>
                                <tr><td colspan="7" class="text-center text-muted py-4">No loan rates found. Click "Add Rate" to get started.</td></tr>
                                <?php else: ?>
                                <?php $i = 1; foreach ($loan_rates as $r): ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><span class="badge bg-secondary"><?php echo htmlspecialchars($r['category']); ?></span></td>
                                    <td><?php echo htmlspecialchars($r['loan_type']); ?></td>
                                    <td class="text-center"><strong><?php echo htmlspecialchars($r['interest_rate']); ?></strong></td>
                                    <td class="text-center"><?php echo $r['display_order']; ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-<?php echo $r['status'] === 'active' ? 'success' : 'secondary'; ?>">
                                            <?php echo ucfirst($r['status']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="rates.php?action=edit&tab=loan&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-primary me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="rates.php?action=delete&tab=loan&id=<?php echo $r['id']; ?>"
                                           class="btn btn-sm btn-outline-danger"
                                           onclick="return confirm('Delete this loan rate?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <?php else: ?>
            <!-- ══ DEPOSIT RATES ══ -->

            <?php if ($action === 'add' || ($action === 'edit' && $edit_deposit)): ?>
            <!-- Add / Edit Deposit Rate Form -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-<?php echo $action === 'add' ? 'plus' : 'edit'; ?> me-2"></i>
                        <?php echo $action === 'add' ? 'Add New Deposit Rate' : 'Edit Deposit Rate'; ?>
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="rates.php?action=<?php echo $action; ?>&tab=deposit<?php echo $action === 'edit' ? '&id='.$edit_id : ''; ?>">
                        <input type="hidden" name="tab" value="deposit">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Deposit Type <span class="text-danger">*</span></label>
                                <input type="text" name="deposit_type" class="form-control"
                                    value="<?php echo htmlspecialchars($edit_deposit['deposit_type'] ?? ''); ?>"
                                    placeholder="e.g. Term Deposit" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Period <span class="text-danger">*</span></label>
                                <input type="text" name="period" class="form-control"
                                    value="<?php echo htmlspecialchars($edit_deposit['period'] ?? ''); ?>"
                                    placeholder="e.g. 46 Days to 90 Days" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">General Rate <span class="text-danger">*</span></label>
                                <input type="text" name="general_rate" class="form-control"
                                    value="<?php echo htmlspecialchars($edit_deposit['general_rate'] ?? ''); ?>"
                                    placeholder="e.g. 5.00%" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Senior Citizen Rate</label>
                                <input type="text" name="senior_rate" class="form-control"
                                    value="<?php echo htmlspecialchars($edit_deposit['senior_rate'] ?? ''); ?>"
                                    placeholder="e.g. 5.50%">
                            </div>
                            <div class="col-md-1">
                                <label class="form-label fw-semibold">Order</label>
                                <input type="number" name="display_order" class="form-control"
                                    value="<?php echo intval($edit_deposit['display_order'] ?? 0); ?>">
                            </div>
                            <div class="col-md-1">
                                <label class="form-label fw-semibold">Status</label>
                                <select name="status" class="form-select">
                                    <option value="active"   <?php echo ($edit_deposit['status'] ?? 'active') === 'active'   ? 'selected' : ''; ?>>Active</option>
                                    <option value="inactive" <?php echo ($edit_deposit['status'] ?? '')        === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-3 d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i><?php echo $action === 'add' ? 'Add Rate' : 'Update Rate'; ?>
                            </button>
                            <a href="rates.php?tab=deposit" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
            <?php endif; ?>

            <!-- Deposit Rates Table -->
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-table me-2"></i>Deposit Interest Rates</h5>
                    <a href="rates.php?action=add&tab=deposit" class="btn btn-success btn-sm">
                        <i class="fas fa-plus me-1"></i>Add Rate
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered mb-0">
                            <thead class="table-success">
                                <tr>
                                    <th>#</th>
                                    <th>Deposit Type</th>
                                    <th>Period</th>
                                    <th class="text-center">General Rate</th>
                                    <th class="text-center">Senior Rate</th>
                                    <th class="text-center">Order</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($deposit_rates)): ?>
                                <tr><td colspan="8" class="text-center text-muted py-4">No deposit rates found. Click "Add Rate" to get started.</td></tr>
                                <?php else: ?>
                                <?php $i = 1; foreach ($deposit_rates as $r): ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo htmlspecialchars($r['deposit_type']); ?></td>
                                    <td><?php echo htmlspecialchars($r['period']); ?></td>
                                    <td class="text-center"><strong><?php echo htmlspecialchars($r['general_rate']); ?></strong></td>
                                    <td class="text-center"><strong><?php echo htmlspecialchars($r['senior_rate']); ?></strong></td>
                                    <td class="text-center"><?php echo $r['display_order']; ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-<?php echo $r['status'] === 'active' ? 'success' : 'secondary'; ?>">
                                            <?php echo ucfirst($r['status']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="rates.php?action=edit&tab=deposit&id=<?php echo $r['id']; ?>" class="btn btn-sm btn-outline-primary me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="rates.php?action=delete&tab=deposit&id=<?php echo $r['id']; ?>"
                                           class="btn btn-sm btn-outline-danger"
                                           onclick="return confirm('Delete this deposit rate?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
