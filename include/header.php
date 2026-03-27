<?php
// Modern Header Include
$current_page = basename($_SERVER['PHP_SELF']);
$request_uri = $_SERVER['REQUEST_URI'];
?>
<!-- Header Requirements -->
<link rel="stylesheet" href="css/modern-design.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<header class="headerdiv">
    <div class="inner">
        <div class="logo">
            <a href="index.php">
                <img src="image/CMU Serif (4).png" class="crtlogo" alt="Logo">
            </a>
        </div>

        <ul class="navlinks">
            <li><a href="index.php" <?php if (($current_page == 'index.php' || $current_page == 'index_legacy.php' || $current_page == '') && (strpos($request_uri, '/about') === false && strpos($request_uri, '/search_result') === false && strpos($request_uri, '/plans') === false && strpos($request_uri, '/contact') === false)) echo 'class="active"'; ?>>Home</a></li>
            <li><a href="about.php" <?php if ($current_page == 'about.php' || strpos($request_uri, '/about') !== false) echo 'class="active"'; ?>>About Us</a></li>
            <li><a href="search_result.php" <?php if ($current_page == 'search_result.php' || strpos($request_uri, '/search_result') !== false) echo 'class="active"'; ?>>Search Profiles</a></li>
            <li><a href="plans.php" <?php if ($current_page == 'plans.php' || $current_page == 'paynow.php' || strpos($request_uri, '/plans') !== false || strpos($request_uri, '/paynow') !== false) echo 'class="active"'; ?>>Payment</a></li>
            <li><a href="contact.php" <?php if ($current_page == 'contact.php' || strpos($request_uri, '/contact') !== false) echo 'class="active"'; ?>>Contact Us</a></li>
            <li><a href="register.php" <?php if ($current_page == 'register.php' || strpos($request_uri, '/register') !== false) echo 'class="active"'; ?>>Register</a></li>
            <button class="btn btn-success" onclick="location.href='login.php'">Login</button>
        </ul>
    </div>
</header>