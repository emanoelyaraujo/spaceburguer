<?php

require_once 'app/model/ModelUsuario.php';
require_once 'app/model/ModelMinhaConta.php';

$model = new Usuario();
$minhaConta = new MinhaConta();

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

        $user = $model->getUserEmail($post["email"]);

        if (!empty($user))
        {
            $codigo = substr(uniqid(rand()), 0, 6);

            $salvaCodigo = $model->updateCodigo($codigo, $user["id"]);

            if ($salvaCodigo)
            {
                $mail = EnviaEmail::create();
                $mail->setFrom("deliveryspaceburguer@gmail.com", "SpaceBurger");
                $mail->addAddress($user["email"], $user["nome"]);
                $mail->Subject = "Alterar Senha";
                $mail->Body    = EnviaEmail::bodyRecuperacaoSenha($codigo, $user["nome"]);

                EnviaEmail::send($mail);

                $email["emailUser"] = $user["email"];
                require_once "app/view/verificaCodigo.php";
                break;
            }
            else
            {
                $_SESSION["msgError"] = "Erro. Tente mais tarde.";
                Redirect::page("Login/esqueciMinhaSenha");
            }
        }
        else
        {
            $_SESSION["msgError"] = "E-mail informado não está cadastrado";
            Redirect::page("Login/esqueciMinhaSenha");
        }

        break;

    case "verificaCodigo":

        $user = $model->getUserEmail($post['email']);

        if ($user["codVerificacao"] == $post["codigo"])
        {
            $dados["usuario"] = $user;
            require_once "app/view/formEsqueciSenha.php";
            break;
        }
        else
        {
            $model->updateCodigo(null, $user['id']);
            $_SESSION["msgError"] = "Erro. Tente mais tarde.";
            Redirect::page("Login/esqueciMinhaSenha");
        }

        break;

    case "updateSenha":

        $user = $model->getId("usuario", $post["id"]);

        if ($post["novaSenha"] != $post["confirmSenha"])
        {
            $_SESSION["msgError"] = "Senhas não conferem";
            require_once "app/view/formEsqueciSenha.php";
            break;
        }

        if ($minhaConta->updateSenha($post, $user["id"]))
        {
            $_SESSION['msgSucesso'] = 'Registro atualizado com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar atualizar o registro na base de dados.';
        }
        
        $model->updateCodigo(null, $user['id']);

        Redirect::Page("Login/index");

        break;
}
