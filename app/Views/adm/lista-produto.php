<?php
$data['title'] = "Página Inicial";
$data['link_css'] = "assets/css/listaProduto-adm.css";
?>

<?= view("include/head", $data) ?>

<?= view("include/nav") ?>

<div class="container">
    <div>
        <h2 class="h2-titles mt-4 mt-5 mb-10 px-3"><b>LISTA DE PRODUTOS</b></h2>
    </div>

    <nav class="navbar mt-10 bg-white">
        <div class="container-fluid">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Pesquise o produto" aria-label="Search">
                <button class="btn btn input-rosa" type="submit">Pesquisar</button>
            </form>
        </div>
    </nav>
</div>
<div class="container">
    <table class="tabela table table-hover text-center mt-3" style="margin-bottom: 10em;">
        <thead class=" table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Descrição </th>
                <th scope="col">Descrição imagem</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>

        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Descrição </th>
                <th scope="col">Descrição imagem</th>
                <th scope="col"><button class="input-simples">Editar</button>
                    <button class="input-simples">Excluir</button>
                </th>
            </tr>
        </thead>
    </table>
</div>
<?= view("include/footer") ?>

<?= view("include/scripts") ?>