<?php

use App\Controllers\RegisterController;
use App\Controllers\RegisterPenjualController;
use App\Controllers\MessagePembeliController;
use App\Controllers\MessagePenjualController;

$routes->get('/', 'Home::index');

//routes register customer
$routes->resource('data', ['controller' => 'RegisterController']);
$routes->match(['post','options'], 'addregister', 'RegisterController::create');
$routes->match(['get','options'], 'register/(:any)', 'RegisterController::getUser/$1');
$routes->match(['put','options'], 'update-register/(:segment)', 'RegisterController::updateUser/$1');
$routes->match(['delete','options'], 'delete-register/(:segment)', 'RegisterController::deleteUser/$1');

// $routes->match(['post','options'], 'addregister', 'RegisterController::login');

//routes register penjual
$routes->resource('datapenjual', ['controller' => 'RegisterPenjualController']);
$routes->match(['post','options'], 'registerpenjual', 'RegisterPenjualController::createakunpenjual');
$routes->match(['get','options'], 'getpenjual/(:any)', 'RegisterPenjualController::getakunpenjual/$1');
$routes->match(['put','options'], 'updateakunpenjual/(:segment)', 'RegisterPenjualController::updateakunpenjual/$1');
$routes->match(['delete','options'], 'deleteakunpenjual/(:segment)', 'RegisterPenjualController::deleteakunpenjual/$1');

//routes message pembeli
$routes->resource('datamessagepembeli', ['controller' => 'MessagePembeliController']);
$routes->match(['post','options'], 'addmessagepembeli', 'MessagePembeliController::createmessagepembeli');
$routes->match(['get','options'], 'messagepembeli/(:any)', 'MessagePembeliController::getmessagepembeli/$1');
$routes->match(['put','options'], 'editmessagepembeli/(:segment)', 'MessagePembeliController::updatemessagepembeli/$1');
$routes->match(['delete','options'], 'hapusmessagepembeli/(:segment)', 'MessagePembeliController::deletemessagepembeli/$1');

//routes message penjual
$routes->resource('datamessagepenjual', ['controller' => 'MessageController']);
$routes->match(['post','options'], 'addmessagepenjual', 'MessageController::createmessagepenjual');
$routes->match(['get','options'], 'messagepenjual/(:any)', 'MessageController::getmessagepenjual/$1');
$routes->match(['put','options'], 'editmessagepenjual/(:segment)', 'MessageController::updatemessagepenjual/$1');
$routes->match(['delete','options'], 'hapusmessagepenjual/(:segment)', 'MessageController::deletemessagepenjual/$1');