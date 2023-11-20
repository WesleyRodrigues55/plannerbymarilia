<?php
    $data['title'] = 'Status Compra';
    $data['link_css'] = "assets/css/carrinho.css";
?>

<?= view("include/head", $data) ?>
    <?= view("include/nav") ?>

    <main class="container my-5" style="max-width: 600px;">
        <h2 class="mb-4 text-center"><b>Pague R$ <?= $valor_total ?>  via Pix para garantir sua compra</b></h2>
        <br>
        <p><b>Escaneie este código para pagar</b></p>
        <p class="p-small">
            1. Acesse seu Internet Banking ou app de pagamentos.
            <br>2. Escolha pagar via Pix.
            <br>3. Escaneie o seguinte código:
        </p>

        <div class="text-center">
            <img src="data:image/jpeg;base64, <?= $qrcode64 ?> " style='width: 200px'/>
        </div>

        <p class="p-small">Pague e será creditado na hora</p>
        <hr>
        <p><b>Ou copie este código QR para fazer o pagamento</b></p>
        <p class="p-small">Escolha pagar via Pix pelo seu Internet Banking ou app de pagamentos. Depois, cole o seguinte código:</p>

        <div class="input-group mb-3">
            <input type="text" value="<?= $id_transaction ?>" id="id-transaction" hidden readonly>
            <input type="text" value="<?= $id_detalhes_pedido ?>" id="id-detalhes-pedido" hidden readonly>
            <input type="text" class="form-control" id="link-transaction" value="<?= $qrcode ?>" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="button" id="button-copy-1"><img src="<?= base_url('assets/icons/copy.png') ?>" alt="copy" style="width: 24px"></button>
        </div>
        <button class="input-simples" id="button-copy-2">Copiar código</button>

       
    </main>

    <?= view("include/footer") ?>

<?= view("include/scripts") ?>
<?= view("comprando/scripts/script-review") ?>





