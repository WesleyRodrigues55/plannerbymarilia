<?php
$data['title'] = "Página Inicial";
$data['link_css'] = "assets/css/cadastro-adm.css";
?>

<?= view("include/head", $data) ?>

<?= view("include/nav") ?>

<div class="container">
    <div class="cadastro my-5">
        <div class="text-center">
            <h2 class="h2-titles mt-5"><b>EDITAR A CATEGORIA</b></h2>
        </div>

        <form class="teste" method="post" action="<?= base_url("/administrador/alterar-categoria") ?>" >
            <div class="row">
                <div class="col-md-12 mt-2 mb-3">
                    
                    <label for="text" class="preencher">NOME DA CATEGORIA</label>
                    <input type="text" class="form-control" id=""  name="categoria" value="<?= $categoria[0]["TIPO_CATEGORIA"] ?>" required>
                    <input type="text" class="form-control" id="" value="<?= $categoria[0]["ID"]?>" name="idcategoria" placeholder="Categorias" hidden redonly>
                </div>
                <!-- ../row -->
            </div>
            
            <div class="text-center mt-5">
                <button type="button" class="btn input-rosa px-3 botao-cadastro" data-bs-toggle="modal" data-bs-target="#staticBackdrop">ATUALIZAR CATEGORIA</button>
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Deseja realmente editar essa categoria?</h1>
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
                <a class="btn input-rosa px-3" href="<?= base_url('administrador/lista-categoria') ?>">VOLTAR</a>
            </div>
        </form>

    </div>
    <?= view("include/footer") ?>

    <?= view("include/scripts") ?>