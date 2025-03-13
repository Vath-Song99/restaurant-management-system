<?php
class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login()
    {
        AuthMiddleware::isGuest();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
            $_POST = ValidationHelper::sanitizeInput($_POST);

            
            if (!CSRFHelper::verifyToken($_POST['csrf_token'])) {
                FlashHelper::setFlash('login_error', 'Security token validation failed. Please try again.', 'alert alert-danger');
                header('Location: ' . BASE_URL . '/auth/login');
                exit;
            }

           
            if (empty($_POST['email']) || !ValidationHelper::validateEmail($_POST['email'])) {
                FlashHelper::setFlash('login_error', 'Please enter a valid email address', 'alert alert-danger');
                header('Location: ' . BASE_URL . '/auth/login');
                exit;
            }

           
            if (empty($_POST['password'])) {
                FlashHelper::setFlash('login_error', 'Please enter your password', 'alert alert-danger');
                header('Location: ' . BASE_URL . '/auth/login');
                exit;
            }

            $user = $this->userModel->findUserByEmail($_POST['email']);

            if ($user) {
                
                if (password_verify($_POST['password'], $user->password)) {
                   
                    if (!$user->is_active) {
                        FlashHelper::setFlash('login_error', 'Your account is currently inactive. Please contact the administrator.', 'alert alert-danger');
                        header('Location: ' . BASE_URL . '/auth/login');
                        exit;
                    }
                   
                    $this->userModel->updateLastLogin($user->id);

                    SessionHelper::setUserSession($user);

                    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                    $_SESSION['last_regenerate'] = time();

                  
                    header('Location: ' . BASE_URL . '/dashboard');
                    exit;
                } else {
                    FlashHelper::setFlash('login_error', 'Invalid password', 'alert alert-danger');
                    header('Location: ' . BASE_URL . '/auth/login');
                    exit;
                }
            } else {
                FlashHelper::setFlash('login_error', 'No user found with that email', 'alert alert-danger');
                header('Location: ' . BASE_URL . '/auth/login');
                exit;
            }
        } else {
            require_once APP_ROOT . '/views/auth/login.php';
        }
    }

    // Handle logout
    public function logout()
    {
        AuthMiddleware::logout();
        FlashHelper::setFlash('logout_success', 'You have been successfully logged out', 'alert alert-success');
        header('Location: ' . BASE_URL . '/auth/login');
        exit;
    }

    // Display forgot password page
    public function forgotPassword()
    {
        // Check if already logged in
        AuthMiddleware::isGuest();

        // Handle POST request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = ValidationHelper::sanitizeInput($_POST);

            // Validate CSRF token
            if (!CSRFHelper::verifyToken($_POST['csrf_token'])) {
                FlashHelper::setFlash('error', 'Security token validation failed. Please try again.', 'alert alert-danger');
                header('Location: ' . BASE_URL . '/auth/forgot-password');
                exit;
            }

            // Validate email
            if (empty($_POST['email']) || !ValidationHelper::validateEmail($_POST['email'])) {
                FlashHelper::setFlash('error', 'Please enter a valid email address', 'alert alert-danger');
                header('Location: ' . BASE_URL . '/auth/forgot-password');
                exit;
            }

            // Check for user
            $user = $this->userModel->findUserByEmail($_POST['email']);

            if ($user) {
                // Generate token
                $token = bin2hex(random_bytes(32));

                // Store token in database
                if ($this->userModel->storeResetToken($user->email, $token)) {
                    // In a real application, you would send an email with the reset link
                    // For demonstration purposes, we'll just show a success message
                    FlashHelper::setFlash('success', 'Password reset link has been sent to your email address. (For demonstration, the token is: ' . $token . ')', 'alert alert-success');
                    header('Location: ' . BASE_URL . '/auth/forgot-password');
                    exit;
                } else {
                    FlashHelper::setFlash('error', 'Failed to process your request. Please try again later.', 'alert alert-danger');
                    header('Location: ' . BASE_URL . '/auth/forgot-password');
                    exit;
                }
            } else {
                // Don't reveal that the email doesn't exist, for security reasons
                FlashHelper::setFlash('success', 'If your email is registered, a password reset link has been sent.', 'alert alert-success');
                header('Location: ' . BASE_URL . '/auth/forgot-password');
                exit;
            }
        } else {
            // Load the view
            require_once APP_ROOT . '/views/auth/forgotPassword.php';
        }
    }

    // Display reset password page
    public function resetPassword($token = null)
    {
        // Check if already logged in
        AuthMiddleware::isGuest();

        if (!$token) {
            FlashHelper::setFlash('error', 'Invalid password reset link', 'alert alert-danger');
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        // Verify token
        $user = $this->userModel->verifyResetToken($token);

        if (!$user) {
            FlashHelper::setFlash('error', 'Invalid or expired password reset link', 'alert alert-danger');
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        // Handle POST request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = ValidationHelper::sanitizeInput($_POST);

            // Validate CSRF token
            if (!CSRFHelper::verifyToken($_POST['csrf_token'])) {
                FlashHelper::setFlash('error', 'Security token validation failed. Please try again.', 'alert alert-danger');
                header('Location: ' . BASE_URL . '/auth/reset-password/' . $token);
                exit;
            }

            // Validate password
            if (empty($_POST['password']) || !ValidationHelper::validatePassword($_POST['password'])) {
                FlashHelper::setFlash('error', 'Password must be at least 8 characters long and contain uppercase, lowercase and numbers', 'alert alert-danger');
                header('Location: ' . BASE_URL . '/auth/reset-password/' . $token);
                exit;
            }

            // Validate confirm password
            if (empty($_POST['confirm_password']) || $_POST['password'] != $_POST['confirm_password']) {
                FlashHelper::setFlash('error', 'Passwords do not match', 'alert alert-danger');
                header('Location: ' . BASE_URL . '/auth/reset-password/' . $token);
                exit;
            }

            // Hash password
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            // Update password
            if ($this->userModel->resetPassword($user->id, $password)) {
                FlashHelper::setFlash('login_success', 'Your password has been reset. You can now log in with your new password', 'alert alert-success');
                header('Location: ' . BASE_URL . '/auth/login');
                exit;
            } else {
                FlashHelper::setFlash('error', 'Failed to reset password. Please try again later.', 'alert alert-danger');
                header('Location: ' . BASE_URL . '/auth/reset-password/' . $token);
                exit;
            }
        } else {
            // Load the view
            require_once APP_ROOT . '/views/auth/resetPassword.php';
        }
    }
}
?>