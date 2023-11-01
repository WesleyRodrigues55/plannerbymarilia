<div class="py-5 container">
    <div class="my-5">
        <br><h2 class="h2-titles"><b>PLANNERS</b></h2>
        <span>PARA UMA VIDA MUITO MAIS ORGANIZADA</span>
    </div>

    <!-- row -->
    <div class="row">
        <?php $message_failed = session()->getFlashdata('query-planners-failed'); ?>
        <?php if ($message_failed): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?= $message_failed; ?>
            </div>
        <?php endif; ?>
        <?php foreach($planners as $p):  ?>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 my-2">
                <div class="card h-100">
                    <img src="<?= base_url('assets/img/teste/'. $p['IMAGEM']) ?>" class="bd-placeholder-img card-img-top" width="100%" height="100%">
                    <div class="card-body card-products">
                        <h3><?php echo $p['NOME']; ?></h3>
                        <p class="card-text">
                            Por:
                            <br><span><b><?php echo number_format($p['PRECO'], 2, '.', ''); ?></b></span>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a class="btn input-simples w-100" style="margin-right: 8px" href="<?= base_url('produto/'.$p['CATEGORIA'].'/'.$p['SLUG'].'/'.$p['ID']) ?>">SAIBA MAIS</a>
                            <?php if (session()->has('usuario')): ?>
                                <form id="adicionaProdutoCarrinho" method="post">
                                <!-- <form action="carrinho/adiciona-produto-carrinho" method="post"> -->
                                    <input type="text" name="id-produto" value="<?= $p['ID'] ?>" id="" hidden readonly>
                                    <input type="text" name="slug" value="<?= $p['SLUG'] ?>" id="" hidden readonly>
                                    <button type="submit" id="submit" name="submit" style="border: none; background: #fff;">
                                        <img src="<?= base_url('assets/img/shopping-cart.png') ?>" alt="" style="width:36px; height: 36px">
                                    </button>
                                </form>
                            <?php else: ?>
                                <button type="submit" id="submit" name="submit" class="faca-login" id="faca-login-<?= $p['SLUG'] ?>" style="border: none; background: #fff;">
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
    <div class="text-center mt-5">
        <a class="btn input-simples px-5" href="planners">VER MAIS</a></button>
    </div>
</div>