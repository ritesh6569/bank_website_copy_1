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
$notices = getActiveNotices();

$gallery_images = [];
$db_downloads   = [];
$deposit_rates_db = [];
$loan_rates_grouped = [];

require_once __DIR__ . '/../includes/db.php';
$pdo = getDBConnection();

try {
    $stmt = $pdo->query("SELECT * FROM gallery WHERE status='active' ORDER BY display_order ASC, created_at DESC LIMIT 24");
    $gallery_images = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) { error_log('gallery query: ' . $e->getMessage()); }

try {
    $stmt = $pdo->query("SELECT * FROM downloads WHERE status='active' ORDER BY created_at DESC");
    $db_downloads = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) { error_log('downloads query: ' . $e->getMessage()); }

try {
    $stmt = $pdo->query("SELECT * FROM deposit_rates WHERE status='active' ORDER BY display_order, id");
    $deposit_rates_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) { error_log('deposit_rates query: ' . $e->getMessage()); }

try {
    $stmt = $pdo->query("SELECT * FROM loan_rates WHERE status='active' ORDER BY display_order, id");
    $loan_rates_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($loan_rates_db as $row) {
        $loan_rates_grouped[$row['category']][] = $row;
    }
} catch (Exception $e) { error_log('loan_rates query: ' . $e->getMessage()); }

$charge_sections = [
    'Membership'  => [
        ['Admission Fee (Individual)',       '&#8377; 500/-'],
        ['Admission Fee (Firm/Institution)', '&#8377; 1,000/-'],
        ['Share Capital (Minimum)',          '&#8377; 500/-'],
    ],
    'Deposits' => [
        ['Account Opening (Savings)',        'Free'],
        ['Account Opening (Current)',        '&#8377; 200/-'],
        ['Minimum Balance (Savings)',        '&#8377; 500/-'],
        ['Minimum Balance (Current)',        '&#8377; 2,000/-'],
        ['Cheque Return (Inward)',           '&#8377; 200/- per cheque'],
        ['Cheque Return (Outward)',          '&#8377; 100/- per cheque'],
        ['Passbook Replacement',             '&#8377; 50/-'],
        ['Duplicate Statement',             '&#8377; 100/- per quarter'],
        ['SMS Alerts (Monthly)',             '&#8377; 10/- per month'],
    ],
    'Loans' => [
        ['Loan Processing Fee',              '1% of loan amount (min &#8377; 500/-)'],
        ['Prepayment Charges (Term Loan)',   '2% on prepaid amount'],
        ['Prepayment Charges (OD/CC)',       'Nil'],
        ['Duplicate NOC',                    '&#8377; 100/-'],
        ['Mortgage Creation Charges',        'At actuals'],
        ['Legal Opinion Charges',            'At actuals'],
        ['Valuation Charges',               'At actuals'],
    ],
    'Cheque / Passbook' => [
        ['Cheque Book (25 leaves)',          '&#8377; 50/-'],
        ['Cheque Book (50 leaves)',          '&#8377; 80/-'],
        ['Cheque Book (100 leaves)',         '&#8377; 150/-'],
        ['Cancelled Cheque',                 '&#8377; 20/- per leaf'],
        ['Stop Payment Instructions',        '&#8377; 50/- per instrument'],
    ],
    'Other Charges' => [
        ['RTGS (Rs. 2 Lakh - Rs. 5 Lakh)',  '&#8377; 25/- per transaction'],
        ['RTGS (Above Rs. 5 Lakh)',          '&#8377; 50/- per transaction'],
        ['NEFT',                             'Free (as per RBI guidelines)'],
        ['DD / Pay Order Issuance',          '&#8377; 50/- per instrument'],
        ['Locker Rent (Small)',              '&#8377; 1,000/- per annum'],
        ['Locker Rent (Medium)',             '&#8377; 1,500/- per annum'],
        ['Locker Rent (Large)',              '&#8377; 2,000/- per annum'],
        ['ATM Transactions (Own ATM)',       'Free'],
        ['ATM Transactions (Other Bank)',    '5 free/month, &#8377; 20/- thereafter'],
    ],
];
?>

<!-- ===== HERO ===== -->
<section style="background:linear-gradient(150deg,#0D3D2E 0%,#1A5C42 60%,#2E8B63 100%);padding:4rem 0 3rem;position:relative;overflow:hidden;">
  <div style="position:absolute;inset:0;opacity:0.04;background:radial-gradient(circle at 80% 20%,#fff 0%,transparent 50%),radial-gradient(circle at 10% 80%,#fff 0%,transparent 40%);"></div>
  <div class="container position-relative">
    <div style="max-width:700px;margin:0 auto;text-align:center;">
      <span style="display:inline-block;background:rgba(184,115,51,0.25);color:#CC8A4A;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:0.3rem 1rem;border-radius:20px;border:1px solid rgba(184,115,51,0.4);margin-bottom:1rem;">Information &amp; Media</span>
      <h1 style="font-size:clamp(1.9rem,4vw,2.8rem);font-weight:800;color:#fff;margin-bottom:1rem;line-height:1.2;">Media <span style="color:#CC8A4A;">Center</span></h1>
      <p style="color:rgba(255,255,255,0.82);font-size:1rem;margin-bottom:2rem;">Stay informed with the latest interest rates, service charges, official notices, downloadable documents and our photo gallery.</p>
      <div style="display:flex;flex-wrap:wrap;gap:0.6rem;justify-content:center;">
        <a href="#rates"         style="background:rgba(255,255,255,0.12);color:#fff;border:1px solid rgba(255,255,255,0.3);padding:0.45rem 1.1rem;border-radius:25px;font-size:0.82rem;font-weight:600;text-decoration:none;" onmouseover="this.style.background='rgba(255,255,255,0.22)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'"><i class="fas fa-percentage me-1"></i>Interest Rates</a>
        <a href="#charges"       style="background:rgba(255,255,255,0.12);color:#fff;border:1px solid rgba(255,255,255,0.3);padding:0.45rem 1.1rem;border-radius:25px;font-size:0.82rem;font-weight:600;text-decoration:none;" onmouseover="this.style.background='rgba(255,255,255,0.22)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'"><i class="fas fa-receipt me-1"></i>Service Charges</a>
        <a href="#notices-tab"   style="background:rgba(255,255,255,0.12);color:#fff;border:1px solid rgba(255,255,255,0.3);padding:0.45rem 1.1rem;border-radius:25px;font-size:0.82rem;font-weight:600;text-decoration:none;" onmouseover="this.style.background='rgba(255,255,255,0.22)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'"><i class="fas fa-bell me-1"></i>Notices</a>
        <a href="#downloads-tab" style="background:rgba(255,255,255,0.12);color:#fff;border:1px solid rgba(255,255,255,0.3);padding:0.45rem 1.1rem;border-radius:25px;font-size:0.82rem;font-weight:600;text-decoration:none;" onmouseover="this.style.background='rgba(255,255,255,0.22)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'"><i class="fas fa-download me-1"></i>Downloads</a>
        <a href="#gallery-tab"   style="background:rgba(255,255,255,0.12);color:#fff;border:1px solid rgba(255,255,255,0.3);padding:0.45rem 1.1rem;border-radius:25px;font-size:0.82rem;font-weight:600;text-decoration:none;" onmouseover="this.style.background='rgba(255,255,255,0.22)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'"><i class="fas fa-images me-1"></i>Gallery</a>
      </div>
    </div>
  </div>
</section>

<!-- ===== STICKY TAB NAV ===== -->
<div id="media-tab-nav" style="background:#fff;border-bottom:2px solid #D6E4DA;position:sticky;top:70px;z-index:100;box-shadow:0 2px 8px rgba(13,61,46,0.06);">
  <div class="container">
    <div style="display:flex;gap:0;overflow-x:auto;scrollbar-width:none;">
      <a href="#rates"         class="media-tab-btn active" data-tab="rates"         style="flex:none;padding:1rem 1.25rem;font-size:0.85rem;font-weight:600;color:#3D5A47;text-decoration:none;border-bottom:3px solid transparent;white-space:nowrap;transition:all 0.2s;"><i class="fas fa-percentage me-1"></i>Interest Rates</a>
      <a href="#charges"       class="media-tab-btn"        data-tab="charges"       style="flex:none;padding:1rem 1.25rem;font-size:0.85rem;font-weight:600;color:#3D5A47;text-decoration:none;border-bottom:3px solid transparent;white-space:nowrap;transition:all 0.2s;"><i class="fas fa-receipt me-1"></i>Service Charges</a>
      <a href="#notices-tab"   class="media-tab-btn"        data-tab="notices-tab"   style="flex:none;padding:1rem 1.25rem;font-size:0.85rem;font-weight:600;color:#3D5A47;text-decoration:none;border-bottom:3px solid transparent;white-space:nowrap;transition:all 0.2s;"><i class="fas fa-bell me-1"></i>Notices</a>
      <a href="#downloads-tab" class="media-tab-btn"        data-tab="downloads-tab" style="flex:none;padding:1rem 1.25rem;font-size:0.85rem;font-weight:600;color:#3D5A47;text-decoration:none;border-bottom:3px solid transparent;white-space:nowrap;transition:all 0.2s;"><i class="fas fa-download me-1"></i>Downloads</a>
      <a href="#gallery-tab"   class="media-tab-btn"        data-tab="gallery-tab"   style="flex:none;padding:1rem 1.25rem;font-size:0.85rem;font-weight:600;color:#3D5A47;text-decoration:none;border-bottom:3px solid transparent;white-space:nowrap;transition:all 0.2s;"><i class="fas fa-images me-1"></i>Gallery</a>
    </div>
  </div>
</div>

<style>
.media-tab-btn:hover  { color:#0D3D2E !important; background:#F5F8F5; }
.media-tab-btn.active { color:#0D3D2E !important; border-bottom-color:#0D3D2E !important; font-weight:700 !important; }
.bank-table { width:100%; border-collapse:collapse; font-size:0.875rem; }
.bank-table thead th { background:#0D3D2E; color:#fff; padding:0.75rem 1rem; text-align:left; font-weight:600; font-size:0.8rem; letter-spacing:0.03em; }
.bank-table tbody tr { border-bottom:1px solid #D6E4DA; transition:background 0.15s; }
.bank-table tbody tr:hover { background:#EBF2ED; }
.bank-table tbody td { padding:0.7rem 1rem; color:#1C2B22; }
.bank-table .category-row td { background:#EBF2ED; font-weight:700; color:#0D3D2E; font-size:0.82rem; letter-spacing:0.04em; text-transform:uppercase; }
.bank-table .rate-cell { font-weight:700; color:#0D3D2E; }
.nboard-wrap { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:1.25rem; }
.nboard-card { background:#fff; border:1px solid #D6E4DA; border-radius:12px; overflow:hidden; box-shadow:0 2px 8px rgba(13,61,46,0.05); transition:transform 0.2s,box-shadow 0.2s; }
.nboard-card:hover { transform:translateY(-3px); box-shadow:0 6px 20px rgba(13,61,46,0.1); }
.nboard-card-header { background:#0D3D2E; color:#fff; padding:0.85rem 1.1rem; font-size:0.78rem; font-weight:700; letter-spacing:0.05em; text-transform:uppercase; }
.nboard-card-body { padding:1rem 1.1rem; }
.nboard-badge { display:inline-block; background:#EBF2ED; color:#0D3D2E; font-size:0.7rem; font-weight:600; padding:0.2rem 0.6rem; border-radius:20px; margin-bottom:0.5rem; }
.nboard-title { font-size:0.92rem; font-weight:700; color:#1C2B22; margin:0 0 0.4rem; }
.nboard-desc { font-size:0.8rem; color:#3D5A47; margin:0 0 0.75rem; }
.nboard-footer { display:flex; justify-content:space-between; align-items:center; padding:0.6rem 1.1rem; border-top:1px solid #D6E4DA; background:#F5F8F5; font-size:0.75rem; color:#7A9485; }
.download-item { display:flex; align-items:center; gap:1rem; padding:0.9rem 1rem; background:#fff; border:1px solid #D6E4DA; border-radius:10px; transition:all 0.2s; }
.download-item:hover { background:#EBF2ED; border-color:#7CB9A0; }
.download-icon { width:42px; height:42px; background:#EBF2ED; border-radius:8px; display:flex; align-items:center; justify-content:center; color:#0D3D2E; font-size:1.1rem; flex-shrink:0; }
.download-info { flex:1; min-width:0; }
.download-info strong { display:block; font-size:0.9rem; color:#1C2B22; font-weight:600; }
.download-info span { font-size:0.78rem; color:#7A9485; }
.gallery-wrap { display:grid; grid-template-columns:repeat(auto-fill,minmax(200px,1fr)); gap:1rem; }
.gallery-item { position:relative; border-radius:10px; overflow:hidden; aspect-ratio:4/3; cursor:pointer; }
.gallery-item img { width:100%; height:100%; object-fit:cover; transition:transform 0.35s; }
.gallery-item:hover img { transform:scale(1.07); }
.gallery-item-overlay { position:absolute; inset:0; background:rgba(13,61,46,0); display:flex; align-items:center; justify-content:center; transition:background 0.3s; }
.gallery-item:hover .gallery-item-overlay { background:rgba(13,61,46,0.45); }
.gallery-item-overlay i { color:#fff; font-size:1.6rem; opacity:0; transform:scale(0.7); transition:all 0.3s; }
.gallery-item:hover .gallery-item-overlay i { opacity:1; transform:scale(1); }
.info-note { display:flex; gap:0.75rem; align-items:flex-start; background:#EBF2ED; border-left:4px solid #0D3D2E; border-radius:0 10px 10px 0; padding:1rem 1.25rem; font-size:0.85rem; color:#1C2B22; }
.info-note i { color:#0D3D2E; margin-top:0.1rem; flex-shrink:0; }
.notice-card { border:1px solid #D6E4DA; border-radius:12px; overflow:hidden; margin-bottom:1.5rem; }
.notice-card-header { background:#0D3D2E; color:#fff; padding:1rem 1.25rem; }
.notice-card-header h5 { margin:0; font-size:1rem; font-weight:700; }
.notice-card-header p  { margin:0.25rem 0 0; font-size:0.8rem; opacity:0.8; }
.notice-card-body { padding:1.25rem; background:#fff; }
</style>

<!-- ============================= TAB 1 — INTEREST RATES ============================= -->
<section id="rates" style="background:#F5F8F5;padding:3.5rem 0;">
  <div class="container">
    <div style="margin-bottom:2rem;">
      <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.5rem;">Media Center</span>
      <h2 style="font-size:1.75rem;font-weight:800;color:#1C2B22;margin:0;">Interest Rates</h2>
    </div>

    <!-- Deposit Rates -->
    <div style="background:#fff;border-radius:14px;border:1px solid #D6E4DA;overflow:hidden;margin-bottom:2.5rem;box-shadow:0 2px 10px rgba(13,61,46,0.05);">
      <div style="background:#0D3D2E;padding:1rem 1.5rem;">
        <h5 style="color:#fff;margin:0;font-weight:700;font-size:1rem;"><i class="fas fa-piggy-bank me-2" style="color:#CC8A4A;"></i>Deposit Interest Rates</h5>
        <p style="color:rgba(255,255,255,0.7);font-size:0.78rem;margin:0.2rem 0 0;">Rates effective as per latest RBI guidelines</p>
      </div>
      <div style="padding:0;">
        <?php if (!empty($deposit_rates_db)): ?>
        <table class="bank-table">
          <thead><tr><th>#</th><th>Scheme / Period</th><th>Rate of Interest (p.a.)</th><th>Senior Citizen (p.a.)</th></tr></thead>
          <tbody>
          <?php $sr = 0; $last_type = ''; foreach ($deposit_rates_db as $r): ?>
            <?php if (!empty($r['deposit_type']) && $r['deposit_type'] !== $last_type): $last_type = $r['deposit_type']; ?>
            <tr class="category-row"><td colspan="4"><i class="fas fa-layer-group me-2"></i><?= htmlspecialchars($r['deposit_type']) ?></td></tr>
            <?php endif; $sr++; ?>
            <tr>
              <td><?= $sr ?></td>
              <td><?= htmlspecialchars($r['period'] ?? '') ?></td>
              <td class="rate-cell"><?= htmlspecialchars($r['general_rate'] ?? '') ?></td>
              <td class="rate-cell"><?= htmlspecialchars($r['senior_rate'] ?? '') ?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
        <?php else: ?>
        <div style="padding:2rem;text-align:center;color:#7A9485;">
          <i class="fas fa-info-circle fa-2x mb-2" style="color:#D6E4DA;display:block;"></i>
          <p style="margin:0;font-size:0.9rem;">Deposit rates will be updated shortly. Please contact your nearest branch.</p>
        </div>
        <?php endif; ?>
      </div>
      <div style="padding:0.75rem 1.25rem;background:#F5F8F5;border-top:1px solid #D6E4DA;">
        <div class="info-note"><i class="fas fa-info-circle"></i><span>Rates are subject to change without prior notice. Senior citizen rate is 0.50% additional on standard rate. TDS applicable as per Income Tax Act.</span></div>
      </div>
    </div>

    <!-- Loan Rates -->
    <div style="background:#fff;border-radius:14px;border:1px solid #D6E4DA;overflow:hidden;box-shadow:0 2px 10px rgba(13,61,46,0.05);">
      <div style="background:#0D3D2E;padding:1rem 1.5rem;">
        <h5 style="color:#fff;margin:0;font-weight:700;font-size:1rem;"><i class="fas fa-hand-holding-usd me-2" style="color:#CC8A4A;"></i>Loan Interest Rates</h5>
        <p style="color:rgba(255,255,255,0.7);font-size:0.78rem;margin:0.2rem 0 0;">Competitive rates for all loan products</p>
      </div>
      <div style="padding:0;">
        <?php if (!empty($loan_rates_grouped)): ?>
        <table class="bank-table">
          <thead><tr><th>#</th><th>Loan Type</th><th>Interest Rate (p.a.)</th></tr></thead>
          <tbody>
          <?php $sr = 0; foreach ($loan_rates_grouped as $cat => $rows): ?>
            <tr class="category-row"><td colspan="3"><i class="fas fa-tag me-2"></i><?= htmlspecialchars($cat) ?></td></tr>
            <?php foreach ($rows as $r): $sr++; ?>
            <tr>
              <td><?= $sr ?></td>
              <td><?= htmlspecialchars($r['loan_type'] ?? '') ?></td>
              <td class="rate-cell"><?= htmlspecialchars($r['interest_rate'] ?? '') ?></td>
            </tr>
            <?php endforeach; ?>
          <?php endforeach; ?>
          </tbody>
        </table>
        <?php else: ?>
        <div style="padding:2rem;text-align:center;color:#7A9485;">
          <i class="fas fa-info-circle fa-2x mb-2" style="color:#D6E4DA;display:block;"></i>
          <p style="margin:0;font-size:0.9rem;">Loan rate details will be updated soon. Contact us for the latest rates.</p>
        </div>
        <?php endif; ?>
      </div>
      <div style="padding:0.75rem 1.25rem;background:#F5F8F5;border-top:1px solid #D6E4DA;">
        <div class="info-note"><i class="fas fa-info-circle"></i><span>Loan rates are subject to credit appraisal and may vary. Processing fee and documentation charges are applicable. Rate of interest may change as per RBI guidelines.</span></div>
      </div>
    </div>
  </div>
</section>

<!-- ============================= TAB 2 — SERVICE CHARGES ============================= -->
<section id="charges" style="background:#fff;padding:3.5rem 0;">
  <div class="container">
    <div style="margin-bottom:2rem;">
      <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.5rem;">Media Center</span>
      <h2 style="font-size:1.75rem;font-weight:800;color:#1C2B22;margin:0;">Service Charges</h2>
    </div>
    <div class="info-note mb-4"><i class="fas fa-info-circle"></i><span>All charges are inclusive of applicable taxes. Charges are subject to revision. Please verify with your branch before transactions.</span></div>
    <?php foreach ($charge_sections as $section_name => $rows): ?>
    <div style="background:#F5F8F5;border-radius:14px;border:1px solid #D6E4DA;overflow:hidden;margin-bottom:2rem;box-shadow:0 2px 8px rgba(13,61,46,0.04);">
      <div style="background:#1A5C42;padding:0.85rem 1.25rem;">
        <h5 style="color:#fff;margin:0;font-weight:700;font-size:0.95rem;"><i class="fas fa-circle-dot me-2" style="color:#CC8A4A;font-size:0.65rem;"></i><?= htmlspecialchars($section_name) ?></h5>
      </div>
      <div style="padding:0;">
        <table class="bank-table">
          <thead><tr><th style="width:50px;">#</th><th>Particulars</th><th>Charges</th></tr></thead>
          <tbody>
          <?php foreach ($rows as $i => $row): ?>
            <tr><td><?= $i + 1 ?></td><td><?= htmlspecialchars($row[0]) ?></td><td class="rate-cell"><?= $row[1] ?></td></tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- ============================= TAB 3 — NOTICES ============================= -->
<section id="notices-tab" style="background:#F5F8F5;padding:3.5rem 0;">
  <div class="container">
    <div style="margin-bottom:2rem;">
      <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.5rem;">Official Communication</span>
      <h2 style="font-size:1.75rem;font-weight:800;color:#1C2B22;margin:0;">Notices &amp; Announcements</h2>
    </div>

    <!-- Statutory Auditor Notice -->
    <div class="notice-card">
      <div class="notice-card-header">
        <h5><i class="fas fa-gavel me-2"></i>Appointment of Statutory Auditor</h5>
        <p>Official Notice &mdash; Published as per statutory requirements</p>
      </div>
      <div class="notice-card-body">
        <p style="font-size:0.9rem;color:#3D5A47;margin-bottom:0.75rem;">The Board of Directors of <strong>Shri Shantappanna Miraji Urban Co-operative Bank Ltd.</strong> hereby informs all members that the appointment of Statutory Auditors for the financial year has been duly completed in accordance with the provisions of the Karnataka Co-operative Societies Act.</p>
        <ul style="font-size:0.88rem;color:#3D5A47;padding-left:1.25rem;margin-bottom:0;">
          <li>Appointment made as per Section 63 of the KCS Act, 1959</li>
          <li>Audit report to be presented at the Annual General Meeting</li>
          <li>Members may inspect audit-related documents at the Head Office</li>
        </ul>
      </div>
    </div>

    <!-- AGM Notice -->
    <div class="notice-card">
      <div class="notice-card-header">
        <h5><i class="fas fa-users me-2"></i>Annual General Meeting (AGM) Notice</h5>
        <p>All members are cordially invited to attend the AGM</p>
      </div>
      <div class="notice-card-body">
        <p style="font-size:0.9rem;color:#3D5A47;margin-bottom:0.75rem;">Notice is hereby given that the Annual General Meeting of <strong>Shri Shantappanna Miraji Urban Co-operative Bank Ltd.</strong> will be held as per schedule. Members are requested to attend and participate in the proceedings.</p>
        <p style="font-size:0.88rem;font-weight:700;color:#0D3D2E;margin-bottom:0.5rem;">Agenda includes:</p>
        <ol style="font-size:0.88rem;color:#3D5A47;padding-left:1.25rem;margin-bottom:0;">
          <li>Confirmation of Minutes of previous AGM</li>
          <li>Adoption of Annual Report &amp; Audited Accounts</li>
          <li>Approval of Dividend for the financial year</li>
          <li>Election of Board of Directors (if due)</li>
          <li>Appointment of Statutory Auditors</li>
          <li>Any other item with permission of the chair</li>
        </ol>
      </div>
    </div>

    <!-- DB Notices -->
    <?php if (!empty($notices)): ?>
    <h5 style="font-size:1rem;font-weight:700;color:#0D3D2E;margin-bottom:1.25rem;"><i class="fas fa-bullhorn me-2" style="color:#B87333;"></i>Latest Notices</h5>
    <div class="nboard-wrap">
      <?php foreach ($notices as $n): ?>
      <div class="nboard-card">
        <div class="nboard-card-header"><?= htmlspecialchars($n['type'] ?? 'Official Notice') ?></div>
        <div class="nboard-card-body">
          <span class="nboard-badge"><?= date('d M Y', strtotime($n['created_at'] ?? 'now')) ?></span>
          <h6 class="nboard-title"><?= htmlspecialchars($n['title'] ?? '') ?></h6>
          <p class="nboard-desc"><?= htmlspecialchars(substr($n['description'] ?? '', 0, 100)) ?><?= strlen($n['description'] ?? '') > 100 ? '&hellip;' : '' ?></p>
          <button onclick="document.getElementById('nModal<?= $n['id'] ?>').style.display='flex'" style="background:#0D3D2E;color:#fff;font-size:0.78rem;border:none;border-radius:6px;padding:0.3rem 0.8rem;cursor:pointer;">Read More</button>
        </div>
        <div class="nboard-footer">
          <?php if (!empty($n['valid_till'])): ?><span><i class="fas fa-clock me-1"></i>Valid till <?= date('d M Y', strtotime($n['valid_till'])) ?></span><?php else: ?><span></span><?php endif; ?>
          <span><?= htmlspecialchars($n['category'] ?? '') ?></span>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div style="text-align:center;padding:2.5rem;background:#fff;border-radius:12px;border:1px solid #D6E4DA;">
      <i class="fas fa-bell-slash fa-2x mb-2" style="color:#D6E4DA;display:block;"></i>
      <p style="color:#7A9485;margin:0;font-size:0.9rem;">No active notices at this time. Check back soon.</p>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- ============================= TAB 4 — DOWNLOADS ============================= -->
<section id="downloads-tab" style="background:#fff;padding:3.5rem 0;">
  <div class="container">
    <div style="margin-bottom:2rem;">
      <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.5rem;">Official Documents</span>
      <h2 style="font-size:1.75rem;font-weight:800;color:#1C2B22;margin:0;">Downloads</h2>
    </div>

    <!-- Annual Reports -->
    <div style="margin-bottom:2.5rem;">
      <h5 style="font-size:1rem;font-weight:700;color:#0D3D2E;margin-bottom:1.25rem;padding-bottom:0.5rem;border-bottom:2px solid #EBF2ED;"><i class="fas fa-book me-2" style="color:#B87333;"></i>Annual Reports</h5>
      <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:0.75rem;">
        <?php
        $annual_reports = [
            ['2024-25','Annual Report 2024-25','Coming Soon'],
            ['2023-24','Annual Report 2023-24','Available'],
            ['2022-23','Annual Report 2022-23','Available'],
            ['2021-22','Annual Report 2021-22','Available'],
            ['2020-21','Annual Report 2020-21','Available'],
            ['2019-20','Annual Report 2019-20','Available'],
        ];
        foreach ($annual_reports as $rpt): ?>
        <div class="download-item">
          <div class="download-icon"><i class="fas fa-file-pdf"></i></div>
          <div class="download-info">
            <strong><?= $rpt[1] ?></strong>
            <span>Financial Year <?= $rpt[0] ?></span>
          </div>
          <?php if ($rpt[2] === 'Available'): ?>
          <button style="font-size:0.78rem;padding:0.3rem 0.75rem;background:#0D3D2E;color:#fff;border:none;border-radius:6px;cursor:pointer;white-space:nowrap;" onclick="alert('Please contact the branch to obtain a copy of this report.')"><i class="fas fa-download me-1"></i>Download</button>
          <?php else: ?>
          <button style="font-size:0.78rem;padding:0.3rem 0.75rem;background:#F5F8F5;color:#7A9485;border:1px solid #D6E4DA;border-radius:6px;cursor:default;" disabled>Coming Soon</button>
          <?php endif; ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- DB Downloads -->
    <?php if (!empty($db_downloads)): ?>
    <div>
      <h5 style="font-size:1rem;font-weight:700;color:#0D3D2E;margin-bottom:1.25rem;padding-bottom:0.5rem;border-bottom:2px solid #EBF2ED;"><i class="fas fa-folder-open me-2" style="color:#B87333;"></i>Other Documents</h5>
      <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:0.75rem;">
        <?php foreach ($db_downloads as $dl): ?>
        <div class="download-item">
          <div class="download-icon"><i class="fas fa-file-alt"></i></div>
          <div class="download-info">
            <strong><?= htmlspecialchars($dl['title'] ?? 'Document') ?></strong>
            <span><?= htmlspecialchars($dl['description'] ?? '') ?></span>
          </div>
          <?php if (!empty($dl['file_path'])): ?>
          <a href="<?= SITE_URL ?>uploads/downloads/<?= htmlspecialchars($dl['file_path']) ?>" target="_blank" style="font-size:0.78rem;padding:0.3rem 0.75rem;background:#0D3D2E;color:#fff;border:none;border-radius:6px;text-decoration:none;white-space:nowrap;"><i class="fas fa-download me-1"></i>Download</a>
          <?php endif; ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- ============================= TAB 5 — GALLERY ============================= -->
<section id="gallery-tab" style="background:#F5F8F5;padding:3.5rem 0;">
  <div class="container">
    <div style="margin-bottom:2rem;">
      <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.5rem;">Photo Gallery</span>
      <h2 style="font-size:1.75rem;font-weight:800;color:#1C2B22;margin:0;">Gallery</h2>
    </div>
    <?php if (!empty($gallery_images)): ?>
    <div class="gallery-wrap">
      <?php foreach ($gallery_images as $img): ?>
      <div class="gallery-item" data-bs-toggle="modal" data-bs-target="#gModal<?= $img['id'] ?>">
        <img src="<?= SITE_URL ?>uploads/gallery/<?= htmlspecialchars($img['image_path'] ?? '') ?>" alt="<?= htmlspecialchars($img['title'] ?? 'Gallery') ?>" loading="lazy">
        <div class="gallery-item-overlay"><i class="fas fa-expand-alt"></i></div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div style="text-align:center;padding:3rem;background:#fff;border-radius:12px;border:1px solid #D6E4DA;">
      <i class="fas fa-images fa-3x mb-3" style="color:#D6E4DA;display:block;"></i>
      <h6 style="color:#3D5A47;font-weight:600;margin-bottom:0.5rem;">Gallery Coming Soon</h6>
      <p style="color:#7A9485;margin:0;font-size:0.88rem;">Photos will be added shortly. Check back soon!</p>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- ===== CTA ===== -->
<section style="background:linear-gradient(135deg,#0D3D2E 0%,#1A5C42 100%);padding:3rem 0;text-align:center;">
  <div class="container">
    <h3 style="color:#fff;font-weight:800;font-size:1.5rem;margin-bottom:0.5rem;">Need More Information?</h3>
    <p style="color:rgba(255,255,255,0.8);font-size:0.95rem;margin-bottom:1.5rem;">Our team is always ready to assist you with any queries.</p>
    <div style="display:flex;flex-wrap:wrap;gap:0.75rem;justify-content:center;">
      <a href="<?= SITE_URL ?>pages/contact.php"  style="background:#B87333;color:#fff;padding:0.6rem 1.5rem;border-radius:8px;font-weight:700;text-decoration:none;font-size:0.9rem;">Contact Us</a>
      <a href="<?= SITE_URL ?>pages/deposits.php" style="background:rgba(255,255,255,0.12);color:#fff;padding:0.6rem 1.5rem;border-radius:8px;font-weight:700;text-decoration:none;font-size:0.9rem;border:1px solid rgba(255,255,255,0.3);">Deposit Rates</a>
      <a href="<?= SITE_URL ?>pages/loans.php"    style="background:rgba(255,255,255,0.12);color:#fff;padding:0.6rem 1.5rem;border-radius:8px;font-weight:700;text-decoration:none;font-size:0.9rem;border:1px solid rgba(255,255,255,0.3);">Loan Products</a>
    </div>
  </div>
</section>

<!-- ===== NOTICE MODALS ===== -->
<?php foreach ($notices as $n): ?>
<div id="nModal<?= $n['id'] ?>" style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.55);align-items:center;justify-content:center;" onclick="if(event.target===this)this.style.display='none'">
  <div style="background:#fff;border-radius:14px;max-width:540px;width:92%;max-height:80vh;overflow-y:auto;box-shadow:0 20px 60px rgba(0,0,0,0.25);">
    <div style="background:#0D3D2E;color:#fff;padding:1.1rem 1.4rem;border-radius:14px 14px 0 0;display:flex;justify-content:space-between;align-items:center;">
      <h6 style="margin:0;font-weight:700;font-size:0.95rem;"><?= htmlspecialchars($n['title'] ?? '') ?></h6>
      <button onclick="document.getElementById('nModal<?= $n['id'] ?>').style.display='none'" style="background:none;border:none;color:#fff;font-size:1.2rem;cursor:pointer;line-height:1;">&times;</button>
    </div>
    <div style="padding:1.4rem;">
      <?php if (!empty($n['type'])): ?><span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.72rem;font-weight:600;padding:0.2rem 0.6rem;border-radius:20px;margin-bottom:0.75rem;"><?= htmlspecialchars($n['type']) ?></span><?php endif; ?>
      <p style="font-size:0.88rem;color:#1C2B22;line-height:1.7;margin-bottom:0.75rem;"><?= nl2br(htmlspecialchars($n['description'] ?? '')) ?></p>
      <?php if (!empty($n['valid_till'])): ?><p style="font-size:0.78rem;color:#7A9485;margin:0;"><i class="fas fa-clock me-1"></i>Valid till <?= date('d M Y', strtotime($n['valid_till'])) ?></p><?php endif; ?>
    </div>
  </div>
</div>
<?php endforeach; ?>

<!-- ===== GALLERY LIGHTBOX MODALS ===== -->
<?php foreach ($gallery_images as $img): ?>
<div class="modal fade" id="gModal<?= $img['id'] ?>" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="background:#0D3D2E;border:none;border-radius:14px;overflow:hidden;">
      <div class="modal-header" style="background:#0D3D2E;border:none;padding:0.8rem 1.2rem;">
        <h6 class="modal-title" style="color:#fff;font-size:0.9rem;font-weight:600;"><?= htmlspecialchars($img['title'] ?? '') ?></h6>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" style="padding:0;background:#000;">
        <img src="<?= SITE_URL ?>uploads/gallery/<?= htmlspecialchars($img['image_path'] ?? '') ?>" class="img-fluid w-100" alt="<?= htmlspecialchars($img['title'] ?? 'Gallery') ?>" style="max-height:70vh;object-fit:contain;">
      </div>
      <?php if (!empty($img['description'])): ?>
      <div class="modal-footer" style="background:#1A5C42;border:none;padding:0.6rem 1.2rem;">
        <p style="color:rgba(255,255,255,0.8);font-size:0.82rem;margin:0;"><?= htmlspecialchars($img['description']) ?></p>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endforeach; ?>

<script>
(function() {
    function fixTabNavTop() {
        var navbar = document.querySelector('nav.navbar, header nav, .navbar');
        var tabNav = document.getElementById('media-tab-nav');
        if (tabNav) tabNav.style.top = navbar ? navbar.offsetHeight + 'px' : '70px';
    }
    fixTabNavTop();
    window.addEventListener('resize', fixTabNavTop);

    var sections = ['rates','charges','notices-tab','downloads-tab','gallery-tab'];
    var tabBtns  = document.querySelectorAll('.media-tab-btn');
    function onScroll() {
        var navH  = document.getElementById('media-tab-nav') ? document.getElementById('media-tab-nav').offsetHeight : 60;
        var offset = navH + 80;
        var current = sections[0];
        sections.forEach(function(id) {
            var el = document.getElementById(id);
            if (el && window.scrollY >= el.offsetTop - offset) current = id;
        });
        tabBtns.forEach(function(btn) {
            btn.classList.toggle('active', btn.dataset.tab === current);
        });
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
})();
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
