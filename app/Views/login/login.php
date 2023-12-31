<?php
$data['title'] = "Login";
$data['link_css'] = "assets/css/login.css";
?>


<?= view("include/head", $data) ?>

<div class="h-100 d-flex flex-column justify-content-center align-items-center">
    <a href="<?= base_url('home') ?>">
        <img src="<?= base_url('assets/img/logo-2.png') ?>" alt="logo-projeto" class="w-100" style="max-width: 400px">
    </a>

    
    <h1 class="titulo">Acesse sua Conta</h1>
    
    <div class="usuario-senha">
        <?php $message_failed = session()->getFlashdata('login-failed'); ?>
        <?php if ($message_failed) : ?>
            <div class="alert alert-danger w-100 text-center" role="alert">
                <?= $message_failed; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="<?= base_url('user/verificarlogin') ?>" class="formulario">
            <div class="mb-3 d-flex align-items-center">
                <div style="position: relative; width: 100%;">
                    <input class="w-100 form-control" type="email" placeholder="E-mail" required id="EMAIL" name="EMAIL" value="" />
                    <img src="<?= base_url('assets/icons/icone-user.png') ?>" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); height: 20px; width: 20px;" alt="Ícone user" />
                </div>
            </div>

            <div class="mb-3 d-flex align-items-center">
                <div style="position: relative; width: 100%;">
                    <input class="mb- w-100 form-control" id="password" type="password" value="" placeholder="Senha" required maxlength="64" name="SENHA" />
                    <img src="<?= base_url('assets/icons/icone-password.png') ?>" id="showPassword" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); height: 20px; width: 20px; cursor: pointer;" alt="Ícone Senha" />
                </div>
            </div>

            <div class="form-check botao-check">
                <input class="form-check-input" type="checkbox" name="LEMBRAR_DE_MIM" value="true" id="flexCheckChecked" style="background-color: lightblue; border-color: lightblue; outline: none;">
                <label class=" form-check-label" for="flexCheckChecked">
                    Lembrar de mim
                </label>
            </div>
            <div>
                <input class="mb-3 w-100 btn input-rosa" type="submit" value="Entrar">
            </div>


        </form>
        <div class="text-center">
            <a href="login/esqueceu-senha" class="link"> Esqueci minha senha </a>
            <br /><a href="login/cadastro-usuario" class="link"> Ainda não possui cadastro? Crie uma conta! </a>
        </div>
    </div>
</div>

<?= view("include/scripts") ?>

<script>
    // Icone do password, ocultando e aparecendo senha
    document.getElementById("showPassword").addEventListener("click", () => {
        var passwordInput = document.getElementById("password");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    });
</script>

