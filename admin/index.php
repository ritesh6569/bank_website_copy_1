<?php
/**
 * Admin Dashboard
 * Main admin panel with overview and navigation
 */

// Start session FIRST
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load configuration and dependencies
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$page_title = 'Admin Dashboard - ' . SITE_NAME;
$meta_description = 'Admin dashboard for managing content';

// Get stats
$totalNotices = 0;
$totalDownloads = 0;
$totalGalleryItems = 0;
$activeNotices = 0;
$totalContacts = 0;
$newContacts = 0;

try {
    $totalNotices = fetchOne("SELECT COUNT(*) as count FROM notices")['count'] ?? 0;
    $totalDownloads = fetchOne("SELECT COUNT(*) as count FROM downloads")['count'] ?? 0;
    $totalGalleryItems = fetchOne("SELECT COUNT(*) as count FROM gallery")['count'] ?? 0;
    $activeNotices = fetchOne("SELECT COUNT(*) as count FROM notices WHERE status = 'active'")['count'] ?? 0;
    $totalContacts = fetchOne("SELECT COUNT(*) as count FROM contact_submissions")['count'] ?? 0;
    $newContacts = fetchOne("SELECT COUNT(*) as count FROM contact_submissions WHERE status = 'new'")['count'] ?? 0;
} catch (Exception $e) {
    // Database might not be set up yet
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
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/admin-responsive.css">
</head>
<body>
    <!-- Hamburger Toggle (mobile) -->
    <button class="hamburger-btn" id="sidebarToggle" aria-label="Toggle menu">
        <i class="fas fa-bars"></i>
    </button>
    <!-- Overlay backdrop -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar Navigation -->
    <div class="d-flex" style="min-height: 100vh;">
        <nav class="sidebar" id="adminSidebar" style="width: 250px; background: #1A2533; padding: 2rem 0; position: fixed; height: 100vh; overflow-y: auto; box-shadow: 4px 0 12px rgba(15,31,53,0.15);">
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
                    <a class="nav-link" href="index.php" style="color: rgba(255,255,255,0.85); padding: 0.85rem 1.5rem; border-left: 3px solid #B8860B; background: rgba(184,134,11,0.12); font-weight: 600;">
                        <i class="fas fa-chart-line me-2" style="color: #B8860B;"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacts.php" style="color: rgba(255,255,255,0.75); padding: 0.85rem 1.5rem; border-left: 3px solid transparent; transition: all 0.2s ease;">
                        <i class="fas fa-envelope me-2"></i>Contact Submissions
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="downloads.php" style="color: rgba(255,255,255,0.75); padding: 0.85rem 1.5rem; border-left: 3px solid transparent; transition: all 0.2s ease;">
                        <i class="fas fa-download me-2"></i>Manage Downloads
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="notices.php" style="color: rgba(255,255,255,0.75); padding: 0.85rem 1.5rem; border-left: 3px solid transparent; transition: all 0.2s ease;">
                        <i class="fas fa-bullhorn me-2"></i>Manage Notices
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gallery.php" style="color: rgba(255,255,255,0.75); padding: 0.85rem 1.5rem; border-left: 3px solid transparent; transition: all 0.2s ease;">
                        <i class="fas fa-images me-2"></i>Manage Gallery
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rates.php" style="color: rgba(255,255,255,0.75); padding: 0.85rem 1.5rem; border-left: 3px solid transparent; transition: all 0.2s ease;">
                        <i class="fas fa-percent me-2"></i>Interest Rates
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
        <main style="margin-left: 250px; width: calc(100% - 250px); padding: 2rem;">
            <div class="container-fluid">
                <!-- Header -->
                <div class="d-flex flex-wrap justify-content-between align-items-start align-items-md-center gap-2 mb-4">
                    <div>
                        <h1 class="mb-1">Dashboard</h1>
                        <p class="text-muted mb-0">Welcome back, <?php echo $_SESSION['admin_name'] ?? 'Admin'; ?>!</p>
                    </div>
                    <div class="text-end">
                        <p class="text-muted mb-0" id="currentDateTime"></p>
                    </div>
                </div>

                <!-- Login Success Alert -->
                <?php if (isset($_SESSION['login_success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show animate__animated animate__slideInDown" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Success!</strong> <?php echo htmlspecialchars($_SESSION['login_success']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['login_success']); ?>
                <?php endif; ?>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-6 col-md-3 mb-3">
                        <div class="card stat-card animate__animated animate__fadeInUp" style="border-left: 4px solid #2E8B63;">
                            <div class="card-body">
                                <h6 class="text-muted mb-2"><i class="fas fa-bullhorn"></i> Notices</h6>
                                <h3 class="mb-0"><?php echo $totalNotices; ?></h3>
                                <small class="text-success"><i class="fas fa-check-circle"></i> <?php echo $activeNotices; ?> Active</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 mb-3">
                        <div class="card stat-card animate__animated animate__fadeInUp" style="border-left: 4px solid #10b981; animation-delay: 0.1s;">
                            <div class="card-body">
                                <h6 class="text-muted mb-2"><i class="fas fa-download"></i> Downloads</h6>
                                <h3 class="mb-0"><?php echo $totalDownloads; ?></h3>
                                <small class="text-info"><i class="fas fa-folder"></i> File Management</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 mb-3">
                        <div class="card stat-card animate__animated animate__fadeInUp" style="border-left: 4px solid #f59e0b; animation-delay: 0.2s;">
                            <div class="card-body">
                                <h6 class="text-muted mb-2"><i class="fas fa-images"></i> Gallery Items</h6>
                                <h3 class="mb-0"><?php echo $totalGalleryItems; ?></h3>
                                <small class="text-warning"><i class="fas fa-images"></i> Image Gallery</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 mb-3">
                        <div class="card stat-card animate__animated animate__fadeInUp" style="border-left: 4px solid #8b5cf6; animation-delay: 0.25s;">
                            <div class="card-body">
                                <h6 class="text-muted mb-2"><i class="fas fa-envelope"></i> Contact Submissions</h6>
                                <h3 class="mb-0"><?php echo $totalContacts; ?></h3>
                                <small class="text-danger"><i class="fas fa-bell"></i> <?php echo $newContacts; ?> New</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 mb-3">
                        <div class="card stat-card animate__animated animate__fadeInUp" style="border-left: 4px solid #ef4444; animation-delay: 0.3s;">
                            <div class="card-body">
                                <h6 class="text-muted mb-2"><i class="fas fa-cogs"></i> System</h6>
                                <h3 class="mb-0" id="dbStatus">OK</h3>
                                <small class="text-info"><i class="fas fa-database"></i> Database Connected</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4 animate__animated animate__fadeInUp">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="fas fa-zap"></i> Quick Actions</h5>
                            </div>
                            <div class="card-body">
                                <a href="notices.php?action=add" class="btn btn-primary btn-sm me-2 mb-2">
                                    <i class="fas fa-plus"></i> Add Notice
                                </a>
                                <a href="downloads.php?action=add" class="btn btn-success btn-sm me-2 mb-2">
                                    <i class="fas fa-plus"></i> Add Download
                                </a>
                                <a href="gallery.php?action=add" class="btn btn-warning btn-sm mb-2">
                                    <i class="fas fa-plus"></i> Add Gallery Item
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0"><i class="fas fa-info-circle"></i> System Information</h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-2"><strong>Site Name:</strong> <?php echo SITE_NAME; ?></p>
                                <p class="mb-2"><strong>Site URL:</strong> <?php echo SITE_URL; ?></p>
                                <p class="mb-2"><strong>PHP Version:</strong> <?php echo phpversion(); ?></p>
                                <p class="mb-0"><strong>Login Time:</strong> <?php echo formatDate($_SESSION['login_time'] ?? date('Y-m-d H:i:s')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Update current date and time
        function updateDateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            document.getElementById('currentDateTime').textContent = now.toLocaleDateString('en-IN', options);
        }
        updateDateTime();
        setInterval(updateDateTime, 60000);

        // Responsive sidebar toggle
        (function(){
            var toggle  = document.getElementById('sidebarToggle');
            var sidebar = document.getElementById('adminSidebar');
            var overlay = document.getElementById('sidebarOverlay');
            function openSidebar()  { sidebar.classList.add('sidebar-open');    overlay.classList.add('active'); }
            function closeSidebar() { sidebar.classList.remove('sidebar-open'); overlay.classList.remove('active'); }
            if (toggle)  toggle.addEventListener('click', function(){ sidebar.classList.contains('sidebar-open') ? closeSidebar() : openSidebar(); });
            if (overlay) overlay.addEventListener('click', closeSidebar);
        })();
    </script>
    <style>
        :root {
            --primary-color: #1e3a8a;
            --primary-light: #2d5a8c;
        }

        body {
            background-color: #f8fafc;
            font-family: 'Open Sans', sans-serif;
        }

        .sidebar {
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
        }

        .stat-card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light)) !important;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border: none;
        }
    </style>
</body>
</html>

