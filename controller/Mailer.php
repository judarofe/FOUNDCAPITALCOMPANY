<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('../../config-ext.php');

function enviaCodigo($nuevoID, $codigo, $email, $emailUser, $emailPass) {
    require_once('../phpMailer/Exception.php');
require_once('../phpMailer/PHPMailer.php');
require_once('../phpMailer/SMTP.php');
    global $conn; // Asegúrate de que la conexión a la base de datos esté disponible

    $sql = "INSERT INTO codigoemail (id_user, codigo) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        throw new Exception('Error en la preparación de la declaración: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "is", $nuevoID, $codigo);

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception('Error en la ejecución de la declaración: ' . mysqli_stmt_error($stmt));
    }

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        mysqli_stmt_close($stmt);

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
            $mail->setFrom('dinamico.moodle@gmail.com', 'Dinamico Web');
            $mail->addAddress($email, $email);
            $mail->isHTML(true);
            $mail->Subject = 'Código de confirmación';
            $mail->Body = "<p><strong>Confirma tu código</strong></p><p>Tu código de confirmación de correo es el siguiente:</p><p>{$codigo}</p>";
            $mail->send();
        } catch (Exception $e) {
            error_log("Error de envío: " . $mail->ErrorInfo);
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn); // Cerrar la conexión a la base de datos
}

?>