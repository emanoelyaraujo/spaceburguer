<?php

require_once 'app/model/ModelPedido.php';

Security::isLogado();
Security::isAUser2();

$model = new Pedido();

$post           = $_POST;
$aDados['acao'] = $acao;

switch ($metodo)
{
    case "index":

        $pedidos["dadosPedido"] = $model->getAllPedidos();

        require_once "app/view/informacoesPedido.php";

        break;

    case "getStatusPedido":
        // pega todos os pedidos retornados do banco e envia para a view em forma de JSON
        $pedido = $model->getAllPedidos();

        ob_end_clean();

        // envia para o método JS os novos valores
        echo json_encode([
            'pedido' => $pedido
        ]);
        exit;
        break;

    case "getItens":
        // pega todos os itens retornados do banco e envia para a view em forma de JSON
        $itens = $model->getAllItens($id);

        foreach($itens as $key => $i){
            $itens[$key]['imagem'] = SITE_URL . "uploads/lanches/" . $i['imagem'];
        }
        
        ob_end_clean();

        // envia para o método JS os novos valores
        echo json_encode([
            'itens' => $itens
        ]);
        exit;
        break;

    case "cancelarPedido":

        if ($model->deletePedido($id))
        {
            $_SESSION['msgSucesso'] = "Pedido cancelado com sucesso!";
        }
        else
        {
            $_SESSION["msgError"] = "Falha ao cancelar pedido.";
        }

        Redirect::Page("Pedido/index");

        break;
}
