<?php
    $data['title'] = 'Carrinho de Compras';
    $data['link_css'] = "assets/css/carrinho.css";
?>


<?= view("include/head", $data) ?>
    <?= view("include/nav") ?>

    <main class="container my-5">


        <?php if (!$dados_usuario): ?>
            <div class="text-center">
                <h1>Ops!</h1>
                <p>Parece que não há endereços de entrega cadastrados, clique no botão abaixo e cadastre.</p>
                <a href="<?= base_url('/comprando/cadastrando-endereco-de-entrega/'. $id_carrinho . '/'. session()->get('id')) ?>" class="input-simples">Adicionar Endereço</a>
            </div>
        <?php else: ?>
            <h1 class="text-center mb-4">Escolha um endereço de entrega</h1>
            <form method="post" action="<?= base_url('/comprando/adiciona-endereco-de-entrega-em-detalhes-pedido') ?>">
                <div class="d-flex align-items-start gap-2 border rounded-3 p-4">
                    <input type="number" value="<?= $id_carrinho ?>" name="id-carrinho" class="mt-2" readonly hidden>
                    <input type="number" value="<?= $dados_usuario[0]['USUARIO_ID'] ?>" name="id-usuario" class="mt-2" readonly hidden>
                    <input type="radio" value="<?= $dados_usuario[0]['ID'] ?>" name="id-endereco-escolhido" class="mt-2" checked>
                    <div class="w-100">
                        <div class="d-block">
                            <h2 style="margin-bottom: 0px">Enviar no meu endereço</h2>
                            <p>
                                <?= $dados_usuario[0]['RUA'] ?> <?= $dados_usuario[0]['NUMERO'] ?> - <?= $dados_usuario[0]['CIDADE'] ?>
                                <br><?= $dados_usuario[0]['LOCAL_ENTREGA'] ?>
                            </p>
                        </div>
                        <hr>
                        <div class="d-block">
                            <a href="<?= base_url('/comprando/escolhendo-endereco-de-entrega/'. $id_carrinho . '/' . session()->get('id')) ?>">Editar ou escolher outro endereço</a>
                        </div>
                    </div>
                </div>

                
                <div class="d-flex justify-content-end mt-4">
                    <input type="submit" class="input-simples" value="Continuar">
                </div>
            </form>
        <?php endif ?>
    </main>

    <?= view("include/footer") ?>

<?= view("include/scripts") ?>

