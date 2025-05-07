<?php
// views/staff/index.php
$pageTitle = 'Staff';
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Staff Management</h1>
        <a href="<?= BASE_URL; ?>/dashboard/staffs/create" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>Add New Staff
        </a>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Staff List</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Position</th>
                            <th>Salary</th>
                            <th>Hire Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($staff)): ?>
                        <tr>
                            <td colspan="9" class="text-center">No staff members found.</td>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($staff as $index => $member): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($member->name ?? '') ?></td>
                                <td><?= htmlspecialchars($member->email ?? '') ?></td>
                                <td><?= htmlspecialchars($member->phone ?? '') ?></td>
                                <td><?= htmlspecialchars($member->position ?? '') ?></td>
                                <td><?= htmlspecialchars(number_format($member->salary ?? 0, 2)) ?></td>
                                <td><?= htmlspecialchars($member->hire_date ?? '') ?></td>
                                <td>
                                    <?php if ($member->status == 'active'): ?>
                                    <span class="badge bg-success">Active</span>
                                    <?php else: ?>
                                    <span class="badge bg-danger">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group gap-2" role="group">
                                        <a href="<?= BASE_URL; ?>/dashboard/staffs/edit/<?= $member->id ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit Staff">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= BASE_URL; ?>/dashboard/staffs/delete/<?= $member->id ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Staff">
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
