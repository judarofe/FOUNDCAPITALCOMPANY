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
    <link rel="stylesheet" href="../css/pestannas.css">

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
                <input name="NombrePlan" id="NombrePlan" type="text" class="form-control" aria-describedby="nombreHelp" value="<?php  echo empty($NombrePlan_1) || $NombrePlan_1 == 0 ? "" : $NombrePlan_1 ?>" required>
                <div id="nombreHelp" class="form-text">Escribe el nombre del plan.</div>
            </div>
            <div class="mb-3">
                <label for="items" class="form-label">Items</label>
                <textarea name="items" id="items" class="form-control" aria-describedby="itemsHelp" rows="8" required><?php echo empty($items_1) || $items_1 == 0 ? "" : $items_1 ?></textarea>
                <div id="itemsHelp" class="form-text">Escribe 8 items con lo principal del plan cada uno separado por salto de linea.</div>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" aria-describedby="descripcionHelp" rows="8" required><?php echo empty($descripcion_1) || $descripcion_1 == 0 ? "" : $descripcion_1?></textarea>
                <div id="descripcionHelp" class="form-text">Escribe una descripción del plan con un máximo de 1700 y un mínimo de 1200 caracteres.</div>
            </div>
            <div class="row">
                <div class="col">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <label for="select_1" onclick="verActivo(1)"><p id="nav-link_1" class="nav-link active">Plan variable</p></label>
                            <label for="select_2" onclick="verActivo(2)"><p id="nav-link_2" class="nav-link">Plan fijo</p></label>
                        </li>
                    </ul>
                    <div class="select_main">
                        <ul>
                            <li>
                                <input type="radio" name="inputRadio" class="inputRadio" id="select_1" checked>
                                <div class="select_content">
                                    <div class="row align-items-center">
                                        <div class="col py-3">
                                            <div class="mb-3">
                                                <label for="PorcentajePlaMin" class="form-label">Porcentaje mínimo</label>
                                                <input name="PorcentajePlanMin" id="PorcentajePlanMin" type="number" step="1" class="form-control" min="0" max="100" aria-describedby="PorcentajeMinHelp" value="<?php echo empty($PorcentajePlan_1) || $PorcentajePlan_1 == 0 ? 0 : $PorcentajePlan_1 ?>" required>
                                                <div id="PorcentajeMinHelp" class="form-text">Ingresa el valor del porcentaje de ganancia mensual mínimo</div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="PorcentajePlanMax" class="form-label">Porcentaje máximo</label>
                                                <input name="PorcentajePlanMax" id="PorcentajePlanMax" type="number" step="1" class="form-control" min="0" max="100" aria-describedby="PorcentajeMaxHelp" value="<?php echo empty($PorcentajePlan_2) || $PorcentajePlan_2 == 0 ? 0 : $PorcentajePlan_2 ?>" required>
                                                <div id="PorcentajeMaxHelp" class="form-text">Ingresa el valor del porcentaje de ganancia mensual máximo</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <input type="radio" name="inputRadio" class="inputRadio" id="select_2">
                                <div class="select_content">
                                    <div class="mb-3 py-3">
                                        <label for="fijoPlan" class="form-label">Porcentaje fijo</label>
                                        <input name="fijoPlan" id="fijoPlan" type="number" step="0.01" class="form-control" min="0" aria-describedby="fijoHelp" value="<?php echo empty($fijoPlan_1) || $fijoPlan_1 == 0 ? 0 : $fijoPlan_1 ?>" required>
                                        <div id="fijoHelp" class="form-text">Ingresa el porcentaje fijo de ganancia mensual</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php echo $selectGananciaFrecuencia ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p><strong>Referidos</strong></p>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col">
                    <div class="mb-3">
                        <label for="nivelMaximo" class="form-label">Nivel máximo</label>
                        <input name="nivelMaximo" id="nivelMaximo" type="number" class="form-control" min="0" aria-describedby="nivelMaximoHelp" value="">
                        <div id="nivelMaximoHelp" class="form-text">Ingresa el valor máximo del nivel para el conteo de referidos</div>
                    </div>
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-secondary" id="addReferidos">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div id="referidosTotal">
                <div class="row referidosRegla align-items-center" id="referidosRegla_1">
                    <div class="col">
                        <div class="mb-3">
                            <label for="porcentajeReferido" class="form-label">Porcentaje</label>
                            <input name="porcentajeReferido[]" type="number" class="form-control" min="0" aria-describedby="porcentajeReferidoHelp" value="">
                            <div id="porcentajeReferidoHelp" class="form-text">Ingresa el porcentaje de ganancia por referido</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="referidosMinimos" class="form-label">Referidos mínimos</label>
                            <input name="referidosMinimos[]" type="number" class="form-control" min="0" aria-describedby="referidosMinimosHelp" value="">
                            <div id="referidosMinimosHelp" class="form-text">Ingresa el total de referidos requeridos</div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <?php echo $selectRetirosFrecuencia ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="tiempoPlan" class="form-label">Duración</label>
                <input name="tiempoPlan" id="tiempoPlan" type="number" class="form-control" aria-describedby="tiempoHelp" value="<?php echo empty($tiempoPlan_1) || $tiempoPlan_1 == 0 ? 0 : $tiempoPlan_1?>" required>
                <div id="tiempoHelp" class="form-text">Ingresa el tiempo máximo en días del plan</div>
            </div>
            <div id="InversioTotal">
                <div class="row align-items-center InversionRegla" id="InversionRegla_1">
                    <div class="col">
                        <div class="mb-3">
                            <label for="Inversion" class="form-label">Inversión</label>
                            <input name="Inversion[]" type="number" class="form-control" aria-describedby="InversionHelp" value="" required>
                            <div id="InversionHelp" class="form-text">Ingresa la inversion</div>
                        </div>
                    </div>
                    <div class="col-1">
                        <button type="button" class="btn btn-secondary" id="addInversion">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                            </svg>
                        </button>
                    </div>
                </div>
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

<section>
    <div class="container">
        <?php echo $planesTotales; ?>
    </div>
</section>

<script src="../js/tools/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
<script src="../js/tools/ajax.googleapis.com_ajax_libs_jquery_1.6.2_jquery.min.js"></script>
<script src="referidosAdmin.js"></script>
<script>
    function verActivo(selector){
        $('.nav-link').removeClass('active');
        $('.nav-link input').val(0);
        $('#nav-link_'+selector).addClass('active');
    }
</script>
</body>
</html>