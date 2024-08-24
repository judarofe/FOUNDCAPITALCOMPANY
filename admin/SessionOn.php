<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true){
    session_destroy();
    header("location: ../index.php");
    exit;
}

if(isset($_POST['logout'])) {
    session_destroy();
    header("Location: ../index.php");
    exit;
}

if(!isset($_SESSION["id_user"]) || empty($_SESSION["id_user"])){
    header("location: ../index.php");
    session_destroy();
    exit;
}

$UserTipo = $_SESSION['UserTipo'];
if ($UserTipo != "1"){
    header("location: location: ../dashboard.php");
}

$userName = $_SESSION['userName'];
$email = $_SESSION['email'];
$Nombre = $_SESSION['Nombre'];
$Apellido = $_SESSION['Apellido'];
$Iduser = $_SESSION['Iduser'];