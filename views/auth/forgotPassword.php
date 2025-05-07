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
                <div class="card-header bg-gradient-primary text-white text-center py-4">
                    <h3 class="font-weight-bold mb-0">Forgot Password</h3>
                    <p class="small mb-0">Enter your email to reset your password</p>
                </div>
                <div class="card-body px-4 py-5">
                    <?php echo FlashHelper::flash('forgot_error'); ?>
                    <?php echo FlashHelper::flash('forgot_success'); ?>
                    
                    <div id="resetSteps" class="mb-4">
                        <div class="d-flex mb-4">
                            <div class="step active">
                                <div class="step-icon">1</div>
                                <div class="step-text">Request</div>
                            </div>
                            <div class="step-line"></div>
                            <div class="step">
                                <div class="step-icon">2</div>
                                <div class="step-text">Email</div>
                            </div>
                            <div class="step-line"></div>
                            <div class="step">
                                <div class="step-icon">3</div>
                                <div class="step-text">Reset</div>
                            </div>
                        </div>
                    </div>
                    
                    <form id="forgotPasswordForm" action="<?= BASE_URL; ?>/auth/forgot-password" method="post">
                        <?php echo CSRFHelper::getTokenField(); ?>
                        
                        <div class="mb-4">
                            <label for="email" class="form-label text-muted small">Email address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-envelope-fill text-muted"></i>
                                </span>
                                <input type="email" class="form-control border-start-0" id="email" name="email" placeholder="Enter your registered email" required>
                            </div>
                            <small class="form-text text-muted">We'll send a password reset link to this email</small>
                        </div>
                        
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg py-2">
                                <span class="me-2">Send Reset Link</span>
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                    
                    <div class="text-center">
                        <p class="small text-muted mb-0">Remember your password?</p>
                        <a href="<?= BASE_URL; ?>/auth/login" class="text-primary fw-bold text-decoration-none">
                            <i class="bi bi-arrow-left me-1"></i> Back to Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom styles for the steps indicator */
.step {
    text-align: center;
    flex: 1;
}

.step-icon {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #e9ecef;
    color: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 8px;
    font-weight: bold;
    transition: all 0.3s ease;
}

.step.active .step-icon {
    background-color: var(--bs-primary);
    color: white;
}

.step-text {
    font-size: 12px;
    color: #6c757d;
}

.step.active .step-text {
    color: var(--bs-primary);
    font-weight: 500;
}

.step-line {
    flex: 1;
    height: 2px;
    background-color: #e9ecef;
    margin-top: 15px;
}

/* Animation classes */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.fadeIn {
    animation: fadeIn 0.5s ease forwards;
}

/* Gradient background for the header */
.bg-gradient-primary {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const forgotPasswordForm = document.getElementById('forgotPasswordForm');
    
    forgotPasswordForm.addEventListener('submit', function(event) {
        const email = document.getElementById('email').value.trim();
        let isValid = true;
        
        if (!email || !validateEmail(email)) {
            showError('email', 'Please enter a valid email address');
            isValid = false;
        } else {
            clearError('email');
        }
        
        if (!isValid) {
            event.preventDefault();
        } else {
            // Show loading state on button when form is valid and submitted
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Sending...';
            submitBtn.disabled = true;
        }
    });
    
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    
    function showError(fieldId, message) {
        const field = document.getElementById(fieldId);
        let errorDiv = field.parentNode.nextElementSibling;
        
        if (!errorDiv || !errorDiv.classList.contains('invalid-feedback')) {
            errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback d-block mt-2';
            field.parentNode.parentNode.insertBefore(errorDiv, field.parentNode.nextElementSibling);
        }
        
        field.classList.add('is-invalid');
        errorDiv.textContent = message;
    }
    
    function clearError(fieldId) {
        const field = document.getElementById(fieldId);
        field.classList.remove('is-invalid');
        
        const errorDiv = field.parentNode.nextElementSibling;
        if (errorDiv && errorDiv.classList.contains('invalid-feedback')) {
            errorDiv.textContent = '';
        }
    }
    
    // Add animation effects
    const forgotCard = document.querySelector('.card');
    forgotCard.classList.add('fadeIn');
});
</script>