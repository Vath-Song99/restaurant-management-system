<?php

// first Load
require_once '../config/config.php';
require_once '../config/database.php';
require_once '../config/class.php';
require_once '../routes/router.php';
require_once '../helpers/csrHelper.php';

SessionHelper::init();
$router = Router::getInstance();

require_once APP_ROOT . '/routes/routes.php';

AuthMiddleware::checkSession();

$router->dispatch();

