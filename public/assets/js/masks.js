$(document).ready(function() {
    $('#cep, #cepEditEndereco').on('input', function() {
        var valorDigitado = $(this).val();
        var valorFormatado = cep(valorDigitado);
        $(this).val(valorFormatado);
    });

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
    }

    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#uf").val(dados.uf);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });

    $('#cpf').on('input', function() {
        var valorDigitado = $(this).val();
        var valorFormatado = cpf(valorDigitado);
        $(this).val(valorFormatado);
    });

    $('#cnpj').on('input', function() {
        var valorDigitado = $(this).val();
        var valorFormatado = cnpj(valorDigitado);
        $(this).val(valorFormatado);
    });

    $('#celular, #celular1').on('input', function() {
        var valorDigitado = $(this).val();
        var valorFormatado = telefoneCelular(valorDigitado);
        $(this).val(valorFormatado);
    });

    $('#telefone, #telefone1').on('input', function() {
        var valorDigitado = $(this).val();
        var valorFormatado = telefoneFixo(valorDigitado);
        $(this).val(valorFormatado);
    });

    $('#dataNascimento, #data-Abertura').on('input', function() {
        var valorDigitado = $(this).val();
        var valorFormatado = formatarEValidarData(valorDigitado);
        $(this).val(valorFormatado);
    });
});

function cep(v) {
    v = v.replace(/\D/g, '')
    v = v.replace(/(\d{5})(\d)/, '$1-$2')
    return v
}


function cnpj(v) {
    v = v.replace(/\D/g, "") //Remove tudo o que não é dígito
    v = v.replace(/^(\d{2})(\d)/, "$1.$2") //Coloca ponto entre o segundo e o terceiro dígitos
    v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3") //Coloca ponto entre o quinto e o sexto dígitos
    v = v.replace(/\.(\d{3})(\d)/, ".$1/$2") //Coloca uma barra entre o oitavo e o nono dígitos
    v = v.replace(/(\d{4})(\d)/, "$1-$2") //Coloca um hífen depois do bloco de quatro dígitos
    return v
}

function cpf(v) {
    v = v.replace(/\D/g, "") //Remove tudo o que não é dígito
    v = v.replace(/(\d{3})(\d)/, "$1.$2") //Coloca um ponto entre o terceiro e o quarto dígitos
    v = v.replace(/(\d{3})(\d)/, "$1.$2") //Coloca um ponto entre o terceiro e o quarto dígitos
        //de novo (para o segundo bloco de números)
    v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
    return v
}

function telefoneCelular(v) {
    v = v.replace(/\D/g, '');

    if (v.length !== 11) {
        console.error('Número de telefone inválido. Deve conter 11 dígitos.');
        return v;
    }
    v = `(${v.substring(0, 2)}) ${v.substring(2, 7)}-${v.substring(7, 11)}`;

    return v;
}

function telefoneFixo(v) {
    v = v.replace(/\D/g, '');

    if (v.length !== 10) {
        console.error('Número de telefone inválido. Deve conter 11 dígitos.');
        return v;
    }
    v = `(${v.substring(0, 2)}) ${v.substring(2, 6)}-${v.substring(6, 10)}`;

    return v;
}

function formatarEValidarData(v) {
    const dataLimpa = v.replace(/\D/g, '');
    const dataFormatada = dataLimpa.replace(/(\d{4})(\d{2})(\d{2})/, '$1-$2-$3');
    return dataFormatada;
}

function validarData(dataString) {
    var partes = dataString.split("-");
    if (partes.length !== 3 || partes[0].length !== 4 || partes[1].length !== 2 || partes[2].length !== 2) {
        return false;
    }

    var data = new Date(dataString);
    return (
        data instanceof Date &&
        !isNaN(data) &&
        data.getFullYear() === parseInt(partes[0], 10) &&
        data.getMonth() + 1 === parseInt(partes[1], 10) &&
        data.getDate() === parseInt(partes[2], 10)
    );
}

// ALTERNANDO TIPO PESSOA

function esconderCPF() {
    var elemento = document.getElementById('divCPF');
    if (elemento) {
        elemento.style.display = 'none';
        document.getElementById('nomePessoa').style.display = 'none';
        document.getElementById('sobrenomePessoa').style.display = 'none';
        document.getElementById('dataNasc').style.display = 'none';
        document.getElementById('name').removeAttribute("required");
        document.getElementById('sobrenome').removeAttribute("required");
        document.getElementById('dataNascimento').removeAttribute("required");
        document.getElementById('name').value = '';
        document.getElementById('sobrenome').value = '';
        document.getElementById('dataNascimento').value = '';
        document.getElementById('cpf').value = '';
    } else {
        console.error('Elemento divCPF não encontrado.');
    }
}


function esconderCNPJ() {
    var elemento = document.getElementById('divCNPJ');
    if (elemento) {
        elemento.style.display = 'none';
        document.getElementById('nomeEmpresa').style.display = 'none';
        document.getElementById('fantasia').style.display = 'none';
        document.getElementById('dataAbertura').style.display = 'none';
        document.getElementById('razaoSocial').removeAttribute("required");
        document.getElementById('nomeFantasia').removeAttribute("required");
        document.getElementById('data-Abertura').removeAttribute("required");
        document.getElementById('razaoSocial').value = '';
        document.getElementById('nomeFantasia').value = '';
        document.getElementById('data-Abertura').value = '';
        document.getElementById('cnpj').value = '';


    } else {
        console.error('Elemento divCNPJ não encontrado.');
    }
}

function mostrarCPF() {
    var elemento = document.getElementById('divCPF');
    if (elemento) {
        elemento.style.display = 'block';
        document.getElementById('nomePessoa').style.display = 'block';
        document.getElementById('sobrenomePessoa').style.display = 'block';
        document.getElementById('dataNasc').style.display = 'block';
        document.getElementById('name').setAttribute("required", "true");
        document.getElementById('sobrenome').setAttribute("required", "true");
        document.getElementById('dataNascimento').setAttribute("required", "true");
    } else {
        console.error('Elemento divCPF não encontrado.');
    }
}

function mostrarCNPJ() {
    var elemento = document.getElementById('divCNPJ');
    if (elemento) {
        elemento.style.display = 'block';
        document.getElementById('divCNPJ').style.display = 'block';
        document.getElementById('nomeEmpresa').style.display = 'block';
        document.getElementById('fantasia').style.display = 'block';
        document.getElementById('dataAbertura').style.display = 'block';
        document.getElementById('razaoSocial').setAttribute("required", "true");
        document.getElementById('nomeFantasia').setAttribute("required", "true");
        document.getElementById('data-Abertura').setAttribute("required", "true")
    } else {
        console.error('Elemento divCNPJ não encontrado.');
    }
}

$(document).ready(function() {
    esconderCNPJ();
    mostrarCPF();
})