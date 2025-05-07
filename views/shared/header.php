<?php
// views/shared/header.php
$controller = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Manager<?= isset($pageTitle) ? ' - ' . $pageTitle : '' ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        .sidebar {
            min-height: calc(100vh - 56px);
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
        }
        .sidebar .nav-link {
            color: #333;
            border-radius: 0;
        }
        .sidebar .nav-link.active {
            color: #fff;
            background-color: #0d6efd;
        }
        .sidebar .nav-link:hover {
            background-color: #e9ecef;
        }
        .main-content {
            padding: 20px;
        }
        .dashboard-card {
            transition: transform 0.3s;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= BASE_URL?>/dashboard">Restaurant Manager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link<?= $controller == 'dashboard' ? ' active' : '' ?>" href="<?= BASE_URL?>/dashboard">
                            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= $controller == 'menu-items' ? ' active' : '' ?>" href="<?= BASE_URL?>/dashboard/menu-items">
                            <i class="fas fa-utensils me-1"></i> Menu Items
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= $controller == 'reservations' ? ' active' : '' ?>" href="<?= BASE_URL?>/dashboard/reservations">
                            <i class="fas fa-tags me-1"></i> Reservations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= $controller == 'orders' ? ' active' : '' ?>" href="<?= BASE_URL?>/dashboard/orders">
                            <i class="fas fa-clipboard-list me-1"></i> Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= $controller == 'staff' ? ' active' : '' ?>" href="<?= BASE_URL?>/dashboard/staffs">
                            <i class="fas fa-users me-1"></i> Staffs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= $controller == 'user' ? ' active' : '' ?>" href="<?= BASE_URL?>/dashboard/users">
                            <i class="fas fa-user-cog me-1"></i> Users
                        </a>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center"></div>
                <i class="fas fa-user-circle text-white me-2" style="font-size: 1.8rem;"></i>
                <span class="text-white me-3"><?= $current_username?></span>
                <a href="<?= BASE_URL?>/auth/logout" class="btn btn-outline-light" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-md-block sidebar py-3">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link<?= $controller == 'dashboard' ? ' active' : '' ?>" href="<?= BASE_URL?>/dashboard">
                                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= $controller == 'menu-items' ? ' active' : '' ?>" href="<?= BASE_URL?>/dashboard/menu-items">
                                <i class="fas fa-utensils me-2"></i> Menu Items
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= $controller == 'reservations' ? ' active' : '' ?>" href="<?= BASE_URL?>/dashboard/reservations">
                                <i class="fas fa-tags me-2"></i> Reservations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= $controller == 'orders' ? ' active' : '' ?>" href="<?= BASE_URL?>/dashboard/orders">
                                <i class="fas fa-clipboard-list me-2"></i> Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= $controller == 'staff' ? ' active' : '' ?>" href="<?= BASE_URL?>/dashboard/staffs">
                                <i class="fas fa-users me-2"></i> Staffs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= $controller == 'user' ? ' active' : '' ?>" href="<?= BASE_URL?>/dashboard/users">
                                <i class="fas fa-user-cog me-2"></i> Users
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-10 ms-sm-auto main-content">
                <?php if (isset($flash) && $flash): ?>
                <div class="alert alert-<?= $flash['type'] ?> alert-dismissible fade show" role="alert">
                    <?= $flash['message'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>