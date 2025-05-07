<?php

class User {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    // Register user
    public function register($data) {
        // Prepare query
        $this->db->query('INSERT INTO users (name, email, password, role_id, is_active) VALUES (:name, :email, :password, :role_id, :is_active)');
        
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':role_id', $data['role_id']);
        $this->db->bind(':is_active', $data['is_active']);
        
        // Execute
        if($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    public function getAll() {
        $this->db->query('SELECT * FROM users ORDER BY created_at DESC');
        return $this->db->resultSet();
    }
    
    // Find user by email
    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        
        $row = $this->db->single();
        
        // Check row
        if($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
    
    // Find user by ID
    public function findUserById($id) {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        
        $row = $this->db->single();
        
        // Check row
        if($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function findUserByToken($token) {
        $this->db->query('SELECT * FROM users WHERE login_token = :login_token');
        $this->db->bind(':login_token', $token);
        
        $row = $this->db->single();
        
        // Check row
        if($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
    
    // Get users with role info
    public function getUsers() {
        $this->db->query('SELECT u.*, r.role_name, r.description AS role_description 
                 FROM users u 
                 LEFT JOIN roles r ON u.role_id = r.id
                 ORDER BY u.created_at DESC');
        
        return $this->db->resultSet();
    }

    public function updateUserById($id, $data) {
        $this->db->query('UPDATE users SET name = :name, email = :email, role_id = :role_id, is_active = :is_active WHERE id = :id');
        
        // Bind values
        $this->db->bind(':id', $id);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':role_id', $data['role_id']);
        $this->db->bind(':is_active', $data['is_active']);
        
        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateQrcode($id, $qrcode) {
        $this->db->query('UPDATE users SET login_qrcode = :qrcode WHERE id = :id');
        
        // Bind values
        $this->db->bind(':id', $id);
        $this->db->bind(':qrcode', $qrcode);
        
        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateLoginToken($id, $token) {
        $this->db->query('UPDATE users SET login_token = :token WHERE id = :id');
        
        // Bind values
        $this->db->bind(':id', $id);
        $this->db->bind(':token', $token);
        
        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Update user
    public function updateUser($data) {
        // Check if password is being updated
        if(!empty($data['password'])) {
            $this->db->query('UPDATE users SET name = :name, email = :email, password = :password, role_id = :role_id, is_active = :is_active WHERE id = :id');
            $this->db->bind(':password', $data['password']);
        } else {
            $this->db->query('UPDATE users SET name = :name, email = :email, role_id = :role_id, is_active = :is_active WHERE id = :id');
        }
        
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':role_id', $data['role_id']);
        $this->db->bind(':is_active', $data['is_active']);
        
        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Delete user
    public function deleteUser($id) {
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        
        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Update last login
    public function updateLastLogin($id) {
        $this->db->query('UPDATE users SET last_login = NOW() WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
    
    // Store password reset token
    public function storeResetToken($email, $token) {
        $this->db->query('UPDATE users SET reset_token = :token, reset_token_expires_at = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = :email');
        $this->db->bind(':email', $email);
        $this->db->bind(':token', $token);
        return $this->db->execute();
    }
    
    // Verify reset token
    public function verifyResetToken($token) {
        $this->db->query('SELECT * FROM users WHERE reset_token = :token AND reset_token_expires_at > NOW()');
        $this->db->bind(':token', $token);
        
        $row = $this->db->single();
        
        if($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
    
    // Reset password
    public function resetPassword($user_id, $password) {
        $this->db->query('UPDATE users SET password = :password, reset_token = NULL, reset_token_expires_at = NULL WHERE id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':password', $password);
        return $this->db->execute();
    }
}
?>