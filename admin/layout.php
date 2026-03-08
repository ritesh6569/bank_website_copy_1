<?php
/**
 * Admin Panel — Shared Layout
 * Include BEFORE any HTML output on each admin page.
 * Requires: $page_title, $admin_active (e.g. 'dashboard')
 */
if (session_status() === PHP_SESSION_NONE) session_start();
if (!defined('SITE_URL')) require_once __DIR__ . '/../config.php';

$_admin_nav = [
    'dashboard' => ['href'=>'index.php',    'icon'=>'fa-gauge-high',   'label'=>'Dashboard'],
    'contacts'  => ['href'=>'contacts.php', 'icon'=>'fa-envelope',     'label'=>'Contact Submissions'],
    'downloads' => ['href'=>'downloads.php','icon'=>'fa-file-arrow-down','label'=>'Downloads'],
    'notices'   => ['href'=>'notices.php',  'icon'=>'fa-bullhorn',     'label'=>'Notices'],
    'gallery'   => ['href'=>'gallery.php',  'icon'=>'fa-images',       'label'=>'Gallery'],
    'rates'     => ['href'=>'rates.php',    'icon'=>'fa-percent',      'label'=>'Interest Rates'],
];

// Try to get new-contacts badge count
$_nav_badge = [];
try {
    $pdo = getDBConnection();
    $_new = $pdo->query("SELECT COUNT(*) FROM contact_submissions WHERE status='new'")->fetchColumn();
    if ($_new > 0) $_nav_badge['contacts'] = $_new;
} catch (Exception $e) {}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($page_title ?? 'Admin') ?> — Miraji Bank</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
  /* ====== CSS VARIABLES ====== */
  :root {
    --s-bg:      #0D3D2E;
    --s-bg2:     #1A5C42;
    --s-accent:  #B87333;
    --s-accentH: #CC8A4A;
    --s-text:    rgba(255,255,255,0.88);
    --s-muted:   rgba(255,255,255,0.55);
    --s-border:  rgba(255,255,255,0.1);
    --s-active:  rgba(184,115,51,0.18);
    --s-width:   240px;
    --b-bg:      #F0F4F1;
    --b-card:    #ffffff;
    --b-border:  #D6E4DA;
    --b-text:    #1C2B22;
    --b-muted:   #5A7A67;
    --b-green:   #0D3D2E;
    --b-copper:  #B87333;
  }

  /* ====== RESET ====== */
  *, *::before, *::after { box-sizing: border-box; }
  body { margin:0; font-family:'Poppins',sans-serif; background:var(--b-bg); color:var(--b-text); font-size:0.9rem; }

  /* ====== SIDEBAR ====== */
  .adm-sidebar {
    position: fixed; top:0; left:0; height:100vh; width:var(--s-width);
    background: var(--s-bg);
    display: flex; flex-direction:column;
    z-index: 1000;
    transition: transform 0.28s ease;
  }
  .adm-sidebar-brand {
    padding: 1.4rem 1.25rem 1rem;
    border-bottom: 1px solid var(--s-border);
    flex-shrink: 0;
  }
  .adm-sidebar-brand .brand-name {
    font-size: 1rem; font-weight: 800; color: #fff; letter-spacing: 0.01em;
    display: flex; align-items: center; gap: 0.6rem;
  }
  .adm-sidebar-brand .brand-icon {
    width:32px; height:32px; background:var(--s-accent); border-radius:8px;
    display:flex; align-items:center; justify-content:center; flex-shrink:0;
  }
  .adm-sidebar-brand .brand-sub {
    font-size:0.72rem; color:var(--s-muted); margin-top:0.2rem; margin-left:40px;
  }
  .adm-sidebar-nav {
    flex:1; overflow-y:auto; padding:0.75rem 0;
    scrollbar-width: thin; scrollbar-color: rgba(255,255,255,0.1) transparent;
  }
  .adm-nav-section {
    font-size:0.65rem; font-weight:700; letter-spacing:0.1em; text-transform:uppercase;
    color:var(--s-muted); padding:0.6rem 1.25rem 0.3rem;
  }
  .adm-nav-link {
    display:flex; align-items:center; gap:0.7rem;
    padding:0.7rem 1.25rem; color:var(--s-text); text-decoration:none;
    font-size:0.84rem; font-weight:500;
    border-left:3px solid transparent;
    transition:all 0.18s;
    position:relative;
  }
  .adm-nav-link:hover { color:#fff; background:rgba(255,255,255,0.07); border-left-color:rgba(255,255,255,0.3); }
  .adm-nav-link.active { color:#fff; background:var(--s-active); border-left-color:var(--s-accent); font-weight:600; }
  .adm-nav-link .nav-icon { width:18px; text-align:center; font-size:0.85rem; opacity:0.85; }
  .adm-nav-link.active .nav-icon { opacity:1; color:var(--s-accentH); }
  .adm-nav-badge {
    margin-left:auto; background:var(--s-accent); color:#fff;
    font-size:0.65rem; font-weight:700; padding:0.15rem 0.45rem; border-radius:20px;
  }
  .adm-sidebar-footer {
    padding:0.85rem 1.25rem; border-top:1px solid var(--s-border); flex-shrink:0;
  }
  .adm-sidebar-footer a {
    display:flex; align-items:center; gap:0.6rem;
    color:var(--s-muted); text-decoration:none; font-size:0.82rem;
    padding:0.45rem 0; transition:color 0.18s;
  }
  .adm-sidebar-footer a:hover { color:#fff; }

  /* ====== MAIN CONTENT ====== */
  .adm-main {
    margin-left: var(--s-width);
    min-height: 100vh;
    display: flex; flex-direction:column;
  }

  /* ====== TOPBAR ====== */
  .adm-topbar {
    background:#fff; border-bottom:1px solid var(--b-border);
    padding:0.75rem 1.5rem;
    display:flex; align-items:center; justify-content:space-between; gap:1rem;
    position:sticky; top:0; z-index:100;
    box-shadow:0 1px 4px rgba(13,61,46,0.06);
  }
  .adm-topbar-left { display:flex; align-items:center; gap:0.75rem; }
  .adm-topbar .page-breadcrumb { font-size:0.8rem; color:var(--b-muted); }
  .adm-topbar .page-breadcrumb span { color:var(--b-text); font-weight:600; }
  .adm-topbar-right { display:flex; align-items:center; gap:0.75rem; }
  .adm-user-pill {
    display:flex; align-items:center; gap:0.5rem;
    background:#F0F4F1; border:1px solid var(--b-border);
    border-radius:25px; padding:0.3rem 0.8rem 0.3rem 0.4rem; font-size:0.8rem;
  }
  .adm-user-pill .avatar {
    width:26px; height:26px; background:var(--b-green); border-radius:50%;
    display:flex; align-items:center; justify-content:center; color:#fff; font-size:0.7rem; font-weight:700;
  }
  .adm-hamburger {
    display:none; background:none; border:none; color:var(--b-text);
    font-size:1.1rem; cursor:pointer; padding:0.25rem;
  }

  /* ====== PAGE CONTENT ====== */
  .adm-content { padding:1.75rem 1.5rem; flex:1; }

  /* ====== PAGE HEADER ====== */
  .adm-page-header {
    margin-bottom:1.5rem; padding-bottom:1rem; border-bottom:2px solid var(--b-border);
    display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:0.75rem;
  }
  .adm-page-header h1 { font-size:1.35rem; font-weight:800; color:var(--b-green); margin:0; }
  .adm-page-header p  { font-size:0.82rem; color:var(--b-muted); margin:0.2rem 0 0; }

  /* ====== CARDS ====== */
  .adm-card {
    background:var(--b-card); border:1px solid var(--b-border); border-radius:12px;
    box-shadow:0 1px 6px rgba(13,61,46,0.05); overflow:hidden;
  }
  .adm-card-header {
    background:var(--b-green); color:#fff;
    padding:0.85rem 1.25rem; font-weight:700; font-size:0.9rem;
    display:flex; align-items:center; gap:0.6rem;
  }
  .adm-card-header i { color:var(--s-accentH); }
  .adm-card-body { padding:1.25rem; }

  /* ====== STAT CARDS ====== */
  .adm-stat {
    background:var(--b-card); border:1px solid var(--b-border); border-radius:12px;
    padding:1.1rem 1.25rem; position:relative; overflow:hidden;
    transition:transform 0.2s, box-shadow 0.2s;
  }
  .adm-stat:hover { transform:translateY(-3px); box-shadow:0 8px 24px rgba(13,61,46,0.1); }
  .adm-stat::before {
    content:''; position:absolute; top:0; left:0; right:0; height:3px;
    background:var(--accent-color, var(--b-copper));
  }
  .adm-stat .stat-icon {
    width:42px; height:42px; border-radius:10px;
    background:var(--accent-bg, #EBF2ED); color:var(--accent-color, var(--b-green));
    display:flex; align-items:center; justify-content:center; font-size:1.1rem;
    float:right; margin-left:0.75rem;
  }
  .adm-stat .stat-value { font-size:1.9rem; font-weight:800; color:var(--b-text); line-height:1; margin-bottom:0.2rem; }
  .adm-stat .stat-label { font-size:0.75rem; font-weight:600; color:var(--b-muted); text-transform:uppercase; letter-spacing:0.05em; }
  .adm-stat .stat-sub   { font-size:0.78rem; color:var(--b-muted); margin-top:0.35rem; }
  .adm-stat .stat-sub .badge-green { color:#0D3D2E; background:#EBF2ED; padding:0.1rem 0.4rem; border-radius:4px; font-weight:600; }
  .adm-stat .stat-sub .badge-red   { color:#dc2626; background:#fee2e2; padding:0.1rem 0.4rem; border-radius:4px; font-weight:600; }

  /* ====== TABLES ====== */
  .adm-table { width:100%; border-collapse:collapse; font-size:0.84rem; }
  .adm-table thead th {
    background:#F0F4F1; color:var(--b-green); font-weight:700; font-size:0.75rem;
    text-transform:uppercase; letter-spacing:0.04em;
    padding:0.65rem 1rem; border-bottom:2px solid var(--b-border);
    white-space:nowrap;
  }
  .adm-table tbody tr { border-bottom:1px solid #EBF2ED; transition:background 0.12s; }
  .adm-table tbody tr:hover { background:#F7FAF8; }
  .adm-table tbody td { padding:0.7rem 1rem; color:var(--b-text); vertical-align:middle; }
  .adm-table tbody tr:last-child { border-bottom:none; }

  /* ====== BUTTONS ====== */
  .btn-adm-primary {
    background:var(--b-green); color:#fff; border:none; border-radius:7px;
    padding:0.45rem 1.1rem; font-size:0.83rem; font-weight:600; cursor:pointer;
    display:inline-flex; align-items:center; gap:0.4rem; text-decoration:none;
    transition:background 0.18s;
  }
  .btn-adm-primary:hover { background:#1A5C42; color:#fff; }
  .btn-adm-copper {
    background:var(--b-copper); color:#fff; border:none; border-radius:7px;
    padding:0.45rem 1.1rem; font-size:0.83rem; font-weight:600; cursor:pointer;
    display:inline-flex; align-items:center; gap:0.4rem; text-decoration:none;
    transition:background 0.18s;
  }
  .btn-adm-copper:hover { background:var(--s-accentH); color:#fff; }
  .btn-adm-ghost {
    background:transparent; color:var(--b-green); border:1px solid var(--b-border);
    border-radius:7px; padding:0.4rem 0.9rem; font-size:0.82rem; font-weight:500;
    cursor:pointer; display:inline-flex; align-items:center; gap:0.4rem; text-decoration:none;
    transition:all 0.18s;
  }
  .btn-adm-ghost:hover { background:#EBF2ED; border-color:#7CB9A0; color:var(--b-green); }
  .btn-adm-danger {
    background:#dc2626; color:#fff; border:none; border-radius:7px;
    padding:0.4rem 0.9rem; font-size:0.82rem; font-weight:600; cursor:pointer;
    display:inline-flex; align-items:center; gap:0.4rem; text-decoration:none;
    transition:background 0.18s;
  }
  .btn-adm-danger:hover { background:#b91c1c; color:#fff; }
  .btn-adm-sm { padding:0.28rem 0.65rem !important; font-size:0.75rem !important; }

  /* ====== BADGES ====== */
  .adm-badge {
    display:inline-block; font-size:0.7rem; font-weight:600; padding:0.2rem 0.55rem;
    border-radius:20px; letter-spacing:0.02em;
  }
  .adm-badge-green  { background:#DCF0E7; color:#0D5C2E; }
  .adm-badge-red    { background:#fee2e2; color:#b91c1c; }
  .adm-badge-amber  { background:#fef3c7; color:#92400e; }
  .adm-badge-blue   { background:#dbeafe; color:#1e40af; }
  .adm-badge-muted  { background:#EBF2ED; color:#5A7A67; }

  /* ====== FORMS ====== */
  .adm-form-group { margin-bottom:1rem; }
  .adm-form-group label { display:block; font-size:0.8rem; font-weight:600; color:var(--b-text); margin-bottom:0.35rem; }
  .adm-form-group label .req { color:#dc2626; margin-left:2px; }
  .adm-input, .adm-select, .adm-textarea {
    width:100%; padding:0.5rem 0.8rem; font-size:0.86rem; font-family:'Poppins',sans-serif;
    background:#fff; border:1px solid #C8DDD3; border-radius:7px; color:var(--b-text);
    transition:border 0.18s, box-shadow 0.18s; outline:none;
  }
  .adm-input:focus, .adm-select:focus, .adm-textarea:focus {
    border-color:var(--b-green); box-shadow:0 0 0 3px rgba(13,61,46,0.1);
  }
  .adm-textarea { resize:vertical; min-height:100px; }
  .adm-form-hint { font-size:0.75rem; color:var(--b-muted); margin-top:0.25rem; }

  /* ====== ALERTS ====== */
  .adm-alert {
    display:flex; align-items:flex-start; gap:0.7rem;
    padding:0.85rem 1rem; border-radius:8px; font-size:0.85rem; margin-bottom:1rem;
  }
  .adm-alert-success { background:#DCF0E7; color:#0D5C2E; border-left:4px solid #0D3D2E; }
  .adm-alert-danger  { background:#fee2e2; color:#b91c1c; border-left:4px solid #dc2626; }
  .adm-alert-info    { background:#EBF2ED; color:#0D3D2E; border-left:4px solid #2E8B63; }
  .adm-alert i { margin-top:0.1rem; flex-shrink:0; }

  /* ====== OVERLAY (mobile sidebar) ====== */
  .adm-overlay {
    display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); z-index:999;
  }
  .adm-overlay.show { display:block; }

  /* ====== RESPONSIVE ====== */
  @media (max-width: 768px) {
    .adm-sidebar { transform:translateX(calc(-1 * var(--s-width))); }
    .adm-sidebar.open { transform:translateX(0); }
    .adm-main { margin-left:0; }
    .adm-hamburger { display:block; }
    .adm-content { padding:1.1rem 1rem; }
    .adm-topbar { padding:0.65rem 1rem; }
  }
  </style>
</head>
<body>

<div class="adm-overlay" id="admOverlay"></div>

<!-- ===== SIDEBAR ===== -->
<aside class="adm-sidebar" id="admSidebar">
  <div class="adm-sidebar-brand">
    <div class="brand-name">
      <div class="brand-icon"><i class="fas fa-university" style="color:#fff;font-size:0.85rem;"></i></div>
      Miraji Bank
    </div>
    <div class="brand-sub">Admin Control Panel</div>
  </div>

  <nav class="adm-sidebar-nav">
    <div class="adm-nav-section">Main</div>
    <?php foreach ($_admin_nav as $key => $item): ?>
    <a href="<?= $item['href'] ?>" class="adm-nav-link<?= (($admin_active ?? '') === $key) ? ' active' : '' ?>">
      <i class="fas <?= $item['icon'] ?> nav-icon"></i>
      <?= $item['label'] ?>
      <?php if (isset($_nav_badge[$key])): ?>
        <span class="adm-nav-badge"><?= $_nav_badge[$key] ?></span>
      <?php endif; ?>
    </a>
    <?php endforeach; ?>
    <div class="adm-nav-section" style="margin-top:0.5rem;">Site</div>
    <a href="<?= SITE_URL ?>" target="_blank" class="adm-nav-link">
      <i class="fas fa-arrow-up-right-from-square nav-icon"></i>View Website
    </a>
  </nav>

  <div class="adm-sidebar-footer">
    <a href="logout.php">
      <i class="fas fa-right-from-bracket" style="width:18px;text-align:center;"></i>
      Sign Out
    </a>
  </div>
</aside>

<!-- ===== MAIN ===== -->
<div class="adm-main" id="admMain">

  <!-- Topbar -->
  <div class="adm-topbar">
    <div class="adm-topbar-left">
      <button class="adm-hamburger" id="admHamburger" aria-label="Menu">
        <i class="fas fa-bars"></i>
      </button>
      <div class="page-breadcrumb">
        Admin &rsaquo; <span><?= htmlspecialchars($page_title ?? '') ?></span>
      </div>
    </div>
    <div class="adm-topbar-right">
      <div style="font-size:0.78rem;color:var(--b-muted);" id="admClock"></div>
      <div class="adm-user-pill">
        <div class="avatar"><?= strtoupper(substr($_SESSION['admin_name'] ?? $_SESSION['admin_username'] ?? 'A', 0, 1)) ?></div>
        <?= htmlspecialchars($_SESSION['admin_name'] ?? $_SESSION['admin_username'] ?? 'Admin') ?>
      </div>
    </div>
  </div>

  <!-- Page Content -->
  <div class="adm-content">
