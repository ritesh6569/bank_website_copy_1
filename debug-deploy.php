<?php
// Temporary debug file — DELETE after confirming deploy is working
echo "<pre>";
echo "PHP version: " . PHP_VERSION . "\n";
echo "__FILE__: " . __FILE__ . "\n";
echo "__DIR__: " . __DIR__ . "\n";
echo "DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "config.php exists: " . (file_exists(__DIR__ . '/config.php') ? 'YES' : 'NO') . "\n";
echo "index.php line 10: ";
$lines = file(__DIR__ . '/index.php');
echo htmlspecialchars($lines[9]);
echo "</pre>";
