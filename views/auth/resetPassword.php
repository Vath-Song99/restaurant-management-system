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
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-primary text-white py-3 rounded-top">
                    <h4 class="mb-0"><i class="fas fa-lock me-2"></i>Reset Password</h4>
                </div>
                <div class="card-body p-4">
                    <?php echo FlashHelper::flash('error'); ?>
                    
                    <form action="<?= BASE_URL . '/auth/reset-password/' . $token; ?>" method="post" id="resetPasswordForm">
                        <?php echo CSRFHelper::getTokenField(); ?>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control border-end-0" id="password" name="password" required>
                                <span class="input-group-text bg-transparent border-start-0 password-toggle" id="togglePassword">
                                    <i class="far fa-eye-slash"></i>
                                </span>
                            </div>
                            <div class="mt-2">
                                <div class="password-strength-meter">
                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <small class="password-feedback text-muted mt-1">Password must be at least 8 characters and include at least one uppercase letter, one lowercase letter, and one number.</small>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="confirm_password" class="form-label fw-bold">Confirm New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control border-end-0" id="confirm_password" name="confirm_password" required>
                                <span class="input-group-text bg-transparent border-start-0 password-toggle" id="toggleConfirmPassword">
                                    <i class="far fa-eye-slash"></i>
                                </span>
                            </div>
                            <div class="invalid-feedback" id="password-match-feedback">Passwords do not match</div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" id="submitBtn" disabled>Reset Password</button>
                    </form>
                    
                    <div class="mt-4 text-center">
                        <a href="<?= BASE_URL; ?>/auth/login" class="text-decoration-none">
                            <i class="fas fa-arrow-left me-1"></i> Back to Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this before the closing body tag or in your footer file -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password toggle functionality
    const togglePassword = document.querySelector('#togglePassword');
    const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
    const password = document.querySelector('#password');
    const confirmPassword = document.querySelector('#confirm_password');
    const passwordFeedback = document.querySelector('.password-feedback');
    const progressBar = document.querySelector('.progress-bar');
    const submitBtn = document.querySelector('#submitBtn');
    const passwordMatchFeedback = document.querySelector('#password-match-feedback');
    
    // Toggle password visibility
    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
    
    toggleConfirmPassword.addEventListener('click', function() {
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
    
    // Password strength meter
    password.addEventListener('input', function() {
        const val = password.value;
        let strength = 0;
        let feedback = '';
        
        if (val.length >= 8) {
            strength += 25;
            feedback += '<i class="fas fa-check-circle text-success me-1"></i> 8+ characters<br>';
        } else {
            feedback += '<i class="fas fa-times-circle text-danger me-1"></i> 8+ characters<br>';
        }
        
        if (val.match(/[A-Z]/)) {
            strength += 25;
            feedback += '<i class="fas fa-check-circle text-success me-1"></i> Uppercase letter<br>';
        } else {
            feedback += '<i class="fas fa-times-circle text-danger me-1"></i> Uppercase letter<br>';
        }
        
        if (val.match(/[a-z]/)) {
            strength += 25;
            feedback += '<i class="fas fa-check-circle text-success me-1"></i> Lowercase letter<br>';
        } else {
            feedback += '<i class="fas fa-times-circle text-danger me-1"></i> Lowercase letter<br>';
        }
        
        if (val.match(/[0-9]/)) {
            strength += 25;
            feedback += '<i class="fas fa-check-circle text-success me-1"></i> Number';
        } else {
            feedback += '<i class="fas fa-times-circle text-danger me-1"></i> Number';
        }
        
        // Update progress bar
        progressBar.style.width = strength + '%';
        
        // Update progress bar color
        if (strength < 50) {
            progressBar.className = 'progress-bar bg-danger';
        } else if (strength < 100) {
            progressBar.className = 'progress-bar bg-warning';
        } else {
            progressBar.className = 'progress-bar bg-success';
        }
        
        passwordFeedback.innerHTML = feedback;
        
        checkPasswords();
    });
    
    // Check if passwords match
    confirmPassword.addEventListener('input', checkPasswords);
    
    function checkPasswords() {
        const passwordValue = password.value;
        const confirmValue = confirmPassword.value;
        
        if (confirmValue && passwordValue !== confirmValue) {
            confirmPassword.classList.add('is-invalid');
            passwordMatchFeedback.style.display = 'block';
            submitBtn.disabled = true;
        } else if (confirmValue) {
            confirmPassword.classList.remove('is-invalid');
            confirmPassword.classList.add('is-valid');
            passwordMatchFeedback.style.display = 'none';
            
            // Enable submit button only if password meets requirements
            const meetsRequirements = passwordValue.length >= 8 && 
                                      passwordValue.match(/[A-Z]/) && 
                                      passwordValue.match(/[a-z]/) && 
                                      passwordValue.match(/[0-9]/);
            
            submitBtn.disabled = !meetsRequirements;
        }
    }
    
    // Simple form shake animation for error
    const form = document.getElementById('resetPasswordForm');
    
    form.addEventListener('submit', function(e) {
        const passwordValue = password.value;
        const confirmValue = confirmPassword.value;
        
        if (passwordValue !== confirmValue || passwordValue.length < 8) {
            e.preventDefault();
            form.classList.add('shake');
            setTimeout(() => {
                form.classList.remove('shake');
            }, 500);
        }
    });
});
</script>

<style>
.password-toggle {
    cursor: pointer;
}

.shake {
    animation: shake 0.5s;
}

@keyframes shake {
    0% { transform: translateX(0); }
    20% { transform: translateX(-10px); }
    40% { transform: translateX(10px); }
    60% { transform: translateX(-10px); }
    80% { transform: translateX(10px); }
    100% { transform: translateX(0); }
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
}

.btn-primary {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
}

.btn-primary:after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 5px;
    height: 5px;
    background: rgba(255, 255, 255, 0.5);
    opacity: 0;
    border-radius: 100%;
    transform: scale(1, 1) translate(-50%);
    transform-origin: 50% 50%;
}

.btn-primary:focus:not(:active)::after {
    animation: ripple 1s ease-out;
}

@keyframes ripple {
    0% {
        transform: scale(0, 0);
        opacity: 0.5;
    }
    100% {
        transform: scale(20, 20);
        opacity: 0;
    }
}
</style>

<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>