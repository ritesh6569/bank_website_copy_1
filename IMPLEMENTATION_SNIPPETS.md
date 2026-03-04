# Modern Banking Theme - Page Implementation Snippets

## Overview

This document provides copy-paste ready code snippets for implementing the modern theme on all your pages. Each section corresponds to a different page type.

---

## Template: Basic Page Structure

Use this as the template for any page:

```php
<?php
/**
 * Page Title - Modern Banking Theme
 */

$page_title = 'Page Title Here';
include 'includes/header-modern.php';
?>

<!-- Page content sections go here -->

<?php include 'includes/footer-modern.php'; ?>
```

---

## 1. ABOUT US PAGE (about.php)

### Hero Section
```html
<section class="section" style="background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%); color: white; padding: 4rem 2rem;">
    <div class="section-container">
        <h1 style="color: white; margin-bottom: 1rem;">About Modern Bank</h1>
        <p style="font-size: 1.125rem; max-width: 600px; line-height: 1.8; color: rgba(255, 255, 255, 0.9);">
            Founded in 2024, we're revolutionizing digital banking with institutional credibility, transparency, and user-centric design.
        </p>
    </div>
</section>
```

### Team Grid
```html
<section class="section">
    <div class="section-container">
        <div class="section-title">
            <h2>Our Leadership Team</h2>
            <p class="section-subtitle">Industry veterans with 150+ years combined experience</p>
        </div>
        
        <div class="grid grid-3">
            <!-- Team Member 1 -->
            <div class="card fade-in-on-scroll" style="text-align: center;">
                <div style="
                    width: 120px;
                    height: 120px;
                    background: linear-gradient(135deg, var(--color-primary-lighter), rgba(59, 130, 246, 0.1));
                    border-radius: 50%;
                    margin: 0 auto 1rem;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 2.5rem;
                    color: var(--color-primary);
                ">
                    <i class="fas fa-user"></i>
                </div>
                <h4>John Smith</h4>
                <p style="color: var(--color-text-tertiary); margin-bottom: 1rem;">CEO & Founder</p>
                <p style="font-size: 0.875rem;">20+ years in fintech. Former VP at leading digital bank.</p>
                <div style="margin-top: 1rem; display: flex; justify-content: center; gap: 1rem;">
                    <a href="#" style="color: var(--color-primary);">LinkedIn</a>
                    <a href="#" style="color: var(--color-primary);">Twitter</a>
                </div>
            </div>
            
            <!-- Repeat for other team members -->
        </div>
    </div>
</section>
```

### Company Mission & Values
```html
<section class="section" style="background: var(--color-bg-secondary);">
    <div class="section-container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-2xl); align-items: center;">
            <!-- Left: Mission -->
            <div>
                <h2>Our Mission</h2>
                <p style="font-size: 1.125rem; line-height: 1.8; color: var(--color-text-secondary);">
                    To make premium digital banking accessible to everyone by combining institutional credibility with user-centric innovation. We believe banking should be transparent, secure, and simple.
                </p>
            </div>
            
            <!-- Right: Values Grid -->
            <div class="grid grid-2" style="gap: var(--space-md);">
                <div style="padding: var(--space-lg); background: white; border-radius: 12px; border-left: 4px solid var(--color-primary);">
                    <h5 style="color: var(--color-primary); margin-bottom: 0.5rem;">
                        <i class="fas fa-shield-alt"></i> Security
                    </h5>
                    <p style="font-size: 0.875rem; margin: 0;">Bank-grade encryption and multi-layer protection</p>
                </div>
                <div style="padding: var(--space-lg); background: white; border-radius: 12px; border-left: 4px solid var(--color-info);">
                    <h5 style="color: var(--color-info); margin-bottom: 0.5rem;">
                        <i class="fas fa-eye"></i> Transparency
                    </h5>
                    <p style="font-size: 0.875rem; margin: 0;">Zero hidden fees, all rates clearly displayed</p>
                </div>
                <div style="padding: var(--space-lg); background: white; border-radius: 12px; border-left: 4px solid var(--color-success);">
                    <h5 style="color: var(--color-success); margin-bottom: 0.5rem;">
                        <i class="fas fa-user"></i> User-Centric
                    </h5>
                    <p style="font-size: 0.875rem; margin: 0;">Design and features driven by customer needs</p>
                </div>
                <div style="padding: var(--space-lg); background: white; border-radius: 12px; border-left: 4px solid var(--color-warning);">
                    <h5 style="color: var(--color-warning); margin-bottom: 0.5rem;">
                        <i class="fas fa-star"></i> Excellence
                    </h5>
                    <p style="font-size: 0.875rem; margin: 0;">24/7 customer support and continuous innovation</p>
                </div>
            </div>
        </div>
    </div>
</section>
```

### Timeline
```html
<section class="section">
    <div class="section-container">
        <div class="section-title">
            <h2>Our Journey</h2>
        </div>
        
        <div style="max-width: 700px; margin: 0 auto;">
            <div style="display: flex; gap: 2rem; margin-bottom: 2rem;">
                <div style="
                    width: 40px;
                    height: 40px;
                    background: var(--color-primary);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-weight: bold;
                    flex-shrink: 0;
                    margin-top: 0.5rem;
                ">1</div>
                <div>
                    <h4>2024 - Founded</h4>
                    <p>Modern Bank launches with a mission to revolutionize digital banking</p>
                </div>
            </div>
            
            <div style="display: flex; gap: 2rem; margin-bottom: 2rem;">
                <div style="
                    width: 40px;
                    height: 40px;
                    background: var(--color-primary);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-weight: bold;
                    flex-shrink: 0;
                    margin-top: 0.5rem;
                ">2</div>
                <div>
                    <h4>Q2 2024 - 10,000+ Customers</h4>
                    <p>Reach 10,000 active accounts with 4.8/5 customer satisfaction</p>
                </div>
            </div>
            
            <!-- Add more timeline items -->
        </div>
    </div>
</section>
```

---

## 2. LOANS PAGE (loans.php)

### Loan Comparison
```html
<section class="section">
    <div class="section-container">
        <div class="section-title">
            <h2>Our Loan Products</h2>
        </div>
        
        <div class="grid grid-3">
            <div class="card" style="border-top: 4px solid var(--color-primary);">
                <h3 style="margin-bottom: 0.5rem;">Personal Loans</h3>
                <p style="font-size: 1.5rem; color: var(--color-success); font-weight: 700; margin-bottom: 1rem;">
                    From 5.9% APR
                </p>
                <ul style="list-style: none; color: var(--color-text-secondary); font-size: 0.875rem;">
                    <li>✓ Up to $50,000</li>
                    <li>✓ 3-7 year terms</li>
                    <li>✓ Quick approval</li>
                    <li>✓ No prepayment penalty</li>
                    <li>✓ Flexible repayment</li>
                </ul>
                <button class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Apply Now</button>
            </div>
            
            <div class="card" style="border-top: 4px solid var(--color-info); transform: scale(1.05);">
                <h3 style="margin-bottom: 0.5rem;">Home Equity Loans</h3>
                <p style="font-size: 1.5rem; color: var(--color-success); font-weight: 700; margin-bottom: 1rem;">
                    From 6.5% APR
                </p>
                <ul style="list-style: none; color: var(--color-text-secondary); font-size: 0.875rem;">
                    <li>✓ Up to $200,000</li>
                    <li>✓ 5-15 year terms</li>
                    <li>✓ Low rates</li>
                    <li>✓ Tax benefits</li>
                    <li>✓ Refinancing available</li>
                </ul>
                <button class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Apply Now</button>
                <p style="text-align: center; font-size: 0.75rem; margin-top: 1rem; color: var(--color-text-tertiary);">Most Popular</p>
            </div>
            
            <div class="card" style="border-top: 4px solid var(--color-warning);">
                <h3 style="margin-bottom: 0.5rem;">Business Loans</h3>
                <p style="font-size: 1.5rem; color: var(--color-success); font-weight: 700; margin-bottom: 1rem;">
                    From 6.9% APR
                </p>
                <ul style="list-style: none; color: var(--color-text-secondary); font-size: 0.875rem;">
                    <li>✓ Up to $500,000</li>
                    <li>✓ Flexible terms</li>
                    <li>✓ Quick funding</li>
                    <li>✓ Working capital</li>
                    <li>✓ Growth capital</li>
                </ul>
                <button class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Apply Now</button>
            </div>
        </div>
    </div>
</section>
```

### EMI Calculator
```html
<section class="section" style="background: var(--color-bg-secondary);">
    <div class="section-container">
        <div class="section-title">
            <h2>Loan EMI Calculator</h2>
            <p class="section-subtitle">See exactly what your monthly payments will be</p>
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
                <label class="form-label">Loan Amount</label>
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <span style="font-size: 1.5rem; color: var(--color-primary);">$</span>
                    <input 
                        type="range" 
                        id="loan-amount" 
                        min="1000" 
                        max="100000" 
                        value="25000" 
                        step="1000"
                        style="flex: 1;"
                    >
                </div>
                <div style="display: flex; justify-content: space-between; margin-top: 0.5rem; font-size: 0.875rem;">
                    <span>$1K</span>
                    <span id="loan-display" style="font-weight: 600; color: var(--color-primary);">$25,000</span>
                    <span>$100K</span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Interest Rate (APR)</label>
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <input 
                        type="range" 
                        id="loan-rate" 
                        min="2" 
                        max="15" 
                        value="6.5" 
                        step="0.1"
                        style="flex: 1;"
                    >
                    <span id="rate-display" style="min-width: 40px; text-align: right; color: var(--color-primary); font-weight: 600;">6.5%</span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Loan Term (Months)</label>
                <select id="loan-term" class="form-input">
                    <option value="12">1 Year</option>
                    <option value="24">2 Years</option>
                    <option value="36">3 Years</option>
                    <option value="48">4 Years</option>
                    <option value="60" selected>5 Years</option>
                    <option value="84">7 Years</option>
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
                        <p style="font-size: 0.875rem; color: var(--color-text-tertiary); margin: 0 0 0.5rem 0;">Monthly Payment</p>
                        <p id="monthly-payment" style="font-size: 2rem; font-weight: 700; color: var(--color-primary); margin: 0;">
                            $450/mo
                        </p>
                    </div>
                    <div>
                        <p style="font-size: 0.875rem; color: var(--color-text-tertiary); margin: 0 0 0.5rem 0;">Total Interest</p>
                        <p id="total-interest" style="font-size: 2rem; font-weight: 700; color: var(--color-warning); margin: 0;">
                            $2,850
                        </p>
                    </div>
                </div>
            </div>
            
            <button class="btn btn-primary" style="width: 100%; margin-top: 1.5rem;">Get Loan Quote</button>
        </div>
    </div>
</section>

<script>
    function calculateEMI() {
        const principal = parseFloat(document.getElementById('loan-amount').value);
        const rate = parseFloat(document.getElementById('loan-rate').value) / 100 / 12;
        const months = parseInt(document.getElementById('loan-term').value);
        
        const numerator = principal * rate * Math.pow(1 + rate, months);
        const denominator = Math.pow(1 + rate, months) - 1;
        const emi = numerator / denominator;
        
        const totalAmount = emi * months;
        const totalInterest = totalAmount - principal;
        
        document.getElementById('loan-display').textContent = '$' + principal.toLocaleString();
        document.getElementById('rate-display').textContent = document.getElementById('loan-rate').value + '%';
        document.getElementById('monthly-payment').textContent = '$' + emi.toLocaleString('en-US', { maximumFractionDigits: 0 }) + '/mo';
        document.getElementById('total-interest').textContent = '$' + totalInterest.toLocaleString('en-US', { maximumFractionDigits: 0 });
    }
    
    document.getElementById('loan-amount').addEventListener('input', calculateEMI);
    document.getElementById('loan-rate').addEventListener('input', calculateEMI);
    document.getElementById('loan-term').addEventListener('change', calculateEMI);
    
    calculateEMI();
</script>
```

---

## 3. SERVICES PAGE (services.php)

### Services Grid with Icons
```html
<section class="section">
    <div class="section-container">
        <div class="section-title">
            <h2>Our Services</h2>
            <p class="section-subtitle">Comprehensive financial solutions for your needs</p>
        </div>
        
        <div class="grid grid-3">
            <div class="card fade-in-on-scroll">
                <div style="
                    width: 70px;
                    height: 70px;
                    background: linear-gradient(135deg, var(--color-primary-light), var(--color-primary));
                    border-radius: 16px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-size: 2rem;
                    margin-bottom: 1rem;
                ">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3>Mobile Banking</h3>
                <p>Bank on the go with our powerful mobile app. Full account management, transfers, and bill pay.</p>
                <a href="#" style="color: var(--color-primary); font-weight: 600;">Learn more →</a>
            </div>
            
            <div class="card fade-in-on-scroll">
                <div style="
                    width: 70px;
                    height: 70px;
                    background: linear-gradient(135deg, var(--color-info), #06b6d4);
                    border-radius: 16px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-size: 2rem;
                    margin-bottom: 1rem;
                ">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <h3>Money Transfer</h3>
                <p>Send money domestically or internationally with competitive rates and fast processing.</p>
                <a href="#" style="color: var(--color-primary); font-weight: 600;">Learn more →</a>
            </div>
            
            <div class="card fade-in-on-scroll">
                <div style="
                    width: 70px;
                    height: 70px;
                    background: linear-gradient(135deg, var(--color-success), #10b981);
                    border-radius: 16px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-size: 2rem;
                    margin-bottom: 1rem;
                ">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <h3>Bill Pay</h3>
                <p>Pay all your bills online in one place. Schedule payments, set up recurring bills, and stay organized.</p>
                <a href="#" style="color: var(--color-primary); font-weight: 600;">Learn more →</a>
            </div>
        </div>
    </div>
</section>
```

---

## 4. CONTACT PAGE (contact.php)

### Contact Form Section
```html
<section class="section">
    <div class="section-container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-2xl);">
            <!-- Left: Info -->
            <div>
                <h2>Get in Touch</h2>
                <p style="color: var(--color-text-secondary); line-height: 1.8; margin-bottom: 2rem;">
                    Have questions? Our dedicated support team is here to help. Reach out to us through any of these channels.
                </p>
                
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <div style="display: flex; gap: 1rem;">
                        <div style="
                            width: 50px;
                            height: 50px;
                            background: var(--color-primary-lighter);
                            border-radius: 12px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: var(--color-primary);
                            flex-shrink: 0;
                        ">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h4 style="margin: 0 0 0.25rem 0;">Phone</h4>
                            <p style="margin: 0; color: var(--color-text-secondary);">1-800-BANK-123<br>Mon-Fri, 8am-9pm EST</p>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 1rem;">
                        <div style="
                            width: 50px;
                            height: 50px;
                            background: var(--color-primary-lighter);
                            border-radius: 12px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: var(--color-primary);
                            flex-shrink: 0;
                        ">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4 style="margin: 0 0 0.25rem 0;">Email</h4>
                            <p style="margin: 0; color: var(--color-text-secondary);">support@modernbank.com<br>Typical response: 2 hours</p>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 1rem;">
                        <div style="
                            width: 50px;
                            height: 50px;
                            background: var(--color-primary-lighter);
                            border-radius: 12px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: var(--color-primary);
                            flex-shrink: 0;
                        ">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4 style="margin: 0 0 0.25rem 0;">Address</h4>
                            <p style="margin: 0; color: var(--color-text-secondary);">123 Financial Ave<br>New York, NY 10001</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right: Form -->
            <form method="POST" action="/api.php" onsubmit="return handleContactForm(event)" style="
                background: var(--color-bg-secondary);
                padding: 2rem;
                border-radius: 16px;
                border: 1px solid var(--color-border);
            ">
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Subject</label>
                    <select name="subject" class="form-input" required>
                        <option>Account Help</option>
                        <option>Loan Inquiry</option>
                        <option>Technical Support</option>
                        <option>Other</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Message</label>
                    <textarea name="message" placeholder="Your message..." required></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
            </form>
        </div>
    </div>
</section>

<script>
    function handleContactForm(event) {
        event.preventDefault();
        const form = event.target;
        
        console.log('Contact form submitted:', {
            name: form.name.value,
            email: form.email.value,
            subject: form.subject.value,
            message: form.message.value
        });
        
        // Here you'd send to your backend
        alert('Thank you for your message. We\'ll get back to you shortly!');
        form.reset();
        return false;
    }
</script>
```

---

## Quick Implementation Summary

Each page follows this pattern:

1. **Open with modern header**
   ```php
   <?php
   $page_title = 'Your Page Title';
   include 'includes/header-modern.php';
   ?>
   ```

2. **Add hero/intro section**
   ```html
   <section class="section" style="background: linear-gradient(...);">
       <div class="section-container">
           <h1>Page Title</h1>
           <p>Page description</p>
       </div>
   </section>
   ```

3. **Add content sections with modern classes**
   - Use `.section` for sections
   - Use `.grid`, `.grid-2`, `.grid-3` for layouts
   - Use `.card` for content boxes
   - Use `.fade-in-on-scroll` for animations

4. **Close with modern footer**
   ```php
   <?php include 'includes/footer-modern.php'; ?>
   ```

---

**All snippets use Bootstrap 5 grid system, Font Awesome icons, and CSS variables. Copy and customize as needed!**
