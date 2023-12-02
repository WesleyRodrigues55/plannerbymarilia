<?php
$data['link_css'] = "assets/css/perfil.css";
?>
<div class="container">
    <h2 class="my-2 titulo-perfil">Minhas Compras</h2>
    <hr>
    <?php
        // echo "<pre>";
        // var_dump($compras_usuario);
    ?>
    <table class="tabela table table-hover text-center mt-3" style="margin-bottom: 10em;">
        <thead class="table-danger">
            <tr>
                <th scope="col">Status</th>
                <th scope="col">Valor</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>

        <thead>
            <?php foreach($compras_usuario as $compras): ?>
                <tr>
                    <td scope="col"><?= $compras['STATUS_PEDIDO'] ?></td>
                    <td scope="col"></td>
                    <td scope="col"><?= $compras['TOTAL_PEDIDO'] ?></td>
                    <td>
                        <a class="btn input-rosa" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Ver Compra</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$compras_usuario): ?>
                <tr>
                    <td colspan="3">Nada por aqui.</td>
                </tr>
            <?php endif; ?>
        </thead>
    </table>
</div>