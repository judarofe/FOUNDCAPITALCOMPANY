<?php

function encoded($valor){
    $base64 = base64_encode($valor);
    $rot13 = str_rot13($base64);

    return $rot13;
}

function decoded($valor){
    $base64 = str_rot13($valor);
    $dato = base64_decode($base64);

    return $dato;
}

?>