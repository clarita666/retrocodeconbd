<?php
/**
 * Acción de Login
 * 
 * Procesa el formulario de inicio de sesión.
 */

session_start();
require_once "../../functions/autoload.php";

if ($_POST) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $auth = new Autenticacion();
    
    if ($auth->login($email, $password)) {
        // Login exitoso
        Alerta::success('¡Bienvenido al panel de administración!');
        header('Location: ../index.php?sec=dashboard');
        exit;
    } else {
        // Login fallido
        Alerta::error('Email o contraseña incorrectos');
        header('Location: ../index.php?sec=login');
        exit;
    }
} else {
    // Acceso directo sin POST
    header('Location: ../index.php?sec=login');
    exit;
}
?>