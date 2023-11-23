<?php if ($carrinho_compras == null):?>
    <div class="d-flex justify-content-center align-items-center text-center" id="carrinho-vazio">
        <div style="max-width: 400px">
            <h2>Monte um carrinho de compras!</h2>
            <p>Adicione produtos e tenha frete grátis.</p>
            <a href="<?= base_url('home') ?>" class="input-rosa">Conferir produtos</a>
        </div>
    </div>
    
<?php else: ?>
    <h1 class="h2-titles mb-5 text-center"><b>CARRINHO DE COMPRAS!</b></h1>
    <div class="row">
        <div class="col-md-12 col-lg-8">

            <?php foreach($carrinho_compras as $cc): ?>
                <div class="d-flex align-items-center box-carrinho my-1 border rounded-3 p-4">
                    
                
                    <div class="w-100 box-item-carrinho">
                        <div class="d-flex align-items-center">
                            <div class="box-img-carrinho">
                                <img src="<?= base_url('assets/img/teste/'.$cc['IMAGEM']) ?>" alt="img-produto">
                            </div>
                            <div>
                                <b><?= $cc['NOME_PRODUTO'] ?></b>
                                <div class="d-flex">
                                    <form method="post" id="removeItemCarrinho">
                                        <input type="number" id="id" name="id" value="<?= $cc['ID_ITENS_CARRINHO']; ?>" hidden>
                                        <button type="submit" name="remover" id="remover" class="botao-remove-item-carrinho p-small">Remover</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="box-quantidade">
                            <div class="d-flex align-items-center justify-content-between">
                                <form method="post" id="subtraiQuantidadeCarrinho">
                                <!-- <form action="carrinho/subtrai-quantidade" method="post"> -->
                                    <input type="number" id="quantidade" name="quantidade" value="<?= $cc['QUANTIDADE']; ?>" hidden>
                                    <input type="number" id="id" name="id" value="<?= $cc['ID_ITENS_CARRINHO']; ?>" hidden>
                                    <input type="submit" value="-" name="sub" id="sub" class="form-control">
                                </form>
                                <div>
                                    <span class="quantidade-item-estoque" id="quantidade-produto"><?= $cc['QUANTIDADE']; ?></span>
                                </div>
                                <form method="post" id="somaQuantidadeCarrinho">
                                <!-- <form action="carrinho/soma-quantidade" method="post"> -->
                                    <input type="number" id="quantidade" name="quantidade" value="<?= $cc['QUANTIDADE']; ?>" hidden>
                                    <input type="number" id="id" name="id" value="<?= $cc['ID_ITENS_CARRINHO']; ?>" hidden>
                                    <input type="submit" value="+" name="sum" class="form-control">
                                </form>
                            </div>
                            
                            <span class="d-block"><?= $cc['QUANTIDADE_ESTOQUE']; ?> disponíveis</span>
                        </div>
                        <div class="box-preco-carrinho">
                            <span>R$ <span id="valor-total"><?= $cc['SUBTOTAL']; ?></span></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="col-md-12 col-lg-4">
            <div class="border rounded-3 p-4 my-1">
            <h2>Resumo da compra</h2>
                <p>Produtos (<?= $visao_geral['count_itens_carrinho'] ?>): R$<?= $visao_geral['total_geral'] ?></p>
                <p>Frete (Grátis)</p>
                <p style="font-size: 20px;">Total R$ <?= $visao_geral['total_geral'] ?></p>
                <div class="text-center">
                    <a href="<?= base_url('/comprando/endereco-de-entrega/'. $visao_geral['id_carrinho'] . '/' . session()->get('id')) ?>" class="input-rosa w-100 d-block">Continuar a compra</a>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<?php //echo "<pre>"; var_dump($visao_geral); ?>

