<?php
/**
 * Media Page - Professional Bank Website
 */

$page_title = 'Media - Professional Bank';
$current_page = 'media';

include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/data-fetcher.php';

$interest_rates = $data_fetcher->getInterestRates();
$service_charges = $data_fetcher->getServiceCharges();
$news = $data_fetcher->getNews();
?>

    <!-- Page Header -->
    <div class="bg-primary text-white py-5">
        <div class="container-lg">
            <h1 class="mb-2">Media Center</h1>
            <p class="lead">Access interest rates, service charges, notices, and media resources</p>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <section class="bg-light py-4 sticky-top" style="z-index: 99;">
        <div class="container-lg">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="rates-tab" data-bs-toggle="tab" data-bs-target="#rates" type="button" role="tab">Interest Rates</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="charges-tab" data-bs-toggle="tab" data-bs-target="#charges" type="button" role="tab">Service Charges</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="notices-tab" data-bs-toggle="tab" data-bs-target="#notices" type="button" role="tab">Notices</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="downloads-tab" data-bs-toggle="tab" data-bs-target="#downloads" type="button" role="tab">Downloads</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery" type="button" role="tab">Gallery</button>
                </li>
            </ul>
        </div>
    </section>

    <!-- Tab Content -->
    <div class="tab-content" id="mediaTabContent">
        <!-- Interest Rates -->
        <div class="tab-pane fade show active" id="rates" role="tabpanel" aria-labelledby="rates-tab">
            <section class="section">
                <div class="container-lg">
                    <h2 class="mb-4">Interest Rates</h2>
                    
                    <!-- Deposits Rates -->
                    <h4 class="mb-3">Deposit Interest Rates</h4>
                    <div class="table-responsive mb-5">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Interest Rate</th>
                                    <th>Minimum Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($interest_rates['deposits'] as $deposit): ?>
                                    <tr>
                                        <td><strong><?php echo htmlspecialchars($deposit['name']); ?></strong></td>
                                        <td><?php echo htmlspecialchars($deposit['rate']); ?></td>
                                        <td><?php echo htmlspecialchars($deposit['min_balance']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Loans Rates -->
                    <h4 class="mb-3">Loan Interest Rates</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Interest Rate</th>
                                    <th>Loan Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($interest_rates['loans'] as $loan): ?>
                                    <tr>
                                        <td><strong><?php echo htmlspecialchars($loan['name']); ?></strong></td>
                                        <td><?php echo htmlspecialchars($loan['rate']); ?></td>
                                        <td><?php echo htmlspecialchars($loan['amount']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="alert alert-info mt-4">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Note:</strong> Rates are subject to change. Please visit your nearest branch or contact customer service for the latest rates.
                    </div>
                </div>
            </section>
        </div>

        <!-- Service Charges -->
        <div class="tab-pane fade" id="charges" role="tabpanel" aria-labelledby="charges-tab">
            <section class="section">
                <div class="container-lg">
                    <h2 class="mb-4">Service Charges</h2>
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Charges</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($service_charges as $charge): ?>
                                    <tr>
                                        <td><strong><?php echo htmlspecialchars($charge['service']); ?></strong></td>
                                        <td><?php echo htmlspecialchars($charge['charge']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="row g-4 mt-5">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Premium Customer Benefits</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>Waiver of annual account maintenance charges</li>
                                        <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>50% discount on cheque book charges</li>
                                        <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>Free international debit card</li>
                                        <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>Priority customer support</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0">Senior Citizen Concessions</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>Higher interest rates on deposits</li>
                                        <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>Waived account maintenance fees</li>
                                        <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>Priority queue at branches</li>
                                        <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>Dedicated relationship manager</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Notices -->
        <div class="tab-pane fade" id="notices" role="tabpanel" aria-labelledby="notices-tab">
            <section class="section">
                <div class="container-lg">
                    <h2 class="mb-4">Notices & Announcements</h2>
                    
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="accordion" id="noticesAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="notice1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#notice1-body">
                                            <strong>Holiday Notice - Bank Closures</strong>
                                        </button>
                                    </h2>
                                    <div id="notice1-body" class="accordion-collapse collapse show" data-bs-parent="#noticesAccordion">
                                        <div class="accordion-body">
                                            <p class="mb-2"><strong>Date:</strong> <?php echo date('d-m-Y'); ?></p>
                                            <p>All branches will be closed on national holidays and weekends. Our digital services (Internet Banking, Mobile App, ATM) will remain available 24/7. For emergency assistance, please contact our 24-hour helpline.</p>
                                            <p><strong>Closed Dates:</strong></p>
                                            <ul>
                                                <li>Republic Day - 26 January</li>
                                                <li>Independence Day - 15 August</li>
                                                <li>Gandhi Jayanti - 2 October</li>
                                                <li>Christmas - 25 December</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="notice2">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#notice2-body">
                                            <strong>New Digital Services Launch</strong>
                                        </button>
                                    </h2>
                                    <div id="notice2-body" class="accordion-collapse collapse" data-bs-parent="#noticesAccordion">
                                        <div class="accordion-body">
                                            <p class="mb-2"><strong>Date:</strong> <?php echo date('d-m-Y', strtotime('-5 days')); ?></p>
                                            <p>We are excited to announce the launch of our AI-powered personal finance assistant. This new feature is now available in our mobile app and helps customers manage their finances better with personalized recommendations.</p>
                                            <p><strong>New Features:</strong></p>
                                            <ul>
                                                <li>Automated budget planning</li>
                                                <li>Investment recommendations</li>
                                                <li>Bill reminders</li>
                                                <li>Savings goals tracker</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="notice3">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#notice3-body">
                                            <strong>Security Alert - Phishing Awareness</strong>
                                        </button>
                                    </h2>
                                    <div id="notice3-body" class="accordion-collapse collapse" data-bs-parent="#noticesAccordion">
                                        <div class="accordion-body">
                                            <p class="mb-2"><strong>Date:</strong> <?php echo date('d-m-Y', strtotime('-10 days')); ?></p>
                                            <p><strong style="color: red;">Alert:</strong> We have detected phishing attempts targeting our customers. Please be cautious and follow these tips:</p>
                                            <ul>
                                                <li>Never share your password or OTP with anyone</li>
                                                <li>Always log into the official bank website</li>
                                                <li>Verify email sender addresses carefully</li>
                                                <li>Report suspicious emails immediately</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="notice4">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#notice4-body">
                                            <strong>Swift Code & IFSC Code Information</strong>
                                        </button>
                                    </h2>
                                    <div id="notice4-body" class="accordion-collapse collapse" data-bs-parent="#noticesAccordion">
                                        <div class="accordion-body">
                                            <p class="mb-2"><strong>For International Transfers:</strong></p>
                                            <p><strong>SWIFT Code:</strong> PBNK</p>
                                            <p class="mb-2"><strong>For Domestic Transfers:</strong></p>
                                            <p><strong>IFSC Code:</strong> PBNK0000001</p>
                                            <p class="text-muted small">Please use these codes for accurate fund transfers.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="card sticky-top" style="top: 80px;">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Quick Links</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled small">
                                        <li class="py-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-download me-2"></i>Download Policy Documents
                                            </a>
                                        </li>
                                        <li class="py-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-download me-2"></i>RBI Guidelines
                                            </a>
                                        </li>
                                        <li class="py-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-download me-2"></i>Grievance Redressal
                                            </a>
                                        </li>
                                        <li class="py-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-envelope me-2"></i>Email Us
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Downloads -->
        <div class="tab-pane fade" id="downloads" role="tabpanel" aria-labelledby="downloads-tab">
            <section class="section">
                <div class="container-lg">
                    <h2 class="mb-4">Downloads</h2>
                    <p class="lead">Download forms, documents, and resources here.</p>
                    
                    <div class="row g-4">
                        <!-- Account Opening Forms -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Account Opening Forms</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li class="py-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-download me-2 text-secondary"></i>Savings Account Form
                                            </a>
                                        </li>
                                        <li class="py-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-download me-2 text-secondary"></i>Current Account Form
                                            </a>
                                        </li>
                                        <li class="py-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-download me-2 text-secondary"></i>Joint Account Form
                                            </a>
                                        </li>
                                        <li class="py-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-download me-2 text-secondary"></i>KYC Form
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Loan Forms -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Loan Application Forms</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li class="py-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-download me-2 text-secondary"></i>Personal Loan Form
                                            </a>
                                        </li>
                                        <li class="py-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-download me-2 text-secondary"></i>Home Loan Form
                                            </a>
                                        </li>
                                        <li class="py-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-download me-2 text-secondary"></i>Vehicle Loan Form
                                            </a>
                                        </li>
                                        <li class="py-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-download me-2 text-secondary"></i>Business Loan Form
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Policy Documents -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-warning text-dark">
                                    <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Policy Documents</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li class="py-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-download me-2 text-secondary"></i>Privacy Policy
                                            </a>
                                        </li>
                                        <li class="py-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-download me-2 text-secondary"></i>Terms & Conditions
                                            </a>
                                        </li>
                                        <li class="py-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-download me-2 text-secondary"></i>Grievance Policy
                                            </a>
                                        </li>
                                        <li class="py-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-download me-2 text-secondary"></i>Fair Practice Code
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Guides & Tutorials -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Guides & Tutorials</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li class="py-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-download me-2 text-secondary"></i>Internet Banking Guide
                                            </a>
                                        </li>
                                        <li class="py-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-download me-2 text-secondary"></i>Mobile App Tutorial
                                            </a>
                                        </li>
                                        <li class="py-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-download me-2 text-secondary"></i>Security Tips
                                            </a>
                                        </li>
                                        <li class="py-2">
                                            <a href="#" class="text-decoration-none">
                                                <i class="fas fa-download me-2 text-secondary"></i>FAQ Document
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Gallery -->
        <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
            <section class="section">
                <div class="container-lg">
                    <h2 class="mb-4">Gallery</h2>
                    <p class="lead">Photos from our branches, events, and community activities.</p>
                    
                    <div class="row g-4 mt-4">
                        <?php
                        $gallery_items = [
                            ['title' => 'Main Branch Opening', 'category' => 'Events'],
                            ['title' => 'Customer Service Excellence', 'category' => 'Operations'],
                            ['title' => 'Digital Banking Expo', 'category' => 'Events'],
                            ['title' => 'Community Service Initiative', 'category' => 'CSR'],
                            ['title' => 'Annual Staff Meeting', 'category' => 'Internal'],
                            ['title' => 'New ATM Installation', 'category' => 'Operations'],
                            ['title' => 'Customer Appreciation Day', 'category' => 'Events'],
                            ['title' => 'Financial Literacy Workshop', 'category' => 'CSR'],
                        ];
                        
                        foreach ($gallery_items as $item):
                        ?>
                            <div class="col-md-6 col-lg-3">
                                <div class="card h-100">
                                    <div style="height: 200px; background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-image" style="font-size: 4rem; color: rgba(255,255,255,0.3);"></i>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title"><?php echo htmlspecialchars($item['title']); ?></h6>
                                        <span class="badge bg-secondary"><?php echo htmlspecialchars($item['category']); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/footer.php';
?>
