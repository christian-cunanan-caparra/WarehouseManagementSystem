<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 * 
 * 
 * 
 * 
 * 
 * 
 */

 $routes->get('/', 'Home::index');

$routes->get('/', 'LoginController::login');  // Homepage route leads to login

// Authentication routes
$routes->get('/login', 'LoginController::login');
$routes->post('/login/authenticate', 'LoginController::authenticate');
$routes->get('/logout', 'LoginController::logout');

// Registration routes
$routes->get('/register', 'RegisterController::register');
$routes->post('/register/save', 'RegisterController::save');

// Dashboard routes (redirect based on role)
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/admin/dashboard', 'DashboardController::index');
$routes->get('/employee/dashboard', 'DashboardController::index');





        // Employee Dashboard Route
        $routes->get('/employee_dashboard', 'DashboardController::index');

        // Logout Route
        $routes->get('/logout', 'DashboardController::logout');

        // Manage Inventory Route (for viewing an inventory item and managing it)
        $routes->get('/manage_inventory/(:num)', 'DashboardController::manage_inventory/$1');

        // Update Inventory Route (for handling inventory updates)
        $routes->post('/update_inventory/(:num)', 'InventoryController::update/$1');

        // Other routes for admin or additional functionality can go here...

        // Admin Dashboard Route (if needed)
        $routes->get('/admin_dashboard', 'DashboardController::admin_dashboard');