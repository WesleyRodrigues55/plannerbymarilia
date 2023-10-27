<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');

// Usuário
$routes->get('/login', 'User::login');
$routes->get('/login/esqueceu-senha', 'User::esqueceuSenha');
$routes->get('/login/cadastro-usuario', 'User::cadastroUser');
$routes->post('/login/forgot', 'User::confirmacaoSenha');
$routes->post('/user/verificarlogin', 'User::verificarLogin');
$routes->get('/user/logout', 'User::logout');
$routes->get('/perfil/meus-depoimentos', 'User::meusDepoimentos');
$routes->post('/user/cadastroUsuario', 'User::cadastroUsuario');

// Administrador
$routes->get('/administrador/dashboard', 'Administrator::dashboard');
$routes->get('/administrador/cadastro-produto', 'Administrator::cadastroProduto');
$routes->get('/administrador/lista-produto', 'Administrator::listaProduto');
$routes->get('/administrador/lista-usuario', 'Administrator::listaUsuario');
$routes->get('/administrador/cadastro-categoria', 'Administrator::cadastroCategoria');
$routes->get('/administrador/lista-categoria', 'Administrator::listaCategoria');
$routes->get('/administrador/editar-categoria', 'Administrator::editarCategoria');
$routes->get('/administrador/editar-produto', 'Administrator::editarProduto');

// Depoimento
$routes->get('/depoimentos-clientes', 'Testimony::depoimentosClientes');
$routes->post('/testimony/salvar', 'Testimony::salvar');

// Produto
$routes->get('/planners', 'Product::planners');
$routes->get('/cadernos', 'Product::cadernos');
$routes->get('/agendas', 'Product::agendas');
$routes->get('/blocos', 'Product::blocos');
$routes->get('/mais-vendidos-semana', 'Product::maisVendidosSemana');
$routes->get('/presentes-criativos', 'Product::presentesCriativos');
$routes->get('/produto/(:any)', 'Product::pagePlanners/$1');

// Carrinho
$routes->get('/carrinho', 'BuyCart::carrinho');
$routes->post('/carrinho/soma-quantidade', 'BuyCart::somaQuantidade');
$routes->post('/carrinho/subtrai-quantidade', 'BuyCart::subtraiQuantidade');

// Políticas
$routes->get('/politicas/politica-loja', 'Home::politicaLoja');
$routes->get('/politicas/politica-privacidade', 'Home::politicaPrivacidade');
