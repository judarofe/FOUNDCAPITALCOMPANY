<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    return;
}

$proceso = true;
$Err_cons = $mensaje_error = "";

if (empty($_POST["NombreBilletera"])) {
    $Err_cons .= "No has ingresado nombre de la billetera.<br>";
    $proceso = false;
} else {
    $NombreBilletera = filter_var(trim($_POST["NombreBilletera"]), FILTER_SANITIZE_STRING);
}

if(strlen($NombreBilletera) > 50){
    $Err_cons .= "Se ha superado los caracteres máximos (50).<br>";
    $proceso = false;
}

if ($proceso === false) {
    $mensaje_error = '<div class="alert alert-danger" role="alert">
    '.$Err_cons.'
    </div>';
}else{
    require_once("../../../config-ext.php");

    $NombreBilletera = mysqli_real_escape_string($conn, $NombreBilletera);
    $sql = "INSERT INTO billetera (nombre) VALUE (?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $NombreBilletera);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $Err_cons = $mensaje_error = $NombreBilletera = "";
    } else {
        echo "Error en la preparación de la consulta.";
    }

    mysqli_close($conn);
}
?>