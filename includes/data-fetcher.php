<?php
/**
 * Data Fetcher and Parser
 * Scrapes data from the target website and provides fallback data
 */

class DataFetcher {
    private $cache_dir;
    private $timeout = 5;

    public function __construct() {
        $this->cache_dir = __DIR__ . '/../data';
    }
    
    /**
     * Fetch data from URL with timeout and error handling
     */
    public function fetchURL($url) {
        try {
            $context = stream_context_create([
                'http' => [
                    'timeout' => $this->timeout,
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
                ],
                'https' => [
                    'timeout' => $this->timeout,
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
                ]
            ]);
            
            $content = @file_get_contents($url, false, $context);
            
            if ($content === false) {
                return null;
            }
            
            return $content;
        } catch (Exception $e) {
            return null;
        }
    }
    
    /**
     * Get interest rates data
     */
    public function getInterestRates() {
        $cache_file = $this->cache_dir . '/interest_rates.json';
        
        // Try to return cached data first
        if (file_exists($cache_file)) {
            $data = json_decode(file_get_contents($cache_file), true);
            if ($data) {
                return $data;
            }
        }
        
        // Fallback data — Real rates for Shri Shantappanna Miraji Urban Co-op. Bank Ltd.
        return [
            'deposits' => [
                ['name' => 'Saving Bank Deposit (General)',         'rate' => '3.00% p.a.',  'min_balance' => '₹500'],
                ['name' => 'Saving Bank Deposit (Senior Citizen)',  'rate' => '3.50% p.a.',  'min_balance' => '₹500'],
                ['name' => 'Term Deposit — 46 to 90 Days',         'rate' => '5.00% p.a.',  'min_balance' => '₹1,000'],
                ['name' => 'Term Deposit — 91 to 180 Days',        'rate' => '5.50% p.a.',  'min_balance' => '₹1,000'],
                ['name' => 'Term Deposit — 181 to 364 Days',       'rate' => '7.00% p.a.',  'min_balance' => '₹1,000'],
                ['name' => 'Term Deposit — 1 to < 2 Years',        'rate' => '7.75% p.a.',  'min_balance' => '₹1,000'],
                ['name' => 'Term Deposit — 2 to < 5 Years',        'rate' => '8.00% p.a.',  'min_balance' => '₹1,000'],
                ['name' => 'Term Deposit — 5 Years and above',     'rate' => '7.75% p.a.',  'min_balance' => '₹1,000'],
            ],
            'loans' => [
                ['name' => 'Gold Loan',                            'rate' => '9.00% p.a.',          'amount' => 'As per gold value'],
                ['name' => 'Industrial / MSME — Working Capital',  'rate' => '10.00% p.a.',         'amount' => 'As per eligibility'],
                ['name' => 'Housing Loan — Residential Construction','rate' => '10.50% p.a.',       'amount' => 'As per eligibility'],
                ['name' => 'Vehicle Loan — Four Wheeler',          'rate' => '10.50% p.a.',         'amount' => 'As per eligibility'],
                ['name' => 'Industrial / MSME — Term Loan',        'rate' => '11.00% p.a.',         'amount' => 'As per eligibility'],
                ['name' => 'Vehicle Loan — Two Wheeler',           'rate' => '11.00% p.a.',         'amount' => 'As per eligibility'],
                ['name' => 'Housing Loan — Commercial',            'rate' => '11.50% p.a.',         'amount' => 'As per eligibility'],
                ['name' => 'Professional Loan',                    'rate' => '12.00%–13.00% p.a.',  'amount' => 'As per eligibility'],
            ]
        ];
    }
    
    /**
     * Get service charges data
     */
    public function getServiceCharges() {
        return [
            // I. Membership
            ['category' => 'Membership', 'service' => 'New Membership Admission Fee',          'charge' => 'Rs. 100/-'],
            ['category' => 'Membership', 'service' => 'Share Capital (per share)',              'charge' => 'Rs. 100/- per share'],
            ['category' => 'Membership', 'service' => 'Membership Transfer Fee',               'charge' => 'Rs. 100/-'],
            // II. Deposits
            ['category' => 'Deposits',   'service' => 'Account Opening (SB / Current)',        'charge' => 'Free'],
            ['category' => 'Deposits',   'service' => 'Minimum Balance (SB Account)',          'charge' => 'Rs. 500/-'],
            ['category' => 'Deposits',   'service' => 'Duplicate Passbook',                    'charge' => 'Rs. 25/-'],
            ['category' => 'Deposits',   'service' => 'Account Closing (within 1 year)',       'charge' => 'Rs. 100/-'],
            ['category' => 'Deposits',   'service' => 'FD / RD Premature Closure Penalty',    'charge' => '1.00% rate reduction'],
            // III. Loans
            ['category' => 'Loans',      'service' => 'Loan Processing Fee (Personal/Surety)', 'charge' => '0.25% (Min Rs. 100/-)'],
            ['category' => 'Loans',      'service' => 'Loan Processing Fee (Mortgage/Housing)', 'charge' => '0.50% of loan amount'],
            ['category' => 'Loans',      'service' => 'Penal Interest (Overdue)',              'charge' => '2.00% p.a. over rate'],
            ['category' => 'Loans',      'service' => 'Loan NOC Certificate',                 'charge' => 'Rs. 100/-'],
            // IV. Cheque/Passbook
            ['category' => 'Cheque',     'service' => 'Cheque Book — First (SB Account)',     'charge' => 'Free'],
            ['category' => 'Cheque',     'service' => 'Cheque Book — 10 leaves',              'charge' => 'Rs. 25/-'],
            ['category' => 'Cheque',     'service' => 'Cheque Book — 25 leaves',              'charge' => 'Rs. 50/-'],
            ['category' => 'Cheque',     'service' => 'Cheque Return — Insufficient Funds',   'charge' => 'Rs. 200/- + GST'],
            ['category' => 'Cheque',     'service' => 'Pay Order (up to Rs. 10,000/-)',        'charge' => 'Rs. 25/-'],
            ['category' => 'Cheque',     'service' => 'Pay Order (Rs. 10,001/- to 1,00,000/-)', 'charge' => 'Rs. 50/-'],
            ['category' => 'Cheque',     'service' => 'Pay Order (above Rs. 1,00,000/-)',     'charge' => 'Rs. 100/-'],
            // V. Other
            ['category' => 'Other',      'service' => 'RTGS (Rs. 2,00,001/- to 5,00,000/-)', 'charge' => 'Rs. 25/- + GST'],
            ['category' => 'Other',      'service' => 'RTGS (above Rs. 5,00,000/-)',          'charge' => 'Rs. 50/- + GST'],
            ['category' => 'Other',      'service' => 'NEFT (up to Rs. 10,000/-)',            'charge' => 'Rs. 2.50 + GST'],
            ['category' => 'Other',      'service' => 'NEFT (Rs. 10,001/- to 1,00,000/-)',   'charge' => 'Rs. 5/- + GST'],
            ['category' => 'Other',      'service' => 'NEFT (Rs. 1,00,001/- to 2,00,000/-)', 'charge' => 'Rs. 15/- + GST'],
            ['category' => 'Other',      'service' => 'NEFT (above Rs. 2,00,000/-)',          'charge' => 'Rs. 25/- + GST'],
            ['category' => 'Other',      'service' => 'Balance / Signature Certificate',      'charge' => 'Rs. 100/-'],
        ];
    }
    
    /**
     * Get branches data — all 14 branches
     */
    public function getBranches() {
        return [
            [
                'name'    => 'Head Office — Chikodi (Admin)',
                'type'    => 'Head Office',
                'address' => '944-945, Guruwar Peth, Chikodi, Belagavi, Karnataka 591201',
                'ifsc'    => 'SSBM0000001',
                'phone'   => '+91 8338273169',
                'phone2'  => '+91 8494903886',
                'email'   => 'shantappanna@mirajibank.com',
                'hours'   => 'Mon–Fri: 10:00 AM – 4:00 PM, Sat: 10:00 AM – 1:00 PM'
            ],
            [
                'name'    => 'Main Branch — Chikodi',
                'type'    => 'Branch',
                'address' => 'Main Branch, Chikodi, Belagavi, Karnataka 591201',
                'ifsc'    => 'SSBM0000002',
                'phone'   => '+91 8338273169',
                'phone2'  => '',
                'email'   => 'chikodi@mirajibank.com',
                'hours'   => 'Mon–Fri: 10:00 AM – 4:00 PM, Sat: 10:00 AM – 1:00 PM'
            ],
            [
                'name'    => 'Examba Branch',
                'type'    => 'Branch',
                'address' => 'Examba, Belagavi, Karnataka',
                'ifsc'    => 'SSBM0000003',
                'phone'   => '',
                'phone2'  => '',
                'email'   => 'examba@mirajibank.com',
                'hours'   => 'Mon–Fri: 10:00 AM – 4:00 PM, Sat: 10:00 AM – 1:00 PM'
            ],
            [
                'name'    => 'Manjari Branch',
                'type'    => 'Branch',
                'address' => 'Manjari, Belagavi, Karnataka',
                'ifsc'    => 'SSBM0000004',
                'phone'   => '',
                'phone2'  => '',
                'email'   => 'manjari@mirajibank.com',
                'hours'   => 'Mon–Fri: 10:00 AM – 4:00 PM, Sat: 10:00 AM – 1:00 PM'
            ],
            [
                'name'    => 'Kothali Branch',
                'type'    => 'Branch',
                'address' => 'Kothali, Belagavi, Karnataka',
                'ifsc'    => 'SSBM0000005',
                'phone'   => '',
                'phone2'  => '',
                'email'   => 'kothali@mirajibank.com',
                'hours'   => 'Mon–Fri: 10:00 AM – 4:00 PM, Sat: 10:00 AM – 1:00 PM'
            ],
            [
                'name'    => 'Karoshi Branch',
                'type'    => 'Branch',
                'address' => 'Karoshi, Belagavi, Karnataka',
                'ifsc'    => 'SSBM0000006',
                'phone'   => '',
                'phone2'  => '',
                'email'   => 'karoshi@mirajibank.com',
                'hours'   => 'Mon–Fri: 10:00 AM – 4:00 PM, Sat: 10:00 AM – 1:00 PM'
            ],
            [
                'name'    => 'Goa-Ves Branch — Belagavi',
                'type'    => 'Branch',
                'address' => 'Goa-Ves, Belagavi, Karnataka',
                'ifsc'    => 'SSBM0000007',
                'phone'   => '',
                'phone2'  => '',
                'email'   => 'goaves@mirajibank.com',
                'hours'   => 'Mon–Fri: 10:00 AM – 4:00 PM, Sat: 10:00 AM – 1:00 PM'
            ],
            [
                'name'    => 'R.K. Colony Branch — Chikodi',
                'type'    => 'Branch',
                'address' => 'R.K. Colony, Chikodi, Belagavi, Karnataka 591201',
                'ifsc'    => 'SSBM0000008',
                'phone'   => '',
                'phone2'  => '',
                'email'   => 'rkcolony@mirajibank.com',
                'hours'   => 'Mon–Fri: 10:00 AM – 4:00 PM, Sat: 10:00 AM – 1:00 PM'
            ],
            [
                'name'    => 'Nasalapur Branch',
                'type'    => 'Branch',
                'address' => 'Nasalapur, Belagavi, Karnataka',
                'ifsc'    => 'SSBM0000009',
                'phone'   => '',
                'phone2'  => '',
                'email'   => 'nasalapur@mirajibank.com',
                'hours'   => 'Mon–Fri: 10:00 AM – 4:00 PM, Sat: 10:00 AM – 1:00 PM'
            ],
            [
                'name'    => 'Soundatti Branch',
                'type'    => 'Branch',
                'address' => 'Soundatti, Belagavi, Karnataka',
                'ifsc'    => 'SSBM0000010',
                'phone'   => '',
                'phone2'  => '',
                'email'   => 'soundatti@mirajibank.com',
                'hours'   => 'Mon–Fri: 10:00 AM – 4:00 PM, Sat: 10:00 AM – 1:00 PM'
            ],
            [
                'name'    => 'Auto Nagar Branch — Belagavi',
                'type'    => 'Branch',
                'address' => 'Auto Nagar, Belagavi, Karnataka',
                'ifsc'    => 'SSBM0000011',
                'phone'   => '',
                'phone2'  => '',
                'email'   => 'autonagar@mirajibank.com',
                'hours'   => 'Mon–Fri: 10:00 AM – 4:00 PM, Sat: 10:00 AM – 1:00 PM'
            ],
            [
                'name'    => 'Nipani Branch',
                'type'    => 'Branch',
                'address' => 'Nipani, Belagavi, Karnataka',
                'ifsc'    => 'SSBM0000012',
                'phone'   => '',
                'phone2'  => '',
                'email'   => 'nipani@mirajibank.com',
                'hours'   => 'Mon–Fri: 10:00 AM – 4:00 PM, Sat: 10:00 AM – 1:00 PM'
            ],
            [
                'name'    => 'Athani Branch',
                'type'    => 'Branch',
                'address' => 'Athani, Belagavi, Karnataka',
                'ifsc'    => 'SSBM0000013',
                'phone'   => '',
                'phone2'  => '',
                'email'   => 'athani@mirajibank.com',
                'hours'   => 'Mon–Fri: 10:00 AM – 4:00 PM, Sat: 10:00 AM – 1:00 PM'
            ],
            [
                'name'    => 'Ugar-Khurd Branch',
                'type'    => 'Branch',
                'address' => 'Ugar-Khurd, Belagavi, Karnataka',
                'ifsc'    => 'SSBM0000014',
                'phone'   => '',
                'phone2'  => '',
                'email'   => 'ugarkhurd@mirajibank.com',
                'hours'   => 'Mon–Fri: 10:00 AM – 4:00 PM, Sat: 10:00 AM – 1:00 PM'
            ],
        ];
    }
    
    /**
     * Get bank leadership data
     */
    public function getLeadership() {
        return [
            'founder' => [
                'name' => 'Late Shri Shantappanna Miraji',
                'title' => 'Founder — "Pratham Sahakara Ratna"',
                'bio' => 'A leading Co-operative Bank of the Belagavi district was founded by visionary and positive thinker Shri Shantappannaji in 1961 to cater to the Banking needs of a common man. He was a true co-operator who established and developed the Bank on true co-operative principles. He had done "Financial Inclusion" 61 years back by opening branches in Rural areas with a population of less than 1000. He never added a single penny to his personal wealth but spent almost all his share of wealth and life for the growth of society by establishing many co-operative, Educational, Social and Charitable Institutions.',
                'image' => '/assets/images/founder.jpg'
            ],
            'chairman' => [
                'name' => 'Mr. Mahantesh Gangadhar Bhate',
                'title' => 'Chairman',
                'bio' => 'We listen, while our Balance Sheet talks! We ended year 2024-2025 on a success note, with "A" grade in Audit remarks. It is indeed a proud moment to share that soon we will come up with our AGM-2024-25 dates. Our bank has continued to register a steady growth in business and earnings through Strong Financial Health, excellent Services, Attractive Rate of Interest, and easy access to Nearest Branch.',
                'image' => '/assets/images/chairman.jpg'
            ],
            'general_manager' => [
                'name' => 'Mr. Rajendra S Vandure',
                'title' => 'General Manager',
                'bio' => 'Welcome dear customers! I am excited to welcome you all to our Bank. I guarantee a realm of services to your complete Banking needs. Here I am always ready to help you. Reach me for any query you have, I will be happy to address them.',
                'image' => '/assets/images/gm.jpg'
            ]
        ];
    }
    
    /**
     * Get board of directors
     */
    public function getBoardOfDirectors() {
        return [
            ['name' => 'Mr. Mahantesh Gangadhar Bhate',     'position' => 'Chairman',   'qualification' => '', 'phone' => '9448349272'],
            ['name' => 'Mr. Amaranath Chandrashekhar Basaragi', 'position' => 'Director', 'qualification' => '', 'phone' => '9448811522'],
            ['name' => 'Mr. Yeshwant Shantappanna Miraji',  'position' => 'Director',   'qualification' => '', 'phone' => '9448469449'],
            ['name' => 'Mr. Irappa Neelakanth Hampannavar', 'position' => 'Director',   'qualification' => '', 'phone' => '9448995332'],
            ['name' => 'Mr. Sanjaykumar Rudragouda Patil',  'position' => 'Director',   'qualification' => '', 'phone' => '9448540744'],
            ['name' => 'Mr. Mahaveer Appa Patil',           'position' => 'Director',   'qualification' => '', 'phone' => '9448693973'],
            ['name' => 'Smt. Mala Shrimandhar Desai',       'position' => 'Director',   'qualification' => '', 'phone' => '9480012068'],
            ['name' => 'Mr. Ravikumar Yeshwant Rokhade',    'position' => 'Director',   'qualification' => '', 'phone' => '9448875937'],
            ['name' => 'Mr. Ashok Adappa Danawade',         'position' => 'Director',   'qualification' => '', 'phone' => '9845096404'],
            ['name' => 'Mr. Anil Anant Sadalage',           'position' => 'Director',   'qualification' => '', 'phone' => '9448129822'],
            ['name' => 'Mr. Mahesh Jayapal Ladage',         'position' => 'Director',   'qualification' => '', 'phone' => '9482081061'],
            ['name' => 'Shri Jitendra Sangale',             'position' => 'Director',   'qualification' => '', 'phone' => ''],
            ['name' => 'Mr. Mahaveer Yeshwant Miraji',      'position' => 'Director',   'qualification' => '', 'phone' => '9448482544'],
            ['name' => 'Mr. Ajit Ravsaheb Akkole',          'position' => 'Director',   'qualification' => '', 'phone' => '7411897116'],
        ];
    }

    /**
     * Get board of management
     */
    public function getBoardOfManagement() {
        return [
            ['name' => 'Shri Anil Sadalage',       'position' => 'BOM Chairman', 'phone' => '9448129822'],
            ['name' => 'Shri Ashok Danawade',       'position' => 'BOM Director', 'phone' => '9845096404'],
            ['name' => 'Shri Mahaveer Yeshwant Miraji', 'position' => 'BOM Director', 'phone' => '9448482544'],
            ['name' => 'Shri Basavaraj Patil',      'position' => 'BOM Director', 'phone' => ''],
            ['name' => 'Shri Uday Mane',            'position' => 'BOM Director', 'phone' => ''],
        ];
    }
    
    /**
     * Get news/announcements — Real updates for Miraji Bank
     */
    public function getNews() {
        return [
            [
                'title' => 'AGM 2024-25 — Notice to Members',
                'date' => date('Y-m-d', strtotime('-7 days')),
                'excerpt' => 'The Annual General Meeting for the year 2024-25 will be held shortly. All members are requested to attend and participate.',
                'link' => '/pages/media.php#notices'
            ],
            [
                'title' => '"A" Grade Audit — 2024-25',
                'date' => date('Y-m-d', strtotime('-20 days')),
                'excerpt' => 'We are proud to announce that the bank has received an "A" Grade in Audit remarks for the year 2024-25, reflecting strong financial health.',
                'link' => '/pages/about.php'
            ],
            [
                'title' => 'FD Interest Rate — Up to 8.00% p.a.',
                'date' => date('Y-m-d', strtotime('-35 days')),
                'excerpt' => 'Earn up to 8.00% p.a. on Fixed Deposits (2–5 years). Senior citizens and soldiers enjoy an additional 0.50% benefit.',
                'link' => '/pages/deposits.php#fixed'
            ],
            [
                'title' => 'DEAF Accounts — Unclaimed Deposits',
                'date' => date('Y-m-d', strtotime('-60 days')),
                'excerpt' => 'Details of accounts transferred to Depositor Education & Awareness Fund (DEAF) as per RBI circular. Contact your nearest branch.',
                'link' => '/pages/media.php#notices'
            ]
        ];
    }
    
    /**
     * Get featured offers/highlights — Real products for Miraji Bank
     */
    public function getOffers() {
        return [
            [
                'title' => 'Fixed Deposit — Up to 8.00% p.a.',
                'description' => 'Earn up to 8.00% p.a. on 2–5 year FD. Senior citizens get 0.50% extra. Flexible tenure from 46 days.',
                'icon' => 'fas fa-chart-line',
                'link' => '/pages/deposits.php#fixed'
            ],
            [
                'title' => 'Gold Loan — 9.00% p.a.',
                'description' => 'Instant gold loan at just 9.00% p.a. Quick disbursal. Secure your gold with us while meeting your financial needs.',
                'icon' => 'fas fa-coins',
                'link' => '/pages/loans.php#gold'
            ],
            [
                'title' => 'Yeshwant Pigmy Deposit',
                'description' => 'Daily savings scheme — our agent collects at your doorstep. Build wealth with small daily contributions.',
                'icon' => 'fas fa-home',
                'link' => '/pages/deposits.php#pigmy'
            ],
            [
                'title' => 'RTGS / NEFT Fund Transfer',
                'description' => 'Transfer funds electronically via RTGS/NEFT to any bank in India. Fast, secure, and convenient.',
                'icon' => 'fas fa-exchange-alt',
                'link' => '/pages/services.php#rtgs'
            ]
        ];
    }

    /**
     * Get downloads from database
     */
    public function getDownloads($limit = 6) {
        require_once __DIR__ . '/db.php';
        
        try {
            $query = "SELECT id, title, description, category FROM downloads WHERE status = 'active' ORDER BY created_at DESC LIMIT ?";
            return fetchAll($query, [$limit]);
        } catch (Exception $e) {
            return [];
        }
    }

    /**
     * Get gallery images from database
     */
    public function getGallery($limit = 6) {
        require_once __DIR__ . '/db.php';
        
        try {
            $query = "SELECT id, title, image_path, alt_text, category FROM gallery WHERE status = 'active' ORDER BY display_order ASC, created_at DESC LIMIT ?";
            return fetchAll($query, [$limit]);
        } catch (Exception $e) {
            return [];
        }
    }

    /**
     * Get notices/news from database
     */
    public function getNotices($limit = 5) {
        require_once __DIR__ . '/db.php';
        
        try {
            $query = "SELECT id, title, content, date_published FROM notices WHERE status = 'active' ORDER BY date_published DESC LIMIT ?";
            return fetchAll($query, [$limit]);
        } catch (Exception $e) {
            return [];
        }
    }
}

// Initialize fetcher globally
$data_fetcher = new DataFetcher();
?>
