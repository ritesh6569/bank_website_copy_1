    </main>
    
    <!-- Footer -->
    <footer role="contentinfo">
        <div class="footer-container">
            <!-- Main Footer Grid -->
            <div class="footer-grid">
                <!-- Company Info Column -->
                <div class="footer-column">
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                        <i class="fas fa-building" style="font-size: 1.5rem;"></i>
                        <h4 style="margin: 0;">Modern Bank</h4>
                    </div>
                    <p style="color: rgba(255, 255, 255, 0.7); font-size: 0.875rem; line-height: 1.6; margin-bottom: 1.5rem;">
                        Pioneering digital banking with institutional credibility, transparency, and user-centric design for modern financial needs.
                    </p>
                    
                    <!-- Social Media Links -->
                    <div class="footer-socials">
                        <a href="https://facebook.com" class="footer-social-link" title="Follow on Facebook" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://linkedin.com" class="footer-social-link" title="Follow on LinkedIn" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://twitter.com" class="footer-social-link" title="Follow on Twitter" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://instagram.com" class="footer-social-link" title="Follow on Instagram" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Products Column -->
                <div class="footer-column">
                    <h4><i class="fas fa-box" style="margin-right: 0.5rem;"></i> Products</h4>
                    <ul class="footer-links">
                        <li><a href="/deposits.php" class="footer-link">Savings Accounts</a></li>
                        <li><a href="/loans.php" class="footer-link">Loan Products</a></li>
                        <li><a href="#" class="footer-link">Credit Cards</a></li>
                        <li><a href="#" class="footer-link">Investment Services</a></li>
                        <li><a href="#" class="footer-link">Wealth Management</a></li>
                    </ul>
                </div>
                
                <!-- Services Column -->
                <div class="footer-column">
                    <h4><i class="fas fa-cogs" style="margin-right: 0.5rem;"></i> Services</h4>
                    <ul class="footer-links">
                        <li><a href="/services.php" class="footer-link">Digital Services</a></li>
                        <li><a href="#" class="footer-link">Mobile Banking</a></li>
                        <li><a href="#" class="footer-link">Money Transfer</a></li>
                        <li><a href="#" class="footer-link">Bill Pay</a></li>
                        <li><a href="#" class="footer-link">Financial Planning</a></li>
                    </ul>
                </div>
                
                <!-- Support Column -->
                <div class="footer-column">
                    <h4><i class="fas fa-headset" style="margin-right: 0.5rem;"></i> Support</h4>
                    <ul class="footer-links">
                        <li><a href="/about.php" class="footer-link">About Us</a></li>
                        <li><a href="/contact.php" class="footer-link">Contact Support</a></li>
                        <li><a href="#" class="footer-link">FAQ</a></li>
                        <li><a href="#" class="footer-link">Security Center</a></li>
                        <li><a href="/media.php" class="footer-link">Media</a></li>
                    </ul>
                </div>
                
                <!-- Newsletter Signup -->
                <div class="footer-column">
                    <div class="footer-newsletter">
                        <h4 style="margin: 0 0 0.5rem 0; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-envelope"></i> Newsletter
                        </h4>
                        <p style="font-size: 0.875rem; margin: 0 0 1rem 0; color: rgba(255, 255, 255, 0.8);">
                            Subscribe for updates and financial insights
                        </p>
                        <form class="footer-newsletter-form" method="POST" action="/api.php" onsubmit="return subscribeNewsletter(event)">
                            <input 
                                type="email" 
                                name="email" 
                                class="footer-newsletter-input" 
                                placeholder="Your email..." 
                                required
                                aria-label="Email address for newsletter">
                            <button type="submit" class="btn btn-primary" style="padding: 0.5rem 1rem; white-space: nowrap;">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Trust Badges & Bottom Section -->
            <div style="background: rgba(255, 255, 255, 0.02); border-top: 1px solid rgba(255, 255, 255, 0.1); border-radius: var(--radius-lg); padding: var(--space-lg); margin-top: var(--space-2xl);">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--space-lg); margin-bottom: var(--space-lg);">
                    <!-- Trust Badge: FDIC -->
                    <div class="trust-item" style="color: white;">
                        <i class="fas fa-shield-alt" style="font-size: 1.5rem; color: var(--color-success);"></i>
                        <div>
                            <div style="font-weight: 600; font-size: 0.875rem;">FDIC Member</div>
                            <div style="font-size: 0.75rem; color: rgba(255, 255, 255, 0.7);">Deposits insured up to $250k</div>
                        </div>
                    </div>
                    
                    <!-- Trust Badge: Security -->
                    <div class="trust-item" style="color: white;">
                        <i class="fas fa-lock" style="font-size: 1.5rem; color: var(--color-success);"></i>
                        <div>
                            <div style="font-weight: 600; font-size: 0.875rem;">256-bit Encryption</div>
                            <div style="font-size: 0.75rem; color: rgba(255, 255, 255, 0.7);">Bank-grade security</div>
                        </div>
                    </div>
                    
                    <!-- Trust Badge: Established -->
                    <div class="trust-item" style="color: white;">
                        <i class="fas fa-certificate" style="font-size: 1.5rem; color: var(--color-success);"></i>
                        <div>
                            <div style="font-weight: 600; font-size: 0.875rem;">Established 2024</div>
                            <div style="font-size: 0.75rem; color: rgba(255, 255, 255, 0.7);">Trusted by thousands</div>
                        </div>
                    </div>
                    
                    <!-- Trust Badge: Awards -->
                    <div class="trust-item" style="color: white;">
                        <i class="fas fa-award" style="font-size: 1.5rem; color: var(--color-success);"></i>
                        <div>
                            <div style="font-weight: 600; font-size: 0.875rem;">Industry Recognition</div>
                            <div style="font-size: 0.75rem; color: rgba(255, 255, 255, 0.7);">Best digital banking platform</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div>
                    &copy; <?php echo date('Y'); ?> Modern Bank. All rights reserved.
                </div>
                <ul class="footer-legal">
                    <li><a href="/privacy-policy.php" class="footer-legal-link">Privacy Policy</a></li>
                    <li><a href="/terms.php" class="footer-legal-link">Terms & Conditions</a></li>
                    <li><a href="#" class="footer-legal-link">Accessibility</a></li>
                    <li><a href="#" class="footer-legal-link">Sitemap</a></li>
                </ul>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-geWF76RCwLtnZ8qwWbSxccPQtF3EpF3fnJHog6LaEVF6sULvnPgKLhw9JJgkreH" 
            crossorigin="anonymous" defer></script>
    
    <!-- Modern Theme JavaScript -->
    <script defer>
        /**
         * Modern Banking Theme - JavaScript Enhancements
         * 2025-2026 Theme
         * 
         * Features:
         * - Sticky navbar with scroll detection
         * - Mobile menu toggle
         * - Intersection Observer for scroll animations
         * - Form validation
         * - Newsletter subscription
         * - Smooth scroll behavior
         * - Accessibility enhancements
         */
        
        class ModernBankApp {
            constructor() {
                this.navbar = document.querySelector('.navbar');
                this.navMenu = document.getElementById('navbar-menu');
                this.menuToggle = document.getElementById('menu-toggle');
                this.init();
            }
            
            init() {
                this.setupNavbar();
                this.setupMobileMenu();
                this.setupDropdowns();
                this.setupScrollAnimations();
                this.setupSmoothScroll();
            }
            
            /**
             * Navbar scroll detection for sticky effect
             */
            setupNavbar() {
                let scrollPosition = 0;
                
                const handleScroll = () => {
                    scrollPosition = window.scrollY;
                    
                    if (scrollPosition > 50) {
                        this.navbar.classList.add('scrolled');
                    } else {
                        this.navbar.classList.remove('scrolled');
                    }
                };
                
                window.addEventListener('scroll', this.debounce(handleScroll, 10), { passive: true });
            }
            
            /**
             * Mobile menu toggle with hamburger animation
             */
            setupMobileMenu() {
                if (!this.menuToggle) return;
                
                this.menuToggle.addEventListener('click', () => {
                    const isOpen = this.menuToggle.getAttribute('aria-expanded') === 'true';
                    this.menuToggle.setAttribute('aria-expanded', !isOpen);
                    this.navMenu.classList.toggle('open');
                    
                    // Animate hamburger
                    const spans = this.menuToggle.querySelectorAll('span');
                    if (isOpen) {
                        spans[0].style.transform = 'none';
                        spans[1].style.opacity = '1';
                        spans[2].style.transform = 'none';
                    } else {
                        spans[0].style.transform = 'rotate(45deg) translate(8px, 8px)';
                        spans[1].style.opacity = '0';
                        spans[2].style.transform = 'rotate(-45deg) translate(7px, -7px)';
                    }
                });
                
                // Close menu on link click
                const navLinks = this.navMenu.querySelectorAll('.nav-link');
                navLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        this.menuToggle.setAttribute('aria-expanded', 'false');
                        this.navMenu.classList.remove('open');
                        const spans = this.menuToggle.querySelectorAll('span');
                        spans[0].style.transform = 'none';
                        spans[1].style.opacity = '1';
                        spans[2].style.transform = 'none';
                    });
                });
            }
            
            /**
             * Dropdown menu interactions
             */
            setupDropdowns() {
                const dropdownButtons = document.querySelectorAll('[aria-haspopup="true"]');
                
                dropdownButtons.forEach(button => {
                    const submenu = document.getElementById(button.getAttribute('aria-controls') || 
                                                           button.id.replace('-menu', '-submenu'));
                    
                    if (!submenu) return;
                    
                    // Click to toggle
                    button.addEventListener('click', (e) => {
                        e.preventDefault();
                        const isOpen = button.getAttribute('aria-expanded') === 'true';
                        button.setAttribute('aria-expanded', !isOpen);
                        submenu.style.display = isOpen ? 'none' : 'flex';
                    });
                    
                    // Keyboard navigation
                    button.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            button.click();
                        }
                    });
                });
            }
            
            /**
             * Intersection Observer for fade-in-on-scroll animations
             */
            setupScrollAnimations() {
                const elements = document.querySelectorAll('.fade-in-on-scroll');
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                });
                
                elements.forEach(el => observer.observe(el));
            }
            
            /**
             * Smooth scroll for anchor links with navbar offset
             */
            setupSmoothScroll() {
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', (e) => {
                        const href = anchor.getAttribute('href');
                        if (href === '#') return;
                        
                        e.preventDefault();
                        const target = document.querySelector(href);
                        if (target) {
                            const navHeight = document.querySelector('.navbar').offsetHeight;
                            const targetPosition = target.offsetTop - navHeight;
                            
                            window.scrollTo({
                                top: targetPosition,
                                behavior: 'smooth'
                            });
                        }
                    });
                });
            }
            
            /**
             * Debounce utility
             */
            debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }
        }
        
        /**
         * Newsletter subscription handler
         */
        function subscribeNewsletter(event) {
            event.preventDefault();
            const form = event.target;
            const email = form.querySelector('input[name="email"]').value;
            
            // Simple validation
            if (!email.includes('@')) {
                alert('Please enter a valid email address');
                return false;
            }
            
            // Here you would typically send the email to your backend
            console.log('Newsletter subscription:', email);
            
            // Show success message
            alert('Thank you for subscribing! Check your email for confirmation.');
            form.reset();
            return false;
        }
        
        /**
         * Initialize app when DOM is ready
         */
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                new ModernBankApp();
            });
        } else {
            new ModernBankApp();
        }
    </script>
</body>
</html>
