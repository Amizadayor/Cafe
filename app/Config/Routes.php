<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');




/*----------------  CREACIÓN DE LAS RUTAS ----------- */

// DIRECCIÓN DE LA API --> http://localhost:8080/api
$routes->group('api', ['namespace' => 'App\Controllers\API'], function($routes){

/*----------------  CREACIÓN DE LAS RUTAS DE LA TABLA USUARIO ----------- */

    // http://localhost:8080/api/usuario --> GET
    $routes->get('usuario', 'Usuario::index');
    // http://localhost:8080/api/usuario/show/(id) --> SHOW
    $routes->get('usuario/show/(:num)','Usuario::show/$1');
    // http://localhost:8080/api/usuario/create --> CREAR
    $routes->post('usuario/create', 'Usuario::create');
    // http://localhost:8080/api/usuario/update/(id) --> EDITAR
    $routes->put('usuario/update/(:num)', 'Usuario::update/$1');
    // http://localhost:8080/api/usuario/delete/(id) --> ELIMINAR
    $routes->delete('usuario/delete/(:num)', 'Usuario::delete/$1');

/*----------------  CREACIÓN DE LAS RUTAS DE LA TABLA CATEGORIA ----------- */

    // http://localhost:8080/api/categoria --> GET
    $routes->get('categoria', 'Categoria::index');
    // http://localhost:8080/api/categoria/show/(id) --> SHOW
    $routes->get('categoria/show/(:num)','Categoria::show/$1');
    // http://localhost:8080/api/categoria/create --> CREAR
    $routes->post('categoria/create', 'Categoria::create');
    // http://localhost:8080/api/categoria/update/(id) --> EDITAR
    $routes->put('categoria/update/(:num)', 'Categoria::update/$1');
    // http://localhost:8080/api/usuario/delete/(id) --> ELIMINAR
    $routes->delete('categoria/delete/(:num)', 'Categoria::delete/$1');

    /*----------------  CREACIÓN DE LAS RUTAS DE LA TABLA PRODUCTOS ----------- */

    // http://localhost:8080/api/producto --> GET
    $routes->get('producto', 'Producto::index');
    // http://localhost:8080/api/producto/show/(id) --> SHOW
    $routes->get('producto/show/(:num)','Producto::show/$1');
    // http://localhost:8080/api/producto/create --> CREAR
    $routes->post('producto/create', 'Producto::create');
    // http://localhost:8080/api/producto/update/(id) --> EDITAR
    $routes->put('producto/update/(:num)', 'Producto::update/$1');
    // http://localhost:8080/api/producto/delete/(id) --> ELIMINAR
    $routes->delete('producto/delete/(:num)', 'Producto::delete/$1');

});

/*--------------------------------------------------- */







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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
