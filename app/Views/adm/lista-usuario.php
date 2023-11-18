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
                <th scope="col">ID </th>
                <th scope="col">Pessoa ID</th>
                <th scope="col">Email</th>
                <th scope="col">Ativo</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>

        <thead>
        <td colspan="6">
                <?php $message_empty = session()->getFlashdata('list-empty'); ?>
                <?php if ($message_empty): ?>
                    <div class="alert alert-danger mt-5 text-center" role="alert">
                        <?= $message_empty; ?>
                        <br>Para cadastrar um usuario, clique em: <a href="<?= base_url('/login/cadastro-usuario'); ?>">Insere Usuario</a>.
                    </div>
                <?php else: ?>
                    <?php foreach($usuario as $user): ?>
                        <tr>
                            <td scope="col"><?= $user['ID'] ?></td>
                            <td scope="col"><?= $user['PESSOA_ID'] ?></td>
                            <td scope="col"><?= $user['USUARIO'] ?></td>
                            <td scope="col"><?= $user['ATIVO'] ?></td>
                            
                            <td scope="col">
                            <a href="" class="input-simples" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $user['ID']?>">Excluir</a>
                            </td>
                        </tr>
                        <div class="modal fade" id="staticBackdrop<?= $user['ID']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Deseja realmente apagar esse usuario?
                                    </div>
                                    <div class="modal-footer">
                                        <form method="post" id="excluirUsuario">
                                        <input type="text" value="<?= $user['ID'] ?>" name="id-user" id="id-user" readonly hidden>
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
        </thead>
    </table>
</div>
<?= view("include/footer") ?>

<?= view("include/scripts") ?>