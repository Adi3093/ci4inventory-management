<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('stock', 'Stock::index');
$routes->get('masuk', 'Masuk::index');
$routes->get('keluar', 'Keluar::index');
$routes->get('masuk/edit/(:num)', 'Masuk::edit/$1');
$routes->post('masuk/update/(:num)', 'Masuk::update/$1');
$routes->get('masuk/hapus/(:num)', 'Masuk::hapus/$1');
$routes->post('masuk/tambah', 'Masuk::tambah');
