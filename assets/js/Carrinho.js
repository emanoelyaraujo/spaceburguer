function handleSubmit(event, id_produto, quantidade, id_lanche, acao) {
    $.post("/Carrinho/updateQuantidade", {
        id_produto,
        quantidade,
        id_lanche,
        acao
    }).done(function(response) {
        response = JSON.parse(response)
        document.getElementById(`totalProduto${id_produto}`).innerHTML = `R$ ${response.totalProduto}`
        document.getElementById('subtotal').innerHTML = `R$ ${response.subtotal.replace('.', ',')}`
        document.getElementById('total').innerHTML = `R$ ${response.total.replace('.', ',')}`
    })
}

function decrease(event, id_produto, id_lanche) {

    let quantidade = document.getElementById(`quantity${id_produto}`)
    const newValue = parseInt(quantidade.value) - 1

    if (newValue > 0) {
        quantidade.value = newValue

        setTimeout(
            handleSubmit(event, id_produto, quantidade.value, id_lanche, "-"),
            6000
        )
    }
}

function increase(event, id_produto, id_lanche) {
    let quantidade = document.getElementById(`quantity${id_produto}`)
    quantidade.value = parseInt(quantidade.value) + 1

    setTimeout(
        handleSubmit(event, id_produto, quantidade.value, id_lanche, "+"),
        6000
    )
}