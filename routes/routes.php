<?php

// Home routes
$router->get('/', 'HomeController', 'index');
$router->get('/about', 'HomeController', 'about');
$router->get('/contact', 'HomeController', 'contact');

$router->get('/menu', 'HomeController', 'menu');
$router->get('/menu/getMenuByCategory/{categoryId}', 'MenuController', 'getMenuByCategory');
$router->get('/menu/getMenuByCategory/{categoryId}', 'MenuController', 'getMenuByCategory');


$router->get('/reservation', 'HomeController', 'reservation');

$router->post('/reservation', 'ReservationController', 'createReservation');

// Authentication routes
$router->get('/auth/login', 'AuthController', 'login');
$router->post('/auth/login', 'AuthController', 'login');
$router->get('/auth/logout', 'AuthController', 'logout');
$router->get('/auth/forgot-password', 'AuthController', 'forgotPassword');
$router->post('/auth/forgot-password', 'AuthController', 'forgotPassword');
$router->get('/auth/reset-password/{token}', 'AuthController', 'resetPassword');
$router->post('/auth/reset-password/{token}', 'AuthController', 'resetPassword');
$router->get('/auth/login/qrcode/{token}', 'AuthController', 'loginWithQrcode');

// Dashboard routes
$router->get('/dashboard', 'DashboardController', 'index');

// Menu Items
$router->get('/dashboard/menu-items', 'MenuItemController', 'index');
$router->get('/dashboard/menu-items/create', 'MenuItemController', 'create');
$router->post('/dashboard/menu-items/create', 'MenuItemController', 'create');
$router->get('/dashboard/menu-items/edit/{id}', 'MenuItemController', 'edit');
$router->post('/dashboard/menu-items/edit/{id}', 'MenuItemController', 'edit');
$router->get('/dashboard/menu-items/delete/{id}', 'MenuItemController', 'delete');
$router->post('/dashboard/menu-items/delete/{id}', 'MenuItemController', 'delete');

// Reservations
$router->get('/dashboard/reservations', 'ReservationController', 'index');
$router->get('/dashboard/reservations/create', 'ReservationController', 'create');
$router->post('/dashboard/reservations/create', 'ReservationController', 'create');
$router->get('/dashboard/reservations/edit/{id}', 'ReservationController', 'edit');
$router->post('/dashboard/reservations/edit/{id}', 'ReservationController', 'edit');
$router->get('/dashboard/reservations/delete/{id}', 'ReservationController', 'delete');
$router->post('/dashboard/reservations/delete/{id}', 'ReservationController', 'delete');
$router->get('/dashboard/reservations/toggle-status/{id}', 'ReservationController', 'toggle');
$router->post('/dashboard/reservations/toggle-status/{id}', 'ReservationController', 'toggle');

// Orders
$router->get('/dashboard/orders', 'OrderController', 'index');
$router->get('/dashboard/orders/cancel/{id}', 'OrderController', 'cancel');
$router->post('/dashboard/orders/cancel/{id}', 'OrderController', 'cancel');
$router->get('/dashboard/orders/view/{id}', 'OrderController', 'view');
$router->post('/dashboard/orders/view/{id}', 'OrderController', 'view');

// Staff
$router->get('/dashboard/staffs', 'StaffController', 'index');
$router->get('/dashboard/staffs/create', 'StaffController', 'create');
$router->post('/dashboard/staffs/create', 'StaffController', 'create');
$router->get('/dashboard/staffs/edit/{id}', 'StaffController', 'edit');
$router->post('/dashboard/staffs/edit/{id}', 'StaffController', 'edit');
$router->get('/dashboard/staffs/delete/{id}', 'StaffController', 'delete');
$router->post('/dashboard/staffs/delete/{id}', 'StaffController', 'delete');

// Users
$router->get('/dashboard/users', 'UserController', 'index');
$router->get('/dashboard/users/create', 'UserController', 'create');
$router->post('/dashboard/users/create', 'UserController', 'create');
$router->get('/dashboard/users/edit/{id}', 'UserController', 'edit');
$router->post('/dashboard/users/edit/{id}', 'UserController', 'edit');
$router->get('/dashboard/users/delete/{id}', 'UserController', 'delete');
$router->post('/dashboard/users/delete/{id}', 'UserController', 'delete');
$router->get('/dashboard/users/qrcode/{id}', 'UserController', 'qrcode');
$router->post('/dashboard/users/qrcode/{id}', 'UserController', 'qrcode');
$router->get('/dashboard/download/qrcode/{id}', 'UserController', 'downloadQrcode');

// errors
$router->get('/errors/403', 'ErrorController', 'forbidden');
$router->get('/errors/404', 'ErrorController', 'notFound');