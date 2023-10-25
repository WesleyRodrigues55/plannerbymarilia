<?php
$data['title'] = "Página Inicial";
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
            <form class="d-flex gap-2" role="search">
                <input class="form-control" type="search" placeholder="Pesquise a categoria" aria-label="Search">
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
                <th scope="col">ID</th>
                <th scope="col">Nome categoria </th>
                <th scope="col"><a href="<?= base_url('administrador/editar-categoria') ?>" class="input-simples">Editar</a>
                    <button class="input-simples" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Excluir</button>
                </th>
            </tr>
        </thead>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Deseja realmente apagar essa categoria?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn input-rosa" data-bs-dismiss="modal" action="">CONFIRMAR</button>
                        <a href="<?= base_url('administrador/lista-categoria') ?>" class="btn btn input-rosa">VOLTAR</a>
                    </div>
                </div>
            </div>
        </div>
    </table>
</div>
<?= view("include/footer") ?>

<?= view("include/scripts") ?>