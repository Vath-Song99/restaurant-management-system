<?php
// views/auth/reset_password.php
require_once APP_ROOT . '/views/layouts/header.php';
?>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Reset Password</h4>
                </div>
                <div class="card-body">
                    <?php echo FlashHelper::flash('error'); ?>
                    
                    <form action="<?php echo BASE_URL . '/auth/reset-password/' . $token; ?>" method="post">
                        <?php echo CSRFHelper::getTokenField(); ?>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <small class="form-text text-muted">Password must be at least 8 characters and include at least one uppercase letter, one lowercase letter, and one number.</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                    </form>
                    
                    <div class="mt-3 text-center">
                        <a href="<?php echo BASE_URL; ?>/auth/login">Back to Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once APP_ROOT . '/views/layouts/footer.php'; ?>