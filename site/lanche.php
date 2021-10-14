<?php

require_once 'modelLanche.php';

$model = new Lanche();

$post           = $_POST;
$aDados['acao'] = $acao;
$aDados['categoria'] = $model->getLista("categoria", "descricao");

switch ($metodo)
{
       
    case 'lista':

        $aDados['data'] = $model->getLista("lanche", "id_categoria");
        require_once "site/admin/listLanches.php";

        break;

    case 'form':

        if ($acao != 'insert') {

            $aDados['data'] = $model->getId("lanche", $id);
        }

        $aDados['categoria'];

        require_once "site/admin/formLanche.php";
        break;

    case 'insert':

        if ($model->insert($_POST)) {
            $_SESSION['msgSucesso'] = 'Registro inserido com sucesso.';
        } else {
            $_SESSION['msgError'] = 'Falha ao tentar inserir o registro na base de dados.';
        }

        Redirect::Page("lanche/lista");
        break;

    case 'update':
        
        if ($model->update($_POST)) {
            $_SESSION['msgSucesso'] = 'Registro atualizado com sucesso.';
        } else {
            $_SESSION['msgError'] = 'Falha ao tentar atualizar o registro na base de dados.';
        }

        Redirect::Page("lanche/lista");
        break;

    case 'delete':

        if ($model->delete($_POST['id'])) {
            $_SESSION['msgSucesso'] = 'Registro excluído com sucesso.';
        } else {
            $_SESSION['msgError'] = 'Falha ao tentar excluir o registro na base de dados.';
        }

        Redirect::Page("lanche/lista");
        break;
}
