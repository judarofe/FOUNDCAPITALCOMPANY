<?php
require_once('../../config-ext.php');
$resultadoOption = "";
$mensajeBilletera = "";

$sql = "SELECT * FROM billeterauser WHERE id_user = $Iduser";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
       $resultadoOption .= '<option value="'.$row['id_billeteraUser'].'">'.$row['link'].'</option>';
    }
}else{
    $mensajeBilletera = '<div class="alert alert-danger" role="alert">
    No has agregado una billetera. Para continuar, ve a tu <a class="btn btn-outline-danger" href="perfil.php">perfil<a> y selecciona la opción \'Billeteras\'. Allí podrás agregar tu billetera para habilitar la realización de depósitos.
  </div>
  ';
}