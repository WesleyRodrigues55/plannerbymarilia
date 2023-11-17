<?php
    $data['title'] = $produto_selecionado[0]["NOME"];
    $data['link_css'] = "";
?>


<?= view("include/head", $data) ?>
<?= view("include/nav") ?>

<main class="container my-5">


    <?php if (session()->has('usuario')): ?>
    <form id="adicionaProdutoCarrinho" method="post">
        <!-- <form action="carrinho/adiciona-produto-carrinho" method="post"> -->
        <input type="text" name="id-produto" value="<?= $produto_selecionado[0]['ID'] ?>" id="" hidden readonly>
        <input type="text" name="slug" value="<?= $produto_selecionado[0]['SLUG'] ?>" id="" hidden readonly>
        <button type="submit" id="submit" name="submit" style="border: none; background: #fff;">
            <img src="<?= base_url('assets/img/shopping-cart.png') ?>" alt="" style="width:36px; height: 36px">
        </button>
    </form>
    <?php else: ?>
    <button type="submit" id="submit" name="submit" class="faca-login"
        id="faca-login-<?= $produto_selecionado[0]['SLUG'] ?>" style="border: none; background: #fff;">
        <img src="<?= base_url('assets/img/shopping-cart.png') ?>" alt="" style="width:36px; height: 36px">
    </button>
    <?php endif; ?>


    <?php
        // echo "<pre>";
        // var_dump($produto_selecionado);
        // echo"<br><br>";
        // var_dump($opcoes_adicionais);
    ?>



    <div class="row my-5">
        <div class="col-12 col-md-6">
            <div class="slider-container">
                <div class="slider-for">
                    <div><img src="<?= base_url('assets/img/capas/planner20.png') ?>" alt=""></div>
                    <div><img src="<?= base_url('assets/img/capas/planner21.png') ?>" alt=""></div>
                    <div><img src="<?= base_url('assets/img/capas/planner22.png') ?>" alt=""></div>

                    <!-- Adicione mais slides conforme necessário -->
                </div>

                <div class="slider-nav">
                    <div><img src="<?= base_url('assets/img/capas/planner20.png') ?>" alt=""
                            style="width:150px; height: 150px"></div>
                    <div><img src="<?= base_url('assets/img/capas/planner21.png') ?>" alt=""
                            style="width:150px; height: 150px"></div>
                    <div><img src="<?= base_url('assets/img/capas/planner22.png') ?>" alt=""
                            style="width:150px; height: 150px"></div>
                    <div><img src="<?= base_url('assets/img/capas/planner23.png') ?>" alt=""
                            style="width:150px; height: 150px"></div>

                    <!-- Adicione mais miniaturas conforme necessário -->
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <h2 class="h2-titles"><b><?=  $produto_selecionado[0]['NOME']?></b></h2>

            <div class="row my-4">
                <p>Escolha o layout do seu planner</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">Vertical - 12 meses</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                    <label class="form-check-label" for="flexRadioDefault2">Horizontal - 12 meses</label>
                </div>
            </div>

            <form>
                <div class="row my-4">
                    <div class="col-12">
                        <label for="name" class="preencher">Digite o nome para a capa</label>
                        <input type="text" class="form-control" id="name" name="nome" placeholder="Digite o seu nome"
                            required>
                        <div class="invalid-feedback">
                            Por favor preencha o seu nome.
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="fonte" class="preencher">Escolha a fonte do nome</label>
                        <select class="select form-control" name="fonte" id="fonte" class="form-select">
                            <option selected>Selecione</option>
                            <option value="fonte1">Nome</option>
                        </select>
                    </div>

                    <div class="row my-4">
                        <p>Gostaria de inserir elástico de fechamento?</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">Sim</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                                checked>
                            <label class="form-check-label" for="flexRadioDefault2">Não</label>
                        </div>
                    </div>

                    <div class="row my-4">
                        <p>Gostaria de algum item adicional?</p>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="flexRadioDefault"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">Cantoneiras metálicas
                                +R$10,00</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="flexRadioDefault"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">Divisórias mensais em abas (janeiro
                                a dezembro) +R$18,00</label>
                        </div>
                    </div>

                    <div class="row my-4">
                        <p>CONCORDO COM OS TERMOS:</p>
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
                    
                    <div class="row my-4">
                        <p><b>PREÇO FINAL:</b></p>
                    </div>

                        
                    <p>À vista no PIX com 10% OFF</p>
                    <p>Cartão em até 12x com juros da plataforma</p>
                </div>
            </form>
        </div>
    </div>

</main>

<?= view("include/footer") ?>
<?= view("include/scripts") ?>