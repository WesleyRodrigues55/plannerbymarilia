<?php
$data['title'] = "Editar Produto";
$data['link_css'] = "assets/css/cadastro-adm.css";
?>

<?= view("include/head", $data) ?>

<?= view("include/nav") ?>

<div class="container">
    <div class="cadastro my-5">
        <div class="text-center">
            <h2 class="h2-titles mt-5"><b>EDITAR PRODUTO</b></h2>
        </div>

        <?php $message_success = session()->getFlashdata('att-product-success'); ?>
        <?php $message_failed = session()->getFlashdata('att-produtc-failed'); ?>
        <?php $message_failed_product = session()->getFlashdata('product-exists'); ?>

        <?php if ($message_failed_product) : ?>
            <div class="alert alert-danger mt-5 text-center" role="alert">
                <?= $message_failed_product; ?>
                <br><br><a href="<?= base_url('/administrador/lista-produto') ?>" class="input-rosa m-2">Clique aqui</a> para conferir
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
                <br><br><a href="<?= base_url('/administrador/lista-produto') ?>" class="input-rosa m-2">Clique aqui</a> para conferir
            </div>
        <?php endif; ?>

        <form method="post" action="<?= base_url("/administrador/alterar-produto") ?>">
            <div class="row">
                <div class="col-md-6 mt-2 mb-3">
                    <label for="text" class="preencher">NOME DO PRODUTO</label>
                    <input type="text" class="form-control" id="" value="<?= $produto['NOME'] ?>" name="nome-produto" placeholder="Nome do produto" required>
                    <input type="text" class="form-control" id="" value="<?= $produto['ID'] ?>" name="id-produto" placeholder="produto" hidden redonly>
                </div>
                <div class="col-md-3 mb-3 mt-2">
                    <label class="preencher">CATEGORIA</label>
                    <select class="select form-control" name="categoria" id="" class="form-select" required>
                        <option selected value="<?= $produto["CATEGORIA"];?>"><?= $produto["CATEGORIA"];?></option>
                        <option value="caderno">Caderno</option>
                        <option value="planner">Planner</option>
                        <option value="bloco">Bloco</option>
                        <option value="agenda">Agenda</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3 mt-2">
                    <label class="preencher">TIPO CATEGORIA</label>
                    <select class="select form-control" name="tipo-categoria" id="" class="form-select" required>
                        <?php $message_failed = session()->getFlashdata('query-failed'); ?>
                        <?php if ($message_failed) : ?>
                            <option selected><?= $message_failed; ?></option>
                        <?php endif; ?>

                        <?php if (!$message_failed) : ?>
                            <!-- <option selected>Selecione</option> -->
                                <?php foreach ($categorias as $c) : ?>
                                    <option value="<?= $c['ID'] ?>"><?= $c['TIPO_CATEGORIA'] ?></option>
                                <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="col-md-4 mb-3 mt-2">
                    <label for="text" class="preencher">SLUG</label>
                    <input type="text" class="form-control" value="<?= $produto['SLUG'];?>" name="slug" id="" placeholder="SLUG" required>
                </div>

                <div class="col-sm-8 col-md-4 mt-2 mb-3">
                    <label for="bairro" class="preencher">PREÇO</label>
                    <input type="text" class="form-control" value="<?= $produto['PRECO'];?>" name="preco" placeholder="R$:" required>
                </div>

                <div class="col-md-4 mt-2 mb-3">
                    <label for="text" class="preencher">ENCARDENAÇÃO</label>
                    <input type="text" class="form-control" value="<?= $produto['ENCADERNACAO'];?>"name="encardenacao" id="" placeholder="ENCARDENAÇÃO" required>
                </div>

                <div class="col-sm-12 col-md-6 mb-3">
                    <label class="preencher">TIPO DA CAPA</label>
                    <select class="select form-control" name="tipo-da-capa" id="" class="form-select" required>
                        <option selected>Selecione</option>
                        <option>Dura</option>
                        <option>Mole</option>
                    </select>
                </div>

                <div class="col-sm-12 col-md-4 mb-3"></div>

                <div class="col-md-6 mb-3">
                    <label for="" class="form-label">DESCRIÇÃO TÉCNICA</label>
                    <textarea class="form-control texto" name="descricao-tecnica" id="" rows="3" required><?= $produto['DESCRICAO_TECNICA'];?></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="form-label">DESCRIÇÃO ELÁSTICO</label>
                    <textarea class="form-control texto" name="descricao-elastico" id="" rows="3" required><?= $produto['DESCRICAO_ELASTICO'];?></textarea>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="text" class="preencher">TAMANHO CAPA S/DIVISORIA</label>
                    <input type="text" class="form-control" value="<?= $produto['TAMANHO_CAPA_SEM_DIVISORIA'];?> "name="capa-sem-divisoria" id="" placeholder="exemplo: 100x50" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="text" class="preencher">TAMANHO CAPA C/DIVISORIA</label>
                    <input type="text" class="form-control" value="<?= $produto['TAMANHO_CAPA_COM_DIVISORIA'];?> "name="capa-com-divisoria" id="" placeholder="exemplo: 100x50" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="text" class="preencher">TAMANHO INTERNO</label>
                    <input type="text" class="form-control" value="<?= $produto['TAMANHO_INTERNO'];?>" name="tamanho-interno" id="" placeholder="exemplo: 100x50" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="text" class="preencher">QUANTIDADE DE FOLHAS</label>
                    <input type="text" class="form-control" value="<?= $produto['QUANTIDADE_FOLHA']; ?>" name="quantidade-folhas" id="" placeholder="exemplo: 100x50" required>
                </div>

                <!-- <p class="texto-secundario"><b>INSIRA A FOTO DO PRODUTO</b></p>
                <div class=" justify-content-center ">
                    <div class="input-group d-flex text-end mb-2" style="width: 45%;">
                        <input type="file" class="form-control " value="<?= $produto['IMAGEM'];?>" name="foto-produto" id="inputGroupFile02" required>
                    </div>
                </div> -->
            </div>
            <!-- ../row -->

            <div class="text-center mt-5">
                <button type="button" class="btn input-rosa px-3 botao-cadastro" data-bs-toggle="modal" data-bs-target="#staticBackdrop">ATUALIZAR PRODUTO</button>
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
                <a class="btn input-rosa px-3" href="<?= base_url('administrador/dashboard') ?>">VOLTAR</a>
            </div>
        </form>
    </div>
</div>
<?= view("include/footer") ?>

<?= view("include/scripts") ?>