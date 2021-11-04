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
            $this->calculaTotal($idPedido, $preco);
            return true;
        }
        else
        {
            return false;
        }
    }

    public function calculaTotal($idPedido, $precoLanche)
    {
        $dadosPedido = $this->getPedidosAbertos()[0];
        $valorTotal = $dadosPedido["valor_total"];
        $valorTotal += $precoLanche;

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
