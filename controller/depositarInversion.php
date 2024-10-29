<?php
require_once('../../../config-ext.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dato = filter_input(INPUT_POST, 'dato', FILTER_VALIDATE_INT);

    if ($conn) {
        $stmt = $conn->prepare("SELECT pagos FROM planes WHERE id_plan = ?");
        
        if ($stmt) {
            $stmt->bind_param("i", $dato);
            
            if ($stmt->execute()) {
                $stmt->bind_result($pagos);
                if ($stmt->fetch()) {
                    $pagosArray = explode(',', $pagos);

                    foreach ($pagosArray as $pago) {
                        $pago = trim($pago);
                        $inputPagos .= '<option value="' . htmlspecialchars($pago) . '">' . htmlspecialchars($pago) . '</option>';
                    }

                    echo $inputPagos;
                }
            }            
            $stmt->close();
        }
    }
}
?>