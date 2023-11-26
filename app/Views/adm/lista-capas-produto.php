<?php
$data['title'] = "Página Inicial";
$data['link_css'] = "assets/css/lista-produto-adm.css";
?>

<?= view("include/head", $data) ?>

<?= view("include/nav") ?>

<div class="container">
    <div>
        <h2 class="h2-titles mt-4 mt-5 mb-10 px-3 titulo-adm"><b>LISTA DE PRODUTOS</b></h2>
    </div>

    <nav class="navbar mt-10 bg-white">
        <div class="container-fluid">
            <form class="d-flex gap-2" role="search">
                <input class="form-control" type="search" placeholder="Pesquise o produto" aria-label="Search">
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
                <th scope="col">Capa </th>
                <th scope="col">Ações</th>
            </tr>
        </thead>

        <thead>
            <td colspan="6">
                <?php $message_empty = session()->getFlashdata('list-empty'); ?>
                <?php if ($message_empty): ?>
                    <div class="alert alert-danger mt-5 text-center" role="alert">
                        <?= $message_empty; ?>
                        <br>Para cadastrar capas de produtos, clique em: <a href="<?= base_url('/administrador/cadastro-capas-produto/'.$id_produto); ?>">Insere Capas Produto</a>.
                    </div>
                <?php else: ?>
                    <?php foreach($capas as $capa): ?>
                        <tr>
                            <td scope="col"><?= $capa['ID'] ?></td>
                            <td scope="col"><img src="<?= base_url('assets/img/produtos/capas/'. $capa['IMAGEM_CAPA']) ?>" alt="<?= $capa['IMAGEM_CAPA'] ?>" style="width: 40px; height: 40px; border-radius: 100%; object-fit: cover"></td>
                            <td scope="col">
                                    <a href="<?= base_url('administrador/editar-capa-produto/' . $capa['ID']) ?>" class="input-simples">Editar Capa</a>
                                    <a href="" class="input-simples" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $capa['ID']?>">Desativar</a>
                                </td>
                        </tr>
                        <div class="modal fade" id="staticBackdrop<?= $capa['ID']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Deseja realmente Desativar essa capa do produto?
                                    </div>
                                    <div class="modal-footer">
                                        <form method="post" id="excluirCapaProduto">
                                            <input type="text" value="<?= $capa['ID'] ?>" name="id-capa-produto" id="id-capa-produto" readonly hidden>
                                            <input type="text" value="<?= $capa['PRODUTO_ID'] ?>" name="id-produto" id="id-produto" readonly hidden>
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