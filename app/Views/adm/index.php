<?php
$data['title'] = "Página Inicial";
$data['link_css'] = "assets/css/lista-produto.css";
?>

<?= view("include/head", $data) ?>

<?= view("include/nav") ?>

<div class="container">
    <div>
        <h2 class="h2-titles mt-4 mt-5 mb-10 px-3 titulo-adm"><b>PAINEL ADMINISTRATIVO </b></h2>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center text-center">
        <div class="col-md-4 mb-4">
            <h2>Produtos</h2>
            <p><a href="<?= base_url('administrador/cadastro-produto') ?>" class="input-simples-outline">Cadastrar Produtos</a></p>
            <p><a href="<?= base_url('administrador/cadastro-capas-produto') ?>" class="input-simples-outline">Cadastrar Capas Produtos</a></p>
            <p><a href="<?= base_url('administrador/lista-produto') ?>" class="input-simples-outline">Listar Produtos</a></p>
        </div>
        <div class="col-md-4 mb-4">
            <h2>Tipo Categorias</h2>
            <p><a href="<?= base_url('administrador/cadastro-categoria') ?>" class="input-simples-outline">Cadastrar Categoria</a></p>
            <p><a href="<?= base_url('administrador/lista-categoria') ?>" class="input-simples-outline">Listar Categoria</a></p>
        </div>
        <div class="col-md-4 mb-4">
            <h2>Opções Adicionais</h2>
            <p><a href="<?= base_url('administrador/cadastro-opcoes-adicionais') ?>" class="input-simples-outline">Cadastrar Adicional</a></p>
            <p><a href="<?= base_url('administrador/lista-opcoes-adicionais') ?>" class="input-simples-outline">Listar Adicional</a></p>
        </div>
        <div class="col-md-4 mb-4">
            <h2>Usuários</h2>
            <p><a href="<?= base_url('administrador/lista-usuario') ?>" class="input-simples-outline">Listar Usuario</a></p>
        </div>
    </div>
</div>

<?= view("include/footer") ?>

<?= view("include/scripts") ?>