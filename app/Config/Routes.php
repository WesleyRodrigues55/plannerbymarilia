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
$routes->get('/login/nova-senha', 'User::novaSenha');
$routes->get('/login/cadastro-usuario', 'User::cadastroUser');
$routes->get('/login/forgot', 'User::confirmacaoSenha'); // CORRIGIR
$routes->post('/user/verificarlogin', 'User::verificarLogin');
$routes->get('/user/logout', 'User::logout');
$routes->get('/perfil/meus-depoimentos', 'User::meusDepoimentos');
$routes->get('/perfil/perfil-usuario', 'User::perfilUsuario');
$routes->post('/user/cadastroUsuario', 'User::cadastroUsuario');

$routes->post('/user/alterar-pessoa', 'User::alterarPessoa');
$routes->post('/user/alterar-usuario', 'User::AlterarUsuarioLogado');

// Administrador
$routes->get('/administrador/dashboard', 'Administrator::dashboard');
    // produto
$routes->get('/administrador/cadastro-produto', 'Administrator::cadastroProduto');
$routes->get('/administrador/lista-produto', 'Administrator::listaProduto');
$routes->get('/administrador/editar-produto/(:any)', 'Administrator::editarProduto/$1');
$routes->post('/administrador/alterar-produto', 'Administrator::alterarProduto');
$routes->post('/administrador/insere-produto', 'Administrator::insereProduto');
$routes->post('/administrador/desativar-produto', 'Administrator::desativarProduto');
    // capas produto
$routes->get('/administrador/cadastro-capas-produto/(:any)', 'Administrator::cadastroCapasProduto/$1');
$routes->get('/administrador/lista-capas-produto/(:any)', 'Administrator::listaCapasProduto/$1');
$routes->get('/administrador/editar-capa-produto/(:any)', 'Administrator::editarCapaProduto/$1');
$routes->post('/administrador/alterar-capa-produto', 'Administrator::alterarCapaProduto');
$routes->post('/administrador/insere-capas-produto', 'Administrator::insereCapasProduto');
$routes->post('/administrador/desativar-capa-produto', 'Administrator::desativarCapaProduto');
    // opcoes adicionais
$routes->get('/administrador/cadastro-opcoes-adicionais', 'Administrator::cadastroOpcaoAdicional');
$routes->get('/administrador/lista-opcoes-adicionais', 'Administrator::listaOpcoesAdicionais');
$routes->get('/administrador/editar-opcoes-adicionais/(:any)', 'Administrator::editarOpcoesAdicionais/$1');
$routes->post('/administrador/alterar-opcoes-adicionais', 'Administrator::alterarOpcoesAdicionais');
$routes->post('/administrador/insere-opcoes-adicionais', 'Administrator::insereOpcaoAdicional');
$routes->post('/administrador/desativar-opcoes-adicionais', 'Administrator::desativarOpcoesAdicionais');
    // usuarios
$routes->get('/administrador/lista-usuario', 'Administrator::listaUsuario');
$routes->post('/administrador/desativar-usuario', 'Administrator::desativarUsuario');
    // categorias
$routes->get('/administrador/cadastro-categoria', 'Administrator::cadastroCategoria');
$routes->get('/administrador/lista-categoria', 'Administrator::listaCategoria');
$routes->get('/administrador/editar-categoria/(:any)', 'Administrator::editarCategoria/$1');
$routes->post('/administrador/alterar-categoria', 'Administrator::alterarCategoria');
$routes->post('/administrador/insere-categoria', 'Administrator::inserirCategoria');
$routes->post('/administrador/desativar-categoria', 'Administrator::desativarCategoria');
    // Estoque
$routes->get('/administrador/lista-estoque', 'Administrator::listaEstoque');
$routes->post('/administrador/alterar-estoque', 'Administrator::alterarQuantidadeEstoque');
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
$routes->get('/produto/(:any)', 'Product::pageProdutos/$1');

// Carrinho
$routes->get('/carrinho', 'BuyCart::carrinho');
$routes->post('/carrinho/soma-quantidade', 'BuyCart::somaQuantidade');
$routes->post('/carrinho/subtrai-quantidade', 'BuyCart::subtraiQuantidade');
$routes->post('/carrinho/adiciona-produto-carrinho', 'BuyCart::adicionaProdutoCarrinho');
$routes->get('/carrinho/load-content-carrinho', 'BuyCart::loadContentCarrinho');
$routes->post('/carrinho/remove-item-carrinho', 'BuyCart::removeItemCarrinho');

// Comprando
$routes->get('/comprando/endereco-de-entrega/(:any)', 'DeliveryAdress::enderecoDeEntrega/$1');
$routes->get('/comprando/escolhendo-endereco-de-entrega/(:any)', 'DeliveryAdress::escolherEnderecoEntrega/$1');
$routes->get('/comprando/editando-endereco-de-entrega/(:any)', 'DeliveryAdress::editarEnderecoEntrega/$1');
$routes->get('/comprando/cadastro-endereco-de-entrega/(:any)', 'DeliveryAdress::cadastroEnderecoEntrega/$1');
$routes->post('/comprando/cadastrar-endereco-de-entrega', 'DeliveryAdress::cadastrarEnderecoEntrega');
$routes->post('/comprando/adiciona-endereco-de-entrega-em-detalhes-pedido', 'BuyCart::adicionaEnderecoDeEntregaEmDetalhesPedido');
$routes->post('/comprando/editar-endereco-de-entrega', 'DeliveryAdress::editandoEnderecoDeEntrega');
$routes->get('/comprando/formas-de-pagamento/(:any)', 'BuyCart::formasDePagamento/$1');
$routes->post('/comprando/forma-de-pagamento-escolhida', 'BuyCart::formaDePagamentoEscolhida');

$routes->get('/comprando/revisao/(:any)', 'BuyCart::revisaoCompra/$1');
$routes->get('/comprando/load-revisao/(:any)', 'BuyCart::loadRevisaoCompra/$1');
// $routes->get('/comprando/checkout/payment/(:any)', 'PaymentMethod::viewPayment/$1');
$routes->get('/comprando/checkout/pagamento/(:any)', 'PaymentMethod::aguardandoPagamento/$1');
$routes->get('/comprando/checkout/success/(:any)', 'PaymentMethod::compraAprovada/$1');

// Pagamento
// $routes->get('/payment/payment', 'PaymentMethod::payment');
$routes->get('/payment/get-payment/(:any)', 'PaymentMethod::getStatusPayment/$1');

// Políticas
$routes->get('/politicas/politica-loja', 'Home::politicaLoja');
$routes->get('/politicas/politica-privacidade', 'Home::politicaPrivacidade');
$routes->get('/politicas/quem-somos', 'Home::quemSomos');
