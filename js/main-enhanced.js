/**
 * Bank Website - Enhanced JavaScript
 * Animations, dark mode toggle, scroll effects, and interactive features
 * Highly performant and accessible
 */

/* ============================================================
   GLOBAL APP STATE
   ============================================================ */

const APP_CONFIG = {
    isDarkMode: localStorage.getItem('darkMode') === 'true',
    isMobileMenuOpen: false,
    isScrolling: false,
    scrollTimeout: null,
    toastTimeout: null,
};

const ANIMATION_CONFIG = {
    duration: 300,
    easing: 'ease-in-out',
};

/* ============================================================
   INITIALIZATION
   ============================================================ */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize dark mode
    initializeDarkMode();
    
    // Initialize Bootstrap tooltips and popovers
    initializeBootstrapComponents();
    
    // Setup form validation
    setupFormValidation();
    
    // Setup smooth scrolling
    setupSmoothScroll();
    
    // Setup scroll animations
    setupScrollAnimations();
    
    // Setup navbar scroll effect
    setupNavbarScrollEffect();
    
    // Format currency
    formatCurrency();
    
    // Setup scroll to top button
    setupScrollToTop();
    
    // Setup interactive elements
    setupInteractiveElements();
    
    // Setup carousel animations
    setupCarousels();
    
    // Setup accordion animations
    setupAccordions();
    
    // Check if animation preferences allow animations
    checkAnimationPreferences();
});

/* ============================================================
   DARK MODE FUNCTIONALITY
   ============================================================ */

/**
 * Initialize dark mode based on user preference
 */
function initializeDarkMode() {
    // Create dark mode toggle button if not exists
    createDarkModeToggle();
    
    // Apply dark mode if saved
    if (APP_CONFIG.isDarkMode) {
        enableDarkMode();
    } else {
        // Check system preference
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            enableDarkMode();
        }
    }
    
    // Listen for system theme changes
    if (window.matchMedia) {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            if (e.matches && !APP_CONFIG.isDarkMode) {
                enableDarkMode();
            }
        });
    }
}

/**
 * Create dark mode toggle button
 */
function createDarkModeToggle() {
    if (document.querySelector('.dark-mode-toggle')) {
        return; // Already exists
    }
    
    const toggleBtn = document.createElement('button');
    toggleBtn.className = 'dark-mode-toggle';
    toggleBtn.setAttribute('aria-label', 'Toggle dark mode');
    toggleBtn.innerHTML = '<i class="fas fa-moon"></i>';
    toggleBtn.addEventListener('click', toggleDarkMode);
    
    document.body.appendChild(toggleBtn);
}

/**
 * Enable dark mode
 */
function enableDarkMode() {
    document.body.classList.add('dark-mode');
    APP_CONFIG.isDarkMode = true;
    localStorage.setItem('darkMode', 'true');
    updateDarkModeToggle();
    
    // Add animation
    animateElement(document.querySelector('.dark-mode-toggle'), {
        animation: 'spin 0.6s ease-in-out'
    });
}

/**
 * Disable dark mode
 */
function disableDarkMode() {
    document.body.classList.remove('dark-mode');
    APP_CONFIG.isDarkMode = false;
    localStorage.setItem('darkMode', 'false');
    updateDarkModeToggle();
    
    // Add animation
    animateElement(document.querySelector('.dark-mode-toggle'), {
        animation: 'spin 0.6s ease-in-out'
    });
}

/**
 * Toggle dark mode
 */
function toggleDarkMode() {
    if (APP_CONFIG.isDarkMode) {
        disableDarkMode();
    } else {
        enableDarkMode();
    }
}

/**
 * Update dark mode toggle icon
 */
function updateDarkModeToggle() {
    const toggleBtn = document.querySelector('.dark-mode-toggle');
    if (toggleBtn) {
        toggleBtn.innerHTML = APP_CONFIG.isDarkMode 
            ? '<i class="fas fa-sun"></i>' 
            : '<i class="fas fa-moon"></i>';
    }
}

/* ============================================================
   BOOTSTRAP COMPONENTS INITIALIZATION
   ============================================================ */

/**
 * Initialize Bootstrap tooltips and popovers
 */
function initializeBootstrapComponents() {
    // Tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function(tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl, {
            delay: { show: 0, hide: 150 }
        });
    });
    
    // Popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.forEach(function(popoverTriggerEl) {
        new bootstrap.Popover(popoverTriggerEl, {
            trigger: 'hover'
        });
    });
}

/* ============================================================
   FORM VALIDATION
   ============================================================ */

/**
 * Setup form validation with Bootstrap validation
 */
function setupFormValidation() {
    const forms = document.querySelectorAll('form:not([novalidate])');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
                
                // Shake animation for invalid form
                animateElement(form, {
                    animation: 'shake 0.5s ease-in-out'
                });
            } else {
                // Show loading state
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    setButtonLoading(submitBtn, true);
                }
            }
            
            form.classList.add('was-validated');
        });
        
        // Real-time validation feedback
        const inputs = form.querySelectorAll('.form-control, .form-select');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    validateField(this);
                }
            });
        });
    });
}

/**
 * Validate individual field
 */
function validateField(field) {
    const isValid = field.checkValidity();
    
    if (isValid) {
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');
    } else {
        field.classList.remove('is-valid');
        field.classList.add('is-invalid');
    }
    
    return isValid;
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
 * Set button loading state
 */
function setButtonLoading(btn, isLoading) {
    if (isLoading) {
        btn.disabled = true;
        btn.setAttribute('data-original-text', btn.innerHTML);
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Loading...';
    } else {
        btn.disabled = false;
        btn.innerHTML = btn.getAttribute('data-original-text');
    }
}

/* ============================================================
   SMOOTH SCROLLING
   ============================================================ */

/**
 * Setup smooth scrolling for anchor links
 */
function setupSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            // Skip if it's just "#" or for modals/dropdowns
            if (href === '#' || this.dataset.bsToggle === 'modal' || this.dataset.bsToggle === 'dropdown') {
                return;
            }
            
            const target = document.querySelector(href);
            
            if (target) {
                e.preventDefault();
                
                // Get navbar height for offset
                const navbar = document.querySelector('.navbar');
                const navbarHeight = navbar ? navbar.offsetHeight : 0;
                
                // Smooth scroll with offset
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - navbarHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
                
                // Add highlight animation
                target.style.animation = 'pulse 0.6s ease-in-out';
                setTimeout(() => {
                    target.style.animation = '';
                }, 600);
            }
        });
    });
}

/* ============================================================
   SCROLL ANIMATIONS & INTERSECTION OBSERVER
   ============================================================ */

/**
 * Setup scroll animations using Intersection Observer
 */
function setupScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Animate element into view
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                
                // Add specific animations based on class
                if (entry.target.classList.contains('col-animation')) {
                    entry.target.style.animation = 'slideInUp 0.6s ease-in-out forwards';
                } else if (entry.target.classList.contains('card')) {
                    entry.target.style.animation = 'fadeIn 0.6s ease-in-out forwards';
                } else if (entry.target.classList.contains('feature-card')) {
                    entry.target.style.animation = 'scaleIn 0.6s ease-in-out forwards';
                }
                
                // Unobserve after animation
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // Observe all elements with animation classes
    document.querySelectorAll('.col-animation, .card, .feature-card, .section').forEach(el => {
        // Initial state
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        observer.observe(el);
    });
}

/**
 * Setup navbar scroll effect
 */
function setupNavbarScrollEffect() {
    const navbar = document.querySelector('.navbar');
    if (!navbar) return;
    
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }, false);
}

/* ============================================================
   SCROLL TO TOP BUTTON
   ============================================================ */

/**
 * Setup scroll to top button
 */
function setupScrollToTop() {
    // Create button if not exists
    let scrollToTopBtn = document.getElementById('scrollToTop');
    if (!scrollToTopBtn) {
        scrollToTopBtn = document.createElement('button');
        scrollToTopBtn.id = 'scrollToTop';
        scrollToTopBtn.setAttribute('aria-label', 'Scroll to top');
        scrollToTopBtn.innerHTML = '<i class="fas fa-chevron-up"></i>';
        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        document.body.appendChild(scrollToTopBtn);
    }
    
    // Show/hide button based on scroll position
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            scrollToTopBtn.classList.add('show');
        } else {
            scrollToTopBtn.classList.remove('show');
        }
    });
}

/* ============================================================
   CURRENCY FORMATTING
   ============================================================ */

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
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }).format(value);
        }
    });
}

/* ============================================================
   INTERACTIVE ELEMENTS
   ============================================================ */

/**
 * Setup interactive elements
 */
function setupInteractiveElements() {
    // Ripple effect on buttons and cards
    setupRippleEffect();
    
    // Card hover effects
    setupCardHoverEffects();
    
    // Button hover effects
    setupButtonHoverEffects();
}

/**
 * Setup ripple effect on clickable elements
 */
function setupRippleEffect() {
    document.querySelectorAll('.btn, .card, a').forEach(element => {
        element.addEventListener('click', function(e) {
            // Only create ripple for buttons and cards
            if (!this.classList.contains('btn') && !this.classList.contains('card')) {
                return;
            }
            
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
}

/**
 * Setup card hover effects
 */
function setupCardHoverEffects() {
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
}

/**
 * Setup button hover effects
 */
function setupButtonHoverEffects() {
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            const icon = this.querySelector('i');
            if (icon) {
                icon.style.transform = 'translateX(3px)';
            }
        });
        
        btn.addEventListener('mouseleave', function() {
            const icon = this.querySelector('i');
            if (icon) {
                icon.style.transform = 'translateX(0)';
            }
        });
    });
}

/* ============================================================
   CAROUSEL ANIMATIONS
   ============================================================ */

/**
 * Setup carousel animations
 */
function setupCarousels() {
    const carousels = document.querySelectorAll('.carousel');
    
    carousels.forEach(carousel => {
        const bootstrapCarousel = new bootstrap.Carousel(carousel, {
            interval: 5000,
            wrap: true,
            pause: 'hover'
        });
        
        // Add animation to carousel items
        carousel.addEventListener('slide.bs.carousel', function(e) {
            const nextItem = e.relatedTarget;
            nextItem.style.animation = 'slideInUp 0.6s ease-in-out';
        });
    });
}

/* ============================================================
   ACCORDION ANIMATIONS
   ============================================================ */

/**
 * Setup accordion animations
 */
function setupAccordions() {
    const accordions = document.querySelectorAll('.accordion');
    
    accordions.forEach(accordion => {
        const buttons = accordion.querySelectorAll('.accordion-button');
        
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const collapse = bootstrap.Collapse.getOrCreateInstance(this.parentElement.querySelector('.accordion-collapse'));
                
                if (this.classList.contains('collapsed')) {
                    collapse.show();
                    this.style.animation = 'slideInDown 0.3s ease-in-out';
                } else {
                    collapse.hide();
                }
            });
        });
    });
}

/* ============================================================
   ANIMATION UTILITIES
   ============================================================ */

/**
 * Animate element with custom animation
 */
function animateElement(element, options = {}) {
    if (!element) return;
    
    const defaults = {
        duration: 300,
        delay: 0,
        animation: 'fadeIn',
        timingFunction: 'ease-in-out'
    };
    
    const config = { ...defaults, ...options };
    
    element.style.animation = `${config.animation} ${config.duration}ms ${config.timingFunction}`;
    element.style.animationDelay = `${config.delay}ms`;
    
    setTimeout(() => {
        element.style.animation = '';
        element.style.animationDelay = '';
    }, config.duration + config.delay);
}

/**
 * Shake animation for errors
 */
function shakeElement(element) {
    animateElement(element, {
        animation: 'shake 0.5s ease-in-out',
        duration: 500
    });
}

/**
 * Bounce animation
 */
function bounceElement(element) {
    animateElement(element, {
        animation: 'bounce 0.6s ease-in-out',
        duration: 600
    });
}

/* ============================================================
   TOAST NOTIFICATIONS
   ============================================================ */

/**
 * Show toast notification
 */
function showToast(message, type = 'info', duration = 3000) {
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `alert alert-${type}`;
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        max-width: 400px;
        animation: slideInRight 0.3s ease-in-out;
    `;
    toast.innerHTML = `
        ${message}
        <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
    `;
    
    document.body.appendChild(toast);
    
    // Auto remove after duration
    setTimeout(() => {
        toast.style.animation = 'slideInLeft 0.3s ease-in-out reverse';
        setTimeout(() => {
            toast.remove();
        }, 300);
    }, duration);
    
    return toast;
}

/**
 * Show success toast
 */
function showSuccessToast(message, duration = 3000) {
    return showToast(message, 'success', duration);
}

/**
 * Show error toast
 */
function showErrorToast(message, duration = 3000) {
    return showToast(message, 'danger', duration);
}

/**
 * Show warning toast
 */
function showWarningToast(message, duration = 3000) {
    return showToast(message, 'warning', duration);
}

/* ============================================================
   ANIMATION PREFERENCES CHECK
   ============================================================ */

/**
 * Check for reduced motion preference
 */
function checkAnimationPreferences() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        // Add no-animation class to body
        document.body.classList.add('no-animations');
    }
}

/* ============================================================
   UTILITY FUNCTIONS
   ============================================================ */

/**
 * Debounce function
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
 * Throttle function
 */
function throttle(func, limit) {
    let inThrottle;
    return function(...args) {
        if (!inThrottle) {
            func.apply(this, args);
            inThrottle = true;
            setTimeout(() => {
                inThrottle = false;
            }, limit);
        }
    };
}

/**
 * Add CSS animation keyframes
 */
function addKeyframeAnimation(name, keyframes) {
    const style = document.createElement('style');
    style.textContent = `@keyframes ${name} { ${keyframes} }`;
    document.head.appendChild(style);
}

/**
 * Get element viewport position
 */
function isElementInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

/**
 * Handle orientation change
 */
function handleOrientationChange() {
    if (window.innerWidth < 768) {
        // Mobile view
        const navbar = document.querySelector('.navbar-collapse');
        if (navbar && !navbar.classList.contains('collapse')) {
            navbar.classList.add('collapse');
        }
    }
}

window.addEventListener('orientationchange', debounce(handleOrientationChange, 250));

/* ============================================================
   PARALLAX SCROLLING (OPTIONAL)
   ============================================================ */

/**
 * Setup parallax scrolling for hero sections
 */
function setupParallaxEffect() {
    const parallaxElements = document.querySelectorAll('[data-parallax]');
    
    if (parallaxElements.length === 0) return;
    
    window.addEventListener('scroll', throttle(() => {
        parallaxElements.forEach(element => {
            const distance = window.pageYOffset;
            const rate = distance * 0.5;
            element.style.transform = `translateY(${rate}px)`;
        });
    }, 16)); // ~60fps
}

/* ============================================================
   LAZY LOADING IMAGES
   ============================================================ */

/**
 * Setup lazy loading for images
 */
function setupLazyLoading() {
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                    imageObserver.unobserve(img);
                }
            });
        }, {
            rootMargin: '50px'
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
}

// Initialize lazy loading on DOM ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupLazyLoading);
} else {
    setupLazyLoading();
}

/* ============================================================
   NAVIGATION HELPER FUNCTIONS
   ============================================================ */

/**
 * Set active navigation item
 */
function setActiveNavItem(selector) {
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
    });
    
    const activeLink = document.querySelector(selector);
    if (activeLink) {
        activeLink.classList.add('active');
    }
}

/**
 * Close all dropdowns except one
 */
function closeOtherDropdowns(element) {
    document.querySelectorAll('.dropdown-menu').forEach(menu => {
        if (menu !== element) {
            menu.classList.remove('show');
        }
    });
}

/* ============================================================
   MOBILE MENU HANDLER
   ============================================================ */

/**
 * Handle mobile menu toggle
 */
function handleMobileMenuToggle() {
    const toggle = document.querySelector('.navbar-toggler');
    const collapse = document.querySelector('.navbar-collapse');
    
    if (toggle && collapse) {
        toggle.addEventListener('click', function() {
            APP_CONFIG.isMobileMenuOpen = !APP_CONFIG.isMobileMenuOpen;
            
            if (APP_CONFIG.isMobileMenuOpen) {
                collapse.style.animation = 'slideInDown 0.3s ease-in-out';
            } else {
                collapse.style.animation = '';
            }
        });
    }
}

handleMobileMenuToggle();

/* ============================================================
   EXPORT FUNCTIONS FOR EXTERNAL USE
   ============================================================ */

window.BankApp = {
    toggleDarkMode,
    showToast,
    showSuccessToast,
    showErrorToast,
    showWarningToast,
    validateEmail,
    validatePhone,
    setButtonLoading,
    animateElement,
    shakeElement,
    bounceElement,
    debounce,
    throttle
};
