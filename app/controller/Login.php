<?php

require_once 'app/model/ModelUsuario.php';

$model = new Usuario();

$post           = $_POST;
$aDados['acao'] = $acao;

switch ($metodo)
{
    case "index":
        require_once "app/view/login.php";

        break;

    case "cadastrar":
        require_once "app/view/cadastrar.php";

        break;

    case 'login':

        // super usário

        $superUser = $model->criaSuperUser();

        if ($superUser > 0)
        {          // 1=Falhou criação do super user; 2=sucesso na criação do super user
            Redirect::page("Login/index");
        }

        // Buscar usuário na base de dados

        $aUsuario = $model->getUserEmail($post['email']);

        if (count($aUsuario) > 0)
        {

            // validar a senha

            if (!password_verify(trim($post["senha"]), $aUsuario['senha']))
            {
                $_SESSION["msgError"] = 'Usuário e ou senha inválido.';
                Redirect::page("Login/index");
            }

            // validar o status do usuário

            if ($aUsuario['status'] == 2)
            {
                $_SESSION["msgError"] = "Usuário Inativo, não será possível prosseguir !";
                Redirect::page("Login/index");
            }

            //  Criar flag's de usuário logado no sistema

            $_SESSION["userId"] = $aUsuario['id'];
            $_SESSION["userNome"]  = $aUsuario['nome'];
            $_SESSION["userEmail"]  = $aUsuario['email'];
            $_SESSION["userNivel"]  = $aUsuario['nivel'];
            $_SESSION["userSenha"]  = $aUsuario['senha'];
            $_SESSION["userTelefone"]  = $aUsuario['telefone'];
            // $_SESSION["pill"]  = ;

            // Direcionar o usuário para página home
            Redirect::page("Home/index");
        }
        else
        {
            $_SESSION['msgError'] = 'E-mail informado não está cadastrado.';
            Redirect::page("Login/cadastrar");
        }

        break;

    case 'register':

        if ($post["senha"] === $post["confirmSenha"])
        {
            $aUsuario = $model->getUserEmail($post['email']);

            // verifica se o email informado já existe na base de dados
            if (!empty($aUsuario) && $aUsuario["email"] == $post["email"])
            {
                $_SESSION["msgError"] = "Este e-mail já foi cadastrado";
                Redirect::page("Login/index");
                break;
            }
            else
            {
                $rscUser = $model->insertUser($post);
            }

            if ($rscUser > 0)
            {
                $aUsuario = $model->getUserEmail($post['email']);
                Redirect::page("Login/index");
            }
            else
            {
                $_SESSION["msgError"] = "Falha ao criar usuário";
                Redirect::page("Login/cadastrar");
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
            Redirect::page("Login/cadastrar");
        }

        break;

    case 'logout':

        unset($_SESSION['userId']);
        unset($_SESSION['userNome']);
        unset($_SESSION['userEmail']);
        unset($_SESSION['userNivel']);
        unset($_SESSION['userSenha']);
        unset($_SESSION['userTelefone']);
        unset($_SESSION['pill']);

        Redirect::Page("Home/index");
        break;

    case "esqueciMinhaSenha":

        require_once "app/view/verificaEmail.php";
        break;

    case "verificaEmail": 
        var_dump($post);exit;
}
