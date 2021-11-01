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

            // Direcionar o usuário para página home
            Redirect::page("Home/index");
        }
        else
        {
            $_SESSION['msgError'] = 'E-mail informado não está cadastrado.';
            Redirect::page("Login/email");
        }

        break;

    case 'register':

        unset($_SESSION["codigo"]);

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
            $rscUser = $model->insert($post);
        }

        if ($rscUser > 0)
        {
            $_SESSION["msgSucesso"] = "Usuário criado com sucesso!";
            Redirect::page("Login/index");
        }
        else
        {
            $_SESSION["msgError"] = "Falha ao criar usuário";
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

    case "email":

        require_once "app/view/verificaEmail.php";
        break;

    case "verificaEmail":

        $user = $model->getUserEmail($post["email"]);
        $codigo = substr(uniqid(rand()), 0, 6);

        $mail = EnviaEmail::create();
        $mail->setFrom("deliveryspaceburguer@gmail.com", "SpaceBurger");

        if (!empty($user))
        {
            $salvaCodigo = $model->updateCodigo($codigo, $user["id"]);

            if ($salvaCodigo)
            {
                $mail->addAddress($user["email"], $user["nome"]);
                $mail->Subject = "Alterar Senha";
                $mail->Body    = EnviaEmail::bodyRecuperacaoSenha($codigo, $user["nome"]);
                $view = "login";
            }
            else
            {
                $_SESSION["msgError"] = "Erro. Tente mais tarde.";
                Redirect::page("Login/email");
            }
        }
        else
        {
            $_SESSION["codigo"] = $codigo;
            $mail->addAddress($post["email"]);
            $mail->Subject = "Código de Verificação";
            $mail->Body    = EnviaEmail::bodyRecuperacaoSenha($codigo);
            $view = "cadastrar";
        }

        EnviaEmail::send($mail);

        $email["emailUser"] = $post["email"];
        require_once "app/view/verificaCodigo.php";
        break;

    case "verificaCodigo":

        unset($_SESSION["msgSucesso"]);

        $user = $model->getUserEmail($post['email']);

        if (@$user["codVerificacao"] == $post["codigo"] || $post["codigo"] == $_SESSION["codigo"])
        {
            if (isset($_SESSION["codigo"]))
            {
                $dados["email"] = $post["email"];
                require_once "app/view/cadastrar.php";
            }
            else
            {
                $dados["usuario"] = $user;
                require_once "app/view/formEsqueciSenha.php";
            }
            break;
        }
        else
        {
            $_SESSION["msgError"] = "Erro. Tente mais tarde.";
            Redirect::page("Login/email");
        }

        unset($_SESSION["codigo"]);
        $model->updateCodigo(null, $user['id']);

        break;

    case "updateSenha":

        $user = $model->getId("usuario", $post["id"]);

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
