<?php
$dados = [
    "action" => "verificaCodigo",
    "name" => "codigo",
    "label" => "Código",
    "maxlength" => "6",
    "type" => "text"

];

echo Formulario::FormSenha("O código para recuperação de senha foi enviado para seu email.", $dados, $email['emailUser']);