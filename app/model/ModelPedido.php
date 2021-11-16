<?php

class Pedido extends ModelBase
{
    protected $conDb = null;

    /**
     * Classe construtora
     */
    public function __construct()
    {
        $this->conDb = $this->conectaDb();
    }

    public function getPedidoAberto()
    {
        $rsc = $this->conDb->dbSelect(
            "SELECT p.*, e.rua, e.numero, e.bairro, e.cep, c.nome as nomeCartao, c.numero as numeroCartao
            FROM pedido AS p
            LEFT JOIN endereco AS e ON e.id = p.id_endereco
            LEFT JOIN cartao AS c ON c.id = p.id_cartao
            WHERE p.id_usuario = ? AND p.status = 'A'",
            [
                $_SESSION["userId"]
            ]
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

    public function getItensPedidoAberto($idPedido, $itemPedido = "")
    {
        $rsc = $this->conDb->dbSelect(
            "SELECT p.subtotal, p.valor_total as total_pedido, p.frete, 
                i.id as id, l.id as idLanche, i.id_pedido, i.quantidade,i.valor_total, 
                l.descricao, l.ingredientes, l.imagem
            FROM pedido AS p
            INNER JOIN itens_pedido AS i ON i.id_pedido = p.id
            INNER JOIN lanche AS l ON i.id_lanche = l.id
            WHERE " . (empty($itemPedido) ? "p.id" : "i.id") . " = ?",
            [
                (empty($itemPedido) ? $idPedido : $itemPedido)
            ]
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

    public function getAllItens($idPedido)
    {
        $rsc = $this->conDb->dbSelect(
            "SELECT p.id as id, i.quantidade, i.valor_total, l.id as idLanche, l.descricao, l.imagem
            FROM pedido AS p
            INNER JOIN itens_pedido AS i ON i.id_pedido = p.id
            INNER JOIN lanche AS l ON i.id_lanche = l.id
            WHERE p.status <> 'A' AND p.id_usuario = ? AND id_pedido = ?",
            [
                $_SESSION["userId"],
                $idPedido
            ]
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

    public function getAllPedidos()
    {
        $rsc = $this->conDb->dbSelect(
            "SELECT p.*, e.rua, e.numero, e.bairro, e.cep
            FROM pedido AS p
            LEFT JOIN endereco AS e ON e.id = p.id_endereco
            WHERE p.status <> 'A' AND p.id_usuario = ?
            ORDER BY p.id desc",
            [
                $_SESSION["userId"]
            ]
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
}
