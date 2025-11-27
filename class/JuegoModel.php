<?php
/**
 * Modelo de Juegos
 * 
 * Clase que maneja todas las operaciones relacionadas con la entidad Juegos.
 * Implementa el patrón Active Record para interactuar con la base de datos.
 * 
 * @author Equipo "Noobs con Código"
 * @version 1.0
 * @since 2024-01-01
 * 
 * Dependencias:
 * - Conexion: Clase base para conexión PDO
 * - Tablas: juegos, categorias
 * 
 * Características:
 * - Prepared statements para seguridad SQL
 * - JOIN automático con tabla categorias
 * - Métodos CRUD básicos
 * - Manejo de errores con excepciones PDO
 */

/**
 * Clase JuegoModel
 * 
 * Proporciona métodos para acceder y manipular datos de juegos
 * en la base de datos MySQL.
 */
class JuegoModel extends Conexion {
    
    /**
     * Constructor de la clase
     * 
     * Inicializa la conexión a la base de datos.
     * 
     * @throws PDOException Si falla la conexión a la base de datos
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Obtiene todos los juegos de la base de datos
     * 
     * Realiza un JOIN con la tabla categorias para obtener el nombre
     * de la categoría junto con los datos del juego.
     * 
     * @return array Array asociativo con todos los juegos y sus categorías
     * @throws PDOException Si ocurre un error en la consulta
     * 
     * Estructura del array retornado:
     * [
     *   ['id' => int, 'nombre' => string, 'empresa' => string, 
     *    'portada' => string, 'categoria' => string, ...]
     * ]
     */
    public function obtenerTodos() {
        $stmt = $this->db->prepare("
            SELECT j.*, c.nombre as categoria 
            FROM juegos j 
            LEFT JOIN categorias c ON j.id_categoria = c.id 
            ORDER BY j.id
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * Obtiene juegos filtrados por categoría
     * 
     * Busca todos los juegos que pertenecen a una categoría específica.
     * Utiliza prepared statements para prevenir inyección SQL.
     * 
     * @param string $categoria Nombre de la categoría a filtrar
     * @return array Array de juegos de la categoría especificada
     * @throws PDOException Si ocurre un error en la consulta
     * 
     * Ejemplo de uso:
     * $juegos = $modelo->obtenerPorCategoria('aventura');
     */
    public function obtenerPorCategoria($categoria) {
        $stmt = $this->db->prepare("
            SELECT j.*, c.nombre as categoria 
            FROM juegos j 
            JOIN categorias c ON j.id_categoria = c.id 
            WHERE c.nombre = ?
            ORDER BY j.id
        ");
        $stmt->execute([$categoria]);
        return $stmt->fetchAll();
    }
    
    /**
     * Obtiene un juego específico por su ID
     * 
     * Busca un juego individual usando su identificador único.
     * Incluye información de la categoría mediante JOIN.
     * 
     * @param int $id Identificador único del juego
     * @return array|false Array con datos del juego o false si no existe
     * @throws PDOException Si ocurre un error en la consulta
     * 
     * Ejemplo de uso:
     * $juego = $modelo->obtenerPorId(1);
     * if ($juego) {
     *     echo $juego['nombre'];
     * }
     */
    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("
            SELECT j.*, c.nombre as categoria 
            FROM juegos j 
            LEFT JOIN categorias c ON j.id_categoria = c.id 
            WHERE j.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}