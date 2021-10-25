<?php

require_once 'app/model/ModelMinhaConta.php';

$model = new MinhaConta();

$post           = $_POST;
$aDados['acao'] = $acao;

switch ($metodo)
{
    case "index":
        $dados["endereco"] = $model->getLista("endereco", "id");

        require_once "app/view/minhaConta.php";

        break;

    case 'updateSenha':

        if (!password_verify($post["senhaAtual"], $_SESSION["userSenha"]) || $post["novaSenha"] != $post["confirmSenha"])
        {
            $_SESSION["msgError"] = "Senhas não conferem";
            Redirect::page("Usuario/formSenha");
            break;
        }

        if ($model->updateSenha($post))
        {
            $_SESSION['msgSucesso'] = 'Registro atualizado com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar atualizar o registro na base de dados.';
        }

        $aUsuario = $model->getId("usuario", $_SESSION["userId"]);

        $_SESSION["userSenha"] = $aUsuario["senha"];

        Redirect::Page("MinhaConta/index");

        break;

    case "updateDados":

        if ($model->updateDados($post))
        {
            $_SESSION['msgSucesso'] = 'Registro atualizado com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar atualizar o registro na base de dados.';
        }

        $aUsuario = $model->getId("usuario", $_SESSION["userId"]);

        $_SESSION["userNome"]  = $aUsuario['nome'];
        $_SESSION["userEmail"]  = $aUsuario['email'];
        $_SESSION["userTelefone"]  = $aUsuario['telefone'];

        Redirect::Page("MinhaConta/index");

        break;

    case "insertEndereco":
        if ($model->insertEndereco($post))
        {
            $_SESSION['msgSucesso'] = 'Endereço criado com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar criar o endereço na base de dados.';
        }

        Redirect::Page("MinhaConta/index");

        break;

    case "setPill":
        $_SESSION["pill"] = $post["id"];

        break;
}