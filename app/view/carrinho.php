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
    <?= Formulario::exibeMsgSucesso() . Formulario::exibeMsgError() ?>
    <div class="container mt-4">
        <div class="row">
            <!-- MEU CARRINHO -->
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
                                            <?php if ($itens["ingredientes"] != "<p>-</p>") : ?>
                                                <div class="text-end mt-auto">
                                                    <button class="btn btn-sm p-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#433A8F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <line x1="12" y1="8" x2="12" y2="12"></line>
                                                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                                        </svg>
                                                    </button>
                                                </div>
                                            <?php endif; ?>
                                            <div class="col-5 col-sm-6">
                                                <img src="<?= $itens['imagem'] ?>" class="img-fluid rounded-center" width="142" height="112" alt="...">
                                            </div>
                                            <div class="col-7 col-sm-6 d-flex flex-column">
                                                <h6><?= $itens["descricao"] ?></h6>
                                                <span class="fw-bold" id="totalProduto<?= $itens['id'] ?>">R$<?= Numeros::formataValor($itens["valor_total"]) ?></span>
                                                <div class="row justify-content-between mt-auto">
                                                    <div class="col-auto">
                                                        <button data-type="quantity" onclick="decrease(event, <?= $itens['id'] ?>, <?= $itens['idLanche'] ?>)" class="btn btn-sm quantidade">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <input id="quantity<?= $itens['id'] ?>" class="text-center inputQuantidade" value="<?= $itens["quantidade"] ?>">
                                                        <button data-type="quantity" onclick="increase(event, <?= $itens['id'] ?>, <?= $itens['idLanche'] ?>)" class="btn btn-sm quantidade">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="<?= SITE_URL ?>Carrinho/deleteItem/<?= $itens['id'] ?>" class="btn p-0">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                            </svg>
                                                        </a>
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

            <!-- RESUMO DA COMPRA -->
            <div class="col-md-5 col-lg-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Resumo da compra</h5>
                    </div>
                    <div class="card-body">
                        <!-- SUBTOTAL -->
                        <h6 class="card-title d-inline text-muted">Subtotal(<?= count($pedido['itensPedido']) ?> itens)</h6>
                        <span class="float-end text-muted" id="subtotal">R$<?= Numeros::formataValor($pedido['itensPedido'][0]["subtotal"]) ?></span><br>
                        <!-- FRETE -->
                        <h6 class="card-title d-inline text-muted">Taxa de entrega</h6>
                        <span class="float-end text-muted">R$<?= Numeros::formataValor($pedido['itensPedido'][0]['frete']) ?></span>
                        <hr>
                        <!-- TOTAL -->
                        <h6 class="card-title d-inline">Valor Total</h6>
                        <span class="float-end fw-bold" id="total">R$<?= Numeros::formataValor($pedido['itensPedido'][0]["total_pedido"]) ?></span>

                        <div class="d-grid gap-2 col-md-8 mx-auto mt-4">
                            <a href="<?= SITE_URL ?>Carrinho/pagamento" class="btn btnRoxo" type="button">CONTINUAR</a>
                            <a href="<?= SITE_URL ?>" class="btn btnLaranja" type="button">ESCOLHER MAIS LANCHES</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL INGREDIENTES -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ingredientes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= $itens["ingredientes"] ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>