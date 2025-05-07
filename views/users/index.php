<?php
// views/users/index.php
$pageTitle = 'Users';
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>User Management</h1>
        <div>
            <a href="<?= BASE_URL; ?>/dashboard/users/create" class="btn btn-success me-2">
                <i class="fas fa-plus me-2"></i>Add New User
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">User List</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Last Login</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($users)): ?>
                            <tr>
                                <td colspan="7" class="text-center">No users found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($users as $index => $user): ?>
                                <tr>

                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($user->name ?? '') ?></td>
                                    <td><?= htmlspecialchars($user->email ?? '') ?></td>
                                    <td><?= htmlspecialchars($user->role_name ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($user->last_login ?? 'Never') ?></td>
                                    <td>
                                        <?php if ($user->is_active): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group gap-2" role="group"></div>
                                        <a href="<?= BASE_URL; ?>/dashboard/users/edit/<?= $user->id ?>"
                                            class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit User">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= BASE_URL; ?>/dashboard/users/delete/<?= $user->id ?>"
                                            class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete User">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <a href="<?= BASE_URL; ?>/dashboard/users/qrcode/<?= $user->id ?>" data-bs-toggle="tooltip" title="Generate Qrcode"
                                            class="btn btn-sm btn-info">
                                            <i class="fas fa-qrcode"></i> </a>
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