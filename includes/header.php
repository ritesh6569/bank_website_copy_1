<?php
/**
 * Header Component
 * Includes navigation bar, brand, and common meta tags
 */

// Always ensure config is loaded (covers pages that don't include it directly)
if (!defined('SITE_URL')) {
    require_once __DIR__ . '/../config.php';
}

// Set default page title
$page_title = isset($page_title) ? $page_title : 'Bank Website';
$current_page = isset($current_page) ? $current_page : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Shri Shantappanna Miraji Urban Co-op. Bank Ltd., Chikodi - 65 Years of Banking. A bank that understands you!">
    <meta name="keywords" content="Miraji Bank, Chikodi, Urban Co-operative Bank, deposits, loans, savings, Belagavi Karnataka">
    <meta name="author" content="Shri Shantappanna Miraji Urban Co-op. Bank Ltd.">
    <meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>">
    <meta property="og:description" content="Shri Shantappanna Miraji Urban Co-op. Bank Ltd., Chikodi - 65 Years of Banking">
    <meta property="og:image" content="/assets/images/og-image.jpg">
    <title><?php echo htmlspecialchars($page_title); ?> - Miraji Bank</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Professional Banking Theme -->
    <link href="<?php echo rtrim(SITE_URL,'/'); ?>/css/professional-theme.css" rel="stylesheet">
</head>
<body>
    <!-- Top Info Bar (hidden on mobile, visible on md and above) -->
    <div class="top-info-bar d-none d-md-block" style="background: #0D3D2E; color: rgba(255,255,255,0.85); font-size: 0.8rem; padding: 6px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
        <div class="container-lg d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span>
                <i class="fas fa-map-marker-alt me-1" style="color:#B87333;"></i>944-945, Guruwar Peth Chikodi, Belagavi Karnataka, 591201
            </span>
            <span class="d-flex gap-3">
                <a href="mailto:shantappanna@mirajibank.com" class="text-decoration-none" style="color:rgba(255,255,255,0.85);">
                    <i class="fas fa-envelope me-1" style="color:#B87333;"></i>shantappanna@mirajibank.com
                </a>
                <a href="http://www.shantappannamirajibank.com" target="_blank" class="text-decoration-none" style="color:rgba(255,255,255,0.85);">
                    <i class="fas fa-globe me-1" style="color:#B87333;"></i>www.shantappannamirajibank.com
                </a>
            </span>
        </div>
    </div>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-lg">
            <!-- Brand -->
            <a class="navbar-brand" href="<?php echo SITE_URL; ?>index.php">
                <img src="<?php echo rtrim(SITE_URL,'/'); ?>/assets/images/logo.png" alt="Miraji Bank" style="height:50px; width:auto; object-fit:contain;">
            </a>
            
            <!-- Toggle Button for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'home' ? 'active' : ''; ?>" 
                           href="<?php echo SITE_URL; ?>index.php">Home</a>
                    </li>
                    
                    <!-- About Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo $current_page === 'about' ? 'active' : ''; ?>" 
                           href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            About Us
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>pages/about.php#the-bank">The Bank</a></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>pages/about.php#our-founder">Our Founder</a></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>pages/about.php#chairman">Chairman</a></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>pages/about.php#board-of-directors">Board of Directors</a></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>pages/about.php#board-of-management">Board of Management</a></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>pages/about.php#general-manager">General Manager</a></li>
                        </ul>
                    </li>
                    
                    <!-- Products Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo $current_page === 'deposits' || $current_page === 'loans' ? 'active' : ''; ?>" 
                           href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Deposits
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>pages/deposits.php#cumulative">Cumulative Deposit</a></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>pages/deposits.php#fixed">Fixed Deposit</a></li>
                        </ul>
                    </li>
                    
                    <!-- Loans Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo $current_page === 'loans' ? 'active' : ''; ?>" 
                           href="#" id="loansDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Loans
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="loansDropdown">
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>pages/loans.php#cash-credit">Cash Credit</a></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>pages/loans.php#overdraft">Over Draft</a></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>pages/loans.php#personal">Personal Loan</a></li>
                        </ul>
                    </li>
                    
                    <!-- Services Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo $current_page === 'services' ? 'active' : ''; ?>" 
                           href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>pages/services.php">Banking Services</a></li>
                        </ul>
                    </li>
                    
                    <!-- Media Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo $current_page === 'media' ? 'active' : ''; ?>" 
                           href="#" id="mediaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Media
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="mediaDropdown">
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>pages/media.php">Media Center</a></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>pages/media.php#deaf-accounts">DEAF Accounts</a></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>pages/media.php#statutory-auditor">Appointment - Statutory Auditor</a></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>pages/media.php#agm-reports">AGM Notice and Annual Reports</a></li>
                        </ul>
                    </li>
                    
                    <!-- Contact Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo $current_page === 'contact' ? 'active' : ''; ?>" 
                           href="#" id="contactDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Contact Us
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="contactDropdown">
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>pages/contact.php">Contact Us</a></li>
                        </ul>
                    </li>
                </ul>
                
                <!-- Right Side Elements -->
                <div class="d-flex align-items-center ms-3">
                    <a href="<?php echo SITE_URL; ?>admin/login.php" class="btn btn-primary btn-sm">
                        <i class="fas fa-sign-in-alt me-1"></i>Admin Login
                    </a>
                </div>
            </div>
        </div>
    </nav>
