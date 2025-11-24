<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('stock', 'Stock::index');
$routes->get('masuk', 'Masuk::index');
$routes->get('keluar', 'Keluar::index');
