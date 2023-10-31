<?php
$data['title'] = "Página Inicial";
$data['link_css'] = "assets/css/lista-usuario.css";
?>

<?= view("include/head", $data) ?>

<?= view("include/nav") ?>

<div class="container">
    <div>
        <h2 class="h2-titles mt-4 mt-5 mb-10 px-3"><b>LISTA DE USUÁRIOS</b></h2>
    </div>

    <nav class="navbar mt-10 bg-white">
        <div class="container-fluid">
            <form class="d-flex gap-2" role="search">
                <input class="form-control" type="search" placeholder="Pesquise o usuario" aria-label="Search">
                <button class="btn btn input-rosa" type="submit">Pesquisar</button>
                <a href="<?= base_url('administrador/dashboard') ?>" class="input-rosa">Voltar</a>
            </form>
        </div>
    </nav>
</div>
<div class="container">
    <table class="tabela table table-hover text-center mt-3" style="margin-bottom: 10em;">
        <thead class="table-dark">
            <tr>
                <th scope="col">Nome </th>
                <th scope="col">Senha</th>
                <th scope="col">CPF</th>
                <th scope="col">Permissão</th>
                <th scope="col">Status</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>

        <thead>
            <tr>
                <th scope="col">Wesley </th>
                <th scope="col">333.333.333.33</th>
                <th scope="col">Administrador</th>
                <th scope="col">333.333.333.33</th>
                <th scope="col">Ativo</th>
                <th>
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
                        Deseja realmente apagar esse usuário?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn input-rosa" data-bs-dismiss="modal">CONFIRMAR</button>
                        <button type="button" class="btn btn input-rosa">CANCELAR</button>
                    </div>
                </div>
            </div>
        </div>
    </table>
</div>
<?= view("include/footer") ?>

<?= view("include/scripts") ?>