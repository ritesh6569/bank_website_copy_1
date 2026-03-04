<?php
/**
 * Data Fetcher and Parser
 * Scrapes data from the target website and provides fallback data
 */

class DataFetcher {
    private $cache_dir = '/bank-website-grok/data';
    private $timeout = 5;
    
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
        $cache_file = $_SERVER['DOCUMENT_ROOT'] . $this->cache_dir . '/interest_rates.json';
        
        // Try to return cached data first
        if (file_exists($cache_file)) {
            $data = json_decode(file_get_contents($cache_file), true);
            if ($data) {
                return $data;
            }
        }
        
        // Fallback data
        return [
            'deposits' => [
                ['name' => 'Savings Account', 'rate' => '3.5% - 4.0% p.a.', 'min_balance' => '₹1,000'],
                ['name' => 'Current Account', 'rate' => 'No Interest', 'min_balance' => '₹5,000'],
                ['name' => 'Fixed Deposit (1 Year)', 'rate' => '6.0% - 6.5% p.a.', 'min_balance' => '₹10,000'],
                ['name' => 'Fixed Deposit (2 Year)', 'rate' => '6.2% - 6.7% p.a.', 'min_balance' => '₹10,000'],
                ['name' => 'Recurring Deposit', 'rate' => '5.5% - 6.0% p.a.', 'min_balance' => '₹500/month']
            ],
            'loans' => [
                ['name' => 'Personal Loan', 'rate' => '8.5% - 12.5% p.a.', 'amount' => '₹50,000 - ₹25,00,000'],
                ['name' => 'Home Loan', 'rate' => '7.0% - 8.5% p.a.', 'amount' => '₹5,00,000 - ₹2 Cr'],
                ['name' => 'Vehicle Loan', 'rate' => '7.5% - 9.5% p.a.', 'amount' => 'Up to 80% of vehicle cost'],
                ['name' => 'Business Loan', 'rate' => '9.0% - 14.0% p.a.', 'amount' => '₹1,00,000 - ₹1 Cr']
            ]
        ];
    }
    
    /**
     * Get service charges data
     */
    public function getServiceCharges() {
        return [
            ['service' => 'Account Opening', 'charge' => 'Free'],
            ['service' => 'Account Maintenance (Annual)', 'charge' => 'Free'],
            ['service' => 'Cheque Book (20 leaves)', 'charge' => '₹50'],
            ['service' => 'Demand Draft', 'charge' => '₹25-50'],
            ['service' => 'RTGS/NEFT Transfer', 'charge' => '₹5-50'],
            ['service' => 'SMS Banking Setup', 'charge' => 'Free'],
            ['service' => 'Internet Banking Setup', 'charge' => 'Free'],
            ['service' => 'Fixed Deposit Renewal', 'charge' => 'Free'],
            ['service' => 'Locker Facility (Annual)', 'charge' => '₹500-5,000'],
            ['service' => 'Account Closure', 'charge' => 'Free']
        ];
    }
    
    /**
     * Get branches data
     */
    public function getBranches() {
        return [
            [
                'name' => 'Main Branch',
                'address' => '123 Banking Street, Financial City, FC 12345',
                'phone' => '+1 (234) 567-890',
                'email' => 'main@bank.com',
                'hours' => 'Mon-Fri: 10:00 AM - 4:00 PM, Sat: 10:00 AM - 1:00 PM'
            ],
            [
                'name' => 'Downtown Branch',
                'address' => '456 Commerce Avenue, Financial City, FC 12346',
                'phone' => '+1 (234) 567-891',
                'email' => 'downtown@bank.com',
                'hours' => 'Mon-Fri: 10:00 AM - 4:00 PM, Sat: 10:00 AM - 1:00 PM'
            ],
            [
                'name' => 'Midtown Branch',
                'address' => '789 Finance Plaza, Financial City, FC 12347',
                'phone' => '+1 (234) 567-892',
                'email' => 'midtown@bank.com',
                'hours' => 'Mon-Fri: 10:00 AM - 4:00 PM, Sat: 10:00 AM - 1:00 PM'
            ],
            [
                'name' => 'Uptown Branch',
                'address' => '321 Investment Road, Financial City, FC 12348',
                'phone' => '+1 (234) 567-893',
                'email' => 'uptown@bank.com',
                'hours' => 'Mon-Fri: 10:00 AM - 4:00 PM, Sat: 10:00 AM - 1:00 PM'
            ]
        ];
    }
    
    /**
     * Get bank leadership data
     */
    public function getLeadership() {
        return [
            'founder' => [
                'name' => 'Mr. John Smith',
                'title' => 'Founder & Chairman Emeritus',
                'bio' => 'Founded the bank in 1995 with a vision to revolutionize banking services in the region. With over 40 years of experience in finance.',
                'image' => '/bank-website-grok/assets/images/founder.jpg'
            ],
            'chairman' => [
                'name' => 'Dr. Sarah Johnson',
                'title' => 'Chairman & CEO',
                'bio' => 'Leads the bank with a commitment to innovation and customer-centric banking solutions. MBA from Harvard Business School.',
                'image' => '/bank-website-grok/assets/images/chairman.jpg'
            ],
            'general_manager' => [
                'name' => 'Mr. Robert Williams',
                'title' => 'General Manager',
                'bio' => 'Oversees daily operations with 25+ years of banking experience. CFA Charterholder.',
                'image' => '/bank-website-grok/assets/images/gm.jpg'
            ]
        ];
    }
    
    /**
     * Get board of directors
     */
    public function getBoardOfDirectors() {
        return [
            ['name' => 'Dr. Michael Brown', 'position' => 'Director', 'qualification' => 'Ph.D. in Economics'],
            ['name' => 'Ms. Emily Davis', 'position' => 'Independent Director', 'qualification' => 'B.Tech in Finance'],
            ['name' => 'Mr. James Wilson', 'position' => 'Director', 'qualification' => 'MBA, Strategic Management'],
            ['name' => 'Ms. Lisa Anderson', 'position' => 'Independent Director', 'qualification' => 'CPA, CFO'],
            ['name' => 'Mr. David Martinez', 'position' => 'Director', 'qualification' => 'BS in Banking & Finance']
        ];
    }
    
    /**
     * Get news/announcements
     */
    public function getNews() {
        return [
            [
                'title' => 'New Mobile App Launch',
                'date' => date('Y-m-d', strtotime('-5 days')),
                'excerpt' => 'Our enhanced mobile banking app now includes AI-powered financial insights and improved security features.',
                'link' => '#'
            ],
            [
                'title' => 'Special FD Rate Promotion',
                'date' => date('Y-m-d', strtotime('-10 days')),
                'excerpt' => 'Enjoy up to 7% interest rate on Fixed Deposits for 1-year tenure. Limited time offer!',
                'link' => '#'
            ],
            [
                'title' => 'Q4 Financial Results Announced',
                'date' => date('Y-m-d', strtotime('-15 days')),
                'excerpt' => 'Bank reports strong financial performance with 25% increase in customer base and improved profitability.',
                'link' => '#'
            ],
            [
                'title' => 'New Home Loan Products',
                'date' => date('Y-m-d', strtotime('-20 days')),
                'excerpt' => 'Introducing flexible home loan options with reduced processing time and competitive interest rates.',
                'link' => '#'
            ]
        ];
    }
    
    /**
     * Get featured offers
     */
    public function getOffers() {
        return [
            [
                'title' => 'Cashback on Digital Transfers',
                'description' => 'Get 2% cashback on all RTGS/NEFT transfers up to ₹50,000',
                'icon' => 'fas fa-hand-holding-usd'
            ],
            [
                'title' => 'Premium Savings Account',
                'description' => 'Earn up to 4.5% interest + exclusive benefits',
                'icon' => 'fas fa-piggy-bank'
            ],
            [
                'title' => 'Personal Loan at 8.5%',
                'description' => 'Quick approval | No hidden charges | Instant disbursement',
                'icon' => 'fas fa-handshake'
            ],
            [
                'title' => 'Zero Annual Fee Credit Card',
                'description' => 'Unlimited rewards + travel benefits + exclusive perks',
                'icon' => 'fas fa-credit-card'
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
