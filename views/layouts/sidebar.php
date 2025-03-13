<?php
// views/layouts/sidebar.php
?>
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
    <div class="position-sticky pt-3">
        <div class="p-3 text-center text-white">
            <h5><?= APP_NAME ?></h5>
        </div>
        <hr class="text-white">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= BASE_URL ?>/dashboard">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            
            <?php 
            // Get user permissions
            $role = new Role();
            $permissions = $role->getRolePermissions(SessionHelper::get('user_role_id'));
            $permissionNames = array_map(function($p) { return $p->permission_name; }, $permissions);
            
            // Check for user management permission
            if (in_array('manage_users', $permissionNames)): 
            ?>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= BASE_URL ?>/dashboard/users">
                    <i class="bi bi-people me-2"></i> Users
                </a>
            </li>
            <?php endif; ?>
            
            <?php if (in_array('manage_menu', $permissionNames)): ?>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= BASE_URL ?>/menu">
                    <i class="bi bi-card-list me-2"></i> Menu
                </a>
            </li>
            <?php endif; ?>
            
            <?php if (in_array('manage_inventory', $permissionNames)): ?>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= BASE_URL ?>/inventory">
                    <i class="bi bi-box me-2"></i> Inventory
                </a>
            </li>
            <?php endif; ?>
            
            <?php if (in_array('manage_orders', $permissionNames)): ?>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= BASE_URL ?>/orders">
                    <i class="bi bi-cart me-2"></i> Orders
                </a>
            </li>
            <?php endif; ?>
            
            <?php if (in_array('manage_tables', $permissionNames)): ?>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= BASE_URL ?>/tables">
                    <i class="bi bi-table me-2"></i> Tables
                </a>
            </li>
            <?php endif; ?>
            
            <?php if (in_array('view_reports', $permissionNames)): ?>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= BASE_URL ?>/reports">
                    <i class="bi bi-graph-up me-2"></i> Reports
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>