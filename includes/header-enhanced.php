<?php
/**
 * Enhanced Header Component
 * Includes modern styling, dark mode toggle, animations, and responsive design
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
    <meta name="keywords" content="bank, deposits, loans, savings, financial services, modern banking">
    <meta name="author" content="Professional Bank">
    <meta name="theme-color" content="#007BFF">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>">
    <meta property="og:description" content="Your trusted banking partner offering comprehensive financial solutions.">
    <meta property="og:image" content="/bank-website-grok/assets/images/og-image.jpg">
    <meta property="og:type" content="website">
    
    <!-- Schema Markup for Bank -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FinancialService",
        "name": "Professional Bank",
        "description": "Your trusted banking partner",
        "url": "<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . htmlspecialchars($_SERVER['HTTP_HOST']); ?>/bank-website-grok/",
        "telephone": "+1-234-567-890",
        "email": "support@bank.com",
        "sameAs": [
            "https://www.facebook.com/professionalbank",
            "https://www.twitter.com/professionalbank",
            "https://www.linkedin.com/company/professional-bank"
        ],
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "123 Banking Street",
            "addressLocality": "Financial City",
            "addressRegion": "FC",
            "postalCode": "12345",
            "addressCountry": "US"
        }
    }
    </script>
    
    <title><?php echo htmlspecialchars($page_title); ?> - Professional Bank</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/bank-website-grok/assets/icons/favicon.ico">
    <link rel="apple-touch-icon" href="/bank-website-grok/assets/icons/apple-touch-icon.png">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha512-t4Fjs0PSXaTvxnERTYV64e1PjjnmlQnT5aUjNXWAc+I0+4opm5YSznFQUEgruD2qnVIc7+Fhe0THcEp+4yIYdQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Font Awesome Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVJkEZSMUkrQ6usKu8zoxvq9/w/MJ5E/bbBvLmKKqLmBj5UWNPkwQp8T5VWrVBQ4/vKvI/WcBHw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Animate.css for advanced animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-d1tjaRY+PS50qvJ521KkB9FJNPKlSQS5qPLytW855mpbZ5IQD8omXee/8QFt6P636B82Pf4w0Fro3l4/+/SFQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700;800&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    
    <!-- Enhanced Custom CSS -->
    <link rel="stylesheet" href="/bank-website-grok/css/style-enhanced.css">
    
    <!-- Preload critical resources -->
    <link rel="preload" as="font" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700;800&family=Lato:wght@300;400;700&display=swap" crossorigin>
    
    <!-- Prefetch DNS for external resources -->
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
</head>
<body>
    <!-- Skip Navigation Link for Accessibility -->
    <a href="#main-content" class="sr-only">Skip to main content</a>
    
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top" role="navigation" aria-label="Main navigation">
        <div class="container-lg">
            <!-- Brand -->
            <a class="navbar-brand fw-bold" href="/bank-website-grok/index.php" aria-label="Professional Bank Home">
                <i class="fas fa-university me-2" style="color: var(--primary-color);"></i>Professional Bank
            </a>
            
            <!-- Toggle Button for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <!-- Home -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'home' ? 'active' : ''; ?>" 
                           href="/bank-website-grok/index.php" aria-label="Home page">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>
                    
                    <!-- About Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo $current_page === 'about' ? 'active' : ''; ?>" 
                           href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="About menu">
                            <i class="fas fa-info-circle me-1"></i> About
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                            <li><a class="dropdown-item" href="/bank-website-grok/pages/about.php"><i class="fas fa-building me-2"></i>About Us</a></li>
                        </ul>
                    </li>
                    
                    <!-- Products Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo $current_page === 'deposits' || $current_page === 'loans' ? 'active' : ''; ?>" 
                           href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Products menu">
                            <i class="fas fa-box me-1"></i> Products
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                            <li><a class="dropdown-item" href="/bank-website-grok/pages/deposits.php"><i class="fas fa-piggy-bank me-2"></i>Deposits</a></li>
                            <li><a class="dropdown-item" href="/bank-website-grok/pages/loans.php"><i class="fas fa-hand-holding-usd me-2"></i>Loans</a></li>
                        </ul>
                    </li>
                    
                    <!-- Services Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo $current_page === 'services' ? 'active' : ''; ?>" 
                           href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Services menu">
                            <i class="fas fa-cogs me-1"></i> Services
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <li><a class="dropdown-item" href="/bank-website-grok/pages/services.php"><i class="fas fa-laptop me-2"></i>Digital Services</a></li>
                            <li><a class="dropdown-item" href="/bank-website-grok/pages/services.php#transfers"><i class="fas fa-exchange-alt me-2"></i>Money Transfer (RTGS/NEFT)</a></li>
                            <li><a class="dropdown-item" href="/bank-website-grok/pages/services.php#locker"><i class="fas fa-vault me-2"></i>Safe Deposit Lockers</a></li>
                        </ul>
                    </li>
                    
                    <!-- Media/Gallery -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'media' ? 'active' : ''; ?>" 
                           href="/bank-website-grok/pages/media.php" aria-label="Gallery and media">
                            <i class="fas fa-images me-1"></i> Gallery
                        </a>
                    </li>
                    
                    <!-- Contact -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'contact' ? 'active' : ''; ?>" 
                           href="/bank-website-grok/pages/contact.php" aria-label="Contact us">
                            <i class="fas fa-envelope me-1"></i> Contact
                        </a>
                    </li>
                    
                    <!-- Admin Link -->
                    <li class="nav-item">
                        <a class="nav-link" href="/bank-website-grok/admin/login.php" aria-label="Admin panel">
                            <i class="fas fa-lock me-1"></i> Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Breadcrumb Navigation (for inner pages) -->
    <?php if ($current_page !== 'home'): ?>
    <nav aria-label="Breadcrumb" class="mt-3">
        <div class="container-lg">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="/bank-website-grok/index.php">
                        <i class="fas fa-home me-1"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php echo htmlspecialchars($page_title); ?>
                </li>
            </ol>
        </div>
    </nav>
    <?php endif; ?>
    
    <!-- Main Content -->
    <main id="main-content" role="main">
