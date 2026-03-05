<?php
/**
 * Media Page - Shri Shantappanna Miraji Urban Co-op. Bank Ltd.
 */

$page_title = 'Media - Miraji Bank';
$current_page = 'media';

require_once __DIR__ . '/../config.php';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/data-fetcher.php';
include __DIR__ . '/../includes/notices-fetcher.php';
// db.php already loaded by notices-fetcher.php via require_once

$notices = getActiveNotices();

// Fetch gallery images from DB
$gallery_images = [];
try {
    $pdo = getDBConnection();
    if ($pdo) {
        $stmt = $pdo->query("SELECT * FROM gallery WHERE status = 'active' ORDER BY display_order ASC, created_at DESC LIMIT 24");
        $gallery_images = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) { /* silent */ }

// Fetch downloads from DB
$db_downloads = [];
try {
    $pdo = getDBConnection();
    if ($pdo) {
        $stmt = $pdo->query("SELECT * FROM downloads WHERE status = 'active' ORDER BY created_at DESC");
        $db_downloads = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) { /* silent */ }
?>

    <!-- Notices Alert Banner -->
    <?php if (!empty($notices)): $latest_notice = $notices[0]; ?>
    <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert" style="border-radius:0;border-left:5px solid #f59e0b;">
        <div class="container-lg d-flex align-items-center">
            <i class="fas fa-bell me-3" style="font-size:1.25rem;color:#d97706;"></i>
            <div style="flex:1;">
                <strong style="color:#92400e;">Important Notice:</strong>
                <span class="ms-2" style="color:#b45309;"><?php echo htmlspecialchars($latest_notice['title']); ?></span>
                <a href="#" class="ms-2" data-bs-toggle="modal" data-bs-target="#noticeModal0" style="color:#1e40af;font-weight:600;">Read More</a>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php foreach ($notices as $ni => $n): ?>
    <div class="modal fade" id="noticeModal<?php echo $ni; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background:linear-gradient(135deg,#1e40af,#3b82f6);color:white;border:none;">
                    <h5 class="modal-title"><i class="fas fa-bell me-2"></i><?php echo htmlspecialchars($n['title']); ?></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <small class="text-muted d-block mb-3"><i class="fas fa-calendar-alt me-1"></i>Published: <?php echo formatNoticeDate($n['date_published']); ?></small>
                    <div><?php echo $n['content']; ?></div>
                </div>
                <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>

    <!-- Page Header -->
    <div class="page-header">
        <i class="fas fa-photo-video page-header-icon"></i>
        <div class="container-lg">
            <span class="page-header-eyebrow"><i class="fas fa-circle-dot"></i> Information & Media</span>
            <h1>Media Center</h1>
            <p>Interest rates, service charges, notices, downloads and gallery — Shri Shantappanna Miraji Urban Co-op. Bank Ltd.</p>
        </div>
    </div>

    <!-- Tabs -->
    <section class="section bg-light py-3" style="position:sticky;top:56px;z-index:100;background:white!important;border-bottom:1px solid #e2e8f0;">
        <div class="container-lg">
            <ul class="nav nav-pills flex-wrap gap-2" id="mediaTabs" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="tab-rates" data-bs-toggle="pill" href="#rates" role="tab"><i class="fas fa-percent me-1"></i>Interest Rates</a></li>
                <li class="nav-item"><a class="nav-link" id="tab-charges" data-bs-toggle="pill" href="#charges" role="tab"><i class="fas fa-rupee-sign me-1"></i>Service Charges</a></li>
                <li class="nav-item"><a class="nav-link" id="tab-notices" data-bs-toggle="pill" href="#notices-tab" role="tab"><i class="fas fa-bell me-1"></i>Notices</a></li>
                <li class="nav-item"><a class="nav-link" id="tab-downloads" data-bs-toggle="pill" href="#downloads-tab" role="tab"><i class="fas fa-download me-1"></i>Downloads</a></li>
                <li class="nav-item"><a class="nav-link" id="tab-gallery" data-bs-toggle="pill" href="#gallery-tab" role="tab"><i class="fas fa-images me-1"></i>Gallery</a></li>
            </ul>
        </div>
    </section>

    <div class="container-lg py-5">
        <div class="tab-content" id="mediaTabsContent">

            <!-- ═══════════════════════════════════════
                 TAB 1: INTEREST RATES
            ═══════════════════════════════════════ -->
            <div class="tab-pane fade show active" id="rates" role="tabpanel">
                <h3 class="mb-4"><i class="fas fa-percent me-2 text-primary"></i>Interest Rates</h3>

                <!-- Deposit Rates -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header" style="background:linear-gradient(135deg,#1e40af,#3b82f6);color:white;">
                        <h5 class="mb-0"><i class="fas fa-piggy-bank me-2"></i>Deposit Interest Rates</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Type of Deposit</th>
                                        <th class="text-center">Period</th>
                                        <th class="text-center">General Public (% p.a.)</th>
                                        <th class="text-center">Senior Citizen / Soldier (% p.a.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="2"><strong>Saving Bank Deposit</strong></td>
                                        <td class="text-center">—</td>
                                        <td class="text-center"><strong>3.00%</strong></td>
                                        <td class="text-center"><strong>3.50%</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="small text-muted">Interest calculated on daily balance</td>
                                    </tr>
                                    <tr class="table-light">
                                        <td colspan="4"><strong>Term Deposits (Fixed Deposit / Recurring Deposit / Kalyan Nidhi)</strong></td>
                                    </tr>
                                    <tr><td>Term Deposit</td><td class="text-center">46 Days to 90 Days</td><td class="text-center"><strong>5.00%</strong></td><td class="text-center"><strong>5.50%</strong></td></tr>
                                    <tr><td>Term Deposit</td><td class="text-center">91 Days to 180 Days</td><td class="text-center"><strong>5.50%</strong></td><td class="text-center"><strong>6.00%</strong></td></tr>
                                    <tr><td>Term Deposit</td><td class="text-center">181 Days to 364 Days</td><td class="text-center"><strong>7.00%</strong></td><td class="text-center"><strong>7.50%</strong></td></tr>
                                    <tr class="table-success"><td>Term Deposit</td><td class="text-center">1 Year and above to &lt; 2 Years</td><td class="text-center"><strong>7.75%</strong></td><td class="text-center"><strong>8.25%</strong></td></tr>
                                    <tr class="table-success"><td>Term Deposit</td><td class="text-center">2 Years and above to &lt; 5 Years</td><td class="text-center"><strong>8.00%</strong></td><td class="text-center"><strong>8.50%</strong></td></tr>
                                    <tr><td>Term Deposit</td><td class="text-center">5 Years and above</td><td class="text-center"><strong>7.75%</strong></td><td class="text-center"><strong>8.25%</strong></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Loan Rates -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header" style="background:linear-gradient(135deg,#059669,#10b981);color:white;">
                        <h5 class="mb-0"><i class="fas fa-hand-holding-usd me-2"></i>Loan Interest Rates</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead class="table-success">
                                    <tr>
                                        <th>Sr.</th>
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
                                    <tr><td>8.</td><td>Two Wheeler Loan</td><td class="text-center"><strong>11.00%</strong></td></tr>
                                    <tr><td>9.</td><td>Four Wheeler / Commercial Vehicle Loan</td><td class="text-center"><strong>10.50%</strong></td></tr>
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
                </div>
                <div class="alert alert-info"><i class="fas fa-info-circle me-2"></i>Interest rates are subject to change as per RBI guidelines and bank board decisions. Please contact your nearest branch for the latest rates.</div>
            </div>

            <!-- ═══════════════════════════════════════
                 TAB 2: SERVICE CHARGES
            ═══════════════════════════════════════ -->
            <div class="tab-pane fade" id="charges" role="tabpanel">
                <h3 class="mb-4"><i class="fas fa-rupee-sign me-2 text-success"></i>Service Charges</h3>

                <!-- I. Membership -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white"><h6 class="mb-0"><i class="fas fa-users me-2"></i>I. Membership</h6></div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm mb-0">
                                <thead class="table-light"><tr><th>Sr.</th><th>Particulars</th><th class="text-center">Charges</th></tr></thead>
                                <tbody>
                                    <tr><td>1.</td><td>New Membership Admission Fee</td><td class="text-center">Rs. 100/-</td></tr>
                                    <tr><td>2.</td><td>Share Capital (per share)</td><td class="text-center">Rs. 100/- per share</td></tr>
                                    <tr><td>3.</td><td>Membership Transfer Fee</td><td class="text-center">Rs. 100/-</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- II. Deposits -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white"><h6 class="mb-0"><i class="fas fa-piggy-bank me-2"></i>II. Deposits</h6></div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm mb-0">
                                <thead class="table-light"><tr><th>Sr.</th><th>Particulars</th><th class="text-center">Charges</th></tr></thead>
                                <tbody>
                                    <tr><td>1.</td><td>Account Opening (SB / Current)</td><td class="text-center">Free</td></tr>
                                    <tr><td>2.</td><td>Minimum Balance (SB Account)</td><td class="text-center">Rs. 500/-</td></tr>
                                    <tr><td>3.</td><td>Duplicate Passbook</td><td class="text-center">Rs. 25/-</td></tr>
                                    <tr><td>4.</td><td>Account Closing Charges (within 1 year)</td><td class="text-center">Rs. 100/-</td></tr>
                                    <tr><td>5.</td><td>Nomination Registration / Change</td><td class="text-center">Free</td></tr>
                                    <tr><td>6.</td><td>Statement of Account</td><td class="text-center">Rs. 25/- per statement</td></tr>
                                    <tr><td>7.</td><td>FD / RD Premature Closure Penalty</td><td class="text-center">1.00% reduction in applicable rate</td></tr>
                                    <tr><td>8.</td><td>FD / RD Duplicate Certificate</td><td class="text-center">Rs. 50/-</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- III. Loans -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-warning text-dark"><h6 class="mb-0"><i class="fas fa-hand-holding-usd me-2"></i>III. Loans</h6></div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm mb-0">
                                <thead class="table-light"><tr><th>Sr.</th><th>Particulars</th><th class="text-center">Charges</th></tr></thead>
                                <tbody>
                                    <tr><td>1.</td><td>Loan Processing Fee (Personal / Surety Loan)</td><td class="text-center">0.25% of loan amount (Min. Rs. 100/-)</td></tr>
                                    <tr><td>2.</td><td>Loan Processing Fee (Mortgage / Housing / Vehicle)</td><td class="text-center">0.50% of loan amount</td></tr>
                                    <tr><td>3.</td><td>Legal / Valuation Charges</td><td class="text-center">At Actuals</td></tr>
                                    <tr><td>4.</td><td>Loan NOC Certificate</td><td class="text-center">Rs. 100/-</td></tr>
                                    <tr><td>5.</td><td>Penal Interest (Overdue Loans)</td><td class="text-center">2.00% p.a. over applicable rate</td></tr>
                                    <tr><td>6.</td><td>Loan Closure Certificate</td><td class="text-center">Rs. 100/-</td></tr>
                                    <tr><td>7.</td><td>Pre-closure Charges (Term Loans within lock-in)</td><td class="text-center">1.00% of outstanding amount</td></tr>
                                    <tr><td>8.</td><td>CIBIL Consent / Report Charges</td><td class="text-center">As applicable</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- IV. Cheque / Passbook -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header" style="background:#8b5cf6;color:white;"><h6 class="mb-0"><i class="fas fa-file-invoice me-2"></i>IV. Cheque / Passbook</h6></div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm mb-0">
                                <thead class="table-light"><tr><th>Sr.</th><th>Particulars</th><th class="text-center">Charges</th></tr></thead>
                                <tbody>
                                    <tr><td>1.</td><td>Cheque Book (First — SB Account)</td><td class="text-center">Free</td></tr>
                                    <tr><td>2.</td><td>Cheque Book (Subsequent — 10 leaves)</td><td class="text-center">Rs. 25/-</td></tr>
                                    <tr><td>3.</td><td>Cheque Book (Subsequent — 25 leaves)</td><td class="text-center">Rs. 50/-</td></tr>
                                    <tr><td>4.</td><td>Cheque Return Charges (Inward — Insufficient Funds)</td><td class="text-center">Rs. 200/- + GST</td></tr>
                                    <tr><td>5.</td><td>Cheque Return Charges (Outward)</td><td class="text-center">Rs. 150/- + GST</td></tr>
                                    <tr><td>6.</td><td>Stop Payment Instruction</td><td class="text-center">Rs. 100/- per instruction</td></tr>
                                    <tr><td>7.</td><td>Pay Order / Banker's Cheque (up to Rs. 10,000/-)</td><td class="text-center">Rs. 25/-</td></tr>
                                    <tr><td>8.</td><td>Pay Order / Banker's Cheque (Rs. 10,001/- to Rs. 1,00,000/-)</td><td class="text-center">Rs. 50/-</td></tr>
                                    <tr><td>9.</td><td>Pay Order / Banker's Cheque (above Rs. 1,00,000/-)</td><td class="text-center">Rs. 100/-</td></tr>
                                    <tr><td>10.</td><td>Pay Order Cancellation</td><td class="text-center">Rs. 50/-</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- V. Other Charges -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-secondary text-white"><h6 class="mb-0"><i class="fas fa-list me-2"></i>V. Other Charges</h6></div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm mb-0">
                                <thead class="table-light"><tr><th>Sr.</th><th>Particulars</th><th class="text-center">Charges</th></tr></thead>
                                <tbody>
                                    <tr><td>1.</td><td>RTGS (Rs. 2,00,001/- to Rs. 5,00,000/-)</td><td class="text-center">Rs. 25/- + GST</td></tr>
                                    <tr><td>2.</td><td>RTGS (Above Rs. 5,00,000/-)</td><td class="text-center">Rs. 50/- + GST</td></tr>
                                    <tr><td>3.</td><td>NEFT (Up to Rs. 10,000/-)</td><td class="text-center">Rs. 2.50 + GST</td></tr>
                                    <tr><td>4.</td><td>NEFT (Rs. 10,001/- to Rs. 1,00,000/-)</td><td class="text-center">Rs. 5/- + GST</td></tr>
                                    <tr><td>5.</td><td>NEFT (Rs. 1,00,001/- to Rs. 2,00,000/-)</td><td class="text-center">Rs. 15/- + GST</td></tr>
                                    <tr><td>6.</td><td>NEFT (Above Rs. 2,00,000/-)</td><td class="text-center">Rs. 25/- + GST</td></tr>
                                    <tr><td>7.</td><td>Signature Verification / Balance Certificate</td><td class="text-center">Rs. 100/-</td></tr>
                                    <tr><td>8.</td><td>No-Due / No-Liability Certificate</td><td class="text-center">Rs. 100/-</td></tr>
                                    <tr><td>9.</td><td>Safe Custody of Documents (per year)</td><td class="text-center">Rs. 200/- per year</td></tr>
                                    <tr><td>10.</td><td>ATM Card (if applicable)</td><td class="text-center">As per prevailing charges</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="alert alert-info"><i class="fas fa-info-circle me-2"></i>All charges are exclusive of applicable GST. Charges are subject to revision as per bank board decisions. Contact your nearest branch for the latest schedule.</div>
            </div>

            <!-- ═══════════════════════════════════════
                 TAB 3: NOTICES
            ═══════════════════════════════════════ -->
            <div class="tab-pane fade" id="notices-tab" role="tabpanel">
                <h3 class="mb-4"><i class="fas fa-bell me-2 text-warning"></i>Notices &amp; Announcements</h3>

                <!-- DEAF Accounts Notice -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header" style="background:linear-gradient(135deg,#dc2626,#ef4444);color:white;">
                        <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>DEAF Accounts — Dormant / Inoperative Account Notice</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger mb-4">
                            <h6><i class="fas fa-info-circle me-2"></i>What is a DEAF Account?</h6>
                            <p class="mb-2">DEAF stands for <strong>Depositor Education and Awareness Fund</strong>. As per RBI guidelines, if a savings or current account has not been operated (credit or debit transactions) for a period of <strong>10 years or more</strong>, the balance in such accounts is transferred to the DEAF maintained by the Reserve Bank of India.</p>
                            <p class="mb-0">Account holders or their nominees/legal heirs can still claim their money by contacting the bank. The bank will process the claim and the amount will be received from RBI.</p>
                        </div>
                        <h6 class="mb-3"><i class="fas fa-list me-2 text-danger"></i>DEAF Account List till 31-12-2025</h6>
                        <p class="text-muted mb-3">The following accounts have been identified as dormant/inoperative and are scheduled for transfer to DEAF. Account holders are requested to contact their nearest branch to reactivate their accounts before the transfer date.</p>
                        <div class="alert alert-warning">
                            <i class="fas fa-download me-2"></i>
                            The complete DEAF accounts list is available for download at your nearest branch or will be published in due course. If you believe your account may be on this list, please contact us immediately at:
                            <strong>+91 8338273169</strong> or <strong>+91 8494903886</strong>
                        </div>
                        <div class="row g-3 mt-2">
                            <div class="col-md-4"><div class="card bg-light text-center p-3"><i class="fas fa-phone fa-2x text-primary mb-2"></i><strong>Call Us</strong><br><small>+91 8338273169</small></div></div>
                            <div class="col-md-4"><div class="card bg-light text-center p-3"><i class="fas fa-envelope fa-2x text-primary mb-2"></i><strong>Email Us</strong><br><small>shantappanna@mirajibank.com</small></div></div>
                            <div class="col-md-4"><div class="card bg-light text-center p-3"><i class="fas fa-map-marker-alt fa-2x text-primary mb-2"></i><strong>Visit Us</strong><br><small>Any of our 14 branches</small></div></div>
                        </div>
                    </div>
                </div>

                <!-- Appointment of Statutory Auditor -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header" style="background:linear-gradient(135deg,#0369a1,#0284c7);color:white;">
                        <h5 class="mb-0"><i class="fas fa-user-tie me-2"></i>Appointment — Statutory Auditor</h5>
                    </div>
                    <div class="card-body">
                        <p>As per the provisions of the Karnataka Co-operative Societies Act and RBI guidelines for Urban Co-operative Banks, the bank appoints its Statutory Auditor annually. The appointment is approved by the Board of Directors and confirmed at the Annual General Meeting.</p>
                        <p>Members are informed that the appointment of the Statutory Auditor for the current financial year has been duly made. The details of the appointed auditor are available at the Head Office and can be obtained upon request.</p>
                        <div class="alert alert-primary mt-3">
                            <i class="fas fa-info-circle me-2"></i>For details on the appointed statutory auditor or audit-related queries, please contact the Head Office at <strong>944-945, Guruwar Peth Chikodi, Belagavi Karnataka 591201</strong> or call <strong>+91 8338273169</strong>.
                        </div>
                    </div>
                </div>

                <!-- AGM Notice -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header" style="background:linear-gradient(135deg,#059669,#10b981);color:white;">
                        <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>AGM Notice — Annual General Meeting</h5>
                    </div>
                    <div class="card-body">
                        <p>All members of Shri Shantappanna Miraji Urban Co-op. Bank Ltd., Chikodi are hereby notified about the Annual General Body Meeting. The agenda includes:</p>
                        <ul>
                            <li>Confirmation of the minutes of the last AGM</li>
                            <li>Presentation and adoption of the Annual Report and Accounts</li>
                            <li>Appointment / Re-appointment of Statutory Auditor</li>
                            <li>Declaration of dividend (if any)</li>
                            <li>Election of Board members (if due)</li>
                            <li>Any other matter with the permission of the Chair</li>
                        </ul>
                        <div class="alert alert-success mt-3">
                            <i class="fas fa-download me-2"></i>The detailed AGM notice with date, time, and venue is available in the <strong>Downloads</strong> section below.
                        </div>
                    </div>
                </div>

                <!-- DB Notices -->
                <?php if (!empty($notices)): ?>
                <h5 class="mb-3 mt-4"><i class="fas fa-bell me-2 text-warning"></i>Latest Notices from Bank</h5>
                <div class="row g-3">
                    <?php foreach ($notices as $ni => $notice): ?>
                    <div class="col-md-6">
                        <div class="card h-100 border-warning" style="border-left:4px solid #f59e0b!important;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="card-title mb-0"><?php echo htmlspecialchars($notice['title']); ?></h6>
                                    <span class="badge bg-warning text-dark ms-2">Notice</span>
                                </div>
                                <p class="text-muted small"><i class="fas fa-calendar-alt me-1"></i><?php echo formatNoticeDate($notice['date_published']); ?></p>
                                <p class="card-text small"><?php echo htmlspecialchars(substr(strip_tags($notice['content']), 0, 100)) . '...'; ?></p>
                                <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#noticeModal<?php echo $ni; ?>">Read More</button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="alert alert-light border mt-3"><i class="fas fa-info-circle me-2 text-muted"></i>No additional notices at this time. Please check back later.</div>
                <?php endif; ?>
            </div>

            <!-- ═══════════════════════════════════════
                 TAB 4: DOWNLOADS
            ═══════════════════════════════════════ -->
            <div class="tab-pane fade" id="downloads-tab" role="tabpanel">
                <h3 class="mb-4"><i class="fas fa-download me-2 text-primary"></i>Downloads</h3>

                <!-- AGM Annual Reports -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header" style="background:linear-gradient(135deg,#1e40af,#3b82f6);color:white;">
                        <h5 class="mb-0"><i class="fas fa-star me-2"></i>Welcome to Annual General Body Meeting 2024-2025</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-4">The Annual Report of Shri Shantappanna Miraji Urban Co-op. Bank Ltd., Chikodi is available for download. These reports contain the bank's financial statements, board reports, audit findings, and other important information for members.</p>
                        <div class="row g-3">
                            <div class="col-md-6 col-lg-4">
                                <div class="card border-primary h-100">
                                    <div class="card-body text-center py-4">
                                        <i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>
                                        <h6>Annual Report 2024-25</h6>
                                        <p class="small text-muted">Financial Year 2024-2025</p>
                                        <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-download me-1"></i>Download</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100">
                                    <div class="card-body text-center py-4">
                                        <i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>
                                        <h6>Annual Report 2023-24</h6>
                                        <p class="small text-muted">Financial Year 2023-2024</p>
                                        <a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-download me-1"></i>Download</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100">
                                    <div class="card-body text-center py-4">
                                        <i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>
                                        <h6>Annual Report 2022-23</h6>
                                        <p class="small text-muted">Financial Year 2022-2023</p>
                                        <a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-download me-1"></i>Download</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100">
                                    <div class="card-body text-center py-4">
                                        <i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>
                                        <h6>Annual Report 2021-22</h6>
                                        <p class="small text-muted">Financial Year 2021-2022</p>
                                        <a href="#" class="btn btn-sm btn-outline-secondary"><i class="fas fa-download me-1"></i>Download</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100">
                                    <div class="card-body text-center py-4">
                                        <i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>
                                        <h6>Annual Report 2020-21</h6>
                                        <p class="small text-muted">Financial Year 2020-2021</p>
                                        <a href="#" class="btn btn-sm btn-outline-secondary"><i class="fas fa-download me-1"></i>Download</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100">
                                    <div class="card-body text-center py-4">
                                        <i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>
                                        <h6>Annual Report 2019-20</h6>
                                        <p class="small text-muted">Financial Year 2019-2020</p>
                                        <a href="#" class="btn btn-sm btn-outline-secondary"><i class="fas fa-download me-1"></i>Download</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bank Uploaded Downloads -->
                <?php if (!empty($db_downloads)): ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light"><h5 class="mb-0"><i class="fas fa-folder-open me-2 text-primary"></i>Other Downloads</h5></div>
                    <div class="card-body">
                        <div class="row g-3">
                            <?php foreach ($db_downloads as $dl): ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border-light">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <?php
                                            $ext = strtolower(pathinfo($dl['file_path'] ?? '', PATHINFO_EXTENSION));
                                            $icon = ($ext === 'pdf') ? 'fa-file-pdf text-danger' : (in_array($ext, ['jpg','jpeg','png','gif']) ? 'fa-file-image text-success' : 'fa-file text-secondary');
                                            ?>
                                            <i class="fas <?php echo $icon; ?> fa-2x me-3"></i>
                                            <div style="flex:1;">
                                                <h6 class="mb-1"><?php echo htmlspecialchars($dl['title']); ?></h6>
                                                <?php if (!empty($dl['description'])): ?>
                                                <p class="small text-muted mb-2"><?php echo htmlspecialchars($dl['description']); ?></p>
                                                <?php endif; ?>
                                                <a href="/uploads/downloads/<?php echo basename($dl['file_path']); ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fas fa-download me-1"></i>Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="alert alert-light border"><i class="fas fa-info-circle me-2 text-muted"></i>If you need any specific form or document not listed here, please visit your nearest branch or contact us at <strong>shantappanna@mirajibank.com</strong>.</div>
            </div>

            <!-- ═══════════════════════════════════════
                 TAB 5: GALLERY
            ═══════════════════════════════════════ -->
            <div class="tab-pane fade" id="gallery-tab" role="tabpanel">
                <h3 class="mb-4"><i class="fas fa-images me-2 text-primary"></i>Photo Gallery</h3>
                <?php if (!empty($gallery_images)): ?>
                <div class="row g-3">
                    <?php foreach ($gallery_images as $gi => $img): ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card overflow-hidden h-100" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#galleryModal<?php echo $gi; ?>">
                            <img src="/uploads/gallery/<?php echo basename($img['image_path']); ?>"
                                 class="card-img-top"
                                 style="height:180px;object-fit:cover;"
                                 alt="<?php echo htmlspecialchars($img['title'] ?? 'Gallery'); ?>"
                                 onerror="this.src='/assets/images/placeholder.jpg'">
                            <?php if (!empty($img['title'])): ?>
                            <div class="card-body p-2"><small class="text-muted"><?php echo htmlspecialchars($img['title']); ?></small></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal fade" id="galleryModal<?php echo $gi; ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header"><h6 class="modal-title"><?php echo htmlspecialchars($img['title'] ?? 'Gallery Image'); ?></h6><button class="btn-close" data-bs-dismiss="modal"></button></div>
                                <div class="modal-body p-0 text-center">
                                    <img src="/uploads/gallery/<?php echo basename($img['image_path']); ?>"
                                         class="img-fluid"
                                         alt="<?php echo htmlspecialchars($img['title'] ?? 'Gallery'); ?>"
                                         onerror="this.src='/assets/images/placeholder.jpg'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="text-center py-5">
                    <i class="fas fa-images fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">No Photos Available</h5>
                    <p class="text-muted">Gallery photos will be added soon. Please check back later.</p>
                </div>
                <?php endif; ?>
            </div>

        </div><!-- end tab-content -->
    </div>

    <!-- CTA -->
    <section class="section" style="background:linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);color:white;">
        <div class="container-lg text-center">
            <h2 class="mb-3">Have Questions?</h2>
            <p class="lead mb-4">Our team is ready to help you with any queries about our rates, charges, or services.</p>
            <a href="/pages/contact.php" class="btn btn-light btn-lg me-3">
                <i class="fas fa-phone me-2"></i>Contact Us
            </a>
            <a href="/pages/services.php" class="btn btn-outline-light btn-lg">
                <i class="fas fa-concierge-bell me-2"></i>Our Services
            </a>
        </div>
    </section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
