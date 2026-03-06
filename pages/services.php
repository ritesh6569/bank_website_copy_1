<?php
/**
 * Services Page - Shri Shantappanna Miraji Urban Co-op. Bank Ltd.
 */

$page_title = 'Services - Miraji Bank';
$current_page = 'services';

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/notices-fetcher.php';

$notices = getActiveNotices();

function sFeatItem($title, $desc = '') {
    return '<div style="display:flex;align-items:flex-start;gap:0.65rem;padding:0.65rem 0;border-bottom:1px solid #EBF2ED;">
        <div style="width:20px;height:20px;border-radius:50%;background:#EBF2ED;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
            <i class="fas fa-check" style="color:#0D3D2E;font-size:0.58rem;"></i>
        </div>
        <div><span style="font-weight:600;color:#1C2B22;font-size:0.88rem;">' . $title . '</span>'
        . ($desc ? '<br><span style="color:#7A9485;font-size:0.78rem;">' . $desc . '</span>' : '')
        . '</div></div>';
}
?>

    <!-- Hero -->
    <section style="background:linear-gradient(150deg,#0D3D2E 0%,#1A5C42 60%,#2E8B63 100%);padding:5rem 0 4rem;position:relative;overflow:hidden;">
        <div style="position:absolute;top:-60px;right:-60px;width:380px;height:380px;border-radius:50%;background:rgba(255,255,255,0.03);pointer-events:none;"></div>
        <div style="position:absolute;bottom:-80px;left:-50px;width:280px;height:280px;border-radius:50%;background:rgba(184,115,51,0.06);pointer-events:none;"></div>
        <div class="container-lg" style="position:relative;z-index:1;">
            <div style="max-width:680px;">
                <span style="display:inline-block;background:rgba(255,255,255,0.12);color:#fff;font-size:0.7rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:0.25rem 0.9rem;border-radius:20px;margin-bottom:1rem;">Banking Services</span>
                <h1 style="color:#fff;font-size:clamp(2rem,4vw,2.9rem);font-weight:800;line-height:1.2;margin-bottom:1rem;">
                    Modern Services for<br><span style="color:#CC8A4A;">All Your Needs</span>
                </h1>
                <p style="color:rgba(255,255,255,0.78);font-size:1.05rem;margin-bottom:2rem;line-height:1.7;">
                    From electronic fund transfers to guaranteed payment instruments — we offer comprehensive banking services to our members and customers.
                </p>
                <div style="display:flex;flex-wrap:wrap;gap:0.5rem;">
                    <?php
                    $svc_links = [
                        ['#cts','fa-shield-alt','CTS Cheques'],
                        ['#rtgs','fa-exchange-alt','RTGS / NEFT'],
                        ['#emi','fa-calendar-check','EMI Facility'],
                        ['#payorder','fa-receipt','Pay Order'],
                        ['#personal-cheques','fa-id-card','Personalized Cheques'],
                        ['#branches','fa-map-marker-alt','Branch Network'],
                    ];
                    foreach ($svc_links as $sl):
                    ?>
                    <a href="<?php echo $sl[0]; ?>" style="display:inline-flex;align-items:center;gap:0.4rem;background:rgba(255,255,255,0.1);color:#fff;font-size:0.78rem;font-weight:600;padding:0.35rem 0.85rem;border-radius:20px;text-decoration:none;border:1px solid rgba(255,255,255,0.18);"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                        <i class="fas <?php echo $sl[1]; ?>" style="font-size:0.7rem;"></i><?php echo $sl[2]; ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>


    <!-- Services Navigator -->
    <section style="background:#F5F8F5;padding:3.5rem 0;">
        <div class="container-lg">
            <div style="text-align:center;margin-bottom:2.5rem;">
                <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;">Our Services</span>
                <h2 style="font-size:1.9rem;font-weight:800;color:#1C2B22;margin:0;">What We Offer</h2>
                <p style="color:#3D5A47;margin-top:0.5rem;font-size:0.95rem;">Explore our complete range of banking services</p>
            </div>
            <div class="row g-3">
                <?php
                $services = [
                    ['#cts','fa-shield-alt','CTS Cheques','CTS-2010 compliant cheques for faster, safer clearing with RBI-mandated security features.'],
                    ['#rtgs','fa-exchange-alt','RTGS / NEFT','Instant and batch electronic fund transfers to any bank account in India.'],
                    ['#emi','fa-calendar-check','EMI Facility','Repay your loans in easy, fixed equated monthly instalments.'],
                    ['#payorder','fa-receipt','Pay Order','Bank-guaranteed payment instruments for high-value, fraud-proof transactions.'],
                    ['#personal-cheques','fa-id-card','Personalized Cheques','Your name and account details pre-printed on every secure cheque leaf.'],
                    ['#branches','fa-map-marker-alt','14 Branch Network','Serving Belagavi district and beyond with 14 convenient branch locations.'],
                ];
                foreach ($services as $s):
                ?>
                <div class="col-md-6 col-lg-4">
                    <a href="<?php echo $s[0]; ?>" style="text-decoration:none;display:block;height:100%;">
                        <div style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;padding:1.5rem;height:100%;transition:box-shadow 0.2s,transform 0.2s;"
                             onmouseover="this.style.boxShadow='0 8px 24px rgba(13,61,46,0.12)';this.style.transform='translateY(-3px)'"
                             onmouseout="this.style.boxShadow='none';this.style.transform='none'">
                            <div style="width:48px;height:48px;border-radius:12px;background:#EBF2ED;display:flex;align-items:center;justify-content:center;margin-bottom:1rem;">
                                <i class="fas <?php echo $s[1]; ?>" style="color:#0D3D2E;font-size:1.1rem;"></i>
                            </div>
                            <h5 style="font-weight:700;color:#1C2B22;font-size:1rem;margin-bottom:0.4rem;"><?php echo $s[2]; ?></h5>
                            <p style="color:#7A9485;font-size:0.85rem;margin:0;line-height:1.6;"><?php echo $s[3]; ?></p>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTS Cheques -->
    <section id="cts" style="background:#fff;padding:4rem 0;">
        <div class="container-lg">
            <div class="row g-4 align-items-start">
                <div class="col-lg-8">
                    <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;">Service 01</span>
                    <h2 style="font-size:1.75rem;font-weight:800;color:#1C2B22;margin-bottom:1rem;">CTS Cheques</h2>
                    <p style="color:#3D5A47;line-height:1.8;margin-bottom:0.75rem;">Cheque Truncation System (CTS) is a cheque clearing system undertaken by the Reserve Bank of India (RBI). CTS-compliant cheques are processed electronically without physical movement, resulting in faster clearing, reduced fraud risk, and improved efficiency.</p>
                    <p style="color:#3D5A47;line-height:1.8;margin-bottom:1.5rem;">Our bank issues CTS-2010 standard compliant cheques to all account holders. These cheques contain security features like watermarks, void pantograph, UV band, and micro-lettering to prevent counterfeiting.</p>
                    <div class="row g-2">
                        <div class="col-sm-6"><?php echo sFeatItem('Faster Clearing','Cheques cleared on the same or next day'); ?></div>
                        <div class="col-sm-6"><?php echo sFeatItem('Enhanced Security','Multiple security features against fraud'); ?></div>
                        <div class="col-sm-6"><?php echo sFeatItem('RBI Compliant','CTS-2010 standard cheques'); ?></div>
                        <div class="col-sm-6"><?php echo sFeatItem('Nationwide Acceptance','Accepted at all CTS-enabled banks'); ?></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;overflow:hidden;">
                        <div style="background:#0D3D2E;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.65rem;">
                            <i class="fas fa-shield-alt" style="color:#7CB9A0;"></i>
                            <span style="color:#fff;font-weight:700;font-size:0.9rem;">CTS Security Features</span>
                        </div>
                        <div style="padding:1.25rem;">
                            <?php
                            $cts_features = ['Watermark security paper','Void pantograph','UV visible fluorescent band','Micro-lettering','MICR code printed'];
                            foreach ($cts_features as $f) echo sFeatItem($f);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- RTGS / NEFT -->
    <section id="rtgs" style="background:#F5F8F5;padding:4rem 0;">
        <div class="container-lg">
            <div class="row g-4 align-items-start">
                <div class="col-lg-8">
                    <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;">Service 02</span>
                    <h2 style="font-size:1.75rem;font-weight:800;color:#1C2B22;margin-bottom:1rem;">RTGS / NEFT</h2>
                    <p style="color:#3D5A47;line-height:1.8;margin-bottom:1.5rem;">Our bank facilitates electronic fund transfers through both RTGS (Real Time Gross Settlement) and NEFT (National Electronic Funds Transfer) systems. Transfer money securely to any bank account in India quickly and conveniently.</p>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div style="background:#fff;border:1px solid #D6E4DA;border-radius:12px;overflow:hidden;">
                                <div style="background:#0D3D2E;padding:0.7rem 1rem;display:flex;align-items:center;gap:0.5rem;">
                                    <i class="fas fa-bolt" style="color:#CC8A4A;font-size:0.85rem;"></i>
                                    <span style="color:#fff;font-size:0.82rem;font-weight:700;">RTGS — Real Time Gross Settlement</span>
                                </div>
                                <div style="padding:1rem;">
                                    <?php foreach(['Real-time fund transfer','Minimum: Rs. 2,00,000/-','No upper limit','Immediate settlement'] as $r) echo sFeatItem($r); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="background:#fff;border:1px solid #D6E4DA;border-radius:12px;overflow:hidden;">
                                <div style="background:#1A5C42;padding:0.7rem 1rem;display:flex;align-items:center;gap:0.5rem;">
                                    <i class="fas fa-exchange-alt" style="color:#CC8A4A;font-size:0.85rem;"></i>
                                    <span style="color:#fff;font-size:0.82rem;font-weight:700;">NEFT — National Electronic Funds Transfer</span>
                                </div>
                                <div style="padding:1rem;">
                                    <?php foreach(['Available 24×7 (online)','No minimum amount','Suitable for small transfers','Settled in batches'] as $n) echo sFeatItem($n); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h6 style="font-weight:700;color:#1C2B22;margin-bottom:0.75rem;"><i class="fas fa-table" style="color:#B87333;margin-right:0.4rem;"></i>RTGS / NEFT Service Charges</h6>
                    <div class="table-responsive">
                        <table style="width:100%;border-collapse:collapse;font-size:0.85rem;">
                            <thead>
                                <tr style="background:#0D3D2E;">
                                    <th style="color:#fff;font-weight:600;padding:0.7rem 1rem;text-align:left;">Transaction Amount</th>
                                    <th style="color:#fff;font-weight:600;padding:0.7rem 1rem;text-align:center;">RTGS Charge</th>
                                    <th style="color:#fff;font-weight:600;padding:0.7rem 1rem;text-align:center;">NEFT Charge</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $rtgs_rows = [
                                    ['Up to Rs. 10,000/-','N/A','Rs. 2.50 + GST'],
                                    ['Rs. 10,001/- to Rs. 1,00,000/-','N/A','Rs. 5.00 + GST'],
                                    ['Rs. 1,00,001/- to Rs. 2,00,000/-','N/A','Rs. 15.00 + GST'],
                                    ['Rs. 2,00,001/- to Rs. 5,00,000/-','Rs. 25.00 + GST','Rs. 25.00 + GST'],
                                    ['Above Rs. 5,00,000/-','Rs. 50.00 + GST','Rs. 25.00 + GST'],
                                ];
                                foreach ($rtgs_rows as $i => $row):
                                    $bg = $i % 2 === 0 ? '#fff' : '#F5F8F5';
                                ?>
                                <tr style="background:<?php echo $bg; ?>;">
                                    <td style="padding:0.6rem 1rem;border-bottom:1px solid #EBF2ED;color:#1C2B22;"><?php echo $row[0]; ?></td>
                                    <td style="padding:0.6rem 1rem;border-bottom:1px solid #EBF2ED;color:#0D3D2E;font-weight:600;text-align:center;"><?php echo $row[1]; ?></td>
                                    <td style="padding:0.6rem 1rem;border-bottom:1px solid #EBF2ED;color:#0D3D2E;font-weight:600;text-align:center;"><?php echo $row[2]; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div style="background:#EBF2ED;border-left:4px solid #0D3D2E;border-radius:0 10px 10px 0;padding:0.85rem 1.1rem;display:flex;align-items:center;gap:0.65rem;margin-top:1rem;">
                        <i class="fas fa-info-circle" style="color:#0D3D2E;flex-shrink:0;"></i>
                        <span style="color:#1C2B22;font-size:0.85rem;">IFSC Code for our Head Office: <strong>SSBM0000001</strong>. Please contact your nearest branch for exact IFSC codes.</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;overflow:hidden;">
                        <div style="background:#0D3D2E;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.65rem;">
                            <i class="fas fa-info-circle" style="color:#7CB9A0;"></i>
                            <span style="color:#fff;font-weight:700;font-size:0.9rem;">Transfer Requirements</span>
                        </div>
                        <div style="padding:1.25rem;">
                            <?php foreach(["Beneficiary account number","Beneficiary bank's IFSC code","Beneficiary name","Beneficiary bank name","Transfer amount"] as $r) echo sFeatItem($r); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- EMI Facility -->
    <section id="emi" style="background:#fff;padding:4rem 0;">
        <div class="container-lg">
            <div class="row g-4 align-items-start">
                <div class="col-lg-8">
                    <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;">Service 03</span>
                    <h2 style="font-size:1.75rem;font-weight:800;color:#1C2B22;margin-bottom:1rem;">EMI Facility</h2>
                    <p style="color:#3D5A47;line-height:1.8;margin-bottom:0.75rem;">Our EMI (Equated Monthly Instalment) facility makes loan repayment simple and convenient. Instead of paying a lump sum, you repay your loan in fixed monthly instalments over the chosen tenure.</p>
                    <p style="color:#3D5A47;line-height:1.8;margin-bottom:1.5rem;">The EMI amount is fixed at the time of loan sanction and remains the same throughout the repayment period, making financial planning predictable and stress-free.</p>
                    <div class="row g-2 mb-4">
                        <div class="col-sm-6"><?php echo sFeatItem('Fixed Monthly Payments','Same amount every month'); ?></div>
                        <div class="col-sm-6"><?php echo sFeatItem('Easy Planning','Plan your finances with fixed EMIs'); ?></div>
                        <div class="col-sm-6"><?php echo sFeatItem('All Loan Types','EMI available on most loans'); ?></div>
                        <div class="col-sm-6"><?php echo sFeatItem('Flexible Tenure','Choose tenure based on your capacity'); ?></div>
                    </div>
                    <div style="background:#F5F8F5;border:1px solid #D6E4DA;border-radius:12px;padding:1.25rem;">
                        <div style="display:flex;align-items:center;gap:0.6rem;margin-bottom:0.75rem;">
                            <div style="width:36px;height:36px;border-radius:9px;background:#EBF2ED;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-calculator" style="color:#B87333;font-size:0.9rem;"></i>
                            </div>
                            <span style="font-weight:700;color:#1C2B22;font-size:0.9rem;">EMI Formula</span>
                        </div>
                        <p style="font-family:monospace;font-size:0.9rem;color:#0D3D2E;font-weight:700;margin-bottom:0.4rem;">EMI = P &times; r &times; (1+r)&sup;n / [(1+r)&sup;n - 1]</p>
                        <p style="font-size:0.8rem;color:#7A9485;margin:0;">Where P = Principal, r = Monthly interest rate, n = Number of months</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;overflow:hidden;">
                        <div style="background:#0D3D2E;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.65rem;">
                            <i class="fas fa-calendar-check" style="color:#CC8A4A;"></i>
                            <span style="color:#fff;font-weight:700;font-size:0.9rem;">EMI Benefits</span>
                        </div>
                        <div style="padding:1.25rem;">
                            <?php foreach(['Available on all term loans','Vehicle, Housing, Personal loans','Reduces repayment burden','Structured repayment plan','Tenure: 1 to 15 years (as applicable)'] as $e) echo sFeatItem($e); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pay Order -->
    <section id="payorder" style="background:#F5F8F5;padding:4rem 0;">
        <div class="container-lg">
            <div class="row g-4 align-items-start">
                <div class="col-lg-8">
                    <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;">Service 04</span>
                    <h2 style="font-size:1.75rem;font-weight:800;color:#1C2B22;margin-bottom:1rem;">Pay Order</h2>
                    <p style="color:#3D5A47;line-height:1.8;margin-bottom:0.75rem;">A Pay Order (also known as a Banker's Cheque) is a guaranteed payment instrument issued by the bank. Unlike a personal cheque, a Pay Order is backed by the bank's funds and cannot bounce.</p>
                    <p style="color:#3D5A47;line-height:1.8;margin-bottom:1.5rem;">It is the preferred instrument for high-value transactions, property purchases, government payments, and other situations requiring guaranteed settlement.</p>
                    <div class="row g-2">
                        <div class="col-sm-6"><?php echo sFeatItem('Guaranteed Payment','Cannot be dishonoured like a cheque'); ?></div>
                        <div class="col-sm-6"><?php echo sFeatItem('Widely Accepted','Accepted for government &amp; legal payments'); ?></div>
                        <div class="col-sm-6"><?php echo sFeatItem('Secure','Protected against fraud'); ?></div>
                        <div class="col-sm-6"><?php echo sFeatItem('Easy to Obtain','Available at all our branches'); ?></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;overflow:hidden;">
                        <div style="background:#0D3D2E;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.65rem;">
                            <i class="fas fa-receipt" style="color:#CC8A4A;"></i>
                            <span style="color:#fff;font-weight:700;font-size:0.9rem;">Pay Order Details</span>
                        </div>
                        <div style="padding:1.25rem;">
                            <?php foreach(['Issued to member / non-member','Bank-guaranteed instrument','Can be crossed / bearer','Cancellation facility available','Charges as per service schedule'] as $p) echo sFeatItem($p); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Personalized Cheques -->
    <section id="personal-cheques" style="background:#fff;padding:4rem 0;">
        <div class="container-lg">
            <div class="row g-4 align-items-start">
                <div class="col-lg-8">
                    <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;">Service 05</span>
                    <h2 style="font-size:1.75rem;font-weight:800;color:#1C2B22;margin-bottom:1rem;">Personalized Cheques</h2>
                    <p style="color:#3D5A47;line-height:1.8;margin-bottom:0.75rem;">All our savings and current account holders are issued personalized cheque books with their name, account number, and IFSC code pre-printed on each leaf.</p>
                    <p style="color:#3D5A47;line-height:1.8;margin-bottom:1.5rem;">These CTS-2010 compliant cheques are more professional, secure, and help prevent fraudulent alterations compared to generic cheque books.</p>
                    <div class="row g-2 mb-4">
                        <div class="col-sm-6"><?php echo sFeatItem('Name Pre-Printed','Your name on every cheque leaf'); ?></div>
                        <div class="col-sm-6"><?php echo sFeatItem('Account Details','Account number and IFSC pre-printed'); ?></div>
                        <div class="col-sm-6"><?php echo sFeatItem('CTS-2010 Compliant','Meets all RBI standards'); ?></div>
                        <div class="col-sm-6"><?php echo sFeatItem('Fraud Prevention','Harder to alter or misuse'); ?></div>
                    </div>
                    <div style="background:#EBF2ED;border-left:4px solid #0D3D2E;border-radius:0 10px 10px 0;padding:0.85rem 1.1rem;display:flex;align-items:center;gap:0.65rem;">
                        <i class="fas fa-info-circle" style="color:#0D3D2E;flex-shrink:0;"></i>
                        <span style="color:#1C2B22;font-size:0.85rem;">New account holders receive their first cheque book free of charge. Subsequent cheque books are available as per the service charges schedule.</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;overflow:hidden;">
                        <div style="background:#0D3D2E;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.65rem;">
                            <i class="fas fa-id-card" style="color:#CC8A4A;"></i>
                            <span style="color:#fff;font-weight:700;font-size:0.9rem;">Cheque Book Details</span>
                        </div>
                        <div style="padding:1.25rem;">
                            <?php foreach(['10 / 25 leaf cheque books','CTS-2010 standard','MICR coding','Account holder name printed','Available at all branches'] as $c) echo sFeatItem($c); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Branch Network -->
    <section id="branches" style="background:#F5F8F5;padding:4rem 0;">
        <div class="container-lg">
            <div style="text-align:center;margin-bottom:2.5rem;">
                <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;">Service 06</span>
                <h2 style="font-size:1.75rem;font-weight:800;color:#1C2B22;margin-bottom:0.5rem;">14 Branch Network</h2>
                <p style="color:#3D5A47;font-size:0.95rem;">Serving customers across Belagavi district and beyond</p>
            </div>
            <div class="row g-3">
                <?php
                $branch_list = [
                    ['Head Office','944-945, Guruwar Peth, Chikodi, Belagavi — 591201','fa-university',true],
                    ['Chikodi Branch','Chikodi, Belagavi District','fa-map-marker-alt',false],
                    ['Nippani Branch','Nippani, Belagavi District','fa-map-marker-alt',false],
                    ['Athani Branch','Athani, Belagavi District','fa-map-marker-alt',false],
                    ['Sankeshwar Branch','Sankeshwar, Belagavi District','fa-map-marker-alt',false],
                    ['Raibag Branch','Raibag, Belagavi District','fa-map-marker-alt',false],
                ];
                foreach ($branch_list as $br):
                ?>
                <div class="col-md-6 col-lg-4">
                    <div style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;padding:1.25rem;height:100%;">
                        <div style="display:flex;align-items:flex-start;gap:0.75rem;">
                            <div style="width:40px;height:40px;border-radius:10px;background:<?php echo $br[3] ? '#0D3D2E' : '#EBF2ED'; ?>;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fas <?php echo $br[2]; ?>" style="color:<?php echo $br[3] ? '#CC8A4A' : '#0D3D2E'; ?>;font-size:0.9rem;"></i>
                            </div>
                            <div>
                                <h6 style="font-weight:700;color:#1C2B22;margin-bottom:0.25rem;font-size:0.9rem;"><?php echo $br[0]; ?></h6>
                                <p style="color:#7A9485;font-size:0.8rem;margin:0;line-height:1.5;"><?php echo $br[1]; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <div class="col-12" style="text-align:center;margin-top:1rem;">
                    <a href="<?php echo SITE_URL; ?>pages/contact.php#branches" style="display:inline-flex;align-items:center;gap:0.5rem;background:#0D3D2E;color:#fff;padding:0.65rem 1.6rem;border-radius:8px;text-decoration:none;font-weight:600;font-size:0.9rem;"
                       onmouseover="this.style.background='#1A5C42'" onmouseout="this.style.background='#0D3D2E'">
                        <i class="fas fa-map-marker-alt"></i>View All Branches &amp; Contact Info
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section style="background:linear-gradient(135deg,#0D3D2E,#1A5C42);padding:4rem 0;">
        <div class="container-lg" style="text-align:center;">
            <span style="display:inline-block;background:rgba(255,255,255,0.12);color:#fff;font-size:0.7rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:0.25rem 0.9rem;border-radius:20px;margin-bottom:1rem;">Get Started</span>
            <h2 style="color:#fff;font-size:1.9rem;font-weight:800;margin-bottom:0.75rem;">Need Help with Our Services?</h2>
            <p style="color:rgba(255,255,255,0.75);font-size:1rem;max-width:560px;margin:0 auto 2rem;">Visit your nearest branch or call us — our team is ready to assist you with all banking requirements.</p>
            <div style="display:flex;flex-wrap:wrap;gap:1rem;justify-content:center;">
                <a href="<?php echo SITE_URL; ?>pages/contact.php" style="display:inline-flex;align-items:center;gap:0.5rem;background:#B87333;color:#fff;padding:0.75rem 1.8rem;border-radius:8px;text-decoration:none;font-weight:700;font-size:0.95rem;"
                   onmouseover="this.style.background='#CC8A4A'" onmouseout="this.style.background='#B87333'">
                    <i class="fas fa-phone"></i>Contact Us
                </a>
                <a href="<?php echo SITE_URL; ?>pages/deposits.php" style="display:inline-flex;align-items:center;gap:0.5rem;background:rgba(255,255,255,0.12);color:#fff;padding:0.75rem 1.8rem;border-radius:8px;text-decoration:none;font-weight:600;font-size:0.95rem;border:1px solid rgba(255,255,255,0.25);"
                   onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'">
                    <i class="fas fa-piggy-bank"></i>Open a Deposit
                </a>
                <a href="<?php echo SITE_URL; ?>pages/loans.php" style="display:inline-flex;align-items:center;gap:0.5rem;background:rgba(255,255,255,0.12);color:#fff;padding:0.75rem 1.8rem;border-radius:8px;text-decoration:none;font-weight:600;font-size:0.95rem;border:1px solid rgba(255,255,255,0.25);"
                   onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'">
                    <i class="fas fa-hand-holding-usd"></i>Apply for a Loan
                </a>
            </div>
        </div>
    </section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
