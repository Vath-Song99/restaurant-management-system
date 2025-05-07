<?php
// views/reservations/create.php
$pageTitle = 'Add Reservation';
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Add Reservation</h1>
        <a href="<?= BASE_URL?>/dashboard/reservations" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Reservations
        </a>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Reservation Details</h5>
        </div>
        <div class="card-body">
            <form action="<?= BASE_URL?>/dashboard/reservations/create" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= htmlspecialchars($reservation['name']) ?>" required>
                    <?php if (isset($errors['name'])): ?>
                    <div class="invalid-feedback"><?= $errors['name'] ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= htmlspecialchars($reservation['email']) ?>" required>
                    <?php if (isset($errors['email'])): ?>
                    <div class="invalid-feedback"><?= $errors['email'] ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>" id="phone" name="phone" value="<?= htmlspecialchars($reservation['phone']) ?>" required>
                    <?php if (isset($errors['phone'])): ?>
                    <div class="invalid-feedback"><?= $errors['phone'] ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label for="num_guests" class="form-label">Number of Guests</label>
                    <input type="number" class="form-control <?= isset($errors['num_guests']) ? 'is-invalid' : '' ?>" id="num_guests" name="num_guests" value="<?= htmlspecialchars($reservation['num_guests']) ?>" required>
                    <?php if (isset($errors['num_guests'])): ?>
                    <div class="invalid-feedback"><?= $errors['num_guests'] ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label for="reservation_time" class="form-label">Reservation Time</label>
                    <input type="datetime-local" class="form-control <?= isset($errors['reservation_time']) ? 'is-invalid' : '' ?>" id="reservation_time" name="reservation_time" value="<?= htmlspecialchars($reservation['reservation_time']) ?>" required>
                    <?php if (isset($errors['reservation_time'])): ?>
                    <div class="invalid-feedback"><?= $errors['reservation_time'] ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label for="special_requests" class="form-label">Special Requests</label>
                    <textarea class="form-control <?= isset($errors['special_requests']) ? 'is-invalid' : '' ?>" id="special_requests" name="special_requests" rows="4"><?= htmlspecialchars($reservation['special_requests']) ?></textarea>
                    <?php if (isset($errors['special_requests'])): ?>
                    <div class="invalid-feedback"><?= $errors['special_requests'] ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control <?= isset($errors['description']) ? 'is-invalid' : '' ?>" id="description" name="description" rows="4" required><?= htmlspecialchars($reservation['description']) ?></textarea>
                    <?php if (isset($errors['description'])): ?>
                    <div class="invalid-feedback"><?= $errors['description'] ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select <?= isset($errors['status']) ? 'is-invalid' : '' ?>" id="status" name="status" required>
                        <option value="pending" <?= $reservation['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="confirmed" <?= $reservation['status'] == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                        <option value="canceled" <?= $reservation['status'] == 'canceled' ? 'selected' : '' ?>>Canceled</option>
                    </select>
                    <?php if (isset($errors['status'])): ?>
                    <div class="invalid-feedback"><?= $errors['status'] ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?= BASE_URL?>/dashboard/reservations" class="btn btn-outline-secondary me-md-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Reservation</button>
                </div>
            </form>
        </div>
    </div>
</div>
