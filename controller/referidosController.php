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
require_once('../../config-ext.php');

$userName = $_SESSION['userName'];
$email = $_SESSION['email'];
$Nombre = $_SESSION['Nombre'];
$Apellido = $_SESSION['Apellido'];
$Iduser = $_SESSION["id_user"];

$sql_1 = "SELECT fecha, valor, referido FROM beneficiosreferidos WHERE user = ? AND valor > 0 ORDER BY fecha DESC";
$stmt_1 = $conn->prepare($sql_1);
$stmt_1->bind_param("i", $Iduser);
$stmt_1->execute();
$result_1 = $stmt_1->get_result();

$referidosRegistro = '';
$total = 0;

if ($result_1->num_rows > 0) {
    $rows = [];
    while($row_1 = $result_1->fetch_assoc()) {
        $nivelDeReferido = nivelReferido($row_1['referido'], $Iduser, $conn);
        $nivelDeReferido = explode(",", $nivelDeReferido);
        $nivelDeReferido = count($nivelDeReferido);
        $total = $total + $row_1['valor'];

        $rows[] = '<tr>
            <td>'.$row_1['fecha'].'</td>
            <td>'.$nivelDeReferido.'</td>
            <td>&#36;US '.number_format($row_1['valor'], 2, '.', ',').'</td>
        </tr>';
    }
    $referidosRegistro = implode("", $rows);
}

function nivelReferido($referido, $Iduser, $conn){
    $a=0;
    $Registro = "";
    $sql="SELECT padre FROM referidos WHERE hijo = $referido";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            if($row["padre"] != $Iduser){
                $Registro .= $row["padre"].",";
                $Registro .= nivelReferido($row["padre"], $Iduser, $conn);
            }else{
                return $row["padre"];
            }
        }
    }

    return $Registro;
}