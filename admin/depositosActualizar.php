<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idDeposito = filter_input(INPUT_POST, 'idDeposito', FILTER_SANITIZE_NUMBER_INT);
    $valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_INT);

    if ($idDeposito !== null && $valor !== null){
        require_once("../../../config-ext.php");

        if($valor === "2"){
            $fecha = date('Y-m-d H:i:s');
            $sql = "UPDATE depositos SET estado = ?, fecha = ? WHERE id_depositos = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isi", $valor, $fecha, $idDeposito);
        }else{
            $sql = "UPDATE depositos SET estado = ? WHERE id_depositos = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $valor, $idDeposito);
        }

        if ($stmt->execute()) {
            echo "OK";
        }
        $stmt->close();
        $conn->close();
    } else {
        return;
    }
}
?>