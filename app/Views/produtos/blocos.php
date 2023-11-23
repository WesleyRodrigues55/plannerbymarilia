<?php
    $data['title'] = "Blocos";
    $data['link_css'] = "";
?>

<?= view("include/head", $data) ?>
    <?= view("include/nav") ?>

    <main class="container my-5">
        <h1><?= $data['title'] ?></h1>

        <!-- FAZER FILTROS -->

        <!-- row -->
        <div class="row">
            <?php $message_failed = session()->getFlashdata('query-failed'); ?>
            <?php if ($message_failed): ?>
                <div class="alert alert-danger mt-5 text-center" role="alert">
                    <?= $message_failed; ?>
                </div>
            <?php endif; ?>
            <?php foreach($blocos as $b):  ?>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 my-2">
                    <div class="card h-100">
                        <img src="<?= base_url('assets/img/teste/'. $b['IMAGEM']) ?>" class="bd-placeholder-img card-img-top" width="100%" height="100%">
                        <div class="card-body card-products">
                            <h3><?php echo $b['NOME']; ?></h3>
                            <p class="card-text">
                                Por:
                                <br><span><b><?php echo number_format($b['PRECO'], 2, '.', ''); ?></b></span>
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a class="btn input-simples w-100" style="margin-right: 8px" href="<?= base_url('produto/'.$b['CATEGORIA'].'/'.$b['SLUG'].'/'. $b['ID']) ?>">SAIBA MAIS</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        <!-- ../row -->
    </main>

    <?= view("include/footer") ?>
<?= view("include/scripts") ?>