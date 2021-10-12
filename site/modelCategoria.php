<?php

class Categoria extends ModelBase
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
            "INSERT INTO categoria
            (descricao, imagem, status)
            VALUES ( ?, ?, ?) ",
            [
                $dados['descricao'],
                $dados['imagem'],
                $dados['status'],
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
            "UPDATE categoria 
                SET descricao = ?, imagem = ?, status = ?
                WHERE id = ?",
            [
                $dados['descricao'],
                $dados['imagem'],
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
            "DELETE FROM categoria WHERE id = ?",
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
