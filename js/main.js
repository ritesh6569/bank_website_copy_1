/**
 * Bank Website - Main JavaScript
 * Handles animations, interactions, and utility functions
 */

document.addEventListener('DOMContentLoaded', function() {
    initAnimations();
    initFormValidation();
    initSmoothScroll();
    initTooltips();
    initCalculators();
    setupScrollAnimations();
});

/**
 * Initialize scroll animations using Animate.css
 */
function setupScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });

    // Animate section titles
    document.querySelectorAll('.section-title').forEach(el => {
        observer.observe(el);
    });

    // Animate cards
    document.querySelectorAll('.card').forEach(el => {
        observer.observe(el);
    });
}

/**
 * Initialize general animations on page load
 */
function initAnimations() {
    // Hero section fade-in
    const hero = document.querySelector('.hero');
    if (hero) {
        hero.style.opacity = '0';
        hero.style.animation = 'fadeIn 0.8s ease-out forwards';
    }

    // Navbar animation on scroll
    let lastScrollTop = 0;
    const navbar = document.querySelector('.navbar');
    
    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > 100) {
            navbar.classList.add('shadow-lg');
        } else {
            navbar.classList.remove('shadow-lg');
        }
        
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    });

    // Button hover effects
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            if (!this.classList.contains('btn-no-animation')) {
                this.style.transform = 'translateY(-2px)';
            }
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
}

/**
 * Smooth scroll for anchor links
 */
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            e.preventDefault();
            const target = document.querySelector(href);
            
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

/**
 * Initialize Bootstrap tooltips
 */
function initTooltips() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
}

/**
 * Form validation
 */
function initFormValidation() {
    const forms = document.querySelectorAll('form[data-validate="true"]');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!this.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            this.classList.add('was-validated');
        });
    });
}

/**
 * Simple Loan EMI Calculator
 * Displays result in realtime
 */
function calculateEMI() {
    const principal = parseFloat(document.getElementById('loanAmount')?.value || 0);
    const rate = parseFloat(document.getElementById('interestRate')?.value || 0);
    const months = parseInt(document.getElementById('loanTenure')?.value || 0);

    if (principal && rate && months) {
        const monthlyRate = rate / 12 / 100;
        const emi = (principal * monthlyRate * Math.pow(1 + monthlyRate, months)) / 
                    (Math.pow(1 + monthlyRate, months) - 1);
        const totalAmount = emi * months;
        const totalInterest = totalAmount - principal;

        const resultDiv = document.getElementById('emiResult');
        if (resultDiv) {
            resultDiv.innerHTML = `
                <div class="alert alert-info" role="alert">
                    <h6 class="alert-heading">EMI Calculation Results</h6>
                    <hr>
                    <p><strong>Monthly EMI:</strong> ₹${emi.toFixed(2)}</p>
                    <p><strong>Total Amount Payable:</strong> ₹${totalAmount.toFixed(2)}</p>
                    <p><strong>Total Interest:</strong> ₹${totalInterest.toFixed(2)}</p>
                </div>
            `;
            resultDiv.style.animation = 'slideInUp 0.5s ease-out';
        }
    }
}

/**
 * Simple FD Calculator
 */
function calculateFD() {
    const principal = parseFloat(document.getElementById('fdAmount')?.value || 0);
    const rate = parseFloat(document.getElementById('fdRate')?.value || 0);
    const years = parseInt(document.getElementById('fdYears')?.value || 0);

    if (principal && rate && years) {
        const maturityAmount = principal * Math.pow(1 + (rate / 100), years);
        const interest = maturityAmount - principal;

        const resultDiv = document.getElementById('fdResult');
        if (resultDiv) {
            resultDiv.innerHTML = `
                <div class="alert alert-success" role="alert">
                    <h6 class="alert-heading">FD Calculation Results</h6>
                    <hr>
                    <p><strong>Principal Amount:</strong> ₹${principal.toFixed(2)}</p>
                    <p><strong>Maturity Amount:</strong> ₹${maturityAmount.toFixed(2)}</p>
                    <p><strong>Interest Earned:</strong> ₹${interest.toFixed(2)}</p>
                </div>
            `;
            resultDiv.style.animation = 'slideInUp 0.5s ease-out';
        }
    }
}

/**
 * Initialize calculators with event listeners
 */
function initCalculators() {
    // EMI Calculator
    ['loanAmount', 'interestRate', 'loanTenure'].forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.addEventListener('change', calculateEMI);
            element.addEventListener('input', calculateEMI);
        }
    });

    // FD Calculator
    ['fdAmount', 'fdRate', 'fdYears'].forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.addEventListener('change', calculateFD);
            element.addEventListener('input', calculateFD);
        }
    });
}

/**
 * Show success notification
 */
function showNotification(message, type = 'success') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.setAttribute('role', 'alert');
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    const container = document.querySelector('main') || document.querySelector('body');
    container.insertBefore(alertDiv, container.firstChild);

    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}

/**
 * Toggle password visibility
 */
function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    if (input) {
        input.type = input.type === 'password' ? 'text' : 'password';
    }
}

/**
 * Format currency input
 */
function formatCurrency(input) {
    let value = input.value.replace(/[^0-9]/g, '');
    input.value = '₹ ' + new Intl.NumberFormat('en-IN').format(value);
}

/**
 * Format phone number input
 */
function formatPhoneNumber(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.length > 0) {
        value = value.match(new RegExp('.{1,2}', 'g')).join('-');
    }
    input.value = value;
}

/**
 * Validate email
 */
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

/**
 * Validate phone number (Indian format)
 */
function validatePhoneNumber(phone) {
    const re = /^[0-9]{10}$/;
    return re.test(phone.replace(/\D/g, ''));
}

/**
 * Show loading spinner
 */
function showSpinner(element) {
    element.innerHTML = '<div class="spinner"></div>';
}

/**
 * Format date to readable string
 */
function formatDate(date) {
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return new Date(date).toLocaleDateString('en-IN', options);
}

/**
 * Copy text to clipboard
 */
function copyToClipboard(text, element) {
    navigator.clipboard.writeText(text).then(() => {
        const originalText = element.textContent;
        element.textContent = 'Copied!';
        setTimeout(() => {
            element.textContent = originalText;
        }, 2000);
    });
}

/**
 * Scroll to top button functionality
 */
function initScrollToTop() {
    const scrollBtn = document.getElementById('scrollToTop');
    
    if (!scrollBtn) return;

    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            scrollBtn.style.display = 'block';
            scrollBtn.classList.add('animate__animated', 'animate__fadeIn');
        } else {
            scrollBtn.style.display = 'none';
        }
    });

    scrollBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// Initialize scroll to top on page load
initScrollToTop();

/**
 * Initialize Fancybox for gallery
 */
if (typeof Fancybox !== 'undefined') {
    Fancybox.bind('[data-fancybox]', {
        on: {
            reveal: (fancybox, slide) => {
                slide.$content?.classList.add('animate__animated', 'animate__zoomIn');
            }
        }
    });
}
