<?php
/**
 * Home Page - Professional Bank Website
 */

$page_title = 'Home - Professional Bank';
$current_page = 'home';

// Include header
include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/data-fetcher.php';

// Get data
$offers = $data_fetcher->getOffers();
$news = $data_fetcher->getNews();
$branches = $data_fetcher->getBranches();
?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container-lg">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6 hero-content">
                    <h1 class="hero-title">Your Trusted Banking Partner</h1>
                    <p class="hero-subtitle">Experience modern banking with secure, innovative financial solutions designed for your success.</p>
                    <div class="hero-buttons">
                        <a href="/bank-website-grok/pages/deposits.php" class="btn btn-light me-3 mb-2">
                            <i class="fas fa-wallet me-2"></i>Open Account
                        </a>
                        <a href="/bank-website-grok/pages/loans.php" class="btn btn-outline-light mb-2">
                            <i class="fas fa-handshake me-2"></i>Apply for Loan
                        </a>
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
                <h2>Special Offers & Highlights</h2>
                <p class="section-subtitle">Check out our latest promotions and exclusive benefits</p>
            </div>
            
            <div class="row g-4">
                <?php foreach ($offers as $offer): ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="card feature-card">
                            <div>
                                <i class="<?php echo htmlspecialchars($offer['icon']); ?>"></i>
                                <h5 class="card-title mt-3"><?php echo htmlspecialchars($offer['title']); ?></h5>
                                <p class="text-muted"><?php echo htmlspecialchars($offer['description']); ?></p>
                                <a href="/bank-website-grok/pages/deposits.php" class="btn btn-sm btn-primary">Learn More</a>
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
                    <a href="/bank-website-grok/pages/deposits.php#savings" class="card text-decoration-none h-100" style="border-left: 4px solid var(--secondary-color);">
                        <div class="card-body text-center">
                            <i class="fas fa-piggy-bank" style="font-size: 2.5rem; color: var(--secondary-color); margin-bottom: 1rem;"></i>
                            <h5 class="card-title">Deposits</h5>
                            <p class="text-muted small">Savings, Current, FD & RD</p>
                        </div>
                    </a>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <a href="/bank-website-grok/pages/loans.php#personal" class="card text-decoration-none h-100" style="border-left: 4px solid var(--success-color);">
                        <div class="card-body text-center">
                            <i class="fas fa-hand-holding-usd" style="font-size: 2.5rem; color: var(--success-color); margin-bottom: 1rem;"></i>
                            <h5 class="card-title">Loans</h5>
                            <p class="text-muted small">Personal, Home, Vehicle & Business</p>
                        </div>
                    </a>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <a href="/bank-website-grok/pages/services.php#internet" class="card text-decoration-none h-100" style="border-left: 4px solid var(--warning-color);">
                        <div class="card-body text-center">
                            <i class="fas fa-globe" style="font-size: 2.5rem; color: var(--warning-color); margin-bottom: 1rem;"></i>
                            <h5 class="card-title">Services</h5>
                            <p class="text-muted small">Internet, Mobile & SMS Banking</p>
                        </div>
                    </a>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <a href="/bank-website-grok/pages/contact.php" class="card text-decoration-none h-100" style="border-left: 4px solid var(--danger-color);">
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
                            <p class="text-muted">Our deposit products are designed to help you save money with competitive interest rates and flexible terms.</p>
                            <ul class="list-unstyled">
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Savings Account</strong> - Up to 4.0% p.a.
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Fixed Deposit</strong> - Up to 6.5% p.a.
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Recurring Deposit</strong> - Up to 6.0% p.a.
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Current Account</strong> - Business focused
                                </li>
                            </ul>
                            <a href="/bank-website-grok/pages/deposits.php" class="btn btn-primary mt-3">
                                Learn More <i class="fas fa-arrow-right ms-2"></i>
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
                            <p class="text-muted">Get the financial support you need with our flexible loan options and competitive rates.</p>
                            <ul class="list-unstyled">
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Personal Loan</strong> - From 8.5% p.a.
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Home Loan</strong> - From 7.0% p.a.
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Vehicle Loan</strong> - From 7.5% p.a.
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Business Loan</strong> - From 9.0% p.a.
                                </li>
                            </ul>
                            <a href="/bank-website-grok/pages/loans.php" class="btn btn-primary mt-3">
                                Learn More <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Preview Section -->
    <section class="section">
        <div class="container-lg">
            <div class="section-title">
                <h2>Latest News & Updates</h2>
                <p class="section-subtitle">Stay informed with our latest announcements and bank news</p>
            </div>
            
            <div class="row g-4">
                <?php foreach (array_slice($news, 0, 3) as $item): ?>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <small class="text-muted">
                                    <i class="far fa-calendar me-1"></i>
                                    <?php echo date('M d, Y', strtotime($item['date'])); ?>
                                </small>
                                <h5 class="card-title mt-2"><?php echo htmlspecialchars($item['title']); ?></h5>
                                <p class="card-text text-muted"><?php echo htmlspecialchars($item['excerpt']); ?></p>
                                <a href="<?php echo htmlspecialchars($item['link']); ?>" class="btn btn-sm btn-outline-primary">
                                    Read More <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="text-center mt-4">
                <a href="/bank-website-grok/pages/media.php" class="btn btn-primary">
                    View All News <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

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
                            <p class="text-muted">
                                <a href="tel:+1234567890" class="text-decoration-none">+1 (234) 567-890</a>
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
                                <a href="mailto:support@bank.com" class="text-decoration-none">support@bank.com</a>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marker-alt" style="font-size: 2.5rem; color: var(--secondary-color); margin-bottom: 1rem;"></i>
                            <h5 class="card-title">Address</h5>
                            <p class="text-muted">123 Banking Street, Financial City, FC 12345</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Inquiry Form -->
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Quick Inquiry</h5>
                        </div>
                        <div class="card-body">
                            <form id="quickInquiryForm" novalidate>
                                <div class="mb-3">
                                    <label for="inquiryName" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="inquiryName" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="inquiryEmail" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="inquiryEmail" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="inquirySubject" class="form-label">Subject</label>
                                    <select class="form-select" id="inquirySubject" name="subject" required>
                                        <option value="">Select a subject...</option>
                                        <option value="deposits">Deposits Inquiry</option>
                                        <option value="loans">Loans Inquiry</option>
                                        <option value="services">Services Inquiry</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="inquiryMessage" class="form-label">Message</label>
                                    <textarea class="form-control" id="inquiryMessage" name="message" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-paper-plane me-2"></i>Send Inquiry
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white;">
        <div class="container-lg text-center">
            <h2 class="mb-3">Ready to Get Started?</h2>
            <p class="lead mb-4">Join thousands of satisfied customers who trust us with their financial needs.</p>
            <a href="/bank-website-grok/pages/deposits.php" class="btn btn-light btn-lg">
                Open an Account Today <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </section>

    <!-- JavaScript for form handling -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            handleFormSubmit('quickInquiryForm', function(data) {
                console.log('Inquiry submitted:', data);
                // In production, send to backend API
            });
        });
    </script>

<?php
// Include footer
include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/footer.php';
?>
