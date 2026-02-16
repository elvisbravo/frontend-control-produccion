<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/auth/logout', 'Auth::logout');

$routes->get('home', 'Home::index');

$routes->get('notifications', 'Notificaciones::getNotificacion');
$routes->get('countNotifications', 'Notificaciones::countNotificacion');

$routes->get('prospectos', 'Clientes::prospectos');
$routes->post('prospectos/crear', 'Clientes::saveProspecto');
$routes->get('prospecto/get-all', 'Clientes::getProspectos');
$routes->get('prospecto/get-row/(:num)', 'Clientes::getProspecto/$1');

$routes->get('permisos', 'Permisos::index');
$routes->get('permisos/lista-roles', 'Permisos::listaRoles');
$routes->post('permisos/guardar-rol', 'Permisos::guardarRol');
$routes->get('permisos/eliminar-rol/(:num)', 'Permisos::eliminarRol/$1');

$routes->get('usuarios', 'Usuario::index');
$routes->get('consulta-dni/(:any)/(:any)', 'Usuario::api_dni_ruc/$1/$2');
$routes->post('save-user', 'Usuario::create');
$routes->get('usuarios/get-all', 'Usuario::getUsers');
$routes->get('usuario/get-row/(:num)', 'Usuario::getUser/$1');
$routes->get('usuario/delete/(:num)', 'Usuario::delete/$1');

$routes->get('tareas', 'Tareas::index');
$routes->post('tareas/save', 'Tareas::create');
$routes->post('categorias/save', 'Tareas::createType');
$routes->get('categorias/get-all', 'Tareas::getAllCategories');
$routes->get('tareas/get-all', 'Tareas::getAllTareas');
$routes->get('categorias/delete/(:num)', 'Tareas::deleteType/$1');
$routes->get('tareas/delete/(:num)', 'Tareas::delete/$1');
$routes->get('tareas/get-row/(:num)', 'Tareas::getTarea/$1');
$routes->get('tareas/get-by-rol/(:num)', 'Clientes::getTareaByRol/$1');

$routes->get('instituciones', 'Instituciones::index');
$routes->post('instituciones/save', 'Instituciones::save');
$routes->get('instituciones/get-all', 'Instituciones::getInstituciones');
$routes->get('instituciones/delete/(:num)', 'Instituciones::delete/$1');


$routes->get('carreras', 'Carreras::index');
$routes->post('carreras/save', 'Carreras::save');
$routes->get('carreras/get-all', 'Carreras::getCarreras');
$routes->get('carreras/delete/(:num)', 'Carreras::delete/$1');
// Mantenimientos - Feriados
$routes->get('feriados', 'Feriados::index');
$routes->get('feriados/get-all', 'Feriados::getFeriados');
$routes->get('origen', 'Origen::index');
$routes->post('origen/save', 'Origen::create');
$routes->get('origen/get-all', 'Origen::getOrigenes');
$routes->get('origen/delete/(:num)', 'Origen::delete/$1');

$routes->get('trabajos', 'Trabajos::index');
$routes->get('trabajos/data', 'Trabajos::data');
$routes->get('trabajos/sugerir', 'Trabajos::sugerirAuxiliares');
$routes->get('trabajos/reporte', 'Trabajos::reporteDisponibilidad');

$routes->get('horario-by-id', 'Horario::getHorarioById');
