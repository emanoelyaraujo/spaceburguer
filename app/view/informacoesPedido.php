<?= Formulario::exibeMsgError() . Formulario::exibeMsgSucesso() ?>
<section>
    <div class="container mt-3">
        <?php if (empty($pedidos['dadosPedido'])) : ?>
            <div class="d-flex justify-content-center">
                <div class="container text-center">
                    <img src="<?= SITE_URL ?>assets/img/SVG/astro_dormindo.svg" width="250" alt="">
                    <h4>Você ainda não pediu :(</h4>
                    <p>Que tal conhecer os melhores lanches da GALÁXIA?</p>
                    <a href="<?= SITE_URL ?>" class="btn btn-sm btnLaranja mt-3 mb-2">VOLTAR PARA A PÁGINA INICIAL</a>
                </div>
            </div>
        <?php else : ?>
            <?php foreach ($pedidos["dadosPedido"] as $key => $pedido) : ?>
                <div class="card mb-4">
                    <div style="border: 1px solid #eeeeee">
                        <div class="row p-3">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <div class="d-grid col-md-8 mx-auto">
                                    <div class="track">
                                        <div id="finalizado_<?= $pedido['id'] ?>" title="Finalizado" class="step"> <span class="icon"> <i class="fa fa-check"></i> </span></div>
                                        <div id="transporte_<?= $pedido['id'] ?>" title="A caminho" class="step"> <span class="icon"> <i class="fas fa-rocket"></i> </span></div>
                                        <div id="entregue_<?= $pedido['id'] ?>" title="Entregue" id="opa" class="step"> <span class="icon"> <i class="fa fa-home"></i> </span></div>
                                    </div>
                                    <h5 class="text-center text-muted">Status: <?= Helpers::$status[$pedido['status']] ?></h5>
                                    <?php if ($pedido['status'] == 'F') : ?>
                                        <a href="<?= SITE_URL ?>Pedido/cancelarPedido/<?= $pedido['id'] ?>" class="btn btn-outline-secondary btn-sm mt-2 mb-2">Cancelar Pedido</a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-3 col-lg-3">
                                <h6>Resumo da compra</h6>
                                <div>
                                    <div class="mt-2">
                                        <p class="text-dark">Pedido: <strong><?= $pedido['id'] ?></strong></p>
                                        <p class="text-dark">Data do Pedido: <strong><?= Data::dmY($pedido['finished_at']) ?></strong></p>
                                        <p class="text-dark">Taxa de entrega: <strong>R$ <?= Numeros::formataValor($pedido["frete"]) ?></strong></p>
                                        <p class="text-dark">Valor total: <strong>R$ <?= Numeros::formataValor($pedido["valor_total"]) ?></strong></p>
                                        <p class="text-dark">Forma de Pagamento: <?= $pedido['forma_pagamento'] == "C" ? '<i class="far fa-credit-card"></i>' : '<i class="fas fa-dollar-sign"></i>' ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-lg-3 pt-0">
                                <div class="pt-md-4 pt-lg-4 pt-sm-5">
                                    <p class="text-dark"><?= is_null($pedido['rua']) ? "<strong>Retirada</strong>" : "Entrega: <strong>" . $pedido['rua'] . ", " . $pedido['numero'] . "<br>" . $pedido['bairro'] . ", " . $pedido['cep'] . "</strong>" ?></p>
                                    <button type="button" onclick="abreModal(<?= $pedido['id'] ?>)" class="btn btnLaranja mt-2 btn-sm">
                                        Ver itens
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<!-- Modal Itens -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>