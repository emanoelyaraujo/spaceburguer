<?php

class Lanche extends ModelBase
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
    public function insert($dados, $arquivo)
    {
        if (Uploads::upload($arquivo, 'lanches'))
        {
            // tipos permitidos
            $preco = Numeros::strValor($dados["preco"]);

            $rsc = $this->conDb->dbInsert(
                "INSERT INTO lanche
            (id_categoria, descricao, ingredientes, preco, imagem)
            VALUES ( ?, ?, ?, ?, ?) ",
                [
                    $dados['id_categoria'],
                    $dados['descricao'],
                    $dados['ingredientes'],
                    $preco,
                    $arquivo['imagem']['name']
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
    public function update($dados, $arquivo)
    {
        $nomeArquivo = "";

        // se foi anexada alguma imagem
        if (!empty($arquivo['imagem']['name']))
        {

            /*envia para o método de upload o $_FILES, a pasta 
            para salvar o arquivo e o nome do arquivo antigo*/
            Uploads::upload($arquivo, 'lanches', $dados['nomeImagem']);
            $nomeArquivo = $arquivo['imagem']['name'];
        }
        else
        {
            $nomeArquivo = $dados['nomeImagem'];
        }

        $preco = Numeros::strValor($dados["preco"]);

        $rsc = 1;

        $select = $this->conDb->dbSelect(
            "SELECT * FROM lanche WHERE id = ?",
            [
                $dados["id"]
            ]
        );

        $select = $this->conDb->dbBuscaArrayAll($select);

        $select = $select[0];

        $alterado = false;

        if (
            $dados["id_categoria"] != $select["id_categoria"] ||
            $dados["descricao"] != $select["descricao"] ||
            $dados["ingredientes"] != $select["ingredientes"] ||
            $preco != $select["preco"] ||
            $dados["status"] != $select["status"] ||
            $nomeArquivo != $select["imagem"]
        )
        {
            $alterado = true;
        }

        if ($alterado)
        {
            $rsc = $this->conDb->dbUpdate(
                "UPDATE lanche 
                SET id_categoria = ?, descricao = ?, ingredientes = ?, preco = ?, status = ?, imagem = ?
                WHERE id = ?",
                [
                    $dados['id_categoria'],
                    $dados['descricao'],
                    $dados['ingredientes'],
                    $preco,
                    $dados['status'],
                    $nomeArquivo,
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
    public function delete($id, $nomeImagem)
    {
        $rsc = $this->conDb->dbDelete(
            "DELETE FROM lanche WHERE id = ?",
            [
                $id
            ]
        );

        if ($rsc > 0)
        {
            // remove o arquivo fisico no servidor
            unlink("uploads/lanches/" . $nomeImagem);
            return true;
        }
        else
        {
            return false;
        }
    }
}
