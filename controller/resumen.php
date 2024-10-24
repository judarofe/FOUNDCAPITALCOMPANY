<?php
    require_once('../../config-ext.php');

    $sql_1 = "SELECT SUM(cantidad) AS total_cantidad FROM depositos WHERE id_user = ? AND estado = 1";
    $stmt_1 = $conn->prepare($sql_1);
    $stmt_1->bind_param("i", $id_user);
    $stmt_1->execute();
    $result_1 = $stmt_1->get_result();
    $total_cantidad = 0;

    if ($result_1->num_rows > 0) {
        $row = $result_1->fetch_assoc();
        $total_cantidad = !empty($row['total_cantidad']) ? $row['total_cantidad'] : 0;
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
    $total_liderazgo = number_format($total_liderazgo, 2, '.', ',');
?>