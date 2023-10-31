<?php
$data['title'] = "Página Inicial";
$data['link_css'] = "assets/css/cadastro-adm.css";
?>

<?= view("include/head", $data) ?>

<?= view("include/nav") ?>

<div class="container">
    <div class="cadastro my-5">
        <div class="text-center">
            <h2 class="h2-titles mt-5"><b>CADASTRO TIPO CATEGORIA</b></h2>
        </div>

        <form class="teste" method="post">
            <div class="row">
                <div class="col-md-12 mt-2 mb-3">
                    <label for="text" class="preencher">NOME DA CATEGORIA</label>
                    <input type="text" class="form-control" id="" name="categoria" placeholder="Nome da categoria" required>
                </div>

            </div>
            <!-- ../row -->

            <div class="text-center mt-5">
                <input type="submit" class="btn input-rosa px-3" value="CADASTRAR CATEGORIA"></a>
                <a class="btn input-rosa px-3" href="<?= base_url('administrador/lista-categoria'); ?>">LISTA DE CATEGORIA</a>
                <a class="btn input-rosa px-3" href="<?= base_url('administrador/dashboard') ?>">VOLTAR</a>
            </div>

        </form>
    </div>
    <?= view("include/footer") ?>

    <?= view("include/scripts") ?>