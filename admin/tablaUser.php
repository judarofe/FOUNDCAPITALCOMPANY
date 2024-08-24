<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['idUser'])) {
        $idUser = filter_input(INPUT_POST, 'idUser', FILTER_SANITIZE_STRING);
        if ($idUser !== null) {
            require_once("../../../config-ext.php");
            $users = "";
            $sql="SELECT id_user, nombre, apellido, email, username FROM user WHERE id_user = $idUser";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $users .= $row['nombre'].",".$row['apellido'].",".$row['username'].",".$row['email'].",".$row['id_user'];
                }
            }
            echo $users;
        } else {
            return;
        }
    }else{
        return;
    }
}else{
    return;
}
