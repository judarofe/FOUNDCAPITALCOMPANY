<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once("../../../config-ext.php");

    $identificador = $_POST["identificador"];
    $tabla = $_POST["tabla"];
    $identificador = $conn->real_escape_string($identificador);
    $tabla = $conn->real_escape_string($tabla);

    $sql = "SHOW COLUMNS FROM `$tabla`";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $primeraColumna = $result->fetch_assoc();
        $nombrePrimeraColumna = $primeraColumna['Field'];

        $stmt = $conn->prepare("DELETE FROM $tabla WHERE $nombrePrimeraColumna = ?");
        $stmt->bind_param("i", $identificador);
    
        if ($stmt->execute()) {
            echo "Registro eliminado correctamente.";
        } else {
            echo "Error al eliminar el registro: " . $stmt->error;
        }
    
        $stmt->close();
    }
            
    mysqli_close($conn);
}