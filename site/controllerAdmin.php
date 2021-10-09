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

        if ($acao != 'insert') {
            //$aDados['data'] = $model->getId("lanches", $id);
        }

        require_once "site/admin/formSobreoAutor.php";
        break;

    case 'formUsuario':

        if ($acao != 'insert') {
            $aDados['data'] = $model->getId("sobreoautor", $id);
        }

        require_once "site/admin/formSobreoAutor.php";
        break;

    case 'formcateoria':

        if ($acao != 'insert') {
            $aDados['data'] = $model->getId("sobreoautor", $id);
        }

        require_once "site/admin/formSobreoAutor.php";
        break;

    case 'insert':

        if ($model->insert($_POST)) {
            $_SESSION['msgSucesso'] = 'Registro inserido com sucesso.';
        } else {
            $_SESSION['msgError'] = 'Falha ao tentar inserir o registro na base de dados.';
        }

        Redirect::Page("sobreoAutor/lista");
        break;

    case 'update':

        if ($model->update($_POST)) {
            $_SESSION['msgSucesso'] = 'Registro atualizado com sucesso.';
        } else {
            $_SESSION['msgError'] = 'Falha ao tentar atualizar o registro na base de dados.';
        }

        Redirect::Page("sobreoAutor/lista");
        break;

    case 'delete':

        if ($model->delete($_POST['id'])) {
            $_SESSION['msgSucesso'] = 'Registro excluído com sucesso.';
        } else {
            $_SESSION['msgError'] = 'Falha ao tentar excluir o registro na base de dados.';
        }

        Redirect::Page("sobreoAutor/lista");
        break;
}
