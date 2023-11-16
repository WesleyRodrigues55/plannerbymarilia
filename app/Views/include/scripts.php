    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- SLick JS -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.single-item').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                infinite: true,
                speed: 500,
                fade: true,
                cssEase: 'linear',
                arrows: false,
            });
        });
    </script>

    <!-- Nav JS -->
    <script src="<?= base_url('assets/js/nav.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Mercado Pago - Pix -->
    <script src="https://sdk.mercadopago.com/js/v2" type="text/javascript"></script>
    <!-- <script src="<?php //base_url('assets/js/payment.js') ?>" type="text/javascript"></script> -->

    <?php if (!isset($script_payment)): ?>

    <?php else: ?>
        <script src="<?= base_url($script_payment) ?>"></script>
    <?php endif ?>
   

    <!-- Nav JS -->
    <script src="<?= base_url('assets/js/nav.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/main.js') ?>" type="text/javascript"></script>

    <!-- SLick JS -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/carousel-slick.js') ?>" type="text/javascript"></script>

    <!-- Instagram JS -->
    <script async src="https://www.instagram.com/embed.js"></script>
    <script type="text/javascript" src="https://instaembedcode.com/in.js"></script>

    <!-- Perfil do Usuário -->
    <script src="<?= base_url('assets/js/perfil-usuario.js') ?>"></script>



    </body>
