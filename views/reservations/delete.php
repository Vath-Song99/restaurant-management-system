<?php
// views/reservations/delete.php
$pageTitle = 'Delete Reservation';
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Delete Reservation</h1>
        <a href="<?= BASE_URL?>/dashboard/reservations" class="btn btn-secondary"></a>
            <i class="fas fa-arrow-left me-2"></i>Back to Reservations
        </a>
    </div>
    
    <div class="card">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Confirm Deletion</h5>
        </div>
        <div class="card-body">
            <p class="lead">Are you sure you want to delete the following reservation?</p>
            
            <div class="alert alert-warning">
                <strong>Customer Name:</strong> <?= htmlspecialchars($reservation->name) ?><br>
                <strong>Emil:</strong> <?= htmlspecialchars($reservation->email) ?><br>
                <strong>Date:</strong> <?= htmlspecialchars($reservation->reservation_time) ?><br>
                <strong>Guests:</strong> <?= htmlspecialchars($reservation->num_guests) ?>
            </div>
            
            <p><strong>Warning:</strong> This action cannot be undone.</p>
            
            <form action="<?= BASE_URL?>/dashboard/reservations/delete/<?= $reservation->id ?>" method="post">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end"></div>
                    <a href="<?= BASE_URL?>/dashboard/reservations" class="btn btn-outline-secondary me-md-2">Cancel</a>
                    <button type="submit" class="btn btn-danger">Delete Reservation</button>
                </div>
            </form>
        </div>
    </div>
</div>