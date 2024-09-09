<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Iduser = $_POST['Iduser'] ?? '';
    $PlanInversion = $_POST['PlanInversion'] ?? '';
    $BilleteraInversion = $_POST['BilleteraInversion'] ?? '';
    $CantidadInversion = $_POST['CantidadInversion'] ?? '';
    $mensaje = "";
    $fechaHoraActual = "";

    $proceder = !empty($PlanInversion) && !empty($BilleteraInversion) && !empty($CantidadInversion);

    if ($proceder) {
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = date('YmdHis') . '_' . $Iduser . '.' . pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $uploadFile = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadFile)) {
                
                $fechaHoraActual = date("Y-m-d H:i:s");
                require_once('../../../config-ext.php');
                $sql = "INSERT INTO depositos (id_user, id_plan, id_billetera, fecha, cantidad, archivo) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ssssss", $Iduser, $PlanInversion, $BilleteraInversion, $fechaHoraActual, $CantidadInversion, $fileName);
                mysqli_stmt_execute($stmt);
                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    $mensaje = "Su depósito ha sido enviado para su revisión";
                }
                
            } else {
                $mensaje = "Error al subir el archivo.";
            }
        } else {
            $mensaje = "Error al cargar el archivo.";
        }
    } else {
        $mensaje = "Datos incompletos.";
    }
    header("Location: ../depositar.php?mensaje=".$mensaje);
    exit();
} else {
    header("Location: ../depositar.php");
    exit();
}