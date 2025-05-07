<?php
// views/menu-items/index.php
$pageTitle = 'Menu Items';
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Menu Items Management</h1>
        <a href="<?= BASE_URL?>/dashboard/menu-items/create" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>Add New Item
        </a>
    </div>
    <div class="mb-4">
        <form method="GET" action="<?= BASE_URL?>/dashboard/menu-items" class="row g-2 align-items-center">
            <div class="col-auto flex-grow-1">
                <input type="text" name="query" class="form-control" placeholder="Search menu items..." value="<?= htmlspecialchars($_GET['query'] ?? '') ?>">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary d-flex align-items-center">
                    <i class="fas fa-search me-2"></i><span>Search</span>
                </button>
            </div>
        </form>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Menu Items List</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Availability</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($menuItems)): ?>
                        <tr>
                            <td colspan="6" class="text-center">No menu items found.</td>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($menuItems as $index => $menuItem): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($menuItem->name ?? '') ?></td>
                                <td>$<?= number_format($menuItem->price ?? 0, 2) ?></td>
                                <td><?= htmlspecialchars($menuItem->description ?? '') ?></td>
                                <td>
                                    <?php if ($menuItem->available == 1): ?>
                                    <span class="badge bg-success">Available</span>
                                    <?php else: ?>
                                    <span class="badge bg-danger">Unavailable</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group gap-2" role="group">
                                        <a href="<?= BASE_URL?>/dashboard/menu-items/edit/<?= $menuItem->id ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit Item">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= BASE_URL?>/dashboard/menu-items/delete/<?= $menuItem->id ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Item">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>