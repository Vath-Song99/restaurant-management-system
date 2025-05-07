<?php
// views/orders/cancel.php
$pageTitle = 'Cancel Order';
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Cancel Order</h1>
        <a href="<?= BASE_URL; ?>/dashboard/orders" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Orders
        </a>
    </div>
    
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Confirm Cancellation</h5>
        </div>
        <div class="card-body">
            <p class="lead">Are you sure you want to cancel the following order?</p>
            
            <div class="alert alert-warning">
                <strong>Order ID:</strong> <?= htmlspecialchars($order->id) ?><br>
                <strong>Customer Name:</strong> <?= htmlspecialchars($order->user_name) ?><br>
                <strong>Total Amount:</strong> <?= htmlspecialchars($order->total_price) ?>
            </div>
            
            <p><strong>Note:</strong> Cancelling this order will update its status to "Cancelled".</p>
            
            <form action="<?= BASE_URL; ?>/dashboard/orders/cancel/<?= $order->id ?>" method="post">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?= BASE_URL; ?>/dashboard/orders" class="btn btn-outline-secondary me-md-2">Back</a>
                    <button type="submit" class="btn btn-warning">Cancel Order</button>
                </div>
            </form>
        </div>
    </div>
</div>