<!-- <p>
    tem que ter:
    <br>Endereço de entrega escolhido
    <br>Os produtos que serão comprados (uma lista simples e pequena)
    <br>A forma de pagamento (Pix)
    <br>Dados para nota fiscal (o que conter?) -- deixar em standy by?
    <br>Valor total da compra
    <br><br>E o botão de CONFIRMAR COMPRA
</p>

<p>Após clicar em confirmar compra: levar para pagamento PIX, mas levar os dados pessoasi do usuário/pessoa para pagamento (nome, sobrenome, cpf, cep, etc...)</p> -->

<?php
    $data['title'] = 'Editando um Endereço de Entrega';
    $data['link_css'] = "assets/css/carrinho.css";
?>




<?= view("include/head", $data) ?>
    <?= view("include/nav") ?>

    <main class="container my-5">
        <h1 class="mb-4 text-center">Pague R$ <?= $valor_total ?>  via Pix para garantir sua compra</h1>
        <br>

        


        <p><b>Escaneie este código para pagar</b></p>
        <p class="p-small">
            Acesse seu Internet Banking ou app de pagamentos.
            <br>Escolha pagar via Pix.
            <br>Escaneie o seguinte código:
        </p>

        <p>QRCODE</p>

        <p>Pague e será creditado na hora</p>
        <hr>
        <p><b>Ou copie este código QR para fazer o pagamento</b></p>
        <p class="p-small">Escolha pagar via Pix pelo seu Internet Banking ou app de pagamentos. Depois, cole o seguinte código:</p>

        <input type="text" class="form-control" value="AKXANWDNAWN3289DN93F292">
        <br>
        <button class="input-simples">Copiar</button>
        
    </main>

    <?= view("include/footer") ?>

<?= view("include/scripts") ?>
<?= view("comprando/scripts/script-cadastro-cep") ?>




