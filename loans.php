<?php
/**
 * Loans Page
 * Information about personal, home, vehicle, and business loans
 */

require_once 'config.php';
require_once 'includes/helpers.php';

$page_title = 'Loans - ' . SITE_NAME;
$meta_description = 'Explore our loan products: Personal Loan, Home Loan, Vehicle Loan, and Business Loan';

?>
<?php include 'includes/header.php'; ?>

<!-- Page Header -->
<section style="background: linear-gradient(135deg, #1e3a8a 0%, #2d5a8c 100%); color: white; padding: 60px 0;">
    <div class="container">
        <h1 class="mb-2">Loan Products</h1>
        <p style="color: rgba(255, 255, 255, 0.9);">Flexible financing solutions tailored to your needs</p>
    </div>
</section>

<!-- Loans Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Personal Loan -->
            <div class="col-lg-6 mb-4 animate-on-scroll">
                <div class="card h-100">
                    <div style="background: linear-gradient(135deg, #3b82f6, #1e3a8a); padding: 2rem; color: white;">
                        <i class="fas fa-user-tie" style="font-size: 2.5rem; margin-bottom: 0.5rem; display: block;"></i>
                        <h4>Personal Loan</h4>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-3"><strong>Details:</strong></h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check" style="color: #10b981;"></i> Loan Amount: ₹1 Lakh to ₹25 Lakh</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #10b981;"></i> Interest Rate: 9.0% - 12.0% p.a.</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #10b981;"></i> Tenure: 1 to 7 years</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #10b981;"></i> Quick Approval (within 48 hours)</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #10b981;"></i> Minimal Documentation</li>
                        </ul>
                        <a href="contact.php" class="btn btn-primary w-100">Apply Now</a>
                    </div>
                </div>
            </div>

            <!-- Home Loan -->
            <div class="col-lg-6 mb-4 animate-on-scroll">
                <div class="card h-100">
                    <div style="background: linear-gradient(135deg, #10b981, #059669); padding: 2rem; color: white;">
                        <i class="fas fa-home" style="font-size: 2.5rem; margin-bottom: 0.5rem; display: block;"></i>
                        <h4>Home Loan</h4>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-3"><strong>Details:</strong></h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check" style="color: #3b82f6;"></i> Loan Amount: ₹5 Lakh to ₹1 Crore</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #3b82f6;"></i> Interest Rate: 6.5% - 8.0% p.a.</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #3b82f6;"></i> Tenure: Up to 20 years</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #3b82f6;"></i> Part Pre-payment Allowed</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #3b82f6;"></i> Easy Balance Transfer</li>
                        </ul>
                        <a href="contact.php" class="btn btn-success w-100">Apply Now</a>
                    </div>
                </div>
            </div>

            <!-- Vehicle Loan -->
            <div class="col-lg-6 mb-4 animate-on-scroll">
                <div class="card h-100">
                    <div style="background: linear-gradient(135deg, #f59e0b, #d97706); padding: 2rem; color: white;">
                        <i class="fas fa-car" style="font-size: 2.5rem; margin-bottom: 0.5rem; display: block;"></i>
                        <h4>Vehicle Loan</h4>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-3"><strong>Details:</strong></h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check" style="color: #ef4444;"></i> Loan Amount: ₹1 Lakh to ₹50 Lakh</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #ef4444;"></i> Interest Rate: 7.5% - 10.0% p.a.</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #ef4444;"></i> Tenure: 1 to 7 years</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #ef4444;"></i> 100% On-road Cost Financing</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #ef4444;"></i> Insurance & Registration Support</li>
                        </ul>
                        <a href="contact.php" class="btn btn-warning w-100">Apply Now</a>
                    </div>
                </div>
            </div>

            <!-- Business Loan -->
            <div class="col-lg-6 mb-4 animate-on-scroll">
                <div class="card h-100">
                    <div style="background: linear-gradient(135deg, #8b5cf6, #6d28d9); padding: 2rem; color: white;">
                        <i class="fas fa-briefcase" style="font-size: 2.5rem; margin-bottom: 0.5rem; display: block;"></i>
                        <h4>Business Loan</h4>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-3"><strong>Details:</strong></h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check" style="color: #06b6d4;"></i> Loan Amount: ₹2 Lakh to ₹2 Crore</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #06b6d4;"></i> Interest Rate: 8.0% - 12.0% p.a.</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #06b6d4;"></i> Tenure: 1 to 10 years</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #06b6d4;"></i> Working Capital Loans</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #06b6d4;"></i> Flexible Repayment Options</li>
                        </ul>
                        <a href="contact.php" class="btn btn-info w-100">Apply Now</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- EMI Calculator -->
        <div class="row mt-5">
            <div class="col-lg-8 mx-auto">
                <div class="card" style="border-left: 4px solid #3b82f6;">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-calculator me-2"></i>EMI Calculator</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="loanAmount" class="form-label">Loan Amount (₹)</label>
                                <input type="number" class="form-control" id="loanAmount" placeholder="Enter amount" min="100000" step="10000">
                            </div>
                            <div class="col-md-4">
                                <label for="interestRate" class="form-label">Interest Rate (% p.a.)</label>
                                <input type="number" class="form-control" id="interestRate" placeholder="Enter rate" min="0" max="20" step="0.1" value="10">
                            </div>
                            <div class="col-md-4">
                                <label for="loanTenure" class="form-label">Loan Tenure (Months)</label>
                                <input type="number" class="form-control" id="loanTenure" placeholder="Enter months" min="1" max="240" step="1" value="60">
                            </div>
                        </div>
                        <div id="emiResult" class="mt-4"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loan Process -->
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="mb-4">Loan Application Process</h3>
                <div class="row">
                    <div class="col-md-3 mb-4 text-center animate-on-scroll">
                        <div style="background: #f0f9ff; padding: 2rem; border-radius: 0.5rem; height: 100%;">
                            <div style="background: linear-gradient(135deg, #3b82f6, #1e3a8a); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; margin: 0 auto 1rem;">
                                <i class="fas fa-list-check"></i>
                            </div>
                            <h5>1. Application</h5>
                            <p class="text-muted">Fill in the loan application form with required details</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 text-center animate-on-scroll">
                        <div style="background: #f0fdf4; padding: 2rem; border-radius: 0.5rem; height: 100%;">
                            <div style="background: linear-gradient(135deg, #10b981, #059669); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; margin: 0 auto 1rem;">
                                <i class="fas fa-file-check"></i>
                            </div>
                            <h5>2. Document Verification</h5>
                            <p class="text-muted">Submit required documents for verification</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 text-center animate-on-scroll">
                        <div style="background: #fef9e7; padding: 2rem; border-radius: 0.5rem; height: 100%;">
                            <div style="background: linear-gradient(135deg, #f59e0b, #d97706); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; margin: 0 auto 1rem;">
                                <i class="fas fa-check"></i>
                            </div>
                            <h5>3. Approval</h5>
                            <p class="text-muted">Loan approval within 48-72 hours</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 text-center animate-on-scroll">
                        <div style="background: #fef2f2; padding: 2rem; border-radius: 0.5rem; height: 100%;">
                            <div style="background: linear-gradient(135deg, #ef4444, #dc2626); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; margin: 0 auto 1rem;">
                                <i class="fas fa-money-bill"></i>
                            </div>
                            <h5>4. Disbursement</h5>
                            <p class="text-muted">Funds transferred to your account</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
