<?php
/**
 * Footer Component
 * Includes copyright, links, and social media
 */
?>
    <!-- Main Content Ends Here -->
    
    <!-- Footer -->
    <footer style="background: #0f2c5e; color: rgba(255,255,255,0.8);" class="mt-5">

        <div class="container-lg py-4">
            <div class="row g-4">

                <!-- Left: Bank Info -->
                <div class="col-md-5 col-sm-12">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="fas fa-university fa-lg" style="color:#c5a880;"></i>
                        <span class="fw-bold text-white" style="font-size:0.95rem; line-height:1.3;">
                            Shri Shantappanna Miraji Urban Co-op. Bank Ltd., Chikodi
                        </span>
                    </div>
                    <p style="color:rgba(255,255,255,0.6); font-size:0.82rem; line-height:1.6; margin-left:1.85rem;" class="mb-3">
                        65 Years of Banking — Serving the community since 1961 with honest effort and abounding faith.
                    </p>
                    <!-- Footer Images -->
                    <div class="d-flex align-items-center gap-3" style="margin-left:1.85rem;">
                        <img src="<?php echo rtrim(SITE_URL,'/'); ?>/assets/images/footer/dic.png" alt="DIC" style="height:55px; width:auto; object-fit:contain;">
                        <img src="<?php echo rtrim(SITE_URL,'/'); ?>/assets/images/footer/qr.png" alt="QR Code" style="height:55px; width:auto; object-fit:contain;">
                    </div>
                </div>

                <!-- Divider for desktop -->
                <div class="col-md-1 d-none d-md-flex justify-content-center">
                    <div style="width:1px; background:rgba(255,255,255,0.12); height:100%;"></div>
                </div>

                <!-- Right: Contact Info -->
                <div class="col-md-6 col-sm-12">
                    <p class="text-uppercase fw-semibold mb-3" style="font-size:0.7rem; letter-spacing:0.1em; color:#c5a880;">Contact Information</p>
                    <div class="d-flex flex-column gap-2" style="font-size:0.82rem; color:rgba(255,255,255,0.75);">
                        <div class="d-flex align-items-start gap-2">
                            <i class="fas fa-map-marker-alt mt-1" style="color:#c5a880; min-width:14px;"></i>
                            <span>944-945, Guruwar Peth Chikodi, Belagavi Karnataka, 591201</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-phone" style="color:#c5a880; min-width:14px;"></i>
                            <span>
                                <a href="tel:+918338273169" class="text-decoration-none" style="color:inherit;">+91 83382 73169</a>
                                &nbsp;&nbsp;|&nbsp;&nbsp;
                                <a href="tel:+918494903886" class="text-decoration-none" style="color:inherit;">+91 84949 03886</a>
                            </span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-envelope" style="color:#c5a880; min-width:14px;"></i>
                            <a href="mailto:shantappanna@mirajibank.com" class="text-decoration-none" style="color:inherit;">shantappanna@mirajibank.com</a>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-globe" style="color:#c5a880; min-width:14px;"></i>
                            <a href="http://www.shantappannamirajibank.com" target="_blank" class="text-decoration-none" style="color:inherit;">www.shantappannamirajibank.com</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Bottom Bar -->
        <div style="background:rgba(0,0,0,0.25); border-top:1px solid rgba(255,255,255,0.08);">
            <div class="container-lg py-2 d-flex flex-wrap justify-content-between align-items-center gap-2" style="font-size:0.75rem; color:rgba(255,255,255,0.45);">
                <span>
                    &copy; <?php echo date('Y'); ?> Shri Shantappanna Miraji Urban Co-op. Bank Ltd. All rights reserved.
                    &nbsp;|&nbsp;
                    Designed by <a href="http://www.successsalescorp.com" target="_blank" class="text-decoration-none" style="color:rgba(255,255,255,0.65);">Success Sales Corporation</a>
                </span>
                <span class="d-flex gap-3">
                    <a href="<?php echo SITE_URL; ?>terms.php" class="text-decoration-none" style="color:rgba(255,255,255,0.45);">Disclaimer</a>
                    <a href="<?php echo SITE_URL; ?>privacy-policy.php" class="text-decoration-none" style="color:rgba(255,255,255,0.45);">Privacy Policy</a>
                </span>
            </div>
        </div>

    </footer>

    <!-- ── Floating Action Buttons ── -->
    <div style="position:fixed;bottom:2rem;right:1.5rem;z-index:1055;display:flex;flex-direction:column;gap:0.75rem;align-items:flex-end;">

        <!-- Contact Us -->
        <div class="d-flex align-items-center gap-2 floating-fab-wrap">
            <span class="floating-fab-label">Contact Us</span>
            <button class="floating-fab" style="background:#0f2c5e;" data-bs-toggle="modal" data-bs-target="#floatContactModal" title="Contact Us">
                <i class="fas fa-phone-alt"></i>
            </button>
        </div>

        <!-- Do Complaint -->
        <div class="d-flex align-items-center gap-2 floating-fab-wrap">
            <span class="floating-fab-label">Do Complaint</span>
            <button class="floating-fab" style="background:#b91c1c;" data-bs-toggle="modal" data-bs-target="#floatComplaintModal" title="Do Complaint">
                <i class="fas fa-exclamation-circle"></i>
            </button>
        </div>
    </div>

    <style>
    .floating-fab {
        width: 52px; height: 52px; border-radius: 50%; border: none;
        color: #fff; font-size: 1.2rem; cursor: pointer;
        box-shadow: 0 4px 14px rgba(0,0,0,0.35);
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .floating-fab:hover { transform: scale(1.1); box-shadow: 0 6px 20px rgba(0,0,0,0.4); }
    .floating-fab-label {
        background: rgba(15,44,94,0.92); color: #fff;
        font-size: 0.78rem; font-weight: 600; padding: 0.3rem 0.7rem;
        border-radius: 20px; white-space: nowrap;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        opacity: 0; transform: translateX(8px);
        transition: opacity 0.2s, transform 0.2s;
        pointer-events: none;
    }
    .floating-fab-wrap:hover .floating-fab-label { opacity: 1; transform: translateX(0); }
    </style>

    <!-- ── Contact Us Modal ── -->
    <div class="modal fade" id="floatContactModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white border-0" style="background:linear-gradient(135deg,#0f2c5e,#1e4d99);">
                    <h5 class="modal-title"><i class="fas fa-phone-alt me-2"></i>Contact Us</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="floatContactMsg"></div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="text-center p-3 rounded" style="background:#f0f4ff;">
                                <i class="fas fa-phone fa-lg mb-2" style="color:#0f2c5e;"></i>
                                <div class="fw-semibold small">Call Us</div>
                                <a href="tel:+918338273169" class="text-decoration-none small d-block" style="color:#0f2c5e;">+91 83382 73169</a>
                                <a href="tel:+918494903886" class="text-decoration-none small d-block" style="color:#0f2c5e;">+91 84949 03886</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-3 rounded" style="background:#f0f4ff;">
                                <i class="fas fa-envelope fa-lg mb-2" style="color:#0f2c5e;"></i>
                                <div class="fw-semibold small">Email Us</div>
                                <a href="mailto:shantappanna@mirajibank.com" class="text-decoration-none small" style="color:#0f2c5e;">shantappanna@mirajibank.com</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-3 rounded" style="background:#f0f4ff;">
                                <i class="fas fa-map-marker-alt fa-lg mb-2" style="color:#0f2c5e;"></i>
                                <div class="fw-semibold small">Visit Us</div>
                                <span class="small" style="color:#555;">944-945, Guruwar Peth, Chikodi, Belagavi 591201</span>
                            </div>
                        </div>
                    </div>
                    <hr class="my-3">
                    <p class="text-muted small mb-3">Or send us a message and we'll get back to you:</p>
                    <form id="floatContactForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" placeholder="Your Name *" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" placeholder="Email Address *" required>
                            </div>
                            <div class="col-md-6">
                                <input type="tel" class="form-control" name="phone" placeholder="Phone Number *" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="subject" placeholder="Subject *" required>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" name="message" rows="3" placeholder="Your message *" required></textarea>
                            </div>
                        </div>
                        <div class="mt-3 text-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn text-white" style="background:#0f2c5e;">
                                <i class="fas fa-paper-plane me-1"></i>Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Do Complaint Modal ── -->
    <div class="modal fade" id="floatComplaintModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white border-0" style="background:linear-gradient(135deg,#7f1d1d,#b91c1c);">
                    <h5 class="modal-title"><i class="fas fa-exclamation-circle me-2"></i>File a Complaint</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="floatComplaintMsg"></div>
                    <div class="alert alert-warning py-2 mb-3">
                        <i class="fas fa-info-circle me-2"></i>
                        <small>Your complaint will be recorded and reviewed by our team within <strong>3 working days</strong>.</small>
                    </div>
                    <form id="floatComplaintForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" placeholder="Your Name *" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" placeholder="Email Address *" required>
                            </div>
                            <div class="col-md-6">
                                <input type="tel" class="form-control" name="phone" placeholder="Phone / Mobile *" required>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select" name="subject" required>
                                    <option value="">-- Complaint Type --</option>
                                    <option>Account Related</option>
                                    <option>Loan Related</option>
                                    <option>Deposit / FD Related</option>
                                    <option>Staff Behaviour</option>
                                    <option>Service Quality</option>
                                    <option>Online / Digital Services</option>
                                    <option>Other</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control" name="account_no" placeholder="Account Number (if applicable)">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" name="message" rows="4" placeholder="Describe your complaint in detail *" required></textarea>
                            </div>
                        </div>
                        <div class="mt-3 text-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn text-white" style="background:#b91c1c;">
                                <i class="fas fa-paper-plane me-1"></i>Submit Complaint
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    (function() {
        const ENDPOINT = '<?php echo rtrim(SITE_URL,"/"); ?>/includes/submit-form.php';

        // ── Generic submit handler ──
        function handleSubmit(formId, msgId, successText, beforeSend) {
            const form   = document.getElementById(formId);
            const msgDiv = document.getElementById(msgId);
            if (!form) return;

            // store original button label once
            const btn = form.querySelector('[type=submit]');
            const origLabel = btn.innerHTML;

            // clear red borders on user input
            form.querySelectorAll('input,select,textarea').forEach(el => {
                el.addEventListener('input',  () => el.classList.remove('is-invalid'));
                el.addEventListener('change', () => el.classList.remove('is-invalid'));
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                msgDiv.innerHTML = '';

                // validate required fields
                const required = Array.from(form.querySelectorAll('[required]'));
                let invalid = false;
                required.forEach(el => {
                    el.classList.remove('is-invalid');
                    if (!el.value.trim()) { el.classList.add('is-invalid'); invalid = true; }
                });
                if (invalid) {
                    msgDiv.innerHTML = '<div class="alert alert-danger py-2 mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Please fill in all highlighted fields.</div>';
                    return;
                }

                // build FormData fresh
                const fd = new FormData(form);

                // let caller modify fd before send
                if (typeof beforeSend === 'function') beforeSend(fd, form);

                btn.disabled = true;
                btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Sending…';

                fetch(ENDPOINT, { method: 'POST', body: fd })
                    .then(function(r) {
                        if (!r.ok) throw new Error('HTTP ' + r.status);
                        return r.json();
                    })
                    .then(function(data) {
                        btn.disabled = false;
                        btn.innerHTML = origLabel;
                        if (data.success) {
                            form.reset();
                            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                            // Show success briefly, then close modal
                            msgDiv.innerHTML = '<div class="alert alert-success mb-0"><i class="fas fa-check-circle me-2"></i>' + successText + '</div>';
                            var modalEl = form.closest('.modal');
                            setTimeout(function() {
                                bootstrap.Modal.getInstance(modalEl).hide();
                            }, 1800);
                        } else {
                            msgDiv.innerHTML = '<div class="alert alert-danger mb-0"><i class="fas fa-times-circle me-2"></i>' + (data.message || 'Something went wrong.') + '</div>';
                        }
                    })
                    .catch(function() {
                        btn.disabled = false;
                        btn.innerHTML = origLabel;
                        msgDiv.innerHTML = '<div class="alert alert-danger mb-0">Connection error. Please call +91 83382 73169.</div>';
                    });
            });
        }

        // ── Reset modal state on close ──
        ['floatContactModal','floatComplaintModal'].forEach(function(id) {
            const el = document.getElementById(id);
            if (!el) return;
            el.addEventListener('hidden.bs.modal', function() {
                el.querySelectorAll('.is-invalid').forEach(f => f.classList.remove('is-invalid'));
                el.querySelectorAll('#floatContactMsg, #floatComplaintMsg').forEach(d => d.innerHTML = '');
                el.querySelector('form').reset();
            });
        });

        // ── Contact Us ──
        handleSubmit(
            'floatContactForm',
            'floatContactMsg',
            'Message sent! We will get back to you soon.',
            null   // no extra processing needed
        );

        // ── Complaint ──
        handleSubmit(
            'floatComplaintForm',
            'floatComplaintMsg',
            'Complaint submitted! We will review it within 3 working days.',
            function(fd, form) {
                // prefix subject with [Complaint]
                fd.set('subject', '[Complaint] ' + fd.get('subject'));
                // append account number to message if given
                var acno = (form.querySelector('[name=account_no]').value || '').trim();
                if (acno) fd.set('message', 'Account No: ' + acno + '\n\n' + fd.get('message'));
            }
        );
    })();
    </script>

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo rtrim(SITE_URL,'/'); ?>/assets/js/main.js"></script>
</body>
</html>
