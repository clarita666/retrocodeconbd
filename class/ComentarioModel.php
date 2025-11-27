<?php
/**
 * Modelo de Comentarios
 * 
 * Clase que gestiona todas las operaciones CRUD relacionadas con comentarios
 * de juegos. Permite crear, leer, contar y eliminar comentarios.
 * 
 * @author Equipo "Noobs con Código"
 * @version 1.0
 * @since 2024-01-01
 * 
 * Dependencias:
 * - Database: Clase singleton para conexión PDO
 * - Tablas: comentarios, usuarios, juegos
 * 
 * Características:
 * - Prepared statements para seguridad
 * - LEFT JOIN con usuarios para obtener nombres
 * - Ordenamiento cronológico descendente
 * - Métodos para estadísticas (conteo)
 */

/**
 * Clase ComentarioModel
 * 
 * Maneja la persistencia y recuperación de comentarios en la base de datos.
 * Implementa operaciones CRUD básicas con seguridad SQL.
 */
class ComentarioModel extends Conexion {
    
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
     * Obtiene todos los comentarios de un juego específico
     * 
     * Realiza un LEFT JOIN con la tabla usuarios para obtener el nombre
     * del usuario que hizo el comentario. Los comentarios se ordenan
     * por fecha de creación descendente (más recientes primero).
     * 
     * @param int $juego_id ID del juego del cual obtener comentarios
     * @return array Array de comentarios con información del usuario
     * @throws PDOException Si ocurre un error en la consulta
     * 
     * Estructura del array retornado:
     * [
     *   ['id' => int, 'contenido' => string, 'creado_at' => datetime,
     *    'juego_id' => int, 'usuario_id' => int, 'nombre_usuario' => string]
     * ]
     */
    public function obtenerPorJuego($juego_id) {
        $stmt = $this->db->prepare("
            SELECT c.* 
            FROM comentarios c 
            WHERE c.juego_id = ? 
            ORDER BY c.creado_at DESC
        ");
        $stmt->execute([$juego_id]);
        return $stmt->fetchAll();
    }
    
    /**
     * Crea un nuevo comentario en la base de datos
     * 
     * Inserta un comentario anónimo (sin usuario_id) para un juego específico.
     * La fecha de creación se establece automáticamente por la base de datos.
     * 
     * @param int $juego_id ID del juego al que pertenece el comentario
     * @param string $contenido Texto del comentario (máx. 1000 caracteres)
     * @return bool True si se insertó correctamente, false en caso contrario
     * @throws PDOException Si ocurre un error en la inserción
     * 
     * Ejemplo de uso:
     * $exito = $modelo->crear(1, 'Excelente juego!');
     * if ($exito) {
     *     echo 'Comentario guardado';
     * }
     */
    public function crear($juego_id, $contenido, $nombre = 'Anónimo') {
        $stmt = $this->db->prepare("
            INSERT INTO comentarios (juego_id, nombre_usuario, contenido) 
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$juego_id, $nombre, $contenido]);
    }
    
    /**
     * Cuenta el número total de comentarios de un juego
     * 
     * Utilizado para mostrar estadísticas y contadores en la interfaz.
     * 
     * @param int $juego_id ID del juego del cual contar comentarios
     * @return int Número total de comentarios del juego
     * @throws PDOException Si ocurre un error en la consulta
     * 
     * Ejemplo de uso:
     * $total = $modelo->contarPorJuego(1);
     * echo "Este juego tiene {$total} comentarios";
     */
    public function contarPorJuego($juego_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM comentarios WHERE juego_id = ?");
        $stmt->execute([$juego_id]);
        return $stmt->fetch()['total'];
    }
    
    /**
     * Elimina un comentario por su ID
     * 
     * Método para moderación de contenido. Elimina permanentemente
     * un comentario de la base de datos.
     * 
     * @param int $id ID del comentario a eliminar
     * @return bool True si se eliminó correctamente, false en caso contrario
     * @throws PDOException Si ocurre un error en la eliminación
     * 
     * Nota: Esta operación es irreversible. Considerar implementar
     * un sistema de "soft delete" para mayor seguridad.
     */
    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM comentarios WHERE id = ?");
        return $stmt->execute([$id]);
    }
}