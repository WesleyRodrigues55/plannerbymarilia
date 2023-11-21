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
const id_detalhes_pedido = document.getElementById('id-detalhes-pedido')
const input_link = document.getElementById('link-transaction')
const button_copy1 = document.getElementById('button-copy-1')
const button_copy2 = document.getElementById('button-copy-2')

button_copy1.addEventListener("click", (e) => {
    selectedAndCopy(input_link);
})

button_copy2.addEventListener("click", (e) => {
    selectedAndCopy(input_link);
})

const status_compra = setInterval(() => {
    $.ajax({
        url: '/payment/get-payment/' + input_id_transaction.value + '/' + id_detalhes_pedido.value,
        type: 'GET',
        success: function(data) {
            if (data == "pending") {
                console.log(`Status compra: ${data}`)
            } else if (data == "rejected") {
                console.log(`Status compra: ${data}`)
            } else {
                console.log(`Status compra: ${data}`)
                clearInterval(status_compra)
                window.location.href = '/comprando/checkout/success'
            }
        },
        error: function(data, jqXHR, textStatus, errorThrown) {
            // Esta função é chamada em caso de erro
            console.log("Ocorreu um erro na requisição AJAX: " + textStatus);
            console.log("Erro: " + errorThrown);
        }
    });
}, 10000);