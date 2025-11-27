<?php
/**
 * Acción de Logout
 * 
 * Cierra la sesión del usuario administrador.
 */

session_start();
require_once "../../functions/autoload.php";

Alerta::info('Sesión cerrada correctamente');
$auth = new Autenticacion();
$auth->logout();
?>