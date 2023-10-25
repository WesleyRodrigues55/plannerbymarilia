<?php
    $data['title'] = $produto_selecionado[0]["NOME"];
    $data['link_css'] = "";
?>


<?= view("include/head", $data) ?>
    <?= view("include/nav") ?>

    <main class="container my-5">
    <?php
        // echo "<pre>";
        // var_dump($produto_selecionado);
        // echo"<br><br>";
        // var_dump($opcoes_adicionais);
    ?>

    <form action="<?= base_url('carrinho/adiciona-produto-carrinho') ?>" method="post">
        <input type="text" name="id-produto" value="<?= $produto_selecionado[0]['ID'] ?>" id="" hidden readonly>
        <input type="text" name="slug" value="<?= $produto_selecionado[0]['SLUG'] ?>" id="" hidden readonly>
        <button type="submit" id="submit" name="submit" style="border: none; background: #fff;">
            <img src="<?= base_url('assets/img/shopping-cart.png') ?>" alt="" style="width:36px; height: 36px">
        </button>
    </form>
   
    </main>

    <?= view("include/footer") ?>
<?= view("include/scripts") ?>