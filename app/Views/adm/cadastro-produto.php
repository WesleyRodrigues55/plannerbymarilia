<?php
$data['title'] = "Página Inicial";
$data['link_css'] = "assets/css/cadastro-adm.css";
?>

<?= view("include/head", $data) ?>

<?= view("include/nav") ?>

<div class="container">
    <div class="cadastro my-5">
        <div class="text-center">
            <h2 class="h2-titles mt-5"><b>CADASTRO DE PRODUTO</b></h2>
        </div>

        <form class="teste" method="post">
            <div class="row">
                <div class="col-md-6 mt-2 mb-3">
                    <label for="text" class="preencher">NOME DO PRODUTO</label>
                    <input type="text" class="form-control" id="" placeholder="Nome do produto" required>
                </div>

                <div class="col-md-3 mb-3 mt-2">
                    <label class="preencher">CATEGORIA</label>
                    <select class="select form-control" name="" id="" class="form-select" required>
                        <option selected>Selecione</option>
                        <option>Caderno</option>
                        <option>Planner</option>
                        <option>Bloco</option>
                        <option>Agenda</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3 mt-2">
                    <!-- trazer do banco -->
                    <label class="preencher">TIPO CATEGORIA</label>
                    <select class="select form-control" name="" id="" class="form-select" required>
                        <?php $message_failed = session()->getFlashdata('query-failed'); ?>
                        <?php if ($message_failed) : ?>
                            <option selected><?= $message_failed; ?></option>
                        <?php endif; ?>

                        <?php if (!$message_failed) : ?>
                            <option selected>Selecione
                            <?php foreach ($tipo_categoria_produto as $lcp): ?>
                                <option value="<?= $lcp['ID'] ?>"><?= $lcp['TIPO_CATEGORIA'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="col-md-4 mb-3 mt-2">
                    <label for="text" class="preencher">SLUG</label>
                    <input type="text" class="form-control" id="" placeholder="SLUG" required>
                </div>

                <div class="col-sm-8 col-md-4 mt-2 mb-3">
                    <label for="bairro" class="preencher">PREÇO</label>
                    <input type="text" class="form-control" placeholder="R$:" required>
                </div>

                <div class="col-md-4 mt-2 mb-3">
                    <label for="text" class="preencher">ENCARDENAÇÃO</label>
                    <input type="text" class="form-control" id="" placeholder="ENCARDENAÇÃO" required>
                </div>

                <div class="col-sm-12 col-md-6 mb-3">
                    <label class="preencher">TIPO DA CAPA</label>
                    <select class="select form-control" name="" id="" class="form-select" required>
                        <option selected>Selecione</option>
                        <option>Dura</option>
                        <option>Mole</option>
                    </select>
                </div>

                <div class="col-sm-12 col-md-4 mb-3"></div>

                <div class="col-md-6 mb-3">
                    <label for="" class="form-label">DESCRIÇÃO TÉCNICA</label>
                    <textarea class="form-control texto" id="" rows="3" required></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="form-label">DESCRIÇÃO ELÁSTICO</label>
                    <textarea class="form-control texto" id="" rows="3" required></textarea>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="text" class="preencher">TAMANHO CAPA S/DIVISORIA</label>
                    <input type="text" class="form-control" id="" placeholder="exemplo: 100x50" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="text" class="preencher">TAMANHO CAPA C/DIVISORIA</label>
                    <input type="text" class="form-control" id="" placeholder="exemplo: 100x50" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="text" class="preencher">TAMANHO INTERNO</label>
                    <input type="text" class="form-control" id="" placeholder="exemplo: 100x50" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="text" class="preencher">QUANTIDADE DE FOLHAS</label>
                    <input type="text" class="form-control" id="" placeholder="exemplo: 100x50" required>
                </div>

                <p class="texto-secundario"><b>INSIRA A FOTO DO PRODUTO</b></p>
                <div class=" justify-content-center ">
                    <div class="input-group d-flex text-end mb-2" style="width: 45%;">
                        <input type="file" class="form-control " id="inputGroupFile02" required>
                    </div>
                </div>
            </div>
            <!-- ../row -->

            <div class="text-center mt-5">
                <input type="submit" class="btn input-rosa px-3 botao-cadastro" value="CADASTRAR PRODUTO"></a>
                <a class="btn input-rosa px-3 botao-cadastro" href="<?= base_url('administrador/lista-produto'); ?>">LISTA DE PRODUTOS</a>
            </div>
    </form>
</div>
<?= view("include/footer") ?>

<?= view("include/scripts") ?>