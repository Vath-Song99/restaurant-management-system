<?php
// views/orders/index.php
$pageTitle = 'Orders';
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Order Management</h1>

    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Order List</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($orders)): ?>
                            <tr>
                                <td colspan="6" class="text-center">No orders found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($orders as $index => $order): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($order->user_name ?? 'Guest') ?></td>
                                    <td><?= htmlspecialchars(number_format($order->total_price, 2) ?? '0.00') ?></td>
                                    <td>
                                        <?php if ($order->status === 'pending'): ?>
                                            <span class="badge bg-warning">Pending</span>
                                        <?php elseif ($order->status === 'completed'): ?>
                                            <span class="badge bg-success">Completed</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Canceled</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($order->created_at ?? '') ?></td>
                                    <td>
                                        <div class="btn-group gap-2" role="group">
                                            <a href="<?= BASE_URL; ?>/dashboard/orders/view/<?= $order->id ?>"
                                                class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="View Order">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?= BASE_URL; ?>/dashboard/orders/cancel/<?= $order->id ?>"
                                                class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Cancel Order">
                                                <i class="fas fa-xmark"></i>
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