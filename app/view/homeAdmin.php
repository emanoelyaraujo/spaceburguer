<?php

$tabFinalizados = '';
$tabACaminho = '';
$tabEntregue = '';
$total = [
    "totalFinalizados" => 0,
    "totalACaminho" => 0,
    "totalEntregues" => 0
];

foreach ($pedidos['pedidos'] as $key => $p)
{
    if ($p["status"] == 'F')
    {
        $total['totalFinalizados'] += 1;
        $tabFinalizados .= Tabela::tbodyPedidos($p, $pedidos['entregadores']);
    }

    if ($p["status"] == 'C')
    {
        $total['totalACaminho'] += 1;
        $tabACaminho .= Tabela::tbodyPedidos($p, $pedidos['entregadores']);
    }

    if ($p["status"] == 'E')
    {
        $total['totalEntregues'] += 1;
        $tabEntregue .= Tabela::tbodyPedidos($p, $pedidos['entregadores']);
    }
}

echo Formulario::exibeMsgError() . Formulario::exibeMsgSucesso();

echo Tabela::tabelaHome($total, $tabFinalizados, $tabACaminho, $tabEntregue);

echo Tabela::modelItensPedido()

?>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Escolha o Motoboy responsável<br>por entregar o pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= SITE_URL ?>HomeAdmin/addMotoboy" method="post">
                    <select class="form-select" name="entregador" required>
                        <option selected disabled></option>
                        <?php foreach ($pedidos['entregadores'] as $entregador) : ?>
                            <option value="<?= $entregador['id'] ?>"><?= $entregador['email'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="idPedido" value="">
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btnRoxo"><i class="fas fa-rocket"></i> Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function modalEntregador(id) {
        $('input[name=idPedido]').val(id)
        var myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"))
        myModal.show()
    }
</script>