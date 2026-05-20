<?php
/**
 * Router script for the PHP built-in web server.
 * Run this from the project root:
 * php -S localhost:3000 router.php
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// If the requested file exists in the public directory or root, serve it directly
if ($uri !== '/' && (file_exists(__DIR__ . '/public' . $uri) || file_exists(__DIR__ . $uri))) {
    return false;
}

// Rewrite all other requests to the front controller
$_SERVER['SCRIPT_NAME'] = '/public/index.php';
require_once __DIR__ . '/public/index.php';
