<?php
session_start();
include("btnSession.php");

require_once('../../config-ext.php');
include('encoded.php');
include('Mailer.php');
include('generarCodigo.php');

$referido = "";

if(isset($_GET["id"])){
    $referido = '<div class="form-floating mb-3">
        <input type="text" class="form-control inputRegistro" name="referido" id="floatingInputReferido" placeholder="Patrocinador" value="'.$_GET["id"].'" readonly>
        <label for="floatingInputReferido">Patrocinador</label>
    </div>';
}

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
$cedula = "";

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

if (empty($_POST["Cedula"])) {
    $Err_cons .= "No has ingresado una Cédula.<br>";
    $proceso = false;
} else {
    $cedula = filter_var(trim($_POST["Cedula"]), FILTER_SANITIZE_STRING);
    $cedula = encoded($cedula);
    $query_identidad = "SELECT * FROM user WHERE cedula = ?";
    $stmt_identidad = mysqli_prepare($conn, $query_identidad);
    mysqli_stmt_bind_param($stmt_identidad, "s", $cedula);
    mysqli_stmt_execute($stmt_identidad);
    $resultado_identidad = mysqli_stmt_get_result($stmt_identidad);
    if (mysqli_num_rows($resultado_identidad) > 0) {
        $Err_cons .= "El numero de identidad ya existe.";
        $proceso = false;
    }
}

if (!empty($_POST["referido"])) {
    $referido = filter_var(trim($_POST["referido"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query_referido = "SELECT id_user FROM user WHERE username = ?";
    $stmt_referido = mysqli_prepare($conn, $query_referido);
    
    if ($stmt_referido) {
        mysqli_stmt_bind_param($stmt_referido, "s", $referido);
        mysqli_stmt_execute($stmt_referido);
        $resultado_referido = mysqli_stmt_get_result($stmt_referido);
        
        if (mysqli_num_rows($resultado_referido) > 0) {
            $registro = mysqli_fetch_assoc($resultado_referido);
            $id_referido = $registro['id_user'];
        } else {
            $Err_cons = "El identificador de su patrocinador no es correcto.";
            $proceso = false;
        }

        mysqli_stmt_close($stmt_referido);
    } else {
        // Manejo de error en la preparación de la declaración
        $Err_cons = "Error al preparar la declaración: " . mysqli_error($conn);
        $proceso = false;
    }
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
    $sql = "INSERT INTO user (nombre, apellido, email, contrasena, username, cedula) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $Nombre, $Apellido, $Email, $hash, $username, $cedula);
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
            
            if (!empty($_POST["referido"])) {
                $sql_2 = "INSERT INTO referidos (padre, hijo) VALUES (?, ?)";
                $stmt_2 = mysqli_prepare($conn, $sql_2);
                if ($stmt_2) {
                    mysqli_stmt_bind_param($stmt_2, "ii", $id_referido, $nuevoID);
                    mysqli_stmt_execute($stmt_2);
                    mysqli_stmt_close($stmt_2);
                } else {
                    error_log("Error al preparar la consulta para referidos: " . mysqli_error($conn));
                }
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