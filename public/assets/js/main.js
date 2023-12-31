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

    const facaLoginDepoimentos = document.getElementById('faca-login');
    if (facaLoginDepoimentos) {
        facaLoginDepoimentos.addEventListener('click', function(event) {
            event.preventDefault();
            openToast('open-toast-login-depoimentos');
            // window.alert('precisa fazer login para adicionar um item no carrinho!')
        });
    }


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

// exclui capa produto
$(document).on('submit', '#excluirCapaProduto', function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '/administrador/desativar-capa-produto',
        data: formData,
        success: function(response) {
            response = JSON.parse(response);
            openToast('open-toast-exclusao-capa-produto');
            setTimeout(() => {
                window.location.href = "/administrador/lista-capas-produto/" + response.id_produto
            }, 5000);
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

// Altera dados usuario logado
$(document).on('submit', '#AlterarUsuarioLogado', function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '/user/alterar-pessoa',
        data: formData,
        success: function(response) {
            // response = JSON.parse(response);
            openToast('open-toast-alterar-usuario-logado');
        }
    })
})

// Altera dados usuario logado
$(document).on('submit', '#AlterarSenhaUsuarioLogado', function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '/user/alterar-usuario',
        data: formData,
        success: function(response) {
            console.log(response)
                // response = JSON.parse(response);
            openToast('open-toast-alterar-senha-usuario-logado');
        }
    })
})

// Altera quantidade item estoque
$(document).on('submit', '#AlterarQuantidadeItemEstoque', function(event) {
    event.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
        type: 'POST',
        url: '/administrador/alterar-estoque',
        data: formData,
        success: function(response) {
            // response = JSON.parse(response);
            openToast('open-toast-alterar-quantidade-estoque');
            $('#AlterarQuantidadeItemEstoque').modal('hide');

            // Adiciona um atraso de 2 segundos antes de recarregar a página
            setTimeout(function() {
                location.reload();
            }, 1000);
        }
    })
})

// desativa depoimento do usuário
$(document).on('submit', '#desativarDepoimento', function(event) {
    event.preventDefault();
    var itemTabValue = $("input[name='item-tab']").val();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '/user/desativa-depoimento',
        data: formData,
        success: function(response) {
            // response = JSON.parse(response);
            openToast('open-toast-desativar-depoimento');
            window.location.href = 'perfil-usuario#' + itemTabValue

        }
    })
})