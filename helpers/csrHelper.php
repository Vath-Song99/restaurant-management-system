<?php
  
class CSRFHelper {
    // Generate CSRF token
    public static function generateToken() {
        if (!SessionHelper::exists('csrf_token')) {
            SessionHelper::set('csrf_token', bin2hex(random_bytes(32)));
        }
        
        return SessionHelper::get('csrf_token');
    }
    
    // Verify CSRF token
    public static function verifyToken($token) {
        if (!$token || !SessionHelper::exists('csrf_token')) {
            return false;
        }
        
        return hash_equals(SessionHelper::get('csrf_token'), $token);
    }
    
    // Get CSRF token field
    public static function getTokenField() {
        $token = self::generateToken();
        return '<input type="hidden" name="csrf_token" value="' . $token . '">';
    }
}
?>