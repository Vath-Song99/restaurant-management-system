<?php
require_once '../models/Menu.php';

class MenuController {
    public function showMenu() {
        $menu = new Menu();
        $items = $menu->getAllMenuItems();
        require '../views/menu.php';
    }
}
?>
