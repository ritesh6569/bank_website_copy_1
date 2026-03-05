<?php
/**
 * About Us Page - Shri Shantappanna Miraji Urban Co-op. Bank Ltd.
 */

$page_title = 'About Us - Miraji Bank';
$current_page = 'about';

include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/data-fetcher.php';
include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/notices-fetcher.php';

$leadership = $data_fetcher->getLeadership();
$board = $data_fetcher->getBoardOfDirectors();
$bom = $data_fetcher->getBoardOfManagement();
$notices = getActiveNotices();
?>

    <!-- Notices Alert Banner -->
    <?php if (!empty($notices)): 
        $latest_notice = $notices[0];
    ?>
    <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert" style="border-radius: 0; border-left: 5px solid #f59e0b;">
        <div class="container-lg">
            <div class="d-flex align-items-center">
                <i class="fas fa-bell me-3" style="font-size: 1.25rem; color: #d97706;"></i>
                <div style="flex: 1;">
                    <strong style="color: #92400e;">Important Notice:</strong>
                    <span class="ms-2" style="color: #b45309;">
                        <?php echo htmlspecialchars($latest_notice['title']); ?>
                    </span>
                    <a href="#" class="ms-2" data-bs-toggle="modal" data-bs-target="#noticeModalLatest" style="color: #1e40af; font-weight: 600;">
                        Read More →
                    </a>
                </div>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <!-- Latest Notice Modal -->
    <div class="modal fade" id="noticeModalLatest" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); color: white; border: none;">
                    <h5 class="modal-title">
                        <i class="fas fa-bell me-2"></i><?php echo htmlspecialchars($latest_notice['title']); ?>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <small class="text-muted d-block mb-3">
                        <i class="fas fa-calendar-alt me-1"></i>Published on <?php echo formatNoticeDate($latest_notice['date_published']); ?>
                    </small>
                    <div class="notice-content">
                        <?php echo $latest_notice['content']; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Page Header -->
    <div class="page-header">
        <i class="fas fa-university page-header-icon"></i>
        <div class="container-lg">
            <span class="page-header-eyebrow"><i class="fas fa-circle-dot"></i> About Us</span>
            <h1>Shri Shantappanna Miraji Urban Co-op. Bank Ltd.</h1>
            <p>Chikodi, Belagavi Karnataka — Serving the community since 1961</p>
        </div>
    </div>

    <!-- Sub-navigation -->
    <div style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; position: sticky; top: 56px; z-index: 100;">
        <div class="container-lg">
            <nav class="nav nav-pills flex-nowrap overflow-auto py-2 gap-2">
                <a class="nav-link btn btn-sm btn-outline-primary" href="#the-bank">The Bank</a>
                <a class="nav-link btn btn-sm btn-outline-primary" href="#our-founder">Our Founder</a>
                <a class="nav-link btn btn-sm btn-outline-primary" href="#chairman">Chairman</a>
                <a class="nav-link btn btn-sm btn-outline-primary" href="#board-of-directors">Board of Directors</a>
                <a class="nav-link btn btn-sm btn-outline-primary" href="#board-of-management">Board of Management</a>
                <a class="nav-link btn btn-sm btn-outline-primary" href="#general-manager">General Manager</a>
            </nav>
        </div>
    </div>

    <!-- ===================== THE BANK ===================== -->
    <section class="section" id="the-bank">
        <div class="container-lg">
            <div class="section-title">
                <span class="text-primary small text-uppercase fw-bold letter-spacing">About Us</span>
                <h2>The Bank</h2>
            </div>
            <div class="row align-items-start g-4">
                <div class="col-lg-8">
                    <h4 class="mb-3" style="color: var(--primary-color);">The Zeal and Vision</h4>
                    <p>It was owing to the abounding zeal and vision of our Founder Shri. Shantappanna Miraji — realizing the need of Banking service to the local area and surrounding Rural area — thereby benefitting our customers, the Bank achieved commendable faith with honest effort.</p>

                    <h4 class="mt-4 mb-3" style="color: var(--primary-color);">Being Shri Shantappanna Miraji Urban Co-op. Bank Ltd.</h4>
                    <p>Soon after the establishment of Shri Shantappanna Miraji Urban Coop Bank Ltd. Chikodi, the founding pillar Shri. Shantappanna Miraji fully involved himself in energizing the Co-operative Movement in Chikodi, Karnataka, more so the Urban Co-operative Banking Movement. He was the Promoting President of our Bank.</p>
                    <p>Bank has continued to register a steady growth in business and earnings. The then management of the bank realized the vital need of the Bank to extend its area of operation so as to carry Banking business in the whole district. Speaking to the need of the issue in its own style with deep faith, vision, optimism &amp; entrepreneurial skill is the key of Board of Management.</p>
                    <p>Our Bank vision is to help customers achieve economic success and financial security, thereby building vibrant and prosperous communities, sustained by values of integrity and good governance.</p>
                </div>
                <div class="col-lg-4">
                    <div class="card" style="border-left: 4px solid var(--secondary-color);">
                        <div class="card-body">
                            <h5><i class="fas fa-bullseye text-primary me-2"></i>Our Vision</h5>
                            <p class="text-muted small">To help customers achieve economic success and financial security, building vibrant and prosperous communities through integrity and good governance.</p>
                        </div>
                    </div>
                    <div class="card mt-3" style="border-left: 4px solid var(--success-color);">
                        <div class="card-body">
                            <h5><i class="fas fa-calendar text-success me-2"></i>Founded</h5>
                            <p class="text-muted small mb-0">Established in <strong>1961</strong> in Chikodi, Belagavi, Karnataka by Shri Shantappanna Miraji. Now over <strong>65 years</strong> of trusted banking.</p>
                        </div>
                    </div>
                    <div class="card mt-3" style="border-left: 4px solid var(--warning-color);">
                        <div class="card-body">
                            <h5><i class="fas fa-map-marker-alt text-warning me-2"></i>Head Office</h5>
                            <p class="text-muted small mb-0">944-945, Guruwar Peth Chikodi,<br>Belagavi, Karnataka 591201</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================== OUR FOUNDER ===================== -->
    <section class="section bg-light" id="our-founder">
        <div class="container-lg">
            <div class="section-title">
                <span class="text-primary small text-uppercase fw-bold">About Us</span>
                <h2>Our Founder</h2>
            </div>
            <div class="row align-items-center g-4">
                <div class="col-md-3 text-center">
                    <div style="width: 200px; height: 200px; background-color: var(--light-bg); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; border: 4px solid var(--secondary-color);">
                        <i class="fas fa-user-circle" style="font-size: 120px; color: var(--secondary-color);"></i>
                    </div>
                    <h5 class="mt-3">Late Shri Shantappanna Miraji</h5>
                    <p class="text-muted fst-italic">"Pratham Sahakara Ratna"<br><small>Founder — 1961</small></p>
                </div>
                <div class="col-md-9">
                    <div class="alert alert-primary mb-3" style="border-left: 4px solid var(--secondary-color); background: rgba(30, 64, 175, 0.05);">
                        <strong>"FOUNDER — Pratham Sahakara Ratna"</strong>
                    </div>
                    <p>A Leading Cooperative Bank of the Belagavi district was founded by visionary and positive thinker Shri Shantapannaji in <strong>1961</strong> to cater to the Banking needs of a common man. He was a true co-operator who established and developed the Bank on the true co-operative principles.</p>
                    <p>It is proud to say that he had done the so-called <strong>"Financial Inclusion"</strong> 61 years back by opening branches in Rural areas with less than 1000 population. He is the first person to open the Branch at Belagavi which was commented upon by many, but releasing the potential, others opened Branches in nook and corners of Belagavi.</p>
                    <p>It is really worth mentioning that he is one of the most uncommon leaders who had never added any single penny to his wealth but spent almost all his share of wealth and life for the growth of the society by establishing many co-operative, Educational, Social and Charitable Institutions which have become role models to others.</p>
                    <p>His services to the society were non-communal, non-political. Many of the so-called politicians, industrialists, businessmen, educationalists, and social workers of today are either his followers or have taken help and inspiration from him. Therefore he was a ladder to other leaders. Even his political rivals accept his selflessness and goodness.</p>
                    <p><em>So he always deserves to be the Fore Father of many values essential for social life.</em></p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================== CHAIRMAN ===================== -->
    <section class="section" id="chairman">
        <div class="container-lg">
            <div class="section-title">
                <span class="text-primary small text-uppercase fw-bold">About Us</span>
                <h2>Chairman</h2>
            </div>
            <div class="row align-items-center g-4">
                <div class="col-md-3 text-center">
                    <div style="width: 200px; height: 200px; background-color: var(--light-bg); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; border: 4px solid var(--secondary-color);">
                        <i class="fas fa-user-tie" style="font-size: 100px; color: var(--secondary-color);"></i>
                    </div>
                    <h5 class="mt-3">Mr. Mahantesh Gangadhar Bhate</h5>
                    <p class="text-muted">Chairman<br><small><i class="fas fa-phone me-1"></i>9448349272</small></p>
                </div>
                <div class="col-md-9">
                    <blockquote class="blockquote mb-4" style="border-left: 4px solid var(--secondary-color); padding-left: 1.5rem;">
                        <p class="fs-5 fst-italic">"We listen, while our Balance Sheet talks!"</p>
                    </blockquote>
                    <p>We ended year <strong>2024-2025</strong> on a success note, with <strong>"A" grade in Audit remarks</strong>. It is indeed a proud moment to share — soon we will come up with our AGM-2024-25 dates. Download our Financial statements.</p>
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6">
                            <div class="card text-center p-3" style="border-top: 3px solid var(--secondary-color);">
                                <div style="font-size: 2rem; color: var(--secondary-color);">01</div>
                                <strong>Strong Financial Health</strong>
                                <p class="small text-muted mb-0 mt-1">"A" Grade — Audit 2024-25</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card text-center p-3" style="border-top: 3px solid var(--success-color);">
                                <div style="font-size: 2rem; color: var(--success-color);">02</div>
                                <strong>Services</strong>
                                <p class="small text-muted mb-0 mt-1">Comprehensive banking services</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card text-center p-3" style="border-top: 3px solid var(--warning-color);">
                                <div style="font-size: 2rem; color: var(--warning-color);">03</div>
                                <strong>Attractive Rate Of Interest</strong>
                                <p class="small text-muted mb-0 mt-1">Competitive rates on deposits & loans</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card text-center p-3" style="border-top: 3px solid var(--danger-color);">
                                <div style="font-size: 2rem; color: var(--danger-color);">04</div>
                                <strong>Visit Nearest Branch</strong>
                                <p class="small text-muted mb-0 mt-1">Chikodi, Belagavi Karnataka</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================== BOARD OF DIRECTORS ===================== -->
    <section class="section bg-light" id="board-of-directors">
        <div class="container-lg">
            <div class="section-title">
                <span class="text-primary small text-uppercase fw-bold">About Us</span>
                <h2>Board of Directors</h2>
                <p class="section-subtitle">Our board comprises experienced professionals guiding the bank's vision and operations</p>
            </div>
            
            <div class="row g-4">
                <?php foreach ($board as $director): ?>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card h-100 text-center">
                            <div class="card-body">
                                <div style="width: 80px; height: 80px; background-color: var(--light-bg); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; border: 2px solid var(--secondary-color);">
                                    <i class="fas fa-user" style="font-size: 36px; color: var(--secondary-color);"></i>
                                </div>
                                <h6 class="card-title mb-1"><?php echo htmlspecialchars($director['name']); ?></h6>
                                <p class="text-muted small mb-1"><?php echo htmlspecialchars($director['position']); ?></p>
                                <?php if (!empty($director['phone'])): ?>
                                    <p class="small mb-0">
                                        <a href="tel:<?php echo htmlspecialchars($director['phone']); ?>" class="text-decoration-none text-muted">
                                            <i class="fas fa-phone me-1" style="font-size:0.75rem;"></i><?php echo htmlspecialchars($director['phone']); ?>
                                        </a>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ===================== BOARD OF MANAGEMENT ===================== -->
    <section class="section" id="board-of-management">
        <div class="container-lg">
            <div class="section-title">
                <span class="text-primary small text-uppercase fw-bold">About Us</span>
                <h2>Board of Management</h2>
                <p class="section-subtitle">The management committee steering day-to-day operations of the bank</p>
            </div>
            
            <div class="row g-4 justify-content-center">
                <?php foreach ($bom as $member): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 text-center" style="border-top: 3px solid var(--secondary-color);">
                            <div class="card-body">
                                <div style="width: 80px; height: 80px; background-color: var(--light-bg); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                                    <i class="fas fa-user-tie" style="font-size: 36px; color: var(--secondary-color);"></i>
                                </div>
                                <h6 class="card-title mb-1"><?php echo htmlspecialchars($member['name']); ?></h6>
                                <p class="text-muted small mb-1"><?php echo htmlspecialchars($member['position']); ?></p>
                                <?php if (!empty($member['phone'])): ?>
                                    <p class="small mb-0">
                                        <a href="tel:<?php echo htmlspecialchars($member['phone']); ?>" class="text-decoration-none text-muted">
                                            <i class="fas fa-phone me-1" style="font-size:0.75rem;"></i><?php echo htmlspecialchars($member['phone']); ?>
                                        </a>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ===================== GENERAL MANAGER ===================== -->
    <section class="section bg-light" id="general-manager">
        <div class="container-lg">
            <div class="section-title">
                <span class="text-primary small text-uppercase fw-bold">About Us</span>
                <h2>General Manager</h2>
            </div>
            <div class="row align-items-center g-4">
                <div class="col-md-3 text-center">
                    <div style="width: 200px; height: 200px; background-color: var(--light-bg); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; border: 4px solid var(--secondary-color);">
                        <i class="fas fa-user-tie" style="font-size: 100px; color: var(--secondary-color);"></i>
                    </div>
                    <h5 class="mt-3">Mr. Rajendra S Vandure</h5>
                    <p class="text-muted">General Manager</p>
                </div>
                <div class="col-md-9">
                    <blockquote class="blockquote mb-4" style="border-left: 4px solid var(--secondary-color); padding-left: 1.5rem;">
                        <p class="fs-5 fst-italic">"Welcome dear customers!"</p>
                    </blockquote>
                    <p>I am excited to welcome you all to our Bank. I guarantee a realm of services to your complete Banking needs. Here I am always ready to help you. Reach me for any query you have — I will be happy to address them.</p>
                    <a href="/bank-website-grok/pages/contact.php" class="btn btn-primary mt-2">
                        <i class="fas fa-envelope me-2"></i>Get In Touch
                    </a>
                </div>
            </div>
        </div>
    </section>

<?php
// Include footer
include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/footer.php';
?>