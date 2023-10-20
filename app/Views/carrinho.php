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
                <?php if ($carrinho_compras == null): ?>
                    <div class="text-center">
                        <h1 class="h2-titles"><b>CARRINHO DE COMPRAS VAZIO!</b></h1>
                        <span>Você não possui itens em seu carrinho de compras.</span>
                    </div>
                <?php endif; ?>

                <?php if ($carrinho_compras != null): ?>
                    <!-- <div class="text-center"> -->
                        <h1 class="h2-titles"><b>CARRINHO DE COMPRAS!</b></h1>
                        <?php //echo "<pre>"; var_dump($carrinho_compras); ?>
                        <?php foreach($carrinho_compras as $cc): ?>
                            <div class="d-flex align-items-center">
                                <div class="box-img-carrinho">
                                    <img src="<?php echo base_url('assets/img/teste/'.$cc['IMAGEM']) ?>" alt="img-produto">
                                </div>
                            
                                <div class="w-100 d-flex align-items-center justify-content-between">
                                    <div>
                                        <h2><?php echo $cc['NOME_PRODUTO'] ?></h2>
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
                                    <div>
                                        <span>R$ </span>
                                        <span id="valor-total">100</span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <!-- </div> -->
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
    </main>

    <?= view("include/footer") ?>

<?= view("include/scripts") ?>