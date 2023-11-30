<?php
$data['title'] = "Listar Estoque";
$data['link_css'] = "assets/css/lista-produto.css";
?>

<?= view("include/head", $data) ?>

<?= view("include/nav") ?>

<div class="container">
    <div>
        <h2 class="h2-titles mt-4 mt-5 mb-10 px-3"><b>LISTA ESTOQUE </b></h2>
    </div>

    <nav class="navbar mt-10 bg-white">
        <div class="container-fluid">
            <form class="d-flex gap-2" role="search">
                <input class="form-control" type="search" placeholder="Pesquise o item" aria-label="Search">
                <button class="btn btn input-rosa" type="submit">Pesquisar</button>
                <a href="<?= base_url('administrador/dashboard') ?>" class="input-rosa">Voltar</a>

            </form>
        </div>
    </nav>
</div>
<div class="container">
    <table class="tabela table table-hover text-center mt-3" style="margin-bottom: 10em;">
        <thead class=" table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Quantidade </th>
                <th scope="col">Ações</th>
            </tr>
        </thead>

        <thead>

            <tr>
                <td colspan="4">
                    <?php $message_empty = session()->getFlashdata('list-empty'); ?>
                        <?php if ($message_empty) : ?>
                            <div class="alert alert-danger mt-5 text-center" role="alert">
                                <?= $message_empty; ?>
                                <br><br><a href="<?= base_url('/administrador/cadastro-produto') ?>" class="input-rosa m-2">Clique aqui</a> para cadastrar um item
                            </div>
                        <?php else : ?>
                        <?php foreach ($estoque as $est) : ?>

                            <tr>
                                <td scope="col"><?= $est['PRODUTO_ID'] ?></td>
                                <td scope="col"><?= $est['NOME_PRODUTO'] ?></td>
                                <td scope="col"><?= $est['QUANTIDADE'] ?></td>
                                <td scope="col">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $est['ID'] ?>" class="input-simples">Editar</a>
                                </td>
                            </tr>
                            <div class="modal fade" id="staticBackdrop<?= $est['ID'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="post" id="AlterarQuantidadeItemEstoque">
                                            <div class="modal-body">
                                                Editar quantidade estoque do item: <?= ($est['NOME_PRODUTO']); ?>


                                                <div class="col-md-12 mt-2 mb-3">
                                                    <label for="text" class="preencher">Insira a quantidade desejada:</label>
                                                    <input type="number" class="form-control" id="" name="qtd-estoque" value="<?= $est["QUANTIDADE"] ?>" required>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <input type="text" value="<?= $est['ID'] ?>" name="id-estoque" id="id-estoque" readonly hidden>
                                                <button type="submit" class="btn btn input-rosa">CONFIRMAR</button>
                                                <button type="button" class="btn btn input-rosa" data-bs-dismiss="modal">FECHAR</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </td>
            </tr>
        </thead>
    </table>
</div>
<?= view("include/footer") ?>

<?= view("include/scripts") ?>