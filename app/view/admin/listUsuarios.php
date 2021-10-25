<?php 

echo Formulario::titulo('Lista Usuário', ['controller' => 'usuarioAdmin']);

$body = [];
$id = [];

foreach($aDados['data'] as $b)
{
    $body[] = [
        $b['nome'],
        $b['email'],
        ($b['nivel'] == 1 ? 'Administrador' : 'Visitante'),
        ($b['status'] == 1 ? 'Ativo' : 'Inativo')
    ];

    $id[] = [
        $b['id']
    ];
}

echo Lista::montaLista("usuarioAdmin", ['Nome', 'E-mail', 'Nível', 'Status', 'Opções'], $body, $id);