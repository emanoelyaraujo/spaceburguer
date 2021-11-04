<?php

require_once 'app/model/ModelCarrinho.php';

$model = new Carrinho();

$post           = $_POST;
$aDados['acao'] = $acao;

switch ($metodo)
{
    case "addCarrinho":
        $pedidoPendente = $model->getPedidosAbertos();
        
        if (empty($pedidoPendente))
        {
            $criaPedido = $model->createPedido($post["id"]);
            $idPedido = $criaPedido;
        }
        else
        {
            $idPedido = $pedidoPendente[0]["id"];
        }

        if ($lanches = $model->adicionaLanche($idPedido, $post["id"]))
        {
            $flag = true;
        }
        else
        {
            $flag = false;
        }

        ob_end_clean();

        echo json_encode([
            'mensagem' => ($flag ? 'Lanche adicionado no carrinho' : 'Falha ao tentar adicionar lanche no carrinho'),
            'status' => $flag
        ]);
        exit;
        break;
}
