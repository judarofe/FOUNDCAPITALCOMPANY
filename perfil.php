<?php
    include(dirname(__FILE__).'/controller/perfilController.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/tools/8_0_1_normalize.css">
    <link rel="stylesheet" href="css/tools/bootstrap_5_3_0_min.css">
    <link rel="stylesheet" href="css/tools/getbootstrap.com_docs_5.3_assets_css_docs.css">
    <link rel="stylesheet" href="css/tools/aos.css" type="text/css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/depositar/styleDepositar.css">
    <link rel="stylesheet" href="css/home/menu.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>PERFIL | FOUND CAPITAL COMPANY</title>
</head>
<body>
<!-- inicio del menú -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">FOUND CAPITAL COMPANY</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 navbar-centrado">
                    <li class="nav-item">
                        <a class="nav-link" href="depositar.php">Depósitos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="retiros.php">Retiros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php">Perfil</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                            </svg>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe2" viewBox="0 0 16 16">
                                <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855-.143.268-.276.56-.395.872.705.157 1.472.257 2.282.287V1.077zM4.249 3.539c.142-.384.304-.744.481-1.078a6.7 6.7 0 0 1 .597-.933A7.01 7.01 0 0 0 3.051 3.05c.362.184.763.349 1.198.49zM3.509 7.5c.036-1.07.188-2.087.436-3.008a9.124 9.124 0 0 1-1.565-.667A6.964 6.964 0 0 0 1.018 7.5h2.49zm1.4-2.741a12.344 12.344 0 0 0-.4 2.741H7.5V5.091c-.91-.03-1.783-.145-2.591-.332zM8.5 5.09V7.5h2.99a12.342 12.342 0 0 0-.399-2.741c-.808.187-1.681.301-2.591.332zM4.51 8.5c.035.987.176 1.914.399 2.741A13.612 13.612 0 0 1 7.5 10.91V8.5H4.51zm3.99 0v2.409c.91.03 1.783.145 2.591.332.223-.827.364-1.754.4-2.741H8.5zm-3.282 3.696c.12.312.252.604.395.872.552 1.035 1.218 1.65 1.887 1.855V11.91c-.81.03-1.577.13-2.282.287zm.11 2.276a6.696 6.696 0 0 1-.598-.933 8.853 8.853 0 0 1-.481-1.079 8.38 8.38 0 0 0-1.198.49 7.01 7.01 0 0 0 2.276 1.522zm-1.383-2.964A13.36 13.36 0 0 1 3.508 8.5h-2.49a6.963 6.963 0 0 0 1.362 3.675c.47-.258.995-.482 1.565-.667zm6.728 2.964a7.009 7.009 0 0 0 2.275-1.521 8.376 8.376 0 0 0-1.197-.49 8.853 8.853 0 0 1-.481 1.078 6.688 6.688 0 0 1-.597.933zM8.5 11.909v3.014c.67-.204 1.335-.82 1.887-1.855.143-.268.276-.56.395-.872A12.63 12.63 0 0 0 8.5 11.91zm3.555-.401c.57.185 1.095.409 1.565.667A6.963 6.963 0 0 0 14.982 8.5h-2.49a13.36 13.36 0 0 1-.437 3.008zM14.982 7.5a6.963 6.963 0 0 0-1.362-3.675c-.47.258-.995.482-1.565.667.248.92.4 1.938.437 3.008h2.49zM11.27 2.461c.177.334.339.694.482 1.078a8.368 8.368 0 0 0 1.196-.49 7.01 7.01 0 0 0-2.275-1.52c.218.283.418.597.597.932zm-.488 1.343a7.765 7.765 0 0 0-.395-.872C9.835 1.897 9.17 1.282 8.5 1.077V4.09c.81-.03 1.577-.13 2.282-.287z"/>
                            </svg>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <?php echo $userName ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <button type="submit" name="logout" class="dropdown-item">Cerrar sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- fin del menú -->
<section class="seccion_oscura">
    <div class="container">
        <div class="cont-pest">
            <ul class="select_main">
                <li>
                    <input type="radio" name="select_main" id="select_1" class="main_select_s" checked>
                        <div class="select_content">
                            <div class="formDepositar seccion_clara">
                                <h3>
                                    PERFIL
                                </h3>
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3 text-center">
                                            <label for="NombreCompleto" class="form-label">Nombre Completo</label>
                                            <input id="NombreCompleto" type="text" class="form-control" value="<?php echo $Nombre." ".$Apellido ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3 text-center">
                                            <label for="NombreUser" class="form-label">User</label>
                                            <input id="NombreUser" type="text" class="form-control" value="<?php echo $userName ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3 text-center">
                                            <label for="Direccion" class="form-label">Email</label>
                                            <input id="Direccion" type="text" class="form-control" value="<?php echo $email?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="Iduser" value="<?php echo $Iduser?>">
                                <br><br>
                                <div class="row">
                                    <div class="col centrarElementos"><label class="btn btn-articule" for="select_2">Billeteras <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16"><path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/></svg></label></div>
                                </div>     
                            </div>
                        </div>
                </li>
                <li>
                    <input type="radio" name="select_main" id="select_2" class="main_select_s">
                        <div class="select_content">
                            <div class="formDepositar seccion_clara">
                                <h3>
                                    BILLETERAS
                                </h3>
                                <br>
                                    <div class="row">
                                        <div class="col">
                                            <label for="Billetera" class="form-label">Nueva billetera</label>
                                            <div class="mb-3 text-center">
                                                <select name="Billetera" id="Billetera" class="form-select" aria-label="Default select example">
                                                    <option value="" selected>Seleccione ...</option>
                                                    <?php echo $resultadoOption ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="linkBilletera" class="form-label">Link billetera</label>
                                            <div class="mb-3 input-group text-center">
                                                <input name="linkBilletera" id="linkBilletera" type="text" class="form-control">
                                                <button class="btn btn-outline-secondary" type="button" onclick="addBilletera()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/></svg></button>
                                            </div>
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col">
                                        <h3>
                                            Billeteras agregadas
                                        </h3>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Enlace</th>
                                                        <th>Eliminar</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="resultadoBilletera">
                                                    <?php echo $resultadoBilletera ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col centrarElementos">
                                        <label class="btn btn-articule" for="select_3">Actualizar contraseña <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16"><path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/></svg></label>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col">
                                        <label class="text-center" for="select_1">
                                            <i>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                                                </svg>
                                                volver
                                            </i>
                                        </label>
                                    </div>
                                </div>    
                            </div>
                        </div>
                </li>
                <li>
                    <input type="radio" name="select_main" id="select_3" class="main_select_s">
                    <div class="select_content">
                        <div class="formDepositar seccion_clara">
                            <h3>CAMBIO DE CONTRASEÑA</h3>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 text-center">
                                        <label for="PassActual" class="form-label">Contraseña actual</label>
                                        <input id="PassActual" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 text-center">
                                        <label for="PassNueva" class="form-label">Contraseña nueva</label>
                                        <input id="PassNueva" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 text-center">
                                        <label for="PassRepeat" class="form-label">Repite nueva contraseña</label>
                                        <input id="PassRepeat" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <br><br>
                                <div class="row">
                                    <div class="col centrarElementos">
                                        <button type="button" class="btn btn-articule" for="select_3" onclick="passActualizar()">Actualizar</button>
                                    </div>
                                </div>
                            <br><br>
                            <div class="row">
                                <div class="col">
                                    <label class="text-center" for="select_2">
                                        <i>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                                            </svg>
                                            volver
                                        </i>
                                    </label>
                                </div>
                            </div> 
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>
<footer class="seccion_clara">
    <div class="row">
        <div class="col"><p style="text-align: right;">Found Capital Company</p></div>
        <div class="col"><p style="text-align: center;">Privacidad y legal</p></div>
        <div class="col"><p style="text-align: left;">Contacto</p></div>
    </div>
</footer>
<script src="js/tools/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
<script src="js/tools/ajax.googleapis.com_ajax_libs_jquery_1.6.2_jquery.min.js"></script>
<script src="js/tools/aos.js"></script>
<script src="js/perfil.js"></script>
<script>
    $(document).ready(function() {
        AOS.init();
    });

    window.addEventListener("scroll", function () {
        var header = document.querySelector("nav");
        header.classList.toggle("bg-dark", window.scrollY > 0);
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>