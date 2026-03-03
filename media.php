<?php
/**
 * Media Center Page
 * News, Interest Rates, Service Charges, Downloads, and Gallery
 */

require_once 'config.php';
require_once 'includes/helpers.php';
require_once 'includes/db.php';

$page_title = 'Media Center - ' . SITE_NAME;
$meta_description = 'News, interest rates, service charges, and resources from ' . SITE_NAME;

$tab = $_GET['tab'] ?? 'notices';

// Get notices
$notices = [];
$downloads = [];
$gallery_items = [];

try {
    $notices = fetchAll("SELECT * FROM notices WHERE status = 'active' ORDER BY date_published DESC");
    $downloads = fetchAll("SELECT * FROM downloads WHERE status = 'active' ORDER BY created_at DESC");
    $gallery_items = fetchAll("SELECT * FROM gallery WHERE status = 'active' ORDER BY display_order ASC, created_at DESC");
} catch (Exception $e) {
    // Database might not be set up yet
}
?>
<?php include 'includes/header.php'; ?>

<!-- Page Header -->
<section style="background: linear-gradient(135deg, #1e3a8a 0%, #2d5a8c 100%); color: white; padding: 60px 0;">
    <div class="container">
        <h1 class="mb-2">Media Center</h1>
        <p style="color: rgba(255, 255, 255, 0.9);">News, updates, resources, and gallery</p>
    </div>
</section>

<!-- Content Tabs -->
<section class="py-5">
    <div class="container">
        <!-- Tab Navigation -->
        <ul class="nav nav-tabs mb-4 border-bottom" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link <?php echo ($tab === 'notices') ? 'active' : ''; ?>" id="notices-tab" data-bs-toggle="tab" data-bs-target="#notices" type="button" role="tab">
                    <i class="fas fa-bullhorn me-2"></i>Notices & News
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?php echo ($tab === 'rates') ? 'active' : ''; ?>" id="rates-tab" data-bs-toggle="tab" data-bs-target="#rates" type="button" role="tab">
                    <i class="fas fa-chart-line me-2"></i>Interest Rates
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?php echo ($tab === 'charges') ? 'active' : ''; ?>" id="charges-tab" data-bs-toggle="tab" data-bs-target="#charges" type="button" role="tab">
                    <i class="fas fa-receipt me-2"></i>Service Charges
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?php echo ($tab === 'downloads') ? 'active' : ''; ?>" id="downloads-tab" data-bs-toggle="tab" data-bs-target="#downloads" type="button" role="tab">
                    <i class="fas fa-download me-2"></i>Downloads
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?php echo ($tab === 'gallery') ? 'active' : ''; ?>" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery" type="button" role="tab">
                    <i class="fas fa-images me-2"></i>Gallery
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Notices Tab -->
            <div class="tab-pane fade <?php echo ($tab === 'notices') ? 'show active' : ''; ?>" id="notices" role="tabpanel">
                <div id="notices">
                    <?php if (!empty($notices)): ?>
                        <div class="row">
                            <?php foreach ($notices as $notice): ?>
                                <div class="col-md-6 mb-4 animate-on-scroll">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="mb-2">
                                                <span class="badge bg-primary"><i class="fas fa-calendar me-1"></i><?php echo formatDate($notice['date_published'], 'M d, Y'); ?></span>
                                            </div>
                                            <h5 class="card-title"><?php echo escape($notice['title']); ?></h5>
                                            <div class="card-text" style="color: #666;">
                                                <?php echo substr(strip_tags($notice['content']), 0, 200); ?>...
                                            </div>
                                            <button class="btn btn-sm btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#notice-<?php echo $notice['id']; ?>">
                                                Read Full Notice
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="notice-<?php echo $notice['id']; ?>" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"><?php echo escape($notice['title']); ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="text-muted mb-3">
                                                                <i class="fas fa-calendar me-2"></i><?php echo formatDate($notice['date_published']); ?>
                                                            </p>
                                                            <?php echo $notice['content']; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>No notices available at the moment.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Interest Rates Tab -->
            <div class="tab-pane fade <?php echo ($tab === 'rates') ? 'show active' : ''; ?>" id="rates" role="tabpanel">
                <div class="row mb-4">
                    <div class="col-lg-6 mb-4">
                        <h5 class="mb-3">Deposit Interest Rates</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Interest Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Savings Account</td>
                                        <td><strong>4.5% - 5.0% p.a.</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Current Account</td>
                                        <td><strong>NIL</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Fixed Deposit (6 months)</td>
                                        <td><strong>6.0% - 6.5% p.a.</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Fixed Deposit (1 year)</td>
                                        <td><strong>6.5% - 7.0% p.a.</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Recurring Deposit</td>
                                        <td><strong>5.5% - 6.0% p.a.</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <h5 class="mb-3">Loan Interest Rates</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Interest Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Personal Loan</td>
                                        <td><strong>9.0% - 12.0% p.a.</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Home Loan</td>
                                        <td><strong>6.5% - 8.0% p.a.</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Vehicle Loan</td>
                                        <td><strong>7.5% - 10.0% p.a.</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Business Loan</td>
                                        <td><strong>8.0% - 12.0% p.a.</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Education Loan</td>
                                        <td><strong>7.0% - 9.0% p.a.</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i><strong>Note:</strong> Rates are subject to change. Please contact your nearest branch for latest rates and offers.
                </div>
            </div>

            <!-- Service Charges Tab -->
            <div class="tab-pane fade <?php echo ($tab === 'charges') ? 'show active' : ''; ?>" id="charges" role="tabpanel">
                <div class="accordion" id="chargesAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#charges1">
                                Account Maintenance Charges
                            </button>
                        </h2>
                        <div id="charges1" class="accordion-collapse collapse show" data-bs-parent="#chargesAccordion">
                            <div class="accordion-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Minimum Balance Penalty</td>
                                            <td><strong>₹100 - ₹500</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Annual Account Maintenance Fee</td>
                                            <td><strong>NIL for savings account</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Dormant Account Reactivation</td>
                                            <td><strong>₹250</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#charges2">
                                Transaction Charges
                            </button>
                        </h2>
                        <div id="charges2" class="accordion-collapse collapse" data-bs-parent="#chargesAccordion">
                            <div class="accordion-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>NEFT Transfer</td>
                                            <td><strong>₹2.50 - ₹5</strong></td>
                                        </tr>
                                        <tr>
                                            <td>RTGS Transfer</td>
                                            <td><strong>₹10 - ₹50</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Cheque Bounce Charge</td>
                                            <td><strong>₹200 - ₹500</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#charges3">
                                Locker & Safe Deposit Charges
                            </button>
                        </h2>
                        <div id="charges3" class="accordion-collapse collapse" data-bs-parent="#chargesAccordion">
                            <div class="accordion-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Small Locker (Annual)</td>
                                            <td><strong>₹500 - ₹750</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Medium Locker (Annual)</td>
                                            <td><strong>₹750 - ₹1000</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Large Locker (Annual)</td>
                                            <td><strong>₹1000 - ₹1500</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Downloads Tab -->
            <div class="tab-pane fade <?php echo ($tab === 'downloads') ? 'show active' : ''; ?>" id="downloads" role="tabpanel">
                <?php if (!empty($downloads)): ?>
                    <div class="row">
                        <?php foreach ($downloads as $download): ?>
                            <div class="col-md-6 mb-3 animate-on-scroll">
                                <div class="card" style="border-left: 4px solid #3b82f6;">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="card-title mb-2">
                                                    <i class="fas fa-file-pdf" style="color: #ef4444; margin-right: 0.5rem;"></i>
                                                    <?php echo escape($download['title']); ?>
                                                </h6>
                                                <p class="card-text text-muted mb-2" style="font-size: 0.9rem;">
                                                    <?php echo escape($download['description'] ?? ''); ?>
                                                </p>
                                                <small class="text-muted">
                                                    <i class="fas fa-tag me-1"></i><?php echo escape($download['category'] ?? 'General'); ?>
                                                </small>
                                            </div>
                                            <a href="<?php echo SITE_URL . '/' . $download['file_path']; ?>" class="btn btn-sm btn-primary" download>
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>No downloads available at the moment.
                    </div>
                <?php endif; ?>
            </div>

            <!-- Gallery Tab -->
            <div class="tab-pane fade <?php echo ($tab === 'gallery') ? 'show active' : ''; ?>" id="gallery" role="tabpanel">
                <?php if (!empty($gallery_items)): ?>
                    <div class="row" style="gap: 1.5rem;">
                        <?php foreach ($gallery_items as $item): ?>
                            <div class="col-md-3 mb-3 animate-on-scroll">
                                <a href="<?php echo SITE_URL . '/' . $item['image_path']; ?>" data-fancybox="gallery" data-caption="<?php echo escape($item['title']); ?>">
                                    <div class="gallery-item">
                                        <img src="<?php echo SITE_URL . '/' . $item['image_path']; ?>" alt="<?php echo escape($item['alt_text']); ?>" style="width: 100%; height: 250px; object-fit: cover; border-radius: 0.5rem;">
                                        <div class="gallery-overlay">
                                            <div style="text-align: center; color: white;">
                                                <i class="fas fa-search-plus" style="font-size: 2rem; margin-bottom: 0.5rem; display: block;"></i>
                                                <small><?php echo escape($item['title']); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>No gallery items available at the moment.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
