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

    case "envioEmail":
        
        EnviaEmail::email($post["email"], $post["nome"],"deliveryspaceburguer@gmail.com", "SpaceBurger", $post);

        Redirect::page("Home/faleConosco");
        break;

    case "faleConosco":
        require_once "app/view/fale-conosco.php";

        break;
}