<?php
/**
 * Asset Index
 * Lists all project files and their purposes
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Bank - Project Files Index</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: #333;
            padding: 30px 0;
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
        }
        h1 {
            color: #1e3a8a;
            margin-bottom: 30px;
            text-align: center;
        }
        .file-group {
            margin-bottom: 30px;
        }
        .file-group h3 {
            color: #3b82f6;
            border-bottom: 2px solid #f59e0b;
            padding-bottom: 10px;
            margin-top: 20px;
        }
        .file-item {
            padding: 15px;
            background: #f3f4f6;
            margin: 10px 0;
            border-left: 4px solid #3b82f6;
            border-radius: 5px;
        }
        .file-name {
            font-weight: bold;
            color: #1e3a8a;
            font-family: monospace;
        }
        .file-desc {
            color: #666;
            margin-top: 5px;
        }
        .start-btn {
            text-align: center;
            margin-top: 40px;
        }
        .badge-custom {
            background: #10b981;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container-lg" style="max-width: 900px;">
        <h1>📋 Professional Bank Website - Project Files</h1>
        
        <div class="alert alert-info">
            <strong>✅ Project Status:</strong> Complete and ready for use!
        </div>

        <!-- Main Files -->
        <div class="file-group">
            <h3>🏠 Main Files</h3>
            
            <div class="file-item">
                <div class="file-name">index.php</div>
                <div class="file-desc">Home page with hero section, offers, products, news, and contact summary</div>
                <div class="mt-2"><a href="/bank-website-grok/index.php" class="btn btn-sm btn-primary">View Page</a></div>
            </div>
            
            <div class="file-item">
                <div class="file-name">config.php</div>
                <div class="file-desc">Configuration file with site constants and helper functions</div>
            </div>
            
            <div class="file-item">
                <div class="file-name">api.php</div>
                <div class="file-desc">API endpoints for AJAX requests and backend integration</div>
            </div>
        </div>

        <!-- Page Files -->
        <div class="file-group">
            <h3>📄 Page Files (pages/ directory)</h3>
            
            <div class="file-item">
                <div class="file-name">about.php</div>
                <div class="file-desc">About Us page with leadership profiles, board of directors, and company history</div>
                <div class="mt-2"><a href="/bank-website-grok/pages/about.php" class="btn btn-sm btn-primary">View Page</a></div>
            </div>
            
            <div class="file-item">
                <div class="file-name">deposits.php</div>
                <div class="file-desc">Deposits products page with Savings, Current, FD, and RD with calculators</div>
                <div class="mt-2"><a href="/bank-website-grok/pages/deposits.php" class="btn btn-sm btn-primary">View Page</a></div>
            </div>
            
            <div class="file-item">
                <div class="file-name">loans.php</div>
                <div class="file-desc">Loans products page with Personal, Home, Vehicle, and Business loans with EMI calculator</div>
                <div class="mt-2"><a href="/bank-website-grok/pages/loans.php" class="btn btn-sm btn-primary">View Page</a></div>
            </div>
            
            <div class="file-item">
                <div class="file-name">services.php</div>
                <div class="file-desc">Banking services page with Internet Banking, Mobile, SMS, RTGS/NEFT, and Locker facility</div>
                <div class="mt-2"><a href="/bank-website-grok/pages/services.php" class="btn btn-sm btn-primary">View Page</a></div>
            </div>
            
            <div class="file-item">
                <div class="file-name">media.php</div>
                <div class="file-desc">Media center with interest rates, service charges, notices, downloads, and gallery</div>
                <div class="mt-2"><a href="/bank-website-grok/pages/media.php" class="btn btn-sm btn-primary">View Page</a></div>
            </div>
            
            <div class="file-item">
                <div class="file-name">contact.php</div>
                <div class="file-desc">Contact Us page with forms, branch listing, and feedback modal</div>
                <div class="mt-2"><a href="/bank-website-grok/pages/contact.php" class="btn btn-sm btn-primary">View Page</a></div>
            </div>
        </div>

        <!-- Include Files -->
        <div class="file-group">
            <h3>🔗 Include Files (includes/ directory)</h3>
            
            <div class="file-item">
                <div class="file-name">header.php</div>
                <div class="file-desc">Navigation bar, meta tags, and page header component (included in all pages)</div>
            </div>
            
            <div class="file-item">
                <div class="file-name">footer.php</div>
                <div class="file-desc">Footer with links, contact info, and social media (included in all pages)</div>
            </div>
            
            <div class="file-item">
                <div class="file-name">data-fetcher.php</div>
                <div class="file-desc">Data management class with interest rates, charges, branches, news, and more</div>
            </div>
        </div>

        <!-- Asset Files -->
        <div class="file-group">
            <h3>🎨 Asset Files</h3>
            
            <div class="file-item">
                <div class="file-name">assets/css/style.css</div>
                <div class="file-desc">Main stylesheet (600+ lines) with responsive design, animations, and modern CSS</div>
            </div>
            
            <div class="file-item">
                <div class="file-name">assets/js/main.js</div>
                <div class="file-desc">Main JavaScript file (400+ lines) with calculators, form validation, and interactivity</div>
            </div>
            
            <div class="file-item">
                <div class="file-name">assets/images/</div>
                <div class="file-desc">Image directory for bank photos, logos, and assets</div>
            </div>
        </div>

        <!-- Documentation Files -->
        <div class="file-group">
            <h3>📚 Documentation Files</h3>
            
            <div class="file-item">
                <div class="file-name">README.md</div>
                <div class="file-desc">Comprehensive documentation with installation, features, and customization guide</div>
            </div>
            
            <div class="file-item">
                <div class="file-name">QUICKSTART.md</div>
                <div class="file-desc">Quick start guide with setup steps and common tasks</div>
            </div>
            
            <div class="file-item">
                <div class="file-name">PROJECT_SUMMARY.md</div>
                <div class="file-desc">Complete project summary with file structure and implementation details</div>
            </div>
        </div>

        <!-- Configuration Files -->
        <div class="file-group">
            <h3>⚙️ Configuration Files</h3>
            
            <div class="file-item">
                <div class="file-name">.htaccess</div>
                <div class="file-desc">Apache server configuration with compression, caching, and security headers</div>
            </div>
            
            <div class="file-item">
                <div class="file-name">.env.example</div>
                <div class="file-desc">Environment variables template for configuration</div>
            </div>
        </div>

        <!-- Features Summary -->
        <div class="file-group">
            <h3>✨ Key Features</h3>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-success">
                        <strong>✅ 7 Complete Pages</strong>
                        <ul class="mb-0 mt-2">
                            <li>Home with hero section</li>
                            <li>About Us with leadership</li>
                            <li>Deposits with calculators</li>
                            <li>Loans with EMI calculator</li>
                            <li>Services overview</li>
                            <li>Media center</li>
                            <li>Contact Us with forms</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="alert alert-success">
                        <strong>✅ Interactive Features</strong>
                        <ul class="mb-0 mt-2">
                            <li>EMI Calculator</li>
                            <li>FD Maturity Calculator</li>
                            <li>RD Maturity Calculator</li>
                            <li>Tenure Slider</li>
                            <li>Form Validation</li>
                            <li>Modals & Accordions</li>
                            <li>Smooth Animations</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="file-group">
            <h3>📊 Project Statistics</h3>
            
            <div class="row text-center">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="color: #3b82f6;">6,500+</h4>
                            <p>Lines of Code</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="color: #3b82f6;">7</h4>
                            <p>Complete Pages</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="color: #3b82f6;">10+</h4>
                            <p>Interactive Forms</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="color: #3b82f6;">50+</h4>
                            <p>Data Sections</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="file-group">
            <h3>🔗 Quick Navigation</h3>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 10px;">
                <a href="/bank-website-grok/index.php" class="btn btn-outline-primary">🏠 Home</a>
                <a href="/bank-website-grok/pages/about.php" class="btn btn-outline-primary">ℹ️ About</a>
                <a href="/bank-website-grok/pages/deposits.php" class="btn btn-outline-primary">💰 Deposits</a>
                <a href="/bank-website-grok/pages/loans.php" class="btn btn-outline-primary">💳 Loans</a>
                <a href="/bank-website-grok/pages/services.php" class="btn btn-outline-primary">🛠️ Services</a>
                <a href="/bank-website-grok/pages/media.php" class="btn btn-outline-primary">📰 Media</a>
                <a href="/bank-website-grok/pages/contact.php" class="btn btn-outline-primary">📞 Contact</a>
            </div>
        </div>

        <!-- Getting Started -->
        <div class="start-btn">
            <div class="alert alert-warning">
                <strong>🚀 Ready to Get Started?</strong>
                <p>Make sure Apache is running in XAMPP, then visit the pages above!</p>
            </div>
            <a href="/bank-website-grok/index.php" class="btn btn-primary btn-lg">
                <i class="fas fa-rocket"></i> Go to Home Page
            </a>
        </div>

        <!-- Footer Info -->
        <div style="text-align: center; margin-top: 40px; color: #666; border-top: 1px solid #ddd; padding-top: 20px;">
            <p><strong>Professional Bank Website v1.0</strong></p>
            <p>Complete PHP banking website built with Bootstrap 5 and vanilla JavaScript</p>
            <p><small>For support, check README.md or QUICKSTART.md</small></p>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
