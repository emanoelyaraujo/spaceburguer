<?php
$dados = [
    "action" => "verificaEmail",
    "name" => "email",
    "label" => "E-mail",
    "maxlength" => "100",
    "type" => "email"

];

echo Formulario::FormEmailCodigo("Informe seu email", $dados);