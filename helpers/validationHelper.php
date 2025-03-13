<?php 
  

class ValidationHelper {
    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    public static function validatePassword($password) {
        // Minimum 8 characters, at least one uppercase letter, one lowercase letter, and one number
        return strlen($password) >= 8 && 
               preg_match('/[A-Z]/', $password) && 
               preg_match('/[a-z]/', $password) && 
               preg_match('/[0-9]/', $password);
    }
    
    public static function sanitizeInput($input) {
        if (is_array($input)) {
            foreach ($input as $key => $value) {
                $input[$key] = self::sanitizeInput($value);
            }
        } else {
            $input = trim(htmlspecialchars($input, ENT_QUOTES, 'UTF-8'));
        }
        
        return $input;
    }
}

?>