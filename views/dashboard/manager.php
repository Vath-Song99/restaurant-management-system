<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Management System - Manager</title>
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
            <!-- <?php include 'components/sidebar-manager.php'; ?> -->
            
            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Navbar -->
                <!-- <?php include 'components/navbar.php'; ?> -->
                
                <!-- Dashboard Overview Section -->
                <div class="dashboard-section mb-4" id="dashboard-overview">
                    <h2 class="border-bottom pb-2 mb-4">Dashboard Overview</h2>
                    
                    <div class="row mb-4">
                        <!-- Daily Sales Card -->
                        <div class="col-md-4">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-header">Daily Sales</div>
                                <div class="card-body">
                                    <h5 class="card-title">$<span id="daily-sales-amount">2,450</span></h5>
                                    <p class="card-text"><span id="daily-sales-percent">8</span>% <i class="fas fa-arrow-up"></i> from yesterday</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Active Orders Card -->
                        <div class="col-md-4">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-header">Active Orders</div>
                                <div class="card-body">
                                    <h5 class="card-title"><span id="active-orders-count">14</span></h5>
                                    <p class="card-text"><span id="pending-orders-count">5</span> pending, <span id="progress-orders-count">9</span> in progress</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Reservations Card -->
                        <div class="col-md-4">
                            <div class="card text-white bg-info mb-3">
                                <div class="card-header">Today's Reservations</div>
                                <div class="card-body">
                                    <h5 class="card-title"><span id="todays-reservations-count">8</span></h5>
                                    <p class="card-text"><span id="upcoming-reservations-count">3</span> upcoming in the next hour</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Activity -->
                    <div class="card mb-4">
                        <div class="card-header">
                            Recent Activity
                        </div>
                        <div class="card-body">
                            <ul class="list-group" id="recent-activity-list">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Order #1089 marked as completed
                                    <span class="badge bg-primary rounded-pill">Just now</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    New reservation for Table #4 at 7:00 PM
                                    <span class="badge bg-primary rounded-pill">10 mins ago</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Added "Weekend Special" to menu
                                    <span class="badge bg-primary rounded-pill">35 mins ago</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Order Management Section -->
                <div class="dashboard-section mb-4" id="order-management" style="display: none;">
                    <h2 class="border-bottom pb-2 mb-4">Order Management</h2>
                    
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Current Orders</span>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary btn-sm filter-btn active" data-filter="all">All</button>
                                <button type="button" class="btn btn-outline-primary btn-sm filter-btn" data-filter="pending">Pending</button>
                                <button type="button" class="btn btn-outline-primary btn-sm filter-btn" data-filter="in-progress">In Progress</button>
                                <button type="button" class="btn btn-outline-primary btn-sm filter-btn" data-filter="completed">Completed</button>
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
                                    <tbody id="orders-table-body">
                                        <tr class="order-row" data-status="pending">
                                            <td>#1092</td>
                                            <td>Table 7</td>
                                            <td>Pasta Carbonara, Caesar Salad, Wine</td>
                                            <td>12:45 PM</td>
                                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#updateOrderModal" data-order-id="1092">Update</button>
                                                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#viewOrderModal" data-order-id="1092">View</button>
                                            </td>
                                        </tr>
                                        <tr class="order-row" data-status="in-progress">
                                            <td>#1091</td>
                                            <td>Table 3</td>
                                            <td>Steak, Fries, Beer</td>
                                            <td>12:30 PM</td>
                                            <td><span class="badge bg-info text-dark">In Progress</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#updateOrderModal" data-order-id="1091">Update</button>
                                                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#viewOrderModal" data-order-id="1091">View</button>
                                            </td>
                                        </tr>
                                        <tr class="order-row" data-status="completed">
                                            <td>#1090</td>
                                            <td>Table 5</td>
                                            <td>Pizza, Soda</td>
                                            <td>12:15 PM</td>
                                            <td><span class="badge bg-success">Completed</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#viewOrderModal" data-order-id="1090">View</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Reservation Management Section -->
                <div class="dashboard-section mb-4" id="reservation-management" style="display: none;">
                    <h2 class="border-bottom pb-2 mb-4">Reservation Management</h2>
                    
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Upcoming Reservations</span>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addReservationModal">
                                <i class="fas fa-plus"></i> Add Reservation
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Reservation ID</th>
                                            <th>Customer Name</th>
                                            <th>Table</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Guests</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="reservations-table-body">
                                        <tr>
                                            <td>#205</td>
                                            <td>Michael Johnson</td>
                                            <td>Table 8</td>
                                            <td>03/13/2025</td>
                                            <td>7:00 PM</td>
                                            <td>4</td>
                                            <td><span class="badge bg-info">Confirmed</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#updateReservationModal" data-reservation-id="205">Edit</button>
                                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cancelReservationModal" data-reservation-id="205">Cancel</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#206</td>
                                            <td>Sarah Williams</td>
                                            <td>Table 4</td>
                                            <td>03/13/2025</td>
                                            <td>8:30 PM</td>
                                            <td>2</td>
                                            <td><span class="badge bg-info">Confirmed</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#updateReservationModal" data-reservation-id="206">Edit</button>
                                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cancelReservationModal" data-reservation-id="206">Cancel</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#207</td>
                                            <td>David Smith</td>
                                            <td>Table 10</td>
                                            <td>03/14/2025</td>
                                            <td>6:15 PM</td>
                                            <td>6</td>
                                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#updateReservationModal" data-reservation-id="207">Edit</button>
                                                <button class="btn btn-sm btn-outline-success" onclick="confirmReservation(207)">Confirm</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Menu Management Section -->
                <div class="dashboard-section mb-4" id="menu-management" style="display: none;">
                    <h2 class="border-bottom pb-2 mb-4">Menu Management</h2>
                    
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Today's Specials</span>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSpecialModal">
                                <i class="fas fa-plus"></i> Add Special
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Item Name</th>
                                            <th>Description</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="specials-table-body">
                                        <tr>
                                            <td>Seafood Pasta</td>
                                            <td>Fresh pasta with shrimp, scallops, and seasonal vegetables</td>
                                            <td>Main Course</td>
                                            <td>$24.99</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editSpecialModal" data-item-id="1">Edit</button>
                                                <button class="btn btn-sm btn-outline-danger" onclick="deactivateSpecial(1)">Deactivate</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Chocolate Lava Cake</td>
                                            <td>Warm chocolate cake with a molten center, served with vanilla ice cream</td>
                                            <td>Dessert</td>
                                            <td>$9.99</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editSpecialModal" data-item-id="2">Edit</button>
                                                <button class="btn btn-sm btn-outline-danger" onclick="deactivateSpecial(2)">Deactivate</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mt-4">
                        <div class="card-header">Regular Menu Items (View Only)</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Item Name</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Grilled Chicken Sandwich</td>
                                            <td>Sandwich</td>
                                            <td>$14.99</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Classic Cheeseburger</td>
                                            <td>Burger</td>
                                            <td>$16.99</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Margherita Pizza</td>
                                            <td>Pizza</td>
                                            <td>$18.99</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <!-- Modals -->
    <!-- Update Order Modal -->
    <div class="modal fade" id="updateOrderModal" tabindex="-1" aria-labelledby="updateOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateOrderModalLabel">Update Order Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateOrderForm">
                        <input type="hidden" id="order-id-input" value="">
                        <div class="mb-3">
                            <label for="order-status-select" class="form-label">Order Status</label>
                            <select class="form-select" id="order-status-select">
                                <option value="pending">Pending</option>
                                <option value="in-progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="order-notes" class="form-label">Notes (Optional)</label>
                            <textarea class="form-control" id="order-notes" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="save-order-status-btn">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add Reservation Modal -->
    <div class="modal fade" id="addReservationModal" tabindex="-1" aria-labelledby="addReservationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addReservationModalLabel">Add New Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addReservationForm">
                        <div class="mb-3">
                            <label for="customer-name" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="customer-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone-number" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone-number" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email (Optional)</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="reservation-date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="reservation-date" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="reservation-time" class="form-label">Time</label>
                                <input type="time" class="form-control" id="reservation-time" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="guests-number" class="form-label">Number of Guests</label>
                                <input type="number" class="form-control" id="guests-number" min="1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="table-select" class="form-label">Table</label>
                                <select class="form-select" id="table-select" required>
                                    <option value="">Select Table</option>
                                    <option value="1">Table 1 (2 seats)</option>
                                    <option value="2">Table 2 (2 seats)</option>
                                    <option value="3">Table 3 (4 seats)</option>
                                    <option value="4">Table 4 (4 seats)</option>
                                    <option value="5">Table 5 (6 seats)</option>
                                    <option value="6">Table 6 (6 seats)</option>
                                    <option value="7">Table 7 (8 seats)</option>
                                    <option value="8">Table 8 (8 seats)</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="special-requests" class="form-label">Special Requests</label>
                            <textarea class="form-control" id="special-requests" rows="2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="save-reservation-btn">Save Reservation</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add Special Modal -->
    <div class="modal fade" id="addSpecialModal" tabindex="-1" aria-labelledby="addSpecialModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSpecialModalLabel">Add Today's Special</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addSpecialForm">
                        <div class="mb-3">
                            <label for="item-name" class="form-label">Item Name</label>
                            <input type="text" class="form-control" id="item-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="item-description" class="form-label">Description</label>
                            <textarea class="form-control" id="item-description" rows="3" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="item-category" class="form-label">Category</label>
                                <select class="form-select" id="item-category" required>
                                    <option value="">Select Category</option>
                                    <option value="appetizer">Appetizer</option>
                                    <option value="main-course">Main Course</option>
                                    <option value="dessert">Dessert</option>
                                    <option value="beverage">Beverage</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="item-price" class="form-label">Price ($)</label>
                                <input type="number" step="0.01" class="form-control" id="item-price" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="item-ingredients" class="form-label">Ingredients (Optional)</label>
                            <textarea class="form-control" id="item-ingredients" rows="2"></textarea>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="dietary-vegetarian">
                            <label class="form-check-label" for="dietary-vegetarian">Vegetarian</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="dietary-gluten-free">
                            <label class="form-check-label" for="dietary-gluten-free">Gluten Free</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="save-special-btn">Add Special</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap and jQuery Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Scripts -->
    <script src="assets/js/manager.js"></script>
</body>
</html>