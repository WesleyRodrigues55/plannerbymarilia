<?php
    $data['title'] = 'Formas de pagamento';
    $data['link_css'] = "";
?>


<?= view("include/head", $data) ?>
    <?= view("include/nav") ?>

    <main class="container py-5">
        <div class="mb-5">
            <h1 class="h2-titles"><b>Como você prefere pagar?</b></h1>
            <span>Com Mercado Pago - <img src="<?= base_url("assets/icons/icon-mp.png") ?>" style="width: 64px" alt="mercado pago"></span>
        </div>

        <?php $message_failed = session()->getFlashdata('query-failed'); ?>
        <?php if ($message_failed): ?>
            <div class="alert alert-danger mt-5 text-center" role="alert">
                <?= $message_failed; ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/comprando/forma-de-pagamento-escolhida') ?>" method="post">
            <div class="d-flex gap-4 align-items-center mb-1 p-4 border rounded-3">
                <div>
                    <input type="number" name="id-carrinho" value="<?= $id_carrinho ?>" required readonly hidden>
                    <input type="number" name="id-usuario" value="<?= $id_usuario ?>" required readonly hidden>
                    <input type="radio" name="forma-de-pagamento" value="pix" required checked>
                </div>
                <div>
                    <img src="<?= base_url('assets/icons/icon-pix.png') ?>" alt="icon-pix" style="width: 32px">
                </div>
                <div>
                    <span>Pix</span>
                    <br><span class="p-small">Aprovação imediata</span>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-4">
                <input type="submit" class="input-rosa" value="Continuar">
            </div>
        </form>
    </main>

  <?= view("include/footer") ?>

<?= view("include/scripts") ?>