<?php 
class Reservation {
    private $db;
    private $table = 'reservations';
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function getAll() {
        $this->db->query("SELECT r.*, u.name as user_name, u.email as user_email 
                         FROM {$this->table} r 
                         LEFT JOIN users u ON r.user_id = u.id 
                         ORDER BY r.reservation_time");
        return $this->db->resultSet();
    }
    
    public function getById($id) {
        $this->db->query("SELECT r.*, u.name as user_name, u.email as user_email 
                         FROM {$this->table} r 
                         LEFT JOIN users u ON r.user_id = u.id 
                         WHERE r.id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function getByUserId($userId) {
        $this->db->query("SELECT * FROM {$this->table} WHERE user_id = :user_id ORDER BY reservation_time");
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }
    
    public function getByDate($date) {
        $this->db->query("SELECT * FROM {$this->table} 
                         WHERE DATE(reservation_time) = :date 
                         ORDER BY reservation_time");
        $this->db->bind(':date', $date);
        return $this->db->resultSet();
    }
    
    public function create($data) {
        $this->db->query("INSERT INTO {$this->table} (user_id, name, phone, num_guests, reservation_time, special_requests, status, email,description) 
                         VALUES (:user_id, :name, :phone, :num_guests, :reservation_time, :special_requests, :status, :email, :description)");
        
        $this->db->bind(':user_id', $data['user_id'] ?? null);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':email', $data['email'] );
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':num_guests', $data['num_guests']);
        $this->db->bind(':reservation_time', $data['reservation_time']);
        $this->db->bind(':special_requests', $data['special_requests'] ?? null);
        $this->db->bind(':status', $data['status'] ?? 'pending');
        
        return $this->db->execute();
    }
    
    public function update($id, $data) {
        $this->db->query("UPDATE {$this->table} 
                         SET name = :name, phone = :phone, num_guests = :num_guests, 
                             reservation_time = :reservation_time, special_requests = :special_requests, status = :status 
                         WHERE id = :id");
        
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':num_guests', $data['num_guests']);
        $this->db->bind(':reservation_time', $data['reservation_time']);
        $this->db->bind(':special_requests', $data['special_requests'] ?? null);
        $this->db->bind(':status', $data['status'] ?? 'pending');
        $this->db->bind(':id', $id);
        
        return $this->db->execute();
    }
    
    public function updateStatus($id, $status) {
        $this->db->query("UPDATE {$this->table} SET status = :status WHERE id = :id");
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
    
    public function delete($id) {
        $this->db->query("DELETE FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
