<?php
function loadEnv($path = __DIR__ . '/../.env') {
    if (!file_exists($path)) {
        throw new Exception(".env file not found!");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue; // Ignore comments
        list($key, $value) = explode("=", $line, 2);
        $key = trim($key);
        $value = trim($value);
        if (!array_key_exists($key, $_ENV)) {
            $_ENV[$key] = $value;
            putenv("$key=$value");
        }
    }
}

// Load environment variables
loadEnv();

define('BASE_URL', 'http://localhost');
define('APP_NAME', 'Restaurant Management System(RMS)');
define('APP_ROOT', dirname(dirname(__FILE__)));
define('PUBLIC_ROOT', BASE_URL . '/public');

// Error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
?>
