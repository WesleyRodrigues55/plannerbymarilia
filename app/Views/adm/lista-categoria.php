<?php
$data['title'] = "Lista Categoria";
$data['link_css'] = "assets/css/lista-produto.css";
?>

<?= view("include/head", $data) ?>

<?= view("include/nav") ?>

<div class="container">
    <div>
        <h2 class="h2-titles mt-4 mt-5 mb-10 px-3"><b>LISTA DE CATEGORIA </b></h2>
    </div>

    <nav class="navbar mt-10 bg-white">
        <div class="container-fluid">
            <form class="d-flex gap-2" role="search" method="get" action="<?= base_url('administrador/lista-categoria') ?>">
                <input class="form-control" type="search" name="search" placeholder="Pesquise a categoria" aria-label="Search">
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
                <th scope="col">Nome categoria </th>
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
                            <br><br><a href="<?= base_url('/administrador/cadastro-categoria') ?>" class="input-rosa m-2">Clique aqui</a> para cadastrar uma categoria
            </div>
                        </div>
                    <?php else : ?>

                        <?php foreach ($categorias as $ctg) : ?>
            <tr>
                <td scope="col"><?= $ctg['ID'] ?></td>
                <td scope="col"><?= $ctg['TIPO_CATEGORIA'] ?></td>
                <td scope="col">
                    <a href="<?= base_url('administrador/editar-categoria/' . $ctg['ID']) ?>" class="input-simples">Editar</a>
                    <a href="" class="input-simples" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $ctg['ID'] ?>">Excluir</a>
                </td>
            </tr>
            <div class="modal fade" id="staticBackdrop<?= $ctg['ID'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Deseja realmente apagar essa categoria?
                        </div>
                        <div class="modal-footer">
                            <form method="post" id="excluirCategoria">
                                <input type="text" value="<?= $ctg['ID'] ?>" name="id-categoria" id="id-categoria" readonly hidden>
                                <button type="submit" class="btn btn input-rosa" data-bs-dismiss="modal">CONFIRMAR</button>
                            </form>
                            <button type="button" class="btn btn input-rosa" data-bs-dismiss="modal">FECHAR</button>
                        </div>
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