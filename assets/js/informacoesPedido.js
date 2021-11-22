$.get('/Pedido/getStatusPedido').done((response) => {
    response = JSON.parse(response)
    $.each(response.pedido, function (key, value) {
        if (value.status == "F") {
            $(`#finalizado_${value.id}`).addClass("active")
        }
        if (value.status == "C") {
            $(`#finalizado_${value.id}`).addClass("active")
            $(`#transporte_${value.id}`).addClass("active")
        }
        if (value.status == "E") {
            $(`#finalizado_${value.id}`).addClass("active")
            $(`#transporte_${value.id}`).addClass("active")
            $(`#entregue_${value.id}`).addClass("active")
        }
    });
})

function abreModal(id, idEndereco) {
    var html = '';
    $.post('/Pedido/getItens', {
        id,
        idEndereco
    }).done((response) => {
        response = JSON.parse(response)
        if (typeof idEndereco != 'undefined') {
            html += `
                <div class="card col-12">
                    <div class="card-body">
                        <h5 class="card-title d-inline">Endereço de entrega</h5>
                        <p class="">
                            ${response.endereco[0].rua}, ${response.endereco[0].numero}
                            <br>${response.endereco[0].bairro}, ${response.endereco[0].cep}
                            <br>${response.endereco[0].complemento}
                        </p>
                    </div>
                </div>
            `;
        }
        $.each(response.itens, function (key, value) {

            if (value.idLanche == null) {
                conteudo = `
                    <h6 class="text-danger text-center">Produto excluído do cardápio</h6>
                    <div class="col-7 col-sm-6 mt-3">
                        <p>Valor Total: <strong>R$ ${value.valor_total.replace('.', ',')}</strong></p>
                        <p>Quantidade: <strong>${value.quantidade}</strong></p>
                    </div>
                `;
            }
            else {
                conteudo = `
                    <div class="col-5 col-sm-6">
                        <img src="${value.imagem}" class="img-fluid rounded-center" width="142" height="112" alt="...">
                    </div>
                    <div class="col-7 col-sm-6 mt-3">
                        <h6>${value.descricao}</h6>
                        <p>Valor Total: <strong>R$ ${value.valor_total.replace('.', ',')}</strong></p>
                        <p>Quantidade: <strong>${value.quantidade}</strong></p>
                    </div>
                `;
            }
            html += `
                <div class='card p-4 mt-2'>
                    <div class="row">
                        ${conteudo}
                    </div>
                </div>
            `;
            $(".modal-title").html(`Itens do Pedido ${value.id}`)
        });
        var myModal = new bootstrap.Modal(document.getElementById("modalItensPedido"))
        $(".modal-body").html(html)
        myModal.show()
    })
}