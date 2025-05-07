<?php
// controllers/BaseController.php

class BaseController
{
    protected $data = [];

    protected function render($view, $layout = 'dashboard')
    {
        $this->data['current_username'] = SessionHelper::get('user_name');
        extract($this->data);

        $headerPath = $layout == 'dashboard' ? '/views/shared/header.php' : '/views/layouts/header.php';
        $footerPath = $layout == 'dashboard' ? '/views/shared/footer.php' : '/views/layouts/footer.php';

        include(APP_ROOT . $headerPath);
        include(APP_ROOT . '/views/' . $view . '.php');
        include(APP_ROOT . $footerPath);
    }

    protected function redirect($endpoint)
    {
        $url = BASE_URL . $endpoint;

        header('Location: ' . $url);
        exit;
    }

    // Method to validate form input
    protected function validate($data, $rules)
    {
        $errors = [];

        foreach ($rules as $field => $rule) {
            // Check required fields
            if (strpos($rule, 'required') !== false && (empty($data[$field]) && $data[$field] !== '0')) {
                $errors[$field] = ucfirst($field) . ' is required';
                continue;
            }

            // Skip other validations if field is empty and not required
            if (empty($data[$field]) && strpos($rule, 'required') === false) {
                continue;
            }

            // Check numeric fields
            if (strpos($rule, 'numeric') !== false && !is_numeric($data[$field])) {
                $errors[$field] = ucfirst($field) . ' must be a number';
            }

            // Check email format
            if (strpos($rule, 'email') !== false && !filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                $errors[$field] = ucfirst($field) . ' must be a valid email address';
            }

            // Check min length
            if (preg_match('/min:(\d+)/', $rule, $matches)) {
                $min = $matches[1];
                if (strlen($data[$field]) < $min) {
                    $errors[$field] = ucfirst($field) . ' must be at least ' . $min . ' characters';
                }
            }

            // Check max length
            if (preg_match('/max:(\d+)/', $rule, $matches)) {
                $max = $matches[1];
                if (strlen($data[$field]) > $max) {
                    $errors[$field] = ucfirst($field) . ' must not exceed ' . $max . ' characters';
                }
            }
        }

        return $errors;
    }

    // Method to display flash messages
    protected function setFlash($type, $message)
    {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }

    // Method to get flash message
    protected function getFlash()
    {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }
}
?>