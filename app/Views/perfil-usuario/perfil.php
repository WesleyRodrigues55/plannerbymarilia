<?php
$data['title'] = "Perfil Usuário";
$data['link_css'] = "assets/css/perfil.css";
?>

<?= view("include/head", $data) ?>

<?= view("include/nav") ?>
<main class="main">
    <div class="responsive-wrapper">
        <div class="content">
            <div class="content-panel">
                <div class="vertical-tabs">
                    <a href="#" id="content1" class="mb-2" style="box-shadow: 5px 5px 3px rgba(0, 0, 0, 0.2);">Minhas informações</a>
                    <a href="#" id="content2" class="mb-2" style="box-shadow: 5px 5px 3px rgba(0, 0, 0, 0.2);">Dados do Usuário</a>
                    <a href="#" id="content3" class="mb-2" style="box-shadow: 5px 5px 3px rgba(0, 0, 0, 0.2);">Meus Depoimentos</a>
                    <a href="#" id="content4" class="mb-2" style="box-shadow: 5px 5px 3px rgba(0, 0, 0, 0.2);">Minhas compras</a>
                </div>
            </div>

            <div class="content-main">
                <div class="box" id="item1" style="display: none; border: 1px solid var(--cor-cinza); padding: 10px; width: 100%; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);">
                    <?= view("perfil-usuario/include/minhas-informacoes", $usuario_selecionado) ?>
                </div>
                <div class="box" id="item2" style="display: none; border: 1px solid var(--cor-cinza); width: 100%; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);">
                    <?= view("perfil-usuario/include/dados-usuario", ) ?> <!-- para referenciar o conteudo-->
                </div>

                <div class="box" id="item3" style="display: none; border: 1px solid var(--cor-cinza); width: 100%; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);">
                    <?= view("perfil-usuario/include/meus-depoimentos") ?><!-- para referenciar o conteudo-->
                </div>
                <div class="box" id="item4" style="display: none; border: 1px solid var(--cor-cinza); padding: 10px; width: 100%; box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.2);">
                    <?= view("perfil-usuario/include/minhas-compras") ?><!-- para referenciar o conteudo-->
                </div>
            </div>
        </div>
</main>

<?= view("include/footer") ?>

<?= view("include/scripts") ?>