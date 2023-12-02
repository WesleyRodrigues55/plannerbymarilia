document.addEventListener("DOMContentLoaded", function() {
    preco_final_view = document.getElementById('preco-final-view')
    preco_final = document.getElementById('preco-final')
    valor_original_produto = document.getElementById('preco-produto').value
    soma_conta = Number(valor_original_produto);
    preco_final.value = soma_conta

    // view inicia com o valor do produto
    preco_final_view.innerText = soma_conta

    // capta checkbox opção adicional
    $(document).on('change', '#divisorias', function(event) {
        if (this.checked) {
            soma_conta += Number(this.value)
            preco_final_view.innerText = soma_conta.toFixed(2)
            preco_final.value = soma_conta.toFixed(2)
        } else {
            soma_conta -= Number(this.value)
            preco_final_view.innerText = soma_conta.toFixed(2)
            preco_final.value = soma_conta.toFixed(2)
        }
    })

    $(document).on('change', '#cantoneiras', function(event) {
        if (this.checked) {
            soma_conta += Number(this.value)
            preco_final_view.innerText = soma_conta.toFixed(2)
            preco_final.value = soma_conta.toFixed(2)
        } else {
            soma_conta -= Number(this.value)
            preco_final_view.innerText = soma_conta.toFixed(2)
            preco_final.value = soma_conta.toFixed(2)
        }
    })
})