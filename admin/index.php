<?php
/**
 * Panel de Administración - RetroCode
 * 
 * Controlador principal del panel de administración.
 * Maneja rutas, autenticación y carga de vistas.
 * 
 * @author Equipo "Noobs con Código"
 * @version 1.0
 */

session_start();
require_once "../functions/autoload.php";

// Secciones válidas del panel de administración
$secciones_validas = [
    "login" => [
        "titulo" => "Inicio de Sesión",
        "restringido" => false
    ],
    "dashboard" => [
        "titulo" => "Panel de Control",
        "restringido" => true
    ],
    "admin_juegos" => [
        "titulo" => "Administración de Juegos",
        "restringido" => true
    ],
    "add_juego" => [
        "titulo" => "Agregar Juego",
        "restringido" => true
    ],
    "edit_juego" => [
        "titulo" => "Editar Juego",
        "restringido" => true
    ],
    "delete_juego" => [
        "titulo" => "Eliminar Juego",
        "restringido" => true
    ]
];

// Obtener sección actual
$seccion = $_GET['sec'] ?? "dashboard";

// Verificar si la sección existe
if (!array_key_exists($seccion, $secciones_validas)) {
    $vista = "404";
    $titulo = "404 - Página no encontrada";
} else {
    $vista = $seccion;
    
    // Verificar autenticación para secciones restringidas
    if ($secciones_validas[$seccion]['restringido']) {
        (new Autenticacion)->verify();
    }
    
    $titulo = $secciones_validas[$seccion]['titulo'];
}

// Datos del usuario logueado
$userData = $_SESSION['loggedIn'] ?? false;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RetroCode Admin - <?= $titulo ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .admin-sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .admin-content {
            background: #f8f9fa;
            min-height: 100vh;
        }
        .nav-link {
            color: rgba(255,255,255,0.8) !important;
            transition: all 0.3s ease;
        }
        .nav-link:hover, .nav-link.active {
            color: white !important;
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block admin-sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">🎮 RetroCode</h4>
                        <small class="text-white-50">Panel de Administración</small>
                    </div>
                    
                    <?php if ($userData): ?>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link <?= $seccion === 'dashboard' ? 'active' : '' ?>" href="index.php?sec=dashboard">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $seccion === 'admin_juegos' ? 'active' : '' ?>" href="index.php?sec=admin_juegos">
                                    <i class="bi bi-controller"></i> Gestionar Juegos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $seccion === 'add_juego' ? 'active' : '' ?>" href="index.php?sec=add_juego">
                                    <i class="bi bi-plus-circle"></i> Agregar Juego
                                </a>
                            </li>
                            <hr class="text-white-50">
                            <li class="nav-item">
                                <a class="nav-link" href="actions/auth_logout.php">
                                    <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                                </a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>
            </nav>

            <!-- Contenido principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 admin-content">
                <!-- Sistema de Alertas -->
                <div class="pt-3">
                    <?= Alerta::render() ?>
                </div>
                <div class="pt-3 pb-2 mb-3">
                    <?php
                    $archivo_vista = "views/$vista.php";
                    if (file_exists($archivo_vista)) {
                        require $archivo_vista;
                    } else {
                        require "views/404.php";
                    }
                    ?>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>