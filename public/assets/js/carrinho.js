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


// abre pop-up
function openToast() {
    const toastLiveExample = document.getElementById('open-toast')
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
    toastBootstrap.show();
}

// remove item do carrinho
$(document).on('submit', '#removeItemCarrinho', function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '/carrinho/remove-item-carrinho',
        data: formData,
        success: function(response) {
            response = JSON.parse(response);
            loadCarrinho();
            openToast();
        }
    });
});

//subtrai quantidade no carrinho
$(document).on('submit', '#subtraiQuantidadeCarrinho', function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '/carrinho/subtrai-quantidade',
        data: formData,
        success: function(response) {
            response = JSON.parse(response);
            loadCarrinho();
        }
    });
});


// soma quantidade no carrinho
$(document).on('submit', '#somaQuantidadeCarrinho', function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '/carrinho/soma-quantidade',
        data: formData,
        success: function(response) {
            response = JSON.parse(response);
            loadCarrinho();
        }
    });
});

// recarrega carrinho com os dados sem o "load" no navegador
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

$(document).on('DOMContentLoaded', function(event) {
    setInterval(() => {
        loadCarrinho();
    }, 10000);
})