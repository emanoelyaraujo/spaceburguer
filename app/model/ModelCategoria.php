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
            (descricao, status)
            VALUES ( ?, ?) ",
            [
                $dados['descricao'],
                $dados['status'],
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
        $rsc = 1;

        $select = $this->conDb->dbSelect(
            "SELECT * FROM categoria WHERE id = ?",
            [
                $dados["id"]
            ]
        );

        $select = $this->conDb->dbBuscaArrayAll($select);

        $select = $select[0];

        $alterado = false;

        if (
            $dados["descricao"] != $select["descricao"] ||
            $dados["status"] != $select["status"]
        )
        {
            $alterado = true;
        }

        if ($alterado)
        {
            $rsc = $this->conDb->dbUpdate(
                "UPDATE categoria 
                SET descricao = ?, status = ?
                WHERE id = ?",
                [
                    $dados['descricao'],
                    $dados['status'],
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
            "DELETE FROM categoria WHERE id = ?",
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

    /**
     * getCategoriaLanche
     *
     * @param  int $id_categoria
     * @return array
     */
    public function getCategoriaLanche($id_categoria)
    {
        $rsc = $this->conDb->dbSelect(
            "SELECT id_categoria FROM lanche WHERE id_categoria = ?",
            [$id_categoria]
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
}
