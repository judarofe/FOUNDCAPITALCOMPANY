<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Iduser = $_POST['Iduser'] ?? '';
    $PlanInversion = $_POST['PlanInversion'] ?? '';
    $BilleteraInversion = $_POST['BilleteraInversion'] ?? '';
    $CantidadInversion = $_POST['CantidadInversion'] ?? '';
    $fileName = $_POST['imagen'] ?? '';
    $mensaje = "";
    $fechaHoraActual = "";
    $verficarReferidoNoBono = "";

    $proceder = !empty($PlanInversion) && !empty($BilleteraInversion) && !empty($CantidadInversion) && !empty($fileName);

    if ($proceder) {
        $fileName = $_POST['imagen'];
        $fechaHoraActual = date("Y-m-d H:i:s");
        require_once('../../../config-ext.php');
        $verficarReferidoNoBono = verificarReferidoNoBono($PlanInversion, $conn);
        $sql = "INSERT INTO depositos (id_user, id_plan, id_billetera, fecha, cantidad, archivo, bono) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssss", $Iduser, $PlanInversion, $BilleteraInversion, $fechaHoraActual, $CantidadInversion, $fileName, $verficarReferidoNoBono);
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

function verificarReferidoNoBono($PlanInversion, $conn) {

    $sql = "SELECT fijoPorcentaje FROM planes WHERE id_plan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $PlanInversion);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fijoPorcentaje = $row['fijoPorcentaje'];
        if ($fijoPorcentaje > 0) {
            return 0;
        }
    }

    return 1;

}