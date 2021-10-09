<?php

require_once 'modelAdmin.php';    // Carregando o model Sobre-o-autorr

// ainda não criei o objeto da classe model

$post           = $_POST;
$aDados['acao'] = $acao;

switch ($metodo) {

    case 'painel':

        require_once "site/admin/painel.php";

        break;

    case 'pedidos':

        require_once "site/admin/pedidos.php";

        break;

    case 'formLanche':

        require_once "site/admin/formLanches.php";
        break;

    case 'formUsuario':

        require_once "site/admin/formUsuarios.php";
        break;

    case 'formCateoria':

        require_once "site/admin/formCategorias.php";
        break;

    case 'listLanche':

        require_once "site/admin/listLanches.php";
        break;

    case 'listUsuario':

        require_once "site/admin/listUsuarios.php";
        break;

    case 'listCateoria':

        require_once "site/admin/listCategorias.php";
        break;
}
