<?php

class Usuario extends ModelBase
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
     * Retornar o usuário para o e-mail especificado em $email
     *
     * @param string $email 
     * @return array
     */
    public function getUserEmail($email)
    {
        $rscUser = $this->conDb->dbSelect(
            "SELECT * FROM usuario WHERE email = ?",
            [$email]
        );

        if ($this->conDb->dbNumeroLinhas($rscUser) > 0)
        {
            return $this->conDb->dbBuscaArray($rscUser);
        }
        else
        {
            return [];
        }
    }

    /**
     * Cria um super user na tabela de usuários
     *
     * @return integer // 0=Se não incluir o super user; 1=Se incluir com sucesso 2=Se já exibir usários
     */
    public function criaSuperUser()
    {
        $rscUser = $this->conDb->dbselect("SELECT COUNT(*) AS QTD FROM usuario");
        $rs      = $this->conDb->dbBuscaDados($rscUser);

        if ($rs->QTD == 0)
        {

            // criando o super usuário

            $rsUsuario = $this->conDb->dbInsert(
                "INSERT INTO usuario
                    (nome, telefone, email, senha, nivel)
                    VALUES( ?, ?, ?, ?, ? ) ",
                array(
                    "administrador",
                    "0000",
                    "adm@spaceburguer.com.br",
                    password_hash("fasm@2021", PASSWORD_DEFAULT),
                    1
                )
            );

            if ($rsUsuario > 0)
            {
                $_SESSION['msgSucesso'] = "Super usuário criado com sucesso.";
                return 2;
            }
            else
            {
                $_SESSION['msgError'] = "Falha na inclusão do super usuário, não é possivel prosseguir.";
                return 1;
            }
        }

        return 0;
    }

    public function insertUser($post)
    {
        
        $rsc = $this->conDb->dbInsert(
            "INSERT INTO usuario
                    (nome, telefone, email, senha, nivel)
                    VALUES(?, ?, ?, ?, ?)",
            [
                $post["nome"],
                $post["telefone"],
                $post["email"],
                password_hash($post["senha"], PASSWORD_DEFAULT),
                2
            ]
        );

        if ($rsc > 0)
        {
            $_SESSION['msgSucesso'] = "Usuário criado com sucesso.";
            return 2;
        }
        else
        {
            $_SESSION['msgError'] = "Falha na inclusão do usuário, não é possivel prosseguir.";
            return 1;
        }
    }

    /**
     * insert
     *
     * @param array $dados 
     * @return boolean
     */
    public function insert($dados)
    {
        $telefone = trim(str_replace("(",")","-", $dados['telefone']));

        $rsc = $this->conDb->dbInsert(
            "INSERT INTO usuario
            (nome, telefone, email, status, nivel, senha)
            VALUES ( ?, ?, ?, ?, ?, ?) ",
            [
                $dados['nome'],
                $telefone,
                $dados['email'],
                $dados['status'],
                $dados['nivel'],
                password_hash(trim($dados['senha']), PASSWORD_DEFAULT)
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
        $telefone = $dados['telefone'];
        //var_dump($telefone);exit; //debug pronto para testar máscara


        $rsc = $this->conDb->dbUpdate(
            "UPDATE usuario 
                SET nome = ?, telefone = ?, email = ?, status = ?, nivel = ?
                WHERE id = ?",
            [
                $dados['nome'],
                $telefone,
                $dados['email'],
                $dados['status'],
                $dados['nivel'],
                $dados['id']
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
     * delete
     *
     * @param integer $id 
     * @return boolean
     */
    public function delete($id)
    {
        $rsc = $this->conDb->dbDelete(
            "DELETE FROM usuario WHERE id = ?",
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
