<?php
// views/orders/view.php
$pageTitle = 'Order Items';
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Order Items</h1>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Order Items List</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Menu Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($orderItems)): ?>
                            <tr>
                                <td colspan="5" class="text-center">No items found for this order.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($orderItems as $index => $item): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($item->menu_name ?? 'Unknown') ?></td>
                                    <td><?= htmlspecialchars($item->quantity) ?></td>
                                    <td><?= htmlspecialchars(number_format($item->price, 2)) ?></td>
                                    <td><?= htmlspecialchars(number_format($item->quantity * $item->price, 2)) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
