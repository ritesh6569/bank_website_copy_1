# Login Testing Guide

## Quick Test Steps

1. **Visit the Login Page:**
   - Go to: `http://localhost/bank-website-grok/admin/login.php`

2. **Look for the Debug Warning Alert**
   - You should see a yellow alert that says "Debug Mode: This page is in debug/testing mode"
   - This proves the page is loading correctly

3. **Enter Demo Credentials:**
   - Username: `admin`
   - Password: `password`

4. **Click Login Button**

5. **Expected Results:**
   
   **If login FAILS:**
   - You'll see a red error alert: "Invalid username or password."
   - An info alert will appear showing what you submitted
   
   **If login SUCCEEDS:**
   - You'll be redirected to: `http://localhost/bank-website-grok/admin/index.php`
   - You'll see a green success alert: "Success! Login successful for user: admin"
   - The dashboard will load with admin stats and navigation

## Debugging Steps

### Check Browser Console (F12):
- Open Developer Tools: Press `F12` or `Ctrl+Shift+I`
- Go to "Console" tab
- You should see debug logs like:
  ```
  🔍 Login Page Debug Info:
  - Page loaded successfully
  - Current URL: http://localhost/bank-website-grok/admin/login.php
  - Form method: POST
  - Demo credentials: username=admin, password=password
  ```

### Check PHP Error Log:
- Open PHP error log (usually in `/xampp/apache/logs/error.log`)
- Look for "Login Debug" entries showing:
  - Username being checked
  - Query results
  - Password verification status

### Check Database:
1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Go to database: `bank_db`
3. Go to table: `admin_users`
4. Look for user "admin"
5. Check that a password hash exists

## If Password Hash is Wrong

Run this query in phpMyAdmin SQL tab:

```sql
UPDATE admin_users SET password = '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4/D66' WHERE username = 'admin';
```

Or visit: `http://localhost/bank-website-grok/generate-hash.php`
This will show you the correct hash to use.

## Common Issues

| Issue | Solution |
|-------|----------|
| Page won't load | Check if PHP is running and database is connected |
| No debug alert showing | Browser might have errors, check console (F12) |
| Login fails with any credentials | Password hash in database is wrong or database is empty |
| Redirects without alert | Check browser console for JavaScript errors |

