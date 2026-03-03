<?php
/**
 * Search Page
 * Simple search functionality
 */

require_once 'config.php';
require_once 'includes/helpers.php';

$page_title = 'Search Results - ' . SITE_NAME;
$search_query = sanitize($_GET['q'] ?? '');

?>
<?php include 'includes/header.php'; ?>

<!-- Page Header -->
<section style="background: linear-gradient(135deg, #1e3a8a 0%, #2d5a8c 100%); color: white; padding: 60px 0;">
    <div class="container">
        <h1 class="mb-2">Search Results</h1>
        <?php if (!empty($search_query)): ?>
            <p style="color: rgba(255, 255, 255, 0.9);">Results for: <strong><?php echo escape($search_query); ?></strong></p>
        <?php endif; ?>
    </div>
</section>

<!-- Search Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Search Form -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="GET" class="d-flex gap-2">
                            <input 
                                type="search" 
                                name="q" 
                                class="form-control" 
                                placeholder="Search our website..." 
                                value="<?php echo escape($search_query); ?>"
                                autofocus
                            >
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Search Results -->
                <?php if (!empty($search_query)): ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Search functionality is currently limited. Here are some helpful pages:
                    </div>
                    
                    <div class="list-group">
                        <a href="<?php echo SITE_URL; ?>/deposits.php" class="list-group-item list-group-item-action">
                            <h6 class="mb-1"><i class="fas fa-wallet me-2"></i>Deposits</h6>
                            <p class="mb-0 text-muted">Learn about our savings, current, fixed, and recurring deposit products</p>
                        </a>
                        <a href="<?php echo SITE_URL; ?>/loans.php" class="list-group-item list-group-item-action">
                            <h6 class="mb-1"><i class="fas fa-money-bill me-2"></i>Loans</h6>
                            <p class="mb-0 text-muted">Explore personal, home, vehicle, and business loan options</p>
                        </a>
                        <a href="<?php echo SITE_URL; ?>/services.php" class="list-group-item list-group-item-action">
                            <h6 class="mb-1"><i class="fas fa-mobile-alt me-2"></i>Services</h6>
                            <p class="mb-0 text-muted">Access our internet banking, mobile banking, and other services</p>
                        </a>
                        <a href="<?php echo SITE_URL; ?>/media.php" class="list-group-item list-group-item-action">
                            <h6 class="mb-1"><i class="fas fa-newspaper me-2"></i>Media Center</h6>
                            <p class="mb-0 text-muted">Check news, rates, charges, and downloads</p>
                        </a>
                        <a href="<?php echo SITE_URL; ?>/contact.php" class="list-group-item list-group-item-action">
                            <h6 class="mb-1"><i class="fas fa-phone me-2"></i>Contact Us</h6>
                            <p class="mb-0 text-muted">Get in touch with our customer support team</p>
                        </a>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">
                        <i class="fas fa-search me-2"></i>
                        Please enter a search term to get started.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
