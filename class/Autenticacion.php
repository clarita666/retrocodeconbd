<?php
/**
 * Clase Autenticación
 * 
 * Maneja el sistema de login y autenticación de usuarios administradores.
 * 
 * @author Equipo "Noobs con Código"
 * @version 1.0
 */

class Autenticacion {
    
    /**
     * Verifica si el usuario está autenticado
     * Redirige al login si no está logueado
     */
    public function verify() {
        if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
            header('Location: index.php?sec=login');
            exit;
        }
    }
    
    /**
     * Autentica un usuario con email y contraseña
     * 
     * @param string $email Email del usuario
     * @param string $password Contraseña del usuario
     * @return bool True si la autenticación es exitosa
     */
    public function login($email, $password) {
        // Credenciales por defecto (en producción usar base de datos)
        $adminEmail = 'admin@retrocode.com';
        $adminPassword = 'admin123';
        
        if ($email === $adminEmail && $password === $adminPassword) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_name'] = 'Administrador';
            return true;
        }
        
        return false;
    }
    
    /**
     * Cierra la sesión del usuario
     */
    public function logout() {
        session_destroy();
        header('Location: index.php?sec=login');
        exit;
    }
    
    /**
     * Verifica si el usuario está logueado
     * 
     * @return bool True si está logueado
     */
    public function isLoggedIn() {
        return isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true;
    }
}
?>