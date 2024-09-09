<?php

if(isset($_POST['email'], $_POST['pass'])){
    
    $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
    $email = str_rot13(base64_encode($email));

    $pass = $_POST['pass'];

    if ($email === false) {
        echo "ERROR: dirección de correo electrónico inválida.";
        exit;
    }

    require_once('../../config-ext.php');

    $stmt = $conn->prepare("SELECT id_user, contrasena FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hash = $row['contrasena'];
        
        if (password_verify($pass, $hash)) {
            echo "ok";
            exit;
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

?>