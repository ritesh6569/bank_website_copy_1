<?php
/**
 * Loans Page - Professional Bank Website
 */

$page_title = 'Loans - Professional Bank';
$current_page = 'loans';

include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/data-fetcher.php';

$interest_rates = $data_fetcher->getInterestRates();
?>

    <!-- Page Header -->
    <div class="bg-primary text-white py-5">
        <div class="container-lg">
            <h1 class="mb-2">Loan Products</h1>
            <p class="lead">Get the financial support you need with our flexible loan options</p>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <section class="bg-light py-4 sticky-top" style="z-index: 99;">
        <div class="container-lg">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab">Personal Loan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab">Home Loan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="vehicle-tab" data-bs-toggle="tab" data-bs-target="#vehicle" type="button" role="tab">Vehicle Loan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="business-tab" data-bs-toggle="tab" data-bs-target="#business" type="button" role="tab">Business Loan</button>
                </li>
            </ul>
        </div>
    </section>

    <!-- Tab Content -->
    <div class="tab-content" id="loanTabContent">
        <!-- Personal Loan -->
        <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
            <section class="section">
                <div class="container-lg">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <h2 class="mb-4">Personal Loan</h2>
                            <p class="lead">Get instant financial support for your personal needs without collateral.</p>
                            
                            <h4 class="mt-4 mb-3">Quick Facts</h4>
                            <div class="row g-3 mb-4">
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Interest Rate</h6>
                                            <p class="h5 text-primary">8.5% - 12.5% p.a.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Loan Amount</h6>
                                            <p class="h5 text-primary">₹50,000 - ₹25,00,000</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Tenure</h6>
                                            <p class="h5 text-primary">12 - 60 months</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Processing Time</h6>
                                            <p class="h5 text-primary">24 - 48 hours</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <h4 class="mb-3">Key Features</h4>
                            <ul class="list-unstyled">
                                <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>No collateral required</li>
                                <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>Quick approval and disbursement</li>
                                <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>Flexible repayment tenure</li>
                                <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>Minimal documentation</li>
                                <li class="py-2"><i class="fas fa-check-circle text-success me-2"></i>Option to pre-close without penalty</li>
                            </ul>
                            
                            <h4 class="mt-4 mb-3">Eligibility Criteria</h4>
                            <ul>
                                <li>Age: 21 - 60 years</li>
                                <li>Employment: Salaried professional or self-employed</li>
                                <li>Income: Minimum ₹3,00,000 p.a.</li>
                                <li>Credit Score: 750+ (preferred)</li>
                                <li>Employment History: Minimum 2 years</li>
                            </ul>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="card sticky-top" style="top: 80px;">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">EMI Calculator</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="loanAmount" class="form-label">Loan Amount (₹)</label>
                                        <input type="number" class="form-control" id="loanAmount" placeholder="500000" min="50000">
                                    </div>
                                    <div class="mb-3">
                                        <label for="interestRate" class="form-label">Interest Rate (%)</label>
                                        <input type="number" class="form-control" id="interestRate" placeholder="10" min="8.5" max="12.5" step="0.1" value="10">
                                    </div>
                                    <div class="mb-3">
                                        <label for="loanTenure" class="form-label">Tenure (Months)</label>
                                        <input type="number" class="form-control" id="loanTenure" placeholder="60" min="12" max="60" step="6" value="60">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Loan Tenure</label>
                                        <input type="range" class="form-range" id="tenureSlider" min="12" max="60" step="6" value="60" style="cursor: pointer;">
                                        <small class="text-muted"><span id="tenureDisplay">60</span> months</small>
                                    </div>
                                    <button type="button" class="btn btn-primary w-100" onclick="calculateEMI()">
                                        Calculate EMI
                                    </button>
                                    <div id="emiResult" class="mt-3" style="display:none;">
                                        <hr>
                                        <p class="mb-1"><strong>Monthly EMI:</strong></p>
                                        <h5 id="monthlyEMI" class="text-success">₹0</h5>
                                        <p class="small text-muted mb-2">Total Amount Payable: <span id="totalPayable">₹0</span></p>
                                        <p class="small text-muted mb-0">Total Interest: <span id="totalInterest">₹0</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Home Loan -->
        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
            <section class="section">
                <div class="container-lg">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <h2 class="mb-4">Home Loan</h2>
                            <p class="lead">Fulfill your dream of owning a home with our comprehensive home loan solutions.</p>
                            
                            <h4 class="mt-4 mb-3">Quick Facts</h4>
                            <div class="row g-3 mb-4">
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Interest Rate</h6>
                                            <p class="h5 text-primary">7.0% - 8.5% p.a.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Loan Amount</h6>
                                            <p class="h5 text-primary">₹5,00,000 - ₹2 Cr</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">LTV Ratio</h6>
                                            <p class="h5 text-primary">Up to 90%</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Tenure</h6>
                                            <p class="h5 text-primary">Up to 20 years</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <h4 class="mb-3">What We Finance</h4>
                            <ul class="list-unstyled">
                                <li class="py-2"><i class="fas fa-home text-success me-2"></i>Purchase of new residential property</li>
                                <li class="py-2"><i class="fas fa-home text-success me-2"></i>Construction of house on own land</li>
                                <li class="py-2"><i class="fas fa-home text-success me-2"></i>Purchase of land for residential purpose</li>
                                <li class="py-2"><i class="fas fa-home text-success me-2"></i>Renovation and repair of existing property</li>
                                <li class="py-2"><i class="fas fa-home text-success me-2"></i>Balance transfer from other bank</li>
                            </ul>
                            
                            <h4 class="mt-4 mb-3">Documents Required</h4>
                            <ul>
                                <li>Identity proof (Passport, Aadhaar, PAN)</li>
                                <li>Address proof (Latest utility bill, rent agreement)</li>
                                <li>Income proof (Salary slips, IT returns)</li>
                                <li>Property documents (Title deed, sale agreement)</li>
                                <li>Bank statements (Last 6 months)</li>
                            </ul>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="card sticky-top" style="top: 80px;">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Apply for Home Loan</h5>
                                </div>
                                <div class="card-body">
                                    <form id="homeLoanForm" novalidate>
                                        <div class="mb-3">
                                            <label for="hlName" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="hlName" name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="hlEmail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="hlEmail" name="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="hlPhone" class="form-label">Phone</label>
                                            <input type="tel" class="form-control" id="hlPhone" name="phone" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="hlAmount" class="form-label">Loan Amount (₹)</label>
                                            <input type="number" class="form-control" id="hlAmount" name="amount" min="500000" required>
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

        <!-- Vehicle Loan -->
        <div class="tab-pane fade" id="vehicle" role="tabpanel" aria-labelledby="vehicle-tab">
            <section class="section">
                <div class="container-lg">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <h2 class="mb-4">Vehicle Loan</h2>
                            <p class="lead">Drive home your dream car with our hassle-free vehicle financing options.</p>
                            
                            <h4 class="mt-4 mb-3">Quick Facts</h4>
                            <div class="row g-3 mb-4">
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Interest Rate</h6>
                                            <p class="h5 text-primary">7.5% - 9.5% p.a.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Finance Up To</h6>
                                            <p class="h5 text-primary">80% value</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Tenure</h6>
                                            <p class="h5 text-primary">12 - 84 months</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Processing Fee</h6>
                                            <p class="h5 text-primary">1% - 2%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <h4 class="mb-3">Vehicle Types We Finance</h4>
                            <ul class="list-unstyled">
                                <li class="py-2"><i class="fas fa-car text-success me-2"></i>New & used cars (sedan, SUV, MUV)</li>
                                <li class="py-2"><i class="fas fa-car text-success me-2"></i>Motorcycles and scooters</li>
                                <li class="py-2"><i class="fas fa-car text-success me-2"></i>Commercial vehicles</li>
                                <li class="py-2"><i class="fas fa-car text-success me-2"></i>Farm equipment</li>
                                <li class="py-2"><i class="fas fa-car text-success me-2"></i>Balance transfer from other lenders</li>
                            </ul>
                            
                            <h4 class="mt-4 mb-3">Benefits</h4>
                            <ul>
                                <li>Instant approval and quick disbursement</li>
                                <li>No hidden charges</li>
                                <li>Flexible repayment options</li>
                                <li>Loan against registration of vehicle</li>
                                <li>Extended warranty coverage available</li>
                            </ul>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="card sticky-top" style="top: 80px;">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Quick Vehicle Loan</h5>
                                </div>
                                <div class="card-body">
                                    <form id="vehicleLoanForm" novalidate>
                                        <div class="mb-3">
                                            <label for="vlName" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="vlName" name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="vlEmail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="vlEmail" name="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="vlPhone" class="form-label">Phone</label>
                                            <input type="tel" class="form-control" id="vlPhone" name="phone" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="vlVehicle" class="form-label">Vehicle Type</label>
                                            <select class="form-select" id="vlVehicle" name="vehicle" required>
                                                <option value="">Select...</option>
                                                <option value="car">Car</option>
                                                <option value="bike">Motorcycle</option>
                                                <option value="commercial">Commercial Vehicle</option>
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

        <!-- Business Loan -->
        <div class="tab-pane fade" id="business" role="tabpanel" aria-labelledby="business-tab">
            <section class="section">
                <div class="container-lg">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <h2 class="mb-4">Business Loan</h2>
                            <p class="lead">Fuel your business growth with our flexible and customized business loan solutions.</p>
                            
                            <h4 class="mt-4 mb-3">Quick Facts</h4>
                            <div class="row g-3 mb-4">
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Interest Rate</h6>
                                            <p class="h5 text-primary">9.0% - 14.0% p.a.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Loan Amount</h6>
                                            <p class="h5 text-primary">₹1,00,000 - ₹1 Cr</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Tenure</h6>
                                            <p class="h5 text-primary">12 - 84 months</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Approval Time</h6>
                                            <p class="h5 text-primary">7-10 days</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <h4 class="mb-3">Suitable For</h4>
                            <ul class="list-unstyled">
                                <li class="py-2"><i class="fas fa-briefcase text-success me-2"></i>Purchase of equipment & machinery</li>
                                <li class="py-2"><i class="fas fa-briefcase text-success me-2"></i>Working capital requirements</li>
                                <li class="py-2"><i class="fas fa-briefcase text-success me-2"></i>Business expansion</li>
                                <li class="py-2"><i class="fas fa-briefcase text-success me-2"></i>Renovation of business premises</li>
                                <li class="py-2"><i class="fas fa-briefcase text-success me-2"></i>Inventory financing</li>
                            </ul>
                            
                            <h4 class="mt-4 mb-3">Eligibility</h4>
                            <ul>
                                <li>Business should be operational for minimum 2 years</li>
                                <li>Annual turnover: Minimum ₹10 lakhs</li>
                                <li>Age: 21-65 years</li>
                                <li>Valid business registration & tax clearance</li>
                                <li>Good credit history</li>
                            </ul>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="card sticky-top" style="top: 80px;">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Apply for Business Loan</h5>
                                </div>
                                <div class="card-body">
                                    <form id="businessLoanForm" novalidate>
                                        <div class="mb-3">
                                            <label for="blOwner" class="form-label">Owner Name</label>
                                            <input type="text" class="form-control" id="blOwner" name="owner" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="blBusiness" class="form-label">Business Name</label>
                                            <input type="text" class="form-control" id="blBusiness" name="business" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="blEmail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="blEmail" name="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="blPhone" class="form-label">Phone</label>
                                            <input type="tel" class="form-control" id="blPhone" name="phone" required>
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
    </div>

    <!-- Loan Comparison -->
    <section class="section bg-light">
        <div class="container-lg">
            <div class="section-title">
                <h2>Loan Products Comparison</h2>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Feature</th>
                            <th>Personal Loan</th>
                            <th>Home Loan</th>
                            <th>Vehicle Loan</th>
                            <th>Business Loan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Interest Rate</strong></td>
                            <td>8.5-12.5%</td>
                            <td>7.0-8.5%</td>
                            <td>7.5-9.5%</td>
                            <td>9.0-14.0%</td>
                        </tr>
                        <tr>
                            <td><strong>Loan Amount</strong></td>
                            <td>₹50K-₹25L</td>
                            <td>₹5L-₹2Cr</td>
                            <td>Up to 80% value</td>
                            <td>₹1L-₹1Cr</td>
                        </tr>
                        <tr>
                            <td><strong>Tenure</strong></td>
                            <td>12-60 mo</td>
                            <td>Up to 20 yr</td>
                            <td>12-84 mo</td>
                            <td>12-84 mo</td>
                        </tr>
                        <tr>
                            <td><strong>Collateral</strong></td>
                            <td>None</td>
                            <td>Property</td>
                            <td>Vehicle</td>
                            <td>Optional</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('tenureSlider').addEventListener('input', function() {
            document.getElementById('loanTenure').value = this.value;
            document.getElementById('tenureDisplay').textContent = this.value;
        });
        
        document.getElementById('loanTenure').addEventListener('input', function() {
            document.getElementById('tenureSlider').value = this.value;
            document.getElementById('tenureDisplay').textContent = this.value;
        });
        
        function calculateEMI() {
            const principal = parseFloat(document.getElementById('loanAmount').value);
            const rate = parseFloat(document.getElementById('interestRate').value);
            const months = parseFloat(document.getElementById('loanTenure').value);
            
            if (!principal || !rate || !months) {
                alert('Please fill all fields');
                return;
            }
            
            const emi = calculateEMI_helper(principal, rate, months);
            const totalPayable = emi * months;
            const totalInterest = totalPayable - principal;
            
            document.getElementById('monthlyEMI').textContent = '₹' + emi.toFixed(2);
            document.getElementById('totalPayable').textContent = '₹' + totalPayable.toFixed(2);
            document.getElementById('totalInterest').textContent = '₹' + totalInterest.toFixed(2);
            document.getElementById('emiResult').style.display = 'block';
        }
        
        function calculateEMI_helper(principal, rate, tenure) {
            const monthlyRate = rate / 100 / 12;
            const numberOfMonths = tenure;
            
            if (monthlyRate === 0) {
                return principal / numberOfMonths;
            }
            
            const emi = (principal * monthlyRate * Math.pow(1 + monthlyRate, numberOfMonths)) 
                        / (Math.pow(1 + monthlyRate, numberOfMonths) - 1);
            
            return emi;
        }
    </script>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/footer.php';
?>
