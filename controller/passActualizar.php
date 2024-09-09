<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../../../config-ext.php');
    $Iduser = filter_input(INPUT_POST, 'Iduser', FILTER_SANITIZE_STRING);
    $PassActual = filter_input(INPUT_POST, 'PassActual', FILTER_SANITIZE_STRING);
    $PassNueva = filter_input(INPUT_POST, 'PassNueva', FILTER_SANITIZE_STRING);
    $PassRepeat = filter_input(INPUT_POST, 'PassRepeat', FILTER_SANITIZE_STRING);
    $mesnajeError = "";

    $stmt = $conn->prepare("SELECT id_user, contrasena FROM user WHERE id_user = ?");
    $stmt->bind_param("s", $Iduser);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hash = $row['contrasena'];

        if (password_verify($PassActual, $hash)) {
            if ($PassNueva === "") {
                $mesnajeError = "No ingresó una nueva contraseña";
            } elseif ($PassNueva != $PassRepeat) {
                $mesnajeError = "Las contraseñas no coinciden";
            } elseif (strlen($PassNueva) < 10 || !preg_match('/[a-z]/', $PassNueva) || !preg_match('/[A-Z]/', $PassNueva) || !preg_match('/\d/', $PassNueva) || !preg_match('/[^A-Za-z0-9]/', $PassNueva)) {
                $mesnajeError = "La contraseña no cumple con los requisitos de seguridad";
            } elseif ($PassNueva === $PassActual) {
                $mesnajeError = "La nueva contraseña no puede ser igual a la actual";
            } else {
                $hashPass = password_hash($PassNueva, PASSWORD_ARGON2I);
                $stmt = $conn->prepare("UPDATE user SET contrasena = ? WHERE id_user = ?");
                $stmt->bind_param("ss", $hashPass, $Iduser);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    $mesnajeError = "Bien";
                } else {
                    $mesnajeError = "Error al actualizar la contraseña.";
                }
            }
        } else {
            $mesnajeError = "Las credenciales ingresadas no son correctas";
        }
    } else {
        $mesnajeError = "Error de autenticidad, por favor comuníquese con el administrador";
    }

    echo $mesnajeError;
} else {
    return;
}