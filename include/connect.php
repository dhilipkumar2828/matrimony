<?php
// Suppress notices/warnings but keep fatal errors visible for debugging
error_reporting(0);
ini_set('display_errors', '0');

@ob_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hmmattdk_matrimonialdb";

// Direct connect with database
$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con) {
    die("DB Connection Failed: " . mysqli_connect_error());
}

// Set charset
mysqli_set_charset($con, "utf8");
?>