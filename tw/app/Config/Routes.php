<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login', 'Login::index');
$routes->get('main', 'Main::index');
$routes->get('signup', 'Signup::index');
$routes->post('insertData', 'UserController::insertData');
$routes->post('loginUser', 'LoginController::loginUser');

