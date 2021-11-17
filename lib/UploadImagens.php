<?php

class Uploads
{
    public static function upload($arquivo, $pasta, $nomeImagem = '')
    {
        // Lista de tipos de arquivos permitidos
        $tiposPermitidos = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');
        
        // Tamanho máximo (em bytes)
        $tamanhoPermitido = 2048 * 500; // 500 Kb
        
        foreach ($arquivo as $value)
        {
            // O nome original do arquivo no computador do usuário
            $arqName = $value["name"];
            
            // O nome temporário do arquivo, como foi guardado no servidor
            $arqTemp = $value['tmp_name'];
            
            if ($value['error'] == 0)
            {
                // Verifica o tipo de arquivo enviado
                if (array_search($value['type'], $tiposPermitidos) === false)
                {
                    $_SESSION["msgError"] = 'O tipo de arquivo enviado é inválido ! (' . $arqName . ')';
                    return false;
                }
                else if ($value['size'] > $tamanhoPermitido)
                {    // Verifica o tamanho do arquivo enviado
                    $_SESSION["msgError"] = 'O tamanho do arquivo enviado é maior que o limite ! (' . $arqName . ')';
                    return false;
                }
                else
                {
                    if (!empty($nomeImagem))
                    {
                        // apaga a imagem antiga no servidor
                        unlink("uploads/$pasta/" . $nomeImagem);
                    }

                    $upload = move_uploaded_file($arqTemp, "uploads/$pasta/" . $arqName);

                    return $arqName;
                }
            }
        }
    }
}
