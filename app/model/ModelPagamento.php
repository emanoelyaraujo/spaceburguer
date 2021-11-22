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

    /**
     * adiciona e remove o frete
     *
     * @param  string $acao
     * @param  mixed $pedido
     * @return void
     */
    public function addRemoveFrete($acao, $pedido)
    {
        // de acordo com a ação, adiciona ou remove o frete 
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

    /**
     * adiciona endereço
     *
     * @param  string $idEndereco
     * @param  array $pedido
     * @return boolean
     */
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

    /**
     * remove endereço e o cartão
     *
     * @param  mixed $pedido
     * @return boolean
     */
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

    /**
     * altera método de pagamento de acordo com a option selecionada
     *
     * @param  mixed $post
     * @param  mixed $pedido
     * @return boolean
     */
    public function metodoPag($post, $pedido)
    {
        // se o método de pagamento for cartão
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
            //  se o método for dinheiro
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

    /**
     * adiciona cartão
     *
     * @param  string $idCartao
     * @param  mixed $pedido
     * @return boolean
     */
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

    /**
     * finaliza o pedido
     *
     * @param  mixed $pedido
     * @return boolean
     */
    public function finalizaPedido($pedido)
    {
        $rsc = $this->conDb->dbUpdate(
            "UPDATE pedido
            SET status = ?, finished_at = ?
            WHERE id = ?",
            [
                "F",
                Data::dataHoraAtual(),
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


    public function getUsuarios()
    {
        $rsc = $this->conDb->dbSelect(
            "SELECT id, nome
            FROM usuario
            WHERE status != '2' AND nivel NOT IN ('1', '3')"
        );

        if ($this->conDb->dbNumeroLinhas($rsc) > 0)
        {
            return $this->conDb->dbBuscaArrayAll($rsc);
        }
        else
        {
            return [];
        }
    }

    public function addClientePedido($idCliente, $idPedido)
    {
        $rsc = $this->conDb->dbUpdate(
            "UPDATE pedido
            SET id_usuario = ?
            WHERE id = ?",
            [
                $idCliente,
                $idPedido['id']
            ]
        );

        if ($rsc > 0)
        {
            $this->finalizaPedido($idPedido);
            return true;
        }
        else
        {
            return false;
        }
    }
}
