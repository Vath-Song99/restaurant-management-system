<?php
// controllers/OrderController.php

class OrderController extends BaseController {

    private $orderModel;
    private $menuModel;
    private $categoryModel;
    private $userModel;
    private $orderItemModel;

    public function __construct() {
        AuthMiddleware::isLoggedIn();
        RoleMiddleware::hasPermission('manage_orders');
        
        $this->orderModel = new Order();
        $this->menuModel = new Menu();
        $this->categoryModel = new Category();
        $this->userModel = new User();
        $this->orderItemModel = new OrderItem();
    }

    public function index() {
        // Get all orders
        $this->data['orders'] = $this->orderModel->getAll();

        // Get flash message if exists
        $this->data['flash'] = $this->getFlash();

        $this->render('orders/index');
    }

    public function view($id) {
        if (!$id) {
            $this->setFlash('danger', 'Invalid order ID');
            $this->redirect('orders');
        }

        $order = $this->orderModel->getById($id);

        if (!$order) {
            $this->setFlash('danger', 'Order not found');
            $this->redirect('orders');
        }

        // Get order items
        $orderItems = $this->orderItemModel->getByOrderId($id);
        $this->data['order'] = $order;
        $this->data['orderItems'] = $orderItems;

        $this->render('orders/view');
    }

    public function cancel($id) {
        if (!$id) {
            $this->setFlash('danger', 'Invalid order ID');
            $this->redirect('orders');
        }

        // Check if form was submitted (confirmation)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order = $this->orderModel->getById($id);
            if($order->status == 'cancelled'){
                $this->setFlash('danger', 'Order already cancelled');
                $this->redirect('/dashboard/orders');
            }
            if($order->status == 'completed'){
                $this->setFlash('danger', 'Order already completed, cannot cancel');
                $this->redirect('/dashboard/orders');
            }
            if ($this->orderModel->updateStatus($id,$_POST['status'])) {
                $this->setFlash('success', 'Order canecl successfully');
            } else {
                $this->setFlash('danger', 'Error cancel order');
            }

            $this->redirect('/dashboard/orders');
        } else {
            // Display the confirmation form
            $order = $this->orderModel->getById($id);

            if (!$order) {
                $this->setFlash('danger', 'Order not found');
                $this->redirect('orders');
            }

            $this->data['order'] = $order;
            $this->render('orders/cancel');
        }
    }

    public function toggle($id) {
        if (!$id) {
            $this->setFlash('danger', 'Invalid order ID');
            $this->redirect('orders');
        }

        // Check if form was submitted (confirmation)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->orderModel->updateStatus($id, $_POST['status'])) {
                $this->setFlash('success', 'Order status updated successfully');
            } else {
                $this->setFlash('danger', 'Error updating order status');
            }

            $this->redirect('/dashboard/orders');
        } else {
            // Display the confirmation form
            $order = $this->orderModel->getById($id);

            if (!$order) {
                $this->setFlash('danger', 'Order not found');
                $this->redirect('orders');
            }

            $this->data['order'] = $order;
            $this->render('orders/toggle');
        }
    }
}
?>
