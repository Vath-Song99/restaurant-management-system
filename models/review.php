<?php
class Review {
    private $db;
    private $table = 'reviews';
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function getAll() {
        $this->db->query("SELECT r.*, u.name as user_name 
                         FROM {$this->table} r 
                         LEFT JOIN users u ON r.user_id = u.id 
                         ORDER BY r.created_at DESC");
        return $this->db->resultSet();
    }
    
    public function getById($id) {
        $this->db->query("SELECT r.*, u.name as user_name 
                         FROM {$this->table} r 
                         LEFT JOIN users u ON r.user_id = u.id 
                         WHERE r.id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function getByUserId($userId) {
        $this->db->query("SELECT * FROM {$this->table} WHERE user_id = :user_id ORDER BY created_at DESC");
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }
    
    public function getAverageRating() {
        $this->db->query("SELECT AVG(rating) as average_rating FROM {$this->table}");
        $result = $this->db->single();
        return $result->average_rating ?? 0;
    }
    
    public function create($userId, $rating, $comment) {
        $this->db->query("INSERT INTO {$this->table} (user_id, rating, comment) VALUES (:user_id, :rating, :comment)");
        
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':rating', $rating);
        $this->db->bind(':comment', $comment);
        
        return $this->db->execute();
    }
    
    public function update($id, $rating, $comment) {
        $this->db->query("UPDATE {$this->table} SET rating = :rating, comment = :comment WHERE id = :id");
        
        $this->db->bind(':rating', $rating);
        $this->db->bind(':comment', $comment);
        $this->db->bind(':id', $id);
        
        return $this->db->execute();
    }
    
    public function delete($id) {
        $this->db->query("DELETE FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}