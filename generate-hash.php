<?php
/**
 * Generate Password Hash
 * Quick utility to generate bcrypt hash for admin password
 */

$password = 'password';
$hash = password_hash($password, PASSWORD_BCRYPT);

echo "Password: " . $password . "\n";
echo "Hash: " . $hash . "\n";
echo "\n";
echo "Verify test: " . (password_verify($password, $hash) ? "✓ PASS" : "✗ FAIL") . "\n";
echo "\n";
echo "Use this SQL to update the database:\n";
echo "UPDATE admin_users SET password = '$hash' WHERE username = 'admin';\n";
?>
