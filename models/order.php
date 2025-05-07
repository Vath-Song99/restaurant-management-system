<?php

class Order {
    private $db;
    private $table = 'orders';
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function getAll() {
        $this->db->query("SELECT o.*, u.name as user_name 
                         FROM {$this->table} o 
                         LEFT JOIN users u ON o.user_id = u.id 
                         ORDER BY o.created_at DESC");
        return $this->db->resultSet();
    }
    
    public function getById($id) {
        $this->db->query("SELECT o.*, u.name as user_name 
                         FROM {$this->table} o 
                         LEFT JOIN users u ON o.user_id = u.id 
                         WHERE o.id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function getByUserId($userId) {
        $this->db->query("SELECT * FROM {$this->table} WHERE user_id = :user_id ORDER BY created_at DESC");
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }
    
    public function getByStatus($status) {
        $this->db->query("SELECT o.*, u.name as user_name 
                         FROM {$this->table} o 
                         LEFT JOIN users u ON o.user_id = u.id 
                         WHERE o.status = :status 
                         ORDER BY o.created_at DESC");
        $this->db->bind(':status', $status);
        return $this->db->resultSet();
    }
    
    public function create($userId, $totalPrice) {
        $this->db->query("INSERT INTO {$this->table} (user_id, total_price, status) VALUES (:user_id, :total_price, 'pending')");
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':total_price', $totalPrice);
        
        if($this->db->execute()){
            return $this->db->lastInsertId();
        }
        
        return false;
    }
    
    public function updateStatus($id, $status) {
        $this->db->query("UPDATE {$this->table} SET status = :status WHERE id = :id");
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
    
    public function delete($id) {
        // Transaction to delete order items first, then the order
        $this->db->beginTransaction();
        
        try {
            // Delete related order items
            $this->db->query("DELETE FROM order_items WHERE order_id = :order_id");
            $this->db->bind(':order_id', $id);
            $this->db->execute();
            
            // Delete the order
            $this->db->query("DELETE FROM {$this->table} WHERE id = :id");
            $this->db->bind(':id', $id);
            $this->db->execute();
            
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollback();
            error_log('Order deletion error: ' . $e->getMessage());
            return false;
        }
    }

    public function count() {
        $this->db->query("SELECT COUNT(*) as count FROM {$this->table}");
        $result = $this->db->single();
        return $result->count;
    }

    public function getRecent($limit = 5) {
        $this->db->query("SELECT o.*, u.name as user_name 
                         FROM {$this->table} o 
                         LEFT JOIN users u ON o.user_id = u.id 
                         ORDER BY o.created_at DESC LIMIT :limit");
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function getStatsByStatus() {
        $this->db->query("SELECT status, COUNT(*) as value 
                 FROM {$this->table} 
                 GROUP BY status");
        $results = $this->db->resultSet();
        $orderStats = [];
        foreach ($results as $row) {
            $orderStats[$row->status] = $row->value;
        }
        return $orderStats;
    }
}