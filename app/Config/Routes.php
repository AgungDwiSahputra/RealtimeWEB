<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->get('/pages/dashboard', 'Pages::dashboard', ['filter' => 'auth']);
$routes->get('/pages/users', 'Pages::users', ['filter' => 'auth']);
$routes->get('/pages/users/edit', 'Pages::edituser', ['filter' => 'auth']);
$routes->get('/pages/banksoal', 'Pages::banksoal', ['filter' => 'auth']);
$routes->get('/pages/banksoal/edit', 'Pages::editsoal', ['filter' => 'auth']);
$routes->get('/pages/perbandingan', 'Pages::perbandingan', ['filter' => 'auth']);
$routes->get('/logout', 'Login::logout');

$routes->get('/delete/user/(:num)', 'Delete::user/$1', ['filter' => 'auth']);
$routes->get('/pages/users/edit/(:num)', 'Pages::edituser/$1', ['filter' => 'auth']);
$routes->get('/pages/banksoal/edit/(:num)', 'Pages::editsoal/$1', ['filter' => 'auth']);
$routes->get('/pages/kategori/edit/(:num)', 'Pages::editkategori/$1', ['filter' => 'auth']);
$routes->get('/pages/perbandingan/(:segment)', 'Pages::resultPerbandingan/$1', ['filter' => 'auth']);

/* Soal */
$routes->get('/pages/soal/(:segment)', 'Pages::list_soal/$1', ['filter' => 'auth']);
$routes->get('/pages/soal/(:segment)/(:num)', 'Pages::list_soal/$1/$2', ['filter' => 'auth']);
//$routes->get('/pages/soal/(:segment)/(:num)/(:segment)/1', 'Pages::list_soal/$1/$2/$3', ['filter' => 'auth']);
$routes->get('/pages/soal/(:segment)/(:num)/(:segment)', 'Pages::list_soal/$1/$2/$3', ['filter' => 'auth']);
// $routes->get('/pages/soal/berhitung/(:num)', 'Pages::berhitung/$1', ['filter' => 'auth']);
// $routes->post('/pages/soal/berhitung/(:num)/(:segment)', 'Pages::berhitung/$1/$2', ['filter' => 'auth']);
// $routes->get('/pages/soal/membaca/(:num)', 'Pages::membaca/$1', ['filter' => 'auth']);
// $routes->post('/pages/soal/membaca/(:num)/(:segment)', 'Pages::membaca/$1/$2', ['filter' => 'auth']);
// $routes->get('/pages/soal/menulis/(:num)', 'Pages::menulis/$1', ['filter' => 'auth']);
// $routes->post('/pages/soal/menulis/(:num)/(:segment)', 'Pages::menulis/$1/$2', ['filter' => 'auth']);


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
