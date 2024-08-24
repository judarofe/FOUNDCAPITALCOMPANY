<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $EmailUser = filter_input(INPUT_POST, 'EmailUser', FILTER_SANITIZE_STRING);
    $passUser = filter_input(INPUT_POST, 'passUser', FILTER_SANITIZE_STRING);
    if($EmailUser === "" || $passUser === ""){
        header("Location: ../index.php");
        exit;
    }
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
            header("Location: ../index.php");
            exit;
        } else {
            header("Location: ../index.php");
            exit;
        }
    }else{
        header("Location: ../index.php");
        exit;
    }
} else {
    header("Location: ../index.php");
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