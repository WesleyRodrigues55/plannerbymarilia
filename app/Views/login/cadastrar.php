<?php
    $data['title'] = "Cadastro Usuário";
    $data['link_css'] = "assets/css/cadastro-user.css";
?>

<?= view("include/head", $data) ?>
<?= view("include/nav") ?>


<main>

    <div class="container">
        <div class="cadastro">
            <div class="text-center">
                <h2 class="h2-titles"><b>INFORMAÇÕES DE ACESSO</b></h2>
            </div>

            <form class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-12">
                        <label for="email" class="preencher">E-MAIL*</label>
                        <input type="email" class="form-control" id="email" placeholder="email@dominio.com.br">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="password" class="preencher">SENHA*</label>
                        <input type="password" class="form-control" id="password" placeholder="Digite sua senha" required>
                        <p>Força da senha: conter maíuscula, numerais e caractere especial</p>
                        <div class="invalid-feedback">
                            Uma senha é requirida.
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <label for="password" class="preencher">CONFIRMAR SENHA*</label>
                    <input type="password" class="form-control" id="password" placeholder="Confirme sua senha" required>
                    <div class="invalid-feedback">
                        Uma senha é requirida.
                    </div>
                </div>


                <div class="text-center">
                    <h2 class="h2-titles"><b>INFORMAÇÕES PESSOAIS</b></h2>
                </div>

                <div class="col-md-12">
                    <label for="name" class="preencher">NOME*</label>
                    <input type="text" class="form-control" id="name" placeholder="Digite o seu nome" required>
                    <div class="invalid-feedback">
                        Por favor preencha o seu nome.
                    </div>
                </div>

                <div class="col-12">
                    <label for="sobrenome" class="preencher">SOBRENOME*</label>
                    <input type="text" class="form-control" id="sobrenome" placeholder="Digite o seu sobrenome">
                    <div class="invalid-feedback">
                        Por favor preencha o seu sobrenome.
                    </div>
                </div>

                <div class="col-12">
                    <label for="telefone" class="preencher">NÚMERO DE TELEFONE*</label>
                    <input type="text" class="form-control" id="telefone" placeholder="(XX)XXXXX-XXXX">
                    <div class="invalid-feedback">
                        Por favor preencha o seu telefone de contato.
                    </div>
                </div>

                <div class="col-12">
                    <label for="cpf" class="preencher">CPF*</label>
                    <input type="text" class="form-control" id="cpf" placeholder="XXX.XXX.XXX-XX">

                    <div class="d-flex gap-4">

                        <input id="pessoaFisica" name="tipoPessoa" type="radio" class="form-check-input" required>
                        <label class="form-check-label" for="pessoaFisica">Pessoa física</label>


                        <input id="pessoaJuridica" name="tipoPessoa" type="radio" class="form-check-input" required>
                        <label class="form-check-label" for="pessoaJuridica">Pessoa jurídica</label>
                    </div>
                    <div class="invalid-feedback">
                        Por favor preencha o seu CPF.
                    </div>
                </div>

                <div class="text-center">
                    <h2 class="h2-titles"><b>INFORMAÇÕES PARA ENTREGA</b></h2>
                </div>

                <div class="col-12">
                    <label for="cep" class="preencher">CEP*</label>
                    <input type="text" class="form-control" id="cep" placeholder="XXXXX-XXX">
                    <div class="invalid-feedback">
                        Por favor preencha o seu CEP.
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                        <label for="rua" class="preencher">RUA*</label>
                        <input type="text" class="form-control" id="rua" placeholder="Digite o nome da sua rua">
                        <div class="invalid-feedback">
                            Por favor preencha o seu endereço.
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="numero" class="preencher">Nº*</label>
                        <input type="text" class="form-control" id="numero" placeholder="XX">
                        <div class="invalid-feedback">
                            Por favor preencha o número do seu endereço.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="complemento" class="preencher">COMPLEMENTO</label>
                        <input type="text" class="form-control" id="complemento" placeholder="apto, bloco, vila">
                    </div>

                    <div class="col">
                        <label for="bairro" class="preencher">BAIRRO</label>
                        <input type="text" class="form-control" id="bairro" placeholder="Digite o nome do seu bairro">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                        <label for="inputCity" class="preencher">Cidade: </label>
                        <input type="text" name="cidade" id="cidade" class="form-control mb-3" id="inputCity" placeholder="Digite o nome da sua cidade">
                    </div>

                    <div class="col-md-2">
                        <label for="inputState" class="preencher">Estado:</label>
                        <select class="select" name="estado" id="estado" class="form-select">
                            <option selected>Selecione</option>
                            <option>AC</option>
                            <option>AL</option>
                            <option>AP</option>
                            <option>AM</option>
                            <option>BA</option>
                            <option>CE</option>
                            <option>DF</option>
                            <option>ES</option>
                            <option>GO</option>
                            <option>MA</option>
                            <option>MT</option>
                            <option>MS</option>
                            <option>MG</option>
                            <option>PA</option>
                            <option>PB</option>
                            <option>PR</option>
                            <option>PE</option>
                            <option>PI</option>
                            <option>RJ</option>
                            <option>RN</option>
                            <option>RS</option>
                            <option>RO</option>
                            <option>RR</option>
                            <option>SC</option>
                            <option>SP</option>
                            <option>SE</option>
                            <option>TO</option>
                        </select>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="termos">
                        <label class="form-check-label" for="termos">Ao usar este formulário de cadastro, você concorda
                            com
                            o
                            armazenamento e manuseio de seus dados por esse site.</label>
                    </div>

                    <div class="text-center mt-5">
                        <a class="btn input-rosa px-5" href="">CRIAR CONTA</a></button>
                    </div>

                    <p1>Ao criar uma conta você está de acordo com a nossa política de privacidade</p1>

                    <div class="text-center mt-5">
                        <a class="link"><b>Voltar</b></a>
                    </div>

            </form>
        </div>
    </div>
</main>


<?= view("include/footer") ?>

<?= view("include/scripts") ?>