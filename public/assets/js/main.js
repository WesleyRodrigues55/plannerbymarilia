document.addEventListener("DOMContentLoaded", function() {

    // abre alerta para realizar login para compra
    const elementosFacaLogin = document.querySelectorAll('.faca-login');
    elementosFacaLogin.forEach(function(elemento) {
        elemento.addEventListener('click', function(event) {
            event.preventDefault();
            openToast('open-toast-login');
            // window.alert('precisa fazer login para adicionar um item no carrinho!')
        });
    });
});

// abre pop-up
function openToast(el) {
    const toastLiveExample = document.getElementById(el)
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
    toastBootstrap.show();
}

// adiciona produto no carrinho
$(document).on('submit', '#adicionaProdutoCarrinho', function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '/carrinho/adiciona-produto-carrinho',
        data: formData,
        success: function(response) {
            // response = JSON.parse(response);
            openToast('open-toast-cart');
        }
    })
})

// exclui catergoria
$(document).on('submit', '#excluirCategoria', function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '/administrador/desativar-categoria',
        data: formData,
        success: function(response) {
            // response = JSON.parse(response);
            openToast('open-toast-exclusao-categoria');
            window.location.href = "/administrador/lista-categoria"
        }
    })
})

// exclui adicional
$(document).on('submit', '#excluirOpcoesAdicionais', function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '/administrador/desativar-opcoes-adicionais',
        data: formData,
        success: function(response) {
            // response = JSON.parse(response);
            openToast('open-toast-exclusao-opcoes-adicionais');
            window.location.href = "/administrador/lista-opcoes-adicionais"
        }
    })
})

// exclui produto
$(document).on('submit', '#excluirProduto', function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '/administrador/desativar-produto',
        data: formData,
        success: function(response) {
            // response = JSON.parse(response);
            openToast('open-toast-exclusao-produto');
            window.location.href = "/administrador/lista-produto"
        }
    })
})

// exclui usuario
$(document).on('submit', '#excluirUsuario', function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '/administrador/desativar-usuario',
        data: formData,
        success: function(response) {
            // response = JSON.parse(response);
            openToast('open-toast-exclusao-usuario');
            window.location.href = "/administrador/lista-usuario"
        }
    })
})