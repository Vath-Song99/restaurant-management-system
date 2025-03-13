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