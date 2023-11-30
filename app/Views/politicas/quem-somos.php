<?php
$data['title'] = "Política da Loja";
$data['link_css'] = "assets/css/quem-somos.css";
?>

<?= view("include/head", $data) ?>
<?= view("include/nav") ?>

<main>
    <div class="container">
        <div class="text-center">
            <h1 class="mt-5"><b>QUEM SOMOS</b></h1>
        </div>

        
        <div class="row my-5">
            <div class="col-12 col-md-12">

                <h2 class="h2-titles"><b>O INÍCIO</b></h2>
                <p>
                    O Planner by Marília nasceu lá em 2018, com um planner pessoal feito pela própria proprietária
                    para si própria organizar sua rotina. A ideia de criar seu próprio planejador surgiu quando a
                    mesma ganhou de um antigo supervisor quando ainda era CLT, seu primeiro planner, ela adorou o
                    conceito de planner, e decidiu então reproduzir o seu com tudo o que gostaria que tivesse para
                    sua organização pessoal, para isso ela precisou fazer curso de encadernação .. e a partir daí,
                    foi encadernação atrás de encadernação, até que decidiu então criar uma página para mostrar suas
                    criações no Instagram.
                </p>
            </div>

           
        </div>

        <div class="row my-5">
            
            <div class="col-12 col-md-6" style = "position: relative"> 
                <img src="<?= base_url('assets/img/equipe.jpg') ?>" alt="" style="width:100%; height: 360px; object-fit: contain">
            </div>

            <div class="col-12 col-md-6">
                <h2 class="h2-titles"><b>HOJE TEMOS ...</b></h2>
                <p>... um time que faz esse negócio acontecer.</p><br>
                <p>Somos em 5 sócios-proprietários:<p>
                <ul>
                    <li>a Marília, idealizadora, sonhadora, designer e a alma criativa desse negócio.</li>
                    <li>o Enrico, que faz com que todas as compras  cheguem à vocês.</li>
                    <li>o João, que deixa esse site aqui, tão fofo que a gente se apaixona antes mesmo de receber o produto.</li>
                    <li>o Lucas, que faz com que o site aconteça, acertando e fazendo tudo o que a gente não vê.</li>
                    <li>e por último e não menos importante, nosso head, que fez com que o site existisse, tomou frente das regras do negócio e botou a mão na massa - ele fica por trás das câmeras, é bravo, exigente, mas olha ai o que ele entregou né? Esse é o Wesley.</li>
                </ul><br>
                
                <p>
                    Time completo, que entrega todas essa fofuras ai para vocês! 
                </p>
            </div>
        </div>

    </div>
</main>

<?= view("include/footer") ?>

<?= view("include/scripts") ?>