<?php

class HomeAdmin extends ModelBase
{
    protected $conDb = null;

    /**
     * Classe construtora
     */
    public function __construct()
    {
        $this->conDb = $this->conectaDb();
    }

    public function getEntregadores()
    {
        $rsc = $this->conDb->dbSelect(
            "SELECT id, nome, email
            FROM usuario
            WHERE nivel = '3' AND status = '1'"
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

    public function getPedidoByStatus()
    {
        $rsc = $this->conDb->dbSelect(
            "SELECT p.*, u.nome
            FROM pedido as p
            LEFT JOIN usuario as u ON p.id_usuario = u.id
            WHERE p.status in ('F', 'C', 'E') AND (DATE(p.finished_at) = CURDATE() OR*/ p.status = 'F')
            ORDER BY p.finished_at desc"
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

    public function updateStatusPedido($get)
    {
        $status = '';
        if (isset($get['btnEnviar']))
        {
            $status = "C";
        }
        else if (isset($get['btnEntregue']))
        {
            $status = "E";
        }

        $rsc = $this->conDb->dbUpdate(
            "UPDATE pedido
            SET status = ?
            WHERE id = ?",
            [
                $status,
                $get['id']
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

    public function deletePedido($id)
    {
        $rsc = $this->conDb->dbDelete(
            "DELETE FROM pedido 
            WHERE id = ?",
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

    public function addMotoboy($post)
    {
        $rsc = $this->conDb->dbUpdate(
            "UPDATE pedido
            SET id_motoboy = ?, status = ?
            WHERE id = ?",
            [
                $post['entregador'],
                "C",
                $post['idPedido']
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
