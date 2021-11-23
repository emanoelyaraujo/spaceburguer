<?php

class Tabela
{
    /**
     * monta a lista dos cruds do adm
     *
     * @param  string $controller
     * @param  array $thead
     * @param  array $tbody
     * @param  array $id
     * @return void
     */
    public static function montaLista($controller, $thead, $tbody, $id)
    {
        ?>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-light table-sm tblLista">
                    <thead>
                        <tr class="text-weigth-bold">
                            <?php foreach ($thead as $th) : ?>
                                <th><?= $th ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php foreach ($tbody as $key => $row) : ?>
                            <tr>
                                <?php foreach ($row as $col) : ?>
                                    <td><?= $col ?></td>
                                <?php endforeach; ?>
                                <td class="text-center">
                                    <a href="<?= SITE_URL ?>/<?= $controller ?>/form/view/<?= (implode("", $id[$key])) ?>" class="btn btn-secondary btn-sm" title="Visualizar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </a>
                                    <a href="<?= SITE_URL ?>/<?= $controller ?>/form/update/<?= (implode("", $id[$key])) ?>" class="btn btn-secondary btn-sm" title="Alterar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </a>
                                    <a href="<?= SITE_URL ?>/<?= $controller ?>/form/delete/<?= (implode("", $id[$key])) ?>" class="btn btn-secondary btn-sm" title="Excluir">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        echo self::datatables();
    }
    
    /**
     * metodo que monta o model que contém os itens do pedido
     *
     * @return string
     */
    public static function modelItensPedido()
    {
        $html = '
            <div class="modal fade" id="modalItensPedido" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div id="modal-body-itens" class="modal-body">
                        </div>
                    </div>
                </div>
            </div>
        ';

        return $html;
    }
    
    /**
     * método que monta a tabela da home admin e da home do motoboy
     *
     * @param  array $total
     * @param  string $tabFinalizados
     * @param  string $tabACaminho
     * @param  string $tabEntregue
     * @param  string $config
     * @return string
     */
    public static function tabelaHome($total, $tabFinalizados, $tabACaminho, $tabEntregue, $config = '')
    {
        if ($_SESSION['userNivel'] == '1')
        {
            $finalizados = '
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                    Finalizados <span class="badge bg-danger">' . $total['totalFinalizados'] . '</span>
                </button>';

            $tabelaFinalizados = '
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-light table-sm tblLista">' .
                self::theaderPedidos()
                . '<tbody>'
                . $tabFinalizados
                . '</tbody>
                        </table>
                    </div>
                </div>';
        }
        else
        {
            $finalizados = '';
            $tabelaFinalizados = '';
        }

        $html = '
            <div class="container mt-3 p-3 mb-4">
                <h1 style="color: #433A8F;" class="">Olá, ' . $_SESSION['userNome'] . '!</h1>
                <h2>Bem-vindo a Home Admin!</h2>
                <nav class="mt-5 mb-4">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">'
            . $finalizados .
            '<button class="nav-link ' . ($_SESSION['userNivel'] == '3' ? 'active' : '') . '" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
                            Á caminho <span class="badge bg-primary">' . $total['totalACaminho'] . '</span>
                        </button>
                        <button class="nav-link" id="nav-fin-tab" data-bs-toggle="tab" data-bs-target="#nav-fin" type="button" role="tab" aria-controls="nav-fin" aria-selected="false">
                            Entregues <span class="badge bg-success">' . $total['totalEntregues'] . '</span>
                        </button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">' .
            $tabelaFinalizados
            . '<div class="tab-pane fade ' . ($_SESSION['userNivel'] == '3' ? 'show active' : '') . '" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-light table-sm tblLista">' .
            self::theaderPedidos()
            . '<tbody>'
            . $tabACaminho
            . '</tbody>
                            </table>
                        </div>
            
                    </div>
                    <div class="tab-pane fade" id="nav-fin" role="tabpanel" aria-labelledby="nav-fin-tab">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-light table-sm tblLista">' .
            self::theaderPedidos()
            . '<tbody>'
            . $tabEntregue
            . '</tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>' . self::datatables($config);

        return $html;
    }
    
    /**
     * metodo que monta a thead da tabela
     *
     * @return string
     */
    public static function theaderPedidos()
    {
        $theader = '
            <thead class="table-light">
                <tr>
                    <th>Cód. Pedido</th>
                    <th>Cliente</th>
                    <th>Valor Total R$</th>
                    <th>Tipo</th>
                    <th>Data e Hora</th>
                    <th>Motoboy</th>
                    <th>Ações</th>
                </tr>
            </thead>';

        return $theader;
    }
    
    /**
     * metodo que monta o tbory da tabela
     *
     * @param  array $pedido
     * @param  array $motoboys
     * @return string
     */
    public static function tbodyPedidos($pedido, $motoboys = [])
    {
        $button = '';
        $motoboy = '';

        // loop para armazenar o nome do motoboy para mostrar na lista
        if (!empty($motoboys))
        {
            foreach ($motoboys as $m)
            {
                if ($m['id'] == $pedido['id_motoboy'])
                {
                    $motoboy = $m['nome'];
                }
            }
        }
        else
        {
            if($_SESSION['userNivel'] == '1')
            {
                $motoboy = "";
            }
            else 
            {
                $motoboy = $_SESSION['userNome'];
            }
        }

        // se o status for diferente de entregue
        if ($pedido['status'] != 'E')
        {
            // se o pedido for igual a finalizado
            if ($pedido['status'] == 'F')
            {
                if (is_null($pedido['id_endereco']))
                {
                    $button .= '
                        <a href="' . SITE_URL . 'HomeAdmin/alteraStatus&id=' . $pedido['id'] . '&btnEntregue=true" class="btnHome btn btn-sm btn-success" title="Enviar pedido">
                            <i class="fas fa-check"></i> 
                            Entregue 
                        </a>
                    ';
                }
                else
                {
                    // é igual a caminho
                    $button .= '
                        <button type="button" class="btnHome btn btn-success btn-sm" title="Enviar" onclick="modalEntregador(' . $pedido['id'] . ')">
                            <i class="fas fa-rocket"></i>  
                            Enviar
                        </button> 
                    ';
                }

                // botão de exluir 
                $button .= '
                    <a href="' . SITE_URL . 'HomeAdmin/deletaPedido/' . $pedido['id'] . '" class="btnHome btn btn-sm btn-secondary" title="Excluir">
                        <i class="fas fa-trash-alt"></i>
                        Excluir
                    </a>
                ';
            }
            else
            {
                if ($_SESSION['userNivel']  == '1')
                {
                    $controller = "HomeAdmin";
                }
                else
                {
                    $controller = "HomeMotoboy";
                }
                // botao que abre modal de escolher o motoboy
                $button .= '
                    <a href="' . SITE_URL . $controller . '/alteraStatus&id=' . $pedido['id'] . '&btnEntregue=true" class="btnHome btn btn-sm btn-success" title="Enviar pedido">
                        <i class="fas fa-check"></i> 
                        Entregue 
                    </a>
                ';
            }
        }

        $tbody = '
            <tr>
                <td class="text-center">' . $pedido['id'] . '</td>
                <td>' . (!is_null($pedido['nome']) ? $pedido['nome'] : "Cliente inexistente") . '</td>
                <td>' . Numeros::formataValor($pedido['valor_total']) . '</td>
                <td>' . (!is_null($pedido['id_endereco']) ? "Entrega" : "Retirada") . " - "
            . ($pedido['forma_pagamento'] == "C" ? "<i class='far fa-credit-card'></i>" : "<i class='fas fa-dollar-sign'></i>") .
            '</td>
                <td>' . Data::dmY($pedido["finished_at"], 2) . '</td>
                <td>' . $motoboy . ' </td>
                <td class="fs-4">
                    <button class="btnHome btn btn-sm btn-secondary" 
                        onclick="abreModal(' . $pedido['id'] . ', ' . $pedido['id_endereco'] . ')" title="Visualizar"
                    >
                        <i class="fas fa-eye"></i> 
                        Visualizar
                    </button>
                    ' . $button . '
                </td>
            </tr>
        ';

        return $tbody;
    }
    
    /**
     * método que monta o script da datatables e se for necessário, 
     * há p parâmetro de configs que foi utilizado para deixar a tabela
     * em ordem decrescente
     *
     * @param  mixed $config
     * @return void
     */
    public static function datatables($config = '')
    {
        return '
            <script src="'.  SITE_URL . 'assets/DataTables/js/jquery.dataTables.min.js"></script>
            <script>
                $(document).ready(function() {
                    fetch("'. SITE_URL . 'assets/DataTables/pt_br.json")
                        .then(mock => {
                            return mock.json()
                        })
                        .then(data => {
                            $(".tblLista").DataTable({
                                language: data,'. 
                                $config .
                            '});
                        });
                });
            </script>';
    }
}
