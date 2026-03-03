<?php
/**
 * Contact Us Page - Professional Bank Website
 */

$page_title = 'Contact Us - Professional Bank';
$current_page = 'contact';

include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/data-fetcher.php';

$branches = $data_fetcher->getBranches();
?>

    <!-- Page Header -->
    <div class="bg-primary text-white py-5">
        <div class="container-lg">
            <h1 class="mb-2">Contact Us</h1>
            <p class="lead">We're here to help. Reach out to us through any of these channels</p>
        </div>
    </div>

    <!-- Contact Information Section -->
    <section class="section">
        <div class="container-lg">
            <div class="row g-4 mb-5">
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-phone" style="font-size: 2.5rem; color: var(--secondary-color); margin-bottom: 1rem;"></i>
                            <h5 class="card-title">Phone</h5>
                            <p class="text-muted">
                                <a href="tel:+1234567890" class="text-decoration-none">+1 (234) 567-890</a>
                            </p>
                            <p class="small text-muted">Available 24/7</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-envelope" style="font-size: 2.5rem; color: var(--secondary-color); margin-bottom: 1rem;"></i>
                            <h5 class="card-title">Email</h5>
                            <p class="text-muted">
                                <a href="mailto:support@bank.com" class="text-decoration-none">support@bank.com</a>
                            </p>
                            <p class="small text-muted">Response within 24 hours</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-map-marker-alt" style="font-size: 2.5rem; color: var(--secondary-color); margin-bottom: 1rem;"></i>
                            <h5 class="card-title">Address</h5>
                            <p class="text-muted">
                                123 Banking Street<br>Financial City, FC 12345
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-clock" style="font-size: 2.5rem; color: var(--secondary-color); margin-bottom: 1rem;"></i>
                            <h5 class="card-title">Hours</h5>
                            <p class="text-muted small">
                                Mon-Fri: 10:00 AM - 4:00 PM<br>
                                Sat: 10:00 AM - 1:00 PM<br>
                                Sun: Closed
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Send us a Message</h5>
                        </div>
                        <div class="card-body">
                            <form id="contactForm" novalidate>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="contactName" class="form-label">Full Name *</label>
                                        <input type="text" class="form-control" id="contactName" name="name" required>
                                        <div class="invalid-feedback">Please provide your name.</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="contactEmail" class="form-label">Email Address *</label>
                                        <input type="email" class="form-control" id="contactEmail" name="email" required>
                                        <div class="invalid-feedback">Please provide a valid email.</div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="contactPhone" class="form-label">Phone Number *</label>
                                        <input type="tel" class="form-control" id="contactPhone" name="phone" required>
                                        <div class="invalid-feedback">Please provide a phone number.</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="contactSubject" class="form-label">Subject *</label>
                                        <select class="form-select" id="contactSubject" name="subject" required>
                                            <option value="">Select a subject...</option>
                                            <option value="account">Account Related Query</option>
                                            <option value="loan">Loan Inquiry</option>
                                            <option value="deposits">Deposits Inquiry</option>
                                            <option value="services">Services Inquiry</option>
                                            <option value="complaint">Complaint</option>
                                            <option value="suggestion">Suggestion</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a subject.</div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="contactMessage" class="form-label">Message *</label>
                                    <textarea class="form-control" id="contactMessage" name="message" rows="6" required></textarea>
                                    <div class="invalid-feedback">Please provide a message.</div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="contactTerms" name="terms" required>
                                        <label class="form-check-label" for="contactTerms">
                                            I agree to the terms and conditions
                                        </label>
                                        <div class="invalid-feedback">You must agree to proceed.</div>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Quick Assistance</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-3">Common Queries</h6>
                            <ul class="list-unstyled small">
                                <li class="py-2">
                                    <a href="#" class="text-decoration-none">
                                        <i class="fas fa-question-circle me-2"></i>FAQ
                                    </a>
                                </li>
                                <li class="py-2">
                                    <a href="#" class="text-decoration-none">
                                        <i class="fas fa-question-circle me-2"></i>How to Apply for Account?
                                    </a>
                                </li>
                                <li class="py-2">
                                    <a href="#" class="text-decoration-none">
                                        <i class="fas fa-question-circle me-2"></i>Forgot Password?
                                    </a>
                                </li>
                                <li class="py-2">
                                    <a href="#" class="text-decoration-none">
                                        <i class="fas fa-question-circle me-2"></i>Security Tips
                                    </a>
                                </li>
                                <li class="py-2">
                                    <a href="#" class="text-decoration-none">
                                        <i class="fas fa-question-circle me-2"></i>Service Charges
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Follow Us</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-outline-primary btn-sm flex-grow-1">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary btn-sm flex-grow-1">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary btn-sm flex-grow-1">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary btn-sm flex-grow-1">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Branches List Section -->
    <section class="section bg-light">
        <div class="container-lg">
            <div class="section-title">
                <h2>Our Branches</h2>
                <p class="section-subtitle">Visit any of our branches for in-person banking services</p>
            </div>
            
            <div class="row g-4">
                <?php foreach ($branches as $index => $branch): ?>
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><?php echo htmlspecialchars($branch['name']); ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <h6 class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i>Address</h6>
                                    <p class="text-muted"><?php echo htmlspecialchars($branch['address']); ?></p>
                                </div>
                                
                                <div class="mb-3">
                                    <h6 class="mb-2"><i class="fas fa-phone text-primary me-2"></i>Phone</h6>
                                    <p class="text-muted">
                                        <a href="tel:<?php echo htmlspecialchars($branch['phone']); ?>" class="text-decoration-none">
                                            <?php echo htmlspecialchars($branch['phone']); ?>
                                        </a>
                                    </p>
                                </div>
                                
                                <div class="mb-3">
                                    <h6 class="mb-2"><i class="fas fa-envelope text-primary me-2"></i>Email</h6>
                                    <p class="text-muted">
                                        <a href="mailto:<?php echo htmlspecialchars($branch['email']); ?>" class="text-decoration-none">
                                            <?php echo htmlspecialchars($branch['email']); ?>
                                        </a>
                                    </p>
                                </div>
                                
                                <div class="mb-3">
                                    <h6 class="mb-2"><i class="fas fa-clock text-primary me-2"></i>Hours</h6>
                                    <p class="text-muted small"><?php echo htmlspecialchars($branch['hours']); ?></p>
                                </div>
                                
                                <button class="btn btn-outline-primary w-100">
                                    <i class="fas fa-directions me-2"></i>Get Directions
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Feedback Section -->
    <section class="section">
        <div class="container-lg">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white;">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-3">We Value Your Feedback</h3>
                            <p class="mb-4">Your feedback helps us improve our services. Let us know about your experience with Professional Bank.</p>
                            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#feedbackModal">
                                <i class="fas fa-star me-2"></i>Share Your Feedback
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feedback Modal -->
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="feedbackModalLabel">Share Your Feedback</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="feedbackForm" novalidate>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="feedbackName" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="feedbackName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="feedbackEmail" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="feedbackEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="feedbackRating" class="form-label">How satisfied are you with our service?</label>
                            <select class="form-select" id="feedbackRating" name="rating" required>
                                <option value="">Select rating...</option>
                                <option value="5">Very Satisfied (5 Stars)</option>
                                <option value="4">Satisfied (4 Stars)</option>
                                <option value="3">Neutral (3 Stars)</option>
                                <option value="2">Unsatisfied (2 Stars)</option>
                                <option value="1">Very Unsatisfied (1 Star)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="feedbackComment" class="form-label">Comments</label>
                            <textarea class="form-control" id="feedbackComment" name="comment" rows="4" placeholder="Please share your thoughts..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit Feedback</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            handleFormSubmit('contactForm', function(data) {
                console.log('Contact form submitted:', data);
                // In production, send to backend API
            });
            
            handleFormSubmit('feedbackForm', function(data) {
                console.log('Feedback submitted:', data);
                // In production, send to backend API
                // Close modal after submission
                const feedbackModal = bootstrap.Modal.getInstance(document.getElementById('feedbackModal'));
                if (feedbackModal) {
                    feedbackModal.hide();
                }
            });
        });
    </script>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/footer.php';
?>
