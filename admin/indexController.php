<?php
require_once("../../../config-ext.php");
$users = "";
$sql="SELECT * FROM user WHERE UserTipo = '2'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users .= "<tr><td>".$row['nombre']." ".$row['apellido']."</td><td>".$row['username']."</td><td>".$row['email']."</td><td><button id=\"btnActualizar\" type=\"button\" class=\"btn btn-primary\" onclick=\"Actualizar(".$row['id_user'].")\">Actualizar</button></td></tr>";
    }
}