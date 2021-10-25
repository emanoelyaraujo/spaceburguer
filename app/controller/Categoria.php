<?php

require_once 'app/model/ModelCategoria.php';

Security::isAdmin();

$model = new Categoria();

$post           = $_POST;
$aDados['acao'] = $acao;

switch ($metodo)
{

    case 'lista':

        $aDados['data'] = $model->getLista("categoria", "descricao");

        require_once "app/view/admin/listCategorias.php";

        break;

    case 'form':

        if ($acao != 'insert')
        {
            $aDados['data'] = $model->getId("categoria", $id);
        }

        require_once "app/view/admin/formCategoria.php";
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

        Redirect::Page("categoria/lista");
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

        Redirect::Page("categoria/lista");
        break;

    case 'delete':

        // busca na tabela de lanches se há algum na categoria a ser removida
        $lanche = $model->getCategoriaLanche($post["id"]);

        if(!empty($lanche))
        {
            if($lanche["id_categoria"] == $post["id"])
            {
                $_SESSION['msgError'] = 'Não é possível deletar essa categoria pois há lanches vinculados a ela. Para realizar essa ação, mude a categoria dos lanches.';
                Redirect::page("categoria/lista");
                break;
            }
        }

        if ($model->delete($post['id']))
        {
            $_SESSION['msgSucesso'] = 'Registro excluído com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar excluir o registro na base de dados.';
        }

        Redirect::Page("categoria/lista");
        break;
}
