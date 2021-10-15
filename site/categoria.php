<?php

require_once 'modelCategoria.php';

Security::isAdmin();

$model = new Categoria();

$post           = $_POST;
$aDados['acao'] = $acao;

switch ($metodo)
{
       
    case 'lista':

        $aDados['data'] = $model->getLista("categoria", "descricao");

        require_once "site/admin/listCategorias.php";

        break;

    case 'form':

        if ($acao != 'insert') {
            $aDados['data'] = $model->getId("categoria", $id);
        }

        require_once "site/admin/formCategoria.php";
        break;

    case 'insert':

        if ($model->insert($_POST)) {
            $_SESSION['msgSucesso'] = 'Registro inserido com sucesso.';
        } else {
            $_SESSION['msgError'] = 'Falha ao tentar inserir o registro na base de dados.';
        }

        Redirect::Page("categoria/lista");
        break;

    case 'update':
        
        if ($model->update($_POST)) {
            $_SESSION['msgSucesso'] = 'Registro atualizado com sucesso.';
        } else {
            $_SESSION['msgError'] = 'Falha ao tentar atualizar o registro na base de dados.';
        }

        Redirect::Page("categoria/lista");
        break;

    case 'delete':

        if ($model->delete($_POST['id'])) {
            $_SESSION['msgSucesso'] = 'Registro excluído com sucesso.';
        } else {
            $_SESSION['msgError'] = 'Falha ao tentar excluir o registro na base de dados.';
        }

        Redirect::Page("categoria/lista");
        break;
}
