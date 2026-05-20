<?php
/**
 * Front Controller / Router
 */

require_once __DIR__ . '/../config/config.php';

// Get the requested URI and clean it up
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$script_name = $_SERVER['SCRIPT_NAME']; // e.g. /hjjc/public/index.php

// The base path for routing is the BASE_URL
$base_path = BASE_URL; // e.g. /hjjc

// Remove base path from the URI to get the relative route
$path = substr($request_uri, strlen($base_path));
$path = trim($path, '/');

// If we are hitting public directly, strip it from the start of the path
if (strpos($path, 'public') === 0) {
    $path = substr($path, strlen('public'));
    $path = trim($path, '/');
}

// If the user explicitly included index.php in the URL, strip it
if (strpos($path, 'index.php') === 0) {
    $path = substr($path, strlen('index.php'));
    $path = trim($path, '/');
}

// Default path
if ($path === '') {
    $path = 'landing';
}

/**
 * Route Mapping
 */
$routes = [
    'landing'      => 'landing.php',
    'menu'         => 'menu.php',
    'about'        => 'about.php',
    'cart'         => 'cart.php',
    'orders'       => 'orders.php',
    'product'      => 'productPage.php',
    'login'        => 'login.php',
    'register'     => 'register.php',
    'admin'        => 'admin.php',
    'developer'    => 'developer.php',
    'address-form' => 'addressForm.php',
    'product-input'=> 'productInput.php',
];

// Check if route exists
if (array_key_exists($path, $routes)) {
    $view_file = VIEW_PATH . '/pages/' . $routes[$path];
    if (file_exists($view_file)) {
        include $view_file;
    } else {
        error_log("View file not found: $view_file");
        render404();
    }
} else {
    render404();
}

/**
 * Helper to render 404 page
 */
function render404() {
    http_response_code(404);
    $home_url = defined('BASE_URL') ? BASE_URL : '/';
    echo "<h1>404 - Page Not Found</h1>";
    echo "<p>The page you are looking for does not exist.</p>";
    echo "<a href='$home_url'>Go to Home</a>";
}
?>