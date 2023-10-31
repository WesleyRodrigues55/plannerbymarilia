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
            
        <?php else: ?>
            <div class="py-5"  id="content-carrinho">
                
            </div>
        <?php endif; ?>
        
    </main>

    <?= view("include/footer") ?>



<?= view("include/scripts") ?>

