document.addEventListener("DOMContentLoaded", function () {

    // abre alerta para realizar login para compra
    const elementosFacaLogin = document.querySelectorAll('.faca-login');
    elementosFacaLogin.forEach(function (elemento) {
        elemento.addEventListener('click', function (event) {
            event.preventDefault();
            window.alert('precisa fazer login para adicionar um item no carrinho!')
        });
    });
});

// abre pop-up
function openToast() {
    const toastLiveExample = document.getElementById('open-toast')
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
    toastBootstrap.show();
}

// adiciona produto no carrinho
$(document).on('submit', '#adicionaProdutoCarrinho', function (event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: '/carrinho/adiciona-produto-carrinho',
        data: formData,
        success: function (response) {
            // response = JSON.parse(response);
            openToast();
        }
    })
})

// Icone do password, ocultando e aparecendo senha
document.getElementById("showPassword").addEventListener("click", () => {
    var passwordInput = document.getElementById("password");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
});