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

    /**
     * busca todos os getEnderecos
     *
     * @return array
     */
    public function getEnderecos()
    {
        $rscTable = $this->conDb->dbSelect(
            "SELECT * FROM endereco WHERE id_usuario = ? AND deleted_at is null",
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

    /**
     * getCartoes
     *
     * @return array
     */
    public function getCartoes()
    {
        $rscTable = $this->conDb->dbSelect(
            "SELECT * 
            FROM cartao 
            WHERE id_usuario = ?",
            [
                $_SESSION["userId"]
            ]
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

    /**
     * updateDados
     *
     * @param  mixed $dados
     * @return boolean
     */
    public function updateDados($dados, $arquivo)
    {
        $nomeArquivo = "";

        // se foi anexada alguma imagem
        if (!empty($arquivo['imagem']['name']))
        {
            /*envia para o método de upload o $_FILES, a pasta 
            para salvar o arquivo e o nome do arquivo antigo*/
            Uploads::upload($arquivo, 'usuarios', $dados['nomeImagem']);
            $nomeArquivo = $arquivo['imagem']['name'];
        }
        else
        {
            $nomeArquivo = $dados['nomeImagem'];
        }

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
            $telefone != $select["telefone"] ||
            $nomeArquivo != $select["imagem"]
        )
        {
            $alterado = true;
        }

        if ($alterado)
        {
            $rsc = $this->conDb->dbUpdate(
                "UPDATE usuario 
                        SET nome = ?, telefone = ?, email = ?, imagem = ?
                        WHERE id = ?",
                [
                    $dados['nome'],
                    $telefone,
                    $dados['email'],
                    $nomeArquivo,
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

    /**
     * updateSenha
     *
     * @param  mixed $dados
     * @return boolean
     */
    public function updateSenha($dados, $id)
    {
        $rsc = $this->conDb->dbUpdate(
            "UPDATE usuario 
                        SET senha = ?
                        WHERE id = ?",
            [
                password_hash(trim($dados['novaSenha']), PASSWORD_DEFAULT),
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
     * insertEndereco
     *
     * @param  mixed $post
     * @return boolean
     */
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

    /**
     * updateEndereco
     *
     * @param  mixed $post
     * @return boolean
     */
    public function updateEndereco($post)
    {
        $cep = str_replace("-", "", $post["cep"]);

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
            $select["cep"] != $cep ||
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
                    $cep,
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

    /**
     * preenche o campo deleted_at com a data que o endereço foi excluido, 
     * tudo isso para não não conflito caso o usuário queira ver os pedidos anteriores
     *
     * @param  int $id
     * @return boolean
     */
    public function deleteEndereco($id)
    {
        $rsc = $this->conDb->dbUpdate(
            "UPDATE endereco 
            SET deleted_at = ?
            WHERE id = ?",
            [
                Data::dataHoraAtual(),
                $_GET["id"]
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
     * insertCartao
     *
     * @param  mixed $post
     * @return boolean 
     */
    public function insertCartao($post)
    {
        $numero = str_replace(" ", "", $post["numeroCartao"]);
        $data = str_replace("-", "", $post["data"]);

        $rsc = $this->conDb->dbInsert(
            "INSERT INTO cartao 
            (id_usuario, numero, nome, cvv, data_vencimento, tipo)
            VALUES (?, ?, ?, ?, ?, ?)",
            [
                $_SESSION["userId"],
                $numero,
                $post["nomeCartao"],
                password_hash($post["cvv"], PASSWORD_DEFAULT),
                $data,
                $post["tipo"]

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
     * updateCartao
     *
     * @param  mixed $post
     * @return boolean
     */
    public function updateCartao($post)
    {
        $numero = str_replace(" ", "", $post["numeroCartao"]);
        $data = str_replace("-", "", $post["data"]);
        $rsc = 1;

        $select = $this->conDb->dbSelect(
            "SELECT * 
            FROM cartao 
            WHERE id = ?",
            [
                $_GET["id"]
            ]
        );

        $select = $this->conDb->dbBuscaArrayAll($select);

        $select = $select[0];

        $alterado = false;

        if (
            $select["numero"] != $numero ||
            $select["nome"] != $post['nomeCartao'] ||
            $select["data_vencimento"] != $data ||
            $select["tipo"] != $post["tipo"]
        )
        {
            $alterado = true;
        }

        if ($alterado)
        {
            $rsc = $this->conDb->dbUpdate(
                "UPDATE cartao 
                SET numero = ?, nome = ?,  data_vencimento = ?, tipo = ?
                WHERE id = ?",
                [
                    $numero,
                    $post["nomeCartao"],
                    $data,
                    $post["tipo"],
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

    /**
     * deleta o cartao com o id que foi enviado no $_GET pelo JS
     *
     * @return boolean
     */
    public function deleteCartao()
    {
        $rsc = $this->conDb->dbDelete(
            "DELETE FROM cartao 
            WHERE id = ?",
            [
                $_GET['id']
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
