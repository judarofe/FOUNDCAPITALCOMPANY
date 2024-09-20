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

$sql = "SELECT d.id_depositos, d.fecha, d.cantidad, d.estado, p.plan, p.porcentaje, p.fijo, p.tiempo, p.pagos
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
        $porcentaje = $row["porcentaje"];
        $fijo = $row["fijo"];
        $ganancias = $porcentaje === "0" ? "&#36;US ".$fijo : "% ".$porcentaje;
        $tiempo = $row["tiempo"];
        $estado = $row["estado"];

        $fechaInicio = date('Y-m-d', strtotime($inicio));
        $hoy = date('Y-m-d');
        $diferencia = strtotime($hoy) - strtotime($fechaInicio);
        $dias = $diferencia / (60 * 60 * 24);
        
        if($estado != "4"){
            if ($estado === "0"){
                $final = "En espera";
                $beneficios = 0;
                $colorAlert = 'class="table-warning"';
            }elseif($estado === "1"){
                $totalDepositado = $totalDepositado + floatval($cantidad);
                if($dias >= $tiempo){
                    $final = "finalizado";
                    $colorAlert = 'class="table-danger"';
                    if($porcentaje === "0"){
                        $beneficios = round(intval($tiempo)/30)*(intval($fijo));
                    }else{
                        $beneficios = round(intval($tiempo)/30)*(floatval($cantidad)*(intval($porcentaje)/100));
                    }
                }else{
                    $colorAlert = 'class="table-success"';
                    $final = date('Y-m-d', strtotime($inicio . ' +'.$tiempo.' days'));
                    if($porcentaje === "0"){
                        $beneficios = round(((round(intval($tiempo)/30)*(intval($fijo)))/$tiempo)*$dias);
                    }else{
                        $beneficios = round(((round(intval($tiempo)/30)*(floatval($cantidad)*(intval($porcentaje)/100)))/$tiempo)*$dias);
                    }
                }
            }elseif($estado === "2"){
                $final = "finalizado";
                $colorAlert = 'class="table-danger"';
                $totalDepositado = $totalDepositado + floatval($cantidad);
                if($porcentaje === "0"){
                    $beneficios = round(intval($tiempo)/30)*(intval($fijo));
                }else{
                    $beneficios = round(intval($tiempo)/30)*(floatval($cantidad)*(intval($porcentaje)/100));
                }
            }elseif($estado === "3"){
                $final = "Retiro en proceso";
                $colorAlert = 'class="table-info"';
                $totalDepositado = $totalDepositado + floatval($cantidad);
                $beneficios = 0;
                if($porcentaje === "0"){
                    $beneficios = round(intval($tiempo)/30)*(intval($fijo));
                }else{
                    $beneficios = round(intval($tiempo)/30)*(floatval($cantidad)*(intval($porcentaje)/100));
                }
            }

            $Totalbeneficios = $Totalbeneficios + $beneficios;
            
            $depositosAll .=    '<tr>
                                <td>'.$fechaInicio.'</td>
                                <td>'.$cantidad.'</td>
                                <td>'.$plan.' ('.$ganancias.')</td>
                                <td>&#36;US '.$beneficios.'</td>
                                <td>'.$tiempo.'</td>
                                <td '.$colorAlert.'><strong>'.$final.'</strong></td></tr>';
        }
    }
}