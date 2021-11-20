<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'terceiros/vendor/autoload.php';

class EnviaEmail
{    
    /**
     * cria o email 
     *
     * @return object
     */
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
    
    /**
     * verifica se o email foi enviado
     *
     * @param  object $mail
     * @return boolean
     */
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
    
    /**
     * html para a recuperação de senha
     *
     * @param  string $codigo
     * @param  string $nome
     * @return string
     */
    public static function bodyEnvioEmail($codigo, $nome = "")
    {
        $html = '
            <div>
                <div style="color:#595756">
                    <table role="presentation" border="0" bgcolor="#ffffff" cellpadding="0" cellspacing="0" style="margin:0 auto">
                        <tbody>
                            <tr>
                                <td align="center"> 
                                    <span style="text-align:center;font-size:30px;font-weight:bold">
                                        <h2 style="margin:40h2x 0 0; color: #433A8F;"> Olá, ' . $nome . ' </p>
                                    </span> 
                                    <span style="color: black; text-align:center;font-size:18px;margin:5px 60px 30px;display:block"> 
                                        Este é o código para acessar a sua conta: 
                                    </span> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" height="70px" border="0" cellpadding="0" cellspacing="0" style="min-width:340px">
                                        <tbody>
                                            <tr>
                                                <td align="center" bgcolor="#E0E0E0" style="border-radius:4px;text-align:center">
                                                    <span style="text-align:center;font-size:36px;font-weight:bold;color:#3f3e3e;letter-spacing:20px">'. $codigo .'</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="text-align:center;font-size:14px;color:#a6a29f;line-height:18px">
                                        <p style="margin-top:5px"> © 2021 SpaceBurguer Delivery - Todos os direitos reservados. </p>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>';

        return $html;
    }
}
