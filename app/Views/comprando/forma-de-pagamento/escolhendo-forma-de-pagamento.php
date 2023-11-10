<?php
    $data['title'] = 'Forma de pagamento';
    $data['link_css'] = "";
?>


<?= view("include/head", $data) ?>
    <?= view("include/nav") ?>

    <main class="container py-5">
        <h1>Sou a tela de pagamento</h1>

        <form id="form-checkout" action="/process_payment" method="post">
            <div>
            <div>
                <label for="payerFirstName">Nome</label>
                <input id="form-checkout__payerFirstName" name="payerFirstName" type="text">
            </div>
            <div>
                <label for="payerLastName">Sobrenome</label>
                <input id="form-checkout__payerLastName" name="payerLastName" type="text">
            </div>
            <div>
                <label for="email">E-mail</label>
                <input id="form-checkout__email" name="email" type="text">
            </div>
            <div>
                <label for="identificationType">Tipo de documento</label>
                <select id="form-checkout__identificationType" name="identificationType" type="text"></select>
            </div>
            <div>
                <label for="identificationNumber">Número do documento</label>
                <input id="form-checkout__identificationNumber" name="identificationNumber" type="text">
            </div>
            </div>

            <div>
            <div>
                <input type="hidden" name="transactionAmount" id="transactionAmount" value="100">
                <input type="hidden" name="description" id="description" value="Nome do Produto">
                <br>
                <button type="submit">Pagar</button>
            </div>
            </div>
        </form>
    </main>

  <?= view("include/footer") ?>

<?= view("include/scripts") ?>