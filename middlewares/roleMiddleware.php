<?php
class RoleMiddleware {
    public static function hasRole($required_role_id) {
        AuthMiddleware::isLoggedIn();
        
        if (SessionHelper::get('user_role_id') != $required_role_id) {
            self::forbidden();
        }
    }
    
    public static function hasPermission($permission_name) {
        AuthMiddleware::isLoggedIn();
        
        $role = new Role();
        if (!$role->userHasPermission(SessionHelper::get('user_id'), $permission_name)) {
            self::forbidden();
        }
    }
    
    private static function forbidden() {
        header('Location: ' . BASE_URL . '/errors/403');
        exit;
    }
}
?>
