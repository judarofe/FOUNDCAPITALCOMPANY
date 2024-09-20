<?php
require_once("../../../config-ext.php");
$sql = "SELECT * FROM planes";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $niveles = 0;
        $listado = "";
        $cadena = $row['items'];
        $elementos = explode("|", $cadena);
        $pagos = explode(",", $row['pagos']);

        $descripcionVisual = str_replace("\\r\\n", '', $row['descripcion']);
        $arrayVisual = explode(",",$row['referidos']);
        $cantidadArrayVisual = count($arrayVisual);

        $referidosVisual = '<table class="table"><tr><th>Nivel</th><th>Porcentaje ganancia</th><th>Referidos necesarios<br>hasta [nivel: '.$row['Nivel'].']</th></tr>';
        for($i=0; $i < $cantidadArrayVisual; $i++){
            $niveles++;
            $variableReferido = $arrayVisual[$i];
            $arrayVariableReferido = explode("-",$variableReferido);
            $referidosVisual .= '<tr><td>'.$niveles.'</td><td>% '.$arrayVariableReferido[0].'</td><td>'.$arrayVariableReferido[1].'</td></tr>';
        }
        $referidosVisual .= '</table>';

        foreach ($elementos as $elemento) {
            $listado .= '<p class="card-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32.42" height="25.5" viewBox="0 0 32.42 25.5">
                                <path id="Trazado_376" data-name="Trazado 376" d="M340.913,6932.681l7.98,7.98,22.319-22.318" transform="translate(-339.853 -6917.282)" fill="none" stroke="#39b54a" stroke-miterlimit="10" stroke-width="3"/>
                            </svg>
                            '.$elemento.'
                        </p>';
        }
        if($row['visibilidad'] == 0){
            $laVisibilidad = "No";
        }else{
            $laVisibilidad = "Si";
        }
        $planesTotales .= '<div class="card">
            <div class="card-header text-center">Plan 
                '.$row['id_plan'].'
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">'.$row['plan'].'</h5>
                '.$listado.'
                <p class="card-text">'.$descripcionVisual.'</p>
                <p class="card-text"><strong>Porcentaje ganancia: </strong>%'.$row['porcentaje'].'</p>
                <p class="card-text"><strong>Ganancia fija: </strong>USD '.number_format($row['fijo'], 2, ',', '.').'</p>
                <p class="card-text"><strong>Tiempo (días): </strong>'.$row['tiempo'].'</p>
                <p class="card-text"><strong>Pagos: </strong>mínimo (USD '.number_format($pagos[0], 2, ',', '.').') - máximo (USD '.number_format($pagos[1], 2, ',', '.').')</p>
                '.$referidosVisual.'
                <button class="btn btn-danger" style="float: right; margin-right: 5px" onclick="eliminar('.$row['id_plan'].',\'planes\')">Eliminar</button>
            </div>
            <div class="card-footer text-body-secondary text-center">
                <strong>visibilidad: </strong>'.$laVisibilidad.'
            </div>
        </div><br>';
    }
}

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

$porcentajeReferido = !empty($_POST["porcentajeReferido"]) ? $_POST["porcentajeReferido"] : 0;
$referidosMinimos = !empty($_POST["referidosMinimos"]) ? $_POST["referidosMinimos"] : 0;
$nivelMaximo = !empty($_POST["nivelMaximo"]) ? $_POST["nivelMaximo"] : 0;

$invMinima = !empty($_POST["invMinima"]) ? $_POST["invMinima"] : 0;
$invMaximo = !empty($_POST["invMaxima"]) ? $_POST["invMaxima"] : 0;

$invPagos = $invMinima.",".$invMaximo;

$resultadoReferidos = [];

if (count($referidosMinimos) === count($porcentajeReferido)) {
    for ($i = 0; $i < count($referidosMinimos); $i++) {
        $resultadoReferidos[] = $porcentajeReferido[$i] . '-' . $referidosMinimos[$i];
    }
}

$cadenaFinalReferidos = implode(',', $resultadoReferidos);

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
    $NombrePlan = mysqli_real_escape_string($conn, $NombrePlan);
    $items_lista = mysqli_real_escape_string($conn, $items_lista);
    $descripcion = mysqli_real_escape_string($conn, $descripcion);
    $PorcentajePlan = mysqli_real_escape_string($conn, $PorcentajePlan);
    $fijoPlan = mysqli_real_escape_string($conn, $fijoPlan);
    $tiempoPlan = mysqli_real_escape_string($conn, $tiempoPlan);
    $visible = mysqli_real_escape_string($conn, $visible);

    $sql = "INSERT INTO planes (plan, items, descripcion, porcentaje, fijo, tiempo, visibilidad, Nivel, referidos, pagos) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssssss", $NombrePlan, $items_lista, $descripcion, $PorcentajePlan, $fijoPlan, $tiempoPlan, $visible,$nivelMaximo,$cadenaFinalReferidos,$invPagos);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $Err_cons = $NombrePlan = $items = $descripcion = $PorcentajePlan = $fijoPlan = $tiempoPlan = $mensaje_error = '';
        $NombrePlan_1 = $items_1 = $descripcion_1 = $PorcentajePlan_1 = $fijoPlan_1 = $tiempoPlan_1 = $mensaje_error_1 = '';

        header("Location: planesAdmin.php");

    } else {
        echo "Error en la preparación de la consulta.";
    }

    mysqli_close($conn);
}