<?php
require_once("../../../config-ext.php");
$sql = "SELECT id_plan, plan, descripcion, referidos, porcentajeMin, porcentajeMax, fijo, tiempo, pagos, visibilidad, items, Nivel FROM planes";
$planesTotales = "";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $niveles = 0;
        $listado = [];
        $cadena = $row['items'];
        $elementos = explode("|", $cadena);
        $pagos = $row['pagos'];
        $descripcionVisual = str_replace("\\r\\n", '', $row['descripcion']);
        $arrayVisual = explode(",", $row['referidos']);
        $cantidadArrayVisual = count($arrayVisual);
        
        // Obtener todos los liderazgos en una sola consulta
        $liderazgoIds = array_map(function($item) {
            return explode("-", $item)[2];
        }, $arrayVisual);
        $liderazgoIds = array_unique($liderazgoIds);
        
        $liderazgos = [];
        if (count($liderazgoIds) > 0) {
            $stmt = $conn->prepare("SELECT id, rango FROM liderazgo WHERE id IN (" . implode(',', array_fill(0, count($liderazgoIds), '?')) . ")");
            $stmt->bind_param(str_repeat('i', count($liderazgoIds)), ...$liderazgoIds);
            $stmt->execute();
            $resultLiderazgo = $stmt->get_result();
            while ($liderazgo = $resultLiderazgo->fetch_assoc()) {
                $liderazgos[$liderazgo['id']] = $liderazgo['rango'];
            }
            $stmt->close();
        }

        $referidosVisual = '<table class="table"><tr><th>Nivel</th><th>Porcentaje ganancia</th><th>Referidos necesarios<br>hasta [nivel: '.$row['Nivel'].']</th><th>Rango</th></tr>';
        
        foreach ($arrayVisual as $variableReferido) {
            $niveles++;
            $arrayVariableReferido = explode("-", $variableReferido);
            $Liderazgo = $liderazgos[$arrayVariableReferido[2]] ?? ''; // Usar el valor de liderazgo correspondiente
            $referidosVisual .= '<tr><td>'.$niveles.'</td><td>% '.$arrayVariableReferido[0].'</td><td>'.$arrayVariableReferido[1].'</td><td>'.$Liderazgo.'</td></tr>';
        }
        $referidosVisual .= '</table>';
        
        foreach ($elementos as $elemento) {
            $listado[] = '<p class="card-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32.42" height="25.5" viewBox="0 0 32.42 25.5">
                                <path id="Trazado_376" data-name="Trazado 376" d="M340.913,6932.681l7.98,7.98,22.319-22.318" transform="translate(-339.853 -6917.282)" fill="none" stroke="#39b54a" stroke-miterlimit="10" stroke-width="3"/>
                            </svg>
                            '.$elemento.'
                        </p>';
        }
        
        $laVisibilidad = $row['visibilidad'] == 0 ? "No" : "Si";
        
        $planesTotales .= '<div class="card">
            <div class="card-header text-center">Plan 
                '.$row['id_plan'].'
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">'.$row['plan'].'</h5>
                '.implode('', $listado).'
                <p class="card-text">'.$descripcionVisual.'</p>
                <p class="card-text"><strong>Porcentaje ganancia: </strong>%'.$row['porcentajeMin'].' - %'.$row['porcentajeMax'].'</p>
                <p class="card-text"><strong>Ganancia fija: </strong>% '.number_format($row['fijo'], 2, ',', '.').'</p>
                <p class="card-text"><strong>Tiempo (días): </strong>'.$row['tiempo'].'</p>
                <p class="card-text"><strong>Pagos: </strong>USD '.$pagos.'</p>
                '.$referidosVisual.'
                <button class="btn btn-danger" style="float: right; margin-right: 5px" onclick="eliminar('.$row['id_plan'].',\'planes\')">Eliminar</button>
            </div>
            <div class="card-footer text-body-secondary text-center">
                <strong>visibilidad: </strong>'.$laVisibilidad.'
            </div>
        </div><br>';
    }
}

$sql_1 = "SELECT * FROM frecuenciaTransaccion";
$result_1 = $conn->query($sql_1);

if ($result_1->num_rows > 0) {
    $options = [];
    while($row_1 = $result_1->fetch_assoc()) {
        $options[] = '<option value="'.$row_1['id'].'">' . htmlspecialchars($row_1['frecuencia']) . '</option>';
    }
    $selectGananciaFrecuencia = '<div class="mb-3">
            <label for="GananciaFrecuencia" class="form-label">Interés</label>
            <select name="GananciaFrecuencia" id="GananciaFrecuencia" class="form-select" required><option selected disabled value="">Seleccionar</option>' . implode('', $options) .
        '</select>
        </div>';

    $selectRetirosFrecuencia = '<div class="mb-3">
        <label for="RetirosFrecuencia" class="form-label">Retiros</label>
        <select name="RetirosFrecuencia" id="RetirosFrecuencia" class="form-select" required><option selected disabled value="">Seleccionar</option>' . implode('', $options) .
    '</select>
    </div>';
}

$sql_2 = "SELECT * FROM liderazgo";
    $result_2 = $conn->query($sql_2);
    if ($result_2->num_rows > 0) {
        $optionLiderazgo[] = "";
        while($row_2 = $result_2->fetch_assoc()) {
            $optionLiderazgo[] = '<option value="'.$row_2['id'].'">' . htmlspecialchars($row_2['rango']) . '</option>';
        }
    }

$selectLiderazgo =  '<div class="mb-3">
    <label for="LiderazgoBono" class="form-label">Liderazgo</label>
    <select name="LiderazgoBono[]" id="LiderazgoBono" class="form-select" aria-describedby="LiderazgoBonoHelp" required><option selected disabled value="">Seleccionar</option>' . implode('', $optionLiderazgo) .'</select>
    <div id="LiderazgoBonoHelp" class="form-text">Ingresa el nivel de inversión</div>
</div>';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    return;
}

$proceso = true;
$Err_cons = $retiros = $interes = $NombrePlan = $items = $descripcion = $PorcentajePlan_1 = $PorcentajePlan_2 = $fijoPlan = $tiempoPlan = $visible = '';

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
$Inversion = !empty($_POST["Inversion"]) ? $_POST["Inversion"] : 0;
$invPagos = implode(',', $Inversion);

$retiros = !empty($_POST["RetirosFrecuencia"]) ? $_POST["RetirosFrecuencia"] : 0;
$interes = !empty($_POST["GananciaFrecuencia"]) ? $_POST["GananciaFrecuencia"] : 0;
$Liderazgo = !empty($_POST["LiderazgoBono"]) ? $_POST["LiderazgoBono"] : 0;

$resultadoReferidos = [];

if (count($referidosMinimos) === count($porcentajeReferido)) {
    for ($i = 0; $i < count($referidosMinimos); $i++) {
        $resultadoReferidos[] = $porcentajeReferido[$i] . '-' . $referidosMinimos[$i] . '-' . $Liderazgo[$i];
    }
}

$cadenaFinalReferidos = implode(',', $resultadoReferidos);

$PorcentajePlan_1 = filter_var(trim($_POST["PorcentajePlanMin"]), FILTER_SANITIZE_STRING);
$PorcentajePlan_1 = (int) $PorcentajePlan_1;

$PorcentajePlan_2 = filter_var(trim($_POST["PorcentajePlanMax"]), FILTER_SANITIZE_STRING);
$PorcentajePlan_2 = (int) $PorcentajePlan_2;

$fijoPlan = filter_var(trim($_POST["fijoPlan"]), FILTER_SANITIZE_STRING);
$fijoPlan_1 = filter_var(trim($_POST["fijoPlan"]), FILTER_SANITIZE_STRING);
$fijoPlan = (int) $fijoPlan;

if ($PorcentajePlan_1 === 0 && $fijoPlan === 0) {
    $Err_cons .= "porcentaje y valor fijo no pueden ser 0 al mismo tiempo.<br>";
    $proceso = false;
}elseif ($PorcentajePlan_1 > 0 && $fijoPlan > 0){
    $Err_cons .= "porcentaje y valor fijo no pueden ser mayor a 0 al mismo tiempo.<br>";
    $proceso = false;
}elseif($PorcentajePlan_1 > 100){
    $Err_cons .= "valor incorrecto ingresado en el porcentaje del plan.<br>";
    $proceso = false;
}

if ($PorcentajePlan_1 > $PorcentajePlan_2) {
    $Err_cons .= "porcentaje mínimo de bebe ser menor<br>";
    $proceso = false;
}elseif ($PorcentajePlan_2 > 0 && $fijoPlan > 0){
    $Err_cons .= "porcentaje y valor fijo no pueden ser mayor a 0 al mismo tiempo.<br>";
    $proceso = false;
}elseif($PorcentajePlan_2 > 100){
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
    $PorcentajePlan_1 = mysqli_real_escape_string($conn, $PorcentajePlan_1);
    $PorcentajePlan_2 = mysqli_real_escape_string($conn, $PorcentajePlan_2);
    $fijoPlan = mysqli_real_escape_string($conn, $fijoPlan);
    $tiempoPlan = mysqli_real_escape_string($conn, $tiempoPlan);
    $visible = mysqli_real_escape_string($conn, $visible);

    $sql = "INSERT INTO planes (plan, items, descripcion, porcentajeMin, porcentajeMax, fijo, id_interes, id_Retiros, tiempo, visibilidad, Nivel, referidos, pagos) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssssssssss", $NombrePlan, $items_lista, $descripcion, $PorcentajePlan_1, $PorcentajePlan_2, $fijoPlan, $interes, $retiros, $tiempoPlan, $visible,$nivelMaximo,$cadenaFinalReferidos,$invPagos);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $Err_cons = $NombrePlan = $items = $descripcion = $PorcentajePlan_1 = $PorcentajePlan_2 = $fijoPlan = $tiempoPlan = $mensaje_error = '';
        $NombrePlan_1 = $items_1 = $descripcion_1 = $fijoPlan_1 = $tiempoPlan_1 = $mensaje_error_1 = $interes = $retiros = '';

        header("Location: planesAdmin.php");

    } else {
        echo "Error en la preparación de la consulta.";
    }

    mysqli_close($conn);
}