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

    case "faleConosco":
        require_once "app/view/fale-conosco.php";

        break;

    case "envioEmail":

        if (!empty($post["mensagem"]))
        {
            $mail = EnviaEmail::create();

            $mail->setFrom($post["email"], $post["nome"]);
            $mail->addReplyTo($post["email"], $post["nome"]);
            $mail->addAddress("deliveryspaceburguer@gmail.com", "SpaceBurger");
            $mail->Subject = $post["assunto"];
            $mail->Body    = $post["mensagem"];
            $mail->AltBody = $post["mensagem"];

            EnviaEmail::send($mail);
        }
        else
        {
            $_SESSION["msgError"] = "Campo mensagem é obrigatório.";
            Redirect::page("Home/faleConosco");
            break;
        }

        Redirect::page("Home/faleConosco");
        break;
}
