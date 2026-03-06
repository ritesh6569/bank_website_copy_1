<?php
/**
 * Deposits Page - Shri Shantappanna Miraji Urban Co-op. Bank Ltd.
 */

$page_title = 'Deposits - Miraji Bank';
$current_page = 'deposits';

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/data-fetcher.php';
include __DIR__ . '/../includes/notices-fetcher.php';

$notices = getActiveNotices();

// Fetch Term Deposit rates from DB (db.php already loaded via data-fetcher.php)
$term_deposit_rates = [];
try {
    $pdo = getDBConnection();
    if ($pdo) {
        $stmt = $pdo->prepare("SELECT * FROM deposit_rates WHERE status = 'active' AND deposit_type = 'Term Deposit' ORDER BY display_order, id");
        $stmt->execute();
        $term_deposit_rates = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) {
    // fallback to empty — static hardcoded rows will show
}
?>

    <!-- Notices Alert Banner -->
    <?php if (!empty($notices)): $latest_notice = $notices[0]; ?>
    <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert" style="border-radius:0;border-left:5px solid #f59e0b;">
        <div class="container-lg d-flex align-items-center">
            <i class="fas fa-bell me-3" style="font-size:1.25rem;color:#d97706;"></i>
            <div style="flex:1;">
                <strong style="color:#92400e;">Important Notice:</strong>
                <span class="ms-2" style="color:#b45309;"><?php echo htmlspecialchars($latest_notice['title']); ?></span>
                <a href="#" class="ms-2" data-bs-toggle="modal" data-bs-target="#noticeModalLatest" style="color:#1e40af;font-weight:600;">Read More</a>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <!-- Page Header -->
    <div class="page-header">
        <i class="fas fa-piggy-bank page-header-icon"></i>
        <div class="container-lg">
            <span class="page-header-eyebrow"><i class="fas fa-circle-dot"></i> Banking Products</span>
            <h1>Deposit Schemes</h1>
            <p>Invest in different schemes of Deposits — Shri Shantappanna Miraji Urban Co-op. Bank Ltd.</p>
        </div>
    </div>

    <!-- Overview Cards -->
    <section class="section bg-light">
        <div class="container-lg">
            <div class="section-title">
                <h2>Our Deposit Schemes</h2>
                <p class="section-subtitle">Choose the right deposit product for your financial goals</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 text-center" style="border-top:4px solid var(--secondary-color);">
                        <div class="card-body p-4">
                            <div class="mb-2" style="font-size:2rem;color:var(--secondary-color);font-weight:700;">01</div>
                            <i class="fas fa-piggy-bank fa-2x mb-3" style="color:var(--secondary-color);"></i>
                            <h5 class="card-title">Savings Deposit</h5>
                            <p class="text-muted small">Earn interest on your daily balance with easy withdrawals. Ideal for individuals and families.</p>
                            <a href="#savings" class="btn btn-sm btn-outline-primary mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 text-center" style="border-top:4px solid var(--success-color);">
                        <div class="card-body p-4">
                            <div class="mb-2" style="font-size:2rem;color:var(--success-color);font-weight:700;">02</div>
                            <i class="fas fa-briefcase fa-2x mb-3" style="color:var(--success-color);"></i>
                            <h5 class="card-title">Current Deposit</h5>
                            <p class="text-muted small">A flexible account for businesses with unlimited transactions and overdraft facilities.</p>
                            <a href="#current" class="btn btn-sm btn-outline-success mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 text-center" style="border-top:4px solid var(--warning-color);">
                        <div class="card-body p-4">
                            <div class="mb-2" style="font-size:2rem;color:var(--warning-color);font-weight:700;">03</div>
                            <i class="fas fa-lock fa-2x mb-3" style="color:var(--warning-color);"></i>
                            <h5 class="card-title">Fixed Deposit</h5>
                            <p class="text-muted small">Earn attractive fixed interest rates on your lump-sum investment for a chosen tenure.</p>
                            <a href="#fixed" class="btn btn-sm btn-outline-warning mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 text-center" style="border-top:4px solid #8b5cf6;">
                        <div class="card-body p-4">
                            <div class="mb-2" style="font-size:2rem;color:#8b5cf6;font-weight:700;">04</div>
                            <i class="fas fa-certificate fa-2x mb-3" style="color:#8b5cf6;"></i>
                            <h5 class="card-title">Kalyan Nidhi Cash Certificates</h5>
                            <p class="text-muted small">Special cash certificates for long-term wealth creation with attractive returns.</p>
                            <a href="#kalyan" class="btn btn-sm btn-outline-secondary mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 text-center" style="border-top:4px solid #ec4899;">
                        <div class="card-body p-4">
                            <div class="mb-2" style="font-size:2rem;color:#ec4899;font-weight:700;">05</div>
                            <i class="fas fa-calendar-alt fa-2x mb-3" style="color:#ec4899;"></i>
                            <h5 class="card-title">Recurring Deposit</h5>
                            <p class="text-muted small">Save a fixed amount every month and earn good interest. Perfect for building savings habits.</p>
                            <a href="#recurring" class="btn btn-sm btn-outline-danger mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 text-center" style="border-top:4px solid #06b6d4;">
                        <div class="card-body p-4">
                            <div class="mb-2" style="font-size:2rem;color:#06b6d4;font-weight:700;">06</div>
                            <i class="fas fa-hand-holding-usd fa-2x mb-3" style="color:#06b6d4;"></i>
                            <h5 class="card-title">Yeshwant Pigmy Deposit</h5>
                            <p class="text-muted small">Small daily/weekly deposits collected at your doorstep. Great for small savers and daily wage earners.</p>
                            <a href="#pigmy" class="btn btn-sm btn-outline-info mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Savings Deposit -->
    <section class="section" id="savings">
        <div class="container-lg">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-primary mb-2 fs-6">Scheme 01</span>
                    <h2 class="mb-3 mt-2">Savings Deposit</h2>
                    <p>Our Savings Deposit account is designed for individuals and families who want to save money while earning interest on their deposits. It provides the flexibility of easy withdrawals while ensuring your money grows steadily.</p>
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Competitive Interest Rate</strong><p class="small text-muted mb-0">Earn attractive interest on your daily balance</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Easy Withdrawals</strong><p class="small text-muted mb-0">Withdraw your money whenever you need</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Passbook Facility</strong><p class="small text-muted mb-0">Track all transactions with a passbook</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Nomination Facility</strong><p class="small text-muted mb-0">Nominate a person for your account</p></div></div></div>
                    </div>
                    <div class="alert alert-info mt-4"><i class="fas fa-info-circle me-2"></i><strong>Interest Rate:</strong> 3.00% p.a. &nbsp;|&nbsp; <strong>Senior Citizen / Soldier:</strong> 3.50% p.a.</div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm" style="border-left:4px solid var(--secondary-color);">
                        <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-list me-2 text-primary"></i>Key Details</h5></div>
                        <div class="card-body">
                            <table class="table table-sm mb-0">
                                <tr><td class="text-muted">Account Type</td><td><strong>Savings</strong></td></tr>
                                <tr><td class="text-muted">Interest Rate</td><td><strong>3.00% p.a.</strong></td></tr>
                                <tr><td class="text-muted">Senior Citizen</td><td><strong>3.50% p.a.</strong></td></tr>
                                <tr><td class="text-muted">Cheque Book</td><td><strong>Available</strong></td></tr>
                                <tr><td class="text-muted">Nomination</td><td><strong>Available</strong></td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Current Deposit -->
    <section class="section bg-light" id="current">
        <div class="container-lg">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-success mb-2 fs-6">Scheme 02</span>
                    <h2 class="mb-3 mt-2">Current Deposit</h2>
                    <p>The Current Deposit account is ideal for businesses, traders, and professionals who require unlimited transactions. It offers overdraft facilities and is perfect for high-volume transaction requirements.</p>
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Unlimited Transactions</strong><p class="small text-muted mb-0">No restrictions on number of transactions</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Overdraft Facility</strong><p class="small text-muted mb-0">Short-term credit facility available</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Cheque Book</strong><p class="small text-muted mb-0">Personalized CTS cheque books</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>RTGS / NEFT</strong><p class="small text-muted mb-0">Electronic fund transfers</p></div></div></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm" style="border-left:4px solid var(--success-color);">
                        <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-list me-2 text-success"></i>Key Details</h5></div>
                        <div class="card-body">
                            <table class="table table-sm mb-0">
                                <tr><td class="text-muted">Account Type</td><td><strong>Current</strong></td></tr>
                                <tr><td class="text-muted">Suitable For</td><td><strong>Business / Trade</strong></td></tr>
                                <tr><td class="text-muted">Transactions</td><td><strong>Unlimited</strong></td></tr>
                                <tr><td class="text-muted">Overdraft</td><td><strong>Available</strong></td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fixed Deposit -->
    <section class="section" id="fixed">
        <div class="container-lg">
            <div class="row g-4 align-items-start">
                <div class="col-lg-8">
                    <span class="badge bg-warning text-dark mb-2 fs-6">Scheme 03</span>
                    <h2 class="mb-3 mt-2">Fixed Deposit</h2>
                    <p>Earn high, assured returns on your lump sum investments. Our Fixed Deposit schemes offer some of the most competitive interest rates with flexible tenure options ranging from 46 days to 5+ years.</p>
                    <h5 class="mt-4 mb-3"><i class="fas fa-table me-2 text-primary"></i>Interest Rates on Term Deposits</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>Period</th>
                                    <th class="text-center">General Public</th>
                                    <th class="text-center">Senior Citizen / Soldier</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($term_deposit_rates)): ?>
                                    <?php foreach ($term_deposit_rates as $rate): ?>
                                        <tr<?php
                                            $g = (float) $rate['general_rate'];
                                            echo ($g >= 7.75) ? ' class="table-success"' : '';
                                        ?>>
                                            <td><?php echo htmlspecialchars($rate['period']); ?></td>
                                            <td class="text-center"><strong><?php echo htmlspecialchars($rate['general_rate']); ?></strong></td>
                                            <td class="text-center"><strong><?php echo htmlspecialchars($rate['senior_rate']); ?></strong></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td>46 Days to 90 Days</td><td class="text-center"><strong>5.00%</strong></td><td class="text-center"><strong>5.50%</strong></td></tr>
                                    <tr><td>91 Days to 180 Days</td><td class="text-center"><strong>5.50%</strong></td><td class="text-center"><strong>6.00%</strong></td></tr>
                                    <tr><td>181 Days to 364 Days</td><td class="text-center"><strong>7.00%</strong></td><td class="text-center"><strong>7.50%</strong></td></tr>
                                    <tr class="table-success"><td>1 Year and above to less than 2 Years</td><td class="text-center"><strong>7.75%</strong></td><td class="text-center"><strong>8.25%</strong></td></tr>
                                    <tr class="table-success"><td>2 Years and above to less than 5 Years</td><td class="text-center"><strong>8.00%</strong></td><td class="text-center"><strong>8.50%</strong></td></tr>
                                    <tr><td>5 Years and above</td><td class="text-center"><strong>7.75%</strong></td><td class="text-center"><strong>8.25%</strong></td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="alert alert-success mt-3"><i class="fas fa-star me-2"></i><strong>Saving Bank Interest:</strong> 3.00% p.a. &nbsp;(3.50% for Senior Citizen / Soldier)</div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm" style="border-left:4px solid var(--warning-color);">
                        <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-star me-2 text-warning"></i>Key Benefits</h5></div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Interest rates up to <strong>8.50%</strong></li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Tenure from 46 days to 5+ years</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Nomination facility available</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Loan against FD available</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Auto-renewal option</li>
                                <li class="py-2"><i class="fas fa-check text-success me-2"></i>Extra 0.50% for Senior Citizens</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kalyan Nidhi -->
    <section class="section bg-light" id="kalyan">
        <div class="container-lg">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <span class="badge mb-2 fs-6" style="background:#8b5cf6;">Scheme 04</span>
                    <h2 class="mb-3 mt-2">Kalyan Nidhi Cash Certificates</h2>
                    <p>Kalyan Nidhi Cash Certificates are special investment instruments offered by our bank for long-term wealth creation. These certificates offer attractive returns and are a safe, reliable investment option for individuals looking to grow their savings over a fixed period.</p>
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Long-Term Growth</strong><p class="small text-muted mb-0">Ideal for long-term wealth creation</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Attractive Returns</strong><p class="small text-muted mb-0">Competitive interest on certificates</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Safe Investment</strong><p class="small text-muted mb-0">Backed by our co-operative bank</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Nomination</strong><p class="small text-muted mb-0">Nomination facility available</p></div></div></div>
                    </div>
                    <div class="alert alert-primary mt-4"><i class="fas fa-info-circle me-2"></i>Contact your nearest branch for current rates and details on Kalyan Nidhi Cash Certificates.</div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm" style="border-left:4px solid #8b5cf6;">
                        <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-certificate me-2" style="color:#8b5cf6;"></i>Certificate Details</h5></div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Fixed tenure certificates</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Transferable to family members</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Loan facility against certificates</li>
                                <li class="py-2"><i class="fas fa-check text-success me-2"></i>Duplicate certificate issuable</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recurring Deposit -->
    <section class="section" id="recurring">
        <div class="container-lg">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <span class="badge mb-2 fs-6" style="background:#ec4899;">Scheme 05</span>
                    <h2 class="mb-3 mt-2">Recurring Deposit</h2>
                    <p>Build a healthy savings habit with our Recurring Deposit scheme. Deposit a fixed amount every month and earn attractive interest. Perfect for salaried employees and those who want to save regularly towards a financial goal.</p>
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Monthly Deposits</strong><p class="small text-muted mb-0">Save a fixed amount every month</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Good Interest</strong><p class="small text-muted mb-0">Competitive interest rates apply</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Flexible Tenure</strong><p class="small text-muted mb-0">Choose tenure as per your goal</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Loan Against RD</strong><p class="small text-muted mb-0">Avail loan against your RD balance</p></div></div></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm" style="border-left:4px solid #ec4899;">
                        <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-calendar-alt me-2" style="color:#ec4899;"></i>RD Details</h5></div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Minimum monthly instalment</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Maturity payment on schedule</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Nomination facility</li>
                                <li class="py-2"><i class="fas fa-check text-success me-2"></i>Duplicate passbook available</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Yeshwant Pigmy -->
    <section class="section bg-light" id="pigmy">
        <div class="container-lg">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <span class="badge mb-2 fs-6" style="background:#06b6d4;">Scheme 06</span>
                    <h2 class="mb-3 mt-2">Yeshwant Pigmy Deposit</h2>
                    <p>The Yeshwant Pigmy Deposit scheme is specially designed for small savers, daily wage earners, and people in rural areas. Our bank agents collect small deposits daily or weekly at your doorstep, making saving easy and accessible for everyone.</p>
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Doorstep Collection</strong><p class="small text-muted mb-0">Deposits collected at your location</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Small Amounts Welcome</strong><p class="small text-muted mb-0">Even small daily savings are welcome</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Rural &amp; Urban Focus</strong><p class="small text-muted mb-0">Designed for all communities</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Financial Inclusion</strong><p class="small text-muted mb-0">Brings banking to the unbanked</p></div></div></div>
                    </div>
                    <div class="alert alert-info mt-4"><i class="fas fa-info-circle me-2"></i>Contact your nearest branch or our Pigmy agent for enrollment and details.</div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm" style="border-left:4px solid #06b6d4;">
                        <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-hand-holding-usd me-2" style="color:#06b6d4;"></i>Pigmy Deposit Benefits</h5></div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Daily / weekly collection</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>No minimum amount barrier</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Passbook issued</li>
                                <li class="py-2"><i class="fas fa-check text-success me-2"></i>Nomination facility</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section" style="background:linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);color:white;">
        <div class="container-lg text-center">
            <h2 class="mb-3">Ready to Start Saving?</h2>
            <p class="lead mb-4">Visit any of our 14 branches to open a deposit account today. Our staff will guide you to the best scheme for your needs.</p>
            <a href="<?php echo SITE_URL; ?>pages/contact.php" class="btn btn-light btn-lg me-3">
                <i class="fas fa-map-marker-alt me-2"></i>Find a Branch
            </a>
            <a href="<?php echo SITE_URL; ?>pages/media.php" class="btn btn-outline-light btn-lg">
                <i class="fas fa-percent me-2"></i>View Interest Rates
            </a>
        </div>
    </section>

<?php include __DIR__ . '/../includes/footer.php'; ?>