<?php
/**
 * Home Page - Shri Shantappanna Miraji Urban Co-op. Bank Ltd.
 */

$page_title = 'Home - Miraji Bank';
$current_page = 'home';

// Include header
require_once __DIR__ . '/config.php';
include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/data-fetcher.php';
include __DIR__ . '/includes/notices-fetcher.php';

// Get data
$offers = $data_fetcher->getOffers();
$branches = $data_fetcher->getBranches();
$notices = getActiveNotices();
?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container-lg">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content text-center text-lg-start">
                    <p class="hero-subtitle mb-1" style="font-size:1rem; color: rgba(255,255,255,0.7); letter-spacing:1px; text-transform:uppercase;">65 Years of Banking</p>
                    <h1 class="hero-title">Shri Shantappanna Miraji Urban Co-op. Bank Ltd.</h1>
                    <p class="hero-subtitle">Keep Faith — Shri Shantappanna Miraji Urban Co-op. Bank Ltd., Chikodi, serving the community since 1961.</p>
                    <div class="hero-buttons">
                        <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-lg-start">
                            <a href="<?php echo SITE_URL; ?>pages/deposits.php" class="btn btn-light">
                                <i class="fas fa-piggy-bank me-2"></i>Deposits
                            </a>
                            <a href="<?php echo SITE_URL; ?>pages/loans.php" class="btn btn-outline-light">
                                <i class="fas fa-handshake me-2"></i>Loans
                            </a>
                            <a href="<?php echo SITE_URL; ?>pages/about.php#the-bank" class="btn btn-outline-light">
                                <i class="fas fa-info-circle me-2"></i>Read More
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="hero-image" style="text-align: center;">
                        <i class="fas fa-university" style="font-size: 15rem; color: rgba(255,255,255,0.2);"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Offers/Highlights Section -->
    <section class="section bg-light">
        <div class="container-lg">
            <div class="section-title">
                <h2>Products & Highlights</h2>
                <p class="section-subtitle">Explore our best-in-class products and special offerings for our valued members</p>
            </div>
            
            <div class="row g-4">
                <?php foreach ($offers as $offer): ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="card feature-card h-100">
                            <div class="card-body d-flex flex-column p-4">
                                <i class="<?php echo htmlspecialchars($offer['icon']); ?> mb-3" style="font-size:2rem; color: var(--secondary-color);"></i>
                                <h5 class="card-title mb-2"><?php echo htmlspecialchars($offer['title']); ?></h5>
                                <p class="text-muted mb-4 flex-grow-1"><?php echo htmlspecialchars($offer['description']); ?></p>
                                <a href="<?php echo htmlspecialchars($offer['link'] ?? '/pages/deposits.php'); ?>" class="btn btn-sm btn-primary mt-auto align-self-start">Learn More</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Quick Links Section -->
    <section class="section">
        <div class="container-lg">
            <div class="section-title">
                <h2>Quick Links to Key Services</h2>
                <p class="section-subtitle">Navigate directly to the services you need</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <a href="<?php echo SITE_URL; ?>pages/deposits.php#savings" class="card text-decoration-none h-100" style="border-left: 4px solid var(--secondary-color);">
                        <div class="card-body text-center">
                            <i class="fas fa-piggy-bank" style="font-size: 2.5rem; color: var(--secondary-color); margin-bottom: 1rem;"></i>
                            <h5 class="card-title">Deposits</h5>
                            <p class="text-muted small">Savings, Current, FD, Kalyan Nidhi & Pigmy</p>
                        </div>
                    </a>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <a href="<?php echo SITE_URL; ?>pages/loans.php#gold" class="card text-decoration-none h-100" style="border-left: 4px solid var(--success-color);">
                        <div class="card-body text-center">
                            <i class="fas fa-hand-holding-usd" style="font-size: 2.5rem; color: var(--success-color); margin-bottom: 1rem;"></i>
                            <h5 class="card-title">Loans</h5>
                            <p class="text-muted small">Gold, Housing, Vehicle & Business Loans</p>
                        </div>
                    </a>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <a href="<?php echo SITE_URL; ?>pages/services.php#rtgs" class="card text-decoration-none h-100" style="border-left: 4px solid var(--warning-color);">
                        <div class="card-body text-center">
                            <i class="fas fa-exchange-alt" style="font-size: 2.5rem; color: var(--warning-color); margin-bottom: 1rem;"></i>
                            <h5 class="card-title">Services</h5>
                            <p class="text-muted small">RTGS/NEFT, CTS Cheques, EMI & Pay Order</p>
                        </div>
                    </a>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <a href="<?php echo SITE_URL; ?>pages/contact.php" class="card text-decoration-none h-100" style="border-left: 4px solid var(--danger-color);">
                        <div class="card-body text-center">
                            <i class="fas fa-phone" style="font-size: 2.5rem; color: var(--danger-color); margin-bottom: 1rem;"></i>
                            <h5 class="card-title">Support</h5>
                            <p class="text-muted small">Contact our branches</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Overview Section -->
    <section class="section bg-light">
        <div class="container-lg">
            <div class="section-title">
                <h2>Our Products</h2>
                <p class="section-subtitle">Explore our comprehensive range of banking products</p>
            </div>
            
            <div class="row g-4">
                <!-- Deposits Overview -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-book me-2"></i>Deposit Products</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Grow your savings with our range of deposit products offering competitive interest rates and flexible terms.</p>
                            <ul class="list-unstyled">
                                <li class="py-2 border-bottom">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Savings Bank Deposit</strong> — 3.00% p.a. (3.50% Senior Citizen)
                                </li>
                                <li class="py-2 border-bottom">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Fixed Deposit</strong> — Up to 8.00% p.a. (8.50% Senior)
                                </li>
                                <li class="py-2 border-bottom">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Kalyan Nidhi Recurring Deposit</strong> — Monthly savings scheme
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Yeshwant Pigmy Deposit</strong> — Daily doorstep collection
                                </li>
                            </ul>
                            <a href="<?php echo SITE_URL; ?>pages/deposits.php" class="btn btn-primary mt-3">
                                View All Deposits <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Loans Overview -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-credit-card me-2"></i>Loan Products</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Get the financial support you need with our flexible loan options and competitive interest rates.</p>
                            <ul class="list-unstyled">
                                <li class="py-2 border-bottom">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Gold Loan</strong> — From 9.00% p.a., quick disbursal
                                </li>
                                <li class="py-2 border-bottom">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Housing Loan</strong> — Construction & purchase from 10.50% p.a.
                                </li>
                                <li class="py-2 border-bottom">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Cash Credit / Working Capital</strong> — Industrial & MSME
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Vehicle Loan</strong> — 4-wheeler from 10.50%, 2-wheeler 11.00%
                                </li>
                            </ul>
                            <a href="<?php echo SITE_URL; ?>pages/loans.php" class="btn btn-primary mt-3">
                                View All Loans <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest News & Updates Section (powered by admin notices) -->
    <section class="section">
        <div class="container-lg">
            <div class="section-title">
                <h2>Latest News &amp; Updates</h2>
                <p class="section-subtitle">Stay informed with our latest announcements and bank news</p>
            </div>

            <?php if (!empty($notices)): ?>
            <div class="row g-4">
                <?php foreach (array_slice($notices, 0, 3) as $notice): ?>
                    <div class="col-md-4">
                        <div class="card h-100" style="border-left: 4px solid var(--color-accent, #1e40af);">
                            <div class="card-body">
                                <small class="text-muted">
                                    <i class="far fa-calendar me-1"></i>
                                    <?php echo date('M d, Y', strtotime($notice['date_published'])); ?>
                                </small>
                                <h5 class="card-title mt-2"><?php echo htmlspecialchars($notice['title']); ?></h5>
                                <p class="card-text text-muted">
                                    <?php echo htmlspecialchars(truncateNotice(stripHtmlTags($notice['content']), 150)); ?>
                                </p>
                                <a href="#noticeModal<?php echo $notice['id']; ?>" class="btn btn-sm btn-outline-primary"
                                   data-bs-toggle="modal" data-bs-target="#noticeModal<?php echo $notice['id']; ?>">
                                    Read More <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (count($notices) > 3): ?>
            <div class="text-center mt-4">
                <a href="<?php echo SITE_URL; ?>pages/media.php#notices" class="btn btn-outline-primary">
                    <i class="fas fa-list me-2"></i>View All Notices (<?php echo count($notices); ?>)
                </a>
            </div>
            <?php endif; ?>

            <?php else: ?>
            <p class="text-center text-muted">No news or updates at the moment. Please check back soon.</p>
            <?php endif; ?>

        </div>
    </section>

    <!-- Notice Detail Modals -->
    <?php foreach ($notices as $notice): ?>
    <div class="modal fade" id="noticeModal<?php echo $notice['id']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); color: white; border: none;">
                    <h5 class="modal-title">
                        <i class="fas fa-bell me-2"></i><?php echo htmlspecialchars($notice['title']); ?>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <small class="text-muted d-block mb-3">
                        <i class="fas fa-calendar-alt me-1"></i>Published on <?php echo formatNoticeDate($notice['date_published']); ?>
                    </small>
                    <div class="notice-content">
                        <?php echo $notice['content']; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>


    <!-- Downloads Section -->
    <?php 
    $downloads = $data_fetcher->getDownloads(6);
    if (!empty($downloads)): 
    ?>
    <section class="section" style="background: var(--color-bg-primary);">
        <div class="container-lg">
            <div class="section-title">
                <h2><i class="fas fa-file-download me-2" style="color: var(--color-accent);"></i>Downloads & Resources</h2>
                <p class="section-subtitle">Access important forms, documents, and regulatory information</p>
            </div>
            
            <div class="row g-4">
                <?php foreach ($downloads as $download): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100" style="position: relative; overflow: hidden;">
                            <div style="position: absolute; top: 0; left: 0; width: 4px; height: 100%; background: linear-gradient(to bottom, var(--color-accent), var(--color-accent-dark));"></div>
                            <div class="card-body" style="padding-left: 1.5rem;">
                                <div style="display: inline-block; background: rgba(15, 118, 110, 0.1); color: var(--color-accent); padding: 10px 12px; border-radius: 6px; margin-bottom: 1rem; font-size: 1.25rem;">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <h5 class="card-title"><?php echo htmlspecialchars($download['title']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($download['description'] ?? 'Download this resource'); ?></p>
                                <?php if (!empty($download['category'])): ?>
                                    <span class="badge" style="background: rgba(15, 118, 110, 0.1); color: var(--color-accent); border: 1px solid rgba(15, 118, 110, 0.2);"><?php echo htmlspecialchars($download['category']); ?></span>
                                <?php endif; ?>
                                <a href="<?php echo SITE_URL; ?>admin/downloads.php?action=download&id=<?php echo $download['id']; ?>" class="btn btn-sm btn-primary w-100 mt-3">
                                    <i class="fas fa-download me-1"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Gallery Section -->
    <?php 
    $gallery = $data_fetcher->getGallery(6);
    if (!empty($gallery)): 
    ?>
    <section class="section" style="background: var(--color-bg-secondary);">
        <div class="container-lg">
            <div class="section-title">
                <h2><i class="fas fa-images me-2" style="color: var(--color-accent);"></i>Gallery</h2>
                <p class="section-subtitle">Highlights from our facilities, events, and operations</p>
            </div>
            
            <div class="row g-4">
                <?php foreach ($gallery as $image): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 overflow-hidden">
                            <div style="background: var(--color-bg-tertiary); height: 240px; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
                                <?php
                                $img_full_path = __DIR__ . '/' . $image['image_path'];
                                $img_url = SITE_URL . $image['image_path'];
                                ?>
                                <?php if (!empty($image['image_path']) && file_exists($img_full_path)): ?>
                                    <img src="<?php echo htmlspecialchars($img_url); ?>" alt="<?php echo htmlspecialchars($image['alt_text'] ?? $image['title']); ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.02)';" onmouseout="this.style.transform='scale(1)';">
                                <?php else: ?>
                                    <i class="fas fa-image" style="font-size: 2.5rem; color: var(--color-border-dark);"></i>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($image['title']); ?></h5>
                                <?php if (!empty($image['category'])): ?>
                                    <span class="badge" style="background: var(--color-bg-tertiary); color: var(--color-text-secondary);"><?php echo htmlspecialchars($image['category']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Contact Summary Section -->
    <section class="section bg-light">
        <div class="container-lg">
            <div class="section-title">
                <h2>Contact Us</h2>
                <p class="section-subtitle">Get in touch with our team for any assistance</p>
            </div>
            
            <div class="row g-4 mb-4">
                <!-- Contact Info -->
                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-phone" style="font-size: 2.5rem; color: var(--secondary-color); margin-bottom: 1rem;"></i>
                            <h5 class="card-title">Phone</h5>
                            <p class="text-muted mb-1">
                                <a href="tel:+918338273169" class="text-decoration-none">+91 8338273169</a>
                            </p>
                            <p class="text-muted">
                                <a href="tel:+918494903886" class="text-decoration-none">+91 8494903886</a>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope" style="font-size: 2.5rem; color: var(--secondary-color); margin-bottom: 1rem;"></i>
                            <h5 class="card-title">Email</h5>
                            <p class="text-muted">
                                <a href="mailto:shantappanna@mirajibank.com" class="text-decoration-none">shantappanna@mirajibank.com</a>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marker-alt" style="font-size: 2.5rem; color: var(--secondary-color); margin-bottom: 1rem;"></i>
                            <h5 class="card-title">Address</h5>
                            <p class="text-muted">944-945, Guruwar Peth Chikodi,<br>Belagavi Karnataka, 591201</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
// Include footer
include __DIR__ . '/includes/footer.php';
?>
