<?php if ($visao_geral['count_itens_carrinho'] == null || $visao_geral['total_geral'] == null  || $visao_geral['id_carrinho'] == null || $carrinho_compras == null):?>
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
        <div class="col-md-7">

            <?php foreach($carrinho_compras as $cc): ?>
                <div class="d-flex align-items-center box-carrinho mb-1 p-4 border rounded-3">
                    <div class="box-img-carrinho">
                        <img src="<?= base_url('assets/img/teste/'.$cc['IMAGEM']) ?>" alt="img-produto">
                    </div>
                
                    <div class="w-100 d-flex align-items-center justify-content-between">
                        <div>
                            <b><?= $cc['NOME_PRODUTO'] ?></b>
                            <div class="d-flex">
                                <form method="post" id="removeItemCarrinho">
                                    <input type="number" id="id" name="id" value="<?= $cc['ID_ITENS_CARRINHO']; ?>" hidden>
                                    <button type="submit" name="remover" id="remover" class="botao-remove-item-carrinho p-small">Remover</button>
                                </form>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="d-flex">
                                <form method="post" id="subtraiQuantidadeCarrinho">
                                <!-- <form action="carrinho/subtrai-quantidade" method="post"> -->
                                    <input type="number" id="quantidade" name="quantidade" value="<?= $cc['QUANTIDADE']; ?>" hidden>
                                    <input type="number" id="id" name="id" value="<?= $cc['ID_ITENS_CARRINHO']; ?>" hidden>
                                    <input type="submit" value="-" name="sub" id="sub">
                                </form>
                                <span style="width: 100px" id="quantidade-produto"><?= $cc['QUANTIDADE']; ?></span>
                                <form method="post" id="somaQuantidadeCarrinho">
                                <!-- <form action="carrinho/soma-quantidade" method="post"> -->
                                    <input type="number" id="quantidade" name="quantidade" value="<?= $cc['QUANTIDADE']; ?>" hidden>
                                    <input type="number" id="id" name="id" value="<?= $cc['ID_ITENS_CARRINHO']; ?>" hidden>
                                    <input type="submit" value="+" name="sum">
                                </form>
                            </div>
                            
                            <span class="d-block"><?= $cc['QUANTIDADE_ESTOQUE']; ?> disponíveis</span>
                        </div>
                        <div class="box-preco-carrinho">
                            <span>R$ </span>
                            <span id="valor-total"><?= $cc['SUBTOTAL']; ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="col-md-3 border rounded-3 p-4">
            <h2>Resumo da compra</h2>
            <p>Produtos (<?= $visao_geral['count_itens_carrinho'] ?>): R$<?= $visao_geral['total_geral'] ?></p>
            <p>Frete (Grátis)</p>
            <p>Total R$<?= $visao_geral['total_geral'] ?></p>
            <a href="<?= base_url('/comprando/endereco-de-entrega/'. $visao_geral['id_carrinho'] . '/' . session()->get('id')) ?>" class="input-rosa">Continuar a compra</a>
        </div>
    </div>
<?php endif ?>

<?php //echo "<pre>"; var_dump($visao_geral); ?>

