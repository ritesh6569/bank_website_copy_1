<?php
/**
 * Services Page - Shri Shantappanna Miraji Urban Co-op. Bank Ltd.
 */

$page_title = 'Services - Miraji Bank';
$current_page = 'services';

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/notices-fetcher.php';

$notices = getActiveNotices();
?>


    <!-- Page Header -->
    <div class="page-header">
        <i class="fas fa-concierge-bell page-header-icon"></i>
        <div class="container-lg">
            <span class="page-header-eyebrow"><i class="fas fa-circle-dot"></i> Banking Services</span>
            <h1>Banking Services</h1>
            <p>Modern banking services for all your financial needs — Shri Shantappanna Miraji Urban Co-op. Bank Ltd.</p>
        </div>
    </div>

    <!-- Services Overview -->
    <section class="section bg-light">
        <div class="container-lg">
            <div class="section-title">
                <h2>Our Banking Services</h2>
                <p class="section-subtitle">Comprehensive services to make your banking experience seamless</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 text-center" style="border-top:4px solid var(--primary-color);">
                        <div class="card-body p-4">
                            <i class="fas fa-file-invoice fa-3x mb-3" style="color:var(--primary-color);"></i>
                            <h5 class="card-title">CTS Cheques</h5>
                            <p class="text-muted small">Cheque Truncation System (CTS) compliant cheques for faster clearing and secure transactions.</p>
                            <a href="#cts" class="btn btn-sm btn-outline-primary mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 text-center" style="border-top:4px solid var(--success-color);">
                        <div class="card-body p-4">
                            <i class="fas fa-exchange-alt fa-3x mb-3" style="color:var(--success-color);"></i>
                            <h5 class="card-title">RTGS / NEFT</h5>
                            <p class="text-muted small">Real Time Gross Settlement and National Electronic Funds Transfer for quick, secure money transfers.</p>
                            <a href="#rtgs" class="btn btn-sm btn-outline-success mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 text-center" style="border-top:4px solid var(--warning-color);">
                        <div class="card-body p-4">
                            <i class="fas fa-calendar-check fa-3x mb-3" style="color:var(--warning-color);"></i>
                            <h5 class="card-title">EMI Facility</h5>
                            <p class="text-muted small">Easy Monthly Instalment facility for loan repayments, making borrowing convenient and manageable.</p>
                            <a href="#emi" class="btn btn-sm btn-outline-warning mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 text-center" style="border-top:4px solid #8b5cf6;">
                        <div class="card-body p-4">
                            <i class="fas fa-receipt fa-3x mb-3" style="color:#8b5cf6;"></i>
                            <h5 class="card-title">Pay Order</h5>
                            <p class="text-muted small">Bank Pay Orders (Demand Drafts) for secure, guaranteed payments anywhere in India.</p>
                            <a href="#payorder" class="btn btn-sm btn-outline-secondary mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 text-center" style="border-top:4px solid #ec4899;">
                        <div class="card-body p-4">
                            <i class="fas fa-id-card fa-3x mb-3" style="color:#ec4899;"></i>
                            <h5 class="card-title">Personalized Cheques</h5>
                            <p class="text-muted small">Personalized cheque books with your name and account details printed for professional banking.</p>
                            <a href="#personal-cheques" class="btn btn-sm btn-outline-danger mt-2">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 text-center" style="border-top:4px solid #06b6d4;">
                        <div class="card-body p-4">
                            <i class="fas fa-map-marker-alt fa-3x mb-3" style="color:#06b6d4;"></i>
                            <h5 class="card-title">14 Branch Network</h5>
                            <p class="text-muted small">Serving customers across Belagavi district and beyond with 14 convenient branch locations.</p>
                            <a href="<?php echo SITE_URL; ?>pages/contact.php" class="btn btn-sm btn-outline-info mt-2">Find a Branch</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTS Cheques -->
    <section class="section" id="cts">
        <div class="container-lg">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-primary mb-2 fs-6">Service 01</span>
                    <h2 class="mb-3 mt-2">CTS Cheques</h2>
                    <p>Cheque Truncation System (CTS) is a cheque clearing system undertaken by the Reserve Bank of India (RBI). CTS-compliant cheques are processed electronically without physical movement of cheques, resulting in faster clearing, reduced risk of fraud, and improved efficiency.</p>
                    <p>Our bank issues CTS-2010 standard compliant cheques to all account holders. These cheques contain security features like watermarks, void pantograph, UV band, and micro-lettering to prevent counterfeiting.</p>
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Faster Clearing</strong><p class="small text-muted mb-0">Cheques cleared on the same or next day</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Enhanced Security</strong><p class="small text-muted mb-0">Multiple security features against fraud</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>RBI Compliant</strong><p class="small text-muted mb-0">CTS-2010 standard cheques</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Nationwide Acceptance</strong><p class="small text-muted mb-0">Accepted at all CTS-enabled banks</p></div></div></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm" style="border-left:4px solid var(--primary-color);">
                        <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-shield-alt me-2 text-primary"></i>CTS Security Features</h5></div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Watermark security paper</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Void pantograph</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>UV visible fluorescent band</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Micro-lettering</li>
                                <li class="py-2"><i class="fas fa-check text-success me-2"></i>MICR code printed</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- RTGS / NEFT -->
    <section class="section bg-light" id="rtgs">
        <div class="container-lg">
            <div class="row g-4 align-items-start">
                <div class="col-lg-8">
                    <span class="badge bg-success mb-2 fs-6">Service 02</span>
                    <h2 class="mb-3 mt-2">RTGS / NEFT</h2>
                    <p>Our bank facilitates electronic fund transfers through both RTGS (Real Time Gross Settlement) and NEFT (National Electronic Funds Transfer) systems. Transfer money securely to any bank account in India quickly and conveniently.</p>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="card h-100 border-success">
                                <div class="card-header bg-success text-white"><h6 class="mb-0"><i class="fas fa-bolt me-2"></i>RTGS — Real Time Gross Settlement</h6></div>
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0 small">
                                        <li class="py-1"><i class="fas fa-check text-success me-2"></i>Real-time fund transfer</li>
                                        <li class="py-1"><i class="fas fa-check text-success me-2"></i>Minimum transfer: Rs. 2,00,000/-</li>
                                        <li class="py-1"><i class="fas fa-check text-success me-2"></i>No upper limit</li>
                                        <li class="py-1"><i class="fas fa-check text-success me-2"></i>Immediate settlement</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100 border-primary">
                                <div class="card-header bg-primary text-white"><h6 class="mb-0"><i class="fas fa-exchange-alt me-2"></i>NEFT — National Electronic Funds Transfer</h6></div>
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0 small">
                                        <li class="py-1"><i class="fas fa-check text-success me-2"></i>Available 24x7 (online)</li>
                                        <li class="py-1"><i class="fas fa-check text-success me-2"></i>No minimum amount</li>
                                        <li class="py-1"><i class="fas fa-check text-success me-2"></i>Suitable for small transfers</li>
                                        <li class="py-1"><i class="fas fa-check text-success me-2"></i>Settled in batches</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h6 class="mt-2 mb-3"><i class="fas fa-table me-2 text-primary"></i>RTGS / NEFT Service Charges</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm">
                            <thead class="table-primary">
                                <tr>
                                    <th>Transaction Amount</th>
                                    <th class="text-center">RTGS Charge</th>
                                    <th class="text-center">NEFT Charge</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>Up to Rs. 10,000/-</td><td class="text-center">N/A</td><td class="text-center">Rs. 2.50 + GST</td></tr>
                                <tr><td>Rs. 10,001/- to Rs. 1,00,000/-</td><td class="text-center">N/A</td><td class="text-center">Rs. 5.00 + GST</td></tr>
                                <tr><td>Rs. 1,00,001/- to Rs. 2,00,000/-</td><td class="text-center">N/A</td><td class="text-center">Rs. 15.00 + GST</td></tr>
                                <tr><td>Rs. 2,00,001/- to Rs. 5,00,000/-</td><td class="text-center">Rs. 25.00 + GST</td><td class="text-center">Rs. 25.00 + GST</td></tr>
                                <tr><td>Above Rs. 5,00,000/-</td><td class="text-center">Rs. 50.00 + GST</td><td class="text-center">Rs. 25.00 + GST</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="alert alert-info mt-3 small"><i class="fas fa-info-circle me-2"></i>IFSC Code for our Head Office: <strong>SSBM0000001</strong>. Please contact your nearest branch for exact IFSC codes.</div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm" style="border-left:4px solid var(--success-color);">
                        <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-info-circle me-2 text-success"></i>Transfer Requirements</h5></div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Beneficiary account number</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Beneficiary bank's IFSC code</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Beneficiary name</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Beneficiary bank name</li>
                                <li class="py-2"><i class="fas fa-check text-success me-2"></i>Transfer amount</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- EMI Facility -->
    <section class="section" id="emi">
        <div class="container-lg">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-warning text-dark mb-2 fs-6">Service 03</span>
                    <h2 class="mb-3 mt-2">EMI Facility</h2>
                    <p>Our EMI (Equated Monthly Instalment) facility makes loan repayment simple and convenient. Instead of paying a lump sum, you repay your loan in fixed monthly instalments over the chosen tenure. The EMI amount is fixed at the time of loan sanction and remains the same throughout the repayment period.</p>
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Fixed Monthly Payments</strong><p class="small text-muted mb-0">Same amount every month</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Easy Planning</strong><p class="small text-muted mb-0">Plan your finances with fixed EMIs</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>All Loan Types</strong><p class="small text-muted mb-0">EMI available on most loans</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Flexible Tenure</strong><p class="small text-muted mb-0">Choose tenure based on your capacity</p></div></div></div>
                    </div>
                    <div class="alert alert-warning mt-4">
                        <h6><i class="fas fa-calculator me-2"></i>EMI Formula</h6>
                        <p class="mb-1 small">EMI = P × r × (1+r)^n / [(1+r)^n - 1]</p>
                        <p class="mb-0 small text-muted">Where P = Principal, r = Monthly interest rate, n = Number of months</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm" style="border-left:4px solid var(--warning-color);">
                        <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-calendar-check me-2 text-warning"></i>EMI Benefits</h5></div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Available on all term loans</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Vehicle, Housing, Personal loans</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Reduces repayment burden</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Structured repayment plan</li>
                                <li class="py-2"><i class="fas fa-check text-success me-2"></i>Tenure: 1 to 15 years (as applicable)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pay Order -->
    <section class="section bg-light" id="payorder">
        <div class="container-lg">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <span class="badge mb-2 fs-6" style="background:#8b5cf6;">Service 04</span>
                    <h2 class="mb-3 mt-2">Pay Order</h2>
                    <p>A Pay Order (also known as a Banker's Cheque or Demand Draft) is a guaranteed payment instrument issued by the bank. Unlike a personal cheque, a Pay Order is backed by the bank's funds and cannot bounce, making it the preferred instrument for high-value transactions, property purchases, government payments, and more.</p>
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Guaranteed Payment</strong><p class="small text-muted mb-0">Cannot be dishonoured like a cheque</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Widely Accepted</strong><p class="small text-muted mb-0">Accepted for government & legal payments</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Secure</strong><p class="small text-muted mb-0">Protected against fraud</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Easy to Obtain</strong><p class="small text-muted mb-0">Available at all our branches</p></div></div></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm" style="border-left:4px solid #8b5cf6;">
                        <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-receipt me-2" style="color:#8b5cf6;"></i>Pay Order Details</h5></div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Issued to member/non-member</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Bank-guaranteed instrument</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Can be crossed / bearer</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Cancellation facility available</li>
                                <li class="py-2"><i class="fas fa-check text-success me-2"></i>Charges as per service schedule</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Personalized Cheques -->
    <section class="section" id="personal-cheques">
        <div class="container-lg">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <span class="badge mb-2 fs-6" style="background:#ec4899;">Service 05</span>
                    <h2 class="mb-3 mt-2">Personalized Cheques</h2>
                    <p>All our savings and current account holders are issued personalized cheque books with their name, account number, and IFSC code pre-printed on each leaf. These CTS-2010 compliant cheques are more professional, secure, and help prevent fraudulent alterations.</p>
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Name Pre-Printed</strong><p class="small text-muted mb-0">Your name on every cheque leaf</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Account Details</strong><p class="small text-muted mb-0">Account number and IFSC pre-printed</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>CTS-2010 Compliant</strong><p class="small text-muted mb-0">Meets all RBI standards</p></div></div></div>
                        <div class="col-sm-6"><div class="d-flex"><i class="fas fa-check-circle text-success me-3 mt-1"></i><div><strong>Fraud Prevention</strong><p class="small text-muted mb-0">Harder to alter or misuse</p></div></div></div>
                    </div>
                    <div class="alert alert-info mt-4"><i class="fas fa-info-circle me-2"></i>New account holders are issued their first cheque book free of charge. Subsequent cheque books are available as per the service charges schedule.</div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm" style="border-left:4px solid #ec4899;">
                        <div class="card-header bg-white"><h5 class="mb-0"><i class="fas fa-id-card me-2" style="color:#ec4899;"></i>Cheque Book Details</h5></div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>10 / 25 leaf cheque books</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>CTS-2010 standard</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>MICR coding</li>
                                <li class="py-2 border-bottom"><i class="fas fa-check text-success me-2"></i>Account holder name printed</li>
                                <li class="py-2"><i class="fas fa-check text-success me-2"></i>Available at all branches</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
