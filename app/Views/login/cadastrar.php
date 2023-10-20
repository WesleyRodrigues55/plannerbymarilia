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

            <form class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-12">
                        <label for="email" class="preencher">E-MAIL*</label>
                        <input type="email" class="form-control" name ="email" id="email" placeholder="email@dominio.com.br">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="password" class="preencher">SENHA*</label>
                        <input type="password" class="form-control" name ="password" id="password" placeholder="Digite sua senha" required>
                        <p>Força da senha: conter maíuscula, numerais e caractere especial</p>
                        <div class="invalid-feedback">
                            Uma senha é requirida.
                        </div>
                    </div>
                
                    <div class="col-md-12">
                        <label for="password" class="preencher">CONFIRMAR SENHA*</label>
                        <input type="password" class="form-control" name ="passwordConfirm" id="password" placeholder="Confirme sua senha" required>
                        <div class="invalid-feedback">
                            Uma senha é requirida.
                        </div>
                    </div>
                </div>
                <!-- ../row -->


                <div class="text-center">
                    <h2 class="h2-titles mt-5"><b>INFORMAÇÕES PESSOAIS</b></h2>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="name" class="preencher">NOME*</label>
                        <input type="text" class="form-control" name ="nome" id="name" placeholder="Digite o seu nome" required>
                        <div class="invalid-feedback">
                            Por favor preencha o seu nome.
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="sobrenome" class="preencher">SOBRENOME*</label>
                        <input type="text" class="form-control" name ="sobrenome" id="sobrenome" placeholder="Digite o seu sobrenome">
                        <div class="invalid-feedback">
                            Por favor preencha o seu sobrenome.
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="telefone" class="preencher">NÚMERO DE TELEFONE*</label>
                        <input type="text" class="form-control" name ="telefone" id="telefone" placeholder="(XX)XXXXX-XXXX">
                        <div class="invalid-feedback">
                            Por favor preencha o seu telefone de contato.
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="cpf" class="preencher">CPF*</label>
                        <input type="text" class="form-control" name ="cpf" id="cpf" placeholder="XXX.XXX.XXX-XX">

                        <div class="content-tipo-pessoa">
                            <div class="d-flex align-items-center gap-2">
                                <input id="pessoaFisica" name="tipoPessoa" type="radio" class="form-check-input" required>
                                <label class="form-check-label" for="pessoaFisica">Pessoa física</label>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <input id="pessoaJuridica" name="tipoPessoa" type="radio" class="form-check-input" required>
                                <label class="form-check-label" for="pessoaJuridica">Pessoa jurídica</label>
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
                        <input type="text" class="form-control" name ="cep" id="cep" placeholder="XXXXX-XXX">
                        <div class="invalid-feedback">
                            Por favor preencha o seu CEP.
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-10">
                        <label for="rua" class="preencher">RUA*</label>
                        <input type="text" class="form-control" name ="rua" id="rua" placeholder="Digite o nome da sua rua">
                        <div class="invalid-feedback">
                            Por favor preencha o seu endereço.
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-2">
                        <label for="numero" class="preencher">Nº*</label>
                        <input type="text" class="form-control" name ="numero" id="numero" placeholder="XX">
                        <div class="invalid-feedback">
                            Por favor preencha o número do seu endereço.
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="complemento" class="preencher">COMPLEMENTO</label>
                        <input type="text" class="form-control" name ="complemento" id="complemento" placeholder="apto, bloco, vila">
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="bairro" class="preencher">BAIRRO</label>
                        <input type="text" class="form-control" name ="bairro" id="bairro" placeholder="Digite o nome do seu bairro">
                    </div>

                    <div class="col-sm-12 col-md-10">
                        <label for="inputCity" class="preencher">CIDADE</label>
                        <input type="text" name="cidade" id="cidade" class="form-control mb-3" id="inputCity" placeholder="Digite o nome da sua cidade">
                    </div>

                    <div class="col-sm-12 col-md-2">
                        <label for="inputState" class="preencher">Estado:</label>
                        <select class="select form-control" name="estado" id="estado" class="form-select">
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
                        <input type="checkbox" class="form-check-input" name ="termos" id="termos">
                        <label class="form-check-label" for="termos" style="display: inline"><i>
                            Ao usar este formulário de cadastro, você concorda com o armazenamento e manuseio de seus dados por esse site.
                        </i></label>
                    </div>
                </div>
                <!-- ../row -->

                <div class="text-center mt-5">
                    <a class="btn input-rosa px-5" href="#">CRIAR CONTA</a></button>
                </div>

                <p class="text-center mt-5"><i>"Ao criar uma conta você está de acordo com a nossa política de privacidade"</i></p>

                <div class="text-center my-5">
                    <a href="<?= base_url("login") ?>" class=""><b>Voltar</b></a>
                

            </form>
        </div>
    </div>
</main>


<?= view("include/footer") ?>

<?= view("include/scripts") ?>