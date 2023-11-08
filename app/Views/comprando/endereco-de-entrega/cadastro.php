<?php
    $data['title'] = 'Carrinho de Compras';
    $data['link_css'] = "assets/css/carrinho.css";
?>


<?= view("include/head", $data) ?>
    <?= view("include/nav") ?>

    <main class="container my-5">
        <h1 class="text-center mb-4">Cadastro de endereço de entrega</h1>

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
            </div>
        <?php endif; ?>
        
        <form method="post" action="/comprando/salvar-endereco-de-entrega">
            <input type="int" class="form-control" name="id-usuario" value="<?= $id_usuario ?>" readonly hidden>
            <div class="row">
                <div class="col-md-6 my-2">
                    <label for="">NOME COMPLETO</label>
                    <input type="text" id="nome" name="nome" class="form-control" tabindex="1">
                </div>
                <div class="col-md-6 my-2">
                    <label for="">CELULAR</label>
                    <input maxlength="11" type="text" id="telefone" name="celular" class="form-control" tabindex="2">
                </div>
                <div class="col-md-6 my-2">
                    <label for="">CEP</label>
                    <input maxlength="9" type="text" id="cep" name="cep" class="form-control" tabindex="3">
                </div>
                <div class="col-md-6 my-2">
                    <label for="">RUA</label>
                    <input type="text" id="rua" name="rua" class="form-control">
                </div>
                <div class="col-md-6 my-2">
                    <label for="">CIDADE</label>
                    <input type="text" id="cidade" name="cidade" class="form-control">
                </div>
                <div class="col-md-6 my-2">
                    <label for="">BAIRRO</label>
                    <input type="text" id="bairro" name="bairro" class="form-control">
                </div>
                <div class="col-md-6 my-2">
                    <label for="">ESTADO</label>
                    <input type="text" id="estado" name="estado" class="form-control">
                </div>
                <div class="col-md-6 my-2">
                    <label for="">NÚMERO DA CASA</label>
                    <input type="text" id="numero" name="numero" class="form-control" tabindex="4">
                </div>
                <div class="col-md-6 my-2">
                    <label for="">COMPLEMENTO</label>
                    <input type="text" id="complemento" name="complemento" class="form-control" tabindex="5">
                </div>
                <div class="col-md-12 my-2">
                    <label for="">ESTE É A SUA CASA OU SEU TRABALHO?</label><br>
                    <input type="radio" id="local" name="local" value="casa" checked tabindex="6"> Casa
                    <br><input type="radio" id="local" name="local" value="trabalho"> Trabalho
                </div>
                <div class="col-md-12 my-2">
                    <label for="">INFORMACÕES ADICIONAIS</label>
                    <input type="text" id="informacoes" name="informacoes" class="form-control" placeholder="Descrição da fachada, pontos de referência, informações de segurança etc." tabindex="7">
                </div>
            </div>
            
            <div class="d-flex gap-2 justify-content-center mt-4">
                <input type="submit" class="input-simples" value="Cadastrar endereço">
                <a href="<?= base_url('/comprando/escolhendo-endereco-de-entrega/'. session()->get('id_carrinho')) .'/'. $id_usuario ?>" class="input-simples">Voltar</a>
            </div>
        </form>
    </main>

    <?= view("include/footer") ?>

    <?= view("include/scripts") ?>
<?= view("comprando/scripts/script-cadastro-cep") ?>

