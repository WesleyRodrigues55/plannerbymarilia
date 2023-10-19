<?php
    $data['title'] = "Depoimentos";
    $data['link_css'] = "assets/css/depoimentos.css";
?>

<?= view("include/head", $data) ?>
<?= view("include/nav") ?>

<main>

    <div class="container">
        <div class="my-5">
            <br>
            <h2 class="h2-titles"><b>NOSSOS CLIENTES. NOSSOS PARCEIROS.</b></h2>
            <span>SÃO VOCÊS QUE NOS IMPULSIONAM TODOS OS DIAS.</span>
        </div>

        <div class="my-5">
            <br>
            <h2 class="h2-titles"><b>Deixe aqui seu recadinho para nós.</b></h2>
            <p class="my-5">Amamos receber os recadinhos de vocês, sua opinião é muito importante pra gente. Assim podemos melhorar e
                também ficamos super orgulhosos com os elogios e carinho que enviam quando recebem nossos produtos,
                nossos corações enchem de alegria.</p>
        </div>

        <div class="row">
            <div class=" col-md-6">
                <label for="nome" class="preencher">NOME*</label>
                <input type="text" class="form-control" id="nome" placeholder="Digite o seu nome" required>
                <div class="invalid-feedback">
                    Por favor preencha o seu nome.
                </div>
            </div>

            <div class=" col-md-6">
                <label for="email" class="preencher">EMAIL*</label>
                <input type="text" class="form-control" id="email" placeholder="email@dominio.com.br" required>
                <div class="invalid-feedback">
                    Por favor preencha o seu email.
                </div>
            </div>

            <div class="col-md-6">
                <label for="telefone" class="preencher">TELEFONE</label>
                <input type="text" class="form-control" id="telefone">
            </div>

            <div class="col-md-6">
                <label for="instagram" class="preencher">INSTAGRAM</label>
                <input type="text" class="form-control" id="instagram">
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="name" class="preencher">MENSAGEM</label>
                <textarea class="form-control message-field" id="name" rows="5"></textarea>
            </div>
        </div>

        <div class="col-md-12 mt-3 d-flex justify-content-end">
            <a class="btn input-rosa px-5" href="#">ENVIAR</a></button>
        </div>

        <p class="text-right my-5">Também sabemos que muitas vezes imprevistos podem acontecer, se esse é o seu caso e
            você precisa de qualquer tipo de suporte, é só enviar um e-mail para planner.bymarilia@hotmail.com ou nos
            chamar no whatsapp que nós vamos tentar ajudar rapidinho.</p>
            
    </div>


</main>

<?= view("include/footer") ?>

<?= view("include/scripts") ?>