<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../../../config-ext.php');
    $dato = filter_input(INPUT_POST, 'dato', FILTER_SANITIZE_URL);
    $dato = htmlspecialchars($dato);
    $Iduser = filter_input(INPUT_POST, 'Iduser', FILTER_SANITIZE_URL);
    $Iduser = htmlspecialchars($Iduser);
    $resultadoBilletera = "";

    $sql = "DELETE FROM billeterauser WHERE id_billeteraUser = $dato";

    if ($conn->query($sql) === TRUE) {
        $sql1 = "SELECT b.id_billeteraUser, w.nombre, b.link 
                    FROM billeterauser b
                    JOIN billetera w ON b.Id_billetera = w.Id_billetera
                    WHERE b.id_user = $Iduser";

        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0) {
            while($row1 = $result1->fetch_assoc()) {
                $resultadoBilletera .= '<tr>';
                $resultadoBilletera .= '<td>'.$row1['nombre'].'</td>';
                $resultadoBilletera .= '<td>'.$row1['link'].'</td>';
                $resultadoBilletera .= '<td><button class="btn btn-danger" type="button" onclick=eliminarBilletera("'.$row1['id_billeteraUser'].'")>X</button></td>';
                $resultadoBilletera .= '</tr>';
            }
        }

        echo $resultadoBilletera;
    } else {
        return;
    }
}else{
    return;
}