<?php
class Router {
    private $routes = [];
    private static $routeInstance;
    private function __construct() {

    }
    public static function getInstance (){
        if (self::$routeInstance === null) {
            self::$routeInstance = new Router();
        }
        return self::$routeInstance;
    }
    
    public function get($path, $controller, $action) {
        $this->addRoute('GET', $path, $controller, $action);
    }
    
    public function post($path, $controller, $action) {
        $this->addRoute('POST', $path, $controller, $action);
    }
    
    public function put($path, $controller, $action) {
        $this->addRoute('PUT', $path, $controller, $action);
    }
    
    public function delete($path, $controller, $action) {
        $this->addRoute('DELETE', $path, $controller, $action);
    }
    
    private function addRoute($method, $path, $controller, $action) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }
    
    public function dispatch() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if ($requestMethod == 'POST' && isset($_POST['_method'])) {
            if (in_array($_POST['_method'], ['PUT', 'DELETE'])) {
                $requestMethod = $_POST['_method'];
            }
        }
        
        foreach ($this->routes as $route) {
            $pattern = $this->patternToRegex($route['path']);

            if ($requestMethod == $route['method'] && preg_match($pattern, $requestUri, $matches)) {
                array_shift($matches);
                $controller = new $route['controller']();              
                call_user_func_array([$controller, $route['action']], $matches);
                return;
            }
        }
        header("Location:" . BASE_URL . "/errors/404");
        exit;
    }
    
    private function patternToRegex($pattern) {
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $pattern);
        return "@^" . $pattern . "$@D";
    }
}