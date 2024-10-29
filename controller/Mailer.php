<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/Exception.php';
require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';

$cssEmail = '
.tabla {
    width: 550px;
    margin: auto;
    border-collapse: collapse;
    border: none;
    text-align: center;
}

table * {
    margin: 0;
    padding: 6px 3px;
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

.oscuroFont {
   color: #00183B;
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

.listado{
    text-align: left;
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
                                    <span class="letraDecoracion">ELITE FOUND</span>
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

function emailconfirmado($Email, $emailUser, $emailPass){

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
        $mail->addAddress($Email);
        $mail->isHTML(true);
        $mail->Subject = 'Email confirmado';

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
                                ¡Felicitaciones tu correo fue confirmado!
                            </th>
                        </tr>
                        <tr>
                            <td class="fontRoboto">
                                Por favor, ya puedes iniciar sesión.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h1 class="fontPoppins">
                                    <span class="letraDecoracion">ELITE FOUND</span>
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

        return;
}

function accesoCuenta($fechaHoraActual,$direccionIP,$dispositivo,$userName,$email,$emailUser,$emailPass){
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
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Notificación de inicio de sesión ELITE FOUND';

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
                                Hola '.$userName.',
                            </th>
                        </tr>
                        <tr>
                            <td class="fontRoboto">
                                Te informamos que tu cuenta ELITE FOUND ha sido accedida recientemente desde un dispositivo.
                            </td>
                        </tr>
                        <tr>
                            <td class="fontRoboto listado claro oscuroFont">
                                <p><strong>Cuenta: </strong>'.$userName.' ('.$email.')</p>
                                <p><strong>Fecha: </strong>'.$fechaHoraActual.'</p>
                                <p><strong>Dispositivo: </strong>'.$dispositivo.'</p>
                                <p><strong>Dirección IP: </strong>'.$direccionIP.'</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="fontRoboto">
                                Si reconoces esta actividad, no es necesario realizar ninguna acción.<br>
                                En caso de que no hayas sido tú, te recomendamos cambiar tu contraseña de inmediato para proteger tu cuenta.
                            </td>
                        </tr>
                        <tr>
                            <td class="fontRoboto">
                                Saludos cordiales, <br>
                                Equipo de soporte
                            </td>
                        <tr>
                        <tr>
                            <td>
                                <h1 class="fontPoppins">
                                    <span class="letraDecoracion">ELITE FOUND</span>
                                </h1>
                            </td>
                        <tr>
                    </tabla>
                </body>
            </html>
            ';

        $mail->send();

        } catch (Exception $e) {
            return ("Error de envío: " . $mail->ErrorInfo);
        }
}

function enviaContraseña($codigo, $Email_user, $emailUser, $emailPass) {

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
            $mail->Subject = 'Contraseña restablecida';

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
                                Contraseña establecida
                            </th>
                        </tr>
                        <tr>
                            <td class="fontRoboto">
                                Por favor, utiliza esta contraseña de 8 caracteres para acceder a tu cuenta. Te recomendamos encarecidamente cambiarla lo antes posible para garantizar la seguridad de tu información.
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
                                    <span class="letraDecoracion">ELITE FOUND</span>
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

        $verifica = "Revisa tu bandeja de entrada, tu contraseña ha sido restablecida.";
        header("Location: ../index.php?mensaje=".urlencode($verifica));
        exit();
}

?>