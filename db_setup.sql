-- Database Setup Script for Bank Website
-- NOTE: On Aiven, the database is 'defaultdb' — no CREATE DATABASE needed
-- Run this entire file in Aiven's Query Editor or via a MySQL client

-- Admin Users Table
CREATE TABLE IF NOT EXISTS admin_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    full_name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Notices Table
CREATE TABLE IF NOT EXISTS notices (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT NOT NULL,
    date_published DATETIME NOT NULL,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by INT,
    FOREIGN KEY (created_by) REFERENCES admin_users(id) ON DELETE SET NULL
);

-- Downloads Table
CREATE TABLE IF NOT EXISTS downloads (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    file_path VARCHAR(255) NOT NULL,
    category VARCHAR(100),
    download_count INT DEFAULT 0,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by INT,
    FOREIGN KEY (created_by) REFERENCES admin_users(id) ON DELETE SET NULL
);

-- Gallery Table
CREATE TABLE IF NOT EXISTS gallery (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image_path VARCHAR(255) NOT NULL,
    alt_text VARCHAR(255),
    category VARCHAR(100),
    display_order INT DEFAULT 0,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_by INT,
    FOREIGN KEY (created_by) REFERENCES admin_users(id) ON DELETE SET NULL
);

-- Loan Rates Table
CREATE TABLE IF NOT EXISTS loan_rates (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category VARCHAR(100) NOT NULL,
    loan_type VARCHAR(255) NOT NULL,
    interest_rate VARCHAR(50) NOT NULL,
    display_order INT DEFAULT 0,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Deposit Rates Table
CREATE TABLE IF NOT EXISTS deposit_rates (
    id INT PRIMARY KEY AUTO_INCREMENT,
    deposit_type VARCHAR(255) NOT NULL,
    period VARCHAR(100) NOT NULL,
    general_rate VARCHAR(50) NOT NULL,
    senior_rate VARCHAR(50) NOT NULL,
    display_order INT DEFAULT 0,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Seed default loan rates (INSERT IGNORE = safe to re-run)
INSERT IGNORE INTO loan_rates (id, category, loan_type, interest_rate, display_order) VALUES
(1,  'I. Industrial Loan / MSME',  'Working Capital',                         '10.00%',         1),
(2,  'I. Industrial Loan / MSME',  'Term Loan',                                '11.00%',         2),
(3,  'I. Industrial Loan / MSME',  'Shade Construction (MSME)',                '11.00%',         3),
(4,  'II. Housing Loan',           'Housing Loan – Residential Construction',  '10.50%',         4),
(5,  'II. Housing Loan',           'Housing Loan – Residential Purchase',      '10.50%',         5),
(6,  'II. Housing Loan',           'Housing Loan – Residential Repair',        '11.00%',         6),
(7,  'II. Housing Loan',           'Housing Loan – Commercial',                '11.50%',         7),
(8,  'III. Vehicle Loan',          'Two Wheeler',                              '11.00%',         8),
(9,  'III. Vehicle Loan',          'Four Wheeler / Commercial Vehicle',        '10.50%',         9),
(10, 'IV. Professional Loan',      'Professional Loan',                        '12.00% – 13.00%',10),
(11, 'V. Gold Loan',               'Gold Loan',                                '9.00%',          11);

-- Seed default deposit rates (INSERT IGNORE = safe to re-run)
INSERT IGNORE INTO deposit_rates (id, deposit_type, period, general_rate, senior_rate, display_order) VALUES
(1, 'Saving Bank Deposit', '—',                            '3.00%', '3.50%', 1),
(2, 'Term Deposit',        '46 Days to 90 Days',           '5.00%', '5.50%', 2),
(3, 'Term Deposit',        '91 Days to 180 Days',          '5.50%', '6.00%', 3),
(4, 'Term Deposit',        '181 Days to 364 Days',         '7.00%', '7.50%', 4),
(5, 'Term Deposit',        '1 Year and above to < 2 Years','7.75%', '8.25%', 5),
(6, 'Term Deposit',        '2 Years and above to < 5 Years','8.00%','8.50%', 6),
(7, 'Term Deposit',        '5 Years and above',            '7.75%', '8.25%', 7);

-- Contact Submissions Table
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
);

-- Insert default admin user only if it doesn't already exist
-- username: admin  |  password: Admin@1234  (change after first login!)
INSERT IGNORE INTO admin_users (username, password, email, full_name) VALUES 
('admin', '$2y$10$YIjlrWyV7w3k5/K2w5K5w.e9rXK5/K2w5K5w.e9rXK5/K2w5K5w.', 'admin@bank.com', 'Administrator');

-- Create indexes for better performance (IF NOT EXISTS = safe to re-run)
CREATE INDEX IF NOT EXISTS idx_notices_status ON notices(status);
CREATE INDEX IF NOT EXISTS idx_notices_date ON notices(date_published);
CREATE INDEX IF NOT EXISTS idx_downloads_category ON downloads(category);
CREATE INDEX IF NOT EXISTS idx_downloads_status ON downloads(status);
CREATE INDEX IF NOT EXISTS idx_gallery_category ON gallery(category);
CREATE INDEX IF NOT EXISTS idx_gallery_status ON gallery(status);
