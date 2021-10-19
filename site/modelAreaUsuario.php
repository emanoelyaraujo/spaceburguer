<?php

class AreaUsuario extends ModelBase
{
    protected $conDb = null;

    /**
     * Classe construtora
     */
    public function __construct()
    {
        $this->conDb = $this->conectaDb();
    }

    public function update($dados)
    {
        $telefone = str_replace("(", "", str_replace(")", "", str_replace("-", "", $dados['telefone'])));

        $rsc = 1;

        $select = $this->conDb->dbSelect(
            "SELECT * FROM usuario WHERE id = ?",
            [
                $_SESSION["userId"]
            ]
        );

        $select = $this->conDb->dbBuscaArrayAll($select);

        $select = $select[0];

        $alterado = false;

        if (
            $select["nome"] != $dados["nome"] ||
            $select["email"] != $dados["email"] ||
            $telefone != $select["telefone"]
        )
        {
            $alterado = true;
        }

        if ($alterado)
        {
            if (!isset($dados["confirmSenha"]))
            {
                $rsc = $this->conDb->dbUpdate(
                    "UPDATE usuario 
                        SET nome = ?, telefone = ?, email = ?
                        WHERE id = ?",
                    [
                        $dados['nome'],
                        $telefone,
                        $dados['email'],
                        $_SESSION["userId"]
                    ]
                );
            }
            else
            {
                $rsc = $this->conDb->dbUpdate(
                    "UPDATE usuario 
                        SET senha = ?
                        WHERE id = ?",
                    [
                        password_hash(trim($dados['senha']), PASSWORD_DEFAULT),
                        $_SESSION["userId"]
                    ]
                );
            }
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
}
