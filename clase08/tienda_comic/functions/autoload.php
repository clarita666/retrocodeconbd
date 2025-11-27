<?php 

session_start();

function autoloadClases($nombreClase){

    /* Obtener Ruta absoluta, -> carpeta base donde estoy ejecutando la clase 
        Super Variables , Variables Magicas __DIR__
    */

    $archivoClase =  __DIR__ . "/../class/" . $nombreClase . ".php";

    if(file_exists($archivoClase)){
        require_once $archivoClase;
    }

}


spl_autoload_register('autoloadClases');















?>