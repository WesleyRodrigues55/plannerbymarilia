<?php
$data['title'] = "Login";
$data['link_css'] = "assets/css/login.css";
?>


<?= view("include/head", $data) ?>

<div class="h-100 d-flex flex-column justify-content-center align-items-center">
    <a href="<?= base_url('home') ?>">
        <img src="<?= base_url('assets/img/logo-2.png') ?>" alt="logo-projeto" class="w-100" style="max-width: 400px">
    </a>
    <h1 class="titulo">Redefinir Senha</h1>

    <div class="usuario-senha">
        <form method="post" action="<?= base_url('user/verificarlogin') ?>" class="formulario">
            <div class="mb-3 d-flex align-items-center">
                <div style="position: relative; width: 100%;">
                    <input class="mb- w-100 form-control" id="password1" type="password" value="" placeholder="Confirme sua nova senha" required maxlength="64" name="NOVA-SENHA" />
                    <img src="<?= base_url('assets/icons/icone-password.png') ?>" id="showsPassword1" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); height: 20px; width: 20px; cursor: pointer;" alt="Ícone Senha" />
                </div>
            </div>
            <div class="mb-3 d-flex align-items-center">
                <div style="position: relative; width: 100%;">
                    <input class="mb- w-100 form-control" id="password2" type="password" value="" placeholder="Confirme sua nova senha" required maxlength="64" name="NOVA-SENHA" />
                    <img src="<?= base_url('assets/icons/icone-password.png') ?>" id="showsPassword2" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); height: 20px; width: 20px; cursor: pointer;" alt="Ícone Senha" />
                </div>
            </div>
            <div>
                <input class="mb-3 w-100 btn input-rosa" type="submit" value="Redefinir" id="enviarButton">
                <script>
                    document.getElementById("enviarButton").addEventListener("click", function() {
                        alert("Senha alterada com sucesso!");
                    });
                </script>

            </div>


        </form>
        <div class="text-center">
            <br /><a href="login/cadastro-usuario" class="link-teste"> Ainda não possui cadastro? Crie uma conta! </a>
        </div>
    </div>
</div>

<script>
    document.getElementById("showsPassword1").addEventListener("click", function() {
        var passwordInput = document.getElementById("password1");
        togglePasswordVisibility(passwordInput);
    });

    document.getElementById("showsPassword2").addEventListener("click", function() {
        var passwordInput = document.getElementById("password2");
        togglePasswordVisibility(passwordInput);
    });

    function togglePasswordVisibility(input) {
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
</script>
<!-- <script>
    document.getElementById("showsPassword").addEventListener("click", function() {
        var passwordInput = document.getElementById("password-2");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    });
</script> -->


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