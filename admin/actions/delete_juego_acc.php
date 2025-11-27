<?php
/**
 * Acción para eliminar juego
 * 
 * Elimina un juego y su imagen asociada.
 */

session_start();
require_once "../../functions/autoload.php";

// Verificar autenticación
(new Autenticacion)->verify();

if ($_POST) {
    try {
        $id = $_POST['id'] ?? null;
        $portada = $_POST['portada'] ?? '';
        
        if (!$id) {
            throw new Exception("ID de juego no válido.");
        }
        
        // Eliminar de la base de datos
        $juego = new Juego();
        if ($juego->delete($id)) {
            // Eliminar imagen si existe
            if ($portada) {
                $rutaImagen = "../../img/covers/" . $portada;
                if (file_exists($rutaImagen)) {
                    unlink($rutaImagen);
                }
            }
            
            Alerta::success('Juego eliminado correctamente');
            header('Location: ../index.php?sec=admin_juegos');
            exit;
        } else {
            throw new Exception("Error al eliminar el juego de la base de datos.");
        }
        
    } catch (Exception $e) {
        Alerta::error($e->getMessage());
        header('Location: ../index.php?sec=delete_juego&id=' . ($id ?? ''));
        exit;
    }
} else {
    header('Location: ../index.php?sec=admin_juegos');
    exit;
}
?>