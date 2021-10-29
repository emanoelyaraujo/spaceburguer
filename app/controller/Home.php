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
        
        $mail = EnviaEmail::create();

        $mail->setFrom($post["email"], $post["nome"]);
        $mail->addReplyTo($post["email"], $post["nome"]);
        $mail->addAddress("deliveryspaceburguer@gmail.com", "SpaceBurger");
        $mail->Subject = $post["assunto"];
        $mail->Body    = $post["mensagem"];
        $mail->AltBody = $post["mensagem"];

        EnviaEmail::send($mail);

        Redirect::page("Home/faleConosco");
        break;

    case "faleConosco":
        require_once "app/view/fale-conosco.php";

        break;
}