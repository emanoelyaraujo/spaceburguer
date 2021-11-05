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

    public function getPedidosAbertos()
    {
        $rsc = $this->conDb->dbSelect(
            "SELECT * FROM pedido WHERE id_usuario = ? AND status = 'A'",
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
            "SELECT i.id as id, l.id as idLanche, i.id_pedido, i.valor_total, l.descricao, l.imagem, p.valor_total as total_pedido
            FROM itens_pedido AS i
            INNER JOIN lanche AS l ON i.id_lanche = l.id
            INNER JOIN pedido AS p ON i.id_pedido = p.id
            WHERE ". (empty($itemPedido) ? "id_pedido" : "i.id") ." = ?",
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

    public function createPedido()
    {
        $rsc = $this->conDb->dbInsert(
            "INSERT INTO pedido (id_usuario) VALUES (?)",
            [
                $_SESSION["userId"]
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

    public function calculaTotal($precoLanche, $acao = "+")
    {
        $dadosPedido = $this->getPedidosAbertos()[0];
        $valorTotal = $dadosPedido["valor_total"];

        if ($acao == "+")
        {
            $valorTotal += $precoLanche;
        }
        else
        {
            $valorTotal -= $precoLanche;
        }

        $rsc = $this->conDb->dbUpdate(
            "UPDATE pedido
            SET valor_total = ?
            WHERE id = ?",
            [
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
}
