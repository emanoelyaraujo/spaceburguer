<?php

session_start();
ob_start();

// carrega as configurações da plataforma
require_once 'config\config.php';

// Carregando as bibliotecas
require_once "lib/ModelBase.php";
require_once "lib/Database.php";
require_once "lib/Redirect.php";
require_once "lib/Formulario.php";
require_once "lib/Security.php";
require_once "lib/Tabela.php";
require_once "lib/Numeros.php";
require_once "lib/Data.php";
require_once "lib/EnviaEmail.php";
require_once "lib/Helpers.php";
require_once "lib/UploadImagens.php";

// Roteamento da plataforma

$pasta      = "app";
$parametros = (isset($_GET["parametro"]) ? $_GET["parametro"] : "Home/index");
$metodo     = "";
$acao       = "";
$id         = 0;

if (substr_count($parametros, "/") > 0)
{
    $aParam     = explode("/", $parametros);
    $control    = (file_exists("{$pasta}/controller/{$aParam[0]}.php") ? $aParam[0] : "Error");
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
    $control    = (file_exists("{$pasta}/controller/{$parametros}.php") ? $parametros : "Error");
    $metodo     = 'index';
}

// views
require_once $pasta . "/view/comuns/header.php";

if ($control != "Login" && $control != "cadastrar")
{
    require_once $pasta . "/view/comuns/navbar.php";
}
require_once "$pasta/controller/$control.php";

if ($control != "Login" && $control != "cadastrar" && $control != "Carrinho")
{
    require_once $pasta . "/view/comuns/footer.php";
}
