<?php
$data['title'] = "Painel Administrativo";
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
            <p class="w-100"><a href="<?= base_url('administrador/cadastro-produto') ?>" class="input-simples-outline d-block">Cadastrar Produtos</a></p>
            <p class="w-100"><a href="<?= base_url('administrador/lista-produto') ?>" class="input-simples-outline d-block">Listar Produtos</a></p>
        </div>
        <div class="col-md-4 mb-4">
            <h2>Tipo Categorias</h2>
            <p class="w-100"><a href="<?= base_url('administrador/cadastro-categoria') ?>" class="input-simples-outline d-block">Cadastrar Categoria</a></p>
            <p class="w-100"><a href="<?= base_url('administrador/lista-categoria') ?>" class="input-simples-outline d-block">Listar Categoria</a></p>
        </div>
        <div class="col-md-4 mb-4">
            <h2>Opções Adicionais</h2>
            <p class="w-100"><a href="<?= base_url('administrador/cadastro-opcoes-adicionais') ?>" class="input-simples-outline d-block">Cadastrar Adicional</a></p>
            <p class="w-100"><a href="<?= base_url('administrador/lista-opcoes-adicionais') ?>" class="input-simples-outline d-block">Listar Adicional</a></p>
        </div>
        <div class="col-md-4 mb-4">
            <h2>Usuários</h2>
            <p class="w-100"><a href="<?= base_url('administrador/lista-usuario') ?>" class="input-simples-outline d-block">Listar Usuario</a></p>
        </div>
        <div class="col-md-4 mb-4"></div>
        <div class="col-md-4 mb-4"></div>
    </div>
</div>

<?= view("include/footer") ?>

<?= view("include/scripts") ?>