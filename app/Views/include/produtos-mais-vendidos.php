<div class="py-5 container">

    <div class="my-5">
        <span>MODELOS MAIS</span>
        <br><h2 class="h2-titles"><b>VENDIDOS DA SEMANA</b></h2>
    </div>

    <!-- row -->
    <div class="row">
        <?php foreach($mais_vendidos as $mv):  ?>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 my-2">
                <div class="card h-100">
                    <img src="<?= base_url('assets/img/teste/'. $mv['IMAGEM']) ?>" class="bd-placeholder-img card-img-top" width="100%" height="100%">
                    <div class="card-body card-products">
                        <h3><?php echo $mv['NOME']; ?></h3>
                        <p class="card-text">
                            Por:
                            <br><span><b><?php echo number_format($mv['PRECO'], 2, '.', ''); ?></b></span>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a class="btn input-simples w-100" style="margin-right: 8px" href="<?= base_url($mv['CATEGORIA'].'/'.$mv['SLUG'].'/'. $mv['ID']) ?>">SAIBA MAIS</a>
                            <a href=""><img src="<?= base_url('assets/img/shopping-cart.png') ?>" alt="" style="width:36px; height: 36px"></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
    <!-- ../row -->
    <div class="text-center mt-5">
        <a class="btn input-simples px-5" href="mais-vendidos-semana">VER MAIS</a></button>
    </div>
    
</div>
