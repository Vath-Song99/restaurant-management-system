<?php
require_once 'config.php'; // Load environment variables

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$dbname = getenv('DB_NAME');

define('DB_HOST', $host);
define('DB_USER', $user);
define('DB_PASS', $pass);
define('DB_NAME', $dbname);
?>
