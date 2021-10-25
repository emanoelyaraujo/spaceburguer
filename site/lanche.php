<?php

require_once 'ModelLanche.php';

Security::isAdmin();

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

        if ($acao != 'insert')
        {

            $aDados['data'] = $model->getId("lanche", $id);
        }

        $aDados['categoria'];

        require_once "site/admin/formLanche.php";
        break;

    case 'insert':

        if (empty(trim($post["ingredientes"])))
        {
            $_SESSION["msgError"] = "Campo ingredientes é obrigatório";
            Redirect::Page("lanche/form/insert");
            break;
        }

        if ($model->insert($_POST))
        {
            $_SESSION['msgSucesso'] = 'Lanche inserido com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar inserir o lanche na base de dados.';
        }

        Redirect::Page("lanche/lista");
        break;

    case 'update':

        if ($model->update($_POST))
        {
            $_SESSION['msgSucesso'] = 'Lanche atualizado com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar atualizar o lanche na base de dados.';
        }

        Redirect::Page("lanche/lista");
        break;

    case 'delete':

        if ($model->delete($_POST['id']))
        {
            $_SESSION['msgSucesso'] = 'Lanche excluído com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar excluir o lanche na base de dados.';
        }

        Redirect::Page("lanche/lista");
        break;
}
