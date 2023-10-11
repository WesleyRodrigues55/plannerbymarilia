<?php
    $data['title'] = "Login";
    $data['link_css'] = "assets/css/login.css";
?>

<?= view("include/head", $data) ?>


    <div class="h-100 d-flex flex-column justify-content-center align-items-center">
        <img src="assets/img/logo-projeto.png" alt="logo-pojeto" class="logo">
        <h1 class="titulo">Acesse sua Conta</h1>
        <div class="usuario-senha">
            <form method="post" action="" class="formulario">
                <div class="mb-3 d-flex align-items-center">
                    <div style="position: relative; width: 100%;">
                        <input class="w-100 form-control" type="email" placeholder="E-mail" required id="EMAIL" name="EMAIL" value="" />
                        <img src="assets/img/icone-user.png" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); height: 20px; width: 20px;" alt="Ícone user" />
                    </div>
                </div>
                
                <div class="mb-3 d-flex align-items-center">
                    <div style="position: relative; width: 100%;">
                        <input class="mb- w-100 form-control" id="password" type="password" placeholder="Senha" required maxlength="64" name="SENHA" />
                        <img src="assets/img/icone-password.png" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); height: 20px; width: 20px;" alt="Ícone Senha" />
                    </div>
                </div>
                
                <input class="mb-3 w-100 btn input-rosa" type="submit" value="Entrar">

            </form>
            <div class="text-center">
                <a href="#" class="link"> Esqueci minha senha </a>
                <br /><a href="#" class="link"> Ainda não possui cadastro? Crie uma conta! </a>
            </div>
        </div>
    </div>


<?= view("include/scripts") ?>