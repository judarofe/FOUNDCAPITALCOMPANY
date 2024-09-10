<?php
session_start();
include("btnSession.php");

require_once('../../config-ext.php');
include('encoded.php');
include('Mailer.php');
include('generarCodigo.php');

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    return;
}

$Err_cons = '';
$proceso = true;

if (!isset($_POST['terminosCheck'])) {
    $Err_cons .= "No has aceptado los términos y condiciones.<br>";
    $proceso = false;
}

$Nombre = "";
$Apellido = "";
$Email_user = "";
$Email = "";
$Password_1 = "";
$Password_2 = "";

if (empty($_POST["Nombre"])) {
    $Err_cons .= "No has ingresado Nombre.<br>";
    $proceso = false;
} else {
    $Nombre = filter_var(trim($_POST["Nombre"]), FILTER_SANITIZE_STRING);
    $Nombre = encoded($Nombre);
}

if (empty($_POST["Apellido"])) {
    $Err_cons .= "No has ingresado Apellido.<br>";
    $proceso = false;
} else {
    $Apellido = filter_var(trim($_POST["Apellido"]), FILTER_SANITIZE_STRING);
    $Apellido = encoded($Apellido);
}

if (empty($_POST["userName"])) {
    $Err_cons .= "No has ingresado un nombre de usuario.<br>";
    $proceso = false;
} else {
    $username = filter_var(trim($_POST["userName"]), FILTER_SANITIZE_STRING);
}

if (empty($_POST["Email"])) {
    $Err_cons .= "No has ingresado tu correo electrónico.<br>";
    $proceso = false;
} else {
    $Email_user = filter_var(trim($_POST["Email"]), FILTER_SANITIZE_EMAIL);
    
    
    if (!filter_var($Email_user, FILTER_VALIDATE_EMAIL)) {
        $Err_cons .= "El correo electrónico no es válido.<br>";
        $proceso = false;
    } else {
        $Email = encoded($Email_user);
        $query = "SELECT * FROM user WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $Email);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($resultado) > 0) {
            $Err_cons .= "El correo electrónico ya existe.";
            $proceso = false;
        } else {
            $query = "SELECT * FROM user WHERE username = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($resultado) > 0) {
                $i = 1;

                while (mysqli_fetch_assoc($resultado)) {
                    $username = $username . "." . $i;
                    $query = "SELECT * FROM user WHERE username = ?";
                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, "s", $username);
                    mysqli_stmt_execute($stmt);
                    $resultado = mysqli_stmt_get_result($stmt);
                    $i++;
                }
            }
        }
    }
}

if (empty($_POST["Password_1"])) {
    $Err_cons .= "No has ingresado contraseña.<br>";
    $proceso = false;
} else {
    $Password_1 = trim($_POST["Password_1"]);
}

if (empty($_POST["Password_2"])) {
    $Err_cons .= "No has confirmado la contraseña.<br>";
    $proceso = false;
} else {
    $Password_2 = trim($_POST["Password_2"]);

    if ($Password_1 != $Password_2) {
        $Err_cons .= "Las contraseñas no coinciden.<br>";
        $proceso = false;
    }
}

if ($proceso == false) {
    $prueba = '
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:fixed; z-index: 100; width: 100%; bottom: 0;">
        <p><strong>ERROR</strong><br>' . $Err_cons . '</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
} else {
    $hash = password_hash($Password_1, PASSWORD_ARGON2I);
    $sql = "INSERT INTO user (nombre, apellido, email, contrasena, username) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $Nombre, $Apellido, $Email, $hash, $username);
        if (mysqli_stmt_execute($stmt)) {
            $nuevoID = mysqli_insert_id($conn);
            $prueba = '
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="position:fixed; z-index: 100; width: 100%; bottom: 0;">
                <p><strong>CORRECTO</strong> Se ha realizado la inscripción exitosamente. Antes de iniciar sesión, por favor verifica tu correo electrónico en la bandeja de entrada, donde encontrarás un enlace de confirmación.</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            
            $codigo = generarCodigo();
            $sql_1 = "INSERT INTO codigoemail (id_user, codigo) VALUES (?, ?)";
            $stmt_1 = mysqli_prepare($conn, $sql_1);
            
            if ($stmt_1) {
                mysqli_stmt_bind_param($stmt_1, "is", $nuevoID, $codigo);
                mysqli_stmt_execute($stmt_1);
                mysqli_stmt_close($stmt_1);
            } else {
                error_log("Error al preparar la consulta para codigoemail: " . mysqli_error($conn));
            }
        } else {
            error_log("Error al ejecutar la consulta para user: " . mysqli_error($conn));
        }
        mysqli_stmt_close($stmt);
    } else {
        error_log("Error al preparar la consulta para user: " . mysqli_error($conn));
    }

    enviaCodigo($codigo, $Email_user, $emailUser, $emailPass);
}

?>