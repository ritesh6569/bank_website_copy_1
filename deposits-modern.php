<?php
/**
 * Modern Deposits Page - 2025-2026 Banking Theme
 * 
 * Features:
 * - Comparison table (responsive card view on mobile)
 * - Interactive APY calculator with slider
 * - Product features grid
 * - Security & protection messaging
 * - Clear CTA for account opening
 * 
 * Usage: Copy to deposits.php after backing it up
 */

$page_title = 'Savings Accounts & Deposits';
include 'includes/header-modern.php';
?>

<!-- ============================================================
     PAGE HERO
     ============================================================ -->
<section class="section" style="background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%); color: white; padding: 4rem 2rem;">
    <div class="section-container">
        <h1 style="color: white; margin-bottom: 1rem;">Premium Savings Accounts</h1>
        <p style="font-size: 1.125rem; max-width: 600px; line-height: 1.8; color: rgba(255, 255, 255, 0.9);">
            Earn industry-leading rates on your savings with FDIC insurance protection up to $250,000. No fees. No minimums. Pure returns.
        </p>
    </div>
</section>

<!-- ============================================================
     COMPARISON TABLE - Responsive
     ============================================================ -->
<section class="section">
    <div class="section-container">
        <div class="section-title">
            <h2>Our Savings Products</h2>
            <p class="section-subtitle">Compare features and find the perfect account for your needs</p>
        </div>
        
        <div style="overflow-x: auto;">
            <table class="comparison-table">
                <thead>
                    <tr>
                        <th>Account Type</th>
                        <th>Current APY</th>
                        <th>Min. Balance</th>
                        <th>Monthly Fee</th>
                        <th>Transactions</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>High Yield Savings</strong></td>
                        <td style="color: var(--color-success); font-weight: 600;">4.50%</td>
                        <td>$0</td>
                        <td>$0</td>
                        <td>Unlimited</td>
                        <td>
                            <button class="btn btn-primary btn-sm">Open</button>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Money Market</strong></td>
                        <td style="color: var(--color-success); font-weight: 600;">4.35%</td>
                        <td>$2,500</td>
                        <td>$0</td>
                        <td>6/month</td>
                        <td>
                            <button class="btn btn-primary btn-sm">Open</button>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>3-Month CD</strong></td>
                        <td style="color: var(--color-success); font-weight: 600;">5.00%</td>
                        <td>$500</td>
                        <td>$0</td>
                        <td>N/A</td>
                        <td>
                            <button class="btn btn-primary btn-sm">Open</button>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>6-Month CD</strong></td>
                        <td style="color: var(--color-success); font-weight: 600;">5.15%</td>
                        <td>$500</td>
                        <td>$0</td>
                        <td>N/A</td>
                        <td>
                            <button class="btn btn-primary btn-sm">Open</button>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>12-Month CD</strong></td>
                        <td style="color: var(--color-success); font-weight: 600;">5.35%</td>
                        <td>$500</td>
                        <td>$0</td>
                        <td>N/A</td>
                        <td>
                            <button class="btn btn-primary btn-sm">Open</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- ============================================================
     INTERACTIVE APY CALCULATOR
     ============================================================ -->
<section class="section" style="background: var(--color-bg-secondary);">
    <div class="section-container">
        <div class="section-title">
            <h2>Calculate Your Earnings</h2>
            <p class="section-subtitle">See how much your savings can grow with our competitive rates</p>
        </div>
        
        <div style="
            max-width: 600px;
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            margin: 0 auto;
        ">
            <div class="form-group">
                <label class="form-label">Initial Deposit</label>
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <span style="font-size: 1.5rem; color: var(--color-primary);">$</span>
                    <input 
                        type="range" 
                        id="deposit-amount" 
                        min="0" 
                        max="100000" 
                        value="10000" 
                        style="flex: 1;"
                    >
                </div>
                <div style="display: flex; justify-content: space-between; margin-top: 0.5rem; font-size: 0.875rem; color: var(--color-text-tertiary);">
                    <span>$0</span>
                    <span id="deposit-display" style="font-weight: 600; color: var(--color-primary);">$10,000</span>
                    <span>$100,000</span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Time Period</label>
                <select id="time-period" class="form-input">
                    <option value="1">1 Month</option>
                    <option value="3">3 Months</option>
                    <option value="6">6 Months</option>
                    <option value="12" selected>1 Year</option>
                    <option value="60">5 Years</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Account Type</label>
                <select id="account-type" class="form-input">
                    <option value="4.50">High Yield Savings (4.50%)</option>
                    <option value="4.35">Money Market (4.35%)</option>
                    <option value="5.00">3-Month CD (5.00%)</option>
                    <option value="5.15">6-Month CD (5.15%)</option>
                    <option value="5.35">12-Month CD (5.35%)</option>
                </select>
            </div>
            
            <!-- Results -->
            <div style="
                background: linear-gradient(135deg, var(--color-primary-lighter) 0%, rgba(59, 130, 246, 0.05) 100%);
                border: 1px solid var(--color-border);
                border-radius: 12px;
                padding: 1.5rem;
                margin-top: 2rem;
            ">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div>
                        <p style="font-size: 0.875rem; color: var(--color-text-tertiary); margin: 0 0 0.5rem 0;">Total Interest Earned</p>
                        <p id="interest-earned" style="font-size: 2rem; font-weight: 700; color: var(--color-success); margin: 0;">
                            $450
                        </p>
                    </div>
                    <div>
                        <p style="font-size: 0.875rem; color: var(--color-text-tertiary); margin: 0 0 0.5rem 0;">Final Balance</p>
                        <p id="final-balance" style="font-size: 2rem; font-weight: 700; color: var(--color-primary); margin: 0;">
                            $10,450
                        </p>
                    </div>
                </div>
            </div>
            
            <button class="btn btn-primary" style="width: 100%; margin-top: 1.5rem;">
                Open High Yield Savings
            </button>
        </div>
    </div>
</section>

<!-- ============================================================
     FEATURES & BENEFITS
     ============================================================ -->
<section class="section">
    <div class="section-container">
        <div class="section-title">
            <h2>Why Our Savings Accounts</h2>
            <p class="section-subtitle">Industry-leading benefits designed with you in mind</p>
        </div>
        
        <div class="grid grid-2 fade-in-on-scroll">
            <!-- Feature 1 -->
            <div class="card">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <div style="
                        width: 50px;
                        height: 50px;
                        background: rgba(5, 150, 105, 0.1);
                        border-radius: 12px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: var(--color-success);
                    ">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <div>
                        <h4 style="margin: 0;">Competitive Rates</h4>
                    </div>
                </div>
                <p>
                    Industry-leading APY rates updated monthly. Earn more on your savings compared to traditional banks.
                </p>
            </div>
            
            <!-- Feature 2 -->
            <div class="card">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <div style="
                        width: 50px;
                        height: 50px;
                        background: rgba(5, 150, 105, 0.1);
                        border-radius: 12px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: var(--color-success);
                    ">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div>
                        <h4 style="margin: 0;">FDIC Insured</h4>
                    </div>
                </div>
                <p>
                    All deposits protected up to $250,000 by FDIC insurance. Your money is safe with us.
                </p>
            </div>
            
            <!-- Feature 3 -->
            <div class="card">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <div style="
                        width: 50px;
                        height: 50px;
                        background: rgba(5, 150, 105, 0.1);
                        border-radius: 12px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: var(--color-success);
                    ">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div>
                        <h4 style="margin: 0;">No Fees</h4>
                    </div>
                </div>
                <p>
                    Zero monthly maintenance fees, no minimum balance requirements. Pure savings, no surprises.
                </p>
            </div>
            
            <!-- Feature 4 -->
            <div class="card">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <div style="
                        width: 50px;
                        height: 50px;
                        background: rgba(5, 150, 105, 0.1);
                        border-radius: 12px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: var(--color-success);
                    ">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <div>
                        <h4 style="margin: 0;">24/7 Access</h4>
                    </div>
                </div>
                <p>
                    Manage your account anytime, anywhere. Mobile app and web platform available 24/7.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     FAQ
     ============================================================ -->
<section class="section" style="background: var(--color-bg-secondary);">
    <div class="section-container">
        <div class="section-title">
            <h2>Frequently Asked Questions</h2>
        </div>
        
        <div style="max-width: 700px; margin: 0 auto;">
            <div style="margin-bottom: 1rem;">
                <button class="btn btn-ghost" style="width: 100%; justify-content: space-between; text-align: left;" onclick="toggleFAQ(this)">
                    <span>How do I open an account?</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div style="display: none; padding: 1rem 1.5rem; background: white; border-radius: 0 0 12px 12px; border: 1px solid var(--color-border); border-top: none;">
                    <p>Opening an account takes just 5 minutes. You'll need a valid ID, Social Security number, and initial deposit of as little as $0. All done online in minutes.</p>
                </div>
            </div>
            
            <div style="margin-bottom: 1rem;">
                <button class="btn btn-ghost" style="width: 100%; justify-content: space-between; text-align: left;" onclick="toggleFAQ(this)">
                    <span>Is my money safe?</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div style="display: none; padding: 1rem 1.5rem; background: white; border-radius: 0 0 12px 12px; border: 1px solid var(--color-border); border-top: none;">
                    <p>Yes. All deposits are protected by FDIC insurance up to $250,000. We also use 256-bit encryption and advanced security measures.</p>
                </div>
            </div>
            
            <div style="margin-bottom: 1rem;">
                <button class="btn btn-ghost" style="width: 100%; justify-content: space-between; text-align: left;" onclick="toggleFAQ(this)">
                    <span>When is interest paid?</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div style="display: none; padding: 1rem 1.5rem; background: white; border-radius: 0 0 12px 12px; border: 1px solid var(--color-border); border-top: none;">
                    <p>Interest is compounded daily and paid monthly on the last business day of each month. Your earnings automatically add to your balance.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // APY Calculator
    function updateCalculator() {
        const deposit = parseFloat(document.getElementById('deposit-amount').value);
        const months = parseFloat(document.getElementById('time-period').value);
        const apy = parseFloat(document.getElementById('account-type').value);
        
        const monthlyRate = apy / 100 / 12;
        const finalBalance = deposit * Math.pow(1 + monthlyRate, months);
        const interest = finalBalance - deposit;
        
        document.getElementById('deposit-display').textContent = '$' + deposit.toLocaleString();
        document.getElementById('interest-earned').textContent = '$' + interest.toLocaleString('en-US', { maximumFractionDigits: 2 });
        document.getElementById('final-balance').textContent = '$' + finalBalance.toLocaleString('en-US', { maximumFractionDigits: 2 });
    }
    
    document.getElementById('deposit-amount').addEventListener('input', updateCalculator);
    document.getElementById('time-period').addEventListener('change', updateCalculator);
    document.getElementById('account-type').addEventListener('change', updateCalculator);
    
    // Initialize
    updateCalculator();
    
    // FAQ Toggle
    function toggleFAQ(button) {
        const answer = button.nextElementSibling;
        const isOpen = answer.style.display !== 'none';
        
        document.querySelectorAll('.btn-ghost').forEach(b => {
            b.nextElementSibling.style.display = 'none';
            b.querySelector('i').style.transform = 'rotate(0)';
        });
        
        if (!isOpen) {
            answer.style.display = 'block';
            button.querySelector('i').style.transform = 'rotate(180deg)';
        }
    }
</script>

<?php include 'includes/footer-modern.php'; ?>
