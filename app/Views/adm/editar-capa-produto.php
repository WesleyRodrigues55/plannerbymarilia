<?php
$data['title'] = "Página Inicial";
$data['link_css'] = "assets/css/cadastro-adm.css";
?>

<?= view("include/head", $data) ?>

<?= view("include/nav") ?>

<div class="container">
    <div class="cadastro my-5">
        <div class="text-center">
            <h2 class="h2-titles mt-5"><b>EDITAR CAPA DO PRODUTO</b></h2>
        </div>
        <?php $message_success = session()->getFlashdata('register-capa-success'); ?>
        <?php $message_failed = session()->getFlashdata('erro-insert-capas'); ?>

        <?php if ($message_failed): ?>
                <div class="alert alert-danger mt-5 text-center" role="alert">
                    <?php $message_failed; ?>
                </div>
        <?php endif; ?>
        
        <?php if ($message_success): ?>
            <div class="alert alert-success mt-5 text-center" role="alert">
                <?= $message_success; ?>
                <br>Para conferir, clique em:  <a href="<?= base_url('/administrador/lista-capas-produto/'. $capa_produto[0]['PRODUTO_ID']); ?>">Lista Capas do Produto</a>.
            </div>
        <?php endif; ?>
        <form method="post" action="<?= base_url("/administrador/alterar-capa-produto") ?>" enctype="multipart/form-data">
            <div class="row">
                <input type="text" class="form-control " name="id" value="<?= $capa_produto[0]['ID'] ?>" required readonly hidden>
                <input type="text" class="form-control " name="id-produto" value="<?= $capa_produto[0]['PRODUTO_ID'] ?>" required readonly hidden>
                <p class="texto-secundario"><b>INSIRA A NOVA FOTO DA CAPA DO PRODUTO</b></p>
                <div class=" justify-content-center ">
                    <div class="input-group d-flex text-end mb-2" style="width: 45%;">
                        <input type="file" class="form-control " name="foto-capa-produto" id="inputGroupFile02" required>
                    </div>
                </div>
                <?php $message_image_failed = session()->getFlashdata('imagem-invalida'); ?>
                <?php if ($message_image_failed) : ?>
                    <p style="color: red"><?= $message_image_failed; ?></p>
                <?php endif; ?>
            </div>
            <!-- ../row -->

            <div class="text-center mt-5">
                <button type="button" class="btn input-rosa px-3 botao-cadastro" data-bs-toggle="modal" data-bs-target="#staticBackdrop">ATUALIZAR CAPA DO PRODUTO</button>
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Deseja realmente atualizar esse produto?</h1>
                            </div>
                            <div class="modal-body">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn input-rosa" data-bs-dismiss="modal">ATUALIZAR</button>
                                <button type="button" class="btn btn input-rosa" data-bs-dismiss="modal">FECHAR</button>
                            </div>
                        </div>
                    </div>
                </div>
                <a class=" btn input-rosa px-3" href="<?= base_url('administrador/lista-produto') ?>">LISTA DE PRODUTOS</a>
                <a class=" btn input-rosa px-3" href="<?= base_url('administrador/lista-capas-produto/'. $capa_produto[0]['PRODUTO_ID']) ?>">LISTA DE CAPAS DO PRODUTO</a>
                <a class="btn input-rosa px-3" href="<?= base_url('administrador/dashboard') ?>">VOLTAR</a>
            </div>
        </form>
    </div>
</div>
<?= view("include/footer") ?>

<?= view("include/scripts") ?>