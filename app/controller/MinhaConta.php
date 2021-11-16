<?php

require_once 'app/model/ModelMinhaConta.php';
require_once 'app/model/ModelPedido.php';

Security::isLogado();

$model = new MinhaConta();
$dadosPedidos = new Pedido();

$post           = $_POST;
$aDados['acao'] = $acao;

switch ($metodo)
{
    case "index":
        $dados["endereco"] = $model->getEnderecos();
        $dados["cartao"] = $model->getCartoes();

        require_once "app/view/minhaConta.php";

        break;

    case "carregaDadosEndereco":
        $dados["endereco"] = $model->getId("endereco", $_GET["id"]);

        ob_end_clean();
        echo json_encode($dados["endereco"]);
        exit;
        break;

    case "carregaDadosCartao":
        $dados["cartao"] = $model->getId("cartao", $_GET["id"]);

        ob_end_clean();
        echo json_encode($dados["cartao"]);
        exit;
        break;

    case 'updateSenha':

        if (!password_verify($post["senhaAtual"], $_SESSION["userSenha"]) || $post["novaSenha"] != $post["confirmSenha"])
        {
            $_SESSION["msgError"] = "Senhas não conferem";
            Redirect::page("Usuario/formSenha");
            break;
        }

        if ($model->updateSenha($post, $_SESSION["userId"]))
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

    case "setPill":
        $_SESSION["pill"] = $post["id"];

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

    case "informacoesPedido":

        $pedidos["dadosPedido"] = $dadosPedidos->getAllPedidos();

        require_once "app/view/informacoesPedido.php";

        break;

    case "getStatusPedido":

        $pedido = $dadosPedidos->getAllPedidos();

        ob_end_clean();

        // envia para o método JS os novos valores
        echo json_encode([
            'pedido' => $pedido
        ]);
        exit;
        break;

    case "getItens":
        $itens = $dadosPedidos->getAllItens($id);

        ob_end_clean();

        // envia para o método JS os novos valores
        echo json_encode([
            'itens' => $itens
        ]);
        exit;
        break;
}
