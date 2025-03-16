<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require APP_ROOT . '/vendor/autoload.php';
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
                FlashHelper::setFlash('login_error', 'No user found this email, Please contact our support team', 'alert alert-danger');
                header('Location: ' . BASE_URL . '/auth/login');
                exit;
            }
        } else {
            require_once APP_ROOT . '/views/auth/login.php';
        }
    }
    public function logout()
    {
        AuthMiddleware::logout();
        FlashHelper::setFlash('logout_success', 'You have been successfully logged out', 'alert alert-success');
        header('Location: ' . BASE_URL . '/auth/login');
        exit;
    }

    public function forgotPassword()
    {
        AuthMiddleware::isGuest();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = ValidationHelper::sanitizeInput($_POST);

            if (!CSRFHelper::verifyToken($_POST['csrf_token'])) {
                FlashHelper::setFlash('error', 'Security token validation failed. Please try again.', 'alert alert-danger');
                header('Location: ' . BASE_URL . '/auth/forgot-password');
                exit;
            }

            if (empty($_POST['email']) || !ValidationHelper::validateEmail($_POST['email'])) {
                FlashHelper::setFlash('error', 'Please enter a valid email address', 'alert alert-danger');
                header('Location: ' . BASE_URL . '/auth/forgot-password');
                exit;
            }

            $user = $this->userModel->findUserByEmail($_POST['email']);

            if ($user) {
        
                $token = bin2hex(random_bytes(32));

                // Store token in database
                if ($this->userModel->storeResetToken($user->email, $token)) {
                    $mail = new PHPMailer(true);

                    try {
                        $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com';  // Your SMTP server
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'vatgaming287@gmail.com';
                        $mail->Password   = 'jhxm olpp iqzt doye';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port       = 587;
                    
                        $mail->setFrom('vatgaming287@gmail.com', 'RMS');
                        $mail->addAddress($user->email);
                    
                        $mail->isHTML(true);
                        $mail->Subject = "HTML email";
                        $mail->Body    = '<p>Dear ' . htmlspecialchars($user->name) . ',</p>';
                        $mail->Body   .= '<p>You have requested to reset your password. Please click the link below to reset your password:</p>';
                        $mail->Body   .= '<p><a href="' . BASE_URL . '/auth/reset-password/' . $token . '">Reset Password</a></p>';
                        $mail->Body   .= '<p>If you did not request this, please ignore this email.</p>';
                        $mail->Body   .= '<p>Thank you,</p>';
                        $mail->Body   .= '<p>Restaurant Management System</p>';
                    
                        $mail->send();
                        FlashHelper::setFlash('success', 'Password reset link has been sent.', 'alert alert-success');
                    } catch (Exception $e) {
                        FlashHelper::setFlash('error', 'Failed to send email: ' . $mail->ErrorInfo, 'alert alert-danger');
                    }
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