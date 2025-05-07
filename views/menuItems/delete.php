<?php
// views/menu-items/delete.php
$pageTitle = 'Delete Menu Item';
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Delete Menu Item</h1>
        <a href="<?= BASE_URL?>/dashboard/menu-items" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Menu Items
        </a>
    </div>
    
    <div class="card">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Confirm Deletion</h5>
        </div>
        <div class="card-body">
            <p class="lead">Are you sure you want to delete the following menu item?</p>
            
            <div class="alert alert-warning">
                <strong>Name:</strong> <?= htmlspecialchars($menuItem->name) ?><br>
                <strong>Price:</strong> $<?= number_format($menuItem->price, 2) ?><br>
                <strong>Category:</strong> <?= htmlspecialchars($menuItem->category_name) ?>
            </div>
            
            <p><strong>Warning:</strong> This action cannot be undone.</p>
            
            <form action="<?= BASE_URL?>/dashboard/menu-items/delete/<?= $menuItem->id ?>" method="post">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?= BASE_URL?>/dashboard/menu-items" class="btn btn-outline-secondary me-md-2">Cancel</a>
                    <button type="submit" class="btn btn-danger">Delete Menu Item</button>
                </div>
            </form>
        </div>
    </div>
</div>