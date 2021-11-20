<?php

require_once 'app/model/ModelUsuario.php';

Security::isAdmin();

$model = new Usuario();

$post           = $_POST;
$aDados['acao'] = $acao;

switch ($metodo)
{
    case 'lista':

        $aDados['data'] = $model->getLista("usuario");

        require_once "app/view/admin/listUsuarios.php";

        break;

    case 'form':

        if ($acao != 'insert')
        {
            $aDados['data'] = $model->getId("usuario", $id);
        }

        require_once "app/view/admin/formUsuarios.php";
        break;

    case 'insert':

        if ($model->insert($post))
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

        if ($model->update($post))
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

        if ($model->delete($post['id']))
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
