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
