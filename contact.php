<?php
/**
 * Contact Us Page
 * Contact form, branch information, and map
 */

require_once 'config.php';
require_once 'includes/helpers.php';

$page_title = 'Contact Us - ' . SITE_NAME;
$meta_description = 'Get in touch with ' . SITE_NAME . '. Find branches, phone numbers, and contact information';

$form_submitted = false;
$form_message = '';
$form_message_type = '';

// Handle contact form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_form'])) {
    $name = sanitize($_POST['name'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $phone = sanitize($_POST['phone'] ?? '');
    $subject = sanitize($_POST['subject'] ?? '');
    $message = sanitize($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        $form_message = 'Please fill in all required fields.';
        $form_message_type = 'danger';
    } elseif (!isValidEmail($email)) {
        $form_message = 'Please enter a valid email address.';
        $form_message_type = 'danger';
    } else {
        // In a real scenario, send email here
        // For now, just show success message
        $form_submitted = true;
        $form_message = 'Thank you for your inquiry! We will contact you soon.';
        $form_message_type = 'success';
    }
}

?>
<?php include 'includes/header.php'; ?>

<!-- Page Header -->
<section style="background: linear-gradient(135deg, #1e3a8a 0%, #2d5a8c 100%); color: white; padding: 60px 0;">
    <div class="container">
        <h1 class="mb-2">Contact Us</h1>
        <p style="color: rgba(255, 255, 255, 0.9);">We're here to help. Reach out to us anytime</p>
    </div>
</section>

<!-- Contact Content -->
<section class="py-5">
    <div class="container">
        <!-- Quick Contact Info -->
        <div class="row mb-5">
            <div class="col-md-4 mb-4 animate-on-scroll">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-phone" style="font-size: 2.5rem; color: #3b82f6; margin-bottom: 1rem; display: block;"></i>
                        <h5 class="card-title">Call Us</h5>
                        <p class="text-muted mb-2">Available 24/7</p>
                        <a href="tel:+919876543210" class="btn btn-sm btn-primary">+91-9876-543-210</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4 animate-on-scroll">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-envelope" style="font-size: 2.5rem; color: #10b981; margin-bottom: 1rem; display: block;"></i>
                        <h5 class="card-title">Email Us</h5>
                        <p class="text-muted mb-2">We'll respond within 24 hours</p>
                        <a href="mailto:<?php echo ADMIN_EMAIL; ?>" class="btn btn-sm btn-success"><?php echo ADMIN_EMAIL; ?></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4 animate-on-scroll">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-map-marker-alt" style="font-size: 2.5rem; color: #f59e0b; margin-bottom: 1rem; display: block;"></i>
                        <h5 class="card-title">Visit Us</h5>
                        <p class="text-muted mb-2">Main Branch - Miraj</p>
                        <a href="#branches" class="btn btn-sm btn-warning">View Branches</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form & Map -->
        <div class="row mb-5">
            <!-- Contact Form -->
            <div class="col-lg-6 mb-4 animate-on-scroll">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Send us a Message</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($form_message)): ?>
                            <div class="alert alert-<?php echo $form_message_type; ?> alert-dismissible fade show" role="alert">
                                <?php echo $form_message; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <input type="hidden" name="contact_form" value="1">
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="(Optional)">
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject *</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Message *</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Map/Info -->
            <div class="col-lg-6 mb-4 animate-on-scroll">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Location & Hours</h5>
                        
                        <div class="mb-4">
                            <h6 class="mb-2"><i class="fas fa-map-pin text-danger me-2"></i>Head Office</h6>
                            <p class="text-muted">
                                Shantappanna Miraj Bank<br>
                                Main Branch, Miraj<br>
                                Maharashtra - 416410<br>
                                India
                            </p>
                        </div>

                        <div class="mb-4">
                            <h6 class="mb-2"><i class="fas fa-clock text-info me-2"></i>Working Hours</h6>
                            <p class="text-muted mb-1"><strong>Monday - Friday:</strong> 10:00 AM - 5:00 PM</p>
                            <p class="text-muted mb-1"><strong>Saturday:</strong> 10:00 AM - 2:00 PM</p>
                            <p class="text-muted"><strong>Sunday:</strong> Closed</p>
                        </div>

                        <div class="mb-4">
                            <h6 class="mb-2"><i class="fas fa-phone text-success me-2"></i>Customer Support</h6>
                            <p class="text-muted mb-1">Toll Free: <strong>1800-123-4567</strong></p>
                            <p class="text-muted">Available 24/7 for your assistance</p>
                        </div>

                        <!-- Embed Map -->
                        <div style="border-radius: 0.5rem; overflow: hidden; margin-top: 2rem;">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3812.897382866829!2d74.54614!3d16.8278!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc5c6b5c5c5c5c5%3A0x5c5c5c5c5c5c5c5c!2sMiraj%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1234567890" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Branches -->
        <div class="row" id="branches">
            <div class="col-12 mb-4">
                <h3>Our Branches</h3>
                <p class="text-muted">Visit any of our branches across the region</p>
            </div>

            <div class="col-12 animate-on-scroll">
                <div class="accordion" id="branchesAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#branch1">
                                <i class="fas fa-building me-2"></i>Main Branch - Miraj
                            </button>
                        </h2>
                        <div id="branch1" class="accordion-collapse collapse show" data-bs-parent="#branchesAccordion">
                            <div class="accordion-body">
                                <p><strong>Address:</strong> Shantappanna Complex, Main Road, Miraj - 416410</p>
                                <p><strong>Phone:</strong> <a href="tel:+919876543210">+91-9876-543-210</a></p>
                                <p><strong>Email:</strong> <a href="mailto:miraj@bank.com">miraj@bank.com</a></p>
                                <p><strong>Hours:</strong> Monday - Friday: 10:00 AM - 5:00 PM, Saturday: 10:00 AM - 2:00 PM</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#branch2">
                                <i class="fas fa-building me-2"></i>Miraj West Branch
                            </button>
                        </h2>
                        <div id="branch2" class="accordion-collapse collapse" data-bs-parent="#branchesAccordion">
                            <div class="accordion-body">
                                <p><strong>Address:</strong> 123, West Road, Miraj - 416410</p>
                                <p><strong>Phone:</strong> <a href="tel:+919876543211">+91-9876-543-211</a></p>
                                <p><strong>Email:</strong> <a href="mailto:west@bank.com">west@bank.com</a></p>
                                <p><strong>Hours:</strong> Monday - Friday: 10:00 AM - 5:00 PM, Saturday: 10:00 AM - 2:00 PM</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#branch3">
                                <i class="fas fa-building me-2"></i>Pandharpur Branch
                            </button>
                        </h2>
                        <div id="branch3" class="accordion-collapse collapse" data-bs-parent="#branchesAccordion">
                            <div class="accordion-body">
                                <p><strong>Address:</strong> 456, Main Street, Pandharpur - 413304</p>
                                <p><strong>Phone:</strong> <a href="tel:+919876543212">+91-9876-543-212</a></p>
                                <p><strong>Email:</strong> <a href="mailto:pandharpur@bank.com">pandharpur@bank.com</a></p>
                                <p><strong>Hours:</strong> Monday - Friday: 10:00 AM - 5:00 PM, Saturday: 10:00 AM - 2:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
