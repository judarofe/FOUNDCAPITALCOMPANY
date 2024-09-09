<?php
    include('billeteraAdminController.php');
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
    <title>BILLETERAS | FOUND CAPITAL COMPANY</title>
</head>
<body>
<?php echo $menu; ?>
<section class="p-5 m-5 bg-dark-subtle text-dark-emphasis rounded shadow">
    
    <div class="container">
        <p class="h2 p-3 text-center">CREAR BILLETERA</p>
        <?php  echo empty($mensaje_error) || $mensaje_error == 0 ? "" : $mensaje_error ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="NombreBilletera" class="form-label">Nombre billetera</label>
                <input name="NombreBilletera" id="NombreBilletera" type="text" class="form-control" aria-describedby="NombreBilleteraHelp" value="<?php  echo empty($NombreBilletera) || $NombreBilletera == 0 ? "" : $NombreBilletera ?>">
                <div id="NombreBilleteraHelp" class="form-text">Escribe el nombre de la billetera.</div>
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