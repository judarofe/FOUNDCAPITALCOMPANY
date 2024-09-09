<?php

function generarCodigo(){
    $caracteres = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
    $codigo = '';
    $longitud = 6;

    for ($i = 0; $i < $longitud; $i++) {
        $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }

    return $codigo;
}

?>