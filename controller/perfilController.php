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

$userName = $_SESSION['userName'];
$email = $_SESSION['email'];
$Nombre = $_SESSION['Nombre'];
$Apellido = $_SESSION['Apellido'];
$Iduser = $_SESSION['Iduser'];
$resultadoOption = "";

require_once('../../config-ext.php');

$sql = "SELECT id_billetera, nombre FROM billetera";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
       $resultadoOption .= '<option value="'.$row['id_billetera'].'">'.$row['nombre'].'</option>';
    }
}

$resultadoBilletera = "";

$sql1 = "SELECT b.id_billeteraUser, w.nombre, b.link 
        FROM billeterauser b
        JOIN billetera w ON b.Id_billetera = w.Id_billetera
        WHERE b.id_user = $Iduser";

$result1 = $conn->query($sql1);


if ($result1->num_rows > 0) {
    while($row1 = $result1->fetch_assoc()) {
        $resultadoBilletera .= '<tr>';
        $resultadoBilletera .= '<td>'.$row1['nombre'].'</td>';
        $resultadoBilletera .= '<td>'.$row1['link'].'</td>';
        $resultadoBilletera .= '<td><button type="button" class="btn btn-danger" onclick=eliminarBilletera("'.$row1['id_billeteraUser'].'")>X</button></td>';
        $resultadoBilletera .= '</tr>';
    }
}

$conn->close();
?>