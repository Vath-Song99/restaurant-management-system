<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Management System - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="active">
            <div class="sidebar-header">
                <h3>Restaurant Admin</h3>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#" data-page="dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#" data-page="orders"><i class="fas fa-utensils"></i> Orders</a>
                </li>
                <li>
                    <a href="#" data-page="menu"><i class="fas fa-clipboard-list"></i> Menu Management</a>
                </li>
                <li>
                    <a href="#" data-page="reservations"><i class="far fa-calendar-alt"></i> Reservations</a>
                </li>
                <li>
                    <a href="#" data-page="staff"><i class="fas fa-users"></i> Staff Management</a>
                </li>
                <li>
                    <a href="#" data-page="reports"><i class="fas fa-chart-bar"></i> Reports</a>
                </li>
                <li>
                    <a href="#" data-page="settings"><i class="fas fa-cog"></i> System Settings</a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div id="content">
            <!-- Navbar -->
            <?php include 'components/navbar.php'; ?>

            <!-- Dashboard Page -->
            <div class="page-content" id="dashboard">
                <div class="container-fluid">
                    <h2 class="mb-4">Admin Dashboard</h2>
                    
                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center text-primary">
                                                <i class="fas fa-dollar-sign"></i>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="numbers">
                                                <p class="card-category">Total Sales</p>
                                                <h4 class="card-title">$23,450</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center text-success">
                                                <i class="fas fa-chart-line"></i>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="numbers">
                                                <p class="card-category">Daily Revenue</p>
                                                <h4 class="card-title">$2,150</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center text-warning">
                                                <i class="fas fa-receipt"></i>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="numbers">
                                                <p class="card-category">Orders Today</p>
                                                <h4 class="card-title">48</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center text-danger">
                                                <i class="fas fa-chair"></i>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="numbers">
                                                <p class="card-category">Active Tables</p>
                                                <h4 class="card-title">12/20</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Monthly Sales Performance</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="salesChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Top Menu Items</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="menuChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activities and Staff Performance -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Recent Activities</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="timeline">
                                        <li class="timeline-item">
                                            <span class="timeline-point"></span>
                                            <div class="timeline-content">
                                                <h6>New order placed - Table #5</h6>
                                                <p class="text-muted">10 minutes ago</p>
                                            </div>
                                        </li>
                                        <li class="timeline-item">
                                            <span class="timeline-point bg-success"></span>
                                            <div class="timeline-content">
                                                <h6>Reservation confirmed for Johnson party (8 people)</h6>
                                                <p class="text-muted">25 minutes ago</p>
                                            </div>
                                        </li>
                                        <li class="timeline-item">
                                            <span class="timeline-point bg-warning"></span>
                                            <div class="timeline-content">
                                                <h6>Menu updated by Manager</h6>
                                                <p class="text-muted">1 hour ago</p>
                                            </div>
                                        </li>
                                        <li class="timeline-item">
                                            <span class="timeline-point bg-info"></span>
                                            <div class="timeline-content">
                                                <h6>New staff member added: Jane Doe</h6>
                                                <p class="text-muted">2 hours ago</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Staff Performance</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Staff Member</th>
                                                <th>Orders Served</th>
                                                <th>Customer Rating</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>John Smith</td>
                                                <td>24</td>
                                                <td>4.8/5 <i class="fas fa-star text-warning"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Maria Garcia</td>
                                                <td>18</td>
                                                <td>4.9/5 <i class="fas fa-star text-warning"></i></td>
                                            </tr>
                                            <tr>
                                                <td>David Kim</td>
                                                <td>22</td>
                                                <td>4.7/5 <i class="fas fa-star text-warning"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Sarah Johnson</td>
                                                <td>20</td>
                                                <td>4.5/5 <i class="fas fa-star text-warning"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Page -->
            <div class="page-content" id="orders" style="display: none;">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Orders Management</h2>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addOrderModal">
                            <i class="fas fa-plus"></i> New Order
                        </button>
                    </div>
                    
                    <!-- Order Filters -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <select class="form-select" id="orderStatusFilter">
                                        <option value="">All Statuses</option>
                                        <option value="pending">Pending</option>
                                        <option value="preparing">Preparing</option>
                                        <option value="ready">Ready to Serve</option>
                                        <option value="served">Served</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select" id="tableFilter">
                                        <option value="">All Tables</option>
                                        <option value="1">Table 1</option>
                                        <option value="2">Table 2</option>
                                        <option value="3">Table 3</option>
                                        <!-- More tables -->
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search orders...">
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-outline-primary w-100" id="refreshOrders">
                                        <i class="fas fa-sync-alt"></i> Refresh
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Orders Table -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Table</th>
                                            <th>Server</th>
                                            <th>Items</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Time</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#1001</td>
                                            <td>Table 3</td>
                                            <td>John Smith</td>
                                            <td>4 items</td>
                                            <td>$56.80</td>
                                            <td><span class="badge bg-warning">Preparing</span></td>
                                            <td>10:15 AM</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewOrderModal">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editOrderModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#1002</td>
                                            <td>Table 5</td>
                                            <td>Maria Garcia</td>
                                            <td>3 items</td>
                                            <td>$42.50</td>
                                            <td><span class="badge bg-success">Served</span></td>
                                            <td>10:08 AM</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewOrderModal">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editOrderModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- More order rows -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu Management Page -->
            <div class="page-content" id="menu" style="display: none;">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Menu Management</h2>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMenuItemModal">
                            <i class="fas fa-plus"></i> Add Menu Item
                        </button>
                    </div>
                    
                    <!-- Category Navigation -->
                    <ul class="nav nav-tabs mb-4" id="menuTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="appetizers-tab" data-bs-toggle="tab" data-bs-target="#appetizers" type="button" role="tab">Appetizers</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="mains-tab" data-bs-toggle="tab" data-bs-target="#mains" type="button" role="tab">Main Courses</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="desserts-tab" data-bs-toggle="tab" data-bs-target="#desserts" type="button" role="tab">Desserts</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="drinks-tab" data-bs-toggle="tab" data-bs-target="#drinks" type="button" role="tab">Drinks</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="specials-tab" data-bs-toggle="tab" data-bs-target="#specials" type="button" role="tab">Specials</button>
                        </li>
                    </ul>
                    
                    <!-- Menu Item Cards -->
                    <div class="tab-content" id="menuTabContent">
                        <div class="tab-pane fade show active" id="appetizers" role="tabpanel">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100">
                                        <img src="/api/placeholder/400/300" class="card-img-top" alt="Bruschetta">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="card-title">Bruschetta</h5>
                                                <span class="badge bg-success">Available</span>
                                            </div>
                                            <p class="card-text">Toasted bread topped with tomatoes, garlic, olive oil, and basil.</p>
                                            <p class="fw-bold">$8.99</p>
                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editMenuItemModal">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- More menu items -->
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100">
                                        <img src="/api/placeholder/400/300" class="card-img-top" alt="Calamari">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="card-title">Calamari</h5>
                                                <span class="badge bg-success">Available</span>
                                            </div>
                                            <p class="card-text">Crispy fried squid served with marinara sauce.</p>
                                            <p class="fw-bold">$12.99</p>
                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editMenuItemModal">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Other menu tab panels -->
                    </div>
                </div>
            </div>

            <!-- Reservations Page -->
            <div class="page-content" id="reservations" style="display: none;">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Reservations</h2>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReservationModal">
                            <i class="fas fa-plus"></i> New Reservation
                        </button>
                    </div>
                    
                    <!-- Calendar View -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div id="reservationCalendar"></div>
                        </div>
                    </div>
                    
                    <!-- Today's Reservations -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Today's Reservations</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Customer</th>
                                            <th>Time</th>
                                            <th>Party Size</th>
                                            <th>Table</th>
                                            <th>Contact</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#R101</td>
                                            <td>Michael Brown</td>
                                            <td>7:30 PM</td>
                                            <td>4</td>
                                            <td>Table 8</td>
                                            <td>555-123-4567</td>
                                            <td><span class="badge bg-success">Confirmed</span></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewReservationModal">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editReservationModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- More reservation rows -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Staff Management Page -->
            <div class="page-content" id="staff" style="display: none;">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Staff Management</h2>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal">
                            <i class="fas fa-plus"></i> Add Staff Member
                        </button>
                    </div>
                    
                    <!-- Staff Table -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Contact</th>
                                            <th>Status</th>
                                            <th>Performance</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#S001</td>
                                            <td>John Smith</td>
                                            <td>Waiter</td>
                                            <td>555-111-2222</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 85%">
                                                        4.8/5
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewStaffModal">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editStaffModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- More staff rows -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reports Page -->
            <div class="page-content" id="reports" style="display: none;">
                <div class="container-fluid">
                    <h2 class="mb-4">Reports & Analytics</h2>
                    
                    <!-- Date Filter -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Date Range</label>
                                    <select class="form-select" id="reportRange">
                                        <option value="today">Today</option>
                                        <option value="week">This Week</option>
                                        <option value="month" selected>This Month</option>
                                        <option value="quarter">This Quarter</option>
                                        <option value="year">This Year</option>
                                        <option value="custom">Custom Range</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Report Type</label>
                                    <select class="form-select" id="reportType">
                                        <option value="sales">Sales Report</option>
                                        <option value="menu">Menu Performance</option>
                                        <option value="staff">Staff Performance</option>
                                        <option value="tables">Table Utilization</option>
                                    </select>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button class="btn btn-primary w-100">Generate Report</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Reports Section -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Monthly Sales Trends</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="reportsChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Revenue Breakdown</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="revenuePieChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Busiest Hours</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="hoursChart" height="250"></canvas>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Table Utilization</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="tableChart" height="250"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Export Options -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Export Report</h5>
                            <div class="btn-group">
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </button>
                                <button class="btn btn-outline-success">
                                    <i class="fas fa-file-excel"></i> Excel
                                </button>
                                <button class="btn btn-outline-info">
                                    <i class="fas fa-print"></i> Print
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Page -->
            <div class="page-content" id="settings" style="display: none;">
                <div class="container-fluid">
                    <h2 class="mb-4">System Settings</h2>
                    
                    <div class="row">
                        <div class="col-lg-8">
                            <!-- Restaurant Information -->
                             <!-- Restaurant Information -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Restaurant Information</h5>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Restaurant Name</label>
                                                <input type="text" class="form-control" value="Gourmet Dining">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Contact Number</label>
                                                <input type="text" class="form-control" value="(555) 123-4567">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control" value="123 Culinary Ave, Foodville, NY 10001">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" value="info@gourmetdining.com">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Website</label>
                                                <input type="text" class="form-control" value="www.gourmetdining.com">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- System Settings -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">System Configuration</h5>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Business Hours</label>
                                                <div class="input-group">
                                                    <input type="time" class="form-control" value="11:00">
                                                    <span class="input-group-text">to</span>
                                                    <input type="time" class="form-control" value="23:00">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Auto-Refresh Interval</label>
                                                <select class="form-select">
                                                    <option>30 seconds</option>
                                                    <option selected>1 minute</option>
                                                    <option>5 minutes</option>
                                                    <option>10 minutes</option>
                                                    <option>Never</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Tax Rate (%)</label>
                                                <input type="number" class="form-control" value="8.5">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Currency</label>
                                                <select class="form-select">
                                                    <option selected>USD ($)</option>
                                                    <option>EUR (€)</option>
                                                    <option>GBP (£)</option>
                                                    <option>JPY (¥)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Default Gratuity (%)</label>
                                                <input type="number" class="form-control" value="18">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Table Reservation Interval</label>
                                                <select class="form-select">
                                                    <option>15 minutes</option>
                                                    <option selected>30 minutes</option>
                                                    <option>1 hour</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="enableNotifications" checked>
                                            <label class="form-check-label" for="enableNotifications">Enable Email Notifications</label>
                                        </div>
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="enableSMS" checked>
                                            <label class="form-check-label" for="enableSMS">Enable SMS Alerts</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Configuration</button>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Backup & Restore -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Backup & Restore</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Last Backup</label>
                                            <p class="form-control-static">March 12, 2025 - 11:45 PM</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Scheduled Backups</label>
                                            <select class="form-select">
                                                <option>Every 6 hours</option>
                                                <option selected>Daily</option>
                                                <option>Weekly</option>
                                                <option>Monthly</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-primary">
                                            <i class="fas fa-download"></i> Backup Now
                                        </button>
                                        <button class="btn btn-outline-secondary">
                                            <i class="fas fa-upload"></i> Restore from Backup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            <!-- Theme Settings -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Theme Settings</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Color Theme</label>
                                        <div class="d-flex gap-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="colorTheme" id="lightTheme" checked>
                                                <label class="form-check-label" for="lightTheme">Light</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="colorTheme" id="darkTheme">
                                                <label class="form-check-label" for="darkTheme">Dark</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="colorTheme" id="autoTheme">
                                                <label class="form-check-label" for="autoTheme">Auto</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Accent Color</label>
                                        <div class="d-flex gap-2">
                                            <div class="color-option bg-primary active"></div>
                                            <div class="color-option bg-success"></div>
                                            <div class="color-option bg-danger"></div>
                                            <div class="color-option bg-warning"></div>
                                            <div class="color-option bg-info"></div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Font Size</label>
                                        <select class="form-select">
                                            <option>Small</option>
                                            <option selected>Medium</option>
                                            <option>Large</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary">Apply Theme</button>
                                </div>
                            </div>
                            
                            <!-- User Access -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">User Access</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Default Role for New Users</label>
                                        <select class="form-select">
                                            <option>Admin</option>
                                            <option selected>Manager</option>
                                            <option>Staff</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password Policy</label>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="minLength" checked>
                                            <label class="form-check-label" for="minLength">Minimum 8 characters</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="requireSpecial" checked>
                                            <label class="form-check-label" for="requireSpecial">Require special characters</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="requireNumber" checked>
                                            <label class="form-check-label" for="requireNumber">Require numbers</label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary">Save Access Settings</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Add Order Modal -->
    <div class="modal fade" id="addOrderModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Table</label>
                                <select class="form-select">
                                    <option value="">Select Table</option>
                                    <option value="1">Table 1</option>
                                    <option value="2">Table 2</option>
                                    <!-- More tables -->
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Server</label>
                                <select class="form-select">
                                    <option value="">Select Server</option>
                                    <option value="1">John Smith</option>
                                    <option value="2">Maria Garcia</option>
                                    <!-- More staff -->
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Menu Items</label>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th width="100">Quantity</th>
                                            <th width="120">Price</th>
                                            <th width="50">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orderItems">
                                        <tr>
                                            <td>
                                                <select class="form-select">
                                                    <option value="">Select Item</option>
                                                    <option value="1">Bruschetta</option>
                                                    <option value="2">Calamari</option>
                                                    <!-- More menu items -->
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" value="1" min="1">
                                            </td>
                                            <td>$8.99</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-plus"></i> Add Item
                            </button>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Special Instructions</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Order Summary</label>
                                <div class="p-3 border rounded">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Subtotal:</span>
                                        <span>$8.99</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Tax (8.5%):</span>
                                        <span>$0.76</span>
                                    </div>
                                    <div class="d-flex justify-content-between fw-bold">
                                        <span>Total:</span>
                                        <span>$9.75</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Create Order</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Menu Item Modal -->
    <div class="modal fade" id="addMenuItemModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Menu Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Item Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select">
                                <option value="appetizers">Appetizers</option>
                                <option value="mains">Main Courses</option>
                                <option value="desserts">Desserts</option>
                                <option value="drinks">Drinks</option>
                                <option value="specials">Specials</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control">
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="availableCheck" checked>
                            <label class="form-check-label" for="availableCheck">Available</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Add Item</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script src="assets/js/scripts.js"></script>
</body>
</html>