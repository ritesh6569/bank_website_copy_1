<?php
/**
 * Services Page
 * Internet Banking, Mobile Banking, RTGS/NEFT, Locker Facility
 */

require_once 'config.php';
require_once 'includes/helpers.php';

$page_title = 'Services - ' . SITE_NAME;
$meta_description = 'Explore our banking services: Internet Banking, Mobile Banking, and more';

?>
<?php include 'includes/header.php'; ?>

<!-- Page Header -->
<section style="background: linear-gradient(135deg, #1e3a8a 0%, #2d5a8c 100%); color: white; padding: 60px 0;">
    <div class="container">
        <h1 class="mb-2">Our Services</h1>
        <p style="color: rgba(255, 255, 255, 0.9);">Modern banking solutions at your fingertips</p>
    </div>
</section>

<!-- Services Content -->
<section class="py-5">
    <div class="container">
        <!-- Internet Banking -->
        <div class="row align-items-center mb-5 animate-on-scroll" id="internet-banking">
            <div class="col-lg-6">
                <div style="background: linear-gradient(135deg, #dbeafe, #eff6ff); padding: 3rem; border-radius: 0.5rem;">
                    <i class="fas fa-globe" style="font-size: 4rem; color: #3b82f6; margin-bottom: 1rem; display: block;"></i>
                </div>
            </div>
            <div class="col-lg-6">
                <h3 class="mb-3">Internet Banking</h3>
                <p>Access your account anytime, anywhere with our secure online banking portal.</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check" style="color: #10b981; margin-right: 0.5rem;"></i>Fund Transfers (Domestic & International)</li>
                    <li class="mb-2"><i class="fas fa-check" style="color: #10b981; margin-right: 0.5rem;"></i>Bill Payments</li>
                    <li class="mb-2"><i class="fas fa-check" style="color: #10b981; margin-right: 0.5rem;"></i>Loan Enquiries & Management</li>
                    <li class="mb-2"><i class="fas fa-check" style="color: #10b981; margin-right: 0.5rem;"></i>Account Statements</li>
                    <li class="mb-2"><i class="fas fa-check" style="color: #10b981; margin-right: 0.5rem;"></i>24/7 Availability</li>
                </ul>
                <a href="contact.php" class="btn btn-primary mt-3">Learn More</a>
            </div>
        </div>

        <!-- Mobile Banking -->
        <div class="row align-items-center mb-5 animate-on-scroll" id="mobile-banking">
            <div class="col-lg-6 order-lg-2">
                <div style="background: linear-gradient(135deg, #dcfce7, #f0fdf4); padding: 3rem; border-radius: 0.5rem;">
                    <i class="fas fa-mobile-alt" style="font-size: 4rem; color: #10b981; margin-bottom: 1rem; display: block;"></i>
                </div>
            </div>
            <div class="col-lg-6 order-lg-1">
                <h3 class="mb-3">Mobile Banking</h3>
                <p>Bank on the go with our user-friendly mobile application available on iOS and Android.</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check" style="color: #f59e0b; margin-right: 0.5rem;"></i>Quick Fund Transfers</li>
                    <li class="mb-2"><i class="fas fa-check" style="color: #f59e0b; margin-right: 0.5rem;"></i>Utility Bill Payments</li>
                    <li class="mb-2"><i class="fas fa-check" style="color: #f59e0b; margin-right: 0.5rem;"></i>Mobile Recharge</li>
                    <li class="mb-2"><i class="fas fa-check" style="color: #f59e0b; margin-right: 0.5rem;"></i>Check Balance & Statements</li>
                    <li class="mb-2"><i class="fas fa-check" style="color: #f59e0b; margin-right: 0.5rem;"></i>Investment Options</li>
                </ul>
                <div class="mt-3">
                    <button class="btn btn-success me-2"><i class="fab fa-apple me-2"></i>App Store</button>
                    <button class="btn btn-success"><i class="fab fa-google-play me-2"></i>Play Store</button>
                </div>
            </div>
        </div>

        <!-- SMS Banking -->
        <div class="row align-items-center mb-5 animate-on-scroll">
            <div class="col-lg-6">
                <div style="background: linear-gradient(135deg, #fef3c7, #fef9e7); padding: 3rem; border-radius: 0.5rem;">
                    <i class="fas fa-sms" style="font-size: 4rem; color: #f59e0b; margin-bottom: 1rem; display: block;"></i>
                </div>
            </div>
            <div class="col-lg-6">
                <h3 class="mb-3">SMS Banking</h3>
                <p>Quick banking services through simple SMS messages - no internet required.</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check" style="color: #ef4444; margin-right: 0.5rem;"></i>Check Account Balance</li>
                    <li class="mb-2"><i class="fas fa-check" style="color: #ef4444; margin-right: 0.5rem;"></i>Recent Transactions</li>
                    <li class="mb-2"><i class="fas fa-check" style="color: #ef4444; margin-right: 0.5rem;"></i>ATM Locator</li>
                    <li class="mb-2"><i class="fas fa-check" style="color: #ef4444; margin-right: 0.5rem;"></i>Block/Activate Card</li>
                    <li class="mb-2"><i class="fas fa-check" style="color: #ef4444; margin-right: 0.5rem;"></i>Support 24/7</li>
                </ul>
                <a href="contact.php" class="btn btn-warning mt-3">Register Now</a>
            </div>
        </div>

        <!-- RTGS/NEFT -->
        <div class="row align-items-center mb-5 animate-on-scroll">
            <div class="col-lg-6 order-lg-2">
                <div style="background: linear-gradient(135deg, #fee2e2, #fef2f2); padding: 3rem; border-radius: 0.5rem;">
                    <i class="fas fa-exchange-alt" style="font-size: 4rem; color: #ef4444; margin-bottom: 1rem; display: block;"></i>
                </div>
            </div>
            <div class="col-lg-6 order-lg-1">
                <h3 class="mb-3">RTGS/NEFT Transfers</h3>
                <p>Safe and secure fund transfers across Indian banks with real-time updates.</p>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <h6 class="mb-2">NEFT (Electronic Clearing Service)</h6>
                        <ul class="list-unstyled small">
                            <li><i class="fas fa-check" style="color: #10b981; margin-right: 0.5rem;"></i>Settlement in batches</li>
                            <li><i class="fas fa-check" style="color: #10b981; margin-right: 0.5rem;"></i>No amount limit</li>
                            <li><i class="fas fa-check" style="color: #10b981; margin-right: 0.5rem;"></i>Charges: ₹2.50 - ₹5</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-2">RTGS (Real Time Gross Settlement)</h6>
                        <ul class="list-unstyled small">
                            <li><i class="fas fa-check" style="color: #10b981; margin-right: 0.5rem;"></i>Real-time settlement</li>
                            <li><i class="fas fa-check" style="color: #10b981; margin-right: 0.5rem;"></i>Min: ₹2 Lakh</li>
                            <li><i class="fas fa-check" style="color: #10b981; margin-right: 0.5rem;"></i>Charges: ₹10 - ₹50</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Locker Facility -->
        <div class="row align-items-center mb-5 animate-on-scroll" id="locker">
            <div class="col-lg-6">
                <div style="background: linear-gradient(135deg, #ddd6fe, #ede9fe); padding: 3rem; border-radius: 0.5rem;">
                    <i class="fas fa-lock" style="font-size: 4rem; color: #8b5cf6; margin-bottom: 1rem; display: block;"></i>
                </div>
            </div>
            <div class="col-lg-6">
                <h3 class="mb-3">Safe Deposit Lockers</h3>
                <p>Secure storage facility for your valuable documents and jewelry with 24/7 access.</p>
                <h6 class="mb-3 mt-4">Available Locker Sizes:</h6>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Small Locker</strong><br>Annual Rent: ₹500 - ₹750</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Medium Locker</strong><br>Annual Rent: ₹750 - ₹1,000</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Large Locker</strong><br>Annual Rent: ₹1,000 - ₹1,500</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Extra Large Locker</strong><br>Annual Rent: ₹1,500 - ₹2,000</p>
                    </div>
                </div>
                <a href="contact.php" class="btn btn-primary mt-3">Book a Locker</a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
