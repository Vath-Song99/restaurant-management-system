<?php

class Staff
{
    private $db;
    private $table = 'staff';
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $this->db->query("SELECT * FROM {$this->table} ORDER BY id");
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data)
    {
        $this->db->query("INSERT INTO {$this->table} (name, email, phone, address, position, salary, hire_date, status, image) 
                          VALUES (:name, :email, :phone, :address, :position, :salary, :hire_date, :status, :image)");

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':position', $data['position']);
        $this->db->bind(':salary', $data['salary']);
        $this->db->bind(':hire_date', $data['hire_date']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':image', $data['image']);

        return $this->db->execute();
    }

    public function update($id, $data)
    {
        $this->db->query("UPDATE {$this->table} 
                          SET name = :name, email = :email, phone = :phone, 
                              address = :address, position = :position, salary = :salary,
                              hire_date = :hire_date, status = :status, image = :image
                          WHERE id = :id");

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':position', $data['position']);
        $this->db->bind(':salary', $data['salary']);
        $this->db->bind(':hire_date', $data['hire_date']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }
    public function delete($id)
    {
        $this->db->query("DELETE FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function count()
    {
        $this->db->query("SELECT COUNT(*) as count FROM {$this->table}");
        $result = $this->db->single();
        return $result->count;
    }

    public function updateStatus($id, $status)
    {
        $this->db->query("UPDATE {$this->table} SET status = :status WHERE id = :id");
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
?>