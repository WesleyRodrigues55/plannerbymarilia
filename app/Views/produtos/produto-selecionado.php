<?php
    $data['title'] = $produto_selecionado[0]["NOME"];
    $data['link_css'] = "";
?>


<?= view("include/head", $data) ?>
    <?= view("include/nav") ?>

    <main class="container my-5">
    <?php
        echo "<pre>";
        var_dump($produto_selecionado);
        echo"<br><br>";
        var_dump($opcoes_adicionais);
    ?>
    </main>

    <?= view("include/footer") ?>
<?= view("include/scripts") ?>