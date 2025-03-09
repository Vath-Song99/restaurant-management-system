<?php
$request = $_GET['page'] ?? 'home';

switch ($request) {
    case 'menu':
        require __DIR__ . '/../controllers/MenuController.php';
        $menuController = new MenuController();
        $menuController->showMenu();
        break;
    case 'orders':
        require __DIR__ . '/../controllers/OrderController.php';
        $orderController = new OrderController();
        $orderController->showOrders();
        break;
    default:
        require __DIR__ . '/../views/home.php';
        break;
}
?>
