<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/auth/logout', 'Auth::logout');

$routes->get('home', 'Home::index');

$routes->get('prospectos', 'Clientes::prospectos');

$routes->get('permisos', 'Permisos::index');

$routes->get('usuarios', 'Usuario::index');
$routes->get('consulta-dni/(:any)/(:any)', 'Usuario::api_dni_ruc/$1/$2');

$routes->get('tareas', 'Tareas::index');

$routes->get('instituciones', 'Instituciones::index');

$routes->get('carreras', 'Carreras::index');
// Mantenimientos - Feriados
$routes->get('feriados', 'Mantenimientos::feriados');

$routes->get('trabajos', 'Trabajos::index');
$routes->get('trabajos/data', 'Trabajos::data');
$routes->get('trabajos/sugerir', 'Trabajos::sugerirAuxiliares');
$routes->get('trabajos/reporte', 'Trabajos::reporteDisponibilidad');
