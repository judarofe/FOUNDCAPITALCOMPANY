<?php
    include('PlanesAdminController.php');
    include(dirname(__FILE__).'/SessionOn.php');
    include('../controller/componentesAdmin.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/tools/bootstrap_5_3_0_min.css">
    <link rel="stylesheet" href="../css/tools/getbootstrap.com_docs_5.3_assets_css_docs.css">

    <title>PLANES | FOUND CAPITAL COMPANY</title>
</head>
<body>
<?php echo $menu; ?>
<section class="p-5 m-5 bg-dark-subtle text-dark-emphasis rounded shadow">
    <div class="container">
        <p class="h2 p-3 text-center">CREAR PLAN</p>
        <?php  echo empty($mensaje_error) || $mensaje_error == 0 ? "" : $mensaje_error ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="NombrePlan" class="form-label">Nombre</label>
                <input name="NombrePlan" id="NombrePlan" type="text" class="form-control" aria-describedby="nombreHelp" value="<?php  echo empty($NombrePlan_1) || $NombrePlan_1 == 0 ? "" : $NombrePlan_1 ?>">
                <div id="nombreHelp" class="form-text">Escribe el nombre del plan.</div>
            </div>
            <div class="mb-3">
                <label for="items" class="form-label">Items</label>
                <textarea name="items" id="items" class="form-control" aria-describedby="itemsHelp" rows="8"><?php echo empty($items_1) || $items_1 == 0 ? "" : $items_1 ?></textarea>
                <div id="itemsHelp" class="form-text">Escribe 8 items con lo principal del plan cada uno separado por salto de linea.</div>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" aria-describedby="descripcionHelp" rows="8"><?php echo empty($descripcion_1) || $descripcion_1 == 0 ? "" : $descripcion_1?></textarea>
                <div id="descripcionHelp" class="form-text">Escribe una descripción del plan con un máximo de 1700 y un mínimo de 1200 caracteres.</div>
            </div>
            <div class="mb-3">
                <label for="PorcentajePlan" class="form-label">Porcentaje</label>
                <input name="PorcentajePlan" id="PorcentajePlan" type="number" step="0.01" class="form-control" min="0" max="100" aria-describedby="PorcentajeHelp" value="<?php echo empty($PorcentajePlan_1) || $PorcentajePlan_1 == 0 ? 0 : $PorcentajePlan_1 ?>">
                <div id="PorcentajeHelp" class="form-text">Ingresa el valor del porcentaje de ganancia mensual, si no corresponde deje el campo vacío</div>
            </div>
            <div class="mb-3">
                <label for="fijoPlan" class="form-label">Valor fijo</label>
                <input name="fijoPlan" id="fijoPlan" type="number" step="0.01" class="form-control" min="0" aria-describedby="fijoHelp" value="<?php echo empty($fijoPlan_1) || $fijoPlan_1 == 0 ? 0 : $fijoPlan_1 ?>">
                <div id="fijoHelp" class="form-text">Ingresa el valor fijo de ganancia mensual, si no corresponde deje el campo vacío</div>
            </div>
            <div class="mb-3">
                <label for="tiempoPlan" class="form-label">Duración</label>
                <input name="tiempoPlan" id="tiempoPlan" type="number" class="form-control" aria-describedby="tiempoHelp" value="<?php echo empty($tiempoPlan_1) || $tiempoPlan_1 == 0 ? 0 : $tiempoPlan_1?>">
                <div id="tiempoHelp" class="form-text">Ingresa el tiempo máximo en días del plan</div>
            </div>
            <div class="form-check">
                <input name="visible" class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    Visible
                </label>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button type="submit" class="btn btn-secondary shadow m-3">Enviar</button>
            </div>
        </form>
    </div>
    
</section>

<script src="../js/tools/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
<script src="../js/tools/ajax.googleapis.com_ajax_libs_jquery_1.6.2_jquery.min.js"></script>
</body>
</html>