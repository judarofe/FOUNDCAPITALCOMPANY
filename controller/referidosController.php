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

if ($result_1->num_rows > 0) {
    $rows = [];
    while($row_1 = $result_1->fetch_assoc()) {
        $rows[] = '<tr>
            <td>'.$row_1['fecha'].'</td>
            <td>'.$row_1['referido'].'</td>
            <td>'.$row_1['valor'].'</td>
        </tr>';
    }
    $referidosRegistro = implode("", $rows);
}