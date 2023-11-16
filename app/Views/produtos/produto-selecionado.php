<?php
    $data['title'] = $produto_selecionado[0]["NOME"];
    $data['link_css'] = "";
?>


<?= view("include/head", $data) ?>
    <?= view("include/nav") ?>

    <main class="container my-5">


    <?php if (session()->has('usuario')): ?>
        <form id="adicionaProdutoCarrinho" method="post">
        <!-- <form action="carrinho/adiciona-produto-carrinho" method="post"> -->
            <input type="text" name="id-produto" value="<?= $produto_selecionado[0]['ID'] ?>" id="" hidden readonly>
            <input type="text" name="slug" value="<?= $produto_selecionado[0]['SLUG'] ?>" id="" hidden readonly>
            <button type="submit" id="submit" name="submit" style="border: none; background: #fff;">
                <img src="<?= base_url('assets/img/shopping-cart.png') ?>" alt="" style="width:36px; height: 36px">
            </button>
        </form>
    <?php else: ?>
        <button type="submit" id="submit" name="submit" class="faca-login" id="faca-login-<?= $produto_selecionado[0]['SLUG'] ?>" style="border: none; background: #fff;">
            <img src="<?= base_url('assets/img/shopping-cart.png') ?>" alt="" style="width:36px; height: 36px">
        </button>
    <?php endif; ?>
    

    <?php
        echo "<pre>";
        var_dump($produto_selecionado);
        echo"<br><br>";
        var_dump($opcoes_adicionais);
    ?>

    <div class="slider-container">
        <div class="slider-for">
        <div>1</div>
        <div>2</div>
        <div>3</div>
        <!-- Adicione mais slides conforme necessário -->
        </div>

        <div class="slider-nav">
        <div>1</div>
        <div>2</div>
        <div>3</div>
        <!-- Adicione mais miniaturas conforme necessário -->
        </div>
    </div>


   
    </main>

    <?= view("include/footer") ?>
<?= view("include/scripts") ?>