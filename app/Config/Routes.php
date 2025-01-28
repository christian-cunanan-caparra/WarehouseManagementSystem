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
$routes->get('/employee_dashboard', 'DashboardController::index');

$routes->get('/order/tracking', 'OrderController::index');
$routes->post('/order/updateStatus/(:num)', 'OrderController::updateStatus/$1');

$routes->get('/employee_dashboard', 'EmployeeDashboard::index');
$routes->get('/employee_dashboard/create', 'EmployeeDashboard::create');
$routes->post('/employee_dashboard/store', 'EmployeeDashboard::store');
$routes->get('/employee_dashboard/edit/(:num)', 'EmployeeDashboard::edit/$1');
$routes->post('/employee_dashboard/update/(:num)', 'EmployeeDashboard::update/$1');
$routes->get('/employee_dashboard/delete/(:num)', 'EmployeeDashboard::delete/$1');



