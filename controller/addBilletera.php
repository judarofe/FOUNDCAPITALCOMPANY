<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Billetera']) && isset($_POST['linkBilletera'])) {
        
        $Billetera = filter_input(INPUT_POST, 'Billetera', FILTER_SANITIZE_STRING);
        $Billetera = htmlspecialchars($Billetera);
        $linkBilletera = filter_input(INPUT_POST, 'linkBilletera', FILTER_SANITIZE_URL);
        $linkBilletera = htmlspecialchars($linkBilletera);
        $Iduser = filter_input(INPUT_POST, 'Iduser', FILTER_SANITIZE_STRING);
        $Iduser = htmlspecialchars($Iduser);
        $resultadoBilletera = "";

        require_once('../../../config-ext.php');

        $sql = "INSERT INTO billeterauser (id_user, Id_billetera, link) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $Iduser, $Billetera, $linkBilletera);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {

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
        }

        echo $resultadoBilletera;

    } else {
        return;
    }
} else {
    return;
}