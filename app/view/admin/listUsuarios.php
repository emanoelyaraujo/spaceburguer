<?php 

echo Formulario::titulo('Lista Usuário', ['controller' => 'usuarioAdmin']);

$body = [];
$id = [];

foreach($aDados['data'] as $b)
{
    $body[] = [
        $b['nome'],
        $b['email'],
        Helpers::$nivel[$b['nivel']],
        Helpers::$status[$b['status']]
    ];

    $id[] = [
        $b['id']
    ];
}

echo Lista::montaLista("usuarioAdmin", ['Nome', 'E-mail', 'Nível', 'Status', 'Opções'], $body, $id);