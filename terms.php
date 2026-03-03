<?php
/**
 * Terms & Conditions Page
 */

require_once 'config.php';
require_once 'includes/helpers.php';

$page_title = 'Terms & Conditions - ' . SITE_NAME;

?>
<?php include 'includes/header.php'; ?>

<!-- Page Header -->
<section style="background: linear-gradient(135deg, #1e3a8a 0%, #2d5a8c 100%); color: white; padding: 60px 0;">
    <div class="container">
        <h1 class="mb-2">Terms & Conditions</h1>
    </div>
</section>

<!-- Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <p class="lead">Last Updated: March 4, 2026</p>

                <h4 class="mt-4 mb-3">1. Acceptance of Terms</h4>
                <p>By accessing and using this website, you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.</p>

                <h4 class="mt-4 mb-3">2. Use License</h4>
                <p>Permission is granted to temporarily download one copy of the materials (information or software) on <?php echo SITE_NAME; ?>'s website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:</p>
                <ul>
                    <li>Modify or copy the materials</li>
                    <li>Use the materials for any commercial purpose or for any public display</li>
                    <li>Attempt to decompile or reverse engineer any software contained on the website</li>
                    <li>Attempt to gain unauthorized access to restricted portions of the website</li>
                </ul>

                <h4 class="mt-4 mb-3">3. Disclaimer</h4>
                <p>The materials on <?php echo SITE_NAME; ?>'s website are provided on an 'as is' basis. <?php echo SITE_NAME; ?> makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.</p>

                <h4 class="mt-4 mb-3">4. Limitations</h4>
                <p>In no event shall <?php echo SITE_NAME; ?> or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on <?php echo SITE_NAME; ?>'s website.</p>

                <h4 class="mt-4 mb-3">5. Accuracy of Materials</h4>
                <p>The materials appearing on <?php echo SITE_NAME; ?>'s website could include technical, typographical, or photographic errors. <?php echo SITE_NAME; ?> does not warrant that any of the materials on its website are accurate, complete, or current. <?php echo SITE_NAME; ?> may make changes to the materials contained on its website at any time without notice.</p>

                <h4 class="mt-4 mb-3">6. Links</h4>
                <p><?php echo SITE_NAME; ?> has not reviewed all of the sites linked to its website and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by <?php echo SITE_NAME; ?> of the site. Use of any such linked website is at the user's own risk.</p>

                <h4 class="mt-4 mb-3">7. Modifications</h4>
                <p><?php echo SITE_NAME; ?> may revise these terms of service for its website at any time without notice. By using this website, you are agreeing to be bound by the then current version of these terms of service.</p>

                <h4 class="mt-4 mb-3">8. Governing Law</h4>
                <p>These terms and conditions are governed by and construed in accordance with the laws of India, and you irrevocably submit to the exclusive jurisdiction of the courts in that location.</p>

                <h4 class="mt-4 mb-3">9. Contact</h4>
                <p>If you have any questions about these Terms & Conditions, please contact us at:</p>
                <p>
                    Email: <a href="mailto:<?php echo ADMIN_EMAIL; ?>"><?php echo ADMIN_EMAIL; ?></a><br>
                    Phone: <a href="tel:<?php echo SITE_PHONE; ?>"><?php echo SITE_PHONE; ?></a>
                </p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
