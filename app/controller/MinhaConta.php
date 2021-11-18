<?php

require_once 'app/model/ModelMinhaConta.php';
require_once 'app/model/ModelPedido.php';
require_once 'app/model/ModelUsuario.php';

Security::isLogado();

$model = new MinhaConta();
$request = new Pedido();
$usuario = new Usuario();

$post           = $_POST;
$aDados['acao'] = $acao;

switch ($metodo)
{
    case "index":
        $dados["endereco"] = $model->getEnderecos();
        $dados["cartao"] = $model->getCartoes();

        require_once "app/view/minhaConta.php";

        break;

    case "setPill":
        // seta na sessão a pill clicada na view minha conta
        $_SESSION["pill"] = $post["id"];

        break;

    case "carregaDadosEndereco":
        // carrega os dados do endereço quando o usuário clica em editar ou excluir
        $dados["endereco"] = $model->getId("endereco", $_GET["id"]);

        // limpa o buffer de saida para ter acesso ao JSON
        ob_end_clean();
        // envia para a view od dados retornados do banco
        echo json_encode($dados["endereco"]);
        exit;
        break;

    case "carregaDadosCartao":
        // carrega os dados do cartão quando o usuário clica em editar ou excluir
        $dados["cartao"] = $model->getId("cartao", $_GET["id"]);

        // limpa o buffer de saida para ter acesso ao JSON
        ob_end_clean();
        // envia para a view od dados retornados do banco
        echo json_encode($dados["cartao"]);
        exit;
        break;

    case 'updateSenha':
        // verifica as senhas informadas 
        if (!password_verify($post["senhaAtual"], $_SESSION["a"]) || $post["novaSenha"] != $post["confirmSenha"])
        {
            $_SESSION["msgError"] = "Senhas não conferem";
            Redirect::page("Usuario/formSenha");
            break;
        }

        if ($model->updateSenha($post, $_SESSION["userId"]))
        {
            $_SESSION['msgSucesso'] = 'Senha atualizada com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar atualizar a senha.';
        }

        // busca os dados do usuario no banco
        $aUsuario = $model->getId("usuario", $_SESSION["userId"]);

        // grava na sessão o novo hash de senha criado
        $_SESSION["userSenha"] = $aUsuario["senha"];

        Redirect::Page("MinhaConta/index");

        break;

    case "updateDados":

        if ($model->updateDados($post, $_FILES))
        {
            $_SESSION['msgSucesso'] = 'Registro atualizado com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar atualizar o registro na base de dados.';
        }

        // busca os dados do usuario no banco
        $aUsuario = $model->getId("usuario", $_SESSION["userId"]);

        // grava na sessão os novos valores
        $_SESSION["userNome"]  = $aUsuario['nome'];
        $_SESSION["userEmail"]  = $aUsuario['email'];
        $_SESSION["userTelefone"]  = $aUsuario['telefone'];
        $_SESSION["userImagem"]  = $aUsuario['imagem'];

        Redirect::Page("MinhaConta/index");

        break;

    case 'deleteUser':

        if ($usuario->delete($_SESSION["userId"]))
        {
            $_SESSION['msgSucesso'] = 'Conta excluída com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar excluir a conta.';
        }

        Redirect::Page("Login/logout");
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

    case "updateEndereco":

        if ($model->updateEndereco($post))
        {
            $_SESSION['msgSucesso'] = 'Endereço atualizado com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar atualizar o endereço na base de dados.';
        }

        Redirect::Page("MinhaConta/index");

        break;

    case "deleteEndereco":

        if ($model->deleteEndereco($post))
        {
            $_SESSION['msgSucesso'] = 'Endereço excluído com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar excluir o endereço na base de dados.';
        }

        Redirect::Page("MinhaConta/index");

        break;

    case "insertCartao":

        if ($model->insertCartao($post))
        {
            $_SESSION['msgSucesso'] = 'Cartão criado com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar criar o cartão na base de dados.';
        }

        Redirect::Page("MinhaConta/index");
        break;

    case "updateCartao":

        if ($model->updateCartao($post))
        {
            $_SESSION['msgSucesso'] = 'Cartão atualizado com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar atualizar o cartão na base de dados.';
        }

        Redirect::Page("MinhaConta/index");

        break;

    case "deleteCartao":

        if ($model->deleteCartao())
        {
            $_SESSION['msgSucesso'] = 'Cartão excluído com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar excluir o cartão na base de dados.';
        }

        Redirect::Page("MinhaConta/index");

        break;
}
