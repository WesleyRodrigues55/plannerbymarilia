<?php
$data['link_css'] = "assets/css/perfil.css";
?>
<style>
    /* aqui vai meu conteudo de style */
</style>
<h1 class="titulo-perfil">Minhas compras</h1>
<table class="tabela table table-hover text-center mt-3" style="margin-bottom: 10em;">
    <thead class="table-danger">
        <tr>
            <th scope="col">Foto produto </th>
            <th scope="col">Status</th>
            <th scope="col"></th>
            <th scope="col">Valor</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>

    <thead>
        <tr>
            <td scope="col"><img src="./img/user.png"></td>
            <td scope="col">Entregue</td>
            <td scope="col"></td>
            <td scope="col">R$13,90</td>
            <td>
                <a class="btn input-rosa" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Ver Compra</a>
            </td>
        </tr>
    </thead>
</table>