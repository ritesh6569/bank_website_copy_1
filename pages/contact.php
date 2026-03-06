<?php
/**
 * Contact Us Page
 * Contact form, branch information, and map
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/db.php';

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
<?php include __DIR__ . '/../includes/header.php'; ?>

    <!-- Hero -->
    <section style="background:linear-gradient(150deg,#0D3D2E 0%,#1A5C42 60%,#2E8B63 100%);padding:5rem 0 4rem;position:relative;overflow:hidden;">
        <div style="position:absolute;top:-60px;right:-60px;width:380px;height:380px;border-radius:50%;background:rgba(255,255,255,0.03);pointer-events:none;"></div>
        <div style="position:absolute;bottom:-80px;left:-50px;width:280px;height:280px;border-radius:50%;background:rgba(184,115,51,0.06);pointer-events:none;"></div>
        <div class="container-lg" style="position:relative;z-index:1;">
            <div style="max-width:680px;">
                <span style="display:inline-block;background:rgba(255,255,255,0.12);color:#fff;font-size:0.7rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:0.25rem 0.9rem;border-radius:20px;margin-bottom:1rem;">Contact Us</span>
                <h1 style="color:#fff;font-size:clamp(2rem,4vw,2.9rem);font-weight:800;line-height:1.2;margin-bottom:1rem;">
                    We're Here<br><span style="color:#CC8A4A;">to Help You</span>
                </h1>
                <p style="color:rgba(255,255,255,0.78);font-size:1.05rem;margin-bottom:2rem;line-height:1.7;">
                    Reach out to us anytime — our team is ready to assist you with all your banking needs.
                </p>
                <div style="display:flex;flex-wrap:wrap;gap:0.75rem;">
                    <a href="tel:+918338273169" style="display:inline-flex;align-items:center;gap:0.5rem;background:rgba(255,255,255,0.1);color:#fff;font-size:0.82rem;font-weight:600;padding:0.45rem 1rem;border-radius:20px;text-decoration:none;border:1px solid rgba(255,255,255,0.18);">
                        <i class="fas fa-phone" style="font-size:0.75rem;color:#CC8A4A;"></i>+91 8338273169
                    </a>
                    <a href="tel:+918494903886" style="display:inline-flex;align-items:center;gap:0.5rem;background:rgba(255,255,255,0.1);color:#fff;font-size:0.82rem;font-weight:600;padding:0.45rem 1rem;border-radius:20px;text-decoration:none;border:1px solid rgba(255,255,255,0.18);">
                        <i class="fas fa-phone" style="font-size:0.75rem;color:#CC8A4A;"></i>+91 8494903886
                    </a>
                    <a href="mailto:shantappanna@mirajibank.com" style="display:inline-flex;align-items:center;gap:0.5rem;background:rgba(255,255,255,0.1);color:#fff;font-size:0.82rem;font-weight:600;padding:0.45rem 1rem;border-radius:20px;text-decoration:none;border:1px solid rgba(255,255,255,0.18);">
                        <i class="fas fa-envelope" style="font-size:0.75rem;color:#CC8A4A;"></i>shantappanna@mirajibank.com
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Info Cards -->
    <section style="background:#F5F8F5;padding:3rem 0;">
        <div class="container-lg">
            <div class="row g-3">
                <div class="col-md-4">
                    <div style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;padding:1.5rem;text-align:center;height:100%;">
                        <div style="width:52px;height:52px;border-radius:13px;background:#EBF2ED;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                            <i class="fas fa-phone" style="color:#0D3D2E;font-size:1.2rem;"></i>
                        </div>
                        <h5 style="font-weight:700;color:#1C2B22;margin-bottom:0.4rem;">Call Us</h5>
                        <p style="color:#7A9485;font-size:0.82rem;margin-bottom:0.75rem;">Mon–Fri: 10 AM – 4 PM<br>Sat: 10 AM – 1 PM</p>
                        <a href="tel:+918338273169" style="display:inline-block;background:#0D3D2E;color:#fff;font-size:0.82rem;font-weight:600;padding:0.4rem 1.1rem;border-radius:7px;text-decoration:none;margin-bottom:0.35rem;"
                           onmouseover="this.style.background='#1A5C42'" onmouseout="this.style.background='#0D3D2E'">+91 8338273169</a><br>
                        <a href="tel:+918494903886" style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.82rem;font-weight:600;padding:0.4rem 1.1rem;border-radius:7px;text-decoration:none;margin-top:0.35rem;">+91 8494903886</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;padding:1.5rem;text-align:center;height:100%;">
                        <div style="width:52px;height:52px;border-radius:13px;background:#EBF2ED;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                            <i class="fas fa-envelope" style="color:#0D3D2E;font-size:1.2rem;"></i>
                        </div>
                        <h5 style="font-weight:700;color:#1C2B22;margin-bottom:0.4rem;">Email Us</h5>
                        <p style="color:#7A9485;font-size:0.82rem;margin-bottom:0.75rem;">We'll respond within 24 hours</p>
                        <a href="mailto:shantappanna@mirajibank.com" style="display:inline-block;background:#0D3D2E;color:#fff;font-size:0.8rem;font-weight:600;padding:0.4rem 1rem;border-radius:7px;text-decoration:none;word-break:break-all;"
                           onmouseover="this.style.background='#1A5C42'" onmouseout="this.style.background='#0D3D2E'">shantappanna@mirajibank.com</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;padding:1.5rem;text-align:center;height:100%;">
                        <div style="width:52px;height:52px;border-radius:13px;background:#EBF2ED;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                            <i class="fas fa-map-marker-alt" style="color:#B87333;font-size:1.2rem;"></i>
                        </div>
                        <h5 style="font-weight:700;color:#1C2B22;margin-bottom:0.4rem;">Visit Us</h5>
                        <p style="color:#7A9485;font-size:0.82rem;margin-bottom:0.75rem;">Head Office — Chikodi<br>Belagavi, Karnataka 591201</p>
                        <a href="#branches" style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.82rem;font-weight:600;padding:0.4rem 1.1rem;border-radius:7px;text-decoration:none;">View Branches</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form & Location -->
    <section style="background:#fff;padding:4rem 0;">
        <div class="container-lg">
            <div class="row g-4 align-items-stretch">
                <!-- Contact Form -->
                <div class="col-lg-6">
                    <div style="background:#fff;border:1px solid #D6E4DA;border-radius:16px;overflow:hidden;height:100%;display:flex;flex-direction:column;">
                        <div style="background:#0D3D2E;padding:1.1rem 1.5rem;display:flex;align-items:center;gap:0.65rem;">
                            <i class="fas fa-paper-plane" style="color:#CC8A4A;"></i>
                            <span style="color:#fff;font-weight:700;font-size:0.95rem;">Send Us a Message</span>
                        </div>
                        <div style="padding:1.75rem;flex:1;display:flex;flex-direction:column;">
                            <?php if (!empty($form_message)): ?>
                            <div style="background:<?php echo $form_message_type === 'success' ? '#EBF2ED' : '#fef2f2'; ?>;border-left:4px solid <?php echo $form_message_type === 'success' ? '#0D3D2E' : '#dc2626'; ?>;border-radius:0 10px 10px 0;padding:0.85rem 1.1rem;display:flex;align-items:center;gap:0.65rem;margin-bottom:1.25rem;">
                                <i class="fas <?php echo $form_message_type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?>" style="color:<?php echo $form_message_type === 'success' ? '#0D3D2E' : '#dc2626'; ?>;flex-shrink:0;"></i>
                                <span style="color:<?php echo $form_message_type === 'success' ? '#1C2B22' : '#dc2626'; ?>;font-size:0.9rem;"><?php echo $form_message; ?></span>
                            </div>
                            <?php endif; ?>
                            <form method="POST" action="" style="display:flex;flex-direction:column;flex:1;gap:1rem;">
                                <input type="hidden" name="contact_form" value="1">
                                <div>
                                    <label style="display:block;font-size:0.85rem;font-weight:600;color:#1C2B22;margin-bottom:0.4rem;">Full Name <span style="color:#dc2626;">*</span></label>
                                    <input type="text" name="name" required style="width:100%;padding:0.6rem 0.85rem;border:1px solid #D6E4DA;border-radius:8px;font-size:0.9rem;color:#1C2B22;outline:none;font-family:inherit;box-sizing:border-box;"
                                           onfocus="this.style.borderColor='#0D3D2E'" onblur="this.style.borderColor='#D6E4DA'">
                                </div>
                                <div>
                                    <label style="display:block;font-size:0.85rem;font-weight:600;color:#1C2B22;margin-bottom:0.4rem;">Email Address <span style="color:#dc2626;">*</span></label>
                                    <input type="email" name="email" required style="width:100%;padding:0.6rem 0.85rem;border:1px solid #D6E4DA;border-radius:8px;font-size:0.9rem;color:#1C2B22;outline:none;font-family:inherit;box-sizing:border-box;"
                                           onfocus="this.style.borderColor='#0D3D2E'" onblur="this.style.borderColor='#D6E4DA'">
                                </div>
                                <div>
                                    <label style="display:block;font-size:0.85rem;font-weight:600;color:#1C2B22;margin-bottom:0.4rem;">Phone Number <span style="color:#dc2626;">*</span></label>
                                    <input type="tel" name="phone" required style="width:100%;padding:0.6rem 0.85rem;border:1px solid #D6E4DA;border-radius:8px;font-size:0.9rem;color:#1C2B22;outline:none;font-family:inherit;box-sizing:border-box;"
                                           onfocus="this.style.borderColor='#0D3D2E'" onblur="this.style.borderColor='#D6E4DA'">
                                </div>
                                <div>
                                    <label style="display:block;font-size:0.85rem;font-weight:600;color:#1C2B22;margin-bottom:0.4rem;">Subject <span style="color:#dc2626;">*</span></label>
                                    <input type="text" name="subject" required style="width:100%;padding:0.6rem 0.85rem;border:1px solid #D6E4DA;border-radius:8px;font-size:0.9rem;color:#1C2B22;outline:none;font-family:inherit;box-sizing:border-box;"
                                           onfocus="this.style.borderColor='#0D3D2E'" onblur="this.style.borderColor='#D6E4DA'">
                                </div>
                                <div style="flex:1;display:flex;flex-direction:column;">
                                    <label style="display:block;font-size:0.85rem;font-weight:600;color:#1C2B22;margin-bottom:0.4rem;">Message <span style="color:#dc2626;">*</span></label>
                                    <textarea name="message" rows="4" required style="width:100%;padding:0.6rem 0.85rem;border:1px solid #D6E4DA;border-radius:8px;font-size:0.9rem;color:#1C2B22;outline:none;font-family:inherit;resize:vertical;flex:1;box-sizing:border-box;"
                                              onfocus="this.style.borderColor='#0D3D2E'" onblur="this.style.borderColor='#D6E4DA'"></textarea>
                                </div>
                                <button type="submit" style="width:100%;background:#0D3D2E;color:#fff;padding:0.75rem;border:none;border-radius:8px;font-size:0.95rem;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:0.5rem;font-family:inherit;"
                                        onmouseover="this.style.background='#1A5C42'" onmouseout="this.style.background='#0D3D2E'">
                                    <i class="fas fa-paper-plane"></i>Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Location & Hours -->
                <div class="col-lg-6">
                    <div style="background:#fff;border:1px solid #D6E4DA;border-radius:16px;overflow:hidden;height:100%;display:flex;flex-direction:column;">
                        <div style="background:#0D3D2E;padding:1.1rem 1.5rem;display:flex;align-items:center;gap:0.65rem;">
                            <i class="fas fa-map-pin" style="color:#CC8A4A;"></i>
                            <span style="color:#fff;font-weight:700;font-size:0.95rem;">Location &amp; Hours</span>
                        </div>
                        <div style="padding:1.75rem;flex:1;display:flex;flex-direction:column;gap:1.5rem;">
                            <div>
                                <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.6rem;">
                                    <div style="width:32px;height:32px;border-radius:8px;background:#EBF2ED;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas fa-university" style="color:#0D3D2E;font-size:0.8rem;"></i>
                                    </div>
                                    <span style="font-weight:700;color:#1C2B22;font-size:0.95rem;">Head Office</span>
                                </div>
                                <p style="color:#3D5A47;font-size:0.88rem;line-height:1.7;margin:0;padding-left:2.5rem;">
                                    Shri Shantappanna Miraji Urban Coop Bank Ltd.<br>
                                    944-945, Guruwar Peth, Chikodi<br>
                                    Belagavi, Karnataka 591201, India
                                </p>
                            </div>
                            <div>
                                <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.6rem;">
                                    <div style="width:32px;height:32px;border-radius:8px;background:#EBF2ED;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas fa-clock" style="color:#0D3D2E;font-size:0.8rem;"></i>
                                    </div>
                                    <span style="font-weight:700;color:#1C2B22;font-size:0.95rem;">Working Hours</span>
                                </div>
                                <div style="padding-left:2.5rem;">
                                    <p style="color:#3D5A47;font-size:0.88rem;margin-bottom:0.3rem;"><strong style="color:#1C2B22;">Monday – Friday:</strong> 10:00 AM – 4:00 PM</p>
                                    <p style="color:#3D5A47;font-size:0.88rem;margin-bottom:0.3rem;"><strong style="color:#1C2B22;">Saturday:</strong> 10:00 AM – 1:00 PM</p>
                                    <p style="color:#7A9485;font-size:0.88rem;margin:0;"><strong style="color:#1C2B22;">Sunday:</strong> Closed</p>
                                </div>
                            </div>
                            <div>
                                <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.6rem;">
                                    <div style="width:32px;height:32px;border-radius:8px;background:#EBF2ED;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas fa-headset" style="color:#0D3D2E;font-size:0.8rem;"></i>
                                    </div>
                                    <span style="font-weight:700;color:#1C2B22;font-size:0.95rem;">Customer Support</span>
                                </div>
                                <div style="padding-left:2.5rem;">
                                    <p style="color:#3D5A47;font-size:0.88rem;margin-bottom:0.3rem;"><i class="fas fa-phone" style="color:#B87333;margin-right:0.4rem;font-size:0.8rem;"></i><a href="tel:+918338273169" style="color:#0D3D2E;font-weight:600;text-decoration:none;">+91 8338273169</a></p>
                                    <p style="color:#3D5A47;font-size:0.88rem;margin-bottom:0.3rem;"><i class="fas fa-phone" style="color:#B87333;margin-right:0.4rem;font-size:0.8rem;"></i><a href="tel:+918494903886" style="color:#0D3D2E;font-weight:600;text-decoration:none;">+91 8494903886</a></p>
                                    <p style="color:#3D5A47;font-size:0.88rem;margin-bottom:0.3rem;"><i class="fas fa-envelope" style="color:#B87333;margin-right:0.4rem;font-size:0.8rem;"></i><a href="mailto:shantappanna@mirajibank.com" style="color:#0D3D2E;font-weight:600;text-decoration:none;">shantappanna@mirajibank.com</a></p>
                                    <p style="color:#3D5A47;font-size:0.88rem;margin:0;"><i class="fas fa-globe" style="color:#B87333;margin-right:0.4rem;font-size:0.8rem;"></i><a href="http://www.shantappannamirajibank.com" target="_blank" style="color:#0D3D2E;font-weight:600;text-decoration:none;">www.shantappannamirajibank.com</a></p>
                                </div>
                            </div>
                            <div style="border-radius:10px;overflow:hidden;flex:1;min-height:180px;">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.0!2d74.5879!3d16.4333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc5af00000000000%3A0x0!2sChikodi%2C%20Karnataka%20591201!5e0!3m2!1sen!2sin!4v1234567890"
                                        width="100%" height="100%" style="border:0;display:block;min-height:180px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Branch Network -->
    <section id="branches" style="background:#F5F8F5;padding:4rem 0;">
        <div class="container-lg">
            <div style="margin-bottom:2.5rem;">
                <span style="display:inline-block;background:#EBF2ED;color:#0D3D2E;font-size:0.7rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.8rem;border-radius:20px;margin-bottom:0.75rem;">Branches</span>
                <h2 style="font-size:1.75rem;font-weight:800;color:#1C2B22;margin-bottom:0.4rem;">Our Branch Network</h2>
                <p style="color:#3D5A47;font-size:0.95rem;">Serving you across 14 branches in Belagavi District and beyond</p>
            </div>
            <?php
            require_once __DIR__ . '/../includes/data-fetcher.php';
            $branches = $data_fetcher->getBranches();
            ?>
            <div class="row g-3">
                <?php foreach ($branches as $bi => $branch): ?>
                <div class="col-md-6 col-lg-4">
                    <div style="background:#fff;border:1px solid #D6E4DA;border-radius:14px;padding:1.25rem;height:100%;transition:box-shadow 0.2s;"
                         onmouseover="this.style.boxShadow='0 6px 20px rgba(13,61,46,0.1)'" onmouseout="this.style.boxShadow='none'">
                        <div style="display:flex;align-items:flex-start;gap:0.75rem;">
                            <div style="width:40px;height:40px;border-radius:10px;background:<?php echo $bi === 0 ? '#0D3D2E' : '#EBF2ED'; ?>;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fas <?php echo $bi === 0 ? 'fa-university' : 'fa-map-marker-alt'; ?>" style="color:<?php echo $bi === 0 ? '#CC8A4A' : '#0D3D2E'; ?>;font-size:0.9rem;"></i>
                            </div>
                            <div>
                                <h6 style="font-weight:700;color:#1C2B22;margin-bottom:0.25rem;font-size:0.9rem;"><?php echo htmlspecialchars($branch['name']); ?></h6>
                                <p style="color:#7A9485;font-size:0.8rem;margin-bottom:0.25rem;line-height:1.5;"><i class="fas fa-map-pin" style="color:#B87333;margin-right:0.3rem;font-size:0.7rem;"></i><?php echo htmlspecialchars($branch['address']); ?></p>
                                <?php if (!empty($branch['phone'])): ?>
                                <p style="font-size:0.8rem;margin-bottom:0.2rem;"><i class="fas fa-phone" style="color:#0D3D2E;margin-right:0.3rem;font-size:0.7rem;"></i><a href="tel:<?php echo $branch['phone']; ?>" style="color:#0D3D2E;font-weight:600;text-decoration:none;"><?php echo $branch['phone']; ?></a></p>
                                <?php endif; ?>
                                <?php if (!empty($branch['ifsc'])): ?>
                                <p style="font-size:0.78rem;color:#7A9485;margin:0;"><strong style="color:#1C2B22;">IFSC:</strong> <?php echo $branch['ifsc']; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section style="background:linear-gradient(135deg,#0D3D2E,#1A5C42);padding:4rem 0;">
        <div class="container-lg" style="text-align:center;">
            <span style="display:inline-block;background:rgba(255,255,255,0.12);color:#fff;font-size:0.7rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;padding:0.25rem 0.9rem;border-radius:20px;margin-bottom:1rem;">Get In Touch</span>
            <h2 style="color:#fff;font-size:1.9rem;font-weight:800;margin-bottom:0.75rem;">Ready to Bank with Us?</h2>
            <p style="color:rgba(255,255,255,0.75);font-size:1rem;max-width:520px;margin:0 auto 2rem;">Open an account, apply for a loan, or enquire about any service — we're just a call away.</p>
            <div style="display:flex;flex-wrap:wrap;gap:1rem;justify-content:center;">
                <a href="tel:+918338273169" style="display:inline-flex;align-items:center;gap:0.5rem;background:#B87333;color:#fff;padding:0.75rem 1.8rem;border-radius:8px;text-decoration:none;font-weight:700;font-size:0.95rem;"
                   onmouseover="this.style.background='#CC8A4A'" onmouseout="this.style.background='#B87333'">
                    <i class="fas fa-phone"></i>+91 8338273169
                </a>
                <a href="<?php echo SITE_URL; ?>pages/deposits.php" style="display:inline-flex;align-items:center;gap:0.5rem;background:rgba(255,255,255,0.12);color:#fff;padding:0.75rem 1.8rem;border-radius:8px;text-decoration:none;font-weight:600;font-size:0.95rem;border:1px solid rgba(255,255,255,0.25);"
                   onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'">
                    <i class="fas fa-piggy-bank"></i>Open a Deposit
                </a>
                <a href="<?php echo SITE_URL; ?>pages/loans.php" style="display:inline-flex;align-items:center;gap:0.5rem;background:rgba(255,255,255,0.12);color:#fff;padding:0.75rem 1.8rem;border-radius:8px;text-decoration:none;font-weight:600;font-size:0.95rem;border:1px solid rgba(255,255,255,0.25);"
                   onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'">
                    <i class="fas fa-hand-holding-usd"></i>Apply for a Loan
                </a>
            </div>
        </div>
    </section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
