<?php

class MinhaConta extends ModelBase
{
    protected $conDb = null;

    /**
     * Classe construtora
     */
    public function __construct()
    {
        $this->conDb = $this->conectaDb();
    }

    public function getEnderecos()
    {
        $rscTable = $this->conDb->dbSelect(
            "SELECT * FROM endereco WHERE id_usuario = ?",
            [$_SESSION["userId"]]
        );

        if ($this->conDb->dbNumeroLinhas($rscTable) > 0)
        {
            return $this->conDb->dbBuscaArrayAll($rscTable);
        }
        else
        {
            return [];
        }
    }

    public function updateDados($dados)
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

        if ($rsc > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateSenha($dados)
    {

        $rsc = $this->conDb->dbUpdate(
            "UPDATE usuario 
                        SET senha = ?
                        WHERE id = ?",
            [
                password_hash(trim($dados['novaSenha']), PASSWORD_DEFAULT),
                $_SESSION["userId"]
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

    public function insertEndereco($post)
    {
        $cep = str_replace("-", "", $post["cep"]);

        $rsc = $this->conDb->dbInsert(
            "INSERT INTO endereco 
            (id_usuario, nomeEndereco, cep, rua, bairro, numero, complemento)
            VALUES (?, ?, ?, ?, ?, ?, ?)",
            [
                $_SESSION["userId"],
                $post["nomeEndereco"],
                $cep,
                $post["rua"],
                $post["bairro"],
                $post["numero"],
                $post["complemento"]
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

    public function updateEndereco($post)
    {
        $rsc = 1;

        $select = $this->conDb->dbSelect(
            "SELECT * FROM endereco WHERE id = ?",
            [
                $_GET["id"]
            ]
        );

        $select = $this->conDb->dbBuscaArrayAll($select);

        $select = $select[0];

        $alterado = false;

        if (
            $select["nomeEndereco"] != $post["nomeEndereco"] ||
            $select["cep"] != $post["cep"] ||
            $select["rua"] != $post["rua"] ||
            $select["bairro"] != $post["bairro"] ||
            $select["numero"] != $post["numero"] ||
            $select["complemento"] != $post["complemento"]
         )
        {
            $alterado = true;
        }

        if ($alterado)
        {
            $rsc = $this->conDb->dbUpdate(
                "UPDATE endereco 
                SET nomeEndereco = ?, cep = ?, rua = ?, bairro = ?, numero = ?, complemento = ?
                WHERE id = ?",
                [
                    $post["nomeEndereco"],
                    $post["cep"],
                    $post["rua"],
                    $post["bairro"],
                    $post["numero"],
                    $post["complemento"],
                    $_GET["id"]
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

    public function deleteEndereco($id)
    {
        $rsc = $this->conDb->dbUpdate(
            "UPDATE endereco 
            SET deleted_at = 
            WHERE id = ?",
            [
                $post["nomeEndereco"],
                $post["cep"],
                $post["rua"],
                $post["bairro"],
                $post["numero"],
                $post["complemento"],
                $_GET["id"]
            ]
        );
    }
}
