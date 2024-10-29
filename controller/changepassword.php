<?php
include("encoded.php");
include("Mailer.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $EmailDecoded = filter_input(INPUT_POST, 'EmailUser', FILTER_SANITIZE_STRING);

    if($EmailDecoded === ""){
        header("Location: ../index.php");
        exit;
    }
    require_once('../../../config-ext.php');
    $EmailUser = encoded($EmailDecoded);
    $longitud = 8;
    $contraseña = generarContrasena($longitud);
    $hash = password_hash($contraseña, PASSWORD_ARGON2I);

    $stmt = $conn->prepare("UPDATE user SET contrasena = ? WHERE email = ?");
    $stmt->bind_param("ss", $hash, $EmailUser);
    $stmt->execute();

    enviaContraseña($contraseña, $EmailDecoded, $emailUser, $emailPass);
}

function generarContrasena($longitud) {

    $minusculas = 'abcdefghijklmnopqrstuvwxyz';
    $mayusculas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numeros = '0123456789';
    $noAlfanumericos = '!#$%&*()_+-=|,.?';

    $caracteres = $minusculas . $mayusculas . $numeros . $noAlfanumericos;

    $contrasena = '';
    $contrasena .= $minusculas[rand(0, strlen($minusculas) - 1)];
    $contrasena .= $mayusculas[rand(0, strlen($mayusculas) - 1)];
    $contrasena .= $numeros[rand(0, strlen($numeros) - 1)];
    $contrasena .= $noAlfanumericos[rand(0, strlen($noAlfanumericos) - 1)];

    for ($i = 4; $i < $longitud; $i++) {
        $contrasena .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }

    $contrasena = str_shuffle($contrasena);

    return $contrasena;
}