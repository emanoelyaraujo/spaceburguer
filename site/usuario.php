<?php

require_once 'modelUsuario.php';

$model = new Usuario();

$post           = $_POST;
$aDados['acao'] = $acao;

switch ($metodo)
{
    case 'login':

        // super usário

        $superUser = $model->criaSuperUser();

        if ($superUser > 0)
        {          // 1=Falhou criação do super user; 2=sucesso na criação do super user
            Redirect::page("login");
        }

        // Buscar usuário na base de dados

        $aUsuario = $model->getUserEmail($post['email']);

        if (count($aUsuario) > 0)
        {

            // validar a senha

            if (!password_verify(trim($post["senha"]), $aUsuario['senha']))
            {
                $_SESSION["msgError"] = 'Usuário e ou senha inválido.';
                Redirect::page("login");
            }

            // validar o status do usuário

            if ($aUsuario['status'] == 2)
            {
                $_SESSION["msgError"] = "Usuário Inativo, não será possível prosseguir !";
                Redirect::page("login");
            }

            //  Criar flag's de usuário logado no sistema

            $_SESSION["userId"] = $aUsuario['id'];
            $_SESSION["userNome"]  = $aUsuario['nome'];
            $_SESSION["userEmail"]  = $aUsuario['email'];
            $_SESSION["userNivel"]  = $aUsuario['nivel'];
            $_SESSION["userSenha"]  = $aUsuario['senha'];
            $_SESSION["userTelefone"]  = $aUsuario['telefone'];

            // Direcionar o usuário para página home

            if ($_SESSION["userNivel"] == 1)
            {
                Redirect::page("homeAdmin");
            }
            else
            {
                Redirect::page("home");
            }
        }
        else
        {
            $_SESSION['msgError'] = 'E-mail informado não está cadastrado.';
            Redirect::page("cadastrar");
        }

        break;

    case "register":

        if ($post["senha"] === $post["confirmSenha"])
        {
            $aUsuario = $model->getUserEmail($post['email']);

            // verifica se o email informado já existe na base de dados
            if (!empty($aUsuario) && $aUsuario["email"] == $post["email"])
            {
                $_SESSION["msgError"] = "Este e-mail já foi cadastrado";
                Redirect::page("login");
                break;
            }
            else
            {
                $rscUser = $model->insertUser($post);
            }

            if ($rscUser > 0)
            {
                $aUsuario = $model->getUserEmail($post['email']);
                Redirect::page("login");
            }
            else
            {
                $_SESSION["msgError"] = "Falha ao criar usuário";
                Redirect::page("cadastrar");
            }

            $_SESSION["userId"] = $aUsuario['id'];
            $_SESSION["userNome"]  = $aUsuario['nome'];
            $_SESSION["userEmail"]  = $aUsuario['email'];
            $_SESSION["userNivel"]  = $aUsuario['nivel'];
            $_SESSION["userSenha"]  = $aUsuario['senha'];
            $_SESSION["userTelefone"]  = $aUsuario['telefone'];
        }
        else
        {
            $_SESSION["msgError"] = "Senhas não conferem";
            Redirect::page("cadastrar");
        }

        break;

    case 'logout':

        unset($_SESSION['userId']);
        unset($_SESSION['userNome']);
        unset($_SESSION['userEmail']);
        unset($_SESSION['userNivel']);
        unset($_SESSION['userSenha']);
        unset($_SESSION['userTelefone']);

        Redirect::Page("home");
        break;

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

        Redirect::Page("usuario/lista");
        break;

    case 'update':

        if (isset($post["confirmSenha"]))
        {
            if (!password_verify($post["senhaAtual"], $_SESSION["userSenha"]) || $post["novaSenha"] === $post["confirmSenha"])
            {
                $_SESSION["msgError"] = "Senhas não conferem";
                Redirect::page("cadastrar");
            }
        }
        exit;

        if ($model->update($_POST))
        {
            $_SESSION['msgSucesso'] = 'Registro atualizado com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar atualizar o registro na base de dados.';
        }

        if ($_SESSION["userNivel"] == 1)
        {
            Redirect::Page("usuario/lista");
        }
        else
        {
            $aUsuario = $model->getId("usuario", $_SESSION["userId"]);

            $_SESSION["userNome"]  = $aUsuario['nome'];
            $_SESSION["userEmail"]  = $aUsuario['email'];
            $_SESSION["userTelefone"]  = $aUsuario['telefone'];
            Redirect::Page("perfil");
        }

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

        Redirect::Page("usuario/lista");
        break;
}
