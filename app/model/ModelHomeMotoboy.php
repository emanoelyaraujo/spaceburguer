<?php

class HomeMotoboy extends ModelBase
{
    protected $conDb = null;

    /**
     * Classe construtora
     */
    public function __construct()
    {
        $this->conDb = $this->conectaDb();
    }

    public function getEntregas()
    {
        $rsc = $this->conDb->dbSelect(
            "SELECT p.*, u.nome
            FROM pedido as p
            LEFT JOIN usuario as u ON p.id_usuario = u.id
            WHERE p.status in ('F', 'C', 'E') AND p.id_motoboy = ?
            ORDER BY p.finished_at desc",
            [
                $_SESSION['userId']
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
}
