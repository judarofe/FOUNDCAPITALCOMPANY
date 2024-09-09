<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    return;
}

$proceso = true;
$Err_cons = $NombrePlan = $items = $descripcion = $PorcentajePlan = $fijoPlan = $tiempoPlan = $visible = '';

if (empty($_POST["NombrePlan"])) {
    $Err_cons .= "No has ingresado nombre del plan.<br>";
    $proceso = false;
} else {
    $NombrePlan = filter_var(trim($_POST["NombrePlan"]), FILTER_SANITIZE_STRING);
    $NombrePlan_1 = filter_var(trim($_POST["NombrePlan"]), FILTER_SANITIZE_STRING);
}

if (empty($_POST["items"])) {
    $Err_cons .= "No has ingresado los items.<br>";
    $proceso = false;
} else {
    $items = filter_var(trim($_POST["items"]), FILTER_SANITIZE_STRING);
    $items_1 = filter_var(trim($_POST["items"]), FILTER_SANITIZE_STRING);
    if (strlen($items) > 250) {
        $Err_cons .= "los items supera los 250 caracteres. Por favor, revisa el contenido.";
        $proceso = false;
    } else {
        $lineas = explode("\n", $items);
        $items_lista = "";
        $cuenta = 0;
        foreach ($lineas as $linea) {
            $linea = trim($linea);
            if (!empty($linea)){
                $items_lista .= $linea . '|';
                $cuenta++;
            }
        }

        $items_lista =  substr($items_lista, 0, -1);

        if($cuenta != 8){
            $Err_cons .= "Debes ingresar 8 items en total";
            $proceso = false;
        }
    }
}

if (empty($_POST["descripcion"])) {
    $Err_cons .= "No has ingresado descripción.<br>";
    $proceso = false;
} else {
    $descripcion = filter_var(trim($_POST["descripcion"]), FILTER_SANITIZE_STRING);
    $descripcion_1 = filter_var(trim($_POST["descripcion"]), FILTER_SANITIZE_STRING);
    if(strlen($descripcion) > 1800 || strlen($descripcion) < 1200){
        $Err_cons .= "la descripción se sale del rango de la longitud.";
        $proceso = false;
    }else{
        $descripcion = nl2br($descripcion);
    }  
}

$PorcentajePlan = filter_var(trim($_POST["PorcentajePlan"]), FILTER_SANITIZE_STRING);
$PorcentajePlan_1 = filter_var(trim($_POST["PorcentajePlan"]), FILTER_SANITIZE_STRING);
$PorcentajePlan = (int) $PorcentajePlan;

$fijoPlan = filter_var(trim($_POST["fijoPlan"]), FILTER_SANITIZE_STRING);
$fijoPlan_1 = filter_var(trim($_POST["fijoPlan"]), FILTER_SANITIZE_STRING);
$fijoPlan = (int) $fijoPlan;

if ($PorcentajePlan === 0 && $fijoPlan === 0) {
    $Err_cons .= "porcentaje y valor fijo no pueden ser 0 al mismo tiempo.<br>";
    $proceso = false;
}elseif ($PorcentajePlan > 0 && $fijoPlan > 0){
    $Err_cons .= "porcentaje y valor fijo no pueden ser mayor a 0 al mismo tiempo.<br>";
    $proceso = false;
}elseif($PorcentajePlan > 100){
    $Err_cons .= "valor incorrecto ingresado en el porcentaje del plan.<br>";
    $proceso = false;
}

if (empty($_POST["tiempoPlan"])) {
    $Err_cons .= "No has ingresado tiempo del plan.<br>";
    $proceso = false;
} else {
    $tiempoPlan = filter_var(trim($_POST["tiempoPlan"]), FILTER_SANITIZE_STRING);
    $tiempoPlan_1 = filter_var(trim($_POST["tiempoPlan"]), FILTER_SANITIZE_STRING);

    $tiempoPlan = (int) $tiempoPlan;
    if ($tiempoPlan < 30){
        $Err_cons .= "La duración debe ser mayor a 30 días.<br>";
        $proceso = false;
    }
}

if (isset($_POST["visible"])) {
    $visible = 1;
} else {
    $visible = 0;
}

if ($proceso === false) {
    $mensaje_error = '<div class="alert alert-danger" role="alert">
    '.$Err_cons.'
    </div>';
} else {
    require_once("../../../config-ext.php");
    
    $NombrePlan = mysqli_real_escape_string($conn, $NombrePlan);
    $items_lista = mysqli_real_escape_string($conn, $items_lista);
    $descripcion = mysqli_real_escape_string($conn, $descripcion);
    $PorcentajePlan = mysqli_real_escape_string($conn, $PorcentajePlan);
    $fijoPlan = mysqli_real_escape_string($conn, $fijoPlan);
    $tiempoPlan = mysqli_real_escape_string($conn, $tiempoPlan);
    $visible = mysqli_real_escape_string($conn, $visible);

    $sql = "INSERT INTO planes (plan, items, descripcion, porcentaje, fijo, tiempo, visibilidad) VALUE (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssss", $NombrePlan, $items_lista, $descripcion, $PorcentajePlan, $fijoPlan, $tiempoPlan, $visible);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $Err_cons = $NombrePlan = $items = $descripcion = $PorcentajePlan = $fijoPlan = $tiempoPlan = $mensaje_error = '';
        $NombrePlan_1 = $items_1 = $descripcion_1 = $PorcentajePlan_1 = $fijoPlan_1 = $tiempoPlan_1 = $mensaje_error_1 = '';
    } else {
        echo "Error en la preparación de la consulta.";
    }

    mysqli_close($conn);
}