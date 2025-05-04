<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/artikel', 'Artikel::index');
$routes->get('/artikel/create', 'Artikel::create');         // Menampilkan form
$routes->post('/artikel/store', 'Artikel::store');         // Menyimpan data
$routes->get('/artikel/get/(:num)', 'Artikel::getArtikel/$1');
$routes->get('/artikel/edit/(:num)', 'Artikel::edit/$1');
$routes->post('/artikel/update/(:num)', 'Artikel::update/$1');
$routes->post('/artikel/delete/(:num)', 'Artikel::delete/$1');




