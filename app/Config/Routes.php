<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('masuk', 'Masuk::index');
$routes->get('keluar', 'Keluar::index');
$routes->get('masuk/edit/(:num)', 'Masuk::edit/$1');
$routes->post('masuk/update/(:num)', 'Masuk::update/$1');
$routes->get('masuk/hapus/(:num)', 'Masuk::hapus/$1');
$routes->post('masuk/tambah', 'Masuk::tambah');
$routes->get('stock', 'Stock::index');
$routes->post('stock/tambah', 'Stock::tambah');
$routes->post('stock/update/(:num)', 'Stock::update/$1');
$routes->get('stock/hapus/(:num)', 'Stock::hapus/$1');
$routes->post('keluar/tambah', 'Keluar::tambah');
$routes->post('keluar/update/(:num)', 'Keluar::update/$1');
$routes->get('keluar/hapus/(:num)', 'Keluar::hapus/$1');
