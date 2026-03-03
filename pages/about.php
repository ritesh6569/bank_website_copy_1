<?php
/**
 * About Us Page - Professional Bank Website
 */

$page_title = 'About Us - Professional Bank';
$current_page = 'about';

include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/data-fetcher.php';

$leadership = $data_fetcher->getLeadership();
$board = $data_fetcher->getBoardOfDirectors();
?>

    <!-- Page Header -->
    <div class="bg-primary text-white py-5">
        <div class="container-lg">
            <h1 class="mb-2">About Professional Bank</h1>
            <p class="lead">Learn more about our rich history, leadership, and commitment to excellence</p>
        </div>
    </div>

    <!-- The Bank Section -->
    <section class="section">
        <div class="container-lg">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <h2 class="mb-4">Our Story</h2>
                    <p>Professional Bank was founded in 1995 with a vision to revolutionize banking services in the region. Over the past three decades, we have grown from a single branch to a multi-location financial institution serving thousands of satisfied customers.</p>
                    <p>Our commitment to excellence, innovation, and customer satisfaction has made us a trusted name in banking. We believe in combining traditional banking values with modern technology to provide the best banking experience.</p>
                    <h4 class="mt-4 mb-3">Our Mission</h4>
                    <p>"To be the most trusted banking partner, delivering innovative financial solutions that empower individuals and businesses to achieve their dreams."</p>
                    <h4 class="mt-4 mb-3">Our Values</h4>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="d-flex">
                                <i class="fas fa-check-circle text-success me-3" style="margin-top: 3px;"></i>
                                <div>
                                    <strong>Trust</strong>
                                    <p class="small text-muted mb-0">Built on integrity and transparency</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex">
                                <i class="fas fa-check-circle text-success me-3" style="margin-top: 3px;"></i>
                                <div>
                                    <strong>Innovation</strong>
                                    <p class="small text-muted mb-0">Embracing modern technology</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex">
                                <i class="fas fa-check-circle text-success me-3" style="margin-top: 3px;"></i>
                                <div>
                                    <strong>Excellence</strong>
                                    <p class="small text-muted mb-0">Delivering superior service</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex">
                                <i class="fas fa-check-circle text-success me-3" style="margin-top: 3px;"></i>
                                <div>
                                    <strong>Community</strong>
                                    <p class="small text-muted mb-0">Supporting local growth</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <img src="/bank-website-grok/assets/images/bank-building.jpg" alt="Professional Bank Building" class="card-img-top" style="height: 400px; background-color: var(--light-bg); display: flex; align-items: center; justify-content: center;">
                        <div style="height: 400px; background-color: var(--light-bg); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-university" style="font-size: 8rem; color: var(--secondary-color); opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Leadership Section -->
    <section class="section bg-light">
        <div class="container-lg">
            <div class="section-title">
                <h2>Leadership Team</h2>
                <p class="section-subtitle">Meet the visionary leaders steering Professional Bank</p>
            </div>
            
            <!-- Tabs for Leadership -->
            <ul class="nav nav-tabs mb-4" id="leadershipTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="founder-tab" data-bs-toggle="tab" data-bs-target="#founder" type="button" role="tab" aria-controls="founder" aria-selected="true">Founder</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="chairman-tab" data-bs-toggle="tab" data-bs-target="#chairman" type="button" role="tab" aria-controls="chairman" aria-selected="false">Chairman & CEO</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="gm-tab" data-bs-toggle="tab" data-bs-target="#gm" type="button" role="tab" aria-controls="gm" aria-selected="false">General Manager</button>
                </li>
            </ul>
            
            <!-- Tab Content -->
            <div class="tab-content" id="leadershipTabsContent">
                <!-- Founder -->
                <div class="tab-pane fade show active" id="founder" role="tabpanel" aria-labelledby="founder-tab">
                    <div class="row align-items-center g-4">
                        <div class="col-md-4 text-center">
                            <div style="width: 250px; height: 250px; background-color: var(--light-bg); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                <i class="fas fa-user-circle" style="font-size: 150px; color: var(--secondary-color);"></i>
                            </div>
                            <h4 class="mt-3"><?php echo htmlspecialchars($leadership['founder']['name']); ?></h4>
                            <p class="text-muted"><?php echo htmlspecialchars($leadership['founder']['title']); ?></p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo htmlspecialchars($leadership['founder']['bio']); ?></p>
                            <h5>Key Achievements</h5>
                            <ul>
                                <li>Founded the bank with a revolutionary vision for modern banking</li>
                                <li>Expanded the bank to 20+ branches across multiple cities</li>
                                <li>Recognized as Banking Entrepreneur of the Year (2005)</li>
                                <li>Established comprehensive corporate social responsibility programs</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Chairman -->
                <div class="tab-pane fade" id="chairman" role="tabpanel" aria-labelledby="chairman-tab">
                    <div class="row align-items-center g-4">
                        <div class="col-md-4 text-center">
                            <div style="width: 250px; height: 250px; background-color: var(--light-bg); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                <i class="fas fa-user-circle" style="font-size: 150px; color: var(--secondary-color);"></i>
                            </div>
                            <h4 class="mt-3"><?php echo htmlspecialchars($leadership['chairman']['name']); ?></h4>
                            <p class="text-muted"><?php echo htmlspecialchars($leadership['chairman']['title']); ?></p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo htmlspecialchars($leadership['chairman']['bio']); ?></p>
                            <h5>Key Achievements</h5>
                            <ul>
                                <li>Led digital transformation of the bank's operations</li>
                                <li>Increased customer base by 40% under her leadership</li>
                                <li>Introduced AI-powered customer service solutions</li>
                                <li>Recognized as Most Influential Woman in Banking (2023)</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- General Manager -->
                <div class="tab-pane fade" id="gm" role="tabpanel" aria-labelledby="gm-tab">
                    <div class="row align-items-center g-4">
                        <div class="col-md-4 text-center">
                            <div style="width: 250px; height: 250px; background-color: var(--light-bg); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                <i class="fas fa-user-circle" style="font-size: 150px; color: var(--secondary-color);"></i>
                            </div>
                            <h4 class="mt-3"><?php echo htmlspecialchars($leadership['general_manager']['name']); ?></h4>
                            <p class="text-muted"><?php echo htmlspecialchars($leadership['general_manager']['title']); ?></p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo htmlspecialchars($leadership['general_manager']['bio']); ?></p>
                            <h5>Key Achievements</h5>
                            <ul>
                                <li>Streamlined operations and improved efficiency by 30%</li>
                                <li>Managed expansion to 10 new branches in 3 years</li>
                                <li>Enhanced risk management protocols and compliance</li>
                                <li>Award recipient for Operational Excellence (2022)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Board of Directors -->
    <section class="section">
        <div class="container-lg">
            <div class="section-title">
                <h2>Board of Directors</h2>
                <p class="section-subtitle">Our board comprises experienced professionals from diverse backgrounds</p>
            </div>
            
            <div class="row g-4">
                <?php foreach ($board as $director): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <div style="width: 120px; height: 120px; background-color: var(--light-bg); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                                    <i class="fas fa-user-circle" style="font-size: 80px; color: var(--secondary-color);"></i>
                                </div>
                                <h5 class="card-title"><?php echo htmlspecialchars($director['name']); ?></h5>
                                <p class="text-muted"><?php echo htmlspecialchars($director['position']); ?></p>
                                <p class="small"><?php echo htmlspecialchars($director['qualification']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Milestones Section -->
    <section class="section bg-light">
        <div class="container-lg">
            <div class="section-title">
                <h2>Our Journey & Milestones</h2>
                <p class="section-subtitle">Celebrating our growth and achievements</p>
            </div>
            
            <!-- Timeline -->
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card border-left" style="border-left: 4px solid var(--secondary-color);">
                        <div class="card-body">
                            <h5 class="card-title">1995 - Founded</h5>
                            <p class="card-text text-muted">Professional Bank established with a vision to revolutionize banking services with a single branch in the city.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card border-left" style="border-left: 4px solid var(--success-color);">
                        <div class="card-body">
                            <h5 class="card-title">2005 - Expansion</h5>
                            <p class="card-text text-muted">Opened 10 branches across the region, becoming a recognized player in the banking sector.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card border-left" style="border-left: 4px solid var(--warning-color);">
                        <div class="card-body">
                            <h5 class="card-title">2015 - Digital Transformation</h5>
                            <p class="card-text text-muted">Launched comprehensive digital banking services including mobile app and online banking platform.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card border-left" style="border-left: 4px solid var(--danger-color);">
                        <div class="card-body">
                            <h5 class="card-title">2024 - Present</h5>
                            <p class="card-text text-muted">Serving 500,000+ customers with 25+ branches and cutting-edge banking solutions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
// Include footer
include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/footer.php';
?>
