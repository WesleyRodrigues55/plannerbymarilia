<?php
$data['title'] = "Página Inicial";
$data['link_css'] = "assets/css/cadastro-adm.css";
?>

<?= view("include/head", $data) ?>

<?= view("include/nav") ?>

<div class="container">
    <div class="cadastro my-5">
        <div class="text-center">
            <h2 class="h2-titles mt-5"><b>EDITAR A OPÇÃO ADICIONAL</b></h2>
        </div>

        <form class="teste" method="post" action="<?= base_url("/administrador/alterar-opcoes-adicionais") ?>" >
            <div class="row">
            <div class="col-md-12 mt-2 mb-3">
                    <label for="text" class="preencher">NOME OPÇÃO ADICIONAL</label>
                    <input type="text" class="form-control" id="" name="nome-opcao-adicional" value="<?= $opcao_selecionada[0]["NOME"] ?>" placeholder="Nome Opção Adicional" required>
                    <input type="text" class="form-control" id="" value="<?= $opcao_selecionada[0]["ID"]?>" name="id-opcao-adicional" placeholder="Categorias" hidden redonly>
                </div>
                <div class="col-sm-8 col-md-4 mt-2 mb-3">
                    <label for="bairro" class="preencher">PREÇO</label>
                    <input type="text" class="form-control" name="preco" value="<?= $opcao_selecionada[0]["PRECO"] ?>" placeholder="R$:" required>
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
</div>
<?= view("include/footer") ?>

<?= view("include/scripts") ?>