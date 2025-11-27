<?php
/**
 * Clase Database - Conexión Singleton a MySQL
 * 
 * Implementa el patrón Singleton para garantizar una única instancia
 * de conexión a la base de datos en toda la aplicación.
 * 
 * @author Equipo "Noobs con Código"
 * @version 1.0
 * @since 2024-01-01
 * 
 * Características:
 * - Patrón Singleton para una sola conexión
 * - Carga de variables de entorno desde archivo .env
 * - Configuración PDO optimizada para MySQL
 * - Manejo de errores con excepciones
 * - Charset UTF-8 para soporte internacional
 * - Valores por defecto para desarrollo local
 * 
 * Variables de entorno soportadas:
 * - DB_HOST: Host del servidor MySQL (default: 127.0.0.1)
 * - DB_PORT: Puerto del servidor MySQL (default: 3306)
 * - DB_NAME: Nombre de la base de datos (default: juegos_db)
 * - DB_USER: Usuario de MySQL (default: root)
 * - DB_PASS: Contraseña de MySQL (default: vacío)
 */

/**
 * Clase Database
 * 
 * Proporciona una conexión singleton a la base de datos MySQL
 * con configuración basada en variables de entorno.
 */
class Database {
    /**
     * Instancia única de la clase (Singleton)
     * @var Database|null
     */
    private static $instance = null;
    
    /**
     * Conexión PDO a la base de datos
     * @var PDO
     */
    private $connection;
    
    /**
     * Constructor privado (Singleton)
     * 
     * Inicializa la conexión cargando primero las variables de entorno
     * y luego estableciendo la conexión PDO.
     * 
     * @throws PDOException Si falla la conexión a la base de datos
     */
    private function __construct() {
        $this->loadEnv();
        $this->connect();
    }
    
    /**
     * Carga variables de entorno (simplificado para clase)
     * 
     * @return void
     */
    private function loadEnv() {
        // Configuración directa para presentación en clase
        $_ENV['DB_HOST'] = '127.0.0.1';
        $_ENV['DB_NAME'] = 'juegos_db';
        $_ENV['DB_USER'] = 'root';
        $_ENV['DB_PASS'] = '';
    }
    
    /**
     * Establece la conexión PDO a MySQL
     * 
     * Configura PDO con las mejores prácticas:
     * - Modo de error por excepciones
     * - Fetch mode asociativo por defecto
     * - Charset UTF-8 para soporte internacional
     * - Configuración SSL deshabilitada para desarrollo local
     * 
     * @throws PDOException Si falla la conexión
     * @return void
     */
    private function connect() {
        // Obtener configuración con valores por defecto
        $host = $_ENV['DB_HOST'] ?? '127.0.0.1';
        $port = $_ENV['DB_PORT'] ?? '3306';
        $dbname = $_ENV['DB_NAME'] ?? 'juegos_db';
        $username = $_ENV['DB_USER'] ?? 'root';
        $password = $_ENV['DB_PASS'] ?? '';
        
        try {
            $this->connection = new PDO(
                "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
                $username,
                $password,
                [
                    // Lanzar excepciones en caso de error
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    // Fetch asociativo por defecto
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    // Deshabilitar verificación SSL para desarrollo local
                    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
                    PDO::MYSQL_ATTR_SSL_CA => null
                ]
            );
        } catch (PDOException $e) {
            // Terminar ejecución si falla la conexión
            die("Error de conexión: " . $e->getMessage());
        }
    }
    
    /**
     * Obtiene la instancia única de la clase (Singleton)
     * 
     * Si no existe una instancia, la crea. Si ya existe, la retorna.
     * Garantiza que solo haya una conexión a la base de datos.
     * 
     * @return Database Instancia única de la clase
     * 
     * Ejemplo de uso:
     * $db = Database::getInstance();
     * $pdo = $db->getConnection();
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Obtiene la conexión PDO
     * 
     * Retorna la instancia PDO configurada para realizar consultas
     * a la base de datos.
     * 
     * @return PDO Conexión PDO configurada
     * 
     * Ejemplo de uso:
     * $pdo = Database::getInstance()->getConnection();
     * $stmt = $pdo->prepare("SELECT * FROM juegos");
     */
    public function getConnection() {
        return $this->connection;
    }
}