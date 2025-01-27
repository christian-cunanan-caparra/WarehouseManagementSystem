<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/', 'LoginController::index');
$routes->post('/login/authenticate', 'LoginController::authenticate');
$routes->get('/logout', 'LoginController::logout');

$routes->get('/register', 'RegisterController::register');
$routes->post('/register/save', 'RegisterController::save');

$routes->get('/dashboard', 'DashboardController::index');


$routes->get('/login', 'LoginController::login');
$routes->post('/login/authenticate', 'LoginController::authenticate');
$routes->get('/logout', 'LoginController::logout');

// For admin and employee dashboards
$routes->get('/admin/dashboard', 'AdminController::dashboard');
$routes->get('/employee/dashboard', 'EmployeeController::dashboard');



$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/admin/dashboard', 'DashboardController::index'); // Admin dashboard route
$routes->get('/employee/dashboard', 'DashboardController::index'); // Employee dashboard route
