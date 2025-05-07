<?php
class Category {
    private $db;
    private $table = 'categories';
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function getAll() {
        $this->db->query("SELECT * FROM {$this->table} ORDER BY name");
        return $this->db->resultSet();
    }
    
    public function getById($id) {
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function create($name) {
        $this->db->query("INSERT INTO {$this->table} (name) VALUES (:name)");
        $this->db->bind(':name', $name);
        return $this->db->execute();
    }
    
    public function update($id, $name) {
        $this->db->query("UPDATE {$this->table} SET name = :name WHERE id = :id");
        $this->db->bind(':name', $name);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
    
    public function delete($id) {
        $this->db->query("DELETE FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function count() {
        $this->db->query("SELECT COUNT(*) as count FROM {$this->table}");
        $result = $this->db->single();
        return $result->count;
    }
}