<?php
/**
 * Modern Header Component - 2025-2026 Theme
 * 
 * Design Philosophy:
 * - Slim, sticky navbar with glass-morphism effect
 * - Transparent → solid on scroll
 * - Mega-dropdowns for Products/Services
 * - Hamburger menu with smooth slide-in (mobile)
 * - Breadcrumb navigation on inner pages
 * - Full accessibility support (ARIA, keyboard nav, skip links)
 * 
 * Usage: Include in all PHP files
 * <?php include 'includes/header-modern.php'; ?>
 */

// Determine current page for active navigation
$current_page = basename($_SERVER['PHP_SELF']);
$pages = ['index.php' => 'Home', 'about.php' => 'About', 'deposits.php' => 'Products', 
          'loans.php' => 'Products', 'services.php' => 'Services', 'media.php' => 'Media', 
          'contact.php' => 'Contact'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Modern digital banking platform offering deposits, loans, and financial services with trust-centered design.">
    <meta name="keywords" content="banking, deposits, loans, financial services, digital bank">
    
    <!-- Open Graph Tags -->
    <meta property="og:title" content="Modern Banking | Trust, Security, Innovation">
    <meta property="og:description" content="Experience modern banking with transparent fees, competitive rates, and institutional credibility.">
    <meta property="og:image" content="/assets/images/og-image.png">
    <meta property="og:type" content="website">
    
    <!-- Theme & Branding -->
    <meta name="theme-color" content="#0d47a1">
    <link rel="icon" type="image/x-icon" href="/assets/icons/favicon.ico">
    
    <!-- JSON-LD Schema Markup for Bank -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FinancialService",
        "name": "Modern Digital Bank",
        "description": "Premium modern banking with institutional credibility",
        "url": "<?php echo isset($_SERVER['HTTP_HOST']) ? 'https://' . $_SERVER['HTTP_HOST'] : '#'; ?>",
        "telephone": "+1-800-BANK-123",
        "email": "support@bank.example.com",
        "sameAs": [
            "https://www.facebook.com/modernbank",
            "https://www.linkedin.com/company/modernbank"
        ],
        "areaServed": "US",
        "knowsAbout": ["Banking", "Deposits", "Loans", "Financial Services"]
    }
    </script>
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-9ndCyUaIbzAi2FUarbnLYV7BL5t6Z8I5ckLIeIAqMW4oVAJlkCvyUtT6E8wsMX0bc" 
          crossorigin="anonymous">
    
    <!-- Font Awesome 6.4 Icons -->
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" 
          rel="stylesheet"
          integrity="sha384-4bw+/aepP/YC94hJpQdFaiJD51FFTavN7KZCpm+omg6iaozhun54hqobiR+RsIFz" 
          crossorigin="anonymous">
    
    <!-- Google Fonts: Inter (body) & Sora (headings) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@600;700&display=swap" 
          rel="stylesheet">
    
    <!-- Modern Theme CSS -->
    <link rel="stylesheet" href="/css/modern-theme.css">
    
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) . ' | Modern Bank' : 'Modern Digital Banking'; ?></title>
</head>
<body>
    <!-- Skip to Content Link (Accessibility) -->
    <a href="#main-content" class="skip-link">Skip to main content</a>
    
    <!-- Navigation Bar -->
    <nav class="navbar" role="navigation" aria-label="Main navigation">
        <div class="navbar-container">
            <!-- Brand Logo -->
            <a href="/" class="navbar-brand" aria-label="Modern Bank - Home">
                <i class="fas fa-building"></i>
                <span>Modern Bank</span>
            </a>
            
            <!-- Main Navigation Menu -->
            <ul class="navbar-nav" id="navbar-menu" role="menubar">
                <!-- Home -->
                <li role="none">
                    <a href="/index.php" 
                       class="nav-link <?php echo $current_page === 'index.php' ? 'active' : ''; ?>"
                       role="menuitem">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                
                <!-- Products Dropdown -->
                <li role="none" class="nav-dropdown">
                    <button class="nav-link" id="products-menu" role="menuitem" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-box"></i> Products
                        <i class="fas fa-chevron-down" style="font-size: 0.75rem; margin-left: 0.25rem;"></i>
                    </button>
                    <div class="dropdown-menu" id="products-submenu" role="menu" aria-labelledby="products-menu">
                        <a href="/deposits.php" class="dropdown-item" role="menuitem">
                            <i class="fas fa-piggy-bank"></i> Savings Accounts
                        </a>
                        <a href="/loans.php" class="dropdown-item" role="menuitem">
                            <i class="fas fa-handshake"></i> Loan Products
                        </a>
                        <a href="#" class="dropdown-item" role="menuitem">
                            <i class="fas fa-credit-card"></i> Credit Cards
                        </a>
                        <a href="#" class="dropdown-item" role="menuitem">
                            <i class="fas fa-chart-line"></i> Investment Services
                        </a>
                    </div>
                </li>
                
                <!-- Services Dropdown -->
                <li role="none" class="nav-dropdown">
                    <button class="nav-link" id="services-menu" role="menuitem" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cogs"></i> Services
                        <i class="fas fa-chevron-down" style="font-size: 0.75rem; margin-left: 0.25rem;"></i>
                    </button>
                    <div class="dropdown-menu" id="services-submenu" role="menu" aria-labelledby="services-menu">
                        <a href="/services.php" class="dropdown-item" role="menuitem">
                            <i class="fas fa-exchange-alt"></i> Digital Services
                        </a>
                        <a href="#" class="dropdown-item" role="menuitem">
                            <i class="fas fa-mobile-alt"></i> Mobile Banking
                        </a>
                        <a href="#" class="dropdown-item" role="menuitem">
                            <i class="fas fa-lock"></i> Security & Protection
                        </a>
                        <a href="#" class="dropdown-item" role="menuitem">
                            <i class="fas fa-phone-alt"></i> Customer Support
                        </a>
                    </div>
                </li>
                
                <!-- About -->
                <li role="none">
                    <a href="/about.php" 
                       class="nav-link <?php echo $current_page === 'about.php' ? 'active' : ''; ?>"
                       role="menuitem">
                        <i class="fas fa-info-circle"></i> About
                    </a>
                </li>
                
                <!-- Media -->
                <li role="none">
                    <a href="/media.php" 
                       class="nav-link <?php echo $current_page === 'media.php' ? 'active' : ''; ?>"
                       role="menuitem">
                        <i class="fas fa-photo-video"></i> Media
                    </a>
                </li>
                
                <!-- Contact -->
                <li role="none">
                    <a href="/contact.php" 
                       class="nav-link <?php echo $current_page === 'contact.php' ? 'active' : ''; ?>"
                       role="menuitem">
                        <i class="fas fa-envelope"></i> Contact
                    </a>
                </li>
                
                <!-- Admin -->
                <li role="none">
                    <a href="/admin/index.php" 
                       class="nav-link"
                       role="menuitem">
                        <i class="fas fa-lock"></i> Admin
                    </a>
                </li>
            </ul>
            
            <!-- Mobile Menu Toggle -->
            <button class="navbar-toggle" id="menu-toggle" aria-label="Toggle navigation menu" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>
    
    <!-- Breadcrumb Navigation (on inner pages) -->
    <?php if ($current_page !== 'index.php'): ?>
    <div class="breadcrumb-container" style="background: var(--color-bg-secondary); border-bottom: 1px solid var(--color-border); padding: 1rem 0; margin-top: 60px;">
        <div class="container-lg">
            <nav aria-label="Breadcrumb">
                <ol class="breadcrumb" style="margin: 0;">
                    <li class="breadcrumb-item">
                        <a href="/index.php" style="color: var(--color-primary);">
                            <i class="fas fa-home" style="margin-right: 0.5rem;"></i> Home
                        </a>
                    </li>
                    <?php 
                    // Generate breadcrumb based on current page
                    $breadcrumbs = [
                        'about.php' => 'About Us',
                        'deposits.php' => ['Products', 'Savings'],
                        'loans.php' => ['Products', 'Loans'],
                        'services.php' => 'Services',
                        'media.php' => 'Media',
                        'contact.php' => 'Contact',
                        'search.php' => 'Search Results',
                        'privacy-policy.php' => 'Privacy Policy',
                        'terms.php' => 'Terms & Conditions'
                    ];
                    
                    if (isset($breadcrumbs[$current_page])) {
                        $crumbs = $breadcrumbs[$current_page];
                        if (is_array($crumbs)) {
                            foreach ($crumbs as $crumb) {
                                echo '<li class="breadcrumb-item">' . htmlspecialchars($crumb) . '</li>';
                            }
                        } else {
                            echo '<li class="breadcrumb-item active">' . htmlspecialchars($crumbs) . '</li>';
                        }
                    }
                    ?>
                </ol>
            </nav>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Main Content Area -->
    <main id="main-content" role="main">
        
        <!-- Page content will be inserted here by individual pages -->
