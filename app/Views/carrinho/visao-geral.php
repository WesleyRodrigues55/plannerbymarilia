<?php if ($visao_geral['count_itens_carrinho'] == null || $visao_geral['total_geral'] == null  || $visao_geral['id_carrinho'] == null): return null;?>
    
<?php else: ?>
    <h2>Resumo da compra</h2>
    <p>Produtos (<?= $visao_geral['count_itens_carrinho'] ?>): R$<?= $visao_geral['total_geral'] ?></p>
    <p>Frete (Grátis)</p>
    <p>Total R$<?= $visao_geral['total_geral'] ?></p>
    <button id="<?= $visao_geral['id_carrinho'] ?>">Continuar a compra</button>
<?php endif ?>


