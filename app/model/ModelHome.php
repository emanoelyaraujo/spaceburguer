<?php

class Home extends ModelBase
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
     * busca todos os lanches que possuem o status diferente de inativo
     *
     * @return array
     */
    public function getLanches()
    {
        $rsc = $this->conDb->dbSelect(
            "SELECT l.id, c.descricao as categoria, l.descricao as descricao, l.preco, l.created_at, l.imagem
            FROM lanche as l
            INNER JOIN categoria as c on l.id_categoria = c.id
            WHERE l.status != '2'
            ORDER BY c.descricao asc"
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
}
