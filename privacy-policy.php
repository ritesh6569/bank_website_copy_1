<?php
/**
 * Privacy Policy Page
 */

require_once 'config.php';
require_once 'includes/helpers.php';

$page_title = 'Privacy Policy - ' . SITE_NAME;

?>
<?php include 'includes/header.php'; ?>

<!-- Page Header -->
<section style="background: linear-gradient(135deg, #1e3a8a 0%, #2d5a8c 100%); color: white; padding: 60px 0;">
    <div class="container">
        <h1 class="mb-2">Privacy Policy</h1>
    </div>
</section>

<!-- Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <p class="lead">Last Updated: March 4, 2026</p>

                <h4 class="mt-4 mb-3">1. Introduction</h4>
                <p><?php echo SITE_NAME; ?> ("we," "us," "our," or the "Bank") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our website.</p>

                <h4 class="mt-4 mb-3">2. Information We Collect</h4>
                <p>We may collect information about you in a variety of ways:</p>
                <ul>
                    <li><strong>Personal Data:</strong> Name, email address, phone number, postal address</li>
                    <li><strong>Financial Information:</strong> Bank account details, transaction history</li>
                    <li><strong>Technical Data:</strong> IP address, browser type, pages visited, time and date</li>
                </ul>

                <h4 class="mt-4 mb-3">3. How We Use Your Information</h4>
                <p>We use the information we collect to:</p>
                <ul>
                    <li>Process your transactions and send related information</li>
                    <li>Provide customer service and respond to your inquiries</li>
                    <li>Send promotional communications (with your consent)</li>
                    <li>Comply with legal and regulatory requirements</li>
                </ul>

                <h4 class="mt-4 mb-3">4. Data Security</h4>
                <p>We implement appropriate technical and organizational measures to protect your personal data against unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the Internet is 100% secure.</p>

                <h4 class="mt-4 mb-3">5. Third-Party Disclosure</h4>
                <p>We do not sell, trade, or rent your personal information to third parties. We may share information with:</p>
                <ul>
                    <li>Service providers who assist us in operating the website</li>
                    <li>Government agencies as required by law</li>
                </ul>

                <h4 class="mt-4 mb-3">6. Your Rights</h4>
                <p>You have the right to:</p>
                <ul>
                    <li>Access your personal data</li>
                    <li>Correct inaccurate data</li>
                    <li>Request deletion of your data</li>
                    <li>Opt-out of marketing communications</li>
                </ul>

                <h4 class="mt-4 mb-3">7. Contact Us</h4>
                <p>If you have questions about this Privacy Policy, please contact us at:</p>
                <p>
                    Email: <a href="mailto:<?php echo ADMIN_EMAIL; ?>"><?php echo ADMIN_EMAIL; ?></a><br>
                    Phone: <a href="tel:<?php echo SITE_PHONE; ?>"><?php echo SITE_PHONE; ?></a>
                </p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
