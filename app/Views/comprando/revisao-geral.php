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
    $data['title'] = 'Revisão Compra';
    $data['link_css'] = "assets/css/carrinho.css";
?>




<?= view("include/head", $data) ?>
    <?= view("include/nav") ?>

    <main class="container my-5">
        <h1 class="mb-4 text-center">Revise e confirme sua compra</h1>
        <br>
        <div class="row">

            <div class="col-md-12 col-lg-8 mt-4">
                <p><b>Detalhe do envio</b></p>
                <div class="d-flex gap-4 align-items-center mb-2 p-4 border rounded-3">
                    <div>
                        <img src="<?= base_url('assets/icons/location.png') ?>" style="width: 32px" alt="location">
                    </div>
                    <div>
                        <span><?= $detalhes_do_pedido[0]['RUA'] ?> <?= $detalhes_do_pedido[0]['NUMERO'] ?></span><br>
                        <span><?= $detalhes_do_pedido[0]['CIDADE'] ?>, <?= $detalhes_do_pedido[0]['ESTADO'] ?> - CEP <?= $detalhes_do_pedido[0]['CEP'] ?></span><br>
                        <span><?= $detalhes_do_pedido[0]['NOME_COMPLETO'] ?> - <?= $detalhes_do_pedido[0]['CELULAR'] ?></span>
                    </div>
                </div>
                <div class="d-flex gap-4 align-items-center mb-2 p-4 border rounded-3">
                    <div>
                        <img src="<?= base_url('assets/icons/delivery-truck.png') ?>" style="width: 32px" alt="delivery-truck">
                    </div>
                    <div class="w-100">
                        <span><b>Produtos</b></span><br>
                        <br>
                        <p class="p-small">Envio</p>
                        <hr>
                        <?php foreach ($itens_carrinho as $ic): ?>
                            <div class="d-flex gap-2 align-items-center my-2">
                                <img src="<?= base_url('assets/img/teste/'. $ic['IMAGEM']) ?>" alt="" style="width: 60px; border-radius: 100%">
                                <div>
                                    <span class="p-small"><b><?= $ic['NOME_PRODUTO'] ?></b></span><br>
                                    <span class="p-small">Quantidade: <?= $ic['QUANTIDADE'] ?></span>
                                </div>
                            </div>
                            <hr>
                        <?php endforeach ?>
                    </div>
                </div>

                <p class="mt-4"><b>Detalhes do pagamento</b></p>
                <div class="d-flex gap-4 align-items-center mb-2 p-4 border rounded-3">
                    <div>
                        <img src="<?= base_url('assets/icons/icon-pix.png') ?>" style="width: 32px" alt="location">
                    </div>
                    <div>
                        <span style="text-transform: uppercase;"><?= $detalhes_do_pedido[0]['FORMA_DE_PAGAMENTO'] ?> </span><br>
                        <span class="p-small">Você pagará <b>R$<?= $detalhes_do_pedido[0]['VALOR_TOTAL'] ?></b></span>
                    </div>
                </div>
                <div class="d-flex gap-4 align-items-center mb-2 p-4 border rounded-3">
                    <div>
                        <img src="<?= base_url('assets/icons/invoice.png') ?>" style="width: 32px" alt="location">
                    </div>
                    <div>
                        <span>Dados para a sua Nota Fiscal eletrônica</span><br>
                        <span><?= $detalhes_do_pedido[0]['NOME_COMPLETO'] ?> - <?= $detalhes_do_pedido[0]['CPF'] ?> </span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12 col-lg-4 px-4 mt-4">
                <p><b>Resumo da compra</b></p>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>Produtos</span>
                    <span>R$ <?= $detalhes_do_pedido[0]['VALOR_TOTAL'] ?></span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Frete</span>
                    <span>R$ 00</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>Você pagará</span>
                    <span>R$ <?= $detalhes_do_pedido[0]['VALOR_TOTAL'] ?></span>
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    <a href="<?= base_url('/comprando/checkout/pagamento/'. $detalhes_do_pedido[0]['ID_DETALHES_DO_PEDIDO'] . '/' . $detalhes_do_pedido[0]['ID_CARRINHO']) ?>" class="input-rosa w-100 text-center">Confirmar a compra</a>
                </div>
                <div class="d-flex justify-content-center mt-2">
                    <a href="<?= base_url('/comprando/formas-de-pagamento/'. $detalhes_do_pedido[0]['ID_CARRINHO'] . '/' . $detalhes_do_pedido[0]['ID_USUARIO']) ?>" class="input-simples w-100 text-center">Voltar</a>
                </div>
            </div>        
        </div>
    </main>

    <?= view("include/footer") ?>

<?= view("include/scripts") ?>




