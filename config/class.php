<?php 

spl_autoload_register(function ($className) {
	$className = lcfirst($className);

	switch (true) {
		case file_exists(APP_ROOT . '/models/' . $className . '.php'):
			require_once APP_ROOT . '/models/' . $className . '.php';
			break;
		case file_exists(APP_ROOT . '/controllers/' . $className . '.php'):
			require_once APP_ROOT . '/controllers/' . $className . '.php';
			break;
		case file_exists(APP_ROOT . '/helpers/' . $className . '.php'):
			require_once APP_ROOT . '/helpers/' . $className . '.php';
			break;
		case file_exists(APP_ROOT . '/middlewares/' . $className . '.php'):
			require_once APP_ROOT . '/middlewares/' . $className . '.php';
			break;
	}
});
?>