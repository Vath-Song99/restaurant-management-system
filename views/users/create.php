<?php
// views/users/create.php
$pageTitle = 'Add User';
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Add User</h1>
        <a href="<?= BASE_URL?>/dashboard/users" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Users
        </a>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">User Details</h5>
        </div>
        <div class="card-body">
            <form action="<?= BASE_URL?>/dashboard/users/create" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>
                    <?php if (isset($errors['name'])): ?>
                    <div class="invalid-feedback"><?= $errors['name'] ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                    <?php if (isset($errors['email'])): ?>
                    <div class="invalid-feedback"><?= $errors['email'] ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>" id="password" name="password" required>
                    <?php if (isset($errors['password'])): ?>
                    <div class="invalid-feedback"><?= $errors['password'] ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label for="role_id" class="form-label">Role</label>
                    <select class="form-select <?= isset($errors['role_id']) ? 'is-invalid' : '' ?>" id="role_id" name="role_id" required>
                        <option value="">Select Role</option>
                        <?php foreach ($roles as $role): ?>
                        <option value="<?= $role->id ?>" <?= $user['role_id'] == $role->id ? 'selected' : '' ?>>
                            <?= htmlspecialchars($role->role_name) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['role_id'])): ?>
                    <div class="invalid-feedback"><?= $errors['role_id'] ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label for="is_active" class="form-label">Active Status</label>
                    <select class="form-select <?= isset($errors['is_active']) ? 'is-invalid' : '' ?>" id="is_active" name="is_active" required>
                        <option value="">Select Status</option>
                        <option value="1" <?= isset($user['is_active']) && $user['is_active'] == 1 ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?= isset($user['is_active']) && $user['is_active'] == 0 ? 'selected' : '' ?>>Inactive</option>
                    </select>
                    <?php if (isset($errors['is_active'])): ?>
                    <div class="invalid-feedback"><?= $errors['is_active'] ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?= BASE_URL?>/dashboard/users" class="btn btn-outline-secondary me-md-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save User</button>
                </div>
            </form>
        </div>
    </div>
</div>
