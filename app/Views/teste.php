<?php
$data['title'] = "Perfil Usuário";
$data['link_css'] = "assets/css/teste.css";
?>

<?= view("include/head", $data) ?>

<?= view("include/nav") ?>

    <div class="container">
        <input id="tab1" type="radio" name="tabs" checked>
        <label for="tab1">Minhas informações</label>
            
        <input id="tab2" type="radio" name="tabs">
        <label for="tab2">Meus dados de usuário</label>
            
        <input id="tab3" type="radio" name="tabs">
        <label for="tab3">Meus depoimentos</label>
            
        <input id="tab4" type="radio" name="tabs">
        <label for="tab4">Minhas compras</label>
            
        <section id="content1">
            
        </section>
            
        <section id="content2">
           
        </section>
            
        <section id="content3">
            
        </section>
            
        <section id="content4">
            
        </section>
    
    </div>