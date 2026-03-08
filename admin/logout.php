<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$_SESSION = [];
session_destroy();
if (!defined('SITE_URL')) require_once __DIR__ . '/../config.php';
header("Location: " . SITE_URL . "admin/login.php"); exit();
