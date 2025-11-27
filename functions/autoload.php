<?php
/**
 * Autoload de Clases
 * 
 * Sistema de carga automática de clases siguiendo el patrón PSR-4.
 * Inicia sesiones y registra el autoloader.
 * 
 * @author Equipo "Noobs con Código"
 * @version 1.0
 */

/**
 * Función de autoload para cargar clases automáticamente
 * 
 * @param string $nombreClase Nombre de la clase a cargar
 */
function autoloadClases($nombreClase) {
    // Obtener ruta absoluta de la clase
    $archivoClase = __DIR__ . "/../class/" . $nombreClase . ".php";
    
    if (file_exists($archivoClase)) {
        require_once $archivoClase;
    }
}

// Registrar el autoloader
spl_autoload_register('autoloadClases');
?>