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
    
    /**
     * cria o pedido
     *
     * @return int
     */
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
    
    /**
     * retorna todos os dados do pedido aberto 
     * OBS: o uso do left é porque quando um 
     * usuario cria o pedido, não é obrigatório 
     * colocar o endereço e o cartão
     *
     * @return array
     */
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
    
    /**
     * retorna os itens do pedido aberto
     *
     * @param  string $idPedido
     * @param  string $itemPedido
     * @return array
     */
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
    
    /**
     * retorna todos os itens de todos os pedidos, 
     * OBS: o left é porque pode acontecer de 
     * um lanche ser excluido, nesse caso ao 
     * invés da foto irá aparecer uma mensagem
     *
     * @param  string $idPedido
     * @return array
     */
    public function getAllItens($idPedido)
    {
        $rsc = $this->conDb->dbSelect(
            "SELECT p.id as id, i.quantidade, i.valor_total, l.id as idLanche, l.descricao, l.imagem
            FROM pedido AS p
            INNER JOIN itens_pedido AS i ON i.id_pedido = p.id
            LEFT JOIN lanche AS l ON i.id_lanche = l.id
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
    
    /**
     * retorna todas as informações de todos os 
     * pedidos na tela de meus pedidos
     *
     * @return array
     */
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
    
    /**
     * deleta um pedido
     *
     * @param  string $pedido
     * @return boolean
     */
    public function deletePedido($idPedido)
    {
        $rsc = $this->conDb->dbDelete(
            "DELETE FROM pedido WHERE id = ?",
            [
                $idPedido
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
