<?php
// views/users/qrcode.php
$pageTitle = 'Generate QR Code for User Login';
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Generate QR Code</h1>
        <a href="<?= BASE_URL ?>/dashboard/users" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Users
        </a>
    </div>
    
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">User Login QR Code</h5>
        </div>
        <div class="card-body">
            <p class="lead">Scan the QR code below to log in:</p>
            
            <div class="text-center">
                <img src="<?= $qrcode ?>" alt="QR Code" class="img-fluid" style="max-width: 300px; max-height: 300px;">
            </div>
            
            <div class="mt-4 text-center">
                <a href="<?= BASE_URL ?>/dashboard/users" class="btn btn-outline-secondary">Back to Users</a>
                <a href="<?= BASE_URL ?>/dashboard/download/qrcode/<?= $user->id ?>" class="btn btn-outline-primary ms-2">Download QR Code</a>
            </div>
        </div>
    </div>
</div>