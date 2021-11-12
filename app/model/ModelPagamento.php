<?php

class Pagamento extends ModelBase
{
    protected $conDb = null;

    /**
     * Classe construtora
     */
    public function __construct()
    {
        $this->conDb = $this->conectaDb();
    }

    public function addRemoveFrete($acao, $pedido)
    {

        if ($acao == "-")
        {
            $frete = 0;
            $valorTotal = $pedido["valor_total"] - $pedido["frete"];
        }
        else
        {
            $frete = 5;
            $valorTotal = $pedido["valor_total"] + $frete;
        }

        $rsc = $this->conDb->dbUpdate(
            "UPDATE pedido
            SET valor_total = ?, frete = ?
            WHERE id = ?",
            [
                $valorTotal,
                $frete,
                $pedido["id"]
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

    public function addEndereco($idEndereco, $pedido)
    {

        $rsc = $this->conDb->dbUpdate(
            "UPDATE pedido
            SET id_endereco = ?
            WHERE id = ?",
            [
                $idEndereco,
                $pedido["id"]
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

    public function removeEnderecoCartao($pedido)
    {

        $rsc = $this->conDb->dbUpdate(
            "UPDATE pedido
            SET id_endereco = ?, id_cartao = ?
            WHERE id = ?",
            [
                null,
                null,
                $pedido["id"]
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

    public function metodoPag($post, $pedido)
    {

        if ($post["metodo"] == "C")
        {
            $rsc = $this->conDb->dbUpdate(
                "UPDATE pedido
                SET forma_pagamento = ?
                WHERE id = ?",
                [
                    $post["metodo"],
                    $pedido["id"]
                ]
            );
        }
        else
        {
            $rsc = $this->conDb->dbUpdate(
                "UPDATE pedido
                SET id_cartao = ?, forma_pagamento = ?
                WHERE id = ?",
                [
                    null,
                    $post["metodo"],
                    $pedido["id"]
                ]
            );
        }



        if ($rsc > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function addCartao($idCartao, $pedido)
    {

        $rsc = $this->conDb->dbUpdate(
            "UPDATE pedido
            SET id_cartao = ?
            WHERE id = ?",
            [
                $idCartao,
                $pedido["id"]
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

    public function finalizaPedido($pedido)
    {
        $rsc = $this->conDb->dbUpdate(
            "UPDATE pedido
            SET status = ?
            WHERE id = ?",
            [
                "F",
                $pedido["id"]
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
