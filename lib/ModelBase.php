<?php

class ModelBase
{
    /**
     * Cria uma conexão com a base de dados
     *
     * @return object
     */
    public function conectaDb()
    {
        return new Database(
            DB_TYPE,
            DB_HOST,
            DB_PORT,
            DB_USER,
            DB_PASSWORD,
            DB_BDADOS
        );
    }

    /**
     * getLista
     *
     * @param string $table 
     * @param string $orderBy 
     * @return array
     */
    public function getLista($table, $orderBy = 'nome')
    {
        $rscTable = $this->conDb->dbSelect("SELECT * FROM {$table} ORDER BY {$orderBy}");

        if ($this->conDb->dbNumeroLinhas($rscTable) > 0)
        {
            return $this->conDb->dbBuscaArrayAll($rscTable);
        }
        else
        {
            return [];
        }
    }

    /**
     * getId
     *
     * @param string $table 
     * @param integer $id 
     * @return array
     */
    public function getId($table, $id)
    {
        $rsc = $this->conDb->dbSelect(
            "SELECT * FROM {$table} WHERE id = ?",
            [$id]
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
