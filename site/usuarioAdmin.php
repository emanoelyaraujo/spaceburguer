<?php

require_once 'ModelUsuario.php';

Security::isAdmin();

$model = new Usuario();

$post           = $_POST;
$aDados['acao'] = $acao;

switch ($metodo)
{
    case 'lista':

        $aDados['data'] = $model->getLista("usuario");

        require_once "site/admin/listUsuarios.php";

        break;

    case 'form':

        if ($acao != 'insert')
        {
            $aDados['data'] = $model->getId("usuario", $id);
        }

        require_once "site/admin/formUsuarios.php";
        break;

    case 'insert':

        if ($model->insert($_POST))
        {
            $_SESSION['msgSucesso'] = 'Registro inserido com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar inserir o registro na base de dados.';
        }

        Redirect::Page("usuarioAdmin/lista");
        break;

    case 'update':

        if ($model->update($_POST))
        {
            $_SESSION['msgSucesso'] = 'Registro atualizado com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar atualizar o registro na base de dados.';
        }

        Redirect::Page("usuarioAdmin/lista");

        break;

    case 'delete':

        if ($model->delete($_POST['id']))
        {
            $_SESSION['msgSucesso'] = 'Registro excluído com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar excluir o registro na base de dados.';
        }

        Redirect::Page("usuarioAdmin/lista");
        break;
}
