<?php
class Contact {
    private $db;
    private $table = 'contacts';
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function getAll() {
        $this->db->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
        return $this->db->resultSet();
    }
    
    public function getById($id) {
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function create($data) {
        $this->db->query("INSERT INTO {$this->table} (name, email, subject, message) VALUES (:name, :email, :subject, :message)");
        
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':subject', $data['subject'] ?? null);
        $this->db->bind(':message', $data['message']);
        
        return $this->db->execute();
    }
    
    public function delete($id) {
        $this->db->query("DELETE FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
?>