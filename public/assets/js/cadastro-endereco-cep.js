$(document).ready(function() {

    $("#rua").attr('readonly', true);
    $("#cidade").attr('readonly', true);
    $("#bairro").attr('readonly', true);
    $("#estado").attr('readonly', true);

    $("#rua").css('background-color', '#ddd');
    $("#cidade").css('background-color', '#ddd');
    $("#bairro").css('background-color', '#ddd');
    $("#estado").css('background-color', '#ddd');

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#cidade").val("");
        $("#bairro").val("");
        $("#estado").val("");
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
                $("#rua").val("");
                $("#cidade").val("");
                $("#bairro").val("");
                $("#estado").val("");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua").val(dados.logradouro);
                        $("#cidade").val(dados.localidade);
                        $("#bairro").val(dados.bairro);
                        $("#estado").val(dados.uf);

                        $("#rua").attr('readonly', false);
                        $("#cidade").attr('readonly', false);
                        $("#bairro").attr('readonly', false);
                        $("#estado").attr('readonly', false);

                        $("#rua").css('background-color', 'transparent');
                        $("#cidade").css('background-color', 'transparent');
                        $("#bairro").css('background-color', 'transparent');
                        $("#estado").css('background-color', 'transparent');
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
});