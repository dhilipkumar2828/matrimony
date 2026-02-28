<?php
// ========== MODERN ENTRY POINT (Front Controller) ==========

// 1. Require Composer Autoloader
// This automatically loads any classes placed in the app/ and config/ folders.
require_once __DIR__ . '/vendor/autoload.php';

// 2. Import Router
use App\Core\Router;

// 3. Initialize Router
$router = new Router();

// ==========================================
// ========== DEFINE YOUR ROUTES ============
// ==========================================

// GET route for testing the new MVC
$router->get('/mvc/welcome', [App\Controllers\HomeController::class, 'index']);

// Default Route (Home Page)
$router->get('/', function() {
    require_once __DIR__ . '/index_legacy.php';
});
$router->get('/index.php', function() {
    require_once __DIR__ . '/index_legacy.php';
});

// Routes for the completely new About Us Page
$router->get('/about.php', [App\Controllers\AboutController::class, 'index']);
$router->get('/about', [App\Controllers\AboutController::class, 'index']);

// Routes for Admin Panel MVC Login
$router->get('/matrimonyadmin/index.php', [App\Controllers\Admin\LoginController::class, 'index']);
$router->get('/admin/login', [App\Controllers\Admin\LoginController::class, 'index']);
$router->post('/admin/authenticate', [App\Controllers\Admin\LoginController::class, 'authenticate']);
$router->get('/admin/logout', [App\Controllers\Admin\LoginController::class, 'logout']);

// Example route for a specific page (e.g., /about)
// $router->get('/about', [App\Controllers\PageController::class, 'about']);

// ==========================================

// Get current URI and HTTP Method
$uri = $_SERVER['REQUEST_URI'] ?? '/';
$method = $_SERVER['REQUEST_METHOD'];

// Ensure all errors are displayed during development
// Move to 0 in production
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Dispatch the request
$router->dispatch($uri, $method);