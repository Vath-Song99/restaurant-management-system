<?php
// views/menu-items/edit.php
$pageTitle = 'Edit Menu Item';
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Menu Item</h1>
        <a href="<?= BASE_URL ?>/dashboard/menu-items" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Menu Items
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Menu Item Details</h5>
        </div>
        <div class="card-body">
            <form action="<?= BASE_URL ?>/dashboard/menu-items/edit/<?= $menuItem->id ?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" id="name"
                        name="name" value="<?= htmlspecialchars($menuItem->name ?? '') ?>" required>
                    <?php if (isset($errors['name'])): ?>
                        <div class="invalid-feedback"><?= $errors['name'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price ($)</label>
                    <input type="number" step="0.01"
                        class="form-control <?= isset($errors['price']) ? 'is-invalid' : '' ?>" id="price" name="price"
                        value="<?= htmlspecialchars($menuItem->price ?? '') ?>" required>
                    <?php if (isset($errors['price'])): ?>
                        <div class="invalid-feedback"><?= $errors['price'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select <?= isset($errors['category_id']) ? 'is-invalid' : '' ?>"
                        id="category_id" name="category_id" required>
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category->id ?>" <?= $menuItem->category_id == $category->id ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category->name ?? '') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['category_id'])): ?>
                        <div class="invalid-feedback"><?= $errors['category_id'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control <?= isset($errors['description']) ? 'is-invalid' : '' ?>"
                        id="description" name="description" rows="4"
                        required><?= htmlspecialchars($menuItem->description ?? '') ?></textarea>
                    <?php if (isset($errors['description'])): ?>
                        <div class="invalid-feedback"><?= $errors['description'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Image Preview</label>
                    <div>
                        <img id="image_preview" src="<?= $menuItem->image ?? '#' ?>" alt="Image Preview"
                            style="max-width: 100%; max-height: 200px; display: <?= !empty($menuItem->image) ? 'block' : 'none' ?>;">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>"
                        id="image" name="image" accept=".jpg,.jpeg,.png,.gif,.webp,.bmp,.svg,.tif,.tiff,.ico"
                        onchange="convertToBase64(this)" <?= empty($menuItem->image) ? 'required' : ''?>>
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

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="available" name="available"
                        <?= $menuItem->available ? 'checked' : '' ?>>
                    <label class="form-check-label" for="available">Available</label>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?= BASE_URL ?>/dashboard/menu-items" class="btn btn-outline-secondary me-md-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Menu Item</button>
                </div>
            </form>
        </div>
    </div>
</div>