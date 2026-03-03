<?php
/**
 * About Us Page
 * Company information, leadership, and history
 */

require_once 'config.php';
require_once 'includes/helpers.php';

$page_title = 'About Us - ' . SITE_NAME;
$meta_description = 'Learn about ' . SITE_NAME . ', our mission, history, and leadership team';

?>
<?php include 'includes/header.php'; ?>

<!-- Page Header -->
<section style="background: linear-gradient(135deg, #1e3a8a 0%, #2d5a8c 100%); color: white; padding: 60px 0;">
    <div class="container">
        <h1 class="mb-2">About Us</h1>
        <p style="color: rgba(255, 255, 255, 0.9);">Trusted banking partner since establishment</p>
    </div>
</section>

<!-- About Content -->
<section class="py-5">
    <div class="container">
        <!-- The Bank Section -->
        <div class="row mb-5 animate-on-scroll">
            <div class="col-lg-8">
                <h3 class="mb-4">The Bank</h3>
                <p class="lead">Shantappanna Miraj Bank has been serving the community with excellence and integrity for decades. We are committed to providing innovative financial solutions and exceptional customer service.</p>
                
                <h5 class="mb-3 mt-4">Our Mission</h5>
                <p>To be the most trusted financial institution, providing comprehensive banking solutions with a customer-centric approach, ensuring sustainable growth and value creation for all stakeholders.</p>

                <h5 class="mb-3 mt-4">Our Vision</h5>
                <p>To create a financial ecosystem that empowers individuals and businesses to achieve their goals through innovative, secure, and accessible banking services.</p>

                <h5 class="mb-3 mt-4">Our Values</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-heart" style="color: #ef4444; margin-right: 0.5rem;"></i><strong>Integrity:</strong> We conduct business with utmost honesty and transparency</li>
                    <li class="mb-2"><i class="fas fa-handshake" style="color: #10b981; margin-right: 0.5rem;"></i><strong>Customer Focus:</strong> Your satisfaction is our priority</li>
                    <li class="mb-2"><i class="fas fa-star" style="color: #f59e0b; margin-right: 0.5rem;"></i><strong>Excellence:</strong> We strive for the highest standards in everything we do</li>
                    <li class="mb-2"><i class="fas fa-shield-alt" style="color: #3b82f6; margin-right: 0.5rem;"></i><strong>Security:</strong> Your financial security is paramount</li>
                </ul>
            </div>
            <div class="col-lg-4">
                <div style="background: linear-gradient(135deg, #dbeafe, #eff6ff); padding: 2rem; border-radius: 0.5rem; height: 100%;">
                    <i class="fas fa-building" style="font-size: 5rem; color: #3b82f6; opacity: 0.3; display: block; text-align: center;"></i>
                </div>
            </div>
        </div>

        <!-- Leadership Team -->
        <div class="row mb-5">
            <div class="col-12">
                <h3 class="mb-4">Leadership Team</h3>
            </div>

            <!-- Founder -->
            <div class="col-md-6 mb-4 animate-on-scroll" id="founder">
                <div class="card h-100">
                    <div style="background: linear-gradient(135deg, #f59e0b, #d97706); height: 150px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user-circle" style="font-size: 4rem; color: white;"></i>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">Founder & Chairman Emeritus</h5>
                        <p class="text-muted mb-3">Shantappanna Nair</p>
                        <p style="font-size: 0.9rem; color: #666;">With a vision to revolutionize banking, Shantappanna founded this institution with core values of integrity and customer service. His leadership established the foundation for our continued success.</p>
                    </div>
                </div>
            </div>

            <!-- Chairman -->
            <div class="col-md-6 mb-4 animate-on-scroll" id="chairman">
                <div class="card h-100">
                    <div style="background: linear-gradient(135deg, #3b82f6, #1e3a8a); height: 150px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user-tie" style="font-size: 4rem; color: white;"></i>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">Chairman & MD</h5>
                        <p class="text-muted mb-3">Arjun Sharma</p>
                        <p style="font-size: 0.9rem; color: #666;">Leading the bank with innovative strategies and digital transformation, Arjun brings decades of banking expertise and a commitment to excellence in every aspect of our operations.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Board of Directors -->
        <div class="row mb-5" id="board">
            <div class="col-12">
                <h3 class="mb-4">Board of Directors</h3>
            </div>
            <div class="col-md-4 mb-4 animate-on-scroll">
                <div class="card text-center">
                    <div style="background: #f0f9ff; padding: 2rem;">
                        <i class="fas fa-user" style="font-size: 2.5rem; color: #3b82f6;"></i>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Rajesh Kumar</h6>
                        <p class="text-muted" style="font-size: 0.9rem;">Independent Director & Audit Committee Chairman</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4 animate-on-scroll">
                <div class="card text-center">
                    <div style="background: #f0fdf4; padding: 2rem;">
                        <i class="fas fa-user" style="font-size: 2.5rem; color: #10b981;"></i>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Priya Desai</h6>
                        <p class="text-muted" style="font-size: 0.9rem;">Executive Director & COO</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4 animate-on-scroll">
                <div class="card text-center">
                    <div style="background: #fef9e7; padding: 2rem;">
                        <i class="fas fa-user" style="font-size: 2.5rem; color: #f59e0b;"></i>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Vikram Singh</h6>
                        <p class="text-muted" style="font-size: 0.9rem;">Independent Director</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- General Manager -->
        <div class="row animate-on-scroll">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div style="background: linear-gradient(135deg, #8b5cf6, #6d28d9); height: 150px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-briefcase" style="font-size: 4rem; color: white;"></i>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">General Manager</h5>
                        <p class="text-muted mb-3">Anita Menon</p>
                        <p style="font-size: 0.9rem; color: #666;">As General Manager, Anita oversees day-to-day operations, ensures regulatory compliance, and drives our customer-first initiatives across all branches and departments.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
