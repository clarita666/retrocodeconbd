<?php

class Conexion {

    //atributos -> constantes
    //conexion PDO (no funciona mysqli con POO)

    public const DB_SERVER = "localhost";
    public const DB_USER = "root";
    public const DB_PASS = "";
    public const DB_NAME  = "tienda_comics";

    const DB_DSN = "mysql:host=" . self::DB_SERVER . ";dbname=" . self::DB_NAME .";charset=utf8mb4";


    // atributo tipo PDO

    protected PDO $db;

    public function __construct()
    {
        try {
            $this->db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS);
            
        } catch (Exception $e) {
           die("Error al conectar la base de datos" );
        }
    }



 

     // Metodo get para llamar la conexion
    public function getConexion() {
        return $this->db;
    }
     
     


}












?>