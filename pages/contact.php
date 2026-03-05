<?php
/**
 * Contact Us Page
 * Contact form, branch information, and map
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/db.php';

$page_title = 'Contact Us - ' . SITE_NAME;
$meta_description = 'Get in touch with Shri Shantappanna Miraji Urban Co-op. Bank Ltd., Chikodi. Phone, email, and address.';

$form_submitted = false;
$form_message = '';
$form_message_type = '';

// Handle contact form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_form'])) {
    // Log all POST data received
    $log_dir = __DIR__ . '/logs';
    if (!is_dir($log_dir)) {
        mkdir($log_dir, 0755, true);
    }
    
    // Get raw POST values first
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Log submission attempt
    $log_entry = [
        'timestamp' => date('Y-m-d H:i:s'),
        'post_data' => $_POST,
        'parsed_data' => [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'subject' => $subject,
            'message' => $message
        ]
    ];
    error_log('Contact form submission received: ' . json_encode($log_entry));

    if (empty($name) || empty($email) || empty($message) || empty($subject)) {
        $form_message = 'Please fill in all required fields.';
        $form_message_type = 'danger';
        error_log('Contact form validation failed: Missing required fields');
    } elseif (!isValidEmail($email)) {
        $form_message = 'Please enter a valid email address.';
        $form_message_type = 'danger';
        error_log('Contact form validation failed: Invalid email - ' . $email);
    } else {
        try {
            // Get database connection
            $pdo = getDBConnection();
            
            // Check if table exists first
            $table_check = $pdo->query("SHOW TABLES LIKE 'contact_submissions'");
            
            if ($table_check->rowCount() === 0) {
                // Table doesn't exist, try to create it
                error_log('contact_submissions table does not exist, creating...');
                $create_table_sql = "
                CREATE TABLE IF NOT EXISTS contact_submissions (
                    id INT PRIMARY KEY AUTO_INCREMENT,
                    name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    phone VARCHAR(20),
                    subject VARCHAR(255) NOT NULL,
                    message LONGTEXT NOT NULL,
                    status ENUM('new', 'replied', 'archived') DEFAULT 'new',
                    admin_reply LONGTEXT,
                    admin_reply_by INT,
                    admin_reply_at DATETIME,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    FOREIGN KEY (admin_reply_by) REFERENCES admin_users(id) ON DELETE SET NULL,
                    KEY idx_email (email),
                    KEY idx_status (status),
                    KEY idx_created_at (created_at)
                )
                ";
                $pdo->exec($create_table_sql);
                error_log('contact_submissions table created successfully');
            }
            
            // Save contact submission to database using prepared statement
            $query = "INSERT INTO contact_submissions (name, email, phone, subject, message, status) 
                     VALUES (?, ?, ?, ?, ?, 'new')";
            
            error_log('Attempting to insert: name=' . $name . ', email=' . $email . ', subject=' . $subject);
            
            $stmt = $pdo->prepare($query);
            $result = $stmt->execute([
                $name,
                $email,
                $phone,
                $subject,
                $message
            ]);
            
            if ($result) {
                $insert_id = $pdo->lastInsertId();
                error_log('Contact submission inserted successfully with ID: ' . $insert_id);
                $form_submitted = true;
                $form_message = 'Thank you for your inquiry! We will contact you soon.';
                $form_message_type = 'success';
            } else {
                error_log('Contact submission insert failed: ' . json_encode($stmt->errorInfo()));
                $form_message = 'There was an error processing your request. Error: ' . $stmt->errorInfo()[2];
                $form_message_type = 'danger';
            }
        } catch (Exception $e) {
            error_log('Exception while saving contact submission: ' . $e->getMessage());
            $form_message = 'Error: ' . $e->getMessage();
            $form_message_type = 'danger';
        }
    }
}

?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/header.php'; ?>

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
                        <p class="text-muted mb-1">Mon–Fri: 10 AM – 4 PM</p>
                        <a href="tel:+918338273169" class="btn btn-sm btn-primary mb-1">+91 8338273169</a><br>
                        <a href="tel:+918494903886" class="btn btn-sm btn-outline-primary mt-1">+91 8494903886</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4 animate-on-scroll">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-envelope" style="font-size: 2.5rem; color: #10b981; margin-bottom: 1rem; display: block;"></i>
                        <h5 class="card-title">Email Us</h5>
                        <p class="text-muted mb-2">We'll respond within 24 hours</p>
                        <a href="mailto:shantappanna@mirajibank.com" class="btn btn-sm btn-success">shantappanna@mirajibank.com</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4 animate-on-scroll">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-map-marker-alt" style="font-size: 2.5rem; color: #f59e0b; margin-bottom: 1rem; display: block;"></i>
                        <h5 class="card-title">Visit Us</h5>
                        <p class="text-muted mb-2">Head Office — Chikodi</p>
                        <a href="#branches" class="btn btn-sm btn-warning">View Location</a>
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
                                Shri Shantappanna Miraji Urban Coop Bank Ltd.<br>
                                944-945, Guruwar Peth, Chikodi<br>
                                Belagavi, Karnataka 591201<br>
                                India
                            </p>
                        </div>

                        <div class="mb-4">
                            <h6 class="mb-2"><i class="fas fa-clock text-info me-2"></i>Working Hours</h6>
                            <p class="text-muted mb-1"><strong>Monday – Friday:</strong> 10:00 AM – 4:00 PM</p>
                            <p class="text-muted mb-1"><strong>Saturday:</strong> 10:00 AM – 1:00 PM</p>
                            <p class="text-muted"><strong>Sunday:</strong> Closed</p>
                        </div>

                        <div class="mb-4">
                            <h6 class="mb-2"><i class="fas fa-phone text-success me-2"></i>Customer Support</h6>
                            <p class="text-muted mb-1">Phone: <strong><a href="tel:+918338273169" class="text-decoration-none">+91 8338273169</a></strong></p>
                            <p class="text-muted mb-1">Phone: <strong><a href="tel:+918494903886" class="text-decoration-none">+91 8494903886</a></strong></p>
                            <p class="text-muted mb-1">Email: <strong><a href="mailto:shantappanna@mirajibank.com" class="text-decoration-none">shantappanna@mirajibank.com</a></strong></p>
                            <p class="text-muted">Website: <strong><a href="http://www.shantappannamirajibank.com" target="_blank" class="text-decoration-none">www.shantappannamirajibank.com</a></strong></p>
                        </div>

                        <!-- Embed Map -->
                        <div style="border-radius: 0.5rem; overflow: hidden; margin-top: 2rem;">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.0!2d74.5879!3d16.4333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc5af00000000000%3A0x0!2sChikodi%2C%20Karnataka%20591201!5e0!3m2!1sen!2sin!4v1234567890" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Branches — All 14 Branches -->
        <div class="row mt-5" id="branches">
            <div class="col-12 mb-4">
                <?php
                require_once $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/data-fetcher.php';
                $branches = $data_fetcher->getBranches();
                ?>
                <h3><i class="fas fa-map-marker-alt me-2 text-primary"></i>Our Branch Network</h3>
                <p class="text-muted">Serving you across 14 branches in Belagavi District and beyond</p>
            </div>

            <!-- Summary Cards -->
            <div class="col-12 mb-4">
                <div class="row g-3">
                    <?php foreach ($branches as $bi => $branch): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100" style="border-left:4px solid <?php echo $bi === 0 ? '#1e40af' : 'var(--secondary-color)'; ?>;">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-<?php echo $bi === 0 ? 'university' : 'map-marker-alt'; ?> fa-lg me-3 mt-1" style="color:<?php echo $bi === 0 ? '#1e40af' : 'var(--secondary-color)'; ?>;"></i>
                                    <div>
                                        <h6 class="mb-1"><?php echo htmlspecialchars($branch['name']); ?></h6>
                                        <p class="text-muted small mb-1"><i class="fas fa-map-pin me-1"></i><?php echo htmlspecialchars($branch['address']); ?></p>
                                        <?php if (!empty($branch['phone'])): ?>
                                        <p class="small mb-1"><i class="fas fa-phone me-1 text-success"></i><a href="tel:<?php echo $branch['phone']; ?>" class="text-decoration-none"><?php echo $branch['phone']; ?></a></p>
                                        <?php endif; ?>
                                        <?php if (!empty($branch['ifsc'])): ?>
                                        <p class="small mb-0 text-muted"><strong>IFSC:</strong> <?php echo $branch['ifsc']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/bank-website-grok/includes/footer.php'; ?>
