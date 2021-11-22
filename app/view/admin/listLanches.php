<?php

echo Formulario::titulo("Lista lanches", ["controller" => "lanche"]);

$body = [];
$categoria = [];
$id = [];

foreach ($aDados["data"] as $b)
{
    foreach ($aDados["categoria"] as $categoria)
    {
        if ($b['id_categoria'] == $categoria['id'])
        {
            $body[] = [
                $categoria["descricao"],
                $b["descricao"],
                "R$ " . Numeros::formataValor($b["preco"]),
                Helpers::$status[$b['status']]
            ];
        }
    }

    $id[] = [
        $b["id"]
    ];
}

echo Tabela::montaLista("lanche", ["Categoria", "Descrição", "Preço", "Status", "Opções"], $body, $id);
