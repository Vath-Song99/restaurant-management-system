<?php
class MenuController {
    private $menuModel;
    private $categoryModel;
    
    public function __construct() {

        $this->menuModel = new Menu();
        $this->categoryModel = new Category();
    }
    
    public function index() {
        $menuItems = $this->menuModel->getAll();
        include 'views/admin/menu/index.php';
    }
    
    public function create() {
        $categories = $this->categoryModel->getAll();
        include 'views/admin/menu/create.php';
    }

    public function getMenuByCategory($categoryId)
    {        
        // This method will be called via AJAX to load menu items when category is changed
        $menuItems = $this->menuModel->getByCategory($categoryId);

        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode($menuItems);
        exit;
    }
    
    public function store() {
        $data = [
            'name' => trim($_POST['name']),
            'description' => trim($_POST['description']),
            'price' => floatval($_POST['price']),
            'category_id' => intval($_POST['category_id']),
            'available' => isset($_POST['available']) ? 1 : 0,
            'image' => ''
        ];
        
        if (empty($data['name']) || $data['price'] <= 0) {
            $_SESSION['error'] = "Name and price are required";
            header('Location: index.php?page=menu/create');
            return;
        }
        
        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'assets/uploads/menu/';
            $fileName = time() . '_' . basename($_FILES['image']['name']);
            $targetFilePath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                $data['image'] = $fileName;
            } else {
                $_SESSION['error'] = "Failed to upload image";
                header('Location: index.php?page=menu/create');
                return;
            }
        }
        
        if ($this->menuModel->create($data)) {
            $_SESSION['success'] = "Menu item created successfully";
            header('Location: index.php?page=menu');
        } else {
            $_SESSION['error'] = "Failed to create menu item";
            header('Location: index.php?page=menu/create');
        }
    }
    
    public function edit($id) {
        $menuItem = $this->menuModel->getById($id);
        
        if (!$menuItem) {
            $_SESSION['error'] = "Menu item not found";
            header('Location: index.php?page=menu');
            return;
        }
        
        $categories = $this->categoryModel->getAll();
        include 'views/admin/menu/edit.php';
    }
    
    public function update($id) {
        $menuItem = $this->menuModel->getById($id);
        
        if (!$menuItem) {
            $_SESSION['error'] = "Menu item not found";
            header('Location: index.php?page=menu');
            return;
        }
        
        $data = [
            'name' => trim($_POST['name']),
            'description' => trim($_POST['description']),
            'price' => floatval($_POST['price']),
            'category_id' => intval($_POST['category_id']),
            'available' => isset($_POST['available']) ? 1 : 0,
            'image' => $menuItem['image']
        ];
        
        if (empty($data['name']) || $data['price'] <= 0) {
            $_SESSION['error'] = "Name and price are required";
            header('Location: index.php?page=menu/edit&id=' . $id);
            return;
        }
        
        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'assets/uploads/menu/';
            $fileName = time() . '_' . basename($_FILES['image']['name']);
            $targetFilePath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                // Delete old image if exists
                if (!empty($menuItem['image']) && file_exists($uploadDir . $menuItem['image'])) {
                    unlink($uploadDir . $menuItem['image']);
                }
                $data['image'] = $fileName;
            } else {
                $_SESSION['error'] = "Failed to upload image";
                header('Location: index.php?page=menu/edit&id=' . $id);
                return;
            }
        }
        
        if ($this->menuModel->update($id, $data)) {
            $_SESSION['success'] = "Menu item updated successfully";
            header('Location: index.php?page=menu');
        } else {
            $_SESSION['error'] = "Failed to update menu item";
            header('Location: index.php?page=menu/edit&id=' . $id);
        }
    }
    
    public function delete($id) {
        $menuItem = $this->menuModel->getById($id);
        
        if (!$menuItem) {
            $_SESSION['error'] = "Menu item not found";
            header('Location: index.php?page=menu');
            return;
        }
        
        // Delete image file if exists
        if (!empty($menuItem['image'])) {
            $imagePath = 'assets/uploads/menu/' . $menuItem['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        
        if ($this->menuModel->delete($id)) {
            $_SESSION['success'] = "Menu item deleted successfully";
        } else {
            $_SESSION['error'] = "Failed to delete menu item";
        }
        
        header('Location: index.php?page=menu');
    }
    
    public function toggleAvailability($id) {
        $menuItem = $this->menuModel->getById($id);
        
        if (!$menuItem) {
            $_SESSION['error'] = "Menu item not found";
            header('Location: index.php?page=menu');
            return;
        }
        
        $newStatus = !$menuItem['available'];
        
        if ($this->menuModel->toggleAvailability($id, $newStatus)) {
            $_SESSION['success'] = "Menu item availability updated";
        } else {
            $_SESSION['error'] = "Failed to update availability";
        }
        
        header('Location: index.php?page=menu');
    }
    
    // Public methods for frontend
    public function menuPage() {
        $categories = $this->categoryModel->getAll();
        $menuItems = [];
        
        foreach ($categories as $category) {
            $menuItems[$category['id']] = [
                'name' => $category['name'],
                'items' => $this->menuModel->getByCategory($category['id'])
            ];
        }
        
        include 'views/menu.php';
    }
}