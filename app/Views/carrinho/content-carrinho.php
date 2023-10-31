<?php if ($visao_geral['count_itens_carrinho'] == null || $visao_geral['total_geral'] == null  || $visao_geral['id_carrinho'] == null || $carrinho_compras == null):?>
    <div class="d-flex justify-content-center align-items-center text-center" id="carrinho-vazio">
        <div style="max-width: 400px">
            <h2>Monte um carrinho de compras!</h2>
            <p>Adicione produtos e tenha frete grátis.</p>
            <a href="<?= base_url('home') ?>" class="input-rosa">Conferir produtos</a>
        </div>
    </div>
    
<?php else: ?>
    <h1 class="h2-titles mb-5 text-center"><b>CARRINHO DE COMPRAS! <?= session()->get('id')  ?></b></h1>
    <div class="row">
        <div class="col-md-8">
            <?php foreach($carrinho_compras as $cc): ?>
                <div class="d-flex align-items-center box-carrinho my-1 p-4">
                    <div class="box-img-carrinho">
                        <img src="<?php echo base_url('assets/img/teste/'.$cc['IMAGEM']) ?>" alt="img-produto">
                    </div>
                
                    <div class="w-100 d-flex align-items-center justify-content-between">
                        <div>
                            <p><b><?php echo $cc['NOME_PRODUTO'] ?></b></p>
                            <div class="d-flex">
                                <span><a href="">Excluir</a></span>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="d-flex">
                                <form method="post" id="subtraiQuantidadeCarrinho">
                                <!-- <form action="carrinho/subtrai-quantidade" method="post"> -->
                                    <input type="number" id="quantidade" name="quantidade" value="<?php echo $cc['QUANTIDADE']; ?>" hidden>
                                    <input type="number" id="id" name="id" value="<?php echo $cc['ID_ITENS_CARRINHO']; ?>" hidden>
                                    <input type="submit" value="-" name="sub">
                                </form>
                                <span style="width: 100px"><?php echo $cc['QUANTIDADE']; ?></span>
                                <form method="post" id="somaQuantidadeCarrinho">
                                <!-- <form action="carrinho/soma-quantidade" method="post"> -->
                                    <input type="number" id="quantidade" name="quantidade" value="<?php echo $cc['QUANTIDADE']; ?>" hidden>
                                    <input type="number" id="id" name="id" value="<?php echo $cc['ID_ITENS_CARRINHO']; ?>" hidden>
                                    <input type="submit" value="+" name="sum">
                                </form>
                            </div>
                            
                            <span class="d-block">2 disponíveis</span>
                        </div>
                        <div class="box-preco-carrinho">
                            <span>R$ </span>
                            <span id="valor-total"><?php echo $cc['SUBTOTAL']; ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="col-md-2">
            <h2>Resumo da compra</h2>
            <p>Produtos (<?= $visao_geral['count_itens_carrinho'] ?>): R$<?= $visao_geral['total_geral'] ?></p>
            <p>Frete (Grátis)</p>
            <p>Total R$<?= $visao_geral['total_geral'] ?></p>
            <button id="<?= $visao_geral['id_carrinho'] ?>">Continuar a compra</button>
        </div>
    </div>
<?php endif ?>