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
$routes->get('/L2FkbWluX2Rhc2hib2FyZA', 'DashboardController::index');

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
$routes->get('/account-management', 'DashboardController::accountManagement');
// wala psa toh $routsses->get('/account-archive', 'DashboardController::accountArchive'); // Add this if you have an archive method

//reset pass




$routes->get('/admin_dashboard', 'DashboardController::index');

$routes->get('/request-reset', 'PasswordResetController::requestReset');
$routes->post('/send-reset-code', 'PasswordResetController::sendResetCode');
$routes->get('/verify-reset-code', 'PasswordResetController::verifyResetCode');
$routes->post('/process-verification', 'PasswordResetController::processVerification');
$routes->get('/reset-password', 'PasswordResetController::resetPassword');
$routes->post('/process-reset-password', 'PasswordResetController::processResetPassword');


$routes->get('/account-management', 'DashboardController::accountManagement');
$routes->get('/YWNjb3VudC1tYW5hZ2VtZW50', 'DashboardController::accountManagement');

$routes->get('/create-account', 'DashboardController::createAccount');
$routes->post('/store-account', 'DashboardController::storeAccount');
$routes->get('/edit-account/(:num)', 'DashboardController::editAccount/$1');
$routes->post('/update-account/(:num)', 'DashboardController::updateAccount/$1');
$routes->get('/delete-account/(:num)', 'DashboardController::deleteAccount/$1');


$routes->get('/archive-accounts', 'DashboardController::archiveAccounts');  // To view the archive (inactive) accounts
$routes->get('/YXJjaGl2ZS1hY2NvdW50cw', 'DashboardController::archiveAccounts');  // To view the archive (inactive) accounts



$routes->get('/restore-account/(:num)', 'DashboardController::restoreAccount/$1');  // To restore a specific account



$routes->get('/waiting-confirmation', 'LoginController::waitingConfirmation');


$routes->get('/inventory-log', 'DashboardController::inventoryLogsPage');



//req product

$routes->get('/request-product', 'RequestController::requestprod');
$routes->get('/cmVxdWVzdC1wcm9kdWN0', 'RequestController::requestprod');


//admin invent logs


$routes->get('/product-list', 'AdminController::productList');
$routes->get('/add-product', 'AdminController::addProduct');
$routes->post('/save-product', 'AdminController::saveProduct');
$routes->get('/edit-product/(:num)', 'AdminController::editProduct/$1');
$routes->post('/update-product/(:num)', 'AdminController::updateProduct/$1');
$routes->get('/delete-product/(:num)', 'AdminController::deleteProduct/$1');
