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
 * 
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
$routes->get('/product', 'DashboardController::index1');
$routes->get('/inventory_logs', 'DashboardController::index2');
$routes->get('/employee/dashboard', 'DashboardController::index');

$routes->get('/employee_dashboard', 'DashboardController::index');
$routes->get('/employee_dashboard/create', 'DashboardController::create');
$routes->post('/employee_dashboard/store', 'DashboardController::store');
$routes->get('/employee_dashboard/edit/(:num)', 'DashboardController::edit/$1');
$routes->post('/employee_dashboard/update/(:num)', 'DashboardController::update/$1');
$routes->get('/employee_dashboard/delete/(:num)', 'DashboardController::delete/$1');



$routes->get('/employee_dashboard/activate/(:num)', 'DashboardController::activate/$1');


$routes->get('/inventory', 'InventoryController::index');
$routes->post('/inventory/add-stock/(:num)', 'InventoryController::addStock/$1');
$routes->post('/inventory/remove-stock/(:num)', 'InventoryController::removeStock/$1');




$routes->get('/create-product', 'DashboardController::create');
$routes->post('/store-product', 'DashboardController::store');
$routes->get('/edit-product/(:num)', 'DashboardController::edit/$1');
$routes->post('/update-product/(:num)', 'DashboardController::update/$1');
$routes->get('/delete-product/(:num)', 'DashboardController::delete/$1');
$routes->get('/activate-product/(:num)', 'DashboardController::activate/$1');

// Inventory Management
$routes->post('/inventory/add-stock/(:num)', 'DashboardController::addStock/$1');
$routes->post('/inventory/remove-stock/(:num)', 'DashboardController::removeStock/$1');

// Logout
$routes->get('/logout', 'DashboardController::logout');


$routes->group('admin', function($routes) {
    // Admin Dashboard Route
    $routes->get('dashboard', 'DashboardController::index', ['filter' => 'role:admin']);

    // Activate Product Route
    $routes->post('activate/(:num)', 'DashboardController::activate/$1');
    
    // Add other admin-related routes here, if needed.
});

$routes->get('logout', 'DashboardController::logout');


$routes->get('/account-management', 'DashboardController::accountManagement');
// wala pa toh $routsses->get('/account-archive', 'DashboardController::accountArchive'); // Add this if you have an archive method

//reset pass


