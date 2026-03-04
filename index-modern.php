<?php
/**
 * Modern Homepage - 2025-2026 Banking Theme
 * 
 * Design Features:
 * - 100vh hero with gradient & wave divider
 * - Trust bar with FDIC/security badges
 * - Asymmetric bento grid for products/offers
 * - Carousel for product highlights
 * - News & inquiry section
 * - Branches teaser
 * - Fully responsive mobile-first
 * - Intersection Observer scroll animations
 * 
 * Usage: Navigate to index.php in browser
 */

$page_title = 'Home';
include 'includes/header-modern.php';
?>

<!-- ============================================================
     HERO SECTION - 100vh Premium Banking Experience
     ============================================================ -->
<section class="hero">
    <div class="hero-container">
        <!-- Left: Content -->
        <div class="hero-content">
            <h1>The Future of Banking</h1>
            <p class="hero-subtitle">
                Experience modern digital banking with institutional credibility, transparent fees, competitive rates, and security you can trust. Join thousands of users who've switched to smarter banking.
            </p>
            <div class="hero-ctas">
                <a href="/deposits.php" class="btn btn-primary">
                    <i class="fas fa-arrow-right"></i> Open Account
                </a>
                <a href="#learn-more" class="btn btn-secondary">
                    <i class="fas fa-info-circle"></i> Learn More
                </a>
            </div>
        </div>
        
        <!-- Right: Visual (Placeholder for image) -->
        <div class="hero-image">
            <div style="
                width: 100%;
                height: 400px;
                background: linear-gradient(135deg, var(--color-primary-lighter) 0%, rgba(59, 130, 246, 0.1) 100%);
                border-radius: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 120px;
                color: var(--color-primary-light);
                opacity: 0.8;
            ">
                <i class="fas fa-mobile-alt"></i>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     TRUST BAR - Security & Credibility Signals
     ============================================================ -->
<section class="trust-bar">
    <div class="trust-container">
        <div class="trust-item">
            <i class="fas fa-shield-alt trust-icon"></i>
            <span><strong>FDIC Member</strong> — Deposits insured up to $250,000</span>
        </div>
        <div class="trust-item">
            <i class="fas fa-lock trust-icon"></i>
            <span><strong>256-bit Encryption</strong> — Bank-grade security</span>
        </div>
        <div class="trust-item">
            <i class="fas fa-certificate trust-icon"></i>
            <span><strong>Industry Recognized</strong> — Best digital banking platform 2024</span>
        </div>
    </div>
</section>

<!-- ============================================================
     HIGHLIGHTS & OFFERS - Asymmetric Bento Grid
     ============================================================ -->
<section class="section" style="background: var(--color-bg-secondary);">
    <div class="section-container">
        <div class="section-title">
            <h2>Why Choose Us</h2>
            <p class="section-subtitle">Premium banking features designed for modern financial lives</p>
        </div>
        
        <div class="bento-grid">
            <!-- Feature 1: High Yields -->
            <div class="bento-item card">
                <div class="card-header">
                    <div style="font-size: 3rem; color: var(--color-primary);">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div>
                        <h3>Competitive Rates</h3>
                    </div>
                </div>
                <p>
                    Earn industry-leading APY on savings and deposit accounts. Rates updated monthly to reflect market conditions.
                </p>
                <a href="/deposits.php" style="color: var(--color-primary); font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                    View rates <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <!-- Feature 2: Zero Fees -->
            <div class="bento-item card">
                <div class="card-header">
                    <div style="font-size: 3rem; color: var(--color-primary);">
                        <i class="fas fa-smile"></i>
                    </div>
                    <div>
                        <h3>No Hidden Fees</h3>
                    </div>
                </div>
                <p>
                    Complete transparency. No monthly fees, no minimum balance requirements, no surprise charges. What you see is what you pay.
                </p>
                <a href="#" style="color: var(--color-primary); font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                    See fee schedule <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <!-- Feature 3: Mobile-First -->
            <div class="bento-item card">
                <div class="card-header">
                    <div style="font-size: 3rem; color: var(--color-primary);">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <div>
                        <h3>Banking Anywhere</h3>
                    </div>
                </div>
                <p>
                    Powerful mobile app and web platform. Manage accounts, transfer funds, and pay bills from anywhere, anytime.
                </p>
                <a href="#" style="color: var(--color-primary); font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                    Download app <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <!-- Feature 4: Security Badges -->
            <div class="bento-item card">
                <div class="card-header">
                    <div style="font-size: 3rem; color: var(--color-success);">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <h3>Bank-Grade Security</h3>
                    </div>
                </div>
                <p>
                    Military-grade encryption, multi-factor authentication, and continuous fraud monitoring. Your money is protected 24/7.
                </p>
                <a href="#" style="color: var(--color-primary); font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                    Learn about security <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <!-- Feature 5: 24/7 Support -->
            <div class="bento-item card">
                <div class="card-header">
                    <div style="font-size: 3rem; color: var(--color-primary);">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div>
                        <h3>Always Available</h3>
                    </div>
                </div>
                <p>
                    Dedicated customer support available 24/7 via chat, email, and phone. Typical response time: under 2 minutes.
                </p>
                <a href="/contact.php" style="color: var(--color-primary); font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                    Contact support <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <!-- Feature 6: Eco-Friendly -->
            <div class="bento-item card">
                <div class="card-header">
                    <div style="font-size: 3rem; color: var(--color-primary);">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <div>
                        <h3>Eco-Conscious Banking</h3>
                    </div>
                </div>
                <p>
                    100% paperless operations with carbon-neutral infrastructure. Banking without the environmental cost.
                </p>
                <a href="/about.php" style="color: var(--color-primary); font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                    Our impact <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     PRODUCTS SHOWCASE - Interactive Cards
     ============================================================ -->
<section class="section">
    <div class="section-container">
        <div class="section-title">
            <h2>Our Products</h2>
            <p class="section-subtitle">Comprehensive financial solutions tailored to your needs</p>
        </div>
        
        <div class="grid grid-3 fade-in-on-scroll">
            <!-- Savings Account Product -->
            <div class="card" style="border-left: 4px solid var(--color-primary);">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <div style="
                        width: 60px;
                        height: 60px;
                        background: linear-gradient(135deg, var(--color-primary-light), var(--color-primary));
                        border-radius: 16px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: white;
                        font-size: 1.5rem;
                    ">
                        <i class="fas fa-piggy-bank"></i>
                    </div>
                    <div>
                        <h4 style="margin: 0;">Savings Account</h4>
                        <p style="margin: 0; font-size: 0.875rem; color: var(--color-text-tertiary);">Starting at 4.5% APY</p>
                    </div>
                </div>
                <p>
                    High-yield savings with no monthly fees, no minimum balance, and unlimited deposits. FDIC insured up to $250,000.
                </p>
                <a href="/deposits.php" class="btn btn-primary btn-sm" style="width: 100%; margin-top: 1rem;">
                    Open Account
                </a>
            </div>
            
            <!-- Loan Product -->
            <div class="card" style="border-left: 4px solid var(--color-info);">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <div style="
                        width: 60px;
                        height: 60px;
                        background: linear-gradient(135deg, var(--color-info), #06b6d4);
                        border-radius: 16px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: white;
                        font-size: 1.5rem;
                    ">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div>
                        <h4 style="margin: 0;">Personal Loans</h4>
                        <p style="margin: 0; font-size: 0.875rem; color: var(--color-text-tertiary);">From 5.9% APR</p>
                    </div>
                </div>
                <p>
                    Fast, flexible loans up to $50,000. Quick approval, competitive rates, and flexible repayment terms.
                </p>
                <a href="/loans.php" class="btn btn-primary btn-sm" style="width: 100%; margin-top: 1rem;">
                    Apply Now
                </a>
            </div>
            
            <!-- Credit Card Product -->
            <div class="card" style="border-left: 4px solid var(--color-warning);">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <div style="
                        width: 60px;
                        height: 60px;
                        background: linear-gradient(135deg, var(--color-warning), #fbbf24);
                        border-radius: 16px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: white;
                        font-size: 1.5rem;
                    ">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div>
                        <h4 style="margin: 0;">Premium Card</h4>
                        <p style="margin: 0; font-size: 0.875rem; color: var(--color-text-tertiary);">2% Cashback</p>
                    </div>
                </div>
                <p>
                    Earn 2% cashback on all purchases. No annual fee, no foreign transaction fees, travel rewards included.
                </p>
                <a href="#" class="btn btn-primary btn-sm" style="width: 100%; margin-top: 1rem;">
                    Get Card
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     CTA SECTION - Quick Inquiry
     ============================================================ -->
<section class="section" style="background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);">
    <div class="section-container">
        <div style="
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--space-2xl);
            align-items: center;
            color: white;
        ">
            <!-- Left: Content -->
            <div>
                <h2 style="color: white; margin-bottom: 1rem;">Ready to Switch?</h2>
                <p style="color: rgba(255, 255, 255, 0.9); font-size: 1.125rem; line-height: 1.8;">
                    Switching to modern banking takes minutes. No paperwork. No hassle. Join thousands of satisfied customers today.
                </p>
                <ul style="list-style: none; margin-top: 1.5rem;">
                    <li style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
                        <i class="fas fa-check-circle"></i> Instant account opening
                    </li>
                    <li style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
                        <i class="fas fa-check-circle"></i> Easy fund transfer
                    </li>
                    <li style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
                        <i class="fas fa-check-circle"></i> Complete control
                    </li>
                </ul>
            </div>
            
            <!-- Right: Form -->
            <div style="
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                padding: 2rem;
                border-radius: 16px;
            ">
                <h3 style="color: white; margin-bottom: 1.5rem;">Get Started</h3>
                <form method="POST" onsubmit="return handleQuickInquiry(event)">
                    <div class="form-group">
                        <input 
                            type="text" 
                            name="name" 
                            class="form-input" 
                            placeholder="Full Name" 
                            required
                            style="
                                background: rgba(255, 255, 255, 0.1);
                                border-color: rgba(255, 255, 255, 0.3);
                                color: white;
                            ">
                    </div>
                    <div class="form-group">
                        <input 
                            type="email" 
                            name="email" 
                            class="form-input" 
                            placeholder="Email Address" 
                            required
                            style="
                                background: rgba(255, 255, 255, 0.1);
                                border-color: rgba(255, 255, 255, 0.3);
                                color: white;
                            ">
                    </div>
                    <div class="form-group">
                        <select 
                            name="interest" 
                            class="form-input"
                            style="
                                background: rgba(255, 255, 255, 0.1);
                                border-color: rgba(255, 255, 255, 0.3);
                                color: white;
                            ">
                            <option style="color: var(--color-text-primary);">I'm interested in...</option>
                            <option style="color: var(--color-text-primary);">Savings Account</option>
                            <option style="color: var(--color-text-primary);">Personal Loan</option>
                            <option style="color: var(--color-text-primary);">Credit Card</option>
                            <option style="color: var(--color-text-primary);">General Information</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        <i class="fas fa-arrow-right"></i> Get Started
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     NEWS & UPDATES
     ============================================================ -->
<section class="section" style="background: var(--color-bg-secondary);">
    <div class="section-container">
        <div class="section-title">
            <h2>Latest News & Updates</h2>
            <p class="section-subtitle">Stay informed with the latest banking news and product announcements</p>
        </div>
        
        <div class="grid grid-3">
            <!-- News 1 -->
            <div class="card fade-in-on-scroll">
                <div style="
                    height: 160px;
                    background: linear-gradient(135deg, var(--color-primary-lighter), rgba(59, 130, 246, 0.05));
                    border-radius: 12px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-bottom: 1rem;
                    font-size: 3rem;
                    color: var(--color-primary);
                ">
                    <i class="fas fa-bolt"></i>
                </div>
                <h4>New Feature: Instant Transfers</h4>
                <p>Send money between accounts instantly with our new same-day transfer feature. No delays, no fees.</p>
                <small style="color: var(--color-text-tertiary);">March 2026</small>
            </div>
            
            <!-- News 2 -->
            <div class="card fade-in-on-scroll">
                <div style="
                    height: 160px;
                    background: linear-gradient(135deg, rgba(6, 182, 212, 0.1), rgba(6, 182, 212, 0.05));
                    border-radius: 12px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-bottom: 1rem;
                    font-size: 3rem;
                    color: var(--color-info);
                ">
                    <i class="fas fa-award"></i>
                </div>
                <h4>Award: Best Digital Bank 2026</h4>
                <p>We're honored to be recognized as the best digital banking platform for the third consecutive year.</p>
                <small style="color: var(--color-text-tertiary);">February 2026</small>
            </div>
            
            <!-- News 3 -->
            <div class="card fade-in-on-scroll">
                <div style="
                    height: 160px;
                    background: linear-gradient(135deg, rgba(5, 150, 105, 0.1), rgba(5, 150, 105, 0.05));
                    border-radius: 12px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-bottom: 1rem;
                    font-size: 3rem;
                    color: var(--color-success);
                ">
                    <i class="fas fa-leaf"></i>
                </div>
                <h4>Going Carbon Neutral</h4>
                <p>We've achieved carbon neutrality across all our operations. Banking without the environmental cost.</p>
                <small style="color: var(--color-text-tertiary);">January 2026</small>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     BRANCHES & LOCATIONS TEASER
     ============================================================ -->
<section class="section">
    <div class="section-container">
        <div style="
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--space-2xl);
            align-items: center;
        ">
            <!-- Left: Map Placeholder -->
            <div style="
                background: linear-gradient(135deg, var(--color-bg-secondary), var(--color-bg-tertiary));
                border-radius: 16px;
                height: 300px;
                display: flex;
                align-items: center;
                justify-content: center;
                border: 1px solid var(--color-border);
                color: var(--color-text-tertiary);
            ">
                <div style="text-align: center;">
                    <i class="fas fa-map" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <p>Interactive branch locator map</p>
                </div>
            </div>
            
            <!-- Right: Content -->
            <div>
                <h2>Visit Our Branches</h2>
                <p style="color: var(--color-text-secondary); font-size: 1.125rem; line-height: 1.8; margin-bottom: 1.5rem;">
                    While we're primarily digital, we have select branches in major cities for in-person consultations and services.
                </p>
                
                <div style="display: flex; flex-direction: column; gap: 1rem; margin-bottom: 2rem;">
                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        <i class="fas fa-map-marker-alt" style="color: var(--color-primary); margin-top: 0.25rem;"></i>
                        <div>
                            <strong>New York</strong>
                            <p style="font-size: 0.875rem; color: var(--color-text-tertiary); margin: 0.25rem 0 0 0;">123 Financial Ave, NY 10001</p>
                        </div>
                    </div>
                    
                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        <i class="fas fa-map-marker-alt" style="color: var(--color-primary); margin-top: 0.25rem;"></i>
                        <div>
                            <strong>San Francisco</strong>
                            <p style="font-size: 0.875rem; color: var(--color-text-tertiary); margin: 0.25rem 0 0 0;">456 Tech Boulevard, SF 94102</p>
                        </div>
                    </div>
                    
                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        <i class="fas fa-map-marker-alt" style="color: var(--color-primary); margin-top: 0.25rem;"></i>
                        <div>
                            <strong>Chicago</strong>
                            <p style="font-size: 0.875rem; color: var(--color-text-tertiary); margin: 0.25rem 0 0 0;">789 Central Park, Chicago 60601</p>
                        </div>
                    </div>
                </div>
                
                <a href="/contact.php" class="btn btn-primary">
                    <i class="fas fa-location-dot"></i> Find a Branch
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    /**
     * Quick Inquiry Form Handler
     */
    function handleQuickInquiry(event) {
        event.preventDefault();
        const form = event.target;
        const name = form.querySelector('input[name="name"]').value;
        const email = form.querySelector('input[name="email"]').value;
        const interest = form.querySelector('select[name="interest"]').value;
        
        console.log('Quick Inquiry:', { name, email, interest });
        
        // Here you would send this to your backend
        alert('Thank you for your interest! We'll be in touch shortly.');
        form.reset();
        return false;
    }
</script>

<?php include 'includes/footer-modern.php'; ?>
