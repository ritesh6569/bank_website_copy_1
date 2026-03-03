<?php
/**
 * Services Page - Professional Bank Website
 */

$page_title = 'Services - Professional Bank';
$current_page = 'services';

include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/header.php';
?>

    <!-- Page Header -->
    <div class="bg-primary text-white py-5">
        <div class="container-lg">
            <h1 class="mb-2">Banking Services</h1>
            <p class="lead">Comprehensive digital and traditional banking services for modern living</p>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <section class="bg-light py-4 sticky-top" style="z-index: 99;">
        <div class="container-lg">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="internet-tab" data-bs-toggle="tab" data-bs-target="#internet" type="button" role="tab">Internet Banking</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="mobile-tab" data-bs-toggle="tab" data-bs-target="#mobile" type="button" role="tab">Mobile Banking</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sms-tab" data-bs-toggle="tab" data-bs-target="#sms" type="button" role="tab">SMS Banking</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="rtgs-tab" data-bs-toggle="tab" data-bs-target="#rtgs" type="button" role="tab">RTGS/NEFT</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="locker-tab" data-bs-toggle="tab" data-bs-target="#locker" type="button" role="tab">Locker Facility</button>
                </li>
            </ul>
        </div>
    </section>

    <!-- Tab Content -->
    <div class="tab-content" id="servicesTabContent">
        <!-- Internet Banking -->
        <div class="tab-pane fade show active" id="internet" role="tabpanel" aria-labelledby="internet-tab">
            <section class="section">
                <div class="container-lg">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <h2 class="mb-4">Internet Banking</h2>
                            <p class="lead">Secure, convenient, and comprehensive online banking at your fingertips 24/7.</p>
                            
                            <h4 class="mt-4 mb-3">Key Features</h4>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title"><i class="fas fa-eye text-primary me-2"></i>Account Overview</h6>
                                            <p class="small text-muted">View all your account balances and transaction history in real-time.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title"><i class="fas fa-exchange-alt text-primary me-2"></i>Fund Transfer</h6>
                                            <p class="small text-muted">Transfer funds to any account using NEFT, RTGS, or Immediate Transfer.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title"><i class="fas fa-credit-card text-primary me-2"></i>Bill Payments</h6>
                                            <p class="small text-muted">Pay utility bills, insurance, loans, and subscriptions with ease.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title"><i class="fas fa-lock text-primary me-2"></i>Secure Transactions</h6>
                                            <p class="small text-muted">256-bit encryption and multi-factor authentication for security.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <h4 class="mt-4 mb-3">How to Register</h4>
                            <ol class="ps-3">
                                <li class="py-2">Visit our website: www.professionalbank.com</li>
                                <li class="py-2">Click on "Internet Banking" in the menu</li>
                                <li class="py-2">Enter your Customer ID and Password</li>
                                <li class="py-2">Complete the OTP verification</li>
                                <li class="py-2">Set your security preferences and MPIN</li>
                                <li class="py-2">You're ready to use Internet Banking!</li>
                            </ol>
                            
                            <h4 class="mt-4 mb-3">Security Tips</h4>
                            <ul class="list-unstyled">
                                <li class="py-2"><i class="fas fa-shield-alt text-success me-2"></i>Never share your password or MPIN with anyone</li>
                                <li class="py-2"><i class="fas fa-shield-alt text-success me-2"></i>Always log out after your session</li>
                                <li class="py-2"><i class="fas fa-shield-alt text-success me-2"></i>Use a secure internet connection only</li>
                                <li class="py-2"><i class="fas fa-shield-alt text-success me-2"></i>Keep your device updated with latest security patches</li>
                            </ul>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="card sticky-top" style="top: 80px;">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Register for Internet Banking</h5>
                                </div>
                                <div class="card-body">
                                    <form id="ibForm" novalidate>
                                        <div class="mb-3">
                                            <label for="ibCustomerId" class="form-label">Customer ID</label>
                                            <input type="text" class="form-control" id="ibCustomerId" name="customer_id" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ibEmail" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" id="ibEmail" name="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ibPhone" class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control" id="ibPhone" name="phone" required>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="ibTerms" required>
                                            <label class="form-check-label" for="ibTerms">
                                                I agree to the terms and conditions
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">
                                            Register Now
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Mobile Banking -->
        <div class="tab-pane fade" id="mobile" role="tabpanel" aria-labelledby="mobile-tab">
            <section class="section">
                <div class="container-lg">
                    <h2 class="mb-4">Mobile Banking</h2>
                    <p class="lead">Bank anytime, anywhere with our feature-rich mobile app available on iOS and Android.</p>
                    
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <h4 class="mb-3">App Features</h4>
                            <ul class="list-unstyled">
                                <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>Instant account balance check</li>
                                <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>One-click fund transfers</li>
                                <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>QR code payments</li>
                                <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>Bill payments and recharges</li>
                                <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>Fixed deposits & investments</li>
                                <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>Loan applications</li>
                                <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>Transaction history</li>
                                <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>24/7 customer support chat</li>
                            </ul>
                            
                            <h4 class="mt-4 mb-3">System Requirements</h4>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <i class="fab fa-apple" style="font-size: 2rem; color: var(--text-dark);"></i>
                                            <h6 class="card-title mt-2">iOS</h6>
                                            <p class="small text-muted">Version 12.0 or later</p>
                                            <a href="#" class="btn btn-sm btn-outline-primary">Download</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <i class="fab fa-android" style="font-size: 2rem; color: var(--success-color);"></i>
                                            <h6 class="card-title mt-2">Android</h6>
                                            <p class="small text-muted">Version 7.0 or later</p>
                                            <a href="#" class="btn btn-sm btn-outline-primary">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <h4 class="mb-3">Why Use Mobile Banking?</h4>
                            <ul class="list-unstyled">
                                <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i><strong>Convenience</strong> - Bank from anywhere</li>
                                <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i><strong>Speed</strong> - Instant transactions</li>
                                <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i><strong>Security</strong> - Biometric login</li>
                                <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i><strong>No Charges</strong> - Free to download and use</li>
                                <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i><strong>Rewards</strong> - Earn cashback on transactions</li>
                            </ul>
                            
                            <div class="card mt-4" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; border: none;">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Limited Time Offer!</h5>
                                    <p>Download our app today and get ₹500 cashback on your first digital transaction.</p>
                                    <small>*Terms and conditions apply</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- SMS Banking -->
        <div class="tab-pane fade" id="sms" role="tabpanel" aria-labelledby="sms-tab">
            <section class="section">
                <div class="container-lg">
                    <h2 class="mb-4">SMS Banking</h2>
                    <p class="lead">Simple, secure, and accessible banking via SMS for those without internet access.</p>
                    
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <h4 class="mb-3">Available SMS Services</h4>
                            <div class="accordion" id="smsAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="smsBal">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#smsBal-body">
                                            <i class="fas fa-coins me-2"></i>Check Account Balance
                                        </button>
                                    </h2>
                                    <div id="smsBal-body" class="accordion-collapse collapse show" data-bs-parent="#smsAccordion">
                                        <div class="accordion-body">
                                            <p><strong>Send:</strong> BAL to 5555</p>
                                            <p class="text-muted small">You'll receive your current account balance via SMS within seconds.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="smsMini">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#smsMini-body">
                                            <i class="fas fa-list-ul me-2"></i>Mini Statement
                                        </button>
                                    </h2>
                                    <div id="smsMini-body" class="accordion-collapse collapse" data-bs-parent="#smsAccordion">
                                        <div class="accordion-body">
                                            <p><strong>Send:</strong> MINI to 5555</p>
                                            <p class="text-muted small">Receive last 5 transactions on your registered mobile number.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="smsChange">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#smsChange-body">
                                            <i class="fas fa-lock me-2"></i>Change MPIN
                                        </button>
                                    </h2>
                                    <div id="smsChange-body" class="accordion-collapse collapse" data-bs-parent="#smsAccordion">
                                        <div class="accordion-body">
                                            <p><strong>Send:</strong> MPIN XXXX YYYY to 5555</p>
                                            <p class="text-muted small">Replace XXXX with old MPIN and YYYY with new MPIN.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="smsAlert">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#smsAlert-body">
                                            <i class="fas fa-bell me-2"></i>SMS Alerts
                                        </button>
                                    </h2>
                                    <div id="smsAlert-body" class="accordion-collapse collapse" data-bs-parent="#smsAccordion">
                                        <div class="accordion-body">
                                            <p><strong>Send:</strong> ALERTS to 5555</p>
                                            <p class="text-muted small">Activate SMS alerts for all transactions on your account.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <h4 class="mt-4 mb-3">How to Register for SMS Banking</h4>
                            <ol class="ps-3">
                                <li class="py-2">Contact your nearest branch with your ID proof</li>
                                <li class="py-2">Fill SMS Banking registration form</li>
                                <li class="py-2">Link your mobile number to your account</li>
                                <li class="py-2">You'll receive confirmation SMS</li>
                                <li class="py-2">Set your SMS Banking MPIN</li>
                            </ol>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="card sticky-top" style="top: 80px;">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">SMS Banking Info</h5>
                                </div>
                                <div class="card-body">
                                    <h6>Service Code: <strong>5555</strong></h6>
                                    <hr>
                                    <h6>Charges:</h6>
                                    <ul class="small list-unstyled">
                                        <li class="py-1"><strong>Registration:</strong> Free</li>
                                        <li class="py-1"><strong>Per Transaction SMS:</strong> Free</li>
                                        <li class="py-1"><strong>Alert SMS:</strong> Free</li>
                                    </ul>
                                    <hr>
                                    <h6>Available 24/7:</h6>
                                    <p class="small text-muted">No waiting time, instant responses.</p>
                                    <button class="btn btn-primary w-100 mt-3">
                                        Request SMS Registration
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- RTGS/NEFT -->
        <div class="tab-pane fade" id="rtgs" role="tabpanel" aria-labelledby="rtgs-tab">
            <section class="section">
                <div class="container-lg">
                    <h2 class="mb-4">RTGS & NEFT Services</h2>
                    <p class="lead">Fast, reliable, and secure electronic fund transfer services across India.</p>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">RTGS (Real-Time Gross Settlement)</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Speed:</strong> Real-time (immediate)</p>
                                    <p><strong>Settlement:</strong> Gross basis (no netting)</p>
                                    <p><strong>Amount:</strong> ₹2 Lakh - No upper limit</p>
                                    <p><strong>Charges:</strong> ₹25-50 depending on amount</p>
                                    <p><strong>Timing:</strong> 9:00 AM - 4:30 PM (Weekdays)</p>
                                    <p class="text-muted small">Best for high-value, urgent transfers</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0">NEFT (National Electronic Funds Transfer)</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Speed:</strong> Batch processing</p>
                                    <p><strong>Settlement:</strong> Net basis (after clearing)</p>
                                    <p><strong>Amount:</strong> No minimum limit</p>
                                    <p><strong>Charges:</strong> ₹2.50-12.50 depending on amount</p>
                                    <p><strong>Timing:</strong> Multiple batches throughout the day</p>
                                    <p class="text-muted small">Best for regular, routine transfers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="mb-3">Charges</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Amount Range</th>
                                    <th>Charges</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td rowspan="3"><strong>RTGS</strong></td>
                                    <td>₹2 Lakh - ₹5 Lakh</td>
                                    <td>₹25</td>
                                </tr>
                                <tr>
                                    <td>₹5 Lakh - ₹1 Crore</td>
                                    <td>₹50</td>
                                </tr>
                                <tr>
                                    <td>₹1 Crore+</td>
                                    <td>₹50</td>
                                </tr>
                                <tr>
                                    <td rowspan="3"><strong>NEFT</strong></td>
                                    <td>₹0 - ₹1 Lakh</td>
                                    <td>₹2.50</td>
                                </tr>
                                <tr>
                                    <td>₹1 Lakh - ₹2 Lakh</td>
                                    <td>₹5</td>
                                </tr>
                                <tr>
                                    <td>₹2 Lakh+</td>
                                    <td>₹12.50</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

        <!-- Locker Facility -->
        <div class="tab-pane fade" id="locker" role="tabpanel" aria-labelledby="locker-tab">
            <section class="section">
                <div class="container-lg">
                    <h2 class="mb-4">Safe Deposit Locker Facility</h2>
                    <p class="lead">Secure storage for your valuables and important documents with 24/7 surveillance.</p>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-lg-8">
                            <h4 class="mb-3">Locker Sizes & Charges</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>Dimensions</th>
                                            <th>Annual Charge</th>
                                            <th>Deposit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Small</strong></td>
                                            <td>6" × 3" × 12"</td>
                                            <td>₹500</td>
                                            <td>₹500</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Medium</strong></td>
                                            <td>9" × 4" × 12"</td>
                                            <td>₹1,000</td>
                                            <td>₹1,000</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Large</strong></td>
                                            <td>12" × 6" × 12"</td>
                                            <td>₹2,000</td>
                                            <td>₹2,000</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Extra Large</strong></td>
                                            <td>15" × 8" × 12"</td>
                                            <td>₹5,000</td>
                                            <td>₹5,000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <h4 class="mt-4 mb-3">What You Can Store</h4>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title"><i class="fas fa-check-circle text-success me-2"></i>Jewelry & Ornaments</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title"><i class="fas fa-check-circle text-success me-2"></i>Documents</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title"><i class="fas fa-check-circle text-success me-2"></i>Deeds & Bonds</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title"><i class="fas fa-check-circle text-success me-2"></i>Certificates</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title"><i class="fas fa-check-circle text-success me-2"></i>Photos</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title"><i class="fas fa-check-circle text-success me-2"></i>Heirlooms</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="card sticky-top" style="top: 80px;">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Locker Features</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled small">
                                        <li class="py-2"><i class="fas fa-check text-success me-2"></i>24/7 access</li>
                                        <li class="py-2"><i class="fas fa-check text-success me-2"></i>Two-key system</li>
                                        <li class="py-2"><i class="fas fa-check text-success me-2"></i>CCTV surveillance</li>
                                        <li class="py-2"><i class="fas fa-check text-success me-2"></i>Fire-resistant vault</li>
                                        <li class="py-2"><i class="fas fa-check text-success me-2"></i>Insurance coverage</li>
                                        <li class="py-2"><i class="fas fa-check text-success me-2"></i>Nomination facility</li>
                                        <li class="py-2"><i class="fas fa-check text-success me-2"></i>Easy transfer option</li>
                                    </ul>
                                    <hr>
                                    <button class="btn btn-primary w-100">
                                        <i class="fas fa-lock me-2"></i>Rent a Locker
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/footer.php';
?>
