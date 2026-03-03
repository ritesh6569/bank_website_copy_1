<?php
/**
 * Deposits Page - Professional Bank Website
 */

$page_title = 'Deposits - Professional Bank';
$current_page = 'deposits';

include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/data-fetcher.php';

$interest_rates = $data_fetcher->getInterestRates();
?>

    <!-- Page Header -->
    <div class="bg-primary text-white py-5">
        <div class="container-lg">
            <h1 class="mb-2">Deposit Products</h1>
            <p class="lead">Choose the right deposit product for your financial goals</p>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <section class="bg-light py-4 sticky-top" style="z-index: 99;">
        <div class="container-lg">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="savings-tab" data-bs-toggle="tab" data-bs-target="#savings" type="button" role="tab">Savings Account</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="current-tab" data-bs-toggle="tab" data-bs-target="#current" type="button" role="tab">Current Account</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="fd-tab" data-bs-toggle="tab" data-bs-target="#fd" type="button" role="tab">Fixed Deposit</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="rd-tab" data-bs-toggle="tab" data-bs-target="#rd" type="button" role="tab">Recurring Deposit</button>
                </li>
            </ul>
        </div>
    </section>

    <!-- Tab Content -->
    <div class="tab-content" id="depositTabContent">
        <!-- Savings Account -->
        <div class="tab-pane fade show active" id="savings" role="tabpanel" aria-labelledby="savings-tab">
            <section class="section">
                <div class="container-lg">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <h2 class="mb-4">Savings Account</h2>
                            <p class="lead">Start your savings journey with our flexible and rewarding Savings Account.</p>
                            
                            <h4 class="mt-4 mb-3">Key Features</h4>
                            <ul class="list-unstyled mb-4">
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Interest Rate:</strong> 3.5% - 4.0% p.a.
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Minimum Balance:</strong> ₹1,000
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Free Monthly Withdrawals:</strong> 5 times
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Free Debit Card:</strong> Yes, lifetime free
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Passbook:</strong> Digital + Physical
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Insurance Coverage:</strong> ₹1 Lakh (DICGC)
                                </li>
                            </ul>
                            
                            <h4 class="mb-3">Eligibility</h4>
                            <p>Any individual aged 18+ years with a valid government ID can open a Savings Account. Minors can open accounts with parental consent.</p>
                            
                            <h4 class="mt-4 mb-3">How to Apply</h4>
                            <ol class="ps-3">
                                <li>Visit our nearest branch or apply online</li>
                                <li>Fill the account opening form</li>
                                <li>Provide required documents (ID, Address proof)</li>
                                <li>Complete KYC verification</li>
                                <li>Receive your account number and debit card</li>
                            </ol>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="card sticky-top" style="top: 80px;">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Open Savings Account</h5>
                                </div>
                                <div class="card-body">
                                    <form id="savingsForm" novalidate>
                                        <div class="mb-3">
                                            <label for="savName" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="savName" name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="savEmail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="savEmail" name="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="savPhone" class="form-label">Phone</label>
                                            <input type="tel" class="form-control" id="savPhone" name="phone" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="savAge" class="form-label">Age</label>
                                            <input type="number" class="form-control" id="savAge" name="age" min="18" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-paper-plane me-2"></i>Apply Now
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Current Account -->
        <div class="tab-pane fade" id="current" role="tabpanel" aria-labelledby="current-tab">
            <section class="section">
                <div class="container-lg">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <h2 class="mb-4">Current Account</h2>
                            <p class="lead">Designed for businesses and professionals with high transaction volumes.</p>
                            
                            <h4 class="mt-4 mb-3">Key Features</h4>
                            <ul class="list-unstyled mb-4">
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Interest Rate:</strong> No Interest
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Minimum Balance:</strong> ₹5,000 - ₹25,000
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Unlimited Transactions:</strong> Deposits & Withdrawals
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Overdraft Facility:</strong> Available up to 2x balance
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Free Cheque Book:</strong> Yes (100 leaves)
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Business Reporting:</strong> Monthly statements
                                </li>
                            </ul>
                            
                            <h4 class="mb-3">Eligibility</h4>
                            <p>Proprietorships, partnerships, private limited companies, public limited companies, NGOs, and other business entities are eligible.</p>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="card sticky-top" style="top: 80px;">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Apply for Current Account</h5>
                                </div>
                                <div class="card-body">
                                    <form id="currentForm" novalidate>
                                        <div class="mb-3">
                                            <label for="curName" class="form-label">Business Name</label>
                                            <input type="text" class="form-control" id="curName" name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="curEmail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="curEmail" name="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="curPhone" class="form-label">Phone</label>
                                            <input type="tel" class="form-control" id="curPhone" name="phone" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="curType" class="form-label">Business Type</label>
                                            <select class="form-select" id="curType" name="type" required>
                                                <option value="">Select...</option>
                                                <option value="proprietorship">Proprietorship</option>
                                                <option value="partnership">Partnership</option>
                                                <option value="company">Company</option>
                                                <option value="ngo">NGO</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-paper-plane me-2"></i>Apply Now
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Fixed Deposit -->
        <div class="tab-pane fade" id="fd" role="tabpanel" aria-labelledby="fd-tab">
            <section class="section">
                <div class="container-lg">
                    <h2 class="mb-4">Fixed Deposit (FD)</h2>
                    <p class="lead mb-4">Earn guaranteed returns with our Fixed Deposit schemes offering competitive interest rates.</p>
                    
                    <!-- Interest Rates Table -->
                    <div class="row mb-5">
                        <div class="col-lg-8">
                            <h4 class="mb-3">Interest Rates (p.a.)</h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tenure</th>
                                            <th>Regular Customer</th>
                                            <th>Senior Citizen</th>
                                            <th>Minimum Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>7 Days</strong></td>
                                            <td>5.0%</td>
                                            <td>5.5%</td>
                                            <td>₹1,000</td>
                                        </tr>
                                        <tr>
                                            <td><strong>1 Month</strong></td>
                                            <td>5.25%</td>
                                            <td>5.75%</td>
                                            <td>₹1,000</td>
                                        </tr>
                                        <tr>
                                            <td><strong>3 Months</strong></td>
                                            <td>5.5%</td>
                                            <td>6.0%</td>
                                            <td>₹5,000</td>
                                        </tr>
                                        <tr>
                                            <td><strong>6 Months</strong></td>
                                            <td>5.75%</td>
                                            <td>6.25%</td>
                                            <td>₹5,000</td>
                                        </tr>
                                        <tr>
                                            <td><strong>1 Year</strong></td>
                                            <td>6.0%</td>
                                            <td>6.5%</td>
                                            <td>₹10,000</td>
                                        </tr>
                                        <tr>
                                            <td><strong>2 Years</strong></td>
                                            <td>6.2%</td>
                                            <td>6.7%</td>
                                            <td>₹10,000</td>
                                        </tr>
                                        <tr>
                                            <td><strong>3 Years</strong></td>
                                            <td>6.3%</td>
                                            <td>6.8%</td>
                                            <td>₹10,000</td>
                                        </tr>
                                        <tr>
                                            <td><strong>5 Years</strong></td>
                                            <td>6.5%</td>
                                            <td>7.0%</td>
                                            <td>₹25,000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="card sticky-top" style="top: 80px;">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">FD Maturity Calculator</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="fdPrincipal" class="form-label">Principal Amount (₹)</label>
                                        <input type="number" class="form-control" id="fdPrincipal" placeholder="10000" min="1000">
                                    </div>
                                    <div class="mb-3">
                                        <label for="fdRate" class="form-label">Interest Rate (%)</label>
                                        <input type="number" class="form-control" id="fdRate" placeholder="6.0" min="0" step="0.1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="fdTenure" class="form-label">Tenure (Years)</label>
                                        <input type="number" class="form-control" id="fdTenure" placeholder="1" min="0.5" step="0.5">
                                    </div>
                                    <div class="mb-3">
                                        <label for="fdFrequency" class="form-label">Compounding</label>
                                        <select class="form-select" id="fdFrequency">
                                            <option value="quarterly">Quarterly</option>
                                            <option value="semi-annually">Semi-Annually</option>
                                            <option value="annually">Annually</option>
                                            <option value="monthly">Monthly</option>
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-primary w-100" onclick="calculateFD()">
                                        Calculate
                                    </button>
                                    <div id="fdResult" class="mt-3" style="display:none;">
                                        <hr>
                                        <p class="mb-1"><strong>Maturity Amount:</strong></p>
                                        <h5 id="fdMaturityAmount" class="text-success">₹0</h5>
                                        <p class="small text-muted mb-0">Interest Earned: <span id="fdInterest">₹0</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="mb-3">Key Features</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title"><i class="fas fa-shield-alt text-success me-2"></i>Guaranteed Returns</h6>
                                    <p class="small text-muted">Assured interest returns regardless of market conditions.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title"><i class="fas fa-money-bill text-success me-2"></i>Flexible Tenures</h6>
                                    <p class="small text-muted">Choose from 7 days to 5 years tenure options.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title"><i class="fas fa-loan text-success me-2"></i>Loan Against FD</h6>
                                    <p class="small text-muted">Borrow up to 90% of FD amount at competitive rates.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title"><i class="fas fa-lock text-success me-2"></i>DICGC Insurance</h6>
                                    <p class="small text-muted">Deposits insured up to ₹5 Lakh per depositor.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Recurring Deposit -->
        <div class="tab-pane fade" id="rd" role="tabpanel" aria-labelledby="rd-tab">
            <section class="section">
                <div class="container-lg">
                    <h2 class="mb-4">Recurring Deposit (RD)</h2>
                    <p class="lead mb-4">Build wealth through regular monthly deposits with attractive interest rates.</p>
                    
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <h4 class="mb-3">Interest Rates (p.a.)</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Tenure</th>
                                            <th>Regular Customer</th>
                                            <th>Senior Citizen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>6 Months</strong></td>
                                            <td>5.5%</td>
                                            <td>6.0%</td>
                                        </tr>
                                        <tr>
                                            <td><strong>1 Year</strong></td>
                                            <td>5.75%</td>
                                            <td>6.25%</td>
                                        </tr>
                                        <tr>
                                            <td><strong>2 Years</strong></td>
                                            <td>5.9%</td>
                                            <td>6.4%</td>
                                        </tr>
                                        <tr>
                                            <td><strong>3 Years</strong></td>
                                            <td>6.0%</td>
                                            <td>6.5%</td>
                                        </tr>
                                        <tr>
                                            <td><strong>5 Years</strong></td>
                                            <td>6.0%</td>
                                            <td>6.5%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <h4 class="mt-4 mb-3">Key Features</h4>
                            <ul class="list-unstyled">
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Monthly Deposit:</strong> ₹500 minimum
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Flexible Tenure:</strong> 6 months to 10 years
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Auto-Renewal:</strong> Automatic renewal on maturity
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Loan Facility:</strong> Borrow up to 80% of maturity value
                                </li>
                                <li class="py-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Nomination Facility:</strong> Available
                                </li>
                            </ul>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="card sticky-top" style="top: 80px;">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">RD Maturity Calculator</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="rdMonthly" class="form-label">Monthly Deposit (₹)</label>
                                        <input type="number" class="form-control" id="rdMonthly" placeholder="1000" min="500">
                                    </div>
                                    <div class="mb-3">
                                        <label for="rdRate" class="form-label">Interest Rate (%)</label>
                                        <input type="number" class="form-control" id="rdRate" placeholder="6.0" min="0" step="0.1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="rdTenure" class="form-label">Tenure (Months)</label>
                                        <input type="number" class="form-control" id="rdTenure" placeholder="12" min="6" step="6">
                                    </div>
                                    <button type="button" class="btn btn-primary w-100" onclick="calculateRD()">
                                        Calculate
                                    </button>
                                    <div id="rdResult" class="mt-3" style="display:none;">
                                        <hr>
                                        <p class="mb-1"><strong>Total Amount Invested:</strong></p>
                                        <p id="rdInvested">₹0</p>
                                        <p class="mb-1"><strong>Maturity Amount:</strong></p>
                                        <h5 id="rdMaturityAmount" class="text-success">₹0</h5>
                                        <p class="small text-muted mb-0">Interest Earned: <span id="rdInterest">₹0</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Comparison Table -->
    <section class="section bg-light">
        <div class="container-lg">
            <div class="section-title">
                <h2>Comparison of Deposit Products</h2>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
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
                            <td>3.5-4.0%</td>
                            <td>No Interest</td>
                            <td>5.0-6.5%</td>
                            <td>5.5-6.0%</td>
                        </tr>
                        <tr>
                            <td><strong>Min Balance</strong></td>
                            <td>₹1,000</td>
                            <td>₹5,000-25,000</td>
                            <td>₹1,000-25,000</td>
                            <td>₹500/month</td>
                        </tr>
                        <tr>
                            <td><strong>Flexibility</strong></td>
                            <td>High</td>
                            <td>Limited</td>
                            <td>Low</td>
                            <td>Medium</td>
                        </tr>
                        <tr>
                            <td><strong>Ideal For</strong></td>
                            <td>Individuals</td>
                            <td>Businesses</td>
                            <td>Long-term savings</td>
                            <td>Regular savers</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        function calculateFD() {
            const principal = parseFloat(document.getElementById('fdPrincipal').value);
            const rate = parseFloat(document.getElementById('fdRate').value);
            const years = parseFloat(document.getElementById('fdTenure').value);
            const frequency = document.getElementById('fdFrequency').value;
            
            if (!principal || !rate || !years) {
                alert('Please fill all fields');
                return;
            }
            
            const maturity = calculateMaturity(principal, rate, years, frequency);
            const interest = maturity - principal;
            
            document.getElementById('fdMaturityAmount').textContent = '₹' + maturity.toFixed(2);
            document.getElementById('fdInterest').textContent = '₹' + interest.toFixed(2);
            document.getElementById('fdResult').style.display = 'block';
        }
        
        function calculateRD() {
            const monthly = parseFloat(document.getElementById('rdMonthly').value);
            const rate = parseFloat(document.getElementById('rdRate').value);
            const months = parseFloat(document.getElementById('rdTenure').value);
            
            if (!monthly || !rate || !months) {
                alert('Please fill all fields');
                return;
            }
            
            const monthlyRate = rate / 100 / 12;
            let maturity = 0;
            
            for (let i = 1; i <= months; i++) {
                maturity += monthly * Math.pow(1 + monthlyRate, months - i + 1);
            }
            
            const invested = monthly * months;
            const interest = maturity - invested;
            
            document.getElementById('rdInvested').textContent = '₹' + invested.toFixed(2);
            document.getElementById('rdMaturityAmount').textContent = '₹' + maturity.toFixed(2);
            document.getElementById('rdInterest').textContent = '₹' + interest.toFixed(2);
            document.getElementById('rdResult').style.display = 'block';
        }
    </script>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/footer.php';
?>
