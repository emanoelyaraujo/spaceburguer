<?php
$dados = [
    "action" => "verificaEmail",
    "name" => "email",
    "label" => "E-mail",
    "maxlength" => "100",
    "type" => "email"

];

echo Formulario::FormSenha("Informe seu email", $dados);