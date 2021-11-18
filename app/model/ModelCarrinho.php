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
    
    /**
     * retorna o preço do lanche de acordo com a Id
     *
     * @param  string $id
     * @return array
     */
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
    
    /**
     * adiciona o lanche no carrinho
     *
     * @param  string $idPedido
     * @param  string $idLanche
     * @param  mixed $dadosPedido
     * @return boolean
     */
    public function adicionaLanche($idPedido, $idLanche, $dadosPedido)
    {
        // pega o preço do lanche selecionado
        $preco = (float)implode("", $this->getLancheById($idLanche));

        $rsc = $this->conDb->dbInsert(
            "INSERT INTO itens_pedido 
            (id_lanche, id_pedido, valor_unitario, valor_total) 
            VALUES (?, ?, ?, ?)",
            [
                $idLanche,
                $idPedido,
                $preco,
                $preco
            ]
        );

        if ($rsc > 0)
        {
            /* se deu tudo certo, calcula o novo valor passando o 
            preço do lanche a ser somado, o operador e os dados do pedido*/
            $this->calculaTotal($preco, "+", $dadosPedido);
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * calculaTotal
     *
     * @param  string $precoLanche
     * @param  string $acao
     * @param  mixed $dadosPedido
     * @return boolean
     */
    public function calculaTotal($precoLanche, $acao = "+", $dadosPedido)
    {
        $valorTotal = $dadosPedido["valor_total"];

        // verifica a opração
        if ($acao == "+")
        {
            $valorTotal += $precoLanche;
        }
        else
        {
            $valorTotal -= $precoLanche;
        }

        // o subtotal sempre vai receber o total - o frete
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
    
    /**
     * atualiza a quantidade do lanche
     *
     * @param  mixed $post
     * @param  mixed $dadosPedido
     * @return boolean
     */
    public function updateLanche($post, $dadosPedido)
    {
        // pega o valor unitário do lanche e multiplica pela quantidade
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
            //  se deu tudo certo, atualiza o calculo do total
            $this->calculaTotal($valorUnitario, $post['acao'], $dadosPedido);
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * deleta o lanche
     *
     * @param  string $id
     * @return boolean
     */
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
}
