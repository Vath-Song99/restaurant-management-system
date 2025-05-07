<?php
// views/reservations/index.php
$pageTitle = 'Reservations';
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Reservation Management</h1>
        <a href="<?= BASE_URL; ?>/dashboard/reservations/create" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>Add New Reservation
        </a>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Reservation List</h5>
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
                            <th>Number of Guests</th>
                            <th>Reservation Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($reservations)): ?>
                        <tr>
                            <td colspan="8" class="text-center">No reservations found.</td>
                        </tr>
                        <?php else: ?>
                            <?php usort($reservations, function($a, $b) {
                                $now = time();
                                return abs(strtotime($a->reservation_time) - $now) - abs(strtotime($b->reservation_time) - $now);
                            }); ?>
                            <?php foreach ($reservations as $index => $reservation): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($reservation->name ?? '') ?></td>
                                <td><?= htmlspecialchars($reservation->email ?? '') ?></td>
                                <td><?= htmlspecialchars($reservation->phone ?? '') ?></td>
                                <td><?= htmlspecialchars($reservation->num_guests ?? '') ?></td>
                                <td><?= htmlspecialchars($reservation->reservation_time ?? '') ?></td>
                                <td>
                                    <?php if ($reservation->status == 'confirmed'): ?>
                                    <span class="badge bg-success">Confirmed</span>
                                    <?php elseif ($reservation->status == 'canceled'): ?>
                                    <span class="badge bg-danger">Canceled</span>
                                    <?php else: ?>
                                    <span class="badge bg-warning">Pending</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group gap-2" role="group">
                                        <a href="<?= BASE_URL; ?>/dashboard/reservations/edit/<?= $reservation->id ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit Item">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= BASE_URL; ?>/dashboard/reservations/delete/<?= $reservation->id ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete Item">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <a href="<?= BASE_URL; ?>/dashboard/reservations/toggle-status/<?= $reservation->id ?>" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Toggle Status Item">
                                            <i class="fas fa-sync-alt"></i>
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