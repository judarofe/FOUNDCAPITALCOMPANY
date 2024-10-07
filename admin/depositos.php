<?php
    include(dirname(__FILE__).'/SessionOn.php');
    include('../controller/componentesAdmin.php');
    include(dirname(__FILE__).'/depositosController.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/tools/bootstrap_5_3_0_min.css">
    <link rel="stylesheet" href="../css/tools/getbootstrap.com_docs_5.3_assets_css_docs.css">
    <title>ADMIN | FOUND CAPITAL COMPANY</title>
    <link rel="stylesheet" href="../css/tools/sweetalert2.min.css">
    <script src="../js/tools/sweetalert.min.js"></script>
</head>
<style>

a {
  color: inherit;
  text-decoration: none;
}

a:hover,
a:focus,
a:active {
  color: inherit;
  text-decoration: none;
  outline: none;
}
</style>
<body>
    <?php echo $menu; ?>
    <section class="p-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <caption>
                        <h2>Depósitos</h2>
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Plan</th>
                                    <th>Billetera</th>
                                    <th>Fecha</th>
                                    <th>Cantidad</th>
                                    <th>Hash</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody id="registrosDepositos">
                                <?php echo $resultadosDepositos; ?>
                            </tbody>
                        </table>
                    </caption>
                </div>
            </div>
        </div>
    </section>
    <div class="modal" tabindex="-1" id="Procesar">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloResumen"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="datosListado" class="list-group"></ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button id="BotonAceptar" type="button" class="btn btn-warning">Aceptar</button>
            </div>
            </div>
        </div>
    </div>
    <script src="../js/tools/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
    <script src="../js/tools/ajax.googleapis.com_ajax_libs_jquery_1.6.2_jquery.min.js"></script>
    <script src="depositos.js"></script>
    
</body>
</html>