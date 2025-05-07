<?php 
class OrderItem {
    private $db;
    private $table = 'order_items';
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function getByOrderId($orderId) {
        $this->db->query("SELECT oi.*, m.name as menu_name, m.image 
                         FROM {$this->table} oi 
                         JOIN menu m ON oi.menu_id = m.id 
                         WHERE oi.order_id = :order_id");
        $this->db->bind(':order_id', $orderId);
        return $this->db->resultSet();
    }

    public function getByMenuId($menuId) {
        $this->db->query("SELECT * FROM {$this->table} WHERE menu_id = :menu_id");
        $this->db->bind(':menu_id', $menuId);
        return $this->db->resultSet();
    }
    
    public function create($orderId, $menuId, $quantity, $price) {
        $this->db->query("INSERT INTO {$this->table} (order_id, menu_id, quantity, price) 
                         VALUES (:order_id, :menu_id, :quantity, :price)");
        
        $this->db->bind(':order_id', $orderId);
        $this->db->bind(':menu_id', $menuId);
        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':price', $price);
        
        return $this->db->execute();
    }
    
    public function update($id, $quantity) {
        $this->db->query("UPDATE {$this->table} SET quantity = :quantity WHERE id = :id");
        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
    
    public function delete($id) {
        $this->db->query("DELETE FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}