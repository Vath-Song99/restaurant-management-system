<?php
class Permission {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    // Get all Permissions
    public function getPermissions() {
        $this->db->query('SELECT * FROM Permissions ORDER BY permission_name');
        return $this->db->resultSet();
    }
    
    // Get permission by ID
    public function getPermissionById($id) {
        $this->db->query('SELECT * FROM Permissions WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    // Add permission to role
    public function addPermissionToRole($role_id, $permission_id) {
        $this->db->query('INSERT INTO Role_Permissions (role_id, permission_id) VALUES (:role_id, :permission_id)');
        $this->db->bind(':role_id', $role_id);
        $this->db->bind(':permission_id', $permission_id);
        return $this->db->execute();
    }
    
    // Remove permission from role
    public function removePermissionFromRole($role_id, $permission_id) {
        $this->db->query('DELETE FROM Role_Permissions WHERE role_id = :role_id AND permission_id = :permission_id');
        $this->db->bind(':role_id', $role_id);
        $this->db->bind(':permission_id', $permission_id);
        return $this->db->execute();
    }
}
?>