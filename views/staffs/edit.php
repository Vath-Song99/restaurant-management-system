<?php
// views/staff/edit.php
$pageTitle = 'Edit Staff Member';
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Staff Member</h1>
        <a href="<?= BASE_URL ?>/dashboard/staffs" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Staff List
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Staff Details</h5>
        </div>
        <div class="card-body">
            <form action="<?= BASE_URL ?>/dashboard/staffs/edit/<?= $staff->id ?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" id="name"
                        name="name" value="<?= htmlspecialchars($staff->name ?? '') ?>" required>
                    <?php if (isset($errors['name'])): ?>
                        <div class="invalid-feedback"><?= $errors['name'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" id="email"
                        name="email" value="<?= htmlspecialchars($staff->email ?? '') ?>">
                    <?php if (isset($errors['email'])): ?>
                        <div class="invalid-feedback"><?= $errors['email'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>" id="phone"
                        name="phone" value="<?= htmlspecialchars($staff->phone ?? '') ?>">
                    <?php if (isset($errors['phone'])): ?>
                        <div class="invalid-feedback"><?= $errors['phone'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control <?= isset($errors['position']) ? 'is-invalid' : '' ?>" id="position"
                        name="position" value="<?= htmlspecialchars($staff->position ?? '') ?>">
                    <?php if (isset($errors['position'])): ?>
                        <div class="invalid-feedback"><?= $errors['position'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="number" step="0.01" class="form-control <?= isset($errors['salary']) ? 'is-invalid' : '' ?>"
                        id="salary" name="salary" value="<?= htmlspecialchars($staff->salary ?? '') ?>">
                    <?php if (isset($errors['salary'])): ?>
                        <div class="invalid-feedback"><?= $errors['salary'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="hire_date" class="form-label">Hire Date</label>
                    <input type="date" class="form-control <?= isset($errors['hire_date']) ? 'is-invalid' : '' ?>" id="hire_date"
                        name="hire_date" value="<?= htmlspecialchars($staff->hire_date ?? '') ?>">
                    <?php if (isset($errors['hire_date'])): ?>
                        <div class="invalid-feedback"><?= $errors['hire_date'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control <?= isset($errors['address']) ? 'is-invalid' : '' ?>"
                        id="address" name="address" rows="4"
                        required><?= htmlspecialchars($staff->address ?? '') ?></textarea>
                    <?php if (isset($errors['address'])): ?>
                        <div class="invalid-feedback"><?= $errors['address'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select <?= isset($errors['status']) ? 'is-invalid' : '' ?>" id="status" name="status" required>
                        <option value="active" <?= $staff->status == 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= $staff->status == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                    <?php if (isset($errors['status'])): ?>
                        <div class="invalid-feedback"><?= $errors['status'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image Preview</label>
                    <div>
                        <img id="image_preview" src="<?= $staff->image ?? '#' ?>" alt="Image Preview"
                            style="max-width: 100%; max-height: 200px; display: <?= !empty($staff->image) ? 'block' : 'none' ?>;">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>"
                        id="image" name="image" accept=".jpg,.jpeg,.png,.gif,.webp,.bmp,.svg,.tif,.tiff,.ico"
                        onchange="convertToBase64(this)" <?= empty($staff->image) ? 'required' : ''?>>
                    <?php if (isset($errors['image'])): ?>
                        <div class="invalid-feedback"><?= $errors['image'] ?></div>
                    <?php endif; ?>
                    <input type="hidden" id="image_base64" name="image_base64">
                </div>
                <script>
                    function convertToBase64(input) {
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                document.getElementById('image_base64').value = e.target.result;
                                const preview = document.getElementById('image_preview');
                                preview.src = e.target.result;
                                preview.style.display = 'block';
                            };
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?= BASE_URL ?>/dashboard/staffs" class="btn btn-outline-secondary me-md-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Staff Member</button>
                </div>
            </form>
        </div>
    </div>
</div>
