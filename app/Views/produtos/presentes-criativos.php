<?php
    $data['title'] = "Presentes Criativos";
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
            <?php foreach($presentes_criativos as $pc):  ?>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 my-2">
                    <div class="card h-100">
                        <img src="<?= base_url('assets/img/teste/'. $pc['IMAGEM']) ?>" class="bd-placeholder-img card-img-top" width="100%" height="100%">
                        <div class="card-body card-products">
                            <h3><?php echo $pc['NOME']; ?></h3>
                            <p class="card-text">
                                Por:
                                <br><span><b><?php echo number_format($pc['PRECO'], 2, '.', ''); ?></b></span>
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a class="btn input-simples w-100" style="margin-right: 8px" href="<?= base_url('produto/'.$pc['CATEGORIA'].'/'.$pc['SLUG'].'/'. $pc['ID']) ?>">SAIBA MAIS</a>
                                <?php if (session()->has('usuario')): ?>
                                    <form id="adicionaProdutoCarrinho" method="post">
                                    <!-- <form action="carrinho/adiciona-produto-carrinho" method="post"> -->
                                        <input type="text" name="id-produto" value="<?= $pc['ID'] ?>" id="" hidden readonly>
                                        <input type="text" name="slug" value="<?= $pc['SLUG'] ?>" id="" hidden readonly>
                                        <button type="submit" id="submit" name="submit" style="border: none; background: #fff;">
                                            <img src="<?= base_url('assets/img/shopping-cart.png') ?>" alt="" style="width:36px; height: 36px">
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <button type="submit" id="submit" name="submit" class="faca-login" id="faca-login-<?= $pc['SLUG'] ?>" style="border: none; background: #fff;">
                                        <img src="<?= base_url('assets/img/shopping-cart.png') ?>" alt="" style="width:36px; height: 36px">
                                    </button>
                                <?php endif; ?>
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