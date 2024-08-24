<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $menuPerfil = '
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
        '.$_SESSION['userName'].'
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="perfil.php" class="dropdown-item">Perfil</a>
        </li>
        <li>
            <form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
                <button type="submit" name="logout" class="dropdown-item">Cerrar sesión</button>
            </form>
        </li>
    </ul>
    ';
} else {
    $prueba = '';
    $menuPerfil = '
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
        </svg>
    </a>
    <ul class="dropdown-menu">
        <li>
            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#login">Iniciar sesión</button>
        </li>
        <li>
            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#Registro">Comenzar</button>
        </li>
    </ul>
    ';
}

if(isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

require_once('../../config-ext.php');

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
$Email = "";
$Password_1 = "";
$Password_2 = "";

if (empty($_POST["Nombre"])) {
    $Err_cons .= "No has ingresado Nombre.<br>";
    $proceso = false;
} else {
    $Nombre = filter_var(trim($_POST["Nombre"]), FILTER_SANITIZE_STRING);
}

if (empty($_POST["Apellido"])) {
    $Err_cons .= "No has ingresado Apellido.<br>";
    $proceso = false;
} else {
    $Apellido = filter_var(trim($_POST["Apellido"]), FILTER_SANITIZE_STRING);
}

if (empty($_POST["Email"])) {
    $Err_cons .= "No has ingresado tu correo electrónico.<br>";
    $proceso = false;
} else {
    $Email = filter_var(trim($_POST["Email"]), FILTER_SANITIZE_EMAIL);

    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $Err_cons .= "El correo electrónico no es válido.<br>";
        $proceso = false;
    } else {
        $query = "SELECT * FROM user WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $Email);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($resultado) > 0) {
            $Err_cons .= "El correo electrónico ya existe.";
            $proceso = false;
        } else {
            list($username, $domain) = explode("@", $Email);
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
    mysqli_stmt_bind_param($stmt, "sssss", $Nombre, $Apellido, $Email, $hash, $username);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $prueba = '
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="position:fixed; z-index: 100; width: 100%; bottom: 0;">
            <p><strong>CORRECTO</strong> Se ha realizado la inscripción exitosamente. Antes de iniciar sesión, por favor verifica tu correo electrónico en la bandeja de entrada, donde encontrarás un enlace de confirmación.</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    //mysqli_stmt_close($stmt);
    //mysqli_close($conn);
}

?>