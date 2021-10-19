<?php

require_once 'modelAreaUsuario.php';

$model = new AreaUsuario();

$post           = $_POST;
$aDados['acao'] = $acao;

switch ($metodo)
{
    case 'update':
        // se foi setado está na view perfil
        if (isset($post["confirmSenha"]))
        {
            if (!password_verify($post["senhaAtual"], $_SESSION["userSenha"]) || $post["novaSenha"] != $post["confirmSenha"])
            {
                $_SESSION["msgError"] = "Senhas não conferem";
                Redirect::page("minhaConta");
                break;
            }
        }
        // senão, lista de usuários do adm
        if ($model->update($post))
        {
            $_SESSION['msgSucesso'] = 'Registro atualizado com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar atualizar o registro na base de dados.';
        }

        $aUsuario = $model->getId("usuario", $_SESSION["userId"]);

        if (!isset($post["confirmSenha"]))
        {

            $_SESSION["userNome"]  = $aUsuario['nome'];
            $_SESSION["userEmail"]  = $aUsuario['email'];
            $_SESSION["userTelefone"]  = $aUsuario['telefone'];
        }
        else
        {
            $_SESSION["userSenha"] = $aUsuario["senha"];
        }

        Redirect::Page("minhaConta");

        break;

    case "setPill":
        $_SESSION["pill"] = $post["id"];
        break;
}
