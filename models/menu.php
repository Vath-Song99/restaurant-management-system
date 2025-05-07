<?php

class Menu {
    private $db;
    private $table = 'menu';
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function getAll() {
        $this->db->query("SELECT m.*, c.name as category_name 
                         FROM {$this->table} m 
                         LEFT JOIN categories c ON m.category_id = c.id 
                         ORDER BY m.category_id, m.name");
        return $this->db->resultSet();
    }
    
    public function getById($id) {
        $this->db->query("SELECT m.*, c.name as category_name 
                         FROM {$this->table} m 
                         LEFT JOIN categories c ON m.category_id = c.id 
                         WHERE m.id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function getByCategory($categoryId) {
        $this->db->query("SELECT * FROM {$this->table} WHERE category_id = :category_id AND available = true ORDER BY name");
        $this->db->bind(':category_id', $categoryId);
        return $this->db->resultSet();
    }

    public function search($query) {
        $this->db->query("SELECT m.*, c.name as category_name 
                         FROM {$this->table} m 
                         LEFT JOIN categories c ON m.category_id = c.id 
                         WHERE m.name LIKE :query OR c.name LIKE :query 
                         ORDER BY m.category_id, m.name");
        $this->db->bind(':query', '%' . $query . '%');
        return $this->db->resultSet();
    }
    
    public function create($data) {
        $this->db->query("INSERT INTO {$this->table} (name, description, price, image, category_id, available) 
                         VALUES (:name, :description, :price, :image, :category_id, :available)");
        
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':available', $data['available'] ?? true);
        
        return $this->db->execute();
    }
    
    public function update($id, $data) {
        $this->db->query("UPDATE {$this->table} 
                         SET name = :name, description = :description, price = :price, 
                             image = :image, category_id = :category_id, available = :available 
                         WHERE id = :id");
        
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':available', $data['available'] ?? true);
        $this->db->bind(':id', $id);
        
        return $this->db->execute();
    }
    
    public function delete($id) {
        $this->db->query("DELETE FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
    
    public function toggleAvailability($id, $available) {
        $this->db->query("UPDATE {$this->table} SET available = :available WHERE id = :id");
        $this->db->bind(':available', $available);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function count() {
        $this->db->query("SELECT COUNT(*) as count FROM {$this->table}");
        $result = $this->db->single();
        return $result->count;
    }

    public function getPopular($limit = 5) {
        $this->db->query("SELECT m.*, COUNT(oi.id) as order_count 
                         FROM {$this->table} m 
                         LEFT JOIN order_items oi ON m.id = oi.menu_id 
                         GROUP BY m.id 
                         ORDER BY order_count DESC 
                         LIMIT :limit");
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }
}
?>