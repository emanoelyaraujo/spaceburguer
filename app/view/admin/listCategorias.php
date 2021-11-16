<?php

echo Formulario::titulo('Lista Categorias', ['controller' => 'categoria']);

$body = [];
$id = [];

foreach ($aDados['data'] as $b)
{
    $body[] = [
        $b['descricao'],
        Helpers::$status[$b['status']]
    ];

    $id[] = [
        $b['id']
    ];
}

echo Lista::montaLista("categoria", ['Descrição', 'Status', 'Opções'], $body, $id);
