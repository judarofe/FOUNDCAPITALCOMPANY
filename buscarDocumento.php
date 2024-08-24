<?php
if(isset($_POST['valor'])){
    require_once('../../config-ext.php');
    $valor = $_POST['valor'];
    $stmt = $conn->prepare("SELECT cedula FROM user WHERE id_user = ?");
    $stmt->bind_param("s", $valor);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $documento = $row['cedula'];
        if(empty($documento)){
            echo "no";
        }else{
            echo "si";
        }
    }
}
?>