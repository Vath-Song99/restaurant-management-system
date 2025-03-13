<?php

class MenuController {
    public function showMenu() {
        $menu = new Menu();
        $items = $menu->getAllMenuItems();
        require '../views/menu.php';
    }
}
?>
