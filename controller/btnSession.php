<?php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

    if($_SESSION["UserTipo"] == 1){
        $enlaceUser = "admin/index.php";
    }else{
        $enlaceUser = "perfil.php";
    }

    $menuPerfil = '
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
        '.$_SESSION['userName'].'
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="'.$enlaceUser.'" class="dropdown-item">Perfil</a>
        </li>
        <li>
            <form method="post" action="./controller/btnLogout.php">
                <button type="submit" name="logout" class="dropdown-item">Cerrar sesión</button>
            </form>
        </li>
    </ul>
    ';

} else {
    $prueba = '';
    $menuPerfil = '
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
        </svg>
    </a>
    <ul class="dropdown-menu">
        <li>
            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#login">Iniciar sesión</button>
        </li>
        <li>
            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#Registro">Comenzar</button>
        </li>
    </ul>
    ';
}

?>