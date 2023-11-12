<?php
$data['title'] = "esqueci-senha";
$data['link_css'] = "assets/css/esqueci-senha.css";
?>

<?= view("include/head", $data) ?>


<div class="h-100 d-flex  justify-content-center align-items-center">
    <div class="text-center" style="width:420px;">
        <a href="<?= base_url('home') ?>">
            <img src="<?= base_url('assets/img/logo-projeto-svg.svg') ?>" alt="logo-projeto" class="logo">
        </a>
        <h1 class="titulo"><b>Esqueceu sua senha?</b></h1>
        <p class="text-center">Informe seu e-mail abaixo – Você receberá um link para redefinir sua senha. </p>
        <br>

        <div class="esqueci-senha">
            <form method="post" action="<?= base_url('login/forgot') ?>" class="formulario">
                <div class="mb-3 d-flex align-items-center">
                    <div style="position: relative; width: 100%;">
                        <input class="mb-10 w-379px form-control" id="esqueci-senha" type="email" placeholder="Digite seu email" required maxlength="64" name="EMAIL" value='lucassuzuki13@gmail.com' />
                        <img src="<?= base_url('assets/icons/user-pink.png') ?>" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); height: 20px; width: 20px;" alt="Ícone User" />
                    </div>
                </div>

                <input class="mb-1 w-100 btn input-rosa botao-enviar" type="submit" value="ENVIAR">

            </form>
            <div class="text-center mt-2">
                <a href="../login" class="text-center voltar mt-2">Voltar</a>
            </div>
        </div>
    </div>
</div>