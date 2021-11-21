<?php

require_once 'app/model/ModelHomeAdmin.php';
require_once 'app/model/ModelPedido.php';

Security::isLogado();
Security::isAdmin();

$model = new HomeAdmin();

$post = $_POST;

switch ($metodo)
{
    case "index":

        $pedidos['entregadores'] = $model->getEntregadores();
        $pedidos['pedidos'] = $model->getPedidoByStatus();

        require_once "app/view/homeAdmin.php";
        break;

    case "alteraStatus":

        if ($model->updateStatusPedido($_GET))
        {
            $_SESSION['msgSucesso'] = "Status alterado com sucesso.";
        }
        else
        {
            $_SESSION['msgError'] = "Falha ao alterar status.";
        }

        Redirect::page("HomeAdmin/index");

        break;

    case 'deletaPedido':

        if ($model->deletePedido($id))
        {
            $_SESSION['msgSucesso'] = "Pedido excluído com sucesso";
        }
        else
        {
            $_SESSION['msgError'] = "Falha ao excluír pedido.";
        }

        Redirect::page("HomeAdmin/index");
        break;

    case "addMotoboy":

        if ($model->addMotoboy($post))
        {
            $_SESSION['msgSucesso'] = "Status alterado e motoboy selecionado.";
        }
        else
        {
            $_SESSION['msgError'] = "Falha ao alterar status e adicionar motoboy.";
        }

        Redirect::page("HomeAdmin/index");
        break;
}
