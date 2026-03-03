/**
 * Professional Bank Website - Main JavaScript
 * Handles interactive elements and form validations
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips and popovers
    initializeBootstrapComponents();
    
    // Form validation
    setupFormValidation();
    
    // Smooth scrolling
    setupSmoothScroll();
    
    // Number formatting
    formatCurrency();
    
    // Scroll animations
    observeScrollAnimations();
});

/**
 * Initialize Bootstrap components
 */
function initializeBootstrapComponents() {
    // Tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

/**
 * Setup form validation
 */
function setupFormValidation() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
}

/**
 * Email validation
 */
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

/**
 * Phone validation
 */
function validatePhone(phone) {
    const re = /^[\d\s\-\+\(\)]{10,}$/;
    return re.test(phone.replace(/\s/g, ''));
}

/**
 * Smooth scrolling for anchor links
 */
function setupSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            // Skip if it's just "#" or for modals
            if (href === '#' || this.dataset.bsToggle === 'modal') {
                return;
            }
            
            const target = document.querySelector(href);
            
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

/**
 * Format numbers as currency
 */
function formatCurrency() {
    document.querySelectorAll('.currency').forEach(el => {
        const value = parseFloat(el.textContent);
        if (!isNaN(value)) {
            el.textContent = new Intl.NumberFormat('en-IN', {
                style: 'currency',
                currency: 'INR',
                maximumFractionDigits: 0
            }).format(value);
        }
    });
}

/**
 * Intersection Observer for scroll animations
 */
function observeScrollAnimations() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    });
    
    document.querySelectorAll('.fade-in, .slide-in').forEach(el => {
        observer.observe(el);
    });
}

/**
 * Loan EMI Calculator
 */
function calculateEMI(principal, rate, tenure) {
    // Rate per month
    const monthlyRate = rate / 100 / 12;
    // Total number of months
    const numberOfMonths = tenure * 12;
    
    // EMI Formula
    const emi = (principal * monthlyRate * Math.pow(1 + monthlyRate, numberOfMonths)) 
                / (Math.pow(1 + monthlyRate, numberOfMonths) - 1);
    
    return emi;
}

/**
 * FD/RD Maturity Calculator
 */
function calculateMaturity(principal, rate, years, frequency = 'annually') {
    // Frequency conversions
    const frequencies = {
        'quarterly': 4,
        'semi-annually': 2,
        'annually': 1,
        'monthly': 12
    };
    
    const n = frequencies[frequency] || 1;
    const ratePerPeriod = rate / (100 * n);
    const totalPeriods = years * n;
    
    // Compound Interest Formula
    const maturityAmount = principal * Math.pow(1 + ratePerPeriod, totalPeriods);
    
    return maturityAmount;
}

/**
 * Format phone number as user types
 */
function formatPhoneNumber(input) {
    input.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        
        if (value.length > 0) {
            if (value.length <= 3) {
                value = value;
            } else if (value.length <= 6) {
                value = value.slice(0, 3) + '-' + value.slice(3);
            } else if (value.length <= 10) {
                value = value.slice(0, 3) + '-' + value.slice(3, 6) + '-' + value.slice(6);
            }
        }
        
        e.target.value = value;
    });
}

/**
 * Show notification toast
 */
function showNotification(message, type = 'info') {
    const toastId = 'toast-' + Date.now();
    const toastHTML = `
        <div id="${toastId}" class="toast align-items-center text-white bg-${type}" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `;
    
    const toastContainer = document.getElementById('toast-container') || createToastContainer();
    toastContainer.insertAdjacentHTML('beforeend', toastHTML);
    
    const toastEl = document.getElementById(toastId);
    const toast = new bootstrap.Toast(toastEl);
    toast.show();
    
    toastEl.addEventListener('hidden.bs.toast', () => {
        toastEl.remove();
    });
}

/**
 * Create toast container if it doesn't exist
 */
function createToastContainer() {
    const container = document.createElement('div');
    container.id = 'toast-container';
    container.className = 'toast-container position-fixed bottom-0 end-0 p-3';
    document.body.appendChild(container);
    return container;
}

/**
 * Debounce function for search
 */
function debounce(func, wait) {
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

/**
 * Search functionality
 */
const handleSearch = debounce(function(query) {
    if (query.length < 2) {
        return;
    }
    
    console.log('Searching for:', query);
    // Implement search logic here
}, 300);

/**
 * Form submission handler
 */
function handleFormSubmit(formId, callback) {
    const form = document.getElementById(formId);
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (form.checkValidity() === false) {
                e.stopPropagation();
                form.classList.add('was-validated');
                return;
            }
            
            // Collect form data
            const formData = new FormData(form);
            const data = Object.fromEntries(formData);
            
            // Call callback with form data
            if (typeof callback === 'function') {
                callback(data);
            }
            
            // Show success message
            showNotification('Form submitted successfully!', 'success');
            
            // Reset form
            form.reset();
            form.classList.remove('was-validated');
        });
    }
}

/**
 * Parallax effect
 */
function setupParallax() {
    const parallaxElements = document.querySelectorAll('[data-parallax]');
    
    if (parallaxElements.length > 0) {
        window.addEventListener('scroll', function() {
            parallaxElements.forEach(el => {
                const scrollPosition = window.pageYOffset;
                const speed = el.dataset.parallax || 0.5;
                el.style.transform = `translateY(${scrollPosition * speed}px)`;
            });
        });
    }
}

/**
 * Counter animation for statistics
 */
function animateCounter(element, target, duration = 2000) {
    let current = 0;
    const increment = target / (duration / 16);
    const interval = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target;
            clearInterval(interval);
        } else {
            element.textContent = Math.floor(current);
        }
    }, 16);
}

/**
 * Initialize counters on scroll
 */
function initializeCounters() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.dataset.target) || 0;
                animateCounter(entry.target, target);
                observer.unobserve(entry.target);
            }
        });
    });
    
    document.querySelectorAll('.counter').forEach(el => {
        observer.observe(el);
    });
}

/**
 * Sticky header on scroll
 */
function setupStickyHeader() {
    const navbar = document.querySelector('.navbar');
    
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }
}

// Initialize on page load
window.addEventListener('load', function() {
    setupParallax();
    initializeCounters();
    setupStickyHeader();
});
