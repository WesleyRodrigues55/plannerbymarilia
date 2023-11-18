<?php
    $data['title'] = 'Status Compra';
    $data['link_css'] = "assets/css/carrinho.css";
?>

<?= view("include/head", $data) ?>
    <?= view("include/nav") ?>

    <main class="container my-5" style="max-width: 600px;">
        <div id="aguardando-pagamento" data-id-detalhes-pedido="<?= $id_detalhes_pedido ?>" data-id-carrinho="<?= $id_carrinho ?>"></div>    
        <div id="pagamento-ok"></div>    
    </main>

    <?= view("include/footer") ?>

<?= view("include/scripts") ?>





