<?php

class DashboardController extends BaseController  {
    private $roleModel;
    private $menuModel;
    private $categoryModel;
    private $orderModel;
    private $staffModel;
    public function __construct() {
        $this->roleModel = new Role();
        $this->menuModel = new Menu();
        $this->categoryModel = new Category();
        $this->orderModel = new Order();
        $this->staffModel = new Staff();
    }
    
    // Display dashboard
    public function index() {
        AuthMiddleware::isLoggedIn();
        RoleMiddleware::hasPermission('view_dashboard');
        
        $this->data['totalMenuItems'] = $this->menuModel->count();
        $this->data['totalCategories'] = $this->categoryModel->count();
        $this->data['totalOrders'] = $this->orderModel->count();
        $this->data['totalStaff'] = $this->staffModel->count();
        // Get recent orders
        $this->data['recentOrders'] = $this->orderModel->getRecent(5);
        
        // Get order stats
        $this->data['orderStats'] = $this->orderModel->getStatsByStatus();
        
        // Get popular menu items
        $this->data['popularItems'] = $this->menuModel->getPopular(9);
        
        $this->render('dashboard');
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