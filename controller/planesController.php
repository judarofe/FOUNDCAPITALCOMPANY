<?php
require_once('../../config-ext.php');
$planes = "";

$sql = "SELECT * FROM planes WHERE visibilidad = 1";

$result = $conn->query($sql);
$styloSeccion = 0;
$articulosPlanes = '';
$imagenPlan = '';
$descripcion = '';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cadena = "";
        $listado = "";
        $descripcion = str_replace("\\r\\n", '', $row['descripcion']);
        
        $cadena = $row['items'];
        $elementos = explode("|", $cadena);
        foreach ($elementos as $elemento) {
            $listado .= '<p class="card-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32.42" height="25.5" viewBox="0 0 32.42 25.5">
                                <path id="Trazado_376" data-name="Trazado 376" d="M340.913,6932.681l7.98,7.98,22.319-22.318" transform="translate(-339.853 -6917.282)" fill="none" stroke="#39b54a" stroke-miterlimit="10" stroke-width="3"/>
                            </svg>
                            '.$elemento.'
                        </p>';
        }

        if($styloSeccion === 0){
            $articulosPlanes .= '<section class="seccion_oscura2 imagenFondo">';
            $imagenPlan = '<img src="img/home/planComercial.png" alt="">';
            $styloSeccion = 1;
        }else{
            $articulosPlanes .= '<section>';
            $imagenPlan = '<img src="img/home/planComercial2.png" alt="">';
            $styloSeccion = 0;
        }

        $articulosPlanes .= '
        <div class="row">
            <div class="col-md-6"><p>'.$descripcion.'</p></div>
            <div class="col-md-6">
                <article>
                    <div class="tarjeta">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <h5 class="card-title">'.$row['plan'].'</h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary">OBTENGA SU PRIMERA GANANCIA</h6>
                                    </div>
                                    <div class="col-3">'.$imagenPlan.'</div>
                                </div>
                                '.$listado.'<br>
                                <button type="button" class="btn btn-articule" data-bs-toggle="modal" data-bs-target="#Registro">Regístrate</button>
                                <p class="text-center">*Términos y condiciones</p></div></div></article></div></div></section>';

    }
}
$conn->close();
?>