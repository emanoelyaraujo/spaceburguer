<?php

require_once 'app/model/ModelCarrinho.php';
require_once 'app/model/ModelMinhaConta.php';

$model = new Carrinho();
$endereco = new MinhaConta();

$post           = $_POST;
$aDados['acao'] = $acao;

switch ($metodo)
{
    case "index":
        $pedido["dadosPedido"] = $model->getPedidoAberto();
        @$pedido["itensPedido"] = $model->getItensCarrinho($pedido["dadosPedido"][0]["id"]);

        require_once "app/view/carrinho.php";
        break;

    case "pagamento":
        $pedido["enderecosUser"] = $endereco->getEnderecos();
        $pedido["cartoesUser"] = $endereco->getCartoes();
        $pedido["dadosPedido"] = $model->getPedidoAberto();
        $pedido["itensPedido"] = $model->getItensCarrinho($pedido["dadosPedido"][0]["id"]);

        require_once "app/view/pagamento.php";
        break;

    case "addCarrinho":

        $pedidoPendente = $model->getPedidoAberto();

        if (empty($pedidoPendente))
        {
            $criaPedido = $model->createPedido();

            // se foi criado o pedido, o idPedido será armazenado com ele 
            $idPedido = $criaPedido;
        }
        else
        {
            // caso já tenha o pedido aberto, pega o id dele
            $idPedido = $pedidoPendente[0]["id"];
        }

        // adiciona o primeiro lanche escolhido
        if ($lanches = $model->adicionaLanche($idPedido, $post["id"]))
        {
            $flag = true;
        }
        else
        {
            $flag = false;
        }

        // limpa o buffer
        ob_end_clean();

        // envia para o método JS a mensagem a ser mostrada na tela através do Toasts
        echo json_encode([
            'mensagem' => ($flag ? 'Lanche adicionado no carrinho' : 'Falha ao tentar adicionar lanche no carrinho'),
            'status' => $flag
        ]);
        exit;
        break;

    case "updateQuantidade":

        // atualiza a quantidade em cada item
        $model->updateLanche($post);

        // busca os dados do lanche que a quantidade foi alterada
        $pedido = $model->getItensCarrinho(0, $post["id_produto"]);

        // limpa o buffer de saida
        ob_end_clean();

        // envia para o método JS os novos valores
        echo json_encode([
            'totalProduto' => $pedido[0]["valor_total"],
            'subtotal' => $pedido[0]["subtotal"],
            'total' => $pedido[0]["total_pedido"]
        ]);
        exit;
        break;

    case "deleteItem":

        // busca no banco os dados do pedido a ser excluido
        $item = $model->getItensCarrinho(0, $id)[0];

        if ($model->deleteLanche($id))
        {
            if (count($model->getItensCarrinho($item["id_pedido"])) > 0)
            {
                // recalcula o total, valorTotalPedido - valorTotalItem
                $model->calculaTotal($item["valor_total"], "-");

                $_SESSION['msgSucesso'] = 'Item removido com sucesso.';
            }
            else
            {
                // se o carrinho não tiver mais pedidos, exclui o pedido
                $model->deletePedido($item["id_pedido"]);
            }
        }
        else
        {
            $_SESSION['msgSucesso'] = 'Falha ao tentar remover item do carrinho.';
        }

        Redirect::Page("Carrinho/index");
        break;

    case "frete":

        if ($model->addRemoveFrete($post["acao"]))
        {
            $flag = true;
        }
        else
        {
            $flag = false;
        }

        // limpa o buffer
        ob_end_clean();

        $pedido = $model->getPedidoAberto()[0];

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
        
        if ($model->addEndereco($post["idEndereco"]))
        {
            $flag = true;
        }
        else
        {
            $flag = false;
        }

        // limpa o buffer
        ob_end_clean();

        $endereco = $model->getEnderecoById($post["idEndereco"]);

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
}
