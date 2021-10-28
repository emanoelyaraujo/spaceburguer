<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'terceiros/vendor/autoload.php';

class EnviaEmail
{
    public static function email($fromEmail, $fromName, $adressEmail, $adressName, $post)
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try
        {
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

            $mail->setFrom($fromEmail, $fromName);
            $mail->addAddress($adressEmail, $adressName);

            //Content
            $mail->isHTML(true);
            $mail->Subject = $post["assunto"];
            $mail->Body    = $post["mensagem"];
            $mail->AltBody = $post["mensagem"];

            if ($mail->send())
            {
                $_SESSION["msgSucesso"] = "E-mail enviado com sucesso!";
            }
            else
            {
                $_SESSION["msgError"] = "Falha ao enviar e-mail.";
            }
        }
        catch (Exception $e)
        {
            echo "Falha ao enviar e-mail. {$mail->ErrorInfo}";
        }
    }
}
