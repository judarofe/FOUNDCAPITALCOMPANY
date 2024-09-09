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

$id_user = $_SESSION["id_user"];
require_once("../../../config-ext.php");
$stmt = $conn->prepare("SELECT * FROM user WHERE id_user = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $Nombre = htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8');
    $Apellido = htmlspecialchars($row['apellido'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
    $userName = htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8');
    $Iduser = htmlspecialchars($row['id_user'], ENT_QUOTES, 'UTF-8');

    $_SESSION['userName'] = $userName;
    $_SESSION['email'] = $email;
    $_SESSION['Nombre'] = $Nombre;
    $_SESSION['Apellido'] = $Apellido;
    $_SESSION['Iduser'] = $Iduser;
    $_SESSION["UserTipo"] = $row['UserTipo'];

    if($row['UserTipo'] != 1){
        header("location: ../dashboard.php");
        exit;
    }

}else{
    header("location: index.php");
    session_destroy();
    exit;
}