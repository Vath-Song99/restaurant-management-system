<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Management System - Staff</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include 'components/sidebar-staff.php'; ?>
            
            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Navbar -->
                <?php include 'components/navbar.php'; ?>
                
                <!-- Staff Dashboard Overview Section -->
                <div class="dashboard-section mb-4" id="staff-dashboard-overview">
                    <h2 class="border-bottom pb-2 mb-4">My Dashboard</h2>
                    
                    <div class="row mb-4">
                        <!-- Assigned Tables Card -->
                        <div class="col-md-6">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-header">My Assigned Tables</div>
                                <div class="card-body">
                                    <h5 class="card-title"><span id="assigned-tables-count">4</span> Tables</h5>
                                    <p class="card-text"><span id="occupied-tables-count">2</span> occupied, <span id="available-tables-count">2</span> available</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Active Orders Card -->
                        <div class="col-md-6">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-header">My Active Orders</div>
                                <div class="card-body">
                                    <h5 class="card-title"><span id="my-active-orders-count">5</span> Orders</h5>
                                    <p class="card-text"><span id="pending-service-count">2</span> ready to serve, <span id="pending-payment-count">1</span> awaiting payment</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Table Status Overview -->
                    <div class="card mb-4">
                        <div class="card-header">
                            Table Status
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="card h-100 text-center table-card" data-table-id="1" data-table-status="available">
                                        <div class="card-body bg-success bg-opacity-25">
                                            <h5 class="card-title">Table 1</h5>
                                            <p class="card-text"><span class="badge bg-success">Available</span></p>
                                            <p class="card-text">Capacity: 2</p>
                                            <button class="btn btn-sm btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#tableActionModal" data-table-id="1">Manage</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="card h-100 text-center table-card" data-table-id="2" data-table-status="occupied">
                                        <div class="card-body bg-danger bg-opacity-25">
                                            <h5 class="card-title">Table 2</h5>
                                            <p class="card-text"><span class="badge bg-danger">Occupied</span></p>
                                            <p class="card-text">Guests: 2</p>
                                            <p class="card-text small">Order #1091</p>
                                            <button class="btn btn-sm btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#tableActionModal" data-table-id="2">Manage</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="card h-100 text-center table-card" data-table-id="3" data-table-status="occupied">
                                        <div class="card-body bg-danger bg-opacity-25">
                                            <h5 class="card-title">Table 3</h5>
                                            <p class="card-text"><span class="badge bg-danger">Occupied</span></p>
                                            <p class="card-text">Guests: 4</p>
                                            <p class="card-text small">Order #1092</p>
                                            <button class="btn btn-sm btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#tableActionModal" data-table-id="3">Manage</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="card h-100 text-center table-card" data-table-id="4" data-table-status="available">
                                        <div class="card-body bg-success bg-opacity-25">
                                            <h5 class="card-title">Table 4</h5>
                                            <p class="card-text"><span class="badge bg-success">Available</span></p>
                                            <p class="card-text">Capacity: 4</p>
                                            <button class="btn btn-sm btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#tableActionModal" data-table-id="4">Manage</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Order Management Section -->
                <div class="dashboard-section mb-4" id="staff-order-management" style="display: none;">
                    <h2 class="border-bottom pb-2 mb-4">Order Management</h2>
                    
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>My Active Orders</span>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary btn-sm filter-btn active" data-filter="all">All</button>
                                <button type="button" class="btn btn-outline-primary btn-sm filter-btn" data-filter="new">New</button>
                                <button type="button" class="btn btn-outline-primary btn-sm filter-btn" data-filter="ready-to-serve">Ready to Serve</button>
                                <button type="button" class="btn btn-outline-primary btn-sm filter-btn" data-filter="served">Served</button>
                                <button type="button" class="btn btn-outline-primary btn-sm filter-btn" data-filter="pending-payment">Pending Payment</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Table</th>
                                            <th>Items</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="staff-orders-table-body">
                                        <tr class="order-row" data-status="new">
                                            <td>#1095</td>
                                            <td>Table 2</td>
                                            <td>Caesar Salad (x1), Steak Frites (x2)</td>
                                            <td>1:05 PM</td>
                                            <td><span class="badge bg-info">New Order</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staffUpdateOrderModal" data-order-id="1095">Update</button>
                                                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#viewOrderDetailsModal" data-order-id="1095">Details</button>
                                            </td>
                                        </tr>
                                        <tr class="order-row" data-status="ready-to-serve">
                                            <td>#1093</td>
                                            <td>Table 3</td>
                                            <td>Margherita Pizza (x1), House Salad (x1), Tiramisu (x1)</td>
                                            <td>12:45 PM</td>
                                            <td><span class="badge bg-warning text-dark">Ready to Serve</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-success" onclick="markAsServed(1093)">Mark as Served</button>
                                                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#viewOrderDetailsModal" data-order-id="1093">Details</button>
                                            </td>
                                        </tr>
                                        <tr class="order-row" data-status="served">
                                            <td>#1091</td>
                                            <td>Table 2</td>
                                            <td>Burger (x1), Fries (x1), Soda (x1)</td>
                                            <td>12:30 PM</td>
                                            <td><span class="badge bg-success">Served</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary" onclick="markAsPendingPayment(1091)">Request Payment</button>
                                                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#viewOrderDetailsModal" data-order-id="1091">Details</button>
                                            </td>
                                        </tr>
                                        <tr class="order-row" data-status="pending-payment">
                                            <td>#1090</td>
                                            <td>Table 4</td>
                                            <td>Pasta Carbonara (x1), Wine (x1)</td>
                                            <td>12:15 PM</td>
                                            <td><span class="badge bg-danger">Pending Payment</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-success" onclick="markAsPaid(1090)">Mark as Paid</button>
                                                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#viewOrderDetailsModal" data-order-id="1090">Details</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Table Management Section -->
                <div class="dashboard-section mb-4" id="staff-table-management" style="display: none;">
                    <h2 class="border-bottom pb-2 mb-4">Table Management</h2>
                    
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    Floor Plan
                                </div>
                                <div class="card-body">
                                    <div class="floor-plan-container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="floor-plan-section">
                                                    <h5>Dining Area</h5>
                                                    <div class="floor-plan p-3 border rounded">
                                                        <div class="row">
                                                            <div class="col-6 mb-3">
                                                                <div class="table-icon available" data-table-id="1" onclick="selectTable(1)">
                                                                    <i class="fas fa-utensils"></i>
                                                                    <span>1</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <div class="table-icon occupied" data-table-id="2" onclick="selectTable(2)">
                                                                    <i class="fas fa-utensils"></i>
                                                                    <span>2</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <div class="table-icon occupied" data-table-id="3" onclick="selectTable(3)">
                                                                    <i class="fas fa-utensils"></i>
                                                                    <span>3</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <div class="table-icon available" data-table-id="4" onclick="selectTable(4)">
                                                                    <i class="fas fa-utensils"></i>
                                                                    <span>4</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="floor-plan-section">
                                                    <h5>Patio Area</h5>
                                                    <div class="floor-plan p-3 border rounded">
                                                        <div class="row">
                                                            <div class="col-6 mb-3">
                                                                <div class="table-icon reserved" data-table-id="5" onclick="selectTable(5)">
                                                                    <i class="fas fa-utensils"></i>
                                                                    <span>5</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <div class="table-icon available" data-table-id="6" onclick="selectTable(6)">
                                                                    <i class="fas fa-utensils"></i>
                                                                    <span>6</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <div class="table-icon available" data-table-id="7" onclick="selectTable(7)">
                                                                    <i class="fas fa-utensils"></i>
                                                                    <span>7</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <div class="table-icon available" data-table-id="8" onclick="selectTable(8)">
                                                                    <i class="fas fa-utensils"></i>
                                                                    <span>8</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="table-legend mt-3 d-flex justify-content-center">
                                            <div class="legend-item mx-2">
                                                <span class="legend-color bg-success"></span> Available
                                            </div>
                                            <div class="legend-item mx-2">
                                                <span class="legend-color bg-danger"></span> Occupied
                                            </div>
                                            <div class="legend-item mx-2">
                                                <span class="legend-color bg-warning"></span> Reserved
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 mt-3 mt-lg-0">
                            <div class="card">
                                <div class="card-header">
                                    Selected Table
                                </div>
                                <div class="card-body" id="selected-table-details">
                                    <p class="text-center">Select a table to view details</p>
                                </div>
                            </div>
                            
                            <div class="card mt-3">
                                <div class="card-header">
                                    Quick Actions
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newOrderModal" disabled id="new-order-btn">New Order</button>
                                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#assignTableModal" disabled id="assign-table-btn">Assign Table</button>
                                        <button class="btn btn-success" disabled id="mark-available-btn" onclick="markTableAvailable()">Mark Available</button>
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#tableNotesModal" disabled id="add-notes-btn">Add Notes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <!-- Modals -->
    <!-- Table Action Modal -->
    <div class="modal fade" id="tableActionModal" tabindex="-1" aria-labelledby="tableActionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tableActionModalLabel">Manage Table</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-details-container mb-4">
                        <h6>Table Information</h6>
                        <p>Table: <span id="modal-table-number">3</span></p>
                        <p>Status: <span id="modal-table-status" class="badge bg-danger">Occupied</span></p>
                        <p>Capacity: <span id="modal-table-capacity">4</span> guests</p>
                        <p id="modal-guests-container">Current Guests: <span id="modal-table-guests">3</span></p>
                        <p id="modal-order-container">Active Order: <span id="modal-table-order">#1092</span></p>
                    </div>
                    
                    <div class="action-buttons-container">
                        <h6>Actions</h6>
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-primary" id="modal-new-order-btn" data-bs-toggle="modal" data-bs-target="#newOrderModal" data-bs-dismiss="modal">New Order</button>
                            <button type="button" class="btn btn-success" id="modal-mark-available-btn">Mark as Available</button>
                            <button type="button" class="btn btn-warning" id="modal-request-payment-btn">Request Payment</button>
                            <button type="button" class="btn btn-info" id="modal-view-order-btn" data-bs-toggle="modal" data-bs-target="#viewOrderDetailsModal" data-bs-dismiss="modal">View Order Details</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Staff Update Order Modal -->
    <div class="modal fade" id="staffUpdateOrderModal" tabindex="-1" aria-labelledby="staffUpdateOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staffUpdateOrderModalLabel">Update Order Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="staffUpdateOrderForm">
                        <input type="hidden" id="staff-order-id-input" value="">
                        <div class="mb-3">
                            <label for="staff-order-status-select" class="form-label">Order Status</label>
                            <select class="form-select" id="staff-order-status-select">
                                <option value="new">New Order</option>
                                <option value="ready-to-serve">Ready to Serve</option>
                                <option value="served">Served</option>
                                <option value="pending-payment">Pending Payment</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="staff-order-notes" class="form-label">Notes (Optional)</label>
                            <textarea class="form-control" id="staff-order-notes" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="staff-save-order-status-btn">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- New Order Modal -->
    <div class="modal fade" id="newOrderModal" tabindex="-1" aria-labelledby="newOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newOrderModalLabel">Create New Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="newOrderForm">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="order-table-select" class="form-label">Table</label>
                                <select class="form-select" id="order-table-select" required>
                                    <option value="">Select Table</option>
                                    <option value="1">Table 1</option>
                                    <option value="4">Table 4</option>
                                    <option value="6">Table 6</option>
                                    <option value="7">Table 7</option>
                                    <option value="8">Table 8</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="order-guests" class="form-label">Number of Guests</label>
                                <input type="number" class="form-control" id="order-guests" min="1" required>
                            </div>
                        </div>
                        
                        <h6 class="mt-4 mb-3">Menu Items</h6>
                        
                        <ul class="nav nav-tabs" id="menuTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="appetizers-tab" data-bs-toggle="tab" data-bs-target="#appetizers" type="button" role="tab">Appetizers</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="main-courses-tab" data-bs-toggle="tab" data-bs-target="#main-courses" type="button" role="tab">Main Courses</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="desserts-tab" data-bs-toggle="tab" data-bs-target="#desserts" type="button" role="tab">Desserts</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="drinks-tab" data-bs-toggle="tab" data-bs-target="#drinks" type="button" role="tab">Drinks</button>
                            </li>
                        </ul>
                        
                        <div class="tab-content p-3 border border-top-0 rounded-bottom mb-4" id="menuTabsContent">
                            <!-- Appetizers Tab -->
                            <div class="tab-pane fade show active" id="appetizers" role="tabpanel">
                                <div class="menu-items-grid">
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="menu-item d-flex justify-content-between align-items-center p-2 border rounded">
                                                <div>
                                                    <p class="mb-0"><strong>Caesar Salad</strong> - $8.99</p>
                                                </div>
                                                <div class="input-group input-group-sm" style="width: 100px;">
                                                    <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="decrease">-</button>
                                                    <input type="number" class="form-control text-center quantity-input" value="0" min="0" data-item-id="1" data-item-name="Caesar Salad" data-item-price="8.99">
                                                    <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="increase">+</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="menu-item d-flex justify-content-between align-items-center p-2 border rounded">
                                                <div>
                                                    <p class="mb-0"><strong>Bruschetta</strong> - $7.99</p>
                                                </div>
                                                <div class="input-group input-group-sm" style="width: 100px;">
                                                    <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="decrease">-</button>
                                                    <input type="number" class="form-control text-center quantity-input" value="0" min="0" data-item-id="2" data-item-name="Bruschetta" data-item-price="7.99">
                                                    <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="increase">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Main Courses Tab -->
                            <div class="tab-pane fade" id="main-courses" role="tabpanel">
                                <div class="menu-items-grid">
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="menu-item d-flex justify-content-between align-items-center p-2 border rounded">
                                                <div>
                                                    <p class="mb-0"><strong>Steak Frites</strong> - $24.99</p>
                                                </div>
                                                <div class="input-group input-group-sm" style="width: 100px;">
                                                    <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="decrease">-</button>
                                                    <input type="number" class="form-control text-center quantity-input" value="0" min="0" data-item-id="3" data-item-name="Steak Frites" data-item-price="24.99">
                                                    <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="increase">+</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="menu-item d-flex justify-content-between align-items-center p-2 border rounded">
                                                <div>
                                                    <p class="mb-0"><strong>Pasta Carbonara</strong> - $18.99</p>
                                                </div>
                                                <div class="input-group input-group-sm" style="width: 100px;">
                                                    <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="decrease">-</button>
                                                    <input type="number" class="form-control text-center quantity-input" value="0" min="0" data-item-id="4" data-item-name="Pasta Carbonara" data-item-price="18.99">
                                                    <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="increase">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Desserts Tab -->
                            <div class="tab-pane fade" id="desserts" role="tabpanel">
                                <!-- Dessert items would go here -->
                            </div>
                            
                            <!-- Drinks Tab -->
                            <div class="tab-pane fade" id="drinks" role="tabpanel">
                                <!-- Drink items would go here -->
                            </div>
                        </div>
                        
                        <div class="selected-items-container mt-4">
                            <h6>Selected Items</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Price</th>