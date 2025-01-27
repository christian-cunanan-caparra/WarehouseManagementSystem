<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->get('/login', 'Auth::login');  // Login page
$routes->get('/register', 'Auth::register');  // Register page
$routes->post('/register', 'Auth::registerSubmit');  // Handle registration form submission
$routes->post('/login', 'Auth::loginSubmit');  // Handle login form submission
$routes->get('/dashboard', 'Dashboard::index');  // Dashboard page after login
