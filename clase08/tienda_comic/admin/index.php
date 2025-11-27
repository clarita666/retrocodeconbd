<?php

require_once "../functions/autoload.php";



$secciones_validas = [
     
    "login" => [
        "titulo" => "Inicio de Sessión",
        "restringido" => FALSE

    ],
    "dashboard" => [
        "titulo" => "Panel de Control",
        "restringido" => TRUE
    ],
      "admin_personajes" => [
        "titulo" => "Administracion de Personajes",
        "restringido" => TRUE
    ],
       "add_personajes" => [
        "titulo" => "Cargar Personajes",
        "restringido" => TRUE
    ],
        "edit_personajes" => [
        "titulo" => "Editar Personajes",
        "restringido" => TRUE
    ],
     "delete_personajes" => [
        "titulo" => "Eliminar Personajes",
        "restringido" => TRUE
    ],
   
];






// Operador Ternario

$seccion = isset($_GET['sec']) ? $_GET['sec'] : "dashboard";

/* Funcion predefinida: que busque si existe lo que viene en la variable $seccion y si existe el indice de la varibale $secciones_validas : array_key_exists */


if(!array_key_exists($seccion, $secciones_validas)){
    $vista = "404";
    $titulo = "404 - Pagina no encontrada";
}else {
    $vista = $seccion;

    if($secciones_validas[$seccion]['restringido']){
        (new Autenticacion)->verify();
    }

    $titulo = $secciones_validas[$seccion]['titulo'];
}


$userData = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : FALSE;


/*    if(isset($_GET['sec'])){
         $seccion = $_GET['sec'];
    }else {
        $seccion = "home";
    }
 */
/*  var_dump($seccion); */

/* $series = $productos['batman'];

echo "<pre>";
    var_dump($series);
echo "</pre>"; */






?>

<!doctype html>
<html lang="es">

<head>
    <meta char+set="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tienda Comic DC -  <?= $titulo  ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;" data-bs-theme="light"  >
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Tienda Comic</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link  <?= $userData ? "" : "d-none" ?> " aria-current="page" href="index.php?sec=dashboard">Dashboard</a>
                        <a class="nav-link  <?= $userData ? "" : "d-none" ?> " aria-current="page" href="index.php?sec=admin_personajes">Administracion de Personajes</a>
                        <a class="nav-link  <?= $userData ? "d-none" : "" ?> " aria-current="page" href="index.php?sec=login">Login</a>
                       <a class="nav-link  <?= $userData ? "" : "d-none" ?> " aria-current="page" href="actions/auth_logout.php">Logout</a>
                        
                       
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="container">
        <?php
            require ("views/$vista.php")  ? "views/$vista.php" : "views/404.php" ;
        ?>
    </main>

    <footer class="bg-secondary">
        <p class="text-light text-center p-4">Todos los derechos reservados - 2025 - CFP20</p>
    </footer>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>