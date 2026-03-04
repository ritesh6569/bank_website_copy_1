# LOGIN TROUBLESHOOTING GUIDE

## Issue: Cannot Login to Admin Panel

If you're unable to login to the admin panel, follow these steps:

### Step 1: Ensure Database is Set Up
The database must be initialized before you can login.

**Option A: Using phpMyAdmin (Recommended)**
1. Open phpMyAdmin: http://localhost/phpmyadmin
2. Create a new database named `bank_db`
3. Select the new `bank_db` database
4. Click "SQL" tab
5. Copy and paste the contents of `/db_setup.sql`
6. Click "Go" to execute

**Option B: Using MySQL Command Line**
```bash
mysql -u root -p < db_setup.sql
```

### Step 2: Verify Database Connection
Visit: http://localhost/bank-website-grok/simple-db-test.php

You should see:
- ✓ Database connection successful!
- ✓ admin_users table exists
- ✓ Admin users in database: 1
- Users in database:
  - admin (admin@bank.com)

### Step 3: Test Login Credentials
Visit: http://localhost/bank-website-grok/test-login.php

Verify all tests pass:
- ✓ Database Connection
- ✓ Check Admin User (admin user should be found)
- ✓ Password Verification (should PASS with password='password')
- ✓ Simulate Login POST (should show Login would be SUCCESSFUL)

### Step 4: Attempt Login
1. Go to: http://localhost/bank-website-grok/admin/login.php
2. Enter:
   - Username: `admin`
   - Password: `password`
3. Click "Login"

You should see:
- A blue info alert box showing: "Test Alert: Login attempt: Username: admin, Password: password"
- Then redirect to: http://localhost/bank-website-grok/admin/index.php
- A green success alert showing: "Success! Login successful for user: admin"

### Step 5: Common Issues & Solutions

**Issue: "Database connection failed"**
- MySQL service not running
- Database credentials wrong (check config in `/includes/db.php`)
- Solution: Start MySQL, check credentials

**Issue: "admin_users table does NOT exist"**
- Database setup SQL wasn't run
- Solution: Run the SQL setup script (Step 1)

**Issue: "No users found in database"**
- SQL script didn't insert the default admin user
- Solution: Manually insert: 
  ```sql
  INSERT INTO admin_users (username, password, email, full_name) VALUES 
  ('admin', '$2y$10$YIjlrWyV7w3k5/K2w5K5w.e9rXK5/K2w5K5w.e9rXK5/K2w5K5w.', 'admin@bank.com', 'Administrator');
  ```

**Issue: "Password verification FAILED"**
- The password hash in database is corrupted or wrong
- Solution: Generate a new hash for 'password':
  ```php
  <?php echo password_hash('password', PASSWORD_BCRYPT); ?>
  ```
  Then update the admin_users table with the new hash

**Issue: Cannot see the test alert box**
- Browser might have JavaScript disabled
- Page didn't submit properly
- Solution: Check browser console (F12) for errors, enable JavaScript

### Debug Mode
All error messages are displayed. Check your browser's:
- **Console** (F12 → Console tab) for JavaScript errors
- **Network** tab to see if form was submitted (look for POST request to login.php)
- **Sources** tab to debug step-by-step

### Login Test Files
These diagnostic files help troubleshoot:
- `/simple-db-test.php` - Check database connection and table
- `/test-login.php` - Full login simulation with detailed output
- `/admin/login.php` - Main login page (shows test alert on POST)
- `/admin/index.php` - Dashboard (shows success alert after login)
