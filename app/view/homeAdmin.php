<?php

$tabFinalizados = '';
$tabACaminho = '';
$tabEntregue = '';
$totalFinalizados = 0;
$totalACaminho = 0;
$totalEntregues = 0;

foreach ($pedidos['pedidos'] as $key => $p)
{
    if ($p["status"] == 'F')
    {
        $totalFinalizados += 1;
        $tabFinalizados .= Lista::tbodyPedidos($p, $pedidos['entregadores']);
    }

    if ($p["status"] == 'C')
    {
        $totalACaminho += 1;
        $tabACaminho .= Lista::tbodyPedidos($p, $pedidos['entregadores']);
    }

    if ($p["status"] == 'E')
    {
        $totalEntregues += 1;
        $tabEntregue .= Lista::tbodyPedidos($p, $pedidos['entregadores']);
    }
}

echo Formulario::exibeMsgError() . Formulario::exibeMsgSucesso() 
?>
<div class="container mt-3 p-3 mb-4">
    <h1 style="color: #433A8F;" class="">Olá, administrador!</h1>
    <h2>Bem-vindo a Home Admin!</h2>
    <nav class="mt-5 mb-4">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                Finalizados <span class="badge bg-danger"><?= $totalFinalizados ?></span>
            </button>
            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
                Á caminho <span class="badge bg-primary"><?= $totalACaminho ?></span>
            </button>
            <button class="nav-link" id="nav-fin-tab" data-bs-toggle="tab" data-bs-target="#nav-fin" type="button" role="tab" aria-controls="nav-fin" aria-selected="false">
                Entregues <span class="badge bg-success"><?= $totalEntregues ?></span>
            </button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-light table-sm tblLista">
                    <?= Lista::theaderPedidos() ?>
                    <tbody>
                        <?= $tabFinalizados ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-light table-sm tblLista">
                    <?= Lista::theaderPedidos() ?>
                    <tbody>
                        <?= $tabACaminho ?>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="tab-pane fade" id="nav-fin" role="tabpanel" aria-labelledby="nav-fin-tab">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-light table-sm tblLista">
                    <?= Lista::theaderPedidos() ?>
                    <tbody>
                        <?= $tabEntregue ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Itens -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
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

<!-- Modal -->
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