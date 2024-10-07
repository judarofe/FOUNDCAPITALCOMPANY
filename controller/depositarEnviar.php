<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Iduser = $_POST['Iduser'] ?? '';
    $PlanInversion = $_POST['PlanInversion'] ?? '';
    $BilleteraInversion = $_POST['BilleteraInversion'] ?? '';
    $CantidadInversion = $_POST['CantidadInversion'] ?? '';
    $fileName = $_POST['imagen'] ?? '';
    $mensaje = "";
    $fechaHoraActual = "";

    $proceder = !empty($PlanInversion) && !empty($BilleteraInversion) && !empty($CantidadInversion) && !empty($fileName);

    if ($proceder) {
        $fileName = $_POST['imagen'];
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
        $mensaje = "Datos incompletos.";
    }
    header("Location: ../depositar.php?mensaje=".$mensaje);
    exit();
} else {
    header("Location: ../depositar.php");
    exit();
}