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

$routes->get('/employee_dashboard', 'DashboardController::index');
$routes->get('/employee_dashboard/create', 'DashboardController::create');
$routes->post('/employee_dashboard/store', 'DashboardController::store');
$routes->get('/employee_dashboard/edit/(:num)', 'DashboardController::edit/$1');
$routes->post('/employee_dashboard/update/(:num)', 'DashboardController::update/$1');
$routes->get('/employee_dashboard/delete/(:num)', 'DashboardController::delete/$1');



$routes->get('/employee_dashboard/activate/(:num)', 'DashboardController::activate/$1');



// $routes->get('chat/messages/(:num)', 'ChatController::getMessages/$1');
// $routes->post('chat/send/(:num)', 'ChatController::sendMessage/$1');

// $routes->get('chat', 'ChatController::index');
// $routes->get('chat/messages/(:num)', 'ChatController::getMessages/$1');
// $routes->post('chat/send', 'ChatController::sendMessage');
// $routes->get('chat/reset', 'ChatController::resetMessages');


// $routes->get('/chat', 'ChatController::index');
// $routes->get('/chat/getMessages/(:num)', 'ChatController::getMessages/$1');
// $routes->post('/chat/sendMessage', 'ChatController::sendMessage');


$routes->get('/chat', 'ChatController::index');
$routes->get('/chat/fetchMessages', 'ChatController::fetchMessages');
$routes->post('/chat/sendMessage', 'ChatController::sendMessage');


$routes->group('chat', function($routes) {
    $routes->post('sendMessage', 'ChatController::sendMessage');
    $routes->get('fetchMessages', 'ChatController::fetchMessages');
});