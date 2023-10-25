<?php
    $data['title'] = 'Carrinho de Compras';
    $data['link_css'] = "assets/css/carrinho.css";
?>


<?= view("include/head", $data) ?>
    <?= view("include/nav") ?>

    <main class="container my-5">
        <?php if (!session()->has('usuario')): ?>
            <div class="text-center py-5">
                <h1>Ops...</h1>
                <p>Você precisa fazer login para salvar os itens no carrinho!</p>
                <br><br>

                <p>Se você possuí uma conta em nossa plataforma, clique no botão abaixo e faça login.</p>
                <a href="<?= base_url('login') ?>" class="input-rosa">Fazer login</a>
                
                <br><br>
                <p>OU</p>

                <p>Clique no botão abaixo e crie uma conta.</p>
                <a href="<?= base_url('login/cadastro-usuario') ?>" class="input-rosa">Criar conta</a>

            </div>
        <?php endif; ?>

        <?php if (session()->has('usuario')): ?>
            <div class="py-5">
                <?php $message_failed = session()->getFlashdata('query-failed'); ?>
                <?php if ($message_failed): ?>
                    <div class="text-center">
                        <h1 class="h2-titles"><b>CARRINHO DE COMPRAS VAZIO!</b></h1>
                        <span>Você não possui itens em seu carrinho de compras.</span>
                    </div>
                <?php endif; ?>
                
                <?php if ($carrinho_compras != null): ?>
                        <h1 class="h2-titles mb-5"><b>CARRINHO DE COMPRAS!</b></h1>
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
                                                    <form action="carrinho/subtrai-quantidade" method="post">
                                                        <input type="number" name="quantidade" value="<?php echo $cc['QUANTIDADE']; ?>" hidden>
                                                        <input type="number" name="id" value="<?php echo $cc['ID_ITENS_CARRINHO']; ?>" hidden>
                                                        <input type="submit" value="-" name="sub">
                                                    </form>
                                                    <input type="number" name="quantidade" value="<?php echo $cc['QUANTIDADE']; ?>">
                                                    <form action="carrinho/soma-quantidade" method="post">
                                                        <input type="number" name="quantidade" value="<?php echo $cc['QUANTIDADE']; ?>" hidden>
                                                        <input type="number" name="id" value="<?php echo $cc['ID_ITENS_CARRINHO']; ?>" hidden>
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
                            <!-- ../col -->
                            <div class="col-md-2">
                                <h2>Resumo da compra</h2>
                                <p>Produtos (<?= $visao_geral['count_itens_carrinho'] ?>): R$<?= $visao_geral['total_geral'] ?></p>
                                <p>Frete (Grátis)</p>
                                <p>Total R$<?= $visao_geral['total_geral'] ?></p>
                                <button id="<?= $visao_geral['id_carrinho'] ?>">Continuar a compra</button>
                            </div>
                            <!-- ../col -->
                        </div>
                        <!-- ../row -->
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
    </main>

    <?= view("include/footer") ?>

<?= view("include/scripts") ?>