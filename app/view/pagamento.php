<?= Formulario::exibeMsgError() . Formulario::exibeMsgSucesso() ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-7 col-lg-6 mb-4">
            <div class="card mb-3 p-3">
                <div class="tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link tabPagamento <?= $pedido['dadosPedido']['frete'] != "0.00" ? 'active' : '' ?>" 
                                href="#tabDelivery" data-bs-toggle="tab" role="tab" aria-selected="false"
                            >
                                <i class="fas fa-motorcycle"></i>
                                Delivery
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tabPagamento <?= $pedido['dadosPedido']['frete'] == "0.00" ?
                                'active' : '' ?>" href="#tabRetirada" data-bs-toggle="tab" role="tab" aria-selected="false">
                                <i class="fas fa-walking"></i>
                                Retirada
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane <?= $pedido['dadosPedido']['frete'] != "0.00" ? 'active' : '' ?>" 
                            id="tabDelivery" role="tabpanel"
                        >
                            <div class="d-flex flex-column mt-2 ms-2">
                                <div class="row justify-content-between mt-auto">
                                    <div class="col-auto">
                                        <i class="fas fa-map-marked-alt"></i>
                                        <span id="informacoesPedido">
                                            <?= (!is_null($pedido["dadosPedido"]["id_endereco"]) ?
                                                $pedido['dadosPedido']['rua'] . " ," .
                                                $pedido['dadosPedido']['numero'] . "<br>" .
                                                $pedido['dadosPedido']['bairro'] . " ," .
                                                $pedido['dadosPedido']['cep'] : "") 
                                            ?>
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <button class="text-end btn btn-sm fw-bold text-decoration-underline" onclick="chamaModal()">Escolher</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane <?= $pedido['dadosPedido']['frete'] == "0.00" ? 'active' : '' ?>" id="tabRetirada" role="tabpanel">
                            <div class="mt-2 ms-2">
                                <i class="fas fa-map-marked-alt"></i> 
                                Praça Irmã Annina Bisegna, 40
                                <br>Centro, Muriaé - MG, 36880-083
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="mt-3 mb-2" id="labelPagamento" for="pagamento">Pague na entrega</label>
                        <select class="form-select" id="pagamento" name="pagamento" aria-label="Default select example">
                            <option value="D" <?= ($pedido["dadosPedido"]["forma_pagamento"] == "D" ? "selected" : "") ?>>
                                Dinheiro
                            </option>
                            <option value="C" <?= ($pedido["dadosPedido"]["forma_pagamento"] == "C" ? "selected" : "") ?>>
                                Cartão
                            </option>
                        </select>
                    </div>
                    <div class="col-6 mt-4" id="divDadosCartao">
                        <p class="" id="dadosCartao">
                            <?= (isset($pedido["dadosPedido"]["nomeCartao"]) ?
                                $pedido['dadosPedido']['nomeCartao'] . "<br>" .
                                "**** **** **** " . substr($pedido['dadosPedido']['numeroCartao'], 12, 16) . "<br>" : "") 
                            ?>
                        </p>
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
                    <table class="table  table-sm">
                        <thead class="table-active">
                            <th>Itens do Pedido</th>
                            <th>Qtde</th>
                            <th>Preço</th>
                        </thead>
                        <tbody>
                            <?php foreach ($pedido["itensPedido"] as $itens) : ?>
                                <tr>
                                    <td><?= $itens["descricao"] ?></td>
                                    <td><?= $itens["quantidade"] ?></td>
                                    <td class="text-end">
                                        <?= Numeros::formataValor($itens["valor_total"]) ?>
                                    </td>
                                <?php endforeach; ?>
                                </tr>
                        </tbody>
                    </table>

                    <!-- SUBTOTAL -->
                    <h6 class="card-title d-inline text-muted" class="invisible">
                        Subtotal(<?= count($pedido['itensPedido']) ?> itens)
                    </h6>
                    <span class="float-end text-muted" id="subtotal">
                        R$ <?= Numeros::formataValor($pedido['itensPedido'][0]["subtotal"]) ?>
                    </span>
                    <br>
                    <!-- FRETE -->
                    <h6 class="card-title d-inline text-muted">
                        Taxa de entrega
                    </h6>
                    <span class="float-end text-muted" id="frete">
                        R$ <?= Numeros::formataValor($pedido['itensPedido'][0]['frete']) ?>
                    </span>
                    <hr>
                    <!-- TOTAL -->
                    <h6 class="card-title d-inline">Valor Total</h6>
                    <span class="float-end fw-bold" id="total">
                        R$ <?= Numeros::formataValor($pedido['itensPedido'][0]["total_pedido"]) ?>
                    </span>
                    <div class="d-grid gap-2 col-md-8 mx-auto mt-4">
                        <a href="<?= SITE_URL ?>Pagamento/finalizarPedido" class="btn btnRoxo" type="button">Finalizar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal" id="modalEndereco" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Escolha seu Endereço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center mb-3">
                    <button class="btn btnRoxo btn-sm" onclick="chamaView('#v-pills-endereco')">Adicionar endereço</button>
                </div>
                <div class="card-group">
                    <?php
                    if (!empty($pedido["enderecosUser"]))
                    {
                        foreach ($pedido["enderecosUser"] as $endereco)
                        {
                            ?>
                            <div class="p-1">
                                <div class="card" style="width: 16rem;">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-start">
                                            <div class="custom-control custom-checkbox">
                                                <input class="form-check-input" type="radio" 
                                                    id="endereco<?= $endereco['id'] ?>" name="endereco" 
                                                    value="<?= $endereco['id'] ?>"
                                                >
                                            </div>
                                            <h5 class="card-title d-inline ms-2">
                                                <?= $endereco['nomeEndereco'] ?>
                                            </h5>
                                        </div>
                                        <p class="">
                                            <?= $endereco['rua'] . ", " . $endereco['numero'] . 
                                                '<br>' . $endereco['bairro'] . ", " . $endereco['cep'] 
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btnLaranja" data-bs-dismiss="modal">Sair</button>
                <button type="button" onclick="addEndereco()" class="btn btnRoxo">Salvar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modalCartao" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Escolha seu Cartão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center mb-2">
                    <button class="btn btnRoxo btn-sm" onclick="chamaView('#v-pills-cartao')">Adicionar cartão</button>
                </div>
            </div>
            <div class="card-group">
                <?php
                if (!empty($pedido["cartoesUser"]))
                {
                    foreach ($pedido["cartoesUser"] as $cartao)
                    {
                        ?>
                        <div class="p-1">
                            <div class="card" style="width: 16rem;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-start">
                                        <div class="custom-control custom-checkbox">
                                            <input class="form-check-input" type="radio" id="cartao<?= $cartao['id'] ?>" 
                                                name="cartao" value="<?= $cartao['id'] ?>"
                                            >
                                        </div>
                                        <h5 class="card-title d-inline ms-2"><?= $cartao['nome'] ?></h5>
                                    </div>
                                    <p class="">**** **** **** 
                                        <?= substr($cartao['numero'], 12, 16) . '<br>' . 
                                            ($cartao['tipo'] == "D" ? "Débito" : "Crédito") 
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btnLaranja" data-bs-dismiss="modal">Sair</button>
                <button type="button" onclick="addCartao()" class="btn btnRoxo">Salvar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function chamaView(id) {
        $.post("/MinhaConta/setPill", {
            id: id
        });

        window.location = "<?= SITE_URL ?>MinhaConta/index"
    }
</script>