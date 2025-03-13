<?php
  
class FlashHelper {
    // Set flash message
    public static function setFlash($name, $message, $class = 'alert alert-success') {
        SessionHelper::set('flash_' . $name, [
            'message' => $message,
            'class' => $class
        ]);
    }
    
    // Display flash message
    public static function flash($name) {
        if (SessionHelper::exists('flash_' . $name)) {
            $flash = SessionHelper::get('flash_' . $name);
            SessionHelper::remove('flash_' . $name);
            
            return '<div class="' . $flash['class'] . ' alert-dismissible fade show" role="alert">
                        ' . $flash['message'] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
        
        return '';
    }
}

?>