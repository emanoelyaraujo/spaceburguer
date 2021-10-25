<?php

require_once 'app/model/ModelHome.php';

$model = new Home();

$post           = $_POST;
$aDados['acao'] = $acao;

switch ($metodo)
{
    case "index":

        $dados = $model->getLanches();

        require_once "app/view/home.php";

        break;
}