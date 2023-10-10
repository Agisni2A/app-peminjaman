<?php

use App\Controllers\ItemController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->get('/', 'Clogin::index');
$routes->get('/login', 'Clogin::index');
$routes->post('/login/process', 'CLogin::loginProcess');
$routes->get('/logout', 'CLogin::logout');
$routes->get('/user/changePasswordToHash', 'login::changePasswordToHash');

$routes->group('dashboard', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'CDashboard::index');
    $routes->get('add', 'CDashboard::addItem');
    $routes->get('edit', 'ItemController::edit');
    $routes->get('master/muser', 'CDashboard::muser');
    $routes->get('master/maset', 'CDashboard::maset');
    $routes->get('mmenu/pinjam', 'CDashboard::pinjam');
    $routes->get('mmenu/kembali', 'CDashboard::kembali');
    $routes->get('maset/item', 'ItemController::index');
    $routes->post('getKode', 'ItemController::getKode');
    $routes->post('getEmployeKode', 'ItemController::getEmployeKode');
    $routes->post('getKodeItems', 'ItemController::getDataByKodeItem');
    $routes->post('returnItem', 'ItemController::returns');
    $routes->post('maset/item/edit', 'ItemController::edit');
    $routes->post('addAction', 'ItemController::addItemAction');
    $routes->post('editAction', 'ItemController::editAction');
    $routes->post('Pinjamitem', 'EmployeController::pinjam');
    $routes->post('loadEmployee', 'EmployeController::index');
    $routes->get('coba', 'ItemController::index');
});

$routes->group('dashboard/master/maset', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->post('item/edit', 'ItemController::edit');
    $routes->post('item/delete', 'ItemController::delete');
});
