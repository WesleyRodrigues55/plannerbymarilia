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

    $('#dataNascimento').on('input', function() {
        var valorDigitado = $(this).val();
        var valorFormatado = formatarEValidarData(valorDigitado);
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

  //VALIDAR DATA

  function formatarEValidarData(v) {
    const dataLimpa = v.replace(/\D/g, '');  
    const dataFormatada = dataLimpa.replace(/(\d{4})(\d{2})(\d{2})/, '$1-$2-$3');  
    // if (validarData(dataFormatada)) {
    //   return dataFormatada;
    // } else {
      //   console.error('Data inválida:', v);
      //   return null;
      // }
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
      document.getElementById('divCPF').style.display = 'none';
  }

  function esconderCNPJ() {
      document.getElementById('divCNPJ').style.display = 'none';
  }

  function mostrarCPF() {
      document.getElementById('divCPF').style.display = 'block';
  }

  function mostrarCNPJ() {
      document.getElementById('divCNPJ').style.display = 'block';
  }

  $(document).ready(function () {
    esconderCNPJ();
    mostrarCPF();
  })

    
  