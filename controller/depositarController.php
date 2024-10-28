<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true){
    session_destroy();
    header("location: index.php");
    exit;
}

if(isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

if(!isset($_SESSION["id_user"]) || empty($_SESSION["id_user"])){
    header("location: index.php");
    session_destroy();
    exit;
}

$UserTipo = $_SESSION['UserTipo'];
if ($UserTipo === "1"){
    header("location: admin/index.php");
}

include("encoded.php");

if(isset($_GET['mensaje'])){
    $variable1 = $_GET['mensaje'];
    if($variable1 === "Su depósito ha sido enviado para su revisión"){
        $variable1 = '<div class="alert alert-success" role="alert">
        '.$variable1.'
      </div>';
    }else{
        $variable1 = '<div class="alert alert-danger" role="alert">
        '.$variable1.'
      </div>';
    }
} else {
    $variable1 = "";
}

$userName = $_SESSION['userName'];
$email = $_SESSION['email'];
$Nombre = $_SESSION['Nombre'];
$Apellido = $_SESSION['Apellido'];
$Iduser = $_SESSION["id_user"];

require_once('../../config-ext.php');
$planes = "";

$sql = "SELECT * FROM planes WHERE visibilidad = 1";

$result = $conn->query($sql);
$selectPlanes = "";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cadena = "";
        $listado = "";
        $selectPlanes .= '<option value="'.$row['id_plan'].'">'.$row['plan'].'</option>';
       $planes .= '
        <article>
            <div class="tarjeta">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <h5 class="card-title">'.$row['plan'].'</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">OBTENGA SU PRIMERA GANANCIA</h6>
                            </div>
                            <div class="col-3">
                                <img src="img/home/planComercial.png" alt="">
                            </div>
                        </div>';
        $cadena = $row['items'];
        $elementos = explode("|", $cadena);
        foreach ($elementos as $elemento) {
            $listado .= '<p class="card-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32.42" height="25.5" viewBox="0 0 32.42 25.5">
                                <path id="Trazado_376" data-name="Trazado 376" d="M340.913,6932.681l7.98,7.98,22.319-22.318" transform="translate(-339.853 -6917.282)" fill="none" stroke="#39b54a" stroke-miterlimit="10" stroke-width="3"/>
                            </svg>
                            '.$elemento.'
                        </p>';
        }
        $planes .= $listado.'
                    </div>
                    <br>
                    <button type="button" class="btn btn-articule" onclick="depositarModal('.$row['id_plan'].')">Abrir cuenta comercial</button>
                    <p class="text-center">*Términos y condiciones</p>
                </div>
            </div>
        </article>
       ';
    }
}

$sql = "SELECT d.id_depositos, d.fecha, d.cantidad, d.estado, d.fechafinal, p.plan, p.porcentajeMin, p.porcentajeMax, p.fijo, p.tiempo, p.pagos
FROM depositos AS d
JOIN planes AS p ON d.id_plan = p.id_plan
WHERE d.id_user = $Iduser";
$result = $conn->query($sql);
$totalDepositado = 0;
$depositosAll = "";
$beneficios = 0;
$Totalbeneficios = 0;
$colorAlert = "";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $inicio = $row["fecha"];
        $cantidad = $row["cantidad"];
        $plan = $row["plan"];
        $fechafinal = $row["fechafinal"];
        $idDeposito = $row["id_depositos"];
        $porcentajeMin = $row["porcentajeMin"];
        $porcentajeMax = $row["porcentajeMax"];
        $fijo = $row["fijo"];
        $ganancias = $fijo != "0" ? "% ".$fijo : "% ".$porcentajeMin." - % ".$porcentajeMax;
        $estado = $row["estado"];

        $tiempoBD = $row["tiempo"];
        $tiempoArray = explode(",", $tiempoBD);
        $duracion = $tiempoArray[0];
        $multiplicador = $tiempoArray[1];

        switch ($duracion){
            case 1:
                $tiempo = "Día (x".$multiplicador.")";
                break;
            case 2:
                $tiempo = "Semana (x".$multiplicador.")";
                break;
            case 3:
                $tiempo = "Mes (x".$multiplicador.")";
                break;
            case 4:
                $tiempo = "Año (x".$multiplicador.")";
                break;
        }

        $fechaInicio = date('Y-m-d', strtotime($inicio));
        $beneficios = buscarBeneficios($Iduser, $idDeposito, $conn);
        $registrosPagos = registrosPagos($Iduser, $idDeposito, $conn);

        if($estado != "4"){
            if ($estado === "0"){
                $final = "En espera";
                $beneficios = 0;
                $colorAlert = 'class="table-warning"';
            }elseif($estado === "1"){
                $colorAlert = 'class="table-danger"';
                $final = $fechafinal;
            }elseif($estado === "2"){
                $final = "finalizado";
                $colorAlert = 'class="table-danger"';
            }elseif($estado === "3"){
                $final = "Retiro en proceso";
                $colorAlert = 'class="table-info"';
            }

            $Totalbeneficios = $Totalbeneficios + $beneficios;
            
            $depositosAll .=    '<tr>
                                <td>'.$fechaInicio.'</td>
                                <td>&#36;US '.number_format($cantidad, 2, '.', ',').'</td>
                                <td>'.$plan.' ('.$ganancias.')</td>
                                <td>&#36;US '.number_format(round($beneficios, 2), 2, '.', ',').'</td>
                                <td>'.$tiempo.'</td>
                                <td '.$colorAlert.'><strong>'.$final.'</strong></td>'.$registrosPagos;
        }
    } 
}

// -----------------------------------------------------

    $totalValor = 0;

    $sql_1 = "SELECT SUM(cantidad) AS total_cantidad FROM depositos WHERE id_user = ? AND estado = 1";
    $stmt_1 = $conn->prepare($sql_1);
    $stmt_1->bind_param("i", $Iduser);
    $stmt_1->execute();
    $result_1 = $stmt_1->get_result();
    $total_cantidad = 0;

    if ($result_1->num_rows > 0) {
        $row = $result_1->fetch_assoc();
        $total_cantidad = !empty($row['total_cantidad']) ? $row['total_cantidad'] : 0;
        $totalValor = $totalValor + $total_cantidad;
        $total_cantidad = number_format($total_cantidad, 2, '.', ',');
    }

    $total_intereses = 0;

    $sql_2 = "SELECT SUM(valor) AS totalPlanBeneficios 
            FROM beneficiosplan 
            WHERE user = ? AND fecha <= CURDATE()";
    $stmt_2 = $conn->prepare($sql_2);
    $stmt_2->bind_param("i", $Iduser);
    $stmt_2->execute();
    $result_2 = $stmt_2->get_result();
    $row = $result_2->fetch_assoc();

    $total_intereses = !empty($row['totalPlanBeneficios']) ? $row['totalPlanBeneficios'] : 0;
    $totalValor = $totalValor + $total_intereses;
    $total_intereses = number_format($total_intereses, 2, '.', ',');

// -----------------------------------------------------

function registrosPagos($Iduser, $idDeposito, $conn){
    $sql = "SELECT fecha, valor
    FROM beneficiosplan 
    WHERE user = ? AND id_deposito = ? AND fecha <= CURDATE()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $Iduser, $idDeposito);
    $stmt->execute();
    $result = $stmt->get_result();
    $tabla = '<tr>
        <td colspan="6">
            <div class="accordion" id="accordionPlan'.$Iduser.'_'.$idDeposito.'">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button btn-sm py-1 px-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne'.$Iduser.'_'.$idDeposito.'" aria-expanded="false" aria-controls="collapseOne">
                            Ver extractos
                        </button>
                    </h2>
                <div id="collapseOne'.$Iduser.'_'.$idDeposito.'" class="accordion-collapse collapse" data-bs-parent="#accordionPlan'.$Iduser.'_'.$idDeposito.'">
            <div class="accordion-body">  
                <table class="table table-striped table-sm">
                    <tr class="table-dark">
                        <th>Fecha</th>
                        <th>Valor</th>
                    <tr>';
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $tabla .= '<tr>
                                <td>
                                    '.$row['fecha'].'
                                </td>
                                <td>
                                    '.$row['valor'].'
                                </td>
                            </tr>';
                        }
                $tabla .= '</table>
            </div>
        </td>
    </tr>';

    }else{
        $tabla = '';
    }

    

    return $tabla;
}

function buscarBeneficios($Iduser, $idDeposito, $conn) {
    $sql = "SELECT SUM(valor) AS totalPlanBeneficios 
            FROM beneficiosplan 
            WHERE user = ? AND id_deposito = ? AND fecha <= CURDATE()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $Iduser, $idDeposito);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['totalPlanBeneficios'];
}