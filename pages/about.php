<?php
/**
 * About Us Page - Shri Shantappanna Miraji Urban Co-op. Bank Ltd.
 */

$page_title = 'About Us - Miraji Bank';
$current_page = 'about';

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/data-fetcher.php';
include __DIR__ . '/../includes/notices-fetcher.php';

$leadership = $data_fetcher->getLeadership();
$board = $data_fetcher->getBoardOfDirectors();
$bom = $data_fetcher->getBoardOfManagement();
$notices = getActiveNotices();
?>

<!-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     PAGE HERO
     â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<section style="background:linear-gradient(150deg,#0D3D2E 0%,#1A5C42 60%,#2E8B63 100%);padding:5rem 0 4rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-60px;right:-60px;width:400px;height:400px;border-radius:50%;background:rgba(255,255,255,0.03);pointer-events:none;"></div>
    <div style="position:absolute;bottom:-80px;left:-50px;width:300px;height:300px;border-radius:50%;background:rgba(184,115,51,0.06);pointer-events:none;"></div>
    <div class="container-lg" style="position:relative;z-index:1;">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <span style="display:inline-block;background:rgba(184,115,51,0.18);border:1px solid rgba(184,115,51,0.4);color:#B87333;font-size:0.72rem;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;padding:0.35rem 1rem;border-radius:30px;margin-bottom:1.25rem;">About Us</span>
                <h1 style="font-size:clamp(1.75rem,4vw,2.75rem);font-weight:800;color:#fff;line-height:1.2;margin-bottom:1rem;">Shri Shantappanna Miraji<br><span style="color:#B87333;">Urban Co-op. Bank Ltd.</span></h1>
                <p style="color:rgba(255,255,255,0.7);font-size:1rem;line-height:1.75;max-width:560px;margin:0;">
                    Chikodi, Belagavi Karnataka â€” Built on honest effort and abounding faith, serving the community since <strong style="color:#fff;">1961</strong>.
                </p>
            </div>
            <div class="col-lg-4 d-none d-lg-flex justify-content-end">
                <div style="display:flex;flex-direction:column;gap:0.75rem;min-width:220px;">
                    <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:12px;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.85rem;">
                        <i class="fas fa-shield-alt" style="color:#B87333;font-size:1.2rem;width:22px;text-align:center;"></i>
                        <span style="color:#fff;font-size:0.85rem;font-weight:600;">RBI Regulated</span>
                    </div>
                    <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:12px;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.85rem;">
                        <i class="fas fa-award" style="color:#B87333;font-size:1.2rem;width:22px;text-align:center;"></i>
                        <span style="color:#fff;font-size:0.85rem;font-weight:600;">"A" Grade â€” Audit 2024-25</span>
                    </div>
                    <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:12px;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.85rem;">
                        <i class="fas fa-map-marker-alt" style="color:#B87333;font-size:1.2rem;width:22px;text-align:center;"></i>
                        <span style="color:#fff;font-size:0.85rem;font-weight:600;">Chikodi, Belagavi 591201</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- â•â•â• STICKY SUB-NAV â•â•â• -->
<div id="aboutSubNav" style="background:#fff;border-bottom:2px solid #D6E4DA;position:sticky;top:64px;z-index:100;box-shadow:0 2px 8px rgba(13,61,46,0.07);">
    <div class="container-lg">
        <nav class="nav flex-nowrap overflow-auto py-2 gap-1" style="scrollbar-width:none;">
            <?php
            $navLinks = [
                ['href'=>'#the-bank',           'label'=>'The Bank'],
                ['href'=>'#our-founder',         'label'=>'Our Founder'],
                ['href'=>'#chairman',            'label'=>'Chairman'],
                ['href'=>'#board-of-directors',  'label'=>'Board of Directors'],
                ['href'=>'#board-of-management', 'label'=>'Board of Management'],
                ['href'=>'#general-manager',     'label'=>'General Manager'],
            ];
            foreach($navLinks as $nl):
            ?>
            <a href="<?php echo $nl['href']; ?>" style="display:inline-block;padding:0.4rem 1rem;border-radius:20px;font-size:0.82rem;font-weight:600;color:#3D5A47;text-decoration:none;white-space:nowrap;transition:background 0.2s,color 0.2s;" onmouseover="this.style.background='#EBF2ED';this.style.color='#0D3D2E'" onmouseout="this.style.background='transparent';this.style.color='#3D5A47'"><?php echo $nl['label']; ?></a>
            <?php endforeach; ?>
        </nav>
    </div>
</div>
<script>
(function() {
    function fixScrollMargins() {
        var navbar = document.querySelector('.navbar');
        var subNav = document.getElementById('aboutSubNav');
        if (!navbar || !subNav) return;
        subNav.style.top = navbar.offsetHeight + 'px';
        var totalOffset = navbar.offsetHeight + subNav.offsetHeight + 16;
        var sections = document.querySelectorAll('#the-bank,#our-founder,#chairman,#board-of-directors,#board-of-management,#general-manager');
        sections.forEach(function(s){ s.style.scrollMarginTop = totalOffset + 'px'; });
    }
    window.addEventListener('load', fixScrollMargins);
    window.addEventListener('resize', fixScrollMargins);
    if (document.readyState !== 'loading') fixScrollMargins();
    else document.addEventListener('DOMContentLoaded', fixScrollMargins);
})();
</script>



<!-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     1. THE BANK
     â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<section style="background:#fff;padding:5rem 0;" id="the-bank">
    <div class="container-lg">
        <div class="row g-5 align-items-start">

            <!-- Main text -->
            <div class="col-lg-7">
                <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:0.3rem 0.9rem;border-radius:30px;margin-bottom:1rem;">The Bank</span>
                <h2 style="font-size:1.9rem;font-weight:800;color:#1C2B22;margin-bottom:1.5rem;line-height:1.25;">The Zeal and Vision</h2>

                <p style="color:#3D5A47;line-height:1.85;font-size:0.95rem;margin-bottom:1rem;">
                    It was owing to the abounding zeal and vision of our Founder Shri. Shantappanna Miraji â€” realizing the need of Banking service to the local area and surrounding Rural area â€” thereby benefitting our customers, the Bank achieved commendable faith with honest effort.
                </p>

                <div style="border-left:3px solid #B87333;padding:1rem 1.5rem;background:#FEFBF7;border-radius:0 10px 10px 0;margin:1.75rem 0;">
                    <h5 style="color:#0D3D2E;font-weight:700;margin-bottom:0.6rem;font-size:1rem;">Being Shri Shantappanna Miraji Urban Co-op. Bank Ltd.</h5>
                    <p style="color:#3D5A47;line-height:1.8;font-size:0.9rem;margin:0;">
                        Soon after the establishment of Shri Shantappanna Miraji Urban Coop Bank Ltd. Chikodi, the founding pillar Shri. Shantappanna Miraji fully involved himself in energizing the Co-operative Movement in Chikodi, Karnataka, more so the Urban Co-operative Banking Movement. He was the Promoting President of our Bank.
                    </p>
                </div>

                <p style="color:#3D5A47;line-height:1.85;font-size:0.95rem;margin-bottom:1rem;">
                    Bank has continued to register a steady growth in business and earnings. The then management of the bank realized the vital need of the Bank to extend its area of operation so as to carry Banking business in the whole district.
                </p>
                <p style="color:#3D5A47;line-height:1.85;font-size:0.95rem;">
                    Our Bank vision is to help customers achieve economic success and financial security, thereby building vibrant and prosperous communities, sustained by values of integrity and good governance.
                </p>
            </div>

            <!-- Sidebar cards -->
            <div class="col-lg-5">
                <div style="display:flex;flex-direction:column;gap:1.25rem;">

                    <div style="background:#F5F8F5;border:1px solid #D6E4DA;border-radius:14px;padding:1.5rem;">
                        <div style="display:flex;align-items:flex-start;gap:1rem;">
                            <div style="width:44px;height:44px;background:#0D3D2E;border-radius:11px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fas fa-bullseye" style="color:#B87333;font-size:1rem;"></i>
                            </div>
                            <div>
                                <h6 style="font-weight:700;color:#1C2B22;margin-bottom:0.4rem;">Our Vision</h6>
                                <p style="color:#7A9485;font-size:0.84rem;line-height:1.6;margin:0;">To help customers achieve economic success and financial security, building vibrant and prosperous communities through integrity and good governance.</p>
                            </div>
                        </div>
                    </div>

                    <div style="background:#F5F8F5;border:1px solid #D6E4DA;border-radius:14px;padding:1.5rem;">
                        <div style="display:flex;align-items:flex-start;gap:1rem;">
                            <div style="width:44px;height:44px;background:#1A5C42;border-radius:11px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fas fa-calendar-check" style="color:#B87333;font-size:1rem;"></i>
                            </div>
                            <div>
                                <h6 style="font-weight:700;color:#1C2B22;margin-bottom:0.4rem;">Founded 1961</h6>
                                <p style="color:#7A9485;font-size:0.84rem;line-height:1.6;margin:0;">Established in Chikodi, Belagavi, Karnataka by Shri Shantappanna Miraji. Over <strong style="color:#0D3D2E;">65 years</strong> of trusted community banking.</p>
                            </div>
                        </div>
                    </div>

                    <div style="background:#F5F8F5;border:1px solid #D6E4DA;border-radius:14px;padding:1.5rem;">
                        <div style="display:flex;align-items:flex-start;gap:1rem;">
                            <div style="width:44px;height:44px;background:#B87333;border-radius:11px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fas fa-map-marker-alt" style="color:#fff;font-size:1rem;"></i>
                            </div>
                            <div>
                                <h6 style="font-weight:700;color:#1C2B22;margin-bottom:0.4rem;">Head Office</h6>
                                <p style="color:#7A9485;font-size:0.84rem;line-height:1.6;margin:0;">944-945, Guruwar Peth Chikodi,<br>Belagavi, Karnataka 591201</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>




<!-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     2. OUR FOUNDER
     â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<section style="background:#F5F8F5;padding:5rem 0;" id="our-founder">
    <div class="container-lg">
        <div class="row g-5 align-items-center">

            <!-- Portrait panel -->
            <div class="col-lg-4 text-center">
                <div style="display:inline-block;position:relative;">
                    <div style="width:200px;height:200px;border-radius:50%;background:linear-gradient(145deg,#0D3D2E,#1A5C42);display:flex;align-items:center;justify-content:center;margin:0 auto;border:5px solid #fff;box-shadow:0 8px 32px rgba(13,61,46,0.2);">
                        <i class="fas fa-user-circle" style="font-size:7rem;color:rgba(184,115,51,0.5);"></i>
                    </div>
                    <div style="position:absolute;bottom:-8px;right:-8px;width:48px;height:48px;background:#B87333;border-radius:50%;display:flex;align-items:center;justify-content:center;border:3px solid #fff;">
                        <i class="fas fa-star" style="color:#fff;font-size:1rem;"></i>
                    </div>
                </div>
                <h4 style="font-weight:800;color:#1C2B22;margin-top:1.5rem;margin-bottom:0.3rem;">Late Shri Shantappanna Miraji</h4>
                <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.75rem;font-weight:700;padding:0.3rem 1rem;border-radius:20px;margin-bottom:0.5rem;">Founder â€” 1961</span>
                <p style="color:#7A9485;font-size:0.85rem;font-style:italic;margin:0;">"Pratham Sahakara Ratna"</p>
            </div>

            <!-- Story text -->
            <div class="col-lg-8">
                <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:0.3rem 0.9rem;border-radius:30px;margin-bottom:1rem;">Our Founder</span>
                <h2 style="font-size:1.9rem;font-weight:800;color:#1C2B22;margin-bottom:1.25rem;line-height:1.25;">A Visionary Who Changed Lives</h2>

                <div style="background:#fff;border:1px solid #D6E4DA;border-radius:12px;padding:1.1rem 1.4rem;margin-bottom:1.25rem;display:flex;align-items:center;gap:0.75rem;">
                    <i class="fas fa-award" style="color:#B87333;font-size:1.2rem;flex-shrink:0;"></i>
                    <strong style="color:#0D3D2E;">FOUNDER â€” Pratham Sahakara Ratna</strong>
                </div>

                <p style="color:#3D5A47;line-height:1.85;font-size:0.93rem;margin-bottom:0.9rem;">
                    A leading Co-operative Bank of the Belagavi district was founded by visionary and positive thinker Shri Shantapannaji in <strong>1961</strong> to cater to the Banking needs of a common man. He was a true co-operator who established and developed the Bank on true co-operative principles.
                </p>
                <p style="color:#3D5A47;line-height:1.85;font-size:0.93rem;margin-bottom:0.9rem;">
                    It is proud to say that he had done the so-called <strong>"Financial Inclusion"</strong> 61 years back by opening branches in Rural areas with less than 1000 population. He is the first person to open the Branch at Belagavi which was commented upon by many, but releasing the potential, others opened Branches in nook and corners of Belagavi.
                </p>
                <p style="color:#3D5A47;line-height:1.85;font-size:0.93rem;margin-bottom:0.9rem;">
                    It is really worth mentioning that he is one of the most uncommon leaders who had never added any single penny to his wealth but spent almost all his share of wealth and life for the growth of the society by establishing many co-operative, Educational, Social and Charitable Institutions.
                </p>
                <p style="color:#3D5A47;line-height:1.85;font-size:0.93rem;margin-bottom:1.25rem;">
                    His services to the society were non-communal, non-political. Many of the so-called politicians, industrialists, businessmen, educationalists, and social workers of today are either his followers or have taken help and inspiration from him.
                </p>
                <div style="background:linear-gradient(135deg,#0D3D2E,#1A5C42);border-radius:12px;padding:1.25rem 1.5rem;">
                    <p style="color:rgba(255,255,255,0.9);font-size:0.95rem;font-style:italic;margin:0;line-height:1.7;">
                        "So he always deserves to be the Fore Father of many values essential for social life."
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>




<!-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     3. CHAIRMAN
     â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<section style="background:#fff;padding:5rem 0;" id="chairman">
    <div class="container-lg">
        <div class="row g-5 align-items-center">

            <!-- Portrait panel -->
            <div class="col-lg-4 text-center">
                <div style="display:inline-block;position:relative;">
                    <div style="width:200px;height:200px;border-radius:50%;background:linear-gradient(145deg,#1A5C42,#2E8B63);display:flex;align-items:center;justify-content:center;margin:0 auto;border:5px solid #fff;box-shadow:0 8px 32px rgba(13,61,46,0.2);">
                        <i class="fas fa-user-tie" style="font-size:6rem;color:rgba(184,115,51,0.55);"></i>
                    </div>
                    <div style="position:absolute;bottom:-8px;right:-8px;width:48px;height:48px;background:#B87333;border-radius:50%;display:flex;align-items:center;justify-content:center;border:3px solid #fff;">
                        <i class="fas fa-crown" style="color:#fff;font-size:0.9rem;"></i>
                    </div>
                </div>
                <h4 style="font-weight:800;color:#1C2B22;margin-top:1.5rem;margin-bottom:0.3rem;">Mr. Mahantesh Gangadhar Bhate</h4>
                <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.75rem;font-weight:700;padding:0.3rem 1rem;border-radius:20px;margin-bottom:0.5rem;">Chairman</span>
                <p style="color:#7A9485;font-size:0.85rem;margin:0;"><i class="fas fa-phone me-1" style="color:#B87333;"></i>9448349272</p>
            </div>

            <!-- Message -->
            <div class="col-lg-8">
                <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:0.3rem 0.9rem;border-radius:30px;margin-bottom:1rem;">Chairman's Message</span>
                <h2 style="font-size:1.9rem;font-weight:800;color:#1C2B22;margin-bottom:1.25rem;line-height:1.25;">We listen, while our<br><span style="color:#B87333;">Balance Sheet talks!</span></h2>

                <p style="color:#3D5A47;line-height:1.85;font-size:0.95rem;margin-bottom:1.5rem;">
                    We ended year <strong>2024-2025</strong> on a success note, with <strong>"A" grade in Audit remarks</strong>. It is indeed a proud moment to share â€” soon we will come up with our AGM-2024-25 dates. Download our Financial statements.
                </p>

                <div class="row g-3">
                    <?php
                    $chStats = [
                        ['num'=>'01','label'=>'Strong Financial Health','sub'=>'"A" Grade â€” Audit 2024-25', 'color'=>'#0D3D2E'],
                        ['num'=>'02','label'=>'Full Banking Services',  'sub'=>'Deposits, loans & transfers','color'=>'#1A5C42'],
                        ['num'=>'03','label'=>'Attractive Interest Rates','sub'=>'Best rates for members',   'color'=>'#B87333'],
                        ['num'=>'04','label'=>'Visit Nearest Branch',   'sub'=>'Chikodi, Belagavi Karnataka','color'=>'#8B5520'],
                    ];
                    foreach($chStats as $cs):
                    ?>
                    <div class="col-sm-6">
                        <div style="background:#F5F8F5;border:1px solid #D6E4DA;border-radius:12px;padding:1.25rem;display:flex;align-items:flex-start;gap:1rem;">
                            <div style="font-size:1.75rem;font-weight:800;color:<?php echo $cs['color']; ?>;line-height:1;flex-shrink:0;width:36px;"><?php echo $cs['num']; ?></div>
                            <div>
                                <div style="font-weight:700;color:#1C2B22;font-size:0.88rem;"><?php echo $cs['label']; ?></div>
                                <div style="color:#7A9485;font-size:0.78rem;margin-top:2px;"><?php echo $cs['sub']; ?></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</section>




<!-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     4. BOARD OF DIRECTORS
     â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<section style="background:#F5F8F5;padding:5rem 0;" id="board-of-directors">
    <div class="container-lg">
        <div class="text-center mb-5">
            <span style="display:inline-block;background:#fff;color:#0D3D2E;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:0.3rem 0.9rem;border-radius:30px;margin-bottom:1rem;">Governance</span>
            <h2 style="font-size:1.9rem;font-weight:800;color:#1C2B22;margin-bottom:0.5rem;">Board of Directors</h2>
            <p style="color:#7A9485;font-size:0.93rem;max-width:480px;margin:0 auto;">Our board comprises experienced professionals guiding the bank's vision and long-term operations.</p>
        </div>

        <div class="row g-4">
            <?php foreach ($board as $director): ?>
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;padding:1.75rem 1.25rem;text-align:center;height:100%;transition:box-shadow 0.2s,transform 0.2s;" onmouseover="this.style.boxShadow='0 8px 28px rgba(13,61,46,0.12)';this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='none';this.style.transform='none'">
                    <div style="width:72px;height:72px;border-radius:50%;background:linear-gradient(145deg,#0D3D2E,#2E8B63);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;border:3px solid #fff;box-shadow:0 4px 14px rgba(13,61,46,0.15);">
                        <i class="fas fa-user" style="color:rgba(184,115,51,0.7);font-size:1.6rem;"></i>
                    </div>
                    <h6 style="font-weight:700;color:#1C2B22;margin-bottom:0.3rem;font-size:0.9rem;"><?php echo htmlspecialchars($director['name']); ?></h6>
                    <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.72rem;font-weight:600;padding:0.2rem 0.65rem;border-radius:20px;margin-bottom:0.6rem;"><?php echo htmlspecialchars($director['position']); ?></span>
                    <?php if(!empty($director['phone'])): ?>
                    <p style="margin:0;">
                        <a href="tel:<?php echo htmlspecialchars($director['phone']); ?>" style="color:#7A9485;font-size:0.78rem;text-decoration:none;" onmouseover="this.style.color='#0D3D2E'" onmouseout="this.style.color='#7A9485'">
                            <i class="fas fa-phone me-1" style="color:#B87333;font-size:0.7rem;"></i><?php echo htmlspecialchars($director['phone']); ?>
                        </a>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>




<!-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     5. BOARD OF MANAGEMENT
     â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<section style="background:#fff;padding:5rem 0;" id="board-of-management">
    <div class="container-lg">
        <div class="text-center mb-5">
            <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:0.3rem 0.9rem;border-radius:30px;margin-bottom:1rem;">Management</span>
            <h2 style="font-size:1.9rem;font-weight:800;color:#1C2B22;margin-bottom:0.5rem;">Board of Management</h2>
            <p style="color:#7A9485;font-size:0.93rem;max-width:480px;margin:0 auto;">The management committee steering day-to-day operations of the bank.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <?php foreach ($bom as $member): ?>
            <div class="col-md-6 col-lg-4">
                <div style="background:#F5F8F5;border:1px solid #D6E4DA;border-top:4px solid #B87333;border-radius:14px;padding:2rem 1.5rem;text-align:center;height:100%;transition:box-shadow 0.2s;" onmouseover="this.style.boxShadow='0 8px 28px rgba(13,61,46,0.1)'" onmouseout="this.style.boxShadow='none'">
                    <div style="width:72px;height:72px;border-radius:50%;background:linear-gradient(145deg,#1A5C42,#2E8B63);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;border:3px solid #fff;box-shadow:0 4px 14px rgba(13,61,46,0.15);">
                        <i class="fas fa-user-tie" style="color:rgba(184,115,51,0.7);font-size:1.6rem;"></i>
                    </div>
                    <h6 style="font-weight:700;color:#1C2B22;margin-bottom:0.3rem;font-size:0.92rem;"><?php echo htmlspecialchars($member['name']); ?></h6>
                    <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.72rem;font-weight:600;padding:0.2rem 0.65rem;border-radius:20px;margin-bottom:0.6rem;"><?php echo htmlspecialchars($member['position']); ?></span>
                    <?php if(!empty($member['phone'])): ?>
                    <p style="margin:0;">
                        <a href="tel:<?php echo htmlspecialchars($member['phone']); ?>" style="color:#7A9485;font-size:0.78rem;text-decoration:none;" onmouseover="this.style.color='#0D3D2E'" onmouseout="this.style.color='#7A9485'">
                            <i class="fas fa-phone me-1" style="color:#B87333;font-size:0.7rem;"></i><?php echo htmlspecialchars($member['phone']); ?>
                        </a>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- 
     6. GENERAL MANAGER
     ═ -->
<section style="background:linear-gradient(150deg,#0D3D2E 0%,#1A5C42 100%);padding:5rem 0;" id="general-manager">
    <div class="container-lg">
        <div class="row g-5 align-items-center">

            <!-- Portrait -->
            <div class="col-lg-4 text-center">
                <div style="display:inline-block;position:relative;">
                    <div style="width:200px;height:200px;border-radius:50%;background:rgba(255,255,255,0.1);border:5px solid rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;margin:0 auto;box-shadow:0 8px 32px rgba(0,0,0,0.2);">
                        <i class="fas fa-user-tie" style="font-size:6rem;color:rgba(184,115,51,0.7);"></i>
                    </div>
                    <div style="position:absolute;bottom:-8px;right:-8px;width:48px;height:48px;background:#B87333;border-radius:50%;display:flex;align-items:center;justify-content:center;border:3px solid rgba(255,255,255,0.3);">
                        <i class="fas fa-briefcase" style="color:#fff;font-size:0.9rem;"></i>
                    </div>
                </div>
                <h4 style="font-weight:800;color:#fff;margin-top:1.5rem;margin-bottom:0.3rem;">Mr. Rajendra S Vandure</h4>
                <span style="display:inline-block;background:rgba(184,115,51,0.2);border:1px solid rgba(184,115,51,0.4);color:#B87333;font-size:0.75rem;font-weight:700;padding:0.3rem 1rem;border-radius:20px;">General Manager</span>
            </div>

            <!-- Message -->
            <div class="col-lg-8">
                <span style="display:inline-block;background:rgba(255,255,255,0.1);color:rgba(255,255,255,0.75);font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:0.3rem 0.9rem;border-radius:30px;margin-bottom:1rem;">General Manager's Message</span>
                <h2 style="font-size:1.9rem;font-weight:800;color:#fff;margin-bottom:1.25rem;line-height:1.25;">
                    Welcome <span style="color:#B87333;">dear customers!</span>
                </h2>

                <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);border-radius:14px;padding:1.5rem 1.75rem;margin-bottom:1.5rem;">
                    <p style="color:rgba(255,255,255,0.85);line-height:1.85;font-size:0.95rem;margin:0;">
                        I am excited to welcome you all to our Bank. I guarantee a realm of services to your complete Banking needs. Here I am always ready to help you. Reach me for any query you have — I will be happy to address them.
                    </p>
                </div>

                <div style="display:flex;flex-wrap:wrap;gap:0.75rem;margin-bottom:2rem;">
                    <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:10px;padding:0.75rem 1.1rem;display:flex;align-items:center;gap:0.6rem;">
                        <i class="fas fa-check-circle" style="color:#B87333;"></i>
                        <span style="color:#fff;font-size:0.85rem;font-weight:600;">Open to all enquiries</span>
                    </div>
                    <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:10px;padding:0.75rem 1.1rem;display:flex;align-items:center;gap:0.6rem;">
                        <i class="fas fa-check-circle" style="color:#B87333;"></i>
                        <span style="color:#fff;font-size:0.85rem;font-weight:600;">Customer-first approach</span>
                    </div>
                    <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:10px;padding:0.75rem 1.1rem;display:flex;align-items:center;gap:0.6rem;">
                        <i class="fas fa-check-circle" style="color:#B87333;"></i>
                        <span style="color:#fff;font-size:0.85rem;font-weight:600;">Transparent operations</span>
                    </div>
                </div>

                <a href="<?php echo SITE_URL; ?>pages/contact.php" style="display:inline-flex;align-items:center;gap:0.6rem;background:#B87333;color:#fff;padding:0.8rem 1.75rem;border-radius:8px;font-weight:700;font-size:0.9rem;text-decoration:none;" onmouseover="this.style.background='#CC8A4A'" onmouseout="this.style.background='#B87333'">
                    <i class="fas fa-envelope"></i> Get In Touch
                </a>
            </div>

        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
