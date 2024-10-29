<?php
include("encoded.php");
include("Mailer.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $EmailDecoded = filter_input(INPUT_POST, 'EmailUser', FILTER_SANITIZE_STRING);
    $passUser = filter_input(INPUT_POST, 'passUser', FILTER_SANITIZE_STRING);
    if($EmailDecoded === "" || $passUser === ""){
        header("Location: ../index.php");
        exit;
    }

    $EmailUser = encoded($EmailDecoded);

    require_once('../../../config-ext.php');
    
    $stmt = $conn->prepare("SELECT id, id_user FROM codigoemail WHERE codigo = ?");
    $stmt->bind_param("s", $passUser);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user = $row['id_user'];
        $valorEncontrado = comprobarEmail($conn, $user, $EmailUser);
        
        if($valorEncontrado === true){
            eliminarRegistro($conn, $row['id']);
            modificarRegistro($conn, $user);
            emailconfirmado($EmailDecoded, $emailUser, $emailPass);
            $verifica = "El correo electrónico ha sido verificado exitosamente. Por favor, inicia sesión para continuar.";
            header("Location: ../index.php?mensaje=".urlencode($verifica));
            exit;
        } else {
            $verifica = "No se pudo verificar el correo electrónico. Por favor, inténtalo nuevamente e inicia sesión.";
            header("Location: ../index.php?error=".urlencode($verifica));
            exit;
        }
    }else{
        $verifica = "No se pudo verificar el correo electrónico. Por favor, inténtalo nuevamente e inicia sesión.";
        header("Location: ../index.php?error=".urlencode($verifica));
        exit;
    }
} else {
    $verifica = "No se pudo verificar el correo electrónico. Por favor, inténtalo nuevamente e inicia sesión.";
    header("Location: ../index.php?error=".urlencode($verifica));
    exit;
}

function comprobarEmail($conn, $user, $EmailUser){
    $stmt = $conn->prepare("SELECT email FROM user WHERE id_user = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
        
        if($email === $EmailUser){
            return true;
        } else {
            return false;
        }
    }
}

function eliminarRegistro($conn, $id){
    $stmt = $conn->prepare("DELETE FROM codigoemail WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

function modificarRegistro($conn, $user){
    $nuevoValor = 1;
    $stmt = $conn->prepare("UPDATE user SET confirma = ? WHERE id_user = ?");
    $stmt->bind_param("si", $nuevoValor, $user);
    $stmt->execute();   
}
?>