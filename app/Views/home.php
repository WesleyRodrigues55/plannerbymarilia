<?php
    $data['title'] = "Página Inicial";
    $data['link_css'] = "assets/css/home.css";
?>

<?= view("include/head", $data) ?>

    <?= view("include/nav") ?>

    <!-- conteúdo home vai aqui -->
    <main>
        <?= view("include/produtos-mais-vendidos") ?>

        <!-- planner 2024 -->
        <div class="bg-planner-2024 pb-5">
            <div class="container">
                <div class="testee">
                    <h2 class="h2-titles"><b>PLANNER<br>2024</b></h2>
                </div>
                <ul>
                    <li>Capa dura personalizada</li>
                    <li>Folha de metas</li>
                    <li>Planejamento anual</li>
                    <li>Planejamento semanal</li>
                </ul>
            </div>
            <!-- <img src="assets/img/planner-2024.png" class=""> -->
        </div>  
        <!-- ../planner 2024 -->

        <?= view("include/produtos-planners") ?>
        <?= view("include/produtos-presentes-criativos") ?>
        <?= view("include/instagram") ?>

        <!-- depoimentos -->
        <div class="py-5 box-slider-depoimentos">
            <div class="container">
                <div class="mb-5 text-center">
                    <h2 class="h2-titles"><b>DEPOIMENTOS</b></h2>
                    <span>DE CLIENTES</span>
                </div>

                <div class="single-item text-center">
                    <div class="p-4 text-center borda-depoimentos">
                        <p>“Ganhei uma vez um planner diário de presente de uma amiga, foi assim que conheci a papelaria, desde então passei a seguir e hoje sou cliente e apaixonada pelos produtos”</p>
                        <h3>- Fabiana G.</h3>
                    </div>
                    <div class="p-4 text-center borda-depoimentos">
                        <p>"Todo ano faço meu planner com a Marília, me sinto muito mais organizada e produtiva quando escrevo em um produto exclusivo"</p>
                        <h3>- Mariana C.</h3>
                    </div>
                    <div class="p-4 text-center borda-depoimentos">
                        <p>"O atendimento, o cuidado em entender e oferecer o que precisamos é maravilhoso. Compro bloquinhos personalizados para minha empresa todo ano para presentear os clientes, e eles amam"</p>
                        <h3>- Juliana C.</h3>
                    </div>
                </div>

                <p class="text-center">OU</p>

                <div class="text-center">
                    <a class="btn input-simples-outline px-5" href="">DEIXE UM DEPOIMENTO</a></button>
                </div>

            </div>
            
        </div>
        <!-- ../depoimentos -->
    
    
</div>

        
    </main>

    <?= view("include/footer") ?>

<?= view("include/scripts") ?>