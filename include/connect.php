<?php
// Suppress notices/warnings but keep fatal errors visible for debugging
error_reporting(0);
ini_set('display_errors', '0');

@ob_start();

// Auto-detect environment
if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
    $servername = "localhost";
    $username = "root";
    $password = "";
} else {
    $servername = "localhost";
    $username = "hmmattdk_testuser";
    $password = "Micandmac@12";
}
$dbname = "hmmattdk_matrimonialdb";

// Direct connect with database
$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con) {
    die("DB Connection Failed: " . mysqli_connect_error());
}

// Set charset
mysqli_set_charset($con, "utf8");

/**
 * Standardized Avatar Helper
 * Always returns gender-based avatar based on input gender
 * Supports optional path prefix (e.g., '../') for files in subdirectories
 */
function get_avatar($gender, $prefix = '') {
    $g = strtolower(trim($gender));
    if ($g == "male" || $g == "groom") {
        return $prefix . "assets/avatar/male-avatar.svg";
    } else {
        return $prefix . "assets/avatar/female-avatar.svg";
    }
}
?>