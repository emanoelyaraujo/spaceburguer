<?php

class Carrinho extends ModelBase
{
    protected $conDb = null;

    /**
     * Classe construtora
     */
    public function __construct()
    {
        $this->conDb = $this->conectaDb();
    }

    public function getLancheById($id)
    {
        $rsc = $this->conDb->dbSelect(
            "SELECT preco
            FROM lanche
            WHERE id = ?",
            [
                $id
            ]
        );

        if ($this->conDb->dbNumeroLinhas($rsc) > 0)
        {
            return $this->conDb->dbBuscaArray($rsc);
        }
        else
        {
            return [];
        }
    }

    public function createPedido()
    {
        $rsc = $this->conDb->dbInsert(
            "INSERT INTO pedido (id_usuario, valor_total, frete, forma_pagamento) VALUES (?, ?, ?, ?)",
            [
                $_SESSION["userId"],
                5,
                5,
                "D"
            ]
        );

        if ($rsc > 0)
        {
            return $rsc;
        }
        else
        {
            return 0;
        }
    }

    public function adicionaLanche($idPedido, $idLanche, $dadosPedido)
    {
        $preco = (float)implode("", $this->getLancheById($idLanche));

        $rsc = $this->conDb->dbInsert(
            "INSERT INTO itens_pedido (id_lanche, id_pedido, valor_unitario, valor_total) VALUES (?, ?, ?, ?)",
            [
                $idLanche,
                $idPedido,
                $preco,
                $preco
            ]
        );

        if ($rsc > 0)
        {
            $this->calculaTotal($preco, "+", $dadosPedido);
            return true;
        }
        else
        {
            return false;
        }
    }

    public function calculaTotal($precoLanche, $acao = "+", $dadosPedido)
    {
        $valorTotal = $dadosPedido["valor_total"];

        if ($acao == "+")
        {
            $valorTotal += $precoLanche;
        }
        else
        {
            $valorTotal -= $precoLanche;
        }

        $subtotal = $valorTotal - $dadosPedido["frete"];

        $rsc = $this->conDb->dbUpdate(
            "UPDATE pedido
            SET subtotal = ?, valor_total = ?
            WHERE id = ?",
            [
                $subtotal,
                $valorTotal,
                $dadosPedido["id"]
            ]
        );

        if ($rsc > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateLanche($post, $dadosPedido)
    {
        $valorUnitario = implode("", $this->getLancheById($post['id_lanche']));

        $rsc = $this->conDb->dbUpdate(
            "UPDATE itens_pedido
            SET quantidade = ?, valor_total = ?
            WHERE id = ?",
            [
                $post['quantidade'],
                $post['quantidade'] * $valorUnitario,
                $post['id_produto']
            ]
        );

        if ($rsc > 0)
        {
            $this->calculaTotal($valorUnitario, $post['acao'], $dadosPedido);
            return true;
        }
        else
        {
            return false;
        }
    }

    public function deleteLanche($id)
    {
        $rsc = $this->conDb->dbDelete(
            "DELETE FROM itens_pedido WHERE id = ?",
            [
                $id
            ]
        );


        if ($rsc > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function deletePedido($pedido)
    {
        $rsc = $this->conDb->dbDelete(
            "DELETE FROM pedido WHERE id = ?",
            [
                $pedido
            ]
        );

        if ($rsc > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
