<?php

class DashboardController {
    private $roleModel;
    
    public function __construct() {
        $this->roleModel = new Role();
    }
    
    // Display dashboard
    public function index() {
        // Check if user is logged in
        AuthMiddleware::isLoggedIn();
        
        // Check permission
        RoleMiddleware::hasPermission('view_dashboard');
        
        // Get user role permissions for sidebar menu
        $permissions = $this->roleModel->getRolePermissions(SessionHelper::get('user_role_id'));
        
        // Determine which dashboard to show based on role
        $role_id = SessionHelper::get('user_role_id');
        
        switch ($role_id) {
            case 1:
            require_once APP_ROOT . '/views/dashboard/admin.php';
            break;
            case 2: 
            require_once APP_ROOT . '/views/dashboard/manager.php';
            break;
            default: 
            require_once APP_ROOT . '/views/dashboard/staff.php';
            break;
        }
    }
    
    // Display user management page (admin only)
    public function users() {
        // Check if user is admin
        RoleMiddleware::hasRole(1);
        
        // Check permission
        RoleMiddleware::hasPermission('manage_users');
        
        $userModel = new User();
        $roleModel = new Role();
        
        // Get all users
        $users = $userModel->getUsers();
        
        // Get all roles
        $roles = $roleModel->getRoles();
        
        // Get permissions for sidebar
        $permissions = $this->roleModel->getRolePermissions(SessionHelper::get('user_role_id'));
        
        // Load the view
        require_once APP_ROOT . '/views/dashboard/users.php';
    }
}
?>