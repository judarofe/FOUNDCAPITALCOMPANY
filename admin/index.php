<?php
    include(dirname(__FILE__).'/sessionController.php');
    include(dirname(__FILE__).'/indexController.php');
    include('../controller/componentesAdmin.php');
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
</head>
<body>
    <?php echo $menu; ?>
    <section class="p-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <caption>
                        <h2>Usuarios inscritos</h2>
                    </caption>
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Email</th>
                                <th>Actualizar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $users; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="respuestaForm" tabindex="-1" aria-labelledby="respuestaFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="respuestaFormLabel">Actualizar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="actualizarUser.php" method="post">
                        <div class="mb-3">
                            <label for="nombreInput" class="form-label">Nombres</label>
                            <input name="nombreInput" type="text" class="form-control" id="nombreInput" aria-describedby="nombreInputHelp">
                            <div id="nombreInputHelp" class="form-text">Modifique nombres</div>
                        </div>
                        <div class="mb-3">
                            <label for="ApellidosInput" class="form-label">Apellidos</label>
                            <input name="ApellidosInput" type="text" class="form-control" id="ApellidosInput" aria-describedby="ApellidosInputHelp">
                            <div id="ApellidosInputHelp" class="form-text">Modifique apellidos</div>
                        </div>
                        <div class="mb-3">
                            <label for="UserInput" class="form-label">Nombre de usuario</label>
                            <input name="UserInput" type="text" class="form-control" id="UserInput" aria-describedby="UserInputHelp">
                            <div id="UserInputHelp" class="form-text">Modifique nombre de usuario</div>
                        </div>
                        <div class="mb-3">
                            <label for="EmailInput" class="form-label">Email</label>
                            <input name="EmailInput" type="text" class="form-control" id="EmailInput" aria-describedby="EmailInputHelp">
                            <div id="EmailInputHelp" class="form-text">Modifique Email</div>
                        </div>
                        <input type="hidden" name="Iduser" id="Iduser">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/tools/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
    <script src="../js/tools/ajax.googleapis.com_ajax_libs_jquery_1.6.2_jquery.min.js"></script>
    <script src="index.js"></script>
</body>
</html>