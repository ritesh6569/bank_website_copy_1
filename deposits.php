<?php
/**
 * Deposits Page
 * Information about savings, current, fixed, and recurring deposits
 */

require_once 'config.php';
require_once 'includes/helpers.php';

$page_title = 'Deposits - ' . SITE_NAME;
$meta_description = 'Explore our deposit products: Savings Account, Current Account, Fixed Deposit, and Recurring Deposit';

?>
<?php include 'includes/header.php'; ?>

<!-- Page Header -->
<section style="background: linear-gradient(135deg, #1e3a8a 0%, #2d5a8c 100%); color: white; padding: 60px 0;">
    <div class="container">
        <h1 class="mb-2">Deposit Products</h1>
        <p style="color: rgba(255, 255, 255, 0.9);">Safe, secure, and profitable savings solutions for you</p>
    </div>
</section>

<!-- Deposits Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Savings Account -->
            <div class="col-lg-6 mb-4 animate-on-scroll">
                <div class="card h-100">
                    <div style="background: linear-gradient(135deg, #3b82f6, #1e3a8a); padding: 2rem; color: white;">
                        <i class="fas fa-piggy-bank" style="font-size: 2.5rem; margin-bottom: 0.5rem; display: block;"></i>
                        <h4>Savings Account</h4>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-3"><strong>Features:</strong></h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check" style="color: #10b981;"></i> Interest Rate: 4.5% - 5.0% p.a.</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #10b981;"></i> Minimum Balance: ₹5,000</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #10b981;"></i> ATM/Debit Card Facility</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #10b981;"></i> Internet Banking Access</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #10b981;"></i> Unlimited Transactions</li>
                        </ul>
                        <a href="contact.php" class="btn btn-primary w-100">Open Account</a>
                    </div>
                </div>
            </div>

            <!-- Current Account -->
            <div class="col-lg-6 mb-4 animate-on-scroll">
                <div class="card h-100">
                    <div style="background: linear-gradient(135deg, #10b981, #059669); padding: 2rem; color: white;">
                        <i class="fas fa-briefcase" style="font-size: 2.5rem; margin-bottom: 0.5rem; display: block;"></i>
                        <h4>Current Account</h4>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-3"><strong>Features:</strong></h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check" style="color: #3b82f6;"></i> No Interest</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #3b82f6;"></i> Minimum Balance: ₹10,000</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #3b82f6;"></i> Unlimited Transactions</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #3b82f6;"></i> Check Book Facility</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #3b82f6;"></i> Overdraft Facility Available</li>
                        </ul>
                        <a href="contact.php" class="btn btn-success w-100">Apply Now</a>
                    </div>
                </div>
            </div>

            <!-- Fixed Deposit -->
            <div class="col-lg-6 mb-4 animate-on-scroll">
                <div class="card h-100">
                    <div style="background: linear-gradient(135deg, #f59e0b, #d97706); padding: 2rem; color: white;">
                        <i class="fas fa-lock" style="font-size: 2.5rem; margin-bottom: 0.5rem; display: block;"></i>
                        <h4>Fixed Deposit</h4>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-3"><strong>Features:</strong></h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check" style="color: #ef4444;"></i> Interest Rate: 6.0% - 7.5% p.a.</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #ef4444;"></i> Flexible Tenure: 7 days to 10 years</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #ef4444;"></i> Minimum Amount: ₹10,000</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #ef4444;"></i> Assured Returns</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #ef4444;"></i> Premature Withdrawal Available</li>
                        </ul>
                        <a href="contact.php" class="btn btn-warning w-100">Apply Now</a>
                    </div>
                </div>
            </div>

            <!-- Recurring Deposit -->
            <div class="col-lg-6 mb-4 animate-on-scroll">
                <div class="card h-100">
                    <div style="background: linear-gradient(135deg, #8b5cf6, #6d28d9); padding: 2rem; color: white;">
                        <i class="fas fa-chart-line" style="font-size: 2.5rem; margin-bottom: 0.5rem; display: block;"></i>
                        <h4>Recurring Deposit</h4>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-3"><strong>Features:</strong></h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check" style="color: #06b6d4;"></i> Interest Rate: 5.5% - 6.5% p.a.</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #06b6d4;"></i> Monthly/Quarterly Installments</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #06b6d4;"></i> Flexible Tenure Options</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #06b6d4;"></i> Loan Against RD Available</li>
                            <li class="mb-2"><i class="fas fa-check" style="color: #06b6d4;"></i> Low Minimum Amount</li>
                        </ul>
                        <a href="contact.php" class="btn btn-info w-100">Apply Now</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- FD Calculator -->
        <div class="row mt-5">
            <div class="col-lg-8 mx-auto">
                <div class="card" style="border-left: 4px solid #3b82f6;">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-calculator me-2"></i>Fixed Deposit Calculator</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="fdAmount" class="form-label">Principal Amount (₹)</label>
                                <input type="number" class="form-control" id="fdAmount" placeholder="Enter amount" min="10000" step="1000">
                            </div>
                            <div class="col-md-4">
                                <label for="fdRate" class="form-label">Interest Rate (% p.a.)</label>
                                <input type="number" class="form-control" id="fdRate" placeholder="Enter rate" min="0" max="20" step="0.1" value="7">
                            </div>
                            <div class="col-md-4">
                                <label for="fdYears" class="form-label">Tenure (Years)</label>
                                <input type="number" class="form-control" id="fdYears" placeholder="Enter years" min="1" max="10" step="1" value="1">
                            </div>
                        </div>
                        <div id="fdResult" class="mt-4"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comparison Table -->
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="mb-4">Deposit Products Comparison</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead style="background-color: #f8fafc;">
                            <tr>
                                <th>Feature</th>
                                <th>Savings Account</th>
                                <th>Current Account</th>
                                <th>Fixed Deposit</th>
                                <th>Recurring Deposit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Interest Rate</strong></td>
                                <td>4.5% - 5.0%</td>
                                <td>NIL</td>
                                <td>6.0% - 7.5%</td>
                                <td>5.5% - 6.5%</td>
                            </tr>
                            <tr>
                                <td><strong>Minimum Balance</strong></td>
                                <td>₹5,000</td>
                                <td>₹10,000</td>
                                <td>₹10,000</td>
                                <td>₹500 - ₹5,000</td>
                            </tr>
                            <tr>
                                <td><strong>Flexibility</strong></td>
                                <td>High</td>
                                <td>High</td>
                                <td>Low</td>
                                <td>Medium</td>
                            </tr>
                            <tr>
                                <td><strong>Best For</strong></td>
                                <td>Daily Use</td>
                                <td>Business</td>
                                <td>Long-term Savings</td>
                                <td>Disciplined Savings</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
