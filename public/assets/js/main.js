document.addEventListener("DOMContentLoaded", function() {

    // abre alerta para realizar login para compra
    const elementosFacaLogin = document.querySelectorAll('.faca-login');
    elementosFacaLogin.forEach(function(elemento) {
        elemento.addEventListener('click', function(event) {
            event.preventDefault();
            window.alert('precisa fazer login para adicionar um item no carrinho!')
        });
    });


});