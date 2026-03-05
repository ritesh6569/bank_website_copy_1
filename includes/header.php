<?php
/**
 * Header Component
 * Includes navigation bar, brand, and common meta tags
 */

// Set default page title
$page_title = isset($page_title) ? $page_title : 'Bank Website';
$current_page = isset($current_page) ? $current_page : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your trusted banking partner offering deposits, loans, and modern banking services.">
    <meta name="keywords" content="bank, deposits, loans, savings, financial services">
    <meta name="author" content="Professional Bank">
    <meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>">
    <meta property="og:description" content="Your trusted banking partner">
    <meta property="og:image" content="/bank-website-grok/assets/images/og-image.jpg">
    <title><?php echo htmlspecialchars($page_title); ?> - Professional Bank</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Professional Banking Theme -->
    <link href="/bank-website-grok/css/professional-theme.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/bank-website-grok/assets/css/style.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-lg">
            <!-- Brand -->
            <a class="navbar-brand fw-bold text-white" href="/bank-website-grok/index.php">
                <i class="fas fa-university me-2"></i>Professional Bank
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
                           href="/bank-website-grok/index.php">Home</a>
                    </li>
                    
                    <!-- About Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo $current_page === 'about' ? 'active' : ''; ?>" 
                           href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            About
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                            <li><a class="dropdown-item" href="/bank-website-grok/pages/about.php">About Us</a></li>
                        </ul>
                    </li>
                    
                    <!-- Products Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo $current_page === 'deposits' || $current_page === 'loans' ? 'active' : ''; ?>" 
                           href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                            <li><a class="dropdown-item" href="/bank-website-grok/pages/deposits.php">Deposits</a></li>
                            <li><a class="dropdown-item" href="/bank-website-grok/pages/loans.php">Loans</a></li>
                        </ul>
                    </li>
                    
                    <!-- Services Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo $current_page === 'services' ? 'active' : ''; ?>" 
                           href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <li><a class="dropdown-item" href="/bank-website-grok/pages/services.php">Banking Services</a></li>
                        </ul>
                    </li>
                    
                    <!-- Media Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo $current_page === 'media' ? 'active' : ''; ?>" 
                           href="#" id="mediaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Media
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="mediaDropdown">
                            <li><a class="dropdown-item" href="/bank-website-grok/pages/media.php">Media Center</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'contact' ? 'active' : ''; ?>" 
                           href="/bank-website-grok/pages/contact.php">Contact</a>
                    </li>
                </ul>
                
                <!-- Right Side Elements -->
                <div class="d-flex align-items-center ms-3">
                    <a href="/bank-website-grok/admin/login.php" class="btn btn-primary btn-sm">
                        <i class="fas fa-sign-in-alt me-1"></i>Admin Login
                    </a>
                </div>
            </div>
        </div>
    </nav>
</body>
</html>
