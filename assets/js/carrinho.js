function addCarrinho(id) {

    $.post("/Carrinho/addCarrinho", {
        id
    }).done(function (response) {
        response = JSON.parse(response)
        if (response.status) {
            msgSucesso(response.mensagem);
        } else {
            msgError(response.mensagem);
        }
    })
}