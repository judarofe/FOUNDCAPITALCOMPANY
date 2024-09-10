<?php
if(isset($_GET['3m41l'])){
    $email = $_GET['3m41l'];
    $email = str_rot13($email);
    $variable1 = '<input type="email" class="form-control" name="EmailUser" id="EmailUser" placeholder="Email ID" value="'.$email.'" required readonly>';
} else {
    $variable1 = '<input type="email" class="form-control" name="EmailUser" id="EmailUser" placeholder="Email ID" required>';
}
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

    <title>CONFIRMA EMAIL | FOUND CAPITAL COMPANY</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">FOUND CAPITAL COMPANY</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
</header>

<section class="seccion_oscura">
        <form action="controller/confirmarCodigo.php" id="subscribe" method="post">
            <div class="formDepositar">
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23.287" height="30.338" viewBox="0 0 23.287 30.338">
                            <path id="Trazado_8" data-name="Trazado 8" d="M735.211,481.489a7.259,7.259,0,1,0-6.465,0,11.608,11.608,0,0,0-8.411,11.133V498.1h23.287v-5.479A11.608,11.608,0,0,0,735.211,481.489Z" transform="translate(-720.335 -467.763)" fill="#e3e3e3"/>
                        </svg>
                    </span>
                    <div class="form-floating">
                        <?php echo $variable1 ?>
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
                        <input type="password" class="form-control" name="passUser" id="passUser" placeholder="Password" required>
                        <label for="passUser">Código de confirmación</label>
                    </div>
                </div>
            </div>
            <div id="btnLogin" style="width: 50%;">
                <button id="btnAcceso" type="submit" class="btn">CONFIRMAR EMAIL</button>
            </div>
        </form>
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
</body>
</html>