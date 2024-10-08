<?php
    require_once("../../../config-ext.php");
    include("../controller/encoded.php");
    
    $sql="  SELECT d.id_depositos, u.id_user, u.nombre, u.apellido, u.email, p.plan, p.porcentajeMin, p.porcentajeMax, p.fijo, p.tiempo, b.link, d.fecha, d.cantidad, d.archivo, d.estado
    FROM depositos d
    JOIN user u ON d.id_user = u.id_user
    JOIN planes p ON d.id_plan = p.id_plan
    JOIN billeterauser b ON d.id_billetera = b.id_billeteraUser
    ORDER BY d.estado ASC, d.fecha ASC";
    
    $resultadosDepositos = "";
    $datos = "";

    $resultados = $conn->query($sql);

    if($resultados->num_rows > 0){
        while($row = $resultados->fetch_assoc()) {
            $nombre = decoded($row['nombre']);
            $apellido = decoded($row['apellido']);
            $email = decoded($row['email']);

            $datos = $row['id_depositos'].",".$row['id_user'].",".$nombre.",".$apellido.",".$email.",".$row['plan'].",".$row['porcentajeMin'].",".$row['porcentajeMax'].",".$row['fijo'].",".$row['tiempo'].",".$row['link'].",".$row['fecha'].",".$row['cantidad'].",".$row['archivo'].",".$row['estado'].",".$row['id_interes'];

            if($row['estado'] === "0"){
                $estado = "<td class=\"table-danger\"><button type=\"button\" class=\"btn btn-danger\" onclick=\"procesar('".$row['id_depositos']."')\">Aceptar</button></td>";
            }
            if($row['estado'] === "1"){
                $estado = "<td class=\"table-warning\"><button type=\"button\" class=\"btn btn-warning\" onclick=\"aceptar('".$row['id_depositos']."')\">Finalizar</button></td>";
            }
            if($row['estado'] === "2"){
                $estado = "<td class=\"table-success\">Finalizado</td>";
            }
            if($row['estado'] === "3"){
                $estado = "<td class=\"table-warning\">Retiro en Proceso</td>";
            }
            if($row['estado'] === "4"){
                $estado = "<td class=\"table-secondary\">Retirado</td>";
            }
                $resultadosDepositos .= "<tr><td>".$nombre." ".$apellido."</td><td>".$row['plan']."</td><td>".$row['link']."</td><td>".$row['fecha']."</td><td>".$row['cantidad']."</td><td><a target=\"_blank\" href=\"".$row['archivo']."\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-search\" viewBox=\"0 0 16 16\"><path d=\"M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0\"/></svg></a></td>".$estado."</tr>";
                $resultadosDepositos .="<input type=\"hidden\" id=\"dato_".$row['id_depositos']."\" value=\"".$datos."\">";
        }
    }
?>