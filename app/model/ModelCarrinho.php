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

    public function getItensCarrinho($idPedido, $itemPedido = "")
    {
        $rsc = $this->conDb->dbSelect(
            "SELECT i.id as id, l.id as idLanche, i.id_pedido, i.quantidade,i.valor_total, 
                l.descricao, l.ingredientes, l.imagem, p.subtotal, p.valor_total as total_pedido, p.frete
            FROM itens_pedido AS i
            INNER JOIN lanche AS l ON i.id_lanche = l.id
            INNER JOIN pedido AS p ON i.id_pedido = p.id
            WHERE " . (empty($itemPedido) ? "id_pedido" : "i.id") . " = ?",
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

    public function adicionaLanche($idPedido, $idLanche)
    {
        $preco = implode("", $this->getLancheById($idLanche));

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
            $this->calculaTotal($preco);
            return true;
        }
        else
        {
            return false;
        }
    }

    public function calculaTotal($precoLanche, $acao = "+")
    {
        $dadosPedido = $this->getPedidoAberto()[0];
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

    public function updateLanche($post)
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
            $rsc2 = $this->calculaTotal($valorUnitario, $post['acao']);
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