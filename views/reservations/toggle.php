<?php
// views/reservations/toggle.php
$pageTitle = 'Toggle Reservation Status';
?>

<div class="container-fluid py-4">
<div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Add Reservation</h1>
        <a href="<?= BASE_URL?>/dashboard/reservations" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Reservations
        </a>
    </div>
    
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Change Reservation Status</h5>
        </div>
        <div class="card-body">
            <p class="lead">Select a new status for the following reservation:</p>
            
            <div class="alert alert-info">
                <strong>Customer Name:</strong> <?= htmlspecialchars($reservation->name) ?><br>
                <strong>Email:</strong> <?= htmlspecialchars($reservation->email) ?><br>
                <strong>Date:</strong> <?= htmlspecialchars($reservation->reservation_time) ?><br>
                <strong>Guests:</strong> <?= htmlspecialchars($reservation->num_guests) ?><br>
                <strong>Current Status:</strong> <?= htmlspecialchars($reservation->status) ?>
            </div>
            
            <form action="<?= BASE_URL; ?>/dashboard/reservations/toggle-status/<?= $reservation->id ?>" method="post">
                <div class="mb-3">
                    <label for="status" class="form-label">New Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="pending" <?= $reservation->status === 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="confirmed" <?= $reservation->status === 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                        <option value="canceled" <?= $reservation->status === 'canceled' ? 'selected' : '' ?>>Canceled</option>
                    </select>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?= BASE_URL; ?>/dashboard/reservations" class="btn btn-outline-secondary me-md-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>