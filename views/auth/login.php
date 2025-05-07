<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= PUBLIC_ROOT ?>/css/styles.css">
    <link rel="stylesheet" href="<?= PUBLIC_ROOT ?>/css/bootstrap.min.css">
    <link rel="icon" href="<?= PUBLIC_ROOT ?>/img/favicon.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="<?= PUBLIC_ROOT ?>/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?= PUBLIC_ROOT ?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= PUBLIC_ROOT ?>/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <script src="<?= PUBLIC_ROOT ?>/js/main.js"></script>
</head>

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
                    
                    <form id="loginForm" action="<?= BASE_URL; ?>/auth/login" method="post">
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
                        <a href="<?= BASE_URL; ?>/auth/forgot-password" class="text-primary medium text-decoration-none">Forgot Password?</a>

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