<?php
  

class HomeController {
    public function index(){
        AuthMiddleware::isLoggedIn();
        AuthMiddleware::isGuest();
        return;
    }
}

?>