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

// Fetch loan rates from DB
$loan_rates_db = [];
try {
    $pdo = getDBConnection();
    if ($pdo) {
        $stmt = $pdo->prepare("SELECT * FROM loan_rates WHERE status = 'active' ORDER BY display_order, id");
        $stmt->execute();
        $loan_rates_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) { /* silent */ }

// Group by category
$grouped_rates = [];
foreach ($loan_rates_db as $row) {
    $grouped_rates[$row['category']][] = $row;
}
?>


<!-- ═══════════════════════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════════════════════ -->
<section style="background:linear-gradient(150deg,#0D3D2E 0%,#1A5C42 60%,#2E8B63 100%);padding:5rem 0 4rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-60px;right:-60px;width:380px;height:380px;border-radius:50%;background:rgba(255,255,255,0.03);pointer-events:none;"></div>
    <div style="position:absolute;bottom:-80px;left:-50px;width:280px;height:280px;border-radius:50%;background:rgba(184,115,51,0.06);pointer-events:none;"></div>
    <div class="container-lg" style="position:relative;z-index:1;">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span style="display:inline-block;background:rgba(184,115,51,0.18);border:1px solid rgba(184,115,51,0.4);color:#B87333;font-size:0.72rem;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;padding:0.35rem 1rem;border-radius:30px;margin-bottom:1.25rem;">Banking Products</span>
                <h1 style="font-size:clamp(1.75rem,4vw,2.75rem);font-weight:800;color:#fff;line-height:1.2;margin-bottom:1rem;">Loan Products</h1>
                <p style="color:rgba(255,255,255,0.7);font-size:1rem;line-height:1.75;max-width:520px;margin:0 0 1.75rem;">
                    Fulfil your dreams with our wide range of loan products — competitive rates, quick processing, and flexible repayment tailored to your needs.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <?php
                    $lSchemes = [
                        ['href'=>'#surety',        'label'=>'Personal'],
                        ['href'=>'#cash-credit',   'label'=>'Cash Credit'],
                        ['href'=>'#gold',          'label'=>'Gold'],
                        ['href'=>'#vehicle',       'label'=>'Vehicle'],
                        ['href'=>'#housing',       'label'=>'Housing'],
                        ['href'=>'#industrial',    'label'=>'MSME'],
                        ['href'=>'#other-loans',   'label'=>'Others'],
                    ];
                    foreach($lSchemes as $ls):
                    ?>
                    <a href="<?php echo $ls['href']; ?>" style="display:inline-block;padding:0.4rem 1rem;border-radius:20px;font-size:0.8rem;font-weight:600;color:rgba(255,255,255,0.75);border:1px solid rgba(255,255,255,0.25);text-decoration:none;" onmouseover="this.style.background='rgba(255,255,255,0.12)';this.style.color='#fff'" onmouseout="this.style.background='transparent';this.style.color='rgba(255,255,255,0.75)'"><?php echo $ls['label']; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex justify-content-end">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;max-width:320px;">
                    <?php
                    $lStats = [
                        ['val'=>'9.00%', 'sub'=>'Gold Loan Rate',     'icon'=>'fa-coins'],
                        ['val'=>'10.50%','sub'=>'Housing from',        'icon'=>'fa-home'],
                        ['val'=>'Same Day','sub'=>'Gold Disbursal',    'icon'=>'fa-bolt'],
                        ['val'=>'9',     'sub'=>'Loan Products',       'icon'=>'fa-layer-group'],
                    ];
                    foreach($lStats as $ls2):
                    ?>
                    <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:12px;padding:1.1rem 1rem;text-align:center;">
                        <i class="fas <?php echo $ls2['icon']; ?>" style="color:#B87333;font-size:1.1rem;margin-bottom:0.5rem;display:block;"></i>
                        <div style="color:#fff;font-size:1.1rem;font-weight:800;line-height:1;"><?php echo $ls2['val']; ?></div>
                        <div style="color:rgba(255,255,255,0.5);font-size:0.7rem;font-weight:500;margin-top:3px;"><?php echo $ls2['sub']; ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════
     LOAN PRODUCTS OVERVIEW GRID
     ═══════════════════════════════════════════════════════ -->
<section style="background:#F5F8F5;padding:3.5rem 0;">
    <div class="container-lg">
        <div class="text-center mb-4">
            <h2 style="font-size:1.7rem;font-weight:800;color:#1C2B22;">Our Loan Products</h2>
            <p style="color:#7A9485;font-size:0.93rem;margin:0.4rem 0 0;">Comprehensive financial solutions for every need</p>
        </div>
        <div class="row g-3">
            <?php
            $lProducts = [
                ['icon'=>'fa-user-friends',   'label'=>'Surety / Personal Loan',   'sub'=>'Member surety, no collateral', 'href'=>'#surety',      'color'=>'#0D3D2E'],
                ['icon'=>'fa-credit-card',    'label'=>'Cash Credit Loan',          'sub'=>'Revolving working capital',    'href'=>'#cash-credit', 'color'=>'#1A5C42'],
                ['icon'=>'fa-building',       'label'=>'Mortgage Loan',             'sub'=>'Against immovable property',   'href'=>'#mortgage',    'color'=>'#8B5520'],
                ['icon'=>'fa-coins',          'label'=>'Gold Loan',                 'sub'=>'9.00% p.a., same day',         'href'=>'#gold',        'color'=>'#B87333'],
                ['icon'=>'fa-tractor',        'label'=>'Hypothecation Loan',        'sub'=>'Retain movable assets',        'href'=>'#hypothecation','color'=>'#0D3D2E'],
                ['icon'=>'fa-car',            'label'=>'Vehicle Loan',              'sub'=>'2W 11%, 4W/Commercial 10.50%', 'href'=>'#vehicle',     'color'=>'#1A5C42'],
                ['icon'=>'fa-home',           'label'=>'Housing Loan',              'sub'=>'From 10.50% p.a.',             'href'=>'#housing',     'color'=>'#8B5520'],
                ['icon'=>'fa-industry',       'label'=>'Industrial / MSME',         'sub'=>'Working capital from 10%',     'href'=>'#industrial',  'color'=>'#B87333'],
                ['icon'=>'fa-briefcase',      'label'=>'Other Loans',               'sub'=>'Professional, Agriculture…',   'href'=>'#other-loans', 'color'=>'#0D3D2E'],
            ];
            foreach($lProducts as $lp):
            ?>
            <div class="col-md-4 col-lg-4">
                <a href="<?php echo $lp['href']; ?>" class="text-decoration-none d-flex align-items-center gap-3 h-100" style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;padding:1.1rem 1.25rem;" onmouseover="this.style.boxShadow='0 8px 24px rgba(13,61,46,0.12)';this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none';this.style.transform='none'">
                    <div style="width:42px;height:42px;border-radius:11px;background:<?php echo $lp['color']; ?>18;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas <?php echo $lp['icon']; ?>" style="color:<?php echo $lp['color']; ?>;font-size:1rem;"></i>
                    </div>
                    <div>
                        <div style="font-weight:700;color:#1C2B22;font-size:0.85rem;margin-bottom:2px;"><?php echo $lp['label']; ?></div>
                        <div style="color:#7A9485;font-size:0.73rem;"><?php echo $lp['sub']; ?></div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════
     INTEREST RATES TABLE
     ═══════════════════════════════════════════════════════ -->
<section style="background:#fff;padding:4rem 0;">
    <div class="container-lg">
        <div class="text-center mb-4">
            <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.6rem;">Transparent Pricing</span>
            <h2 style="font-size:1.7rem;font-weight:800;color:#1C2B22;">Loan Interest Rates</h2>
            <p style="color:#7A9485;font-size:0.93rem;margin:0.4rem 0 0;">Competitive rates on all our loan products</p>
        </div>
        <div class="table-responsive">
            <table style="width:100%;border-collapse:collapse;font-size:0.88rem;">
                <thead>
                    <tr style="background:#0D3D2E;">
                        <th style="color:#fff;font-weight:600;padding:0.75rem 1rem;text-align:center;width:60px;">Sr.</th>
                        <th style="color:#fff;font-weight:600;padding:0.75rem 1rem;">Type of Loan</th>
                        <th style="color:#fff;font-weight:600;padding:0.75rem 1rem;text-align:center;">Interest Rate (% p.a.)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($grouped_rates)): ?>
                    <tr><td colspan="3" style="text-align:center;color:#7A9485;padding:2.5rem 1rem;">Interest rate information coming soon.</td></tr>
                    <?php else: ?>
                    <?php $sr = 1; foreach ($grouped_rates as $category => $rows): ?>
                    <tr style="background:#EBF2ED;">
                        <td colspan="3" style="padding:0.65rem 1rem;font-weight:700;color:#0D3D2E;font-size:0.82rem;letter-spacing:0.03em;text-transform:uppercase;"><?php echo htmlspecialchars($category); ?></td>
                    </tr>
                    <?php foreach ($rows as $i => $r): $bg = ($i%2===0)?'#fff':'#F5F8F5'; ?>
                    <tr style="background:<?php echo $bg; ?>;">
                        <td style="padding:0.65rem 1rem;text-align:center;color:#7A9485;"><?php echo $sr++; ?>.</td>
                        <td style="padding:0.65rem 1rem;color:#1C2B22;"><?php echo htmlspecialchars($r['loan_type']); ?></td>
                        <td style="padding:0.65rem 1rem;text-align:center;font-weight:700;color:#0D3D2E;"><?php echo htmlspecialchars($r['interest_rate']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════
     REUSABLE HELPERS
     ═══════════════════════════════════════════════════════ -->
<?php
function lFeatItem($title, $desc) {
    return '<div style="display:flex;align-items:flex-start;gap:0.65rem;padding:0.65rem 0;border-bottom:1px solid #EBF2ED;">
        <div style="width:20px;height:20px;border-radius:50%;background:#EBF2ED;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
            <i class="fas fa-check" style="color:#0D3D2E;font-size:0.58rem;"></i>
        </div>
        <div><span style="font-weight:600;color:#1C2B22;font-size:0.88rem;">'.$title.'</span><br>
        <span style="color:#7A9485;font-size:0.78rem;">'.$desc.'</span></div>
    </div>';
}
function lDetailRow($label, $val, $last=false) {
    return '<div style="display:flex;align-items:center;justify-content:space-between;padding:0.7rem 0;'.($last?'':'border-bottom:1px solid #EBF2ED;').'">
        <span style="color:#7A9485;font-size:0.82rem;">'.$label.'</span>
        <span style="font-weight:700;color:#1C2B22;font-size:0.85rem;">'.$val.'</span>
    </div>';
}
?>

<!-- ═══════════════════════════════════════════════════════
     1. SURETY / PERSONAL LOAN
     ═══════════════════════════════════════════════════════ -->
<section style="background:#F5F8F5;padding:5rem 0;" id="surety">
    <div class="container-lg">
        <div class="row g-5 align-items-start">
            <div class="col-lg-8">
                <span style="display:inline-block;background:#fff;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;border:1px solid #D6E4DA;">Surety / Personal Loan</span>
                <h2 style="font-size:1.8rem;font-weight:800;color:#1C2B22;margin-bottom:1rem;">Surety / Personal Loan</h2>
                <p style="color:#3D5A47;line-height:1.85;font-size:0.95rem;margin-bottom:1.25rem;">Our Surety / Personal Loan is available to members of the bank on the surety of other members. It can be utilized for personal needs, education, medical emergencies, marriage, home renovation, and other genuine personal requirements.</p>
                <?php echo lFeatItem('Quick Processing','Fast approval for genuine needs'); ?>
                <?php echo lFeatItem('Member Benefits','Available to all bank members'); ?>
                <?php echo lFeatItem('Flexible Repayment','Repayment in convenient EMIs'); ?>
                <?php echo lFeatItem('No Collateral Required','Surety of members is sufficient'); ?>
            </div>
            <div class="col-lg-4">
                <div style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;overflow:hidden;">
                    <div style="background:#0D3D2E;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.75rem;">
                        <i class="fas fa-user-friends" style="color:#B87333;"></i>
                        <span style="color:#fff;font-weight:700;font-size:0.9rem;">Loan Details</span>
                    </div>
                    <div style="padding:0.5rem 1.25rem 1rem;">
                        <?php echo lFeatItem('For bank members only','Member surety required'); ?>
                        <?php echo lFeatItem('EMI repayment','Convenient monthly payments'); ?>
                        <?php echo lFeatItem('Multiple purposes','Education, medical, marriage…'); ?>
                        <?php echo lFeatItem('No asset pledge needed','Surety-based approval'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════
     2. CASH CREDIT
     ═══════════════════════════════════════════════════════ -->
<section style="background:#fff;padding:5rem 0;" id="cash-credit">
    <div class="container-lg">
        <div class="row g-5 align-items-start">
            <div class="col-lg-8">
                <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;">Cash Credit Loan</span>
                <h2 style="font-size:1.8rem;font-weight:800;color:#1C2B22;margin-bottom:1rem;">Cash Credit Loan</h2>
                <p style="color:#3D5A47;line-height:1.85;font-size:0.95rem;margin-bottom:1.25rem;">A Cash Credit Loan is a revolving credit facility ideal for traders and business owners who need working capital. It allows you to withdraw up to your approved credit limit and pay interest only on the amount used.</p>
                <?php echo lFeatItem('Revolving Credit','Withdraw and repay as needed'); ?>
                <?php echo lFeatItem('Interest on Utilized Amount','Pay interest only on amount used'); ?>
                <?php echo lFeatItem('Business Growth','Fuel your business working capital'); ?>
                <?php echo lFeatItem('Annual Review','Limit reviewed every year'); ?>
            </div>
            <div class="col-lg-4">
                <div style="background:#F5F8F5;border:1px solid #D6E4DA;border-radius:14px;overflow:hidden;">
                    <div style="background:#1A5C42;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.75rem;">
                        <i class="fas fa-credit-card" style="color:#B87333;"></i>
                        <span style="color:#fff;font-weight:700;font-size:0.9rem;">Loan Details</span>
                    </div>
                    <div style="padding:0.5rem 1.25rem 1rem;">
                        <?php echo lFeatItem('For traders &amp; businesses','Working capital facility'); ?>
                        <?php echo lFeatItem('Revolving credit line','Flexible draw and repay'); ?>
                        <?php echo lFeatItem('Security / collateral required','Backed by eligible assets'); ?>
                        <?php echo lFeatItem('Annual renewal','Easy yearly review process'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════
     3. MORTGAGE LOAN
     ═══════════════════════════════════════════════════════ -->
<section style="background:#F5F8F5;padding:5rem 0;" id="mortgage">
    <div class="container-lg">
        <div class="row g-5 align-items-start">
            <div class="col-lg-8">
                <span style="display:inline-block;background:#fff;color:#8B5520;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;border:1px solid #D6E4DA;">Mortgage Loan</span>
                <h2 style="font-size:1.8rem;font-weight:800;color:#1C2B22;margin-bottom:1rem;">Mortgage Loan</h2>
                <p style="color:#3D5A47;line-height:1.85;font-size:0.95rem;margin-bottom:1.25rem;">Our Mortgage Loan is available against the mortgage of immovable property such as land, buildings, or commercial premises. It provides higher loan amounts for business expansion, personal needs, or working capital requirements.</p>
                <?php echo lFeatItem('High Loan Amount','Higher limits against property'); ?>
                <?php echo lFeatItem('Multiple Purposes','Business or personal use'); ?>
                <?php echo lFeatItem('Long Tenure','Repayment over a longer period'); ?>
                <?php echo lFeatItem('Competitive Rates','Attractive interest rates'); ?>
            </div>
            <div class="col-lg-4">
                <div style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;overflow:hidden;">
                    <div style="background:#8B5520;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.75rem;">
                        <i class="fas fa-building" style="color:#fff;"></i>
                        <span style="color:#fff;font-weight:700;font-size:0.9rem;">Loan Details</span>
                    </div>
                    <div style="padding:0.5rem 1.25rem 1rem;">
                        <?php echo lFeatItem('Against immovable property','Land, building, premises'); ?>
                        <?php echo lFeatItem('Property valuation required','Certified market valuation'); ?>
                        <?php echo lFeatItem('Legal documentation','Title deed and NOC required'); ?>
                        <?php echo lFeatItem('High loan-to-value ratio','Maximize borrowing potential'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════
     4. GOLD LOAN
     ═══════════════════════════════════════════════════════ -->
<section style="background:#fff;padding:5rem 0;" id="gold">
    <div class="container-lg">
        <div class="row g-5 align-items-start">
            <div class="col-lg-8">
                <span style="display:inline-block;background:rgba(184,115,51,0.12);color:#8B5520;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;">Gold Loan</span>
                <h2 style="font-size:1.8rem;font-weight:800;color:#1C2B22;margin-bottom:1rem;">Gold Loan</h2>
                <p style="color:#3D5A47;line-height:1.85;font-size:0.95rem;margin-bottom:1.25rem;">Get instant liquidity by pledging your gold ornaments with us. Our Gold Loan offers quick disbursement at one of the lowest interest rates, making it the ideal option for meeting urgent financial needs.</p>
                <?php echo lFeatItem('Quick Disbursal','Loan disbursed within hours'); ?>
                <?php echo lFeatItem('Low Interest Rate','Only 9.00% per annum'); ?>
                <?php echo lFeatItem('Safe Custody','Gold kept safe in bank vault'); ?>
                <?php echo lFeatItem('Flexible Repayment','Repay at your convenience'); ?>
                <div style="background:#EBF2ED;border-left:4px solid #B87333;border-radius:0 10px 10px 0;padding:1rem 1.25rem;margin-top:1.25rem;display:flex;align-items:center;gap:0.75rem;">
                    <i class="fas fa-star" style="color:#B87333;flex-shrink:0;"></i>
                    <span style="color:#1C2B22;font-size:0.9rem;"><strong>Interest Rate: 9.00% p.a.</strong> — One of the lowest gold loan rates available.</span>
                </div>
            </div>
            <div class="col-lg-4">
                <div style="background:#F5F8F5;border:1px solid #D6E4DA;border-radius:14px;overflow:hidden;">
                    <div style="background:#B87333;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.75rem;">
                        <i class="fas fa-coins" style="color:#fff;"></i>
                        <span style="color:#fff;font-weight:700;font-size:0.9rem;">Gold Loan Details</span>
                    </div>
                    <div style="padding:0.25rem 1.25rem 1rem;">
                        <?php echo lDetailRow('Interest Rate','9.00% p.a.'); ?>
                        <?php echo lDetailRow('Security','Gold Ornaments'); ?>
                        <?php echo lDetailRow('Disbursal','Same Day'); ?>
                        <?php echo lDetailRow('Repayment','Flexible',true); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════
     5. HYPOTHECATION
     ═══════════════════════════════════════════════════════ -->
<section style="background:#F5F8F5;padding:5rem 0;" id="hypothecation">
    <div class="container-lg">
        <div class="row g-5 align-items-start">
            <div class="col-lg-8">
                <span style="display:inline-block;background:#fff;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;border:1px solid #D6E4DA;">Hypothecation Loan</span>
                <h2 style="font-size:1.8rem;font-weight:800;color:#1C2B22;margin-bottom:1rem;">Hypothecation Loan</h2>
                <p style="color:#3D5A47;line-height:1.85;font-size:0.95rem;margin-bottom:1.25rem;">A Hypothecation Loan is available against the hypothecation of movable assets such as agricultural equipment, machinery, inventory, or other eligible assets. The borrower retains possession while the asset is hypothecated to the bank as security.</p>
                <?php echo lFeatItem('Retain Asset Possession','Continue using your assets'); ?>
                <?php echo lFeatItem('For Business Assets','Machinery, equipment, inventory'); ?>
                <?php echo lFeatItem('Agricultural Use','Suitable for farm equipment'); ?>
                <?php echo lFeatItem('Flexible Tenure','As per loan type and usage'); ?>
            </div>
            <div class="col-lg-4">
                <div style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;overflow:hidden;">
                    <div style="background:#0D3D2E;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.75rem;">
                        <i class="fas fa-tractor" style="color:#B87333;"></i>
                        <span style="color:#fff;font-weight:700;font-size:0.9rem;">Loan Details</span>
                    </div>
                    <div style="padding:0.5rem 1.25rem 1rem;">
                        <?php echo lFeatItem('Movable asset as security','Agriculture &amp; MSME assets'); ?>
                        <?php echo lFeatItem('Borrower retains possession','No physical handover'); ?>
                        <?php echo lFeatItem('Insurance on hypothecated assets','Asset protection required'); ?>
                        <?php echo lFeatItem('Suitable for agriculture &amp; MSME','Wide applicability'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════
     6. VEHICLE LOAN
     ═══════════════════════════════════════════════════════ -->
<section style="background:#fff;padding:5rem 0;" id="vehicle">
    <div class="container-lg">
        <div class="row g-5 align-items-start">
            <div class="col-lg-8">
                <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;">Vehicle Loan</span>
                <h2 style="font-size:1.8rem;font-weight:800;color:#1C2B22;margin-bottom:1rem;">Vehicle Loan</h2>
                <p style="color:#3D5A47;line-height:1.85;font-size:0.95rem;margin-bottom:1.25rem;">Drive your dreams with our Vehicle Loan. We finance two-wheelers, four-wheelers, and commercial vehicles at competitive interest rates with easy EMI options. The vehicle itself serves as the primary security.</p>
                <?php echo lFeatItem('Two &amp; Four Wheelers','All types of vehicles financed'); ?>
                <?php echo lFeatItem('Commercial Vehicles','Auto, trucks, and more'); ?>
                <?php echo lFeatItem('Easy EMI','Convenient monthly repayments'); ?>
                <?php echo lFeatItem('Quick Processing','Fast approval and disbursement'); ?>
                <div style="background:#EBF2ED;border-left:4px solid #0D3D2E;border-radius:0 10px 10px 0;padding:1rem 1.25rem;margin-top:1.25rem;display:flex;align-items:center;gap:0.75rem;">
                    <i class="fas fa-info-circle" style="color:#0D3D2E;flex-shrink:0;"></i>
                    <span style="color:#1C2B22;font-size:0.9rem;"><strong>Two Wheeler:</strong> 11.00% p.a. &nbsp;|&nbsp; <strong>Four Wheeler / Commercial:</strong> 10.50% p.a.</span>
                </div>
            </div>
            <div class="col-lg-4">
                <div style="background:#F5F8F5;border:1px solid #D6E4DA;border-radius:14px;overflow:hidden;">
                    <div style="background:#1A5C42;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.75rem;">
                        <i class="fas fa-car" style="color:#B87333;"></i>
                        <span style="color:#fff;font-weight:700;font-size:0.9rem;">Vehicle Loan Rates</span>
                    </div>
                    <div style="padding:0.25rem 1.25rem 1rem;">
                        <?php echo lDetailRow('Two Wheeler','11.00% p.a.'); ?>
                        <?php echo lDetailRow('Four Wheeler','10.50% p.a.'); ?>
                        <?php echo lDetailRow('Commercial Vehicle','10.50% p.a.'); ?>
                        <?php echo lDetailRow('Security','Vehicle Hypothecation'); ?>
                        <?php echo lDetailRow('Repayment','EMI',true); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════
     7. HOUSING LOAN
     ═══════════════════════════════════════════════════════ -->
<section style="background:#F5F8F5;padding:5rem 0;" id="housing">
    <div class="container-lg">
        <div class="row g-5 align-items-start">
            <div class="col-lg-8">
                <span style="display:inline-block;background:#fff;color:#8B5520;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;border:1px solid #D6E4DA;">Housing Loan</span>
                <h2 style="font-size:1.8rem;font-weight:800;color:#1C2B22;margin-bottom:1rem;">Housing Loan</h2>
                <p style="color:#3D5A47;line-height:1.85;font-size:0.95rem;margin-bottom:1.25rem;">Our Housing Loan products cover all your residential and commercial property needs — from constructing a new home, purchasing a ready property, repairing an existing home, to financing a commercial building.</p>
                <?php echo lFeatItem('Residential Construction','Build your dream home'); ?>
                <?php echo lFeatItem('Property Purchase','Buy ready or under-construction property'); ?>
                <?php echo lFeatItem('Home Repair / Renovation','Renovate or expand your home'); ?>
                <?php echo lFeatItem('Commercial Property','Finance your commercial space'); ?>
                <h5 style="font-weight:700;color:#1C2B22;margin:1.5rem 0 0.75rem;font-size:0.95rem;display:flex;align-items:center;gap:0.5rem;">
                    <i class="fas fa-table" style="color:#B87333;"></i> Housing Loan Interest Rates
                </h5>
                <div class="table-responsive">
                    <table style="width:100%;border-collapse:collapse;font-size:0.88rem;">
                        <thead>
                            <tr style="background:#0D3D2E;">
                                <th style="color:#fff;font-weight:600;padding:0.65rem 1rem;text-align:left;">Type</th>
                                <th style="color:#fff;font-weight:600;padding:0.65rem 1rem;text-align:center;">Interest Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="background:#fff;"><td style="padding:0.65rem 1rem;color:#1C2B22;">Residential – Construction</td><td style="padding:0.65rem 1rem;text-align:center;font-weight:700;color:#0D3D2E;">10.50%</td></tr>
                            <tr style="background:#F5F8F5;"><td style="padding:0.65rem 1rem;color:#1C2B22;">Residential – Purchase</td><td style="padding:0.65rem 1rem;text-align:center;font-weight:700;color:#0D3D2E;">10.50%</td></tr>
                            <tr style="background:#fff;"><td style="padding:0.65rem 1rem;color:#1C2B22;">Residential – Repair</td><td style="padding:0.65rem 1rem;text-align:center;font-weight:700;color:#0D3D2E;">11.00%</td></tr>
                            <tr style="background:#F5F8F5;"><td style="padding:0.65rem 1rem;color:#1C2B22;">Commercial Property</td><td style="padding:0.65rem 1rem;text-align:center;font-weight:700;color:#0D3D2E;">11.50%</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <div style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;overflow:hidden;">
                    <div style="background:#8B5520;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.75rem;">
                        <i class="fas fa-home" style="color:#fff;"></i>
                        <span style="color:#fff;font-weight:700;font-size:0.9rem;">Key Benefits</span>
                    </div>
                    <div style="padding:0.5rem 1.25rem 1rem;">
                        <?php echo lFeatItem('High loan amount','Upto eligible property value'); ?>
                        <?php echo lFeatItem('Long repayment tenure','Easy on monthly budget'); ?>
                        <?php echo lFeatItem('Property as security','Registered mortgage deed'); ?>
                        <?php echo lFeatItem('EMI facility','Convenient monthly payments'); ?>
                        <?php echo lFeatItem('Both residential &amp; commercial','All property types covered'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════
     8. INDUSTRIAL / MSME LOAN
     ═══════════════════════════════════════════════════════ -->
<section style="background:#fff;padding:5rem 0;" id="industrial">
    <div class="container-lg">
        <div class="row g-5 align-items-start">
            <div class="col-lg-8">
                <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;">Industrial / MSME Loan</span>
                <h2 style="font-size:1.8rem;font-weight:800;color:#1C2B22;margin-bottom:1rem;">Industrial / MSME Loan</h2>
                <p style="color:#3D5A47;line-height:1.85;font-size:0.95rem;margin-bottom:1.25rem;">We support the growth of small and medium enterprises with specialized MSME loan products. Whether you need working capital, a term loan, or funds for shed construction, we have you covered.</p>
                <?php echo lFeatItem('Working Capital','Fund day-to-day operations'); ?>
                <?php echo lFeatItem('Term Loan','Capital investment loans'); ?>
                <?php echo lFeatItem('Shed Construction','Finance your factory or workshop'); ?>
                <?php echo lFeatItem('MSME Eligible','For all registered MSMEs'); ?>
                <div style="background:#EBF2ED;border-left:4px solid #0D3D2E;border-radius:0 10px 10px 0;padding:1rem 1.25rem;margin-top:1.25rem;display:flex;align-items:center;gap:0.75rem;">
                    <i class="fas fa-info-circle" style="color:#0D3D2E;flex-shrink:0;"></i>
                    <span style="color:#1C2B22;font-size:0.9rem;"><strong>Working Capital:</strong> 10.00% p.a. &nbsp;|&nbsp; <strong>Term Loan:</strong> 11.00% p.a. &nbsp;|&nbsp; <strong>Shade Construction:</strong> 11.00% p.a.</span>
                </div>
            </div>
            <div class="col-lg-4">
                <div style="background:#F5F8F5;border:1px solid #D6E4DA;border-radius:14px;overflow:hidden;">
                    <div style="background:#0D3D2E;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.75rem;">
                        <i class="fas fa-industry" style="color:#B87333;"></i>
                        <span style="color:#fff;font-weight:700;font-size:0.9rem;">MSME Loan Rates</span>
                    </div>
                    <div style="padding:0.25rem 1.25rem 1rem;">
                        <?php echo lDetailRow('Working Capital','10.00% p.a.'); ?>
                        <?php echo lDetailRow('Term Loan','11.00% p.a.'); ?>
                        <?php echo lDetailRow('Shade Construction','11.00% p.a.',true); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════
     9. OTHER LOANS
     ═══════════════════════════════════════════════════════ -->
<section style="background:#F5F8F5;padding:5rem 0;" id="other-loans">
    <div class="container-lg">
        <div class="text-center mb-4">
            <span style="display:inline-block;background:#fff;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.6rem;border:1px solid #D6E4DA;">Specialized Products</span>
            <h2 style="font-size:1.7rem;font-weight:800;color:#1C2B22;">Other Loan Products</h2>
            <p style="color:#7A9485;font-size:0.93rem;margin:0.4rem 0 0;">We also offer the following specialized loan products</p>
        </div>
        <div class="row g-3">
            <?php
            $otherLoans = [
                ['icon'=>'fa-stethoscope','color'=>'#0D3D2E','title'=>'Professional Loan','desc'=>'For doctors, engineers, lawyers, and other professionals to set up or expand their practice.','rate'=>'12.00% – 13.00% p.a.'],
                ['icon'=>'fa-tv','color'=>'#1A5C42','title'=>'Consumer Durable Loan','desc'=>'Finance for household appliances, electronics, and other consumer durables.','rate'=>null],
                ['icon'=>'fa-seedling','color'=>'#B87333','title'=>'Allied to Agriculture Loan','desc'=>'Loans for animal husbandry, dairy, poultry, fishery, and horticulture activities.','rate'=>null],
                ['icon'=>'fa-store','color'=>'#8B5520','title'=>'Trade / Business Loan','desc'=>'Loans for traders, shopkeepers, and small business owners to expand operations.','rate'=>null],
                ['icon'=>'fa-truck','color'=>'#0D3D2E','title'=>'Transport Loan','desc'=>'Finance for trucks, tempos, buses, and other transport vehicles for commercial use.','rate'=>null],
                ['icon'=>'fa-university','color'=>'#1A5C42','title'=>'Other RBI Approved Loans','desc'=>'All other loans approved by Reserve Bank of India guidelines for urban co-operative banks.','rate'=>null],
            ];
            foreach($otherLoans as $ol):
            ?>
            <div class="col-md-6 col-lg-4">
                <div style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;padding:1.5rem;" onmouseover="this.style.boxShadow='0 8px 24px rgba(13,61,46,0.1)';this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none';this.style.transform='none'" style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;padding:1.5rem;transition:box-shadow 0.2s,transform 0.2s;">
                    <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:0.85rem;">
                        <div style="width:40px;height:40px;border-radius:10px;background:<?php echo $ol['color']; ?>18;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="fas <?php echo $ol['icon']; ?>" style="color:<?php echo $ol['color']; ?>;font-size:0.95rem;"></i>
                        </div>
                        <h5 style="font-weight:700;color:#1C2B22;font-size:0.92rem;margin:0;"><?php echo $ol['title']; ?></h5>
                    </div>
                    <p style="color:#7A9485;font-size:0.82rem;line-height:1.6;margin:0;">
                        <?php echo $ol['desc']; ?>
                        <?php if($ol['rate']): ?>
                        <br><span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.75rem;font-weight:700;padding:0.2rem 0.6rem;border-radius:15px;margin-top:0.5rem;">Rate: <?php echo $ol['rate']; ?></span>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════
     CONTACT CTA
     ═══════════════════════════════════════════════════════ -->
<section style="background:linear-gradient(135deg,#0D3D2E,#1A5C42);padding:4rem 0;">
    <div class="container-lg text-center">
        <h3 style="color:#fff;font-weight:800;margin-bottom:0.75rem;">Ready to Apply for a Loan?</h3>
        <p style="color:rgba(255,255,255,0.7);margin-bottom:1.75rem;font-size:0.95rem;">Visit our Chikodi branch or contact us today to get started with your loan application.</p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
            <a href="<?php echo SITE_URL; ?>pages/contact.php" style="display:inline-flex;align-items:center;gap:0.5rem;background:#B87333;color:#fff;padding:0.8rem 1.75rem;border-radius:8px;font-weight:700;font-size:0.9rem;text-decoration:none;" onmouseover="this.style.background='#CC8A4A'" onmouseout="this.style.background='#B87333'">
                <i class="fas fa-paper-plane"></i> Contact Us
            </a>
            <a href="<?php echo SITE_URL; ?>pages/deposits.php" style="display:inline-flex;align-items:center;gap:0.5rem;background:transparent;color:#fff;padding:0.8rem 1.75rem;border-radius:8px;font-weight:700;font-size:0.9rem;text-decoration:none;border:1.5px solid rgba(255,255,255,0.4);" onmouseover="this.style.background='rgba(255,255,255,0.08)'" onmouseout="this.style.background='transparent'">
                <i class="fas fa-piggy-bank"></i> View Deposit Schemes
            </a>
            <a href="<?php echo SITE_URL; ?>pages/media.php" style="display:inline-flex;align-items:center;gap:0.5rem;background:transparent;color:#fff;padding:0.8rem 1.75rem;border-radius:8px;font-weight:700;font-size:0.9rem;text-decoration:none;border:1.5px solid rgba(255,255,255,0.4);" onmouseover="this.style.background='rgba(255,255,255,0.08)'" onmouseout="this.style.background='transparent'">
                <i class="fas fa-percent"></i> All Interest Rates
            </a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>