<?php
  

class ErrorController {
    // Display 403 Forbidden page
    public function forbidden() {
        http_response_code(403);
        require_once APP_ROOT . '/views/errors/403.php';
    }
    
    // Display 404 Not Found page
    public function notFound() {
        http_response_code(404);
        require_once APP_ROOT . '/views/errors/404.php';
    }
}
?>