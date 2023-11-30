<?php
$data['title'] = "Cadastrar Adicional";
$data['link_css'] = "assets/css/cadastro-adm.css";
?>

<?= view("include/head", $data) ?>

<?= view("include/nav") ?>

<div class="container">
    <div class="cadastro my-5">
        <div class="text-center">
            <h2 class="h2-titles mt-5"><b>CADASTRO OPÇÕES ADICIONAIS</b></h2>
        </div>

        <?php $message_success = session()->getFlashdata('register-adicional-success'); ?>
        <?php $message_failed = session()->getFlashdata('register-adicional-failed'); ?>
        <?php $message_failed_adicional = session()->getFlashdata('option-exists'); ?>

        <?php if ($message_failed_adicional) : ?>
            <div class="alert alert-danger mt-5 text-center" role="alert">
                <?= $message_failed_adicional; ?>
                <br><br><a href="<?= base_url('/administrador/lista-opcoes-adicionais') ?>" class="input-rosa m-2">Clique aqui</a> para conferir
            </div>
        <?php endif; ?>

        <?php if ($message_failed) : ?>
            <div class="alert alert-danger mt-5 text-center" role="alert">
                <?php $message_failed; ?>

            </div>
        <?php endif; ?>

        <?php if ($message_success) : ?>
            <div class="alert alert-success mt-5 text-center" role="alert">
                <?= $message_success; ?>
                <br><br><a href="<?= base_url('/administrador/lista-opcoes-adicionais') ?>" class="input-rosa m-2">Clique aqui</a> para conferir
            </div>
        <?php endif; ?>

        <form class="teste" method="post" action="<?= base_url('/administrador/insere-opcoes-adicionais') ?>">
            <div class="row">
                <div class="col-md-12 mt-2 mb-3">
                    <label for="text" class="preencher">NOME OPÇÃO ADICIONAL</label>
                    <input type="text" class="form-control" id="" name="nome-opcao-adicional" placeholder="Nome Opção Adicional" required>
                </div>
                <div class="col-sm-8 col-md-4 mt-2 mb-3">
                    <label for="bairro" class="preencher">PREÇO</label>
                    <input type="text" class="form-control" name="preco" placeholder="R$:" required>
                </div>

            </div>
            <!-- ../row -->

            <div class="text-center mt-5">
                <input type="submit" class="btn input-rosa px-3" value="CADASTRAR OPÇÃO ADICIONAL"></a>
                <a class="btn input-rosa px-3" href="<?= base_url('administrador/lista-opcoes-adicionais'); ?>">LISTA DE ADICIONAL</a>
                <a class="btn input-rosa px-3" href="<?= base_url('administrador/dashboard') ?>">VOLTAR</a>
            </div>

        </form>
    </div>
</div>
<?= view("include/footer") ?>

<?= view("include/scripts") ?>