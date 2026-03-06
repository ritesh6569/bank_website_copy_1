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

// Fetch interest rates from DB
$deposit_rates_db = [];
$loan_rates_db    = [];
$loan_rates_grouped = [];
try {
    $pdo = getDBConnection();
    if ($pdo) {
        $stmt = $pdo->prepare("SELECT * FROM deposit_rates WHERE status = 'active' ORDER BY display_order, id");
        $stmt->execute();
        $deposit_rates_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare("SELECT * FROM loan_rates WHERE status = 'active' ORDER BY display_order, id");
        $stmt->execute();
        $loan_rates_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($loan_rates_db as $row) {
            $loan_rates_grouped[$row['category']][] = $row;
        }
    }
} catch (Exception $e) { /* silent */ }
?>


    <!-- Page Header -->
    <div class="page-header">
        <i class="fas fa-photo-video page-header-icon"></i>
        <div class="container-lg">
            <span class="page-header-eyebrow"><i class="fas fa-circle-dot"></i> Information & Media</span>
            <h1>Media Center</h1>
            <p>Interest rates, service charges, notices, downloads and gallery — Shri Shantappanna Miraji Urban Co-op. Bank Ltd.</p>
        </div>
    </div>

    <!-- ── Tab Navigation ── -->
    <div id="mediaTabNav" style="background:#fff;border-bottom:2px solid #e2e8f0;position:sticky;top:64px;z-index:100;">
        <div class="container-lg">
            <ul class="nav media-tab-nav flex-nowrap overflow-auto mb-0" id="mediaTabs" role="tablist" style="gap:0;border:none;">
                <li class="nav-item" role="presentation">
                    <button class="media-tab-btn active" id="tab-rates" data-bs-toggle="pill" data-bs-target="#rates" type="button" role="tab">
                        <i class="fas fa-percent me-2"></i>Interest Rates
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="media-tab-btn" id="tab-charges" data-bs-toggle="pill" data-bs-target="#charges" type="button" role="tab">
                        <i class="fas fa-receipt me-2"></i>Service Charges
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="media-tab-btn" id="tab-notices" data-bs-toggle="pill" data-bs-target="#notices-tab" type="button" role="tab">
                        <i class="fas fa-bell me-2"></i>Notices
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="media-tab-btn" id="tab-downloads" data-bs-toggle="pill" data-bs-target="#downloads-tab" type="button" role="tab">
                        <i class="fas fa-download me-2"></i>Downloads
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="media-tab-btn" id="tab-gallery" data-bs-toggle="pill" data-bs-target="#gallery-tab" type="button" role="tab">
                        <i class="fas fa-images me-2"></i>Gallery
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <style>
    /* ── Media Tab Navigation ── */
    .media-tab-btn {
        display: inline-flex;
        align-items: center;
        padding: 0.85rem 1.35rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #64748b;
        background: none;
        border: none;
        border-bottom: 3px solid transparent;
        cursor: pointer;
        white-space: nowrap;
        transition: color 0.2s, border-color 0.2s;
        letter-spacing: 0.01em;
        margin-bottom: -2px;
    }
    .media-tab-btn:hover { color: #1e40af; border-bottom-color: #bfdbfe; }
    .media-tab-btn.active { color: #1e40af; border-bottom-color: #1e40af; background: none; }

    /* ── Section dividers within tab content ── */
    .media-section-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #e2e8f0;
        margin-bottom: 1.5rem;
    }
    .media-section-header .icon-wrap {
        width: 40px; height: 40px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        font-size: 1rem;
    }
    .media-section-header h4 {
        margin: 0;
        font-size: 1.05rem;
        font-weight: 700;
        color: #1e293b;
    }
    .media-section-header p {
        margin: 0;
        font-size: 0.8rem;
        color: #64748b;
    }

    /* ── Clean institutional tables ── */
    .bank-table { width:100%; border-collapse:collapse; font-size:0.875rem; }
    .bank-table thead tr { background:#1e3a5f; color:#fff; }
    .bank-table thead th { padding:0.7rem 1rem; font-weight:600; border:none; letter-spacing:0.02em; font-size:0.8rem; text-transform:uppercase; }
    .bank-table tbody tr:nth-child(even) { background:#f8fafc; }
    .bank-table tbody tr:hover { background:#eff6ff; }
    .bank-table tbody td { padding:0.65rem 1rem; border-bottom:1px solid #e2e8f0; color:#334155; vertical-align:middle; }
    .bank-table tbody tr.category-row td { background:#f1f5f9; font-weight:700; color:#1e40af; padding:0.5rem 1rem; font-size:0.8rem; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #cbd5e1; }
    .bank-table .rate-cell { font-weight:700; color:#1e40af; }
    .bank-table .rate-cell-green { font-weight:700; color:#059669; }

    /* ── Notice cards ── */
    .notice-card {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1.25rem;
        background: #fff;
        border-left: 4px solid #f59e0b;
        transition: box-shadow 0.2s;
    }
    .notice-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
    .notice-card .notice-date { font-size:0.78rem; color:#94a3b8; margin-bottom:0.4rem; }
    .notice-card h6 { font-size:0.95rem; font-weight:700; color:#1e293b; margin-bottom:0.5rem; }
    .notice-card p { font-size:0.85rem; color:#475569; margin:0 0 0.75rem; }

    /* ── Download list items ── */
    .download-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.25rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #fff;
        transition: box-shadow 0.2s, border-color 0.2s;
    }
    .download-item:hover { box-shadow: 0 3px 10px rgba(0,0,0,0.07); border-color: #bfdbfe; }
    .download-item .dl-icon { width:44px; height:44px; border-radius:8px; background:#fef2f2; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:1.3rem; color:#dc2626; }
    .download-item .dl-icon.pdf { background:#fef2f2; color:#dc2626; }
    .download-item .dl-icon.doc { background:#eff6ff; color:#2563eb; }
    .download-item .dl-icon.other { background:#f0fdf4; color:#16a34a; }
    .download-item .dl-info { flex:1; min-width:0; }
    .download-item .dl-info h6 { font-size:0.9rem; font-weight:700; color:#1e293b; margin:0 0 0.2rem; }
    .download-item .dl-info small { font-size:0.78rem; color:#94a3b8; }
    .download-item .dl-year-badge { font-size:0.72rem; font-weight:700; padding:0.25rem 0.6rem; border-radius:4px; background:#eff6ff; color:#1e40af; white-space:nowrap; }

    /* ── Gallery ── */
    .gallery-wrap { border: 2px solid #e2e8f0; border-radius: 10px; overflow: hidden; background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.06); transition: border-color 0.2s, box-shadow 0.2s; }
    .gallery-wrap:hover { border-color: #93c5fd; box-shadow: 0 6px 20px rgba(30,64,175,0.12); }
    .gallery-item { position:relative; overflow:hidden; cursor:pointer; background:#f1f5f9; aspect-ratio:4/3; }
    .gallery-item img { width:100%; height:100%; object-fit:cover; display:block; transition:transform 0.35s ease; }
    .gallery-item:hover img { transform:scale(1.06); }
    .gallery-item .gallery-overlay { position:absolute; inset:0; background:rgba(15,44,94,0); display:flex; align-items:center; justify-content:center; transition:background 0.3s; }
    .gallery-item:hover .gallery-overlay { background:rgba(15,44,94,0.45); }
    .gallery-item .gallery-overlay i { color:#fff; font-size:1.6rem; opacity:0; transform:scale(0.8); transition:opacity 0.3s, transform 0.3s; }
    .gallery-item:hover .gallery-overlay i { opacity:1; transform:scale(1); }
    .gallery-caption { font-size:0.78rem; color:#475569; padding:0.5rem 0.75rem; background:#fff; border-top:1px solid #f1f5f9; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }

    /* ── Latest Notices board ── */
    .nboard-wrap { background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 12px; overflow: hidden; }
    .nboard-head { background: #1e3a5f; padding: 0.9rem 1.4rem; display: flex; align-items: center; gap: 0.7rem; }
    .nboard-head-icon { color: #93c5fd; font-size: 1rem; }
    .nboard-head-text { color: #fff; font-size: 0.9rem; font-weight: 700; letter-spacing: 0.03em; flex: 1; }
    .nboard-head-badge { background: #2563eb; color: #dbeafe; font-size: 0.68rem; font-weight: 800; padding: 0.18rem 0.65rem; border-radius: 20px; border: 1px solid #3b82f6; }
    .nboard-list { padding: 1rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.75rem; }
    @media (max-width: 640px) { .nboard-list { grid-template-columns: 1fr; } }
    .nboard-card { background: #fff; border: 1px solid #cbd5e1; border-radius: 8px; padding: 1.1rem 1.25rem; cursor: pointer; transition: box-shadow 0.18s, border-color 0.18s; position: relative; overflow: hidden; }
    .nboard-card::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: #94a3b8; transition: background 0.18s; }
    .nboard-card:hover { box-shadow: 0 4px 18px rgba(30,58,95,0.12); border-color: #93c5fd; }
    .nboard-card:hover::before { background: #1e3a5f; }
    .nboard-card-header { display: flex; align-items: flex-start; justify-content: space-between; gap: 0.75rem; margin-bottom: 0.4rem; }
    .nboard-card-title { font-size: 0.9rem; font-weight: 700; color: #0f172a; line-height: 1.4; }
    .nboard-card-tag { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; border-radius: 4px; font-size: 0.62rem; font-weight: 800; letter-spacing: 0.06em; text-transform: uppercase; padding: 0.18rem 0.5rem; white-space: nowrap; flex-shrink: 0; margin-top: 2px; }
    .nboard-card-date { font-size: 0.73rem; color: #64748b; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.3rem; }
    .nboard-card-preview { font-size: 0.82rem; color: #475569; line-height: 1.6; margin: 0 0 0.75rem; }
    .nboard-card-btn { display: inline-flex; align-items: center; gap: 0.3rem; font-size: 0.74rem; font-weight: 600; color: #1e3a5f; background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 5px; padding: 0.28rem 0.7rem; transition: background 0.15s, border-color 0.15s; }
    .nboard-card:hover .nboard-card-btn { background: #dbeafe; border-color: #93c5fd; color: #1d4ed8; }
    .nboard-foot { padding: 0.65rem 1.4rem; border-top: 1px solid #cbd5e1; display: flex; align-items: center; gap: 0.45rem; font-size: 0.75rem; color: #64748b; background: #f8fafc; }

    /* ── Info disclaimer box ── */
    .info-note { display:flex; gap:0.75rem; align-items:flex-start; background:#f0f9ff; border:1px solid #bae6fd; border-radius:8px; padding:1rem 1.25rem; font-size:0.85rem; color:#0369a1; }
    .info-note i { margin-top:2px; flex-shrink:0; }
    </style>

    <!-- ── Tab Content ── -->
    <div class="container-lg py-5">
        <div class="tab-content" id="mediaTabsContent">

            <!-- ═══════════════════════════════════════
                 TAB 1: INTEREST RATES
            ═══════════════════════════════════════ -->
            <div class="tab-pane fade show active" id="rates" role="tabpanel">

                <div class="section-title text-start mb-4">
                    <span class="text-primary small text-uppercase fw-bold">Media Center</span>
                    <h2 class="text-start">Interest Rates</h2>
                </div>

                <!-- Deposit Rates -->
                <div class="mb-5">
                    <div class="media-section-header">
                        <div class="icon-wrap" style="background:#eff6ff;color:#1e40af;"><i class="fas fa-piggy-bank"></i></div>
                        <div>
                            <h4>Deposit Interest Rates</h4>
                            <p>Rates applicable for Savings, Fixed &amp; Recurring Deposits</p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="bank-table">
                            <thead>
                                <tr>
                                    <th>Type of Deposit</th>
                                    <th>Period</th>
                                    <th class="text-center">General Public<br><small style="font-weight:400;text-transform:none;letter-spacing:0;">(% p.a.)</small></th>
                                    <th class="text-center">Senior Citizen / Soldier<br><small style="font-weight:400;text-transform:none;letter-spacing:0;">(% p.a.)</small></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($deposit_rates_db)): ?>
                                <tr><td colspan="4" class="text-center text-muted py-4">Deposit rate information will be updated soon.</td></tr>
                                <?php else: ?>
                                <?php foreach ($deposit_rates_db as $r): ?>
                                <?php if (empty($r['general_rate']) && empty($r['period'])): ?>
                                <tr class="category-row"><td colspan="4"><?php echo htmlspecialchars($r['deposit_type']); ?></td></tr>
                                <?php else: ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($r['deposit_type']); ?></td>
                                    <td><?php echo htmlspecialchars($r['period']); ?></td>
                                    <td class="text-center rate-cell"><?php echo htmlspecialchars($r['general_rate']); ?></td>
                                    <td class="text-center rate-cell"><?php echo htmlspecialchars($r['senior_rate']); ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Loan Rates -->
                <div class="mb-5">
                    <div class="media-section-header">
                        <div class="icon-wrap" style="background:#f0fdf4;color:#059669;"><i class="fas fa-hand-holding-usd"></i></div>
                        <div>
                            <h4>Loan Interest Rates</h4>
                            <p>Rates applicable on all loan and credit facilities</p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="bank-table">
                            <thead>
                                <tr>
                                    <th style="width:50px;">Sr.</th>
                                    <th>Type of Loan</th>
                                    <th class="text-center">Interest Rate<br><small style="font-weight:400;text-transform:none;letter-spacing:0;">(% p.a.)</small></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($loan_rates_grouped)): ?>
                                <tr><td colspan="3" class="text-center text-muted py-4">Loan rate information will be updated soon.</td></tr>
                                <?php else: ?>
                                <?php $sr = 1; foreach ($loan_rates_grouped as $category => $rows): ?>
                                <tr class="category-row"><td colspan="3"><?php echo htmlspecialchars($category); ?></td></tr>
                                <?php foreach ($rows as $r): ?>
                                <tr>
                                    <td><?php echo $sr++; ?>.</td>
                                    <td><?php echo htmlspecialchars($r['loan_type']); ?></td>
                                    <td class="text-center rate-cell-green"><?php echo htmlspecialchars($r['interest_rate']); ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="info-note">
                    <i class="fas fa-info-circle"></i>
                    <span>Interest rates are subject to change as per RBI guidelines and bank board decisions. Please contact your nearest branch for the latest applicable rates before making any financial decisions.</span>
                </div>
            </div>

            <!-- ═══════════════════════════════════════
                 TAB 2: SERVICE CHARGES
            ═══════════════════════════════════════ -->
            <div class="tab-pane fade" id="charges" role="tabpanel">

                <div class="section-title text-start mb-4">
                    <span class="text-primary small text-uppercase fw-bold">Media Center</span>
                    <h2 class="text-start">Service Charges</h2>
                </div>

                <?php
                $charge_sections = [
                    ['icon'=>'fa-users','color'=>'#eff6ff','icolor'=>'#1e40af','title'=>'I. Membership','rows'=>[
                        ['1.','New Membership Admission Fee','Rs. 100/-'],
                        ['2.','Share Capital (per share)','Rs. 100/- per share'],
                        ['3.','Membership Transfer Fee','Rs. 100/-'],
                    ]],
                    ['icon'=>'fa-piggy-bank','color'=>'#f0fdf4','icolor'=>'#059669','title'=>'II. Deposits','rows'=>[
                        ['1.','Account Opening (SB / Current)','Free'],
                        ['2.','Minimum Balance (SB Account)','Rs. 500/-'],
                        ['3.','Duplicate Passbook','Rs. 25/-'],
                        ['4.','Account Closing Charges (within 1 year)','Rs. 100/-'],
                        ['5.','Nomination Registration / Change','Free'],
                        ['6.','Statement of Account','Rs. 25/- per statement'],
                        ['7.','FD / RD Premature Closure Penalty','1.00% reduction in applicable rate'],
                        ['8.','FD / RD Duplicate Certificate','Rs. 50/-'],
                    ]],
                    ['icon'=>'fa-hand-holding-usd','color'=>'#fffbeb','icolor'=>'#d97706','title'=>'III. Loans','rows'=>[
                        ['1.','Loan Processing Fee (Personal / Surety Loan)','0.25% of loan amount (Min. Rs. 100/-)'],
                        ['2.','Loan Processing Fee (Mortgage / Housing / Vehicle)','0.50% of loan amount'],
                        ['3.','Legal / Valuation Charges','At Actuals'],
                        ['4.','Loan NOC Certificate','Rs. 100/-'],
                        ['5.','Penal Interest (Overdue Loans)','2.00% p.a. over applicable rate'],
                        ['6.','Loan Closure Certificate','Rs. 100/-'],
                        ['7.','Pre-closure Charges (Term Loans within lock-in)','1.00% of outstanding amount'],
                        ['8.','CIBIL Consent / Report Charges','As applicable'],
                    ]],
                    ['icon'=>'fa-file-invoice','color'=>'#faf5ff','icolor'=>'#7c3aed','title'=>'IV. Cheque / Passbook','rows'=>[
                        ['1.','Cheque Book (First — SB Account)','Free'],
                        ['2.','Cheque Book (Subsequent — 10 leaves)','Rs. 25/-'],
                        ['3.','Cheque Book (Subsequent — 25 leaves)','Rs. 50/-'],
                        ['4.','Cheque Return Charges (Inward — Insufficient Funds)','Rs. 200/- + GST'],
                        ['5.','Cheque Return Charges (Outward)','Rs. 150/- + GST'],
                        ['6.','Stop Payment Instruction','Rs. 100/- per instruction'],
                        ['7.','Pay Order / Banker\'s Cheque (up to Rs. 10,000/-)','Rs. 25/-'],
                        ['8.','Pay Order / Banker\'s Cheque (Rs. 10,001/- to Rs. 1,00,000/-)','Rs. 50/-'],
                        ['9.','Pay Order / Banker\'s Cheque (above Rs. 1,00,000/-)','Rs. 100/-'],
                        ['10.','Pay Order Cancellation','Rs. 50/-'],
                    ]],
                    ['icon'=>'fa-list-ul','color'=>'#f8fafc','icolor'=>'#475569','title'=>'V. Other Charges','rows'=>[
                        ['1.','RTGS (Rs. 2,00,001/- to Rs. 5,00,000/-)','Rs. 25/- + GST'],
                        ['2.','RTGS (Above Rs. 5,00,000/-)','Rs. 50/- + GST'],
                        ['3.','NEFT (Up to Rs. 10,000/-)','Rs. 2.50 + GST'],
                        ['4.','NEFT (Rs. 10,001/- to Rs. 1,00,000/-)','Rs. 5/- + GST'],
                        ['5.','NEFT (Rs. 1,00,001/- to Rs. 2,00,000/-)','Rs. 15/- + GST'],
                        ['6.','NEFT (Above Rs. 2,00,000/-)','Rs. 25/- + GST'],
                        ['7.','Signature Verification / Balance Certificate','Rs. 100/-'],
                        ['8.','No-Due / No-Liability Certificate','Rs. 100/-'],
                        ['9.','Safe Custody of Documents (per year)','Rs. 200/- per year'],
                        ['10.','ATM Card (if applicable)','As per prevailing charges'],
                    ]],
                ];
                foreach ($charge_sections as $cs):
                ?>
                <div class="mb-5">
                    <div class="media-section-header">
                        <div class="icon-wrap" style="background:<?php echo $cs['color']; ?>;color:<?php echo $cs['icolor']; ?>;"><i class="fas <?php echo $cs['icon']; ?>"></i></div>
                        <div><h4><?php echo $cs['title']; ?></h4></div>
                    </div>
                    <div class="table-responsive">
                        <table class="bank-table">
                            <thead><tr><th style="width:45px;">Sr.</th><th>Particulars</th><th class="text-end" style="width:260px;">Charges</th></tr></thead>
                            <tbody>
                                <?php foreach ($cs['rows'] as $row): ?>
                                <tr>
                                    <td style="color:#94a3b8;"><?php echo $row[0]; ?></td>
                                    <td><?php echo $row[1]; ?></td>
                                    <td class="text-end" style="font-weight:600;color:#1e293b;"><?php echo $row[2]; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endforeach; ?>

                <div class="info-note">
                    <i class="fas fa-info-circle"></i>
                    <span>All charges are exclusive of applicable GST. Charges are subject to revision as per bank board decisions. Please contact your nearest branch for the latest schedule of charges.</span>
                </div>
            </div>

            <!-- ═══════════════════════════════════════
                 TAB 3: NOTICES
            ═══════════════════════════════════════ -->
            <div class="tab-pane fade" id="notices-tab" role="tabpanel">

                <div class="section-title text-start mb-4">
                    <span class="text-primary small text-uppercase fw-bold">Media Center</span>
                    <h2 class="text-start">Notices &amp; Announcements</h2>
                </div>

                <!-- Statutory Auditor -->
                <div class="mb-4">
                    <div class="media-section-header">
                        <div class="icon-wrap" style="background:#eff6ff;color:#1e40af;"><i class="fas fa-user-tie"></i></div>
                        <div>
                            <h4>Appointment — Statutory Auditor</h4>
                            <p>As per Karnataka Co-operative Societies Act &amp; RBI guidelines</p>
                        </div>
                    </div>
                    <div style="border:1px solid #cbd5e1;border-radius:10px;overflow:hidden;">
                        <div style="background:#1e3a5f;padding:0.7rem 1.25rem;display:flex;align-items:center;gap:0.65rem;">
                            <i class="fas fa-stamp" style="color:#93c5fd;font-size:0.9rem;"></i>
                            <span style="color:#e2e8f0;font-size:0.8rem;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;">Official Notice — Statutory Audit</span>
                            <span style="margin-left:auto;background:#2563eb;color:#dbeafe;font-size:0.7rem;font-weight:700;padding:0.2rem 0.6rem;border-radius:4px;letter-spacing:0.04em;border:1px solid #3b82f6;">ANNUAL</span>
                        </div>
                        <div style="background:#fff;padding:1.5rem;">
                            <p style="color:#334155;line-height:1.8;margin-bottom:0.85rem;">As per the provisions of the Karnataka Co-operative Societies Act and RBI guidelines for Urban Co-operative Banks, the bank appoints its Statutory Auditor annually. The appointment is approved by the Board of Directors and confirmed at the Annual General Meeting.</p>
                            <p style="color:#334155;line-height:1.8;margin-bottom:1rem;">Members are informed that the appointment of the Statutory Auditor for the current financial year has been duly made. The details of the appointed auditor are available at the Head Office and can be obtained upon request.</p>
                            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:0.9rem 1.1rem;display:flex;gap:0.75rem;align-items:flex-start;">
                                <i class="fas fa-building" style="color:#1e40af;margin-top:3px;flex-shrink:0;"></i>
                                <span style="font-size:0.85rem;color:#334155;">Head Office: <strong>944-945, Guruwar Peth Chikodi, Belagavi Karnataka 591201</strong> &nbsp;|&nbsp; <i class="fas fa-phone me-1" style="color:#1e40af;font-size:0.75rem;"></i><strong>+91 8338273169</strong></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- AGM Notice -->
                <div class="mb-5">
                    <div class="media-section-header">
                        <div class="icon-wrap" style="background:#eff6ff;color:#1e40af;"><i class="fas fa-calendar-alt"></i></div>
                        <div>
                            <h4>AGM Notice — Annual General Meeting</h4>
                            <p>Notice to all members of Shri Shantappanna Miraji Urban Co-op. Bank Ltd.</p>
                        </div>
                    </div>
                    <div style="border:1px solid #cbd5e1;border-radius:10px;overflow:hidden;">
                        <div style="background:#1e3a5f;padding:0.7rem 1.25rem;display:flex;align-items:center;gap:0.65rem;">
                            <i class="fas fa-gavel" style="color:#93c5fd;font-size:0.9rem;"></i>
                            <span style="color:#e2e8f0;font-size:0.8rem;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;">Notice to All Members — AGM</span>
                            <span style="margin-left:auto;background:#2563eb;color:#dbeafe;font-size:0.7rem;font-weight:700;padding:0.2rem 0.6rem;border-radius:4px;letter-spacing:0.04em;border:1px solid #3b82f6;">2024–25</span>
                        </div>
                        <div style="background:#fff;padding:1.5rem;">
                            <p style="color:#334155;line-height:1.8;margin-bottom:0.85rem;">All members are hereby notified about the Annual General Body Meeting. The agenda includes:</p>
                            <ul style="color:#334155;line-height:2;padding-left:1.25rem;margin-bottom:1rem;">
                                <li>Confirmation of the minutes of the last AGM</li>
                                <li>Presentation and adoption of the Annual Report and Accounts</li>
                                <li>Appointment / Re-appointment of Statutory Auditor</li>
                                <li>Declaration of dividend (if any)</li>
                                <li>Election of Board members (if due)</li>
                                <li>Any other matter with the permission of the Chair</li>
                            </ul>
                            <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:8px;padding:0.9rem 1.1rem;display:flex;gap:0.75rem;align-items:center;">
                                <i class="fas fa-download" style="color:#1e40af;flex-shrink:0;"></i>
                                <span style="font-size:0.85rem;color:#1e3a5f;">The detailed AGM notice with date, time, and venue is available in the <strong>Downloads</strong> tab.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DB Notices -->
                <?php if (!empty($notices)): ?>
                <div>
                    <div class="media-section-header">
                        <div class="icon-wrap" style="background:#eff6ff;color:#1e40af;"><i class="fas fa-bell"></i></div>
                        <div>
                            <h4>Latest Notices</h4>
                            <p>Current notices and announcements from the bank</p>
                        </div>
                    </div>
                    <div class="nboard-wrap">
                        <div class="nboard-head">
                            <i class="fas fa-clipboard-list nboard-head-icon"></i>
                            <span class="nboard-head-text">Notice Board — Shri Shantappanna Miraji Urban Co-op. Bank Ltd.</span>
                            <span class="nboard-head-badge"><?php echo count($notices); ?> Active</span>
                        </div>
                        <div class="nboard-list">
                            <?php foreach ($notices as $ni => $notice): ?>
                            <div class="nboard-card" data-bs-toggle="modal" data-bs-target="#noticeModal<?php echo $ni; ?>">
                                <div class="nboard-card-header">
                                    <span class="nboard-card-title"><?php echo htmlspecialchars($notice['title']); ?></span>
                                    <span class="nboard-card-tag">Notice</span>
                                </div>
                                <div class="nboard-card-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    <?php echo formatNoticeDate($notice['date_published']); ?>
                                </div>
                                <p class="nboard-card-preview"><?php echo htmlspecialchars(substr(strip_tags($notice['content']), 0, 160)) . '…'; ?></p>
                                <span class="nboard-card-btn"><i class="fas fa-eye"></i> Read Full Notice</span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="nboard-foot">
                            <i class="fas fa-info-circle"></i>
                            Click any notice card to read the full announcement.
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="info-note mt-3">
                    <i class="fas fa-info-circle"></i>
                    <span>No additional notices at this time. Please check back later or contact your nearest branch.</span>
                </div>
                <?php endif; ?>
            </div>

            <!-- ═══════════════════════════════════════
                 TAB 4: DOWNLOADS
            ═══════════════════════════════════════ -->
            <div class="tab-pane fade" id="downloads-tab" role="tabpanel">

                <div class="section-title text-start mb-4">
                    <span class="text-primary small text-uppercase fw-bold">Media Center</span>
                    <h2 class="text-start">Downloads</h2>
                </div>

                <!-- Annual Reports -->
                <div class="mb-5">
                    <div class="media-section-header">
                        <div class="icon-wrap" style="background:#eff6ff;color:#1e40af;"><i class="fas fa-file-alt"></i></div>
                        <div>
                            <h4>Annual General Body Meeting — Reports</h4>
                            <p>Financial year-wise annual reports and AGM documents</p>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <?php
                        $annual_reports = [
                            ['year'=>'2024-25','label'=>'Annual Report 2024-25','desc'=>'Financial Year 2024-2025'],
                            ['year'=>'2023-24','label'=>'Annual Report 2023-24','desc'=>'Financial Year 2023-2024'],
                            ['year'=>'2022-23','label'=>'Annual Report 2022-23','desc'=>'Financial Year 2022-2023'],
                            ['year'=>'2021-22','label'=>'Annual Report 2021-22','desc'=>'Financial Year 2021-2022'],
                            ['year'=>'2020-21','label'=>'Annual Report 2020-21','desc'=>'Financial Year 2020-2021'],
                            ['year'=>'2019-20','label'=>'Annual Report 2019-20','desc'=>'Financial Year 2019-2020'],
                        ];
                        foreach ($annual_reports as $ar):
                        ?>
                        <div class="download-item">
                            <div class="dl-icon pdf"><i class="fas fa-file-pdf"></i></div>
                            <div class="dl-info">
                                <h6><?php echo $ar['label']; ?></h6>
                                <small><?php echo $ar['desc']; ?></small>
                            </div>
                            <span class="dl-year-badge"><?php echo $ar['year']; ?></span>
                            <button class="btn btn-sm btn-outline-secondary" disabled style="font-size:0.78rem;padding:0.3rem 0.75rem;">
                                <i class="fas fa-clock me-1"></i>Coming Soon
                            </button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- DB Downloads -->
                <?php if (!empty($db_downloads)): ?>
                <div class="mb-5">
                    <div class="media-section-header">
                        <div class="icon-wrap" style="background:#f0fdf4;color:#059669;"><i class="fas fa-folder-open"></i></div>
                        <div>
                            <h4>Other Documents &amp; Forms</h4>
                            <p>Circulars, forms, notices and other documents uploaded by the bank</p>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <?php foreach ($db_downloads as $dl):
                            $ext = strtolower(pathinfo($dl['file_path'] ?? '', PATHINFO_EXTENSION));
                            $iconClass = ($ext === 'pdf') ? 'pdf' : (in_array($ext,['jpg','jpeg','png','gif']) ? 'doc' : 'other');
                            $iconFa = ($ext === 'pdf') ? 'fa-file-pdf' : (in_array($ext,['jpg','jpeg','png','gif']) ? 'fa-file-image' : 'fa-file-alt');
                        ?>
                        <div class="download-item">
                            <div class="dl-icon <?php echo $iconClass; ?>"><i class="fas <?php echo $iconFa; ?>"></i></div>
                            <div class="dl-info">
                                <h6><?php echo htmlspecialchars($dl['title']); ?></h6>
                                <?php if (!empty($dl['description'])): ?>
                                <small><?php echo htmlspecialchars($dl['description']); ?></small>
                                <?php endif; ?>
                            </div>
                            <a href="<?php echo rtrim(SITE_URL, '/'); ?>/<?php echo ltrim($dl['file_path'], '/'); ?>"
                               class="btn btn-sm btn-primary"
                               target="_blank"
                               download
                               style="font-size:0.78rem;padding:0.3rem 0.75rem;white-space:nowrap;">
                                <i class="fas fa-download me-1"></i>Download
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="info-note">
                    <i class="fas fa-envelope"></i>
                    <span>Need a specific form or document not listed here? Please visit your nearest branch or contact us at <strong>shantappanna@mirajibank.com</strong>.</span>
                </div>
            </div>

            <!-- ═══════════════════════════════════════
                 TAB 5: GALLERY
            ═══════════════════════════════════════ -->
            <div class="tab-pane fade" id="gallery-tab" role="tabpanel">

                <div class="section-title text-start mb-4">
                    <span class="text-primary small text-uppercase fw-bold">Media Center</span>
                    <h2 class="text-start">Photo Gallery</h2>
                </div>

                <?php if (!empty($gallery_images)): ?>
                <div class="row g-3">
                    <?php foreach ($gallery_images as $gi => $img): ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="gallery-wrap">
                            <div class="gallery-item" data-bs-toggle="modal" data-bs-target="#galleryModal<?php echo $gi; ?>">
                                <img src="<?php echo SITE_URL; ?>uploads/gallery/<?php echo basename($img['image_path']); ?>"
                                     alt="<?php echo htmlspecialchars($img['title'] ?? 'Gallery'); ?>"
                                     loading="lazy"
                                     onerror="this.src='/assets/images/placeholder.jpg'">
                                <div class="gallery-overlay"><i class="fas fa-expand-alt"></i></div>
                            </div>
                            <?php if (!empty($img['title'])): ?>
                            <div class="gallery-caption"><i class="fas fa-image me-1" style="font-size:0.7rem;color:#94a3b8;"></i><?php echo htmlspecialchars($img['title']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal fade" id="galleryModal<?php echo $gi; ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content" style="background:#0f172a;border:none;">
                                <div class="modal-header" style="border:none;padding:0.75rem 1rem;">
                                    <h6 class="modal-title text-white"><?php echo htmlspecialchars($img['title'] ?? 'Photo Gallery'); ?></h6>
                                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body p-0 text-center">
                                    <img src="<?php echo SITE_URL; ?>uploads/gallery/<?php echo basename($img['image_path']); ?>"
                                         style="max-height:80vh;max-width:100%;object-fit:contain;"
                                         alt="<?php echo htmlspecialchars($img['title'] ?? 'Gallery'); ?>"
                                         onerror="this.src='/assets/images/placeholder.jpg'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="text-center py-5" style="color:#94a3b8;">
                    <i class="fas fa-images fa-4x mb-4" style="opacity:0.3;"></i>
                    <h5 style="color:#64748b;">No Photos Available Yet</h5>
                    <p style="font-size:0.9rem;">Gallery photos will be published soon. Please check back later.</p>
                </div>
                <?php endif; ?>
            </div>

        </div><!-- end tab-content -->
    </div>

    <script>
    // Fix sticky tab nav top position relative to actual navbar height
    (function() {
        function fixTabNavTop() {
            var navbar = document.querySelector('.navbar');
            var tabNav = document.getElementById('mediaTabNav');
            if (navbar && tabNav) tabNav.style.top = navbar.offsetHeight + 'px';
        }
        window.addEventListener('load', fixTabNavTop);
        window.addEventListener('resize', fixTabNavTop);
        if (document.readyState !== 'loading') fixTabNavTop();
        else document.addEventListener('DOMContentLoaded', fixTabNavTop);
    })();
    </script>
<?php include __DIR__ . '/../includes/footer.php'; ?>