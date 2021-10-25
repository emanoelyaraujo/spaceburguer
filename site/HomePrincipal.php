<?php

require_once 'ModelHome.php';

$model = new Home();

$post           = $_POST;
$aDados['acao'] = $acao;

switch ($metodo)
{
    case "home":

        $dados = $model->getLanches();

        require_once "site/home.php";

        break;
}