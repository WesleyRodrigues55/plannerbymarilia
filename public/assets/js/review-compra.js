function openToast(el) {
    const toastLiveExample = document.getElementById(el)
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
    toastBootstrap.show();
}

function selectedAndCopy(el) {
    el.select();
    document.execCommand('copy');
    openToast('open-toast-copy-coadigo');
}

const input_id_transaction = document.getElementById('id-transaction')
const input_link = document.getElementById('link-transaction')
const button_copy1 = document.getElementById('button-copy-1')
const button_copy2 = document.getElementById('button-copy-2')

button_copy1.addEventListener("click", (e) => {
    selectedAndCopy(input_link);
})

button_copy2.addEventListener("click", (e) => {
    selectedAndCopy(input_link);
})


const content_payment = document.getElementById('aguardando-pagamento')
const id_detalhe_pedido = content_payment.getAttribute('data-id-detahes-pedido')
const id_carrinho = content_payment.getAttribute('data-id-carrinho')

$.ajax({
    url: '/comprando/checkout/pagamento/' + id_detalhe_pedido + '/' + id_carrinho,
    type: 'GET',
    success: function(data) {
        console.log(data)
        $('#aguardando-pagamento').html(data);
    },
    error: function(data, jqXHR, textStatus, errorThrown) {
        // Esta função é chamada em caso de erro
        console.log("Ocorreu um erro na requisição AJAX: " + textStatus);
        console.log("Erro: " + errorThrown);
    }
});


const status_compra = setInterval(() => {
    $.ajax({
        url: '/payment/get-payment/' + input_id_transaction.value,
        type: 'GET',
        success: function(data) {

            if (data == "pending") {
                console.log(`Status compra: ${data}`)
            } else {
                console.log(`Status compra: ${data}`)
                clearInterval(status_compra)
                $('#content-paymanet-success').html(data);
            }
        },
        error: function(data, jqXHR, textStatus, errorThrown) {
            // Esta função é chamada em caso de erro
            console.log("Ocorreu um erro na requisição AJAX: " + textStatus);
            console.log("Erro: " + errorThrown);
        }
    });
}, 5000);