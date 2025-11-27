<?php
session_start();
require_once 'functions/autoload.php';

$secciones_validas = [
    "home" => [
        "titulo" => "Bienvenidos"
    ],
    "quienes_somos" => [
        "titulo" => "Nosotros"
    ],
    "juegos" => [
        "titulo" => "Nuestro Catalogo"
    ],
    "juego" => [
        "titulo" => "Profundizar"
    ],
    "formularios" => [
        "titulo" => "Nuestro formulario"
    ],
    "creditos" => [
        "titulo" => "datos"
    ],
    "todos" => [
        "titulo" => "todos los juegos"
    ]
];

// operador terniario averiguar como se usa o que es

$seccion = isset($_GET['sec']) ? $_GET['sec'] : "home";

/* funciones predefinida que busque si existe lo que viene e la variable $seccion y si existe el indice de la variable $seccion_validas : array_key_exists */

if (!array_key_exists($seccion, $secciones_validas)) {
    $vista = "404";
    $titulo = "404 - pagina no encontrada";
} else {
    $vista = $seccion;
    $titulo = $secciones_validas[$seccion]['titulo'];
}



/* if(isset($_GET['sec'])) {
    $seccion = $_GET['sec'];
}else {
    $seccion = "home";
}
*/


/* $series = $productos ['superman'];

echo "</pre>";
var_dump ($series);
echo "</pre>";
*/




/* var_dump($seccion); */


?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> TP FINAL BLOG VIDEOJUGOS <?= $titulo  ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">


    <link rel="stylesheet" href="css/estilos.css">

</head>

<body class="vt323-regular text-light d-flex flex-column min-vh-100" style="background: <?php if(isset($_GET['id']) && $_GET['sec'] == 'juego') { require_once 'functions/autoload.php'; $juegoModel = new JuegoModel(); $juego_bg = $juegoModel->obtenerPorId($_GET['id']); $colores_bg = [1 => '#1a0000', 2 => '#0f0020', 3 => '#0a0a0a', 4 => '#200020', 5 => '#2a1a0a', 6 => '#2a2a00', 7 => '#2a1000', 8 => '#002a2a', 9 => '#0a2a0a', 10 => '#2a002a', 11 => '#0a2a0a', 12 => '#001a2a', 13 => '#2a1a0a', 14 => '#2a2000', 15 => '#2a1a10']; echo $colores_bg[$_GET['id']] ?? '#1a1a1a'; } else { echo '#1a1a1a'; } ?>;">


    <?php include __DIR__ . '/views/header.php'; ?>
    
    <!-- Sistema de Alertas -->
    <div class="container mt-3">
        <?= Alerta::render() ?>
    </div>
    
    <main class="container flex-grow-1">
        <?php
        // Cargar vistas desde src/views para la nueva estructura.
        // Comprobación segura: si la vista no existe, usar 404.
        $ruta_vista = __DIR__ . "/views/{$vista}.php";
        if (! file_exists($ruta_vista)) {
            $ruta_vista = __DIR__ . "/views/404.php";
        }
        require $ruta_vista;
        ?>
    </main>

    <footer class="mx-auto w-100" style="
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(20px);
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin-top: 40px;
    ">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-6">
                    <p class="text-light mb-2" style="font-size: 1.1rem; font-weight: 500;">
                        <span style="background: linear-gradient(45deg, #fff, #ff6b9d); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-weight: bold;">RETROCODE</span>
                    </p>
                    <p class="text-light opacity-75 mb-0" style="font-size: 0.9rem;">Tu destino para los videojuegos clásicos</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-light opacity-75 mb-2" style="font-size: 0.9rem;">Todos los derechos reservados - 2025</p>
                    <p class="text-light opacity-50 mb-0" style="font-size: 0.8rem;">CFP20 - Trabajo Final</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>