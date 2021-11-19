let deliverySelecionado = true

$(".tabPagamento").on("click", function () {
    if (deliverySelecionado && $("a[href='#tabDelivery']").hasClass("active")) {
        return
    }

    if ($(this).attr('href') == "#tabRetirada") {
        acao = "-"
        $("#labelPagamento").html("Pague na retirada")
        $("#informacoesPedido").html("")
        $("#dadosCartao").html("")
        $.get(`/Pagamento/removeEnderecoCartao`)
    } else {
        acao = "+"
        $("#labelPagamento").html("Pague na entrega")
    }

    $.post("/Pagamento/frete", {
        acao
    }).done(function (response) {
        response = JSON.parse(response)
        document.getElementById('frete').innerHTML = `R$ ${response.frete.replace('.', ',')}`
        document.getElementById('total').innerHTML = `R$ ${response.total.replace('.', ',')}`
    });

    if (!deliverySelecionado && $("a[href='#tabDelivery']").hasClass("active")) {
        deliverySelecionado = true
    } else {
        deliverySelecionado = false
    }
});

function chamaModal() {
    var myModal = new bootstrap.Modal(document.getElementById('modalEndereco'))
    myModal.show()
}

function addEndereco() {

    $('#modalEndereco').modal('hide');

    idEndereco = $("input[name=endereco]:checked").val()

    $.post("/Pagamento/addEndereco", {
        idEndereco
    }).done(function (response) {
        response = JSON.parse(response)
        document.getElementById('informacoesPedido').innerHTML = ` ${response.rua}, ${response.numero}<br>${response.bairro}, ${response.cep}`
    });
}

function addCartao() {

    $('#modalCartao').modal('hide');

    idCartao = $("input[name=cartao]:checked").val()

    $.post("/Pagamento/addCartao", {
        idCartao
    }).done(function (response) {
        response = JSON.parse(response)
        document.getElementById('dadosCartao').innerHTML = ` ${response.nomeCartao}<br>${response.numero}`
    });
}

$("#pagamento").on('change', function () {

    metodo = $("#pagamento").val()
    $.post("/Pagamento/metodoPag", {
        metodo
    });

    if ($("#pagamento").val() == "C" && $("a[href='#tabDelivery']").hasClass("active")) {

        var myModal = new bootstrap.Modal(document.getElementById('modalCartao'))
        myModal.show()
    }
})
