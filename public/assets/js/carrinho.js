// solicitação para trazer view na tela
$.ajax({
    url: '/carrinho/load-content-carrinho',
    type: 'GET',
    success: function(data) {
        $('#content-carrinho').html(data);
    },
    error: function(data, jqXHR, textStatus, errorThrown) {
        // Esta função é chamada em caso de erro
        console.log("Ocorreu um erro na requisição AJAX: " + textStatus);
        console.log("Erro: " + errorThrown);
    }
});

function loadCarrinho() {
    $.ajax({
        url: '/carrinho/load-content-carrinho',
        type: 'GET',
        success: function(data) {
            $('#content-carrinho').html(data);

        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Esta função é chamada em caso de erro
            console.log("Ocorreu um erro na requisição AJAX: " + textStatus);
            console.log("Erro: " + errorThrown);
        }
    });
}

$(document).on('submit', '#subtraiQuantidadeCarrinho', function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '/carrinho/subtrai-quantidade',
        data: formData,
        success: function(response) {
            loadCarrinho();
        }
    });
});

$(document).on('submit', '#somaQuantidadeCarrinho', function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '/carrinho/soma-quantidade',
        data: formData,
        success: function(response) {
            // console.log(response);
            loadCarrinho();
        }
    });
});