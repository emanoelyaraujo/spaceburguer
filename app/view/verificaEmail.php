<?php
var_dump($_SESSION);
$dados = [
    "action" => "verificaEmail",
    "name" => "email",
    "label" => "E-mail",
    "maxlength" => "100",
    "type" => "email"

];

echo Formulario::FormEmailCodigo("Entrar com e-mail", "Informe seu email para continuar", $dados);