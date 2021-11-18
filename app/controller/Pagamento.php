<?php

require_once 'app/model/ModelCarrinho.php';
require_once 'app/model/ModelPagamento.php';
require_once 'app/model/ModelMinhaConta.php';
require_once 'app/model/ModelPedido.php';

$model = new Pagamento();
$carrinho = new Carrinho;
$endereco = new MinhaConta;
$request = new Pedido();

$post           = $_POST;
$aDados['acao'] = $acao;

Security::pedidoAberto($request->getPedidoAberto());

$pedidoAberto = $request->getPedidoAberto()[0];

switch ($metodo)
{
    case "index":
        $pedido["enderecosUser"] = $endereco->getEnderecos();
        $pedido["cartoesUser"] = $endereco->getCartoes();
        $pedido["dadosPedido"] = $request->getPedidoAberto()[0];
        $pedido["itensPedido"] = $request->getItensPedidoAberto($pedido["dadosPedido"]["id"]);

        require_once "app/view/pagamento.php";
        break;

    case "frete":

        // método que adiciona ou remove o frete de acordo com  a tab clicada
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

        // busca os dadosdo banco com o frete atualizado e envia para a view em forma de JSON
        $pedido = $request->getPedidoAberto()[0];

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
        // adiciona o endereço escolhido pelo usuário
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

        // busca o endereço escolhido e retona para a view em forma de JSON
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
        /* caso o usuário escolha retirar o produto 
        no estabelecimento, será removido o endereco e o cartao*/
        $model->removeEnderecoCartao($pedidoAberto);

        break;

    case "metodoPag":

        // muda o método de pagamento do pedido em aberto
        $model->metodoPag($post, $pedidoAberto);

        break;

    case "addCartao":

        // adiciona o cartão escolhido pelo usuário
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

        // pega os dados do cartão escolhido e manda para a view em forma de json
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

        // verificações antes de finalizar o pedido
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

        //  se houver erro, volta para a página de pagamento
        if ($erro)
        {
            Redirect::page("Pagamento/index");
        }
        // se não, o pedido é finalizado e redireciona para a index
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
