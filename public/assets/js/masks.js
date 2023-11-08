$(document).ready(function () {
    $('#cep').on('input', function() {
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
    $("#cep").blur(function () {

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
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

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

    $('#telefone').on('input', function() {
        var valorDigitado = $(this).val();
        var valorFormatado = telefone(valorDigitado);
        $(this).val(valorFormatado);
      });

    $('#dataNascimento').on('input', function() {
        var valorDigitado = $(this).val();
        var valorFormatado = data(valorDigitado);
        $(this).val(valorFormatado);
      });

});

function cep(v){
  v = v.replace(/\D/g,'')
  v = v.replace(/(\d{5})(\d)/,'$1-$2')
  return v
}


function cnpj(v){
    v=v.replace(/\D/g,"")                           //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/,"$1.$2")             //Coloca ponto entre o segundo e o terceiro dígitos
    v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3") //Coloca ponto entre o quinto e o sexto dígitos
    v=v.replace(/\.(\d{3})(\d)/,".$1/$2")           //Coloca uma barra entre o oitavo e o nono dígitos
    v=v.replace(/(\d{4})(\d)/,"$1-$2")              //Coloca um hífen depois do bloco de quatro dígitos
    return v
}

function cpf(v){
    v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
                                             //de novo (para o segundo bloco de números)
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
    return v
}

function telefone(v) {
    v = v.replace(/\D/g, '');
  
    if (v.length !== 11) {
      console.error('Número de telefone inválido. Deve conter 11 dígitos.');
      return v;
    }  
    v = `(${v.substring(0, 2)}) ${v.substring(2, 7)}-${v.substring(7, 11)}`;
  
    return v;
  }

  function data(v) {
    v = v.replace(/\D/g, '');
  
    v = v.replace(/(\d{2})(\d{2})(\d{4})/, '$1/$2/$3');
  
    return v;}