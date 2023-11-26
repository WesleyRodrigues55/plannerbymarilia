<?php
$data['title'] = "Página Inicial";
$data['link_css'] = "assets/css/home.css";
?>

<?= view("include/head", $data) ?>

<?= view("include/nav") ?>

<!-- conteúdo home vai aqui -->
<main>
    <header>
        <img src="<?= base_url('assets/img/banner-home.png') ?>" class="w-100" alt="">
    </header>
    <?= view("include/produtos-mais-vendidos", $mais_vendidos) ?>

    <!-- planner 2024 -->
    <div class="bg-planner-2024 pb-5 mt-5">
        <div class="container">
            <div class="testee">
                <h2 class="h2-titles"><b>PLANNER<br>2024</b></h2>
            </div>
            <ul>
                <li>Capa dura personalizada</li>
                <li>Folha de metas</li>
                <li>Planejamento anual</li>
                <li>Planejamento semanal</li>
            </ul>
        </div>
        <!-- <img src="assets/img/planner-2024.png" class=""> -->
    </div>
    <!-- ../planner 2024 -->

    <?= view("include/produtos-planners", $planners) ?>
    <?= view("include/produtos-presentes-criativos", $presentes_criativos) ?>
    <?= view("include/instagram") ?>

    <!-- depoimentos -->
    <div class="py-5 box-slider-depoimentos">
        <div class="container">
            <div class="mb-5 text-center">
                <h2 class="h2-titles"><b>DEPOIMENTOS</b></h2>
                <span>DE CLIENTES</span>
            </div>
            <?php $message_failed = session()->getFlashdata('query-depoimentos-failed'); ?>
            <?php if ($message_failed) : ?>
                <div class="alert alert-danger mt-5 text-center" role="alert">
                    <?= $message_failed; ?>
                </div>
            <?php endif; ?>
            <div class="single-item text-center">
                <?php foreach ($depoimentos as $d) : ?>
                    <div class="p-4 text-center borda-depoimentos">
                        <p><?php echo $d['DEPOIMENTO']; ?></p>
                        <a href="https://www.instagram.com/<?php echo $d['INSTAGRAM']; ?>" target="_blank">
                            <h3>@<?php echo $d['NOME']; ?></h3>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <p class="text-center">OU</p>

            <div class="text-center">
                <a class="btn input-simples-outline px-5" href="/depoimentos-clientes">DEIXE UM DEPOIMENTO</a></button>
            </div>

        </div>

    </div>
    <!-- ../depoimentos -->


    </div>


</main>

<div class="whats">
    <a href="https://wa.me/5515996625568" target="_blank">
        <img src="<?= base_url('assets/img/whatsapp.png') ?>" alt="Fale Conosco pelo Whatsapp" width="50">
    </a>

</div>

<?= view("include/footer") ?>

<?= view("include/scripts") ?>