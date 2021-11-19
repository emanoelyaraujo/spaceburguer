<?php

$dados = [
    "action" => "Login/verificaEmail",
    "name" => "email",
    "label" => "E-mail",
    "maxlength" => "100",
    "type" => "email"
];

echo Formulario::FormEmailCodigo($configs["titulo"], "Informe seu email para continuar", $dados, "", $configs["view"]);