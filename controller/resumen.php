<?php
    require_once('../../config-ext.php');

    $totalValor = 0;

    $sql_1 = "SELECT SUM(cantidad) AS total_cantidad FROM depositos WHERE id_user = ? AND estado = 1";
    $stmt_1 = $conn->prepare($sql_1);
    $stmt_1->bind_param("i", $id_user);
    $stmt_1->execute();
    $result_1 = $stmt_1->get_result();
    $total_cantidad = 0;

    if ($result_1->num_rows > 0) {
        $row = $result_1->fetch_assoc();
        $total_cantidad = !empty($row['total_cantidad']) ? $row['total_cantidad'] : 0;
        $totalValor = $totalValor + $total_cantidad;
        $total_cantidad = number_format($total_cantidad, 2, '.', ',');
    }

    $total_intereses = 0;

    $sql_2 = "SELECT SUM(valor) AS totalPlanBeneficios 
            FROM beneficiosplan 
            WHERE user = ? AND fecha <= CURDATE()";
    $stmt_2 = $conn->prepare($sql_2);
    $stmt_2->bind_param("i", $id_user);
    $stmt_2->execute();
    $result_2 = $stmt_2->get_result();
    $row = $result_2->fetch_assoc();

    $total_intereses = !empty($row['totalPlanBeneficios']) ? $row['totalPlanBeneficios'] : 0;
    $totalValor = $totalValor + $total_intereses;
    $total_intereses = number_format($total_intereses, 2, '.', ',');

    $total_referidos = 0;
    $sql_3 = "SELECT SUM(valor) AS totalReferidos
                FROM beneficiosreferidos
                WHERE user = ?";
    $stmt_3 = $conn->prepare($sql_3);
    $stmt_3->bind_param("i", $id_user);
    $stmt_3->execute();
    $result_3 = $stmt_3->get_result();
    $row = $result_3->fetch_assoc();

    $total_referidos = !empty($row['totalReferidos']) ? $row['totalReferidos'] : 0;
    $totalValor = $totalValor + $total_referidos;
    $total_referidos = number_format($total_referidos, 2, '.', ',');

    $total_liderazgo = 0;
    $sql_4 = "SELECT SUM(valor) AS totalliderazgo
                FROM beneficiosliderazgo
                WHERE user = ?";
    $stmt_4 = $conn->prepare($sql_4);
    $stmt_4->bind_param("i", $id_user);
    $stmt_4->execute();
    $result_4 = $stmt_4->get_result();
    $row = $result_4->fetch_assoc();

    $total_liderazgo = !empty($row['totalliderazgo']) ? $row['totalliderazgo'] : 0;
    $totalValor = $totalValor + $total_liderazgo;
    $total_liderazgo = number_format($total_liderazgo, 2, '.', ',');

    $rangoActual_5 = 0;
    $rangoActual = "";
    $sql_5 = "SELECT b.rango AS rango, l.rango AS nombre
        FROM beneficiosliderazgo b
        JOIN liderazgo l ON b.rango = l.id
        WHERE user = ? ORDER BY b.id DESC LIMIT 1";
    $stmt_5 = $conn->prepare($sql_5);
    $stmt_5->bind_param("i", $id_user);
    $stmt_5->execute();
    $result_5 = $stmt_5->get_result();

    if ($row_5 = $result_5->fetch_assoc()) {
        $rangoActual_5 = isset($row_5['rango']) ? $row_5['rango'] : 0;
    }

    if($rangoActual_5 == 0 || $rangoActual_5 == 1){
        $rangoActual = '<img src="img/home/planComercial.png" class="svgCard">';
        $nombreRAngo = "<br>";
    }else{
        $rangoActual = '<img src="img/rango/'.$rangoActual_5.'.png" class="svgCard" alt="'.$rangoActual_5.'">';
        $nombreRAngo = $row_5['nombre'];
    }

    $equipo = equipo($id_user, $conn);
    $equipo = substr($equipo, 0, -1);
    $volumen = volumen($equipo, $conn);
    $volumen = number_format($volumen, 2, '.', ',');

    $totalValor = number_format($totalValor, 2, '.', ',');

    function equipo($id_user, $conn) {
        $Registro = "";
        $sql = "SELECT hijo FROM referidos WHERE padre = $id_user";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $Registro .= $row["hijo"].",";
                $Registro .= equipo($row["hijo"], $conn);
            }
        }
    
        return $Registro;
    }
    
    function volumen($equipo, $conn){
        $array = explode(",", $equipo);
        $inversion = 0;
        foreach ($array as $datos){
            $inversion = $inversion + inversionPersonal($datos, $conn);
        }
    
        return $inversion;
    }

    function inversionPersonal($id_user, $conn) {
        $sql = "SELECT SUM(cantidad) AS total_cantidad FROM depositos WHERE id_user = ? AND estado = 1";
        $stmt = $conn->prepare($sql);
        
        if ($stmt === false) {
            return 0;
        }
    
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $total_cantidad = !empty($row['total_cantidad']) ? $row['total_cantidad'] : 0;
            return $total_cantidad;
        } else {
            return 0;
        }
    }
?>