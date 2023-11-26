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

        <?php $message_success = session()->getFlashdata('register-category-success'); ?>
        <?php $message_failed = session()->getFlashdata('register-category-failed'); ?>
        <?php $message_failed_category = session()->getFlashdata('category-exists'); ?>

        <?php if ($message_failed_category): ?>
            <div class="alert alert-danger mt-5 text-center" role="alert">
                <?= $message_failed_category; ?>
                <br>Para conferir, clique em:  <a href="<?= base_url('/administrador/lista-categoria'); ?>">Lista</a>.
            </div>
        <?php endif; ?>

        <?php if ($message_failed): ?>
                <div class="alert alert-danger mt-5 text-center" role="alert">
                    <?php $message_failed; ?>
                    
                </div>
        <?php endif; ?>
        
        <?php if ($message_success): ?>
            <div class="alert alert-success mt-5 text-center" role="alert">
                <?= $message_success; ?>
                <br>Para conferir, clique em:  <a href="<?= base_url('/administrador/lista-categoria'); ?>">Lista</a>.
            </div>
        <?php endif; ?>

        <form class="teste" method="post" action="<?= base_url('/administrador/insere-categoria') ?>">
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
</div>
<?= view("include/footer") ?>

<?= view("include/scripts") ?>