<?php
$data['link_css'] = "assets/css/perfil.css";
?>

<div class="container p-4">
    <h2 class="mb-2 titulo-perfil">Meus Depoimentos</h2>
    <hr>
    <?php $message_success = session()->getFlashdata('query-depoimentos-success'); ?>
        <?php $message_failed = session()->getFlashdata('query-depoimentos-failed'); ?>

        <?php if ($message_failed): ?>
                <div class="alert alert-danger mt-5 text-center" role="alert">
                    <?php $message_failed; ?>
                </div>
        <?php endif; ?>
        
        <?php if ($message_success): ?>
            <div class="alert alert-success mt-5 text-center" role="alert">
                <?= $message_success; ?>
            </div>
        <?php endif; ?>
    <?php foreach ($depoimentos_usuario as $du): ?>
        <div class="card mb-3 teste-background">
            <div class="card-body">
                <div class="d-flex justify-content-between flex-wrap">
                    <span class="card-text p-small"><i>Em <?= $du['data_formatada'] ?> as <?= $du['hora_formatada'] ?></i></span>
                    <form method="post" action="<?= base_url('/user/desativa-depoimento') ?>">
                        <input type="text" value="<?= $du['ID'] ?>" name="id-depoimento" id="id-depoimento" readonly hidden required>
                        <input type="text" value="tab3" name="item-tab" id="item-tab" readonly hidden required>
                        <button type="submit" class="btn d-flex justify-content-end align-items-center gap-2">
                            <img src="<?= base_url('assets/icons/delete.png') ?>" alt="" style="width: 18px; height: 18px">
                        </button>
                    </form>
                </div>
                <hr>
                <p class="card-text"><?= $du['DEPOIMENTO'] ?></p>
            </div>
        </div>
    <?php endforeach ?>
</div>