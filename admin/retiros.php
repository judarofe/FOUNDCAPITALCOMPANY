<?php
    include(dirname(__FILE__).'/SessionOn.php');
    include('../controller/componentesAdmin.php');
    include(dirname(__FILE__).'/retirosController.php');
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


        <script src="../js/tools/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
        <script src="../js/tools/ajax.googleapis.com_ajax_libs_jquery_1.6.2_jquery.min.js"></script>
    </body>
</html>