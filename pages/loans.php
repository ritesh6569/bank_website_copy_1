<?php
/**
 * Loans Page - Shri Shantappanna Miraji Urban Co-op. Bank Ltd.
 */

$page_title = 'Loans - Miraji Bank';
$current_page = 'loans';

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/data-fetcher.php';
include __DIR__ . '/../includes/notices-fetcher.php';

$notices = getActiveNotices();
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
        <i class="fas fa-hand-holding-usd page-header-icon"></i>
        <div class="container-lg">
            <span class="page-header-eyebrow"><i class="fas fa-circle-dot"></i> Banking Products</span>
            <h1>Loan Products</h1>
            <p>Fulfil your dreams with our wide range of loan products — Shri Shantappanna Miraji Urban Co-op. Bank Ltd.</p>
        </div>
    </div>

    <!-- Loan Products Overview -->
    <section class="section bg-light">
        <div class="container-lg">
            <div class="section-title">
                <h2>Our Loan Products</h2>
                <p class="section-subtitle">Comprehensive financial solutions for every need</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100" style="border-top:4px solid var(--primary-color);">
                        <div class="card-body p-4">
                            <i class="fas fa-user-friends fa-2x mb-3" style="color:var(--primary-color);"></i>
                            <h5 class="card-title">Surety / Personal Loan</h5>
                            <p class="text-muted small">Loans on surety of members for personal needs, education, medical emergencies, and more.</p>
                            <a href="#surety" class="btn btn-sm btn-outline-primary mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100" style="border-top:4px solid var(--success-color);">
                        <div class="card-body p-4">
                            <i class="fas fa-credit-card fa-2x mb-3" style="color:var(--success-color);"></i>
                            <h5 class="card-title">Cash Credit Loan</h5>
                            <p class="text-muted small">Revolving credit facility for working capital needs of businesses and traders.</p>
                            <a href="#cash-credit" class="btn btn-sm btn-outline-success mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100" style="border-top:4px solid #f59e0b;">
                        <div class="card-body p-4">
                            <i class="fas fa-building fa-2x mb-3" style="color:#f59e0b;"></i>
                            <h5 class="card-title">Mortgage Loan</h5>
                            <p class="text-muted small">Loans against mortgage of immovable property for business or personal use.</p>
                            <a href="#mortgage" class="btn btn-sm btn-outline-warning mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100" style="border-top:4px solid #f59e0b;">
                        <div class="card-body p-4">
                            <i class="fas fa-coins fa-2x mb-3" style="color:#f59e0b;"></i>
                            <h5 class="card-title">Gold Loan</h5>
                            <p class="text-muted small">Quick loans against pledge of gold ornaments at competitive interest rates.</p>
                            <a href="#gold" class="btn btn-sm btn-outline-warning mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100" style="border-top:4px solid #8b5cf6;">
                        <div class="card-body p-4">
                            <i class="fas fa-tractor fa-2x mb-3" style="color:#8b5cf6;"></i>
                            <h5 class="card-title">Hypothecation Loan</h5>
                            <p class="text-muted small">Loans against hypothecation of movable assets including agricultural equipment and machinery.</p>
                            <a href="#hypothecation" class="btn btn-sm btn-outline-secondary mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100" style="border-top:4px solid #06b6d4;">
                        <div class="card-body p-4">
                            <i class="fas fa-car fa-2x mb-3" style="color:#06b6d4;"></i>
                            <h5 class="card-title">Vehicle Loan</h5>
                            <p class="text-muted small">Finance for two-wheelers, four-wheelers, and commercial vehicles at attractive rates.</p>
                            <a href="#vehicle" class="btn btn-sm btn-outline-info mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100" style="border-top:4px solid #ec4899;">
                        <div class="card-body p-4">
                            <i class="fas fa-home fa-2x mb-3" style="color:#ec4899;"></i>
                            <h5 class="card-title">Housing Loan</h5>
                            <p class="text-muted small">Residential and commercial housing loans for construction, purchase, and repair.</p>
                            <a href="#housing" class="btn btn-sm btn-outline-danger mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100" style="border-top:4px solid #10b981;">
                        <div class="card-body p-4">
                            <i class="fas fa-industry fa-2x mb-3" style="color:#10b981;"></i>
                            <h5 class="card-title">Industrial / MSME Loan</h5>
                            <p class="text-muted small">Working capital and term loans for small and medium enterprises, including shed construction.</p>
                            <a href="#industrial" class="btn btn-sm btn-outline-success mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100" style="border-top:4px solid var(--primary-color);">
                        <div class="card-body p-4">
                            <i class="fas fa-briefcase fa-2x mb-3" style="color:var(--primary-color);"></i>
                            <h5 class="card-title">Other Loans</h5>
                            <p class="text-muted small">Professional, Consumer Durable, Agricultural, Trade/Business, Transport, and other RBI-approved loans.</p>
                            <a href="#other-loans" class="btn btn-sm btn-outline-primary mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interest Rates Table -->
    <section class="section">
        <div class="container-lg">
            <div class="section-title">
                <h2>Loan Interest Rates</h2>
                <p class="section-subtitle">Transparent and competitive rates on all our loan products</p>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Sr. No.</th>
                            <th>Type of Loan</th>
                            <th class="text-center">Interest Rate (% p.a.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-light"><td colspan="3"><strong>I. Industrial Loan / MSME</strong></td></tr>
                        <tr><td>1.</td><td>Working Capital</td><td class="text-center"><strong>10.00%</strong></td></tr>
                        <tr><td>2.</td><td>Term Loan</td><td class="text-center"><strong>11.00%</strong></td></tr>
                        <tr><td>3.</td><td>Shade Construction (MSME)</td><td class="text-center"><strong>11.00%</strong></td></tr>
                        <tr class="table-light"><td colspan="3"><strong>II. Housing Loan</strong></td></tr>
                        <tr><td>4.</td><td>Housing Loan – Residential Construction</td><td class="text-center"><strong>10.50%</strong></td></tr>
                        <tr><td>5.</td><td>Housing Loan – Residential Purchase</td><td class="text-center"><strong>10.50%</strong></td></tr>
                        <tr><td>6.</td><td>Housing Loan – Residential Repair</td><td class="text-center"><strong>11.00%</strong></td></tr>
                        <tr><td>7.</td><td>Housing Loan – Commercial</td><td class="text-center"><strong>11.50%</strong></td></tr>
                        <tr class="table-light"><td colspan="3"><strong>III. Vehicle Loan</strong></td></tr>
                        <tr><td>8.</td><td>Two Wheeler</td><td class="text-center"><strong>11.00%</strong></td></tr>
                        <tr><td>9.</td><td>Four Wheeler / Commercial Vehicle</td><td class="text-center"><strong>10.50%</strong></td></tr>
                        <tr class="table-light"><td colspan="3"><strong>IV. Professional Loan</strong></td></tr>
                        <tr><td>10.</td><td>Professional Loan</td><td class="text-center"><strong>12.00% – 13.00%</strong></td></tr>
                        <tr class="table-light"><td colspan="3"><strong>V. Gold Loan</strong></td></tr>
                        <tr><td>11.</td><td>Gold Loan</td><td class="text-center"><strong>9.00%</strong></td></tr>
                        <tr class="table-light"><td colspan="3"><strong>VI. Staff Loans</strong></td></tr>
                        <tr><td>12.</td><td>Staff Loan – Festival Advance</td><td class="text-center"><strong>7.50%</strong></td></tr>
                        <tr><td>13.</td><td>Staff Loan – Personal / Other</td><td class="text-center"><strong>10.00%</strong></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Surety / Personal Loan -->
    <section class="section bg-light" id="surety">
        <div class="container-lg">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-primary mb-2 fs-6">Surety / Personal Loan</span>
                    <h2 class="mb-3 mt-2">Surety / Personal Loan</h2>
                    <p>Our Surety / Personal Loan is available to members of the bank on the surety of other members. It can be utilized for personal needs, education, medical emergencies, marriage, home renovation, and other genuine personal requirements.</p>
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Quick Processing</strong><p class="small text-muted mb-0">Fast approval for genuine needs</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Member Benefits</strong><p class="small text-muted mb-0">Available to all bank members</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Flexible Repayment</strong><p class="small text-muted mb-0">Repayment in convenient EMIs</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>No Collateral</strong><p class="small text-muted mb-0">Surety of members is sufficient</p></div></div></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm" style="border-left:4px solid var(--primary-color);">
                        <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-info-circle me-2 text-primary"></i>Loan Details</h5></div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>For bank members</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Surety of members required</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>EMI repayment available</li>
                                <li class="py-2"><i class="fas fa-check text-success me-2"></i>Multiple purposes covered</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cash Credit -->
    <section class="section" id="cash-credit">
        <div class="container-lg">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-success mb-2 fs-6">Cash Credit Loan</span>
                    <h2 class="mb-3 mt-2">Cash Credit Loan</h2>
                    <p>A Cash Credit Loan is a revolving credit facility ideal for traders and business owners who need working capital. It allows you to withdraw up to your approved credit limit and pay interest only on the amount used.</p>
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Revolving Credit</strong><p class="small text-muted mb-0">Withdraw and repay as needed</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Interest on Utilized Amount</strong><p class="small text-muted mb-0">Pay interest only on amount used</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Business Growth</strong><p class="small text-muted mb-0">Fuel your business working capital</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Annual Review</strong><p class="small text-muted mb-0">Limit reviewed every year</p></div></div></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm" style="border-left:4px solid var(--success-color);">
                        <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-info-circle me-2 text-success"></i>Loan Details</h5></div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>For traders & businesses</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Revolving credit line</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Security / collateral required</li>
                                <li class="py-2"><i class="fas fa-check text-success me-2"></i>Annual renewal</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mortgage Loan -->
    <section class="section bg-light" id="mortgage">
        <div class="container-lg">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-warning text-dark mb-2 fs-6">Mortgage Loan</span>
                    <h2 class="mb-3 mt-2">Mortgage Loan</h2>
                    <p>Our Mortgage Loan is available against the mortgage of immovable property such as land, buildings, or commercial premises. It provides higher loan amounts for business expansion, personal needs, or working capital requirements.</p>
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>High Loan Amount</strong><p class="small text-muted mb-0">Higher limits against property</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Multiple Purposes</strong><p class="small text-muted mb-0">Business or personal use</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Long Tenure</strong><p class="small text-muted mb-0">Repayment over longer period</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Competitive Rates</strong><p class="small text-muted mb-0">Attractive interest rates</p></div></div></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm" style="border-left:4px solid #f59e0b;">
                        <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-info-circle me-2 text-warning"></i>Loan Details</h5></div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Against immovable property</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Property valuation required</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Legal documentation required</li>
                                <li class="py-2"><i class="fas fa-check text-success me-2"></i>High loan-to-value ratio</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gold Loan -->
    <section class="section" id="gold">
        <div class="container-lg">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-warning text-dark mb-2 fs-6">Gold Loan</span>
                    <h2 class="mb-3 mt-2">Gold Loan</h2>
                    <p>Get instant liquidity by pledging your gold ornaments with us. Our Gold Loan offers quick disbursement at one of the lowest interest rates, making it the ideal option for meeting urgent financial needs.</p>
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Quick Disbursal</strong><p class="small text-muted mb-0">Loan disbursed within hours</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Low Interest Rate</strong><p class="small text-muted mb-0">Only 9.00% per annum</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Safe Custody</strong><p class="small text-muted mb-0">Gold kept safe at bank vault</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Flexible Repayment</strong><p class="small text-muted mb-0">Repay at your convenience</p></div></div></div>
                    </div>
                    <div class="alert alert-warning mt-4"><i class="fas fa-star me-2"></i><strong>Interest Rate: 9.00% p.a.</strong> — One of the lowest gold loan rates available.</div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm" style="border-left:4px solid #f59e0b;">
                        <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-coins me-2 text-warning"></i>Gold Loan Details</h5></div>
                        <div class="card-body">
                            <table class="table table-sm mb-0">
                                <tr><td class="text-muted">Interest Rate</td><td><strong>9.00% p.a.</strong></td></tr>
                                <tr><td class="text-muted">Security</td><td><strong>Gold Ornaments</strong></td></tr>
                                <tr><td class="text-muted">Disbursal</td><td><strong>Same Day</strong></td></tr>
                                <tr><td class="text-muted">Repayment</td><td><strong>Flexible</strong></td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hypothecation -->
    <section class="section bg-light" id="hypothecation">
        <div class="container-lg">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <span class="badge mb-2 fs-6" style="background:#8b5cf6;">Hypothecation Loan</span>
                    <h2 class="mb-3 mt-2">Hypothecation Loan</h2>
                    <p>A Hypothecation Loan is available against the hypothecation of movable assets such as agricultural equipment, machinery, inventory, or other eligible assets. The borrower retains possession while the asset is hypothecated to the bank as security.</p>
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Retain Asset Possession</strong><p class="small text-muted mb-0">Continue using your assets</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>For Business Assets</strong><p class="small text-muted mb-0">Machinery, equipment, inventory</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Agricultural Use</strong><p class="small text-muted mb-0">Suitable for farm equipment</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Flexible Tenure</strong><p class="small text-muted mb-0">As per loan type</p></div></div></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm" style="border-left:4px solid #8b5cf6;">
                        <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-info-circle me-2" style="color:#8b5cf6;"></i>Loan Details</h5></div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Movable asset as security</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Borrower retains possession</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Insurance on hypothecated assets</li>
                                <li class="py-2"><i class="fas fa-check text-success me-2"></i>Suitable for agriculture & MSME</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vehicle Loan -->
    <section class="section" id="vehicle">
        <div class="container-lg">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <span class="badge mb-2 fs-6" style="background:#06b6d4;">Vehicle Loan</span>
                    <h2 class="mb-3 mt-2">Vehicle Loan</h2>
                    <p>Drive your dreams with our Vehicle Loan. We finance two-wheelers, four-wheelers, and commercial vehicles at competitive interest rates with easy EMI options. The vehicle itself serves as the primary security.</p>
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Two & Four Wheelers</strong><p class="small text-muted mb-0">All types of vehicles financed</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Commercial Vehicles</strong><p class="small text-muted mb-0">Auto, trucks, and more</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Easy EMI</strong><p class="small text-muted mb-0">Convenient monthly repayments</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Quick Processing</strong><p class="small text-muted mb-0">Fast approval and disbursement</p></div></div></div>
                    </div>
                    <div class="alert alert-info mt-4"><i class="fas fa-info-circle me-2"></i><strong>Two Wheeler:</strong> 11.00% p.a. &nbsp;|&nbsp; <strong>Four Wheeler / Commercial:</strong> 10.50% p.a.</div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm" style="border-left:4px solid #06b6d4;">
                        <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-car me-2" style="color:#06b6d4;"></i>Vehicle Loan Details</h5></div>
                        <div class="card-body">
                            <table class="table table-sm mb-0">
                                <tr><td class="text-muted">Two Wheeler</td><td><strong>11.00% p.a.</strong></td></tr>
                                <tr><td class="text-muted">Four Wheeler</td><td><strong>10.50% p.a.</strong></td></tr>
                                <tr><td class="text-muted">Security</td><td><strong>Vehicle Hypothecation</strong></td></tr>
                                <tr><td class="text-muted">Repayment</td><td><strong>EMI</strong></td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Housing Loan -->
    <section class="section bg-light" id="housing">
        <div class="container-lg">
            <div class="row g-4 align-items-start">
                <div class="col-lg-8">
                    <span class="badge mb-2 fs-6" style="background:#ec4899;">Housing Loan</span>
                    <h2 class="mb-3 mt-2">Housing Loan</h2>
                    <p>Our Housing Loan products cover all your residential and commercial property needs — from constructing a new home, purchasing a ready property, repairing an existing home, to financing a commercial building.</p>
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Residential Construction</strong><p class="small text-muted mb-0">Build your dream home</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Property Purchase</strong><p class="small text-muted mb-0">Buy ready or under-construction property</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Home Repair / Renovation</strong><p class="small text-muted mb-0">Renovate or expand your home</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Commercial Property</strong><p class="small text-muted mb-0">Finance your commercial space</p></div></div></div>
                    </div>
                    <h6 class="mt-4 mb-3"><i class="fas fa-table me-2 text-primary"></i>Housing Loan Interest Rates</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr><th>Type</th><th class="text-center">Interest Rate</th></tr>
                            </thead>
                            <tbody>
                                <tr><td>Residential – Construction</td><td class="text-center"><strong>10.50%</strong></td></tr>
                                <tr><td>Residential – Purchase</td><td class="text-center"><strong>10.50%</strong></td></tr>
                                <tr><td>Residential – Repair</td><td class="text-center"><strong>11.00%</strong></td></tr>
                                <tr><td>Commercial Property</td><td class="text-center"><strong>11.50%</strong></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm" style="border-left:4px solid #ec4899;">
                        <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-home me-2" style="color:#ec4899;"></i>Key Benefits</h5></div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>High loan amount available</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Long repayment tenure</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Property as security</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>EMI facility available</li>
                                <li class="py-2"><i class="fas fa-check text-success me-2"></i>Both residential & commercial</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Industrial / MSME Loan -->
    <section class="section" id="industrial">
        <div class="container-lg">
            <div class="row g-4 align-items-start">
                <div class="col-lg-8">
                    <span class="badge mb-2 fs-6" style="background:#10b981;">Industrial / MSME Loan</span>
                    <h2 class="mb-3 mt-2">Industrial / MSME Loan</h2>
                    <p>We support the growth of small and medium enterprises with specialized MSME loan products. Whether you need working capital, a term loan, or funds for shed construction, we have you covered.</p>
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Working Capital</strong><p class="small text-muted mb-0">Fund day-to-day operations</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Term Loan</strong><p class="small text-muted mb-0">Capital investment loans</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Shed Construction</strong><p class="small text-muted mb-0">Finance your factory or workshop</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>MSME Eligible</strong><p class="small text-muted mb-0">For all registered MSMEs</p></div></div></div>
                    </div>
                    <div class="alert alert-success mt-4"><i class="fas fa-info-circle me-2"></i><strong>Working Capital:</strong> 10.00% p.a. &nbsp;|&nbsp; <strong>Term Loan:</strong> 11.00% p.a. &nbsp;|&nbsp; <strong>Shade Construction:</strong> 11.00% p.a.</div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm" style="border-left:4px solid #10b981;">
                        <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-industry me-2" style="color:#10b981;"></i>MSME Loan Details</h5></div>
                        <div class="card-body">
                            <table class="table table-sm mb-0">
                                <tr><td class="text-muted">Working Capital</td><td><strong>10.00% p.a.</strong></td></tr>
                                <tr><td class="text-muted">Term Loan</td><td><strong>11.00% p.a.</strong></td></tr>
                                <tr><td class="text-muted">Shade Construction</td><td><strong>11.00% p.a.</strong></td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Other Loans -->
    <section class="section bg-light" id="other-loans">
        <div class="container-lg">
            <div class="section-title">
                <h2>Other Loan Products</h2>
                <p class="section-subtitle">We also offer the following specialized loan products</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body p-4">
                            <i class="fas fa-stethoscope fa-2x mb-3 text-primary"></i>
                            <h5>Professional Loan</h5>
                            <p class="text-muted small">For doctors, engineers, lawyers, and other professionals to set up or expand their practice. Rate: <strong>12.00% – 13.00% p.a.</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body p-4">
                            <i class="fas fa-tv fa-2x mb-3 text-primary"></i>
                            <h5>Consumer Durable Loan</h5>
                            <p class="text-muted small">Finance for household appliances, electronics, and other consumer durables for daily living needs.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body p-4">
                            <i class="fas fa-seedling fa-2x mb-3 text-success"></i>
                            <h5>Allied to Agriculture Loan</h5>
                            <p class="text-muted small">Loans for activities allied to agriculture such as animal husbandry, dairy, poultry, fishery, and horticulture.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body p-4">
                            <i class="fas fa-store fa-2x mb-3 text-warning"></i>
                            <h5>Trade / Business Loan</h5>
                            <p class="text-muted small">Loans for traders, shopkeepers, and small business owners to expand or maintain their commercial operations.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body p-4">
                            <i class="fas fa-truck fa-2x mb-3" style="color:#06b6d4;"></i>
                            <h5>Transport Loan</h5>
                            <p class="text-muted small">Finance for purchase of trucks, tempos, buses, and other transport vehicles for commercial transport business.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body p-4">
                            <i class="fas fa-university fa-2x mb-3" style="color:#8b5cf6;"></i>
                            <h5>Other RBI Approved Loans</h5>
                            <p class="text-muted small">All other loans approved by the Reserve Bank of India guidelines for urban co-operative banks.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section" style="background:linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);color:white;">
        <div class="container-lg text-center">
            <h2 class="mb-3">Ready to Apply for a Loan?</h2>
            <p class="lead mb-4">Visit any of our 14 branches or contact us to start your loan application today.</p>
            <a href="/pages/contact.php" class="btn btn-light btn-lg me-3">
                <i class="fas fa-map-marker-alt me-2"></i>Find a Branch
            </a>
            <a href="/pages/media.php" class="btn btn-outline-light btn-lg">
                <i class="fas fa-percent me-2"></i>View All Interest Rates
            </a>
        </div>
    </section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
