<?php
/**
 * Global Configuration and Path Constants
 */

// Root directory of the project
define('BASE_PATH', dirname(__DIR__));

// Paths to major directories
define('VIEW_PATH', BASE_PATH . '/views');
define('INC_PATH', BASE_PATH . '/includes');
define('CONFIG_PATH', BASE_PATH . '/config');
define('PUBLIC_PATH', BASE_PATH . '/public');

// Web-relative base URL (the folder containing the app, e.g., /hjjc)
$script_name = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$public_pos = strpos($script_name, '/public/');
if ($public_pos !== false) {
    $app_base = substr($script_name, 0, $public_pos);
} else {
    $app_base = rtrim(dirname($script_name), '/');
}
define('BASE_URL', $app_base === '' ? '' : $app_base);

// Path to public assets
define('ASSET_URL', BASE_URL . '/public/assets');

/**
 * Common includes that should be available on every page
 */
require_once CONFIG_PATH . '/db.php';
require_once CONFIG_PATH . '/sessionStart.php';
?>
