<?php
$data['title'] = "Cadastro Usuário";
$data['link_css'] = "assets/css/cadastro-user.css";
?>

<?= view("include/head", $data) ?>
<?= view("include/nav") ?>


<main>
    <div class="container">
        <div class="cadastro my-5">
            <div class="text-center">
                <h2 class="h2-titles mt-5"><b>INFORMAÇÕES DE ACESSO</b></h2>
            </div>

            <?php $message_success = session()->getFlashdata('success-register'); ?>
            <?php $message_failed_cpf = session()->getFlashdata('cpf-exists'); ?>
            <?php $message_failed_email = session()->getFlashdata('email-exists'); ?>
            <?php $message_failed = session()->getFlashdata('failed-register'); ?>
            <?php if ($message_failed): ?>
                <div class="alert alert-danger mt-5 text-center" role="alert">
                    <?php $message_failed; ?>

                </div>
            <?php endif; ?>


            <?php if ($message_success): ?>
                <div class="alert alert-success mt-5 text-center" role="alert">
                    <?= $message_success; ?>
                </div>
            <?php endif; ?>

            <?php if ($message_failed_cpf): ?>
                <div class="alert alert-danger mt-5 text-center" role="alert">
                    <?= $message_failed_cpf; ?>
                </div>
            <?php endif; ?>
            <?php if ($message_failed_email): ?>
                <div class="alert alert-danger mt-5 text-center" role="alert">
                    <?= $message_failed_email; ?>
                </div>
            <?php endif; ?>
            <form onsubmit="senhaOk();" action="<?= base_url('user/cadastroUsuario') ?>" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <label for="email" class="preencher">E-MAIL*</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="email@dominio.com.br" required>
                    </div>

                    <div class="col-md-12">
                        <label for="password" class="preencher">SENHA*</label>
                        <input type="password" class="form-control" id="" name="senha"
                            placeholder="Digite sua senha" required>
                        <p>Força da senha: conter maíuscula, numerais e caractere especial</p>

                    </div>

                    <div class="col-md-12">
                        <label for="password" class="preencher">CONFIRMAR SENHA*</label>
                        <input type="password" class="form-control" id="confirma" name="confirmarSenha"
                            placeholder="Confirme sua senha" required onchange="confereSenha();">
                        <div class="invalid-feedback" id="message">
                            <span>Senhas não conferem</span>.
                        </div>
                    </div>
                </div>
                <!-- ../row -->


                <div class="text-center">
                    <h2 class="h2-titles mt-5"><b>INFORMAÇÕES PESSOAIS</b></h2>
                </div>

                <div class="row">
                    <div class="col-md-12" id="nomePessoa">
                        <label for="name" class="preencher">NOME*</label>
                        <input type="text" class="form-control" id="name" name="nome" placeholder="Digite o seu nome"
                            required>
                        <div class="invalid-feedback">
                            Por favor preencha o seu nome.
                        </div>
                    </div>
                    <div class="col-md-12" id="nomeEmpresa">
                        <label for="razaoSocial" class="preencher">RAZÃO SOCIAL*</label>
                        <input type="text" class="form-control" id="razaoSocial" name="razaoSocial"
                            placeholder="Digite a razão social" required>
                        <div class="invalid-feedback">
                            Por favor preencha a razão social.
                        </div>
                    </div>

                    <div class="col-md-12" id="sobrenomePessoa">
                        <label for="sobrenome" class="preencher">SOBRENOME*</label>
                        <input type="text" class="form-control" id="sobrenome" name="sobrenome" required
                            placeholder="Digite o seu sobrenome">
                        <div class="invalid-feedback">
                            Por favor preencha o seu sobrenome.
                        </div>
                    </div>
                    <div class="col-md-12" id="fantasia">
                        <label for="nomeFantasia" class="preencher">NOME FANTASIA*</label>
                        <input type="text" class="form-control" id="nomeFantasia" name="nomeFantasia"
                            placeholder="Digite o nome fantasia">
                        <div class="invalid-feedback">
                            Por favor preencha o nome fantasia.
                        </div>
                    </div>
                    <!-- ADICIONADO - FORMATAR CONFORME NECESSIDADE -->
                    <div class="col-md-12" id="dataNasc">
                        <label for="sobrenome" class="preencher">DATA NASCIMENTO*</label>
                        <input maxlength="10" type="text" class="form-control" id="dataNascimento" name="dataNascimento"
                            required placeholder="xxxx/xx/xx">
                        <div class="invalid-feedback">
                            Por favor preencha o seu sobrenome.
                        </div>
                    </div>
                    <div class="col-md-12" id="dataAbertura">
                        <label for="dataAbertura" class="preencher">DATA ABERTURA*</label>
                        <input maxlength="10" type="text" class="form-control" id="data-Abertura" name="dataAbertura"
                            placeholder="xxxx/xx/xx">
                        <div class="invalid-feedback">
                            Por favor preencha a data de abertura.
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="telefone" class="preencher">TELEFONE</label>
                        <input maxlength="10" type="text" class="form-control" id="telefone" name="telefone_01"
                            placeholder="(XX)XXXX-XXXX">
                        <div class="invalid-feedback">
                            Por favor preencha o seu telefone de contato.
                        </div>
                    </div>
                    <!-- ADICIONADO, FORMATAR CONFORME NECESSIDADE -->
                    <div class="col-md-12">
                        <label for="telefone" class="preencher">NÚMERO DE CELULAR*</label>
                        <input maxlength="11" type="text" class="form-control" id="celular" name="celular"
                            placeholder="(XX)XXXXX-XXXX" required>
                        <div class="invalid-feedback">
                            Por favor preencha o seu telefone de contato.
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div id="divCPF">
                            <label for="cpf" class="preencher">CPF*</label>
                            <input type="text" class="form-control" id="cpf" name="CPF" maxlength="14"
                                placeholder="XXX.XXX.XXX-XX" required>
                        </div>

                        <div id="divCNPJ">
                            <label for="cpf" class="preencher">CNPJ*</label>
                            <input type="text" class="form-control" id="cnpj" name="CNPJ" maxlength="18"
                                placeholder="xx.xxx.xxx/xxxx-xx">
                        </div>
                        <div class="content-tipo-pessoa">
                            <div class="d-flex align-items-center gap-2">
                                <input id="pessoaFisica" name="tipoPessoa" type="radio" class="form-check-input"
                                    value="FISICA" required onclick="esconderCNPJ(), mostrarCPF()" checked>
                                <label class="form-check-label" for="FISICA">Pessoa física</label>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <input id="pessoaJuridica" name="tipoPessoa" type="radio" class="form-check-input"
                                    value="JURIDICA" required onclick="esconderCPF(), mostrarCNPJ()">
                                <label class="form-check-label" for="JURIDICA">Pessoa jurídica</label>
                            </div>

                        </div>
                        <div class="invalid-feedback">
                            Por favor preencha o seu CPF.
                        </div>
                    </div>
                </div>
                <!-- ../row -->

                <div class="text-center">
                    <h2 class="h2-titles mt-5"><b>INFORMAÇÕES PARA ENTREGA</b></h2>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="cep" class="preencher">CEP*</label>
                        <input maxlength="9" type="text" class="form-control" id="cep" name="CEP"
                            placeholder="XXXXX-XXX" required>
                        <div class="invalid-feedback">
                            Por favor preencha o seu CEP.
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-10">
                        <label for="rua" class="preencher">RUA*</label>
                        <input type="text" class="form-control" id="rua" name="rua"
                            placeholder="Digite o nome da sua rua" required>
                        <div class="invalid-feedback">
                            Por favor preencha o seu endereço.
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-2">
                        <label for="numero" class="preencher">Nº*</label>
                        <input type="text" class="form-control" id="numero" name="numeroResidencia" placeholder="XX"
                            required>
                        <div class="invalid-feedback">
                            Por favor preencha o número do seu endereço.
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="complemento" class="preencher">COMPLEMENTO</label>
                        <input type="text" class="form-control" id="complemento" name="complemento"
                            placeholder="apto, bloco, vila">
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="bairro" class="preencher">BAIRRO*</label>
                        <input type="text" class="form-control" id="bairro" name="bairro"
                            placeholder="Digite o nome do seu bairro" required>
                    </div>

                    <div class="col-sm-12 col-md-10">
                        <label for="inputCity" class="preencher">CIDADE*</label>
                        <input type="text" name="cidade" id="cidade" class="form-control mb-3"
                            placeholder="Digite o nome da sua cidade">
                    </div>

                    <div class="col-sm-12 col-md-2">
                        <label for="inputState" class="preencher">ESTADO</label>
                        <select class="select form-control" name="estado" id="uf" class="form-select" required>
                            <option selected>Selecione</option>
                            <option value="AC">AC</option>
                            <option value="AL">AL</option>
                            <option value="AP">AP</option>
                            <option value="AM">AM</option>
                            <option value="BA">BA</option>
                            <option value="CE">CE</option>
                            <option value="DF">DF</option>
                            <option value="ES">ES</option>
                            <option value="GO">GO</option>
                            <option value="MA">MA</option>
                            <option value="MT">MT</option>
                            <option value="MS">MS</option>
                            <option value="MG">MG</option>
                            <option value="PA">PA</option>
                            <option value="PB">PB</option>
                            <option value="PR">PR</option>
                            <option value="PE">PE</option>
                            <option value="PI">PI</option>
                            <option value="RJ">RJ</option>
                            <option value="RN">RN</option>
                            <option value="RS">RS</option>
                            <option value="RO">RO</option>
                            <option value="RR">RR</option>
                            <option value="SC">SC</option>
                            <option value="SP">SP</option>
                            <option value="SE">SE</option>
                            <option value="TO">TO</option>
                        </select>
                    </div>

                    <div class="col-md-12 mt-1">
                        <input type="checkbox" class="form-check-input" name="termoPrivacidade" id="termos" checked
                            required>
                        <label class="form-check-label" for="termos" style="display: inline"><i>
                                Ao usar este formulário de cadastro, você concorda com o armazenamento e manuseio de
                                seus dados por esse site.
                            </i></label>
                    </div>
                </div>
                <!-- ../row -->

                <div class="text-center mt-5">
                    <input type="submit" class="input-rosa" value="Criar Conta" id="btnSubmit">
                </div>

                <p class="text-center mt-5"><i>"Ao criar uma conta você está de acordo com a nossa política de
                        privacidade"</i></p>

                <div class="text-center my-5">
                    <a href="<?= base_url("login") ?>" class=""><b>Voltar</b></a>
                </div>



            </form>
        </div>
    </div>
</main>


<?= view("include/footer") ?>

<?= view("include/scripts") ?>