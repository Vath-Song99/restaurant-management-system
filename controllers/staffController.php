<?php
// controllers/StaffController.php

class StaffController extends BaseController {

    private $staffModel;

    public function __construct() {
        AuthMiddleware::isLoggedIn();
        RoleMiddleware::hasPermission('manage_staff');
        $this->staffModel = new Staff();
    }

    public function index() {
        // Get all staff members
        $this->data['staff'] = $this->staffModel->getAll();

        // Get flash message if exists
        $this->data['flash'] = $this->getFlash();

        $this->render('staffs/index');
    }

    public function create() {
        // Check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $staff = [
                'name' => trim($_POST['name'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'phone' => trim($_POST['phone'] ?? ''),
                'position' => trim($_POST['position'] ?? ''),
                'address' => trim($_POST['address'] ?? ''),
                'salary' => trim($_POST['salary'] ?? ''),
                'hire_date' => trim($_POST['hire_date'] ?? ''),
                'status' => trim($_POST['status'] ?? 'active'),
                'image' => trim($_POST['image_base64'] ?? '')
            ];

            // Validate input
            $errors = $this->validate($staff, [
                'name' => 'required|max:50',
                'email' => 'nullable|email|max:100|unique:staff,email',
                'phone' => 'nullable|max:20',
                'position' => 'nullable|max:50',
                'address' => 'nullable|max:250',
                'salary' => 'nullable|numeric',
                'hire_date' => 'nullable|date',
                'status' => 'required|in:active,inactive'
            ]);

            if (empty($errors)) {
                if ($this->staffModel->create($staff)) {
                    $this->setFlash('success', 'Staff member created successfully');
                    $this->redirect('/dashboard/staffs');
                } else {
                    $this->setFlash('danger', 'Error creating staff member');
                    $this->data['staff'] = $staff;
                    $this->data['errors'] = $errors;
                    $this->render('staffs/create');
                }
            } else {
                $this->data['staff'] = $staff;
                $this->data['errors'] = $errors;
                $this->render('staffs/create');
            }
        } else {
            // Display the create form
            $this->data['staff'] = [
                'name' => '',
                'email' => '',
                'phone' => '',
                'position' => '',
                'salary' => '',
                'address' => '',
                'hire_date' => '',
                'status' => 'active',
                'image' => ''
            ];
            $this->data['errors'] = [];
            $this->render('staffs/create');
        }
    }

    public function edit($id) {
        if (!$id) {
            $this->setFlash('danger', 'Invalid staff ID');
            $this->redirect('/dashboard/staffs');
        }

        $staff = $this->staffModel->getById($id);

        if (!$staff) {
            $this->setFlash('danger', 'Staff member not found');
            $this->redirect('/dashboard/staffs');
        }

        // Check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $staff = [
                'name' => trim($_POST['name'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'phone' => trim($_POST['phone'] ?? ''),
                'position' => trim($_POST['position'] ?? ''),
                'address' => trim($_POST['address'] ?? ''),
                'salary' => trim($_POST['salary'] ?? ''),
                'hire_date' => trim($_POST['hire_date'] ?? ''),
                'status' => trim($_POST['status'] ?? 'active'),
                'image' => trim($_POST['image_base64'] ?? '')
            ];

            // Validate input
            $errors = $this->validate($staff, [
                'name' => 'required|max:50',
                'email' => 'nullable|email|max:100|unique:staff,email',
                'phone' => 'nullable|max:20',
                'position' => 'nullable|max:50',
                'address' => 'nullable|max:250',
                'salary' => 'nullable|numeric',
                'hire_date' => 'nullable|date',
                'status' => 'required|in:active,inactive'
            ]);

            if (empty($errors)) {
                if ($this->staffModel->update($id, $staff)) {
                    $this->setFlash('success', 'Staff member updated successfully');
                    $this->redirect('/dashboard/staffs');
                } else {
                    $this->setFlash('danger', 'Error updating staff member');
                    $this->data['staff'] = $staff;
                    $this->data['errors'] = $errors;
                    $this->render('staffs/edit');
                }
            } else {
                $this->data['staff'] = $staff;
                $this->data['errors'] = $errors;
                $this->render('staffs/edit');
            }
        } else {
            // Display the edit form
            $this->data['staff'] = $staff;
            $this->data['errors'] = [];
            $this->render('staffs/edit');
        }
    }

    public function delete($id) {
        if (!$id) {
            $this->setFlash('danger', 'Invalid staff ID');
            $this->redirect('/dashboard/staffs');
        }

        // Check if form was submitted (confirmation)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->staffModel->delete($id)) {
                $this->setFlash('success', 'Staff member deleted successfully');
            } else {
                $this->setFlash('danger', 'Error deleting staff member');
            }

            $this->redirect('/dashboard/staffs');
        } else {
            // Display the confirmation form
            $staff = $this->staffModel->getById($id);

            if (!$staff) {
                $this->setFlash('danger', 'Staff member not found');
                $this->redirect('/dashboard/staffs');
            }

            $this->data['staff'] = $staff;
            $this->render('staffs/delete');
        }
    }

    public function toggle($id) {
        if (!$id) {
            $this->setFlash('danger', 'Invalid staff ID');
            $this->redirect('/dashboard/staffs');
        }

        // Check if form was submitted (confirmation)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->staffModel->updateStatus($id, $_POST['status'])) {
                $this->setFlash('success', 'Staff status updated successfully');
            } else {
                $this->setFlash('danger', 'Error updating staff status');
            }

            $this->redirect('/dashboard/staffs');
        } else {
            // Display the confirmation form
            $staff = $this->staffModel->getById($id);

            if (!$staff) {
                $this->setFlash('danger', 'Staff member not found');
                $this->redirect('/dashboard/staffs');
            }

            $this->data['staff'] = $staff;
            $this->render('staffs/toggle');
        }
    }
}
?>
