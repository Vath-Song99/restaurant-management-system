<?php
class UserController {
    private $userModel;
    private $roleModel;
    
    public function __construct() {
        $this->userModel = new User();
        $this->roleModel = new Role();
    }
    
    // Add user (admin only)
    public function add() {
        // Check if user is admin
        RoleMiddleware::hasRole(1);
        
        // Check permission
        RoleMiddleware::hasPermission('manage_users');
        
        // Handle POST request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = ValidationHelper::sanitizeInput($_POST);
            
            // Validate CSRF token
            if (!CSRFHelper::verifyToken($_POST['csrf_token'])) {
                FlashHelper::setFlash('error', 'Security token validation failed. Please try again.', 'alert alert-danger');
                header('Location: ' . BASE_URL . '/dashboard/users');
                exit;
            }
            
            // Validate form data
            $errors = [];
            
            if (empty($_POST['name'])) {
                $errors[] = 'Name is required';
            }
            
            if (empty($_POST['email']) || !ValidationHelper::validateEmail($_POST['email'])) {
                $errors[] = 'Valid email is required';
            } else if ($this->userModel->findUserByEmail($_POST['email'])) {
                $errors[] = 'Email already exists';
            }
            
            if (empty($_POST['password']) || !ValidationHelper::validatePassword($_POST['password'])) {
                $errors[] = 'Password must be at least 8 characters long and contain uppercase, lowercase and numbers';
            }
            
            if (empty($_POST['confirm_password']) || $_POST['password'] != $_POST['confirm_password']) {
                $errors[] = 'Passwords do not match';
            }
            
            if (empty($_POST['role_id'])) {
                $errors[] = 'Role is required';
            }
            
            // Check for errors
            if (!empty($errors)) {
                $_SESSION['form_errors'] = $errors;
                $_SESSION['form_data'] = $_POST;
                header('Location: ' . BASE_URL . '/dashboard/users');
                exit;
            }
            
            // Hash password
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            // Prepare data
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $password,
                'role_id' => $_POST['role_id']
            ];
            
            // Add user
            if ($this->userModel->register($data)) {
                FlashHelper::setFlash('success', 'User added successfully', 'alert alert-success');
                header('Location: ' . BASE_URL . '/dashboard/users');
                exit;
            } else {
                FlashHelper::setFlash('error', 'Failed to add user', 'alert alert-danger');
                header('Location: ' . BASE_URL . '/dashboard/users');
                exit;
            }
        } else {
            header('Location: ' . BASE_URL . '/dashboard/users');
            exit;
        }
    }
    
    // Edit user (admin only)
    public function edit($id = null) {
        // Check if user is admin
        RoleMiddleware::hasRole(1);
        
        // Check permission
        RoleMiddleware::hasPermission('manage_users');
        
        if (!$id) {
            FlashHelper::setFlash('error', 'User ID is required', 'alert alert-danger');
            header('Location: ' . BASE_URL . '/dashboard/users');
            exit;
        }
        
        // Handle POST request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = ValidationHelper::sanitizeInput($_POST);
            
            // Validate CSRF token
            if (!CSRFHelper::verifyToken($_POST['csrf_token'])) {
                FlashHelper::setFlash('error', 'Security token validation failed. Please try again.', 'alert alert-danger');
                header('Location: ' . BASE_URL . '/dashboard/users');
                exit;
            }
            
            // Validate form data
            $errors = [];
            
            if (empty($_POST['name'])) {
                $errors[] = 'Name is required';
            }
            
            $user = $this->userModel->findUserById($id);
            
            if (empty($_POST['email']) || !ValidationHelper::validateEmail($_POST['email'])) {
                $errors[] = 'Valid email is required';
            } else if ($_POST['email'] != $user->email && $this->userModel->findUserByEmail($_POST['email'])) {
                $errors[] = 'Email already exists';
            }
            
            // Password is optional when editing
            if (!empty($_POST['password'])) {
                if (!ValidationHelper::validatePassword($_POST['password'])) {
                    $errors[] = 'Password must be at least 8 characters long and contain uppercase, lowercase and numbers';
                }
                
                if (empty($_POST['confirm_password']) || $_POST['password'] != $_POST['confirm_password']) {
                    $errors[] = 'Passwords do not match';
                }
            }
            
            if (empty($_POST['role_id'])) {
                $errors[] = 'Role is required';
            }
            
            // Check for errors
            if (!empty($errors)) {
                $_SESSION['form_errors'] = $errors;
                $_SESSION['form_data'] = $_POST;
                header('Location: ' . BASE_URL . '/user/edit/' . $id);
                exit;
            }
            
            // Prepare data
            $data = [
                'id' => $id,
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'role_id' => $_POST['role_id'],
                'is_active' => isset($_POST['is_active']) ? 1 : 0
            ];
            
            // Add password if set
            if (!empty($_POST['password'])) {
                $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }
            
            // Update user
            if ($this->userModel->updateUser($data)) {
                FlashHelper::setFlash('success', 'User updated successfully', 'alert alert-success');
                header('Location: ' . BASE_URL . '/dashboard/users');
                exit;
            } else {
                FlashHelper::setFlash('error', 'Failed to update user', 'alert alert-danger');
                header('Location: ' . BASE_URL . '/user/edit/' . $id);
                exit;
            }
        } else {
            // Get user
            $user = $this->userModel->findUserById($id);
            
            if (!$user) {
                FlashHelper::setFlash('error', 'User not found', 'alert alert-danger');
                header('Location: ' . BASE_URL . '/dashboard/users');
                exit;
            }
            
            // Get all roles
            $roles = $this->roleModel->getRoles();
            
            // Get permissions for sidebar
            $permissions = $this->roleModel->getRolePermissions(SessionHelper::get('user_role_id'));
            
            // Load the view
            require_once APP_ROOT . '/views/dashboard/edit_user.php';
        }
    }
    
    // Delete user (admin only)
    public function delete($id = null) {
        // Check if user is admin
        RoleMiddleware::hasRole(1);
        
        // Check permission
        RoleMiddleware::hasPermission('manage_users');
        
        if (!$id) {
            FlashHelper::setFlash('error', 'User ID is required', 'alert alert-danger');
            header('Location: ' . BASE_URL . '/dashboard/users');
            exit;
        }
        
        // Prevent self-deletion
        if ($id == SessionHelper::get('user_id')) {
            FlashHelper::setFlash('error', 'You cannot delete your own account', 'alert alert-danger');
            header('Location: ' . BASE_URL . '/dashboard/users');
            exit;
        }
        
        // Delete user
        if ($this->userModel->deleteUser($id)) {
            FlashHelper::setFlash('success', 'User deleted successfully', 'alert alert-success');
            header('Location: ' . BASE_URL . '/dashboard/users');
            exit;
        } else {
            FlashHelper::setFlash('error', 'Failed to delete user', 'alert alert-danger');
            header('Location: ' . BASE_URL . '/dashboard/users');
            exit;
        }
    }
}
?>