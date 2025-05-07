<?php

class CartController {
    private $menuModel;
    
    public function __construct() {
        $this->menuModel = new MenuItem();
        
        // Initialize cart if not exists
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }
    
    public function viewCart() {
        $cartItems = [];
        $totalPrice = 0;
        
        foreach ($_SESSION['cart'] as $item) {
            $menuItem = $this->menuModel->getById($item['menu_id']);
            if ($menuItem) {
                $cartItem = [
                    'id' => $item['menu_id'],
                    'name' => $menuItem['name'],
                    'price' => $menuItem['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $menuItem['price'] * $item['quantity'],
                    'image' => $menuItem['image']
                ];
                
                $cartItems[] = $cartItem;
                $totalPrice += $cartItem['subtotal'];
            }
        }
        
        include 'views/cart.php';
    }
    
    public function addToCart() {
        $menuId = intval($_POST['menu_id']);
        $quantity = intval($_POST['quantity'] ?? 1);
        
        if ($quantity <= 0) {
            $quantity = 1;
        }
        
        $menuItem = $this->menuModel->getById($menuId);
        
        if (!$menuItem || !$menuItem['available']) {
            $_SESSION['error'] = "Item not available";
            header('Location: index.php?page=menu');
            return;
        }
        
        // Check if item already exists in cart
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['menu_id'] == $menuId) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }
        
        if (!$found) {
            $_SESSION['cart'][] = [
                'menu_id' => $menuId,
                'quantity' => $quantity
            ];
        }
        
        $_SESSION['success'] = $menuItem['name'] . " added to cart";
        header('Location: index.php?page=cart');
    }
    
    public function updateCart() {
        $menuId = intval($_POST['menu_id']);
        $quantity = intval($_POST['quantity']);
        
        if ($quantity <= 0) {
            // Remove item from cart
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['menu_id'] == $menuId) {
                    unset($_SESSION['cart'][$key]);
                    break;
                }
            }
            // Re-index the array
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        } else {
            // Update quantity
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['menu_id'] == $menuId) {
                    $item['quantity'] = $quantity;
                    break;
                }
            }
        }
        
        $_SESSION['success'] = "Cart updated";
        header('Location: index.php?page=cart');
    }
    
    public function removeFromCart($menuId) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['menu_id'] == $menuId) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
        
        // Re-index the array
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        
        $_SESSION['success'] = "Item removed from cart";
        header('Location: index.php?page=cart');
    }
    
    public function clearCart() {
        $_SESSION['cart'] = [];
        $_SESSION['success'] = "Cart cleared";
        header('Location: index.php?page=cart');
    }
    
    public function checkout() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Please login to checkout";
            header('Location: index.php?page=login');
            return;
        }
        
        // Check if cart is empty
        if (empty($_SESSION['cart'])) {
            $_SESSION['error'] = "Your cart is empty";
            header('Location: index.php?page=menu');
            return;
        }
        
        include 'views/checkout.php';
    }
}