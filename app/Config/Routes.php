<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


//ruta FILTER CREADOR para filtrar y mostrar el sistema al administrador

$routes->group('', ['filter' => 'auth'], function($routes) {
/* Tablas  */
//Vista Cliente
$routes->get('cliente', 'Clientes::index');
$routes->get('crear', 'Clientes::crear');
//CRUD CLIENTE
$routes->post('guardar', 'Clientes::guardar');
$routes->get('borrar/(:num)', 'Clientes::borrar/$1');
$routes->get('editar/(:num)', 'Clientes::editar/$1');
$routes->post('actualizar', 'Clientes::actualizar');

/* ______________________________________________________________________ */

//Vista Falda
$routes->get('datosFalda', 'Faldas::index');
$routes->get('falda', 'Faldas::falda');

//CRUD FALDA
$routes->post('guardarFalda', 'Faldas::guardarFalda');
$routes->get('borrarFalda/(:num)', 'Faldas::borrarFalda/$1');
$routes->get('editarFalda/(:num)', 'Faldas::editarFalda/$1');
$routes->post('actualizarFalda', 'Faldas::actualizarFalda');

/* ______________________________________________________________________ */

//Vista Pantalon
$routes->get('datosPantalon', 'Pantalons::index');
$routes->get('pantalon', 'Pantalons::pantalon');

//CRUD PANTALON
$routes->post('guardarPantalon', 'Pantalons::guardarPantalon');
$routes->get('borrarPantalon/(:num)', 'Pantalons::borrarPantalon/$1');
$routes->get('editarPantalon/(:num)', 'Pantalons::editarPantalon/$1');
$routes->post('actualizarPantalon', 'Pantalons::actualizarPantalon');

/* ______________________________________________________________________ */

//Vista TrajeFemenino
$routes->get('datosTrajeFemenino', 'TrajeFemeninos::index');
$routes->get('trajeFemenino', 'TrajeFemeninos::trajeFemenino');


//CRUD TRAJE FEMENINO
$routes->post('guardartrajeFemenino', 'TrajeFemeninos::guardartrajeFemenino');
$routes->get('borrartrajeFemenino/(:num)', 'TrajeFemeninos::borrartrajeFemenino/$1');
$routes->get('editartrajeFemenino/(:num)', 'TrajeFemeninos::editartrajeFemenino/$1');
$routes->post('actualizartrajeFemenino', 'TrajeFemeninos::actualizartrajeFemenino');

/* ______________________________________________________________________ */

//Vista TrajeMasculino
$routes->get('datosTrajeMasculino', 'TrajeMasculinos::index');
$routes->get('trajeMasculino', 'TrajeMasculinos::trajeMasculino');

//CRUD TRAJE MASCULINO
$routes->post('guardartrajeMasculino', 'TrajeMasculinos::guardartrajeMasculino');
$routes->get('borrartrajeMasculino/(:num)', 'TrajeMasculinos::borrartrajeMasculino/$1');
$routes->get('editartrajeMasculino/(:num)', 'TrajeMasculinos::editartrajeMasculino/$1');
$routes->post('actualizartrajeMasculino', 'TrajeMasculinos::actualizartrajeMasculino');

/* ______________________________________________________________________ */

$routes->get('venta', 'Ventas::index');

$routes->get('/confeccion', 'Confeccions::index');
$routes->get('/editarConfeccion/(:num)', 'Confeccions::editar/$1');
$routes->get('/borrarConfeccion/(:num)', 'Confeccions::borrar/$1');




});

$routes->set404Override(function () {
    return (new \App\Controllers\ErrorController())->show404();
});



//HTML SASTRERIA
$routes->get('comprar.html', 'Clientes::comprar');
$routes->get('traje.html', 'Clientes::traje');
$routes->get('diseno.html', 'Clientes::diseno');
$routes->get('novedad.html', 'Clientes::novedad');
$routes->get('sacoFemenino.html', 'Clientes::sacoFemenino');
$routes->get('sacoMasculino.html', 'Clientes::sacoMasculino');
$routes->get('index.html', 'Clientes::index1');
$routes->get('nosotros.html', 'Clientes::nosotros');
$routes->get('tienda', 'Clientes::tienda');




//Login

$routes->get('/login', 'Auth::login');
$routes->post('/auth/login', 'Auth::login'); // Asegúrate de que el formulario apunte a esta ruta
$routes->post('/auth/register', 'Auth::register');











$routes->get('producto', 'Productos::producto');
$routes->post('guardarProducto', 'Productos::guardar');
