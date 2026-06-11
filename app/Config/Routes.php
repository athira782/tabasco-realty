<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'AuthController::index');
$routes->get('login', 'AuthController::index');
$routes->post('login', 'AuthController::attemptLogin');
$routes->get('logout', 'AuthController::logout');
$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);

// Module Placeholders (Coming Soon)
$routes->get('projects', 'ProjectController::index', ['filter' => 'auth']);
$routes->get('sales', 'SalesController::index', ['filter' => 'auth']);
$routes->get('customers', 'CustomerController::index', ['filter' => 'auth']);
$routes->get('emi', 'EmiController::index', ['filter' => 'auth']);
$routes->get('expenses', 'ExpenseController::index', ['filter' => 'auth']);
$routes->get('petty-cash', 'PettyCashController::index', ['filter' => 'auth']);
$routes->get('loans', 'LoanController::index', ['filter' => 'auth']);
$routes->get('brokerage', 'BrokerageController::index', ['filter' => 'auth']);
$routes->get('reports', 'ReportController::index', ['filter' => 'auth']);

// User Management
$routes->group('users', ['filter' => ['auth', 'permission:users,view']], function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create', ['filter' => ['auth', 'permission:users,create']]);
    $routes->post('store', 'UserController::store', ['filter' => ['auth', 'permission:users,create']]);
    $routes->get('edit/(:any)', 'UserController::edit/$1', ['filter' => ['auth', 'permission:users,edit']]);
    $routes->post('update/(:any)', 'UserController::update/$1', ['filter' => ['auth', 'permission:users,edit']]);
    $routes->post('deactivate/(:any)', 'UserController::deactivate/$1', ['filter' => ['auth', 'permission:users,edit']]);
});