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
                <h1 style="font-size:clamp(1.75rem,4vw,2.75rem);font-weight:800;color:#fff;line-height:1.2;margin-bottom:1rem;">Deposit Schemes</h1>
                <p style="color:rgba(255,255,255,0.7);font-size:1rem;line-height:1.75;max-width:520px;margin:0 0 1.75rem;">
                    Invest in different schemes of Deposits — grow your savings with competitive interest rates, flexible tenures, and DICGC-insured security.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <?php
                    $dSchemes = [
                        ['href'=>'#savings',   'label'=>'Savings'],
                        ['href'=>'#current',   'label'=>'Current'],
                        ['href'=>'#fixed',     'label'=>'Fixed Deposit'],
                        ['href'=>'#kalyan',    'label'=>'Kalyan Nidhi'],
                        ['href'=>'#recurring', 'label'=>'Recurring'],
                        ['href'=>'#pigmy',     'label'=>'Pigmy'],
                    ];
                    foreach($dSchemes as $ds):
                    ?>
                    <a href="<?php echo $ds['href']; ?>" style="display:inline-block;padding:0.4rem 1rem;border-radius:20px;font-size:0.8rem;font-weight:600;color:rgba(255,255,255,0.75);border:1px solid rgba(255,255,255,0.25);text-decoration:none;" onmouseover="this.style.background='rgba(255,255,255,0.12)';this.style.color='#fff'" onmouseout="this.style.background='transparent';this.style.color='rgba(255,255,255,0.75)'"><?php echo $ds['label']; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex justify-content-end">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;max-width:320px;">
                    <?php
                    $heroStats = [
                        ['val'=>'8.50%','sub'=>'Best FD Rate',      'icon'=>'fa-percent'],
                        ['val'=>'3.50%','sub'=>'Senior SB Rate',    'icon'=>'fa-piggy-bank'],
                        ['val'=>'₹5L',  'sub'=>'DICGC Insured',    'icon'=>'fa-shield-alt'],
                        ['val'=>'6',    'sub'=>'Deposit Schemes',   'icon'=>'fa-layer-group'],
                    ];
                    foreach($heroStats as $hs):
                    ?>
                    <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:12px;padding:1.1rem 1rem;text-align:center;">
                        <i class="fas <?php echo $hs['icon']; ?>" style="color:#B87333;font-size:1.1rem;margin-bottom:0.5rem;display:block;"></i>
                        <div style="color:#fff;font-size:1.2rem;font-weight:800;line-height:1;"><?php echo $hs['val']; ?></div>
                        <div style="color:rgba(255,255,255,0.5);font-size:0.7rem;font-weight:500;margin-top:3px;"><?php echo $hs['sub']; ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════
     SCHEME NAVIGATOR GRID
     ═══════════════════════════════════════════════════════ -->
<section style="background:#F5F8F5;padding:3.5rem 0;">
    <div class="container-lg">
        <div class="text-center mb-4">
            <h2 style="font-size:1.7rem;font-weight:800;color:#1C2B22;">Our Deposit Schemes</h2>
            <p style="color:#7A9485;font-size:0.93rem;margin:0.4rem 0 0;">Choose the right product for your financial goals</p>
        </div>
        <div class="row g-3">
            <?php
            $schemes = [
                ['num'=>'01','icon'=>'fa-piggy-bank',      'label'=>'Savings Deposit',          'sub'=>'3.00% p.a. (3.50% Senior)','href'=>'#savings',   'color'=>'#0D3D2E'],
                ['num'=>'02','icon'=>'fa-briefcase',        'label'=>'Current Deposit',           'sub'=>'Unlimited transactions',   'href'=>'#current',   'color'=>'#1A5C42'],
                ['num'=>'03','icon'=>'fa-lock',             'label'=>'Fixed Deposit',             'sub'=>'Up to 8.50% p.a.',         'href'=>'#fixed',     'color'=>'#B87333'],
                ['num'=>'04','icon'=>'fa-certificate',      'label'=>'Kalyan Nidhi Certificates', 'sub'=>'Long-term wealth creation', 'href'=>'#kalyan',    'color'=>'#8B5520'],
                ['num'=>'05','icon'=>'fa-calendar-alt',     'label'=>'Recurring Deposit',         'sub'=>'Monthly savings scheme',   'href'=>'#recurring', 'color'=>'#0D3D2E'],
                ['num'=>'06','icon'=>'fa-hand-holding-usd', 'label'=>'Yeshwant Pigmy Deposit',    'sub'=>'Doorstep daily collection','href'=>'#pigmy',     'color'=>'#1A5C42'],
            ];
            foreach($schemes as $s):
            ?>
            <div class="col-md-4 col-lg-2">
                <a href="<?php echo $s['href']; ?>" class="text-decoration-none d-block h-100" style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;padding:1.5rem 1.1rem;text-align:center;" onmouseover="this.style.boxShadow='0 8px 24px rgba(13,61,46,0.12)';this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='none';this.style.transform='none'">
                    <div style="font-size:0.7rem;font-weight:700;color:<?php echo $s['color']; ?>;margin-bottom:0.5rem;"><?php echo $s['num']; ?></div>
                    <div style="width:44px;height:44px;border-radius:12px;background:<?php echo $s['color']; ?>18;display:flex;align-items:center;justify-content:center;margin:0 auto 0.75rem;">
                        <i class="fas <?php echo $s['icon']; ?>" style="color:<?php echo $s['color']; ?>;font-size:1.1rem;"></i>
                    </div>
                    <div style="font-weight:700;color:#1C2B22;font-size:0.83rem;margin-bottom:0.25rem;"><?php echo $s['label']; ?></div>
                    <div style="color:#7A9485;font-size:0.72rem;line-height:1.4;"><?php echo $s['sub']; ?></div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════
     REUSABLE HELPERS
     ═══════════════════════════════════════════════════════ -->
<?php
function dFeatItem($title, $desc) {
    return '<div style="display:flex;align-items:flex-start;gap:0.65rem;padding:0.65rem 0;border-bottom:1px solid #EBF2ED;">
        <div style="width:20px;height:20px;border-radius:50%;background:#EBF2ED;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
            <i class="fas fa-check" style="color:#0D3D2E;font-size:0.58rem;"></i>
        </div>
        <div><span style="font-weight:600;color:#1C2B22;font-size:0.88rem;">'.$title.'</span><br>
        <span style="color:#7A9485;font-size:0.78rem;">'.$desc.'</span></div>
    </div>';
}
function dDetailRow($label, $val, $last=false) {
    return '<div style="display:flex;align-items:center;justify-content:space-between;padding:0.7rem 0;'.($last?'':'border-bottom:1px solid #EBF2ED;').'">
        <span style="color:#7A9485;font-size:0.82rem;">'.$label.'</span>
        <span style="font-weight:700;color:#1C2B22;font-size:0.85rem;">'.$val.'</span>
    </div>';
}
?>

<!-- ═══════════════════════════════════════════════════════
     1. SAVINGS DEPOSIT
     ═══════════════════════════════════════════════════════ -->
<section style="background:#fff;padding:5rem 0;" id="savings">
    <div class="container-lg">
        <div class="row g-5 align-items-start">
            <div class="col-lg-8">
                <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;">Scheme 01</span>
                <h2 style="font-size:1.8rem;font-weight:800;color:#1C2B22;margin-bottom:1rem;">Savings Deposit</h2>
                <p style="color:#3D5A47;line-height:1.85;font-size:0.95rem;margin-bottom:1.25rem;">Our Savings Deposit account is designed for individuals and families who want to save money while earning interest on their deposits. It provides the flexibility of easy withdrawals while ensuring your money grows steadily.</p>
                <?php echo dFeatItem('Competitive Interest Rate','Earn attractive interest on your daily balance'); ?>
                <?php echo dFeatItem('Easy Withdrawals','Withdraw your money whenever you need'); ?>
                <?php echo dFeatItem('Passbook Facility','Track all transactions with a passbook'); ?>
                <?php echo dFeatItem('Nomination Facility','Nominate a person for your account'); ?>
                <div style="background:#EBF2ED;border-left:4px solid #0D3D2E;border-radius:0 10px 10px 0;padding:1rem 1.25rem;margin-top:1.25rem;display:flex;align-items:center;gap:0.75rem;">
                    <i class="fas fa-info-circle" style="color:#0D3D2E;flex-shrink:0;"></i>
                    <span style="color:#1C2B22;font-size:0.9rem;"><strong>Interest Rate:</strong> 3.00% p.a. &nbsp;|&nbsp; <strong>Senior Citizen / Soldier:</strong> 3.50% p.a.</span>
                </div>
            </div>
            <div class="col-lg-4">
                <div style="background:#F5F8F5;border:1px solid #D6E4DA;border-radius:14px;overflow:hidden;">
                    <div style="background:#0D3D2E;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.75rem;">
                        <i class="fas fa-piggy-bank" style="color:#B87333;"></i>
                        <span style="color:#fff;font-weight:700;font-size:0.9rem;">Key Details</span>
                    </div>
                    <div style="padding:0.25rem 1.25rem 1rem;">
                        <?php echo dDetailRow('Account Type','Savings'); ?>
                        <?php echo dDetailRow('Interest Rate','3.00% p.a.'); ?>
                        <?php echo dDetailRow('Senior Citizen','3.50% p.a.'); ?>
                        <?php echo dDetailRow('Cheque Book','Available'); ?>
                        <?php echo dDetailRow('Nomination','Available',true); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════
     2. CURRENT DEPOSIT
     ═══════════════════════════════════════════════════════ -->
<section style="background:#F5F8F5;padding:5rem 0;" id="current">
    <div class="container-lg">
        <div class="row g-5 align-items-start">
            <div class="col-lg-8">
                <span style="display:inline-block;background:#fff;color:#1A5C42;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;border:1px solid #D6E4DA;">Scheme 02</span>
                <h2 style="font-size:1.8rem;font-weight:800;color:#1C2B22;margin-bottom:1rem;">Current Deposit</h2>
                <p style="color:#3D5A47;line-height:1.85;font-size:0.95rem;margin-bottom:1.25rem;">The Current Deposit account is ideal for businesses, traders, and professionals who require unlimited transactions. It offers overdraft facilities and is perfect for high-volume transaction requirements.</p>
                <?php echo dFeatItem('Unlimited Transactions','No restrictions on number of transactions'); ?>
                <?php echo dFeatItem('Overdraft Facility','Short-term credit facility available'); ?>
                <?php echo dFeatItem('Cheque Book','Personalized CTS cheque books'); ?>
                <?php echo dFeatItem('RTGS / NEFT','Electronic fund transfers'); ?>
            </div>
            <div class="col-lg-4">
                <div style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;overflow:hidden;">
                    <div style="background:#1A5C42;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.75rem;">
                        <i class="fas fa-briefcase" style="color:#B87333;"></i>
                        <span style="color:#fff;font-weight:700;font-size:0.9rem;">Key Details</span>
                    </div>
                    <div style="padding:0.25rem 1.25rem 1rem;">
                        <?php echo dDetailRow('Account Type','Current'); ?>
                        <?php echo dDetailRow('Suitable For','Business / Trade'); ?>
                        <?php echo dDetailRow('Transactions','Unlimited'); ?>
                        <?php echo dDetailRow('Overdraft','Available',true); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════
     3. FIXED DEPOSIT
     ═══════════════════════════════════════════════════════ -->
<section style="background:#fff;padding:5rem 0;" id="fixed">
    <div class="container-lg">
        <div class="row g-5 align-items-start">
            <div class="col-lg-8">
                <span style="display:inline-block;background:rgba(184,115,51,0.12);color:#8B5520;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;">Scheme 03</span>
                <h2 style="font-size:1.8rem;font-weight:800;color:#1C2B22;margin-bottom:1rem;">Fixed Deposit</h2>
                <p style="color:#3D5A47;line-height:1.85;font-size:0.95rem;margin-bottom:1.5rem;">Earn high, assured returns on your lump sum investments. Our Fixed Deposit schemes offer some of the most competitive interest rates with flexible tenure options ranging from 46 days to 5+ years.</p>
                <h5 style="font-weight:700;color:#1C2B22;margin-bottom:1rem;font-size:1rem;display:flex;align-items:center;gap:0.5rem;">
                    <i class="fas fa-table" style="color:#B87333;"></i> Interest Rates on Term Deposits
                </h5>
                <div class="table-responsive">
                    <table style="width:100%;border-collapse:collapse;font-size:0.88rem;">
                        <thead>
                            <tr style="background:#0D3D2E;">
                                <th style="color:#fff;font-weight:600;padding:0.75rem 1rem;text-align:left;">Period</th>
                                <th style="color:#fff;font-weight:600;padding:0.75rem 1rem;text-align:center;">General Public</th>
                                <th style="color:#fff;font-weight:600;padding:0.75rem 1rem;text-align:center;">Senior Citizen / Soldier</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($term_deposit_rates)): ?>
                                <?php foreach ($term_deposit_rates as $i => $rate):
                                    $bg = ($i % 2 === 0) ? '#fff' : '#F5F8F5';
                                    $highlight = ((float)$rate['general_rate'] >= 7.75);
                                ?>
                                <tr style="background:<?php echo $highlight ? '#EBF2ED' : $bg; ?>;">
                                    <td style="padding:0.75rem 1rem;color:#1C2B22;<?php echo $highlight ? 'font-weight:600;' : ''; ?>"><?php echo htmlspecialchars($rate['period']); ?><?php if($highlight): ?> <span style="background:#B87333;color:#fff;font-size:0.62rem;font-weight:700;padding:0.1rem 0.45rem;border-radius:10px;margin-left:6px;vertical-align:middle;">Best</span><?php endif; ?></td>
                                    <td style="padding:0.75rem 1rem;text-align:center;font-weight:700;color:#0D3D2E;"><?php echo htmlspecialchars($rate['general_rate']); ?></td>
                                    <td style="padding:0.75rem 1rem;text-align:center;font-weight:700;color:#B87333;"><?php echo htmlspecialchars($rate['senior_rate']); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?php
                                $staticRates = [
                                    ['46 Days to 90 Days','5.00%','5.50%',false],
                                    ['91 Days to 180 Days','5.50%','6.00%',false],
                                    ['181 Days to 364 Days','7.00%','7.50%',false],
                                    ['1 Year and above to less than 2 Years','7.75%','8.25%',true],
                                    ['2 Years and above to less than 5 Years','8.00%','8.50%',true],
                                    ['5 Years and above','7.75%','8.25%',false],
                                ];
                                foreach($staticRates as $i => $r): $bg = ($i%2===0)?'#fff':'#F5F8F5'; ?>
                                <tr style="background:<?php echo $r[3] ? '#EBF2ED' : $bg; ?>;">
                                    <td style="padding:0.75rem 1rem;color:#1C2B22;<?php echo $r[3]?'font-weight:600;':''; ?>"><?php echo $r[0]; ?><?php if($r[3]): ?> <span style="background:#B87333;color:#fff;font-size:0.62rem;font-weight:700;padding:0.1rem 0.45rem;border-radius:10px;margin-left:6px;vertical-align:middle;">Best</span><?php endif; ?></td>
                                    <td style="padding:0.75rem 1rem;text-align:center;font-weight:700;color:#0D3D2E;"><?php echo $r[1]; ?></td>
                                    <td style="padding:0.75rem 1rem;text-align:center;font-weight:700;color:#B87333;"><?php echo $r[2]; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div style="background:#EBF2ED;border-left:4px solid #B87333;border-radius:0 10px 10px 0;padding:0.85rem 1.1rem;margin-top:1rem;display:flex;align-items:center;gap:0.65rem;">
                    <i class="fas fa-star" style="color:#B87333;flex-shrink:0;"></i>
                    <span style="color:#1C2B22;font-size:0.88rem;"><strong>Saving Bank Interest:</strong> 3.00% p.a. &nbsp;(3.50% for Senior Citizen / Soldier)</span>
                </div>
            </div>
            <div class="col-lg-4">
                <div style="background:#F5F8F5;border:1px solid #D6E4DA;border-radius:14px;overflow:hidden;">
                    <div style="background:#B87333;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.75rem;">
                        <i class="fas fa-star" style="color:#fff;"></i>
                        <span style="color:#fff;font-weight:700;font-size:0.9rem;">Key Benefits</span>
                    </div>
                    <div style="padding:0.5rem 1.25rem 1rem;">
                        <?php echo dFeatItem('Rates up to 8.50% p.a.','Best for Senior Citizens'); ?>
                        <?php echo dFeatItem('Tenure: 46 days to 5+ years','Flexible investment period'); ?>
                        <?php echo dFeatItem('Nomination facility','Secure your investment'); ?>
                        <?php echo dFeatItem('Loan against FD','Access funds without breaking FD'); ?>
                        <?php echo dFeatItem('Auto-renewal option','Seamless reinvestment'); ?>
                        <?php echo dFeatItem('+0.50% for Senior Citizens','Extra benefit for elders'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════
     4. KALYAN NIDHI
     ═══════════════════════════════════════════════════════ -->
<section style="background:#F5F8F5;padding:5rem 0;" id="kalyan">
    <div class="container-lg">
        <div class="row g-5 align-items-start">
            <div class="col-lg-8">
                <span style="display:inline-block;background:#fff;color:#8B5520;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;border:1px solid #D6E4DA;">Scheme 04</span>
                <h2 style="font-size:1.8rem;font-weight:800;color:#1C2B22;margin-bottom:1rem;">Kalyan Nidhi Cash Certificates</h2>
                <p style="color:#3D5A47;line-height:1.85;font-size:0.95rem;margin-bottom:1.25rem;">Kalyan Nidhi Cash Certificates are special investment instruments for long-term wealth creation. These certificates offer attractive returns and are a safe, reliable investment option for individuals looking to grow their savings over a fixed period.</p>
                <?php echo dFeatItem('Long-Term Growth','Ideal for long-term wealth creation'); ?>
                <?php echo dFeatItem('Attractive Returns','Competitive interest on certificates'); ?>
                <?php echo dFeatItem('Safe Investment','Backed by our co-operative bank'); ?>
                <?php echo dFeatItem('Nomination','Nomination facility available'); ?>
                <div style="background:#EBF2ED;border-left:4px solid #0D3D2E;border-radius:0 10px 10px 0;padding:1rem 1.25rem;margin-top:1.25rem;display:flex;align-items:center;gap:0.75rem;">
                    <i class="fas fa-info-circle" style="color:#0D3D2E;flex-shrink:0;"></i>
                    <span style="color:#1C2B22;font-size:0.9rem;">Contact your nearest branch for current rates and details on Kalyan Nidhi Cash Certificates.</span>
                </div>
            </div>
            <div class="col-lg-4">
                <div style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;overflow:hidden;">
                    <div style="background:#8B5520;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.75rem;">
                        <i class="fas fa-certificate" style="color:#fff;"></i>
                        <span style="color:#fff;font-weight:700;font-size:0.9rem;">Certificate Details</span>
                    </div>
                    <div style="padding:0.5rem 1.25rem 1rem;">
                        <?php echo dFeatItem('Fixed tenure certificates','Secure locked-in returns'); ?>
                        <?php echo dFeatItem('Transferable to family','Easy transfer facility'); ?>
                        <?php echo dFeatItem('Loan against certificates','Liquidity without breaking'); ?>
                        <?php echo dFeatItem('Duplicate certificate','Can be reissued if lost'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════
     5. RECURRING DEPOSIT
     ═══════════════════════════════════════════════════════ -->
<section style="background:#fff;padding:5rem 0;" id="recurring">
    <div class="container-lg">
        <div class="row g-5 align-items-start">
            <div class="col-lg-8">
                <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;">Scheme 05</span>
                <h2 style="font-size:1.8rem;font-weight:800;color:#1C2B22;margin-bottom:1rem;">Recurring Deposit</h2>
                <p style="color:#3D5A47;line-height:1.85;font-size:0.95rem;margin-bottom:1.25rem;">Build a healthy savings habit with our Recurring Deposit scheme. Deposit a fixed amount every month and earn attractive interest. Perfect for salaried employees and those saving towards a financial goal.</p>
                <?php echo dFeatItem('Monthly Deposits','Save a fixed amount every month'); ?>
                <?php echo dFeatItem('Good Interest','Competitive interest rates apply'); ?>
                <?php echo dFeatItem('Flexible Tenure','Choose tenure as per your goal'); ?>
                <?php echo dFeatItem('Loan Against RD','Avail loan against your RD balance'); ?>
            </div>
            <div class="col-lg-4">
                <div style="background:#F5F8F5;border:1px solid #D6E4DA;border-radius:14px;overflow:hidden;">
                    <div style="background:#0D3D2E;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.75rem;">
                        <i class="fas fa-calendar-alt" style="color:#B87333;"></i>
                        <span style="color:#fff;font-weight:700;font-size:0.9rem;">RD Details</span>
                    </div>
                    <div style="padding:0.5rem 1.25rem 1rem;">
                        <?php echo dFeatItem('Minimum monthly instalment','Start small, save big'); ?>
                        <?php echo dFeatItem('Maturity payment on schedule','Reliable, on-time returns'); ?>
                        <?php echo dFeatItem('Nomination facility','Secure your savings'); ?>
                        <?php echo dFeatItem('Duplicate passbook available','Always accessible'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════
     6. YESHWANT PIGMY DEPOSIT
     ═══════════════════════════════════════════════════════ -->
<section style="background:#F5F8F5;padding:5rem 0;" id="pigmy">
    <div class="container-lg">
        <div class="row g-5 align-items-start">
            <div class="col-lg-8">
                <span style="display:inline-block;background:#fff;color:#1A5C42;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;border:1px solid #D6E4DA;">Scheme 06</span>
                <h2 style="font-size:1.8rem;font-weight:800;color:#1C2B22;margin-bottom:1rem;">Yeshwant Pigmy Deposit</h2>
                <p style="color:#3D5A47;line-height:1.85;font-size:0.95rem;margin-bottom:1.25rem;">The Yeshwant Pigmy Deposit scheme is specially designed for small savers, daily wage earners, and people in rural areas. Our bank agents collect small deposits daily or weekly at your doorstep, making saving easy and accessible for everyone.</p>
                <?php echo dFeatItem('Doorstep Collection','Deposits collected at your location'); ?>
                <?php echo dFeatItem('Small Amounts Welcome','Even small daily savings are welcome'); ?>
                <?php echo dFeatItem('Rural &amp; Urban Focus','Designed for all communities'); ?>
                <?php echo dFeatItem('Financial Inclusion','Brings banking to the unbanked'); ?>
                <div style="background:#EBF2ED;border-left:4px solid #0D3D2E;border-radius:0 10px 10px 0;padding:1rem 1.25rem;margin-top:1.25rem;display:flex;align-items:center;gap:0.75rem;">
                    <i class="fas fa-info-circle" style="color:#0D3D2E;flex-shrink:0;"></i>
                    <span style="color:#1C2B22;font-size:0.9rem;">Contact your nearest branch or our Pigmy agent for enrollment and details.</span>
                </div>
            </div>
            <div class="col-lg-4">
                <div style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;overflow:hidden;">
                    <div style="background:#1A5C42;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.75rem;">
                        <i class="fas fa-hand-holding-usd" style="color:#B87333;"></i>
                        <span style="color:#fff;font-weight:700;font-size:0.9rem;">Pigmy Deposit Benefits</span>
                    </div>
                    <div style="padding:0.5rem 1.25rem 1rem;">
                        <?php echo dFeatItem('Daily / weekly collection','Convenient for all schedules'); ?>
                        <?php echo dFeatItem('No minimum amount barrier','Everyone can participate'); ?>
                        <?php echo dFeatItem('Passbook issued','Track your savings'); ?>
                        <?php echo dFeatItem('Nomination facility','Secure your deposits'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════
     CONTACT CTA
     ═══════════════════════════════════════════════════════ -->
<section style="background:linear-gradient(135deg,#0D3D2E,#1A5C42);padding:4rem 0;">
    <div class="container-lg text-center">
        <h3 style="color:#fff;font-weight:800;margin-bottom:0.75rem;">Ready to Start Saving?</h3>
        <p style="color:rgba(255,255,255,0.7);margin-bottom:1.75rem;font-size:0.95rem;">Visit our Chikodi branch or contact us to open your deposit account today.</p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
            <a href="<?php echo SITE_URL; ?>pages/contact.php" style="display:inline-flex;align-items:center;gap:0.5rem;background:#B87333;color:#fff;padding:0.8rem 1.75rem;border-radius:8px;font-weight:700;font-size:0.9rem;text-decoration:none;" onmouseover="this.style.background='#CC8A4A'" onmouseout="this.style.background='#B87333'">
                <i class="fas fa-paper-plane"></i> Contact Us
            </a>
            <a href="<?php echo SITE_URL; ?>pages/loans.php" style="display:inline-flex;align-items:center;gap:0.5rem;background:transparent;color:#fff;padding:0.8rem 1.75rem;border-radius:8px;font-weight:700;font-size:0.9rem;text-decoration:none;border:1.5px solid rgba(255,255,255,0.4);" onmouseover="this.style.background='rgba(255,255,255,0.08)'" onmouseout="this.style.background='transparent'">
                <i class="fas fa-hand-holding-usd"></i> View Loan Products
            </a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>