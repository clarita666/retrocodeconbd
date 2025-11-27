<?php
/**
 * Clase Conexion
 * 
 * Maneja la conexión a la base de datos usando PDO.
 * Clase base para otros modelos.
 * 
 * @author Equipo "Noobs con Código"
 * @version 1.0
 */

class Conexion {
    
    // Constantes de conexión
    public const DB_SERVER = "localhost";
    public const DB_USER = "root";
    public const DB_PASS = "";
    public const DB_NAME = "juegos_db";
    
    const DB_DSN = "mysql:host=" . self::DB_SERVER . ";dbname=" . self::DB_NAME . ";charset=utf8mb4";
    
    // Atributo PDO
    protected PDO $db;
    
    /**
     * Constructor - Establece la conexión PDO
     */
    public function __construct() {
        try {
            $this->db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die("Error al conectar la base de datos: " . $e->getMessage());
        }
    }
    
    /**
     * Obtiene la conexión PDO
     * 
     * @return PDO Instancia de la conexión
     */
    public function getConexion() {
        return $this->db;
    }
}
?>