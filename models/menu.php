<?php
require_once '../config/database.php';

class Menu {
    public function getAllMenuItems() {
        global $conn;
        $result = $conn->query("SELECT * FROM menu");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
