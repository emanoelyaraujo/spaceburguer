<?php

$dados = [
    "action" => "Login/verificaCodigo",
    "name" => "codigo",
    "label" => "Código",
    "maxlength" => "6",
    "type" => "text"

];

echo Formulario::FormEmailCodigo("Código enviado", "Digite o código que enviamos para <strong>" . $email["emailUser"] ."</strong>.", $dados, $email['emailUser']);