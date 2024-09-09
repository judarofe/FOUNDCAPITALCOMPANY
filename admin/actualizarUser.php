<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreInput = filter_input(INPUT_POST, 'nombreInput', FILTER_SANITIZE_STRING);
    $ApellidosInput = filter_input(INPUT_POST, 'ApellidosInput', FILTER_SANITIZE_STRING);
    $UserInput = filter_input(INPUT_POST, 'UserInput', FILTER_SANITIZE_STRING);
    $EmailInput = filter_input(INPUT_POST, 'EmailInput', FILTER_SANITIZE_STRING);
    $Iduser = filter_input(INPUT_POST, 'Iduser', FILTER_SANITIZE_STRING);

    require_once("../../../config-ext.php");
        if($conn){
            $sql="UPDATE user SET nombre = '$nombreInput',apellido = '$ApellidosInput',email = '$EmailInput',username = '$UserInput' WHERE id_user = $Iduser";
        }

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        }    
        // Cerrar la conexión
        $conn->close();
}