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
