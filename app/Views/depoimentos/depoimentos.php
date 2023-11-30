<?php
    $data['title'] = "Depoimentos";
    $data['link_css'] = "assets/css/depoimentos.css";
?>

<?= view("include/head", $data) ?>
<?= view("include/nav") ?>

<main>
    <div class="container">

        <?php $message_success = session()->getFlashdata('depoimento-success'); ?>
        <?php $message_failed = session()->getFlashdata('depoimento-failed'); ?>
        <?php if ($message_failed): ?>
            <div class="alert alert-danger mt-5 text-center" role="alert">
                <?= $message_failed; ?>
            </div>
        <?php endif; ?>

        <?php if ($message_success): ?>
            <div class="alert alert-success mt-5 text-center" role="alert">
                <?= $message_success; ?>
                <br>Para editar seus depoimentos ou excluílos, acesse <a href="<?= base_url('perfil/meus-depoimentos'); ?>">Meus depoimentos</a>.
            </div>
        <?php endif; ?>
       
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

        <form class="" action="testimony/salvar" method="post">    
            <div class="row">
                <div class=" col-md-6">
                    <label for="nome" class="preencher">NOME*</label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite o seu nome" required>
                    <div class="invalid-feedback">
                        Por favor preencha o seu nome.
                    </div>
                </div>

                <div class=" col-md-6">
                    <label for="email" class="preencher">EMAIL*</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="email@dominio.com.br" required>
                    <div class="invalid-feedback">
                        Por favor preencha o seu email.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="telefone" class="preencher">TELEFONE</label>
                    <input type="text" name="telefone" class="form-control" id="telefone" required>
                </div>

                <div class="col-md-6">
                    <label for="instagram" class="preencher">INSTAGRAM</label>
                    <input type="text" class="form-control" name="instagram" id="instagram" required>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="name" class="preencher">MENSAGEM*</label>
                    <textarea class="form-control message-field" name="mensagem" id="name" rows="5" required></textarea>
                </div>
            </div>

            <div class="col-md-12 mt-3 d-flex justify-content-end">
                <input type="submit" class="btn input-rosa px-5" value="ENVIAR">
            </div>

            <p class="text-right my-5">Também sabemos que muitas vezes imprevistos podem acontecer, se esse é o seu caso e
                você precisa de qualquer tipo de suporte, é só enviar um e-mail para planner.bymarilia@hotmail.com ou nos
                chamar no whatsapp que nós vamos tentar ajudar rapidinho.</p>
        </form>     
    </div>
    

</main>

<?= view("include/footer") ?>

<?= view("include/scripts") ?>