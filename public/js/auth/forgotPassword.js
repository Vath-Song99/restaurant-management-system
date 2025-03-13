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