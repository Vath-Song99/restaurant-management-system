<?php

// Home routes
$router->get('/', 'HomeController', 'index');


$router->get('/dashboard', 'DashboardController', 'index');

// Authentication routes
$router->get('/auth/login', 'AuthController', 'login');
$router->post('/auth/login', 'AuthController', 'login');
$router->get('/auth/logout', 'AuthController', 'logout');
$router->get('/auth/forgot-password', 'AuthController', 'forgotPassword');
$router->post('/auth/forgot-password', 'AuthController', 'forgotPassword');
$router->get('/auth/reset-password/{token}', 'AuthController', 'resetPassword');
$router->post('/auth/reset-password/{token}', 'AuthController', 'resetPassword');


// Menu routes
// $router->get('/menu', 'MenuController', 'index');
// $router->get('/menu/{id}', 'MenuController', 'show');
// $router->get('/menu/create', 'MenuController', 'create');
// $router->post('/menu', 'MenuController', 'store');
// $router->get('/menu/{id}/edit', 'MenuController', 'edit');
// $router->put('/menu/{id}', 'MenuController', 'update');
// $router->delete('/menu/{id}', 'MenuController', 'destroy');

// // Order routes
// $router->get('/orders', 'OrderController', 'index');
// $router->get('/orders/{id}', 'OrderController', 'show');
// $router->post('/orders', 'OrderController', 'store');
// $router->put('/orders/{id}', 'OrderController', 'update');
// $router->delete('/orders/{id}', 'OrderController', 'destroy');

// // Reservation routes
// $router->get('/reservations', 'ReservationController', 'index');
// $router->post('/reservations', 'ReservationController', 'store');
// $router->get('/reservations/{id}', 'ReservationController', 'show');
// $router->put('/reservations/{id}', 'ReservationController', 'update');
// $router->delete('/reservations/{id}', 'ReservationController', 'destroy');

// errors
$router->get('/errors/403', 'ErrorController', 'forbidden');
$router->get('/errors/404', 'ErrorController', 'notFound');