<?php
include(dirname(__FILE__).'/controller/sessionController.php');
include(dirname(__FILE__).'/controller/planesController.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>T&C PLANES | FOUND CAPITAL COMPANY</title>
    <link rel="stylesheet" href="css/tools/8_0_1_normalize.css">
    <link rel="stylesheet" href="css/tools/bootstrap_5_3_0_min.css">
    <link rel="stylesheet" href="css/tools/getbootstrap.com_docs_5.3_assets_css_docs.css">
    <link rel="stylesheet" href="css/tools/aos.css" type="text/css">
    <link rel="stylesheet" href="css/home/menu.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="css/planes/planesStyle.css" type="text/css">
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
                        <a class="nav-link" aria-current="page" href="index.php#Mercados">Mercados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="planes.php">Planes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Compañía</a>
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
                        <?php echo $menuPerfil ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="subscribe.php" id="subscribe" method="post">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="espacio">
                        <img src="img/home/Grupo 21.png" alt="">
                        </div>
                        <div class="bodyModal">
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23.287" height="30.338" viewBox="0 0 23.287 30.338">
                                        <path id="Trazado_8" data-name="Trazado 8" d="M735.211,481.489a7.259,7.259,0,1,0-6.465,0,11.608,11.608,0,0,0-8.411,11.133V498.1h23.287v-5.479A11.608,11.608,0,0,0,735.211,481.489Z" transform="translate(-720.335 -467.763)" fill="#e3e3e3"/>
                                    </svg>
                                </span>
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="EmailUser" id="floatingInputGroup1" placeholder="Email ID">
                                    <label for="floatingInputGroup1">Correo electrónico</label>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26.854" height="33.354" viewBox="0 0 26.854 33.354">
                                        <g id="Grupo_12" data-name="Grupo 12" transform="translate(-717.49 -569.782)">
                                            <path id="Trazado_9" data-name="Trazado 9" d="M741.427,580.808h-2.033V578.27a8.488,8.488,0,0,0-16.977,0v2.538H720.38a2.9,2.9,0,0,0-2.89,2.889V600.22a2.909,2.909,0,0,0,2.89,2.916h21.047a2.916,2.916,0,0,0,2.917-2.916V583.7A2.909,2.909,0,0,0,741.427,580.808Zm-15.173-2.538a4.652,4.652,0,1,1,9.3,0v2.538h-9.3Zm6.222,17.218v4.221a.317.317,0,0,1-.333.306h-2.02a.312.312,0,0,1-.308-.306v-4.221a3.708,3.708,0,1,1,2.661,0Z" fill="#e3e3e3"/>
                                        </g>
                                    </svg>
                                </span>
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="floatingInputGroup2" name="passUser" placeholder="Password">
                                    <label for="floatingInputGroup2">Contraseña</label>
                                </div>
                            </div>
                        </div>
                        <div class="row modalFoo">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">
                                        Recuérdame
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <p style="text-align: right;"><a href=""><i>¿Has olvidado tu contraseña?</i></a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="btnLogin">
                        <button type="submit" class="btn">ACCESO</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="Registro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border: none;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="registroForm">

                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h1 class="modal-title">REGISTRO</h1>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control inputRegistro" name="Nombre" id="floatingInputNombre" placeholder="Nombre">
                                <label for="floatingInputNombre">Nombre</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control inputRegistro" name="Apellido" id="floatingInputApellido" placeholder="Apellido">
                                <label for="floatingInputApellido">Apellido</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control inputRegistro" name="Email" id="floatingInputemail" placeholder="Correo electrónico">
                                <label for="floatingInputemail">Correo electrónico</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control inputRegistro" name="Password_1" id="floatingInputpassword" placeholder="Contraseña">
                                <label for="floatingInputpassword">Contraseña</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control inputRegistro" name="Password_2" id="floatingInputpasswordConf" placeholder="Contraseña">
                                <label for="floatingInputpasswordConf">Confirmar contraseña</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" name="terminosCheck" type="checkbox" id="terminosCheck">
                                <label class="form-check-label" for="terminosCheck">
                                    Acepto los términos de uso
                                </label>
                            </div>
                        </div>
                    </div>   
                </div>
                <div class="modal-footer" style="border: none;">
                    <div class="row">
                        <div class="col">
                            <button id="registrarse" type="button" class="btn botonRegistro">Regístrate ahora</button>
                        </div>
                    </div>  
                </div>

            </form>
        </div>
    </div>
</div>

<?php echo isset($prueba) ? $prueba : ''; ?>

<?php
echo $articulosPlanes;
?>

<footer class="seccion_oscura">
    <div class="row">
        <div class="col"><p style="text-align: right;">Found Capital Company</p></div>
        <div class="col"><p style="text-align: center;">Privacidad y legal</p></div>
        <div class="col"><p style="text-align: left;">Contacto</p></div>
    </div>
</footer>
<script src="js/tools/cdn.jsdelivr.net_npm_bootstrap@5.3.0_dist_js_bootstrap.bundle.min.js"></script>
<script src="js/tools/ajax.googleapis.com_ajax_libs_jquery_1.6.2_jquery.min.js"></script>
<script src="js/tools/aos.js"></script>
<script src="js/comenzar.js"></script>
<script>
    $(document).ready(function() {
        AOS.init();
    });

    window.addEventListener("scroll", function () {
        var header = document.querySelector("nav");
        header.classList.toggle("bg-dark", window.scrollY > 0);
    });
</script>
</body>
</html>