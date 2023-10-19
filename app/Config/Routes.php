<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');

$routes->get('login', 'User::login');
$routes->get('/login/esqueceu-senha', 'User::esqueceuSenha');
$routes->get('/login/cadastro-usuario', 'User::cadastroUser');
$routes->add('user/verificarlogin', 'User::verificarLogin');
$routes->add('user/logout', 'User::logout');

$routes->get('/adm/cadastroAdm', 'User::cadastroAdm');

$routes->add('/planners', 'Product::planners');
$routes->add('/cadernos', 'Product::cadernos');
$routes->add('/agendas', 'Product::agendas');
$routes->add('/blocos', 'Product::blocos');
$routes->add('/mais-vendidos-semana', 'Product::maisVendidosSemana');
$routes->add('/presentes-criativos', 'Product::presentesCriativos');

