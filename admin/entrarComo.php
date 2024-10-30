<?php

require_once("../../../config-ext.php");
if(isset($_POST['EmailUser'], $_POST['passUser'])){
    $EmailUser = $_POST['EmailUser'];
    $passUser = $_POST['passUser'];
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND contrasena = ?");
    $stmt->bind_param("ss", $EmailUser, $passUser);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['loggedin'] = true;
        $_SESSION["UserTipo"] = $row['UserTipo'];

        header("Location: ../dashboard.php");
        exit();
        
    } else {
        echo "Correo electrónico o contraseña incorrectos.";
    }
}