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
                ($b['status'] == 1 ? '<div class="text-center"><span class="badge bg-success">Ativo</span></div>' : '<span class="text-center badge bg-warning">Inativo</span>')
            ];
        }
    }

    $id[] = [
        $b["id"]
    ];
}

echo Lista::montaLista("lanche", ["Categoria", "Descrição", "Preço", "Status", "Opções"], $body, $id);
