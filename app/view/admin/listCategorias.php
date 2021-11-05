<?php

echo Formulario::titulo('Lista Categorias', ['controller' => 'categoria']);

$body = [];
$id = [];

foreach($aDados['data'] as $b)
{
    $body[] = [
        $b['descricao'],
        ($b['status'] == 1 ? '<div class="text-center"><span class="badge bg-success">Ativo</span></div>' : '<span class="text-center badge bg-warning">Inativo</span>')
    ];

    $id[] = [
        $b['id']
    ];
}

echo Lista::montaLista("categoria", ['Descrição', 'Status', 'Opções'], $body, $id);