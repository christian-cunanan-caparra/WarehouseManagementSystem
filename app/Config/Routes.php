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

// $routes->get('/product/create', 'DashboardController::create');
$routes->post('/product/store', 'DashboardController::store');
$routes->get('/product/edit/(:num)', 'DashboardController::edit/$1');
$routes->post('/product/update/(:num)', 'DashboardController::update/$1');
$routes->get('/product/delete/(:num)', 'DashboardController::delete/$1');
$routes->get('/product/activate/(:num)', 'DashboardController::activate/$1');

// Employee Dashboard (Filtered Products)
$routes->get('/employee_dashboard', 'DashboardController::index');