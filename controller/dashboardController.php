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

$id_user = $_SESSION["id_user"];
require_once('../../config-ext.php');
include("encoded.php");

$stmt = $conn->prepare("SELECT * FROM user WHERE id_user = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $Nombre = htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8');
    $Nombre = decoded($Nombre);
    $Apellido = htmlspecialchars($row['apellido'], ENT_QUOTES, 'UTF-8');
    $Apellido = decoded($Apellido);
    $email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
    $email = decoded($email);
    $userName = htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8');
    $Iduser = htmlspecialchars($row['id_user'], ENT_QUOTES, 'UTF-8');
    $UserTipo = htmlspecialchars($row['UserTipo'], ENT_QUOTES, 'UTF-8');
    $cedula = htmlspecialchars($row['cedula'], ENT_QUOTES, 'UTF-8');
    $cedula = decoded($cedula);


    $_SESSION['userName'] = $userName;
    $_SESSION['email'] = $email;
    $_SESSION['Nombre'] = $Nombre;
    $_SESSION['Apellido'] = $Apellido;
    $_SESSION['Iduser'] = $Iduser;
    $_SESSION['UserTipo'] = $UserTipo;
    $_SESSION['cedula'] = $cedula;

}else{
    header("location: index.php");
    session_destroy();
    exit;
}

if ($UserTipo === "1"){
    header("location: admin/index.php");
}
?>