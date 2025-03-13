<?php
// views/layouts/header.php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= PUBLIC_ROOT ?>/css/styles.css">
    <link rel="icon" href="https://cdn.pixabay.com/photo/2021/05/25/02/03/restaurant-6281067_1280.png" type="image/x-icon">
</head>

<body>
    <?php if (SessionHelper::exists('is_logged_in') && SessionHelper::get('is_logged_in')): ?>
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <?php require_once APP_ROOT . '/views/layouts/sidebar.php'; ?>

                <!-- Main content -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                    <!-- Top navigation bar -->
                    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
                        <div class="container-fluid">
                            <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#sidebarMenu">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="navbar-nav ms-auto">
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-person-circle me-1"></i> <?= SessionHelper::get('user_name') ?>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <li><a class="dropdown-item" href="<?= BASE_URL ?>/auth/logout">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>

                    <!-- Flash messages -->
                    <?= FlashHelper::flash('success') ?>
                    <?= FlashHelper::flash('error') ?>
                    <?php
                    // views/layouts/footer.php
                    ?>
                </main>
            </div>
        </div>
    <?php else: ?>
        <div class="container py-4">
            <!-- Flash messages -->
            <?= FlashHelper::flash('login_error') ?>
            <?= FlashHelper::flash('login_success') ?>
            <?= FlashHelper::flash('logout_success') ?>
            <?= FlashHelper::flash('success') ?>
            <?= FlashHelper::flash('error') ?>
        <?php endif; ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="<?= PUBLIC_ROOT ?>/js/scripts.js"></script>
</body>

</html>