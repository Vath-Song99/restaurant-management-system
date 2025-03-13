<?php
require_once APP_ROOT . '/views/layouts/header.php';
?>

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-75 py-5">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-primary  text-center py-4">
                    <h3 class="font-weight-bold mb-0">Welcome to RMS</h3>
                    <p class="small mb-0">Sign in to your account</p>
                </div>
                <div class="card-body px-4 py-5">
                    <?php echo FlashHelper::flash('login_error'); ?>
                    <?php echo FlashHelper::flash('login_success'); ?>
                    <?php echo FlashHelper::flash('logout_success'); ?>
                    <?php echo FlashHelper::flash('password_reset_success'); ?>
                    
                    <form id="loginForm" action="<?php echo BASE_URL; ?>/auth/login" method="post">
                        <?php echo CSRFHelper::getTokenField(); ?>
                        
                        <div class="mb-4">
                            <label for="email" class="form-label text-muted small">Email address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-envelope-fill text-muted"></i>
                                </span>
                                <input type="email" class="form-control border-start-0" id="email" name="email" placeholder="name@example.com" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <div class="d-flex justify-content-between">
                                <label for="password" class="form-label text-muted small">Password</label>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-lock-fill text-muted"></i>
                                </span>
                                <input type="password" class="form-control border-start-0" id="password" name="password" required>
                                <button class="btn btn-outline-secondary border-start-0" type="button" id="togglePassword">
                                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe" name="remember_me">
                            <label class="form-check-label small" for="rememberMe">Remember me</label>
                        </div>
                        
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg py-2">
                                <span class="me-2">Sign In</span>
                                <i class="bi bi-box-arrow-in-right"></i>
                            </button>
                        </div>
                    </form>
                    
                    <div class="text-center">
                        <a href="<?php echo BASE_URL; ?>/auth/forgot-password" class="text-primary medium text-decoration-none">Forgot Password?</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    togglePassword.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash');
        }
    });

    // Form validation
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', function(event) {
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        let isValid = true;
        
        // Simple validation
        if (!email || !validateEmail(email)) {
            showError('email', 'Please enter a valid email address');
            isValid = false;
        } else {
            clearError('email');
        }
        
        if (!password) {
            showError('password', 'Password is required');
            isValid = false;
        } else {
            clearError('password');
        }
        
        if (!isValid) {
            event.preventDefault();
        }
    });
    
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    
    function showError(fieldId, message) {
        const field = document.getElementById(fieldId);
        let errorDiv = field.nextElementSibling;
        
        if (!errorDiv || !errorDiv.classList.contains('invalid-feedback')) {
            errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback';
            field.parentNode.insertBefore(errorDiv, field.nextSibling);
        }
        
        field.classList.add('is-invalid');
        errorDiv.textContent = message;
    }
    
    function clearError(fieldId) {
        const field = document.getElementById(fieldId);
        field.classList.remove('is-invalid');
        
        const errorDiv = field.nextElementSibling;
        if (errorDiv && errorDiv.classList.contains('invalid-feedback')) {
            errorDiv.textContent = '';
        }
    }
    
    // Add animation effects
    const loginCard = document.querySelector('.card');
    loginCard.classList.add('animate__animated', 'animate__fadeIn');
});
</script>

<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>