<?php
  
class SessionHelper {
    // Initialize session
    public static function init() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    // Set session
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }
    
    // Get session
    public static function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }
    
    // Check if session exists
    public static function exists($key) {
        return isset($_SESSION[$key]);
    }
    
    // Remove session
    public static function remove($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
    
    // Destroy session
    public static function destroy() {
        session_destroy();
        // Unset all session variables
        $_SESSION = array();
        
        // Delete the session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
    }
    
    // Regenerate ID
    public static function regenerate() {
        session_regenerate_id(true);
    }
    
    // Set user session
    public static function setUserSession($user) {
        self::set('user_id', $user->id);
        self::set('user_name', $user->name);
        self::set('user_email', $user->email);
        self::set('user_role_id', $user->role_id);
        self::set('is_logged_in', true);
        self::regenerate();
    }
}



