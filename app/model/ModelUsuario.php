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
                    "deliveryspaceburguer@gmail.com",
                    password_hash("adm@2021", PASSWORD_DEFAULT),
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

    /**
     * inserir usuario
     *
     * @param array $dados 
     * @return boolean
     */
    public function insert($dados)
    {
        if (isset($dados['nivel']))
        {
            $nivel = $dados['nivel'];
            $status = $dados['status'];
        }
        else
        {
            $nivel = 2;
            $status = 1;
        }
        $telefone = str_replace("(", "", str_replace(")", "", str_replace("-", "", $dados['telefone'])));

        $rsc = $this->conDb->dbInsert(
            "INSERT INTO usuario
            (nome, email, telefone, senha, nivel, status)
            VALUES ( ?, ?, ?, ?, ?, ?) ",
            [
                $dados['nome'],
                $dados['email'],
                $telefone,
                password_hash(trim($dados['senha']), PASSWORD_DEFAULT),
                $nivel,
                $status
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
     * atualizar os dados
     *
     * @param array $dados 
     * @return boolean
     */
    public function update($dados)
    {
        $telefone = str_replace("(", "", str_replace(")", "", str_replace("-", "", $dados['telefone'])));

        $rsc = 1;

        $select = $this->conDb->dbSelect(
            "SELECT * FROM usuario WHERE id = ?",
            [
                $dados["id"]
            ]
        );

        $select = $this->conDb->dbBuscaArrayAll($select);

        $select = $select[0];

        $alterado = false;

        if (
            $dados["nome"] != $select["nome"] ||
            $dados["status"] != $select["status"] ||
            $dados["email"] != $select["email"] ||
            $telefone != $select["telefone"] ||
            $dados["nivel"] != $select["nivel"] ||
            !empty($dados['senha'])
        )
        {
            $alterado = true;
        }

        if ($alterado)
        {
            if (!empty($dados['senha']))
            {
                $rsc = $this->conDb->dbUpdate(
                    "UPDATE usuario 
                        SET nome = ?, telefone = ?, email = ?, status = ?, nivel = ?, senha = ?
                        WHERE id = ?",
                    [
                        $dados['nome'],
                        $telefone,
                        $dados['email'],
                        $dados['status'],
                        $dados['nivel'],
                        password_hash($dados['senha'], PASSWORD_DEFAULT),
                        $dados['id']
                    ]
                );
            }
            else
            {
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

    /**
     * deletar os dados
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

    /**
     * atualiza o codigo gerado para atualizar a senha
     *
     * @param  string $codigo
     * @param  string $id
     * @return void
     */
    public function updateCodigo($codigo, $id)
    {
        $rsc = $this->conDb->dbUpdate(
            "UPDATE usuario 
            SET codVerificacao = ?
            WHERE id = ?",
            [
                $codigo,
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
