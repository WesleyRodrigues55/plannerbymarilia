<?php
    $data['title'] = "Página Inicial";
    $data['link_css'] = "assets/css/home.css";
?>

<?= view("include/head", $data) ?>

    <?= view("include/nav", $data) ?>

    <!-- conteúdo home vai aqui -->
    <h1>Sou a home</h1>

<?= view("include/footer") ?>