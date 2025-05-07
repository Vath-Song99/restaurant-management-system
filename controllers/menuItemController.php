<?php
// controllers/MenuItemController.php

class MenuItemController extends BaseController
{

    private $menuModel;
    private $categoryModel;

    public function __construct()
    {
        AuthMiddleware::isLoggedIn();
        RoleMiddleware::hasPermission('manage_menu');

        $this->menuModel = new Menu();
        $this->categoryModel = new Category();
    }
    public function index($queryParams)
    {
        $this->data['menuItems'] = empty($queryParams['query']) ? $this->menuModel->getAll() : $this->menuModel->search($queryParams['query']);
        $this->data['categories'] = $this->categoryModel->getAll();

        // Get flash message if exists
        $this->data['flash'] = $this->getFlash();

        $this->render('menuItems/index');
    }

    public function create()
    {
        $this->data['categories'] = $this->categoryModel->getAll();

        // Check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $menuItem = [
                'name' => trim($_POST['name'] ?? ''),
                'price' => trim($_POST['price'] ?? ''),
                'category_id' => trim($_POST['category_id'] ?? ''),
                'available' => isset($_POST['available']) ? 1 : 0,
                'description' => trim($_POST['description'] ?? ''),
                'image' => trim($_POST['image_base64'] ?? '')
            ];

            // Validate input
            $errors = $this->validate($menuItem, [
                'name' => 'required|max:100',
                'price' => 'required|numeric',
                'category_id' => 'required|numeric'
            ]);

            if (empty($errors)) {

                if ($this->menuModel->create($menuItem)) {
                    $this->setFlash('success', 'Menu item created successfully');
                    $this->redirect('/dashboard/menu-items');
                } else {
                    $this->setFlash('danger', 'Error creating menu item');
                    $this->data['menuItem'] = $menuItem;
                    $this->data['errors'] = $errors;
                    $this->render('menuItems/create');
                }
            } else {
                $this->data['menuItem'] = $menuItem;
                $this->data['errors'] = $errors;
                $this->render('menuItems/create');
            }
        } else {
            // Display the create form
            $this->data['menuItem'] = [
                'name' => '',
                'price' => '',
                'category_id' => '',
                'available' => 1,
                'description' => '',
                'image' => ''
            ];
            $this->data['errors'] = [];
            $this->render('menuItems/create');
        }
    }

    public function edit($id)
    {

        if (!$id) {
            $this->setFlash('danger', 'Invalid menu item ID');
            $this->redirect('menu-items');
        }

        $menuItem = $this->menuModel->getById($id);

        if (!$menuItem) {
            $this->setFlash('danger', 'Menu item not found');
            $this->redirect('menu-items');
        }

        $this->data['categories'] = $this->categoryModel->getAll();

        // Check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $menuItem = [
                'id' => $id,
                'name' => trim($_POST['name'] ?? ''),
                'price' => trim($_POST['price'] ?? ''),
                'category_id' => trim($_POST['category_id'] ?? ''),
                'available' => isset($_POST['available']) ? 1 : 0,
                'description' => trim($_POST['description'] ?? ''),
                'image' => trim($_POST['image_base64'] ?? '')
            ];

            // Validate input
            $errors = $this->validate($menuItem, [
                'name' => 'required|max:100',
                'price' => 'required|numeric',
                'category_id' => 'required|numeric'
            ]);

            if (empty($errors)) {
                if ($this->menuModel->update($id, $menuItem)) {
                    $this->setFlash('success', 'Menu item updated successfully');
                    $this->redirect('/dashboard/menu-items');
                } else {
                    $this->setFlash('danger', 'Error updating menu item');
                    $this->data['menuItem'] = $menuItem;
                    $this->data['errors'] = $errors;
                    $this->render('menuItems/edit');
                }
            } else {
                $this->data['menuItem'] = $menuItem;
                $this->data['errors'] = $errors;
                $this->render('menuItems/edit');
            }
        } else {
            // Display the edit form
            $this->data['menuItem'] = $menuItem;
            $this->data['errors'] = [];
            $this->render('menuItems/edit');
        }
    }

    public function delete($id)
    {

        if (!$id) {
            $this->setFlash('danger', 'Invalid menu item ID');
            $this->redirect('menu-items');
        }

        // Check if form was submitted (confirmation)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            if ($this->menuModel->delete($id)) {
                $this->setFlash('success', 'Menu item deleted successfully');
            } else {
                $this->setFlash('danger', 'Error deleting menu item');
            }

            $this->redirect('/dashboard/menu-items');
        } else {
            // Display the confirmation form

            $menuItem = $this->menuModel->getById($id);

            if (!$menuItem) {
                $this->setFlash('danger', 'Menu item not found');
                $this->redirect('menu-items');
            }

            $this->data['menuItem'] = $menuItem;
            $this->render('menuItems/delete');
        }
    }
}
?>