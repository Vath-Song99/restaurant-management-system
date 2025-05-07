<?php
// controllers/CategoryController.php

class CategoryController extends BaseController {
    public function index() {
        $categoryModel = new Category();
        
        // Get all categories
        $this->data['categories'] = $categoryModel->getAll();
        
        // Get flash message if exists
        $this->data['flash'] = $this->getFlash();
        
        $this->render('categories/index');
    }
    
    public function create() {
        // Check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = [
                'name' => trim($_POST['name'] ?? ''),
                'description' => trim($_POST['description'] ?? '')
            ];
            
            // Validate input
            $errors = $this->validate($category, [
                'name' => 'required|max:50',
                'description' => 'max:255'
            ]);
            
            if (empty($errors)) {
                $categoryModel = new Category();
                if ($categoryModel->create($category)) {
                    $this->setFlash('success', 'Category created successfully');
                    $this->redirect('categories');
                } else {
                    $this->setFlash('danger', 'Error creating category');
                    $this->data['category'] = $category;
                    $this->data['errors'] = $errors;
                    $this->render('categories/create');
                }
            } else {
                $this->data['category'] = $category;
                $this->data['errors'] = $errors;
                $this->render('categories/create');
            }
        } else {
            // Display the create form
            $this->data['category'] = [
                'name' => '',
                'description' => ''
            ];
            $this->data['errors'] = [];
            $this->render('categories/create');
        }
    }
    
    public function edit() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if (!$id) {
            $this->setFlash('danger', 'Invalid category ID');
            $this->redirect('categories');
        }
        
        $categoryModel = new Category();
        $category = $categoryModel->getById($id);
        
        if (!$category) {
            $this->setFlash('danger', 'Category not found');
            $this->redirect('categories');
        }
        
        // Check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = [
                'id' => $id,
                'name' => trim($_POST['name'] ?? ''),
                'description' => trim($_POST['description'] ?? '')
            ];
            
            // Validate input
            $errors = $this->validate($category, [
                'name' => 'required|max:50',
                'description' => 'max:255'
            ]);
            
            if (empty($errors)) {
                if ($categoryModel->update($category)) {
                    $this->setFlash('success', 'Category updated successfully');
                    $this->redirect('categories');
                } else {
                    $this->setFlash('danger', 'Error updating category');
                    $this->data['category'] = $category;
                    $this->data['errors'] = $errors;
                    $this->render('categories/edit');
                }
            } else {
                $this->data['category'] = $category;
                $this->data['errors'] = $errors;
                $this->render('categories/edit');
            }
        } else {
            // Display the edit form
            $this->data['category'] = $category;
            $this->data['errors'] = [];
            $this->render('categories/edit');
        }
    }
    
    public function delete() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if (!$id) {
            $this->setFlash('danger', 'Invalid category ID');
            $this->redirect('categories');
        }
        
        // Check if form was submitted (confirmation)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryModel = new Category();
            
            if ($categoryModel->delete($id)) {
                $this->setFlash('success', 'Category deleted successfully');
            } else {
                $this->setFlash('danger', 'Error deleting category');
            }
            
            $this->redirect('categories');
        } else {
            // Display the confirmation form
            $categoryModel = new Category();
            $category = $categoryModel->getById($id);
            
            if (!$category) {
                $this->setFlash('danger', 'Category not found');
                $this->redirect('categories');
            }
            
            $this->data['category'] = $category;
            $this->render('categories/delete');
        }
    }
}
?>