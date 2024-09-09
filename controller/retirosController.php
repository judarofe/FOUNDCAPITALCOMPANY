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
$Iduser = $_SESSION['id_user'];

require_once('../../config-ext.php');

// Utilizar sentencias preparadas para evitar la inyección de SQL
$stmt = $conn->prepare("SELECT d.id_depositos, d.fecha, d.id_plan, d.cantidad, d.estado, p.plan, p.porcentaje, p.fijo, p.tiempo
FROM depositos AS d
JOIN planes AS p ON d.id_plan = p.id_plan
WHERE d.id_user = ?");
$stmt->bind_param("i", $Iduser);
$stmt->execute();
$result = $stmt->get_result();

$selectPlanes = "";
$final = "";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($row['estado'] === 1 || $row['estado'] === 2){
            $imprime = true;
            $inicio = $row["fecha"];
            $tiempo = $row["tiempo"];
            $estado = $row["estado"];

            $fechaInicio = date('Y-m-d', strtotime($inicio));
            $hoy = date('Y-m-d');
            $diferencia = strtotime($hoy) - strtotime($fechaInicio);
            $dias = $diferencia / (60 * 60 * 24);

            if ($estado === 1){
                if($dias >= $tiempo){
                    $final = "finalizado";
                }else{
                    $imprime = false;
                }
            }elseif($estado === 2){
                $final = "finalizado";
            }

            if($imprime){
            $selectPlanes .= '<option value="'.$row['id_depositos'].'">['.$row['plan'].'][&#36;US: '.$row['cantidad'].']['.$final.']</option>';
            }
        }
    }
}

$sql2 = "SELECT r.fecha, r.cantidad, r.estado, p.plan
        FROM retiros AS r
        JOIN depositos AS d ON r.id_depositos = d.id_depositos
        JOIN planes AS p ON d.id_plan = p.id_plan
        WHERE r.id_user = $Iduser";

$tablaRetiros = "";
$result2 = $conn->query($sql2);

// Mostrar en una tabla
if ($result2->num_rows > 0) {

    while($row2 = $result2->fetch_assoc()) {
        if($row2["estado"] === "1"){
            $tablaRetiros .= "<td>" . $row2["fecha"] . "</td>";
            $tablaRetiros .= "<td>" . $row2["cantidad"] . "</td>";
            $tablaRetiros .= "<td>" . $row2["plan"] . "</td>";
        }
    }

}