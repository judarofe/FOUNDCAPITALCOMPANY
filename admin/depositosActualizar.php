<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once("../../../config-ext.php");

    $datos = filter_var($_POST["datos"], FILTER_SANITIZE_STRING);
    $arraydatos = explode(",", $datos);

    $id_depositos = $arraydatos[0];

    $id_user = $arraydatos[1];
 
    $nombre = $arraydatos[2];
    $apellido = $arraydatos[3];
    $email = $arraydatos[4];
    $plan = $arraydatos[5];
    $porcentajeMin = empty($arraydatos[6]) || $arraydatos[6] == 0 ? "" : $arraydatos[6];
    $porcentajeMax = empty($arraydatos[7]) || $arraydatos[7] == 0 ? "" : $arraydatos[7];
    $fijo = empty($arraydatos[8]) || $arraydatos[8] == 0 ? "" : $arraydatos[8];

    $tiempo = $arraydatos[9];
    $multiplicador = $arraydatos[10];
    $billetera = $arraydatos[11];
    $fecha = $arraydatos[12];
    $inversion = $arraydatos[13];
    $hash = $arraydatos[14];
    $estado = $arraydatos[15];
    $id_interes = $id_interes[16];

    $inversionPersonal = inversionPersonal($id_user, $conn);
    $equipo = equipo($id_user, $conn);
    $equipo = substr($equipo, 0, -1);
    $volumen = volumen($equipo, $conn);
    $rango = rango($inversionPersonal, $volumen, $conn);
    $beneficioRango = cargarrango($id_user, $rango, $conn);
    $diaInicial = diaInicial();
    $diaFinal = diaFinal($diaInicial, $tiempo, $multiplicador);
    $contarDias = contarDias($diaInicial, $diaFinal);
    
    echo "Inversion personal: ".$inversionPersonal."<br>";
    echo "Niveles: ".$equipo."<br>";
    echo "Volumen: ".$volumen."<br>";
    echo "Rango: ".$rango."<br>";
    echo "Beneficio: ".$beneficioRango."<br>";
    echo "Dia incial: ".$diaInicial."<br>";
    echo "Dia final: ".$diaFinal."<br>";
    echo "Dias habiles: ".$contarDias."<br>";
    
    if($fijo !== ""){
        $ganancias = gananciasDiarias($inversion, $multiplicador, $fijo, $contarDias);
        echo "ganancias diarias: ".$ganancias."<br>";
    }
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

function rango($inversionPersonal, $volumen, $conn) {

    $stmt = $conn->prepare("SELECT id FROM liderazgo WHERE inversionpersonal <= ? AND volumendered <= ? ORDER BY inversionpersonal DESC, volumendered DESC LIMIT 1");
    $stmt->bind_param("dd", $inversionPersonal, $volumen);
    $stmt->execute();
    $result = $stmt->get_result();
    $registros = null;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $registros = $row["id"];
    }

    $stmt->close();

    return $registros;
}

function cargarrango($id_user, $rango, $conn) {

    $stmt = $conn->prepare("
        SELECT l.bono
        FROM liderazgo l
        LEFT JOIN beneficiosliderazgo bl ON bl.user = ? AND bl.rango = l.id
        WHERE l.id = ? AND bl.user IS NULL
    ");

    $stmt->bind_param("ii", $id_user, $rango);
    $stmt->execute();
    $stmt->bind_result($bono);
    $stmt->fetch();
    $stmt->close();
    if ($bono === null) {
        return null;
    }
    $stmt = $conn->prepare("
        INSERT INTO beneficiosliderazgo (user, fecha, valor, rango)
        VALUES (?, NOW(), ?, ?)
    ");

    $stmt->bind_param("iii", $id_user, $bono, $rango);
    
    if (!$stmt->execute()) {
        echo "Error en la ejecución: " . $stmt->error;
        return null;
    }

    $stmt->close();
    return $bono;
}

function diaInicial(){
    $fechaActual = new DateTime();
    $dia = $fechaActual->format('N');

    if ($dia == 5) {
        $fechaActual->modify('+3 days');
    } elseif ($dia == 6) {
        $fechaActual->modify('+2 days');
    } elseif ($dia == 7) {
        $fechaActual->modify('+1 day');
    } else {
        $fechaActual->modify('+1 day');
    }

    return $fechaActual->format('Y-m-d');
}

function diaFinal($diaInicial, $tiempo, $multiplicador){

    $fechaFinal = new DateTime($diaInicial);

    switch ($tiempo) {
        case 1: // Días hábiles
            $diasAgregados = 0;
            while ($diasAgregados < $multiplicador) {
                $fechaFinal->modify('+1 day');
                if ($fechaFinal->format('N') < 6) {
                    $diasAgregados++;
                }
            }
            break;
        case 2: // Semanas
            $fechaFinal->modify('+' . ($multiplicador * 7) . ' days');
            break;
        case 3: // Meses
            $fechaFinal->modify('+' . $multiplicador . ' months');
            break;
        case 4: // Años
            $fechaFinal->modify('+' . $multiplicador . ' years');
            break;
    }

    $diasRestantes = $fechaFinal->format('N');
    if ($diasRestantes == 6) {
        $fechaFinal->modify('+1 day');
    } elseif ($diasRestantes == 7) {
        $fechaFinal->modify('+2 days');
    }

    return $fechaFinal->format('Y-m-d');

}

function contarDias($diaInicial, $diaFinal){
    $diaInicial = new DateTime($diaInicial);
    $diaFinal = new DateTime($diaFinal);
    $diasLaborales = 0;

    while ($diaInicial <= $diaFinal) {
        if ($diaInicial->format('N') < 6) {
            $diasLaborales++;
        }
        $diaInicial->modify('+1 day');
    }

    return $diasLaborales;
}

function gananciasDiarias($inversion, $multiplicador, $fijo, $contarDias){
    $ganancias = (($inversion*($fijo/100))*$multiplicador)/$contarDias;
    return $ganancias;
}
/*
    $registros = "";

    $sql = "SELECT hijo FROM referidos WHERE padre = $id_user";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            $registros .= $row["hijo"]."<br>";
        }
    }

    return $registros;
*/
/*
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
    */
?>