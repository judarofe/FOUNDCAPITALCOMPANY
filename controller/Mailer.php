<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/Exception.php';
require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';

$cssEmail = '
.tabla {
    width: 450px;
    margin: auto;
    border-collapse: collapse;
    border: none;
    text-align: center;
}

table * {
    margin: 0;
    padding: 6px 0;
    box-sizing: border-box;
}

.fontPoppins {
    font-family: "Poppins", sans-serif;
}

.fontRoboto {
    font-family: "Roboto", sans-serif;
}

.fontRobotoMono {
    font-family: "Roboto Mono", monospace;
}

.claro {
    background-color: #ffffff;
}

.oscuro {
    background-color: #00183B;
}    

.claroFont {
   color: #ffffff;
}

.letraDecoracion {
    background-color: #375272;
    color: #ffffff;
    font-size: 20px;
    padding: 10px 20px;
    border-radius: 20px;
    text-decoration: none;
    margin: 6px;
}

.titulo {
    font-weight: 700;
    padding: 9px 0px;
    font-size: 26px;
}
';

function enviaCodigo($codigo, $Email_user, $emailUser, $emailPass) {

    global $cssEmail;
        
    $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->CharSet = 'UTF-8';
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $emailUser;
            $mail->Password = $emailPass;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            
            $mail->setFrom($emailUser);
            $mail->addAddress($Email_user);
            $mail->isHTML(true);
            $mail->Subject = 'Código de confirmación';

            $caracteres = mb_str_split($codigo);
            $resultado = '';
            foreach ($caracteres as $caracter) {
                $resultado .= '<span class="fontRobotoMono letraDecoracion">' . htmlspecialchars($caracter) . '</span>';
            }

            $mail->Body = '
            <html>
                <head>
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700&family=Roboto+Mono:wght@300;700&family=Roboto:wght@300;700&display=swap" rel="stylesheet">
                    <style>'.$cssEmail.'</style>
                </head>
                <body>
                    <table class="tabla oscuro claroFont" cellpadding="0" cellspacing="0">
                        <tr>
                            <th class="titulo fontPoppins">
                                Verifica tu dirección de correo electrónico
                            </th>
                        </tr>
                        <tr>
                            <td class="fontRoboto">
                                Por favor, utiliza este código de 6 caracteres para verificar tu dirección de correo electrónico.
                            </td>
                        </tr>
                        <tr>
                            <td class="fontRobotoMono">
                                '.$resultado.'
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h1 class="fontPoppins">
                                    ELITE FOUND
                                </h1>
                            </td>
                        <tr>
                    </tabla>
                </body>
            </html>
            ';

            $mail->send();
        } catch (Exception $e) {
            error_log("Error de envío: " . $mail->ErrorInfo);
        }

        header("Location: ./confirmarEmail.php?3m41l=".urlencode(str_rot13($Email_user)));
        exit();
}
?>