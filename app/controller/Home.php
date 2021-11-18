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

        // verifica se o campo mesnagem foi preenchido
        if (!empty($post["mensagem"]))
        {
            // se sim, chama a lib de email e em seguida passa as configurações a ser enviadas
            $mail = EnviaEmail::create();

            $mail->setFrom($post["email"], $post["nome"]);
            $mail->addReplyTo($post["email"], $post["nome"]);
            $mail->addAddress("deliveryspaceburguer@gmail.com", "SpaceBurger");
            $mail->Subject = $post["assunto"];
            $mail->Body    = $post["mensagem"];
            $mail->AltBody = $post["mensagem"];

            // no final, envia o email
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
