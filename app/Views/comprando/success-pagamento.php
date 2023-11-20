<?php
    $data['title'] = 'Compra Aprovada';
    $data['link_css'] = "assets/css/carrinho.css";
?>

<?= view("include/head", $data) ?>
    <?= view("include/nav") ?>

    <main class="container my-5" style="max-width: 600px;">
        
        
        <div class="alert alert-success text-center py-5" role="alert">
            <img src="<?= base_url('assets/icons/approved.png') ?>" alt="" style="width: 120px">
            <br>
            Compra aprovada!
            <br><br>
            <div class="text-center">
                <p>Obrigado pela sua compra, ficamos muito felizes!</p>
                <p>Clique no botão abaixo e acesse suas compras.</p>

                <!-- fazer link para perfil/minhas-compras -->
                <button class="input-simples-outline w-100">Acessar minhas compras</button>
            </div>
        </div>
    </main>

    <?= view("include/footer") ?>

<?= view("include/scripts") ?>





