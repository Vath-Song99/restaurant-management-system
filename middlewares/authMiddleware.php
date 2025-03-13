<?php
class AuthMiddleware {
    public static function isLoggedIn() {
        if (!SessionHelper::exists('is_logged_in') || !SessionHelper::get('is_logged_in')) {
            FlashHelper::setFlash('login_error', 'Please log in to access this page', 'alert alert-danger');
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
    }
    
    public static function isGuest() {
        if (SessionHelper::exists('is_logged_in') && SessionHelper::get('is_logged_in')) {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }
    }
    
    public static function checkSession() {

        // Check if user is logged in
        if (SessionHelper::exists('is_logged_in') && SessionHelper::get('is_logged_in')) {

            // Check for session hijacking
            if (!isset($_SESSION['user_agent']) || $_SESSION['user_agent'] != $_SERVER['HTTP_USER_AGENT']) {
                self::logout();
                FlashHelper::setFlash('login_error', 'Session validation failed. Please log in again.', 'alert alert-danger');
                header('Location: ' . BASE_URL . '/auth/login');
                exit;
            }
            
            // Regenerate session ID periodically
            if (!isset($_SESSION['last_regenerate']) || (time() - $_SESSION['last_regenerate']) > 1800) {
                SessionHelper::regenerate();
                $_SESSION['last_regenerate'] = time();
            }
        } 
    }
    
    public static function logout() {
        SessionHelper::destroy();
    }
}

?>