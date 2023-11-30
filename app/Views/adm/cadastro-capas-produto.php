<?php
$data['title'] = "Cadastro de Capas do Produto";
$data['link_css'] = "assets/css/cadastro-adm.css";
?>

<?= view("include/head", $data) ?>

<?= view("include/nav") ?>

<div class="container">
    <div class="cadastro my-5">
        <div class="text-center">
            <h2 class="h2-titles mt-5"><b>CADASTRO DE CAPAS DO PRODUTO</b></h2>
        </div>
        <?php $message_success = session()->getFlashdata('succes-insert-capas'); ?>
        <?php $message_failed = session()->getFlashdata('erro-insert-capas'); ?>

        <?php if ($message_failed): ?>
                <div class="alert alert-danger mt-5 text-center" role="alert">
                    <?php $message_failed; ?>
                </div>
        <?php endif; ?>
        
        <?php if ($message_success): ?>
            <div class="alert alert-success mt-5 text-center" role="alert">
                <?= $message_success; ?>
                <br><br><a href="<?= base_url('/administrador/lista-capas-produto/'. $id_produto) ?>" class="input-rosa m-2">Clique aqui</a> para conferir
            </div>
        <?php endif; ?>

        <form class="teste" method="post" action="<?= base_url('/administrador/insere-capas-produto') ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mt-2 mb-3">
                    <input type="text" class="form-control" value="<?= $id_produto ?>" name="id-produto" required readonly hidden>
                </div>

                <p class="texto-secundario"><b>INSIRA AS CAPAS DO PRODUTO</b></p>
                <div class=" justify-content-center ">
                    <div class="input-group d-flex flex-column mb-2" style="width: 45%;">
                        <input type="file" class="form-control w-100" name="foto-produto[]" id="inputGroupFile02" multiple required>
                        <i class="p-small">Selecione de uma vez todas a imagens de capas a serem cadastradas</i>
                    </div>
                </div>
                <?php $message_image_failed = session()->getFlashdata('imagem-invalida'); ?>
                <?php if ($message_image_failed) : ?>
                    <p style="color: red"><?= $message_image_failed; ?></p>
                <?php endif; ?>
            </div>
            <!-- ../row -->

            <div class="text-center mt-5">
                <input type="submit" class="btn input-rosa px-3 botao-cadastro" value="CADASTRAR CAPAS DO PRODUTO"></a>
                <a class="btn input-rosa px-3" href="<?= base_url('administrador/lista-produto'); ?>">LISTA DE PRODUTOS</a>
                <a class="btn input-rosa px-3" href="<?= base_url('administrador/lista-capas-produto/'. $id_produto); ?>">LISTA DE CAPAS DO PRODUTO</a>
                <a class="btn input-rosa px-3" href="<?= base_url('administrador/dashboard') ?>">VOLTAR</a>
            </div>
        </form>
    </div>
</div>
<?= view("include/footer") ?>

<?= view("include/scripts") ?>