<?php
include('./controller/encoded.php');
include('./controller/generarCodigo.php');
include('./controller/Mailer.php');

if(isset($_POST['EmailUser'], $_POST['passUser'])){
        
    $email = filter_var(trim($_POST["EmailUser"]), FILTER_VALIDATE_EMAIL);
    $email = encoded($email);

    $pass = $_POST['passUser'];

    if ($email === false) {
        echo "ERROR: dirección de correo electrónico inválida.";
        exit;
    }

    require_once('../../config-ext.php');

    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hash = $row['contrasena'];
        
        if (password_verify($pass, $hash)) {
            session_start();
            $_SESSION["id_user"] = $row['id_user'];
            $_SESSION["loggedin"] = true;
            $_SESSION["UserTipo"] = $row['UserTipo'];

            if($row['UserTipo'] === 1){
                header("location: admin/index.php");
                exit;
            }else{
                if($row['confirma'] === 0){
                    session_destroy();
                    $email = decoded($row['email']);
                    header("location: confirmarEmail.php?3m41l=".urlencode(str_rot13($email)));
                    exit;
                }else{
                    date_default_timezone_set('America/Bogota');
                    $fechaHoraActual = date('Y-m-d H:i:s');
                    $direccionIP = obtenerIP();
                    $dispositivo = obtenerDispositivo();
                    $userName = $row['username'];
                    $email = decoded($row['email']);
                    $prueba = accesoCuenta($fechaHoraActual,$direccionIP,$dispositivo,$userName,$email,$emailUser,$emailPass);
                    header("location: dashboard.php");
                    exit;                    
                }
            }
        } else {
            echo "Las credenciales ingresadas no son correctas";
        }
    } else {
        echo "Las credenciales ingresadas no son correctas";
    }

    $stmt->close();
    $conn->close();
 
} else {
    echo "ERROR: correo electrónico y contraseña no están configurados o no son válidos.";
}

function obtenerIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    
    return $ip;
}

function obtenerDispositivo() {
    return $_SERVER['HTTP_USER_AGENT'];
}

?>