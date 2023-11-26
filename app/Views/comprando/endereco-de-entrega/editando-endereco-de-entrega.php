<?php
    $data['title'] = 'Editando um Endereço de Entrega';
    $data['link_css'] = "assets/css/carrinho.css";
    // echo "<pre>";
    // var_dump($dados_usuario);
?>




<?= view("include/head", $data) ?>
<?= view("include/nav") ?>

<main class="container my-5">
    <h1 class="text-center mb-4">Editar Endereço</h1>

    <?php $message_success = session()->getFlashdata('endereco-success'); ?>
    <?php $message_failed = session()->getFlashdata('endereco-failed'); ?>
    <?php if ($message_failed): ?>
        <div class="alert alert-danger mt-5 text-center" role="alert">
            <?= $message_failed; ?>
        </div>
    <?php endif; ?>

        <?php if ($message_success): ?>
            <div class="alert alert-success mt-5 text-center" role="alert">
                <?= $message_success; ?>
                <br><br><a href="<?= base_url('/comprando/escolhendo-endereco-de-entrega/'. $id_carrinho .'/'. $dados_usuario[0]['USUARIO_ID']) ?>" class="input-rosa">Clique aqui</a> para continuar o processo de compra
            </div>
        <?php endif; ?>

    <form method="post" action="<?= base_url('/comprando/editar-endereco-de-entrega') ?>">

            <div class="row">
                <div class="col-md-12">
                    <input type="text" class="form-control" name="id-endereco" value="<?= $dados_usuario[0]['ID'] ?>" readonly hidden required>
                    <input type="text" class="form-control" name="id-carrinho" value="<?= $id_carrinho ?>" readonly hidden required>
                    <input type="text" class="form-control" name="id-usuario" value="<?= $dados_usuario[0]['USUARIO_ID'] ?>" readonly hidden required>
                </div>
                <div class="col-md-6 my-2">
                    <label for="">NOME COMPLETO *</label>
                    <input type="text" id="nome" name="nome" value="<?= $dados_usuario[0]['NOME_COMPLETO'] ?>" class="form-control" tabindex="1" required>
                </div>
                <div class="col-md-6 my-2">
                    <label for="">CELULAR *</label>
                    <input type="text" id="celular" name="celular" value="<?= $dados_usuario[0]['CELULAR'] ?>" class="form-control" tabindex="2" required>
                </div>
                <div class="col-md-6 my-2">
                    <label for="">CEP *</label>
                    <input type="text" id="cep" name="cep" value="<?= $dados_usuario[0]['CEP'] ?>" class="form-control" tabindex="3" maxlength="9" required>
                </div>
                <div class="col-md-6 my-2">
                    <label for="">RUA *</label>
                    <input type="text" id="rua" name="rua" value="<?= $dados_usuario[0]['RUA'] ?>" class="form-control" required>
                </div>
                <div class="col-md-6 my-2">
                    <label for="">CIDADE *</label>
                    <input type="text" id="cidade" name="cidade" value="<?= $dados_usuario[0]['CIDADE'] ?>" class="form-control" required>
                </div>
                <div class="col-md-6 my-2">
                    <label for="">BAIRRO *</label>
                    <input type="text" id="bairro" name="bairro" value="<?= $dados_usuario[0]['BAIRRO'] ?>" class="form-control" required>
                </div>
                <div class="col-md-6 my-2">
                    <label for="">ESTADO *</label>
                    <input type="text" id="estado" name="estado" value="<?= $dados_usuario[0]['ESTADO'] ?>" class="form-control" required>
                </div>
                <div class="col-md-6 my-2">
                    <label for="">NÚMERO DA CASA *</label>
                    <input type="text" id="numero" name="numero" value="<?= $dados_usuario[0]['NUMERO'] ?>" class="form-control" tabindex="4" required>
                </div>
                <div class="col-md-6 my-2">
                    <label for="">COMPLEMENTO</label>
                    <input type="text" id="complemento" name="complemento" value="<?= $dados_usuario[0]['COMPLEMENTO'] ?>" class="form-control" tabindex="5">
                </div>
                <div class="col-md-12 my-2">
                    <label for="">ESTE É A SUA CASA OU SEU TRABALHO? *</label><br>
                    <?php if ($dados_usuario[0]['LOCAL_ENTREGA'] == "casa"): ?>
                        <input type="radio" id="local" name="local" value="casa" checked tabindex="6"> Casa
                    <?php else:  ?>
                        <input type="radio" id="local" name="local" value="casa" checked tabindex="6"> Casa
                    <?php endif ?>

                <?php if ($dados_usuario[0]['LOCAL_ENTREGA'] == "trabalho"): ?>
                    <input type="radio" id="local" name="local" value="trabalho" checked tabindex="6"> Trabalho
                <?php else: ?>
                    <br><input type="radio" id="local" name="local" value="trabalho"> Trabalho
                <?php endif ?>

            </div>
            <div class="col-md-12 my-2">
                <label for="">INFORMACÕES ADICIONAIS *</label>
                <input type="text" id="informacoes" name="informacoes"
                    value="<?= $dados_usuario[0]['INFORMACOES_ADICIONAIS'] ?>" class="form-control"
                    placeholder="Descrição da fachada, pontos de referência, informações de segurança etc." tabindex="7"
                    required>
            </div>
        </div>

            <div class="d-flex justify-content-center mt-4 gap-2">
                <input type="submit" class="input-rosa" value="Editar">
                <a href="<?= base_url('/comprando/escolhendo-endereco-de-entrega/'. $id_carrinho . '/' . $dados_usuario[0]['USUARIO_ID']) ?>" class="input-simples">Voltar</a>
            </div>
        </form>
    
    </main>

<?= view("include/footer") ?>

<?= view("include/scripts") ?>
<?= view("comprando/scripts/script-cadastro-cep") ?>