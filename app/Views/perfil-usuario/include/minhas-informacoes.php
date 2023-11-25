<?php
$data['link_css'] = "assets/css/perfil.css";
?>
<style>
    /* aqui vai meu conteudo de style */
</style>

<div class="container">
    <h1 class="titulo-perfil">Minhas informações</h1>
    <form id="AlterarUsuarioLogado" method="post">

        <div class="mb-2 p-2 my-2">
            <label for="userPassword" class="form-label " value="Nome completo do usuário"><b>Nome</b></label>
            <input type="text" class="form-control" id="" value="<?=$usuario_selecionado['ID']?>" name="id-pessoa" hidden redonly>
            <input type="text" value="<?=$usuario_selecionado["NOME"]?>" name="nome" class="form-control">
        </div>
        <div class="mb-2 p-2 my-2">
            <label for="userPassword" class="form-label " value="Nome completo do usuário"><b>Sobrenome</b></label>
            <input type="text" value="<?=$usuario_selecionado["SOBRENOME"]?>" name="sobrenome" class="form-control">
        </div>
        <div class="mb-2 p-2 my-2">
            <label for="cpf" class="form-label "><b>CPF</b></label>
            <input type="text" name="" value="<?=$usuario_selecionado["CPF"]?>" id="cpf" class="form-control" disabled>
        </div>
        <div class="mb-2 p-2 my-2">
            <label for="endereço" class="form-label "><b>CEP</b></label>
            <input type="text" name="cep" value="<?=$usuario_selecionado["CEP"]?>" id="cep" class="form-control">
        </div>
        <div class="mb-2 p-2 my-2">
            <label for="endereço" class="form-label "><b>Rua</b></label>
            <input type="text" name="rua" value="<?=$usuario_selecionado["RUA"]?>" id="rua" class="form-control">
        </div>
        <div class="mb-2 p-2 my-2">
            <label for="endereço" class="form-label "><b>Número</b></label>
            <input type="text" name="numero" value="<?=$usuario_selecionado["NUMERO"]?>" id="numero" class="form-control">
        </div>
        <div class="mb-2 p-2 my-2">
            <label for="endereço" class="form-label "><b>Complemento</b></label>
            <input type="text" name="complemento" value="<?=$usuario_selecionado["COMPLEMENTO"]?>" id="complemento" class="form-control">
        </div>
        <div class="mb-2 p-2 my-2">
            <label for="endereço" class="form-label "><b>Bairro</b></label>
            <input type="text" name="bairro" value="<?=$usuario_selecionado["BAIRRO"]?>" id="bairro" class="form-control">
        </div>
        <div class="mb-2 p-2 my-2">
            <label for="endereço" class="form-label "><b>Cidade</b></label>
            <input type="text" name="cidade" value="<?=$usuario_selecionado["CIDADE"]?>" id="cidade" class="form-control">
        </div>
        <div class="mb-2 p-2 my-2">
            <label for="endereço" class="form-label "><b>Estado</b></label>
            <input type="text" name="estado" value="<?=$usuario_selecionado["ESTADO"]?>" id="uf" class="form-control">
        </div>
        <div class="mb-2 p-2 my-2">
            <label for="endereço" class="form-label" id="telefone" name="telefone_01"><b>Telefone</b></label>
            <input type="text" name="telefone_01" value="<?=$usuario_selecionado["TELEFONE_01"]?>" id="telefone" class="form-control">
        </div>

        <div class="mb-2 p-2 my-2">
            <label for="endereço" class="form-label" id="celular" name="celular"><b>Celular</b></label>
            <input type="text" name="celular" value="<?=$usuario_selecionado["CELULAR"]?>" id="celular" class="form-control">
        </div>



        <div class="container mt-3 button-informacoes">
            <button type="submit" class="btn input-rosa" id="">Atualizar</button>
        </div>
    </form>
</div>