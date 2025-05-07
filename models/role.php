<?php

class Role {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    // Get all Roles
    public function getRoles() {
        $this->db->query('SELECT * FROM roles ORDER BY id');
        return $this->db->resultSet();
    }
    
    // Get role by ID
    public function getRoleById($id) {
        $this->db->query('SELECT * FROM roles WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    // Get Permissions for role
    public function getRolePermissions($role_id) {
        $this->db->query('SELECT p.* FROM permissions p
                        JOIN role_permissions rp ON p.id = rp.permission_id
                        WHERE rp.role_id = :role_id');
        $this->db->bind(':role_id', $role_id);
        return $this->db->resultSet();
    }
    
    // Check if user has permission
    public function userHasPermission($user_id, $permission_name) {
        $this->db->query('SELECT COUNT(*) as count FROM users u
                        JOIN roles r ON u.role_id = r.id
                        JOIN role_permissions rp ON r.id = rp.role_id
                        JOIN permissions p ON rp.permission_id = p.id
                        WHERE u.id = :user_id AND p.permission_name = :permission_name');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':permission_name', $permission_name);
        
        $result = $this->db->single();
        return $result->count > 0;
    }
}
?>