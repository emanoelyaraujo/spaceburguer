<?php

session_start();

// Roteamento da plataforma

$pasta      = "site";
$parametros = (isset($_GET["parametro"]) ? $_GET["parametro"] : "home");
$metodo     = "";
$acao       = "";
$id         = 0;

if (substr_count($parametros, "/") > 0)
{
    $aParam     = explode("/", $parametros);
    $control    = (file_exists("{$pasta}/{$aParam[0]}.php") ? $aParam[0] : "comuns/error");
    $metodo     = $aParam[1];

    if (isset($aParam[2]))
    {
        if (in_array($aParam[2], ['insert', 'update', 'delete', 'view']))
        {
            $acao       = (isset($aParam[2]) ? $aParam[2] : 0);
            $id         = (isset($aParam[3]) ? $aParam[3] : 0);
        }
        else
        {
            $acao       = "";
            $id         = (isset($aParam[2]) ? $aParam[2] : 0);
        }
    }
}
else
{
    $control    = (file_exists("{$pasta}/{$parametros}.php") ? $parametros : "comuns/error");
}

// views

require_once $pasta . "/comuns/header.php";
require_once $pasta . "/comuns/sidebar.php";
require_once $pasta . "/" . $control . ".php";
require_once $pasta . "/comuns/footer.php";
