<?php
    $data['title'] = 'Compra Aprovada';
    $data['link_css'] = "assets/css/carrinho.css";
?>

<?= view("include/head", $data) ?>
    <?= view("include/nav") ?>

    <main class="container my-5" style="max-width: 600px;">
        
        <h2>Compra aprovada!</h2>
        
    </main>

    <?= view("include/footer") ?>

<?= view("include/scripts") ?>
<?= view("comprando/scripts/script-review") ?>





