<?php
    $data['title'] = $produto_selecionado[0]["NOME"];
    $data['link_css'] = "assets/css/produto-selecionado.css";
?>


<?= view("include/head", $data) ?>
<?= view("include/nav") ?>

<main class="container my-5">

<?php
// echo "<pre>";
// var_dump($capas_internas_produto);

?>
    <div class="row my-5">
        <div class="col-12 col-md-6">
            <div class="slider-container p-4">
                <div class="slider-for">
                    <div class="d-flex justify-content-center">
                        <img src="<?= base_url('assets/img/produtos/capas-externas/'. $produto_selecionado[0]['IMAGEM']) ?>" alt="">
                    </div>
                    <?php foreach ($capas_internas_produto as $cip): ?>
                        <div class="d-flex justify-content-center">
                            <img src="<?= base_url('assets/img/produtos/capas-internas/'.$cip['IMAGEM_CAPA']) ?>" alt="">
                        </div>
                    <?php endforeach; ?>
                </div>
                <br>
                <div class="slider-nav">
                        <div class="d-flex justify-content-center">
                            <img src="<?= base_url('assets/img/produtos/capas-externas/'. $produto_selecionado[0]['IMAGEM']) ?>" alt="" style="width:150px; height: 150px">
                        </div>
                    <?php foreach ($capas_internas_produto as $cip): ?>
                        <div>
                            <img src="<?= base_url('assets/img/produtos/capas-internas/'.$cip['IMAGEM_CAPA']) ?>" alt="" style="width:150px; height: 150px">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="p-4">
                <h1><b><?=  $produto_selecionado[0]['NOME']?></b></h1>

                <!-- <form method="post" action="<?php //base_url('/carrinho/adiciona-produto-carrinho') ?>"> -->
                <form method="post" id="adicionaProdutoCarrinho">

                    <?php if (strpos($produto_selecionado[0]['NOME'], "Planner anual") === 0): ?>
                        <div class="my-4">
                            <b>Escolha o layout do seu planner</b><br>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="layout-planner" value="v-12">
                                <label class="form-check-label">Vertical - 12 meses</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="layout-planner" value="h-12" checked>
                                <label class="form-check-label">Horizontal - 12 meses</label>
                            </div>
                        </div>
                    <?php endif; ?>
                    

                    <div class="my-4">
                        <label for="name" class="preencher"><b>Digite o nome para a capa</b></label>
                        <input type="text" class="form-control" id="name" name="nome-capa" placeholder="Digite o seu nome" required>
                    </div>

                    <div class="my-4">
                        <label for="fonte" class="preencher"><b>Escolha a fonte do nome</b></label>
                        <select class="select form-control" name="fonte-capa" id="fonte" class="form-select" required>
                            <option selected>Selecione</option>
                            <option value="fonte1">Nome</option>
                        </select>
                    </div>

                    <div class="my-4">
                        <b>Gostaria de algum item adicional?</b><br>

                        <?php foreach($opcoes_adicionais as $oa): ?>
                            <?php
                                if (strpos($oa['NOME'], "Divisórias") === 0) {
                                    $name = "divisorias";
                                } else if (strpos($oa['NOME'], "Cantoneiras") === 0) {
                                    $name = "cantoneiras";
                                }
                            ?>
                            <?php if ((strpos($produto_selecionado[0]['CATEGORIA'], "caderno") === 0 || strpos($produto_selecionado[0]['CATEGORIA'], "bloco") === 0) && $oa['NOME'] == "Divisórias mensais em abas (janeiro a dezembro)"): ?>
                                <div></div>
                            <?php else: ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="<?= $name ?>" name="<?= $name ?>" value="<?= $oa['PRECO'] ?>">
                                    <label class="form-check-label" for="flexRadioDefault1"><?= $oa['NOME'] ?> + R$<?= $oa['PRECO'] ?></label>
                                </div>
                            <?php endif; ?>
                        <?php endforeach ?>  
                    </div>

                    <div class="my-4">
                        <b>Concordo com os termos:</b><br>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="flexRadioDefault"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">Garanto que as informações estão
                                corretas e sei que não poderei alterar o pedido após finalizar a compra.</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="flexRadioDefault"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">Li e concordo com os termos de
                                política da loja</label>
                        </div>
                    </div>
                

                    <div class="my-4">
                        <b>Preço final: <span id="preco-final-view"></span></b><br>
                        <input type="text" name="preco-final" value="" id="preco-final" class="form-control" hidden readonly required>
                        <input type="text" name="preco-original-produto" value="<?= $produto_selecionado[0]['PRECO'] ?>" class="form-control"  id="preco-produto" hidden readonly required>
                        <p>À vista no PIX com 10% OFF</p>
                    </div>

                    <div class="mt-4">
                        <!-- <input type="submit" class="btn input-rosa px-5" value="COMPRAR TESTE"> -->

                        <?php if (session()->has('usuario')): ?>
                            <input type="text" name="id-produto" value="<?= $produto_selecionado[0]['ID'] ?>" id="" hidden readonly>
                            <input type="text" name="slug" value="<?= $produto_selecionado[0]['SLUG'] ?>" id="" hidden readonly>
                            <button type="submit" class="btn input-rosa px-5 w-100 d-flex align-items-center justify-content-center gap-2">
                                <span>Comprar</span>
                                <img src="<?= base_url('assets/img/shopping-cart.png') ?>" alt="" style="width:24px; height: 24px">
                            </button>
                        <?php else: ?>
                            <button class="btn input-rosa px-5 w-100 d-flex align-items-center justify-content-center gap-2 faca-login" id="faca-login-<?= $produto_selecionado[0]['SLUG'] ?>">
                                <span>Comprar</span>
                                <img src="<?= base_url('assets/img/shopping-cart.png') ?>" alt="" style="width:24px; height: 24px">
                            </button>
                        <?php endif; ?>
                    </div>
                </form>
                        

            </div>
        </div>
        <!-- end col -->

        <div class="col-md-12">
            <h2 class="mt-4">Descrições sobre o produto</h2>
            <p><?= $produto_selecionado[0]['DESCRICAO_TECNICA'] ?><p></p>


            <h2 class="mt-4">Contém elástico de fechamento?</h2>
            <?php if ($produto_selecionado[0]['DESCRICAO_ELASTICO'] == "sim") : ?>
                <p>Sim</p>
            <?php else: ?>
                <p>Não</p>
            <?php endif; ?>

        </div>
    </div>
    <!-- end row -->
</main>

<?= view("include/footer") ?>
<?= view("include/scripts") ?>
<script src="<?= base_url("assets/js/produto.js") ?>"></script>