<?php
// controllers/UserController.php

class UserController extends BaseController {

    private $userModel;
    private $roleModel;

    public function __construct() {
        AuthMiddleware::isLoggedIn();
        RoleMiddleware::hasPermission('manage_users');
        $this->userModel = new User();
        $this->roleModel = new Role();
    }

    public function index() {
        // Get all users
        $this->data['users'] = $this->userModel->getUsers();

        // Get flash message if exists
        $this->data['flash'] = $this->getFlash();

        $this->render('users/index');
    }

    public function create() {
        // Check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = [
                'name' => trim($_POST['name'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'password' => password_hash(trim($_POST['password'] ?? ''), PASSWORD_BCRYPT),
                'role_id' => trim($_POST['role_id'] ?? ''),
                'is_active' => trim($_POST['is_active'] ?? 1)
            ];

            // Validate input
            $errors = $this->validate($user, [
                'name' => 'required|max:100',
                'email' => 'required|email|max:100|unique:users,email',
                'password' => 'required|min:6',
                'role_id' => 'required|numeric',
            ]);

            if($user['email'] && $this->userModel->findUserByEmail($user['email'])) {
                $errors['email'] = 'Email already exists';
                $this->setFlash('danger', 'Email already exists');
                $this->redirect('/dashboard/users');
            }

            if (empty($errors)) {
                if ($this->userModel->register($user)) {
                    $this->setFlash('success', 'User created successfully');
                    $this->redirect('/dashboard/users');
                } else {
                    $this->setFlash('danger', 'Error creating user');
                    $this->data['user'] = $user;
                    $this->data['errors'] = $errors;
                    $this->render('users/create');
                }
            } else {
                $this->data['user'] = $user;
                $this->data['errors'] = $errors;
                $this->render('users/create');
            }
        } else {
            // Display the create form
            $this->data['user'] = [
                'name' => '',
                'email' => '',
                'password' => '',
                'role_id' => '',
                'is_active' => 1
            ];
            $this->data['roles'] = $this->roleModel->getRoles(); // Assuming you have a method to get roles
            $this->data['errors'] = [];
            $this->render('users/create');
        }
    }

    public function edit($id) {
        if (!$id) {
            $this->setFlash('danger', 'Invalid user ID');
            $this->redirect('users');
        }

        $user = $this->userModel->findUserById($id);

        if (!$user) {
            $this->setFlash('danger', 'User not found');
            $this->redirect('users');
        }

        // Check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = [
                'name' => trim($_POST['name'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'password' => password_hash(trim($_POST['password'] ?? ''), PASSWORD_BCRYPT),
                'role_id' => trim($_POST['role_id'] ?? ''),
                'is_active' => trim($_POST['is_active'] ?? 1)
            ];

            // Validate input
            $errors = $this->validate($user, [
                'name' => 'required|max:100',
                'email' => 'required|email|max:100|unique:users,email',
                'password' => 'required|min:6',
                'role_id' => 'required|numeric',
            ]);

            if (empty($errors)) {
                if ($this->userModel->updateUserById($id, $user)) {
                    $this->setFlash('success', 'User updated successfully');
                    $this->redirect('/dashboard/users');
                } else {
                    $this->setFlash('danger', 'Error updating user');
                    $this->data['user'] = $user;
                    $this->data['errors'] = $errors;
                    $this->render('users/edit');
                }
            } else {
                $this->data['user'] = $user;
                $this->data['errors'] = $errors;
                $this->render('users/edit');
            }
        } else {
            $this->data['user'] = $user;
            $this->data['roles'] = $this->roleModel->getRoles();
            $this->data['errors'] = [];
            $this->render('users/edit');
        }
    }

    public function delete($id) {
        if (!$id) {
            $this->setFlash('danger', 'Invalid user ID');
            $this->redirect('users');
        }

        // Check if form was submitted (confirmation)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->userModel->deleteUser($id)) {
                $this->setFlash('success', 'User deleted successfully');
            } else {
                $this->setFlash('danger', 'Error deleting user');
            }

            $this->redirect('/dashboard/users');
        } else {
            // Display the confirmation form
            $user = $this->userModel->findUserById($id);

            if (!$user) {
                $this->setFlash('danger', 'User not found');
                $this->redirect('users');
            }

            $this->data['user'] = $user;
            $this->render('users/delete');
        }
    }

    public function qrcode ($id) {
        if (!$id) {
            $this->setFlash('danger', 'Invalid user ID');
            $this->redirect('users');
        }

        // Generate QR code for the user
        $user = $this->userModel->findUserById($id);

        if (!$user) {
            $this->setFlash('danger', 'User not found');
            $this->redirect('users');
        }

        $user->login_token = bin2hex(random_bytes(16));
        $this->userModel->updateLoginToken($id,  $user->login_token);
        $qrcode = QRCodeGenerator::generate(BASE_URL . '/auth/login/qrcode/' . urlencode($user->login_token ?? ''));

        $this->userModel->updateQrcode($id, $qrcode);
        $this->data['qrcode'] = $qrcode;
        $this->data['user'] = $user;
        $this->render('users/qrcode');
    }

    public function downloadQrcode ($id) {
        if (!$id) {
            $this->setFlash('danger', 'Invalid user ID');
            $this->redirect('users');
        }

        // Generate QR code for the user
        $user = $this->userModel->findUserById($id);

        if (!$user) {
            $this->setFlash('danger', 'User not found');
            $this->redirect('users');
        }

        $qrcode = $user->login_qrcode;
        if (!$qrcode) {
            $this->setFlash('danger', 'QR code not found for this user');
            $this->redirect('dashboard/users');
        }
        // Set headers for download
        header('Content-Type: image/png');
        header('Content-Disposition: attachment; filename="rms_login_qrcode_' . strtolower(str_replace(' ', '_', $user->name)) . '.png"');
        echo base64_decode(str_replace('data:image/png;base64,', '', $qrcode));
    }
}
?>
