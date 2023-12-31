<?php
    $data['title'] = 'Escolhendo Endereço de Entrega';
    $data['link_css'] = "assets/css/carrinho.css";
?>


<?= view("include/head", $data) ?>
    <?= view("include/nav") ?>

    <main class="container my-5">
        <h1 class="text-center mb-4">Meus Endereços</h1>
    
        <form method="post" action="<?= base_url('/comprando/adiciona-endereco-de-entrega-em-detalhes-pedido') ?>">
            <?php foreach ($dados_usuario as $du): ?>
                <div class="d-flex align-items-start gap-2 border rounded-1 p-4 mb-2">
                    <input type="number" value="<?= $id_carrinho ?>" name="id-carrinho" class="mt-2" readonly hidden>
                    <input type="number" value="<?= $du['USUARIO_ID'] ?>" name="id-usuario" class="mt-2" readonly hidden>

                    <?php if ($du['CHECKED'] == 1): ?>
                        <input type="radio" value="<?= $du['ID'] ?>" name="id-endereco-escolhido" class="mt-2" checked>
                    <?php else: ?>
                        <input type="radio" value="<?= $du['ID'] ?>" name="id-endereco-escolhido" class="mt-2">
                    <?php endif; ?>
                    <div class="w-100">
                        <div class="d-block">
                            <p>
                                <?= $du['RUA'] ?> <?= $du['NUMERO'] ?>
                                <br><?= $du['CIDADE'] ?>, <?= $du['ESTADO'] ?> - CEP <?= $du['CEP'] ?>
                                <br><?= $du['NOME_COMPLETO'] ?> - <?= $du['CELULAR'] ?>
                                <br>Residencial
                            </p>
                        </div>
                        <hr>
                        <div class="d-block">
                            <a href="<?= base_url('comprando/editando-endereco-de-entrega/'. $du['ID'] . '/' . $du['USUARIO_ID'] . '/' . $id_carrinho) ?>">Editar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>

            <div class="d-flex justify-content-between mt-4 gap-2">
                <a href="<?= base_url('/comprando/cadastro-endereco-de-entrega/'. $id_carrinho . '/' . $du['USUARIO_ID']) ?>" class="input-simples">Adicionar Endereço</a>
                <input type="submit" class="input-rosa" value="Continuar">
            </div>
        </form>
    </main>

    <?= view("include/footer") ?>

<?= view("include/scripts") ?>

