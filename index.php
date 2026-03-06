<?php
/**
 * Home Page - Shri Shantappanna Miraji Urban Co-op. Bank Ltd.
 */

$page_title = 'Home - Miraji Bank';
$current_page = 'home';

require_once __DIR__ . '/config.php';
include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/data-fetcher.php';
include __DIR__ . '/includes/notices-fetcher.php';

$offers   = $data_fetcher->getOffers();
$notices  = getActiveNotices();
$downloads = $data_fetcher->getDownloads(4);
$gallery   = $data_fetcher->getGallery(6);
?>

<!-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     1. HERO â€” Split layout with trust stats ribbon
     â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<section style="background: linear-gradient(150deg, #0D3D2E 0%, #1A5C42 55%, #2E8B63 100%); min-height: 88vh; display:flex; align-items:center; position:relative; overflow:hidden; padding: 5rem 0 4rem;">

    <!-- Background decorative circles -->
    <div style="position:absolute;top:-80px;right:-80px;width:500px;height:500px;border-radius:50%;background:rgba(255,255,255,0.03);pointer-events:none;"></div>
    <div style="position:absolute;bottom:-120px;left:-60px;width:380px;height:380px;border-radius:50%;background:rgba(184,115,51,0.06);pointer-events:none;"></div>
    <div style="position:absolute;top:30%;right:10%;width:180px;height:180px;border-radius:50%;border:1px solid rgba(255,255,255,0.06);pointer-events:none;"></div>

    <div class="container-lg" style="position:relative;z-index:1;">
        <div class="row align-items-center g-5">

            <!-- Left: Text -->
            <div class="col-lg-6 text-center text-lg-start">
                <span style="display:inline-block;background:rgba(184,115,51,0.18);border:1px solid rgba(184,115,51,0.4);color:#B87333;font-size:0.72rem;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;padding:0.35rem 1rem;border-radius:30px;margin-bottom:1.5rem;">
                    Serving Since 1961 Â· 65+ Years
                </span>
                <h1 style="font-size:clamp(2rem,4.5vw,3rem);font-weight:800;color:#fff;line-height:1.15;letter-spacing:-0.02em;margin-bottom:1.25rem;">
                    Your Trusted<br>
                    <span style="color:#B87333;">Co-operative Bank</span><br>
                    in Chikodi
                </h1>
                <p style="font-size:1.05rem;color:rgba(255,255,255,0.72);line-height:1.8;max-width:480px;margin:0 auto 2rem;">
                    Shri Shantappanna Miraji Urban Co-op. Bank Ltd. â€” built on honest effort and abounding faith, serving the Belagavi community for over six decades.
                </p>
                <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                    <a href="<?php echo SITE_URL; ?>pages/deposits.php" style="background:#B87333;color:#fff;padding:0.75rem 1.75rem;border-radius:8px;font-weight:700;font-size:0.9rem;text-decoration:none;display:inline-flex;align-items:center;gap:0.5rem;transition:background 0.2s;" onmouseover="this.style.background='#CC8A4A'" onmouseout="this.style.background='#B87333'">
                        <i class="fas fa-piggy-bank"></i> Open Deposit
                    </a>
                    <a href="<?php echo SITE_URL; ?>pages/loans.php" style="background:transparent;color:#fff;padding:0.75rem 1.75rem;border-radius:8px;font-weight:700;font-size:0.9rem;text-decoration:none;border:1.5px solid rgba(255,255,255,0.45);display:inline-flex;align-items:center;gap:0.5rem;transition:background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.08)'" onmouseout="this.style.background='transparent'">
                        <i class="fas fa-handshake"></i> Apply for Loan
                    </a>
                    <a href="<?php echo SITE_URL; ?>pages/about.php" style="background:transparent;color:rgba(255,255,255,0.7);padding:0.75rem 1.25rem;border-radius:8px;font-weight:600;font-size:0.9rem;text-decoration:none;display:inline-flex;align-items:center;gap:0.4rem;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">
                        About Us <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Right: Info cards stack -->
            <div class="col-lg-6 d-none d-lg-flex flex-column gap-3">
                <!-- Card 1 -->
                <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);border-radius:16px;padding:1.5rem 2rem;display:flex;align-items:center;gap:1.25rem;backdrop-filter:blur(6px);">
                    <div style="width:52px;height:52px;background:#B87333;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas fa-shield-alt" style="color:#fff;font-size:1.25rem;"></i>
                    </div>
                    <div>
                        <div style="color:#fff;font-weight:700;font-size:1rem;">Insured &amp; Regulated</div>
                        <div style="color:rgba(255,255,255,0.6);font-size:0.83rem;margin-top:2px;">Deposits insured under DICGC up to â‚¹5 Lakh</div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);border-radius:16px;padding:1.5rem 2rem;display:flex;align-items:center;gap:1.25rem;backdrop-filter:blur(6px);">
                    <div style="width:52px;height:52px;background:rgba(184,115,51,0.25);border:1px solid rgba(184,115,51,0.4);border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas fa-percent" style="color:#B87333;font-size:1.25rem;"></i>
                    </div>
                    <div>
                        <div style="color:#fff;font-weight:700;font-size:1rem;">Up to 8.50% p.a. on FD</div>
                        <div style="color:rgba(255,255,255,0.6);font-size:0.83rem;margin-top:2px;">Higher rates for senior citizens on Fixed Deposits</div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);border-radius:16px;padding:1.5rem 2rem;display:flex;align-items:center;gap:1.25rem;backdrop-filter:blur(6px);">
                    <div style="width:52px;height:52px;background:rgba(184,115,51,0.25);border:1px solid rgba(184,115,51,0.4);border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas fa-users" style="color:#B87333;font-size:1.25rem;"></i>
                    </div>
                    <div>
                        <div style="color:#fff;font-weight:700;font-size:1rem;">Community-First Banking</div>
                        <div style="color:rgba(255,255,255,0.6);font-size:0.83rem;margin-top:2px;">Owned &amp; governed by members, for members</div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Trust stats ribbon -->
        <div style="margin-top:3.5rem;padding-top:2.5rem;border-top:1px solid rgba(255,255,255,0.1);">
            <div class="row g-3 text-center text-lg-start">
                <div class="col-6 col-lg-3">
                    <div style="color:#B87333;font-size:2rem;font-weight:800;line-height:1;">65+</div>
                    <div style="color:rgba(255,255,255,0.55);font-size:0.75rem;font-weight:500;text-transform:uppercase;letter-spacing:0.08em;margin-top:4px;">Years of Service</div>
                </div>
                <div class="col-6 col-lg-3">
                    <div style="color:#B87333;font-size:2rem;font-weight:800;line-height:1;">â‚¹5L</div>
                    <div style="color:rgba(255,255,255,0.55);font-size:0.75rem;font-weight:500;text-transform:uppercase;letter-spacing:0.08em;margin-top:4px;">Deposit Insurance</div>
                </div>
                <div class="col-6 col-lg-3">
                    <div style="color:#B87333;font-size:2rem;font-weight:800;line-height:1;">8.50%</div>
                    <div style="color:rgba(255,255,255,0.55);font-size:0.75rem;font-weight:500;text-transform:uppercase;letter-spacing:0.08em;margin-top:4px;">Best FD Rate p.a.</div>
                </div>
                <div class="col-6 col-lg-3">
                    <div style="color:#B87333;font-size:2rem;font-weight:800;line-height:1;">1961</div>
                    <div style="color:rgba(255,255,255,0.55);font-size:0.75rem;font-weight:500;text-transform:uppercase;letter-spacing:0.08em;margin-top:4px;">Founded</div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     2. QUICK SERVICE TILES â€” Icon grid
     â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<section style="background:#F5F8F5;padding:3.5rem 0;">
    <div class="container-lg">
        <div class="row g-3">
            <?php
            $tiles = [
                ['icon'=>'fa-piggy-bank',    'label'=>'Savings Account',  'sub'=>'Open a savings account',    'href'=>'pages/deposits.php',         'color'=>'#0D3D2E'],
                ['icon'=>'fa-file-invoice',  'label'=>'Fixed Deposit',    'sub'=>'Earn up to 8.50% p.a.',     'href'=>'pages/deposits.php#fixed',   'color'=>'#1A5C42'],
                ['icon'=>'fa-coins',         'label'=>'Recurring Deposit','sub'=>'Kalyan Nidhi monthly scheme','href'=>'pages/deposits.php#cumulative','color'=>'#2E8B63'],
                ['icon'=>'fa-hand-holding-usd','label'=>'Gold Loan',      'sub'=>'Quick disbursal, low rate', 'href'=>'pages/loans.php',            'color'=>'#B87333'],
                ['icon'=>'fa-home',          'label'=>'Housing Loan',     'sub'=>'Build your dream home',     'href'=>'pages/loans.php',            'color'=>'#8B5520'],
                ['icon'=>'fa-exchange-alt',  'label'=>'RTGS / NEFT',      'sub'=>'Fast fund transfers',       'href'=>'pages/services.php',         'color'=>'#0D3D2E'],
                ['icon'=>'fa-file-alt',      'label'=>'Downloads',        'sub'=>'Forms & documents',         'href'=>'pages/media.php',            'color'=>'#1A5C42'],
                ['icon'=>'fa-headset',       'label'=>'Contact Support',  'sub'=>'We are here to help',       'href'=>'pages/contact.php',          'color'=>'#B87333'],
            ];
            foreach($tiles as $tile):
            ?>
            <div class="col-6 col-md-3">
                <a href="<?php echo SITE_URL . $tile['href']; ?>" class="text-decoration-none d-block h-100" style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;padding:1.4rem 1.25rem;transition:box-shadow 0.2s,transform 0.2s;text-align:center;" onmouseover="this.style.boxShadow='0 8px 28px rgba(13,61,46,0.12)';this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='none';this.style.transform='none'">
                    <div style="width:48px;height:48px;border-radius:12px;background:<?php echo $tile['color']; ?>18;display:flex;align-items:center;justify-content:center;margin:0 auto 0.85rem;">
                        <i class="fas <?php echo $tile['icon']; ?>" style="color:<?php echo $tile['color']; ?>;font-size:1.2rem;"></i>
                    </div>
                    <div style="font-weight:700;color:#1C2B22;font-size:0.88rem;margin-bottom:0.25rem;"><?php echo $tile['label']; ?></div>
                    <div style="color:#7A9485;font-size:0.76rem;line-height:1.4;"><?php echo $tile['sub']; ?></div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     3. ABOUT STRIP â€” Horizontal with image-side accent
     â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<section style="background:#fff;padding:5rem 0;">
    <div class="container-lg">
        <div class="row align-items-center g-5">
            <!-- Left accent panel -->
            <div class="col-lg-5">
                <div style="background:linear-gradient(145deg,#0D3D2E,#1A5C42);border-radius:20px;padding:3rem 2.5rem;position:relative;overflow:hidden;">
                    <div style="position:absolute;top:-40px;right:-40px;width:180px;height:180px;border-radius:50%;background:rgba(255,255,255,0.04);"></div>
                    <div style="position:absolute;bottom:-30px;left:-30px;width:140px;height:140px;border-radius:50%;background:rgba(184,115,51,0.08);"></div>
                    <i class="fas fa-university" style="font-size:3rem;color:#B87333;margin-bottom:1.5rem;display:block;"></i>
                    <h3 style="color:#fff;font-weight:800;font-size:1.6rem;margin-bottom:1rem;">A Bank Born from the Community</h3>
                    <p style="color:rgba(255,255,255,0.7);line-height:1.8;font-size:0.9rem;margin-bottom:0;">
                        Established in 1961, Shri Shantappanna Miraji Urban Co-operative Bank has grown into a pillar of financial strength for families and businesses in Chikodi, Belagavi.
                    </p>
                    <div style="margin-top:2rem;padding-top:1.5rem;border-top:1px solid rgba(255,255,255,0.12);display:flex;gap:2rem;">
                        <div>
                            <div style="color:#B87333;font-size:1.5rem;font-weight:800;">1961</div>
                            <div style="color:rgba(255,255,255,0.5);font-size:0.72rem;text-transform:uppercase;letter-spacing:0.07em;">Est.</div>
                        </div>
                        <div>
                            <div style="color:#B87333;font-size:1.5rem;font-weight:800;">RBI</div>
                            <div style="color:rgba(255,255,255,0.5);font-size:0.72rem;text-transform:uppercase;letter-spacing:0.07em;">Regulated</div>
                        </div>
                        <div>
                            <div style="color:#B87333;font-size:1.5rem;font-weight:800;">DICGC</div>
                            <div style="color:rgba(255,255,255,0.5);font-size:0.72rem;text-transform:uppercase;letter-spacing:0.07em;">Insured</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: feature list -->
            <div class="col-lg-7">
                <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:0.3rem 0.9rem;border-radius:30px;margin-bottom:1rem;">Who We Are</span>
                <h2 style="font-size:2rem;font-weight:800;color:#1C2B22;margin-bottom:1rem;line-height:1.25;">Banking on Trust,<br>Built on Community Values</h2>
                <p style="color:#3D5A47;line-height:1.8;margin-bottom:2rem;font-size:0.95rem;">
                    For over six decades, we have provided reliable, transparent, and member-driven banking services. As a co-operative bank, every decision we make is in the best interest of our members and the community we serve.
                </p>
                <div class="row g-3">
                    <?php
                    $feats = [
                        ['icon'=>'fa-balance-scale','title'=>'Transparent Governance','desc'=>'Member-elected board. Every rupee accounted for.'],
                        ['icon'=>'fa-lock',         'title'=>'Secure Deposits',       'desc'=>'DICGC insured. Your money is always safe.'],
                        ['icon'=>'fa-chart-line',   'title'=>'Competitive Returns',   'desc'=>'Best rates on FD, RD & savings accounts.'],
                        ['icon'=>'fa-hands-helping','title'=>'Community Support',      'desc'=>'Loans tailored for farmers, SMEs & families.'],
                    ];
                    foreach($feats as $f):
                    ?>
                    <div class="col-sm-6">
                        <div style="display:flex;gap:1rem;align-items:flex-start;">
                            <div style="width:42px;height:42px;border-radius:10px;background:#EBF2ED;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                                <i class="fas <?php echo $f['icon']; ?>" style="color:#0D3D2E;font-size:1rem;"></i>
                            </div>
                            <div>
                                <div style="font-weight:700;color:#1C2B22;font-size:0.9rem;margin-bottom:0.2rem;"><?php echo $f['title']; ?></div>
                                <div style="color:#7A9485;font-size:0.82rem;line-height:1.5;"><?php echo $f['desc']; ?></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <a href="<?php echo SITE_URL; ?>pages/about.php" style="display:inline-flex;align-items:center;gap:0.5rem;margin-top:2rem;background:#0D3D2E;color:#fff;padding:0.75rem 1.75rem;border-radius:8px;font-weight:700;font-size:0.9rem;text-decoration:none;" onmouseover="this.style.background='#1A5C42'" onmouseout="this.style.background='#0D3D2E'">
                    Read Our Story <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     4. PRODUCTS â€” Tabbed-style two-column cards
     â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<section style="background:#F5F8F5;padding:5rem 0;">
    <div class="container-lg">
        <div class="text-center mb-5">
            <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:0.3rem 0.9rem;border-radius:30px;margin-bottom:1rem;">Products</span>
            <h2 style="font-size:1.9rem;font-weight:800;color:#1C2B22;">Deposits &amp; Loans at a Glance</h2>
            <p style="color:#7A9485;max-width:500px;margin:0.75rem auto 0;font-size:0.93rem;">Competitive interest rates, flexible tenures â€” designed for every stage of your financial life.</p>
        </div>

        <div class="row g-4">
            <!-- Deposits -->
            <div class="col-lg-6">
                <div style="background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 2px 16px rgba(13,61,46,0.07);height:100%;">
                    <div style="background:#0D3D2E;padding:1.25rem 1.75rem;display:flex;align-items:center;gap:0.85rem;">
                        <div style="width:40px;height:40px;background:rgba(184,115,51,0.2);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="fas fa-piggy-bank" style="color:#B87333;"></i>
                        </div>
                        <h5 style="color:#fff;font-weight:700;margin:0;font-size:1rem;">Deposit Products</h5>
                    </div>
                    <div style="padding:1.5rem 1.75rem;">
                        <?php
                        $deposits_list = [
                            ['name'=>'Savings Bank Deposit',         'rate'=>'3.00% p.a.',  'note'=>'3.50% for Senior Citizens'],
                            ['name'=>'Fixed Deposit',                'rate'=>'Up to 8.00%', 'note'=>'8.50% for Senior Citizens'],
                            ['name'=>'Kalyan Nidhi Recurring',       'rate'=>'Market Rate', 'note'=>'Monthly savings scheme'],
                            ['name'=>'Yeshwant Pigmy Deposit',       'rate'=>'Market Rate', 'note'=>'Daily doorstep collection'],
                            ['name'=>'Current Account',              'rate'=>'â€”',           'note'=>'For businesses & traders'],
                        ];
                        foreach($deposits_list as $i => $d):
                        ?>
                        <div style="display:flex;align-items:center;justify-content:space-between;padding:0.85rem 0;<?php echo $i < count($deposits_list)-1 ? 'border-bottom:1px solid #EBF2ED;' : ''; ?>">
                            <div style="display:flex;align-items:center;gap:0.75rem;">
                                <div style="width:8px;height:8px;border-radius:50%;background:#B87333;flex-shrink:0;"></div>
                                <div>
                                    <div style="font-weight:600;color:#1C2B22;font-size:0.88rem;"><?php echo $d['name']; ?></div>
                                    <div style="color:#7A9485;font-size:0.76rem;margin-top:1px;"><?php echo $d['note']; ?></div>
                                </div>
                            </div>
                            <span style="background:#EBF2ED;color:#0D3D2E;font-size:0.76rem;font-weight:700;padding:0.25rem 0.65rem;border-radius:20px;white-space:nowrap;flex-shrink:0;"><?php echo $d['rate']; ?></span>
                        </div>
                        <?php endforeach; ?>
                        <a href="<?php echo SITE_URL; ?>pages/deposits.php" style="display:inline-flex;align-items:center;gap:0.5rem;margin-top:1.25rem;color:#0D3D2E;font-weight:700;font-size:0.88rem;text-decoration:none;" onmouseover="this.style.color='#B87333'" onmouseout="this.style.color='#0D3D2E'">
                            View all deposit details <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Loans -->
            <div class="col-lg-6">
                <div style="background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 2px 16px rgba(13,61,46,0.07);height:100%;">
                    <div style="background:#1A5C42;padding:1.25rem 1.75rem;display:flex;align-items:center;gap:0.85rem;">
                        <div style="width:40px;height:40px;background:rgba(184,115,51,0.2);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="fas fa-hand-holding-usd" style="color:#B87333;"></i>
                        </div>
                        <h5 style="color:#fff;font-weight:700;margin:0;font-size:1rem;">Loan Products</h5>
                    </div>
                    <div style="padding:1.5rem 1.75rem;">
                        <?php
                        $loans_list = [
                            ['name'=>'Gold Loan',                    'rate'=>'From 9.00%',  'note'=>'Quick disbursal, minimal docs'],
                            ['name'=>'Housing Loan',                 'rate'=>'From 10.50%', 'note'=>'Construction & purchase'],
                            ['name'=>'Cash Credit / Working Capital','rate'=>'As applicable','note'=>'For Industrial & MSME units'],
                            ['name'=>'Over Draft Facility',          'rate'=>'As applicable','note'=>'Flexible limit-based credit'],
                            ['name'=>'Personal / Vehicle Loan',      'rate'=>'From 11.00%', 'note'=>'2-wheeler & 4-wheeler financing'],
                        ];
                        foreach($loans_list as $i => $l):
                        ?>
                        <div style="display:flex;align-items:center;justify-content:space-between;padding:0.85rem 0;<?php echo $i < count($loans_list)-1 ? 'border-bottom:1px solid #EBF2ED;' : ''; ?>">
                            <div style="display:flex;align-items:center;gap:0.75rem;">
                                <div style="width:8px;height:8px;border-radius:50%;background:#B87333;flex-shrink:0;"></div>
                                <div>
                                    <div style="font-weight:600;color:#1C2B22;font-size:0.88rem;"><?php echo $l['name']; ?></div>
                                    <div style="color:#7A9485;font-size:0.76rem;margin-top:1px;"><?php echo $l['note']; ?></div>
                                </div>
                            </div>
                            <span style="background:#EBF2ED;color:#0D3D2E;font-size:0.76rem;font-weight:700;padding:0.25rem 0.65rem;border-radius:20px;white-space:nowrap;flex-shrink:0;"><?php echo $l['rate']; ?></span>
                        </div>
                        <?php endforeach; ?>
                        <a href="<?php echo SITE_URL; ?>pages/loans.php" style="display:inline-flex;align-items:center;gap:0.5rem;margin-top:1.25rem;color:#0D3D2E;font-weight:700;font-size:0.88rem;text-decoration:none;" onmouseover="this.style.color='#B87333'" onmouseout="this.style.color='#0D3D2E'">
                            View all loan details <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     5. OFFERS â€” Dynamic from DB (if any)
     â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<?php if (!empty($offers)): ?>
<section style="background:#fff;padding:5rem 0;">
    <div class="container-lg">
        <div class="text-center mb-5">
            <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:0.3rem 0.9rem;border-radius:30px;margin-bottom:1rem;">Special Offers</span>
            <h2 style="font-size:1.9rem;font-weight:800;color:#1C2B22;">Products &amp; Highlights</h2>
        </div>
        <div class="row g-4">
            <?php foreach($offers as $offer): ?>
            <div class="col-md-6 col-lg-3">
                <div style="background:#F5F8F5;border:1px solid #D6E4DA;border-radius:16px;padding:2rem 1.5rem;height:100%;display:flex;flex-direction:column;transition:box-shadow 0.2s,transform 0.2s;" onmouseover="this.style.boxShadow='0 8px 28px rgba(13,61,46,0.12)';this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='none';this.style.transform='none'">
                    <div style="width:50px;height:50px;background:#0D3D2E;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:1.25rem;">
                        <i class="<?php echo htmlspecialchars($offer['icon']); ?>" style="color:#B87333;font-size:1.3rem;"></i>
                    </div>
                    <h5 style="font-weight:700;color:#1C2B22;font-size:0.95rem;margin-bottom:0.5rem;"><?php echo htmlspecialchars($offer['title']); ?></h5>
                    <p style="color:#7A9485;font-size:0.84rem;line-height:1.65;flex:1;margin-bottom:1.25rem;"><?php echo htmlspecialchars($offer['description']); ?></p>
                    <a href="<?php echo htmlspecialchars($offer['link'] ?? SITE_URL.'pages/deposits.php'); ?>" style="display:inline-flex;align-items:center;gap:0.4rem;color:#0D3D2E;font-weight:700;font-size:0.84rem;text-decoration:none;" onmouseover="this.style.color='#B87333'" onmouseout="this.style.color='#0D3D2E'">
                        Learn More <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     6. NOTICES â€” Card wall with date badge
     â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<?php if (!empty($notices)): ?>
<section style="background:#EBF2ED;padding:5rem 0;">
    <div class="container-lg">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
            <div>
                <span style="display:inline-block;background:#fff;color:#0D3D2E;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:0.3rem 0.9rem;border-radius:30px;margin-bottom:0.75rem;">Announcements</span>
                <h2 style="font-size:1.9rem;font-weight:800;color:#1C2B22;margin:0;">Latest News &amp; Notices</h2>
            </div>
            <?php if (count($notices) > 3): ?>
            <a href="<?php echo SITE_URL; ?>pages/media.php#notices" style="display:inline-flex;align-items:center;gap:0.5rem;background:#0D3D2E;color:#fff;padding:0.65rem 1.4rem;border-radius:8px;font-weight:700;font-size:0.85rem;text-decoration:none;" onmouseover="this.style.background='#1A5C42'" onmouseout="this.style.background='#0D3D2E'">
                All Notices <i class="fas fa-arrow-right"></i>
            </a>
            <?php endif; ?>
        </div>

        <div class="row g-4">
            <?php foreach(array_slice($notices, 0, 3) as $notice): ?>
            <div class="col-md-4">
                <div style="background:#fff;border-radius:14px;padding:1.75rem;height:100%;display:flex;flex-direction:column;box-shadow:0 2px 12px rgba(13,61,46,0.06);border-top:4px solid #B87333;">
                    <div style="display:flex;align-items:center;gap:0.6rem;margin-bottom:1rem;">
                        <span style="background:#EBF2ED;color:#0D3D2E;font-size:0.72rem;font-weight:700;padding:0.3rem 0.75rem;border-radius:20px;">
                            <i class="far fa-calendar-alt me-1"></i><?php echo date('d M Y', strtotime($notice['date_published'])); ?>
                        </span>
                    </div>
                    <h5 style="font-weight:700;color:#1C2B22;font-size:0.95rem;margin-bottom:0.75rem;line-height:1.4;"><?php echo htmlspecialchars($notice['title']); ?></h5>
                    <p style="color:#7A9485;font-size:0.84rem;line-height:1.65;flex:1;margin-bottom:1.25rem;"><?php echo htmlspecialchars(truncateNotice(stripHtmlTags($notice['content']), 130)); ?></p>
                    <button style="display:inline-flex;align-items:center;gap:0.4rem;background:transparent;border:1.5px solid #D6E4DA;color:#0D3D2E;padding:0.5rem 1rem;border-radius:7px;font-weight:700;font-size:0.82rem;cursor:pointer;transition:all 0.2s;"
                        data-bs-toggle="modal" data-bs-target="#noticeModal<?php echo $notice['id']; ?>"
                        onmouseover="this.style.background='#EBF2ED';this.style.borderColor='#0D3D2E'" onmouseout="this.style.background='transparent';this.style.borderColor='#D6E4DA'">
                        Read Full Notice <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Notice Modals -->
<?php foreach($notices as $notice): ?>
<div class="modal fade" id="noticeModal<?php echo $notice['id']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background:linear-gradient(135deg,#0D3D2E,#2E8B63);border:none;">
                <h5 class="modal-title text-white"><i class="fas fa-bell me-2" style="color:#B87333;"></i><?php echo htmlspecialchars($notice['title']); ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="padding:2rem;">
                <p style="color:#7A9485;font-size:0.82rem;margin-bottom:1.25rem;"><i class="fas fa-calendar-alt me-1"></i>Published on <?php echo formatNoticeDate($notice['date_published']); ?></p>
                <div class="notice-content"><?php echo $notice['content']; ?></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>

<!-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     7. DOWNLOADS â€” Row list style
     â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<?php if (!empty($downloads)): ?>
<section style="background:#fff;padding:5rem 0;">
    <div class="container-lg">
        <div class="row align-items-center mb-4">
            <div class="col">
                <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:0.3rem 0.9rem;border-radius:30px;margin-bottom:0.75rem;">Resources</span>
                <h2 style="font-size:1.9rem;font-weight:800;color:#1C2B22;margin:0;">Downloads &amp; Forms</h2>
            </div>
            <div class="col-auto">
                <a href="<?php echo SITE_URL; ?>pages/media.php" style="display:inline-flex;align-items:center;gap:0.4rem;color:#0D3D2E;font-weight:700;font-size:0.85rem;text-decoration:none;" onmouseover="this.style.color='#B87333'" onmouseout="this.style.color='#0D3D2E'">View all <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="row g-3">
            <?php foreach($downloads as $dl): ?>
            <div class="col-md-6">
                <div style="display:flex;align-items:center;gap:1.25rem;background:#F5F8F5;border:1px solid #D6E4DA;border-radius:12px;padding:1.1rem 1.5rem;transition:box-shadow 0.2s;" onmouseover="this.style.boxShadow='0 4px 16px rgba(13,61,46,0.1)'" onmouseout="this.style.boxShadow='none'">
                    <div style="width:46px;height:46px;background:#FEE2E2;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas fa-file-pdf" style="color:#DC2626;font-size:1.2rem;"></i>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-weight:700;color:#1C2B22;font-size:0.88rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?php echo htmlspecialchars($dl['title']); ?></div>
                        <?php if(!empty($dl['category'])): ?>
                        <span style="background:#EBF2ED;color:#0D3D2E;font-size:0.7rem;font-weight:700;padding:0.18rem 0.55rem;border-radius:20px;display:inline-block;margin-top:4px;"><?php echo htmlspecialchars($dl['category']); ?></span>
                        <?php endif; ?>
                    </div>
                    <a href="<?php echo SITE_URL; ?>admin/downloads.php?action=download&id=<?php echo $dl['id']; ?>" style="display:inline-flex;align-items:center;gap:0.4rem;background:#0D3D2E;color:#fff;padding:0.5rem 1rem;border-radius:7px;font-weight:700;font-size:0.78rem;text-decoration:none;flex-shrink:0;" onmouseover="this.style.background='#1A5C42'" onmouseout="this.style.background='#0D3D2E'">
                        <i class="fas fa-download"></i> Download
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     8. GALLERY â€” Masonry-style grid
     â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<?php if (!empty($gallery)): ?>
<section style="background:#F5F8F5;padding:5rem 0;">
    <div class="container-lg">
        <div class="text-center mb-4">
            <span style="display:inline-block;background:#fff;color:#0D3D2E;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:0.3rem 0.9rem;border-radius:30px;margin-bottom:0.75rem;">Photo Gallery</span>
            <h2 style="font-size:1.9rem;font-weight:800;color:#1C2B22;">Our Bank &amp; Events</h2>
        </div>
        <div class="row g-3">
            <?php foreach($gallery as $img):
                $img_full_path = __DIR__ . '/' . $img['image_path'];
                $img_url = SITE_URL . $img['image_path'];
            ?>
            <div class="col-6 col-md-4">
                <div style="border-radius:14px;overflow:hidden;position:relative;aspect-ratio:4/3;background:#D6E4DA;">
                    <?php if(!empty($img['image_path']) && file_exists($img_full_path)): ?>
                    <img src="<?php echo htmlspecialchars($img_url); ?>" alt="<?php echo htmlspecialchars($img['alt_text'] ?? $img['title']); ?>" style="width:100%;height:100%;object-fit:cover;display:block;transition:transform 0.4s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    <?php else: ?>
                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;"><i class="fas fa-image" style="font-size:2rem;color:#7A9485;"></i></div>
                    <?php endif; ?>
                    <div style="position:absolute;bottom:0;left:0;right:0;background:linear-gradient(to top,rgba(13,61,46,0.75),transparent);padding:1rem 0.85rem 0.75rem;">
                        <div style="color:#fff;font-size:0.78rem;font-weight:600;"><?php echo htmlspecialchars($img['title']); ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     9. CONTACT STRIP â€” Horizontal 3-col + map placeholder
     â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<section style="background:linear-gradient(135deg,#0D3D2E,#1A5C42);padding:5rem 0;">
    <div class="container-lg">
        <div class="text-center mb-4">
            <h2 style="color:#fff;font-size:1.9rem;font-weight:800;margin-bottom:0.5rem;">Get in Touch</h2>
            <p style="color:rgba(255,255,255,0.65);font-size:0.93rem;margin:0;">We're here Mondayâ€“Saturday, 10 AM to 5 PM</p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:14px;padding:2rem;text-align:center;">
                    <div style="width:56px;height:56px;background:#B87333;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;">
                        <i class="fas fa-phone-alt" style="color:#fff;font-size:1.3rem;"></i>
                    </div>
                    <h6 style="color:#B87333;font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:0.75rem;">Call Us</h6>
                    <a href="tel:+918338273169" style="color:#fff;font-weight:600;font-size:0.93rem;display:block;text-decoration:none;margin-bottom:0.3rem;">+91 83382 73169</a>
                    <a href="tel:+918494903886" style="color:rgba(255,255,255,0.65);font-size:0.88rem;display:block;text-decoration:none;">+91 84949 03886</a>
                </div>
            </div>
            <div class="col-md-4">
                <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:14px;padding:2rem;text-align:center;">
                    <div style="width:56px;height:56px;background:#B87333;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;">
                        <i class="fas fa-envelope" style="color:#fff;font-size:1.3rem;"></i>
                    </div>
                    <h6 style="color:#B87333;font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:0.75rem;">Email Us</h6>
                    <a href="mailto:shantappanna@mirajibank.com" style="color:#fff;font-weight:600;font-size:0.88rem;display:block;text-decoration:none;word-break:break-all;">shantappanna@mirajibank.com</a>
                </div>
            </div>
            <div class="col-md-4">
                <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:14px;padding:2rem;text-align:center;">
                    <div style="width:56px;height:56px;background:#B87333;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;">
                        <i class="fas fa-map-marker-alt" style="color:#fff;font-size:1.3rem;"></i>
                    </div>
                    <h6 style="color:#B87333;font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:0.75rem;">Visit Us</h6>
                    <p style="color:#fff;font-weight:600;font-size:0.9rem;margin:0;line-height:1.6;">944-945, Guruwar Peth<br>Chikodi, Belagavi 591201</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="<?php echo SITE_URL; ?>pages/contact.php" style="display:inline-flex;align-items:center;gap:0.5rem;background:#B87333;color:#fff;padding:0.8rem 2rem;border-radius:8px;font-weight:700;font-size:0.9rem;text-decoration:none;" onmouseover="this.style.background='#CC8A4A'" onmouseout="this.style.background='#B87333'">
                <i class="fas fa-paper-plane"></i> Send Us a Message
            </a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>

