<?php
// views/dashboard/index.php
$pageTitle = 'Dashboard';
?>

<div class="container-fluid py-4">
    <h1 class="mb-4">Dashboard</h1>
    
    <!-- Summary Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary dashboard-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Menu Items</h6>
                            <h2 class="mb-0"><?= $totalMenuItems ?></h2>
                        </div>
                        <i class="fas fa-utensils fa-3x opacity-75"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a href="<?= BASE_URL?>/dashboard/menu-items" class="text-white">View Details</a>
                    <i class="fas fa-arrow-circle-right"></i>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-success dashboard-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Categories</h6>
                            <h2 class="mb-0"><?= $totalCategories ?></h2>
                        </div>
                        <i class="fas fa-tags fa-3x opacity-75"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a href="<?= BASE_URL?>/dashboard/categories" class="text-white">View Details</a>
                    <i class="fas fa-arrow-circle-right"></i>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-info dashboard-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Orders</h6>
                            <h2 class="mb-0"><?= $totalOrders ?></h2>
                        </div>
                        <i class="fas fa-clipboard-list fa-3x opacity-75"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a href="<?= BASE_URL?>/dashboard/orders" class="text-white">View Details</a>
                    <i class="fas fa-arrow-circle-right"></i>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-danger dashboard-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Staff</h6>
                            <h2 class="mb-0"><?= $totalStaff ?></h2>
                        </div>
                        <i class="fas fa-users fa-3x opacity-75"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a href="<?= BASE_URL?>/dashboard/staffs" class="text-white">View Details</a>
                    <i class="fas fa-arrow-circle-right"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts and Recent Data -->
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
            <div class="card-header">
                <h6 class="mb-0">Orders by Status</h6>
            </div>
            <div class="card-body p-2">
                <canvas id="orderStatusChart" height="200"></canvas>
            </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Popular Menu Items</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Orders</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($popularItems as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item->name) ?></td>
                                <td>$<?= number_format($item->price, 2) ?></td>
                                <td><?= $item->order_count ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Recent Orders</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentOrders as $index => $order): ?>
                            <tr>
                                <td><?= $index + 1?></td>
                                <td><?= htmlspecialchars($order->user_name ?? 'Guest') ?></td>
                                <td>$<?= number_format($order->total_price, 2) ?></td>
                                <td>
                                    <span class="badge bg-<?= getStatusColor($order->status) ?>">
                                        <?= ucfirst($order->status ?? 'unknown') ?>
                                    </span>
                                </td>
                                <td><?= date('M d, Y H:i', strtotime($order->created_at)) ?></td>
                                <td>
                                    <a href="<?= BASE_URL ?>/dashboard/orders/view/<?= $order->id ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="<?= BASE_URL ?>/dashboard/orders" class="btn btn-primary">View All Orders</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Helper function for badge colors
function getStatusColor($status) {
    switch ($status) {
        case 'pending':
            return 'warning';
        case 'preparing':
            return 'info';
        case 'ready':
            return 'primary';
        case 'delivered':
            return 'success';
        case 'cancelled':
            return 'danger';
        default:
            return 'secondary';
    }
}

// JavaScript for charts
$pageScripts = <<<EOT
<script>
// Order Status Chart
const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
const orderStatusChart = new Chart(orderStatusCtx, {
    type: 'doughnut',
    data: {
        labels: [
EOT;

$statusLabels = [];
$statusData = [];
$statusColors = ['#ffc107', '#0dcaf0', '#0d6efd', '#198754', '#dc3545', '#6c757d'];
$colorIndex = 0;

foreach ($orderStats as $status => $count) {
    $statusLabels[] = "'" . ucfirst($status) . "'";
    $statusData[] = is_object($count) ? (property_exists($count, 'value') ? $count->value : 0) : $count;
    $colorIndex++;
}

$pageScripts .= implode(', ', $statusLabels) . "],\n";
$pageScripts .= "        datasets: [{\n";
$pageScripts .= "            data: [" . implode(', ', $statusData) . "],\n";
$pageScripts .= "            backgroundColor: ['" . implode("', '", array_slice($statusColors, 0, count($statusData))) . "'],\n";
$pageScripts .= <<<EOT
            hoverOffset: 4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
            }
        }
    }
});
</script>
EOT;
?>