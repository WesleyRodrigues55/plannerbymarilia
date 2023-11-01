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
            <div role="alert" id="message-response-action-cart"></div>

            <!-- saída de dados do conteudo carrinho -->
            <div class="py-5"  id="content-carrinho"></div>

            <!-- mensagem de item removido do carrinho -->
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="open-toast" class="toast bg-light" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                    <img src="<?= base_url('favicon.ico') ?>" class="rounded me-2" alt="...">
                    <strong class="me-auto">Planner By marília</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                    <p class="p-small">
                        Produto removido do carrinho!
                    </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
    </main>

    <?= view("include/footer") ?>

<?= view("include/scripts") ?>

