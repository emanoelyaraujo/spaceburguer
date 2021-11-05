<?php

class Lanche extends ModelBase
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
     * insert
     *
     * @param array $dados 
     * @return boolean
     */
    public function insert($dados)
    {
        $preco = Numeros::strValor($dados["preco"]);

        $rsc = $this->conDb->dbInsert(
            "INSERT INTO lanche
            (id_categoria, descricao, ingredientes, preco, status)
            VALUES ( ?, ?, ?, ?, ?) ",
            [
                $dados['id_categoria'],
                $dados['descricao'],
                $dados['ingredientes'],
                $preco,
                $dados['status']
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
     * update
     *
     * @param array $dados 
     * @return boolean
     */
    public function update($dados)
    {
        $preco = Numeros::strValor($dados["preco"]);

        $rsc = 1;

        $select = $this->conDb->dbSelect(
            "SELECT * FROM lanche WHERE id = ?",
            [
                $dados["id"]
            ]
        );

        $select = $this->conDb->dbBuscaArrayAll($select);

        $select = $select[0];

        $alterado = false;

        if (
            $dados["id_categoria"] != $select["id_categoria"] ||
            $dados["descricao"] != $select["descricao"] ||
            $dados["ingredientes"] != $select["ingredientes"] ||
            $preco != $select["preco"] ||
            $dados["status"] != $select["status"] ||
            $dados["imagem"] != $select["imagem"]
        )
        {
            $alterado = true;
        }

        if ($alterado)
        {
            $rsc = $this->conDb->dbUpdate(
                "UPDATE lanche 
                SET id_categoria = ?, descricao = ?, ingredientes = ?, preco = ?, status = ?, imagem = ?
                WHERE id = ?",
                [
                    $dados['id_categoria'],
                    $dados['descricao'],
                    $dados['ingredientes'],
                    $preco,
                    $dados['status'],
                    $dados["imagem"],
                    $dados['id']
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
     * delete
     *
     * @param integer $id 
     * @return boolean
     */
    public function delete($id)
    {
        $rsc = $this->conDb->dbDelete(
            "DELETE FROM lanche WHERE id = ?",
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
