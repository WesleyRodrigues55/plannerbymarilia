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

        <form class="needs-validation" novalidate>
            <div class="row">
                <div class="col-md-6 mt-2 mb-3">
                    <label for="text" class="preencher">NOME DO PRODUTO</label>
                    <input type="text" class="form-control" id="" placeholder="Nome do produto">
                </div>

                <!-- <div class="col-md-4 mt-2 mb-5">
                    <label for="text" class="preencher">CATEGORIA DO PRODUTO</label>
                    <input type="text" class="form-control" id="" placeholder="CATEGORIA DO PRODUTO">
                </div> -->

                <div class="col-md-2 mb-3 mt-2">
                    <label class="preencher">CATEGORIA</label>
                    <select class="select form-control" name="" id="" class="form-select">
                        <option selected>Selecione</option>
                        <option>Caderno</option>
                        <option>Planner</option>
                        <option>Bloco</option>
                        <option>Agenda</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3 mt-2">
                    <label for="text" class="preencher">SLUG</label>
                    <input type="text" class="form-control" id="" placeholder="SLUG">
                </div>

                <div class="col-sm-8 col-md-1 mt-2 mb-3">
                    <label for="bairro" class="preencher">PREÇO</label>
                    <input type="text" class="form-control" placeholder="R$:">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="text" class="preencher">ENCARDENAÇÃO</label>
                    <input type="text" class="form-control" id="" placeholder="ENCARDENAÇÃO">
                </div>

                <div class="col-sm-12 col-md-6 mb-3">
                    <label class="preencher">TIPO DA CAPA</label>
                    <select class="select form-control" name="" id="" class="form-select">
                        <option selected>Selecione</option>
                        <option>Dura</option>
                        <option>Mole</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="form-label">DESCRIÇÃO TÉCNICA</label>
                    <textarea class="form-control texto" id="" rows="3"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="" class="form-label">DESCRIÇÃO ELÁSTICO</label>
                    <textarea class="form-control texto" id="" rows="3"></textarea>
                </div>

                <!-- <div class="col-md-8 mb-5">
                    <label for="text" class="preencher">DESCRIÇÃO ELASTICO</label>
                    <input type="text" class="form-control" id="" placeholder="DESCREVA O ELASTICO">
                </div> -->
                <!-- <div class="col-md-6 mb-2">
                    <label for="" class="form-label">DESCRIÇÃO TÉCNICA</label>
                    <textarea class="form-control texto" id="" rows="1"></textarea>
                </div> -->

                <div class="col-md-3 mb-3">
                    <label for="text" class="preencher">TAMANHO CAPA S/DIVISORIA</label>
                    <input type="text" class="form-control" id="" placeholder="exemplo: 100x50">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="text" class="preencher">TAMANHO CAPA C/DIVISORIA</label>
                    <input type="text" class="form-control" id="" placeholder="exemplo: 100x50">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="text" class="preencher">TAMANHO INTERNO</label>
                    <input type="text" class="form-control" id="" placeholder="exemplo: 100x50">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="text" class="preencher">QUANTIDADE DE FOLHAS</label>
                    <input type="text" class="form-control" id="" placeholder="exemplo: 100x50">
                </div>


                <p class="texto-secundario"><b>INSIRA A FOTO</b></p>
                <div class=" justify-content-center ">
                    <div class="input-group d-flex text-end mb-2" style="width: 45%;">
                        <input type="file" class="form-control " id="inputGroupFile02">
                    </div>
                </div>
            </div>
            <!-- ../row -->

            <div class="text-center mt-5">
                <a class="btn input-rosa px-3 botao-cadastro" href="#">CADASTRAR PRODUTO</a>
                <a class="btn input-rosa px-3 botao-cadastro" href="#">LISTA DE PRODUTOS</a>
            </div>
    </div>
    </form>
</div>
<?= view("include/footer") ?>

<?= view("include/scripts") ?>