<?php
    $data['title'] = "Cadastro Usuário";
    $data['link_css'] = "assets/css/cadastro-user.css";
?>

<?= view("include/head", $data) ?>
    
    <?= view("include/nav") ?>
    
    <main>
        <div class="container">
            <div class="py-5 text-center">
                <h2 class="h2-titles"><b>INFORMAÇÕES DE ACESSO</b></h2>
            </div>

            
            <div class="col-md-7 col-lg-8">
                <form class="needs-validation" novalidate>
                <div class="row g-3">

                    <div class="col-12">
                    <label for="email" class="form-label">E-MAIL*</label>
                    <input type="email" class="form-control" id="email" placeholder="">
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                    </div>

                    <div class="col-12">
                    <label for="password" class="form-label">SENHA*</label>
                    <input type="password" class="form-control" id="password" placeholder="" required>
                    <p>Força da senha: conter maíuscula, numerais e caractere especial</p>
                    <div class="invalid-feedback">
                        Uma senha é requirida.
                        </div>
                    </div>
                    </div>

                    <div class="col-12">
                    <label for="password" class="form-label">CONFIRMAR SENHA*</label>
                    <input type="password" class="form-control" id="password" placeholder="" required>
                    <div class="invalid-feedback">
                        Uma senha é requirida.
                        </div>
                    </div>
                    </div>

                    <div class="py-5 text-center">
                    <h2 class="h2-titles"><b>INFORMAÇÕES PESSOAIS</b></h2>
                    </div>

                    <div class="col-12">
                    <label for="name" class="form-label">NOME*</label>
                    <input type="text" class="form-control" id="name" placeholder="" required>
                    <div class="invalid-feedback">
                        Por favor preencha o seu nome.
                    </div>
                    </div>

                    <div class="col-12">
                    <label for="sobrenome" class="form-label">SOBRENOME*</label>
                    <input type="text" class="form-control" id="sobrenome" placeholder="">
                    <div class="invalid-feedback">
                        Por favor preencha o seu sobrenome.
                    </div>
                    </div>

                    <div class="col-12">
                    <label for="telefone" class="form-label">NÚMERO DE TELEFONE*</label>
                    <input type="text" class="form-control" id="telefone" placeholder="">
                    <div class="invalid-feedback">
                        Por favor preencha o seu telefone de contato.
                    </div>
                    </div>

                    <div class="col-12">
                    <label for="cpf" class="form-label">CPF*</label>
                    <input type="text" class="form-control" id="cpf" placeholder="">
                    <div class="form-check">
                        <input id="pessoaFisica" name="pessoaFisica" type="radio" class="form-check-input"  required>
                        <label class="form-check-label" for="pessoaFisica">Pessoa física</label>
                    </div>
                    <div class="form-check">
                        <input id="pessoaJuridica" name="pessoaJuridica" type="radio" class="form-check-input" required>
                        <label class="form-check-label" for="pessoaJuridica">Pessoa jurídica</label>
                    </div>
                    <div class="invalid-feedback">
                        Por favor preencha o seu CPF.
                    </div>
                    </div>

                    <div class="py-5 text-center">
                    <h2 class="h2-titles"><b>INFORMAÇÕES PARA ENTREGA</b></h2>
                    </div>

                    <div class="col-12">
                    <label for="cep" class="form-label">CEP*</label>
                    <input type="text" class="form-control" id="cep" placeholder="">
                    <div class="invalid-feedback">
                        Por favor preencha o seu CEP.
                    </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10">
                        <label for="rua" class="form-label">RUA*</label>
                        <input type="text" class="form-control" id="rua" placeholder="">
                        <div class="invalid-feedback">
                            Por favor preencha o seu endereço.
                        </div>
                        </div>

                        <div class="col-md-2">
                        <label for="numero" class="form-label">Nº*</label>
                        <input type="text" class="form-control" id="numero" placeholder="">
                        <div class="invalid-feedback">
                            Por favor preencha o número do seu endereço.
                        </div>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col">
                        <label for="complemento" class="form-label">COMPLEMENTO</label>
                        <input type="text" class="form-control" id="complemento" placeholder="">
                        </div>
            
                        <div class="col">
                        <label for="bairro" class="form-label">BAIRRO</label>
                        <input type="text" class="form-control" id="bairro" placeholder="">
                        </div>
                    </div> 
                    
                    <div class="row">
                    <div class="col-md-10">
                        <label for="inputCity" class="form-label">Cidade: </label>
                        <input type="text" name="cidade" id="cidade" class="form-control mb-3" id="inputCity">
                    </div>

                    <div class="col-md-2">
                        <label for="inputState" class="form-label">Estado:</label>
                        <select name="estado" id="estado" class="form-select">
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

                <hr class="my-4">

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="termos">
                    <label class="form-check-label" for="termos">Ao usar este formulário de cadastro, você concorda com o armazenamento e manuseio de seus dados por esse site.</label>
                </div>

                <div class="text-center mt-5">
                    <a class="btn input-rosa px-5" href="">ACESSE O INSTAGRAM</a></button>
                </div>
                
                <p>Ao criar uma conta você está de acordo com a nossa política de privacidade</p>

                <div class="text-center mt-5">
                    <a class="btn input-simples px-5" href="">Voltar</a></button>
                </div>
                
                </form>
            </div>
            </div>
    </main>

    <?= view("include/footer") ?>

<?= view("include/scripts") ?>



