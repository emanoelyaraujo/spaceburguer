<?php if (empty($pedido["dadosPedido"])) : ?>
    <div class="d-flex justify-content-center mt-4">
        <div class="container text-center">
            <span><img src="<?= SITE_URL ?>assets/img/SVG/shopping-cart.svg" alt=""></span>
            <h4 class="mt-2">Seu carrinho está vazio</h4>
            <p>Adicione lanches clicando no botão “ADICIONAR AO CARRINHO” na página principal.</p>
            <a href="<?= SITE_URL ?>" class="btn btn-sm btnLaranja mt-3">VOLTAR PARA A PÁGINA INICIAL</a>
        </div>
    </div>
<?php else : ?>
    <div class="container mt-4">
        <!-- <h1 class="h3 mb-3">Meu carrinho</h1> -->
        <div class="row">
            <div class="col-md-7 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Meu carrinho</h5>
                    </div>
                    <div class="card-body h-100">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <?php foreach ($pedido["itensPedido"] as $itens) : ?>
                                    <div class="border text-sm text-muted p-2 mt-1 mb-3">
                                        <div class="row">
                                            <div class="col-5 col-sm-6">
                                                <img src="<?= $itens['imagem'] ?>" class="img-fluid rounded-start" width="142" height="112" alt="...">
                                            </div>
                                            <div class="col-7 col-sm-6 d-flex flex-column">
                                                <h6><?= $itens["descricao"] ?></h6>
                                                <span class="fw-bold" id="totalProduto<?= $itens['id'] ?>">R$<?= $itens["valor_total"] ?></span>

                                                <div class="row justify-content-between mt-auto">
                                                    <div class="col-auto">
                                                        <button data-type="quantity" onclick="decrease(event, <?= $itens['id'] ?>, <?= $itens['idLanche'] ?>)" class="btn btn-sm">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <input id="quantity<?= $itens['id'] ?>" class="text-center" style="width: 30px; border: none; outline: none !important; box-shadow: none !important;" value="1">
                                                        <button data-type="quantity" onclick="increase(event, <?= $itens['id'] ?>, <?= $itens['idLanche'] ?>)" class="btn btn-sm">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button class="btn p-0">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5 col-lg-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Resumo da compra</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Subtotal(<?= count($pedido['itensPedido']) ?>)<span class="float-end text-muted">R$<?= $itens["total_pedido"] ?></span></h6>
                        <h6 class="card-title">Frete<span class="float-end text-muted">R$4,00</span></h6>
                        <hr>
                        <h6 class="card-title">Valor Total<span class="float-end">R$<?= $itens["total_pedido"] ?></span></h6>

                        <div class="d-grid gap-2 col-md-8 mx-auto mt-4">
                            <button class="btn btnRoxo" type="button">CONTINUAR</button>
                            <button class="btn btnLaranja" type="button">ESCOLHER MAIS LANCHES</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

<script>
    function handleSubmit(event, id_produto, quantidade, id_lanche, acao) {
        $.post("/Carrinho/updateQuantidade", {
            id_produto,
            quantidade,
            id_lanche,
            acao
        }).done(function(response) {
            response = JSON.parse(response)
            document.getElementById(`totalProduto${id_produto}`).innerHTML = `R$ ${response.totalProduto}`
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
</script>