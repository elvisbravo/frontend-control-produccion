<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');

$routes->get('home', 'Home::index');

$routes->get('prospectos', 'Clientes::prospectos');

$routes->get('permisos', 'Permisos::index');

$routes->get('usuarios', 'Usuario::index');

$routes->get('tareas', 'Tareas::index');

$routes->get('instituciones', 'Instituciones::index');

$routes->get('Carreras', 'Carreras::index');