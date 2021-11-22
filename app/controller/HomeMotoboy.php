<?php

require_once 'app/model/ModelHomeMotoboy.php';
require_once 'app/model/ModelHomeAdmin.php';

Security::isLogado();
Security::isMotoboy();

$model = new HomeMotoboy();
$admin = new HomeAdmin();

$post = $_POST;

switch ($metodo)
{
    case "index":

        $pedidos['pedidos'] = $model->getEntregas();

        require_once "app/view/motoboy/homeMotoboy.php";
        break;

    case "alteraStatus":

        if ($admin->updateStatusPedido($_GET))
        {
            $_SESSION['msgSucesso'] = "Status alterado com sucesso.";
        }
        else
        {
            $_SESSION['msgError'] = "Falha ao alterar status.";
        }

        Redirect::page("HomeMotoboy/index");

        break;
}
