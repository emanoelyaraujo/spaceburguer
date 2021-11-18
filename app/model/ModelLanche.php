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
     * insere lanche
     *
     * @param array $dados 
     * @return boolean
     */
    public function insert($dados, $arquivo)
    {
        // pega o nome com codigo aleatorio gerado pela lib 
        $nomeRetornado = Uploads::upload($arquivo, 'lanches');

        // se não for boolean, significa que está tudo OK
        if (!is_bool($nomeRetornado))
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
                    $nomeRetornado
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
     * atualiza lanche
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
            $nomeArquivo = Uploads::upload($arquivo, 'lanches', $dados['nomeImagem']);;
        }
        else
        {
            $nomeArquivo = $dados['nomeImagem'];
        }

        $preco = Numeros::strValor($dados["preco"]);

        $rsc = 1;

        // faz um select no banco com os antigos dados
        $select = $this->conDb->dbSelect(
            "SELECT * FROM lanche WHERE id = ?",
            [
                $dados["id"]
            ]
        );

        $select = $this->conDb->dbBuscaArrayAll($select);

        $select = $select[0];

        $alterado = false;

        // verifica se algo foi alterado 
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
     * deleta lanche
     *
     * @param string $id 
     * @param string $nomeImagem 
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
