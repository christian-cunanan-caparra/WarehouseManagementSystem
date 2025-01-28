<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Route to the homepage (redirects to login)
$routes->get('/', 'LoginController::login');  // Use only one route for home page

// Authentication routes
$routes->get('/login', 'LoginController::login');
$routes->post('/login/authenticate', 'LoginController::authenticate');
$routes->get('/logout', 'LoginController::logout');

// Registration routes
$routes->get('/register', 'RegisterController::register');
$routes->post('/register/save', 'RegisterController::save');

// Dashboard routes (redirect based on role)
$routes->get('/dashboard', 'DashboardController::index'); // Redirect to Dashboard based on role
$routes->get('/admin/dashboard', 'DashboardController::admin_dashboard');
$routes->get('/employee/dashboard', 'DashboardController::employee_dashboard');

// Employee Dashboard Route
$routes->get('/employee_dashboard', 'DashboardController::index');

// Manage Inventory Route (for viewing an inventory item and managing it)
$routes->get('/manage_inventory/(:num)', 'DashboardController::manage_inventory/$1');

// Update Inventory Route (for handling inventory updates)
$routes->post('/update_inventory/(:num)', 'InventoryController::update/$1');

// Admin Dashboard Route
$routes->get('/admin_dashboard', 'DashboardController::admin_dashboard');
