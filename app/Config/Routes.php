<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');



// $routes->group('usuarios', ['filter' => 'auth'], function ($routes) {
//     $routes->get('/', 'Auth::index');          // Página de lista de usuarios
//     $routes->get('crear', 'Auth::crear');      // Formulario para crear un usuario
//     $routes->post('guardar', 'Auth::guardar'); // Acción para guardar un nuevo usuario
//     $routes->get('editar/(:num)', 'Auth::editar/$1'); // Formulario para editar un usuario
//     $routes->post('actualizar', 'Auth::actualizar');  // Acción para actualizar un usuario
//     $routes->get('borrar/(:num)', 'Auth::borrar/$1'); // Acción para borrar un usuario
// });

$routes->group('', ['filter' => 'auth'], function ($routes) {


    $routes->get('usuarios', 'Auth::index');              // Página de lista de usuarios
    $routes->get('usuarios/crear', 'Auth::crear');        // Formulario para crear un usuario
    $routes->post('usuarios/guardar', 'Auth::guardar');   // Acción para guardar un nuevo usuario
    $routes->get('usuarios/editar/(:num)', 'Auth::editarUsuarios/$1'); // Formulario para editar un usuario
    $routes->post('usuarios/actualizar', 'Auth::actualizar');  // Acción para actualizar un usuario
    $routes->get('usuarios/borrar/(:num)', 'Auth::borrar/$1'); // Acción para borrar un usuario
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
    $routes->get('/venta', 'Ventas::index');
    $routes->get('/crearVenta', 'Ventas::crear');
    $routes->post('/guardarVenta', 'Ventas::guardarVenta');
    $routes->get('ventas/editar/(:num)', 'Ventas::editar/$1');  // Editar venta
    $routes->post('actualizarVenta/(:num)', 'Ventas::actualizarVenta/$1');  // Actualizar venta
    $routes->get('ventas/borrar/(:num)', 'Ventas::borrar/$1');  // Borrar venta
    $routes->get('venta/confirmarPago', 'Ventas::confirmarPago'); // Para mostrar la vista de confirmación de pago




    $routes->get('/confeccion', 'Confeccions::index');  // Mostrar lista de confecciones
    $routes->get('crearConfeccion', 'Confeccions::crear');
    $routes->post('/confeccion/guardar', 'Confeccions::guardar');  // Guardar la confección creada
    $routes->get('/confeccion/editar/(:num)', 'Confeccions::editar/$1');  // Mostrar formulario de edición
    $routes->post('/confeccion/actualizar/(:num)', 'Confeccions::actualizar/$1');  // Actualizar confección
    $routes->get('/confeccion/borrar/(:num)', 'Confeccions::borrar/$1');  // Borrar confección

    $routes->get('exportarPDF/completadas', 'DompdfController::exportarCompletadasPDF');
    $routes->get('exportarPDF/pendientes', 'DompdfController::exportarPendientesPDF');


    $routes->get('reportes', 'ReportesController::index');
    //REPORTE VISTA
    $routes->get('/exportarPDF/estadoClientes/(:segment)', 'ReportesController::exportarPDF/$1');
    $routes->get('exportarPDF/ventasPorFecha', 'ReportesController::generarHtmlVentasPorFecha');
    //Reporte Procedural
    $routes->get('/exportarPDF/deudores', 'ReportesController::exportarPDFDeudores');
    //Reporte estatico
    $routes->get('exportarPDF/deudaPorCliente', 'ReportesController::exportarPDFDeudaPorCliente');

});

$routes->get('/telas', 'Telas::index');
//CRUD
$routes->get('/crearTela', 'Telas::crear');
$routes->post('/guardarTela', 'Telas::guardar');
$routes->get('/telas/editar/(:num)', 'Telas::editar/$1');
$routes->post('/telas/actualizar/(:num)', 'Telas::actualizar/$1');
$routes->get('/telas/borrar/(:num)', 'Telas::borrar/$1');
$routes->get('/telas/mostrar', 'Telas::mostrarTela');


$routes->get('reservas/ver/(:num)', 'Reservas::ver/$1', ['as' => 'reservas.ver']);
$routes->get('reservas/mis-reservas', 'Reservas::misReservas', ['as' => 'reservas.misReservas']);
$routes->get('reservas/editar/(:num)', 'Reservas::editar/$1', ['as' => 'reservas.editar']);
$routes->post('reservas/actualizar/(:num)', 'Reservas::actualizar/$1', ['as' => 'reservas.actualizar']);
//CRUD
$routes->get('reservas/seleccionarTela/(:num)', 'Reservas::seleccionarTela/$1');
$routes->post('reservas/guardarReserva', 'Reservas::guardarReserva');
$routes->get('reservas', 'Reservas::listarReservas');
$routes->get('reservas/cancelar/(:num)', 'Reservas::cancelar/$1');




$routes->get('/telaTraje', 'Telas::mostrarTelaTraje');


$routes->get('auth/olvidar-contrasenia', 'Auth::olvidarContrasenia');
$routes->post('auth/olvido_contrasenia', 'Auth::olvidoContrasenia');

$routes->set404Override(function () {
    return (new \App\Controllers\ErrorController())->show404();
});



//HTML SASTRERIA
$routes->get('index.html', 'Clientes::index1');
$routes->get('nosotros.html', 'Clientes::nosotros');
$routes->get('contacto.html', 'Clientes::contacto');


//Login
$routes->get('/login', 'Auth::login');
$routes->post('/auth/login', 'Auth::login'); // Asegúrate de que el formulario apunte a esta ruta
$routes->post('/auth/register', 'Auth::register');


//SALIR LOGIN
$routes->get('auth/logout', 'Auth::logout');


//MI-CUENTA
$routes->get('mi-cuenta', 'Auth::miCuenta'); // Muestra la vista "Mi Cuenta"
$routes->post('mi-cuenta/cambiar-contrasena', 'Auth::cambiarContrasena'); // Procesa el cambio de contraseña


// CONTRASEÑA ERROR 
$routes->get('mi-cuenta/olvidaste-tu-contrasena', 'Auth::olvidarContrasena');


// //SE USARA LUEGO 
// $routes->get('producto', 'Productos::producto');
// $routes->post('guardarProducto', 'Productos::guardar');
