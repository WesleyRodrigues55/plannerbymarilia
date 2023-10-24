<div class="py-5 container">
    <div class="my-5">
        <br><h2 class="h2-titles"><b>PRESENTES CRIATIVOS</b></h2>
        <span>AQUELE PRODUTINHO QUE NÃO TEM ERRO NA HORA DA ESCOLHA .. <b>TODO MUNDO GOSTA!</b></span>
    </div>

    <!-- row -->
    <div class="row">
        <?php $message_failed = session()->getFlashdata('query-presentes-criativos-failed'); ?>
        <?php if ($message_failed): ?>
            <div class="alert alert-danger text-center" role="alert">
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
                            <a href=""><img src="<?= base_url('assets/img/shopping-cart.png') ?>" alt="" style="width:36px; height: 36px"></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- ../row -->
    <div class="text-center mt-5">
        <a class="btn input-simples px-5" href="presentes-criativos">VER MAIS</a></button>
    </div>
</div>