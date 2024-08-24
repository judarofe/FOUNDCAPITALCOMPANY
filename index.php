<?php
include(dirname(__FILE__).'/controller/sessionController.php');
include(dirname(__FILE__).'/controller/selectPlanes.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/tools/8_0_1_normalize.css">
    <link rel="stylesheet" href="css/tools/bootstrap_5_3_0_min.css">
    <link rel="stylesheet" href="css/tools/getbootstrap.com_docs_5.3_assets_css_docs.css">
    <link rel="stylesheet" href="css/tools/aos.css" type="text/css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="css/home/homeStyle.css">
    <link rel="stylesheet" href="css/home/menu.css">

    <title>INICIO | FOUND CAPITAL COMPANY</title>
</head>
<body>

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
                        <a class="nav-link" aria-current="page" onclick="mercados()" style="cursor: pointer;">Mercados</a>
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
                                    <input type="email" class="form-control" name="EmailUser" id="EmailUser" placeholder="Email ID">
                                    <label for="EmailUser">Correo electrónico</label>
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
                                    <input type="password" class="form-control" name="passUser" id="passUser" placeholder="Password">
                                    <label for="passUser">Contraseña</label>
                                </div>
                            </div>
                        </div>
                        <div id="respuesta" style="color: red"></div>
                        <div class="row modalFoo">
                            <div class="col">
                                <p style="text-align: right;"><a href=""><i>¿Has olvidado tu contraseña?</i></a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="btnLogin">
                        <button id="btnAcceso" type="button" class="btn">ACCESO</button>
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

<section class="imagenFondo seccion_1 centrarElementos" style="height: 56.4vw;">
    <h2>Invierte con sabiduría<hr></h2>
</section>
<section class="seccion_oscura seccion_2" style="height: 56.4vw;">
    <div class="customers marcador"><p>254k</p><p>total customers</p></div>
    <div class="transactions marcador"><p>50M</p><p>total transactions</p></div>
    <div class="payments marcador"><p>2631</p><p>total daily Payments</p></div>
    <div class="info"><p>En Found Capital Company, entendemos la importancia de tomar decisiones financieras inteligentes y seguras. Nuestro compromiso es brindarte la oportunidad de invertir en algunos de los mercados más sólidos, respetados y diversificados del mundo, incluyendo el S&P 500, la Bolsa de Valores de Tokio, la Bolsa de Londres, el NASDAQ, así como en materias primas y por supuesto, en criptomonedas con gran proyección de crecimiento. Aquí, no solo te brindamos un camino hacia la inversión, sino también hacia la confianza y la rentabilidad.</p></div>
    <div class="ilustracion"><img src="img/home/ilustracion1.png" alt=""></div>
</section>
<section class="seccion_clara" id="Mercados">
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="slideHome">
                    <div class="izquierda">
                        <div class="texto_1 centrarElementos">
                            <div class="texto_1_1">
                                <h2 style="text-align: left;">
                                    MATERIAS PRIMAS&nbsp;&nbsp;
                                    <svg xmlns="http://www.w3.org/2000/svg" width="46.508" height="27.916" viewBox="0 0 46.508 27.916">
                                        <g id="Grupo_1232" data-name="Grupo 1232" transform="translate(-501.512 -2615)">
                                            <path id="Trazado_422" data-name="Trazado 422" d="M526.084,2641.916h19.47a1.443,1.443,0,0,0,1.289-2.094l-4.373-8.671a1.845,1.845,0,0,0-1.648-1.015h-9.914a2.215,2.215,0,0,0-2.028,1.325l-3.87,8.811A1.173,1.173,0,0,0,526.084,2641.916Z" fill="#fff" stroke="#00183b" stroke-miterlimit="10" stroke-width="2"/>
                                            <path id="Trazado_423" data-name="Trazado 423" d="M503.7,2641.916h19.47a1.444,1.444,0,0,0,1.289-2.094l-4.373-8.671a1.847,1.847,0,0,0-1.649-1.015h-9.914a2.214,2.214,0,0,0-2.027,1.325l-3.87,8.811A1.173,1.173,0,0,0,503.7,2641.916Z" fill="#fff" stroke="#00183b" stroke-miterlimit="10" stroke-width="2"/>
                                            <path id="Trazado_424" data-name="Trazado 424" d="M515.482,2627.78h19.47a1.443,1.443,0,0,0,1.289-2.094l-4.373-8.671A1.847,1.847,0,0,0,530.22,2616h-9.914a2.215,2.215,0,0,0-2.028,1.324l-3.87,8.812A1.173,1.173,0,0,0,515.482,2627.78Z" fill="#fff" stroke="#00183b" stroke-miterlimit="10" stroke-width="2"/>
                                        </g>
                                    </svg>
                                </h2>
                                <br>
                                <p>Desde la perspectiva de una cartera de inversión, incorporar materias primas en su estrategia es una elección inteligente para diversificar más allá de los activos convencionales. En Found Capital Company, le damos la oportunidad de aprovechar los mercados globales de metales preciosos y energéticos más destacados. Contamos con una presencia en más de 20 materias primas a nivel internacional y le ofrecemos la flexibilidad necesaria en cuanto al tamaño de sus inversiones, lo que facilita su participación en estos mercados con confianza.</p>
                            </div>
                        </div>
                    </div>
                    <div class="derecha">
                        <div class="videoSlide centrarElementos">
                            <img src="img/home/Meterias primas.gif " alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="slideHome">
                    <div class="izquierda">
                        <div class="videoSlide centrarElementos">
                            <img src="img/home/ETF'S.gif" alt="">
                        </div>
                    </div>
                    <div class="derecha">
                        <div class="texto_1 centrarElementos">
                            <div class="texto_1_1">
                                <h2 style="text-align: right;"> 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="33.5" height="37.5" viewBox="0 0 33.5 37.5">
                                        <g id="Grupo_1228" data-name="Grupo 1228" transform="translate(-1672.5 -3712.5)">
                                            <rect id="Rectángulo_32" data-name="Rectángulo 32" width="23" height="29" rx="1.734" transform="translate(1673.5 3713.5)" fill="#fff" stroke="#00183b" stroke-miterlimit="10" stroke-width="2"/>
                                            <rect id="Rectángulo_33" data-name="Rectángulo 33" width="23" height="29" rx="1.734" transform="translate(1682 3720)" fill="#fff" stroke="#00183b" stroke-miterlimit="10" stroke-width="2"/>
                                            <line id="Línea_9" data-name="Línea 9" x2="12.239" transform="translate(1687.5 3729.5)" fill="#fff" stroke="#00183b" stroke-miterlimit="10" stroke-width="2"/>
                                            <line id="Línea_10" data-name="Línea 10" x2="12.239" transform="translate(1687.5 3734.5)" fill="#fff" stroke="#00183b" stroke-miterlimit="10" stroke-width="2"/>
                                            <line id="Línea_11" data-name="Línea 11" x2="12.239" transform="translate(1687.5 3739.5)" fill="#fff" stroke="#00183b" stroke-miterlimit="10" stroke-width="2"/>
                                        </g>
                                    </svg>&nbsp;&nbsp;
                                    ETF’S
                                </h2>
                                <br>
                                <p>Considerar la incorporación de ETFs (Exchange Traded Funds) en su estrategia es una decisión inteligente para diversificar su cartera más allá de las inversiones tradicionales. Los ETFs ofrecen una forma eficiente y accesible de invertir en una amplia gama de activos financieros, desde acciones y bonos hasta sectores específicos de la economía. En Found Capital Company, le brindamos la oportunidad de explorar y capitalizar en una variedad de ETFs líderes a nivel mundial, proporcionándole la flexibilidad y la confianza necesarias para participar en estos mercados de manera efectiva.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="slideHome">
                    <div class="izquierda">
                        <div class="texto_1 centrarElementos">
                            <div class="texto_1_1">
                                <h2 style="text-align: left;">
                                    ÍNDICES BURSÁTILES&nbsp;&nbsp;
                                    <svg xmlns="http://www.w3.org/2000/svg" width="44.109" height="49.45" viewBox="0 0 44.109 49.45">
                                        <g id="Grupo_1225" data-name="Grupo 1225" transform="translate(-569.5 -4824.55)">
                                            <line id="Línea_6" data-name="Línea 6" y2="37.341" transform="translate(607.241 4830.241)" fill="#fff" stroke="#00183b" stroke-miterlimit="10" stroke-width="2"/>
                                            <line id="Línea_7" data-name="Línea 7" y2="49.45" transform="translate(591.307 4824.55)" fill="#fff" stroke="#00183b" stroke-miterlimit="10" stroke-width="2"/>
                                            <line id="Línea_8" data-name="Línea 8" y2="38.18" transform="translate(575.621 4830.241)" fill="#fff" stroke="#00183b" stroke-miterlimit="10" stroke-width="2"/>
                                            <rect id="Rectángulo_28" data-name="Rectángulo 28" width="10.243" height="35.281" rx="3.34" transform="translate(586.433 4830.184)" fill="#fff" stroke="#00183b" stroke-miterlimit="10" stroke-width="2"/>
                                            <rect id="Rectángulo_29" data-name="Rectángulo 29" width="10.243" height="23.9" rx="3.117" transform="translate(602.367 4839.288)" fill="#fff" stroke="#00183b" stroke-miterlimit="10" stroke-width="2"/>
                                            <rect id="Rectángulo_30" data-name="Rectángulo 30" width="10.243" height="27.314" rx="3.266" transform="translate(570.5 4834.736)" fill="#fff" stroke="#00183b" stroke-miterlimit="10" stroke-width="2"/>
                                        </g>
                                    </svg>
                                </h2>
                                <br>
                                <p>Explorar los índices bursátiles e incluirlos en su estrategia es una elección inteligente para ampliar su cartera. Estos índices son una herramienta efectiva para rastrear y capitalizar en el desempeño de los mercados financieros, reflejando a menudo segmentos específicos de la economía o regiones geográficas. En Found Capital Company, estamos para brindarle la flexibilidad y la confianza necesarias para diversificar su cartera de manera estratégica.</p>
                            </div>
                        </div>
                    </div>
                    <div class="derecha">
                        <div class="videoSlide centrarElementos">
                            <img src="img/home/Intro.gif" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<section class="seccion_oscura">
    <h1>¿POR QUÉ INVERTIR CON NOSOTROS?</h1>
    <div class="galeriaX4">
        <article class="row">
             <div class="col-3 centrarElementos"><img src="img/home/acompañamiento.png" alt=""></div>
             <div class="col-9"><h3>Acompañamiento</h3><p>Tu éxito es nuestro éxito. Ofrecemos un servicio al cliente excepcional y estamos disponibles para responder a tus preguntas y ayudarte en cada paso del camino. Tu satisfacción es lo más importante para nosotros.</p></div>
        </article>
        <article class="row">
             <div class="col-3 centrarElementos"><img src="img/home/rentabilidad.png" alt=""></div>
             <div class="col-9"><h3>Rentabilidad Consistente</h3><p>Nuestro objetivo es claro: queremos ayudarte a lograr un crecimiento financiero sostenible. Ofrecemos un atractivo porcentaje de rentabilidad semanal en todos nuestros paquetes de inversión. Ya sea que estés comenzando con $50 o estés listo para invertir $10000, nuestro enfoque en la rentabilidad constante puede ayudarte a alcanzar tus metas financieras.</p></div>
        </article>
        <article class="row">
             <div class="col-3 centrarElementos"><img src="img/home/universal.png" alt=""></div>
             <div class="col-9"><h3>Acceso Universal</h3><p>No importa si eres un inversor experimentado o si apenas estás empezando tu viaje en el mundo de las inversiones. En Found Capital Company, todos son bienvenidos. Nuestro de paquete se adapta a diferentes niveles de inversión y experiencia.</p></div>
        </article>
        <article class="row">
             <div class="col-3 centrarElementos"><img src="img/home/seguridad.png" alt=""></div>
             <div class="col-9"><h3>Seguridad</h3><p>Contamos con los más altps estándares de seguridad sobre tu información.</p></div>
        </article>
    </div>
</section>
<section class="seccion_clara">
    <h1>PLANES</h1>
    <div class="articulos">
        <?php  echo empty($planes) || $planes == 0 ? "" : $planes ?>
    </div>
</section>
<section class="imagenFondo seccion_6" style="height: 56.4vw;">
    <div class="leyenda seccion_oscura">
        <p>Con gran orgullo, mantenemos firmemente nuestro compromiso con la responsabilidad y la coherencia hacia nuestros clientes, nuestra familia y todos aquellos que han depositado su confianza en nosotros.</p>
    </div>
</section>
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
<script src="js/session.js"></script>
<script>
    $(document).ready(function() {
        AOS.init();
    });

    window.addEventListener("scroll", function () {
        var header = document.querySelector("nav");
        header.classList.toggle("bg-dark", window.scrollY > 0);
    });

    function mercados(){
        $('html, body').animate({
            scrollTop: $('#Mercados').offset().top
        }, 1000);
    }
</script>
</body>
</html>