<?php
/**
 * Clase Juego
 * 
 * Maneja todas las operaciones CRUD para la entidad Juegos.
 * Extiende de la clase Conexion para acceder a la base de datos.
 * 
 * @author Equipo "Noobs con Código"
 * @version 1.0
 */

class Juego extends Conexion {
    
    private $id;
    private $nombre;
    private $empresa;
    private $portada;
    private $precio;
    private $categoria;
    private $descripcion;
    
    /**
     * Obtiene todos los juegos de la base de datos
     * 
     * @return array Array de juegos
     */
    public function catalogo_completo() {
        $query = "SELECT j.*, c.nombre as categoria_nombre 
                  FROM juegos j 
                  LEFT JOIN categorias c ON j.id_categoria = c.id 
                  ORDER BY j.id";
        
        $PDOStatement = $this->db->prepare($query);
        $PDOStatement->execute();
        
        return $PDOStatement->fetchAll();
    }
    
    /**
     * Obtiene un juego por su ID
     * 
     * @param int $id ID del juego
     * @return array|false Datos del juego o false si no existe
     */
    public function juego_x_id($id) {
        $query = "SELECT j.*, c.nombre as categoria_nombre 
                  FROM juegos j 
                  LEFT JOIN categorias c ON j.id_categoria = c.id 
                  WHERE j.id = :id";
        
        $PDOStatement = $this->db->prepare($query);
        $PDOStatement->execute(['id' => $id]);
        
        return $PDOStatement->fetch();
    }
    
    /**
     * Obtiene juegos por categoría
     * 
     * @param string $categoria Nombre de la categoría
     * @return array Array de juegos de la categoría
     */
    public function juegos_x_categoria($categoria) {
        $query = "SELECT j.*, c.nombre as categoria_nombre 
                  FROM juegos j 
                  JOIN categorias c ON j.id_categoria = c.id 
                  WHERE c.nombre = :categoria 
                  ORDER BY j.id";
        
        $PDOStatement = $this->db->prepare($query);
        $PDOStatement->execute(['categoria' => $categoria]);
        
        return $PDOStatement->fetchAll();
    }
    
    /**
     * Inserta un nuevo juego en la base de datos
     * 
     * @param array $data Datos del juego
     * @return bool True si se insertó correctamente
     */
    public function insert($data) {
        // Obtener el próximo ID disponible
        $queryMaxId = "SELECT COALESCE(MAX(id), 0) + 1 as next_id FROM juegos";
        $stmt = $this->db->prepare($queryMaxId);
        $stmt->execute();
        $nextId = $stmt->fetch()['next_id'];
        
        $query = "INSERT INTO juegos (id, nombre, empresa, portada, precio, id_categoria, bajada) 
                  VALUES (:id, :nombre, :empresa, :portada, :precio, :categoria, :descripcion)";
        
        $PDOStatement = $this->db->prepare($query);
        
        return $PDOStatement->execute([
            'id' => $nextId,
            'nombre' => $data['nombre'],
            'empresa' => $data['empresa'],
            'portada' => $data['portada'],
            'precio' => $data['precio'],
            'categoria' => $data['categoria'],
            'descripcion' => $data['descripcion']
        ]);
    }
    
    /**
     * Actualiza un juego existente
     * 
     * @param int $id ID del juego
     * @param array $data Nuevos datos del juego
     * @return bool True si se actualizó correctamente
     */
    public function edit($id, $data) {
        $query = "UPDATE juegos SET 
                  nombre = :nombre, 
                  empresa = :empresa, 
                  portada = :portada, 
                  precio = :precio, 
                  id_categoria = :categoria, 
                  bajada = :descripcion 
                  WHERE id = :id";
        
        $PDOStatement = $this->db->prepare($query);
        
        return $PDOStatement->execute([
            'id' => $id,
            'nombre' => $data['nombre'],
            'empresa' => $data['empresa'],
            'portada' => $data['portada'],
            'precio' => $data['precio'],
            'categoria' => $data['categoria'],
            'descripcion' => $data['descripcion']
        ]);
    }
    
    /**
     * Elimina un juego de la base de datos
     * 
     * @param int $id ID del juego a eliminar
     * @return bool True si se eliminó correctamente
     */
    public function delete($id) {
        $query = "DELETE FROM juegos WHERE id = :id";
        
        $PDOStatement = $this->db->prepare($query);
        
        return $PDOStatement->execute(['id' => $id]);
    }
}
?>