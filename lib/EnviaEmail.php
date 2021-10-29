<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'terceiros/vendor/autoload.php';

class EnviaEmail
{
    public static function create()
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        //Server settings
        $mail->CharSet = "utf-8";
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'deliveryspaceburguer@gmail.com';
        $mail->Password   = "adm@2021";
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->isHTML(true);

        return $mail;
    }

    public static function send($mail)
    {
        try
        {
            if ($mail->send())
            {
                $_SESSION["msgSucesso"] = "E-mail enviado com sucesso!";
                return true;
            }
            else
            {
                $_SESSION["msgError"] = "Falha ao enviar e-mail.";
                return false;
            }
        }
        catch (Exception $e)
        {
            echo "Falha ao enviar e-mail. {$mail->ErrorInfo}";
        }
    }

    public static function bodyRecuperacaoSenha($codigo, $nome)
    {
        $html = '<div>
                    <div">
                        <h4 style="color:#433a8f;font-size: 1.5rem;">Olá, '. $nome . '</h4>
                        <h5 style="font-size: 1rem;"">Recebemos um pedido para alteração de senha, caso tenha solicitado copie o código abaixo.</h5>
                        <p>Seu código de verificação é: <strong>' . $codigo . '</strong></p>
                    </div>
                </div>';

        return $html;
    }
}
