<?php

require_once 'app/model/ModelCarrinho.php';
require_once 'app/model/ModelPagamento.php';
require_once 'app/model/ModelMinhaConta.php';
require_once 'app/model/ModelPedido.php';

$model = new Pagamento();
$carrinho = new Carrinho;
$endereco = new MinhaConta;
$dadosPedido = new Pedido();

$post           = $_POST;
$aDados['acao'] = $acao;

Security::pedidoAberto($dadosPedido->getPedidoAberto());

$pedidoAberto = $dadosPedido->getPedidoAberto()[0];

switch ($metodo)
{
    case "index":
        $pedido["enderecosUser"] = $endereco->getEnderecos();
        $pedido["cartoesUser"] = $endereco->getCartoes();
        $pedido["dadosPedido"] = $dadosPedido->getPedidoAberto()[0];
        $pedido["itensPedido"] = $dadosPedido->getItensPedidoAberto($pedido["dadosPedido"]["id"]);

        require_once "app/view/pagamento.php";
        break;

    case "frete":

        if ($model->addRemoveFrete($post["acao"], $pedidoAberto))
        {
            $flag = true;
        }
        else
        {
            $flag = false;
        }

        // limpa o buffer
        ob_end_clean();

        $pedido = $dadosPedido->getPedidoAberto()[0];

        if ($flag)
        {
            echo json_encode([
                'frete' => $pedido["frete"],
                'total' => $pedido["valor_total"]
            ]);
        }
        exit;
        break;

    case "addEndereco":

        if ($model->addEndereco($post["idEndereco"], $pedidoAberto))
        {
            $flag = true;
        }
        else
        {
            $flag = false;
        }

        // limpa o buffer
        ob_end_clean();

        $endereco = $model->getId("endereco", $post["idEndereco"], $pedidoAberto);

        if ($flag)
        {
            echo json_encode([
                'rua' => $endereco["rua"],
                'numero' => $endereco["numero"],
                'bairro' => $endereco["bairro"],
                'cep' => $endereco["cep"]
            ]);
        }
        exit;

        break;

    case "removeEnderecoCartao":

        $model->removeEnderecoCartao($pedidoAberto);

        break;

    case "metodoPag":

        $model->metodoPag($post, $pedidoAberto);

        break;

    case "addCartao":

        if ($model->addCartao($post["idCartao"], $pedidoAberto))
        {
            $flag = true;
        }
        else
        {
            $flag = false;
        }

        // limpa o buffer
        ob_end_clean();

        $cartao = $model->getId("cartao", $post["idCartao"]);

        if ($flag)
        {
            echo json_encode([
                'nomeCartao' => $cartao["nome"],
                'numero' => "**** **** **** " . substr($cartao['numero'], 12, 16)
            ]);
        }
        exit;

        break;

    case "finalizarPedido":
        $erro = false;

        if (is_null($pedidoAberto["id_endereco"]) && ($pedidoAberto["forma_pagamento"] == "C" && !is_null($pedidoAberto["id_cartao"])))
        {
            $_SESSION["msgError"] = "Endereço obrigatório";
            $erro = true;
        }

        if (!is_null($pedidoAberto["id_endereco"]) && ($pedidoAberto["forma_pagamento"] == "C" && is_null($pedidoAberto["id_cartao"])))
        {
            $_SESSION["msgError"] = "Selecione um cartão ou<br>altere a forma de pagamento";
            $erro = true;
        }

        if ($erro)
        {
            Redirect::page("Pagamento/index");
        }
        else
        {
            if ($model->finalizaPedido($pedidoAberto))
            {
                $_SESSION["msgSucesso"] = "Pedido finalizado com sucesso!";
                Redirect::page("Home/index");
            }
            else
            {
                $_SESSION["msgSucesso"] = "Falha ao finalizar pedido";
                Redirect::page("Pagamento/index");
            }
        }

        break;
}
