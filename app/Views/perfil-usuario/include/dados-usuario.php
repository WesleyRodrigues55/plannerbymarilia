<?php
$data['link_css'] = "assets/css/perfil.css";
?>

<div class="container">

    <div class="h-100 col-md-12 p-2">
        <h2 class="mb-2 mt-2 titulo-perfil">Dados do Usuário</h2>
        <hr>
        <form id="AlterarSenhaUsuarioLogado" method="post">
            <div class="row p-2">
                <div class="col-md-12">
                    <div class="text-center bg-perfil p-4">
                        <input type="file" id="userImage" style="display: none;">
                        <img class="" id="userImageDisplay" style="width: 100px; cursor: pointer;" src="/assets/icons/user-profile.png" alt="Imagem de perfil">
                    </div>
                </div>
                <div class="col-md-12 mb-2 p-2 my-2 col-md-12">
                    <label for="userEmail"><b>Email do Usuário</b></label>
                    <input type="email" class="form-control" id="" value="<?= session()->get('usuario') ?>" name="usuario" disabled>
                    <input type="text" class="form-control" id="" value="<?= session()->get('id') ?>" name="id" hidden readonly>
                </div>
                <div class="mb-2 row">
                    <div class="col-md-6 p-2 mb-2">
                        <label for="userPassword" class="form-label "><b>Senha do Usuário</b></label>
                        <div style="position: relative; width: 100%;">
                            <input class="w-100 form-control" id="senha" type="password" value="" placeholder="Senha" required maxlength="64" name="senha" />
                            <img src="<?= base_url('assets/icons/icone-password.png') ?>" id="showPassword" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); height: 20px; width: 20px; cursor: pointer;" alt="Ícone Senha" />
                        </div>
                        <i>Força da senha: conter maíuscula, numerais e caractere especial</i><br>
                        <div id="mensagemSenha"></div>
                    </div>
                    <div class="col-md-6 p-2 mb-2">
                        <label for="userPassword" class="form-label "><b>Confirme sua Senha</b></label>
                        <div style="position: relative; width: 100%;">
                            <input class="mb- w-100 form-control" id="confirma" type="password" value="" placeholder="Senha" required maxlength="64" name="confirmar-senha" />
                            <img src="<?= base_url('assets/icons/icone-password.png') ?>" id="showPassword" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); height: 20px; width: 20px; cursor: pointer;" alt="Ícone Senha" />
                        </div>
                        <div id="mensagemSenhaConfirma"></div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" id="btnSubmit" class="btn  w-100 d-block input-rosa">Atualizar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>


<script>
    const userImageInput = document.getElementById('userImage');
    const userImageDisplay = document.getElementById('userImageDisplay');
    const userPasswordInput = document.getElementById('userPassword');
    const updateButton = document.getElementById('updateButton');

    userImageDisplay.addEventListener('click', () => {
        userImageInput.click();
    });

    userImageInput.addEventListener('change', () => {
        const file = userImageInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                userImageDisplay.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    if (updateButton) {
        updateButton.addEventListener('click', () => {
        // Aqui você pode implementar a lógica para atualizar a senha do usuário.
        const newPassword = userPasswordInput.value;
        // Faça algo com a nova senha (por exemplo, envie para o servidor).
    });
    }
    

    // Icone do password, ocultando e aparecendo senha
    document.getElementById("showPassword").addEventListener("click", () => {
        var passwordInput = document.getElementById("senha");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    });


    document.addEventListener('DOMContentLoaded', function () {
        var senhaInput = document.getElementById('senha');
        var senhaConfirmaInput = document.getElementById('confirma');
        var mensagemSenha = document.getElementById('mensagemSenha');
        var mensagemSenhaConfirma = document.getElementById('mensagemSenhaConfirma');
        var btnSubmit = document.getElementById('btnSubmit');

        senhaInput.addEventListener('input', function() {
            var senha = senhaInput.value;

            // Expressão regular para validar senha
            var regex = /^(?=.*[A-Z])(?=(?:.*[0-9]){3}).{8,}$/;

            // Verifica se a senha atende aos critérios
            if (regex.test(senha)) {
                // A senha é válida
                mensagemSenha.textContent = 'Senha válida';
                mensagemSenha.style.color = "green";
                mensagemSenha.classList.remove('invalida');
                mensagemSenha.classList.add('valida');
                btnSubmit.disabled = false; // Habilita o botão
            } else {
                // A senha não atende aos critérios
                mensagemSenha.textContent = 'Senha inválida';
                mensagemSenha.style.color = "red";
                mensagemSenha.classList.remove('valida');
                mensagemSenha.classList.add('invalida');
                btnSubmit.disabled = true;
            }
        });

        senhaConfirmaInput.addEventListener('input', function() {
            var senhaConfirma = senhaConfirmaInput.value;

            if (senhaConfirma != senhaInput.value) {
                mensagemSenhaConfirma.textContent = 'Senhas não estão iguais!'
                mensagemSenhaConfirma.style.color = "red"
                btnSubmit.disabled = true; // Habilita o botão

            } else {
                mensagemSenhaConfirma.textContent = 'Senhas iguais!'
                mensagemSenhaConfirma.style.color = "green"
                btnSubmit.disabled = false; // Habilita o botão
            }
        })
    });
</script>