<?php
// views/staff/delete.php
$pageTitle = 'Delete Staff Member';
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Delete Staff Member</h1>
        <a href="<?= BASE_URL?>/dashboard/staffs" class="btn btn-secondary"></a>
            <i class="fas fa-arrow-left me-2"></i>Back to Staff
        </a>
    </div>
    
    <div class="card">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Confirm Deletion</h5>
        </div>
        <div class="card-body">
            <p class="lead">Are you sure you want to delete the following staff member?</p>
            
            <div class="alert alert-warning">
                <strong>Name:</strong> <?= htmlspecialchars($staff->name ?? '') ?><br>
                <strong>Email:</strong> <?= htmlspecialchars($staff->email ?? '') ?><br>
                <strong>Phone:</strong> <?= htmlspecialchars($staff->phone ?? '') ?><br>
                <strong>Position:</strong> <?= htmlspecialchars($staff->position ?? '') ?><br>
                <strong>Salary:</strong> <?= htmlspecialchars($staff->salary ?? '') ?><br>
                <strong>Hire Date:</strong> <?= htmlspecialchars($staff->hire_date ?? '') ?><br>
                <strong>Status:</strong> <?= htmlspecialchars($staff->status ?? '') ?><br>
                <strong>Address:</strong> <?= htmlspecialchars($staff->address ?? '') ?>
            </div>
            
            <p><strong>Warning:</strong> This action cannot be undone.</p>
            
            <form action="<?= BASE_URL?>/dashboard/staffs/delete/<?= $staff->id ?>" method="post">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?= BASE_URL?>/dashboard/staffs" class="btn btn-outline-secondary me-md-2">Cancel</a>
                    <button type="submit" class="btn btn-danger">Delete Staff Member</button>
                </div>
            </form>
        </div>
    </div>
</div>