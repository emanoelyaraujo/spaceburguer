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
        $rsc = $this->conDb->dbInsert(
            "INSERT INTO lanche
            (id_categoria, descricao, ingredientes, preco, status)
            VALUES ( ?, ?, ?, ?, ?) ",
            [
                $dados['id_categoria'],
                $dados['descricao'],
                $dados['ingredientes'],
                $dados['preco'],
                $dados['status']
            ]
        );

        if ($rsc > 0) {
            return true;
        } else {
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
        $rsc = $this->conDb->dbUpdate(
            "UPDATE lanche 
                SET id_categoria = ?, descricao = ?, ingredientes = ?, preco = ?, status = ?
                WHERE id = ?",
            [
                $dados['id_categoria'],
                $dados['descricao'],
                $dados['ingredientes'],
                $dados['preco'],
                $dados['status'],
                $dados['id']
            ]
        );

        if ($rsc > 0) {
            return true;
        } else {
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

        if ($rsc > 0) {
            return true;
        } else {
            return false;
        }
    }

}
