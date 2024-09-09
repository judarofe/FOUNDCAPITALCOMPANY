<?php
require_once('../../config-ext.php');
$resultadoOption = "";

$sql = "SELECT * FROM billeterauser WHERE id_user = $Iduser";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
       $resultadoOption .= '<option value="'.$row['id_billeteraUser'].'">'.$row['link'].'</option>';
    }
}